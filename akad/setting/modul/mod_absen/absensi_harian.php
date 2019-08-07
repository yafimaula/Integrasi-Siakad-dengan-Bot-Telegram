<?php  
if ($_GET['code'] == 1){
?>
<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data absensi Mahasiswa berhasil ditambahkan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data absensi Mahasiswa berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data absensi Mahasiswa berhasil dihapus.</p>
	</div>
<?php
}
if ($_GET['code'] == 4){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-ban'></i>Failed!</h5>
		<p>Absensi mahasiswa gagal disimpan, absensi sudah pernah disimpan pada tanggal ini sebelumnya</p>
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
		
		$("#prodi4").change(function(){
			var prodi4 = $("#prodi4").val();
			$.ajax({
				url: "modul/mod_absen/ambil_kelas4.php",
				data: "prodi4="+prodi4,
				cache: false,
				success: function(msg){
					$("#kelas4").html(msg);
				}
			});
		});
		
		$("#kelas4").change(function(){
			var kelas4 = $("#kelas4").val();
			$.ajax({
				url: "modul/mod_absen/ambil_makul4.php",
				data: "kelas4="+kelas4,
				cache: false,
				success: function(msg){
					$("#makul4").html(msg);
				}
			});
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
                                Absensi Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <div class="bd-example bd-example-tabs" role="tabpanel">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">Entri Absensi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="false">Buka/Update Absensi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="laporan-tab" data-toggle="tab" href="#laporan" role="tab" aria-controls="laporan" aria-expanded="false">Laporan Kumulatif Absensi</a>
                                    </li>
                                </ul>
                             <div class="tab-content" id="myTabContent">
                                 <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="true">
                                    <form method="GET">
                                        <input type='hidden' name='mod' value='absensi_harian'>
										<input type='hidden' name='act' value='entri'>
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
                                          <select name="makul2" id="makul" class="form-control">
                                          	<option value=''></option>
                                          	
                                          </select>
                                       </div>
                                       <button type="submit" class="btn btn-purple m-r-5">Open Data</button>
                                    </form>
                                  </div>
                                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                                     <form method="GET">
                                        <input type='hidden' name='mod' value='absensi_harian'>
										<input type='hidden' name='act' value='buka'>
										<div class="form-group">
                                          <label for="exampleInputEmail4">Tanggal Absensi</label>
                                          <input type='date' class="form-control" name='tgl' id='datepicker' style='margin: 5px;'>
                                       </div>
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
                                          <select name="makul2" id='makul2' class="form-control">
                                          	<option value=''></option>
                                          </select>
                                       </div>
                                       <button type="submit" class="btn btn-purple m-r-5">Open Data</button>
                                    </form>
                                  </div>
                                  <div class="tab-pane fade" id="laporan" role="tabpanel" aria-labelledby="laporan-tab" aria-expanded="false">
                                     <form method="GET">
                                        <input type='hidden' name='mod' value='absensi_harian'>
										<input type='hidden' name='act' value='laporan'>
										
										<div class="form-group">
                                          <label for="exampleInputEmail4">Program Studi</label>
                                          <select name="prodi" id='prodi4' class="form-control">
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
                                          <select name="kelas" id='kelas4' class="form-control">
                                          	<option value=''></option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Mata Kuliah</label>
                                          <select name="makul4" id='makul4' class="form-control">
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
	
	
	case "buka":
	$kelas = explode("*", $_GET['kelas']);
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM jadwal_kuliah A INNER JOIN kelas B ON A.kelas_id=B.kelas_id
														INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id 
														INNER JOIN prodi D ON D.prodi_id=B.prodi_id
														INNER JOIN dosen E ON E.dosen_id=A.dosen_id
														INNER JOIN ruang F ON F.ruang_id=A.ruang_id
														WHERE 	A.makul_id=? AND
																A.kelas_id=? AND
																B.angkatan_id = ? LIMIT 1")->execute($_GET['makul2'],$kelas[0],$kelas[2]));
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
	$tgl_absensi = $_GET['tgl'];
	$data_makul = $db->database_fetch_array($db->database_prepare("SELECT kode_mata_kuliah,nama_mata_kuliah FROM makul WHERE mata_kuliah_id = ?")->execute($_GET["makul2"]));
	?>
	<div class="content">
        <div class="row">
			<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Ubah Data Absensi
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form method='POST' action='modul/mod_absen/aksi_absen.php?mod=absensi_harian&act=update'>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>Program Studi </td>
                                        <td><input type='hidden' value='<?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]";?>'> <?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]"; ?>
                                        	<input type='hidden' name='kelas' value='<?php echo "$_GET[kelas]";?>'>
											<input type='hidden' name='prodi' value='<?php echo "$_GET[prodi]";?>'>
											<input type='hidden' name='makul2' value='<?php echo "$_GET[makul2]";?>'>
										</td>
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
                                    </tr>
                                    <tr>
                                    	<td>Tanggal Absensi</td>
                                    	<td><input type='text' class="form-control" name='tgl_absen' id='datepicker' value='<?php echo "$tgl_absensi"; ?>'></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        
                    
                            <h5 class="pvr-header">
                               
                            </h5>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th width='30'>No</th>
									<th width='100'>NIM</th>
									<th width='250'>Nama Mahasiswa</th>
									<th>Paraf</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
									$z = 1;
								$sql_data = $db->database_prepare("SELECT * FROM absensi_mhs A INNER JOIN jadwal_kuliah B ON A.jadwal_id=B.jadwal_id
												INNER JOIN kelas C ON C.kelas_id=B.kelas_id
												INNER JOIN angkatan D ON D.angkatan_id=C.angkatan_id
												INNER JOIN mahasiswa E ON E.id_mhs=A.id_mhs
												WHERE
												B.makul_id = ? AND
												B.kelas_id = ? AND
												D.angkatan_id = ? AND
												A.tanggal_absen = ?")->execute($_GET['makul2'],$kelas[0],$kelas[2],$_GET["tgl"]);
								$nol = $db->database_num_rows($sql_data);
								while ($data_data = $db->database_fetch_array($sql_data)){
									if ($data_data['paraf'] == 'H'){
										$h = "SELECTED";
									}
									else{
										$h = "";
									}
									
									if ($data_data['paraf'] == 'A'){
										$a = "SELECTED";
									}
									else{
										$a = "";
									}
									
									if ($data_data['paraf'] == 'I'){
										$i = "SELECTED";
									}
									else{
										$i = "";
									}
									
									if ($data_data['paraf'] == 'S'){
										$s = "SELECTED";
									}
									else{
										$s = "";
									}
										echo "<tr>
												<td>$z</td>
												<td>$data_data[nim] 
													<input type='hidden' name='id_absensi[]' value='$data_data[absensi_id]'>
													<input type='hidden' name='id_mhs[]' value='$data_data[id_mhs]'>
													<input type='hidden' name='jadwal_id[]' value='$data_data[jadwal_id]'>
													<input type='hidden' name='semester[]' value='$data_data[semester]'>
													<input type='hidden' name='kelas' value='$_GET[kelas]'>
													<input type='hidden' name='makul2' value='$_GET[makul2]'>
													<input type='hidden' name='tgl' value='$_GET[tgl]'>
													<input type='hidden' name='prodi' value='$_GET[prodi]'>
												</td>
												<td>$data_data[nama_mahasiswa]</td>
												<td><select class='form-control' name='paraf[]'>
													<option value='H' $h>Hadir</option>
													<option value='A' $a>Alpha</option>
													<option value='S' $s>Sakit</option>
													<option value='I' $i>Izin</option></select>
												</td>
											</tr>";
											$z++;
											}
									?>            
                                </tbody>
                            </table>
                            <?php
                            if ($nol == 0) {
                            	echo "<div>
										<button type='submit' class='btn btn-secondary' disabled>Simpan Perubahan</button>
									</div>";
                            }else{
								echo "<div>
										<button type='submit' class='btn btn-primary'>Simpan Perubahan</button>
									</div>"; 
                            }
                            ?>
						</form>
                        </div>
                    </div>
    			</div>
    	</div>
    </div>


	<?php
	break;
	
	case "entri";
	$kelas = explode("*", $_GET['kelas']);
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM jadwal_kuliah A INNER JOIN kelas B ON A.kelas_id=B.kelas_id
														INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id 
														INNER JOIN prodi D ON D.prodi_id=B.prodi_id
														INNER JOIN dosen E ON E.dosen_id=A.dosen_id
														INNER JOIN ruang F ON F.ruang_id=A.ruang_id
														WHERE 	A.makul_id=? AND
																A.kelas_id=? AND
																B.angkatan_id = ? LIMIT 1")->execute($_GET['makul2'],$kelas[0],$kelas[2]));
	$data_makul = $db->database_fetch_array($db->database_prepare("SELECT kode_mata_kuliah, nama_mata_kuliah FROM makul WHERE mata_kuliah_id = ?")->execute($_GET["makul2"]));
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
	$date = date('Y-m-d');
	?>
	<div class="content">
        <div class="row">
				<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Entri Data Absensi
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form method='POST' action='modul/mod_absen/aksi_absen.php?mod=absensi_harian&act=input'>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>Program Studi </td>
                                        <td><input type='hidden' name='sms' value='<?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]";?>'> <?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]"; ?>
                                        	<input type='hidden' name='kelas' value='<?php echo "$_GET[kelas]";?>'>
											<input type='hidden' name='prodi' value='<?php echo "$_GET[prodi]";?>'>
											<input type='hidden' name='makul2' value='<?php echo "$_GET[makul2]";?>'>
										</td>
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
                                    </tr>
                                    <tr>
                                    	<td>Tanggal Absensi</td>
                                    	<td><input type='text' class="form-control" name='tgl_absen' id='datepicker' value='<?php echo "$date"; ?>'></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
		                            <h5 class="pvr-header">
		                            </h5>
		                            <table id="example" class="table table-striped table-bordered nowrap" width="100%">
		                                <thead>
		                                <tr>
		                                    <th width='30'>No</th>
											<th width='100'>NIM</th>
											<th width='250'>Nama Mahasiswa</th>
											<th>Paraf</th>
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
																		A.semester = ? GROUP BY B.id_mhs")->execute($_GET['makul2'],$kelas[0],$kelas[2],$kelas[1]);
										while ($data_data = $db->database_fetch_array($sql_data)){
												echo "<tr>
														<td>$i</td>
														<td>$data_data[nim] <input type='hidden' name='id_mhs[]' value='$data_data[id_mhs]'><input type='hidden' name='jadwal' value='$data_data[jadwal_id]'><input type='hidden' name='jadwal_id[]' value='$data_data[jadwal_id]'><input type='hidden' name='semester[]' value='$data_data[semester]'></td>
														<td>$data_data[nama_mahasiswa]</td>
														<td><select class='form-control' name='paraf[]'>
															<option value='H'>Hadir</option>
															<option value='A'>Alpha</option>
															<option value='S'>Sakit</option>
															<option value='I'>Izin</option></select>
														</td>
													</tr>";
													$i++;
													}
											?>            
		                                </tbody>
		                            </table>
		                            <?php 
										echo "<div>
												<button type='submit' class='btn btn-primary'>Simpan Absensi</button>
											</div>"; ?>
								</form>
		                </div>
		            </div>
		        </div>
		</div>
	</div>
		
	<?php
break;
	
case "laporan";
	$kelas = explode("*", $_GET['kelas']);
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM jadwal_kuliah A INNER JOIN kelas B ON A.kelas_id=B.kelas_id
														INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id 
														INNER JOIN prodi D ON D.prodi_id=B.prodi_id
														INNER JOIN dosen E ON E.dosen_id=A.dosen_id
														INNER JOIN ruang F ON F.ruang_id=A.ruang_id
														INNER JOIN makul G ON A.makul_id=G.mata_kuliah_id
														WHERE 	A.makul_id=? AND
																A.kelas_id=? AND
																B.angkatan_id = ? LIMIT 1")->execute($_GET['makul4'],$kelas[0],$kelas[2]));
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
                                Laporan Data Absensi
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form method='POST' action='modul/mod_absen/aksi_absen.php?mod=absensi_harian&act=input'>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>Program Studi </td>
                                        <td><?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]"; ?>
                                        <input type='hidden' name='kelas' value='<?php echo "$_GET[kelas]";?>'>
                                        <input type='hidden' name='prodi' value='<?php echo "$_GET[prodi]";?>'>
                                        <input type='hidden' name='makul2' value='<?php echo "$_GET[makul2]";?>'>
										</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas/Semester</td>
                                        <td><?php echo "$data_mhs[nama_kelas] - $data_mhs[semester]"; ?><input type='hidden' name='kelas_id' value='<?php echo"$data_mhs[kelas_id]";?>'></td>
                                    </tr>
                                    <tr>
                                    	<td>Mata Kuliah</td>
                                    	<td><?php echo "$data_mhs[kode_mata_kuliah] - $data_mhs[nama_mata_kuliah]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Dosen</td>
                                    	<td><?php echo "$data_mhs[nama_dosen] $data_mhs[gelar]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Ruang</td>
                                    	<td><?php echo "$data_mhs[nama_ruang]"; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="pvr-header">
                            </h5>
                            <table id="data-table" class="table table-striped table-bordered" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>NIM</th>
									<th>Nama Mahasiswa</th>
									<th>Hadir</th>
									<th>Alpha</th>
									<th>Izin</th>
									<th>Sakit</th>
									<th>Total &nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								$j = 1;
								$sql_data = $db->database_prepare("SELECT * FROM absensi_mhs A INNER JOIN jadwal_kuliah B ON A.jadwal_id=B.jadwal_id
																	INNER JOIN kelas C ON C.kelas_id=B.kelas_id
																	INNER JOIN angkatan D ON D.angkatan_id=C.angkatan_id
																	INNER JOIN mahasiswa E ON E.id_mhs=A.id_mhs
																	WHERE
																	B.makul_id = ? AND
																	B.kelas_id = ? AND
																	D.angkatan_id = ? GROUP BY A.id_mhs, A.jadwal_id")->execute($_GET['makul4'],$kelas[0],$kelas[2]);
								while ($data_data = $db->database_fetch_array($sql_data)){
									$numsH = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE id_mhs = ? AND jadwal_id = ? AND paraf = ?")->execute($data_data['id_mhs'],$data_data['jadwal_id'],'H'));
									$numsA = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE id_mhs = ? AND jadwal_id = ? AND paraf = ?")->execute($data_data['id_mhs'],$data_data['jadwal_id'],'A'));
									$numsI = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE id_mhs = ? AND jadwal_id = ? AND paraf = ?")->execute($data_data['id_mhs'],$data_data['jadwal_id'],'I'));
									$numsS = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs WHERE id_mhs = ? AND jadwal_id = ? AND paraf = ?")->execute($data_data['id_mhs'],$data_data['jadwal_id'],'S'));
									$nums = $db->database_num_rows($db->database_prepare("SELECT * FROM absensi_mhs A INNER JOIN jadwal_kuliah B ON A.jadwal_id=B.jadwal_id
														INNER JOIN kelas C ON C.kelas_id=B.kelas_id
														INNER JOIN angkatan D ON D.angkatan_id=C.angkatan_id
														INNER JOIN mahasiswa E ON E.id_mhs=A.id_mhs
														WHERE B.makul_id = ? AND
															  B.kelas_id = ? AND
															  D.angkatan_id = ? AND
															  A.id_mhs = ?")->execute($_GET['makul4'],$kelas[0],$kelas[2],$data_data['id_mhs']));
									if ($data_data['paraf'] == 'H'){
										$paraf = "Hadir";
									}
									elseif($data_data['paraf'] == 'A'){
										$paraf = "Alpha";
									}
									elseif($data_data['paraf'] == 'I'){
										$paraf = "Izin";
									}
									elseif($data_data['paraf'] == 'S'){
										$paraf = "Sakit";
									}
										echo "<tr>
												<td>$j</td>
												<td>$data_data[nim]</td>
												<td>$data_data[nama_mahasiswa]</td>
												<td><b>$numsH</b></td>
												<td><b>$numsA</b></td>
												<td><b>$numsI</b></td>
												<td><b>$numsS</b></td>
												<td><b>$nums</b></td>
											</tr>";
											$j++;
											}
									?>            
                                </tbody>
                            </table>
						</form>
                        </div>
                    </div>
    			</div>
    		</div>
    </div>

	<?php
break;
	

}
?>