<?php 
// mengaktifkan session php
session_start();
// menghapus semua session
$_SESSION = [];
session_unset();
session_destroy();
 
// mengalihkan halaman ke halaman login
header("location:index.php");
exit;
?>