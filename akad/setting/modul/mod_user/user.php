<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Administrator Baru berhasil disimpan.</p>
	</div> 
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Administrator berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-danger'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Data Administrator berhasil dihapus.</p>
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
                                Data Administrator
                            </h5>
                             <button type="button" onclick="window.location.href='?mod=user&act=add'" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Admin</button>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
									<th>NIP</th>
									<th>Nama Lengkap</th>
									<th>Email</th>
									<th>Status</th>
									<th>Hak Akses</th>
									<th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                	$no = 1;
									$sql_user = $db->database_prepare("SELECT * FROM users WHERE user_id != 1 ORDER BY nip,nama_lengkap ASC")->execute();
									while ($data_user = $db->database_fetch_array($sql_user)){
										if ($data_user['aktif'] == 'Y'){
                                      	  $status_user = "<span class='badge-success badge'>Aktif</span>";
	                                    }
	                                    else{
	                                      $status_user = "<span class='badge-danger badge'>Tidak Aktif</span>";
	                                    }

	                                    if ($data_user['blokir'] == 'N'){
                                      	  $blokir_user = "<span class='badge-success badge'>Aktif</span>";
	                                    }
	                                    else{
	                                      $blokir_user = "<span class='badge-danger badge'>Blokir</span>";
	                                    }
										echo "
										<tr>
											<td>$no</td>
											<td>$data_user[nip]</td>
											<td>$data_user[nama_lengkap]</td>
											<td>$data_user[email]</td>
											<td>$status_user</td>
											<td>$blokir_user</td>
											<td><a title='Ubah' href='?mod=user&act=edit&id=$data_user[user_id]'><i class='fa fa-pencil-square-o'></i></a> |";
											?>
											<a title='Hapus' href='modul/mod_user/aksi_user.php?mod=user&act=delete&id=<?php echo $data_user[user_id];?>'><i class='fa fa-trash' onclick="return confirm('Anda Yakin ingin menghapus pengguna <?php echo $data_user[nama_lengkap];?>?');"></i></a>
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
<?php

	break;
	
	case "add":
	$tahun = date("Y");
	$sql_urut = $db->database_prepare("SELECT nip FROM users ORDER BY nip DESC LIMIT 1");
	$num_urut = $db->database_num_rows($sql_urut);
	
	$data_urut = $db->database_fetch_array($sql_urut);
	$awal = substr($data_urut['nip'],0-4);
	$next = $awal + 1;
	$jnip = strlen($next);
	
	if (!$data_urut['nip']){
		$no = "0001";
	}
	elseif($jnip == 1){
		$no = "000";
	} 
	elseif($jnip == 2){
		$no = "00";
	}
	elseif($jnip == 3){
		$no = "0";
	}
	elseif($jnip == 4){
		$no = "";
	}
	if ($num_urut == 0){
		$npm = $tahun.$no;
	}
	else{
		$npm = $tahun.$no.$next;
	}
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Tambah Admin
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                    <i class="material-icons" data-box="close">close</i>
                                </div>
                            </h5> 
                            <form action="modul/mod_user/aksi_user.php?mod=user&act=input" method="POST" />
                                <fieldset>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">NIP</label>
                                        <input type="text" class="form-control" name="nip" size="40" maxlength="15" value="<?php echo $npm; ?>" disabled>
                                        <input type="hidden" class="form-control" name="nip" size="40" maxlength="15" value="<?php echo $npm; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nama Pegawai</label>
                                        <input type="text" class="form-control" name="nama_lengkap" size="40" required="" placeholder="Ahmad Muhammad">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Alamat</label>
                                        <textarea class="form-control" name="alamat" cols="40" rows="3"  placeholder="JL.Rambutan No 4 Jombang"></textarea>
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
	                                        <label for="exampleInputEmail4">E-Mail</label>
	                                        <input type="text" class="form-control" name="email" size="40" maxlength="40" placeholder="abc@gmail.com" required="">
	                                    </div>
	                                  </div>
	                                </div>
	                                <div class="row">
                                  	 <div class="col-sm-4">
	                                    <div class="form-group">
	                                        <label for="exampleInputEmail4">No Hp</label>
	                                        <input type="text" class="form-control" name="hp" size="40" maxlength="15"  placeholder="+62134567890">
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Aktif</label>
	                                          <select name="aktif" class="form-control" required="">
		                                          <option value="">- None -</option>
												  <option value="Y" SELECTED>Aktif</option>
												  <option value="N">Tidak Aktif</option>
											  </select>
	                                    </div>
	                                  </div>
	                                  <div class="col-sm-4">
	                                    <div class="form-group">
	                                          <label for="exampleInputEmail4">Blokir</label>
	                                          <select name="blokir" class="form-control" required="">
		                                          <option value="">- None -</option>
												  <option value="Y">Ya</option>
												  <option value="N" SELECTED>Tidak</option>
											  </select>
	                                    </div>
	                                   </div>
	                                </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=user'">Cancel</button>
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
	$data_user = $db->database_fetch_array($db->database_prepare("SELECT * FROM users WHERE user_id = ?")->execute($_GET["id"]));
?>	
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Ubah Data Admin
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                    <i class="material-icons" data-box="close">close</i>
                                </div>
                            </h5> 
                            <form action="modul/mod_user/aksi_user.php?mod=user&act=update" method="POST" />
                            <input type="hidden" name="id" value="<?php echo $data_user['user_id']; ?>">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">NIP</label>
                                        <input type="text" class="form-control" name="nip" size="40" maxlength="15" value="<?php echo $data_user['nip']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nama Pegawai</label>
                                        <input type="text" class="form-control" name="nama_lengkap" size="40" value="<?php echo $data_user['nama_lengkap']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Alamat</label>
                                        <textarea class="form-control" name="alamat" cols="40" rows="3"><?php echo $data_user['alamat']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Jenis Kelamin</label>
                                          <select name="jenis_kelamin" class="form-control">
	                                          <option value="L" <?php if($data_user['jenis_kelamin'] == 'L'){ echo "SELECTED"; } ?>>Laki-Laki</option>
											  <option value="P" <?php if($data_user['jenis_kelamin'] == 'P'){ echo "SELECTED"; } ?>>Perempuan</option>
										  </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">E-Mail</label>
                                        <input type="text" class="form-control" name="email" size="40" maxlength="40" value="<?php echo $data_user['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">No Hp</label>
                                        <input type="text" class="form-control" name="hp" size="40" maxlength="15" value="<?php echo $data_user['hp']; ?>">
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Aktif</label>
                                          <select name="aktif" class="form-control">
	                                          <option value="Y" <?php if($data_user['aktif'] == 'Y'){ echo "SELECTED"; } ?>>Aktif</option>
											  <option value="N" <?php if($data_user['aktif'] == 'N'){ echo "SELECTED"; } ?>>Tidak Aktif</option>
										  </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Blokir</label>
                                          <select name="blokir" class="form-control">
	                                          <option value="Y" <?php if($data_user['blokir'] == 'Y'){ echo "SELECTED"; } ?>>Ya</option>
											  <option value="N" <?php if($data_user['blokir'] == 'N'){ echo "SELECTED"; } ?>>Tidak</option>
										  </select>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=user'">Cancel</button>
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