<?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');
include "../config/class_database.php";
include "../config/serverconfig.php";
include "../config/debug.php";
// include "../fungsi/timezone.php";
// include "../fungsi/fungsi_combobox.php";
// include "../fungsi/fungsi_date.php";
// include "../fungsi/fungsi_rupiah.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=../index.php?code=1'>";
}

else{
	if($_GET['mod'] == 'ruang'){
		include "modul/mod_ruang/ruang.php";
	}
	
	elseif ($_GET['mod'] == 'prodi'){
		include "modul/mod_prodi/prodi.php";
	}
	
	elseif ($_GET['mod'] == 'krs'){
		include "modul/mod_krs/krs.php";
	}
	
	elseif($_GET['mod'] == 'kelas_prodi'){
		include "modul/mod_kelas/kelas.php";
	}
	
	elseif ($_GET['mod'] == 'bagi_kelas'){
		include "modul/mod_kelas/bagi_kelas.php";
	}
	
	elseif ($_GET['mod'] == 'fakultas'){
		include "modul/mod_fakultas/fakultas.php"; 
	}
	
	elseif($_GET['mod'] == 'jadwal_mata_kuliah'){
		include "modul/mod_jadwal/jadwal.php";
	}
	
	elseif ($_GET['mod'] == 'dosen'){
		include "modul/mod_dosen/dosen.php";
	}
	
	elseif ($_GET['mod'] == 'mhs'){
		include "modul/mod_mhs/mahasiswa.php";
	}
	
	elseif ($_GET['mod'] == 'angkatan'){
		include "modul/mod_angkatan/angkatan.php";
	}
	
	elseif ($_GET['mod'] == 'makul'){
		include "modul/mod_makul/makul.php";
	}
	
	elseif($_GET['mod'] == 'user'){
		include "modul/mod_user/user.php";
	}
	
	elseif ($_GET['mod'] == 'biaya'){
		include "modul/mod_biaya/biaya.php";
	}
	
	elseif ($_GET['mod'] == 'biaya_mahasiswa'){
		include "modul/mod_biaya/biaya_mahasiswa.php";
	}

	elseif ($_GET['mod'] == 'biaya_mhs'){
		include "modul/mod_biaya/biaya_mhs.php";
	}
	
	elseif ($_GET['mod'] == 'absensi_harian'){
		include "modul/mod_absen/absensi_harian.php";
	}
	
	elseif ($_GET['mod'] == 'jadwal_dosen'){
		include "modul/mod_jadwal_dosen/jadwal_dosen.php";
	}
	
	elseif ($_GET['mod'] == 'nilai_semester'){
		include "modul/mod_nilai/nilai.php";
	}
	
	elseif ($_GET['mod'] == 'ubah_password'){
		include "modul/mod_user/password.php";
	}
	
	elseif ($_GET['mod'] == 'akun'){
		include "modul/mod_user/akun.php";
	}
	
	elseif ($_GET['mod'] == 'nilai'){
		include "modul/mod_nilai/data_nilai.php";
	}
	
	elseif ($_GET['mod'] == 'transkrip_nilai'){
		include "modul/mod_nilai/transkrip_nilai.php";
	}
	
	elseif ($_GET['mod'] == 'khs'){
		include "modul/mod_khs/khs.php";
	}
	
	elseif ($_GET['mod'] == 'backup_db'){
		include "modul/mod_backup/backup.php";
	}
	elseif ($_GET['mod'] == 'profil_mahasiswa'){
		include "modul/mod_mhs/profil_mahasiswa.php";
	}
	elseif ($_GET['mod'] == 'telegram'){
		include "modul/mod_mhs/telegram_mhs.php";
	}
	
	else{
		if ($_GET['code'] == 1){
			echo "
				<div class='alert alert-info'>
                <h4><i class='fa fa-check'></i> Login Succes!</h4>
              </div>";
		}
		echo "
		<div class='content'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='pvr-wrapper'>
                        <div class='pvr-box'>
                            <h5 class='pvr-header'>
                                Welcome !!!
                                
                            </h5>
                            <div class='welcome_message pvr-box-gray'>
                                    <div class='element-info'>
                                            <div class='element-info-text'>
                                                <h2 class='element-inner-header m-t-0 text-purple' id='good_morning' data-typeit='true'>
                                                    Hello, $_SESSION[nama_lengkap] !!!
                                                </h2>
                                                <div class='element-inner-desc text-justify m-b-0'>
                                                    Selamat datang di Sistem Informasi Akademik Kampus, Anda dapat mengolah konten melalui menu di sisi kiri.<br><br>
                                                    Informasi Login:<br>
                                                    Tanggal : $_SESSION[last_login] <br>
                                                    IP : $_SESSION[ip]
                                                </div>
                                            </div>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>";
		
	}
}
?>