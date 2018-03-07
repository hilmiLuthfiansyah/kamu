<?php
    include 'koneksi.php';
    $id_user	            = $_POST['id_user'];
    
    $q_aturan = "SELECT * FROM aturan;";
    $aturan = mysqli_query($conn,$q_aturan);
    $input = array();
    while($data = mysqli_fetch_array($aturan)){
        array_push($input,strtolower($data['nama']));
    }
    $keputusan = array();
    for ($i = 0; $i < count($input); $i++) {
        array_push($keputusan,array(
            $input[$i] => $_POST[$input[$i]],
        ));
    }

    $x = json_encode($keputusan);
    $q_kredit= "INSERT INTO kredit(
                id_user,
                kriteria,
                keputusan,
                ranking,
                tgl_kredit
                )
            VALUES(
                '$id_user',
                '$x',
                'layak',
                '1',
                NOW()
                );";
    if (!mysqli_query($conn, $q_kredit)){
        echo "<script> alert('Gagal menambahkan pemohon kredit'); location = 'transaksi-kredit.php'; </script>";             	
    }else{           
        echo "<script> alert('Berhasil menambahkan pemohon kredit'); location = 'transaksi-kredit.php'; </script>";
    }
?>
       
      	

