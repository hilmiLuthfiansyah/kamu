<?php
include 'koneksi.php';
$nip	  = $_POST['nip'];
$nama 	  = $_POST['nama'];
$jabatan= $_POST['jabatan'];
$alamat   = $_POST['alamat'];

$sql= "UPDATE users set  nama='$nama', jabatan='$jabatan', alamat='$alamat' where nip='$nip'";


 if (!mysqli_query($conn,$sql))
    {
    	echo "Gagal";         	
     }
    else
     {               
      header('location:pegawai.php'); 
     }
      	

?>
