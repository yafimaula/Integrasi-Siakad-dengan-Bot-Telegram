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
	require ("../../../fungsi/html2pdf/html2pdf.class.php");
	
	$content = ob_get_clean();
	$year = date('Y');
	$month = date('m');
	$date = date('d');
	$now = date('Y-m-d');
	$date_now = tgl_indo($now);
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM mahasiswa A INNER JOIN prodi B ON A.kode_program_studi=B.prodi_id
										LEFT JOIN dosen E ON B.kaprodi = E.dosen_id
										WHERE A.id_mhs = ? AND status_mahasiswa = 'A' LIMIT 1")->execute($_GET['id_mhs']));
	$id=$_GET['id_mhs'];
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
	$content = "
				<table width='100%' >
					<tr valign='top'>
						<td><img src='../../../logo.jpg' height='50'></td>
						<td width='10'></td>
						<td>
							<b>Universitas Pesantren Tinggi Darul Ulum</b><br>
							PP Darul Ulum Rejoso Peterongan Jombang<br>
							Telp. (0231) 358630, 085 621 21141
						</td>
					</tr>
					<tr>
						<td colspan='3' width='10'><hr></td>
					</tr>
					<tr>
						<td colspan='3' align='center'><br><p><b><u>KARTU RENCANA STUDI (KRS)</u></b></p></td>
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
						<td>Nama Mahasiswa</td>
						<td>:</td>
						<td><b>$data_mhs[nama_mahasiswa]</b></td>
					</tr>
					<tr>
						<td>Program Studi</td>
						<td>:</td>
						<td><b>$kd_jenjang_studi - $data_mhs[nama_prodi]</b></td>
					</tr>
					<tr>
						<td>Semester</td>
						<td>:</td>
						<td><b>$data_mhs[semester] $_GET[semester]</b></td>
					</tr>
				</table>	<br>
				<table cellpadding=0 cellspacing=0>
					<tr>
						<th width='10' style='border: 1px solid #000; padding: 5px;font-size: 11.5px; background-color:#DC143C;'>No.</th>
						<th align='center' width='60' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Kode MK</th>
						<th align='center' width='180' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Nama MK</th>
						<th align='center' width='200' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Dosen</th>
						<th align='center' width='55' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Hari</th>
						<th align='center' width='55' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Jam</th>
						<th align='center' width='55' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Ruang</th>
						<th width='55' align='center' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Jumlah SKS</th>
					</tr>
			";
			$i = 1;
			$sql_krs = $db->database_prepare("SELECT * FROM krs A INNER JOIN jadwal_kuliah B ON A.jadwal_id=B.jadwal_id
											INNER JOIN makul C ON C.mata_kuliah_id=B.makul_id
											INNER JOIN ruang R ON B.ruang_id = R.ruang_id 
											INNER JOIN kelas D ON D.kelas_id=B.kelas_id
											INNER JOIN dosen E ON E.dosen_id=B.dosen_id 
											WHERE A.id_mhs = ? AND B.semester = ?")->execute($_GET["id_mhs"],$_GET["semester"]);
			while ($data_krs = $db->database_fetch_array($sql_krs)){
			if ($data_krs['hari'] == 1){
				$hari = "Senin";
				}
			elseif ($data_krs['hari'] == 2){
				$hari = "Selasa";
			}
			elseif ($data_krs['hari'] == 3){
				$hari = "Rabu";
			}
			elseif ($data_krs['hari'] == 4){
				$hari = "Kamis";
			}
			elseif ($data_krs['hari'] == 5){
				$hari = "Jumat";
			}
			elseif ($data_krs['hari'] == 6){
				$hari = "Sabtu";
			}
			else{
				$hari = "Minggu";
			}
			$content .= "<tr>
						<td style='border: 1px solid #000;padding: 5px; font-size: 11.5px;'>$i</td>
						<td style='border: 1px solid #000; font-size: 11.5px;'>$data_krs[kode_mata_kuliah]</td>
						<td style='border: 1px solid #000; font-size: 11.5px;'>$data_krs[nama_mata_kuliah]</td>
						<td style='border: 1px solid #000; font-size: 11.5px;'>$data_krs[nama_dosen] $data_krs[gelar]</td>
						<td style='border: 1px solid #000; font-size: 11.5px;' align='center'>$hari</td>
						<td style='border: 1px solid #000; font-size: 11.5px;' align='center'>$data_krs[jam_mulai]</td>
						<td style='border: 1px solid #000; font-size: 11.5px;' align='center'>$data_krs[nama_ruang]</td>
						<td style='border: 1px solid #000; font-size: 11.5px;' align='center'>$data_krs[sks]</td>
					</tr>";
				$grand_sks += $data_krs['sks'];
				$i++;
			}				
			$nip = $db->database_fetch_array($db->database_prepare("SELECT * FROM users WHERE user_id = ?")->execute($_SESSION["userid"]));
			$content .= "
					<tr>
						<td colspan='7' style='border: 1px solid #000; padding: 4px 7px; font-size: 11.5px;' align='center'><b>Total SKS</b></td>
						<td style='border: 1px solid #000; font-size: 11.5px;' align='center'><b>$grand_sks</b></td>
					</tr>
					</table>
					<p>&nbsp;</p>
					<table>
						<tr>
							<td width='400'></td>
							<td align='center'>Jombang, $date_now<br>
							Universitas Pesantren Tinggi Darul Ulum Jombang<br>
							Kepala Program Studi<br>
								<p>&nbsp;</p><p>&nbsp;</p>
								<u>$data_mhs[nama_dosen] $data_mhs[gelar]</u><br>
								<b>NIP. $data_mhs[nidn]</b> 
							</td>
						</tr>
					</table>
					";	
			
			
	// conversion HTML => PDF
	try
	{
		$filename= $id.'.pdf';
		$html2pdf = new HTML2PDF('P','A4','fr', false, 'ISO-8859-15',array(10, 10, 10, 10)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename, "D");
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>