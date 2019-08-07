<?php
error_reporting(0);
session_start();
include "../../../config/class_database.php";
include "../../../config/serverconfig.php";
include "../../../config/debug.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	header("Location: ../../../index.php?code=2");
}

else{
	if ($_GET['mod'] == 'bagi_kelas' && $_GET['act'] == 'input'){
		$created_date = date('Y-m-d H:i:s');
		$kelas_id = $_POST['kelas_id'];
		$id_mhs = $_POST['id_mhs'];
		$count_kelas = COUNT($kelas_id);
		
		for ($i = 0; $i < $count_kelas; $i++){
			$db->database_prepare("INSERT INTO kelas_mahasiswa (id_mhs,kelas_id,semester,created_date,created_userid,modified_date,modified_userid) VALUES(?,?,?,?,?,?,?)")
							->execute($id_mhs[$i],$kelas_id[$i],1,$created_date,$_SESSION["userid"],"","");
			header("Location: ../../index.php?mod=kelas_prodi&act=detail&proid=".$_POST['proid']."&angkatan_id=".$_POST['angkatan_id']."&code=1");
		}
		header("Location: ../../index.php?mod=bagi_kelas&code=1");
	} 
	
	elseif ($_GET['mod'] == 'kelas_prodi' && $_GET['act'] == 'update'){
		$modified_date = date('Y-m-d H:i:s');
		
		$db->database_prepare("UPDATE as_kelas SET	nama_kelas = ?,
													daya_tampung = ?,
													aktif = ?,
													semester = ?,
													modified_date = ?,
													modified_userid = ?
											WHERE kelas_id = ?")
										->execute(	$_POST["nama_kelas"],
													$_POST["daya_tampung"],
													$_POST["aktif"],
													$_POST["semester"],
													$modified_date,
													$_SESSION["userid"],
													$_POST["id"]);	
		header("Location: ../../index.php?mod=kelas_prodi&act=detail&proid=".$_POST['proid']."&angkatan_id=".$_POST['angkatan_id']."&code=2");
	}
	
	elseif ($_GET['mod'] == 'kelas_prodi' && $_GET['act'] == 'delete'){
		$db->database_prepare("DELETE FROM as_kelas WHERE kelas_id = ?")->execute($_GET["id"]);
		header("Location: ../../index.php?mod=kelas_prodi&act=detail&proid=".$_GET['proid']."&angkatan_id=".$_GET['angkatan_id']."&code=3");
	}
}
?>