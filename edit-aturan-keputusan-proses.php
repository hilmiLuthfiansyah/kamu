<?php
    include 'koneksi.php';

    session_start();
    if(!$_SESSION['is_logged_in']){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $aturan = $_POST['aturan'];
    $tgl_dibuat = $_POST['tgl_dibuat'];
    

    $query= "
        UPDATE 
           aturan_keputusan
        SET  
            nama ='$nama', 
            aturan ='$aturan',
            tgl_dibuat='$tgl_dibuat'
            
        WHERE
            id='$id';
        ";
        
    if (!mysqli_query($conn,$query)){
        echo "Gagal";         	
        header('location:aturan-keputusan.php'); 
    }else{                  
        header('location:aturan-keputusan.php'); 
    }
?>
