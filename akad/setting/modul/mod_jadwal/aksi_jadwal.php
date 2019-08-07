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
	if ($_GET['mod'] == 'jadwal_mata_kuliah' && $_GET['act'] == 'input'){
		$created_date = date('Y-m-d H:i:s');
		
		$db->database_prepare("INSERT INTO jadwal_kuliah (	makul_id,
																kelas_id,
																semester,
																hari,
																jam_mulai,
																jam_selesai,
																dosen_id,
																ruang_id,
																program,
																created_date,
																created_userid,
																modified_date,
																modified_userid)
													VALUE	(?,?,?,?,?,?,?,?,?,?,?,?,?)")
													->execute(	$_POST["makul_id"],
																$_POST["kelas_id"],
																$_POST["semester"],
																$_POST["hari"],
																$_POST["jam_mulai"],
																$_POST["jam_selesai"],
																$_POST["dosen_id"],
																$_POST["ruang_id"],
																$_POST["program"],
																$created_date,
																$_SESSION["userid"],
																"",
																"");
		header("Location: ../../index.php?mod=jadwal_mata_kuliah&act=mgm_mata_kuliah&prodi=".$_POST['proid']."&tahun_angkatan=".$_POST['angkatan_id']."&kelas_id=".$_POST['kelas_id']."&semester=".$_POST['semester']."&code=1");
	} 
	
	elseif ($_GET['mod'] == 'jadwal_mata_kuliah' && $_GET['act'] == 'update'){
		$modified_date = date('Y-m-d H:i:s');
		
		$db->database_prepare("UPDATE jadwal_kuliah SET	makul_id = ?,
															hari = ?,
															jam_mulai = ?,
															jam_selesai = ?,
															dosen_id = ?,
															ruang_id = ?,
															program = ?,
															modified_date = ?,
															modified_userid = ?
													WHERE jadwal_id = ?")
												->execute(	$_POST["makul_id"],
															$_POST["hari"],
															$_POST["jam_mulai"],
															$_POST["jam_selesai"],
															$_POST["dosen_id"],
															$_POST["ruang_id"],
															$_POST["program"],
															$modified_date,
															$_SESSION["userid"],
															$_POST["id"]);	
		header("Location: ../../index.php?mod=jadwal_mata_kuliah&act=mgm_mata_kuliah&prodi=".$_POST['prodi']."&tahun_angkatan=".$_POST['angkatan_id']."&kelas_id=".$_POST['kelas_id']."&semester=".$_POST['semester']."&code=2");
	}
	
	elseif ($_GET['mod'] == 'jadwal_mata_kuliah' && $_GET['act'] == 'delete'){
		$db->database_prepare("DELETE FROM jadwal_kuliah WHERE jadwal_id = ?")->execute($_GET["id"]);
		header("Location: ../../index.php?mod=jadwal_mata_kuliah&act=mgm_mata_kuliah&prodi=".$_GET['prodi']."&tahun_angkatan=".$_GET['angkatan_id']."&kelas_id=".$_GET['kelas_id']."&semester=".$_GET['semester']."&code=3");
	}
}
?>