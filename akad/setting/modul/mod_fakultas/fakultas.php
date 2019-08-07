<?php 
if ($_GET['code'] == 1){
?>
  <div class='alert alert-info'>
    <h5><i class='fa fa-check'></i> Success!</h5>
    <p>Data Fakultas Baru berhasil disimpan.</p>
  </div>
<?php
}
if ($_GET['code'] == 2){
?>
  <div class='alert alert-success'>
    <h5><i class='fa fa-check'></i> Success!</h5>
    <p>Data Fakultas berhasil diubah.</p>
  </div>
<?php
} 
if ($_GET['code'] == 3){
?>
  <div class='alert alert-danger'>
    <h5><i class='fa fa-check'></i> Success!</h5>
    <p>Data Fakultas berhasil dihapus.</p>
  </div>
<?php
}
?>

<?php
switch ($_REQUEST['act']) {
  default:
        ?>
    <!--Begin Content-->
        <div class="content">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box"> 
                            <h5 class="pvr-header">
                                Data Fakultas
                            </h5>
                             <button type="button" onclick="window.location.href='?mod=fakultas&act=add'" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Tambah Fakultas</button>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>No Izin</th>
                                    <th>Nama Fakultas</th>
                                    <th>Nama Ketua</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $no = 1;
                                  $sql_fakultas = $db->database_prepare("SELECT * FROM fakultas ORDER BY nama_fak ASC")->execute();
                                  while ($data_fakultas = $db->database_fetch_array($sql_fakultas)){
                                    if ($data_fakultas['status'] == 'A'){
                                      $status_fakultas = "Aktif";
                                    }
                                    else{
                                      $status_fakultas = "Non-Aktif";
                                    }
                                    echo "<tr>
                                      <td>$no</td>
                                      <td>$data_fakultas[no_izin]</td>
                                      <td>$data_fakultas[nama_fak]</td>
                                      <td>$data_fakultas[ketua]</td>
                                      <td>$status_fakultas</td>
                                      <td><a href='?mod=fakultas&act=edit&id=$data_fakultas[fakultas_id]'><i class='fa fa-pencil-square-o'></i></a> |";
                                      ?>
                                        <a href='modul/mod_fakultas/aksi_fakultas.php?mod=fakultas&act=delete&id=<?php echo "$data_fakultas[fakultas_id]";?>' onclick="return confirm('Anda Yakin ingin menghapus Fakultas <?php echo $data_fakultas[nama_fak];?>?');"><i class='fa fa-trash'></i></a>
                                      <?php echo "
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
                                Tambah Fakultas
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_fakultas/aksi_fakultas.php?mod=fakultas&act=input" method="POST" />
                                <fieldset>
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nama Fakultas</label>
                                        <input type="text" class="form-control" name="nama" id="exampleInputEmail4" required="" />
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Ketua</label>
                                          <input type="text" class="form-control" name="ketua"  />
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">No Izin</label>
                                          <input type="text" class="form-control" name="izin" />
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
                                    <button type="button" class="btn btn-default" onclick="window.location.href='?mod=fakultas'">Cancel</button>
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
    $data_fakultas = $db->database_fetch_array($db->database_prepare("SELECT * FROM fakultas WHERE fakultas_id = ?")->execute($_GET["id"]));
  
  
?>
  <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Edit Fakultas
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_fakultas/aksi_fakultas.php?mod=fakultas&act=update" method="POST" />
                                <fieldset>
                                  <input type="hidden" name="id" value="<?php echo $data_fakultas['fakultas_id']; ?>">
                                    <div class="form-group">
                                        <label for="exampleInputEmail4">Nama Fakultas</label>
                                        <input type="text" class="form-control" name="nama" id="exampleInputEmail4" value="<?php echo $data_fakultas['nama_fak']; ?>" />
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Ketua</label>
                                          <input type="text" class="form-control" name="ketua" value="<?php echo $data_fakultas['ketua']; ?>" />
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">No Izin</label>
                                          <input type="text" class="form-control" name="izin" value="<?php echo $data_fakultas['no_izin']; ?>" />
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputEmail4">Status</label>
                                          <select name="status" class="form-control">
                                            <option value="A" <?php if($data_fakultas['status'] == 'A'){ echo "SELECTED"; } ?> >Aktif</option>
                                            <option value="N" <?php if($data_fakultas['status'] == 'N'){ echo "SELECTED"; } ?>>Non-Aktif</option>
                                          </select>
                                        </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                    <button type="button" onclick="window.location.href='?mod=fakultas'" class="btn btn-default">Cancel</button>
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