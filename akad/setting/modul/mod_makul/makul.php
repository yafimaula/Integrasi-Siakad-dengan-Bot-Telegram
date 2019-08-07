<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Mata kuliah berhasil disimpan.</p>
	</div>
<?php
} 
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Mata kuliah berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Mata kuliah berhasil dihapus.</p>
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
                                Data Mata Kuliah
                            </h5>
                             <button type="button" onclick="window.location.href='?mod=makul&act=add'" class="btn btn-primary" ><i class='fa fa-plus-square'></i> Tambah Mata Kuliah</button>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Kode</th>
									<th>Mata Kuliah</th>
									<th>Program Studi</th>
									<th>Jenis MK</th>
									<th>SKS</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $no = 1;
                                  $sql_makul = $db->database_prepare("SELECT * FROM makul m LEFT JOIN prodi p ON p.prodi_id=m.prodi_id ORDER BY m.prodi_id,nama_mata_kuliah ASC")->execute();
								  while ($data_makul = $db->database_fetch_array($sql_makul)){
								  		if ($data_makul['jenis_mata_kuliah'] == 'A'){
											$jenis_mk = "MK Wajib Umum";
										}
										elseif ($data_makul['jenis_mata_kuliah'] == 'B'){
											$jenis_mk = "MK Wajib Prodi";
										}
										elseif ($data_makul['jenis_mata_kuliah'] == 'C'){
											$jenis_mk = "MK Pilihan Mandiri";
										}
										else{
											$jenis_mk = "-";
										}
										
										if ($data_makul['jenjang_studi_id'] == 'A'){
											$kd_jenjang_studi = "S3";
										}
										elseif ($data_makul['jenjang_studi_id'] == 'B'){
											$kd_jenjang_studi = "S2";
										}
										elseif ($data_makul['jenjang_studi_id'] == 'C'){
											$kd_jenjang_studi = "S1";
										}
										elseif ($data_makul['jenjang_studi_id'] == 'D'){
											$kd_jenjang_studi = "D4";
										}
										elseif ($data_makul['jenjang_studi_id'] == 'E'){
											$kd_jenjang_studi = "D3";
										}
										elseif ($data_makul['jenjang_studi_id'] == 'F'){
											$kd_jenjang_studi = "D2";
										}
										elseif ($data_makul['jenjang_studi_id'] == 'G'){
											$kd_jenjang_studi = "D1";
										}
										elseif ($data_makul['jenjang_studi_id'] == 'H'){
											$kd_jenjang_studi = "Sp-1";
										}
										elseif ($data_makul['jenjang_studi_id'] == 'I'){
											$kd_jenjang_studi = "Sp-2";
										}
										else{
											$kd_jenjang_studi = "Profesi";
										}
										echo "
										<tr>
											<td>$no</td>
											<td>$data_makul[kode_mata_kuliah]</td>
											<td>$data_makul[nama_mata_kuliah]</td>
											<td>$kd_jenjang_studi $data_makul[nama_prodi]</td>
											<td align=center>$jenis_mk</td>
											<td align=center>$data_makul[sks]</td>
											<td><a title='Ubah' href='?mod=makul&act=edit&id=$data_makul[mata_kuliah_id]'><i class='fa fa-pencil-square-o'></i> </a> |";
											?>
											<a title='Hapus' href='modul/mod_makul/aksi_makul.php?mod=makul&act=delete&id=<?php echo $data_makul[mata_kuliah_id];?>' onclick="return confirm('Anda Yakin ingin menghapus mata kuliah <?php echo $data_makul[nama_mata_kuliah];?>?');"><i class='fa fa-trash'></i> </a>
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

	break;
	
	case "add":
	$sql_urut = $db->database_prepare("SELECT kode_mata_kuliah FROM makul ORDER BY mata_kuliah_id DESC LIMIT 1")->execute();
	$num_urut = $db->database_num_rows($sql_urut);
	
	$data_urut = $db->database_fetch_array($sql_urut);
	$awal = substr($data_urut['kode_mata_kuliah'],0-4);
	$next = $awal + 1;
	$jnim = strlen($next);
	
	if (!$data_urut['kode_mata_kuliah']){
		$no = "0001";
	}
	elseif($jnim == 1){
		$no = "000";
	} 
	elseif($jnim == 2){
		$no = "00";
	}
	elseif($jnim == 3){
		$no = "0";
	}
	elseif($jnim == 4){
		$no = "";
	}
	if ($num_urut == 0){
		$npm = "MK".$no;
	}
	else{
		$npm = "MK".$no.$next;
	}	
		
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Mata Kuliah
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_makul/aksi_makul.php?mod=makul&act=input" method="POST" />
                                <fieldset>
	                               	<div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Kode Mata Kuliah</label>
	                                        <input type="text" class="form-control" name="kode_mata_kuliah" id="exampleInputEmail4" value="<?php echo $npm; ?>" DISABLED />
                                        	<input type="hidden" name="kode_mata_kuliah" size="40" maxlength="10" value="<?php echo $npm; ?>"></td>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Nama Mata Kuliah</label>
	                                        <input type="text" class="form-control" name="nama_mata_kuliah" id="exampleInputEmail4" placeholder="Manajemen Resiko" required="" />
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Program Studi</label>
	                                          <select name="prodi_id" class="form-control" required="">
	                                            <option value="">- None -</option>
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
													echo "<option value=$data_prodi[prodi_id]>$kd_jenjang_studi $data_prodi[nama_prodi]</option>";
												}
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">SKS</label>
	                                          <input type="number" class="form-control" name="sks" placeholder="Sistem Kredit Semester" required="" />
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-12">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Dosen Pengampu</label>
	                                          <select name="dosen_pengampu" class="form-control" required="">
	                                            <option value="">- None -</option>	
												<?php
												$sql_dosen = $db->database_prepare("SELECT * FROM dosen WHERE status = 'A' ORDER BY nama_dosen ASC")->execute();
												while ($data_dosen = $db->database_fetch_array($sql_dosen)){
													echo "<option value=$data_dosen[dosen_id]>$data_dosen[nidn] - $data_dosen[nama_dosen] $data_dosen[gelar]</option>";
												} 
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Jenis Mata Kuliah</label>
	                                          <select name="jenis_mata_kuliah" class="form-control">
	                                            <option value="">- None -</option>	
												<option value="A">MWU-MK Wajib Umum</option>
												<option value="B">MWP-MK Wajib Prodi</option>
												<option value="C">MPM-MK Pilihan Mandiri</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Status Mata Kuliah</label>
	                                          <select name="status_mata_kuliah" class="form-control" required="">
	                                            <option value="">- None -</option>	
												<option value="A">Aktif</option>
												<option value="B">Non-Aktif</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=makul'">Cancel</button>
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
	$data_makul = $db->database_fetch_array($db->database_prepare("SELECT * FROM makul WHERE mata_kuliah_id = ?")->execute($_GET["id"]));	
	?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Edit Mata Kuliah
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_makul/aksi_makul.php?mod=makul&act=update" method="POST" />
                            <input type="hidden" name="id" value="<?php echo $data_makul['mata_kuliah_id']; ?>">
                                <fieldset>
	                               	<div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Kode Mata Kuliah</label>
	                                        <input type="text" class="form-control" name="kode_mata_kuliah" id="exampleInputEmail4" value="<?php echo $data_makul['kode_mata_kuliah']; ?>" DISABLED />
                                        	<input type="hidden" name="kode_mata_kuliah" size="40" maxlength="10" value="<?php echo $data_makul['kode_mata_kuliah']; ?>"></td>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Nama Mata Kuliah</label>
	                                        <input type="text" class="form-control" name="nama_mata_kuliah" id="exampleInputEmail4" value="<?php echo $data_makul['nama_mata_kuliah']; ?>" />
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Program Studi</label>
	                                          <select name="prodi_id" class="form-control">
	                                            <option value="">- None -</option>
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
													if ($data_makul['prodi_id'] == $data_prodi['prodi_id']){
														echo "<option value=$data_prodi[prodi_id] SELECTED>$kd_jenjang_studi $data_prodi[nama_prodi]</option>";
													}
													else{
														echo "<option value=$data_prodi[prodi_id]>$kd_jenjang_studi $data_prodi[nama_prodi]</option>";
													}
												}
												?>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">SKS</label>
	                                          <input type="number" class="form-control" name="sks" value="<?php echo $data_makul['sks']; ?>" />
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
	                                  <div class="col-sm-12">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Dosen Pengampu</label>
	                                          <select name="dosen_pengampu" class="form-control">
												<?php
												$sql_dosen = $db->database_prepare("SELECT * FROM dosen WHERE status = 'A' ORDER BY nama_dosen ASC")->execute();
												while ($data_dosen = $db->database_fetch_array($sql_dosen)){
													if ($data_makul['nidn'] == $data_dosen['dosen_id']){
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
	                                <div class="row">
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Jenis Mata Kuliah</label>
	                                          <select name="jenis_mata_kuliah" class="form-control">
	                                            <option value="">- None -</option>	
												<option value="A" <?php if ($data_makul['jenis_mata_kuliah'] == 'A'){ echo "SELECTED"; } ?>>MWU-MK Wajib Umum</option>
												<option value="B" <?php if ($data_makul['jenis_mata_kuliah'] == 'B'){ echo "SELECTED"; } ?>>MWP-MK Wajib Prodi</option>
												<option value="C" <?php if ($data_makul['jenis_mata_kuliah'] == 'C'){ echo "SELECTED"; } ?>>MPM-MK Pilihan Mandiri</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-6">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Status Mata Kuliah</label>
	                                          <select name="status_mata_kuliah" class="form-control">
	                                            <option value="A" <?php if ($data_makul['status_mata_kuliah'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
												<option value="B" <?php if ($data_makul['status_mata_kuliah'] == 'B'){ echo "SELECTED"; } ?>>Non-Aktif</option>
	                                          </select>
	                                    </div>
	                                  </div>
	                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=makul'">Cancel</button>
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