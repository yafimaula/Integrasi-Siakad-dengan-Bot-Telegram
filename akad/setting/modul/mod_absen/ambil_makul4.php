<?php
//error_reporting(0);
session_start();
include "../../../config/class_database.php";
include "../../../config/serverconfig.php";

$kelas = explode("*", $_GET['kelas4']);

if ($_SESSION['level'] == 'dos'){
	$sql_makul = $db->database_prepare("SELECT dosen.nama_dosen, dosen.gelar, jadwal_kuliah.makul_id, makul.nama_mata_kuliah, makul.kode_mata_kuliah FROM jadwal_kuliah 
								INNER JOIN makul ON makul.mata_kuliah_id=jadwal_kuliah.makul_id 
								INNER JOIN dosen ON dosen.dosen_id=jadwal_kuliah.dosen_id
								WHERE jadwal_kuliah.kelas_id = ? AND jadwal_kuliah.semester = ?
								AND jadwal_kuliah.dosen_id=?")->execute($kelas[0],$kelas[1],$_SESSION["useri"]);
}
else{
	$sql_makul = $db->database_prepare("SELECT dosen.nama_dosen, dosen.gelar, jadwal_kuliah.makul_id, makul.nama_mata_kuliah, makul.kode_mata_kuliah FROM jadwal_kuliah 
								INNER JOIN makul ON makul.mata_kuliah_id=jadwal_kuliah.makul_id 
								INNER JOIN dosen ON dosen.dosen_id=jadwal_kuliah.dosen_id
								WHERE jadwal_kuliah.kelas_id = ? AND jadwal_kuliah.semester = ?")->execute($kelas[0],$kelas[1]);
}

while($k = $db->database_fetch_array($sql_makul)){
    echo "<option value=$k[makul_id]>$k[kode_mata_kuliah] - $k[nama_mata_kuliah] - $k[nama_dosen] $k[gelar]</option>";
}
?>