<?php 
//error_reporting(0);
if ($_GET['code'] == 1){ 
?> 
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Master Biaya Baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Master Biaya berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Master Biaya berhasil dihapus.</p>
	</div>
<?php
}
?>
<?php 
if ($_GET['code_a'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Akun Biaya Baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code_a'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Akun Biaya berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code_a'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Akun Biaya berhasil dihapus.</p>
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
                               Master Biaya
                            </h5>
                            <!-- <button type="button" onclick="window.location.href='?mod=biaya&act=add'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Master Biaya</button> -->
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Program Studi</th>
									<th>Action</th>
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
                                    echo "<tr>
											<td>$no</td>
											<td>$kd_jenjang_studi - $data_prodi[nama_prodi]</td>
											<td><a class='btn btn-purple btn-sm' href='?mod=biaya&act=view&proid=$data_prodi[prodi_id]'>Open Data</a></td>
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
	
	case "view":
	if ($_GET['sess'] == ''){
		$prodi = $db->database_fetch_array($db->database_prepare("SELECT jenjang_studi_id, nama_prodi FROM prodi WHERE prodi_id = ?")->execute($_GET["proid"]));
		if ($prodi['jenjang_studi_id'] == 'A'){
			$kd_jenjang_studi = "S3";
		}
		elseif ($prodi['jenjang_studi_id'] == 'B'){
			$kd_jenjang_studi = "S2";
		}
		elseif ($prodi['jenjang_studi_id'] == 'C'){
			$kd_jenjang_studi = "S1";
		}
		elseif ($prodi['jenjang_studi_id'] == 'D'){
			$kd_jenjang_studi = "D4";
		}
		elseif ($prodi['jenjang_studi_id'] == 'E'){
			$kd_jenjang_studi = "D3";
		}
		elseif ($prodi['jenjang_studi_id'] == 'F'){
			$kd_jenjang_studi = "D2";
		}
		elseif ($prodi['jenjang_studi_id'] == 'G'){
			$kd_jenjang_studi = "D1";
		}
		elseif ($prodi['jenjang_studi_id'] == 'H'){
			$kd_jenjang_studi = "Sp-1";
		}
		elseif ($prodi['jenjang_studi_id'] == 'I'){
			$kd_jenjang_studi = "Sp-2";
		}
		elseif ($prodi['jenjang_studi_id'] == 'J'){
			$kd_jenjang_studi = "Profesi";
		}
		?>
		<div class="content">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                               <?php echo $kd_jenjang_studi." - ".$prodi['nama_prodi']; ?><br>
								Daftar Master Biaya
                            </h5>
                            <button type="button" onclick="window.location.href='?mod=biaya&act=add&proid=<?php echo $_GET['proid']; ?>'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Master Biaya</button>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th width='30'>No</th>
									<th width='150'>Tahun Angkatan</th>
									<th width='500'>Keterangan</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$no = 1;
									$sql_biaya = $db->database_prepare("SELECT tahun_angkatan,semester_angkatan,keterangan,mst_biaya_id FROM mst_biaya LEFT JOIN angkatan ON angkatan.angkatan_id=mst_biaya.angkatan_id WHERE mst_biaya.prodi_id = ? ORDER BY mst_biaya.mst_biaya_id DESC")->execute($_GET["proid"]);
									while ($data_biaya = $db->database_fetch_array($sql_biaya)){
										if($data_biaya['semester_angkatan'] == '1'){
											$semester = "Ganjil";
										}
										else{
											$semester = "Genap";
										}
                                    echo "<tr>
											<td>$no</td>
											<td>$data_biaya[tahun_angkatan] - $semester</td>
											<td>$data_biaya[keterangan]</td>
											<td><a title='Lihat' href='?mod=biaya&act=view&proid=$_GET[proid]&mstbiayaid=$data_biaya[mst_biaya_id]'><i class='fa fa-search'></i></a> |
												<a title='Ubah' href='?mod=biaya&act=edit&proid=$_GET[proid]&mstbiayaid=$data_biaya[mst_biaya_id]'><i class='fa fa-pencil-square-o'></i></a> |";
												?>  
												<a title='Hapus' href='modul/mod_biaya/aksi_biaya.php?mod=biaya&act=delete&id=<?php echo $data_biaya[mst_biaya_id];?>&proid=<?php echo $_GET[proid];?>' onclick="return confirm('Anda Yakin Ingin Menghapus Master Biaya Tahun <?php echo $data_biaya[tahun_angkatan]." - ".$semester; ?>?');"><i class='fa fa-trash'></i></a><?php
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

	<?php
	}
	if ($_GET['act'] == 'view' && $_GET['mstbiayaid'] != '' && $_GET['sess'] == ''){
		$data_angkatan = $db->database_fetch_array($db->database_prepare("SELECT tahun_angkatan,semester_angkatan FROM mst_biaya INNER JOIN angkatan ON angkatan.angkatan_id=mst_biaya.angkatan_id WHERE mst_biaya.mst_biaya_id = ?")->execute($_GET["mstbiayaid"]));
		if ($data_angkatan['semester_angkatan'] == '1'){
			$sem_ang = "Ganjil";
		} 
		else{
			$sem_ang = "Genap";
		}
	?> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                               Akun Biaya <br>Th. Angkatan: <?php echo $data_angkatan['tahun_angkatan']; ?> - <?php echo $sem_ang; ?>
                            </h5>
                            <div id='toolbar'>
                            	<button type="button" onclick="window.location.href='?mod=biaya&act=view&sess=akun_add&proid=<?php echo $_GET['proid']; ?>&mstbiayaid=<?php echo $_GET['mstbiayaid']; ?>'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Akun Biaya</button>
                            </div>
                            <table data-toolbar="#toolbar" data-toggle="table" data-search="true"  data-only-info-pagination="false" data-pagination="true" data-buttons-class="purple" data-page-list="[10, 25, 50, 100, ALL]" data-show-footer="false" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Biaya</th>
									<th>Nominal</th>
									<th>Semester</th>
									<th>Program</th>
									<th>Status</th>
									<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
								$sql_akun_biaya = $db->database_prepare("SELECT * FROM akun_biaya WHERE mst_biaya_id = ? ORDER BY semester DESC")->execute($_GET["mstbiayaid"]);
								while ($data_akun_biaya = $db->database_fetch_array($sql_akun_biaya)){
									
									
									if($data_akun_biaya['aktif'] == 'A'){
										$status = "<span class='badge-success badge'>Aktif</span>";
									}
									else{
										$status = "<span class='badge-danger badge'>Tidak Aktif</span>";
									}
									
									if($data_akun_biaya['program'] == 'A'){
										$program = "Reguler";
									}
									else{
										$program = "Non-Reguler";
									}
									$nominal = number_format($data_akun_biaya[biaya]);
                                    echo "
									<tr>
										<td>$no</td>
										<td>$data_akun_biaya[nama_biaya]</td>
										<td>$nominal</td>
										<td>$data_akun_biaya[semester]</td>
										<td>$program</td>
										<td>$status</td>
										<td><a title='Edit' href='?mod=biaya&act=edit&sess=akun_edit&id=$data_akun_biaya[akun_id]&proid=$_GET[proid]&mstbiayaid=$_GET[mstbiayaid]'><i class='fa fa-pencil-square-o'></i></a> |";
										?>
										<a title='Hapus' href='modul/mod_biaya/aksi_biaya.php?mod=akun_biaya&act=delete&id=<?php echo $data_akun_biaya[akun_id];?>&mstbiayaid=<?php echo $_GET[mstbiayaid];?>&proid=<?php echo $_GET[proid];?>' onclick="return confirm('Anda Yakin ingin menghapus akun biaya <?php echo $data_akun_biaya[nama_biaya];?>?');"><i class='fa fa-trash'></i></a>
										<?php
								echo "		</td>
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

	elseif ($_GET['sess'] == 'akun_add'){
	?>
		<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Akun Biaya
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_biaya/aksi_biaya.php?mod=akun_biaya&act=input" method="POST" />
                            <input type="hidden" name="mst_biaya_id" value="<?php echo $_GET['mstbiayaid']; ?>">
							<input type="hidden" name="proid" value="<?php echo $_GET['proid']; ?>">
                                <fieldset>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nama Biaya</label>
                                        <input type="text" class="form-control" name="nama_biaya" id="exampleInputEmail4" required="" />
                                        <div class="help-block form-text text-muted form-control-feedback">
                                            Contoh : SPP/Skripsi/MKA/dll
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Nominal Biaya</label>
                                          <input type="text" class="form-control" name="biaya" required="" />
                                          <div class="help-block form-text text-muted form-control-feedback">
                                            1000000
                                          </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
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
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status Biaya</label>
                                          <select name="status" class="form-control" required="">
                                            <option value="">- None -</option>
											<option value="A">Aktif</option>
											<option value="N">Tidak Aktif</option>
                                          </select>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=biaya'">Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php
	}
	break;
	
	case "add":
    ?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Master Biaya
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_biaya/aksi_biaya.php?mod=biaya&act=input" method="POST" />
                                <fieldset>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Program Studi</label>
                                          <select name="prodi" class="form-control">
											<?php
											$sql_prodi = $db->database_prepare("SELECT * FROM prodi WHERE prodi_id = ? ")->execute($_GET['proid']);
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
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Tahun Angkatan</label>
                                          <select name="tahun" class="form-control" required="">
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
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Keterangan</label>
                                          <textarea class="form-control" name="keterangan" id="exampleTextarea" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=biaya'">Cancel</button>
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
	$data_biaya = $db->database_fetch_array($db->database_prepare("SELECT * FROM mst_biaya LEFT JOIN prodi ON prodi.prodi_id=mst_biaya.prodi_id WHERE mst_biaya.mst_biaya_id = ?")->execute($_GET["mstbiayaid"]));
	if ($data_biaya['jenjang_studi_id'] == 'A'){
		$kd_jenjang_studi = "S3";
	}
	elseif ($data_biaya['jenjang_studi_id'] == 'B'){
		$kd_jenjang_studi = "S2";
	}
	elseif ($data_biaya['jenjang_studi_id'] == 'C'){
		$kd_jenjang_studi = "S1";
	}
	elseif ($data_biaya['jenjang_studi_id'] == 'D'){
		$kd_jenjang_studi = "D4";
	}
	elseif ($data_biaya['jenjang_studi_id'] == 'E'){
		$kd_jenjang_studi = "D3";
	}
	elseif ($data_biaya['jenjang_studi_id'] == 'F'){
		$kd_jenjang_studi = "D2";
	}
	elseif ($data_biaya['jenjang_studi_id'] == 'G'){
		$kd_jenjang_studi = "D1";
	}
	elseif ($data_biaya['jenjang_studi_id'] == 'H'){
		$kd_jenjang_studi = "Sp-1";
	}
	elseif ($data_biaya['jenjang_studi_id'] == 'I'){
		$kd_jenjang_studi = "Sp-2";
	}
	else{
		$kd_jenjang_studi = "Profesi";
	}
	
	if ($_GET['sess'] == 'akun_edit'){
		$data_akun = $db->database_fetch_array($db->database_prepare("SELECT * FROM akun_biaya WHERE akun_id = ?")->execute($_GET["id"]));
		?>
		<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Ubah Akun Biaya
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_biaya/aksi_biaya.php?mod=akun_biaya&act=update" method="POST" />
                            <input type="hidden" name="mst_biaya_id" value="<?php echo $_GET['mstbiayaid']; ?>">
							<input type="hidden" name="proid" value="<?php echo $_GET['proid']; ?>">
							<input type="hidden" name="id" value="<?php echo $data_akun['akun_id']; ?>">
                                <fieldset>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nama Biaya</label>
                                        <input type="text" class="form-control" name="nama_biaya" id="exampleInputEmail4" value="<?php echo $data_akun['nama_biaya']; ?>"/>
                                        <div class="help-block form-text text-muted form-control-feedback">
                                            Contoh : SPP/Skripsi/MKA/dll
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Nominal Biaya</label>
                                          <input type="text" class="form-control" name="biaya" value="<?php echo $data_akun['biaya']; ?>"/>
                                          <div class="help-block form-text text-muted form-control-feedback">
                                            1000000
                                          </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Program Kuliah</label>
                                          <select name="program" class="form-control">
                                            <option value="A" <?php if($data_akun['program'] == 'A'){ echo "SELECTED"; } ?>>Reguler</option>
											<option value="B" <?php if($data_akun['program'] == 'B'){ echo "SELECTED"; } ?>>Non-Reguler</option>
                                          </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Semester</label>
                                          <select name="semester" class="form-control">
                                            <option value="">- None -</option>
											<option value="1" <?php if($data_akun['semester'] == 1){ echo "SELECTED"; } ?>>1</option>
											<option value="2" <?php if($data_akun['semester'] == 2){ echo "SELECTED"; } ?>>2</option>
											<option value="3" <?php if($data_akun['semester'] == 3){ echo "SELECTED"; } ?>>3</option>
											<option value="4" <?php if($data_akun['semester'] == 4){ echo "SELECTED"; } ?>>4</option>
											<option value="5" <?php if($data_akun['semester'] == 5){ echo "SELECTED"; } ?>>5</option>
											<option value="6" <?php if($data_akun['semester'] == 6){ echo "SELECTED"; } ?>>6</option>
											<option value="7" <?php if($data_akun['semester'] == 7){ echo "SELECTED"; } ?>>7</option>
											<option value="8" <?php if($data_akun['semester'] == 8){ echo "SELECTED"; } ?>>8</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status Biaya</label>
                                          <select name="status" class="form-control">
                                            <option value="">- None -</option>
											<option value="A" <?php if($data_akun['aktif'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
											<option value="N" <?php if($data_akun['aktif'] == 'N'){ echo "SELECTED"; } ?>>Tidak Aktif</option>
                                          </select>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=biaya'">Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
	else{
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Ubah Master Biaya
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_biaya/aksi_biaya.php?mod=biaya&act=update" method="POST" />
                            <input type="hidden" name="id" value="<?php echo $data_biaya['mst_biaya_id']; ?>">
							<input type="hidden" name="prodi" value="<?php echo $data_biaya['prodi_id']; ?>">
                                <fieldset>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Program Studi</label>
                                          <input type="text" class="form-control" name="" value="<?php echo $kd_jenjang_studi." - ".$data_biaya['nama_prodi']; ?>" readonly>
                                    </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Angkatan Mahasiswa</label>
	                                          <select name="tahun" class="form-control">
												<?php 
												$sql_angkatan = $db->database_prepare("SELECT * FROM angkatan WHERE status = 'A' ORDER BY angkatan_id DESC")->execute();
												while ($data_angkatan = $db->database_fetch_array($sql_angkatan)){
													if ($data_angkatan['semester_angkatan'] == '1'){
														$semester = "Ganjil";
													}
													else{
														$semester = "Genap";
													}
													
													if ($data_biaya['angkatan_id'] == $data_angkatan['angkatan_id']){
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
                                </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Keterangan</label>
                                          <textarea class="form-control" name="keterangan" id="exampleTextarea" rows="3"><?php echo $data_biaya['keterangan']; ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=biaya'">Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
	
	<?php
	}
	break;
}
?>