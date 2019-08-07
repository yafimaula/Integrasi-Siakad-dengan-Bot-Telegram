<?php
//error_reporting(0);
include "../../../config/class_database.php";
include "../../../config/serverconfig.php"; 

$sql_prodi = $db->database_prepare("SELECT * FROM kelas A JOIN angkatan B ON A.angkatan_id = B.angkatan_id WHERE A.prodi_id = ? AND A.status = 'A' AND B.status = 'A' ORDER BY A.nama_kelas ASC")->execute($_GET['prodi4']);
echo "<option value=''></option>";
while($k = $db->database_fetch_array($sql_prodi)){
    echo "<option value='$k[kelas_id]*$k[semester_kelas]*$k[angkatan_id]'>$k[nama_kelas] / $k[semester_kelas]</option>";
}
?>