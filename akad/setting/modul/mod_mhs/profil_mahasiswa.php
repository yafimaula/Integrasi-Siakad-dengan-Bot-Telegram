<?php 
if ($_GET['code'] == 1){
?>
  <div class='alert alert-info'>
    <h5><i class='fa fa-check'></i>Success!</h5>
    <p>Data Mahasiswa Baru berhasil disimpan.</p>
  </div>
<?php
}
if ($_GET['code'] == 2){
?>
  <div class='alert alert-success'>
    <h5><i class='fa fa-check'></i>Success!</h5>
    <p>Data Mahasiswa berhasil diubah.</p>
  </div>
<?php
}
if ($_GET['code'] == 3){
?>
  <div class='alert alert-danger'>
    <h5><i class='fa fa-check'></i>Success!</h5>
    <p>Data Mahasiswa berhasil dihapus.</p>
  </div>
<?php
}

if ($_GET['code'] == 4){
?>
  <div class='alert alert-info'>
    <h5><i class='fa fa-check'></i>Success!</h5>
    <p>Data Mahasiswa berhasil di Upload.</p>
  </div>
<?php
}

if ($_GET['code'] == 5){
?>
  <div class='alert alert-danger'>
    <h5><i class='fa fa-ban'></i>Error!</h5>
    <p>Data Mahasiswa gagal di Upload.</p>
  </div>
<?php
}

?>
<div class="content p-0 profile_v2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="user-profile compact">
                        <div class="up-head-w" style="background-image:url('../assets/img/cover.jpg')">
                            <div class="up-social">
                                <a href="?mod=telegram" data-toggle="tooltip" data-placement="bottom" title="Telegram"><i class="fa fa-telegram"></i></a>
                            </div>
                            <?php
                            $data_mhs = $db->database_fetch_array($db->database_prepare("SELECT * FROM mahasiswa WHERE id_mhs = ?")->execute($_SESSION["id_mhs"]));
                            ?>
                            <div class="up-main-info">
                                <div class="avatar">
                                    <img alt="" class="avatar" width="100" height="100" src="./foto/mahasiswa/mahasiswa_<?php echo $data_mhs['foto']; ?>" />
                                </div>
                                <h2 class="up-header">
                                    <?php echo "$_SESSION[nama_lengkap]"; ?>
                                </h2>
                                <h6 class="up-sub-header">
                                    <?php echo "$_SESSION[nim]"; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Profil Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_mhs/aksi_mahasiswa.php?mod=mhs&act=update_profil" method="POST" enctype="multipart/form-data" />
                            <input type="hidden" name="program_studi" value="<?php echo $_GET['program_studi']; ?>">
                            <input type="hidden" name="nim" value="<?php echo $_GET['nim']; ?>">
                            <input type="hidden" name="id" value="<?php echo $data_mhs['id_mhs']; ?>">
                                <fieldset>
                                    <div class="col-md-6 offset-md-3 text-center">
                                        <h4 class="card-title m-0">Profil Mahasiswa
                                            <p class="card-category">
                                                <small>Data yang berhubungan dengan akademik mahasiswa</small>
                                            </p>
                                        </h4>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail4">NIM</label>
                                            <input type="text" class="form-control" name="nim" id="exampleInputEmail4" value="<?php echo $data_mhs['nim']; ?>" DISABLED />
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail4">Nama Mahasiswa</label>
                                            <input type="text" class="form-control" name="nama_mahasiswa" id="exampleInputEmail4" value="<?php echo $data_mhs['nama_mahasiswa']; ?>"/>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail4">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" id="exampleInputEmail4" placeholder="Tempat lahir" value="<?php echo $data_mhs['tempat_lahir']; ?>"/>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail4">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir" id="exampleInputEmail4" value="<?php echo $data_mhs['tanggal_lahir']; ?>"/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                              <label for="exampleInputEmail4">Jenis Kelamin</label>
                                              <select name="jenis_kelamin" class="form-control">
                                                <option value="L" <?php if($data_mhs['jenis_kelamin'] == 'L'){ echo "SELECTED"; } ?>>Laki-Laki</option>
                                                <option value="P" <?php if($data_mhs['jenis_kelamin'] == 'P'){ echo "SELECTED"; } ?>>Perempuan</option>
                                              </select>
                                        </div> 
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                              <label for="exampleInputEmail4">Agama</label>
                                              <select name="agama" class="form-control">
                                                <option value="I" <?php if($data_mhs['agama'] == 'I'){ echo "SELECTED"; } ?>>Islam</option>
                                                <option value="K" <?php if($data_mhs['agama'] == 'K'){ echo "SELECTED"; } ?>>Kristen</option>
                                                <option value="C" <?php if($data_mhs['agama'] == 'C'){ echo "SELECTED"; } ?>>Katolik</option>
                                                <option value="H" <?php if($data_mhs['agama'] == 'H'){ echo "SELECTED"; } ?>>Hindu</option>
                                                <option value="B" <?php if($data_mhs['agama'] == 'B'){ echo "SELECTED"; } ?>>Budha</option>
                                                <option value="G" <?php if($data_mhs['agama'] == 'G'){ echo "SELECTED"; } ?>>Kong Hu Cu</option>
                                                <option value="L" <?php if($data_mhs['agama'] == 'L'){ echo "SELECTED"; } ?>>Lainnya</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                              <label for="exampleInputEmail4">No HP</label>
                                              <input type="text" class="form-control" name="hp" value="<?php echo $data_mhs['hp']; ?>" />
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                              <label for="exampleInputEmail4">E-Mail</label>
                                              <input type="text" class="form-control" name="email" value="<?php echo $data_mhs['email']; ?>" />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                              <label for="exampleInputEmail4">Alamat Lengkap</label>
                                              <textarea class="form-control" rows="3" name="alamat" ><?php echo $data_mhs['alamat']; ?></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                              <label for="exampleInputEmail4">Program Kuliah</label>
                                              <select name="program" disabled="" class="form-control">
                                                <option value="R" <?php if($data_mhs['program'] == 'R'){ echo "SELECTED"; } ?>>Reguler</option>
                                                <option value="N" <?php if($data_mhs['program'] == 'N'){ echo "SELECTED"; } ?>>Non-Reguler</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                              <label for="exampleInputEmail4">Status Mahasiswa</label>
                                              <input type="hidden" name="status_mahasiswa" value="A">
                                              <select name="status_mahasiswa" DISABLED class="form-control">
                                                <option value="A" <?php if($data_mhs['status_mahasiswa'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
                                                <option value="C" <?php if($data_mhs['status_mahasiswa'] == 'C'){ echo "SELECTED"; } ?>>Cuti</option>
                                                <option value="D" <?php if($data_mhs['status_mahasiswa'] == 'D'){ echo "SELECTED"; } ?>>Drop-out</option>
                                                <option value="L" <?php if($data_mhs['status_mahasiswa'] == 'L'){ echo "SELECTED"; } ?>>Lulus</option>
                                                <option value="K" <?php if($data_mhs['status_mahasiswa'] == 'K'){ echo "SELECTED"; } ?>>Keluar</option>
                                                <option value="N" <?php if($data_mhs['status_mahasiswa'] == 'N'){ echo "SELECTED"; } ?>>Non-Aktif</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                              <label for="exampleInputEmail4">Angkatan Mahasiswa</label>
                                              <select name="angkatan_id" disabled="" class="form-control">
                                                <?php 
                                                $sql_angkatan = $db->database_prepare("SELECT * FROM angkatan")->execute();
                                                while ($data_angkatan = $db->database_fetch_array($sql_angkatan)){
                                                    if ($data_angkatan['semester_angkatan'] == '1'){
                                                        $semester = "Ganjil";
                                                    }
                                                    else{
                                                        $semester = "Genap";
                                                    }
                                                    
                                                    if ($data_mhs['angkatan_id'] == $data_angkatan['angkatan_id']){
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
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail4">Tanggal Masuk</label>
                                            <input type="date" disabled="" class="form-control" name="tgl_masuk_mhs" id="exampleInputEmail4" value="<?php echo $data_mhs['tanggal_masuk']; ?>"/>
                                        </div>
                                      </div>
                                     <div class="col-sm-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Foto Mahasiswa</label>
                                          <input type="file" class="form-control" name="uploadfile"/>
                                       </div>
                                     </div>
                                    </div>

                                    <div class="col-md-6 offset-md-3 text-center">
                                        <h4 class="card-title m-0">Sekolah / Insitusi Asal
                                            <p class="card-category">
                                                <small>Data yang berhubungan dengan sekolah atau institusi asal mahasiswa</small>
                                            </p>
                                        </h4>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Sekolah Asal</label>
                                                <input class="form-control" name="sekolah_nama" value="<?php echo $data_mhs['sekolah_nama']; ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No Telp Sekolah Asal</label>
                                                <input class="form-control" name="sekolah_telp" value="<?php echo $data_mhs['sekolah_telp']; ?>" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <input class="form-control" name="sekolah_jurusan" value="<?php echo $data_mhs['sekolah_jurusan']; ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tahun Lulus</label>
                                                <input class="form-control" name="sekolah_tahun_lulus" value="<?php echo $data_mhs['sekolah_tahun_lulus']; ?>" type="text" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Alamat Sekolah Asal</label>
                                                <textarea class="form-control" name="sekolah_alamat" id="exampleTextarea" rows="3"><?php echo $data_mhs['sekolah_alamat']; ?></textarea>
                                            </div>
                                        </div>
                                      </div>

                                    <div class="col-md-6 offset-md-3 text-center">
                                        <h4 class="card-title m-0">Orang Tua / Wali
                                            <p class="card-category">
                                                <small>Data yang berhubungan dengan Orang Tua atau Wali mahasiswa</small>
                                            </p>
                                        </h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Ayah</label>
                                                <input class="form-control" name="nama_ayah" value="<?php echo $data_mhs['nama_ayah']; ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Ibu</label>
                                                <input class="form-control" name="nama_ibu" value="<?php echo $data_mhs['nama_ibu']; ?>" type="text" />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ayah</label>
                                                <select name="pekerjaan_ayah" class="form-control">
                                                    <option value="X" <?php if($data_mhs['pekerjaan_ayah'] == 'X'){ echo "SELECTED"; } ?>>Tidak Bekerja</option>
                                                    <option value="A" <?php if($data_mhs['pekerjaan_ayah'] == 'A'){ echo "SELECTED"; } ?>>Petani</option>
                                                    <option value="B" <?php if($data_mhs['pekerjaan_ayah'] == 'B'){ echo "SELECTED"; } ?>>Nelayan</option>
                                                    <option value="C" <?php if($data_mhs['pekerjaan_ayah'] == 'C'){ echo "SELECTED"; } ?>>Peternak</option>
                                                    <option value="D" <?php if($data_mhs['pekerjaan_ayah'] == 'D'){ echo "SELECTED"; } ?>>Buruh</option>
                                                    <option value="E" <?php if($data_mhs['pekerjaan_ayah'] == 'E'){ echo "SELECTED"; } ?>>Karyawan Swasta</option>
                                                    <option value="F" <?php if($data_mhs['pekerjaan_ayah'] == 'F'){ echo "SELECTED"; } ?>>Pedagang</option>
                                                    <option value="G" <?php if($data_mhs['pekerjaan_ayah'] == 'G'){ echo "SELECTED"; } ?>>Wiraswasta</option>
                                                    <option value="H" <?php if($data_mhs['pekerjaan_ayah'] == 'H'){ echo "SELECTED"; } ?>>PNS/TNI/Polri</option>
                                                    <option value="I" <?php if($data_mhs['pekerjaan_ayah'] == 'I'){ echo "SELECTED"; } ?>>Pensiunan</option>
                                                    <option value="J" <?php if($data_mhs['pekerjaan_ayah'] == 'J'){ echo "SELECTED"; } ?>>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ibu</label>
                                                <select name="pekerjaan_ibu" class="form-control">
                                                    <option value="X" <?php if($data_mhs['pekerjaan_ibu'] == 'X'){ echo "SELECTED"; } ?>>Tidak Bekerja</option>
                                                    <option value="A" <?php if($data_mhs['pekerjaan_ibu'] == 'A'){ echo "SELECTED"; } ?>>Petani</option>
                                                    <option value="B" <?php if($data_mhs['pekerjaan_ibu'] == 'B'){ echo "SELECTED"; } ?>>Nelayan</option>
                                                    <option value="C" <?php if($data_mhs['pekerjaan_ibu'] == 'C'){ echo "SELECTED"; } ?>>Peternak</option>
                                                    <option value="D" <?php if($data_mhs['pekerjaan_ibu'] == 'D'){ echo "SELECTED"; } ?>>Buruh</option>
                                                    <option value="E" <?php if($data_mhs['pekerjaan_ibu'] == 'E'){ echo "SELECTED"; } ?>>Karyawan Swasta</option>
                                                    <option value="F" <?php if($data_mhs['pekerjaan_ibu'] == 'F'){ echo "SELECTED"; } ?>>Pedagang</option>
                                                    <option value="G" <?php if($data_mhs['pekerjaan_ibu'] == 'G'){ echo "SELECTED"; } ?>>Wiraswasta</option>
                                                    <option value="H" <?php if($data_mhs['pekerjaan_ibu'] == 'H'){ echo "SELECTED"; } ?>>PNS/TNI/Polri</option>
                                                    <option value="I" <?php if($data_mhs['pekerjaan_ibu'] == 'I'){ echo "SELECTED"; } ?>>Pensiunan</option>
                                                    <option value="J" <?php if($data_mhs['pekerjaan_ibu'] == 'J'){ echo "SELECTED"; } ?>>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Penghasilan Ayah</label>
                                                <select class="form-control" name="penghasilan_ayah">
                                                    <option value="A" <?php if($data_mhs['penghasilan_ayah'] == 'A'){ echo "SELECTED"; } ?>>Tidak Berpenghasilan</option>
                                                    <option value="B" <?php if($data_mhs['penghasilan_ayah'] == 'B'){ echo "SELECTED"; } ?>> < 500.000 </option>
                                                    <option value="C" <?php if($data_mhs['penghasilan_ayah'] == 'C'){ echo "SELECTED"; } ?>> 1.000.000-2.000.000 </option>
                                                    <option value="D" <?php if($data_mhs['penghasilan_ayah'] == 'D'){ echo "SELECTED"; } ?>> 2.000.000-5.000.000 </option>
                                                    <option value="E" <?php if($data_mhs['penghasilan_ayah'] == 'E'){ echo "SELECTED"; } ?>> > 5.000.000 </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Penghasilan Ibu</label>
                                                <select class="form-control" name="penghasilan_ibu">
                                                    <option value="A" <?php if($data_mhs['penghasilan_ibu'] == 'A'){ echo "SELECTED"; } ?>>Tidak Berpenghasilan</option>
                                                    <option value="B" <?php if($data_mhs['penghasilan_ibu'] == 'B'){ echo "SELECTED"; } ?>> < 500.000 </option>
                                                    <option value="C" <?php if($data_mhs['penghasilan_ibu'] == 'C'){ echo "SELECTED"; } ?>> 1.000.000-2.000.000 </option>
                                                    <option value="D" <?php if($data_mhs['penghasilan_ibu'] == 'D'){ echo "SELECTED"; } ?>> 2.000.000-5.000.000 </option>
                                                    <option value="E" <?php if($data_mhs['penghasilan_ibu'] == 'E'){ echo "SELECTED"; } ?>> > 5.000.000 </option>
                                                </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>No HP Orang Tua</label>
                                                <input class="form-control" name="no_hp_ortu" value="<?php echo $data_mhs['no_hp_ortu']; ?>" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Update Data</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        </div>