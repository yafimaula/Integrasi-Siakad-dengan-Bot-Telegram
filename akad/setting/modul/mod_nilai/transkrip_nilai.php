<?php
error_reporting(0);
	$sql_mhs = $db->database_prepare("SELECT * FROM mahasiswa A INNER JOIN prodi B ON A.kode_program_studi=B.prodi_id WHERE A.nim = ?")->execute($_SESSION['nim']);
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
                                Transkrip Nilai 
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
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="pvr-header">
                                
                            </h5>
                            
				<table id="data-table" class="table" width="100%">
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
					
					echo "<tr>
							<td>$i</td>
							<td>$data_rekap3[kode_mata_kuliah]</td>
							<td>$data_rekap3[nama_mata_kuliah]</td>
							<td>$data_rekap3[sks]</td>
							<td>$mutu2</td>
						</tr>";
					$total_sks2 += $data_rekap3['sks'];
					$bobot2 += $bobot2;
					$bobot_total2 += $total_bobot2;
					$i++;
				}
			echo "</tbody></table>";
			
			$ipk = number_format($bobot_total2/ $total_sks2, 2);
					
			echo "
				<table class='form'>
					<tr valign='top'>
						<td width='150'>Total SKS</td>
						<td>: <b>$total_sks2</b> SKS</td>
					</tr>
					<tr>
						<td>IP Kumulatif</td>
						<td>: <b>$ipk</b></td>
					</tr>
				</table>
                    </div>
                </div>
                </div>
                </div>
                </div>
	";
	}