<?php 
   //TOKEN BOT
    $token_bot="713784264:AAGFNdWJdjKH3f9irAgSFP65itAHe3LFkG4";

    //KIRIM PESAN
    $LinkSend = "https://api.telegram.org/bot$token_bot/sendMessage?";
 
    //KIRIM DOKUMEN
    $LinkSendDoc = "https://api.telegram.org/bot$token_bot/sendDocument?";
    $Lokasipdf = "https://kutorejo.desa.or.id/botcamp/";

    //Set Time Server
    date_default_timezone_set("Asia/Jakarta");

    //Sesuaikan Tanggal dan Jam
    $tgljam = date("Y-m-d H:i:s");
    $tgl = date("Y-m-d");

    //Setting Database
    $Pengguna = "kutorejo_botcamp";
    $Sandi = "botcamp5498";
    $Host = "localhost";
    $db = "kutorejo_botcamp";
    $con = mysqli_connect($Host, $Pengguna, $Sandi, $db);

    //FORMAT PERTUKARAN DATA JSON
    $ambil = file_get_contents('php://input');
    $pesan = json_decode($ambil, TRUE);
    
    include "fungsi_date.php";
    $date_now = tgl_indo($tgl);
    
    //-----------------------------------------------------------------------
    if($pesan["message"]["message_id"] != null){
        $id_pesan = $pesan["message"]["message_id"];
        $id_pengirim = $pesan["message"]["chat"]["id"];
        $pengirim = $pesan["message"]["chat"]["first_name"];
        $tgl_pesan = $pesan["message"]["date"];
        $pesan_asli = $pesan["message"]["text"];
        
        switch ($pesan_asli) {
            case "/start":
                $psn = urlencode("Hallo $pengirim 😉 !!! \nSelamat Datang di layanan SIAKAD UNIPDU Silahkan Menggunakan Fitur yang tersedia\nUntuk bantuan cara penggunaan aplikasi silahkan ketik: /bantuan");
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if (mysqli_num_rows($proses) == 0){
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                }else{
                    $keyboard = array(array("Tentang","Profil"), array("KRS","KHS","Biaya"), array("Transkrip Nilai"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
            
            case "/bantuan":
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if (mysqli_num_rows($proses) == 0){
                    $psn = urlencode("Selamat Datang di Sistem Informasi Akademik Universitas Pesantren Tinggi Darul Ulum \n\n ").
                    urlencode("⚠️ SILAHKAN MENDAFTAR TERLEBIH DAHULU \n\n ").
                    urlencode("1. Pilih Tombol Register dibawah ini. \n ").
                    urlencode("2. Masukkan NIM kamu. Contoh : 4115095 \n ").
                    urlencode("3. Masukkan Password kamu yang digunakan untuk login SIAKAD \n ").
                    urlencode("4. Jika kamu telah memasukkan NIM dan Password dengan benar maka Selamat kamu dapat menggunakan bot telegram ini untuk mengakses data kamu yang ada di siakad 😄\n ");
                }else{
                    $psn = urlencode("Selamat Datang di Sistem Informasi Akademik Universitas Pesantren Tinggi Darul Ulum \n\n ").
                    urlencode("✅ DAFTAR MENU-MENU YANG TERSEDIA \n\n ").
                    
                    urlencode("1. Tombol Profil untuk melihat informasi data diri kamu \n ").
                    urlencode("2. Tombol KRS untuk melihat daftar KRS kamu \n ").
                    urlencode("3. Tombol KHS untuk melihat daftar KHS kamu \n ").
                    urlencode("4. Tombol Biaya untuk melihat rincian pembiayaan kuliah kamu \n ").
                    urlencode("5. Tombol Transkrip Nilai untuk melihat daftar transkrip nilai kamu \n\n ").
                    urlencode("SILAHKAN MENCOBA !!! \n ");
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn");
                return;
                break;
                
            case "/logout":
                $sql = "UPDATE `mahasiswa` SET `id_telegram`= '0' WHERE `id_telegram` = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if(mysqli_num_rows($proses) == 0){
                    $psn = urlencode("Anda Berhasil Logout");
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                }
                else{
                    $psn = urlencode("Anda Gagal Logout");
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
                
            case "Register":
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if (mysqli_num_rows($proses) == 0){
                    $sql = "INSERT INTO daftar_temp VALUES ('$id_pengirim','','')";
                    $proses = mysqli_query($con, $sql);
                    $keyboard = array(array("Batal Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                    $psn = urlencode("ID Telegram = $id_pengirim\nMasukkan NIM anda !");
                }else{
                    $keyboard = array(array("Tentang","Profil"), array("KRS","KHS","Biaya"), array("Transkrip Nilai"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                    $psn = "Menu Register tidak dapat digunakan dikarenakan anda telah terdaftar disistem ini";
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
                
            case "Batal Register":
                $sql = "DELETE FROM daftar_temp WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if (mysqli_num_rows($proses) == 0){
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                }else{
                    $keyboard = array(array("Tentang","Profil"), array("KRS","KHS","Biaya"), array("Transkrip Nilai"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=Registrasi di Batalkan&reply_markup=$reply");
                return;
                break;
                
            case "KRS":
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if (mysqli_num_rows($proses) == 0){
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                    $psn = "Silahkan Register Terlebih Dahulu !";
                }else{
                    $sql = "SELECT * FROM v_krs1 WHERE id_telegram = '$id_pengirim' AND status = 'A' ";
                    $proses = mysqli_query($con, $sql);
                    if(mysqli_num_rows($proses) == 0){
                        $psn = "Maaf Anda Belum Memiliki KRS";
                        $keyboard = array(array("Tentang","Profil"), array("KRS","KHS","Biaya"), array("Transkrip Nilai"));
                        $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                        $reply = json_encode($resp);
                    }else{
                        $hasil = "";
                        $hasil = $hasil."KRS Mahasiswa\n\n";
                        while ($d = mysqli_fetch_array($proses)){
                            if ($d['program'] == 'R'){$program = "Reguler";}
                            else{$program = "Non-Reguler";}
                            
                            $daftarhari = array("","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
                            $hari = $daftarhari[$d['hari']];
                            $kode_makul = $d["kode_mata_kuliah"];
                            $nama_makul = $d["nama_mata_kuliah"];
                            $sks = $d["sks"];
                            $kelas = $d["nama_kelas"];
                            $nama_dosen = $d["nama_dosen"];
                            $gelar = $d["gelar"];
                            $jam_mulai = $d["jam_mulai"];
                            $jam_selesai = $d["jam_selesai"];
                            $ruang = $d["nama_ruang"];
                            
                        
                            $hasil = $hasil."📌 Kode MK: $kode_makul \n├ Nama MK: $nama_makul \n├ SKS: $sks \n├ Kelas: $kelas \n├ Dosen: $nama_dosen.$gelar \n├ Ruang: $ruang \n├ Hari: $hari \n├ Jam: $jam_mulai-$jam_selesai \n└ Ruang: $ruang \n\n";
                            
                        }
                        
                        $ang = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM  angkatan WHERE  status =  'A'"));
                            $tahun = $ang["tahun_angkatan"];
                            $semester = $ang["semester_angkatan"];
                        $mhs = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM mahasiswa A INNER JOIN prodi B ON A.kode_program_studi=B.prodi_id LEFT JOIN dosen E ON B.kaprodi = E.dosen_id WHERE A.id_telegram= '$id_pengirim'"));
                        $nim = $mhs["nim"];
                        $nama_mhs = $mhs["nama_mahasiswa"];
                        $prodi = $mhs["nama_prodi"];
                        $nama_dosen = $mhs["nama_dosen"];
                        $gelar = $mhs["gelar"];
                        $nidn = $mhs["nidn"];
                        $content = "
                        <table align='center'>
                            <tr align='top'>
                                <td><img src='logo.JPG' height='50'></td>
                                <td width='10'></td>
                                <td>
                                    <b>Universitas Pesantren Tinggi Darul Ulum</b><br>
                                    PP Darul Ulum Rejoso Peterongan Jombang<br>
                                    Telp. (0231) 358630, 085 621 21141
                                </td>
                            </tr>
                            <tr>
                                <td colspan='3'><hr></td>
                            </tr>
                            <tr>
                                <td colspan='3' align='center'><br><p><b><u>KARTU RENCANA STUDI (KRS)</u></b></p></td>
                            </tr>
                            <tr>
                                <td colspan='3'><p>&nbsp;</p></td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td width='50'>NIM</td>
                                <td width='5'>:</td>
                                <td><b>$nim</b></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><b>$nama_mhs</b></td>
                            </tr>
                            <tr>
                                <td>Prodi</td>
                                <td>:</td>
                                <td><b>$prodi</b></td>
                            </tr>
                            <tr>
                                <td>Tahun Angkatan</td>
                                <td>:</td>
                                <td><b>$tahun - $semester</b></td>
                            </tr>
                        </table>
                        <br>
                        <table cellpadding=0 border='0' cellspacing=0>
                            <tr>
                                <th width='10' style='border: 1px solid #000; padding: 5px;font-size: 11.5px; background-color:#DC143C;'>No.</th>
                                <th align='center' width='60' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Kode MK</th>
                                <th align='center' width='180' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Nama MK</th>
                                <th align='center' width='200' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Dosen</th>
                                <th align='center' width='55' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Hari</th>
                                <th align='center' width='55' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Jam</th>
                                <th align='center' width='55' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>Ruang</th>
                                <th width='55' align='center' style='border: 1px solid #000; font-size: 11.5px;background-color:#DC143C;'>SKS</th>
                            </tr>
                            <tr bgcolor='#DC143C'>
                            </tr>";
                        $xx = 1;
                        $sql2 = "SELECT * FROM v_krs1 WHERE id_telegram = '$id_pengirim' AND status = 'A'";
                        $proses2 = mysqli_query($con, $sql2);
                        while ($d2 = mysqli_fetch_array($proses2)){
                            if($d2['program'] == 'A'){$program2 = "Reguler";}
                            else{$program2 = "Non-Reguler";}
        
                            $daftarhari2 = array("","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
                            $hari2 = $daftarhari2[$d2['hari']];
                            $kode_makul2 = $d2["kode_mata_kuliah"];
                            $nama_makul2 = $d2["nama_mata_kuliah"];
                            $sks2 = $d2["sks"];
                            $kelas2 = $d2["nama_kelas"];
                            $nama_dosen2 = $d2["nama_dosen"];
                            $gelar2 = $d2["gelar"];
                            $jam_mulai2 = $d2["jam_mulai"];
                            $jam_selesai2 = $d2["jam_selesai"];
                            $ruang2 = $d2["nama_ruang"];
                            
                        $content .= "
                                    <tr>
                                        <td style='border: 1px solid #000;padding: 5px; font-size: 11.5px;'>$xx</td>
                                        <td style='border: 1px solid #000; font-size: 11.5px;'>$kode_makul2</td>
                                        <td style='border: 1px solid #000; font-size: 11.5px;'>$nama_makul2</td>
                                        <td style='border: 1px solid #000; font-size: 11.5px;'>$nama_dosen2 $gelar2</td>
                                        <td style='border: 1px solid #000; font-size: 11.5px;' align='center'>$hari2</td>
                                        <td style='border: 1px solid #000; font-size: 11.5px;' align='center'>$jam_mulai2 - $jam_selesai2</td>
                                        <td style='border: 1px solid #000; font-size: 11.5px;' align='center'>$ruang2</td>
                                        <td style='border: 1px solid #000; font-size: 11.5px;' align='center'>$sks2</td>
                                    </tr>";
                                $grand_sks += $sks2;
                                $xx++;
                        }
                        
                        $content .= "
                            <tr>
                                <td colspan='7' style='border: 1px solid #000; padding: 4px 7px; font-size: 11.5px;' align='center'><b>Total SKS</b></td>
                                <td style='border: 1px solid #000; font-size: 11.5px;' align='center'><b>$grand_sks</b></td>
                            </tr>
                            </table>
                            <p>&nbsp;</p>
                            <table>
                                <tr>
                                    <td width='400'></td>
                                    <td align='center'>Jombang, $date_now<br>
                                    Universitas Pesantren Tinggi Darul Ulum Jombang<br>
                                    Kepala Program Studi<br>
                                        <p>&nbsp;</p><p>&nbsp;</p>
                                        <u>$nama_dosen $gelar</u><br>
                                        <b>NIP. $nidn</b> 
                                    </td>
                                </tr>
                            </table>
                            ";
                                
                        //--
                        $psn = urlencode($hasil);
                        $jamskr = strtotime($tgljam);
                        $namapdf = $jamskr."KRS".$tahun.$semester;
                        $judul = $Lokasipdf.$namapdf.".pdf";
                        include "akad/fungsi/mpdf57/mpdf.php";
                        $mpdf = new mPDF("utf-8","A4");
                        $mpdf->WriteHTML($content);
                        //$mpdf->WriteHTML($psn);
                        $mpdf->Output($namapdf.".pdf");
                        //-
                        file_get_contents($LinkSendDoc."chat_id=$id_pengirim&document=$judul");
                        file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&parse_mode=HTML");
                        unlink($namapdf.".pdf");
                        return;
                    }
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
                
            case "KHS":
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if(mysqli_num_rows($proses) == 0){
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                    $psn = "Silahkan Register Terlebih Dahulu !";
                }else{
                    $sqlk = "SELECT id_telegram, nim, tahun_angkatan, semester_angkatan FROM v_khs1 WHERE id_telegram = '$id_pengirim' GROUP BY nim, tahun_angkatan, semester_angkatan ORDER BY nim, tahun_angkatan, semester_angkatan";
                    $prosesk = mysqli_query($con, $sqlk);
                    if(mysqli_num_rows($prosesk) == 0){
                        $psn = "Maaf Anda Belum Memiliki KHS";
                        $keyboard = array(array("Tentang","Profil"), array("KRS","KHS","Biaya"), array("Transkrip Nilai"));
                        $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                        $reply = json_encode($resp);
                    }else{
                        $datakhs = array();
                        while($k = mysqli_fetch_array($prosesk)){
                            $array = array(array("text"=>"🗓 ".$k["tahun_angkatan"]."-".$k["semester_angkatan"], "callback_data"=>"KHS|$id_pengirim|".$k["tahun_angkatan"]."|".$k["semester_angkatan"]));
                            array_push($datakhs, $array);
                        }
                        $keyboard = $datakhs;
                        $resp = array("inline_keyboard" => $keyboard);
                        $reply = json_encode($resp);
                        $psn = "Silahkan Pilih KHS Berdasarkan Tahun Akademik";
                    }
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
                
            case "Transkrip Nilai":
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if(mysqli_num_rows($proses) == 0){
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                    $psn = "Silahkan Register Terlebih Dahulu !";
                }else{
                    $sql = "SELECT * FROM v_khs1 WHERE id_telegram = '$id_pengirim' GROUP BY kode_mata_kuliah";
                    $proses = mysqli_query($con, $sql);
                    $hasil = "";
                    $hasil = $hasil."Transkrip Nilai Mahasiswa\n\n";
                    while ($y = mysqli_fetch_array($proses)){
                        $a = $y["kode_mata_kuliah"];
                        $b = $y["nama_mata_kuliah"];
                        $c = $y["sks"];
                        $d = $y["tugas"];
                        $e = $y["uts"];
                        $f = $y["uas"];
                        $g = $y["total"];
                        $h = $y["abs_masuk"];
                        $i = $y["abs_tot"];
                        $k = $y["absensi"];
                        
                        $nilai_abs = $k;
                        $nilai_tugas = ($d / 100) * 15;
                        $nilai_uts  = ($e / 100) * 25;
                        $nilai_uas  = ($f / 100) * 40;
                        
                        $nilai = $nilai_abs + $nilai_tugas + $nilai_uas + $nilai_uts;
                        
                        if ($nilai >= 95 AND $nilai <= 100){$mutu = "A"; $bobot = "4";}
                        elseif ($nilai >= 90 AND $nilai <= 94.9){$mutu = "A-"; $bobot = "3.75";}
                        elseif ($nilai >= 85 AND $nilai <= 89.9){$mutu = "B+"; $bobot = "3.25";}
                        elseif ($nilai >= 80 AND $nilai <= 84.9){$mutu = "B"; $bobot = "3";}
                        elseif ($nilai >= 75 AND $nilai <= 79.9){$mutu = "B-"; $bobot = "2.75";}
                        elseif ($nilai >= 70 AND $nilai <= 74.9){$mutu = "C+"; $bobot = "2.25";}
                        elseif ($nilai >= 65 AND $nilai <= 69.9){$mutu = "C"; $bobot = "2";}
                        elseif ($nilai >= 60 AND $nilai <= 64.9){$mutu = "C-"; $bobot = "1.75";}
                        elseif ($nilai >= 55 AND $nilai <= 59.9){$mutu = "D+"; $bobot = "1.25";}
                        elseif ($nilai >= 45 AND $nilai <= 49.9){$mutu = "D-"; $bobot = "1";}
                        elseif ($nilai < 44){$mutu = "E"; $bobot = "0";}    
                        
                        $total_bobot = $c * $bobot;
                        $total_sks += $c;
                        //$bobot += $bobot;
                        $bobot_total += $total_bobot;
                    
                        $hasil = $hasil."🏷 Kode MK: $a \n├ Nama MK: $b \n├ SKS: $c \n└ Grade: $mutu \n\n";
                        
                    }
                    
                    $ipk = number_format($bobot_total / $total_sks,2);
                    
                    $psn = urlencode($hasil);
                   $psn = $psn.urlencode("\nJumlah SKS: ")."$total_sks SKS";
                    $psn = $psn.urlencode("\nIP Kumulatif: ")."$ipk";
                    
                    file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn");
                    return;
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
                
            case "Biaya":
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if(mysqli_num_rows($proses) == 0){
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                    $psn = "Silahkan Register Terlebih Dahulu !";
                }else{
                    $keyboard = array(array(
                                        array("text"=>"⏩ Rincian Biaya", "callback_data"=>"rincian|$id_pengirim|"),
                                        array("text"=>"⏩ Telah Dibayar", "callback_data"=>"dibayar|$id_pengirim|")
                                    ),
                                    array(
                                        array("text"=>"⏩ Sisa Bayar", "callback_data"=>"kurang|$id_pengirim|")
                                    ));
                     $resp = array("inline_keyboard" => $keyboard);
                     $reply = json_encode($resp);
                     $psn = "Silahkan Pilih Menu Biaya !!!";
                  file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                  return;
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
                
            case "Profil":
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if(mysqli_num_rows($proses) == 0){
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                    $psn = "Silahkan Register Terlebih Dahulu !";
                }else{
                    $sql = "SELECT m. * , a.tahun_angkatan as tahun, a.semester_angkatan as semester FROM  `mahasiswa` m JOIN angkatan a ON a.angkatan_id = m.`angkatan_id` WHERE  m.id_telegram =  '$id_pengirim'";
                    $proses = mysqli_query($con, $sql);
                    $hasil = "";
                    while ($d = mysqli_fetch_array($proses)){
                        if ($d['jenis_kelamin'] == 'L'){$jenis_kelamin = "Laki-Laki";}
                        else{$jenis_kelamin = "Perempuan";}
    
                        if ($d['agama'] == 'I'){$agama = "Islam";}
                        elseif ($d['agama'] == 'K'){$agama = "Kristen";}
                        elseif ($d['agama'] == 'C'){$agama = "Katolik";}
                        elseif ($d['agama'] == 'H'){$agama = "Hindu";}
                        elseif ($d['agama'] == 'B'){$agama = "Budha";}
                        elseif ($d['agama'] == 'G'){$agama = "Konghucu";}
                        elseif ($d['agama'] == 'L'){$agama = "Lainnya";}
    
                        if ($d['program'] == 'R'){
                            $program = "Reguler";
                        }
                        else{
                            $program = "Non-Reguler";
                        }
    
                        if ($d['status_mahasiswa'] == 'A'){
                            $status_mahasiswa = "Aktif";
                        }
                        elseif ($d['status_mahasiswa'] == 'C'){
                            $status_mahasiswa = "Cuti";
                        }
                        elseif ($d['status_mahasiswa'] == 'D'){
                            $status_mahasiswa = "Drop Out";
                        }
                        elseif ($d['status_mahasiswa'] == 'L'){
                            $status_mahasiswa = "Lulus";
                        }
                        elseif ($d['status_mahasiswa'] == 'K'){
                            $status_mahasiswa = "Keluar";
                        }
                        elseif ($d['status_mahasiswa'] == 'N'){
                            $status_mahasiswa = "Non-Aktif";
                        }
                        
                        if ($d['pekerjaan_ayah'] == 'X'){
                            $pekerjaan_ayah = "Tidak Bekerja";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'A'){
                            $pekerjaan_ayah = "Petani";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'B'){
                            $pekerjaan_ayah = "Nelayan";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'C'){
                            $pekerjaan_ayah = "Peternak";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'D'){
                            $pekerjaan_ayah = "Buruh";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'E'){
                            $pekerjaan_ayah = "Karyawan Swasta";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'F'){
                            $pekerjaan_ayah = "Pedagang";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'G'){
                            $pekerjaan_ayah = "Wiraswasta";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'H'){
                            $pekerjaan_ayah = "PNS/TNI/Polri";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'I'){
                            $pekerjaan_ayah = "Pensiunan";
                        }
                        elseif ($d['pekerjaan_ayah'] == 'J'){
                            $pekerjaan_ayah = "Lainnya";
                        }
    
                        if ($d['pekerjaan_ibu'] == 'X'){
                            $pekerjaan_ibu = "Tidak Bekerja";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'A'){
                            $pekerjaan_ibu = "Petani";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'B'){
                            $pekerjaan_ibu = "Nelayan";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'C'){
                            $pekerjaan_ibu = "Peternak";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'D'){
                            $pekerjaan_ibu = "Buruh";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'E'){
                            $pekerjaan_ibu = "Karyawan Swasta";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'F'){
                            $pekerjaan_ibu = "Pedagang";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'G'){
                            $pekerjaan_ibu = "Wiraswasta";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'H'){
                            $pekerjaan_ibu = "PNS/TNI/Polri";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'I'){
                            $pekerjaan_ibu = "Pensiunan";
                        }
                        elseif ($d['pekerjaan_ibu'] == 'J'){
                            $pekerjaan_ibu = "Lainnya";
                        }
    
                        if ($d['penghasilan_ayah'] == 'A'){
                            $penghasilan_ayah = "Tidak Berpenghasilan";
                        }
                        elseif ($d['penghasilan_ayah'] == 'B'){
                            $penghasilan_ayah = "< 500.000";
                        }
                        elseif ($d['penghasilan_ayah'] == 'C'){
                            $penghasilan_ayah = "1.000.000-2.000.000";
                        }
                        elseif ($d['penghasilan_ayah'] == 'D'){
                            $penghasilan_ayah = "2.000.000-5.000.000";
                        }
                        elseif ($d['penghasilan_ayah'] == 'E'){
                            $penghasilan_ayah = "> 5.000.000";
                        }
    
                        if ($d['penghasilan_ibu'] == 'A'){
                            $penghasilan_ibu = "Tidak Berpenghasilan";
                        }
                        elseif ($d['penghasilan_ibu'] == 'B'){
                            $penghasilan_ibu = "< 500.000";
                        }
                        elseif ($d['penghasilan_ibu'] == 'C'){
                            $penghasilan_ibu = "1.000.000-2.000.000";
                        }
                        elseif ($d['penghasilan_ibu'] == 'D'){
                            $penghasilan_ibu = "2.000.000-5.000.000";
                        }
                        elseif ($d['penghasilan_ibu'] == 'E'){
                            $penghasilan_ibu = "> 5.000.000";
                        }
    
                        if ($d['semester'] == '1'){
                            $semester = "Ganjil";
                        }
                        elseif ($d['semester'] == '2'){
                            $semester = "Genap";
                        }
    
                        $nim = $d["nim"];
                        $alamat = $d["alamat"];
                        $nama_mahasiswa = $d["nama_mahasiswa"]; //error pas dimunculkan
                        $tempat_lahir = $d["tempat_lahir"];
                        $tanggal_lahir = $d["tanggal_lahir"];
                        $no_hp = $d["hp"];
                        $email = $d["email"];
                        $tanggal_masuk = $d["tanggal_masuk"];
                        $tahun = $d["tahun"];
    
                        $nama_ayah = $d["nama_ayah"];
                        $nama_ibu = $d["nama_ibu"];
                        $no_telp_ortu = $d["no_hp_ortu"];
                        
                        $sekolah_nama = $d["sekolah_nama"];
                        $sekolah_alamat = $d["sekolah_alamat"];
                        $sekolah_telp = $d["sekolah_telp"];
                        $sekolah_jurusan = $d["sekolah_jurusan"];
                        $sekolah_tahun_lulus = $d["sekolah_tahun_lulus"];
                        
                    }
                    $hasil = $hasil."Data Pribadi Mahasiswa\n\n👩🏻‍🎓NIM: $nim \n├ Nama: $nama_mahasiswa\n├ TTL: $tempat_lahir, $tanggal_lahir\n├ JK: $jenis_kelamin\n├ Agama: $agama\n├ No Hp: $no_hp\n├ Email: $email\n├ Alamat: $alamat\n├ Program: $program\n├ Status: $status_mahasiswa\n└ Angkatan: $tahun-$semester\n\n👨🏻 Nama Ayah: $nama_ayah\n├ Pekerjaan Ayah: $pekerjaan_ayah\n└ Penghasilan Ayah: $penghasilan_ayah\n\n👱🏻‍♀ Nama Ibu: $nama_ibu\n├ Pekerjaan Ibu: $pekerjaan_ibu\n└ Penghasilan Ibu: $penghasilan_ibu\n\n☎️ No Telp Orang Tua: $no_telp_ortu\n\n🏫 Asal Sekolah: $sekolah_nama\n├ Jurusan: $sekolah_jurusan\n└ Tahun Lulus: $sekolah_tahun_lulus";
                    
                    $psn = urlencode($hasil);    
                    file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn");
                    return;
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
                
                case "Tentang":
                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                $proses = mysqli_query($con, $sql);
                if(mysqli_num_rows($proses) == 0){
                    $keyboard = array(array("Register"));
                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                    $reply = json_encode($resp);
                    $psn = "Silahkan Register Terlebih Dahulu !";
                }else{
                    $psn = urlencode("BOT Telegram Ini Digunakan Untuk Otomatisasi Layanan Data Kampus UNIPDU Jombang. \n\n© Copyright : UNIPDU 2019");
                    file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn");
                    return;
                }
                file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                return;
                break;
                
                
                default:
                $sql1 = "SELECT * FROM daftar_temp WHERE id_telegram = '$id_pengirim'";
                $proses1 = mysqli_query($con, $sql1);
                if (mysqli_num_rows($proses1) == 0){ //jika tidak ada data di daftar_temp
                    $sql2 = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                    $proses2 = mysqli_query($con, $sql2);
                    if(mysqli_num_rows($proses2) == 0){
                        $keyboard = array(array("Register"));
                        $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                        $reply = json_encode($resp);
                    }else{
                        $keyboard = array(array("Tentang","Profil"), array("KRS","KHS","Biaya"), array("Transkrip Nilai"));
                        $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                        $reply = json_encode($resp);
                    }
                    file_get_contents($LinkSend."chat_id=$id_pengirim&text=Perintah Tidak di Kenal&reply_markup=$reply");
                    return;
                }else{
                    while ($d = mysqli_fetch_array($proses1)){
                        $idt = $d["id_telegram"];
                        $nmt = $d["nim"];
                        $pas = $d["password"];
                    }
                    if($nmt == ""){
                         $sql3 = "SELECT * FROM mahasiswa WHERE nim = '$pesan_asli'";
                         $proses3 = mysqli_query($con, $sql3);
                         if(mysqli_num_rows($proses3) == 0){
                            $keyboard = array(array("Batal Register"));
                            $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                            $reply = json_encode($resp);
                            $psn = urlencode("ID Telegram = $idt\nNIM anda Salah, Masukkan NIM anda yang benar !");
                         }else{
                            $sql4 = "UPDATE daftar_temp SET nim = '$pesan_asli'";
                            $proses4 = mysqli_query($con, $sql4);
                            $keyboard = array(array("Batal Register"));
                            $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                            $reply = json_encode($resp);
                            $psn = urlencode("ID Telegram = $id_pengirim\nNIM = $pesan_asli\nMasukkan Password Siakad !");
                         }
                         file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                         return;
                    }
                    if($pas == ""){
                         $pss = md5($pesan_asli);
                         $sql5 = "SELECT * FROM mahasiswa WHERE nim = '$nmt' AND password = '$pss'";
                         $proses5 = mysqli_query($con, $sql5);
                         if(mysqli_num_rows($proses5) == 0){
                            $keyboard = array(array("Batal Register"));
                            $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                            $reply = json_encode($resp);
                            $psn = urlencode("ID Telegram = $id_pengirim\nPassword Salah, Gunakan Password Siakad !");
                         }else{
                            $sql6 = "UPDATE daftar_temp SET password = '$pesan_asli'";
                            $proses6 = mysqli_query($con, $sql6);
                            $sql7 = "UPDATE mahasiswa SET id_telegram = '$idt' WHERE nim = '$nmt'";
                            $proses7 = mysqli_query($con, $sql7);
                            $sql8 = "DELETE FROM daftar_temp WHERE id_telegram='$idt'";
                            $proses8 = mysqli_query($con, $sql8);
                            
                            if($proses7){
                                $sql = "SELECT * FROM mahasiswa WHERE id_telegram = '$id_pengirim'";
                                $proses = mysqli_query($con, $sql);
                                $psn = "Registrasi Berhasil";
                                if(mysqli_num_rows($proses) == 0){
                                    $keyboard = array(array("Register"));
                                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                                    $reply = json_encode($resp);
                                }else{
                                    $keyboard = array(array("Tentang","Profil"), array("KRS","KHS","Biaya"), array("Transkrip Nilai"));
                                    $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                                    $reply = json_encode($resp);
                                }
                            }else{
                                $keyboard = array(array("Batal Register"));
                                $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
                                $reply = json_encode($resp);
                                $psn = urlencode("ID Telegram = $id_pengirim\nPassword Salah, Gunakan Password Siakad !");
                            }
                         }
                         file_get_contents($LinkSend."chat_id=$id_pengirim&text=$psn&reply_markup=$reply");
                         return;
                    }
                }
                break;
                
        }
    }else{
        $pesan_query = $pesan["callback_query"]["data"];
        $id_pengirim_query = $pesan["callback_query"]["from"]["id"];
        //file_get_contents($LinkSend."chat_id=$id_pengirim_query&text=$pesan_query");
        $data_query = explode("|", $pesan_query);
        switch ($data_query[0]){
            case "KHS":
                $sqly = "SELECT * FROM v_khs1 WHERE id_telegram = '".$data_query[1]."' AND tahun_angkatan = '".$data_query[2]."' AND semester_angkatan = '".$data_query[3]."' GROUP BY kode_mata_kuliah ORDER BY kode_mata_kuliah";
                $prosesy = mysqli_query($con, $sqly);
                $hasil = "";
                while ($y = mysqli_fetch_array($prosesy)){
                    $a = $y["kode_mata_kuliah"];
                    $b = $y["nama_mata_kuliah"];
                    $c = $y["sks"];
                    $d = $y["tugas"];
                    $e = $y["uts"];
                    $f = $y["uas"];
                    $g = $y["total"];
                    $h = $y["abs_masuk"];
                    $i = $y["abs_tot"];
                    $k = $y["absensi"];
                    $nim = $y["nim"];
                    $tahun = $y["tahun_angkatan"];
                    $semester = $y["semester_angkatan"];
                    
                    $nilai_abs = $k;
                    $nilai_tugas= ($d / 100) * 15;
                    $nilai_uts  = ($e / 100) * 25;
                    $nilai_uas  = ($f / 100) * 40;
                    $nilai = $nilai_abs + $nilai_tugas + $nilai_uas + $nilai_uts;
                    
                    if ($nilai >= 95 AND $nilai <= 100){$mutu = "A"; $bobot = "4";}
                    elseif ($nilai >= 90 AND $nilai <= 94.9){$mutu = "A-"; $bobot = "3.75";}
                    elseif ($nilai >= 85 AND $nilai <= 89.9){$mutu = "B+"; $bobot = "3.25";}
                    elseif ($nilai >= 80 AND $nilai <= 84.9){$mutu = "B"; $bobot = "3";}
                    elseif ($nilai >= 75 AND $nilai <= 79.9){$mutu = "B-"; $bobot = "2.75";}
                    elseif ($nilai >= 70 AND $nilai <= 74.9){$mutu = "C+"; $bobot = "2.25";}
                    elseif ($nilai >= 65 AND $nilai <= 69.9){$mutu = "C"; $bobot = "2";}
                    elseif ($nilai >= 60 AND $nilai <= 64.9){$mutu = "C-"; $bobot = "1.75";}
                    elseif ($nilai >= 55 AND $nilai <= 59.9){$mutu = "D+"; $bobot = "1.25";}
                    elseif ($nilai >= 45 AND $nilai <= 49.9){$mutu = "D-"; $bobot = "1";}
                    elseif ($nilai < 44){$mutu = "E"; $bobot = "0";}    
                    
                    $total_bobot = $c * $bobot;
                    $total_sks += $c;
                    //$bobot += $bobot;
                    $bobot_total += $total_bobot;
                    
                    $hasil = $hasil."📌 Kode MK: $a\n├ Nama MK: $b\n├ SKS: $c\n├ Grade: $mutu \n├ Bobot: $bobot\n└ BxK: $total_bobot \n\n";
                    
                }
                
                $ips = number_format($bobot_total / $total_sks,2);
                
                $sqlpk = "SELECT * FROM v_khs1 WHERE id_telegram = '".$data_query[1]."' GROUP BY kode_mata_kuliah";
                $prosespk = mysqli_query($con, $sqlpk);
                while ($y2 = mysqli_fetch_array($prosespk)){
                    $a2 = $y2["kode_mata_kuliah"];
                    $b2 = $y2["nama_mata_kuliah"];
                    $c2 = $y2["sks"];
                    $d2 = $y2["tugas"];
                    $e2 = $y2["uts"];
                    $f2 = $y2["uas"];
                    $g2 = $y2["total"];
                    $h2 = $y2["abs_masuk"];
                    $i2 = $y2["abs_tot"];
                    $k2 = $y2["absensi"];
                    
                    $nilai_abs2 = $k2;
                    $nilai_tugas2= ($d2 / 100) * 15;
                    $nilai_uts2 = ($e2 / 100) * 25;
                    $nilai_uas2 = ($f2 / 100) * 40;
                    
                    $nilai2 = $nilai_abs2 + $nilai_tugas2 + $nilai_uas2 + $nilai_uts2;
                    
                    if ($nilai2 >= 95 AND $nilai2 <= 100){
                        $mutu2 = "A";
                        $bobot2 = "4";
                    }
                    elseif ($nilai2 >= 90 AND $nilai2 <= 94.9){
                        $mutu2 = "A-";
                        $bobot2 = "3.75";
                    }
                    elseif ($nilai2 >= 85 AND $nilai2 <= 89.9){
                        $mutu2 = "B+";
                        $bobot2 = "3.25";
                    }
                    elseif ($nilai2 >= 80 AND $nilai2 <= 84.9){
                        $mutu2 = "B";
                        $bobot2 = "3";
                    }
                    elseif ($nilai2 >= 75 AND $nilai2 <= 79.9){
                        $mutu2 = "B-";
                        $bobot2 = "2.75";
                    }
                    elseif ($nilai2 >= 70 AND $nilai2 <= 74.9){
                        $mutu2 = "C+";
                        $bobot2 = "2.25";
                    }
                    elseif ($nilai2 >= 65 AND $nilai2 <= 69.9){
                        $mutu2 = "C";
                        $bobot2 = "2";
                    }
                    elseif ($nilai2 >= 60 AND $nilai2 <= 64.9){
                        $mutu2 = "C-";
                        $bobot2 = "1.75";
                    }
                    elseif ($nilai2 >= 55 AND $nilai2 <= 59.9){
                        $mutu2 = "D+";
                        $bobot2 = "1,25";
                    }
                    elseif ($nilai2 >= 45 AND $nilai2 <= 49.9){
                        $mutu2 = "D-";
                        $bobot2 = "1";
                    }
                    elseif ($nilai2 < 44){
                        $mutu2 = "E";
                        $bobot2 = "0";
                    }   
                    
                    $total_bobot2 = $c2 * $bobot2;
                    $total_sks2 += $c2;
                    //$bobot2 += $bobot2;
                    $bobot_total2 += $total_bobot2;
                    
                }
                $ipk = number_format($bobot_total2 / $total_sks2,2);
                
                $psn = urlencode($hasil);
                $psn = $psn.urlencode("IP Semester: ")."$ips";
                $psn = $psn.urlencode("\nIP Kumulatif: ")."$ipk";
                
                //----------------------------------------
                
                $mhs = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM mahasiswa A INNER JOIN prodi B ON A.kode_program_studi=B.prodi_id LEFT JOIN dosen E ON B.kaprodi = E.dosen_id WHERE A.nim= '$nim'"));
                $nama_mhs = $mhs["nama_mahasiswa"];
                $prodi = $mhs["nama_prodi"];
                $nama_dosen = $mhs["nama_dosen"];
                $gelar = $mhs["gelar"];
                $nidn = $mhs["nidn"];
                $content = "
                <table align='center'>
                    <tr align='top'>
                        <td><img src='logo.JPG' height='50'></td>
                        <td width='10'></td>
                        <td>
                            <b>Universitas Pesantren Tinggi Darul Ulum</b><br>
                            PP Darul Ulum Rejoso Peterongan Jombang<br>
                            Telp. (0231) 358630, 085 621 21141
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'><hr></td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'><br><p><b><u>Kartu Hasil Studi (KHS)</u></b></p></td>
                    </tr>
                    <tr>
                        <td colspan='3'><p>&nbsp;</p></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td width='50'>NIM</td>
                        <td width='5'>:</td>
                        <td><b>$nim</b></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><b>$nama_mhs</b></td>
                    </tr>
                    <tr>
                        <td>Prodi</td>
                        <td>:</td>
                        <td><b>$prodi</b></td>
                    </tr>
                    <tr>
                        <td>Tahun Angkatan</td>
                        <td>:</td>
                        <td><b>$tahun - $semester</b></td>
                    </tr>
                </table>
                <br>
                <table cellpadding=0 border='0' cellspacing=0>
                    <tr>
                        <th width='15' rowspan='2' style='border:1px solid #000; background-color: #DC143C; padding: 2px;'>No</th>
                        <th rowspan='2' align='center' width='130' style='border:1px solid #000; background-color: #DC143C; padding: 2px;'>Kode Matakuliah</th>
                        <th rowspan='2' align='center' width='250' style='border:1px solid #000; background-color: #DC143C; padding: 2px;'>Mata Kuliah</th>
                        <th rowspan='2' align='center' width='50' style='border:1px solid #000; background-color: #DC143C; padding: 2px;'>SKS</th>
                        <th colspan='2' style='border:1px solid #000; background-color: #DC143C; padding: 2px;' align='center' width='210'>Grade</th>
                    </tr>
                    <tr bgcolor='#DC143C'>
                    </tr>";
                    $xx = 1;
                    $sqly3 = "SELECT * FROM v_khs1 WHERE id_telegram = '".$data_query[1]."' AND tahun_angkatan = '".$data_query[2]."' AND semester_angkatan = '".$data_query[3]."' GROUP BY kode_mata_kuliah ORDER BY kode_mata_kuliah ";
                    $prosesy3 = mysqli_query($con, $sqly3);
                    while ($y3 = mysqli_fetch_array($prosesy3)){
                        $a3 = $y3["kode_mata_kuliah"];
                        $b3 = $y3["nama_mata_kuliah"];
                        $c3 = $y3["sks"];
                        $d3 = $y3["tugas"];
                        $e3 = $y3["uts"];
                        $f3 = $y3["uas"];
                        $g3 = $y3["total"];
                        $h3 = $y3["abs_masuk"];
                        $i3 = $y3["abs_tot"];
                        $k3 = $y3["absensi"];
                        
                        $nilai_abs3 = $k3;
                        $nilai_tugas3= ($d3 / 100) * 15;
                        $nilai_uts3 = ($e3 / 100) * 25;
                        $nilai_uas3 = ($f3 / 100) * 40;
                        $nilai3 = $nilai_abs3 + $nilai_tugas3 + $nilai_uas3 + $nilai_uts3;
                        
                        if ($nilai3 >= 95 AND $nilai3 <= 100){$mutu3 = "A"; $bobot3 = "4";}
                        elseif ($nilai3 >= 90 AND $nilai3 <= 94.9){$mutu3 = "A-"; $bobot3 = "3.75";}
                        elseif ($nilai3 >= 85 AND $nilai3 <= 89.9){$mutu3 = "B+"; $bobot3 = "3.25";}
                        elseif ($nilai3 >= 80 AND $nilai3 <= 84.9){$mutu3 = "B"; $bobot3 = "3";}
                        elseif ($nilai3 >= 75 AND $nilai3 <= 79.9){$mutu3 = "B-"; $bobot3 = "2.75";}
                        elseif ($nilai3 >= 70 AND $nilai3 <= 74.9){$mutu3 = "C+"; $bobot3 = "2.25";}
                        elseif ($nilai3 >= 65 AND $nilai3 <= 69.9){$mutu3 = "C"; $bobot3 = "2";}
                        elseif ($nilai3 >= 60 AND $nilai3 <= 64.9){$mutu3 = "C-"; $bobot3 = "1.75";}
                        elseif ($nilai3 >= 55 AND $nilai3 <= 59.9){$mutu3 = "D+"; $bobot3 = "1.25";}
                        elseif ($nilai3 >= 45 AND $nilai3 <= 49.9){$mutu3 = "D-"; $bobot3 = "1";}
                        elseif ($nilai3 < 44){$mutu3 = "E"; $bobot3 = "0";} 
                        
                        $total_bobot3 = $c3 * $bobot3;
                        $total_sks3 += $c3;
                        $bobot3 += $bobot3;
                        $bobot_total3 += $total_bobot3;
                        $content .= "
                            <tr>
                                    <td style='border:1px solid #000; padding: 2px;'>$xx</td>
                                    <td style='border:1px solid #000; padding: 2px;' align='center'>$a3</td>
                                    <td style='border:1px solid #000; padding: 2px;'>$b3</td>
                                    <td style='border:1px solid #000; padding: 2px;' align='center'>$c3</td>
                                    <td style='border:1px solid #000; padding: 2px;' align='center'>$mutu3</td>
                                </tr>";
                        $xx++;
                        }
                        $ips3 = number_format($bobot_total3 / $total_sks3,2);
                        $content .= "</table> <br> 
                            <table>
                                <tr>
                                    <td width='160'>Jumlah SKS</td>
                                    <td>: <b>$total_sks3 SKS</b></td>
                                </tr>
                                <tr>
                                    <td>IP Semester </td>
                                    <td>: <b>$ips3</b></td>
                                </tr>
                                <tr>
                                    <td>IP Kumulatif</td>
                                    <td>: <b>$ipk</b></td>
                                </tr>
                            </table>
                            <table>
                                <tr></tr>
                                <tr>
                                    <td width='400'></td>
                                    <td align='center'>Jombang, $date_now<br><br>
                                    Universitas Pesantren Tinggi Darul Ulum Jombang<br>
                                    Kepala Program Studi<br>
                                        <p>&nbsp;</p><p>&nbsp;</p>
                                        $nama_dosen $gelar<br>
                                        <b>NIP. $nidn</b> 
                                    </td>
                                </tr>
                            </table>";
                //----------------------------------------
                $jamskr = strtotime($tgljam);
                $namapdf = $jamskr."KHS".$data_query[2].$data_query[3];
                $judul = $Lokasipdf.$namapdf.".pdf";
                include "akad/fungsi/mpdf57/mpdf.php";
                $mpdf = new mPDF("utf-8","A4");
                $mpdf->WriteHTML($content);
                //$mpdf->WriteHTML($psn);
                $mpdf->Output($namapdf.".pdf");
                
                //----------------------------------------
                
                //file_get_contents($LinkSend."chat_id=$id_pengirim_query&text=$judul");
                file_get_contents($LinkSendDoc."chat_id=$id_pengirim_query&document=$judul&caption=$psn");
                unlink($namapdf.".pdf");
                return;
                break;
                
                case "rincian":
                $sql = "SELECT COUNT(A.`jadwal_id`) as jum FROM  `jadwal_kuliah` A JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`nama_mata_kuliah` =  'Skripsi' AND D.id_telegram = '".$data_query[1]."' ";
                $proses = mysqli_query($con, $sql);
                $hasil = "";
                while ($d = mysqli_fetch_array($proses)){
                        $jum_skrip = $d["jum"];
                }
                if($jum_skrip == 0){ // NO SKRIPSI, CEK DIA AMBIL MKA ATAU TIDAK
                    $sql = "SELECT A.`jadwal_id` as mka FROM  `jadwal_kuliah` A  JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`jenis_mata_kuliah` =  'C' AND D.id_telegram = '".$data_query[1]."' LIMIT 1 ";
                    $proses = mysqli_query($con, $sql);
                    $hasil = "";
                    while ($d = mysqli_fetch_array($proses)){
                            $nama_mka = $d["mka"];
                    }
                    if($nama_mka == '217'){ // NO SKRIPSI + MKA MM
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram= '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                    }elseif($nama_mka == '222'){ // NO SKRIPSI + MKA BM
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram='".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                    }elseif($nama_mka == '219'){ // NO SKRIPSI + MKA ECO
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram='".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                    }elseif($nama_mka == '225'){// NO SKRIPSI + MKA EDUWIST
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram='".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                    }else{
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya, D.kode_program_studi, D.program FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram= '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                    }
                    
                }else{
                    $sql = "SELECT A.`jadwal_id` as mka FROM  `jadwal_kuliah` A  JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`jenis_mata_kuliah` =  'C' AND D.id_telegram = '".$data_query[1]."' LIMIT 1 ";
                    $proses = mysqli_query($con, $sql);
                    $hasil = "";
                    while ($d = mysqli_fetch_array($proses)){
                            $nama_mka = $d["mka"];
                    }
                    if($nama_mka == '217'){ // SKRIPSI + MKA MM
                        $sql = "SELECT A.semester as semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya as nama_biaya, A.biaya as biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram = '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                            
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                        
                    }elseif($nama_mka == '222'){ // SKRIPSI + MKA BM
                        $sql = "SELECT A.semester as semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya as nama_biaya, A.biaya as biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram = '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                        
                    }elseif($nama_mka == '219'){ // SKRIPSI + MKA ECOTOURISM
                        $sql = "SELECT A.semester as semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya as nama_biaya, A.biaya as biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram = '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                    }elseif($nama_mka == '225'){ // // SKRIPSI + MKA EDUWISATA
                        $sql = "SELECT A.semester as semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya as nama_biaya, A.biaya as biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram = '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                    }else{
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan,C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id=B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM `akun_biaya` WHERE nama_biaya LIKE 'MKA%') AND B.prodi_id = D.kode_program_studi AND D.id_telegram= '".$data_query[1]."' AND A.aktif = 'A' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);
                        
                        $hasil = $hasil."✅ Biaya: $nama_biaya\n├ Semester: $semester\n└ Nominal: Rp.$biaya \n\n"; }
                        $hasil = $hasil."**Total : Rp.$nominal\n\n";
                    }
                }
                
                
                $psn = urlencode($hasil);
                file_get_contents($LinkSend."chat_id=$id_pengirim_query&text=$psn");
                break;
                
                case "dibayar":
                $sql = "SELECT * FROM biaya_kuliah bk JOIN mahasiswa m ON m.id_mhs = bk.id_mhs WHERE m.id_telegram = '".$data_query[1]."' ORDER BY bk.biaya_id DESC";
                $proses = mysqli_query($con, $sql);
                $hasil = "";
                while ($d = mysqli_fetch_array($proses)){
                        $tanggal = $d["created_date"];
                        $keterangan = $d["keterangan"];
                        $nominal = $d["biaya"];
                        $nomi=number_format($nominal);
                        
                        $jumlah_dibayar += $d["biaya"];
                    
                    $hasil = $hasil."🆗 $tanggal\n├ $keterangan\n└ Rp.$nomi \n\n";
                }
                
                
                $n_jum=number_format($jumlah_dibayar);
                
                $hasil = $hasil."**Total Pembayaran : Rp.$n_jum\n\n";
                
                $psn = urlencode($hasil);
                
                file_get_contents($LinkSend."chat_id=$id_pengirim_query&text=$psn");
                break;
                
                case "kurang":
                $sql = "SELECT COUNT(A.`jadwal_id`) as jum FROM  `jadwal_kuliah` A JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`nama_mata_kuliah` =  'Skripsi' AND D.id_telegram = '".$data_query[1]."' ";
                $proses = mysqli_query($con, $sql);
                $hasil = "";
                while ($d = mysqli_fetch_array($proses)){
                        $jum_skrip = $d["jum"];
                }
                if($jum_skrip == 0){ // NO SKRIPSI, CEK DIA AMBIL MKA ATAU TIDAK
                    $sql = "SELECT A.`jadwal_id` as mka FROM  `jadwal_kuliah` A  JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`jenis_mata_kuliah` =  'C' AND D.id_telegram = '".$data_query[1]."' LIMIT 1 ";
                    $proses = mysqli_query($con, $sql);
                    $hasil = "";
                    while ($d = mysqli_fetch_array($proses)){
                            $nama_mka = $d["mka"];
                    }
                    if($nama_mka == '217'){ // NO SKRIPSI + MKA MM
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram= '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                    }elseif($nama_mka == '222'){ // NO SKRIPSI + MKA BM
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram='".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                    }elseif($nama_mka == '219'){ // NO SKRIPSI + MKA ECO
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram='".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                    }elseif($nama_mka == '225'){// NO SKRIPSI + MKA EDUWIST
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND A.nama_biaya NOT  IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram='".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                    }else{
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya, A.biaya, D.kode_program_studi, D.program FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'SKRIPSI',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram= '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                    }
                    
                }else{
                    $sql = "SELECT A.`jadwal_id` as mka FROM  `jadwal_kuliah` A  JOIN makul B ON B.`mata_kuliah_id` = A.`makul_id` JOIN krs C ON A.`jadwal_id`=C.`jadwal_id` JOIN mahasiswa D ON C.id_mhs = D.id_mhs WHERE B.`jenis_mata_kuliah` =  'C' AND D.id_telegram = '".$data_query[1]."' LIMIT 1 ";
                    $proses = mysqli_query($con, $sql);
                    $hasil = "";
                    while ($d = mysqli_fetch_array($proses)){
                            $nama_mka = $d["mka"];
                    }
                    if($nama_mka == '217'){ // SKRIPSI + MKA MM
                        $sql = "SELECT A.semester as semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya as nama_biaya, A.biaya as biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram = '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah); }
                        
                    }elseif($nama_mka == '222'){ // SKRIPSI + MKA BM
                        $sql = "SELECT A.semester as semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya as nama_biaya, A.biaya as biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram = '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                        
                    }elseif($nama_mka == '219'){ // SKRIPSI + MKA ECOTOURISM
                        $sql = "SELECT A.semester as semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya as nama_biaya, A.biaya as biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA EDU',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram = '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                    }elseif($nama_mka == '225'){ // // SKRIPSI + MKA EDUWISATA
                        $sql = "SELECT A.semester as semester, A.akun_id, C.tahun_angkatan, C.semester_angkatan, A.nama_biaya as nama_biaya, A.biaya as biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id = B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id = B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA BM',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA ECO',  `nama_biaya` )) AND A.nama_biaya NOT IN (SELECT nama_biaya FROM  `akun_biaya` WHERE LOCATE(  'MKA MM',  `nama_biaya` )) AND B.prodi_id = D.kode_program_studi AND A.aktif =  'A' AND D.id_telegram = '".$data_query[1]."' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                    }else{
                        $sql = "SELECT A.semester, A.akun_id, C.tahun_angkatan,C.semester_angkatan, A.nama_biaya, A.biaya FROM akun_biaya A INNER JOIN mst_biaya B ON A.mst_biaya_id=B.mst_biaya_id INNER JOIN angkatan C ON C.angkatan_id=B.angkatan_id INNER JOIN mahasiswa D ON D.angkatan_id = C.angkatan_id WHERE A.nama_biaya NOT IN (SELECT nama_biaya FROM `akun_biaya` WHERE nama_biaya LIKE 'MKA%') AND B.prodi_id = D.kode_program_studi AND D.id_telegram= '".$data_query[1]."' AND A.aktif = 'A' ORDER BY A.semester ASC";
                        $proses = mysqli_query($con, $sql);
                        $hasil = "";
                        while ($d = mysqli_fetch_array($proses)){
                            $nama_biaya = $d["nama_biaya"];
                            $semester = $d["semester"];
                            $biaya = number_format($d["biaya"]);
                            
                            $jumlah += $d['biaya'];
                            $nominal = number_format($jumlah);}
                    }
                }
                
                $j = mysqli_fetch_array(mysqli_query($con, "SELECT SUM( bk.`biaya` ) AS tot FROM `biaya_kuliah` bk JOIN mahasiswa m ON m.id_mhs=bk.id_mhs WHERE m.id_telegram = '".$data_query[1]."'"));
                $jumlah_dibayar = $j['tot'];
                
                $kurang = $jumlah_dibayar-$jumlah;
                $nominal_kurang = number_format($kurang);
                
                $hasil="";
                
                if ($kurang<0){
                    $hasil = $hasil."Kekurangan Biaya Kamu sebesar Rp.$nominal_kurang \n\n";
                }else{
                    $hasil = $hasil."Sisa Bayar Kamu sebesar Rp.$nominal_kurang \n\n ";
                }
                
                $psn = urlencode($hasil);
                file_get_contents($LinkSend."chat_id=$id_pengirim_query&text=$psn");
                return;
                break;
        }
    }
    return;
   
    
    //-----------------------------------------------------------------------