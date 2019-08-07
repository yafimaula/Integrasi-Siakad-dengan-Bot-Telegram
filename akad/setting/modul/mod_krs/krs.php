<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>KRS baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>KRS berhasil diubah.</p>
	</div>
<?php
} 
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>KRS berhasil dihapus.</p>
	</div>
<?php
}
?>


<?php
switch($_GET['act']){
	default:
?>
	<!-- <div class="content">
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
                            <input type="hidden" name="mod" value="krs">
							<input type="hidden" name="act" value="krs_detail">
                                <fieldset>
                               	<div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">NIM</label>
                                        <input type="hidden" class="form-control" name="id_mhs" id="exampleInputEmail4" value="<?php echo "$_SESSION[id_mhs]";?>"/>
                                        <input type="text" class="form-control" name="nim" readonly="" id="exampleInputEmail4" value="<?php echo "$_SESSION[nim]";?>"/>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
	                                    <label for="exampleInputEmail4">Angkatan Mahasiswa</label>
	                                        <select name="angkatan_id" class="form-control">
	                                           <option value="">- None -</option>
												<?php 
												$sql_angkatan = $db->database_prepare("SELECT * FROM angkatan ")->execute();
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
                                    <button type="submit" class="btn btn-purple m-r-5">Lanjut</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <?php
    $sql_ang = $db->database_prepare("SELECT * FROM  `angkatan` WHERE  `status` =  'A'")->execute();
	$data_ang = $db->database_fetch_array($sql_ang);
	if ($data_ang['semester_angkatan'] == '1'){
		$semester = "Ganjil";
	}
	else{
		$semester = "Genap";
	}
	$sql_mhs = $db->database_prepare("SELECT m.id_mhs,m.nim, m.nama_mahasiswa, p.prodi_id as prodi_id, p.nama_prodi, p.jenjang_studi_id as jenjang_studi_id FROM  `mahasiswa` m JOIN prodi p ON p.prodi_id = m.`kode_program_studi` 
									WHERE m.id_mhs = ? AND m.status_mahasiswa = 'A' ORDER BY m.nama_mahasiswa DESC LIMIT 1")->execute($_SESSION['id_mhs']);
	$nums = $db->database_num_rows($sql_mhs);
	$data_mhs = $db->database_fetch_array($sql_mhs);
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
	?>
	<div class="content">
            <div class="row">
				<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                KRS Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
							<div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>NIM</td>
                                        <td><?php echo "$data_mhs[nim]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Nama Mahasiswa</td>
                                    	<td><?php echo "$data_mhs[nama_mahasiswa]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Program Studi</td>
                                    	<td><?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]"; ?></td>
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
                                KRS Yang Telah Diambil
                            </h5>
                            <a href="?mod=krs&act=form&id_mhs=<?php echo $_SESSION['id_mhs']; ?>&angkatan_id=<?php echo $data_ang['angkatan_id']; ?>"><button type='button' class='btn btn-primary'><i class="fa fa-get-pocket"></i> Ambil KRS</button></a>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Kode MK</th>
									<th>Nama MK</th>
									<th>SKS</th>
									<th>Kelas</th>
									<th>Dosen</th>
									<th>Hari</th>
									<th>Jam</th>
									<th>Ruang</th>
									<th>Hapus</th> 
                                </tr>
                                </thead>
                                <tbody>
                                <?php
									$x = 1;	
										$sql_krs = $db->database_prepare("SELECT * FROM krs A
											INNER JOIN jadwal_kuliah B ON A.jadwal_id = B.jadwal_id
											INNER JOIN makul C ON C.mata_kuliah_id = B.makul_id
											INNER JOIN kelas D ON D.kelas_id = B.kelas_id
											INNER JOIN dosen E ON E.dosen_id = B.dosen_id
											INNER JOIN ruang F ON F.ruang_id = B.ruang_id
											WHERE A.id_mhs =  ? AND D.angkatan_id =  ?")->execute($_SESSION["id_mhs"],$data_ang['angkatan_id']);
										while ($data_krs = $db->database_fetch_array($sql_krs)){
											if ($data_krs['program'] == 'A'){
												$program = "Reguler";
											}
											else{
												$program = "Non-Reguler";
											}
											
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
										echo "<tr>
												<td>$x</td>
												<td>$data_krs[kode_mata_kuliah]</td>
												<td>$data_krs[nama_mata_kuliah]</td>
												<td>$data_krs[sks]</td>
												<td>$data_krs[nama_kelas]</td>
												<td>$data_krs[nama_dosen] $data_krs[gelar]</td>
												<td>$hari</td>
												<td>$data_krs[jam_mulai]</td> 
												<td>$data_krs[nama_ruang]</td>
												<td>";
												?>
												<a href='modul/mod_krs/aksi_krs.php?mod=krs&act=delete&id=<?php echo "$data_krs[krs_id]";?>&id_mhs=<?php echo "$_SESSION[id_mhs]";?>&angkatan_id=<?php echo "$data_ang[angkatan_id]";?>' onclick="return confirm('Anda Yakin ingin menghapus Mata Kuliah <?php echo "$data_krs[nama_mata_kuliah]";?>?');"><i class="fa fa-trash"></i></a></td>
												<?php 
									    echo "</tr>";
												$x++;
											}
									?>            
                                </tbody>
                            </table>
                            <?php 
                            $tot_krs = $db->database_fetch_array($db->database_prepare("SELECT SUM(C.sks) as jumlah FROM krs A INNER JOIN jadwal_kuliah B ON A.jadwal_id=B.jadwal_id
										INNER JOIN makul C ON C.mata_kuliah_id=B.makul_id 
										INNER JOIN kelas D ON D.kelas_id=B.kelas_id
										INNER JOIN dosen E ON E.dosen_id=B.dosen_id 
										WHERE A.id_mhs = ? AND D.angkatan_id = ?")->execute($_SESSION["id_mhs"],$data_ang["angkatan_id"]));
                            echo "<table class='form'>
								<tr>
									<td width='200'><label>TOTAL KESELURUHAN SKS AMBIL</label></td>
									<td><b>$tot_krs[jumlah] SKS</b></td>
								</tr>
							</table>
							<br>
							<div>
								<a href='modul/mod_krs/cetak_krsmpdf.php?mod=krs&act=print&id_mhs=$_SESSION[id_mhs]&angkatan_id=$data_ang[angkatan_id]' target='_blank'><button type='button' class='btn btn-wd btn-info'><i class='fa fa-print'></i> Cetak KRS</button></a>
								<a href='index.php'><button type='button' class='btn btn-danger'><i class='fa fa-sign-out'></i>Keluar</button></a> 
							</div>";
				
			                ?>

                        </div>
                    </div>
    			</div>
    		</div>
    </div>


	<?php

	break;
	
	case "form":
	$sql_mhs = $db->database_prepare("SELECT m.id_mhs,m.nim, m.nama_mahasiswa, p.prodi_id as prodi_id, p.nama_prodi, p.jenjang_studi_id as jenjang_studi_id FROM  `mahasiswa` m JOIN prodi p ON p.prodi_id = m.`kode_program_studi` 
									WHERE m.id_mhs = ? AND m.status_mahasiswa = 'A' ORDER BY m.nama_mahasiswa DESC LIMIT 1")->execute($_SESSION['id_mhs']);
	$nums = $db->database_num_rows($sql_mhs);
	
		$data_mhs = $db->database_fetch_array($sql_mhs);
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
                               Kartu Rencana Studi
                            </h5>
                        <form method='POST' action='modul/mod_krs/aksi_krs.php?mod=krs&act=input'>
                        <input type='hidden' name='id_mhs' value='$_SESSION[id_mhs]'> 
                        <input type='hidden' name='tahun_angkatan' value='$_GET[angkatan_id]'>
                    ";
		
		echo "<table data-toolbar='#toolbar' data-toggle='table' data-search='true'  data-only-info-pagination='false' data-pagination='true' data-buttons-class='purple' data-page-list='[10, 25, 50, 100, ALL]' data-show-footer='false' class='table table-striped table-bordered' id='example' width='100%'> 
				<thead>
					<tr>
						<th>Kode MK</th>
						<th>Nama MK</th>
						<th>Program</th>
						<th>SKS</th>
						<th>SMS</th>
						<th>Kelas</th>
						<th>Dosen</th>
						<th>Hari</th>
						<th>Jam</th>
						<th>Ambil</th>
					</tr>
				</thead><tbody>";
		$i = 1;	
		$sql_krs = $db->database_prepare("SELECT k.kelas_id, k.`nama_kelas` as nama_kelas , jk.makul_id, m.nama_mata_kuliah, p.nama_prodi, m.kode_mata_kuliah as kode_mata_kuliah, jk.program as program, m.sks as sks, jk.semester as semester, d.nama_dosen as nama_dosen, d.gelar as gelar, jk.hari as hari, jk.jam_mulai, jk.jam_selesai, jk.jadwal_id as jadwal_id
									FROM  `kelas` k
									JOIN jadwal_kuliah jk ON k.`kelas_id` = jk.`kelas_id` 
									JOIN dosen d ON d.dosen_id = jk.dosen_id
									JOIN makul m ON m.mata_kuliah_id = jk.makul_id
									JOIN prodi p ON p.prodi_id = m.prodi_id
									WHERE p.prodi_id = ? AND k.angkatan_id =  ?")->execute($data_mhs['prodi_id'],$_GET['angkatan_id']);
		while ($data_krs = $db->database_fetch_array($sql_krs)){
			$nums = $db->database_num_rows($db->database_prepare("SELECT * FROM krs WHERE id_mhs=? AND jadwal_id=?")->execute($data_mhs["id_mhs"],$data_krs["jadwal_id"]));
			if ($data_krs['program'] == 'A'){
				$program = "Reguler";
			}
			else{
				$program = "Non-Reguler";
			}
			
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
			if ($nums == 0){
				echo "<tr> 
						<td>$data_krs[kode_mata_kuliah]</td>
						<td>$data_krs[nama_mata_kuliah]</td>
						<td>$program</td>
						<td>$data_krs[sks]</td>
						<td>$data_krs[semester]</td>
						<td>$data_krs[nama_kelas]</td>
						<td>$data_krs[nama_dosen] $data_krs[gelar]</td>
						<td>$hari</td>
						<td>$data_krs[jam_mulai]</td>
						<td><input type='checkbox' name='ambil[]' value='$data_krs[jadwal_id]'></td>
					</tr>";
			}
			$i++;
		}
		echo "</tbody></table>
		<br>";
		if ($nums == 0){
			echo "<button type='submit' class='btn btn-primary'>Ambil Yang Dicentang</button>";
		}else{
			echo "<button type='button' class='btn btn-primary disabled'>Ambil Yang Dicentang</button>";
		}
		echo "</form></div>
                </div>
                </div>
                </div>
                </div>";
		
	
	break;
	
	case "krs_detail":
	$sql_ang = $db->database_prepare("SELECT * FROM  `angkatan` WHERE  `angkatan_id` =  ?")->execute($_GET["angkatan_id"]);
	$data_ang = $db->database_fetch_array($sql_ang);
	if ($data_ang['semester_angkatan'] == '1'){
		$semester = "Ganjil";
	}
	else{
		$semester = "Genap";
	}
	$sql_mhs = $db->database_prepare("SELECT m.id_mhs,m.nim, m.nama_mahasiswa, p.prodi_id as prodi_id, p.nama_prodi, p.jenjang_studi_id as jenjang_studi_id FROM  `mahasiswa` m JOIN prodi p ON p.prodi_id = m.`kode_program_studi` 
									WHERE m.id_mhs = ? AND m.status_mahasiswa = 'A' ORDER BY m.nama_mahasiswa DESC LIMIT 1")->execute($_GET['id_mhs']);
	$nums = $db->database_num_rows($sql_mhs);
	$data_mhs = $db->database_fetch_array($sql_mhs);
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
	?>
	<div class="content">
            <div class="row">
				<div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                KRS Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
							<div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>NIM</td>
                                        <td><?php echo "$data_mhs[nim]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Nama Mahasiswa</td>
                                    	<td><?php echo "$data_mhs[nama_mahasiswa]"; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Program Studi</td>
                                    	<td><?php echo "$kd_jenjang_studi - $data_mhs[nama_prodi]"; ?></td>
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
                                KRS Yang Telah Diambil
                            </h5>
                            <a href="?mod=krs&act=form&id_mhs=<?php echo $_SESSION['id_mhs']; ?>&angkatan_id=<?php echo $_GET['angkatan_id']; ?>"><button type='button' class='btn btn-primary'><i class="fa fa-get-pocket"></i> Ambil KRS</button></a>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th width='30'>No</th>
									<th width='70'>Kode MK</th>
									<th width='170'>Nama MK</th>
									<th width='45'>SKS</th>
									<th width='45'>SMS</th>
									<th width='45'>Kelas</th>
									<th width='160'>Dosen</th>
									<th width='50'>Hari</th>
									<th width='90'>Jam</th>
									<th width='90'>Ruang</th>
									<th>Hapus</th> 
                                </tr>
                                </thead>
                                <tbody>
                                <?php
									$x = 1;	
										$sql_krs = $db->database_prepare("SELECT * FROM krs A
											INNER JOIN jadwal_kuliah B ON A.jadwal_id = B.jadwal_id
											INNER JOIN makul C ON C.mata_kuliah_id = B.makul_id
											INNER JOIN kelas D ON D.kelas_id = B.kelas_id
											INNER JOIN dosen E ON E.dosen_id = B.dosen_id
											INNER JOIN ruang F ON F.ruang_id = B.ruang_id
											WHERE A.id_mhs =  ? AND D.angkatan_id =  ?")->execute($_GET["id_mhs"],$_GET["angkatan_id"]);
										while ($data_krs = $db->database_fetch_array($sql_krs)){
											if ($data_krs['program'] == 'A'){
												$program = "Reguler";
											}
											else{
												$program = "Non-Reguler";
											}
											
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
										echo "<tr>
												<td>$x</td>
												<td>$data_krs[kode_mata_kuliah]</td>
												<td>$data_krs[nama_mata_kuliah]</td>
												<td>$data_krs[sks]</td>
												<td>$data_krs[semester]</td>
												<td>$data_krs[nama_kelas]</td>
												<td>$data_krs[nama_dosen] $data_krs[gelar]</td>
												<td>$hari</td>
												<td>$data_krs[jam_mulai]</td>
												<td>$data_krs[nama_ruang]</td>
												<td>";
												?>
												<a href='modul/mod_krs/aksi_krs.php?mod=krs&act=delete&id=<?php echo "$data_krs[krs_id]";?>&id_mhs=<?php echo "$_SESSION[id_mhs]";?>&angkatan_id=<?php echo "$data_ang[angkatan_id]";?>' onclick="return confirm('Anda Yakin ingin menghapus Mata Kuliah <?php echo "$data_krs[nama_mata_kuliah]";?>?');"><i class="fa fa-trash"></i></a></td>
												<?php 
									    echo "</tr>";
												$x++;
											}
									?>            
                                </tbody>
                            </table>
                            <?php 
                            $tot_krs = $db->database_fetch_array($db->database_prepare("SELECT SUM(C.sks) as jumlah FROM krs A INNER JOIN jadwal_kuliah B ON A.jadwal_id=B.jadwal_id
										INNER JOIN makul C ON C.mata_kuliah_id=B.makul_id 
										INNER JOIN kelas D ON D.kelas_id=B.kelas_id
										INNER JOIN dosen E ON E.dosen_id=B.dosen_id 
										WHERE A.id_mhs = ? AND D.angkatan_id = ?")->execute($_GET["id_mhs"],$_GET["angkatan_id"]));
                            echo "<table class='form'>
								<tr>
									<td width='200'><label>TOTAL KESELURUHAN SKS AMBIL</label></td>
									<td><b>$tot_krs[jumlah] SKS</b></td>
								</tr>
							</table>
							<br>
							<div>
								<a href='modul/mod_krs/cetak_krsmpdf.php?mod=krs&act=print&id_mhs=$_GET[id_mhs]&angkatan_id=$_GET[angkatan_id]' target='_blank'><button type='button' class='btn btn-wd btn-info'><i class='fa fa-print'></i> Cetak KRS</button></a>
								<a href='index.php?mod=krs'><button type='button' class='btn btn-danger'><i class='fa fa-sign-out'></i>Keluar</button></a> 
							</div>";
				
			                ?>

                        </div>
                    </div>
    			</div>
    		</div>
    </div>

	<?php
	break;
	
	
}
?>