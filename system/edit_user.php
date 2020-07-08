<?php include "../system/koneksi.php"; ?>
<html lang="en">
  <head>
    <?php ob_start(); ?>
  </head>
  <?php 
    //ambil data di url
    $id_user= $_GET["id_user"];

    //query data user berdasarkan id
    $usr = user("SELECT * FROM user WHERE id_user = $id_user")[0];

    if (isset($_POST["submit"])) { 
      if (edituser($_POST) > 0 ) {
        echo "
          <script> 
            alert('Data berhasil diubah!')
            document.location.href = '?page=list_user';
          </script>
        ";
      } 
      else {
        echo "
          <script> 
            alert('Tidak ada data yang diubah!')
            document.location.href = '?page=list_user';
          </script>
        ";
      }
    } 
  ?>

  <body id="page-top">
  <div id="content-wrapper">
    <div class="container-fluid">
    <!-- Awal Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Edit User</li>
    </ol>
    <!-- Akhir Breadcrumbs-->

    <!-- Awal Form Edit User -->
    <form action="" class="form-horizontal" method="post" onsubmit="return empty()">
    <div class="form-row">
      <input type="hidden" name="id_user" value="<?=$usr['id_user'];?>">
      <div class="form-group col-md-6">
        <label for="nama" >Nama : </label>
        <input type="text" class="form-control"  name="nama" id="nama" value="<?= $usr['nama'] ?>" required>
      </div>
      <div class="form-group col-md-6">
        <label for="jabatan" >Jabatan : </label>
        <input type="jabatan" class="form-control" name="jabatan" id="jabatan" value="<?= $usr['jabatan'] ?>" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="username" >Username : </label>
        <input type="username" class="form-control" name="username" id="username" value="<?= $usr['username'] ?>"  required readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="inputState">Level</label>
        <select id="level" class="form-control" name="level" required>
          <option value="<?= $usr['level'] ?>"><?= $usr['level'] ?></option>
          <option value="staff">Staff</option>
          <option value="eselon4">Eselon 4</option>
          <option value="eselon3">Eselon 3</option>
          <option value="eselon2">Eselon 2</option>  
          </option>
        </select>
      </div>
    </div> 
      <button type="submit" class="btn btn-primary" name="submit" style="margin-top: 10px">Submit</button>
    </form>
    <!-- Akhir Form Edit User -->

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