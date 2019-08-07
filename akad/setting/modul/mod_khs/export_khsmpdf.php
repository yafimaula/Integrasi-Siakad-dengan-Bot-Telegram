<?php
error_reporting(0);
session_start();
include "../../../config/class_database.php";
include "../../../config/serverconfig.php";
include "../../../config/debug.php";
include "../../../fungsi/fungsi_date.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	header("Location: ../../../login.php?code=2");
}

else{
	require ("../../../fungsi/mpdf57/mpdf.php");
	//require ("../../../fungsi/html2pdf/html2pdf.class.php");
	//$filename="khs.pdf";
	$content = ob_get_clean();
	$year = date('Y');
	$month = date('m');
	$date = date('d'); 
	$now = date('Y-m-d');
	$date_now = tgl_indo($now);

	$sql_ang = $db->database_prepare("SELECT * FROM  `angkatan` WHERE  `angkatan_id` =  ?")->execute($_GET['angkatan_id']);
	$data_ang = $db->database_fetch_array($sql_ang);
	if ($data_ang['semester_angkatan'] == '1'){
		$semester = "Ganjil";
	}
	else{
		$semester = "Genap";
	}

	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM mahasiswa A INNER JOIN prodi B ON A.kode_program_studi=B.prodi_id
										LEFT JOIN dosen E ON B.kaprodi = E.dosen_id
										WHERE A.id_mhs = ?")->execute($_GET['id']));

	if ($data_mhs['jenjang_studi_id'] == 'A'){
		$kd_jenjang_studi = "S3";
	}
	elseif ($data_mhs['jenjang_studi_id'] == 'B'){
		$kd_jenjang_studi = "S2";
	}
	elseif ($data_mhs['jenjang_studi_id'] == 'C'){
		$kd_jenjang_studi = "S1";
	}
	elseif ($data_mhs['jenjang_studi_id'] == 'D'){
		$kd_jenjang_studi = "D4";
	}
	elseif ($data_mhs['jenjang_studi_id'] == 'E'){
		$kd_jenjang_studi = "D3";
	}
	elseif ($data_mhs['jenjang_studi_id'] == 'F'){
		$kd_jenjang_studi = "D2";
	}
	elseif ($data_mhs['jenjang_studi_id'] == 'G'){
		$kd_jenjang_studi = "D1";
	}
	elseif ($data_mhs['jenjang_studi_id'] == 'H'){
		$kd_jenjang_studi = "Sp-1";
	}
	elseif ($data_mhs['jenjang_studi_id'] == 'I'){
		$kd_jenjang_studi = "Sp-2";
	}
	else{
		$kd_jenjang_studi = "Profesi";
	}
	
	$tanggal_lahir = tgl_indo($data_mhs['tanggal_lahir']);
	
	$content = "
				<table align='center'>
					<tr align='top'>
						<td><img src='../../../logo.JPG' height='50'></td>
						<td width='10'></td>
						<td>
							<b>Universitas Pesantren Tinggi Darul Ulum</b><br>
							PP Darul Ulum Rejoso Peterongan Jombang<br>
							Telp. (0231) 358630, 085 621 21141
						</td>
					</tr>
					<tr>
						<td colspan='3'><hr></td>
					</tr>
					<tr>
						<td colspan='3' align='center'><br><p><b><u>Kartu Hasil Studi (KHS)</u></b></p></td>
					</tr>
					<tr>
						<td colspan='3'><p>&nbsp;</p></td>
					</tr>
				</table>
				<table>
					<tr>
						<td width='50'>NIM</td>
						<td width='5'>:</td>
						<td><b>$data_mhs[nim]</b></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><b>$data_mhs[nama_mahasiswa]</b></td>
					</tr>
					<tr>
						<td>Prodi</td>
						<td>:</td>
						<td><b>$kd_jenjang_studi - $data_mhs[nama_prodi]</b></td>
					</tr>
					<tr>
						<td>Tahun Angkatan</td>
						<td>:</td>
						<td><b>$data_ang[tahun_angkatan] - $semester</b></td>
					</tr>
				</table>
				<br>
				<table cellpadding=0 border='0' cellspacing=0>
					<tr>
						<th width='15' rowspan='2' style='border:1px solid #000; background-color: #DC143C; padding: 2px;'>No</th>
						<th rowspan='2' align='center' width='130' style='border:1px solid #000; background-color: #DC143C; padding: 2px;'>Kode Matakuliah</th>
						<th rowspan='2' align='center' width='250' style='border:1px solid #000; background-color: #DC143C; padding: 2px;'>Mata Kuliah</th>
						<th rowspan='2' align='center' width='50' style='border:1px solid #000; background-color: #DC143C; padding: 2px;'>SKS</th>
						<th colspan='2' style='border:1px solid #000; background-color: #DC143C; padding: 2px;' align='center' width='210'>Grade</th>
					</tr>
					<tr bgcolor='#DC143C'>
						
					</tr>";
					$i = 1;
			$sql_sql = $db->database_prepare("SELECT * FROM v_khs1
					WHERE nim =  ? AND tahun_angkatan =  ? AND semester_angkatan = ? GROUP BY kode_mata_kuliah")->execute($data_mhs['nim'],$data_ang['tahun_angkatan'], $data_ang['semester_angkatan']);
			while ($data_nilai = $db->database_fetch_array($sql_sql)){
				
				$nilai_abs = $data_nilai['absensi'];
				$nilai_tugas= ($data_nilai['tugas'] / 100) * 15;
				$nilai_uts	= ($data_nilai['uts'] / 100) * 25;
				$nilai_uas	= ($data_nilai['uas'] / 100) * 40;
				
				$nilai = $nilai_abs + $nilai_tugas + $nilai_uas + $nilai_uts;
				
				if ($nilai >= 95 AND $nilai <= 100){
						$mutu = "A";
						$bobot = "4";
					}
					elseif ($nilai >= 90 AND $nilai <= 94.9){
						$mutu = "A-";
						$bobot = "3.75";
					}
					elseif ($nilai >= 85 AND $nilai <= 89.9){
						$mutu = "B+";
						$bobot = "3.25";
					}
					elseif ($nilai >= 80 AND $nilai <= 84.9){
						$mutu = "B";
						$bobot = "3";
					}
					elseif ($nilai >= 75 AND $nilai <= 79.9){
						$mutu = "B-";
						$bobot = "2.75";
					}
					elseif ($nilai >= 70 AND $nilai <= 74.9){
						$mutu = "C+";
						$bobot = "2.25";
					}
					elseif ($nilai >= 65 AND $nilai <= 69.9){
						$mutu = "C";
						$bobot = "2";
					}
					elseif ($nilai >= 60 AND $nilai <= 64.9){
						$mutu = "C-";
						$bobot = "1.75";
					}
					elseif ($nilai >= 55 AND $nilai <= 59.9){
						$mutu = "D+";
						$bobot = "1.25";
					}
					elseif ($nilai >= 45 AND $nilai <= 49.9){
						$mutu = "D-";
						$bobot = "1";
					}
					elseif ($nilai < 44){
						$mutu = "E";
						$bobot = "0";
					}
				
				$total_bobot = $data_nilai['sks'] * $bobot;

				$content .= "
					<tr>
							<td style='border:1px solid #000; padding: 2px;'>$i</td>
							<td style='border:1px solid #000; padding: 2px;' align='center'>$data_nilai[kode_mata_kuliah]</td>
							<td style='border:1px solid #000; padding: 2px;'>$data_nilai[nama_mata_kuliah]</td>
							<td style='border:1px solid #000; padding: 2px;' align='center'>$data_nilai[sks]</td>
							<td style='border:1px solid #000; padding: 2px;' align='center'>$mutu</td>
						</tr>";
				$grand_sks += $data_nilai['sks'];
				$grand_bobot += $total_bobot;
						$i++;
			}
			$ips = number_format($grand_bobot / $grand_sks, 2);

			$sql_data3 = $db->database_prepare("SELECT * FROM v_khs1
					WHERE nim =  ? GROUP BY kode_mata_kuliah")->execute($data_mhs['nim']);
				while ($data_rekap3 = $db->database_fetch_array($sql_data3)){
					
					$nilai_abs2 = $data_rekap3['absensi'];
					$nilai_tugas2= ($data_rekap3['tugas'] / 100) * 15;
					$nilai_uts2	= ($data_rekap3['uts'] / 100) * 25;
					$nilai_uas2	= ($data_rekap3['uas'] / 100) * 40;
					
					$nilai2 = $nilai_abs2 + $nilai_tugas2 + $nilai_uas2 + $nilai_uts2;
					
					if ($nilai2 >= 95 AND $nilai2 <= 100){
						$mutu2 = "A";
						$bobot2 = "4";
					}
					elseif ($nilai2 >= 90 AND $nilai2 <= 94.9){
						$mutu2 = "A-";
						$bobot2 = "3.75";
					}
					elseif ($nilai2 >= 85 AND $nilai2 <= 89.9){
						$mutu2 = "B+";
						$bobot2 = "3.25";
					}
					elseif ($nilai2 >= 80 AND $nilai2 <= 84.9){
						$mutu2 = "B";
						$bobot2 = "3";
					}
					elseif ($nilai2 >= 75 AND $nilai2 <= 79.9){
						$mutu2 = "B-";
						$bobot2 = "2.75";
					}
					elseif ($nilai2 >= 70 AND $nilai2 <= 74.9){
						$mutu2 = "C+";
						$bobot2 = "2.25";
					}
					elseif ($nilai2 >= 65 AND $nilai2 <= 69.9){
						$mutu2 = "C";
						$bobot2 = "2";
					}
					elseif ($nilai2 >= 60 AND $nilai2 <= 64.9){
						$mutu2 = "C-";
						$bobot2 = "1.75";
					}
					elseif ($nilai2 >= 55 AND $nilai2 <= 59.9){
						$mutu2 = "D+";
						$bobot2 = "1.25";
					}
					elseif ($nilai2 >= 45 AND $nilai2 <= 49.9){
						$mutu2 = "D-";
						$bobot2 = "1";
					}
					elseif ($nilai2 < 44){
						$mutu2 = "E";
						$bobot2 = "0";
					}	

					$total_bobot2 = $data_rekap3['sks'] * $bobot2;
					$total_sks2 += $data_rekap3['sks'];
					$bobot2 += $bobot2;
					$bobot_total2 += $total_bobot2;
					$ipk = number_format($bobot_total2/ $total_sks2, 2);
					}

			$nip = $db->database_fetch_array($db->database_prepare("SELECT * FROM as_users WHERE user_id = ?")->execute($_SESSION["userid"]));
			$content .= "	</table>
					<br>
					<table>
						<tr>
							<td width='160'>Jumlah SKS</td>
							<td>: <b>$grand_sks SKS</b></td>
						</tr>
						<tr>
							<td>IP Semester </td>
							<td>: <b>$ips</b></td>
						</tr>
						<tr>
							<td>IP Kumulatif</td>
							<td>: <b>$ipk</b></td>
						</tr>
					</table>
					<table>
						<tr></tr>
						<tr>
							<td width='400'></td>
							<td align='center'>Jombang, $date_now<br><br>
							Universitas Pesantren Tinggi Darul Ulum Jombang<br>
							Kepala Program Studi<br>
								<p>&nbsp;</p><p>&nbsp;</p>
								$data_mhs[nama_dosen] $data_mhs[gelar]<br>
								<b>NIP. $data_mhs[nidn]</b> 
							</td>
						</tr>
					</table>

	";
$id=$_SESSION['id_mhs'];
$ang=$_GET['angkatan_id'];
$filename= $id.'_'.$ang.'.pdf';
$mpdf=new mPDF();
$mpdf->WriteHTML($content);
$mpdf->Output($filename, "I");
exit;
	
	// conversion HTML => PDF
	// try
	// {
	// 	$html2pdf = new HTML2PDF('P','A4','fr', false, 'ISO-8859-15',array(10, 10, 10, 10)); //setting ukuran kertas dan margin pada dokumen anda
	// 	// $html2pdf->setModeDebug();
	// 	$html2pdf->setDefaultFont('Arial');
	// 	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	// 	$html2pdf->Output($filename);
	// }
	// catch(HTML2PDF_exception $e) { echo $e; }
}
?>