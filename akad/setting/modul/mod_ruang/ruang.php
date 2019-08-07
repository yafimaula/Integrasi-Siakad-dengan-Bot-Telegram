<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Ruang berhasil disimpan.</p>
	</div>
<?php 
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Ruang berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Ruang berhasil dihapus.</p>
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
                                Data Ruangan
                            </h5>
                             <button type="button" onclick="window.location.href='?mod=ruang&act=add'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Ruangan</button>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th width='30'>No</th>
									<th width='150'>Nama Ruang</th>
									<th width='110'>Jenis</th>
									<th width='100'>Status</th>
									<th width='200'>Kepala Ruang</th>
									<th align='left'>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $no = 1;
                                  $sql_ruang = $db->database_prepare("SELECT * FROM ruang LEFT JOIN dosen ON dosen.dosen_id=ruang.head_id ORDER BY nama_ruang ASC")->execute();
									while ($data_ruang = $db->database_fetch_array($sql_ruang)){
										if ($data_ruang['aktif'] == 'A'){
											$status = "Aktif";
										}
										else{
											$status = "Tidak Aktif";
										}
										
										if ($data_ruang['jenis'] == 'A'){
											$jenis = "Kelas";
										}
										elseif ($data_ruang['jenis'] == 'B'){
											$jenis = "Laboratorium";
										}
										else{
											$jenis = "Auditorium";
										}
										echo "
										<tr>
											<td>$no</td>
											<td>$data_ruang[nama_ruang]</td>
											<td>$jenis</td>
											<td>$status</td>
											<td>$data_ruang[nama_dosen] $data_ruang[gelar]</td>
											<td><a title='Ubah' href='?mod=ruang&act=edit&id=$data_ruang[ruang_id]'><i class='fa fa-pencil-square-o'></i> </a> |";
											?>
												<a title='Hapus' href='modul/mod_ruang/aksi_ruang.php?mod=ruang&act=delete&id=<?php echo "$data_ruang[ruang_id]"?>' onclick="return confirm('Anda Yakin ingin menghapus ruang <?php echo $data_ruang[nama_ruang]." ".$semester;?>?');"><i class='fa fa-trash'></i></a>
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
	$sql_urut = $db->database_prepare("SELECT kode_ruang FROM ruang ORDER BY ruang_id DESC LIMIT 1")->execute();
	$num_urut = $db->database_num_rows($sql_urut);
	
	$data_urut = $db->database_fetch_array($sql_urut);
	$awal = substr($data_urut['kode_ruang'],0-4);
	$next = $awal + 1;
	$jnim = strlen($next);
	
	if (!$data_urut['kode_ruang']){
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
		$kr = "R".$no;
	}
	else{
		$kr = "R".$no.$next;
	}
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Ruangan
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5> 
                            <form action="modul/mod_ruang/aksi_ruang.php?mod=ruang&act=input" method="POST" />
                                <fieldset>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Nama Ruangan</label>
                                          <input type="text" name="nama_ruang" class="form-control">
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Jenis Ruangan</label>
                                          <select name="jenis" class="form-control">
	                                          <option value="">- None -</option>
											  <option value="A">Kelas</option>
											  <option value="B">Laboratorium</option>
											  <option value="C">Auditorium</option>
										  </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status Ruangan</label>
                                          <select name="status" class="form-control">
	                                          <option value="">- None -</option>
											  <option value="A">Aktif</option>
											  <option value="B">Tidak Aktif</option>
										  </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Kepala Ruangan</label>
                                          <select name="head_id" class="form-control">
                                          	<option value="">- None -</option>
	                                        <?php
											$sql_dosen = $db->database_prepare("SELECT * FROM dosen WHERE status = 'A' ORDER BY nidn ASC")->execute();
												while ($data_dosen = $db->database_fetch_array($sql_dosen)){
													echo "<option value=$data_dosen[dosen_idn]>$data_dosen[nidn] - $data_dosen[nama_dosen] $data_dosen[gelar]</option>";
											} 
											?>
										  </select>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=ruang'">Cancel</button>
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
	$data_ruang = $db->database_fetch_array($db->database_prepare("SELECT * FROM ruang WHERE ruang_id = ?")->execute($_GET["id"]));
	
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Edit Ruangan
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5> 
                            <form action="modul/mod_ruang/aksi_ruang.php?mod=ruang&act=update" method="POST" />
                            <input type="hidden" name="id" value="<?php echo $data_ruang['ruang_id']; ?>">
                                <fieldset>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Nama Ruangan</label>
                                          <input type="text" name="nama_ruang" class="form-control" value="<?php echo $data_ruang['nama_ruang']; ?>">
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Jenis Ruangan</label>
                                          <select name="jenis" class="form-control">
	                                          <option value="A" <?php if($data_ruang['jenis'] == 'A'){ echo "SELECTED"; } ?>>Kelas</option>
											  <option value="B" <?php if($data_ruang['jenis'] == 'B'){ echo "SELECTED"; } ?>>Laboratorium</option>
											  <option value="C" <?php if($data_ruang['jenis'] == 'C'){ echo "SELECTED"; } ?>>Auditorium</option>
										  </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status Ruangan</label>
                                          <select name="status" class="form-control">
	                                          <option value="A" <?php if($data_ruang['aktif'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
											  <option value="B" <?php if($data_ruang['aktif'] == 'B'){ echo "SELECTED"; } ?>>Tidak Aktif</option>
										  </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Kepala Ruangan</label>
                                          <select name="head_id" class="form-control">
                                          	<option value="">- None -</option>
	                                        <option value="">- none -</option>	
											<?php
											$sql_dosen = $db->database_prepare("SELECT * FROM dosen WHERE status = 'A' ORDER BY nidn ASC")->execute();
											while ($data_dosen = $db->database_fetch_array($sql_dosen)){
												if ($data_dosen['dosen_id'] == $data_ruang['head_id']){
													echo "<option value=$data_dosen[dosen_id] SELECTED>$data_dosen[nidn] - $data_dosen[nama_dosen] $data_dosen[gelar]</option>";
												}
												else{
													echo "<option value=$data_dosen[dosen_id]>$data_dosen[nidn] - $data_dosen[nama_dosen] $data_dosen[gelar]</option>";
												}
											} 
											?>
										  </select>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=ruang'">Cancel</button>
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