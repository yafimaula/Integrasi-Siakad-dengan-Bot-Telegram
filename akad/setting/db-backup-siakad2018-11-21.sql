
/*---------------------------------------------------------------
  SQL DB BACKUP 21.11.2018 18:15 
  HOST: localhost
  DATABASE: dbakad
  TABLES: *
  ---------------------------------------------------------------*/

/*---------------------------------------------------------------
  TABLE: `absensi_mhs`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `absensi_mhs`;
CREATE TABLE `absensi_mhs` (
  `absensi_id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_id` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `paraf` char(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`absensi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2661 DEFAULT CHARSET=latin1;
INSERT INTO `absensi_mhs` VALUES   ('2595','25','101','2018-11-06','H','2018-11-06 03:38:25','2018110015','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2596','25','101','2018-11-12','H','2018-11-06 03:46:59','2018110015','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2597','25','101','2018-11-24','H','2018-11-06 03:47:15','2018110015','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2598','26','101','2018-11-07','H','2018-11-07 03:43:35','2018110016','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2599','26','101','2018-11-08','H','2018-11-07 03:44:46','2018110016','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2600','26','101','2018-11-09','H','2018-11-07 03:46:01','2018110016','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2601','27','101','2018-11-07','H','2018-11-07 03:54:05','2018110017','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2602','27','101','2018-11-08','H','2018-11-07 03:54:25','2018110017','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2603','27','101','2018-11-09','H','2018-11-07 04:05:46','2018110017','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2604','28','101','2018-11-07','H','2018-11-07 04:13:21','2018110018','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2605','28','101','2018-11-08','H','2018-11-07 04:14:30','2018110018','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2606','28','101','2018-11-09','H','2018-11-07 04:20:27','2018110018','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2607','29','101','2018-11-07','H','2018-11-07 04:26:55','2018110019','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2608','29','101','2018-11-08','H','2018-11-07 04:27:50','2018110019','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2609','29','101','2018-11-09','H','2018-11-07 04:28:47','2018110019','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2610','30','101','2018-11-07','H','2018-11-07 04:38:48','2018110020','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2611','30','101','2018-11-08','H','2018-11-07 04:39:08','2018110020','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2612','30','101','2018-11-09','H','2018-11-07 04:39:36','2018110020','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2613','31','101','2018-11-07','H','2018-11-07 04:41:42','2018110021','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2614','31','101','2018-11-08','H','2018-11-07 04:41:58','2018110021','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2615','31','101','2018-11-09','H','2018-11-07 04:42:13','2018110021','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2616','32','101','2018-11-07','H','2018-11-07 04:45:54','2018110022','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2617','32','101','2018-11-08','H','2018-11-07 04:46:14','2018110022','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2618','32','101','2018-11-09','H','2018-11-07 04:46:33','2018110022','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2619','33','101','2018-11-12','H','2018-11-12 10:33:59','2018110019','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2620','33','101','2018-11-13','H','2018-11-12 10:36:17','2018110019','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2621','33','101','2018-11-14','H','2018-11-12 10:36:46','2018110019','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2622','35','101','2018-11-12','H','2018-11-12 10:49:19','2018110024','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2623','35','101','2018-11-13','H','2018-11-12 10:49:56','2018110024','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2624','35','101','2018-11-14','H','2018-11-12 10:50:40','2018110024','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2625','34','101','2018-11-12','H','2018-11-12 11:04:30','2018110023','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2626','34','101','2018-11-13','H','2018-11-12 11:04:48','2018110023','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2627','34','101','2018-11-14','H','2018-11-12 11:05:36','2018110023','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2628','37','101','2018-11-12','H','2018-11-12 11:13:12','2018110025','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2629','37','101','2018-11-13','H','2018-11-12 11:13:41','2018110025','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2630','37','101','2018-11-14','H','2018-11-12 11:13:58','2018110025','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2631','38','101','2018-11-12','H','2018-11-12 11:21:05','2018110026','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2632','38','101','2018-11-13','H','2018-11-12 11:22:11','2018110026','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2633','38','101','2018-11-14','H','2018-11-12 11:22:28','2018110026','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2634','39','101','2018-11-12','H','2018-11-12 11:27:22','2018110016','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2635','39','101','2018-11-13','H','2018-11-12 11:27:38','2018110016','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2636','39','101','2018-11-14','H','2018-11-12 11:28:31','2018110016','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2637','40','101','2018-11-12','H','2018-11-12 12:35:45','2018110028','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2638','40','101','2018-11-13','H','2018-11-12 12:36:12','2018110028','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2639','40','101','2018-11-14','H','2018-11-12 12:36:31','2018110028','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2640','40','101','2018-11-15','H','2018-11-12 12:38:37','2018110028','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2641','42','101','2018-11-15','H','2018-11-15 11:53:12','2018110029','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2642','42','102','2018-11-15','H','2018-11-15 11:53:12','2018110029','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2643','42','101','2018-11-16','H','2018-11-15 11:53:34','2018110029','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2644','42','102','2018-11-16','H','2018-11-15 11:53:34','2018110029','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2645','42','101','2018-11-17','H','2018-11-15 11:55:50','2018110029','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2646','42','102','2018-11-17','H','2018-11-15 11:55:50','2018110029','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2647','43','101','2018-11-15','H','2018-11-15 12:08:46','2018110030','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2648','43','102','2018-11-15','H','2018-11-15 12:08:46','2018110030','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2649','44','101','2018-11-15','H','2018-11-15 12:11:47','2018110031','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2650','44','102','2018-11-15','H','2018-11-15 12:11:47','2018110031','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2651','45','101','2018-11-15','H','2018-11-15 12:14:44','2018110023','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2652','45','102','2018-11-15','H','2018-11-15 12:14:44','2018110023','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2653','41','101','2018-11-15','H','2018-11-15 12:16:18','2018110032','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2654','41','102','2018-11-15','H','2018-11-15 12:16:18','2018110032','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2655','46','101','2018-11-15','H','2018-11-15 12:18:07','2018110033','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2656','46','102','2018-11-15','H','2018-11-15 12:18:07','2018110033','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2657','47','101','2018-11-15','H','2018-11-15 12:21:25','2018110034','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2658','47','102','2018-11-15','H','2018-11-15 12:21:25','2018110034','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2659','48','101','2018-11-15','H','2018-11-15 12:28:32','2018110035','0000-00-00 00:00:00','0');
INSERT INTO `absensi_mhs` VALUES ('2660','48','102','2018-11-15','H','2018-11-15 12:28:32','2018110035','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `akun_biaya`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `akun_biaya`;
CREATE TABLE `akun_biaya` (
  `akun_id` int(11) NOT NULL AUTO_INCREMENT,
  `mst_biaya_id` int(11) NOT NULL,
  `nama_biaya` varchar(30) NOT NULL,
  `biaya` int(11) NOT NULL,
  `program` char(1) NOT NULL,
  `semester` int(11) NOT NULL,
  `aktif` char(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`akun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
INSERT INTO `akun_biaya` VALUES   ('1','1','SPP','4500000','A','1','A','2013-11-13 03:09:54','3','2013-11-28 19:14:45','3');
INSERT INTO `akun_biaya` VALUES ('2','2','Uang Gedung','4500000','A','1','N','2013-11-14 03:50:56','3','0000-00-00 00:00:00','0');
INSERT INTO `akun_biaya` VALUES ('3','2','SPP','4500000','A','1','N','2013-11-14 03:50:57','3','2013-11-18 03:25:24','3');
INSERT INTO `akun_biaya` VALUES ('5','2','Uang Praktek','4500000','A','1','A','2013-11-18 00:03:08','3','2013-11-18 00:10:11','3');
INSERT INTO `akun_biaya` VALUES ('6','3','SPP','3000000','A','1','A','2013-11-28 19:07:11','3','2013-11-28 19:07:47','3');
INSERT INTO `akun_biaya` VALUES ('7','3','Uang Praktek','3000000','A','2','N','2013-11-28 19:07:39','3','0000-00-00 00:00:00','0');
INSERT INTO `akun_biaya` VALUES ('11','5','SPP 1','2887500','A','1','A','2018-11-02 12:52:58','1','0000-00-00 00:00:00','0');
INSERT INTO `akun_biaya` VALUES ('12','5','Daftar Ulang','1000000','A','1','N','2018-11-03 03:33:50','1','2018-11-16 13:06:49','1');
INSERT INTO `akun_biaya` VALUES ('16','5','SPP','2887500','A','2','A','2018-11-16 13:04:51','1','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `angkatan`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `angkatan`;
CREATE TABLE `angkatan` (
  `angkatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_angkatan` varchar(20) NOT NULL,
  `semester_angkatan` char(1) NOT NULL,
  `status` char(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`angkatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
INSERT INTO `angkatan` VALUES   ('3','2015','1','A','2013-08-26 00:32:29','1','2018-11-19 12:33:56','1');
INSERT INTO `angkatan` VALUES ('4','2015','2','A','2013-11-27 17:23:18','3','2018-11-19 12:34:05','1');
INSERT INTO `angkatan` VALUES ('5','2018','1','N','2018-10-03 13:15:14','1','2018-11-02 12:38:34','1');
INSERT INTO `angkatan` VALUES ('8','2016','1','A','2018-11-02 11:19:14','1','2018-11-19 13:11:41','1');
INSERT INTO `angkatan` VALUES ('9','2016','2','A','2018-11-02 11:19:27','1','2018-11-18 04:27:59','1');
INSERT INTO `angkatan` VALUES ('10','2017','1','N','2018-11-02 11:20:44','1','0000-00-00 00:00:00','0');
INSERT INTO `angkatan` VALUES ('11','2017','2','N','2018-11-02 11:20:58','1','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `biaya_kuliah`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `biaya_kuliah`;
CREATE TABLE `biaya_kuliah` (
  `biaya_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mhs` int(11) NOT NULL,
  `mst_biaya_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `biaya` varchar(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`biaya_id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;
INSERT INTO `biaya_kuliah` VALUES   ('102','101','5','11','1000000','Cicil SPP','2018-11-03 04:53:35','1','0000-00-00 00:00:00','0');
INSERT INTO `biaya_kuliah` VALUES ('103','101','5','11','2000000','Cicil SPP','2018-11-03 05:06:58','1','0000-00-00 00:00:00','0');
INSERT INTO `biaya_kuliah` VALUES ('104','101','5','11','887500','Cicil SPP','2018-11-11 05:37:59','1','0000-00-00 00:00:00','0');
INSERT INTO `biaya_kuliah` VALUES ('105','101','6','13','1000000','SPP 2','2018-11-11 05:38:36','1','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `daftar_temp`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `daftar_temp`;
CREATE TABLE `daftar_temp` (
  `id_telegram` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `daftar_temp` VALUES   ('1','2','');

/*---------------------------------------------------------------
  TABLE: `dosen`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `dosen_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Dosen',
  `nidn` varchar(10) NOT NULL COMMENT 'Nomor Dosen (NIDN)',
  `nama_dosen` varchar(30) NOT NULL COMMENT 'Nama Dosen',
  `gelar` varchar(20) NOT NULL COMMENT 'Gelar Akademik/Profesional tertinggi',
  `tempat_lahir` varchar(20) NOT NULL COMMENT 'Tempat Lahir',
  `tanggal_lahir` varchar(12) NOT NULL COMMENT 'Tanggal Lahir',
  `jk` varchar(1) NOT NULL COMMENT 'Kode Jenis Kelamin',
  `jabatan_id` varchar(1) NOT NULL COMMENT 'Kode Jabatan Akademik',
  `pendidikan_id` varchar(1) NOT NULL COMMENT 'Kode Pendidikan tertinggi',
  `ikatan_kerja_id` varchar(1) NOT NULL COMMENT 'Kode Status Ikatan Kerja Dosen di PTS',
  `status` varchar(1) NOT NULL COMMENT 'Kode Status Aktivitas Dosen',
  `mulai_masuk_dosen` date NOT NULL COMMENT 'Mulai Aktif menjadi dosen',
  `akta_dan_ijin_mengajar` varchar(1) NOT NULL COMMENT 'Akta dan Ijin mengajar Dosen',
  `alamat` text NOT NULL COMMENT 'Alamat Dosen',
  `no_hp` varchar(20) NOT NULL COMMENT 'Handphone',
  `email` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`dosen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
INSERT INTO `dosen` VALUES   ('17','2018110015','Zainal Muttaqin','S.Kom, M.IKom','','','L','A','B','','A','0000-00-00','','','','zainalmuttaqin@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-06 04:24:41','::1','2018-11-02 12:09:04','1','2018-11-02 12:31:09','1');
INSERT INTO `dosen` VALUES ('18','2018110016','Teguh Priyo Utomo','S.Kom, M.IKom','','','L','A','B','','A','0000-00-00','','','','teguhpriyo@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-12 11:24:49','::1','2018-11-02 12:11:33','1','2018-11-02 12:20:01','1');
INSERT INTO `dosen` VALUES ('19','2018110017','Achmad Fanani','SS, M.Pd','','','L','','B','','A','0000-00-00','','','','achmadfanani@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-07 03:51:03','::1','2018-11-02 12:12:42','1','2018-11-07 03:50:50','1');
INSERT INTO `dosen` VALUES ('20','2018110018','Ana Rahmawati','M.Pd','','','P','','B','','A','0000-00-00','','','','anarahmawati@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-07 04:12:55','::1','2018-11-02 12:13:30','1','2018-11-02 12:20:44','1');
INSERT INTO `dosen` VALUES ('21','2018110019','Erliyah Nurul Jannah','S.Kom, M.Sc','','','P','','B','','A','0000-00-00','','','','erliyah.jannah@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-12 10:33:08','::1','2018-11-02 12:15:05','1','2018-11-02 12:21:27','1');
INSERT INTO `dosen` VALUES ('22','2018110020','Sujarwo','ST, M.Si','','','L','','B','','A','0000-00-00','','','','sujarwo@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-07 04:56:26','::1','2018-11-02 12:15:45','1','2018-11-02 12:21:58','1');
INSERT INTO `dosen` VALUES ('23','2018110021','Lilik Maftuhatin','M.PdI','','','P','','B','','A','0000-00-00','','','','lilikmaftuhatin@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-07 04:41:24','::1','2018-11-02 12:17:18','1','2018-11-02 12:19:05','1');
INSERT INTO `dosen` VALUES ('24','2018110022','Abdullah Rikza','S.Ip, M.Pd.I','','','L','A','B','','A','0000-00-00','','','','abdullahrikza@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-07 04:44:32','::1','2018-11-02 12:18:45','1','0000-00-00 00:00:00','0');
INSERT INTO `dosen` VALUES ('25','2018110023','Nufan Balafif','S.Kom, M.M.','','','L','A','B','','A','0000-00-00','','','','nufanbalafif@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-15 12:14:18','::1','2018-11-11 04:42:12','1','0000-00-00 00:00:00','0');
INSERT INTO `dosen` VALUES ('26','2018110024','Fachruddin','M.Pd','','','L','A','B','','A','0000-00-00','','','','fachruddin@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-12 10:48:28','::1','2018-11-11 04:42:42','1','2018-11-11 04:43:10','1');
INSERT INTO `dosen` VALUES ('27','2018110025','Ulumul Umah','M.Pd','','','P','A','B','','A','0000-00-00','','','','ulumulumah@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-12 11:11:56','::1','2018-11-11 04:43:59','1','0000-00-00 00:00:00','0');
INSERT INTO `dosen` VALUES ('28','2018110026','Eddy Kurniawan','S.Kom, M.M','','','L','A','B','','A','0000-00-00','','','','eddykurniawan@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-12 11:20:49','::1','2018-11-11 04:45:39','1','0000-00-00 00:00:00','0');
INSERT INTO `dosen` VALUES ('30','2018110028','Mukhlisin','M.Pd.i','','','L','','','','A','0000-00-00','','','','mukhlisin@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-12 12:35:20','::1','2018-11-11 04:47:59','1','2018-11-11 05:07:41','1');
INSERT INTO `dosen` VALUES ('31','2018110029','Ahmad Heru Mujianto','S.Kom, M.M.','','','L','A','B','','A','0000-00-00','','','','ahmadheru@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-15 12:10:22','::1','2018-11-11 04:51:48','1','2018-11-11 04:53:51','1');
INSERT INTO `dosen` VALUES ('32','2018110030','Mukhammad Masrur','S.Kom, M.Kom','','','L','A','B','','A','0000-00-00','','','','mukhammadmasrur@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-15 12:05:24','::1','2018-11-15 04:02:20','1','2018-11-20 13:54:31','1');
INSERT INTO `dosen` VALUES ('33','2018110031','Sulung Rahmawan Wiragani','ST, MT','','','L','A','','','A','0000-00-00','','','','sulungwiragani@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-15 12:11:29','::1','2018-11-15 04:03:11','1','0000-00-00 00:00:00','0');
INSERT INTO `dosen` VALUES ('34','2018110032','Mas\'ud','S.Si, S.T, M.MT','','','L','A','B','','A','0000-00-00','','','','masud@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-15 12:15:47','::1','2018-11-15 04:03:52','1','2018-11-20 13:54:13','1');
INSERT INTO `dosen` VALUES ('35','2018110033','Wiwit Denny Fitrianan','S.Si., M.Si','','','P','A','B','','A','0000-00-00','','','','wiwitdenny@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-15 12:17:37','::1','2018-11-15 04:04:46','1','0000-00-00 00:00:00','0');
INSERT INTO `dosen` VALUES ('36','2018110034','Imam Mutaqin','M.PdI','','','L','A','B','','A','0000-00-00','','','','imammutaqin@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-15 12:19:32','::1','2018-11-15 04:05:36','1','0000-00-00 00:00:00','0');
INSERT INTO `dosen` VALUES ('37','2018110035','Sumargono','Ir. Drs. M.Pd','','','L','A','','','A','0000-00-00','','','','sumargono@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','2018-11-15 12:26:17','::1','2018-11-15 04:06:15','1','0000-00-00 00:00:00','0');
INSERT INTO `dosen` VALUES ('38','2018110036','Suprapti','M.Pd.I','','','P','A','B','','A','0000-00-00','','','','suprapti@unipdu.ac.id','e10adc3949ba59abbe56e057f20f883e','dosen_','0000-00-00 00:00:00','','2018-11-20 14:08:24','1','2018-11-20 14:09:24','1');

/*---------------------------------------------------------------
  TABLE: `fakultas`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE `fakultas` (
  `fakultas_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Fakultas',
  `nama_fak` varchar(50) NOT NULL COMMENT 'Nama Fakultas',
  `ketua` varchar(50) NOT NULL,
  `no_izin` varchar(30) NOT NULL,
  `status` char(1) NOT NULL COMMENT 'Status Fakultas',
  `created_userid` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`fakultas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `fakultas` VALUES   ('3','Sains dan Teknologi','Mukhamad Masrur S.Kom, M.Kom','-','A','1','2018-10-04 05:57:39','1','2018-11-20 04:57:47');

/*---------------------------------------------------------------
  TABLE: `jadwal_kuliah`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `jadwal_kuliah`;
CREATE TABLE `jadwal_kuliah` (
  `jadwal_id` int(11) NOT NULL AUTO_INCREMENT,
  `makul_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `hari` char(10) NOT NULL,
  `jam_mulai` char(10) NOT NULL,
  `jam_selesai` char(10) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `ruang_id` int(11) NOT NULL,
  `program` char(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`jadwal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
INSERT INTO `jadwal_kuliah` VALUES   ('6','13','7','1','1','18.30','20.30','12','7','A','2013-08-26 02:47:24','1','2013-08-26 02:59:59','1');
INSERT INTO `jadwal_kuliah` VALUES ('7','12','7','1','2','18.30','20.30','5','7','A','2013-08-26 03:02:43','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('8','15','7','1','3','18.30','20.30','14','7','A','2013-08-26 03:08:55','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('9','11','7','1','4','18.30','20.30','8','7','A','2013-08-26 03:10:38','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('10','7','7','1','5','18.30','20.30','9','7','A','2013-08-26 03:11:06','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('11','3','8','1','1','18.30','20.30','3','9','A','2013-08-26 03:15:41','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('12','16','8','1','2','18.30','20.30','11','9','A','2013-08-26 03:16:17','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('13','4','8','1','3','18.30','20.30','13','9','A','2013-08-26 03:17:18','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('14','5','8','1','4','18.30','20.30','10','9','A','2013-08-26 03:18:32','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('15','6','8','1','5','18.30','20.30','4','9','A','2013-08-26 03:19:07','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('16','16','9','1','1','19.00','21.00','11','9','A','2013-09-17 03:42:37','3','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('17','4','9','1','2','19.00','21.00','13','9','A','2013-09-17 03:43:21','3','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('18','5','9','1','3','19.00','21.00','10','9','A','2013-09-17 03:44:30','3','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('19','6','9','1','4','19.002','21.00','15','9','A','2013-09-17 05:37:16','3','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('20','3','9','1','5','19.00','21.00','6','9','A','2013-09-17 05:37:58','3','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('23','22','10','1','1','11:11','14:00','15','6','A','2018-10-09 04:29:26','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('24','23','11','1','6','12:12','15:06','15','10','A','2018-10-09 04:30:00','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('25','24','13','1','7','12:30','13:59','17','11','A','2018-11-02 12:40:00','1','2018-11-19 12:41:16','1');
INSERT INTO `jadwal_kuliah` VALUES ('26','25','13','1','7','11:00','12:29','18','11','A','2018-11-02 12:42:21','1','2018-11-19 12:37:11','1');
INSERT INTO `jadwal_kuliah` VALUES ('27','26','13','1','1','08:00','09:30','19','11','A','2018-11-02 12:43:58','1','2018-11-19 12:41:46','1');
INSERT INTO `jadwal_kuliah` VALUES ('28','27','13','1','1','11:00','13:14','20','11','A','2018-11-02 12:44:55','1','2018-11-19 12:42:21','1');
INSERT INTO `jadwal_kuliah` VALUES ('29','28','13','1','2','10:15','12:29','21','18','A','2018-11-02 12:45:35','1','2018-11-19 12:45:43','1');
INSERT INTO `jadwal_kuliah` VALUES ('30','29','13','1','2','11:00','12:30','22','11','A','2018-11-02 12:46:45','1','2018-11-19 12:46:41','1');
INSERT INTO `jadwal_kuliah` VALUES ('31','30','13','1','4','10:20','','23','11','A','2018-11-02 12:48:38','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('32','31','13','1','4','09:30','10:59','24','11','A','2018-11-02 12:49:41','1','2018-11-19 12:46:15','1');
INSERT INTO `jadwal_kuliah` VALUES ('33','32','14','2','6','08:00','10:59','21','19','A','2018-11-11 05:11:54','1','2018-11-19 13:03:35','1');
INSERT INTO `jadwal_kuliah` VALUES ('34','33','14','2','6','11:00','13:59','25','20','A','2018-11-11 05:16:04','1','2018-11-19 13:04:08','1');
INSERT INTO `jadwal_kuliah` VALUES ('35','34','14','2','7','09:30','10:59','26','11','A','2018-11-11 05:18:14','1','2018-11-19 12:52:23','1');
INSERT INTO `jadwal_kuliah` VALUES ('37','35','14','2','2','10:15','12:29','27','11','A','2018-11-11 05:20:24','1','2018-11-19 12:58:01','1');
INSERT INTO `jadwal_kuliah` VALUES ('38','36','14','2','2','08:00','10:14','28','18','A','2018-11-11 05:21:23','1','2018-11-19 12:53:27','1');
INSERT INTO `jadwal_kuliah` VALUES ('39','37','14','2','4','23:00','12:29','18','15','A','2018-11-11 05:22:12','1','2018-11-19 13:00:18','1');
INSERT INTO `jadwal_kuliah` VALUES ('40','38','14','2','4','09:30','10:59','30','15','A','2018-11-11 05:23:09','1','2018-11-19 12:59:48','1');
INSERT INTO `jadwal_kuliah` VALUES ('41','43','16','4','2','10:00','','34','17','A','2018-11-15 04:15:29','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('42','39','15','3','6','12:00','','31','11','A','2018-11-15 04:16:43','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('43','40','15','3','7','10:00','','32','16','A','2018-11-15 04:17:22','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('44','41','15','3','7','20:00','','33','16','A','2018-11-15 04:18:33','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('45','42','15','3','1','12:00','','25','15','A','2018-11-15 04:19:36','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('46','44','15','3','3','12:00','','35','14','A','2018-11-15 04:27:20','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('47','45','15','3','4','10:00','','36','11','A','2018-11-15 04:32:07','1','0000-00-00 00:00:00','0');
INSERT INTO `jadwal_kuliah` VALUES ('48','46','15','3','4','08:00','','37','11','A','2018-11-15 04:33:36','1','2018-11-21 04:38:56','1');

/*---------------------------------------------------------------
  TABLE: `kelas`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `kelas_id` int(11) NOT NULL AUTO_INCREMENT,
  `prodi_id` int(11) NOT NULL,
  `angkatan_id` int(11) NOT NULL,
  `nama_kelas` varchar(40) NOT NULL,
  `daya_tampung` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `semester_kelas` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`kelas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
INSERT INTO `kelas` VALUES   ('13','4','3','D','25','A','1','2018-11-02 12:27:52','1','0000-00-00 00:00:00','0');
INSERT INTO `kelas` VALUES ('14','4','4','D','30','A','2','2018-11-11 04:39:19','1','0000-00-00 00:00:00','0');
INSERT INTO `kelas` VALUES ('15','4','8','D','30','A','3','2018-11-15 03:59:29','1','0000-00-00 00:00:00','0');
INSERT INTO `kelas` VALUES ('16','4','8','C','30','A','4','2018-11-15 03:59:49','1','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `krs`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `krs`;
CREATE TABLE `krs` (
  `krs_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mhs` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL DEFAULT '3',
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`krs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=500 DEFAULT CHARSET=latin1;
INSERT INTO `krs` VALUES   ('453','101','25','2018-11-04 12:57:41','0','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('454','101','26','2018-11-05 03:13:17','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('455','101','27','2018-11-05 03:15:02','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('456','101','28','2018-11-05 03:15:02','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('457','101','29','2018-11-05 03:15:02','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('458','101','30','2018-11-05 03:15:02','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('459','101','31','2018-11-05 03:15:02','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('460','101','32','2018-11-05 03:15:02','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('472','101','34','2018-11-11 11:03:43','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('473','101','35','2018-11-11 11:05:58','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('474','101','40','2018-11-11 11:05:58','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('475','101','37','2018-11-11 11:06:53','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('476','101','38','2018-11-11 11:06:53','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('477','101','39','2018-11-11 11:06:53','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('478','101','33','2018-11-11 11:09:44','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('479','102','41','2018-11-15 11:43:33','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('480','102','42','2018-11-15 11:43:33','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('481','102','43','2018-11-15 11:43:33','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('482','102','44','2018-11-15 11:43:33','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('483','102','45','2018-11-15 11:43:33','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('484','102','46','2018-11-15 11:43:33','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('485','102','47','2018-11-15 11:43:33','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('486','102','48','2018-11-15 11:43:33','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('487','101','41','2018-11-15 11:51:04','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('488','101','42','2018-11-15 11:51:04','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('489','101','43','2018-11-15 11:51:04','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('490','101','44','2018-11-15 11:51:04','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('491','101','45','2018-11-15 11:51:04','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('492','101','46','2018-11-15 11:51:04','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('493','101','47','2018-11-15 11:51:04','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('494','101','48','2018-11-15 11:51:04','101','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('495','102','40','2018-11-17 13:49:25','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('496','102','25','2018-11-18 04:00:51','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('497','102','33','2018-11-18 04:00:51','102','0000-00-00 00:00:00','0');
INSERT INTO `krs` VALUES ('499','102','34','2018-11-18 04:26:38','102','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `mahasiswa`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id_mhs` int(11) NOT NULL AUTO_INCREMENT,
  `id_telegram` int(11) NOT NULL,
  `kode_program_studi` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL COMMENT 'Nim Mahasiswa dari PT',
  `nama_mahasiswa` varchar(30) NOT NULL COMMENT 'Nama Mahasiswa',
  `tempat_lahir` varchar(20) NOT NULL COMMENT 'Tempat Lahir',
  `tanggal_lahir` date NOT NULL COMMENT 'Tanggal Lahir',
  `jenis_kelamin` char(1) NOT NULL COMMENT 'Jenis Kelamin',
  `angkatan_id` int(11) NOT NULL,
  `program` char(1) NOT NULL COMMENT 'Kelas Mahasiswa',
  `email` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL COMMENT 'Alamat',
  `hp` varchar(20) NOT NULL,
  `agama` char(1) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `status_mahasiswa` char(1) NOT NULL COMMENT 'Status Mahasiswa',
  `status_awal_mahasiswa` char(1) NOT NULL,
  `tahun_masuk` char(4) NOT NULL COMMENT 'Tahun Masuk Mahasiswa',
  `tanggal_masuk` date NOT NULL COMMENT 'Tanggal Masuk',
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `no_hp_ortu` varchar(15) NOT NULL,
  `pekerjaan_ayah` char(1) NOT NULL,
  `pekerjaan_ibu` char(1) NOT NULL,
  `penghasilan_ayah` char(1) NOT NULL,
  `penghasilan_ibu` char(1) NOT NULL,
  `sekolah_nama` varchar(50) NOT NULL,
  `sekolah_telp` varchar(15) NOT NULL,
  `sekolah_alamat` varchar(100) NOT NULL,
  `sekolah_jurusan` varchar(50) NOT NULL,
  `sekolah_tahun_lulus` varchar(4) NOT NULL,
  `kode_biaya_studi` char(1) NOT NULL,
  `password` varchar(32) NOT NULL,
  `last_login` varchar(20) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`id_mhs`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
INSERT INTO `mahasiswa` VALUES   ('101','0','4','4115095','Yafi Maula','Jombang','1998-04-05','P','3','R','yafimaula@gmail.com','Gereh, Janti, Jogoroto, Jombang','081357137981','I','mahasiswa_','A','','','2015-01-01','Agus Purnomo','Erwin Nur F','085790535020','G','X','E','A','MAN REJOSO','1233565','PP DARUL ULUM REJOSO PETERONGAN JOMBANG','IPA','2015','','e10adc3949ba59abbe56e057f20f883e','2018-11-19 12:19:34','::1','2018-10-09 06:51:32','1','2018-11-16 12:24:17','0');
INSERT INTO `mahasiswa` VALUES ('102','0','4','4115092','Achmad Miftakhul Ilmi','Jombang','1997-09-06','L','3','R','cem25mip@gmail.com','Jombang','081357137981','I','mahasiswa_','A','R','','0000-00-00','','','','X','X','A','A','','','','','','','e10adc3949ba59abbe56e057f20f883e','2018-11-18 03:58:40','::1','2018-11-15 03:37:37','1','2018-11-16 12:52:10','0');

/*---------------------------------------------------------------
  TABLE: `makul`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `makul`;
CREATE TABLE `makul` (
  `mata_kuliah_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mata_kuliah` varchar(10) NOT NULL,
  `prodi_id` int(1) NOT NULL,
  `nama_mata_kuliah` varchar(40) NOT NULL,
  `jenis_mata_kuliah` char(1) NOT NULL,
  `sks` int(11) NOT NULL,
  `status_mata_kuliah` char(1) NOT NULL,
  `nidn` char(40) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`mata_kuliah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
INSERT INTO `makul` VALUES   ('24','MK0020','4','Filsafat Ilmu','B','2','A','17','2018-11-02 12:31:28','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('25','MK0021','4','Pengantar Sistem Informasi','B','2','A','18','2018-11-02 12:32:14','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('26','MK0022','4','Bahasa Inggris','B','2','A','19','2018-11-02 12:32:49','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('27','MK0023','4','Matematika Diskrit','B','3','A','20','2018-11-02 12:34:18','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('28','MK0024','4','Algoritma & Pemrograman 1','B','4','A','21','2018-11-02 12:34:56','1','2018-11-07 05:19:09','1');
INSERT INTO `makul` VALUES ('29','MK0025','4','Pendidikan Pancasila','A','2','A','22','2018-11-02 12:35:40','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('30','MK0026','4','Pendidikan Agama Islam','A','2','A','23','2018-11-02 12:36:21','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('31','MK0027','4','Pendidikan Kewarganegaraan','A','2','A','24','2018-11-02 12:36:56','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('32','MK0028','4','Algoritma & Pemrograman 2','B','4','A','21','2018-11-11 04:55:14','1','2018-11-21 04:31:28','1');
INSERT INTO `makul` VALUES ('33','MK0029','4','Manajemen Basis Data','B','4','A','25','2018-11-11 05:03:43','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('34','MK0030','4','Bahasa Inggris Terapan','B','2','A','26','2018-11-11 05:05:04','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('35','MK0031','4','Kalkulus dan Aljabar Linear','B','3','A','27','2018-11-11 05:05:47','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('36','MK0032','4','Sistem Operasi','B','3','A','28','2018-11-11 05:06:16','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('37','MK0033','4','Komunikasi Interpersonal','B','2','A','18','2018-11-11 05:06:52','1','2018-11-12 11:27:05','1');
INSERT INTO `makul` VALUES ('38','MK0034','4','Studi Keislaman 2','B','2','A','30','2018-11-11 05:07:16','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('39','MK0035','4','Rekayasa Perangkat Lunak','B','3','A','31','2018-11-15 04:07:55','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('40','MK0036','4','Analisis dan Desain Sistem','B','3','A','32','2018-11-15 04:08:30','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('41','MK0037','4','Sistem Fungsional Bisnis','B','3','A','33','2018-11-15 04:09:14','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('42','MK0038','4','Pemrograman Web 1','B','4','A','25','2018-11-15 04:09:46','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('43','MK0039','4','Manajemen Sains','B','3','A','34','2018-11-15 04:11:05','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('44','MK0040','4','Statistika Komputasional','B','3','A','35','2018-11-15 04:11:42','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('45','MK0041','4','Studi Keislaman 3','B','2','A','36','2018-11-15 04:12:17','1','0000-00-00 00:00:00','0');
INSERT INTO `makul` VALUES ('46','MK0042','4','Bahasa Indonesia','A','2','A','37','2018-11-15 04:13:09','1','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `mst_biaya`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `mst_biaya`;
CREATE TABLE `mst_biaya` (
  `mst_biaya_id` int(11) NOT NULL AUTO_INCREMENT,
  `prodi_id` int(11) NOT NULL,
  `angkatan_id` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`mst_biaya_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
INSERT INTO `mst_biaya` VALUES   ('5','4','3','Biaya Kuliah Tahun 2015-Ganjil','2018-11-02 12:52:08','1','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `nilai_semester_mhs`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `nilai_semester_mhs`;
CREATE TABLE `nilai_semester_mhs` (
  `nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mhs` int(11) NOT NULL,
  `makul_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `semester_nilai` int(11) NOT NULL,
  `absensi` int(11) NOT NULL,
  `tugas` int(11) NOT NULL,
  `uts` int(11) NOT NULL,
  `uas` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`nilai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;
INSERT INTO `nilai_semester_mhs` VALUES   ('129','101','24','13','1','10','92','96','89','89','2018-11-06 05:40:01','2018110015','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('130','101','25','13','1','10','60','95','90','77','2018-11-07 03:47:25','2018110016','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('131','101','26','13','1','10','85','95','95','88','2018-11-07 04:07:57','2018110017','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('132','101','27','13','1','10','97','100','100','99','2018-11-07 04:25:24','2018110018','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('134','101','29','13','1','10','90','95','95','94','2018-11-07 04:40:04','2018110020','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('135','101','30','13','1','10','80','95','90','88','2018-11-07 04:42:45','2018110021','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('136','101','31','13','1','10','80','75','85','83','2018-11-07 04:47:41','2018110022','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('137','101','28','13','1','20','100','97','77','90','2018-11-07 05:16:49','2018110019','2018-11-07 05:35:50','2018110019');
INSERT INTO `nilai_semester_mhs` VALUES ('138','101','32','14','2','20','85','93','95','94','2018-11-12 10:39:58','2018110019','2018-11-12 10:44:00','2018110019');
INSERT INTO `nilai_semester_mhs` VALUES ('139','101','34','14','2','20','88','97','98','97','2018-11-12 10:52:17','2018110024','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('140','101','33','14','2','20','80','88','99','94','2018-11-12 11:06:23','2018110023','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('141','101','35','14','2','20','100','97','95','97','2018-11-12 11:19:31','2018110025','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('142','101','36','14','2','20','83','85','90','90','2018-11-12 11:23:43','2018110026','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('143','101','37','14','2','20','90','90','95','94','2018-11-12 11:29:05','2018110016','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('144','101','38','14','2','20','95','95','90','94','2018-11-12 12:41:19','2018110028','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('145','101','39','15','3','20','84','85','98','93','2018-11-15 12:01:08','2018110029','2018-11-15 12:10:59','2018110029');
INSERT INTO `nilai_semester_mhs` VALUES ('146','102','39','15','3','20','80','100','90','93','2018-11-15 12:01:08','2018110029','2018-11-15 12:10:59','2018110029');
INSERT INTO `nilai_semester_mhs` VALUES ('147','101','40','15','3','20','98','95','100','98','2018-11-15 12:10:02','2018110030','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('148','102','40','15','3','20','90','80','100','94','2018-11-15 12:10:02','2018110030','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('149','101','41','15','3','20','95','80','88','89','2018-11-15 12:12:41','2018110031','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('150','102','41','15','3','20','90','80','90','90','2018-11-15 12:12:41','2018110031','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('151','101','42','15','3','20','80','94','98','95','2018-11-15 12:15:29','2018110023','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('152','102','42','15','3','20','80','94','98','95','2018-11-15 12:15:29','2018110023','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('153','101','43','16','4','20','90','90','90','92','2018-11-15 12:17:09','2018110032','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('154','102','43','16','4','20','90','85','90','91','2018-11-15 12:17:09','2018110032','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('155','101','44','15','3','20','87','90','98','95','2018-11-15 12:18:56','2018110033','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('156','102','44','15','3','20','90','97','98','97','2018-11-15 12:18:56','2018110033','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('157','101','45','15','3','20','94','94','96','96','2018-11-15 12:25:12','2018110034','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('158','102','45','15','3','20','95','98','90','95','2018-11-15 12:25:12','2018110034','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('159','101','46','15','3','20','95','95','90','94','2018-11-15 12:29:49','2018110035','0000-00-00 00:00:00','0');
INSERT INTO `nilai_semester_mhs` VALUES ('160','102','46','15','3','20','95','95','95','96','2018-11-15 12:29:49','2018110035','0000-00-00 00:00:00','0');

/*---------------------------------------------------------------
  TABLE: `prodi`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `prodi`;
CREATE TABLE `prodi` (
  `prodi_id` int(11) NOT NULL AUTO_INCREMENT,
  `kaprodi` varchar(10) NOT NULL COMMENT 'NIDN Ketua Program Studi',
  `fakultas_id` int(11) NOT NULL,
  `jenjang_studi_id` varchar(1) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  `akreditasi` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  PRIMARY KEY (`prodi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `prodi` VALUES   ('4','21','3','C','Sistem Informasi','A','A','2018-10-04 06:09:50','1','2018-11-05 11:23:41','1');

/*---------------------------------------------------------------
  TABLE: `ruang`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `ruang`;
CREATE TABLE `ruang` (
  `ruang_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruang` varchar(30) NOT NULL,
  `jenis` char(1) NOT NULL,
  `aktif` char(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  `head_id` int(11) NOT NULL,
  PRIMARY KEY (`ruang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
INSERT INTO `ruang` VALUES   ('11','U-308','A','A','2018-11-02 12:22:56','1','0000-00-00 00:00:00','0','0');
INSERT INTO `ruang` VALUES ('12','U-304','A','A','2018-11-02 12:23:36','1','2018-11-19 12:45:01','1','0');
INSERT INTO `ruang` VALUES ('13','U-302','A','A','2018-11-11 04:32:52','1','2018-11-11 04:33:13','1','0');
INSERT INTO `ruang` VALUES ('14','U-306','A','A','2018-11-11 04:33:34','1','0000-00-00 00:00:00','0','0');
INSERT INTO `ruang` VALUES ('15','U-314','A','A','2018-11-11 04:35:17','1','0000-00-00 00:00:00','0','0');
INSERT INTO `ruang` VALUES ('16','U-310','A','A','2018-11-15 03:53:21','1','0000-00-00 00:00:00','0','0');
INSERT INTO `ruang` VALUES ('17','U-312','A','A','2018-11-15 03:54:56','1','0000-00-00 00:00:00','0','0');
INSERT INTO `ruang` VALUES ('18','G-304','B','A','2018-11-19 12:45:19','1','0000-00-00 00:00:00','0','0');
INSERT INTO `ruang` VALUES ('19','G-301','B','A','2018-11-19 13:00:50','1','0000-00-00 00:00:00','0','0');
INSERT INTO `ruang` VALUES ('20','G-302','B','A','2018-11-19 13:01:20','1','2018-11-20 12:35:56','1','0');

/*---------------------------------------------------------------
  TABLE: `users`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(11) NOT NULL,
  `aktif` char(1) NOT NULL,
  `blokir` char(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_userid` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_userid` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
INSERT INTO `users` VALUES   ('1','','Administrator','','','','info@unipdu.ac.id','21232f297a57a5a743894a0e4a801fc3','1','Y','N','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0','2018-11-21 11:06:48','::1');
INSERT INTO `users` VALUES ('3','20130002','Agus Saputra','Jl. Pegadaian No. 38 RT. 01 RW. 01 Arjawinangun, Cirebon','L','08562121141','agus.saputra@unipdu.ac.id','21232f297a57a5a743894a0e4a801fc3','1','Y','N','2013-08-26 00:06:27','1','2018-11-11 05:43:58','1','2018-10-28 06:26:41','::1');
INSERT INTO `users` VALUES ('5','20130015','Feni Agustin, S.Kom','Wisma Bahtera Jl. Stasiun Arjawinangun, Cirebon','P','08987300657','felicia.feni@unipdu.ac.id','21232f297a57a5a743894a0e4a801fc3','1','Y','Y','2013-11-13 00:03:08','3','2018-11-21 11:57:09','1','2013-12-30 03:59:52','::1');
