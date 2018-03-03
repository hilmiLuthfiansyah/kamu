<?php
    include 'koneksi.php';

    session_start();
    if(!$_SESSION['is_logged_in']){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }

    $id_kredit = $_POST['id_kredit'];
    $pengajuan = $_POST['pengajuan'];
    $waktu_pengembalian = $_POST['waktu_pengembalian'];
    $jaminan = $_POST['jaminan'];
    

    $query= "
        UPDATE 
           kredit 
        SET  
            pengajuan ='$pengajuan', 
            waktu_pengembalian ='$waktu_pengembalian', 
            jaminan ='$jaminan'
           
        WHERE
            id_kredit='$id_kredit';
        ";
        
    if (!mysqli_query($conn,$query)){
        echo "Gagal";         	
        header('location:transaksi-kredit.php'); 
    }else{                  
        header('location:transaksi-kredit.php'); 
    }
?>
