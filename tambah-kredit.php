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
    // ngambil kelayakan
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

    


    // ngambil yang besar
    $max_l = 0;
    $max_tl = 0;
    for ($i=0; $i < count($res); $i++) { 
        if ($res[$i]['nama'] == 'layak'){
            if($max_l < $res[$i]['value']){
                $max_l = $res[$i]['value'];
            }
        }else{
            if($max_tl < $res[$i]['value']){
                $max_tl = $res[$i]['value'];
            }
        }
    }
    // LOM
    $kl = 'tidak layak';
    $val_kl = $max_tl;
    if ($max_l > $max_tl){
        $kl = 'layak';
        $val_kl = $max_l;
    }
    

    // masuk ke database
    $x = json_encode($keputusan);
    $q_kredit= "INSERT INTO kredit(
                id_user,
                kriteria,
                keputusan,
                ranking,
                tgl_kredit
                )
            VALUES(
                '$id_user',
                '$x',
                 '$kl',
                '$val_kl',
                NOW()
                );";
    if (!mysqli_query($conn, $q_kredit)){
        echo "<script> alert('Gagal menambahkan pemohon kredit'); location = 'transaksi-kredit.php'; </script>";             	
    }else{           
        echo "<script> alert('Berhasil menambahkan pemohon kredit'); location = 'transaksi-kredit.php'; </script>";
    }
?>