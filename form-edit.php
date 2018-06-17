<?php
    include 'koneksi.php';
    session_start();
    if(!$_SESSION['is_logged_in']&& !$_SESSION['role']=='admin'){
        echo "<script>
        window.location = 'login.php';
        </script>";
    }     
    $nip        = $_GET['nip'];
    $query = "
        SELECT * FROM 
            admin
        WHERE
            id = '$nip';
    ";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
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
                            <span class="text-uppercase">Jawa barat</span>
                    </div>
                    <div class="sidenav-header-logo">
                    
                        <a href="index.php" class="brand-small text-center">
                            <strong class="text-primary">BPR</strong>
                        </a>
                    </div>
                </div>
                <div class="main-menu">
                    <ul id="side-main-menu" class="side-menu list-unstyled">
                        <li>
                            <a href="index.php">
                                <i class="icon-home"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class=>
                            <a href="keputusan.php">
                                <i class="icon-interface-windows"></i>
                                <span>Kriteria Keputusan</span>
                            </a>
                        </li>
                        <li >
                           <a href="aturan-keputusan.php">
                              <i class="icon-presentation"></i>
                              <span>Aturan Keputusan</span>
                           </a>
                        </li>
                        <li class="active">
                            <a href="forms.php">
                                <i class="icon-form"></i>
                                <span>Data Pegawai</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <div class="admin-menu">
                    <ul id="side-admin-menu" class="side-menu list-unstyled">
                        

                    </ul>
                </div>
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
                        <div class="brand-text d-none d-md-inline-block"><span>Halaman 
                            <?php if ($_SESSION['role']== 'admin'){
                                echo "Administrator";
                            }else{
                                echo "Pegawai";
                            } ?>
                        </span><strong class="text-primary">   BPR Majalengka</strong></div>
                    </a>
                     </div>

                     </ul>
                         <ul class="nav">
                             <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
                         </ul>

                     
                  </div>
               </div>
            </nav>
         </header>
            <div class="breadcrumb-holder">
                <div style="padding-left: 20px;" class="container-fluid">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active"> <h3>Edit Pegawai Kredit </h3></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card">
                            <div class="card-body">
                                <p>Silahkan ubah data yang diperlukan</p>
                                <form class="form-horizontal" action="simpanubahP.php" method="post">
                                    <input type="hidden" name="id" class="form-control" value="<?php echo $data['id'];?>">
                                    <div class="row">
                                        <div class="col-lg-6" style="margin-bottom:0px;">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control" value="<?php echo $data['nama'];?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="margin-bottom:0px;">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input type="text" name="jabatan" class="form-control" value="<?php echo $data['jabatan'];?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12" style="margin-bottom:0px;">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea style="min-height: 100px; max-height: 200px;" name="alamat" placeholder="Alamat Anda" class="form-control" > <?php echo $data['alamat'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="Ubah Data" class="btn btn-primary">
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
    </body>

    </html>