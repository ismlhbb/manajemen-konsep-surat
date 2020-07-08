<?php  include "../system/koneksi.php"; ?>
<html lang="en">
  <head>
    <?php ob_start(); ?>
  </head>
  
    <?php 
      if (isset($_POST["submit"])) {
        $nama = htmlspecialchars($_POST["nama"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $level = htmlspecialchars($_POST["level"]);
        $jabatan = htmlspecialchars($_POST["jabatan"]);
        $nama_eselon = htmlspecialchars($_POST["nama_eselon"]);
        $password = md5($password);

        $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
        if(mysqli_fetch_assoc ($result)){
          echo "
            <script>
              alert('username sudah terdaftar!')
            </script>
          ";
        return false;
        }

      $queryy = "INSERT INTO user VALUES 
        ('', '$nama', '$username', '$password', '$level', '$jabatan', '$nama_eselon')";
        mysqli_query($koneksi, $queryy);

        if (mysqli_affected_rows($koneksi) > 0 ) {
          echo "
            <script> 
              alert('data berhasil ditambahkan!')
              document.location.href = '?page=list_user';
            </script>
          ";
        } else {
          echo "
              <script> 
                alert('data gagal ditambahkan!')
                document.location.href = '?page=list_user&sub=buat_user';
              </script>
            ";
          echo mysqli_error($koneksi);
        }
      } 
    ?>

  <body id="page-top">
  <div id="content-wrapper">
    <div class="container-fluid">
        
    <!-- Awal Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Tambah User</li>
    </ol>
    <!-- Akhir Breadcrumbs-->

    <!-- Awal Form Buat User -->
    <div class="container">
      <form action="" class="form-horizontal" method="post" onsubmit="return empty()">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nama" >Nama : </label>
            <input type="text" class="form-control"  name="nama" id="nama" placeholder="Nama Lengkap" required>
          </div>
          <div class="form-group col-md-6">
            <label for="jabatan" >Jabatan : </label>
            <input type="jabatan" class="form-control" name="jabatan" id="jabatan" placeholder="jabatan" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="username" >Username : </label>
            <input type="username" class="form-control" name="username" id="username" title="Username minimal 8 karakter dan terdiri dari" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{7,20}$" placeholder="Username" required>
          </div>
          <div class="form-group col-md-6">
            <label for="password" >Password : </label>
            <input type="password" class="form-control" name="password" id="password" title="Password minimal 8 karakter dan terdiri dari [A-Z] [0-9]" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{7,20}$" placeholder="Password" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputState">Level</label>
            <select id="level" class="form-control" name="level" required>
              <option value="">Please Select</option>
              <option value="staff">Staff</option>
              <option value="eselon4">Eselon 4</option>
              <option value="eselon3">Eselon 3</option>
              <option value="eselon2">Eselon 2</option>  
              </option>
             </select>
          </div>
          <div class="form-group col-md-6">
            <label for="level" >Nama dan Jabatan Eselon</label>
            <input type="text" class="form-control" name="nama_eselon" id="nama_eselon" placeholder=' misal "Dewi Indriyati, ST, M.T.I "' required>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit" style="margin-top: 10px">Submit</button> 
      </form>
    <!-- Akhir Form Buat User -->

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