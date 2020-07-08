<?php 
  include "../system/koneksi.php";
  $hasil_upload=$_GET["hasil_upload"];
?>
<html lang="eng">
  <head>
    <?php
      ob_start();
    ?>
  </head>
    <?php
      $surat = 'SELECT * FROM tbl_surat_upload WHERE hasil_upload="'.$hasil_upload.'"';
      $query1 = mysqli_query($koneksi, $surat);
      $surat = mysqli_fetch_assoc($query1);
    ?>
    <?php 
      if ($surat["es2"]=='1' || $surat["es2"]=='2') { ?>
        <div id="content-wrapper">
          <div class="container-fluid">

          <!-- Page Content -->
          <h1 class="display-1">Surat Sudah Anda Setujui</h1>
            <p class="lead">Surat Akan diteruskan <br>
              <a href="javascript:history.back()">go back</a>
              to the previous page, or
              <a href="index.php">return home</a>.</p>
          </div>
        </div>

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

        <?php } 
        elseif($surat["es2"]=='0') { ?>
          <body id="page-top">
            <div id="content-wrapper">
            <div class="container-fluid">
              <table border="1" cellpadding="10" cellspacing="0">
                <div class="row margin-atas">
                  <div class="col-12">
                    <div class="card mb-3">
                      <div class="card-header">
                        <h5><i class="fa fa-file-o"></i> Detail Surat</h5>
                      </div>
                      <div class="card-body">
                        <a>
                          <h5>Nomor Surat = <?php echo $surat["nomor_surat"];?></h5> <br>
                          <h5>Asal Surat  = <?php echo $surat["asal_surat"];?></h5><br>
                          <h5>Perihal  = <?php echo $surat["perihal"];?></h5><br>
                          <h5>Ditujukan Kepada  = <?php echo $surat["id_penerima_3"];?></h5><br>
                        </a>
                          <?php 
                            if ($surat['revisi']=='0') { ?>
                              <h5><a href=files/<?=$surat["hasil_upload"]?>>Download File</a></h5>
                          <?php } 
                            elseif ($surat['revisi']!='0') { ?>
                              <h5><a href=files/hasil_revisi_dari_staff/<?=$surat["hasil_upload"]?>>Download File</a></h5>
                          <?php } ?> <br>
                      <div class="btn-group d-flex">
                      <form method="post" action="">
                        <button type="approve" class="btn btn-outline-success" type="approve-akhir" name="approve-akhir">Terima Untuk Tanda Tangan</button>
                      </form>

                      <?php
                        if($_SESSION['level']=="eselon2"){
                          if (isset($_POST["approve-akhir"])) {
                            $query_es2 = "UPDATE tbl_surat_upload SET es2='2' WHERE hasil_upload='$hasil_upload'";
                              mysqli_query($koneksi, $query_es2);
                            $query_disposisi = "UPDATE tbl_surat_upload SET status_disposisi='2' WHERE hasil_upload='$hasil_upload'";
                              mysqli_query($koneksi, $query_disposisi);  
                            $query_approve = "UPDATE tbl_surat_upload SET status_approve='sudah' WHERE hasil_upload='$hasil_upload'";
                              mysqli_query($koneksi, $query_approve);
                            echo "<meta http-equiv='refresh' content='0'>";
                          }   
                        }
                      ?>
                      <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal">Revisi</button>
                    </div>
                  </div>
                </div>

                <ol class="breadcrumb">
                   <li class="breadcrumb-item active">List Revisi</li>
                </ol>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO</th> 
                      <th>Isi Revisi</th>
                      <th>Tanggal</th> 
                      <th>File Revisi</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <?php     
                    $no = 1;
                    $id_user= $_GET["id_user"];
                    $revisi = "SELECT * FROM tbl_revisi WHERE hasil_upload ='".$hasil_upload."' AND id_penerima ='".$id_user."'";
                    $query1 = mysqli_query($koneksi, $revisi);
                  ?>
                  <tbody>
                  <?php while ($revisi = mysqli_fetch_assoc($query1)) { ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><strong><?= $revisi["catatan"]; ?></strong></td>
                        <td><?= $revisi["tanggal_revisi"]; ?></td>
                        <td><?= $revisi["hasil_upload_revisi"]; ?> <hr>
                          <a href=files/hasil_revisi_dari_staff/<?=$surat["hasil_upload"]?>>Download File Revisi</a></td>
                        <td><?= $revisi["keterangan"]; ?> </td>
                    </tr>
                  <?php $no++ ?>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


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

<?php
    $cek = "SELECT status_baca_3 FROM tbl_surat_upload WHERE hasil_upload='$hasil_upload'";
    $res = mysqli_query($koneksi,$cek);
    $row = mysqli_fetch_array($res);
      if ($row['status_baca_3']=="belum") {
        $upd = "UPDATE tbl_surat_upload SET status_baca_3='sudah' WHERE hasil_upload='$hasil_upload'";
        $hasil = mysqli_query($koneksi,$upd);
      }
    $cek = "SELECT * FROM tbl_surat_upload, user WHERE hasil_upload='$hasil_upload' AND tbl_surat_upload.id_penerima=user.id_user";
    $res = mysqli_query($koneksi,$cek);
    $row = mysqli_fetch_array($res);
 ?>

 <!-- Awal Revisi Modal -->
 <div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Revisi</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3>Silahkan masukkan revisian dari anda</h3>
          <form action="" class="form-horizontal" method="post" onsubmit="return empty()"  enctype="multipart/form-data">
            <div class="form-row">
              <input type="hidden" class="form-control" id="id_surat" name="id_surat" value="<?php echo $surat['id_surat']; ?>">
              <input type="hidden" class="form-control" id="id_pengirim" name="id_pengirim" value="<?php echo $surat['id_penerima_3']; ?>">
              <input type="hidden" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $surat['nomor_surat']; ?>">
              <input type="hidden" class="form-control" id="id_penerima_3" name="id_penerima_3" value="<?php echo $surat['id_pengirim']; ?>">
              <input type="hidden" class="form-control" id="hasil_upload" name="hasil_upload" value="<?php echo $surat['hasil_upload']; ?>">
              <input type="hidden" class="form-control" id="keterangan" name="keterangan" value="Revisi untuk Surat <?php echo $surat['nomor_surat']; ?>">
              <textarea class="form-control" id="catatan" name="catatan" rows="5"  required></textarea>
              <strong><label style="margin-top: 8px; ">Upload File<hr></label></strong><br>
              <input style="margin-top:35px; margin-left:-85px;" type="file" id="_hasil_upload_revisi" name="hasil_upload_revisi" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
            </div>
             <button type="submit-revisi" style="margin-top: 10px;" name="submit-revisi" class="btn btn-success sm" value="refresh" onclick="return RefreshWindow();">Accept</button>
          </form>
      </div>
        <strong style="color: red; margin-top: -20px; margin-left: 10px;">Pesan : Nama file mohon untuk tidak diganti </strong>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="close" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
          
       <?php } ?>
       <?php
          if (isset($_POST["submit-revisi"])) {
            $id_surat = htmlspecialchars($_POST["id_surat"]);
            $id_pengirim = htmlspecialchars($_POST["id_penerima_3"]);
            $id_penerima = htmlspecialchars($_POST["id_pengirim"]);
            $nomor_surat = htmlspecialchars($_POST["nomor_surat"]);
            $catatan = htmlspecialchars($_POST["catatan"]);
            $tanggal_revisi = date("Y-m-d H:i:s");
            $hasil_upload = htmlspecialchars($_POST["hasil_upload"]);
            $keterangan = htmlspecialchars($_POST["keterangan"]);
            $hasil_upload_revisi = upload_revisi_eselon();
              if( !$hasil_upload_revisi ) {
                return false;
            } 
            
            $query_revisi = "INSERT INTO tbl_revisi VALUES 
                ('', '$id_surat', '$id_penerima' , '$id_pengirim', '$nomor_surat', '$catatan', '$tanggal_revisi','$hasil_upload', '$hasil_upload_revisi','$keterangan')";
                mysqli_query($koneksi, $query_revisi);  
            $update_revisi = "UPDATE tbl_surat_upload SET revisi = revisi + 1 WHERE hasil_upload='$hasil_upload'";
            $hasil_update_revisi = mysqli_query($koneksi,$update_revisi);
                echo "<meta http-equiv='refresh' content='0'>";
            }
  
            function upload_revisi_eselon() {
              $namaFile = $_FILES['hasil_upload_revisi']['name'];
              $error    = $_FILES['hasil_upload_revisi']['error'];
              $tmpName  = $_FILES['hasil_upload_revisi']['tmp_name'];

              //cek apakah tidak ada file yng diupload
              if( $error === 4 ) {
                echo "<script> 
                  alert('upload file terlebih dahulu');
                </script>";

                return false;
              }

              // cek apakah yang diupload hanya document
              $ekstensiFileValid = ['docx' , 'pdf', 'doc'];
              $ekstensiFile = explode('.', $namaFile);
              $ekstensiFile = strtolower(end($ekstensiFile));
              if( !in_array($ekstensiFile, $ekstensiFileValid)) {
                echo "<script> 
                  alert('yang anda upload bukan Document');
                </script>";
              }

              // lolos pengecekan file siap diupload
              //generate nama file baru
              $spasi    = str_replace(' ', '', $namaFile); // kode untuk menghilangkan spasi
              $namaFileBaru = $spasi; 
              move_uploaded_file($tmpName, '../beranda/files/hasil_revisi_dari_eselon/' .$namaFileBaru );
              return $namaFileBaru;
            } ?>
      </div>
    </div>
  </div>
<!-- Akhir Revisi Modal -->
