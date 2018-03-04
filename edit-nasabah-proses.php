<?php
    include 'koneksi.php';

    session_start();
    if(!$_SESSION['is_logged_in'] && !$_SESSION['role']=='pegawai'){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }

    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $pekerjaan = $_POST['pekerjaan'];
    $penghasilan = $_POST['penghasilan'];
    $tanggungan = $_POST['tanggungan'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];

    $query= "
        UPDATE 
            user 
        SET  
            nama ='$nama', 
            pekerjaan ='$pekerjaan', 
            penghasilan ='$penghasilan', 
            tanggungan ='$tanggungan', 
            umur ='$umur', 
            alamat='$alamat'
        WHERE
            id_user='$id_user';
        ";
    
    if (!mysqli_query($conn,$query)){
        echo "Gagal";         	
        header('location:nasabah.php'); 
    }else{                  
        header('location:nasabah.php'); 
    }
?>
