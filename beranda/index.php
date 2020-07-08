<html lang="en">
  <head>
    <?php include'../include/header.php' ?>
    <?php include'../include/footer.php'?>
    <?php include'../system/koneksi.php'?>
  </head>
  <body id="page-top">
    <?php 
    session_start();
    ob_start();
 
      // cek apakah yang mengakses halaman ini sudah login
      if($_SESSION['level']==""){
        header("location:../index.php?pesan=gagal");
      } $kode = $_SESSION['level'] ;
        $yanglagilogin = "SELECT * FROM user WHERE level = '$kode' " ;
        $result = mysqli_query ($koneksi, $yanglagilogin) ;
          if (!$result) {
            die ("gak bisa") ;
            }              
        $row = mysqli_fetch_assoc($result) ;
        $id_user = $row['id_user'];

        //mengambil id user yang sedang login
        $kode1 = $_SESSION['username'];
        $login = "SELECT * FROM user WHERE username = '$kode1' ";
        $result1 = mysqli_query($koneksi, $login);
        $row1 = mysqli_fetch_array($result1);
        $id_user1 = $row1['id_user'];
        $penerima = mysqli_query($koneksi, "SELECT * FROM tbl_surat_upload WHERE id_penerima ='$id_user1' OR id_penerima_2='$id_user1' OR id_penerima_3='$id_user1' OR id_pengirim='$id_user1'");
        $row2 = mysqli_fetch_array($penerima);
    ?>

    <?php 
      $surat = 'SELECT * FROM tbl_surat_upload';
      $query1 = mysqli_query($koneksi, $surat);
        if (!$query1) {
            die ('SQL Error: ' . mysqli_error($koneksi));
        }
    ?>
    <?php include'../include/navbar.php'?>
    <div id="wrapper">
    <?php include'../include/sidebar.php'?>
      
    <?php if(isset($_GET['page'])){
            $page = $_GET['page'];
            switch ($page) {
                case 'upload_surat':
                include "upload_surat.php";
              break;
                case 'log_surat':
                include "log_surat.php";
              break;
                case 'list_user':
                include "list_user.php";
              break;
                case 'transaksi_permohonan':
                include"transaksi_permohonan_surat.php";
              break;
                case 'permohonan_masuk':
                include"permohonan_masuk.php";
              break;
                case 'status_pengajuan':
                include"status_pengajuan.php";
              break;
                case 'approved':
                include"approved.php";
              break;
                case 'permohonan_masuk_2':
                include"permohonan_masuk_2.php";
              break;    
                case 'permohonan_masuk_3':
                 include"permohonan_masuk_3.php";
                        break;
            }
          } else {
      ?>
      <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Awal Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Beranda</a>
          </li>
        </ol>
        <!-- Akhir Breadcrumbs-->
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <h1 class="display-1">Sistem Pengolahan Surat</h1>
            </div>
          </div>
        </div>
        <?php
        
        //menghitung jumlah surat masuk dan surat yang diajukan
        $count = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tbl_surat_upload WHERE id_penerima = $id_user1"));
        $count2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tbl_surat_upload WHERE id_penerima_2 = $id_user1"));
        $count3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tbl_surat_upload WHERE id_penerima_3 = $id_user1"));
        $count4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tbl_surat_upload WHERE id_pengirim = $id_user1"));
        ?>
      
      <!-- Welcome Message -->
      <h3 style="margin-top: 15px"> Selamat Datang <?php echo $row['nama_eselon']; ?></h3>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br>
          <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-mail-bulk"></i>
                </div>
                <div class="mr-5">

                  <?php
                  
                  if ($row['id_user'] == $row2["id_penerima"] ) {
                    echo 'Jumlah Surat Masuk<h5 class="white-text link">'.$count.' Surat Masuk</h5>';
                  } elseif ($row['id_user'] == $row2["id_penerima_2"] ){
                    echo 'Jumlah Surat Masuk<h5 class="white-text link">'.$count2.' Surat Masuk</h5>';
                  } 
                  elseif ($row['id_user'] == $row2["id_penerima_3"] ){
                    echo 'Jumlah Surat Masuk<h5 class="white-text link">'.$count3.' Surat Masuk</h5>';
                  } 
                  elseif ($row['id_user'] == $row2["id_pengirim"] ){
                    echo 'Jumlah Surat Yang Diajukan<h5 class="white-text link">'.$count4.' Surat Yang Diajukan</h5>';
                  } 
                  else {
                    echo 'Jumlah Surat<h5 class="white-text link">0</h5>';
                  } 
                   ?> 
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Awal Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="../logout.php">Logout</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Akhir Logout Modal-->
  </body>
</html>
<?php } ?>