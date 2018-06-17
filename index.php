<?php
   session_start();
   if(!$_SESSION['is_logged_in']&& !$_SESSION['role']=='pegawai'){
       echo "<script>
     window.location = 'login.php';
     </script>";
   }
?>
    <?php
    include 'koneksi.php';  
    $sql="SELECT * from admin where role='pegawai'";  
    $hasil=mysqli_query($conn,$sql);
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

                            <li class="active">
                                <a href="index.php">
                                    <i class="icon-home"></i>
                                    <span>Beranda</span>
                                </a>
                                <?php
                        $role = $_SESSION['role'] == 'admin';
                        if($role){
                        ?>
                                    <li>
                                        <a href="keputusan.php" aria-expanded="false">
                                            <i class="icon-interface-windows"></i>
                                            <span>Kriteria Keputusan</span>
                                        </a>
                                    </li>
                                    <li>
                                       <a href="aturan-keputusan.php">
                                          <i class="icon-presentation"></i>
                                          <span>Aturan Keputusan</span>
                                       </a>
                                   </li>
                                    <li>
                                        <a href="pegawai.php">
                                            <i class="icon-form"></i>
                                            <span>Data Pegawai</span>
                                        </a>
                                    </li>
                                    <?php } else {?>
                                    <li>
                                        <a href="nasabah.php">
                                            <i class="icon-form"></i>
                                            <span>Data Nasabah</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="transaksi-kredit.php">
                                            <i class="icon-presentation"></i>
                                            <span>Transaksi Kredit</span>
                                        </a>
                                    </li>
                    </div>
                    <?php }?>
                </div>
            </nav>
            <div class="page home-page">
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
                        </span><strong class="text-primary">     BPR Majalengka</strong></div>
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
                <!-- Counts Section -->

                <!-- Header Section-->
                <section class="dashboard-header section-padding">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-md-stretch">

                            <header>
                                <center>
                                    <h2 class="display h4"><strong>Sejarah Singkat</strong></h2>
                                </center>
                                <p>
                                    <center>PD. BPR Sukahaji yang kemudian berganti nama menjadi Perumda BPR Majalengka tanggal 21 agustus 2015, sebagai Perusahaan Daerah sebagai salah satu Badan Usaha Milik Daerah (BUMD) mempunyai peran strategis dalam menciptakan
                                        pertumbuhan ekonomi wilayah, pelayanan public dalam hal perbankan juga memberikan ruang bagi lapangan pekerjaan serta memberikan kontribusi alam PAD. PUD. BPR Majalengka merupakan hasil penggabungan (merger) 7 bank
                                        yang meliputi PD. BPR Rajagaluh, Cikijing, Bantarujeg, Kadipaten, Kertajati, Jatitujuh, dan Ligung ke dalam PD. BPR Sukahaji, dan mulai beroprasi sejak tanggal 2 Juli 2008 denggan dasar hukum Perda Kabupaten Majalengka
                                        No. 3 Tahun 2007 tentang Pendirian PD.BPR Sukahaji hasil merjer, serta dilengkapi dengan ijin Bank Indonesia melalui Surat Keputusan Gubernur Bank Indonesia tanggal 13 Mei 2008. Modal dasar PD. BPR Sukahaji memiliki
                                        Modal dasar Rp. 10.000.000.000,- (sepuluh Milyar Rupiah), sesuai dengan Anggaran Dasarnya yaitu Peraturan Daerah No.3 Tahun 2007 dan diganti menjadi Perda No.4 Tahun 2015 tentang Perubahan nama PD.BPR Sukahaji Majalengka
                                        menjadi Perumda BPR Majalengka. Didukung komitmen bersama pemegang saham dan pengurus serta staff menjadikan PD. BPR Sukahaji sebagai suatu Perusahaan Daerah Penyumbang terbesar Pendapatan Asli Daerah Tahun 2015
                                        dan mampu bersaing didunia perbankan dibandingkan dengan BPR lainya yang ada di Majalengka.
                                    </center>
                                </p>
                        </div>
                    </div>
                </section>
                <section class="dashboard-header section-padding">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-md-stretch">

                            <header>
                                <center>
                                    <h2 class="display h4"><strong>VISI</strong></h2>
                                </center>
                                <p>
                                    <center>Memujudkan Perusahaan Daerah Bank Perkreditan Rakyat (PD.BPR) Sukahaji yang Terbaik dan Terpercaya
                                    </center>
                                </p>
                                <center><br><br>
                                    <h2 class="display h4"><strong>MISI</strong></h2>
                                </center>
                                <p>
                                    <center> Memberikan layanan perbankan yang prima dengan meningkatkan kualitas sumberdaya manusia yang handal dengan mengandalkan Standar Operasional Prosedur dan Informasi dan teknologi, laba usaha dan Pendapatan Asli Daerah
                                        yang makin meningkat, meningkatkan manajemen yang profesional dan transparan serta berorientasi pada kebutuhan Pasar usaha Mikro, Kecil dan menengah. 
                                    </center>
                                </p>
                                <center><br><br>
                                    <h2 class="display h4"><strong>MOTTO</strong></h2>
                                </center>
                                <p>
                                    <center> “Mitra Kerja membangun Ekonomi Rakyat”
                                    </center>
                                </p>

                        </div>
                    </div>
                </section>
                <!-- Statistics Section-->

                <footer class="main-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Your company &copy; 2017-2019</p>
                            </div>
                            <div class="col-sm-6 text-right">
                                <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <script src="js/front.js"></script>
        </body>

        </html>