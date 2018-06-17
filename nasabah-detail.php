<?php
    session_start();
    if(!$_SESSION['is_logged_in'] ){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }else{
        if (!($_SESSION['role']=="pegawai")){
            echo "<script>
            window.location = 'index.php';
            </script>";  
        }
    }
    include 'koneksi.php';  
    $id_user = $_GET['id_user'];
    $query = "
        SELECT * FROM
            user
        WHERE
            id_user = '$id_user'
    ";
    $user = mysqli_query($conn,$query);
    while($data = mysqli_fetch_array($user)){
        $id = $data['id_user'];
        $penghasilan = $data['penghasilan'];
        $umur = $data['umur'];
        $tanggungan = $data['tanggungan'];
    } 
    header('Content-Type: application/json');
    if ($id!=NULL){
        echo json_encode(
            array(
                'status' => 200 ,
                'data' => array(
                    'id' => $id,
                    'penghasilan' => $penghasilan,
                    'umur' => $umur,
                    'tanggungan' => $tanggungan,
                )
            )
        );
    }else{
        echo json_encode(
            array(
                'status' => 400 ,
                'message' => "Error guys"
            )
        );
    }
    

?>