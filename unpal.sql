# Host: localhost  (Version 5.6.21)
# Date: 2019-07-11 21:30:52
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "tb_admin"
#

CREATE TABLE `tb_admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "tb_admin"
#

REPLACE INTO `tb_admin` VALUES (1,'admin_mnj','adminmnj'),(2,'admin','admin');

#
# Structure for table "tb_dosen"
#

CREATE TABLE `tb_dosen` (
  `id_dosen` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL DEFAULT '',
  `prodi_id` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `alamat` text,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=8014 DEFAULT CHARSET=latin1;

#
# Data for table "tb_dosen"
#

REPLACE INTO `tb_dosen` VALUES (1,'ayu','1','dosen','sekayu','Laki-laki','2019-07-05','palembang  ','Islam'),(8013,'udin','2','dosen_hukum','lemabang\t','Laki-laki',NULL,NULL,NULL);

#
# Structure for table "tb_jadwal"
#

CREATE TABLE `tb_jadwal` (
  `id_jadwal` int(5) NOT NULL AUTO_INCREMENT,
  `tahun` int(4) DEFAULT NULL,
  `prodi_id` int(5) DEFAULT NULL,
  `id_mk` int(5) DEFAULT NULL,
  `nip_dosen` varchar(20) DEFAULT NULL,
  `semester` int(3) DEFAULT NULL,
  `hari` varchar(10) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "tb_jadwal"
#

REPLACE INTO `tb_jadwal` VALUES (4,2019,2,4,'dosen',1,'Senin','12:59:00','20:56:00'),(5,2019,2,6,'dosen',1,'Senin','12:59:00','20:56:00'),(6,2019,2,6,'dosen',1,'Senin','12:59:00','20:56:00'),(7,2019,1,9,'dosen',0,'Senin','01:59:00','13:59:00'),(8,2019,1,9,'dosen',1,'Senin','01:00:00','13:00:00'),(9,2019,1,8,'dosen',2,'Selasa','11:00:00','01:00:00'),(10,2019,1,5,'dosen',1,'Senin','00:00:00','00:00:00'),(11,2019,1,11,'dosen',1,'Selasa','13:00:00','02:00:00'),(12,2019,2,3,'dosen_hukum',1,'Selasa','11:58:00','00:59:00');

#
# Structure for table "tb_kartustudi"
#

CREATE TABLE `tb_kartustudi` (
  `id_ks` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) DEFAULT NULL,
  `id_jadwal` int(3) DEFAULT NULL,
  `semester` int(3) DEFAULT NULL,
  `sks` int(3) DEFAULT NULL,
  `grade` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_ks`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "tb_kartustudi"
#

REPLACE INTO `tb_kartustudi` VALUES (1,'theo',4,1,3,4),(2,'theo',5,1,2,3),(4,'theo',6,1,2,NULL),(5,'theo',12,1,4,NULL);

#
# Structure for table "tb_login"
#

CREATE TABLE `tb_login` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(70) DEFAULT NULL,
  `role_id` int(3) DEFAULT NULL,
  `keterangan` int(4) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tb_login"
#

REPLACE INTO `tb_login` VALUES ('admin','e10adc3949ba59abbe56e057f20f883e','Admin',1,NULL),('dosen','e10adc3949ba59abbe56e057f20f883e','dosen',3,1),('dosen_hukum','e10adc3949ba59abbe56e057f20f883e','Andre Siap',3,2),('theo','e10adc3949ba59abbe56e057f20f883e','Theo Vhaldino',2,2);

#
# Structure for table "tb_mahasiswa"
#

CREATE TABLE `tb_mahasiswa` (
  `id_mhs` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `alamat` text,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `prodi_id` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_mhs`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "tb_mahasiswa"
#

REPLACE INTO `tb_mahasiswa` VALUES (1,'Theo Valdino','bukit besar','Laki-laki','Islam','2','palembang ','2019-07-17','theo'),(2,'Jemz Suzura',NULL,NULL,NULL,'1',NULL,NULL,'jemz123');

#
# Structure for table "tb_matakuliah"
#

CREATE TABLE `tb_matakuliah` (
  `id_mk` int(5) NOT NULL AUTO_INCREMENT,
  `kode_huruf` varchar(10) DEFAULT NULL,
  `kode_angka` int(11) DEFAULT NULL,
  `nama_mk` varchar(70) DEFAULT NULL,
  `sks` int(3) DEFAULT NULL,
  `prodi_id` int(3) DEFAULT NULL,
  `semester` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_mk`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "tb_matakuliah"
#

REPLACE INTO `tb_matakuliah` VALUES (3,'asd',123,'Jerman',4,2,1),(4,'MDA',123,'HUKUM HAKIM',3,2,1),(5,'MDA',123,'MANAJEMEN KEUANGAN',2,1,1),(6,'mxx',12312,'Hukum ASLI',2,2,2),(7,'MAC',1231,'MIKRO EKONOMI',2,1,0),(8,'QWE',1312,'MIKRO',2,1,1),(9,'ASD',231,'EKONOMI PEMBANGUNAN',2,1,1),(10,'sdf',234,'matematika',2,1,1),(11,'ar',213233,'PKN',3,1,1),(12,'MDA',12312,'SKRIPSI',3,1,2);

#
# Structure for table "tb_prodi"
#

CREATE TABLE `tb_prodi` (
  `id_prodi` int(4) NOT NULL AUTO_INCREMENT,
  `nama_prodi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_prodi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "tb_prodi"
#

REPLACE INTO `tb_prodi` VALUES (1,'Manajemen'),(2,'Hukum');
