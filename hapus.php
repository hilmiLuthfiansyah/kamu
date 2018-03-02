<?php
include 'koneksi.php';

$nip   = $_GET['nip'];

$query="DELETE from admin where id='$nip'";
mysqli_query($conn, $query);

// mengalihkan ke halaman index.php
header("location:pegawai.php");
?>

