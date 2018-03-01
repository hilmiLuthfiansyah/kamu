<?php
session_start(); //mulai session, krena kita akan menggunakan session pd file php ini
include 'koneksi.php'; //hubungkan dengan config.php untuk berhubungan dengan database

$username=$_POST['username']; //tangkap data yg di input dari form login input username
$password= md5($_POST['password']); //tangkap data yg di input dari form login input password

$query=mysqli_query($conn, "select * from admin where username='$username' and password='$password'"); //melakukan pengampilan data dari database untuk di cocokkan
$result = $conn->query("select * from admin where username='$username' and password='$password'");

if($result->num_rows > 0){ // melakukan pemeriksaan kecocokan dengan percabangan.
    while($row = $result->fetch_assoc()) {
        $_SESSION['role'] = $row["role"];
        $_SESSION['is_logged_in'] = true;
    }
   //jika cocok, buat session dengan nama sesuai dengan username
   header("location:index.php"); // dan alihkan ke index.php
}else{ //jika tidak tampilkan pesan gagal login
   echo "<script> alert('Username atau Password Salah'); location = 'login.php'; </script>";
}
    
?>