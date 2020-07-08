<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login Pengajuan Surat Elektronik</title>
  <link rel="icon" href="./asset/img/logo.png" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="asset/css/bootstrap.css" rel="stylesheet">

</head>

<?php include"./system/koneksi.php" ?>

<body class="bg-dark">

  <?php 
  // mengaktifkan session php
  session_start();
    if(isset($_GET['pesan'])){
      if($_GET['pesan']=="gagal"){
        echo "<script>
        alert('Salah!');
        document.location.href = './'
        </script>";
      }
    }
  ?> 

  <!-- Awal Form Login -->
  <div class="kotak_login">
    <img src="source/logo.png" alt="logo" class="center" width="200">
    <legend>Login</legend>
      <form action="cek_login.php" method="post">
        <label>Username</label>
          <input type="text" name="username" class="form_login" placeholder="Username .." required="required">
        <label>Password</label>
          <input type="password" name="password" class="form_login" placeholder="Password .." required="required">
        <input type="submit" class="tombol_login" value="LOGIN">
      </form>
  </div>
  <!-- Akhir Form Login -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

<style>
  .center{
    display:block;
    margin-left:auto;
    margin-right:auto;
    width:50%;
    padding-bottom: 10px;
  }

  .font-family: sans-serif{
    background: red;
  }
 
  h1{
    text-align: center;
    /*ketebalan font*/
    font-weight: 300;
  }
 
  .tulisan_login{
    text-align: center;
    /*membuat semua huruf menjadi kapital*/
    text-transform: uppercase;
  }
 
  .kotak_login{
    width: 350px;
    background: white;
    /*meletakkan form ke tengah*/
    margin: 80px auto;
    padding: 30px 20px;
    box-shadow: 0px 0px 100px 4px #d6d6d6;
  }
 
  label{
    font-size: 11pt;
  }
 
  .form_login{
    /*membuat lebar form penuh*/
    box-sizing : border-box;
    width: 100%;
    padding: 10px;
    font-size: 11pt;
    margin-bottom: 20px;
  }
   
  .tombol_login{
    background: #2aa7e2;
    color: white;
    font-size: 11pt;
    width: 100%;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
  }
   
  .link{
    color: #232323;
    text-decoration: none;
    font-size: 10pt;
  }
   
  .alert{
    background: #e44e4e;
    color: white;
    padding: 10px;
    text-align: center;
    border:1px solid #b32929;
  }
</style>

<?php include'include/footer.php' ?>

<script src="asset/jquery/jquery-3.4.1.js"></script>

