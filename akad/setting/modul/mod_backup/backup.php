<?php
function &backup_tables($host, $user, $pass, $name, $tables = '*'){
	$data = "\n/*---------------------------------------------------------------".
			"\n  SQL DB BACKUP ".date("d.m.Y H:i")." ".
			"\n  HOST: {$host}".
			"\n  DATABASE: {$name}".
			"\n  TABLES: {$tables}".
			"\n  ---------------------------------------------------------------*/\n";
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	mysql_query( "SET NAMES `utf8` COLLATE `utf8_general_ci`" , $link ); // Unicode

	if($tables == '*'){ //get all of the tables
		$tables = array();
		$result = mysql_query("SHOW TABLES");
		while($row = mysql_fetch_row($result)){
			$tables[] = $row[0];
		}
	}
	else{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}

	foreach($tables as $table){
		$data.= "\n/*---------------------------------------------------------------".
		"\n  TABLE: `{$table}`".
		"\n  ---------------------------------------------------------------*/\n";
		$data.= "DROP TABLE IF EXISTS `{$table}`;\n";
		$res = mysql_query("SHOW CREATE TABLE `{$table}`", $link);
		$row = mysql_fetch_row($res);
		$data.= $row[1].";\n";

		$result = mysql_query("SELECT * FROM `{$table}`", $link);
		$num_rows = mysql_num_rows($result);

		if($num_rows>0){
			$vals = Array(); $z=0;
			for($i=0; $i<$num_rows; $i++){
				$items = mysql_fetch_row($result);
				$vals[$z]="(";
				for($j=0; $j<count($items); $j++){
					if (isset($items[$j])) { $vals[$z].= "'".mysql_real_escape_string( $items[$j], $link )."'"; } else { $vals[$z].= "NULL"; }
					if ($j<(count($items)-1)){ $vals[$z].= ","; }
				}
				$vals[$z].= ")"; $z++;
			}
			$data.= "INSERT INTO `{$table}` VALUES ";      
			$data .= "  ".implode(";\nINSERT INTO `{$table}` VALUES ", $vals).";\n";
		}
	}
	mysql_close( $link );
	return $data;
}

$backup_file = 'db-backup-siakad'.date('Y-m-d').'.sql';

// get backup
$mybackup = backup_tables("localhost","root","","dbakad","*");

// save to file
$handle = fopen($backup_file,'w+');
fwrite($handle,$mybackup);
fclose($handle);

echo "
<div class='content'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='pvr-wrapper'>
                        <div class='pvr-box'>
                            <h5 class='pvr-header'>
                                Back Up Database
                            </h5> 
                            
                                <fieldset>
                                    <div class='form-group'>
                                        
                                        <div class='alert alert-info'>
											<h5><i class='fa fa-check'></i>Success!</h5>
											<p>Backup data telah berhasil, silahkan klik link download dibawah untuk menyimpan ke dalam PC local Anda.</p>
										</div> 
                                    </div>
                                    <a href='$backup_file'><button type='button' class='btn btn-primary'><i class='fa fa-download'></i> Download Disini</button></a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
";
?>