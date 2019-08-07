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
	if ($_GET['mod'] == 'makul' && $_GET['act'] == 'input'){
		$created_date = date('Y-m-d H:i:s');
		
		$db->database_prepare("INSERT INTO makul (	kode_mata_kuliah,
														prodi_id,
														nama_mata_kuliah,
														jenis_mata_kuliah,
														sks,
														status_mata_kuliah,
														nidn,
														created_date,
														created_userid,
														modified_date,
														modified_userid)
											VALUE	(?,?,?,?,?,?,?,?,?,?,
													?)")
										->execute(	$_POST["kode_mata_kuliah"],
													$_POST["prodi_id"],
													$_POST["nama_mata_kuliah"],
													$_POST["jenis_mata_kuliah"],
													$_POST["sks"],
													$_POST["status_mata_kuliah"],
													$_POST["dosen_pengampu"],
													$created_date,
													$_SESSION["userid"],
													"",
													"");
		header("Location: ../../index.php?mod=makul&code=1");
	} 
	
	elseif ($_GET['mod'] == 'makul' && $_GET['act'] == 'update'){
		$modified_date = date('Y-m-d H:i:s');
		
		$db->database_prepare("UPDATE makul SET	prodi_id = ?,
													nama_mata_kuliah = ?,
													jenis_mata_kuliah = ?,
													sks = ?,
													status_mata_kuliah = ?,
													nidn = ?,
													modified_date = ?,
													modified_userid = ?
												WHERE mata_kuliah_id = ?")
									->execute(	$_POST["prodi_id"],
												$_POST["nama_mata_kuliah"],
												$_POST["jenis_mata_kuliah"],
												$_POST["sks"],
												$_POST["status_mata_kuliah"],
												$_POST["dosen_pengampu"],
												$modified_date,
												$_SESSION["userid"],
												$_POST["id"]);	
														
														
		header("Location: ../../index.php?mod=makul&code=2");	
	}
	
	elseif ($_GET['mod'] == 'makul' && $_GET['act'] == 'delete'){
		$db->database_prepare("DELETE FROM makul WHERE mata_kuliah_id = ?")->execute($_GET["id"]);
		header("Location: ../../index.php?mod=makul&code=3");
	}
}
?>