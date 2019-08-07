<?php
//error_reporting(0);
session_start();
include "../../../config/class_database.php";
include "../../../config/serverconfig.php";
include "../../../config/debug.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	header("Location: ../../../index.php?code=2");
}

else{
	if ($_GET['mod'] == 'dosen' && $_GET['act'] == 'input'){
		$created_date = date('Y-m-d H:i:s');
		$mulai_masuk_dosen = $_POST['tgl_masuk'];
		$password = md5(123456);
		$uploaddir = '../../foto/dosen/'; 
		$file = $uploaddir ."dosen_".basename($_FILES['uploadfile']['name']); 
		$file_name= "dosen_".$_FILES['uploadfile']['name']; 
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file);
		
		$db->database_prepare("INSERT INTO dosen (	nidn, 
													nama_dosen, 
													gelar, 
													tempat_lahir, 
													tanggal_lahir, 
													jk, 
													jabatan_id, 
													pendidikan_id, 
													ikatan_kerja_id, 
													status, 
													mulai_masuk_dosen, 
													akta_dan_ijin_mengajar, 
													alamat, 
													no_hp, 
													email,
													password,
													foto,
													last_login,
													ip,
													created_date,
													created_userid,
													modified_date,
													modified_userid)
										VALUES	(	?,?,?,?,?,?,?,?,?,?,
													?,?,?,?,?,?,?,?,?,?,
													?,?,?)")
										->execute(	$_POST["nidn"],
													$_POST["nama_dosen"],
													$_POST["gelar"],
													$_POST["tempat_lahir"],
													$_POST["tanggal_lahir"],
													$_POST["jk"],
													$_POST["jabatan_id"],
													$_POST["pendidikan_id"],
													$_POST["ikatan_kerja_id"],
													$_POST["status"],
													$mulai_masuk_dosen,
													$_POST["akta_ijin_mengajar"],
													$_POST["alamat"],
													$_POST["hp"],
													$_POST["email"],
													$password,
													$file_name,
													"",
													"",
													$created_date,
													$_SESSION["userid"],
													"",
													"");
		
		header("Location: ../../index.php?mod=dosen&code=1");
	} 

	elseif($_GET['mod'] == 'dosen' && $_GET['act'] == 'update'){
		$modified_date = date('Y-m-d H:i:s');
		$mulai_masuk_dosen = $_POST['tgl_masuk'];
		$uploaddir = '../../foto/dosen/'; 
		$file = $uploaddir ."dosen_".basename($_FILES['uploadfile']['name']); 
		$file_name= "dosen_".$_FILES['uploadfile']['name']; 
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file);
		//KDPTIMSDOS = ?,
		//KDPSTMSDOS = ?,
		//KDJENMSDOS = ?,
		$db->database_prepare("UPDATE dosen SET nama_dosen = ?, 
												gelar = ?, 
												tempat_lahir = ?, 
												tanggal_lahir = ?, 
												jk = ?, 
												jabatan_id = ?, 
												pendidikan_id = ?, 
												ikatan_kerja_id = ?, 
												status = ?, 
												mulai_masuk_dosen = ?, 
												akta_dan_ijin_mengajar = ?, 
												alamat = ?, 
												no_hp = ?, 
												email = ?,
												foto = ?,
												modified_date = ?,
												modified_userid = ?
												WHERE dosen_id = ?")
									->execute(	$_POST["nama_dosen"],
												$_POST["gelar"],
												$_POST["tempat_lahir"],
												$_POST["tanggal_lahir"],
												$_POST["jk"],
												$_POST["jabatan_id"],
												$_POST["pendidikan_id"],
												$_POST["ikatan_kerja_id"],
												$_POST["status"],
												$mulai_masuk_dosen,
												$_POST["akta_ijin_mengajar"],
												$_POST["alamat"],
												$_POST["hp"],
												$_POST["email"],
												$file_name,
												$modified_date,
												$_SESSION["userid"],
												$_POST["id"]);
		header("Location: ../../index.php?mod=dosen&code=2");
	}

	elseif ($_GET['mod'] == 'dosen' && $_GET['act'] == 'delete'){
		$dataimage = $db->database_fetch_array($db->database_prepare("SELECT foto FROM dosen WHERE dosen_id = ?")->execute($_GET["id"]));
		if ($dataimage['foto'] != ''){
			$del_image = unlink("../../foto/dosen/".$dataimage['foto']);
		}
		
		$db->database_prepare("DELETE FROM dosen WHERE dosen_id = ?")->execute($_GET["id"]);
		header("Location: ../../index.php?mod=dosen&code=3");
	}
}
?>