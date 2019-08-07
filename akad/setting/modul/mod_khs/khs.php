<script type='text/javascript' src='../js/jquery.validate.js'></script>
<script type='text/javascript' src="../js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />
		
<script type='text/javascript'>
	$(document).ready(function() {
		$('#frm_khs').validate({
			rules:{
				nim: true,
				semester: true
			},
			messages:{
				nim:{
					required: "Masukan NIM terlebih dahulu."
				},
				semester:{
					required: "Masukkan semester KHS."
				}
			}
		});
		
		$("#getnim").autocomplete("modul/mod_nilai/getnim.php", {
			width: 260,
			matchContains: true,
			selectFirst: false
		});
	});
</script>
<?php
switch($_GET['act']){
	default:
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Masukkan NIM dan Tahun Akademik
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="" method="GET" />
                            <input type="hidden" name="mod" value="khs">
							<input type="hidden" name="act" value="data">
                                <fieldset>
                               	<div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">NIM</label>
                                        <input type="text" class="form-control" name="nim" id="exampleInputEmail4"  value="<?php echo "$_SESSION[nim]";?>" DISABLED/>
                                        <input type="hidden" class="form-control" name="nim" id="exampleInputEmail4"  value="<?php echo "$_SESSION[id_mhs]";?>"/>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
	                                    <label for="exampleInputEmail4">Tahun Akademik</label>
	                                        <select name="tahun_angkatan" class="form-control">
	                                           <option value="">- None -</option>
												<?php 
												$sql_angkatan = $db->database_prepare("SELECT DISTINCT F.angkatan_id, F.tahun_angkatan, F.semester_angkatan 
													FROM nilai_semester_mhs A 
													INNER JOIN makul B ON B.mata_kuliah_id = A.makul_id 
													INNER JOIN jadwal_kuliah C ON C.makul_id = B.mata_kuliah_id
													INNER JOIN kelas D ON C.kelas_id = D.kelas_id 
													INNER JOIN angkatan F ON F.angkatan_id=D.angkatan_id
													WHERE A.id_mhs =  ?")->execute($_SESSION["id_mhs"]);
												while ($data_angkatan = $db->database_fetch_array($sql_angkatan)){
													if ($data_angkatan['semester_angkatan'] == '1'){
														$semester = "Ganjil";
													}
													else{
														$semester = "Genap";
													}
													echo "<option value=$data_angkatan[angkatan_id]>$data_angkatan[tahun_angkatan] - $semester</option>";
												}
												?>
	                                        </select>
	                                    </div>
                                  </div>
                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Lanjutkan</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

	break;
	
	case "data":
	//$n = explode("-", $_GET['nim']);
	//$nim = $n[0];
	$sql_ang = $db->database_prepare("SELECT * FROM  `angkatan` WHERE  `angkatan_id` =  ?")->execute($_GET["tahun_angkatan"]);
	$data_ang = $db->database_fetch_array($sql_ang);
	if ($data_ang['semester_angkatan'] == '1'){
		$semester = "Ganjil";
	}
	else{
		$semester = "Genap";
	}
	$sql_mhs = $db->database_prepare("SELECT m.id_mhs,m.nim, m.nama_mahasiswa, p.prodi_id as prodi_id, p.nama_prodi, p.jenjang_studi_id as jenjang_studi_id FROM  `mahasiswa` m JOIN prodi p ON p.prodi_id = m.`kode_program_studi` 
									WHERE m.id_mhs = ? AND m.status_mahasiswa = 'A' ORDER BY m.nama_mahasiswa DESC LIMIT 1")->execute($_SESSION['id_mhs']);
	$nums_mhs = $db->database_num_rows($sql_mhs);
	$data_mhs = $db->database_fetch_array($sql_mhs);
	if ($nums_mhs == 0){
		echo "<div class='message error'>
				<h5>Failed!</h5>
				<p>NIM tidak ditemukan / Data KHS belum tersedia. <br> <a href='?mod=khs' style='color:#BE4741;'>Back</a></p>
			</div>";
	}
	else{
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
		?>
		<div class="content">
            <div class="row">
				<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                        	<h5 class="pvr-header">
                                KHS Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                        	<div class="table-responsive">
                        		<form method='POST' action='modul/mod_krs/aksi_krs.php?mod=krs&act=input'>
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>NIM</td>
                                        <td><?php echo "$data_mhs[nim]"; ?></td>
                                        <input type='hidden' name='id_mhs' value=<?php echo '$data_mhs[id_mhs]';?>>
                                    </tr>
                                    <tr>
                                    	<td>Nama Mahasiswa</td>
                                    	<td><?php echo "$data_mhs[nama_mahasiswa]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Program Studi</td>
                                    	<td><?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]"; ?></td><input type='hidden' name='prodi_id' value=<?php echo '$data_mhs[prodi_id]';?>>
                                    </tr>
                                    <tr>
                                    	<td>Tahun Angkatan</td>
                                    	<td><?php echo "$data_ang[tahun_angkatan] - $semester"; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
				
			<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                               Data KHS
                            </h5>
				<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th width='30'>No</th>
							<th width='85'>Kode MK</th>
							<th width='250'>Mata Kuliah</th>
							<th width='250'>SKS</th>
							<th width='100'>Grade</th> 
						</tr>
					</thead><tbody><?php
					$i = 1;
				$sql_data = $db->database_prepare("SELECT * FROM v_khs1
					WHERE nim =  ? AND tahun_angkatan =  ? AND semester_angkatan = ? GROUP BY kode_mata_kuliah")->execute($data_mhs[nim],$data_ang['tahun_angkatan'], $data_ang['semester_angkatan']);
				while ($data_data = $db->database_fetch_array($sql_data)){
					
					$nilai_abs = $data_data['absensi'];
					$nilai_tugas= ($data_data['tugas'] / 100) * 15;
					$nilai_uts	= ($data_data['uts'] / 100) * 25;
					$nilai_uas	= ($data_data['uas'] / 100) * 40;
					
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
					
					$total_bobot = $data_data['sks'] * $bobot;
					
					echo "<tr>
							<td>$i</td>
							<td>$data_data[kode_mata_kuliah]</td>
							<td>$data_data[nama_mata_kuliah]</td>
							<td>$data_data[sks]</td>
							<td>$mutu</td>
						</tr>";
					$total_sks += $data_data['sks'];
					$bobot += $bobot;
					$bobot_total += $total_bobot;
					$i++;
				}
			echo "</tbody></table>";
			
			$ips = number_format($bobot_total / $total_sks,2);
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
			echo "
				<table class='form'>
					<tr valign='top'>
						<td width='150'>Total SKS</td>
						<td>: <b>$total_sks</b> SKS</td>
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
				<br>
				<a target='_blank' href='modul/mod_khs/export_khsmpdf.php?id=$data_mhs[id_mhs]&angkatan_id=$_GET[tahun_angkatan]'><button type='button' class='btn btn-wd btn-info'><i class='fa fa-print'></i> Cetak KHS</button></a>
				<a href='index.php?mod=khs'><button type='button' class='btn btn-danger'><i class='fa fa-sign-out'></i>Keluar</button></a> 
			</div>
                    </div>
                </div>
        </div>
    </div>
	";
	}
	break;
	
	
}
?>