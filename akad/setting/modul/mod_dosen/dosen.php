<?php
if ($_GET['act'] == 'add' || $_GET['act'] == 'edit'){
?>
	
<?php
}
?>

<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Dosen Baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Dosen berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Dosen berhasil dihapus.</p>
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
                                Data Dosen
                            </h5>
                             <button type="button" onclick="window.location.href='?mod=dosen&act=add'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Dosen</button>
                            <table id="data-table" class="table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama Dosen</th>
                                    <th>JK</th>
                                    <th>E-Mail</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $no = 1;
                                  $sql_dosen = $db->database_prepare("SELECT A.nidn, A.nama_dosen, A.gelar, A.jk, A.dosen_id, A.email
									                 FROM dosen A ORDER BY A.nidn ASC")->execute();
                                  while ($data_dosen = $db->database_fetch_array($sql_dosen)){
                                    
                                    echo "<tr>
                                      	<td>$no</td>
                    										<td>$data_dosen[nidn]</td>
                    										<td>$data_dosen[nama_dosen] $data_dosen[gelar]</td>
                    										<td>$data_dosen[jk]</td>
                    										<td>$data_dosen[email]</td>
                                      	<td><a title='Ubah' href='?mod=dosen&act=edit&id=$data_dosen[dosen_id]'><i class='fa fa-pencil-square-o'></i></a> |";
                    										?>
                    											<a title='Hapus' href='modul/mod_dosen/aksi_dosen.php?mod=dosen&act=delete&id=<?php echo "$data_dosen[dosen_id]"?>' onclick="return confirm('Anda Yakin ingin menghapus Dosen <?php echo $data_dosen[nama_dosen]." ".$data_dosen[gelar];?>?');" ><i class='fa fa-trash'></i></a>
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
	$tahun = date("Y");
	$month = date('m');
	$sql_urut = $db->database_prepare("SELECT nidn FROM dosen ORDER BY nidn DESC LIMIT 1")->execute();
	$num_urut = $db->database_num_rows($sql_urut);
	
	$data_urut = $db->database_fetch_array($sql_urut);
	$awal = substr($data_urut['nidn'],0-4);
	$next = $awal + 1;
	$jnim = strlen($next);
	
	if (!$data_urut['nidn']){
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
		$npm = $tahun.$month.$no;
	}
	else{
		$npm = $tahun.$month.$no.$next;
	}
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Dosen
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_dosen/aksi_dosen.php?mod=dosen&act=input" method="POST" enctype="multipart/form-data" />
                                <fieldset>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nomor Induk Dosen (NID)</label>
                                        <input type="text" name="nidn" id="exampleInputEmail4" class="form-control" value="<?php echo $npm; ?>" DISABLED>
										                    <input type="hidden" name="nidn" id="exampleInputEmail4" class="form-control" value="<?php echo $npm; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Nama Dosen</label>
                                          <input type="text" class="form-control" name="nama_dosen" placeholder="Muhammad Matematika" required="" />
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Gelar</label>
                                          <input type="text" class="form-control" name="gelar" placeholder="S.Si"  />
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Tempat Lahir</label>
										                    <input type="text" name="tempat_lahir" id="exampleInputEmail4" class="form-control" placeholder="Jombang">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail4">Tanggal Lahir</label>
                                      <input class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" type="text" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" />
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Jenis Kelamin</label>
                                        <select name="jk" class="form-control" required="">
                    											<option value="">- None -</option>
                    											<option value="L">Laki-Laki</option>
                    											<option value="P">Perempuan</option>
                    										</select>
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Jabatan Akademik</label>
                                          <select name="jabatan_id" class="form-control">
                      											<option value="">- None -</option>
                      											<option value="A">Tenaga Pengajar</option>
                      											<option value="B">Asisten Ahli</option>
                      											<option value="C">Lektor</option>
                      											<option value="D">Lektor Kepala</option>
                      											<option value="E">Guru Besar</option>
                      										</select>
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                       <label for="exampleInputEmail4">Pendidikan</label>
                                       <select name="pendidikan_id" class="form-control">
                                        <option value="">- None -</option>
                    										<option value="A">S3</option>
                    										<option value="B">S2</option>
                    										<option value="C">S1</option>
                    										<option value="D">Sp-1</option>
                    										<option value="E">Sp-2</option>
                    										<option value="F">D4</option>
                    										<option value="G">D3</option>
                    										<option value="H">D2</option>
                    										<option value="I">D1</option>
                    										<option value="J">Profesi</option>
                    									 </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Status Ikatan Kerja di PT lain</label>
                                        <select name="ikatan_kerja_id" class="form-control">
                    											<option value="">- None -</option>
                    											<option value="A">Dosen Tetap</option>
                    											<option value="B">Dosen PNS DPK</option>
                    											<option value="C">Dosen PNS PTN</option>
                    											<option value="D">Honorer Non PNS PTN</option>
                    											<option value="E">Kontrak/Tetap Kontrak</option>
                    										</select>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status Aktivitas Dosen</label>
                                          <select name="status" class="form-control" required="">
                      											<option value="">- None -</option>
                      											<option value="A">Aktif Mengajar</option>
                      											<option value="C">Cuti</option>
                      											<option value="K">Keluar/Pensiun</option>
                      											<option value="S">Studi Lanjut</option>
                      											<option value="T">Tugas di Instansi Lain</option>
                      											<option value="M">Almarhum</option>
                      										</select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Mulai Masuk Dosen</label>
                                          <input type="date" class="form-control" name="tgl_masuk" placeholder="" />
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Akta dan Ijin Mengajar</label>
                                          <select name="akta_ijin_mengajar" class="form-control">
                      											<option value="">- None -</option>
                      											<option value="1">Ada</option>
                      											<option value="2">Tidak Ada</option>
                      										</select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Alamat</label>
                                          <textarea class="form-control" name="alamat" rows="3" placeholder="Jl.Durian No 4 Perumahan Rambutan Jogoroto Jombang"></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">No Hp</label>
                                          <input type="text" class="form-control" name="hp" placeholder="+621346749373" />
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">E-Mail</label>
                                          <input type="text" class="form-control" name="email" placeholder="muhammadmatematika@gmail.com" required="" />
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">File Foto</label>
                                          <input type="file" class="form-control" name="uploadfile"/>
                                      	  <small id="fileHelp" class="form-text text-muted">Beri Nama Foto Sesuai dengan NIDN
                                                </small>
                                    </div>
                                  </div>
                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=dosen'">Cancel</button>
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
	$data_dosen = $db->database_fetch_array($db->database_prepare("SELECT * FROM dosen WHERE dosen_id = ?")->execute($_GET["id"]));
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Edit Dosen
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_dosen/aksi_dosen.php?mod=dosen&act=update" method="POST" enctype="multipart/form-data" />
                            <input type="hidden" name="id" value="<?php echo $data_dosen['dosen_id']; ?>">
                                <fieldset>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nomor Induk Dosen (NID)</label>
                                        <input type="text" name="nidn" id="exampleInputEmail4" class="form-control" value="<?php echo $data_dosen['nidn']; ?>" DISABLED>
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Nama Dosen</label>
                                          <input type="text" class="form-control" required="" name="nama_dosen" value="<?php echo $data_dosen['nama_dosen']; ?>"/>
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Gelar</label>
                                          <input type="text" class="form-control" name="gelar" value="<?php echo $data_dosen['gelar']; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Tempat Lahir</label>
										                    <input type="text" name="tempat_lahir" id="exampleInputEmail4" class="form-control" value="<?php echo $data_dosen['tempat_lahir']; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Tanggal Lahir</label>
                                          <input class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" type="text" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" value="<?php echo $data_dosen['tanggal_lahir']; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Jenis Kelamin</label>
                                        <select name="jk" class="form-control">
                    											<option value="L" <?php if($data_dosen['jk'] == 'L'){ echo "SELECTED"; } ?>>Laki-Laki</option>
                    											<option value="P" <?php if($data_dosen['jk'] == 'P'){ echo "SELECTED"; } ?>>Perempuan</option>
                    										</select>
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Jabatan Akademik</label>
                                          <select name="jabatan_id" class="form-control">
                      											<option value="">- None -</option>
                      											<option value="A" <?php if($data_dosen['jabatan_id'] == 'A'){ echo "SELECTED"; } ?>>Tenaga Pengajar</option>
                      											<option value="B" <?php if($data_dosen['jabatan_id'] == 'B'){ echo "SELECTED"; } ?>>Asisten Ahli</option>
                      											<option value="C" <?php if($data_dosen['jabatan_id'] == 'C'){ echo "SELECTED"; } ?>>Lektor</option>
                      											<option value="D" <?php if($data_dosen['jabatan_id'] == 'D'){ echo "SELECTED"; } ?>>Lektor Kepala</option>
                      											<option value="E" <?php if($data_dosen['jabatan_id'] == 'E'){ echo "SELECTED"; } ?>>Guru Besar</option>
                      										</select>
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                       <label for="exampleInputEmail4">Pendidikan</label>
                                       <select name="pendidikan_id" class="form-control">
                                        <option value="">- None -</option>
                    										<option value="A" <?php if($data_dosen['pendidikan_id'] == 'A'){ echo "SELECTED"; } ?>>S3</option>
                    										<option value="B" <?php if($data_dosen['pendidikan_id'] == 'B'){ echo "SELECTED"; } ?>>S2</option>
                    										<option value="C" <?php if($data_dosen['pendidikan_id'] == 'C'){ echo "SELECTED"; } ?>>S1</option>
                    										<option value="D" <?php if($data_dosen['pendidikan_id'] == 'D'){ echo "SELECTED"; } ?>>Sp-1</option>
                    										<option value="E" <?php if($data_dosen['pendidikan_id'] == 'E'){ echo "SELECTED"; } ?>>Sp-2</option>
                    										<option value="F" <?php if($data_dosen['pendidikan_id'] == 'F'){ echo "SELECTED"; } ?>>D4</option>
                    										<option value="G" <?php if($data_dosen['pendidikan_id'] == 'G'){ echo "SELECTED"; } ?>>D3</option>
                    										<option value="H" <?php if($data_dosen['pendidikan_id'] == 'H'){ echo "SELECTED"; } ?>>D2</option>
                    										<option value="I" <?php if($data_dosen['pendidikan_id'] == 'I'){ echo "SELECTED"; } ?>>D1</option>
                    										<option value="J" <?php if($data_dosen['pendidikan_id'] == 'J'){ echo "SELECTED"; } ?>>Profesi</option>
                    									 </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Status Ikatan Kerja di PT lain</label>
                                        <select name="ikatan_kerja_id" class="form-control">
                    											<option value="">- None -</option>
                    											<option value="A" <?php if($data_dosen['ikatan_kerja_id'] == 'A'){ echo "SELECTED"; } ?>>Dosen Tetap</option>
                    											<option value="B" <?php if($data_dosen['ikatan_kerja_id'] == 'B'){ echo "SELECTED"; } ?>>Dosen PNS DPK</option>
                    											<option value="C" <?php if($data_dosen['ikatan_kerja_id'] == 'C'){ echo "SELECTED"; } ?>>Dosen PNS PTN</option>
                    											<option value="D" <?php if($data_dosen['ikatan_kerja_id'] == 'D'){ echo "SELECTED"; } ?>>Honorer Non PNS PTN</option>
                    											<option value="E" <?php if($data_dosen['ikatan_kerja_id'] == 'E'){ echo "SELECTED"; } ?>>Kontrak/Tetap Kontrak</option>
                    										</select>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status Aktivitas Dosen</label>
                                          <select name="status" class="form-control" required="">
                      											<option value="">- None -</option>
                      											<option value="A" <?php if($data_dosen['status'] == 'A'){ echo "SELECTED"; } ?>>Aktif Mengajar</option>
                      											<option value="C" <?php if($data_dosen['status'] == 'C'){ echo "SELECTED"; } ?>>Cuti</option>
                      											<option value="K" <?php if($data_dosen['status'] == 'K'){ echo "SELECTED"; } ?>>Keluar/Pensiun</option>
                      											<option value="S" <?php if($data_dosen['status'] == 'S'){ echo "SELECTED"; } ?>>Studi Lanjut</option>
                      											<option value="T" <?php if($data_dosen['status'] == 'T'){ echo "SELECTED"; } ?>>Tugas di Instansi Lain</option>
                      											<option value="M" <?php if($data_dosen['status'] == 'M'){ echo "SELECTED"; } ?>>Almarhum</option>
                      										</select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Mulai Masuk Dosen</label>
                                          <input type="date" class="form-control" name="tgl_masuk" value="<?php echo $data_dosen['mulai_masuk_dosen']; ?>" />
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Akta dan Ijin Mengajar</label>
                                          <select name="akta_ijin_mengajar" class="form-control">
                      											<option value="">- None -</option>
                      											<option value="1" <?php if($data_dosen['akta_dan_ijin_mengajar'] == 1){ echo "SELECTED"; } ?>>Ada</option>
                      											<option value="2" <?php if($data_dosen['akta_dan_ijin_mengajar'] == 2){ echo "SELECTED"; } ?>>Tidak Ada</option>
                      										</select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Alamat</label>
                                          <textarea class="form-control" name="alamat" rows="3"><?php echo $data_dosen['alamat']; ?></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">No Hp</label>
                                          <input type="text" class="form-control" name="hp" value="<?php echo $data_dosen['no_hp']; ?>"/>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">E-Mail</label>
                                          <input type="text" class="form-control" name="email" required="" value="<?php echo $data_dosen['email']; ?>"/>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">File Foto</label>
                                          <input type="file" class="form-control" name="uploadfile" value="">
                                      	  <small id="fileHelp" class="form-text text-muted">Beri Nama Foto Sesuai dengan NIDN
                                                </small>
                                    </div>
                                  </div>
                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=dosen'">Cancel</button>
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