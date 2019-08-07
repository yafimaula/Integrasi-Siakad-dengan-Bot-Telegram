<?php 
if ($_GET['code'] == 1){
?>
	<div class='message success'>
		<h5>Success!</h5>
		<p>Pembagian Kelas Baru berhasil disimpan.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='message success'>
		<h5>Success!</h5>
		<p>Pembagian Kelas berhasil diubah.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='message success'>
		<h5>Success!</h5>
		<p>Pembagian Kelas berhasil dihapus.</p>
	</div>
<?php
}
?>
<script type='text/javascript' src='../js/jquery.validate.js'></script>
		
<script type='text/javascript'>
	$(document).ready(function() {
		$('#frm_lanjut').validate({
			rules:{
				prodi: true,
				tahun_angkatan: true
			},
			messages:{
				prodi:{
					required: "Pilih program studi."
				},
				tahun_angkatan:{
					required: "Pilih tahun angkatan."
				}
			}
		});
		
		$('#frm_lanjut2').validate({
			rules:{
				prodi: true,
				tahun_angkatan: true
			},
			messages:{
				prodi:{
					required: "Pilih program studi."
				},
				tahun_angkatan:{
					required: "Pilih tahun angkatan."
				}
			}
		});
	});
</script>

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
                                Pembagian Kelas Mahasiswa
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                    <i class="material-icons" data-box="close">close</i>
                                </div>
                            </h5>
                            <div class="bd-example bd-example-tabs" role="tabpanel">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">Data Mahasiswa Angkatan Baru</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="false">Data Mahasiswa Per Jurusan</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="true">
                                    <form method="GET">
                                        <input type='hidden' name='mod' value='bagi_kelas'>
										<input type='hidden' name='act' value='data_mhs'>
										<div class="form-group">
                                          <label for="exampleInputEmail4">Program Studi</label>
                                          <select name="prodi" class="form-control">
                                          	<option value=''>- None -</option>
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
												echo "<option value=$data_prodi[prodi_id]>$kd_jenjang_studi - $data_prodi[nama_prodi]</option>";
											}?>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Tahun Angkatan</label>
                                          <select name="tahun_angkatan" class="form-control">
                                          	<option value=''>- None -</option>
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
											}?>
                                          </select>
                                       </div>
                                       <button type="submit" class="btn btn-purple m-r-5">Open Data</button>
                                    </form>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                                     <form method="GET">
                                        <input type='hidden' name='mod' value='bagi_kelas'>
										<input type='hidden' name='act' value='all'>
										<div class="form-group">
                                          <label for="exampleInputEmail4">Program Studi</label>
                                          <select name="prodi" class="form-control">
                                          	<option value=''>- None -</option>
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
												echo "<option value=$data_prodi[prodi_id]>$kd_jenjang_studi - $data_prodi[nama_prodi]</option>";
											}?>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputEmail4">Tahun Angkatan</label>
                                          <select name="tahun_angkatan" class="form-control">
                                          	<option value=''>- None -</option>
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
											}?>
                                          </select>
                                       </div>
                                       <button type="submit" class="btn btn-purple m-r-5">Open Data</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	</div>
<?php
	break;
	
	case "data_mhs":
	$data_angkatan = $db->database_fetch_array($db->database_prepare("SELECT * FROM angkatan WHERE angkatan_id = ?")->execute($_GET['tahun_angkatan']));
	$sql_prodi = $db->database_prepare("SELECT * FROM prodi WHERE prodi_id = ?")->execute($_GET['prodi']);
	$data_prodi = $db->database_fetch_array($sql_prodi);
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
                                Data Mahasiswa Ajaran Baru<br>
                                <?php
                                echo "Program Studi: $kd_jenjang_studi - $data_prodi[nama_prodi], Th. Angkatan: $data_angkatan[tahun_angkatan]";?>
                            </h5>
                            <form method='POST' action='modul/mod_kelas/aksi_bagi_kelas.php?mod=bagi_kelas&act=input'>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th width='30'>No</th>
                                    <th width='150'>NIM/NPM</th>
                                    <th width='250'>Nama</th>
                                    <th width='100'>Status</th>
                                    <th width='50'>JK</th>
                                    <th>Kelas</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  
                                    $i = 1;
                                    $sql_mhs = $db->database_prepare("SELECT * FROM mahasiswa WHERE angkatan_id = ? AND kode_program_studi = ? ORDER BY id_mhs ASC")->execute($_GET['tahun_angkatan'],$_GET['prodi']);
                                    while ($data_mhs = $db->database_fetch_array($sql_mhs)){
                                      if ($i % 2 == 1){
                                        $bg = "#CCCCCC";
                                      }
                                      else{
                                        $bg = "#FFFFFF";
                                      }
                                      if ($data_mhs['status_mahasiswa'] == 'A'){
                                        $status = 'Aktif';
                                      }
                                      elseif ($data_mhs['status_mahasiswa'] == 'C'){
                                        $status = 'Cuti';
                                      }
                                      elseif ($data_mhs['status_mahasiswa'] == 'D'){
                                        $status = 'Drop-out';
                                      }
                                      elseif ($data_mhs['status_mahasiswa'] == 'L'){
                                        $status = 'Lulus';
                                      }
                                      elseif ($data_mhs['status_mahasiswa'] == 'K'){
                                        $status = 'Keluar';
                                      }
                                      else{
                                        $status = 'Non-Aktif';
                                      }
                                      
                                      $num = $db->database_num_rows($db->database_prepare("SELECT * FROM kelas_mahasiswa WHERE id_mhs = ? AND semester = '1'")->execute($data_mhs['id_mhs']));
                                      if ($num == 0){
                                        echo "<tr>
                                            <td bgcolor=$bg>$i</td>
                                            <td bgcolor=$bg>$data_mhs[nim]<input type='hidden' name='id_mhs[]' value=$data_mhs[id_mhs]></td>
                                            <td bgcolor=$bg>$data_mhs[nama_mahasiswa]</td>
                                            <td bgcolor=$bg>$status</td>
                                            <td bgcolor=$bg>$data_mhs[jenis_kelamin]</td>
                                            <td bgcolor=$bg>
                                            <select name='kelas_id[]' class='form-control'>
                                              <option value=''>Pilih Kelas</option>";
	                                            $sql_kelas = $db->database_prepare("SELECT * FROM kelas WHERE prodi_id = ? AND angkatan_id = ? AND semester_kelas = '1' AND status = 'A' ORDER BY kelas_id ASC")->execute($_GET['prodi'],$_GET['tahun_angkatan']);
	                                            while($data_kelas = $db->database_fetch_array($sql_kelas)){
	                                           echo "<option value=$data_kelas[kelas_id]>$data_kelas[nama_kelas] ($data_kelas[daya_tampung])</option>"; 
	                                            }
                                            echo "</select></td>
                                          </tr>";
                                          $i++;
                                      }
                                      
                                    }
                                  ?>            
                                </tbody>
                            </table>
                         <button type='submit' class='btn btn-primary'><i class='icon-save'></i> Update Pembagian Kelas</button>
                        </form>   
                        </div>
                    </div>
                </div>

            </div>
    </div>
	
	<?php
	break;
	
	case "all":
	$data_angkatan = $db->database_fetch_array($db->database_prepare("SELECT * FROM angkatan WHERE angkatan_id = ?")->execute($_GET['tahun_angkatan']));
	$sql_prodi = $db->database_prepare("SELECT * FROM prodi WHERE prodi_id = ?")->execute($_GET['prodi']);
	$data_prodi = $db->database_fetch_array($sql_prodi);
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
                                Data Mahasiswa<br>
                                <?php
                                echo "Program Studi: $kd_jenjang_studi - $data_prodi[nama_prodi], Th. Angkatan: $data_angkatan[tahun_angkatan]";?>
                            </h5>
                            <form method='POST' action='modul/mod_kelas/aksi_bagi_kelas.php?mod=bagi_kelas&act=input'>
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                <tr>
                                   <th width='30'>No</th>
									<th width='150'>NIM/NPM</th>
									<th width='250'>Nama</th>
									<th width='100'>Status</th>
									<th width='50'>JK</th>
									<th width='50'>Kelas</th>
									<th align='left'>Semester</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 1;
                                    $sql_mhs = $db->database_prepare("SELECT * FROM mahasiswa INNER JOIN kelas_mahasiswa ON kelas_mahasiswa.id_mhs=mahasiswa.id_mhs 
											INNER JOIN kelas ON kelas.kelas_id=kelas_mahasiswa.kelas_id WHERE mahasiswa.angkatan_id = ? AND mahasiswa.kode_program_studi = ? ORDER BY mahasiswa.id_mhs ASC")->execute($_GET['tahun_angkatan'],$_GET['prodi']);
                                    while ($data_mhs = $db->database_fetch_array($sql_mhs)){
										if ($data_mhs['status_mahasiswa'] == 'A'){
											$status = 'Aktif';
										}
										elseif ($data_mhs['status_mahasiswa'] == 'C'){
											$status = 'Cuti';
										}
										elseif ($data_mhs['status_mahasiswa'] == 'D'){
											$status = 'Drop-out';
										}
										elseif ($data_mhs['status_mahasiswa'] == 'L'){
											$status = 'Lulus';
										}
										elseif ($data_mhs['status_mahasiswa'] == 'K'){
											$status = 'Keluar';
										}
										elseif ($data_mhs['status_mahasiswa'] == 'N'){
											$status = 'Non-Aktif';
										}
                                        echo "<tr>
                                            <td>$i</td>
											<td>$data_mhs[nim]</td>
											<td>$data_mhs[nama_mahasiswa]</td>
											<td>$status</td>
											<td>$data_mhs[jenis_kelamin]</td>
											<td>$data_mhs[nama_kelas]</td>
											<td>$data_mhs[semester_kelas]</td>
										</tr>";
                                      $i++;
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
	
	case "detail":
	?>
	<p>&nbsp;</p>
	<a href="javascript:history.go(-1)"><img src="../images/back.png"></a>
	<p>&nbsp;</p>
	<h4>Daftar Program Studi</h4>
	<table id="example" class="display">
		<thead>
			<tr>
				<th>No</th>
				<th>Program Studi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		$sql_prodi = $db->database_prepare("SELECT * FROM mspst WHERE STATUMSPST = 'A' ORDER BY jenjang_studi_id,NMPSTMSPST ASC")->execute();
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
			elseif ($data_prodi['jenjang_studi_id'] == 'J'){
				$kd_jenjang_studi = "Profesi";
			}
			echo "
			<tr>
				<td>$no</td>
				<td>$kd_jenjang_studi - $data_prodi[NMPSTMSPST]</td>
				<td><a href='?mod=kelas_prodi&act=detail&proid=$data_prodi[IDPSTMSPST]&angkatan_id=$_GET[id]'>Lihat</a></td>
			</tr>";
			$no++;
		} 
		?>
		</tbody>
	</table>
	
	<?php
	if($_GET['proid'] != ''  && $_GET['angkatan_id'] != ''){
		$data_ang = $db->database_fetch_array($db->database_prepare("SELECT * FROM as_angkatan WHERE angkatan_id = ?")->execute($_GET['angkatan_id']));
		$dt_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM mspst WHERE IDPSTMSPST = ?")->execute($_GET["proid"]));
		if ($dt_prodi['jenjang_studi_id'] == 'A'){
			$kd_jenjang_studi = "S3";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'B'){
			$kd_jenjang_studi = "S2";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'C'){
			$kd_jenjang_studi = "S1";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'D'){
			$kd_jenjang_studi = "D4";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'E'){
			$kd_jenjang_studi = "D3";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'F'){
			$kd_jenjang_studi = "D2";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'G'){
			$kd_jenjang_studi = "D1";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'H'){
			$kd_jenjang_studi = "Sp-1";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'I'){
			$kd_jenjang_studi = "Sp-2";
		}
		elseif ($dt_prodi['jenjang_studi_id'] == 'J'){
			$kd_jenjang_studi = "Profesi";
		}
		echo "<p>&nbsp;</p>
				<h4>Data Kelas: $kd_jenjang_studi - $dt_prodi[NMPSTMSPST]<br>
				Th. Angkatan $data_ang[tahun_angkatan]</h4>
		";
		?><div>
				<a href="?mod=kelas_prodi&act=add&proid=<?php echo $_GET['proid']; ?>&angkatan_id=<?php echo $_GET['angkatan_id']; ?>"><button type='button' class='btn btn-primary'>+ Tambah Kelas</button></a>
			</div>
			<table id="example2" class="display">
				<thead>
					<tr>
						<th>No</th>
						<th>Kelas</th>
						<th>Semester</th>
						<th>Daya Tampung</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql_kelas = $db->database_prepare("SELECT * FROM as_kelas WHERE prodi_id = ? AND angkatan_id = ? ORDER BY kelas_id DESC")->execute($_GET["proid"],$_GET["angkatan_id"]);
				while ($data_kelas = $db->database_fetch_array($sql_kelas)){
					if ($data_kelas['aktif'] == 'A'){
						$status = "Aktif";
					}
					else{
						$status = "Tidak Aktif";
					}
					echo "
					<tr>
						<td>$no</td>
						<td>$data_kelas[nama_kelas]</td>
						<td>$data_kelas[semester]</td>
						<td>$data_kelas[daya_tampung]</td>
						<td>$status</td>
						<td><a href='?mod=kelas_prodi&act=edit&id=$data_kelas[kelas_id]&proid=$_GET[proid]&angkatan_id=$_GET[angkatan_id]'><img src='../images/edit.jpg' width='20'></a>";
						?>
						<a href="modul/mod_kelas/aksi_kelas.php?mod=kelas_prodi&act=delete&id=<?php echo $data_kelas[kelas_id];?>&proid=<?php echo $_GET['proid']; ?>&angkatan_id=<?php echo $_GET['angkatan_id']; ?>" onclick="return confirm('Anda Yakin ingin menghapus kelas <?php echo $data_kelas[nama_kelas];?>?');"><img src='../images/delete.jpg' width='20'></a>
						<?php
						echo "</td>
					</tr>";
					$no++;
				} 
				?>
				</tbody>
			</table>
	<?php
	}
	
	break;
	
	case "add":
	$data_ang = $db->database_fetch_array($db->database_prepare("SELECT * FROM as_angkatan WHERE angkatan_id = ?")->execute($_GET['angkatan_id']));
	$dt_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM mspst WHERE IDPSTMSPST = ?")->execute($_GET["proid"]));
	if ($dt_prodi['jenjang_studi_id'] == 'A'){
		$kd_jenjang_studi = "S3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'B'){
		$kd_jenjang_studi = "S2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'C'){
		$kd_jenjang_studi = "S1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'D'){
		$kd_jenjang_studi = "D4";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'E'){
		$kd_jenjang_studi = "D3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'F'){
		$kd_jenjang_studi = "D2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'G'){
		$kd_jenjang_studi = "D1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'H'){
		$kd_jenjang_studi = "Sp-1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'I'){
		$kd_jenjang_studi = "Sp-2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'J'){
		$kd_jenjang_studi = "Profesi";
	}
?>
	<p>&nbsp;</p>
	<h4>Tambah Kelas</h4>
	<div class="well">
		<form id="frm_kelas" action="modul/mod_kelas/aksi_kelas.php?mod=kelas_prodi&act=input" method="POST">
			<label>Program Studi</label>
				<b><?php echo $kd_jenjang_studi." - ".$dt_prodi['NMPSTMSPST']; ?></b><p></p><input type="hidden" name="proid" value="<?php echo $dt_prodi['IDPSTMSPST']; ?>">
			
			<label>Tahun Angkatan</label>
				<b><?php echo $data_ang['tahun_angkatan']; ?></b><p></p><input type="hidden" name="angkatan_id" value="<?php echo $data_ang['angkatan_id']; ?>">
			<label>Nama Kelas <font color="red">*</font></label>
				<input type="text" name="nama_kelas" class="required">
			<label>Semester <font color="red">*</font></label>
				<select name="semester" class="required">
					<option value=""></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
				</select>
			<label>Daya Tampung <font color="red">*</font> <i>Daya tampung kursi / mahasiswa per kelas</i></label>
				<input type="text" name="daya_tampung" class="required">
			<label>Status <font color="red">*</font></label>
				<select name="aktif" class="required">
					<option value=""></option>
					<option value="A">Aktif</option>
					<option value="N">Non-Aktif</option>
				</select>		
		<br><br>	
		<div>
			<button type="submit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
		</div>
		</form>
	</div>
	<?php
	break;
	
	case "edit":
	$data_ang = $db->database_fetch_array($db->database_prepare("SELECT * FROM as_angkatan WHERE angkatan_id = ?")->execute($_GET['angkatan_id']));
	$dt_prodi = $db->database_fetch_array($db->database_prepare("SELECT * FROM mspst WHERE IDPSTMSPST = ?")->execute($_GET["proid"]));
	$data_kelas = $db->database_fetch_array($db->database_prepare("SELECT * FROM as_kelas WHERE kelas_id=?")->execute($_GET["id"]));
	if ($dt_prodi['jenjang_studi_id'] == 'A'){
		$kd_jenjang_studi = "S3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'B'){
		$kd_jenjang_studi = "S2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'C'){
		$kd_jenjang_studi = "S1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'D'){
		$kd_jenjang_studi = "D4";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'E'){
		$kd_jenjang_studi = "D3";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'F'){
		$kd_jenjang_studi = "D2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'G'){
		$kd_jenjang_studi = "D1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'H'){
		$kd_jenjang_studi = "Sp-1";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'I'){
		$kd_jenjang_studi = "Sp-2";
	}
	elseif ($dt_prodi['jenjang_studi_id'] == 'J'){
		$kd_jenjang_studi = "Profesi";
	}
?>
	<p>&nbsp;</p>
	<h4>Ubah Kelas</h4>
	<div class="well">
		<form id="frm_kelas" action="modul/mod_kelas/aksi_kelas.php?mod=kelas_prodi&act=update" method="POST">
			<input type="hidden" name="id" value="<?php echo $data_kelas['kelas_id']; ?>">
			<input type="hidden" name="proid" value="<?php echo $_GET['proid']; ?>">
			<input type="hidden" name="angkatan_id" value="<?php echo $_GET['angkatan_id']; ?>">
			<label>Program Studi</label>
				<b><?php echo $kd_jenjang_studi." - ".$dt_prodi['NMPSTMSPST']; ?></b><p></p><input type="hidden" name="proid" value="<?php echo $dt_prodi['IDPSTMSPST']; ?>">
			
			<label>Tahun Angkatan</label>
				<b><?php echo $data_ang['tahun_angkatan']; ?></b><p></p><input type="hidden" name="angkatan_id" value="<?php echo $data_ang['angkatan_id']; ?>">
			<label>Nama Kelas <font color="red">*</font></label>
				<input type="text" name="nama_kelas" class="required" value="<?php echo $data_kelas['nama_kelas']; ?>">
			<label>Semester <font color="red">*</font></label>
				<select name="semester" class="required">
					<option value=""></option>
					<option value="1" <?php if($data_kelas['semester'] == 1){ echo "SELECTED"; } ?>>1</option>
					<option value="2" <?php if($data_kelas['semester'] == 2){ echo "SELECTED"; } ?>>2</option>
					<option value="3" <?php if($data_kelas['semester'] == 3){ echo "SELECTED"; } ?>>3</option>
					<option value="4" <?php if($data_kelas['semester'] == 4){ echo "SELECTED"; } ?>>4</option>
					<option value="5" <?php if($data_kelas['semester'] == 5){ echo "SELECTED"; } ?>>5</option>
					<option value="6" <?php if($data_kelas['semester'] == 6){ echo "SELECTED"; } ?>>6</option>
					<option value="7" <?php if($data_kelas['semester'] == 7){ echo "SELECTED"; } ?>>7</option>
					<option value="8" <?php if($data_kelas['semester'] == 8){ echo "SELECTED"; } ?>>8</option>
				</select>
			<label>Daya Tampung <font color="red">*</font> <i>Daya tampung kursi / mahasiswa per kelas</i></label>
				<input type="text" name="daya_tampung" class="required" value="<?php echo $data_kelas['daya_tampung']; ?>">
			<label>Status <font color="red">*</font></label>
				<select name="aktif" class="required">
					<option value=""></option>
					<option value="A" <?php if($data_kelas['aktif'] == 'A'){ echo "SELECTED"; } ?>>Aktif</option>
					<option value="N" <?php if($data_kelas['aktif'] == 'N'){ echo "SELECTED"; } ?>>Non-Aktif</option>
				</select>		
		<br><br>	
		<div>
			<button type="submit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
		</div>
		</form>
	</div>
	<?php
	break;
}
?>