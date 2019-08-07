<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i> Success!</h5>
		<p>Kelas Baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i> Success!</h5>
		<p>Kelas berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i> Success!</h5>
		<p>Kelas berhasil dihapus.</p>
	</div>
<?php
}
?>

<?php
switch($_GET['act']){
	default:
?>		
	<!--Begin Content-->
        <div class="content">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                               Pilih Tahun Angkatan
                            </h5>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Th. Angkatan</th>
									<th>Semester</th>
									<th>Status</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $no = 1;
                                  $sql_angkatan = $db->database_prepare("SELECT * FROM angkatan ORDER BY tahun_angkatan,status ASC")->execute();
									while ($data_angkatan = $db->database_fetch_array($sql_angkatan)){
										if ($data_angkatan['status'] == 'A'){
											$status_angkatan = "<span class='badge-success badge'>Aktif</span>";
										}
										else{
											$status_angkatan = "<span class='badge-danger badge'>Tidak Aktif</span>";
										}
										
										if ($data_angkatan['semester_angkatan'] == '2'){
											$semester = "Genap";
										}
										else{
											$semester = "Ganjil";
										}
                                    echo "<tr>
											<td>$no</td>
											<td>$data_angkatan[tahun_angkatan]</td>
											<td>$semester</td>
											<td>$status_angkatan</td>
											<td><a title='Open' href='?mod=kelas_prodi&act=detail&angkatan_id=$data_angkatan[angkatan_id]' class='btn btn-purple btn-sm'>Open</a></td>
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

	break;
	
	case "detail":
	?>
	<!--Begin Content-->
        <div class="content">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                               Pilih Daftar Prodi
                            </h5>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th >No</th>
									<th >Program Studi</th>
									<th align='right'>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
									$no = 1;
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
										echo "
										<tr>
											<td>$no</td>
											<td>$kd_jenjang_studi - $data_prodi[nama_prodi]</td>
											<td><a title='Buka'  class='btn btn-purple btn-sm' href='?mod=kelas_prodi&act=detail&proid=$data_prodi[prodi_id]&angkatan_id=$_GET[angkatan_id]'>Lihat</a></td>
										</tr>";
										$no++;
									} 
									?>            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            
   <!--End Content-->
	<?php
	if($_GET['proid'] != ''  && $_GET['angkatan_id'] != ''){
		$data_ang = $db->database_fetch_array($db->database_prepare("SELECT * FROM angkatan WHERE angkatan_id = ?")->execute($_GET['angkatan_id']));
		$dt_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM prodi WHERE prodi_id = ?")->execute($_GET["proid"]));
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
		
		if ($data_ang['semester_angkatan'] == 'A'){
			$semester = "Genap";
		}
		else{
			$semester = "Ganjil";
		}
		
		?>
			<!--Begin Content-->
        
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                                Data Kelas <br> Prodi <?php echo "$kd_jenjang_studi - $dt_prodi[nama_prodi]";?> <br> Th. Angkatan <?php echo "$data_ang[tahun_angkatan] - $semester";?>
                            </h5>
                            <div id='toolbar'>
                             <a href='?mod=kelas_prodi&act=add&proid=<?php echo $_GET['proid']; ?>&angkatan_id=<?php echo $_GET['angkatan_id']; ?>'><button type='button' class='btn btn-primary'><i class='fa fa-plus-square'></i> Tambah Kelas</button></a>
                            </div>
                            <table data-toolbar="#toolbar" data-toggle="table" data-search="true"  data-only-info-pagination="false" data-pagination="true" data-buttons-class="purple" data-page-list="[10, 25, 50, 100, ALL]" data-show-footer="false" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Kelas</th>
									<th>Semester</th>
									<th>Kapasitas Mahasiswa</th>
									<th>Status</th>
									<th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
									$no = 1;
									$sql_kelas = $db->database_prepare("SELECT * FROM kelas WHERE prodi_id = ? AND angkatan_id = ? ORDER BY kelas_id DESC")->execute($_GET["proid"],$_GET["angkatan_id"]);
									while ($data_kelas = $db->database_fetch_array($sql_kelas)){
										if ($data_kelas['status'] == 'A'){
											$status = "<span class='badge-success badge'>Aktif</span>";
										}
										else{
											$status = "<span class='badge-danger badge'>Tidak Aktif</span>";
										}
										echo "
										<tr>
											<td>$no</td>
											<td>$data_kelas[nama_kelas]</td>
											<td>$data_kelas[semester_kelas]</td>
											<td>$data_kelas[daya_tampung]</td>
											<td>$status</td>
											<td><a title='Ubah' href='?mod=kelas_prodi&act=edit&id=$data_kelas[kelas_id]&proid=$_GET[proid]&angkatan_id=$_GET[angkatan_id]'><i class='fa fa-pencil-square-o'></i> </a> |";
											?>
											<a title='Hapus' href='modul/mod_kelas/aksi_kelas.php?mod=kelas_prodi&act=delete
											&id=<?php echo "$data_kelas[kelas_id]";?>
											&proid=<?php echo "$_GET[proid]";?>
											&angkatan_id=<?php echo "$_GET[angkatan_id]";?>' onclick="return confirm('Anda Yakin ingin menghapus kelas <?php echo $data_kelas[nama_kelas];?>?');"><i class='fa fa-trash'></i></a>
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
	
	case "add":
	$data_ang = $db->database_fetch_array($db->database_prepare("SELECT * FROM angkatan WHERE angkatan_id = ?")->execute($_GET['angkatan_id']));
	$dt_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM prodi WHERE prodi_id = ?")->execute($_GET["proid"]));

	if ($dt_prodi['jenjang_studi_id'] == 'A'){
		$jenjang_studi_id = "S3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'B'){
		$jenjang_studi_id = "S2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'C'){
		$jenjang_studi_id = "S1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'D'){
		$jenjang_studi_id = "D4";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'E'){
		$jenjang_studi_id = "D3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'F'){
		$jenjang_studi_id = "D2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'G'){
		$jenjang_studi_id = "D1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'H'){
		$jenjang_studi_id = "Sp-1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'I'){
		$jenjang_studi_id = "Sp-2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'J'){
		$jenjang_studi_id = "Profesi";
	}
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Kelas
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_kelas/aksi_kelas.php?mod=kelas_prodi&act=input" method="POST" />
                                <fieldset>
                               	<div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Program Studi</label>
                                        <input type="text" class="form-control" id="exampleInputEmail4" value="<?php echo $jenjang_studi_id." - ".$dt_prodi['nama_prodi']; ?>" DISABLED/>
                                        <input type="hidden" name="proid" value="<?php echo $dt_prodi['prodi_id']; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Tahun Angkatan</label>
                                        <input type="text" class="form-control" id="exampleInputEmail4" value="<?php echo $data_ang['tahun_angkatan']; ?>" DISABLED/>
                                        <input type="hidden" name="angkatan_id" value="<?php echo $data_ang['angkatan_id']; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Nama Kelas</label>
                                          <input type="text" class="form-control" name="nama_kelas" placeholder="Nama Kelas Untuk Program Studi" required="" />
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Semester</label>
                                          <select name="semester" class="form-control" required="">
                                            <option value="">- None -</option>
                                            <option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Kapasitas Mahasiswa</label>
                                          <input type="number" class="form-control" name="daya_tampung" placeholder="Nama Kelas Untuk Program Studi" />
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status</label>
                                          <select name="status" class="form-control" required="">
                                            <option value="">- None -</option>
                                            <option value="A">Aktif</option>
                                            <option value="N">Non-Aktif</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=kelas_prodi'">Cancel</button>
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
	$data_ang = $db->database_fetch_array($db->database_prepare("SELECT * FROM angkatan WHERE angkatan_id = ?")->execute($_GET['angkatan_id']));
	$dt_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM prodi WHERE prodi_id = ?")->execute($_GET["proid"]));
	$data_kelas = $db->database_fetch_array($db->database_prepare("SELECT * FROM kelas WHERE kelas_id=?")->execute($_GET["id"]));
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
                                Edit Kelas
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                    <i class="material-icons" data-box="close">close</i>
                                </div>
                            </h5>
                            <form action="modul/mod_kelas/aksi_kelas.php?mod=kelas_prodi&act=update" method="POST" />
                            <input type="hidden" name="id" value="<?php echo $data_kelas['kelas_id']; ?>">
							<input type="hidden" name="proid" value="<?php echo $_GET['proid']; ?>">
							<input type="hidden" name="angkatan_id" value="<?php echo $_GET['angkatan_id']; ?>">
                                <fieldset>
                               	<div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Program Studi</label>
                                        <input type="text" class="form-control" id="exampleInputEmail4" value="<?php echo $kd_jenjang_studi." - ".$dt_prodi['nama_prodi']; ?>" DISABLED/>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Tahun Angkatan</label>
                                        <input type="text" class="form-control" id="exampleInputEmail4" value="<?php echo $data_ang['tahun_angkatan']; ?>" DISABLED/>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Nama Kelas</label>
                                          <input type="text" class="form-control" name="nama_kelas" value="<?php echo $data_kelas['nama_kelas']; ?>" />
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Semester</label>
                                          <select name="semester" class="form-control">
                                            <option value="">- None -</option>
                                            <option value="1" <?php if($data_kelas['semester_kelas'] == 1){ echo "SELECTED"; } ?>>1</option>
											<option value="2" <?php if($data_kelas['semester_kelas'] == 2){ echo "SELECTED"; } ?>>2</option>
											<option value="3" <?php if($data_kelas['semester_kelas'] == 3){ echo "SELECTED"; } ?>>3</option>
											<option value="4" <?php if($data_kelas['semester_kelas'] == 4){ echo "SELECTED"; } ?>>4</option>
											<option value="5" <?php if($data_kelas['semester_kelas'] == 5){ echo "SELECTED"; } ?>>5</option>
											<option value="6" <?php if($data_kelas['semester_kelas'] == 6){ echo "SELECTED"; } ?>>6</option>
											<option value="7" <?php if($data_kelas['semester_kelas'] == 7){ echo "SELECTED"; } ?>>7</option>
											<option value="8" <?php if($data_kelas['semester_kelas'] == 8){ echo "SELECTED"; } ?>>8</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Kapasitas Mahasiswa</label>
                                          <input type="number" class="form-control" name="daya_tampung" value="<?php echo $data_kelas['daya_tampung']; ?>" />
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status</label>
                                          <select name="status" class="form-control">
                                            <option value="A" <?php if($data_kelas['status'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
											<option value="N" <?php if($data_kelas['status'] == 'N'){ echo "SELECTED"; } ?>>Non-Aktif</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=kelas_prodi'">Cancel</button>
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