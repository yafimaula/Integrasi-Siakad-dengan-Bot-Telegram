<?php 
if ($_GET['code'] == 1){ 
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Tahun Angkatan Baru berhasil disimpan.</p>  
	</div>
<?php 
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Tahun Angkatan berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Tahun Angkatan berhasil dihapus.</p>
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
                                Data Tahun Angkatan
                            </h5>
                             <button type="button" onclick="window.location.href='?mod=angkatan&act=add'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Tahun Angkatan</button>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>Tahun Angkatan</th>
									<th>Semester</th>
									<th>Status</th>
									<th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $no = 1;
                                  $sql_angkatan = $db->database_prepare("SELECT * FROM angkatan ORDER BY angkatan_id ASC")->execute();
									while ($data_angkatan = $db->database_fetch_array($sql_angkatan)){
										if ($data_angkatan['status'] == 'A'){
											$status_angkatan = "<span class='badge-success badge'>Aktif</span>";
										}
										else{
											$status_angkatan = "<span class='badge-danger badge'>Non-Aktif</span>";
										}
										if ($data_angkatan['semester_angkatan'] == '1'){
											$semester = "Ganjil";
										}
										elseif($data_angkatan['semester_angkatan'] == '2'){
											$semester = "Genap";
										}
										echo "
										<tr>
											<td>$no</td>
											<td>$data_angkatan[tahun_angkatan]</td>
											<td>$semester</td>
											<td>$status_angkatan</td>
											<td><a title='Ubah' href='?mod=angkatan&act=edit&id=$data_angkatan[angkatan_id]'><i class='fa fa-pencil-square-o'></i> </a> | ";
											?>
												<a title='Hapus' href='modul/mod_angkatan/aksi_angkatan.php?mod=angkatan&act=delete&id=<?php echo "$data_angkatan[angkatan_id]"?>' onclick="return confirm('Anda Yakin ingin menghapus angkatan <?php echo $data_angkatan[tahun_angkatan]." ".$semester;?>?');"><i class='fa fa-trash'></i></a>
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
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Tahun Angkatan
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5> 
                            <form action="modul/mod_angkatan/aksi_angkatan.php?mod=angkatan&act=input" method="POST" />
                                <fieldset>
                                	
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Tahun Angkatan</label>
                                        <input type="text" class="form-control" name="tahun_angkatan" id="exampleInputEmail4" required="" />
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Semester</label>
                                          <select name="semester" class="form-control" required="">
	                                          <option value="">- None -</option>
											  <option value="1">Ganjil</option>
											  <option value="2">Genap</option>
										  </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status</label>
                                          <select name="status" class="form-control" required="">
	                                          <option value="">- None -</option>
											  <option value="A">Aktif</option>
											  <option value="N">Non-Aktif</option>
										  </select>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=angkatan'">Cancel</button>
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
	$data_angkatan = $db->database_fetch_array($db->database_prepare("SELECT * FROM angkatan WHERE angkatan_id = ?")->execute($_GET["id"]));
	
	if ($data_angkatan['status'] == 'A'){
		$statusA = "SELECTED";
	}
	elseif($data_angkatan['status'] == 'N'){
		$statusN = "SELECTED";
	}
	else{
		$statusA = "";
		$statusN = "";
	}
	
	if ($data_angkatan['semester_angkatan'] == '1'){
		$semesterA = "SELECTED";
	}
	elseif($data_angkatan['semester_angkatan'] == '2'){
		$semesterB = "SELECTED";
	}
	else{
		$semesterA = "";
		$semesterB = "";
	}
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Edit Tahun Angkatan
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                    <i class="material-icons" data-box="close">close</i>
                                </div>
                            </h5> 
                            <form action="modul/mod_angkatan/aksi_angkatan.php?mod=angkatan&act=update" method="POST" />
                                <fieldset>
                                	<input type="hidden" name="id" value="<?php echo $data_angkatan['angkatan_id']; ?>">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Tahun Angkatan</label>
                                        <input type="text" class="form-control" name="tahun_angkatan" id="exampleInputEmail4" value="<?php echo $data_angkatan['tahun_angkatan']; ?>" />
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Semester</label>
                                          <select name="semester" class="form-control">
											  <option value="1" <?php if($data_angkatan['semester_angkatan'] == '1'){ echo "SELECTED"; } ?>>Ganjil</option>
											  <option value="2" <?php if($data_angkatan['semester_angkatan'] == '2'){ echo "SELECTED"; } ?>>Genap</option>
										  </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status</label>
                                          <select name="status" class="form-control">
	                                          <option value="A" <?php if($data_angkatan['status'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
											  <option value="N" <?php if($data_angkatan['status'] == 'N'){ echo "SELECTED"; } ?>>Non-Aktif</option>
										  </select>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=angkatan'">Cancel</button>
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