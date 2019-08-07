<?php
error_reporting(0);
ini_set('max_execution_time', 300);
session_start();
include "../../../config/class_database.php";
include "../../../config/serverconfig.php";
include "../../../config/debug.php";
include "../../../fungsi/PHPExcel.php";

function mysql_escape($str){
	if(get_magic_quotes_gpc()){
		$str= stripslashes($str);
	}
	return str_replace("'", "''", $str);
}

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	header("Location: ../../../index.php?code=2");
}

else{
	if ($_GET['mod'] == 'mhs' && $_GET['act'] == 'input'){
		$created_date = date('Y-m-d H:i:s');
		$tgl_lahir = $_POST['tgl_lahir'];
		$tgl_masuk = $_POST['tgl_masuk_mhs'];
		$password = md5(123456);
		
		$uploaddir = '../../foto/mahasiswa/'; 
		$file = $uploaddir ."mahasiswa_".basename($_FILES['uploadfile']['name']); 
		$file_name= $_FILES['uploadfile']['name']; 
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file);
		
		$db->database_prepare("INSERT INTO mahasiswa ( 	kode_program_studi,
															nim,
															nama_mahasiswa,
															tempat_lahir,
															tanggal_lahir,
															jenis_kelamin,
															angkatan_id,
															program,
															email,
															alamat,
															hp,
															agama,
															foto,
															status_mahasiswa,
															status_awal_mahasiswa,
															tanggal_masuk,
															nama_ayah,
															nama_ibu,
															penghasilan_ayah,
															penghasilan_ibu,
															pekerjaan_ayah,
															pekerjaan_ibu,
															no_hp_ortu,
															sekolah_nama,
															sekolah_telp,
															sekolah_alamat,
															sekolah_jurusan,
															sekolah_tahun_lulus,
															password,
															last_login,
															ip,
															created_date,
															created_userid,
															modified_date,
															modified_userid
															)
													VALUES (?,?,?,?,?,?,?,?,?,?,
															?,?,?,?,?,?,?,?,?,?,
															?,?,?,?,?,?,?,?,?,?,
															?,?,?,?,?)")
												->execute( 	$_POST["kode_program_studi"],
															$_POST["nim"],
															$_POST["nama_mahasiswa"],
															$_POST["tempat_lahir"],
															$tgl_lahir,
															$_POST["jenis_kelamin"],
															$_POST["angkatan_id"],
															$_POST["program"],
															$_POST["email"],
															$_POST["alamat"],
															$_POST["hp"],
															$_POST["agama"],
															$file_name,
															$_POST["status_mahasiswa"],
															$_POST["status_awal_mahasiswa"],
															$tgl_masuk,
															$_POST["nama_ayah"],
															$_POST["nama_ibu"],
															$_POST["penghasilan_ayah"],
															$_POST["penghasilan_ibu"],
															$_POST["pekerjaan_ayah"],
															$_POST["pekerjaan_ibu"],
															$_POST["no_hp_ortu"],
															$_POST["sekolah_nama"],
															$_POST["sekolah_telp"],
															$_POST["sekolah_alamat"],
															$_POST["sekolah_jurusan"],
															$_POST["sekolah_tahun_lulus"],
															$password,
															"",
															"",
															$created_date,
															$_SESSION["userid"],
															"",
															"");
															
		header("Location: ../../index.php?mod=mhs&code=1");
	} 
	
	elseif($_GET['mod'] == 'mhs' && $_GET['act'] == 'upload'){
		$F1		= $_FILES['file'];
		$F1_name= $F1['name'];
		$F1_type= $F1['type'];
		$F1_size= $F1['size'];
		$dir	= "../../../uploads/";
		$timenow = time();
		$created_date = date('Y-m-d H:i:s');
		if(copy($F1['tmp_name'],$dir.$timenow."_".$F1_name)){
			$inputFileType = 'Excel2007';
			$inputFileName = $dir.$timenow."_".$F1_name;   
			$sheetname = 'Sheet1';
			
			class chunkReadFilter implements PHPExcel_Reader_IReadFilter {
			    private $_startRow = 0;
			    private $_endRow = 0;
			
			    /**  Set the list of rows that we want to read  */ 
			    public function setRows($startRow, $chunkSize) { 
			        $this->_startRow    = $startRow; 
			        $this->_endRow      = $startRow + $chunkSize;
			    } 
			
			    public function readCell($column, $row, $worksheetName = '') {
			        //  Only read the heading row, and the rows that are configured in $this->_startRow and $this->_endRow 
			        if (($row >= $this->_startRow && $row < $this->_endRow)) { 
			           return true;
			        }
			        return false;
			    } 
			}
			
			/**  Create a new Reader of the type defined in $inputFileType  **/
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			/**  Define how many rows we want to read for each "chunk"  **/ 
			$chunkSize = 500;
			/**  Create a new Instance of our Read Filter  **/ 
			$chunkFilter = new chunkReadFilter(); 
			/**  Tell the Reader that we want to use the Read Filter that we've Instantiated  **/ 
			$objReader->setReadFilter($chunkFilter); 
			
			for ($startRow = 1; ($startRow <= 1265536); $startRow += $chunkSize) 
			{
				/**  Tell the Read Filter, the limits on which rows we want to read this iteration  **/ 
			    $chunkFilter->setRows($startRow,$chunkSize); 
				/** Advise the Reader that we only want to load cell data, not formatting **/ 
				$objReader->setReadDataOnly(true);
			    /**  Load only the rows that match our filter from $inputFileName to a PHPExcel Object  **/ 
			    $objPHPExcel = $objReader->load($inputFileName); 
			    //    Do some processing here
			    $worksheet = null; 
				$worksheet = $objPHPExcel->getActiveSheet();
				
				//break the loop when there are 5 blank row in column A
				$numofblankrow = 0;
				$error_message = "";
				
				//Check excel format, are the first cell is "ID NUMBER"?, if not, then will be upload fail
				if($startRow == 1 && $worksheet->getCellByColumnAndRow(0, 1)->getValue() != "No.")
				{
					$processdone = 1; 
					$error_message = "Invalid import file format";
					break;
				}
				
				for($i = 0;$i<$chunkSize;$i++)
				{
					//Set $rowdata to be array variable 
					$rowdata=array();
					//Get the value from cell in excel file
					$rowdata[] 	= $worksheet->getCellByColumnAndRow(0, $i+$startRow)->getValue();
					$nim	 	= mysql_escape($worksheet->getCellByColumnAndRow(1, $i+$startRow)->getValue());
					$id_prodi 	= mysql_escape($worksheet->getCellByColumnAndRow(2, $i+$startRow)->getValue());
					$nama_mhs 	= mysql_escape($worksheet->getCellByColumnAndRow(3, $i+$startRow)->getValue());
					$tempat_lahir= mysql_escape($worksheet->getCellByColumnAndRow(4, $i+$startRow)->getValue());
					$jk			= mysql_escape($worksheet->getCellByColumnAndRow(5, $i+$startRow)->getValue());
					$program	= mysql_escape($worksheet->getCellByColumnAndRow(6, $i+$startRow)->getValue());
					$status_mhs	= mysql_escape($worksheet->getCellByColumnAndRow(7, $i+$startRow)->getValue());
					$status_awal= mysql_escape($worksheet->getCellByColumnAndRow(8, $i+$startRow)->getValue());
					$thn_angkatan = mysql_escape($worksheet->getCellByColumnAndRow(9, $i+$startRow)->getValue());
					
					$abc = (string)$rowdata[0];
					//echo "Processing excel row  : " . ($i+$startRow)  .", id : " . $abc . "<br>"; 
					
				  	//break the loop when there are 5 sequential blank row in column A
				    if($rowdata[0] == "" || $rowdata[0]==NULL || !$rowdata[0] || $rowdata[0]=="END")
				    {
						$numofblankrow++;  
						if($numofblankrow >= 5 || (string)$rowdata[0]=="END")
						{
							$processdone = 1;
							break;
						}
						else
						{
							continue;	
						}
						
				    }
					else 
					{
						$numofblankrow = 0;
					}
					$numrow = 1;
					$kosong = 0;
					if($i+$startRow > 1 && !empty($rowdata))
					{
						if($nim != "" && $nama_mhs !=""){
							$db->database_prepare("INSERT INTO mahasiswa ( 	kode_program_studi,
																				NIM,
																				nama_mahasiswa,
																				tempat_lahir,
																				tanggal_lahir,
																				jenis_kelamin,
																				angkatan_id,
																				program,
																				email,
																				alamat,
																				hp,
																				agama,
																				foto,
																				status_mahasiswa,
																				status_awal_mahasiswa,
																				tanggal_masuk,
																				nama_ayah,
																				nama_ibu,
																				penghasilan_ayah,
																				penghasilan_ibu,
																				pekerjaan_ayah,
																				pekerjaan_ibu,
																				no_hp_ortu,
																				sekolah_nama,
																				sekolah_telp,
																				sekolah_alamat,
																				sekolah_jurusan,
																				sekolah_tahun_lulus,
																				created_date,
																				created_userid,
																				modified_date,
																				modified_userid
																				)
																		VALUES (?,?,?,?,?,?,?,?,?,?,
																				?,?,?,?,?,?,?,?,?,?,
																				?,?,?,?,?,?,?,?,?,?,
																				?,?)")
																	->execute( 	$id_prodi,
																				$nim,
																				$nama_mhs,
																				$tempat_lahir,
																				"0000-00-00",
																				$jk,
																				$thn_angkatan,
																				$program,
																				"",
																				"",
																				"",
																				"",
																				"",
																				$status_mhs,
																				$status_awal,
																				"0000-00-00",
																				"",
																				"",
																				"",
																				"",
																				"",
																				"",
																				"",
																				"",
																				"",
																				"",
																				"",
																				"",
																				$created_date,
																				$_SESSION["userid"],
																				"",
																				"");	
						header("Location: ../../index.php?mod=mhs&code=4");
						}
					} //close bracket if($i+$startRow > 1 && !empty($rowdata))
				    //    Free up some of the memory 
				    
				}//close bracket for
				$objPHPExcel->disconnectWorksheets(); 
			    unset($objPHPExcel);		
			}
			header("Location: ../../index.php?mod=mhs&code=4");
		} 
		else{
			header("Location: ../../index.php?mod=mhs&code=5");
		}
	}

	elseif($_GET['mod'] == 'mhs' && $_GET['act'] == 'update'){
		$modified_date = date('Y-m-d H:i:s');
		$tgl_lahir = $_POST['tgl_lahir'];
		$tgl_masuk = $_POST['tgl_masuk_mhs'];
		
		$uploaddir = '../../foto/mahasiswa/'; 
		$file = $uploaddir ."mahasiswa_".basename($_FILES['uploadfile']['name']); 
		$file_name= $_FILES['uploadfile']['name']; 
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file);
		
		if (empty($file_name)) {
			$db->database_prepare("UPDATE mahasiswa SET nama_mahasiswa = ?,
														tempat_lahir = ?,
														tanggal_lahir = ?,
														jenis_kelamin = ?,
														angkatan_id = ?,
														program = ?,
														email = ?,
														alamat = ?,
														hp = ?,
														agama = ?,
														status_mahasiswa = ?,
														tanggal_masuk = ?,
														nama_ayah = ?,
														nama_ibu = ?,
														penghasilan_ayah = ?,
														penghasilan_ibu = ?,
														pekerjaan_ayah = ?,
														pekerjaan_ibu = ?,
														no_hp_ortu = ?,
														sekolah_nama = ?,
														sekolah_telp = ?,
														sekolah_alamat = ?,
														sekolah_jurusan = ?,
														sekolah_tahun_lulus = ?,
														modified_date = ?,
														modified_userid = ?
														WHERE id_mhs = ?")
											->execute(	$_POST["nama_mahasiswa"],
														$_POST["tempat_lahir"],
														$tgl_lahir,
														$_POST["jenis_kelamin"],
														$_POST["angkatan_id"],
														$_POST["program"],
														$_POST["email"],
														$_POST["alamat"],
														$_POST["hp"],
														$_POST["agama"],
														$_POST["status_mahasiswa"],
														$tgl_masuk,
														$_POST["nama_ayah"],
														$_POST["nama_ibu"],
														$_POST["penghasilan_ayah"],
														$_POST["penghasilan_ibu"],
														$_POST["pekerjaan_ayah"],
														$_POST["pekerjaan_ibu"],
														$_POST["no_hp_ortu"],
														$_POST["sekolah_nama"],
														$_POST["sekolah_telp"],
														$_POST["sekolah_alamat"],
														$_POST["sekolah_jurusan"],
														$_POST["sekolah_tahun_lulus"],
														$modified_date,
														$_SESSION["id_mhs"],
														$_POST["id"]);
		}elseif (!empty($file_name)) {
			$db->database_prepare("UPDATE mahasiswa SET 	nama_mahasiswa = ?,
														tempat_lahir = ?,
														tanggal_lahir = ?,
														jenis_kelamin = ?,
														angkatan_id = ?,
														program = ?,
														email = ?,
														alamat = ?,
														hp = ?,
														agama = ?,
														foto = ?,
														status_mahasiswa = ?,
														tanggal_masuk = ?,
														nama_ayah = ?,
														nama_ibu = ?,
														penghasilan_ayah = ?,
														penghasilan_ibu = ?,
														pekerjaan_ayah = ?,
														pekerjaan_ibu = ?,
														no_hp_ortu = ?,
														sekolah_nama = ?,
														sekolah_telp = ?,
														sekolah_alamat = ?,
														sekolah_jurusan = ?,
														sekolah_tahun_lulus = ?,
														modified_date = ?,
														modified_userid = ?
														WHERE id_mhs = ?")
											->execute(	$_POST["nama_mahasiswa"],
														$_POST["tempat_lahir"],
														$tgl_lahir,
														$_POST["jenis_kelamin"],
														$_POST["angkatan_id"],
														$_POST["program"],
														$_POST["email"],
														$_POST["alamat"],
														$_POST["hp"],
														$_POST["agama"],
														$file_name,
														$_POST["status_mahasiswa"],
														$tgl_masuk,
														$_POST["nama_ayah"],
														$_POST["nama_ibu"],
														$_POST["penghasilan_ayah"],
														$_POST["penghasilan_ibu"],
														$_POST["pekerjaan_ayah"],
														$_POST["pekerjaan_ibu"],
														$_POST["no_hp_ortu"],
														$_POST["sekolah_nama"],
														$_POST["sekolah_telp"],
														$_POST["sekolah_alamat"],
														$_POST["sekolah_jurusan"],
														$_POST["sekolah_tahun_lulus"],
														$modified_date,
														$_SESSION["id_mhs"],
														$_POST["id"]);
		}

		header("Location: ../../index.php?mod=mhs&code=2&act=biodata&program_studi=".$_POST['program_studi']."&nim=".$_POST['nim']);
	}

	elseif ($_GET['mod'] == 'mhs' && $_GET['act'] == 'delete'){
		$dataimage = $db->database_fetch_array($db->database_prepare("SELECT foto FROM mahasiswa WHERE id_mhs = ?")->execute($_GET["id"]));
		if ($dataimage['foto'] != ''){
			$del_image = unlink("../../foto/mahasiswa/".$dataimage['foto']);
		}
		
		$db->database_prepare("DELETE FROM mahasiswa WHERE id_mhs = ?")->execute($_GET["id"]);
		header("Location: ../../index.php?mod=mhs&code=3&act=biodata&program_studi=".$_GET['program_studi']."&nim=".$_GET['nim']);
	}

	elseif($_GET['mod'] == 'mhs' && $_GET['act'] == 'update_profil'){
		$modified_date = date('Y-m-d H:i:s');
		$tgl_lahir = $_POST['tgl_lahir'];
		$tgl_masuk = $_POST['tgl_masuk_mhs'];
		
		$uploaddir = '../../foto/mahasiswa/'; 
		$file = $uploaddir ."mahasiswa_".basename($_FILES['uploadfile']['name']); 
		$file_name= $_FILES['uploadfile']['name']; 
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file);
		
		if (empty($file_name)) {
			$db->database_prepare("UPDATE mahasiswa SET nama_mahasiswa = ?,
														tempat_lahir = ?,
														tanggal_lahir = ?,
														jenis_kelamin = ?,
														email = ?,
														alamat = ?,
														hp = ?,
														agama = ?,
														status_mahasiswa = ?,
														tanggal_masuk = ?,
														nama_ayah = ?,
														nama_ibu = ?,
														penghasilan_ayah = ?,
														penghasilan_ibu = ?,
														pekerjaan_ayah = ?,
														pekerjaan_ibu = ?,
														no_hp_ortu = ?,
														sekolah_nama = ?,
														sekolah_telp = ?,
														sekolah_alamat = ?,
														sekolah_jurusan = ?,
														sekolah_tahun_lulus = ?,
														modified_date = ?,
														modified_userid = ?
														WHERE id_mhs = ?")
											->execute(	$_POST["nama_mahasiswa"],
														$_POST["tempat_lahir"],
														$tgl_lahir,
														$_POST["jenis_kelamin"],
														$_POST["email"],
														$_POST["alamat"],
														$_POST["hp"],
														$_POST["agama"],
														$_POST["status_mahasiswa"],
														$tgl_masuk,
														$_POST["nama_ayah"],
														$_POST["nama_ibu"],
														$_POST["penghasilan_ayah"],
														$_POST["penghasilan_ibu"],
														$_POST["pekerjaan_ayah"],
														$_POST["pekerjaan_ibu"],
														$_POST["no_hp_ortu"],
														$_POST["sekolah_nama"],
														$_POST["sekolah_telp"],
														$_POST["sekolah_alamat"],
														$_POST["sekolah_jurusan"],
														$_POST["sekolah_tahun_lulus"],
														$modified_date,
														$_SESSION["id_mhs"],
														$_POST["id"]);
		}elseif (!empty($file_name)) {
			$db->database_prepare("UPDATE mahasiswa SET 	nama_mahasiswa = ?,
														tempat_lahir = ?,
														tanggal_lahir = ?,
														jenis_kelamin = ?,
														email = ?,
														alamat = ?,
														hp = ?,
														agama = ?,
														foto = ?,
														status_mahasiswa = ?,
														tanggal_masuk = ?,
														nama_ayah = ?,
														nama_ibu = ?,
														penghasilan_ayah = ?,
														penghasilan_ibu = ?,
														pekerjaan_ayah = ?,
														pekerjaan_ibu = ?,
														no_hp_ortu = ?,
														sekolah_nama = ?,
														sekolah_telp = ?,
														sekolah_alamat = ?,
														sekolah_jurusan = ?,
														sekolah_tahun_lulus = ?,
														modified_date = ?,
														modified_userid = ?
														WHERE id_mhs = ?")
											->execute(	$_POST["nama_mahasiswa"],
														$_POST["tempat_lahir"],
														$tgl_lahir,
														$_POST["jenis_kelamin"],
														$_POST["email"],
														$_POST["alamat"],
														$_POST["hp"],
														$_POST["agama"],
														$file_name,
														$_POST["status_mahasiswa"],
														$tgl_masuk,
														$_POST["nama_ayah"],
														$_POST["nama_ibu"],
														$_POST["penghasilan_ayah"],
														$_POST["penghasilan_ibu"],
														$_POST["pekerjaan_ayah"],
														$_POST["pekerjaan_ibu"],
														$_POST["no_hp_ortu"],
														$_POST["sekolah_nama"],
														$_POST["sekolah_telp"],
														$_POST["sekolah_alamat"],
														$_POST["sekolah_jurusan"],
														$_POST["sekolah_tahun_lulus"],
														$modified_date,
														$_SESSION["id_mhs"],
														$_POST["id"]);
		}

		header("Location: ../../index.php?mod=profil_mahasiswa&code=2");
	}
}
?>