<?php
$data_mhs = $db->database_fetch_array($db->database_prepare("SELECT m . * , a.tahun_angkatan as tahun, a.semester_angkatan as semester FROM mahasiswa m JOIN angkatan a ON a.`angkatan_id` = m.`angkatan_id` WHERE id_mhs = ?")->execute($_SESSION["id_mhs"]));
  $data_prodi = $db->database_fetch_array($db->database_prepare("SELECT jenjang_studi_id,nama_prodi FROM prodi WHERE prodi_id = ?")->execute($data_mhs["kode_program_studi"]));
  if ($data_mhs['program'] == 'R'){
    $program = "Reguler";
  }else{
      $program = "Non-Reguler";
  }
  if ($data_mhs['semester'] == '1'){
    $semester = "Ganjil";
  }
  else{
    $semester = "Genap";
  }
  
  if ($data_mhs['status_mahasiswa'] == 'A'){
    $status_mahasiswa = "Aktif";
  }
  elseif ($data_mhs['status_mahasiswa'] == 'C'){
    $status_mahasiswa = "Cuti";
  }
  elseif ($data_mhs['status_mahasiswa'] == 'D'){
    $status_mahasiswa = "Drop-out";
  }
  elseif ($data_mhs['status_mahasiswa'] == 'L'){
    $status_mahasiswa = "Lulus";
  }
  elseif ($data_mhs['status_mahasiswa'] == 'K'){
    $status_mahasiswa = "keluar";
  }
  else{
    $status_mahasiswa = "Non-aktif";
  }
  
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
?>
  <div class="content">
            <div class="row"> 
        <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                               Form Pembayaran Kuliah
                            </h5>
                            <input type="hidden" name="kode_program_studi" value="<?php echo $_GET['prodi_id']; ?>">
                            <input type="hidden" name="prodi" value="<?php echo $_GET['program_studi']; ?>">
                            <input type="hidden" name="nim" value="<?php echo $_GET['nim']; ?>">
                            <input type="hidden" name="id" value="<?php echo $_GET['bid']; ?>">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>NIM </td>
                                        <td><?php echo $data_mhs['nim']; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td><?php echo $data_mhs['nama_mahasiswa']; ?> / <?php echo $data_mhs['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Angkatan</td>
                                      <td><?php echo $data_mhs['tahun']; ?> - <?php echo $semester; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Program Studi</td>
                                      <td><?php echo $kd_jenjang_studi." - ".$data_prodi['nama_prodi']; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Status / Program</td>
                                      <td><?php echo $status_mahasiswa." / ".$program;?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
    <?php
    if ($data_mhs['program'] == 'R'){
        $program = "A";
    }
    else{
        $program = "B";
    }
    $sql_biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan,C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A 
      INNER JOIN mst_biaya B ON A.mst_biaya_id=B.mst_biaya_id
      INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id
      INNER JOIN mahasiswa D ON D.angkatan_id = B.angkatan_id
      WHERE B.prodi_id = ? AND A.aktif = 'A' AND A.program = ? AND D.angkatan_id = ? AND D.id_mhs = ?")->execute($data_mhs['kode_program_studi'],$program, $data_mhs['angkatan_id'], $_SESSION["id_mhs"] );
    $nums = $db->database_num_rows($sql_biaya);
    if ($nums == 0){
      ?>
      <div class="col-xl-12 col-sm-12 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body ">
                                <div class="row" >
                                    <div class="col-12">
                                      <font color="=ff0000">
                                        <h6 class="mt-1 mb-0">Mohon Maaf !!! Pembiayaan Belum Tersedia Untuk Saat Ini.</h6>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <?php
    }
    else{
    $data_biaya = $db->database_fetch_array($sql_biaya);
    if ($data_biaya['semester_angkatan'] == '1'){
      $sem = "Ganjil";
    }
    else{
      $sem = "Genap";
  }?>
    <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Akun Biaya
                            </h5>
                            <form method='POST' action='modul/mod_biaya/aksi_biaya_mahasiswa.php?mod=biaya_mahasiswa&act=input'>
                            <input type="hidden" name="akun_id" value="<?php echo $data_biaya['akun_id']; ?>">
                            <input type="hidden" name="id_mhs" value="<?php echo $_SESSION['id']; ?>">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                  <tr>
                                    <th>Tahun Angkatan</th>
                                    <th>Semester</th>
                                    <th>Nama Biaya</th>
                                    <th>Nominal</th>
                                  </tr>
                                  </thead>
                                  <?php
                                  $skripsi = $db->database_prepare("SELECT A.`jadwal_id` FROM  `jadwal_kuliah` A JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`nama_mata_kuliah` =  'Skripsi' AND C.id_mhs = ? ")->execute($_SESSION["id_mhs"]); // TAMPILKAN SKRIPSI
                                  $jumskrip = $db->database_num_rows($skripsi);
                                  if ($jumskrip == 0) { // IF TIDAK SKRIPSI
                                    $mka = $db->database_prepare("SELECT A.`jadwal_id` FROM  `jadwal_kuliah` A  JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`jenis_mata_kuliah` =  'C' AND C.id_mhs = ?")->execute($_GET["id"]);  
                                    $jumka = $db->database_num_rows($mka);
                                    $mka_array = $db->database_fetch_array($mka);
                                    $nama_mka = $mka_array['jadwal_id'];
                                    if ($jumka == 0) { //TIDAK SKRIPSI +TIDAK MKA
                                      $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                    } else {
                                      ?><input type="hidden" name="" value="<?php echo $nama_mka ; ?>"><?php
                                      if ($nama_mka == '217') { // MKA MULTIMED
                                        $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                      }elseif ($nama_mka == '222') { //NO SKRIPSI TP MELU MKA BISNIS MODERN
                                        $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` ))AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                      }elseif ($nama_mka == '219') { // NO SKRIPSI TAPI MKA ECO
                                        $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, C.angkatan_id, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                      }elseif ($nama_mka == '225') { // NO SKRIPSI TP MKA EDU
                                        $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                      }
                                      
                                    }
                                    
                                    
                                  } else { // JIKA SKRIPSI
                                    $mka = $db->database_prepare("SELECT A.`jadwal_id` FROM  `jadwal_kuliah` A  JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`jenis_mata_kuliah` =  'C' AND C.id_mhs = ?")->execute($_SESSION["id_mhs"]);  
                                    $jumka = $db->database_num_rows($mka);
                                    $mka_array = $db->database_fetch_array($mka);
                                    $nama_mka = $mka_array['jadwal_id'];
                                    if ($jumka == 0) { // SKRIPSI TOK NO MKA
                                      $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan,C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id=B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM `akun_biaya` WHERE nama_biaya LIKE 'MKA%') AND B.prodi_id = ? AND A.aktif = 'A' AND A.program = ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                      while ($data = $db->database_fetch_array($biaya)){
                                      echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                      }
                                      ?>
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                          <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                          <td>Rp. <?php echo number_format($jumlah); ?></td>
                                        </tr>
                                        </tfoot><?php // MKA APA
                                    }else{
                                      ?> 
                                      <input type="hidden" name="" value="<?php echo $nama_mka ; ?>"> <?php
                                      if ($nama_mka == '217') { // SKRIPSI + MKA MULTIMED
                                        $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                      }elseif ($nama_mka == '222') { // SKRIPSI + MKA BISNIS MODERN
                                        $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                      }elseif ($nama_mka == '219') { // SKRIPSI + MKA ECOTOURISM
                                        $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, C.angkatan_id, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                      }elseif ($nama_mka == '225') { // SKRIPSI + MKA EDUWISATA
                                        $biaya = $db->database_prepare("SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id =  ? AND A.aktif =  'A' AND A.program =  ? ORDER BY A.semester ASC")->execute($data_mhs['kode_program_studi'],$program);
                                        while ($data = $db->database_fetch_array($biaya)){
                                        echo "
                                        <tbody>
                                            <tr>
                                              <td>$data[tahun_angkatan]</td>
                                              <td>$data[semester]</td>
                                              <td>$data[nama_biaya]</td>
                                              <td>$data[biaya]</td>
                                            </tr>";
                                          $jumlah += $data['biaya'];
                                        }
                                        ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                            <td colspan="3"><b>Jumlah Yang Harus Dibayar</b></td>
                                            <td>Rp. <?php echo number_format($jumlah); ?></td>
                                          </tr>
                                          </tfoot><?php
                                      }
                                    } 
                                  }
                                  
                                  ?>    
                                </table>
                            </div>
                            <br>
                            
                        </div>
                    </div>
    </div>
    
  </form>
    <?php
      }

  
  ?>

  <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Biaya Kuliah a.n <?php echo $data_mhs['nama_mahasiswa']; ?>
                            </h5>
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                              $no = 1;
                              $sql_biaya = $db->database_prepare("SELECT * FROM biaya_kuliah WHERE id_mhs = ? ORDER BY biaya_id DESC")->execute($_SESSION["id_mhs"]);
                              while ($data_biaya = $db->database_fetch_array($sql_biaya)){
                                $nomi=number_format($data_biaya['biaya']);
                                                  echo "<tr>
                                    <td>$no</td>
                                    <td>$data_biaya[keterangan]</td>
                                    <td>$nomi</td>
                                    <td><a title='Ubah' href='?mod=biaya_mahasiswa&act=ganti&id=$data_biaya[biaya_id]&mhs=$_SESSION[id_mhs]'><i class='fa fa-pencil-square-o'></i> </a> |";
                                    ?>
                                      <a title='Hapus' href='modul/mod_biaya/aksi_biaya_mahasiswa.php?mod=biaya_mahasiswa&act=delete&id=<?php echo "$data_biaya[biaya_id]"?>' onclick="return confirm('Anda Yakin ingin menghapus data biaya <?php echo $data_biaya[keterangan]." ".$nomi;?>?');"><i class='fa fa-trash'></i></a>
                                    <?php
                                    echo "</td>
                                  </tr>";
                                    $no++;
                                    $telah += $data_biaya['biaya'];
                                }
                                    $kurang = $telah-$jumlah;
                                  ?>     
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <td colspan="2"><b>Jumlah Yang Sudah Dibayar</b></td>
                                    <td colspan="2"><?php echo number_format($telah); ?></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"><b>Jumlah Yang Harus Dibayar</b></td>
                                    <td colspan="2"><?php echo number_format($jumlah); ?></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"><b>Sisa Bayar</b></td>
                                    <td colspan="2"><b><?php echo number_format($kurang); ?></b></td>
                                  </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
    </div>