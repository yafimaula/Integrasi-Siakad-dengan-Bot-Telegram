<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i> Success!</h5>
		<p>Data Program Studi Baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'> 
		<h5><i class='fa fa-check'></i> Success!</h5>
		<p>Data Program Studi berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'> 
		<h5><i class='fa fa-check'></i> Success!</h5>
		<p>Data Program Studi berhasil dihapus.</p>
	</div>
<?php
}
?>

<?php
switch ($_GET['act']) {
	
	default:
	?>
		<!--Begin Content-->
        <div class="content">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                                Data Prodi
                            </h5>
                             <button type="button" onclick="window.location.href='?mod=prodi&act=add'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Prodi</button>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Program Studi</th>
									<th>Jenjang Studi</th>
									<th>Fakultas</th>
									<th>Akreditasi</th>
									<th>Ketua Program Studi</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $no = 1;
                                  $sql_prodi = $db->database_prepare("SELECT C.nama_dosen,
												C.gelar,
												A.nama_prodi, 
												A.prodi_id,
												A.jenjang_studi_id,
												B.nama_fak, 
												A.akreditasi,
												A.nama_prodi,
												A.kaprodi
												FROM prodi A INNER JOIN 
												fakultas B 
												ON A.fakultas_id=B.fakultas_id
												LEFT JOIN dosen C 
												ON C.dosen_id=A.kaprodi")->execute();
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
										
										if($data_prodi['akreditasi'] == 'A'){
											$kd_status = "Berakreditas A";
										}
										elseif($data_prodi['akreditasi'] == 'B'){
											$kd_status = "Berakreditas B";
										}
										elseif($data_prodi['akreditasi'] == 'C'){
											$kd_status = "Berakreditas C";
										}
										elseif($data_prodi['akreditasi'] == 'D'){
											$kd_status = "Berakreditas D";
										}
										elseif($data_prodi['akreditasi'] == 'U'){
											$kd_status = "Unggul";
										}
										else{
											$kd_status = "Belajar";
										}
										//<td>$data_prodi[nama_jurusan]</td>
										//<td>$data_prodi[KDPSTMSPST]</td>
										echo "
										<tr>
											<td>$no</td>
											<td>$data_prodi[nama_prodi]</td>
											<td>$kd_jenjang_studi</td>
											<td>$data_prodi[nama_fak]</td>
											<td>$kd_status</td>
											<td>$data_prodi[nama_dosen] $data_prodi[gelar]</td>
											<td><a href='?mod=prodi&act=edit&id=$data_prodi[prodi_id]'><i class='fa fa-pencil-square-o'></i></a> |";
										?>
                                        <a href='modul/mod_prodi/aksi_prodi.php?mod=prodi&act=delete&id=<?php echo $data_prodi[prodi_id]; ?>' onclick="return confirm('Anda Yakin ingin menghapus Program Studi <?php echo $data_prodi[nama_prodi];?>?');"><i class='fa fa-trash'></i></a>
                                        <?php
                                        echo "
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
        <!--End Content-->
        <?php
		break;

	case "add":
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Prodi
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_prodi/aksi_prodi.php?mod=prodi&act=input" method="POST" />
                                <fieldset>
                                  <div class="row">
                                	<div class="col-sm-6">
                                		<div class="form-group">
                                          <label for="exampleInputEmail4">Jenjang Studi</label>
                                          <select name="kd_jenjang_studi" class="form-control">
											<option value="">- None -</option>
											<option value="A">S3</option>
											<option value="B">S2</option>
											<option value="C">S1</option>
											<option value="D">D4</option>
											<option value="E">D3</option>
											<option value="F">D2</option>
											<option value="G">D1</option>
											<option value="J">Profesi</option>
										  </select>
                                     	</div>
                                     </div>
                                     <div class="col-sm-6">
                                     	<div class="form-group">
                                          <label for="exampleInputEmail4">Fakultas</label>
                                          <select name="fakultas_id" class="form-control">
											<option value="">- None -</option>
											<?php
											$sql_fakultas = $db->database_prepare("SELECT * FROM fakultas WHERE status = 'A'")->execute();
											while ($data_fakultas = $db->database_fetch_array($sql_fakultas)){
												echo "<option value=$data_fakultas[fakultas_id]>$data_fakultas[nama_fak]</option>";
											}
											?>
										 </select>
                                     </div>
                                     </div>
                                   </div>
                                   <div class="row">
                                   	   <div class="col-sm-12">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Nama Program Studi</label>
	                                        <input type="text" class="form-control" name="nama" id="exampleInputEmail4" required="" />
	                                    </div>
	                                   </div>
                                    </div>
                                    <div class="row">
                                   	   <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Status</label>
	                                          <select name="status" class="form-control" required="">
												<option value="">- None -</option>
												<option value="A">Aktif</option>
												<option value="N">Non-Aktif</option>
											</select>
                                    	</div>
	                                   </div>
	                                   <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Akreditasi</label>
	                                          <select name="akreditasi" class="form-control">
												<option value="0">- None -</option>
												<option value="A">Berakreditasi "A"</option>
												<option value="B">Berakreditasi "B"</option>
												<option value="C">Berakreditasi "C"</option>
												<option value="D">Berakreditasi "D"</option>
												<option value="U">Unggul</option>
												<option value="L">Belajar</option>
											</select>
                                    	</div>
                                       </div>
                                       <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Kepala Prodi</label>
	                                          <select name="kaprodi" class="form-control">
												<option value="">- None -</option>
													<?php
													$sql_dosen = $db->database_prepare("SELECT * FROM dosen WHERE status = 'A' ORDER BY nama_dosen ASC")->execute();
													while ($data_dosen = $db->database_fetch_array($sql_dosen)){
														echo "<option value='$data_dosen[dosen_id]'>$data_dosen[dosen] - $data_dosen[nama_dosen] $data_dosen[gelar]</option>";
													}
													?>
											</select>
                                    	</div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" onclick="window.location.href='?mod=prodi'" class="btn btn-default">Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	
	<?php
	break;

case 'edit':
	$data_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM prodi INNER JOIN fakultas ON prodi.fakultas_id=fakultas.fakultas_id WHERE prodi_id = ?")->execute($_GET["id"]));
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Edit Prodi
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                    <i class="material-icons" data-box="close">close</i>
                                </div>
                            </h5>
                            <form action="modul/mod_prodi/aksi_prodi.php?mod=prodi&act=update" method="POST" />
                                <fieldset>
                                <input type="hidden" name="id" value="<?php echo $data_prodi['prodi_id']; ?>">
                                  <div class="row">
                                	<div class="col-sm-6">
                                		<div class="form-group">
                                          <label for="exampleInputEmail4">Kode Jenjang Studi</label>
                                          <select name="kd_jenjang_studi" class="form-control">
											<option value="A" <?php if($data_prodi['jenjang_studi_id'] == 'A'){ echo "SELECTED"; } ?>>S3</option>
											<option value="B" <?php if($data_prodi['jenjang_studi_id'] == 'B'){ echo "SELECTED"; } ?>>S2</option>
											<option value="C" <?php if($data_prodi['jenjang_studi_id'] == 'C'){ echo "SELECTED"; } ?>>S1</option>
											<option value="D" <?php if($data_prodi['jenjang_studi_id'] == 'D'){ echo "SELECTED"; } ?>>D4</option>
											<option value="E" <?php if($data_prodi['jenjang_studi_id'] == 'E'){ echo "SELECTED"; } ?>>D3</option>
											<option value="F" <?php if($data_prodi['jenjang_studi_id'] == 'F'){ echo "SELECTED"; } ?>>D2</option>
											<option value="G" <?php if($data_prodi['jenjang_studi_id'] == 'G'){ echo "SELECTED"; } ?>>D1</option>
											<option value="H" <?php if($data_prodi['jenjang_studi_id'] == 'H'){ echo "SELECTED"; } ?>>Sp-1</option>
											<option value="I" <?php if($data_prodi['jenjang_studi_id'] == 'I'){ echo "SELECTED"; } ?>>Sp-2</option>
											<option value="J" <?php if($data_prodi['jenjang_studi_id'] == 'J'){ echo "SELECTED"; } ?>>Profesi</option>
										  </select>
                                     	</div>
                                     </div>
                                     <div class="col-sm-6">
                                     	<div class="form-group">
                                          <label for="exampleInputEmail4">Fakultas</label>
                                          <select name="fakultas_id" class="form-control">
											<?php
												$sql_fakultas = $db->database_prepare("SELECT * FROM fakultas WHERE status = 'A'")->execute();
												while ($data_fakultas = $db->database_fetch_array($sql_fakultas)){
													if ($data_prodi['fakultas_id'] == $data_fakultas['fakultas_id']){
														echo "<option value=$data_fakultas[fakultas_id] SELECTED>$data_fakultas[nama_fak]</option>";
													}
													else{
														echo "<option value=$data_fakultas[fakultas_id]>$data_fakultas[nama_fak]</option>";
													}
												}
											?>
										 </select>
                                     </div>
                                     </div>
                                   </div>
                                   <div class="row">
                                   	   <div class="col-sm-12">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">Nama Program Studi</label>
	                                        <input type="text" class="form-control" name="nama" id="exampleInputEmail4" value="<?php echo $data_prodi['nama_prodi']; ?>" />
	                                    </div>
	                                   </div>
                                    </div>
                                    <div class="row">
                                   	   <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Status</label>
	                                          <select name="status" class="form-control">
												<option value="A" <?php if($data_prodi['status'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
												<option value="N" <?php if($data_prodi['status'] == 'N'){ echo "SELECTED"; } ?>>Non-Aktif</option>
											</select>
                                    	</div>
	                                   </div>
	                                   <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Akreditasi</label>
	                                          <select name="akreditasi" class="form-control">
												<option value="0">- none -</option>
												<option value="A" <?php if($data_prodi['akreditasi'] == 'A'){ echo "SELECTED"; } ?>>A</option>
												<option value="B" <?php if($data_prodi['akreditasi'] == 'B'){ echo "SELECTED"; } ?>>B</option>
												<option value="C" <?php if($data_prodi['akreditasi'] == 'C'){ echo "SELECTED"; } ?>>C</option>
												<option value="D" <?php if($data_prodi['akreditasi'] == 'D'){ echo "SELECTED"; } ?>>D</option>
												<option value="U" <?php if($data_prodi['akreditasi'] == 'U'){ echo "SELECTED"; } ?>>Unggul</option>
												<option value="L" <?php if($data_prodi['akreditasi'] == 'L'){ echo "SELECTED"; } ?>>Belajar</option>
											</select>
                                    	</div>
                                       </div>
                                       <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Kepala Prodi</label>
	                                          <select name="kaprodi" class="form-control">
												<option value="">- None -</option>
													<?php
													$sql_dosen = $db->database_prepare("SELECT * FROM dosen WHERE status = 'A' ORDER BY nama_dosen ASC")->execute();
													while ($data_dosen = $db->database_fetch_array($sql_dosen)){
														if ($data_prodi['kaprodi'] == $data_dosen['dosen_id']){
														echo "<option value='$data_dosen[dosen_id]' SELECTED>$data_dosen[nama_dosen] $data_dosen[gelar]</option>";
													}
													else{
														echo "<option value='$data_dosen[dosen_id]'>$data_dosen[nama_dosen] $data_dosen[gelar]</option>";
													}
													}
													?>
											</select>
                                    	</div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=prodi'">Cancel</button>
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