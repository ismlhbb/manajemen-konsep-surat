<?php 
	include 'koneksi.php';
	require '../system/functions.php';    

	if( tambah($_POST) > 0 ){
	    echo "<script>
	    alert('data berhasil ditambahkan!');
	    document.location.href = '../beranda/'
	    </script>";

	}else{
	    echo "<script>
	    alert('data gagal ditambahkan!');
	    document.location.href = '../beranda/?page=upload_surat'
	    </script>";
	}
?> 