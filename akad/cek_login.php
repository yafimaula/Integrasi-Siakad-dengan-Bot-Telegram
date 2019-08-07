<?php
//error_reporting(0);
include "config/class_database.php";
include "config/serverconfig.php";
include "config/debug.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

	if ($_POST["dosen"] == 1){
	$sql = $db->database_prepare("SELECT * FROM dosen WHERE email = ? AND password = ? AND status = 'A'")->execute($username,$password);

}elseif ($_POST["mhs"] == 2) {
	$sql = $db->database_prepare("SELECT * FROM mahasiswa WHERE nim = ? AND password = ? AND status_mahasiswa = 'A'")->execute($username,$password);
}
else{
	$sql = $db->database_prepare("SELECT * FROM users WHERE email = ? AND password = ? AND aktif = 'Y' AND blokir = 'N'")->execute($username,$password);
}
$nums = $db->database_num_rows($sql);

$data = $db->database_fetch_array($sql);

if ($nums > 0){ 
	session_start();
	$last_login = date('Y-m-d H:i:s');
	
	if ($_POST['dosen'] == 1){
		$_SESSION['nama_lengkap'] = $data['nama_dosen']." ".$data['gelar'];
		$_SESSION['username'] = $data['email'];
		$_SESSION['password'] = $data['password'];
		$_SESSION['userid'] = $data['nidn'];
		$_SESSION['useri'] = $data['dosen_id'];
		$_SESSION['level'] = "dos";
		$_SESSION['last_login'] = date('Y-m-d H:i:s');
		$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];
		$_SESSION['aktif'] = $data['status'];
		$db->database_prepare("UPDATE dosen SET last_login = ?, ip = ? WHERE dosen_id = ?")->execute($last_login,$_SERVER["REMOTE_ADDR"],$data["dosen_id"]);
	}
	elseif ($_POST['mhs'] == 2){
		$_SESSION['nama_lengkap'] = $data['nama_mahasiswa'];
		$_SESSION['username'] = $data['email'];
		$_SESSION['password'] = $data['password'];
		$_SESSION['nim'] = $data['nim'];
		$_SESSION['id_mhs'] = $data['id_mhs'];
		$_SESSION['level'] = "mhs";
		$_SESSION['last_login'] = date('Y-m-d H:i:s');
		$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];
		$_SESSION['status'] = $data['status_mahasiswa'];
		$db->database_prepare("UPDATE mahasiswa SET last_login = ?, ip = ? WHERE id_mhs = ?")->execute($last_login,$_SERVER["REMOTE_ADDR"],$data["id_mhs"]); 
	}
	else{
		$_SESSION['username'] = $data['email'];
		$_SESSION['password'] = $data['password'];
		$_SESSION['userid'] = $data['user_id'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
		$_SESSION['aktif'] = $data['aktif'];
		$_SESSION['blokir'] = $data['blokir'];
		$_SESSION['last_login'] = date('Y-m-d H:i:s');
		$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];
		$db->database_prepare("UPDATE users SET last_login = ?, ip = ? WHERE user_id = ?")->execute($last_login,$_SERVER["REMOTE_ADDR"],$data["user_id"]);
	}
	
	header("Location: setting/index.php?code=1");
}
else{
	header("Location: index.php?code=1");
}


?>