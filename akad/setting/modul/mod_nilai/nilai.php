<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Nilai berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Nilai berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Nilai berhasil dihapus.</p>
	</div>
<?php
}
?>
<script type='text/javascript' src='../js/jquery.validate.js'></script>
<script src="../js/jquery-1.10.2.min.js"></script>

<script type='text/javascript'>
	var htmlobjek;
	$(document).ready(function() {
		$("#prodi").change(function(){
			var prodi = $("#prodi").val();
			$.ajax({
				url: "modul/mod_nilai/ambilkelas.php",
				data: "prodi="+prodi,
				cache: false,
				success: function(msg){
					$("#kelas").html(msg);
				}
			});
		});
		
		$("#kelas").change(function(){
			var kelas = $("#kelas").val();
			$.ajax({
				url: "modul/mod_nilai/ambilmakul.php",
				data: "kelas="+kelas,
				cache: false,
				success: function(msg){
					$("#makul").html(msg);
				}
			});
		});
		
		$("#prodi2").change(function(){
			var prodi2 = $("#prodi2").val();
			$.ajax({
				url: "modul/mod_nilai/ambilkelas2.php",
				data: "prodi2="+prodi2,
				cache: false,
				success: function(msg){
					$("#kelas2").html(msg);
				}
			});
		});
		
		$("#kelas2").change(function(){
			var kelas2 = $("#kelas2").val();
			$.ajax({
				url: "modul/mod_nilai/ambilmakul2.php",
				data: "kelas2="+kelas2,
				cache: false,
				success: function(msg){
					$("#makul2").html(msg);
				}
			});
		});
		
		$('#frm_nilai').validate({
			rules:{
				prodi: true
			},
			messages:{
				prodi:{
					required: "Program studi wajib diisi."
				}
			}
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
                                Nilai Semester Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <div class="bd-example bd-example-tabs" role="tabpanel">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">Entri Nilai</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="false">Buka/Update Nilai</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="true">
                                    <form method="GET">
                                        <input type="hidden" name="mod" value="nilai_semester">
										<input type="hidden" name="act" value="form">
										<div class="form-group">
                                          <label for="exampleInputEmail4">Program Studi</label>
                                          <select name="prodi" id='prodi' class="form-control">
                                          	<option value=''>- None -</option>
                                          	<?php
                                          	$sql_prodi = $db->database_prepare("SELECT jenjang_studi_id,prodi_id,nama_prodi FROM prodi WHERE status = 'A'")->execute();
											while ($data_prodi = $db->database_fetch_array($sql_prodi)){
												if ($data_prodi['jenjang_studi_id'] == 'A'){
													$kd_jenjang_studi = "S3";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'B'){
													$kd_jenjang_studi = "S2";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'C'){
													$kd_jenjang_studi = "S1";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'D'){
													$kd_jenjang_studi = "D4";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'E'){
													$kd_jenjang_studi = "D3";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'F'){
													$kd_jenjang_studi = "D2";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'G'){
													$kd_jenjang_studi = "D1";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'H'){
													$kd_jenjang_studi = "Sp-1";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'I'){
													$kd_jenjang_studi = "Sp-2";
												}
												else{
													$kd_jenjang_studi = "Profesi";
												}
												echo "<option value=$data_prodi[prodi_id]>$kd_jenjang_studi - $data_prodi[nama_prodi]</option>";
											}?>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Kelas</label>
                                          <select name="kelas" id="kelas" class="form-control">
                                          	<option value=''></option>
                                          	
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Mata Kuliah</label>
                                          <select name="makul" id="makul" class="form-control">
                                          	<option value=''></option>
                                          	
                                          </select>
                                       </div>
                                       <button type="submit" class="btn btn-purple m-r-5">Open Data</button>
                                    </form>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                                     <form method="GET">
                                        <input type='hidden' name='mod' value='nilai_semester'>
										<input type='hidden' name='act' value='update_nilai'>
										<div class="form-group">
                                          <label for="exampleInputEmail4">Program Studi</label>
                                          <select name="prodi" id='prodi2' class="form-control">
                                          	<option value=''>- None -</option>
                                          	<?php
                                          	$sql_prodi = $db->database_prepare("SELECT * FROM prodi WHERE status = 'A' ORDER BY jenjang_studi_id,nama_prodi ASC")->execute();
											while ($data_prodi = $db->database_fetch_array($sql_prodi)){
												if ($data_prodi['jenjang_studi_id'] == 'A'){
													$kd_jenjang_studi = "S3";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'B'){
													$kd_jenjang_studi = "S2";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'C'){
													$kd_jenjang_studi = "S1";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'D'){
													$kd_jenjang_studi = "D4";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'E'){
													$kd_jenjang_studi = "D3";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'F'){
													$kd_jenjang_studi = "D2";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'G'){
													$kd_jenjang_studi = "D1";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'H'){
													$kd_jenjang_studi = "Sp-1";
												}
												elseif ($data_prodi['jenjang_studi_id'] == 'I'){
													$kd_jenjang_studi = "Sp-2";
												}
												else{
													$kd_jenjang_studi = "Profesi";
												}
												echo "<option value=$data_prodi[prodi_id]>$kd_jenjang_studi - $data_prodi[nama_prodi]</option>";
											}?>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Kelas</label>
                                          <select name="kelas" id='kelas2' class="form-control">
                                          	<option value=''></option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Mata Kuliah</label>
                                          <select name="makul" id='makul2' class="form-control">
                                          	<option value=''></option>
                                          </select>
                                       </div>
                                       <button type="submit" class="btn btn-purple m-r-5">Open Data</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	</div>
	<?php
	break;
	
	case "form":
	$kelas = explode("*", $_GET['kelas']);
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM jadwal_kuliah A INNER JOIN kelas B ON A.kelas_id=B.kelas_id
														INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id 
														INNER JOIN prodi D ON D.prodi_id=B.prodi_id
														INNER JOIN dosen E ON E.dosen_id=A.dosen_id
														INNER JOIN ruang F ON F.ruang_id=A.ruang_id
														WHERE 	A.makul_id=? AND
																A.kelas_id=? AND
																B.angkatan_id = ? LIMIT 1")->execute($_GET['makul'],$kelas[0],$kelas[2]));
	$data_makul = $db->database_fetch_array($db->database_prepare("SELECT kode_mata_kuliah,nama_mata_kuliah FROM makul WHERE mata_kuliah_id = ?")->execute($_GET['makul']));
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
                                Entri Data Nilai Semester
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form method='POST' action='modul/mod_nilai/aksi_nilai.php?mod=nilai_semester&act=input'>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>Program Studi : </td>
                                        <td><input type='hidden' name='sms' value='<?php echo "$data_mhs[semester]";?>'> <?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]"; ?>
                                        	<input type='hidden' name='kelas' value='<?php echo"$_GET[kelas]";?>'>
                                        	<input type='hidden' name='prodi' value='<?php echo"$_GET[prodi]";?>'>
                                        	<input type='hidden' name='makul' value='<?php echo"$_GET[makul]";?>'></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas/Semester</td>
                                        <td><?php echo "$data_mhs[nama_kelas] - $data_mhs[semester]"; ?><input type='hidden' name='kelas_id' value='<?php echo"$data_mhs[kelas_id]";?>'></td>
                                    </tr>
                                    <tr>
                                    	<td>Mata Kuliah</td>
                                    	<td><?php echo "$data_makul[kode_mata_kuliah] - $data_makul[nama_mata_kuliah]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Dosen</td>
                                    	<td><?php echo "$data_mhs[nama_dosen] $data_mhs[gelar]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Ruang</td>
                                    	<td><?php echo "$data_mhs[nama_ruang]"; ?></td>
                                    	<!-- <td><?php echo "$_GET[makul]";?></td>
                                    	<td><?php echo "$kelas[0]";?></td>
                                    	<td><?php echo "$kelas[2]";?></td>
                                    	<td><?php echo "$kelas[1]";?></td> -->
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        
                     
                            <h5 class="pvr-header">
                                
                            </h5>
                            <table id="example" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
							        <th>NIM</th>
							        <th>Nama Mahasiswa</th>
							        <th>Absensi (20%)</th>
									<th>Tugas (15%)</th>
									<th>UTS (25%)</th>
									<th>UAS (40%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
									$i = 1;
								$sql_data = $db->database_prepare("SELECT * FROM jadwal_kuliah A INNER JOIN krs B ON B.jadwal_id=A.jadwal_id
											INNER JOIN kelas C ON C.kelas_id=A.kelas_id
											INNER JOIN angkatan D ON C.angkatan_id=C.angkatan_id
											INNER JOIN mahasiswa E ON E.id_mhs=B.id_mhs
											WHERE 	A.makul_id=? AND
													A.kelas_id=? AND 
													C.angkatan_id = ? AND
													A.semester = ? GROUP BY B.id_mhs")->execute($_GET['makul'],$kelas[0],$kelas[2],$kelas[1]);
								while ($data_data = $db->database_fetch_array($sql_data)){
									$nums = $db->database_num_rows($db->database_prepare("SELECT * FROM nilai_semester_mhs WHERE id_mhs = ? AND makul_id = ? AND kelas_id = ? ")->execute($data_data["id_mhs"],$_GET["makul"],$kelas[0]));
									
									if ($nums == 0){
										$abs_hadir = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE jadwal_id = ? AND id_mhs = ? AND paraf = 'H'")->execute($data_data['jadwal_id'],$data_data['id_mhs']));
										$abs_total = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE jadwal_id = ? AND id_mhs = ?")->execute($data_data['jadwal_id'],$data_data['id_mhs']));
										$nilai_abs = number_format(($abs_hadir / $abs_total) * 20,2);

										echo "<tr>
												<td>$i</td>
												<td>$data_data[nim] <input type='hidden' name='id_mhs[]' value='$data_data[id_mhs]'></td>
												<td>$data_data[nama_mahasiswa]</td>
												<td><input type='text' required class='form-control' name='absensi[]' size='5' value='$nilai_abs' DISABLED><input type='hidden' name='absensi[]' size='5' value='$nilai_abs'></td>
												<td><input type='text' required class='form-control' name='tugas[]' value='0' size='5'></td>
												<td><input type='text' required name='uts[]' class='form-control' value='0' size='5'></td>
												<td><input type='text' required name='uas[]' class='form-control'  value='0' size='5'></td>
											</tr>";
											}
												$i++;
											}
									?>            
                                </tbody>
                                
                            </table>
                            <?php if ($nums == 0){
								echo "<div>
										<button type='submit' class='btn btn-primary'>Simpan Nilai</button>
									</div>"; }else{
										echo "<div>
										<button type='submit' class='btn btn-primary'>Simpan Nilai</button>
									</div>";
									} ?>
						</form>
                        </div>
                    </div>
                 </div>   
    </div>
    <?php
	break;
	
	case "preview":
	$kelas = explode("*", $_GET['kelas']);
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM jadwal_kuliah A INNER JOIN kelas B ON A.kelas_id=B.kelas_id
														INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id 
														INNER JOIN prodi D ON D.prodi_id=B.prodi_id
														INNER JOIN dosen E ON E.dosen_id=A.dosen_id
														INNER JOIN ruang F ON F.ruang_id=A.ruang_id
														WHERE 	A.makul_id=? AND
																A.kelas_id=? AND
																B.angkatan_id = ? LIMIT 1")->execute($_GET['makul'],$kelas[0],$kelas[2]));
	$data_makul = $db->database_fetch_array($db->database_prepare("SELECT kode_mata_kuliah,nama_mata_kuliah FROM makul WHERE mata_kuliah_id = ?")->execute($_GET['makul']));
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
	echo "
	<div class='content'>
        <div class='row'>
			<div class='col-lg-12'>
                    <div class='pvr-wrapper'>
                        <div class='pvr-box'>
                            <h5 class='pvr-header'>
                                Hasil Entri Data Nilai Semester
                                <div class='pvr-box-controls'>
                                    <i class='material-icons' data-box='refresh' data-effect='win8_linear'>refresh</i>
                                    <i class='material-icons' data-box='fullscreen'>fullscreen</i>
                                </div>
                            </h5>
                            <div class='table-responsive'>
                                <table class='table table-striped'>
                                    <tbody>
                                    <tr>
                                        <td>Program Studi </td>
                                        <td>$kd_jenjang_studi - $data_mhs[nama_prodi] <input type='hidden' name='kelas' value='$_GET[kelas]'><input type='hidden' name='prodi' value='$_GET[prodi]'><input type='hidden' name='makul' value='$_GET[makul]'>
										</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas/Semester</td>
                                        <td>$data_mhs[nama_kelas] - $data_mhs[semester] <input type='hidden' name='kelas_id' value='$data_mhs[kelas_id]'></td>
                                    </tr>
                                    <tr>
                                    	<td>Mata Kuliah</td>
                                    	<td>$data_makul[kode_mata_kuliah] - $data_makul[nama_mata_kuliah]</td>
                                    </tr>
                                    <tr>
                                    	<td>Dosen</td>
                                    	<td>$data_mhs[nama_dosen] $data_mhs[gelar]</td>
                                    </tr>
                                    <tr>
                                    	<td>Ruang</td>
                                    	<td>$data_mhs[nama_ruang]</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
              				<h5 class='pvr-header'>
                                
                            </h5>
			<table class='table table-striped' id='example'>
				<thead>
				<tr>
					<th>No</th>
					<th>NIM</th>
					<th>Nama Mahasiswa</th>
					<th>Absensi (20%)</th>
					<th>Tugas (15%)</th>
					<th>UTS (25%)</th>
					<th>UAS (40%)</th>
					<th>Total</th>
					<th>Nilai</th>
					<th>Bobot</th> 
				</tr>
				</thead></tbody>";
				$i = 1;
				$sql_data = $db->database_prepare("SELECT * FROM nilai_semester_mhs A 
															INNER JOIN kelas B ON B.kelas_id=A.kelas_id
															INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id
															INNER JOIN mahasiswa D ON D.id_mhs=A.id_mhs
															WHERE 	A.makul_id=? AND
																	A.kelas_id=? AND
																	C.angkatan_id = ?")->execute($_GET['makul'],$kelas[0],$kelas[2]);
				while ($data_data = $db->database_fetch_array($sql_data)){
					
					$abs_hadir = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE jadwal_id = ? AND id_mhs = ? AND paraf = 'H'")->execute($data_mhs['jadwal_id'],$data_data['id_mhs']));
					$abs_total = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE jadwal_id = ? AND id_mhs = ?")->execute($data_mhs['jadwal_id'],$data_data['id_mhs']));
					$nilai_abs = ($abs_hadir / $abs_total) * 20;
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
						$mutu = "D";
						$bobot = "1";
					}
					elseif ($nilai >= 45 AND $nilai <= 49.9){
						$mutu = "D-";
						$bobot = "1";
					}
					elseif ($nilai < 44){
						$mutu = "E";
						$bobot = "0";
					}
				echo "<tr>
						<td>$i</td>
						<td>$data_data[nim]</td>
						<td>$data_data[nama_mahasiswa]</td>
						<td>$data_data[absensi]</td>
						<td>$data_data[tugas]</td>
						<td>$data_data[uts]</td>
						<td>$data_data[uas]</td>
						<td>$data_data[total]</td>
						<td>$mutu</td>
						<td>$bobot</td>
					</tr>";
				$i++;
			}
		echo "</tbody></table>

		<div>
			<a href='index.php?mod=nilai_semester'><button type='button' class='btn btn-primary'>Keluar</button></a>
		</div>
	</div>
	</div>
    </div>";
	break;
	
	case "update_nilai":
	$kelas = explode("*", $_GET['kelas']);
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM jadwal_kuliah A INNER JOIN kelas B ON A.kelas_id=B.kelas_id
														INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id 
														INNER JOIN prodi D ON D.prodi_id=B.prodi_id
														INNER JOIN dosen E ON E.dosen_id=A.dosen_id
														INNER JOIN ruang F ON F.ruang_id=A.ruang_id
														WHERE 	A.makul_id=? AND
																A.kelas_id=? AND
																B.angkatan_id = ? LIMIT 1")->execute($_GET['makul'],$kelas[0],$kelas[2]));
	$data_makul = $db->database_fetch_array($db->database_prepare("SELECT kode_mata_kuliah,nama_mata_kuliah FROM makul WHERE mata_kuliah_id = ?")->execute($_GET['makul']));
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
	echo "
	<div class='content'>
        <div class='row'>
			<div class='col-lg-12'>
                    <div class='pvr-wrapper'>
                        <div class='pvr-box'>
                            <h5 class='pvr-header'>
                                Data Nilai Semester
                                <div class='pvr-box-controls'>
                                    <i class='material-icons' data-box='refresh' data-effect='win8_linear'>refresh</i>
                                    <i class='material-icons' data-box='fullscreen'>fullscreen</i>
                                </div> 
                            </h5>
                            <form method='POST' action='modul/mod_nilai/aksi_nilai.php?mod=nilai_semester&act=update''>
                            <div class='table-responsive'>
                                <table class='table table-striped'>
                                    <tbody>
                                    <tr>
                                        <td>Program Studi </td>
                                        <td>$kd_jenjang_studi - $data_mhs[nama_prodi] <input type='hidden' name='kelas' value='$_GET[kelas]'><input type='hidden' name='prodi' value='$_GET[prodi]'><input type='hidden' name='makul' value='$_GET[makul]'>
										</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas/Semester</td>
                                        <td>$data_mhs[nama_kelas] - $data_mhs[semester] <input type='hidden' name='kelas_id' value='$data_mhs[kelas_id]'></td>
                                    </tr>
                                    <tr>
                                    	<td>Mata Kuliah</td>
                                    	<td>$data_makul[kode_mata_kuliah] - $data_makul[nama_mata_kuliah]</td>
                                    </tr>
                                    <tr>
                                    	<td>Dosen</td>
                                    	<td>$data_mhs[nama_dosen] $data_mhs[gelar]</td>
                                    </tr>
                                    <tr>
                                    	<td>Ruang</td>
                                    	<td>$data_mhs[nama_ruang]</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        
                    	<h5 class='pvr-header'>
                                
                        </h5>
			
			<table id='example' class='table table-striped table-bordered nowrap' width='100%'>
				<thead>
				<tr>
					<th>No</th>
					<th>NIM</th>
					<th>Nama Mahasiswa</th>
					<th>Absensi (20%)</th>
					<th>Tugas (15%)</th>
					<th>UTS (25%)</th>
					<th>UAS (40%)</th>
					<th>Total</th>
					<th>Nilai</th>
					<th>Bobot</th>
				</tr>
				</thead></tbody>";
				$j = 1;
			$sql_data = $db->database_prepare("SELECT * FROM nilai_semester_mhs A 
														INNER JOIN kelas B ON B.kelas_id=A.kelas_id
														INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id
														INNER JOIN mahasiswa D ON D.id_mhs=A.id_mhs
														WHERE 	A.makul_id=? AND
																A.kelas_id=? AND
																C.angkatan_id = ? ORDER BY D.NIM ASC")->execute($_GET['makul'],$kelas[0],$kelas[2]);
			while ($data_data = $db->database_fetch_array($sql_data)){
				$abs_hadir = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE jadwal_id = ? AND id_mhs = ? AND paraf = 'H'")->execute($data_mhs['jadwal_id'],$data_data['id_mhs']));
				$abs_total = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE jadwal_id = ? AND id_mhs = ?")->execute($data_mhs['jadwal_id'],$data_data['id_mhs']));
				$nilai_abs = ($abs_hadir / $abs_total) * 20;
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
						$mutu = "D";
						$bobot = "1";
					}
					elseif ($nilai >= 45 AND $nilai <= 49.9){
						$mutu = "D-";
						$bobot = "1";
					}
					elseif ($nilai < 44){
						$mutu = "E";
						$bobot = "0";
					}
				
				echo "<tr>
						<td>$j</td>
						<td>$data_data[nim] <input type='hidden' name='nilai_id[]' value='$data_data[nilai_id]'></td>
						<td>$data_data[nama_mahasiswa]</td>
						<td><input type='text' class='form-control' name='absensi[]' value='$nilai_abs' size='5' DISABLED><input type='hidden' name='absensi[]' value='$nilai_abs' size='5'></td>
						<td><input type='text' class='form-control' name='tugas[]' value='$data_data[tugas]' size='5'></td>
						<td><input type='text' class='form-control' name='uts[]' value='$data_data[uts]' size='5'></td>
						<td><input type='text' class='form-control' name='uas[]' value='$data_data[uas]' size='5'></td>
						<td><input type='text' class='form-control' name='total[]' value='$data_data[total]' size='5' DISABLED></td>
						<td><input type='text' class='form-control' name='mutu[]' value='$mutu' size='5' DISABLED></td>
						<td><input type='text' class='form-control' name='bobot[]' value='$bobot' size='5' DISABLED></td>
					</tr>";
				$j++;
			}
		echo "</tbody></table>
		<div>
			<button type='submit' class='btn btn-primary'><i class='icon-save'></i> Simpan Perubahan</button>
		</div>
	</form>
	</div>
	</div>
    </div>";
	break;
}
?>