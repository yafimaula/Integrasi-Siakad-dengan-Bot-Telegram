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
	if ($_GET['mod'] == 'prodi' && $_GET['act'] == 'input'){
		
		$created_date = date('Y-m-d H:i:s');
		
		$db->database_prepare("INSERT INTO prodi (	jenjang_studi_id,
													fakultas_id,
													nama_prodi,
													status,
													akreditasi,
													kaprodi,
													created_date,
													created_userid,
													modified_date,
													modified_userid)
											VALUE	(?,?,?,?,?,?,?,?,?,?)")
										->execute(	
													$_POST["kd_jenjang_studi"],
													$_POST["fakultas_id"],
													$_POST["nama"],
													$_POST["status"],
													$_POST["akreditasi"],
													$_POST["kaprodi"],
													$created_date,
													$_SESSION["userid"],
													"",
													"");
		header("Location: ../../index.php?mod=prodi&code=1");
	} 

	elseif($_GET['mod'] == 'prodi' && $_GET['act'] == 'update'){
		
		$modified_date = date('Y-m-d H:i:s');
		
		$db->database_prepare("UPDATE prodi SET	jenjang_studi_id = ?,
												fakultas_id = ?,
												nama_prodi = ?,
												status = ?,
												akreditasi = ?,
												kaprodi = ?,
												modified_date = ?,
												modified_userid = ?
												WHERE prodi_id = ?")
									->execute(	$_POST["kd_jenjang_studi"],
												$_POST["fakultas_id"],
												$_POST["nama"],
												$_POST["status"],
												$_POST["akreditasi"],
												$_POST["kaprodi"],
												$modified_date,
												$_SESSION["userid"],
												$_POST["id"]);
		header("Location: ../../index.php?mod=prodi&code=2");
	}

	elseif ($_GET['mod'] == 'prodi' && $_GET['act'] == 'delete'){
		$db->database_prepare("DELETE FROM prodi WHERE prodi_id = ?")->execute($_GET["id"]);
		header("Location: ../../index.php?mod=prodi&code=3");
	}
}
?>