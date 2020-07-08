<?php 
  require "../system/koneksi.php";
  $id_user= $_GET['id_user'];
  $query = 
  mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id_user'");

  if (mysqli_affected_rows($koneksi) > 0 ) {
  	echo "
      <script> 
        alert('data berhasil dihapus!')
        document.location.href = '../beranda/?page=list_user';
      </script>
    ";
  	
  } 
  else {
  	echo "
      <script> 
        alert('data gagal dihapus!')
        document.location.href = '../beranda/?page=list_user';
      </script>
      ";
  }
?>