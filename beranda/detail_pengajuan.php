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
  <body id="page-top">
    <div id="content-wrapper">
      <div class="container-fluid">
        <table border="1" cellpadding="10" cellspacing="0">
          <div class="row margin-atas">
            <div class="col-12">
              <div class="card mb-3">
                <div class="card-header">
                  <h5><i class="fa fa-upload"></i> Upload Ulang Hasil Revisi Anda Disini</h5></div>
                  <div class="card-body">
                    
                    <div class="form-row">
                      <div class="form-grup col-md-6">
                      <label for="custom-file">Upload File</label><br>
                      <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" id="hasil_upload_revisi" name="hasil_upload_revisi" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="keterangan">Keterangan</label>
                        <input type="keterangan" class="form-control" id="catatan" name="catatan" placeholder="Keterangan Singkat" name="keterangan" >
                      </div>
                        <input type="hidden" class="form-control" id="id_surat" name="id_surat" value="<?php echo $surat['id_surat']; ?>">
                        <input type="hidden" class="form-control" id="id_pengirim" name="id_pengirim" value="<?php echo $surat['id_pengirim']; ?>">
                        <input type="hidden" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $surat['nomor_surat']; ?>">
                        <?php 
                          if ($surat['status_disposisi']=='0') { ?>
                            <input type="hidden" class="form-control" id="id_penerima" name="id_penerima" value="<?php echo $surat['id_penerima']; ?>">
                        <?php } ?>
                        <?php 
                          if ($surat['status_disposisi']=='4') { ?>
                            <input type="hidden" class="form-control" id="id_penerima" name="id_penerima" value="<?php echo $surat['id_penerima_2']; ?>">
                        <?php } ?>
                        <?php 
                          if ($surat['status_disposisi']=='3') { ?>
                            <input type="hidden" class="form-control" id="id_penerima" name="id_penerima" value="<?php echo $surat['id_penerima_3']; ?>">
                        <?php } ?>
                        <input type="hidden" class="form-control" id="hasil_upload" name="hasil_upload" value="<?php echo $surat['hasil_upload']; ?>">
                        <input type="hidden" class="form-control" id="keterangan" name="keterangan" value="<?php echo $surat['hasil_upload']; ?>">
                    </div>
                <button type="submit_revisi_user" class="btn btn-primary" name="submit_revisi_user" value="add" style="margin-top: 20px">Submit</button><br><br>  
                <strong style="color: red; margin-bottom: 10px;">Pesan : Nama file mohon untuk tidak diganti </strong>
              </form>
            </div>
          </div>
  <?php
    if (isset($_POST["submit_revisi_user"])) {
      $id_surat = htmlspecialchars($_POST["id_surat"]);
      $id_pengirim = htmlspecialchars($_POST["id_pengirim"]);
      $id_penerima = htmlspecialchars($_POST["id_penerima"]);
      $nomor_surat = htmlspecialchars($_POST["nomor_surat"]);
      $catatan = htmlspecialchars($_POST["catatan"]);
      $tanggal_revisi = date("Y-m-d H:i:s");
      $hasil_upload = htmlspecialchars($_POST["hasil_upload"]);
      $keterangan = htmlspecialchars($_POST["keterangan"]);
      $hasil_upload_revisi = upload_revisi();
        if( !$hasil_upload_revisi ) {
          return false;
        } 
      $query_revisi_user = "INSERT INTO tbl_revisi VALUES 
          ('', '$id_surat', '$id_pengirim', '$id_penerima', '$nomor_surat', '$catatan', '$tanggal_revisi','$hasil_upload', '$keterangan', '$hasil_upload_revisi' )";
          mysqli_query($koneksi, $query_revisi_user);
        }
     

      function upload_revisi() {
        $namaFile = $_FILES['hasil_upload_revisi']['name'];
        $error    = $_FILES['hasil_upload_revisi']['error'];
        $tmpName = $_FILES['hasil_upload_revisi']['tmp_name'];

        //cek apakah tidak ada file yang diupload
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
        move_uploaded_file($tmpName, '../beranda/files/hasil_revisi_dari_staff/' .$namaFileBaru );
        return $namaFileBaru;
      }
  ?>
  
        <!-- Awal Breadcrumb -->    
        <ol class="breadcrumb">
          <h5>List Revisi</h5>
        </ol>
        <!-- Akhir Breadcrumb -->
        
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>NO</th>
                <th>Nomor Surat</th>
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
                <td><?= $revisi["nomor_surat"]; ?></td>
                <td><?= $revisi["catatan"]; ?></td>
                <td><?= $revisi["tanggal_revisi"]; ?></td>
                <td><?= $revisi["hasil_upload_revisi"]; ?><hr> 
                  <a href=files/hasil_revisi_dari_eselon/<?=$revisi["hasil_upload_revisi"]?>>Download File Revisi</a></td>
                  <?php 
                    if($surat['status_disposisi']=='0' AND $surat['status_disposisi']=='0'){ ?> 
                      <td class="pesan pesan_revisi">Terdapat Revisi dari Eselon 4</td>
                  <?php }
                    elseif($surat['status_disposisi']=='4' AND $surat['es3']=='0' ){ ?>
                      <td class="pesan pesan_revisi">Eselon 4 setuju, Menunggu persetujuan Eselon 3</td>
                  <?php }
                    elseif($surat['status_disposisi']=='3' AND $surat['es3']=='2' ){ ?>
                      <td>Surat permohonan diterima silahkan Minta tanda tangan ke Eselon 3</td>
                  <?php }
                    elseif($surat['status_disposisi']=='3' AND $surat['es2']=='0' ){ ?>
                      <td class="pesan pesan_revisi">Eselon 3 setuju, Menunggu persetujuan Eselon 2</td>
                  <?php }
                    elseif($surat['status_disposisi']=='2' AND $surat['es2']=='2'){ ?>
                      <td class="pesan approve_sudah">Surat Permohonan diterima silahkan minta tanda tangan ke Eselon 2</td>
                  <?php } ?>
              </tr>
            <?php $no++ ?>
            <?php } ?>
            </tbody>
          </table>
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

 



