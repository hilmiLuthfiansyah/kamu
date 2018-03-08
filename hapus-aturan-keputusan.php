<?php
include 'koneksi.php';

$id  = $_GET['id'];

$query="DELETE from aturan_keputusan where id='$id'";
mysqli_query($conn, $query);


header("location:aturan-keputusan.php");
?>

