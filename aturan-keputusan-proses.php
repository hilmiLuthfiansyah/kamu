<?php
    include 'koneksi.php';

    session_start();
    if(!$_SESSION['is_logged_in'] && !$_SESSION['role']=='pegawai'){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }

    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];

    $q_aturan = "SELECT * FROM aturan;";
    $aturan = mysqli_query($conn, $q_aturan);
    $input = array();
    while($data = mysqli_fetch_array($aturan)){
        array_push($input,strtolower($data['nama']));
    }
    $keputusan = array();
    for ($i = 0; $i < count($input); $i++) {
        array_push($keputusan,array(
            "nama" => $input[$i],
            "value" => $_POST[$input[$i]]
        ));
    }
    $data = array(
        "aturan" => $keputusan,
        "value" => $_POST['nilai']
    );
    $vq_aturan = json_encode($data);
    $n = $_POST['nama'];
    $query= "
        INSERT INTO  
            aturan_keputusan
        (
            nama,
            aturan,
            tgl_dibuat
            )
        VALUES(                
            '$n',
            '$vq_aturan',
            NOW()
        );";
    if (!mysqli_query($conn,$query)){
        echo "Gagal";         	
        header('location:aturan-keputusan.php'); 
    }else{              
        header('location:aturan-keputusan.php'); 
    }
?>
