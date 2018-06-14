<?php
    include 'koneksi.php';
    $id_user = $_POST['id_user'];
    
    $q_aturan = "SELECT * FROM aturan;";
    $aturan = mysqli_query($conn,$q_aturan);
    
    // post inputan
    $input = array();
    while($data = mysqli_fetch_array($aturan)){
        array_push($input,strtolower($data['nama']));
    }
    // ngambil keputusan
    $keputusan = array();
    $fk = array();
    $kriteria=array();
    for ($i = 0; $i < count($input); $i++) {
        $nama = $input[$i];
        $nilai = $_POST[$input[$i]];
        array_push($kriteria, array(
            "nama" => $nama,
             "nilai" => $nilai,
        ));
        
    }
    if ($kriteria[1]['nilai'] >= $kriteria[3]['nilai']){
        $hasil = 20;
    }
    else{
        for ($i = 0; $i < count($input); $i++) {
            $nama = $input[$i];
            $nilai = $_POST[$input[$i]];
            $tmp_v = array();
            for ($j = 1; $j <= 3; $j++) { 
                $tmp_b = "";
                switch ($j) {
                    case 1:
                        $q_isaturan = "
                            SELECT 
                                * 
                            FROM
                                aturan
                            WHERE
                            nama = '$nama' && rendah_bb<=$nilai && rendah_ba >= $nilai
                            LIMIT 1;
                        ";
                        $tmp_b = "rendah";
                        break;
                    case 2:
                        $q_isaturan = "
                            SELECT 
                                * 
                            FROM
                                aturan
                            WHERE
                            nama = '$nama' && sedang_bb<=$nilai && sedang_ba >= $nilai
                            LIMIT 1;
                        ";
                        $tmp_b = "sedang";
                        break;
                    default:
                        $q_isaturan = "
                            SELECT 
                                * 
                            FROM
                                aturan
                            WHERE
                            nama = '$nama' && tinggi_bb<=$nilai && tinggi_ba >= $nilai
                            LIMIT 1;
                        ";
                        $tmp_b = "tinggi";
                        break;
                }
                $xx = mysqli_query($conn,$q_isaturan);
                while($dt = mysqli_fetch_array($xx)){
                        array_push($tmp_v,$tmp_b);
                }
            }
            array_push($fk, array(
                "nama" => $input[$i],
                "fk" => $tmp_v,
            ));
            array_push($keputusan,array(
                $input[$i] => $_POST[$input[$i]],
            ));
        }
        
        // for ($i=0; $i < count($fk);$i++){
        //     echo $fk[$i]['nama']." ";
        //     for ( $j = 0; $j < count($fk[$i]['fk']);$j++ ) {
        //         echo $fk[$i]['fk'][$j]." ";
        //     }
        //     echo "<br>";
        // }

        // ngambil nilai kelayakan
        $kelayakan = array();
        for ($i=0; $i < count($fk); $i++) {
            $nama = $fk[$i]['nama'] ;
            $val_kelayakan = [];
            if (count($fk[$i]['fk']) == 2){
                for ($j=0; $j < count($fk[$i]['fk']); $j++) {
                    $bb = $fk[$i]['fk'][$j];
                    if($bb == 'sedang'&& $j==1) {
                        $ba = "rendah_ba";
                        $bb = "sedang_bb";
                    }
                    if ($bb == 'tinggi'&& $j==1){
                        $ba = "sedang_ba";
                        $bb = "tinggi_bb";
                    }
                }
                $q = "
                    SELECT * FROM
                        aturan
                    WHERE
                        nama = '$nama'
                    LIMIT 1;
                ";
                $qq = mysqli_query($conn,$q);
                while($dt = mysqli_fetch_array($qq)){
                    $d = $dt[$bb];
                    $c = $dt[$ba];
                }
                for ($j=0; $j < count($input); $j++) { 
                    if ($input[$j]==$nama){
                        $z = $_POST[$nama];
                    }
                }
                // ttt = titik tengah
                $ttt = $d + (($c - $d) / 2);
                if ($z>$c && $z<=$d){
                    $hh = ($z - $d) / ($d-$c) * (-1);
                }else{
                    $hh = ($z - $c) / ($d-$c);
                }
                if ($z >= $ttt){
                    // hasil bobot
                    for ($j=0; $j < 2;  $j++) { 
                        if ($hh > 0.5 && $hh != 0){
                            $hb =  $fk[$i]['fk'][1];
                            $hh = $hh;
                            array_push($val_kelayakan, array(
                                "nama" => $hb,
                                "value" => $hh,
                            ));
                            $hh = 1 - $hh;
                        }else{
                            $hb =  $fk[$i]['fk'][0];
                            $hh = $hh;
                            array_push($val_kelayakan, array(
                                "nama" => $hb,
                                "value" => $hh,
                            ));
                            $hh = 1 - $hh;
                        }    
                    }
                } else {
                    for ($j=0; $j < 2;  $j++) { 
                        if ($hh > 0.5){
                            $hb =  $fk[$i]['fk'][0];
                            $hh = $hh;
                            array_push($val_kelayakan, array(
                                "nama" => $hb,
                                "value" => $hh,
                            ));
                            $hh = 1 - $hh;
                        }else{
                            $hb =  $fk[$i]['fk'][1];
                            $hh = $hh;
                            array_push($val_kelayakan, array(
                                "nama" => $hb,
                                "value" => $hh,
                            ));
                            $hh = 1 - $hh;
                        }
                    }
                }
            }else{
                $hb = $fk[$i]['fk'][0];
                $hh = 1;
                array_push($val_kelayakan, array(
                    "nama" => $hb,
                    "value" => $hh,
                ));
            }
            array_push($kelayakan, array(
                "$nama" => $val_kelayakan,
            ));
        }
        // var_dump($kelayakan);

        // ngambil aturan keputusan
        $q_aturan_keputusan = "
            SELECT * FROM aturan_keputusan;
        ";
        // dak short for data aturan keputusan
        $min = [];
        $dak = mysqli_query($conn,$q_aturan_keputusan);
        $res = [];
        while($d = mysqli_fetch_array($dak)){
            $p = 0;
            $min = 2;
            $val_k = "";
            // $jd short for json data
            $jd = json_decode($d['aturan'], true);
            $val_k = $jd['value'];;
            for ($i=0; $i < count($jd['aturan']); $i++) { 
                $val = $jd['aturan'][$i]['value'];
                $key = $jd['aturan'][$i]['nama'];
                for ($j=0; $j < count($kelayakan[$i][$key]); $j++) { 
                    if ($kelayakan[$i][$key][$j]['nama'] == $val){
                        $p++;
                        if ($min > $kelayakan[$i][$key][$j]['value']){
                            $min = $kelayakan[$i][$key][$j]['value'];
                        }
                        break;
                    }
                }
            }
            
        
            
            if ($p == count($jd['aturan'])){
                array_push($res, array(
                    "nama"=> $val_k,
                    "value" => $min,
                ));
            }

        }

        
        for ($i=0; $i < count($res); $i++){
             echo $res[$i]['nama']." ".$res[$i]['value']."<br>";
        }
        
        $zm_all = array();
        for ($i=0; $i < count($res); $i++){
            $z = 0;
            $m = 0;
            if($res[$i]['nama']=='tlayak'){
                $z= (100-($res[$i]['value'])*80);
                if($z <= 20 ){
                    $m=1;
                }
                else if($z >= 20 && $z <= 100 ){
                    $m= ($res[$i]['value']);
                }
                else if($z >= 100 ){
                    $m=0;
                }
            }
            else if($res[$i]['nama']=='layak'){
                $z = ($res[$i]['value']*80)+20;
                if($z <= 20 ){
                    $m=0;
                }
                if($z >= 20 && $z <= 100 ){
                    $m= $res[$i]['value'];
                }
                if($z >= 100 ){
                    $m=1;
                }
            }
        array_push($zm_all, array(
            "z" => $z,
            "m" => $m,
        ));
        }
        

        echo "print zm_all<br>";
        for ($i=0; $i < count($zm_all); $i++){
            echo $zm_all[$i]['z']." ".$zm_all[$i]['m']."<br>";
        }

        $jml = 0;
        $pred = 0;
        $n = count($zm_all);
        for ($i=0 ; $i < $n; $i++){
            $jml = $jml + ($zm_all[$i]['z']*$zm_all[$i]['m']);
            $pred = $pred + $zm_all[$i]['m'];
        }
        $hasil = $jml/$pred;
        echo $jml." ".$pred." ".$hasil;
    }

    // masuk ke database
    $x = json_encode($keputusan);
    $q_kredit= "INSERT INTO kredit(
                id_user,
                kriteria,
                ranking,
                tgl_kredit
                )
            VALUES(
                '$id_user',
                '$x',
                 '$hasil',
                NOW()
                );";
    if (!mysqli_query($conn, $q_kredit)){
        echo "<script> alert('Gagal menambahkan pemohon kredit'); location = 'transaksi-kredit.php'; </script>";             	
    }else{           
        echo "<script> alert('Berhasil menambahkan pemohon kredit'); location = 'transaksi-kredit.php'; </script>";
    }
?>