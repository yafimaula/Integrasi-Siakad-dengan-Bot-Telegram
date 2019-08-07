<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Pembayaran Mahasiswa Berhasil Disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Pembayaran Mahasiswa Berhasil Diubah.</p>
	</div> 
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Pembayaran Mahasiswa Berhasil Dihapus.</p>
	</div>
<?php
}
?>
<script type='text/javascript' src='../js/jquery.validate.js'></script>
		
<?php
switch($_GET['act']){
	default:
?>
	<div class="content">
    	<div class="row"> 
			<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box horizontal-form">
                            <h5 class="pvr-header">
                                Daftar Biaya Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form class="form-inline" action="" method="GET" />
                            <input type="hidden" name="mod" value="biaya_mahasiswa">
							<input type="hidden" name="act" value="biodata">
                                <div class="form-group m-r-10">
                                    <select name="program_studi" class="form-control">
                                    	<option value="">- Program Studi -</option>
										<?php
										$sql_fks = $db->database_prepare("SELECT * FROM fakultas")->execute();
										while ($data_fks = $db->database_fetch_array($sql_fks)){
											$sql_prodi = $db->database_prepare("SELECT jenjang_studi_id,prodi_id,nama_prodi FROM prodi WHERE fakultas_id = ? AND status = 'A'")->execute($data_fks["fakultas_id"]);
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
												echo "<option value=$data_prodi[prodi_id]>$kd_jenjang_studi $data_fks[nama_fak] - $data_prodi[nama_prodi]</option>";
											}
										}
										?>
                                    </select>
                                </div>
                                <div class="form-group m-r-10">
                                    <input type="text" class="form-control" name="nim" id="exampleInputPassword2" placeholder="Masukkan nim Mahasiswa" />
                                </div>
                                <button type="submit" class="btn btn-purple m-b-0 m-r-10">Search</button>
                            </form>
                        </div>
                    </div>
    		</div>
    	</div>
    </div>
<?php

	break;
	
	case "biodata":
	if ($_GET["program_studi"] == "" && $_GET["nim"] == ""){
	?>
	<div class="content">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                               Data Semua Mahasiswa - Semua Program Studi
                            </h5>
                             
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Program Studi</th>
									<th>NIM</th>
									<th>Nama Mahasiswa</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								$no = 1;
								$sql_mhs = $db->database_prepare("SELECT A.kode_program_studi,B.jenjang_studi_id, B.nama_prodi, A.id_mhs, A.nim, A.nama_mahasiswa, A.jenis_kelamin, A.program, A.email, A.status_mahasiswa
																	FROM mahasiswa A LEFT JOIN prodi B ON A.kode_program_studi = B.prodi_id
																	ORDER BY A.kode_program_studi, A.nim ASC")->execute();
								while ($data_mhs = $db->database_fetch_array($sql_mhs)){
									$data_semester = $db->database_fetch_array($db->database_prepare("SELECT semester FROM akun_biaya INNER JOIN mst_biaya ON mst_biaya.mst_biaya_id=akun_biaya.mst_biaya_id 
										WHERE mst_biaya.prodi_id = ? AND akun_biaya.aktif = 'A' ORDER BY akun_id DESC LIMIT 1")->execute($data_mhs["kode_program_studi"]));
									$status_a = $db->database_prepare("SELECT 	A.tahun_angkatan,
																				A.angkatan_id,
																				C.semester,
																				D.biaya_id
																		FROM angkatan A INNER JOIN mst_biaya B ON B.angkatan_id=A.angkatan_id
																		INNER JOIN akun_biaya C ON C.mst_biaya_id=B.mst_biaya_id
																		INNER JOIN biaya_kuliah D ON D.akun_id=C.akun_id
																		WHERE D.id_mhs = ? ORDER BY D.biaya_id DESC LIMIT 1")->execute($data_mhs["id_mhs"]);
									$status_b = $db->database_num_rows($status_a);
									$data_status = $db->database_fetch_array($status_a);
									if ($data_semester['semester'] > $data_status['semester']){
										$tambah_biaya = "<a href='?mod=biaya_mahasiswa&act=add&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]'>Tambah</a>";
										$status_biaya = "";
									}
									else{
										$tambah_biaya = "";
										$status_biaya = $data_status['tahun_angkatan']." - ".$data_status['semester'];
									}
									
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
									
									if ($data_mhs['program'] == 'R'){
										$program = "Reguler";
									}
									else{
										$program = "Non-Reguler";
									}
									
									if ($data_mhs['status_mahasiswa'] == 'A'){
										$status = "Aktif";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'C'){
										$status = "Cuti";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'D'){
										$status = "Drop-out";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'L'){
										$status = "Lulus";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'K'){
										$status = "Keluar";
									}
									else{
										$status = "Non-Aktif";
									}
									echo "
									<tr>
										<td>$no</td>
										<td>$kd_jenjang_studi - $data_mhs[nama_prodi]</td>
										<td>$data_mhs[nim]</td>
										<td>$data_mhs[nama_mahasiswa]</td>
										<td>
											<a href='?mod=biaya_mahasiswa&act=edit&bid=$data_status[biaya_id]&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]&ang_id=$data_status[angkatan_id]&sms=$data_status[semester]' class='btn btn-purple btn-sm' >Open</a>
										</td> 
									</tr>";
									$no++;
								} 
								?>            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php
	}

	elseif ($_GET["program_studi"] != "" && $_GET["nim"] == ""){
		$data_prodi = $db->database_fetch_array($db->database_prepare("SELECT jenjang_studi_id,nama_prodi FROM prodi WHERE prodi_id = ?")->execute($_GET["program_studi"]));
		if ($data_prodi['jenjang_studi_id'] == 'A'){
			$kd_prodi = "S3";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'B'){
			$kd_prodi = "S2";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'C'){
			$kd_prodi = "S1";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'D'){
			$kd_prodi = "D4";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'E'){
			$kd_prodi = "D3";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'F'){
			$kd_prodi = "D2";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'G'){
			$kd_prodi = "D1";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'H'){
			$kd_prodi = "Sp-1";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'I'){
			$kd_prodi = "Sp-2";
		}
		else{
			$kd_prodi = "Profesi";
		}
	?>
	
	<div class="content">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                                Data Semua Mahasiswa<br>
								<?php echo $kd_prodi." - ".$data_prodi['nama_prodi']; ?>
                            </h5>
                             
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Program Studi</th>
									<th>NIM</th>
									<th>Nama Mahasiswa</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								$no = 1;          
								$sql_mhs = $db->database_prepare("SELECT A.kode_program_studi,B.jenjang_studi_id, B.nama_prodi, A.id_mhs, A.nim, A.nama_mahasiswa, A.jenis_kelamin, A.program, A.email, A.status_mahasiswa
																	FROM mahasiswa A LEFT JOIN prodi B ON A.kode_program_studi = B.prodi_id
																	WHERE A.kode_program_studi = ?
																	ORDER BY A.kode_program_studi, A.nim ASC")->execute($_GET["program_studi"]);
								while ($data_mhs = $db->database_fetch_array($sql_mhs)){
									$data_semester = $db->database_fetch_array($db->database_prepare("SELECT semester FROM akun_biaya INNER JOIN mst_biaya ON mst_biaya.mst_biaya_id=akun_biaya.mst_biaya_id 
										WHERE mst_biaya.prodi_id = ? AND akun_biaya.aktif = 'A' ORDER BY akun_id DESC LIMIT 1")->execute($data_mhs["kode_program_studi"]));
									$status_a = $db->database_prepare("SELECT A.tahun_angkatan,
																				A.angkatan_id,
																				C.semester,
																				D.biaya_id
																			FROM angkatan A INNER JOIN mst_biaya B ON B.angkatan_id=A.angkatan_id
																			INNER JOIN akun_biaya C ON C.mst_biaya_id=B.mst_biaya_id
																			INNER JOIN biaya_kuliah D ON D.akun_id=C.akun_id
																			WHERE D.id_mhs = ? ORDER BY D.biaya_id DESC LIMIT 1")->execute($data_mhs["id_mhs"]);
									$status_b = $db->database_num_rows($status_a);
									$data_status = $db->database_fetch_array($status_a);
									if ($data_semester['semester'] > $data_status['semester']){
										$tambah_biaya = "<a href='?mod=biaya_mahasiswa&act=add&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]'>Tambah</a> ";
										$status_biaya = "";
									}
									else{
										$tambah_biaya = "";
										$status_biaya = $data_status['tahun_angkatan']." - ".$data_status['semester'];
									}
									
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
									
									if ($data_mhs['program'] == 'R'){
										$program = "Reguler";
									}
									else{
										$program = "Non-Reguler";
									}
									
									if ($data_mhs['status_mahasiswa'] == 'A'){
										$status = "Aktif";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'C'){
										$status = "Cuti";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'D'){
										$status = "Drop-out";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'L'){
										$status = "Lulus";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'K'){
										$status = "Keluar";
									}
									else{
										$status = "Non-Aktif";
									}
									echo "
									<tr>
										<td>$no</td>
										<td>$kd_jenjang_studi - $data_mhs[nama_prodi]</td>
										<td>$data_mhs[nim]</td>
										<td>$data_mhs[nama_mahasiswa]</td>
										<td>
											<a title='Ubah' href='?mod=biaya_mahasiswa&act=edit&bid=$data_status[biaya_id]&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]&ang_id=$data_status[angkatan_id]&sms=$data_status[semester]' class='btn btn-purple btn-sm'>Open</a></td>
									</tr>";
									$no++;
								} 
								?>            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php
	}

	else{
		$data_prodi = $db->database_fetch_array($db->database_prepare("SELECT jenjang_studi_id,nama_prodi FROM prodi WHERE prodi_id = ?")->execute($_GET["program_studi"]));
		if ($data_prodi['jenjang_studi_id'] == 'A'){
			$kd_prodi = "S3";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'B'){
			$kd_prodi = "S2";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'C'){
			$kd_prodi = "S1";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'D'){
			$kd_prodi = "D4";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'E'){
			$kd_prodi = "D3";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'F'){
			$kd_prodi = "D2";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'G'){
			$kd_prodi = "D1";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'H'){
			$kd_prodi = "Sp-1";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'I'){
			$kd_prodi = "Sp-2";
		}
		elseif ($data_prodi['jenjang_studi_id'] == 'J'){
			$kd_prodi = "Profesi";
		}
	?>
	<div class="content">
            <div class="row"> 
                <div class="col-lg-12"> 
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                                Data Mahasiswa
                            </h5>
                             
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Program Studi</th>
									<th>NIM</th>
									<th>Nama Mahasiswa</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								$no = 1;          
								$sql_mhs = $db->database_prepare("SELECT A.kode_program_studi,B.jenjang_studi_id, B.nama_prodi, A.id_mhs, A.nim, A.nama_mahasiswa, A.jenis_kelamin, A.program, A.email, A.status_mahasiswa
																FROM mahasiswa A LEFT JOIN prodi B ON A.kode_program_studi = B.prodi_id
																WHERE A.kode_program_studi = ? AND A.nim = ?
																ORDER BY A.kode_program_studi, A.nim ASC")->execute($_GET["program_studi"],$_GET["nim"]);
								while ($data_mhs = $db->database_fetch_array($sql_mhs)){
									$data_semester = $db->database_fetch_array($db->database_prepare("SELECT semester FROM akun_biaya INNER JOIN mst_biaya ON mst_biaya.mst_biaya_id=akun_biaya.mst_biaya_id 
										WHERE mst_biaya.prodi_id = ? AND akun_biaya.aktif = 'A' ORDER BY akun_id DESC LIMIT 1")->execute($data_mhs["kode_program_studi"]));
									$status_a = $db->database_prepare("SELECT 	A.tahun_angkatan,
																				A.angkatan_id,
																				C.semester,
																				D.biaya_id
																		FROM angkatan A INNER JOIN mst_biaya B ON B.angkatan_id=A.angkatan_id
																		INNER JOIN akun_biaya C ON C.mst_biaya_id=B.mst_biaya_id
																		INNER JOIN biaya_kuliah D ON D.akun_id=C.akun_id
																		WHERE D.id_mhs = ? ORDER BY D.biaya_id DESC LIMIT 1")->execute($data_mhs["id_mhs"]);
									$status_b = $db->database_num_rows($status_a);
									$data_status = $db->database_fetch_array($status_a);
									if ($data_semester['semester'] > $data_status['semester']){
										$tambah_biaya = "<a href='?mod=biaya_mahasiswa&act=add&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]'>Tambah</a> ";
										$status_biaya = "";
									}
									else{
										$tambah_biaya = "";
										$status_biaya = $data_status['tahun_angkatan']." - ".$data_status['semester'];
									}
									
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
									elseif ($data_mhs['jenjang_studi_id'] == 'J'){
										$kd_jenjang_studi = "Profesi";
									}
									
									if ($data_mhs['program'] == 'R'){
										$program = "Reguler";
									}
									else{
										$program = "Non-Reguler";
									}
									
									if ($data_mhs['status_mahasiswa'] == 'A'){
										$status = "Aktif";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'C'){
										$status = "Cuti";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'D'){
										$status = "Drop-out";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'L'){
										$status = "Lulus";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'K'){
										$status = "Keluar";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'N'){
										$status = "Non-Aktif";
									}
				
									echo "
									<tr>
										<td>$no</td>
										<td>$kd_jenjang_studi - $data_mhs[nama_prodi]</td>
										<td>$data_mhs[nim]</td>
										<td>$data_mhs[nama_mahasiswa]</td>
										<td>
											<a href='?mod=biaya_mahasiswa&act=edit&bid=$data_status[biaya_id]&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]&ang_id=$data_status[angkatan_id]&sms=$data_status[semester]' class='btn btn-purple btn-sm'>Open</a></td>
									</tr>";
									$no++;
								} 
								?>            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	
	<?php
	}
	break;
	
	case "add":
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT m . * , a.tahun_angkatan, a.semester_angkatan as semester FROM mahasiswa m JOIN angkatan a ON a.`angkatan_id` = m.`angkatan_id` WHERE id_mhs = ?")->execute($_GET["id"]));
	$data_prodi = $db->database_fetch_array($db->database_prepare("SELECT jenjang_studi_id,nama_prodi FROM prodi WHERE prodi_id = ?")->execute($data_mhs["kode_program_studi"]));
	if ($data_mhs['semester'] == '1'){
		$semester = "Ganjil";
	}
	else{
		$semester = "Genap";
	}
	
	if ($data_mhs['status_mahasiswa'] == 'A'){
		$status_mahasiswa = "Aktif";
	}
	elseif ($data_mhs['status_mahasiswa'] == 'C'){
		$status_mahasiswa = "Cuti";
	}
	elseif ($data_mhs['status_mahasiswa'] == 'D'){
		$status_mahasiswa = "Drop-out";
	}
	elseif ($data_mhs['status_mahasiswa'] == 'L'){
		$status_mahasiswa = "Lulus";
	}
	elseif ($data_mhs['status_mahasiswa'] == 'K'){
		$status_mahasiswa = "keluar";
	}
	else{
		$status_mahasiswa = "Non-aktif";
	}
	
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
    ?>

    <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Biaya Kuliah
                            </h5>
                            <form method='POST' action='modul/mod_biaya/aksi_biaya_mahasiswa.php?mod=biaya_mahasiswa&act=input'>
                            <input type="hidden" name="kode_program_studi" value="<?php echo $_GET['prodi']; ?>">
							<input type="hidden" name="prodi" value="<?php echo $_GET['program_studi']; ?>">
							<input type="hidden" name="id_mhs" value="<?php echo $_GET['id']; ?>">
							<input type="hidden" name="nim" value="<?php echo $_GET['nim']; ?>">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>NIM </td>
                                        <td><?php echo $data_mhs['nim']; ?>
										</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td><?php echo $data_mhs['nama_mahasiswa']; ?> / <?php echo $data_mhs['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Tahun Masuk</td>
                                    	<td><?php echo $data_mhs['tahun_masuk']; ?> - <?php echo $semester; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Program Studi</td>
                                    	<td><?php echo $kd_jenjang_studi." - ".$data_prodi['nama_prodi']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Status</td>
                                    	<td><?php echo $status_mahasiswa; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
    <?php
		if ($data_mhs['program'] == 'R'){
				$program = "A";
		}
		else{
				$program = "B";
		}
		$sql_biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan,C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A 
												INNER JOIN mst_biaya B ON A.mst_biaya_id=B.mst_biaya_id
												INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id
												WHERE B.prodi_id = ? AND A.aktif = 'A' AND A.program = ?")->execute($data_mhs['kode_program_studi'],$program);
		$nums = $db->database_num_rows($sql_biaya);
		if ($nums == 0){?>
			<div class="col-xl-12 col-sm-12 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body ">
                                <div class="row" >
                                    <div class="col-12">
                                    	<font color="=ff0000">
                                        <h6 class="mt-1 mb-0">Mohon Maaf !!! Pembiayaan Belum Tersedia Untuk Saat Ini.</h6>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
		<?php
		}
		else{
			
		$data_biaya = $db->database_fetch_array($sql_biaya);
		if ($data_biaya['semester_angkatan'] == '1'){
			$sem = "Ganjil";
		}
		else{
			$sem = "Genap";
	}?>
    <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                <?php echo "Tahun Angkatan: $data_biaya[tahun_angkatan] - $sem <br>Semester : $data_biaya[semester]</h5>"; ?>
                            </h5>
                            <form method='POST' action='modul/mod_biaya/aksi_biaya_mahasiswa.php?mod=biaya_mahasiswa&act=input'>
                            <input type="hidden" name="akun_id" value="<?php echo $data_biaya['akun_id']; ?>">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>Nama Biaya </td>
                                        <td><input type="text" class="form-control" name="nama_biaya" maxlength="30" value="<?php echo $data_biaya['nama_biaya']; ?>">
										</td>
                                    </tr>
                                    <tr>
                                        <td>Nominal</td>
                                        <td><input type="text" class="form-control" name="biaya" maxlength="30" value="<?php echo $data_biaya['biaya']; ?>"></td>
                                    </tr>
                                    <tr>
                                    	<td>Keterangan</td>
                                    	<td><textarea name="keterangan" class="form-control" cols="40" rows="5"></textarea></td>
                                    </tr>
                                    <?php
									if ($nums > 0){ 
									?>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-purple">Simpan</button>
                            </div>
                        </div>
                    </div>
    </div>
	<?php
	}
	?>
	</form>
    <?php
			}
	
	break;
	
	case "edit":
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT m . * , a.tahun_angkatan as tahun, a.semester_angkatan as semester FROM mahasiswa m JOIN angkatan a ON a.`angkatan_id` = m.`angkatan_id` WHERE id_mhs = ?")->execute($_GET["id"]));
	$data_prodi = $db->database_fetch_array($db->database_prepare("SELECT jenjang_studi_id,nama_prodi FROM prodi WHERE prodi_id = ?")->execute($data_mhs["kode_program_studi"]));
	if ($data_mhs['program'] == 'R'){
    $program = "Reguler";
	}else{
	    $program = "Non-Reguler";
	}
	if ($data_mhs['semester'] == '1'){
		$semester = "Ganjil";
	}
	else{
		$semester = "Genap";
	}
	
	if ($data_mhs['status_mahasiswa'] == 'A'){
		$status_mahasiswa = "Aktif";
	}
	elseif ($data_mhs['status_mahasiswa'] == 'C'){
		$status_mahasiswa = "Cuti";
	}
	elseif ($data_mhs['status_mahasiswa'] == 'D'){
		$status_mahasiswa = "Drop-out";
	}
	elseif ($data_mhs['status_mahasiswa'] == 'L'){
		$status_mahasiswa = "Lulus";
	}
	elseif ($data_mhs['status_mahasiswa'] == 'K'){
		$status_mahasiswa = "keluar";
	}
	else{
		$status_mahasiswa = "Non-aktif";
	}
	
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
?>
	<div class="content">
            <div class="row"> 
				<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                               Form Pembayaran Kuliah
                            </h5>
                            <input type="hidden" name="kode_program_studi" value="<?php echo $_GET['prodi_id']; ?>">
							<input type="hidden" name="prodi" value="<?php echo $_GET['program_studi']; ?>">
							<input type="hidden" name="nim" value="<?php echo $_GET['nim']; ?>">
							<input type="hidden" name="id" value="<?php echo $_GET['bid']; ?>">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>NIM </td>
                                        <td><?php echo $data_mhs['nim']; ?>
										</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td><?php echo $data_mhs['nama_mahasiswa']; ?> / <?php echo $data_mhs['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Angkatan</td>
                                    	<td><?php echo $data_mhs['tahun']; ?> - <?php echo $semester; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Program Studi</td>
                                    	<td><?php echo $kd_jenjang_studi." - ".$data_prodi['nama_prodi']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Status / Program</td>
                                      	<td><?php echo $status_mahasiswa." / ".$program;?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
    <?php
		if ($data_mhs['program'] == 'R'){
				$program = "A";
		}
		else{
				$program = "B";
		}
		$sql_biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan,C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A 
			INNER JOIN mst_biaya B ON A.mst_biaya_id=B.mst_biaya_id
			INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id
			INNER JOIN mahasiswa D ON D.angkatan_id = B.angkatan_id
			WHERE B.prodi_id = ? AND A.aktif = 'A' AND A.program = ? AND D.angkatan_id = ? AND D.id_mhs = ?")->execute($data_mhs['kode_program_studi'],$program, $data_mhs['angkatan_id'], $_GET["id"] );
		$nums = $db->database_num_rows($sql_biaya);
		if ($nums == 0){
			?>
			<div class="col-xl-12 col-sm-12 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body ">
                                <div class="row" >
                                    <div class="col-12">
                                    	<font color="=ff0000">
                                        <h6 class="mt-1 mb-0">Mohon Maaf !!! Pembiayaan Belum Tersedia Untuk Saat Ini.</h6>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

		<?php
		}
		else{
		$data_biaya = $db->database_fetch_array($sql_biaya);
		if ($data_biaya['semester_angkatan'] == '1'){
			$sem = "Ganjil";
		}
		else{
			$sem = "Genap";
	}?>
    <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Akun Biaya
                            </h5>
                            <form method='POST' action='modul/mod_biaya/aksi_biaya_mahasiswa.php?mod=biaya_mahasiswa&act=input'>
                            <input type="hidden" name="akun_id" value="<?php echo $data_biaya['akun_id']; ?>">
                            <input type="hidden" name="id_mhs" value="<?php echo $_GET['id']; ?>">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                	<thead>
	                                <tr>
	                                	<th>Tahun Angkatan</th>
	                                	<th>Semester</th>
										<th>Nama Biaya</th>
										<th>Nominal</th>
	                                </tr>
	                                </thead>
	                                <?php
	                                $skripsi = $db->database_prepare("SELECT A.`jadwal_id` FROM  `jadwal_kuliah` A JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`nama_mata_kuliah` =  'Skripsi' AND C.id_mhs = ? ")->execute($_GET["id"]);	// TAMPILKAN SKRIPSI
	                                $jumskrip = $db->database_num_rows($skripsi);
	                                if ($jumskrip == 0) { // IF TIDAK SKRIPSI
	                                	$mka = $db->database_prepare("SELECT A.`jadwal_id` FROM  `jadwal_kuliah` A  JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`jenis_mata_kuliah` =  'C' AND C.id_mhs = ?")->execute($_GET["id"]);	
		                                $jumka = $db->database_num_rows($mka);
		                                $mka_array = $db->database_fetch_array($mka);
		                                $nama_mka = $mka_array['jadwal_id'];
		                                if ($jumka == 0) { //TIDAK SKRIPSI +TIDAK MKA
		                                	$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                } else {
		                                	?><input type="hidden" name="" value="<?php echo $nama_mka ; ?>"><?php
		                                	if ($nama_mka == '217') { // MKA MULTIMED
		                                		$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                	}elseif ($nama_mka == '222') { //NO SKRIPSI TP MELU MKA BISNIS MODERN
		                                		$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` ))AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                	}elseif ($nama_mka == '219') { // NO SKRIPSI TAPI MKA ECO
		                                		$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, C.angkatan_id, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                	}elseif ($nama_mka == '225') { // NO SKRIPSI TP MKA EDU
		                                		$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                	}
		                                	
		                                }
		                                
		                                
	                                } else { // JIKA SKRIPSI
	                                	$mka = $db->database_prepare("SELECT A.`jadwal_id` FROM  `jadwal_kuliah` A  JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`jenis_mata_kuliah` =  'C' AND C.id_mhs = ?")->execute($_GET["id"]);	
		                                $jumka = $db->database_num_rows($mka);
		                                $mka_array = $db->database_fetch_array($mka);
		                                $nama_mka = $mka_array['jadwal_id'];
		                                if ($jumka == 0) { // SKRIPSI TOK NO MKA
		                                	$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan,C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id=B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM `akun_biaya` WHERE nama_biaya LIKE 'MKA%') AND B.prodi_id = ? AND A.aktif = 'A' AND A.program = ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
			                                while ($data = $db->database_fetch_array($biaya)){
			                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
											}
											?>
		                                    </tbody>
		                                    <tfoot>
		                                    	<tr>
		                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
		                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
		                                		</tr>
		                                    </tfoot><?php // MKA APA
		                                }else{
		                                	?> 
		                                	<input type="hidden" name="" value="<?php echo $nama_mka ; ?>"> <?php
		                                	if ($nama_mka == '217') { // SKRIPSI + MKA MULTIMED
		                                		$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                	}elseif ($nama_mka == '222') { // SKRIPSI + MKA BISNIS MODERN
		                                		$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                	}elseif ($nama_mka == '219') { // SKRIPSI + MKA ECOTOURISM
		                                		$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, C.angkatan_id, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                	}elseif ($nama_mka == '225') { // SKRIPSI + MKA EDUWISATA
		                                		$biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
				                                while ($data = $db->database_fetch_array($biaya)){
				                                echo "
				                                <tbody>
				                                    <tr>
				                                    	<td>$data[tahun_angkatan]</td>
														<td>$data[semester]</td>
														<td>$data[nama_biaya]</td>
														<td>$data[biaya]</td>
				                                    </tr>";
			                                    $jumlah += $data['biaya'];
												}
												?>
			                                    </tbody>
			                                    <tfoot>
			                                    	<tr>
			                                			<td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
			                                			<td>Rp. <?php echo number_format($jumlah); ?></td>
			                                		</tr>
			                                    </tfoot><?php
		                                	}
		                                } 
	                                }
	                                
	                                ?>
	                                
                               </table>
                            </div>
                            <br>
                            <h5 class="pvr-header">
                                Bayar Kuliah
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>Nominal Pembayaran</td>
                                        <td><input type="text" class="form-control" name="biaya" maxlength="30" ></td>
                                    </tr>
                                    <tr>
                                    	<td>Keterangan</td>
                                    	<td><textarea name="keterangan" class="form-control" cols="40" rows="5"></textarea></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-purple">Simpan</button>
                        </div>
                        </div>
                    </div>
    </div>
    
	</form>
    <?php
			}

	
	?>

	<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Biaya Kuliah a.n <?php echo $data_mhs['nama_mahasiswa']; ?>
                            </h5>
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
									<th>Nominal</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
	                            $no = 1;
								$sql_biaya = $db->database_prepare("SELECT * FROM biaya_kuliah WHERE id_mhs = ? ORDER BY biaya_id DESC")->execute($_GET["id"]);
								while ($data_biaya = $db->database_fetch_array($sql_biaya)){
									$nomi=number_format($data_biaya['biaya']);
                                    echo "<tr>
											<td>$no</td>
											<td>$data_biaya[keterangan]</td>
											<td>$nomi</td>
											<td><a title='Ubah' href='?mod=biaya_mahasiswa&act=ganti&id=$data_biaya[biaya_id]&mhs=$_GET[id]'><i class='fa fa-pencil-square-o'></i> </a> |";
											?>
												<a title='Hapus' href='modul/mod_biaya/aksi_biaya_mahasiswa.php?mod=biaya_mahasiswa&act=delete&id=<?php echo "$data_biaya[biaya_id]"?>' onclick="return confirm('Anda Yakin ingin menghapus data biaya <?php echo $data_biaya[keterangan]." ".$nomi;?>?');"><i class='fa fa-trash'></i></a>
											<?php
											echo "</td>
										</tr>";
                                    $no++;
                                    $telah += $data_biaya['biaya'];
                                }
									$kurang = $telah-$jumlah;
                                  ?>     
                                </tbody>
                                <tfoot>
                                	<tr>
                                		<td colspan="2"><b>Jumlah Yang Sudah Dibayar</b></td>
                                		<td colspan="2"><?php echo number_format($telah); ?></td>
                                	</tr>
                                	<tr>
                                		<td colspan="2"><b>Jumlah Yang Harus Dibayar</b></td>
                                		<td colspan="2"><?php echo number_format($jumlah); ?></td>
                                	</tr>
                                	<tr>
                                		<td colspan="2"><b>Sisa Bayar</b></td>
                                		<td colspan="2"><b><?php echo number_format($kurang); ?></b></td>
                                	</tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
    </div>
	<?php
	break;

	case 'ganti':
		
	$biaya_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM biaya_kuliah WHERE biaya_id = ? AND id_mhs = ? ")->execute($_GET['id'],$_GET["mhs"]));
	?>
		
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Edit Pembayaran
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_biaya/aksi_biaya_mahasiswa.php?mod=biaya_mahasiswa&act=update" method="POST" />
                                <fieldset>
                                  <input type="text" name="id" value="<?php echo $biaya_mhs[biaya_id]; ?>">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nominal Pembayaran</label>
                                        <input type="text" class="form-control" name="biaya" maxlength="30" value="<?php echo $biaya_mhs['biaya']; ?>">
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Keterangan</label>
                                          <textarea name="keterangan" class="form-control" cols="40" rows="5"><?php echo $biaya_mhs['keterangan']; ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" onclick="window.location.href='?mod=biaya_mahasiswa'" class="btn btn-default">Cancel</button>
                                </fieldset>
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