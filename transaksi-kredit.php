<?php
   session_start();
   if(!$_SESSION['is_logged_in'] && !$_SESSION['role']=='pegawai'){
       echo "<script>
     window.location = 'login.php';
     </script>";
	}
	include 'koneksi.php';  
	$sql = "
        SELECT 
            kredit.id_kredit,
            kredit.ranking, 
            
            kredit.tgl_kredit, 
            user.id_user, 
            user.nama
        FROM 
            kredit
        INNER JOIN 
            user
        ON
            user.id_user = kredit.id_user";
    $hasil = mysqli_query($conn,$sql);
    $k_query = "
        SELECT * FROM 
            aturan";
    $kriteria = mysqli_query($conn,$k_query);
    $tanggungan = false;
    $penghasilan = false;
    $umur = false;
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BPR Majalengka</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
        <!-- Custom icon font-->
        <link rel="stylesheet" href="css/fontastic.css">
        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <!-- jQuery Circle-->
        <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
        <!-- Custom Scrollbar-->
        <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="css/custom.css">
        <!-- Favicon-->
        <link rel="shortcut icon" href="favicon.png">
        <!-- Tweaks for older IEs-->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>

    <body>
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <div class="side-navbar-wrapper">
                <div class="sidenav-header d-flex align-items-center justify-content-center">
                    <div class="sidenav-header-inner text-center">
                        <alt="person" class="img-fluid rounded-circle">
                            <h2 class="h5 text">BPR Majalengka</h2>
                            <span class="text-uppercase">Jawa Barat</span>
                    </div>
                    <div class="sidenav-header-logo">
                        <a href="index.php" class="brand-small text-center">
                            <strong class="text-primary">BPR</strong>
                        </a>
                    </div>
                </div>
                <div class="main-menu">
                    <ul id="side-main-menu" class="side-menu list-unstyled">

                        <a href="index.php">
                            <i class="icon-home"></i>
                            <span>Beranda</span>
                        </a>


                        <?php
			$role = $_SESSION['role'] == 'admin';
			if($role){
			?>
                            <li>
                                <a href="#pages-nav-list" data-toggle="collapse" aria-expanded="false">
                                    <i class="icon-interface-windows"></i>
                                    <span>Kriteria Keputusan</span>
                                    <div class="arrow pull-right">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </a>
                                <ul id="pages-nav-list" class="collapse list-unstyled">
                                    <li>
                                        <a href="#">Penghasilan</a>
                                    </li>
                                    <li>
                                        <a href="#">Pengajuan Kredit</a>
                                    </li>
                                    <li>
                                        <a href="#">Jangka Waktu</a>
                                    </li>
                                    <li>
                                        <a href="#">Agunan</a>
                                    </li>
                                    <li>
                                        <a href="#">Umur</a>
                                    </li>
                                    <li>
                                        <a href="#">Tanggungan</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="pegawai.php">
                                    <i class="icon-form"></i>
                                    <span>Data Pegawai</span>
                                </a>
                            </li>
                            <?php } else {?>
                            <li >
                                <a href="nasabah.php">
                                    <i class="icon-form"></i>
                                    <span>Data Nasabah</span>
                                </a>
                            </li>
                            <li class="active"> 
                                <a href="transaksi-kredit.php">
                                    <i class="icon-presentation"></i>
                                    <span>Transaksi Kredit</span>
                                </a>
                            </li>
                    </ul>
                </div>
                <?php }?>
            </div>
        </nav>

        <div class="page forms-page">
            <!-- navbar-->
            <header class="header">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <div class="navbar-header">
                            <a id="toggle-btn" href="#" class="menu-btn">
                                <i class="icon-bars"> </i>
                            </a>
                            <a href="index.php" class="navbar-brand">
                                <div class="brand-text d-none d-md-inline-block">
                                    <span>Halaman Pegawai </span>
                                    <strong class="text-primary"> BPR Majalengka</strong>
                                </div>
                            </a>
                        </div>
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link logout">Logout
                            <i class="fa fa-sign-out"></i>
                        </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
            <div class="breadcrumb-holder">
                <div class="container-fluid">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <h3>Data Transaksi Kredit </h3>
                        </li>
                    </ul>
                </div>
            </div>
            <section class="forms">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Transaksi</th>
                                        <th>Nama Nasabah</th>
                                        <th>Tanggal Kredit</th>
                                        <th>Nilai Kelayakan</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php	
                               $per_page=10;
                               $page_query=mysqli_query($conn,"
                               SELECT 
                                   kredit.id_kredit,
                                   kredit.ranking, 
                                   
                                   kredit.tgl_kredit, 
                                   user.id_user, 
                                   user.nama
                               FROM 
                                   kredit
                               INNER JOIN 
                                   user
                               ON
                                   user.id_user = kredit.id_user");
                               $total=mysqli_num_rows($page_query);
                               $pages=ceil($total/$per_page);

                               $page=(isset($_GET['page'])) ? (int)$_GET['page']:1;
                               $start=($page-1)*$per_page;
                               $query=mysqli_query($conn,"
                               SELECT 
                                   kredit.id_kredit,
                                   kredit.ranking, 
                         
                                   kredit.tgl_kredit, 
                                   user.id_user, 
                                   user.nama
                               FROM 
                                   kredit
                               INNER JOIN 
                                   user
                               ON
                                   user.id_user = kredit.id_user ORDER BY CONCAT(id_kredit) desc LIMIT $start, $per_page");
                               $no=$start+1;
                    
                              while($data=mysqli_fetch_assoc($query)){         
                    
                                 ?>
                                        <tr>
                                        <center>
                                            <td>
                                                 <?php echo $no++;?>
                                            </td>
                                            <td>
                                                <?php echo $data['id_kredit'];?>
                                            </td>
                                            <td>
                                                <?php echo $data['nama'];?>
                                            </td>
                                            <td>
                                                <?php echo $data['tgl_kredit'];?>
                                            </td>
                                            <td>
                                                <?php echo $data['ranking'];?>
                                            </td>
                                            
                                            <td>
                                                <a style="color: blue;" href=<?php echo "#"?>>Read</a>
                                                <a href=<?php echo "edit-kredit.php?id_kredit=", $data[ 'id_kredit']; ?>>Edit</a>
                                                <a style="color: red;" onclick="return confirm('Hapus Data?');"href=<?php echo "hapus-kredit.php?id_kredit=", $data[ 'id_kredit']; ?>>Delete</a>
                                               
                                            </td>
                                            </center>
                                        </tr>
                                        <?php
	}
	?>
                                </tbody>
                            </table>
                            <table class="table table-striped">
                        <?php
                        if($pages >= 1 && $page <= $pages ){
                            echo "<b>Total Halaman Tabel Adalah</b> &nbsp";
                            for($x=1; $x <= $pages; $x++){
                                echo "&nbsp", ($x == $page) ? '<b><a href="?page='.$x.'">'.$x.'</a></b>' : '<a href="?page='.$x.'">'.$x.'</a>';
                                
                            }
                        }
                        echo "<br/> ";
                        echo "<b>Total Data Adalah </b>","<b>$total</b>";
                        
                        ?>
                       </tbody>
                     </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h2 class="h5 display display">Masukkan Data Pemohon Kredit</h2>
                                </div>
                                <div class="card-body">
                                    <p>Silahkan masukkan data yang diperlukan:</p>
                                    <form action="tambah-kredit.php" method="post">
                                        <div class="row">
                                            <div class="col-lg-12" style="margin-bottom:0px;">
                                                <div class="form-group">
                                                    <label>ID Nasabah</label>
                                                    <input onchange="userDetail(this.value)"type="text" name="id_user" placeholder="ID Nasabah" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <?php 
                                            while($d = mysqli_fetch_array($kriteria)){
                                                $nama = strtolower($d['nama']);
                                                if ($nama== "Tanggungan"){
                                                    $tanggungan = true;
                                                    echo "
                                                    <div class='col-lg-6' style='margin-bottom:0px;'>
                                                        <div class='form-group'>
                                                            <label>",$nama,"</label>
                                                            <input type='text' name='", $nama,"' id='",$nama,"' placeholder='",$nama,"' class='form-control' >
                                                        </div>
                                                    </div>
                                                    ";
                                                } else if($nama== "umur"){
                                                    $umur = true;
                                                    echo "
                                                    <div class='col-lg-6' style='margin-bottom:0px;'>
                                                        <div class='form-group'>
                                                            <label>",$nama,"</label>
                                                            <input type='text' name='", $nama,"' id='",$nama,"' placeholder='",$nama,"' class='form-control'  >
                                                        </div>
                                                    </div>
                                                    ";
                                                } else if($nama == "Penghasilan"){
                                                    $penghasilan = true;
                                                    echo "
                                                    <div class='col-lg-6' style='margin-bottom:0px;'>
                                                        <div class='form-group'>
                                                            <label>",$nama,"</label>
                                                            <input type='text' name='", $nama,"' id='",$nama,"' placeholder='",$nama,"' class='form-control'  >
                                                        </div>
                                                    </div>
                                                    ";
                                                }else{
                                                    echo "
                                                    <div class='col-lg-6' style='margin-bottom:0px;'>
                                                        <div class='form-group'>
                                                            <label>",$d['nama'],"</label>
                                                            <input type='number' min='",$d['rendah_bb'],"' max='",$d['tinggi_ba'],"' id='",$nama,"' name='", $nama,"'placeholder='",$d['nama'],"' class='form-control' >
                                                        </div>
                                                    </div>
                                                    ";
                                                }
                                            }
                                        ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="Proses Data" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <p> BPR Majalengka</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p>Design by Hilmi Luthfiansyah</a>
                            </p>
                            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Javascript files-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js">
        </script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/jquery.cookie/jquery.cookie.js">
        </script>
        <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
        <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/front.js"></script>
        <script>
        function userDetail(str) {
            Penghasilan = '<?php echo $penghasilan ;?>';
            umur = '<?php echo $umur ;?>';
            Tanggungan = '<?php echo $tanggungan ;?>';
            if (str.length == 0) { 
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        const data = JSON.parse(this.responseText);
                        if(data.status == 200){
                            if (data.data.penghasilan != null && penghasilan){
                                document.getElementById("penghasilan").value = data.data.penghasilan;
                                document.getElementById("penghasilan").readOnly = true;
                            }
                            if (data.data.umur != null && umur){
                                document.getElementById("umur").value = data.data.umur;
                                document.getElementById("umur").readOnly = true;
                            }
                            if (data.data.tanggungan != null && tanggungan){
                                document.getElementById("tanggungan").value = data.data.tanggungan;
                                document.getElementById("tanggungan").readOnly = true;
                            }
                        }else{
                            if (tanggungan){
                                document.getElementById("tanggungan").readOnly = false;
                                document.getElementById("tanggungan").value = '';
                            }
                            if (umur){
                                document.getElementById("umur").readOnly = false;
                                document.getElementById("umur").value = '';
                            }
                            if (penghasilan){
                                document.getElementById("penghasilan").readOnly = false;
                                document.getElementById("penghasilan").value = '';
                            }
                        }
                    }
                };
                xmlhttp.open("GET", "nasabah-detail.php?id_user=" + str, true);
                xmlhttp.send();
            }
        }
</script>
    </body>

    </html>