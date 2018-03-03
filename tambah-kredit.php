<?php
    include 'koneksi.php';
    $id_user	            = $_POST['id_user'];
    $pengajuan          = $_POST['pengajuan'];
    $waktu_pengembalian = $_POST['waktu_pengembalian'];
    $jaminan  	= $_POST['jaminan'];
   

    $sql= "INSERT INTO kredit(
                id_user,
                pengajuan,
                waktu_pengembalian,
                jaminan
                )
            VALUES(
                '$id_user',
                '$pengajuan',
                '$waktu_pengembalian',
                '$jaminan'
                );";
               
    if (!mysqli_query($conn, $sql)){
        echo "<script> alert('Gagal menambahkan pemohon kredit'); location = 'transaksi-kredit.php'; </script>";             	
    }else{           
        echo "<script> alert('Berhasil menambahkan pemohon kredit'); location = 'transaksi-kredit.php'; </script>";
    }
?>
       
      	

