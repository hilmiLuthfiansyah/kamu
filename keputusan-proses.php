<?php
    include 'koneksi.php';

    session_start();
    if(!$_SESSION['is_logged_in'] && !$_SESSION['role']=='pegawai'){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }

    $nama = $_POST['nama'];
    $rendah_bb = $_POST['rendah-bb'];
    $rendah_ba = $_POST['rendah-ba'];
    $sedang_bb = $_POST['sedang-bb'];
    $sedang_ba = $_POST['sedang-ba'];
    $tinggi_bb = $_POST['tinggi-bb'];
    $query= "
        INSERT INTO  
            aturan
        (
            nama,
            rendah_bb,
            rendah_ba,
            sedang_bb,
            sedang_ba,
            tinggi_bb
            )
        VALUES(                
            '$nama',
            '$rendah_bb',
            '$rendah_ba',
            '$sedang_bb',
            '$sedang_ba',
            '$tinggi_bb'
        );";
    if (!mysqli_query($conn,$query)){
        echo "Gagal";         	
        header('location:keputusan.php'); 
    }else{              
        header('location:keputusan.php'); 
    }
?>
