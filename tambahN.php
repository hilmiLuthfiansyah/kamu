<?php
    include 'koneksi.php';
    $id_user	            = $_POST['id_user'];
    $nama           = $_POST['nama'];
    $alamat      	= $_POST['alamat'];
    $pekerjaan  	= $_POST['pekerjaan'];
    $umur        	= $_POST['umur'];
    $penghasilan	= $_POST['penghasilan'];
    $tanggungan 	= $_POST['tanggungan'];

    $sql= "INSERT INTO user(
                id_user,
                nama,
                alamat,
                pekerjaan,
                umur,
                penghasilan,
                tanggungan
                )
            VALUES(
                '$id_user',
                '$nama',
                '$alamat',
                '$pekerjaan',
                '$umur',
                '$penghasilan',
                '$tanggungan')";
    
    if (!mysqli_query($conn, $sql)){
        echo "<script> alert('Gagal menambahkan pemohon kredit'); location = 'nasabah.php'; </script>";             	
    }else{           
        echo "<script> alert('Berhasil menambahkan pemohon kredit'); location = 'nasabah.php'; </script>";
    }
?>
       
      	

