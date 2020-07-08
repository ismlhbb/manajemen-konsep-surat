<?php 
  include "../system/koneksi.php";
  require "../system/functions.php";
  $user = user("SELECT * FROM user");
?>
<html lang="eng">
  <head>
    <?php
      ob_start();
    ?>
  </head>
  <?php
    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level'] == "eselon4" || $_SESSION['level'] == "staff" || $_SESSION['level'] == "sekretaris"){
      header("location:../index.php?pesan=gagal");
    }
  ?>
  
  <body id="page-top">
    <?php if(isset($_REQUEST['sub'])){
      $sub = $_REQUEST['sub'];
        switch ($sub) {
          case 'buat_user':
          include "../system/buat_user.php";
        break;
          case 'edit_user':
          include "../system/edit_user.php";
        break;
          case 'hapus_user':
          include "../system/hapus_user.php";
        }
    } else {
    ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Awal Breadcrumbs-->
        <ol class="breadcrumb">
           <li class="breadcrumb-item active">Daftar User</li>
        </ol>
        <!-- Akhir Breadcrumbs-->
      <table border="1" cellpadding="10" cellspacing="0">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>NOMOR</th>
                <th>NAMA</th>
                <th>USERNAME</th>
                <th>LEVEL</th>
                <th>JABATAN</th> 
                <th>Nama Eselon</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php 
            foreach( $user as $row ) :  ?>
            <tr>
              <td><?= $i;   ?></td>
              <td><?= $row["nama"]; ?></td>
              <td><?= $row["username"]; ?></td>
              <td><?= $row["level"]; ?></td>
              <td><?= $row["jabatan"]; ?></td>
              <td><?= $row["nama_eselon"]; ?></td>
              <td>
                <a href="../beranda/?page=list_user&sub=edit_user&id_user=<?= $row["id_user"]; ?>">Edit</a> |
                <a href="../beranda/?page=list_user&sub=hapus_user&id_user=<?= $row["id_user"]; ?>" onclick="return confirm('Yakin ingin menghapus data?');">Delete</a></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
                <a class='btn btn-primary' href='../beranda/?page=list_user&sub=buat_user' role='button' style='margin-bottom:10px; position: static;'> Tambah User</a>
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
<?php } ?>