<?php
$koneksi = mysqli_connect("localhost", "root", "", "surat4");

function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $koneksi;
	$nomor_surat = htmlspecialchars($data["nomor_surat"]);
    $asal_surat = htmlspecialchars($data["asal_surat"]);
    $perihal = htmlspecialchars($data["perihal"]);
    $id_penerima = htmlspecialchars($data["id_penerima"]);
    $id_penerima_2 = htmlspecialchars($data["id_penerima_2"]);
	$id_penerima_3 = htmlspecialchars($data["id_penerima_3"]);
	$id_pengirim	= htmlspecialchars($data["id_pengirim"]);
    $jenis_naskah= htmlspecialchars($data["jenis_naskah"]);
    $jenis_surat = htmlspecialchars($data["jenis_surat"]);
    //upload gambar
    $hasil_upload = upload();
    if( !$hasil_upload ) {
    	return false;
    }
    //tanggal
    $tgl = date("Y-m-d H:i:s"); 
    $status_baca = htmlspecialchars($data["status_baca"]);
    $status_baca_2 = htmlspecialchars($data["status_baca_2"]);
    $status_baca_3 = htmlspecialchars($data["status_baca_3"]);
    $status_disposisi = htmlspecialchars($data["status_disposisi"]);
    $status_approve = htmlspecialchars($data["status_approve"]);
    $revisi = htmlspecialchars($data["revisi"]);
    $es4 = htmlspecialchars($data["es4"]);
    $es3 = htmlspecialchars($data["es3"]);
    $es2 = htmlspecialchars($data["es2"]);
    
    $query = "INSERT INTO tbl_surat_upload
    			VALUES
    			('', '$nomor_surat', '$asal_surat', '$perihal', '$id_penerima', '$id_penerima_2', '$id_penerima_3', '$id_pengirim', '$jenis_naskah', '$jenis_surat', '$hasil_upload', '$tgl',  '$status_baca', '$status_baca_2', '$status_baca_3', '$status_disposisi', '$status_approve', '$revisi','$es4','$es3','$es2')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function upload() {
	$namaFile = $_FILES['hasil_upload']['name'];
	$error		= $_FILES['hasil_upload']['error'];
	$tmpName = $_FILES['hasil_upload']['tmp_name'];

	//cek apakah tidak ada file yang diupload
	if( $error === 4 ) {
		echo "<script> 
			alert('upload file terlebih dahulu');
		</script>";

		return false;
	}

  	// cek apakah yang diupload hanya document
	$ekstensiFileValid = ['docx' , 'pdf', 'doc'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if( !in_array($ekstensiFile, $ekstensiFileValid)) {
		echo "<script> 
			alert('yang anda upload bukan Document');
		</script>";
	}

	// lolos pengecekan gmabar siap diupload
	//generate nama file baru
	$spasi    = str_replace(' ', '', $namaFile); // kode untuk menghilangkan spasi
	$namaFileBaru = $spasi; 
	move_uploaded_file($tmpName, '../beranda/files/' .$namaFileBaru );
	return $namaFileBaru;
}

function user($user){
	global $koneksi;
	$result = mysqli_query($koneksi,$user);
	$rowss = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rowss[] = $row;
	}
	return $rowss;
}

function surat($surat){
	global $koneksi;
	$result = mysqli_query($koneksi,$surat);
	$rowss = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rowss[] = $row;
	}
	return $rowss;
}

function edituser($data1) {
	global $koneksi;
	$id_user= $data1["id_user"];
	$nama = htmlspecialchars($data1["nama"]);
  	$username = strtolower(stripslashes($data1["username"]));
  	$level = htmlspecialchars($data1["level"]);
  	$jabatan = htmlspecialchars($data1["jabatan"]);
 	$result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
  	
    $query = "UPDATE user SET
   			nama='$nama', 
   			username='$username',  
   			level='$level', 
   			jabatan='$jabatan' 
   			WHERE id_user=$id_user
    		";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
?>