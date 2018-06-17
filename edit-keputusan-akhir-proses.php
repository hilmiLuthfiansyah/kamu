<?php
    include 'koneksi.php';

    session_start();
    if(!$_SESSION['is_logged_in']&& !$_SESSION['role']=='pegawai'){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }

    $id = $_POST['id'];
    $dipertimbangkan = $_POST['dipertimbangkan'];
    $diharapkan = $_POST['diharapkan'];
    
    

    $query= "
        UPDATE 
           keputusan
        SET  
            dipertimbangkan ='$dipertimbangkan', 
            diharapkan ='$diharapkan'
            
        WHERE
            id='$id';
        ";
        
    if (!mysqli_query($conn,$query)){
        echo "Gagal";         	
        header('location:keputusan.php'); 
    }else{                  
        header('location:keputusan.php'); 
    }
?>
