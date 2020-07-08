<html lang="en">
  <head>
  <?php
    require '../system/functions.php';
    ob_start();
  ?>
  </head>
  
  <body id="page-top">
  <?php 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:../index.php?pesan=gagal");
  }
  ?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Daftar User</li>
      </ol>
  <?php include '../system/koneksi.php' ?>
    <?php  
    $sql = 'SELECT * FROM tbl_surat_upload ORDER BY id_surat DESC';
    $query = mysqli_query($koneksi,$sql);
      if (!$query) {
        die ('SQL Error: ' . mysqli_error($koneksi));
      }

    echo '
      <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>Data Table Example
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Input By</th>
                <th>Nomor Surat</th>
                <th>Asal Surat</th>
                <th>Perihal</th>
                <th>Tujuan</th>
                <th>Jenis Naskah</th>
                <th>Jenis Surat</th>
                <th>Nama Eselon Penyetuju</th>
                <th>Tanggal Upload</th>
                <th>File</th>
                <th>Status Disposisi</th>
                <th>Status Approve</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
    ';
  
      while ($row = mysqli_fetch_array($query)) {
        echo '
              <tr>
                <td>'.$row['id_pengirim'].'</td>  
                <td>'.$row['nomor_surat'].'</td>
                <td>'.$row['asal_surat'].'</td>
                <td>'.$row['perihal'].'</td>
                <td>'.$row['id_penerima'].'</td>
                <td>'.$row['jenis_naskah'].'</td>
                <td>'.$row['jenis_surat'].'</td>
                <td>'.$row['id_penerima'].'</td>
                <td>'.$row['tanggal_upload'].'</td>
                <td>'.$row['hasil_upload'].'<hr> <a href=files\\'.$row["hasil_upload"].'>Download File</a> </td>
                <td>'.$row['status_disposisi'].'</td>
                <td>'.$row['status_approve'].'</td>
                <td>'.$row['revisi'].'</td>
              </tr>';
        }
        echo '
            </tbody>
          </table>';
        mysqli_free_result($query);
        mysqli_close($koneksi);
  ?>
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