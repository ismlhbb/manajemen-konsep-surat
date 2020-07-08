<?php
  require '../system/functions.php'; 
  $tgl=date('Y-m-d');
  ob_start();
  include"../system/koneksi.php"
?>
  <body id="page-top">
  <?php 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:../index.php?pesan=gagal");
  } ?>

  <div id="content-wrapper">
  <div class="container-fluid">
    <!-- Awal Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Upload Konsep Surat</a>
        </li>
      </ol>
    <!-- Awal Breadcrumbs-->

    <!-- Awal Form Upload Surat-->
    <div class="container"> 
    <form action="../system/tambah_upload_surat.php" class="form-horizontal" method="post" onsubmit="return empty()" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nomor_surat">1. Nomor Urut Surat</label>
        <input type="text" class="form-control" id="nomor_surat" placeholder="Nomor Surat" name="nomor_surat" required>
      </div>
      <div class="form-group col-md-6">
        <label for="asalSurat">2. Asal Surat</label>
        <input type="text" class="form-control" id="asal_surat" placeholder="Asal Surat" name="asal_surat" required>
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="perihal">3. Perihal</label>
        <input type="text" class="form-control" id="perihal" placeholder="Perihal" name="perihal" required>
      </div>
      <div class="form-group col-md-6">
        <label for="inputState">4. Eselon 4</label>
        <select id="id_penerima" class="form-control" name="id_penerima" required>
          <option value="">Please Select</option>
            <?php
             $query = mysqli_query($koneksi, "SELECT * FROM user WHERE level='eselon4'");
             while ($row = mysqli_fetch_assoc($query)) { ?>
             <option value="<?php echo $row['id_user']; ?>">
             <?php echo $row['nama_eselon']; ?>
             -
             <?php echo $row['jabatan']; ?>
          </option>
              <?php } ?>
         </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputState">5. Eselon 3</label>
        <select id="id_penerima_2" class="form-control" name="id_penerima_2" required>
          <option value="">Please Select</option>
            <?php
             $query = mysqli_query($koneksi, "SELECT * FROM user WHERE level='eselon3'");
             while ($row = mysqli_fetch_assoc($query)) { ?>
             <option value="<?php echo $row['id_user']; ?>">
             <?php echo $row['nama_eselon']; ?>
             -
             <?php echo $row['jabatan']; ?>
             </option>
             <?php } ?>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="inputState">6. Eselon 2</label>
        <select id="id_penerima_3" class="form-control" name="id_penerima_3">
          <option value="">Please Select</option>
            <?php
             $query = mysqli_query($koneksi, "SELECT * FROM user WHERE level='eselon2'");
             while ($row = mysqli_fetch_assoc($query)) { ?>
             <option value="<?php echo $row['id_user']; ?>">
             <?php echo $row['nama_eselon']; ?>
             -
             <?php echo $row['jabatan']; ?>
             </option>
             <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-row">
     <div class="form-group col-md-6">
        <label for="inputState">7. Tipe Naskah Dinas</label>
         <select id="jenis_naskah" class="form-control" name="jenis_naskah" required>
          <option value="">Please Select</option>
            <?php
             $query = mysqli_query($koneksi, "SELECT * FROM tbl_jenisnaskah ORDER BY jenis_naskah");
             while ($row = mysqli_fetch_assoc($query)) { ?>
             <option value="<?php echo $row['jenis_naskah']; ?>">
             <?php echo $row['jenis_naskah']; ?>
             </option>
             <?php } ?>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="inputState">8. Jenis Surat</label>
        <select id="jenis_surat" class="form-control" name="jenis_surat" required>
          <option value="">Please Select</option>
           <?php
            $query = mysqli_query($koneksi, "SELECT * FROM tbl_jenissurat INNER JOIN tbl_jenisnaskah ON tbl_jenissurat.id_jenis_fk = tbl_jenisnaskah.id_jenis ORDER BY nama_surat");
             while ($row = mysqli_fetch_assoc($query)) { ?>
              <option id="jenisSurat" class="<?php echo $row['jenis_naskah']; ?>" value="<?php echo $row['nama_surat']; ?>">
              <?php echo $row['nama_surat']; ?>
          </option>
              <?php } ?>
         </select>
      </div>
    </div>  
      <input type="hidden" class="form-control" id="status_baca" name="status_baca" value="belum">
      <input type="hidden" class="form-control" id="status_baca_2" name="status_baca_2" value="belum">
      <input type="hidden" class="form-control" id="status_baca_3" name="status_baca_3" value="belum">
      <input type="hidden" class="form-control" id="status_disposisi" name="status_disposisi" value="0">
      <input type="hidden" class="form-control" id="status_approve" name="status_approve" value="belum">

      <div class="form-row">
        <div class="form-grup col-md-6">
          <label for="custom-file">9. Upload File</label><br>
            <form action="upload.php" method="post" enctype="multipart/form-data">
              <input type="file" id="hasil_upload" name="hasil_upload" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
        </div>


      <?php   
        $kode = $_SESSION['username'];
        $yanglagilogin = "SELECT * FROM user WHERE username = '$kode' ";
        $result = mysqli_query($koneksi, $yanglagilogin);
        $row = mysqli_fetch_array($result); 
        $pengirim = $row['id_user'];
        $user = mysqli_query($koneksi, "SELECT id_user FROM user WHERE username ='$username'");
      ?>
      <input type = "hidden" class="form-control" name = "id_pengirim" value = "<?php echo $pengirim ;?>">
      <input type = "hidden" class="form-control" name = "revisi" value = "0">
      <input type = "hidden" class="form-control" name = "es4" value = "0">
      <input type = "hidden" class="form-control" name = "es3" value = "0"> 
      <input type = "hidden" class="form-control" name = "es2" value = "0">
       
      </div>
        <button type="submit" class="btn btn-primary" name="Submit" value="add" style="margin-top: 20px">Submit</button>
    </form>
    </div>
  </div>
  <!-- content-wrapper -->
  </div>
  <!-- wrapper -->

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

  <script src="../asset/js/jquery-chained.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
      $(document).ready(function() {
      $("#jenis_surat").chained("#jenis_naskah");
      $("#nama_eselon").chained("eselon");
      });
    </script>
  </body>
<!-- ================================================ -->