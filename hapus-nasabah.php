<?php
include 'koneksi.php';

$id_user   = $_GET['id_user'];

$query="DELETE from user where id_user='$id_user'";
mysqli_query($conn, $query);


header("location:nasabah.php");
?>

