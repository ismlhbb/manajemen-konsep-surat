<?php 

// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include './system/koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);

// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' AND password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){
	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:beranda/index.php");

	// cek jika user login sebagai eselon 4
	}else if($data['level']=="eselon4"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "eselon4";
		// alihkan ke halaman dashboard eselon 4
		header("location:beranda/index.php");

	// cek jika user login sebagai Eselon 3
	}else if($data['level']=="eselon3"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "eselon3";
		// alihkan ke halaman dashboard Eselon 3
		header("location:beranda/index.php");

	// cek jika user login sebagai Eselon 2
	}else if($data['level']=="eselon2"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "eselon2";
		// alihkan ke halaman dashboard Eselon 2
		header("location:beranda/index.php");

	// cek jika user login sebagai Staff
	}else if($data['level']=="staff"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "staff";
		// alihkan ke halaman dashboard Staff
		header("location:beranda/index.php");	

	}else{
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
		exit;
	}	
}else{
	header("location:index.php?pesan=gagal");
}
?>