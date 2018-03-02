<?php
include 'koneksi.php';
$id_user	            = $_POST['id_user'];
$nama           = $_POST['nama'];
$alamat      	= $_POST['alamat'];
$pekerjaan  	= $_POST['pekerjaan'];
$umur        	= $_POST['umur'];
$penghasilan	= $_POST['penghasilan'];
$pengajuan      = $_POST['pengajuan'];
$waktu_pengembalian 	= $_POST['waktu_pengembalian'];
$jaminan 	    = $_POST['jaminan'];
$tanggungan 	= $_POST['tanggungan'];

$sql= "insert into user(id_user,nama,alamat,pekerjaan,umur,penghasilan,tanggungan)values('$id_user','$nama','$alamat','$pekerjaan','$umur','$tanggungan')";
$sql .= "insert into kredit(pengajuan,waktu_pengembalian,jaminan)values('$pengajuan','$waktu_pengembalian','$jaminan')";
$hasil=mysqli_multi_query($conn, $sql);
      
if (!$hasil)
{
    echo "<script> alert('Gagal menambahkan pemohon kredit'); location = 'nasabah.php'; </script>";             	
 }
else
 {               
    echo "<script> alert('Berhasil menambahkan pemohon kredit'); location = 'nasabah.php'; </script>";
    
 }
      

?>
       
      	

