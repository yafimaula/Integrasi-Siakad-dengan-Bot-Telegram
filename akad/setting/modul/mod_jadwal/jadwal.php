<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5> 
		<p>Jadwal Baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Jadwal berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Jadwal berhasil dihapus.</p>
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
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Penjadwalan Mata Kuliah
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="" method="GET" />
                            <input type="hidden" name="mod" value="jadwal_mata_kuliah">
							<input type="hidden" name="act" value="mgm_mata_kuliah">
                                <fieldset>
	                                <div class="row">
	                                  <div class="col-sm-12">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Program Studi</label>
	                                          <select name="prodi" class="form-control" required="">
	                                            <option value="">- None -</option>	
												<?php
												$sql_prodi = $db->database_prepare("SELECT * FROM prodi WHERE status = 'A' ORDER BY prodi_id,nama_prodi ASC")->execute();
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
												}
											?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-12">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Tahun Angkatan</label>
	                                          <select name="tahun_angkatan" class="form-control" required="">
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
	
	case "mgm_mata_kuliah":
	echo "
        <div class='content'>
            <div class='row'> 
                <div class='col-lg-12'>
                    <div class='pvr-wrapper'> 
                        <div class='pvr-box'> 
                            <h5 class='pvr-header'>
                                Data Kelas
                            </h5>
                            <table id='data-table' class='table table-striped table-bordered nowrap' width='100%'>
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Kelas</th>
									<th>Semester</th>
									<th align='left'>Action</th>
                                </tr>
                                </thead>
                                <tbody>";
                                $i = 1;
								$sql_kelas = $db->database_prepare("SELECT * FROM kelas WHERE status = 'A' AND prodi_id = ? AND angkatan_id = ? ORDER BY semester_kelas DESC")
										->execute($_GET["prodi"],$_GET["tahun_angkatan"]);
								while ($data_kelas = $db->database_fetch_array($sql_kelas)){
									echo "	<tr>
											<td>$i</td>
											<td>$data_kelas[nama_kelas]</td>
											<td>$data_kelas[semester_kelas]</td>
											<td><a title='Lihat' href='index.php?mod=jadwal_mata_kuliah&act=mgm_mata_kuliah&prodi=$_GET[prodi]&tahun_angkatan=$_GET[tahun_angkatan]&kelas_id=$data_kelas[kelas_id]&semester=$data_kelas[semester_kelas]'><i class='fa fa-search'></i></a></td>
										</tr>";
									$i++;
								}            
                          echo "</tbody>
                            </table>
                </div>
            </div>
        </div>";

   if ($_GET['kelas_id'] != ''){
		$data2 = $db->database_fetch_array($db->database_prepare("SELECT * FROM kelas WHERE kelas_id = ?")->execute($_GET["kelas_id"]));
		echo"
                <div class='col-lg-12'>
                    <div class='pvr-wrapper'>
                        <div class='pvr-box'> 
                            <h5 class='pvr-header'>
                            	Jadwal Mata Kuliah <br>Kelas: $data2[nama_kelas]<br>Semester: $_GET[semester]
                            </h5> 
                            <div id='toolbar'>
                            	<a href='?mod=jadwal_mata_kuliah&act=add&prodi=$_GET[prodi]&tahun_angkatan=$_GET[tahun_angkatan]&kelas_id=$_GET[kelas_id]&semester=$_GET[semester]'><button type='button' class='btn btn-primary'><i class='fa fa-plus-square'></i>Tambah Jadwal</button></a>
                            </div>";
                            ?>
                            <table data-toolbar="#toolbar" data-toggle="table" data-search="true"  data-only-info-pagination="false" data-pagination="true" data-buttons-class="purple" data-page-list="[10, 25, 50, 100, ALL]" data-show-footer="false" class="table table-striped table-bordered">
                                <thead>
                                <tr>
									<th >Kode MK</th>
									<th >Mata Kuliah</th>
									<th >Kelas</th>
									<th >Hari</th>
									<th >Jam </th>
									<th >Dosen</th>
									<th >Ruang</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php
                                $i = 1;
								  $sql_jadwal = $db->database_prepare("SELECT * FROM jadwal_kuliah INNER JOIN makul ON makul.mata_kuliah_id=jadwal_kuliah.makul_id 
													INNER JOIN kelas ON kelas.kelas_id=jadwal_kuliah.kelas_id
													INNER JOIN ruang ON ruang.ruang_id=jadwal_kuliah.ruang_id
													INNER JOIN dosen ON dosen.dosen_id=jadwal_kuliah.dosen_id
													WHERE jadwal_kuliah.kelas_id = ? AND jadwal_kuliah.semester = ? ORDER BY jadwal_id DESC")->execute($_GET["kelas_id"],$_GET["semester"]);
									while ($data_jadwal = $db->database_fetch_array($sql_jadwal)){
										if ($data_jadwal['program'] == 'A'){
											$program = "Reguler";
										}
										else{
											$program = "Non-Reguler";
										}
										
										if ($data_jadwal['hari'] == 1){
											$hari = "Senin";
										}
										elseif ($data_jadwal['hari'] == 2){
											$hari = "Selasa";
										}
										elseif ($data_jadwal['hari'] == 3){
											$hari = "Rabu";
										}
										elseif ($data_jadwal['hari'] == 4){
											$hari = "Kamis";
										}
										elseif ($data_jadwal['hari'] == 5){
											$hari = "Jumat";
										}
										elseif ($data_jadwal['hari'] == 6){
											$hari = "Sabtu";
										}
										else{
											$hari = "Minggu";
										}
									echo "<tr>
											<td>$data_jadwal[kode_mata_kuliah]</td>
											<td>$data_jadwal[nama_mata_kuliah]</td>
											<td>$data_jadwal[nama_kelas]-$program</td>
											<td>$hari</td>
											<td>$data_jadwal[jam_mulai]</td>
											<td>$data_jadwal[nama_dosen] $data_jadwal[gelar]</td>
											<td>$data_jadwal[nama_ruang]</td>
											<td><a title='Ubah' href='index.php?mod=jadwal_mata_kuliah&act=edit&id=$data_jadwal[jadwal_id]&prodi=$_GET[prodi]&tahun_angkatan=$_GET[tahun_angkatan]&kelas_id=$_GET[kelas_id]&semester=$_GET[semester]'><i class='fa fa-pencil-square-o'></i> </a> | ";?>
											<a title='Hapus' href='modul/mod_jadwal/
											aksi_jadwal.php?mod=jadwal_mata_kuliah&act=delete
											&id=<?php echo $data_jadwal[jadwal_id];?>
											&prodi=<?php echo $_GET[prodi];?>
											&angkatan_id=<?php echo $_GET[tahun_angkatan];?>
											&kelas_id=<?php echo $_GET[kelas_id];?>
											&semester=<?php echo $_GET[semester];?>' onclick="return confirm('Anda Yakin ingin menghapus jadwal mata kuliah <?php echo $data_jadwal[nama_mata_kuliah];?>?');"><i class='fa fa-trash'></i></a>
											<?php
											echo "
										</tr>";
									$i++;
								}            
                          echo "</tbody>
                            </table>
                </div>
            </div>
        </div>";
	}
	break;
	
	case "edit":
	$data_jadwal = $db->database_fetch_array($db->database_prepare("SELECT * FROM jadwal_kuliah WHERE jadwal_id = ?")->execute($_GET["id"]));
	$data_ang = $db->database_fetch_array($db->database_prepare("SELECT * FROM angkatan WHERE angkatan_id = ?")->execute($_GET['tahun_angkatan']));
	$dt_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM prodi WHERE prodi_id = ?")->execute($_GET["prodi"]));
	if ($dt_prodi['jenjang_studi_id'] == 'A'){
		$kd_jenjang_studi = "S3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'B'){
		$kd_jenjang_studi = "S2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'C'){
		$kd_jenjang_studi = "S1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'D'){
		$kd_jenjang_studi = "D4";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'E'){
		$kd_jenjang_studi = "D3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'F'){
		$kd_jenjang_studi = "D2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'G'){
		$kd_jenjang_studi = "D1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'H'){
		$kd_jenjang_studi = "Sp-1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'I'){
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
                                Ubah Jadwal Mata Kuliah
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_jadwal/aksi_jadwal.php?mod=jadwal_mata_kuliah&act=update" method="POST" />
                            <input type="hidden" name="id" value="<?php echo $data_jadwal['jadwal_id']; ?>">
                                <fieldset>
	                               	<div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Program Studi</label>
	                                        <input type="text" class="form-control" name="" id="exampleInputEmail4" value="<?php echo $kd_jenjang_studi." - ".$dt_prodi['nama_prodi']; ?>" DISABLED />
                                        	<input type="hidden" name="prodi" value="<?php echo $_GET['prodi']; ?>">
											<input type="hidden" name="kelas_id" value="<?php echo $_GET['kelas_id']; ?>">
											<input type="hidden" name="semester" value="<?php echo $_GET['semester']; ?>">
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Tahun Angkatan</label>
	                                        <input type="text" class="form-control" name="angkatan_id" id="exampleInputEmail4" value="<?php echo $data_ang['tahun_angkatan']; ?>" DISABLED />
	                                        <input type="hidden" name="angkatan_id" value="<?php echo $data_ang['angkatan_id']; ?>">
	                                    </div>
	                                  </div>
	                                </div>

	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Kode Mata Kuliah</label>
	                                          <select name="makul_id" class="js-states form-control" id="limiting">
	                                            <?php
												$sql_makul = $db->database_prepare("SELECT * FROM makul WHERE status_mata_kuliah = 'A' ORDER BY kode_mata_kuliah ASC")->execute();
												while ($data_makul = $db->database_fetch_array($sql_makul)){
													if ($data_jadwal['makul_id'] == $data_makul['mata_kuliah_id']){
														echo "<option value=$data_makul[mata_kuliah_id] SELECTED>$data_makul[kode_mata_kuliah] - $data_makul[nama_mata_kuliah]</option>";
													}
													else{
														echo "<option value=$data_makul[mata_kuliah_id]>$data_makul[kode_mata_kuliah] - $data_makul[nama_mata_kuliah]</option>";
													}
												}
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Hari</label>
	                                          <select name="hari" class="form-control">
	                                          	<option value="1" <?php if($data_jadwal['hari'] == 1){ echo "SELECTED"; } ?>>Senin</option>
												<option value="2" <?php if($data_jadwal['hari'] == 2){ echo "SELECTED"; } ?>>Selasa</option>
												<option value="3" <?php if($data_jadwal['hari'] == 3){ echo "SELECTED"; } ?>>Rabu</option>
												<option value="4" <?php if($data_jadwal['hari'] == 4){ echo "SELECTED"; } ?>>Kamis</option>
												<option value="5" <?php if($data_jadwal['hari'] == 5){ echo "SELECTED"; } ?>>Jumat</option>
												<option value="6" <?php if($data_jadwal['hari'] == 6){ echo "SELECTED"; } ?>>Sabtu</option>
												<option value="7" <?php if($data_jadwal['hari'] == 7){ echo "SELECTED"; } ?>>Minggu</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Jam Mulai</label>
	                                          <input type="time" name="jam_mulai" class="form-control" value="<?php echo $data_jadwal['jam_mulai']; ?>">
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Jam Selesai</label>
	                                          <input type="time" name="jam_selesai" class="form-control" value="<?php echo $data_jadwal['jam_selesai']; ?>">
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Ruang Kuliah</label>
	                                          <select name="ruang_id" class="js-states form-control" class="form-control">
	                                            <?php
												$sql_ruang = $db->database_prepare("SELECT * FROM ruang WHERE aktif = 'A' ORDER BY nama_ruang ASC")->execute();
												while ($data_ruang = $db->database_fetch_array($sql_ruang)){
													if ($data_jadwal['ruang_id'] == $data_ruang['ruang_id']){
														echo "<option value=$data_ruang[ruang_id] SELECTED>$data_ruang[nama_ruang]</option>";
													}
													else{
														echo "<option value=$data_ruang[ruang_id]>$data_ruang[nama_ruang]</option>";
													}
												}
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Program Kuliah</label>
	                                          <select name="program" class="form-control">
	                                            <option value="A" <?php if($data_jadwal['program'] == 'A'){ echo "SELECTED"; } ?>>Reguler</option>
												<option value="B" <?php if($data_jadwal['program'] == 'B'){ echo "SELECTED"; } ?>>Non-Reguler</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-12">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Dosen Pengampu</label>
	                                          <select name="dosen_id" class="js-states form-control" id="select2">
	                                          	<?php
												$sql_dosen = $db->database_prepare("SELECT * FROM dosen WHERE status = 'A' ORDER BY nidn,nama_dosen ASC")->execute();
												while ($data_dosen = $db->database_fetch_array($sql_dosen)){
													if ($data_jadwal['dosen_id'] == $data_dosen['dosen_id']){
														echo "<option value=$data_dosen[dosen_id] SELECTED>$data_dosen[nidn] - $data_dosen[nama_dosen] $data_dosen[gelar]</option>";
													}
													else{
														echo "<option value=$data_dosen[dosen_id]>$data_dosen[nidn] - $data_dosen[nama_dosen] $data_dosen[gelar]</option>";
													}
												}
												?>
	                                          </select> 
	                                    </div>
	                                  </div>
	                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=jadwal_mata_kuliah'">Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
	<?php
	break;
	
	case "add":
	$data_ang = $db->database_fetch_array($db->database_prepare("SELECT * FROM angkatan WHERE angkatan_id = ?")->execute($_GET['tahun_angkatan']));
	$dt_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM prodi WHERE prodi_id = ?")->execute($_GET["prodi"]));
	if ($dt_prodi['jenjang_studi_id'] == 'A'){
		$kd_jenjang_studi = "S3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'B'){
		$kd_jenjang_studi = "S2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'C'){
		$kd_jenjang_studi = "S1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'D'){
		$kd_jenjang_studi = "D4";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'E'){
		$kd_jenjang_studi = "D3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'F'){
		$kd_jenjang_studi = "D2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'G'){
		$kd_jenjang_studi = "D1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'H'){
		$kd_jenjang_studi = "Sp-1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'I'){
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
                                Tambah Jadwal Mata Kuliah
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_jadwal/aksi_jadwal.php?mod=jadwal_mata_kuliah&act=input" method="POST" />
                                <fieldset>
	                               	<div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Program Studi</label>
	                                        <input type="text" class="form-control" name="" id="exampleInputEmail4" value="<?php echo $kd_jenjang_studi." - ".$dt_prodi['nama_prodi']; ?>" DISABLED />
                                        	<input type="hidden" name="proid" value="<?php echo $dt_prodi['prodi_id']; ?>">
											<input type="hidden" name="kelas_id" value="<?php echo $_GET['kelas_id']; ?>">
											<input type="hidden" name="semester" value="<?php echo $_GET['semester']; ?>">
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Tahun Angkatan</label>
	                                        <input type="text" class="form-control" name="angkatan_id" id="exampleInputEmail4" value="<?php echo $data_ang['tahun_angkatan']; ?>" DISABLED />
	                                        <input type="hidden" name="angkatan_id" value="<?php echo $data_ang['angkatan_id']; ?>">
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Kode Mata Kuliah</label>
	                                          <select name="makul_id" class="js-states form-control" id="limiting" required="">
	                                            <option value="">- None -</option>
	                                            <?php
												$sql_makul = $db->database_prepare("SELECT * FROM makul WHERE status_mata_kuliah = 'A' ORDER BY kode_mata_kuliah ASC")->execute();
												while ($data_makul = $db->database_fetch_array($sql_makul)){
													echo "<option value=$data_makul[mata_kuliah_id]>$data_makul[kode_mata_kuliah] - $data_makul[nama_mata_kuliah]</option>";
												}
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Hari</label>
	                                          <select name="hari" class="form-control" required="">
	                                          	<option value="">- None -</option>
												<option value="1">Senin</option>
												<option value="2">Selasa</option>
												<option value="3">Rabu</option>
												<option value="4">Kamis</option>
												<option value="5">Jumat</option>
												<option value="6">Sabtu</option>
												<option value="7">Minggu</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Jam Mulai</label>
	                                          <input type="time" name="jam_mulai" class="form-control" required="">
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Jam Selesai</label>
	                                          <input type="time" name="jam_selesai" class="form-control">
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Ruang Kuliah</label>
	                                          <select name="ruang_id" class="form-control" required="">
	                                            <option value="">- None -</option>	
												<?php
												$sql_ruang = $db->database_prepare("SELECT * FROM ruang WHERE aktif = 'A' ORDER BY nama_ruang ASC")->execute();
												while ($data_ruang = $db->database_fetch_array($sql_ruang)){
													echo "<option value=$data_ruang[ruang_id]>$data_ruang[nama_ruang]</option>";
												}
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Program Kuliah</label>
	                                          <select name="program" class="form-control" required="">
	                                            <option value="">- None -</option>	
												<option value="A">Reguler</option>
												<option value="B">Non-Reguler</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-12">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Dosen Pengampu</label>
	                                          <select name="dosen_id" class="js-states form-control"  id="select2" required="">
	                                          	<option value="">- None -</option>
												<?php
												$sql_dosen = $db->database_prepare("SELECT * FROM dosen WHERE status = 'A' ORDER BY dosen_id,nama_dosen ASC")->execute();
												while ($data_dosen = $db->database_fetch_array($sql_dosen)){
													echo "<option value=$data_dosen[dosen_id]>$data_dosen[nidn] - $data_dosen[nama_dosen] $data_dosen[gelar]</option>";
												}
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=jadwal_mata_kuliah'">Cancel</button>
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