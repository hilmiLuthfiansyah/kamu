<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$nip   = $_GET['nip'];
// query SQL untuk insert data
$query="DELETE from admin where id='$nip'";
mysqli_query($conn, $query);
// mengalihkan ke halaman index.php
header("location:pegawai.php");
?>