<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
  <?php include '../system/koneksi.php';
    $kode = $_SESSION['username'];
    $yanglagilogin = "SELECT * FROM user WHERE username = '$kode' ";
    $result = mysqli_query($koneksi, $yanglagilogin);
    $row = mysqli_fetch_array($result);
    $username = $row['username'];
    $user = mysqli_query($koneksi, "SELECT id_user FROM user WHERE username ='$username'"); ?>
  <a class="navbar-brand mr-1" href="index.php">Pengajuan Surat Berbasis Website | Selamat Datang 
    <?php echo $row['nama_eselon']; ?>  
  </a>
  
  <!-- Navbar Search -->
  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
  </form>
  
  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle fa-fw">
        </i>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
