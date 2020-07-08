<html lang="en">
  <link href="../asset/css/pesan.css" rel="stylesheet">
  <head>
    <?php
      ob_start();
    ?>
  </head>
  <?php  
    include "../system/koneksi.php";
    require '../system/functions.php';
  ?>
  <?php 
    $id_user= $_GET["id_user"];
    $surat = 'SELECT * FROM tbl_surat_upload WHERE id_pengirim="'.$id_user.'"';
    $query1 = mysqli_query($koneksi, $surat);
      if (!$query1) {
        die ('SQL Error: ' . mysqli_error($koneksi));
      } ?>
  <body id="page-top">
    <div id="content-wrapper">
      <div class="container-fluid">
      <!-- Awal Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">Status Pengajuan</li>
      </ol>
      <!-- Akhir Breadcrumbs-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Tabel Pengajuan</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NOMOR SURAT</th>
                    <th>ASAL SURAT</th>
                    <th>PERIHAL</th> 
                    <th>JENIS NASKAH</th>
                    <th>FILE PENGAJUAN</th>
                    <th>TANGGAL UPLOAD</th>
                    <th>Approved</th>
                    <th>Status Disposisi</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  while ($surat = mysqli_fetch_assoc($query1)) { ?>
                <?php 
                  if($surat['status_approve']=="belum") { ?>
                    <tr >
                      <td><?= $surat["nomor_surat"]; ?></td>
                      <td><?= $surat["asal_surat"]; ?></td>
                      <td><?= $surat["perihal"]; ?></td>
                      <td><?= $surat["jenis_surat"]; ?></td>
                      <td><?= $surat["hasil_upload"]; ?></td>
                      <td><?= $surat["tanggal_upload"]; ?></td>
                      <td>Surat Belum Disetujui</td>
                      <td><?= $surat["status_disposisi"]; ?></td>
                    </tr>
                <?php } 
                  else if($surat['status_approve']=="sudah") { ?>
                    <tr class="pesan approve_sudah">
                      <td><?= $surat["nomor_surat"]; ?></td>
                      <td><?= $surat["asal_surat"]; ?></td>
                      <td><?= $surat["perihal"]; ?></td>
                      <?php 
                        if(!empty($surat['id_penerima_3'])){ ?> 
                          <td><?= $surat["id_penerima_3"]; ?> </td>
                         <?php }
                        elseif (empty($surat['id_penerima_3'])) { ?>
                          <td><?= $surat["id_penerima_2"]; ?> </td>
                      <?php } ?>
                      <td><?= $surat["jenis_surat"]; ?></td>
                      <td><?= $surat["hasil_upload"]; ?></td>
                      <td><?= $surat["tanggal_upload"]; ?></td>
                      <td>Sudah Disetujui</td>
                      <?php 
                        if(!empty($surat['id_penerima_3'])){ ?> 
                          <td>Silakan Minta Tanda Tangan Ke  User <?= $surat["id_penerima_3"]; ?></td>
                      <?php }
                        elseif (empty($surat['id_penerima_3'])) { ?>
                          <td>Silkan Minta Tanda Tangan Ke  User <?= $surat["id_penerima_2"]; ?> </td>
                      <?php } ?>
                    </tr>
                <?php 
                  } 
                } ?>
            </div>
          </tbody>
        </table>
        <a style="font-weight: bold">Keterangan <br>
        Status Disposisi <br>
        4 = Eselon 4 Sudah Menyetujui <br>
        3 = Eselon 3 Sudah Menyetujui <br>
        2 = Eselon 2 Sudah Menyetujui <br>
        </a>
          </div>
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
    <!-- Akhir Logout Modal -->
  </body>
</html>