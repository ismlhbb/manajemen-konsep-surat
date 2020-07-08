<?php 
// cek apakah yang mengakses halaman ini sudah login 
if($_SESSION[ 'level']=="" ){ header( "location:../index.php?pesan=gagal"); }
?>

<?php include '../system/koneksi.php';
    $kode = $_SESSION['username'];
    $yanglagilogin = "SELECT * FROM user WHERE username = '$kode' ";
    $result = mysqli_query($koneksi, $yanglagilogin);
    $row = mysqli_fetch_array($result);
    $username = $row['username'];
    $user = mysqli_query($koneksi, "SELECT id_user FROM user WHERE username ='$username'"); ?>

<?php $level = $_SESSION["level"];
    $nama_member = mysqli_query($koneksi, "SELECT id_user FROM user WHERE level='$level'");
    $data = mysqli_fetch_assoc($nama_member); ?>

<!-- Sidebar untuk eselon 4 -->
<?php if ($_SESSION['level'] == "eselon4") { ?>
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-igloo"></i>
            <span>Beranda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=upload_surat'>
            <i class="fas fa-pen-alt"></i>
            <span>Upload Konsep Surat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=permohonan_masuk&id_user=<?=$row["id_user"]; ?>'>
            <i class="fas fa-inbox"></i>
            <span>Surat Masuk</span>
        </a>
    </li>
</ul>
<?php
} ?>
<!-- Akhir Sidebar untuk eselon 4 -->

<!-- Sidebar untuk eselon 3 -->
<?php if ($_SESSION['level'] == "eselon3") { ?>
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-igloo"></i>
            <span>Beranda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=upload_surat'>
            <i class="fas fa-pen-alt"></i>
            <span>Upload Konsep Surat</span>
        </a
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=permohonan_masuk_2&id_user=<?=$row["id_user"]; ?>'>
            <i class="fas fa-inbox"></i>
            <span>Surat Masuk</span>
        </a>
    </li>
</ul>
<?php
} ?>
<!-- Akhir Sidebar untuk eselon 3 -->

<!-- Sidebar untuk eselon 2 -->
<?php if ($_SESSION['level'] == "eselon2") { ?>
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-igloo"></i>
            <span>Beranda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=upload_surat'>
            <i class="fas fa-pen-alt"></i>
            <span>Upload Konsep Surat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=permohonan_masuk_3&id_user=<?=$row["id_user"]; ?>'>
            <i class="fas fa-inbox"></i>
            <span>Surat Masuk</span>
        </a>
    </li>
</ul>
<?php
} ?>
<!-- Akhir Sidebar untuk eselon 2 -->

<!-- Sidebar untuk admin -->
<?php if ($_SESSION['level'] == "admin") { ?>
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-igloo"></i>
            <span>Beranda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=upload_surat'>
            <i class="fas fa-pen-alt"></i>
            <span>Upload Konsep Surat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../beranda/?page=log_surat">
            <i class="fas fa-mail-bulk"></i>
            <span>Daftar Permohonan Surat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../beranda/?page=list_user">
            <i class="fas fa-users"></i>
            <span>Daftar User</span>
        </a>
    </li>
</ul>
<?php
} ?>
<!-- Akhir Sidebar untuk admin -->

<!-- Sidebar untuk Staff -->
<?php if ($_SESSION['level'] == "staff") { ?>
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-igloo"></i>
            <span>Beranda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=upload_surat'>
            <i class="fas fa-pen-alt"></i>
            <span>Upload Konsep Surat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=approved&id_user=<?=$row["id_user"]; ?>'>
            <i class="fas fa-inbox"></i>
            <span>Approved</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href='../beranda/?page=status_pengajuan&id_user=<?=$row["id_user"]; ?>'>
            <i class="fas fa-inbox"></i>
            <span>Status Pengajuan</span>
        </a>
    </li>
</ul>
<?php
} ?>
<!-- Akhir Sidebar untuk Staff -->