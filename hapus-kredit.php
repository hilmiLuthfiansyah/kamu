<?php
include 'koneksi.php';

$id_kredit   = $_GET['id_kredit'];

$query="DELETE from kredit where id_kredit='$id_kredit'";
mysqli_query($conn, $query);


header("location:transaksi-kredit.php");
?>

