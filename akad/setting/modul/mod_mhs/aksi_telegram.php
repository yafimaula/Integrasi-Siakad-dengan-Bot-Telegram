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
	if ($_GET['mod'] == 'ubah_telegram'){
		$modified_date = date('Y-m-d H:i:s');
		
		$db->database_prepare("UPDATE mahasiswa SET	id_telegram = ?
												WHERE id_mhs = ?")
									->execute( 	'0',
												$_POST["id"]);
		header("Location: ../../index.php?mod=telegram&code=1");	
	}
	
}
?>