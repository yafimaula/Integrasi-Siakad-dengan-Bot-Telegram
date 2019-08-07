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
	if ($_GET['mod'] == 'krs' && $_GET['act'] == 'input'){ 
		$created_date = date('Y-m-d H:i:s');
		
		foreach($_POST['ambil'] AS $ambil){
			$db->database_prepare("INSERT INTO krs (	id_mhs,
													jadwal_id,
													created_date,
													created_userid,
													modified_date,
													modified_userid)
												VALUES(?,?,?,?,?,?)")
											->execute(	$_POST["id_mhs"],
														$ambil,
														$created_date,
														$_SESSION["id_mhs"],
														"",
														"");
											
		/*$sql_krs = $db->database_prepare("SELECT * FROM krs A
											INNER JOIN jadwal_kuliah B ON A.jadwal_id = B.jadwal_id
											INNER JOIN makul C ON C.mata_kuliah_id = B.makul_id
											INNER JOIN kelas D ON D.kelas_id = B.kelas_id
											INNER JOIN dosen E ON E.dosen_id = B.dosen_id
											INNER JOIN ruang F ON F.ruang_id = B.ruang_id
											WHERE A.id_mhs =  ? AND D.angkatan_id =  ?")->execute($_POST['id_mhs'],$_POST['tahun_angkatan']);
		while ($data_krs = $db->database_fetch_array($sql_krs)){
			echo $data_krs['makul_id']; 
			echo " ----- ";
			echo $data_krs['kelas_id']; 
			echo " ----- ";
			echo $data_krs['semester']; 
			echo " ----- ";
			// $db->database_prepare("INSERT INTO nilai_semester_mhs (	id_mhs,
			// 															makul_id,
			// 															kelas_id,
			// 															semester_nilai,
			// 															created_date,
			// 															created_userid,
			// 															modified_date,
			// 															modified_userid)
			// 												VALUES (?,?,?,?,?,?,?,?)")
			// 												->execute( 	$_POST["id_mhs"],
			// 															$data_krs['makul_id'],
			// 															$data_krs['kelas_id'],
			// 															$data_krs['semester'],
			// 															$created_date,
			// 															$_SESSION["userid"],
			// 															"",
			// 															"");
					}*/ 			
		}
																	
		header("Location: ../../index.php?mod=krs&act=krs_detail&id_mhs=".$_POST['id_mhs']."&angkatan_id=".$_POST['tahun_angkatan']."&code=1");
	} 

	elseif ($_GET['mod'] == 'krs' && $_GET['act'] == 'delete'){
		$db->database_prepare("DELETE FROM krs WHERE krs_id = ?")->execute($_GET["id"]);
		header("Location: ../../index.php?mod=krs&act=krs_detail&id_mhs=".$_GET['id_mhs']."&angkatan_id=".$_GET['angkatan_id']."&code=3");
	}
}
?>