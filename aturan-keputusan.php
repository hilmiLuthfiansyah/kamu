<?php
   session_start();
   if(!$_SESSION['is_logged_in']&& !$_SESSION['role']=='admin'){
       echo "<script>
     window.location = 'login.php';
     </script>";
   }

    include 'koneksi.php';  
    $sql="SELECT * from aturan_keputusan;";  
    $hasil=mysqli_query($conn,$sql);


    $q_aturan = "SELECT * FROM aturan;";
    $aturan = mysqli_query($conn,$q_aturan);

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

                  <li ><a href="index.php">
                        <i class="icon-home"></i>
                        <span>Beranda</span>
                     </a>

                     <?php
                $role = $_SESSION['role'] == 'admin';
                if($role){
                ?>
                        <li>
                           <a href="keputusan.php"  aria-expanded="false">
                              <i class="icon-interface-windows"></i>
                              <span>Kriteria Keputusan</span>
                           </a>
                        </li>
                        <li class="active">
                           <a href="pegawai.php">
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
                              <span>Pemohon Kredit</span>
                           </a>
                        </li>
                        <li>
                           <a href="keputusan.php">
                              <i class="icon-presentation"></i>
                              <span>Keputusan</span>
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
            <div class="breadcrumb-holder">
               <div class="container-fluid">
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item active"><h3>Kriteria dan Aturan Kredit<h3></li>
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
                                 <th>Id</th>
                                 <th>Nama Aturan</th>
                                 <th>Tanggal Dibuat</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php	
                               $per_page=10;
                               $page_query=mysqli_query($conn,"SELECT * FROM aturan_keputusan");
                               $total=mysqli_num_rows($page_query);
                               $pages=ceil($total/$per_page);

                               $page=(isset($_GET['page'])) ? (int)$_GET['page']:1;
                               $start=($page-1)*$per_page;
                               $query=mysqli_query($conn,"SELECT * FROM aturan_keputusan LIMIT $start, $per_page");
                               $no=$start+1;
                    
                              while($data=mysqli_fetch_assoc($query)){         
                    
                                 ?>
                                 <tr>
                                    <td>
                                       <?php echo $no++;?>
                                    </td>
                                    <td>
                                       <?php echo $data['id'];?>
                                    </td>
                                    <td>
                                       <?php echo $data['nama'];?>
                                    </td>
                                    <td>
                                       <?php echo $data['tgl_dibuat'];?>
                                    </td>
                                    <td>
                                       <a style="color: blue;" data-toggle="modal" data-target="#myModal">Read</a>
                                       <a href= <?php echo "edit-aturan-keputusan.php?id=", $data['id']; ?>>Edit</a>
                                      
                                       <a style="color: red;" onclick="return confirm('Hapus Data?');"href=<?php echo "hapus-aturan-keputusan.php?id=", $data['id']; ?>>Delete</a>
                                    </td>
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
                              <h2 class="h5 display display">Masukkan Pegawai Kredit</h2>
                           </div>
                           <div class="card-body">
                              <p>Silahkan masukkan data yang diperlukan:</p>
                              <form action="aturan-keputusan-proses.php" method="post">
                                <div class="row">
                                    <div class='col-lg-12' style='margin-bottom:10px;'>
                                        <label for='Nilai'>Nama Aturan</label>
                                        <input type="text" name="nama" placeholder="Nama aturan" class="form-control">
                                    </div>
                                 </div>
                                 <div class="row">
                                 <?php 
                                    while($k = mysqli_fetch_array($aturan)){
                                        $nama = strtolower($k['nama']);
                                        echo "
                                            <div class='col-lg-6' style='margin-bottom:0px;'>
                                                <div class='form-group'>
                                                    <label>",$k['nama'],"</label>
                                                    <select name='",$nama,"' class='form-control'>
                                                        <option value='rendah' >Rendah</option>
                                                        <option value='sedang' >Sedang</option>
                                                        <option value='tinggi' >Tinggi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        ";
                                    }
                                    ?>
                                 </div>
                                 <div class="row">
                                    <div class='col-lg-12'>
                                        <label for='Nilai'>Nilai Kelayakan</label>
                                        <select name='nilai' class='form-control'>
                                            <option value='tlayak' >Tidak layak</option>
                                            <option value='layak' >Layak</option>
                                        </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <input type="submit" name="submit" value="Buat Aturan" class="btn btn-primary">
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
         <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Aturan Keputusan</h4>
                </div>
                <div class="modal-body">
                <p>
                        <?php
                        $query = mysqli_query($conn,$sql);
                         
                        while($data=mysqli_fetch_assoc($query)){
                          echo $data['aturan'];
                         }
                         ?>
                </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
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