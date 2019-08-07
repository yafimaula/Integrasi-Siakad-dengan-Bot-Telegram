<!--Begin Sidebar-->
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-bg.jpg">
        <div class="sidebar-wrapper">
            <!--Begins Logo start-->
            <div class="logo" align="center">
                
                <a href="index.php" class="simple-text logo-normal">
                    <b>UNIPDU JOMBANG</b>
                </a>
            </div>
            <!--End Logo start-->
           <ul class="nav">
                <li class="nav-item has-menu">
                    <a class="nav-link" href="index.php">
                        <i class="material-icons">dashboard</i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
<?php
if ($_SESSION["level"] == 1){
?>
                <li class="nav-item has-sub-menu">
                    <a class="nav-link" data-toggle="collapse" href="#pvr_applications">
                        <i class="material-icons">important_devices</i>
                        <p>
                            Master Data
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse sub-menu" id="pvr_applications">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=fakultas">
                                    <i class="material-icons">account_balance</i>
                                    <span class="sidebar-normal">Fakultas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=prodi">
                                    <i class="material-icons">business</i>
                                    <span class="sidebar-normal">Program Studi</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=angkatan">
                                    <i class="material-icons">date_range</i>
                                    <span class="sidebar-normal">Tahun Angkatan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=ruang">
                                    <i class="material-icons">weekend</i>
                                    <span class="sidebar-normal">Ruang Kelas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=kelas_prodi">  
                                    <i class="material-icons">fiber_smart_record</i>
                                    <span class="sidebar-normal">Kelas Per Jurusan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item has-menu">
                    <a class="nav-link" href="?mod=dosen">
                        <i class="material-icons">supervisor_account</i>
                        <p>
                            Lectures
                        </p>
                    </a>
                </li>
                <li class="nav-item has-menu"> 
                    <a class="nav-link" href="?mod=mhs">
                        <i class="material-icons">accessibility</i>
                        <p>
                            College Student
                        </p>
                    </a>
                </li>
                <li class="nav-item has-sub-menu">
                    <a class="nav-link" data-toggle="collapse" href="#pvr_applications">
                        <i class="material-icons">stars</i>
                        <p>
                            Akademik
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse sub-menu" id="pvr_applications">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=makul">
                                    <i class="material-icons">style</i>
                                    <span class="sidebar-normal">Mata Kuliah</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=jadwal_mata_kuliah">
                                    <i class="material-icons">collections_bookmark</i>
                                    <span class="sidebar-normal">Jadwal Kuliah</span>
                                </a>
                            </li>
                            <?php
                            /*<li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=bagi_kelas">
                                    <i class="material-icons">pages</i>
                                    <span class="sidebar-normal">Pembagian Kelas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="./pvr_contact_v1.html">
                                    <i class="material-icons">assessment</i>
                                    <span class="sidebar-normal">KHS</span>
                                </a>
                            </li>*/
                            ?>
                        </ul>
                    </div>
                </li>
                <li class="nav-item has-sub-menu">
                    <a class="nav-link" data-toggle="collapse" href="#pvr_applications">
                        <i class="material-icons">attach_money</i>
                        <p>
                            Master Biaya
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse sub-menu" id="pvr_applications">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=biaya">
                                    <i class="material-icons">account_balance_wallet</i>
                                    <span class="sidebar-normal">Akun Biaya</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=biaya_mahasiswa">
                                    <i class="material-icons">payment</i>
                                    <span class="sidebar-normal">Pembiayaan Mahasiswa</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item has-sub-menu">
                    <a class="nav-link" data-toggle="collapse" href="#pvr_applications">
                        <i class="material-icons">gesture</i>
                        <p>
                            Management System
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse sub-menu" id="pvr_applications">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=user">
                                    <i class="material-icons">font_download</i>
                                    <span class="sidebar-normal">Administrator</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=backup_db">
                                    <i class="material-icons">gamepad</i>
                                    <span class="sidebar-normal">Back Up DB</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--End Sidebar-->
<?php
}
elseif ($_SESSION["level"] == 'dos'){
?>

                <li class="nav-item has-menu"> 
                    <a class="nav-link" href="?mod=absensi_harian">
                        <i class="fa fa-eercast"></i>
                        <p>
                            Absensi Harian
                        </p>
                    </a>
                </li>
                <li class="nav-item has-menu">
                    <a class="nav-link" href="?mod=nilai_semester">
                       <i class="fa fa-slideshare"></i>
                        <p>
                            Nilai Semester
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item has-menu">
                    <a class="nav-link" href="?mod=skripsi">
                        <i class="material-icons">assessment</i>
                        <p>
                            Skripsi
                        </p>
                    </a>
                </li>
                <li class="nav-item has-menu">
                    <a class="nav-link" href="?mod=bahan_kuliah_dosen">
                        <i class="material-icons">work</i>
                        <p>
                            Bahan Kuliah dan Tugas
                        </p>
                    </a>
                </li> -->
                
            </ul>
        </div>
    </div>
    <!--End Sidebar-->
<?php
}
elseif ($_SESSION["level"] == 'mhs'){
?>
                <li class="nav-item has-sub-menu">
                    <a class="nav-link" data-toggle="collapse" href="#pvr_applications">
                        <i class="material-icons">ac_unit</i>
                        <p>
                            Data Akademik
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse sub-menu" id="pvr_applications">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=krs">
                                    <i class="fa fa-cubes"></i>
                                    <span class="sidebar-normal">KRS Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=nilai">
                                    <i class="fa fa-crosshairs"></i>
                                    <span class="sidebar-normal">Nilai Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub_link" href="?mod=khs">
                                    <i class="fa fa-file-text"></i>
                                    <span class="sidebar-normal">KHS Mahasiswa</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item has-menu">
                    <a class="nav-link" href="?mod=transkrip_nilai">
                        <i class="material-icons">layers</i>
                        <p>
                            Transkrip Nilai
                        </p>
                    </a>
                </li>
                <li class="nav-item has-menu"> 
                    <a class="nav-link" href="?mod=profil_mahasiswa">
                        <i class="material-icons">child_care</i>
                        <p>
                            Data Diri Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-item has-menu"> 
                    <a class="nav-link" href="?mod=biaya_mhs">
                        <i class="material-icons">payment</i>
                        <p>
                            Biaya Kuliah
                        </p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
<?php
}
?>