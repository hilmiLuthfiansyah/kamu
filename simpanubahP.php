<?php
    include 'koneksi.php';

    session_start();
    if(!$_SESSION['is_logged_in']&&!$_SESSION['role']=='admin'){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }

    $id	= $_POST['id'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];

    $sql= "UPDATE admin set  nama='$nama', jabatan='$jabatan', alamat='$alamat' where id='$id'";

    if (!mysqli_query($conn,$sql)){
        echo "Gagal";         	
    }else{                  
        header('location:pegawai.php'); 
    }
    
?>
