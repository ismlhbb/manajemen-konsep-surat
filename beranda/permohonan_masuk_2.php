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
    if(isset($_GET['pageeee'])){
      $sub = $_GET['pageeee'];
        switch ($sub) {
          case 'download_2':
          include "../beranda/download_2.php";
        break;
        }
    } else { 
  ?>
  <?php 
    $id_user= $_GET["id_user"];
    $surat = 'SELECT * FROM tbl_surat_upload WHERE id_penerima_2="'.$id_user.'"';
    $query1 = mysqli_query($koneksi, $surat);
      if (!$query1) {
          die ('SQL Error: ' . mysqli_error($koneksi));
      } 
  ?>
  <body id="page-top">
    <div id="content-wrapper">
    <div class="container-fluid">
      <!-- Awal Breadcrumbs-->
      <ol class="breadcrumb">
           <li class="breadcrumb-item active">Transaksi Permohonan</li>
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
              <th>STATUS BACA</th>
              <th>STATUS DISPOSISI</th>
            </tr>
          </thead>
          
          <tbody>
          <?php 
            while ($surat = mysqli_fetch_assoc($query1)) { ?>
          <?php 
            if($surat['status_baca']=="belum" AND $surat['es4']=='0') {
          ?>
            <tr class="pesan pesan_belum">
              <td><?= $surat["nomor_surat"]; ?></td>
              <td><?= $surat["asal_surat"]; ?></td>
              <td><?= $surat["perihal"]; ?></td>
               <td><?= $surat["jenis_surat"]; ?></td>
               <td><?= $surat["hasil_upload"]; ?> </td>
               <td><?= $surat["tanggal_upload"]; ?></td>
               <td><?= $surat["status_baca_2"]; ?></td>
               <td style="color: red;">Belum Disetujui Oleh Eselon 4, Tidak Ada Detail</a></td>
            </tr>

            <?php } 
              else if($surat['status_baca']=="sudah" AND $surat['es4']=='0') { ?>
                <tr class="pesan pesan_belum">
                  <td><?= $surat["nomor_surat"]; ?></td>
                  <td><?= $surat["asal_surat"]; ?></td>
                  <td><?= $surat["perihal"]; ?></td>
                   <td><?= $surat["jenis_surat"]; ?></td>
                   <td><?= $surat["hasil_upload"]; ?></td>
                   <td><?= $surat["tanggal_upload"]; ?></td>
                   <td><?= $surat["status_baca_2"]; ?></td>
                   <td style="color: red;">Belum Disetujui Oleh Eselon 4, Tidak Ada Detail</a></td>
                  </tr>

            <?php } 
              else if($surat['status_baca_2']=="belum" AND $surat['es4']=='1') { ?>
                <tr class="pesan pesan_belum">
                  <td><?= $surat["nomor_surat"]; ?></td>
                  <td><?= $surat["asal_surat"]; ?></td>
                  <td><?= $surat["perihal"]; ?></td>
                   <td><?= $surat["jenis_surat"]; ?></td>
                   <td><?= $surat["hasil_upload"]; ?> <hr>
                      <a href=../beranda/?page=permohonan_masuk_2&id_user=<?= $row["id_user"]; ?>&pageeee=download_2&hasil_upload=<?= $surat["hasil_upload"];?>>Detail</a></td>
                   <td><?= $surat["tanggal_upload"]; ?></td>
                   <td><?= $surat["status_baca_2"]; ?></td>
                     <?php if($surat['status_disposisi']=='0' AND $surat['status_disposisi']=='0'){ ?> 
                      <td>Menunggu Persetujuan Eselon 4</td>
                    <?php }elseif($surat['status_disposisi']=='4' AND $surat['es3']=='0' ){ ?>
                      <td>Eselon 4 setuju, Eselon 3 Belum Setuju</td>
                    <?php }elseif($surat['status_disposisi']=='3' AND $surat['es3']=='2' ){ ?>
                      <td>Permohonan dapat ditandatangani Eselon 3</td>
                    <?php }elseif($surat['status_disposisi']=='3' AND $surat['es2']=='0' ){ ?>
                      <td>Eselon 3 setuju, Eselon 2 Belum Setuju</td>
                    <?php }elseif($surat['status_disposisi']=='2' AND $surat['es2']=='1'){ ?>
                      <td>Permohonan dapat ditanda tangani oleh Eselon 2</td>
                    <?php } ?>
                </tr>

            <?php } 
              else if($surat['status_baca_2']=="sudah" AND $surat['es4']=='1') { ?>
                <tr>
                  <td><?= $surat["nomor_surat"]; ?></td>
                  <td><?= $surat["asal_surat"]; ?></td>
                  <td><?= $surat["perihal"]; ?></td>
                   <td><?= $surat["jenis_surat"]; ?></td>
                   <td><?= $surat["hasil_upload"]; ?> <hr>
                    <a href=../beranda/?page=permohonan_masuk_2&id_user=<?= $row["id_user"]; ?>&pageeee=download_2&hasil_upload=<?= $surat["hasil_upload"];?>>Detail</a></td>
                   <td><?= $surat["tanggal_upload"]; ?></td>
                   <td><?= $surat["status_baca_2"]; ?></td>
                    <?php if($surat['status_disposisi']=='0' AND $surat['status_disposisi']=='0'){ ?> 
                      <td>Menunggu Persetujuan Eselon 4</td>
                    <?php }elseif($surat['status_disposisi']=='4' AND $surat['es3']=='0' ){ ?>
                      <td>Eselon 4 setuju, Eselon 3 Belum Setuju</td>
                    <?php }elseif($surat['status_disposisi']=='3' AND $surat['es3']=='2' ){ ?>
                      <td>Permohonan dapat ditandatangani Eselon 3</td>
                    <?php }elseif($surat['status_disposisi']=='3' AND $surat['es2']=='0' ){ ?>
                      <td>Eselon 3 setuju, Eselon 2 Belum Setuju</td>
                    <?php }elseif($surat['status_disposisi']=='2' AND $surat['es2']=='1'){ ?>
                      <td>Permohonan dapat ditanda tangani oleh Eselon 2</td>
                    <?php } ?>
                  </tr>

              
                  

                <?php 
                  } 
                } ?>
          </div>
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
    <!-- Awal Logout Modal-->
  </body>
</html>
<?php } ?>