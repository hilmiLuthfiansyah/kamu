<?php
include 'koneksi.php';
$id	            = $_POST['id'];
$nama           = $_POST['nama'];
$alamat      	= $_POST['alamat'];
$jk         	= $_POST['jk'];
$pekerjaan  	= $_POST['pekerjaan'];
$umur        	= $_POST['umur'];
$penghasilan	= $_POST['penghasilan'];
$pengajuan      = $_POST['pengajuan'];
$pengembalian 	= $_POST['pengembalian'];
$jaminan 	    = $_POST['jaminan'];
$tanggungan 	= $_POST['tanggungan'];

$sql= "insert into nasabah(id,nama,alamat,jk,pekerjaan,umur,penghasilan,pengajuan,pengembalian,jaminan,tanggungan)values('$id','$nama','$alamat','$jk','$pekerjaan','$umur','$penghasilan','$pengajuan','$pengembalian','$jaminan','$tanggungan')";

      
if (!mysqli_query($conn, $sql))
{
    echo "<script> alert('Gagal menambahkan pemohon kredit'); location = 'nasabah.php'; </script>";             	
 }
else
 {               
    echo "<script> alert('Berhasil menambahkan pemohon kredit'); location = 'nasabah.php'; </script>";
    
 }
      

?>
       
      	

