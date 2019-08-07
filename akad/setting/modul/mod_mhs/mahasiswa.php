<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Mahasiswa Baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Mahasiswa berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Mahasiswa berhasil dihapus.</p>
	</div>
<?php
}

if ($_GET['code'] == 4){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Mahasiswa berhasil di Upload.</p>
	</div>
<?php
}

if ($_GET['code'] == 5){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-ban'></i>Error!</h5>
		<p>Data Mahasiswa gagal di Upload.</p>
	</div>
<?php
}

?>

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
                                Cari Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5> 
                            <button type="button" onclick="window.location.href='?mod=mhs&act=addprodi'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Mahasiswa</button> 
                            <button type="button" onclick="window.location.href='?mod=mhs&act=upload'" class="btn btn-success" > <i class="fa fa-plus-square"></i>Tambah Mahasiswa (Upload)</button> 
                             <p></p>
	                          <form class="form-inline" action="" method="GET" />
	                            <input type="hidden" name="mod" value="mhs">
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
                                    <input type="text" class="form-control" name="nim" id="exampleInputPassword2" placeholder="NIM Mahasiswa" />
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
	<!--Begin Content-->
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
									<th>JK</th>
									<th>Program</th>
									<th>Status</th>
									<th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								$no = 1;
								$sql_mhs = $db->database_prepare("SELECT B.jenjang_studi_id, B.nama_prodi, A.id_mhs, A.nim, A.nama_mahasiswa, A.jenis_kelamin, A.program, A.email, A.status_mahasiswa
																	FROM mahasiswa A LEFT JOIN prodi B ON A.kode_program_studi = B.prodi_id
																	ORDER BY A.kode_program_studi, A.nim ASC")->execute();
								while ($data_mhs = $db->database_fetch_array($sql_mhs)){
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
										$status = "<span class='badge-success badge'>Aktif</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'C'){
										$status = "<span class='badge' data-color='purple'>Cuti</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'D'){
										$status = "<span class='badge-danger badge'>Drop-out</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'L'){
										$status = "<span class='badge badge-warning'>Lulus</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'K'){
										$status = "<span class='badge' data-color='azure'>Keluar</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'N'){
										$status = "<span class='badge badge-secondary'>Non-Aktif</span>";
									}
									
									echo "
									<tr>
										<td>$no</td>
										<td>$kd_jenjang_studi - $data_mhs[nama_prodi]</td>
										<td>$data_mhs[nim]</td>
										<td>$data_mhs[nama_mahasiswa]</td>
										<td>$data_mhs[jenis_kelamin]</td>
										<td>$program</td>
										<td>$status</td>
										<td><a title = 'Ubah Data Mahasiswa' href='?mod=mhs&act=edit&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]'><i class='fa fa-pencil-square-o'></i></a> |";
										?>
										<a title='Hapus Data Mahasiswa' href='modul/mod_mhs/aksi_mahasiswa.php?mod=mhs&act=delete&id=<?php echo "$data_mhs[id_mhs]";?>&program_studi=<?php echo "$_GET[program_studi]";?>&nim=<?php echo "$_GET[nim]";?>' onclick="return confirm('Anda Yakin ingin menghapus mahasiswa <?php echo $data_mhs[nama_mahasiswa];?>?');"><i class='fa fa-trash'></i></a>
											
										<?php
										echo "</td>
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
        <!--End Content-->
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
	<!--Begin Content-->
        <div class="content">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                                Data Semua Mahasiswa
                            </h5>
                             
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Program Studi</th>
									<th>NIM</th>
									<th>Nama Mahasiswa</th>
									<th>JK</th>
									<th>Program</th>
									<th>Status</th>
									<th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								$no = 1;
								$sql_mhs = $db->database_prepare("SELECT B.jenjang_studi_id, B.nama_prodi, A.id_mhs, A.nim, A.nama_mahasiswa, A.jenis_kelamin, A.program, A.email, A.status_mahasiswa
																	FROM mahasiswa A LEFT JOIN prodi B ON A.kode_program_studi = B.prodi_id
																	WHERE A.kode_program_studi = ?
																	ORDER BY A.kode_program_studi, A.nim ASC")->execute($_GET["program_studi"]);
								while ($data_mhs = $db->database_fetch_array($sql_mhs)){
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
										$status = "<span class='badge-success badge'>Aktif</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'C'){
										$status = "<span class='badge' data-color='purple'>Cuti</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'D'){
										$status = "<span class='badge-danger badge'>Drop-out</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'L'){
										$status = "<span class='badge badge-warning'>Lulus</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'K'){
										$status = "<span class='badge' data-color='azure'>Keluar</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'N'){
										$status = "<span class='badge badge-secondary'>Non-Aktif</span>";
									}
									
									echo "
									<tr>
										<td>$no</td>
										<td>$kd_jenjang_studi - $data_mhs[nama_prodi]</td>
										<td>$data_mhs[nim]</td>
										<td>$data_mhs[nama_mahasiswa]</td>
										<td>$data_mhs[jenis_kelamin]</td>
										<td>$program</td>
										<td>$status</td>
										<td><a title = 'Ubah' href='?mod=mhs&act=edit&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]'><i class='fa fa-pencil-square-o'></i></a> |";
										?>
										<a title='Hapus Data Mahasiswa' href='modul/mod_mhs/aksi_mahasiswa.php?mod=mhs&act=delete&id=<?php echo "$data_mhs[id_mhs]";?>&program_studi=<?php echo "$_GET[program_studi]";?>&nim=<?php echo "$_GET[nim]";?>' onclick="return confirm('Anda Yakin ingin menghapus mahasiswa <?php echo $data_mhs[nama_mahasiswa];?>?');"><i class='fa fa-trash'></i></a>
										<?php
										echo "</td>
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
        <!--End Content-->
	<?php
	}

	elseif ($_GET["program_studi"] = "" OR $_GET["nim"] !== ""){
		$data_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM mahasiswa WHERE nim = ?")->execute($_GET["nim"]));
	?>
	<!--Begin Content-->
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
									<th>JK</th>
									<th>Program</th>
									<th>Status</th>
									<th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								$no = 1;
								$sql_mhs = $db->database_prepare("SELECT B.jenjang_studi_id, B.nama_prodi, A.id_mhs, A.nim, A.nama_mahasiswa, A.jenis_kelamin, A.program, A.email, A.status_mahasiswa
																	FROM mahasiswa A LEFT JOIN prodi B ON A.kode_program_studi = B.prodi_id
																	WHERE A.nim = ?
																	ORDER BY A.kode_program_studi, A.nim ASC")->execute($_GET["nim"]);
								while ($data_mhs = $db->database_fetch_array($sql_mhs)){
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
										$status = "<span class='badge-success badge'>Aktif</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'C'){
										$status = "<span class='badge' data-color='purple'>Cuti</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'D'){
										$status = "<span class='badge-danger badge'>Drop-out</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'L'){
										$status = "<span class='badge badge-warning'>Lulus</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'K'){
										$status = "<span class='badge' data-color='azure'>Keluar</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'N'){
										$status = "<span class='badge badge-secondary'>Non-Aktif</span>";
									}
									
									echo "
									<tr>
										<td>$no</td>
										<td>$kd_jenjang_studi - $data_mhs[nama_prodi]</td>
										<td>$data_mhs[nim]</td>
										<td>$data_mhs[nama_mahasiswa]</td>
										<td>$data_mhs[jenis_kelamin]</td>
										<td>$program</td>
										<td>$status</td>
										<td><a title = 'Ubah' href='?mod=mhs&act=edit&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]'><i class='fa fa-pencil-square-o'></i></a> |";
										?>
										<a title='Hapus Data Mahasiswa' href='modul/mod_mhs/aksi_mahasiswa.php?mod=mhs&act=delete&id=<?php echo "$data_mhs[id_mhs]";?>&program_studi=<?php echo "$_GET[program_studi]";?>&nim=<?php echo "$_GET[nim]";?>' onclick="return confirm('Anda Yakin ingin menghapus mahasiswa <?php echo $data_mhs[nama_mahasiswa];?>?');"><i class='fa fa-trash'></i></a>
										<?php
										echo "</td>
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
        <!--End Content-->
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
		else{
			$kd_prodi = "Profesi";
		}
	?>
	
	<!--Begin Content-->
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
									<th>JK</th>
									<th>Program</th>
									<th>Status</th>
									<th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								$no = 1;
								$sql_mhs = $db->database_prepare("SELECT B.jenjang_studi_id, B.nama_prodi, A.id_mhs, A.nim, A.nama_mahasiswa, A.jenis_kelamin, A.program, A.email, A.status_mahasiswa
																	FROM mahasiswa A LEFT JOIN prodi B ON A.kode_program_studi = B.prodi_id
																	WHERE A.kode_program_studi = ? AND A.nim = ? 
																	ORDER BY A.kode_program_studi, A.nim ASC")->execute($_GET["program_studi"],$_GET["nim"]);
								while ($data_mhs = $db->database_fetch_array($sql_mhs)){
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
										$kelas = "Reguler";
									}
									else{
										$kelas = "Non-Reguler";
									}
									
									if ($data_mhs['status_mahasiswa'] == 'A'){
										$status = "<span class='badge-success badge'>Aktif</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'C'){
										$status = "<span class='badge' data-color='purple'>Cuti</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'D'){
										$status = "<span class='badge-danger badge'>Drop-out</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'L'){
										$status = "<span class='badge badge-warning'>Lulus</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'K'){
										$status = "<span class='badge' data-color='azure'>Keluar</span>";
									}
									elseif ($data_mhs['status_mahasiswa'] == 'N'){
										$status = "<span class='badge badge-secondary'>Non-Aktif</span>";
									}
									
									echo "
									<tr>
										<td>$no</td>
										<td>$kd_jenjang_studi - $data_mhs[nama_prodi]</td>
										<td>$data_mhs[nim]</td>
										<td>$data_mhs[nama_mahasiswa]</td>
										<td>$data_mhs[jenis_kelamin]</td>
										<td>$kelas</td>
										<td>$status</td>
										<td><a title = 'Ubah' href='?mod=mhs&act=edit&id=$data_mhs[id_mhs]&program_studi=$_GET[program_studi]&nim=$_GET[nim]'><i class='fa fa-pencil-square-o'></i></a> |";
										?>
										<a title='Hapus Data Mahasiswa' href='modul/mod_mhs/aksi_mahasiswa.php?mod=mhs&act=delete&id=<?php echo "$data_mhs[id_mhs]";?>&program_studi=<?php echo "$_GET[program_studi]";?>&nim=<?php echo "$_GET[nim]";?>' onclick="return confirm('Anda Yakin ingin menghapus mahasiswa <?php echo $data_mhs[nama_mahasiswa];?>?');"><i class='fa fa-trash'></i></a>
										<?php
										echo "</td>
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
        <!--End Content-->
	<?php
	}
	break;
	
	
	case "addprodi":
	?>
	<div class="content">
            <div class="row">
				<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box horizontal-form">
                            <h5 class="pvr-header">
                                Tambah Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            
                            <form class="form-inline" action="" method="GET" />
                            <input type="hidden" name="mod" value="mhs">
							<input type="hidden" name="act" value="add">
                                <div class="form-group m-r-10">
                                    <select name="prodi" class="form-control">
                                    	<option value="">- Pilih Program Studi -</option>
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
                                <button type="submit" class="btn btn-purple m-b-0 m-r-10">Next</button>
                            </form>
                        </div>
                    </div>
    			</div>
    		</div>
    </div>
	<?php
	break;
	
	case "upload":
	echo "
	<div class='content'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='pvr-wrapper'>
                        <div class='pvr-box'>
                            <h5 class='pvr-header'>
                                Upload Data Mahasiswa 
                                <div class='pvr-box-controls'>
                                    <i class='material-icons' data-box='refresh' data-effect='win8_linear'>refresh</i>
                                    <i class='material-icons' data-box='fullscreen'>fullscreen</i>
                                </div>
                            </h5>
                            <form action='modul/mod_mhs/aksi_mahasiswa.php?mod=mhs&act=upload' enctype='multipart/form-data' method='POST' />
                                <fieldset>
                                    <div class='form-group'>
                                        <label for='exampleInputEmail4'>Format Upload File</label>
                                        <a href='modul/mod_mhs/upload_akad.xlsx'  class='form-control'><button type='button' class='btn btn-green' >Download</button></a>
                                    </div>
                                    <div class='form-group'>
                                          <label for='exampleInputEmail4'>Upload File</label>
                                          <input type='file' name='file' class='form-control'>
                                    </div>
                                    <button type='submit' class='btn btn-purple m-r-5'>Save</button>";?>
                                    <button type='button' class='btn btn-default' onclick="window.location.href='?mod=mhs'">Cancel</button>
                                    <?php
                                    echo "
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		";
	break;
	
	case "add":

	$tahun = date("Y");
	$ambil_tahun=substr($tahun, 2);
	$sql_urut = $db->database_prepare("SELECT m.nim, f.fakultas_id FROM mahasiswa m JOIN prodi p ON p.prodi_id = m.kode_program_studi JOIN fakultas f ON f.fakultas_id = p.fakultas_id WHERE m.kode_program_studi = ? ORDER BY nim DESC  LIMIT 1")->execute($_GET["prodi"]);
	$num_urut = $db->database_num_rows($sql_urut);

	
	
	$jprodi = strlen($_GET["prodi"]);
	if ($jprodi == 1){
		$jprodi = $_GET["prodi"];
	}
	else{
		$jprodi = $_GET["prodi"];
	}
	
	$data_urut = $db->database_fetch_array($sql_urut);
	$awal = substr($data_urut['nim'],1-4);
	$next = $awal + 1;
	$jnim = strlen($next);

	//$ganjil=$data_urut['fakultas_id'];
	$ganjil='1';
	
	if (!$data_urut['nim']){
		$no = "001";
	}
	elseif($jnim == 1){
		$no = "00";
	} 
	elseif($jnim == 2){
		$no = "0";
	}
	elseif($jnim == 3){
		$no = "";
	}
	if ($num_urut == 0){
		$npm = $tahun.$jprodi.$no;
	}
	else{
		$npm = $jprodi.$ganjil.$ambil_tahun.$no.$next;
	}
?>
	
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_mhs/aksi_mahasiswa.php?mod=mhs&act=input" method="POST" enctype="multipart/form-data" />
                            <input type="hidden" name="kode_program_studi" value="<?php echo $_GET['prodi']; ?>">
                                <fieldset>
                                	<div class="col-md-6 offset-md-3 text-center">
                                    	<h4 class="card-title m-0">Biodata Mahasiswa
	                                        <p class="card-category">
	                                            <small>Data yang berhubungan dengan akademik mahasiswa</small>
	                                        </p>
                                    	</h4>
                                    </div>
	                               	<div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">NIM</label>
	                                        <input type="text" class="form-control" name="nim" id="exampleInputEmail4" value="<?php echo $npm; ?>" DISABLED />
                                        	<input type="hidden" name="nim" value="<?php echo $npm; ?>"></td>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Nama Mahasiswa</label>
	                                        <input type="text" class="form-control" name="nama_mahasiswa" id="exampleInputEmail4" />
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Tempat Lahir</label>
	                                        <input type="text" class="form-control" name="tempat_lahir" id="exampleInputEmail4" placeholder="Tempat lahir" />
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Tanggal Lahir</label>
	                                        <input type="date" class="form-control" name="tgl_lahir" id="exampleInputEmail4" placeholder="Tempat lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"/>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Jenis Kelamin</label>
	                                          <select name="jenis_kelamin" class="form-control">
	                                            <option value="">- None -</option>	
												<option value="L">Laki-Laki</option>
             									<option value="P">Perempuan</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Agama</label>
	                                          <select name="agama" class="form-control">
	                                            <option value="">- None -</option>	
												<option value="I">Islam</option>
									            <option value="K">Kristen</option>
									            <option value="C">Katolik</option>
									            <option value="H">Hindu</option>
									            <option value="B">Budha</option>
									            <option value="G">Kong Hu Cu</option>
									            <option value="L">Lainnya</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">No HP</label>
	                                          <input type="text" class="form-control" name="hp" placeholder="+098764235618" />
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">E-Mail</label>
	                                          <input type="text" class="form-control" name="email" placeholder="abc@gmail.com" />
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-12">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Alamat Lengkap</label>
	                                          <textarea class="form-control" rows="3" name="alamat" placeholder="JL.Anggrek no 36 Kampung Buah Kecamatan Jogoroto Kabupaten Jombang"></textarea>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Program Kuliah</label>
	                                          <select name="program" class="form-control">
	                                            <option value="">- None -</option>	
												<option value="R">Reguler</option>
              									<option value="N">Non-Reguler</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Status Mahasiswa</label>
	                                          <input type="hidden" name="status_mahasiswa" value="A">
	                                          <select name="status_mahasiswa" DISABLED class="form-control">
	                                           	<option value="A" SELECTED>Aktif</option>
									            <option value="C">Cuti</option>
									            <option value="D">Drop-out</option>
									            <option value="L">Lulus</option>
									            <option value="K">Keluar</option>
									            <option value="N">Non-Aktif</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Status Awal</label>
	                                          <select name="status_awal_mahasiswa" class="form-control">
	                                            <option value="">- None -</option>	
												<option value="R">Baru</option>
              									<option value="N">Pindahan</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Angkatan Mahasiswa</label>
	                                          <select name="angkatan_id" class="form-control">
	                                           	<option value="">- None -</option>
												<?php 
												$sql_angkatan = $db->database_prepare("SELECT * FROM angkatan WHERE status = 'A' ORDER BY angkatan_id DESC")->execute();
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
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Tanggal Masuk</label>
	                                        <input type="date" class="form-control" name="tgl_masuk_mhs" id="exampleInputEmail4"/>
	                                    </div>
	                                  </div>
	                                 <div class="col-sm-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Foto Mahasiswa</label>
                                          <input type="file" class="form-control" name="uploadfile"/>
                                       </div>
                                     </div>
	                                </div>

	                                <div class="col-md-6 offset-md-3 text-center">
	                                    <h4 class="card-title m-0">Sekolah / Insitusi Asal
	                                        <p class="card-category">
	                                            <small>Data yang berhubungan dengan sekolah atau institusi asal mahasiswa</small>
	                                        </p>
	                                    </h4>
                                    </div>
	                                
	                                <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Sekolah/Institusi Asal</label>
                                                <input class="form-control" name="sekolah_nama" placeholder="SMA NUSA CENDEKIA" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No Telp Sekolah/Institusi Asal</label>
                                                <input class="form-control" name="sekolah_telp" placeholder="+62123456789" type="text" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Jurusan Sekolah/Institusi Asal</label>
                                                <input class="form-control" name="sekolah_jurusan" placeholder="IPA/IPS/RPL/TKJ/DLL" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tahun Lulus</label>
                                                <input class="form-control" name="sekolah_tahun_lulus" placeholder="2015" type="text" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Alamat Sekolah/Institusi Asal</label>
                                                <textarea class="form-control" name="sekolah_alamat" id="exampleTextarea" rows="3"></textarea>
                                            </div>
                                        </div>
                                      </div>

                                    <div class="col-md-6 offset-md-3 text-center">
                                    	<h4 class="card-title m-0">Orang Tua / Wali
	                                        <p class="card-category">
	                                            <small>Data yang berhubungan dengan Orang Tua atau Wali mahasiswa</small>
	                                        </p>
                                    	</h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Ayah</label>
                                                <input class="form-control" name="nama_ayah" placeholder="Nama Ayah" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Ibu</label>
                                                <input class="form-control" name="nama_ibu" placeholder="Nama Ibu" type="text" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ayah</label>
                                                <select name="pekerjaan_ayah" class="form-control">
	                                                <option value="">- Tidak Bekerja -</option>	
													<option value="A">Petani</option>
													<option value="B">Nelayan</option>
													<option value="C">Peternak</option>
													<option value="D">Buruh</option>
													<option value="E">Karyawan Swasta</option>
													<option value="F">Pedagang</option>
													<option value="G">Wiraswasta</option>
													<option value="H">PNS/TNI/Polri</option>
	              									<option value="I">Pensiunan</option>
	              									<option value="J">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ibu</label>
                                                <select name="pekerjaan_ibu" class="form-control">
                                                	<option value="">- Tidak Bekerja -</option>	
													<option value="A">Petani</option>
													<option value="B">Nelayan</option>
													<option value="C">Peternak</option>
													<option value="D">Buruh</option>
													<option value="E">Karyawan Swasta</option>
													<option value="F">Pedagang</option>
													<option value="G">Wiraswasta</option>
													<option value="H">PNS/TNI/Polri</option>
	              									<option value="I">Pensiunan</option>
	              									<option value="J">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Penghasilan Ayah</label>
                                                <select class="form-control" name="penghasilan_ayah">
                                                	<option value="A">Tidak Berpenghasilan</option>
                                                	<option value="B"> < 500.000 </option>
                                                	<option value="C"> 1.000.000-2.000.000 </option>
                                                	<option value="D"> 2.000.000-5.000.000 </option>
                                                	<option value="E"> > 5.000.000 </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Penghasilan Ibu</label>
                                                <select class="form-control" name="penghasilan_ibu">
                                                	<option value="A">Tidak Berpenghasilan</option>
                                                	<option value="B"> < 500.000 </option>
                                                	<option value="C"> 1.000.000-2.000.000 </option>
                                                	<option value="D"> 2.000.000-5.000.000 </option>
                                                	<option value="E"> > 5.000.000 </option>
                                                </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>No HP Orang Tua</label>
                                                <input class="form-control" name="no_hp_ortu" placeholder="+62123456789" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=mhs'">Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
	<?php
	break;
	
	case "edit":
	$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM mahasiswa WHERE id_mhs = ?")->execute($_GET["id"]));
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Edit Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_mhs/aksi_mahasiswa.php?mod=mhs&act=update" method="POST" enctype="multipart/form-data" />
                            <input type="hidden" name="program_studi" value="<?php echo $_GET['program_studi']; ?>">
							<input type="hidden" name="nim" value="<?php echo $_GET['nim']; ?>">
							<input type="hidden" name="id" value="<?php echo $data_mhs['id_mhs']; ?>">
                                <fieldset>
                                	<div class="col-md-6 offset-md-3 text-center">
                                    	<h4 class="card-title m-0">Biodata Mahasiswa
	                                        <p class="card-category">
	                                            <small>Data yang berhubungan dengan akademik mahasiswa</small>
	                                        </p>
                                    	</h4>
                                    </div>
	                               	<div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">NIM</label>
	                                        <input type="text" class="form-control" name="nim" id="exampleInputEmail4" value="<?php echo $data_mhs['nim']; ?>" DISABLED />
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Nama Mahasiswa</label>
	                                        <input type="text" class="form-control" name="nama_mahasiswa" id="exampleInputEmail4" value="<?php echo $data_mhs['nama_mahasiswa']; ?>"/>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Tempat Lahir</label>
	                                        <input type="text" class="form-control" name="tempat_lahir" id="exampleInputEmail4" placeholder="Tempat lahir" value="<?php echo $data_mhs['tempat_lahir']; ?>"/>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Tanggal Lahir</label>
	                                        <input type="date" class="form-control" name="tgl_lahir" id="exampleInputEmail4" value="<?php echo $data_mhs['tanggal_lahir']; ?>"/>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Jenis Kelamin</label>
	                                          <select name="jenis_kelamin" class="form-control">
	                                            <option value="L" <?php if($data_mhs['jenis_kelamin'] == 'L'){ echo "SELECTED"; } ?>>Laki-Laki</option>
												<option value="P" <?php if($data_mhs['jenis_kelamin'] == 'P'){ echo "SELECTED"; } ?>>Perempuan</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Agama</label>
	                                          <select name="agama" class="form-control">
	                                            <option value="I" <?php if($data_mhs['agama'] == 'I'){ echo "SELECTED"; } ?>>Islam</option>
												<option value="K" <?php if($data_mhs['agama'] == 'K'){ echo "SELECTED"; } ?>>Kristen</option>
												<option value="C" <?php if($data_mhs['agama'] == 'C'){ echo "SELECTED"; } ?>>Katolik</option>
												<option value="H" <?php if($data_mhs['agama'] == 'H'){ echo "SELECTED"; } ?>>Hindu</option>
												<option value="B" <?php if($data_mhs['agama'] == 'B'){ echo "SELECTED"; } ?>>Budha</option>
												<option value="G" <?php if($data_mhs['agama'] == 'G'){ echo "SELECTED"; } ?>>Kong Hu Cu</option>
												<option value="L" <?php if($data_mhs['agama'] == 'L'){ echo "SELECTED"; } ?>>Lainnya</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">No HP</label>
	                                          <input type="text" class="form-control" name="hp" value="<?php echo $data_mhs['hp']; ?>" />
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">E-Mail</label>
	                                          <input type="text" class="form-control" name="email" value="<?php echo $data_mhs['email']; ?>" />
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-12">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Alamat Lengkap</label>
	                                          <textarea class="form-control" rows="3" name="alamat" ><?php echo $data_mhs['alamat']; ?></textarea>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Program Kuliah</label>
	                                          <select name="program" class="form-control">
	                                            <option value="R" <?php if($data_mhs['program'] == 'R'){ echo "SELECTED"; } ?>>Reguler</option>
												<option value="N" <?php if($data_mhs['program'] == 'N'){ echo "SELECTED"; } ?>>Non-Reguler</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Status Mahasiswa</label>
	                                          <select name="status_mahasiswa" class="form-control">
	                                           	<option value="A" <?php if($data_mhs['status_mahasiswa'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
												<option value="C" <?php if($data_mhs['status_mahasiswa'] == 'C'){ echo "SELECTED"; } ?>>Cuti</option>
												<option value="D" <?php if($data_mhs['status_mahasiswa'] == 'D'){ echo "SELECTED"; } ?>>Drop-out</option>
												<option value="L" <?php if($data_mhs['status_mahasiswa'] == 'L'){ echo "SELECTED"; } ?>>Lulus</option>
												<option value="K" <?php if($data_mhs['status_mahasiswa'] == 'K'){ echo "SELECTED"; } ?>>Keluar</option>
												<option value="N" <?php if($data_mhs['status_mahasiswa'] == 'N'){ echo "SELECTED"; } ?>>Non-Aktif</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Angkatan Mahasiswa</label>
	                                          <select name="angkatan_id" class="form-control">
												<?php 
												$sql_angkatan = $db->database_prepare("SELECT * FROM angkatan ORDER BY angkatan_id DESC")->execute();
												while ($data_angkatan = $db->database_fetch_array($sql_angkatan)){
													if ($data_angkatan['semester_angkatan'] == '1'){
														$semester = "Ganjil";
													}
													else{
														$semester = "Genap";
													}
													
													if ($data_mhs['angkatan_id'] == $data_angkatan['angkatan_id']){
														echo "<option value=$data_angkatan[angkatan_id] SELECTED>$data_angkatan[tahun_angkatan] - $semester</option>";
													}
													else{
														echo "<option value=$data_angkatan[angkatan_id]>$data_angkatan[tahun_angkatan] - $semester</option>";
													}
												}
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-4">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Tanggal Masuk</label>
	                                        <input type="date" class="form-control" name="tgl_masuk_mhs" id="exampleInputEmail4" value="<?php echo $data_mhs['tanggal_masuk']; ?>"/>
	                                    </div>
	                                  </div>
	                                 <div class="col-sm-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Foto Mahasiswa</label>
                                          <input type="file" class="form-control" name="uploadfile"/>
                                       </div>
                                     </div>
	                                </div>

	                                <div class="col-md-6 offset-md-3 text-center">
	                                    <h4 class="card-title m-0">Sekolah / Insitusi Asal
	                                        <p class="card-category">
	                                            <small>Data yang berhubungan dengan sekolah atau institusi asal mahasiswa</small>
	                                        </p>
	                                    </h4>
                                    </div>
	                                
	                                <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Sekolah Asal</label>
                                                <input class="form-control" name="sekolah_nama" value="<?php echo $data_mhs['sekolah_nama']; ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No Telp Sekolah Asal</label>
                                                <input class="form-control" name="sekolah_telp" value="<?php echo $data_mhs['sekolah_telp']; ?>" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <input class="form-control" name="sekolah_jurusan" value="<?php echo $data_mhs['sekolah_jurusan']; ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tahun Lulus</label>
                                                <input class="form-control" name="sekolah_tahun_lulus" value="<?php echo $data_mhs['sekolah_tahun_lulus']; ?>" type="text" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Alamat Sekolah Asal</label>
                                                <textarea class="form-control" name="sekolah_alamat" id="exampleTextarea" rows="3"><?php echo $data_mhs['sekolah_alamat']; ?></textarea>
                                            </div>
                                        </div>
                                      </div>

                                    <div class="col-md-6 offset-md-3 text-center">
                                    	<h4 class="card-title m-0">Orang Tua / Wali
	                                        <p class="card-category">
	                                            <small>Data yang berhubungan dengan Orang Tua atau Wali mahasiswa</small>
	                                        </p>
                                    	</h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Ayah</label>
                                                <input class="form-control" name="nama_ayah" value="<?php echo $data_mhs['nama_ayah']; ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Ibu</label>
                                                <input class="form-control" name="nama_ibu" value="<?php echo $data_mhs['nama_ibu']; ?>" type="text" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ayah</label>
                                                <select name="pekerjaan_ayah" class="form-control">
                                                	<option value="X" <?php if($data_mhs['pekerjaan_ayah'] == 'A'){ echo "SELECTED"; } ?>>Tidak Bekerja</option>
													<option value="A" <?php if($data_mhs['pekerjaan_ayah'] == 'A'){ echo "SELECTED"; } ?>>Petani</option>
													<option value="B" <?php if($data_mhs['pekerjaan_ayah'] == 'B'){ echo "SELECTED"; } ?>>Nelayan</option>
													<option value="C" <?php if($data_mhs['pekerjaan_ayah'] == 'C'){ echo "SELECTED"; } ?>>Peternak</option>
													<option value="D" <?php if($data_mhs['pekerjaan_ayah'] == 'D'){ echo "SELECTED"; } ?>>Buruh</option>
													<option value="E" <?php if($data_mhs['pekerjaan_ayah'] == 'E'){ echo "SELECTED"; } ?>>Karyawan Swasta</option>
													<option value="F" <?php if($data_mhs['pekerjaan_ayah'] == 'F'){ echo "SELECTED"; } ?>>Pedagang</option>
													<option value="G" <?php if($data_mhs['pekerjaan_ayah'] == 'G'){ echo "SELECTED"; } ?>>Wiraswasta</option>
													<option value="H" <?php if($data_mhs['pekerjaan_ayah'] == 'H'){ echo "SELECTED"; } ?>>PNS/TNI/Polri</option>
	              									<option value="I" <?php if($data_mhs['pekerjaan_ayah'] == 'I'){ echo "SELECTED"; } ?>>Pensiunan</option>
	              									<option value="J" <?php if($data_mhs['pekerjaan_ayah'] == 'J'){ echo "SELECTED"; } ?>>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ibu</label>
                                                <select name="pekerjaan_ibu" class="form-control">
                                                	<option value="X" <?php if($data_mhs['pekerjaan_ibu'] == 'X'){ echo "SELECTED"; } ?>>Tidak Bekerja</option>
                                                	<option value="A" <?php if($data_mhs['pekerjaan_ibu'] == 'A'){ echo "SELECTED"; } ?>>Petani</option>
													<option value="B" <?php if($data_mhs['pekerjaan_ibu'] == 'B'){ echo "SELECTED"; } ?>>Nelayan</option>
													<option value="C" <?php if($data_mhs['pekerjaan_ibu'] == 'C'){ echo "SELECTED"; } ?>>Peternak</option>
													<option value="D" <?php if($data_mhs['pekerjaan_ibu'] == 'D'){ echo "SELECTED"; } ?>>Buruh</option>
													<option value="E" <?php if($data_mhs['pekerjaan_ibu'] == 'E'){ echo "SELECTED"; } ?>>Karyawan Swasta</option>
													<option value="F" <?php if($data_mhs['pekerjaan_ibu'] == 'F'){ echo "SELECTED"; } ?>>Pedagang</option>
													<option value="G" <?php if($data_mhs['pekerjaan_ibu'] == 'G'){ echo "SELECTED"; } ?>>Wiraswasta</option>
													<option value="H" <?php if($data_mhs['pekerjaan_ibu'] == 'H'){ echo "SELECTED"; } ?>>PNS/TNI/Polri</option>
	              									<option value="I" <?php if($data_mhs['pekerjaan_ibu'] == 'I'){ echo "SELECTED"; } ?>>Pensiunan</option>
	              									<option value="J" <?php if($data_mhs['pekerjaan_ibu'] == 'J'){ echo "SELECTED"; } ?>>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Penghasilan Ayah</label>
                                                <select class="form-control" name="penghasilan_ayah">
                                                	<option value="A" <?php if($data_mhs['penghasilan_ayah'] == 'A'){ echo "SELECTED"; } ?>>Tidak Berpenghasilan</option>
                                                	<option value="B" <?php if($data_mhs['penghasilan_ayah'] == 'B'){ echo "SELECTED"; } ?>> < 500.000 </option>
                                                	<option value="C" <?php if($data_mhs['penghasilan_ayah'] == 'C'){ echo "SELECTED"; } ?>> 1.000.000-2.000.000 </option>
                                                	<option value="D" <?php if($data_mhs['penghasilan_ayah'] == 'D'){ echo "SELECTED"; } ?>> 2.000.000-5.000.000 </option>
                                                	<option value="E" <?php if($data_mhs['penghasilan_ayah'] == 'E'){ echo "SELECTED"; } ?>> > 5.000.000 </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Penghasilan Ibu</label>
                                                <select class="form-control" name="penghasilan_ibu">
                                                	<option value="A" <?php if($data_mhs['penghasilan_ibu'] == 'A'){ echo "SELECTED"; } ?>>Tidak Berpenghasilan</option>
                                                	<option value="B" <?php if($data_mhs['penghasilan_ibu'] == 'B'){ echo "SELECTED"; } ?>> < 500.000 </option>
                                                	<option value="C" <?php if($data_mhs['penghasilan_ibu'] == 'C'){ echo "SELECTED"; } ?>> 1.000.000-2.000.000 </option>
                                                	<option value="D" <?php if($data_mhs['penghasilan_ibu'] == 'D'){ echo "SELECTED"; } ?>> 2.000.000-5.000.000 </option>
                                                	<option value="E" <?php if($data_mhs['penghasilan_ibu'] == 'E'){ echo "SELECTED"; } ?>> > 5.000.000 </option>
                                                </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>No HP Orang Tua</label>
                                                <input class="form-control" name="no_hp_ortu" value="<?php echo $data_mhs['no_hp_ortu']; ?>" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=mhs'">Cancel</button>
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