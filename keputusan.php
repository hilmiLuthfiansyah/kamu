<?php
session_start();
?>
<?php
 include 'koneksi.php';  
 $sql="select * from nasabah";  
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

               <a href="index.php">
                  <i class="icon-home"></i>
                  <span>Beranda</span>
               </a>
            
               <?php
               $role = $_SESSION['role'] == 'admin';
               if($role){
               ?>
               <li> <a href="#pages-nav-list" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Kriteria Keputusan</span>
                   <div class="arrow pull-right"><i class="fa fa-angle-down"></i></div></a>
                   <ul id="pages-nav-list" class="collapse list-unstyled">
                       <li> <a href="#">Penghasilan</a></li>
                       <li> <a href="#">Pengajuan Kredit</a></li>
                       <li> <a href="#">Jangka Waktu</a></li>
                       <li> <a href="#">Agunan</a></li>
                       <li> <a href="#">Umur</a></li>
                       <li> <a href="#">Tanggungan</a></li>
                   </ul>
               </li>
               <li> <a href="pegawai.php"><i class="icon-form"></i><span>Data Pegawai</span></a></li>
               <?php } else {?>
                   <li > <a href="nasabah.php"><i class="icon-form"></i><span>Pemohon Kredit</span></a></li>
               <li class="active"> <a href="keputusan.php"><i class="icon-presentation"></i><span>Keputusan</span></a></li>
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
                        <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
                            <a href="index.html" class="navbar-brand">
                                <div class="brand-text d-none d-md-inline-block"><span>Halaman Pegawai </span><strong class="text-primary">   BPR Majalengka</strong></div>
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
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Data Pemohon Kredit</li>
                </ul>
            </div>
        </div>
        <section class="forms">
            <div class="container-fluid">
                <header>
                    <h1 class="h3 display">Data Pemohon Kredit Terdaftar</h1>
                </header>
                <div class="card-body">
                <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>ID Nasabah</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Pekerjaan</th>
                    <th>Umur</th>
                    <th>Penghasilan/Bulan</th>
                    <th>Pengajuan Kredit</th>
                    <th>Pengembalian/Bulan</th>
                    <th>Jaminan</th>
                    <th>Tanggungan</th>
                    <th>Keputusan Akhir</th>
                  </tr>
                </thead>
                <tbody>
                <?php	
                    $i=0;
                    while($data=mysqli_fetch_array($hasil))
                    {         
                    $i++;
                ?>
                  <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data['id'];?></td>
                  <td><?php echo $data['nama'];?></td>
                  <td><?php echo $data['alamat'];?></td>			
                  <td><?php echo $data['jk'];?></td>
                  <td><?php echo $data['pekerjaan'];?></td>
                  <td><?php echo $data['umur'];?></td>
                  <td><?php echo $data['penghasilan'];?></td>	
                  <td><?php echo $data['pengajuan'];?></td>			
                  <td><?php echo $data['pengembalian'];?></td>
                  <td><?php echo $data['jaminan'];?></td>			
                  <td><?php echo $data['tanggungan'];?></td>
                  <td><?php echo $data['keputusan'];?></td>

                  </tr>		
           <?php
           }
           ?>
          </tbody>
      </table>
     
     
        
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
    

</html>