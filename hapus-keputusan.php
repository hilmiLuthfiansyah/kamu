<?php
include 'koneksi.php';

$id  = $_GET['id'];

$query="DELETE from aturan where id='$id'";
mysqli_query($conn, $query);


header("location:keputusan.php");
?>

