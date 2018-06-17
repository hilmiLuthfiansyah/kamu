<?php
session_start();
   if(!$_SESSION['is_logged_in'] && !$_SESSION['role']=='pegawai'){
       echo "<script>
     window.location = 'login.php';
     </script>";
	}
    include 'koneksi.php';  
    $id = $_GET['id'];
	$sql = "
        SELECT 
            kredit.id_kredit,
            kredit.ranking, 
            kredit.kriteria,
            kredit.tgl_kredit, 
            user.id_user, 
            user.nama
        FROM 
            kredit
        INNER JOIN 
            user
        ON
            user.id_user = kredit.id_user
        WHERE id_kredit = $id";
    $hasil = mysqli_query($conn,$sql);
    header('Content-Type: application/json');
    while($row = $hasil->fetch_array()){
        
        $object = json_decode(json_encode(array(
            'id_kredit' => $row['id_kredit'],
            'id_user' => $row['id_user'],
            'nama' => $row['nama'],
            'ranking' => $row['ranking'],
            'kriteria' => json_decode($row['kriteria']),
            'tgl_kredit' => $row['tgl_kredit'],
        )));
    }
    echo json_encode($object);
?>