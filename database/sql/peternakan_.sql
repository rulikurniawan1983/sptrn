# ************************************************************
# Sequel Ace SQL dump
# Version 20074
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.18-MariaDB)
# Database: diskanak_new
# Generation Time: 2024-10-09 13:12:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table peternakan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `peternakan`;

CREATE TABLE `peternakan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kbli` bigint(20) unsigned DEFAULT NULL,
  `id_jenis_usaha` bigint(20) unsigned DEFAULT NULL,
  `id_jenis_peternakan` bigint(20) unsigned DEFAULT NULL,
  `id_kecamatan` bigint(20) unsigned DEFAULT NULL,
  `id_kelurahan` bigint(20) unsigned DEFAULT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_tlp_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_tlp_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_badan_hukum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_badan_hukum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pengesahan_badan_hukum` bigint(20) unsigned DEFAULT NULL,
  `tahun_ind_usaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_notaris` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nib` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nib_tanggal_terbit` date DEFAULT NULL,
  `nib_dikeluarkan_oleh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nib_penanggungjawab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_izin_tempat_usaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_izin_tempat_usaha_tanggal_terbit` date DEFAULT NULL,
  `surat_izin_tempat_usaha_dikeluarkan_oleh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_izin_tempat_usaha_masa_berlaku` date DEFAULT NULL,
  `surat_izin_tempat_usaha_penanggungjawab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tingkat_resiko` bigint(20) unsigned DEFAULT NULL,
  `id_skala_usaha` bigint(20) unsigned DEFAULT NULL,
  `nilai_investasi` bigint(20) DEFAULT NULL,
  `id_status_permodalan` bigint(20) unsigned DEFAULT NULL,
  `luas_tanah` bigint(20) DEFAULT NULL,
  `luas_bangunan` bigint(20) DEFAULT NULL,
  `tki_pria` bigint(20) DEFAULT NULL,
  `tki_wanita` bigint(20) DEFAULT NULL,
  `tka_pria` bigint(20) DEFAULT NULL,
  `tka_wanita` bigint(20) DEFAULT NULL,
  `id_status_verifikasi` bigint(20) unsigned DEFAULT NULL,
  `catatan_verifikasi_petugas` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peternakan_id_kbli_foreign` (`id_kbli`),
  KEY `peternakan_id_jenis_usaha_foreign` (`id_jenis_usaha`),
  KEY `peternakan_id_jenis_peternakan_foreign` (`id_jenis_peternakan`),
  KEY `peternakan_id_status_verifikasi_foreign` (`id_status_verifikasi`),
  KEY `peternakan_id_pengesahan_badan_hukum_foreign` (`id_pengesahan_badan_hukum`),
  KEY `peternakan_id_tingkat_resiko_foreign` (`id_tingkat_resiko`),
  KEY `peternakan_id_skala_usaha_foreign` (`id_skala_usaha`),
  KEY `peternakan_id_status_permodalan_foreign` (`id_status_permodalan`),
  KEY `peternakan_id_kecamatan_foreign` (`id_kecamatan`),
  KEY `peternakan_id_kelurahan_foreign` (`id_kelurahan`),
  CONSTRAINT `peternakan_id_jenis_peternakan_foreign` FOREIGN KEY (`id_jenis_peternakan`) REFERENCES `mst_jenis_peternakan` (`id`),
  CONSTRAINT `peternakan_id_jenis_usaha_foreign` FOREIGN KEY (`id_jenis_usaha`) REFERENCES `mst_jenis_usaha` (`id`),
  CONSTRAINT `peternakan_id_kbli_foreign` FOREIGN KEY (`id_kbli`) REFERENCES `mst_kbli` (`id`),
  CONSTRAINT `peternakan_id_kecamatan_foreign` FOREIGN KEY (`id_kecamatan`) REFERENCES `mst_kecamatan` (`id`),
  CONSTRAINT `peternakan_id_kelurahan_foreign` FOREIGN KEY (`id_kelurahan`) REFERENCES `mst_desa` (`id`),
  CONSTRAINT `peternakan_id_pengesahan_badan_hukum_foreign` FOREIGN KEY (`id_pengesahan_badan_hukum`) REFERENCES `mst_pengesahan_badan_hukum` (`id`),
  CONSTRAINT `peternakan_id_skala_usaha_foreign` FOREIGN KEY (`id_skala_usaha`) REFERENCES `mst_skala_usaha` (`id`),
  CONSTRAINT `peternakan_id_status_permodalan_foreign` FOREIGN KEY (`id_status_permodalan`) REFERENCES `mst_status_permodalan` (`id`),
  CONSTRAINT `peternakan_id_status_verifikasi_foreign` FOREIGN KEY (`id_status_verifikasi`) REFERENCES `status_verifikasi` (`id`),
  CONSTRAINT `peternakan_id_tingkat_resiko_foreign` FOREIGN KEY (`id_tingkat_resiko`) REFERENCES `mst_tingkat_resiko` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `peternakan` WRITE;
/*!40000 ALTER TABLE `peternakan` DISABLE KEYS */;

INSERT INTO `peternakan` (`id`, `nama`, `id_kbli`, `id_jenis_usaha`, `id_jenis_peternakan`, `id_kecamatan`, `id_kelurahan`, `alamat`, `kode_pos`, `no_tlp_1`, `no_tlp_2`, `fax`, `email`, `website`, `no_badan_hukum`, `tanggal_badan_hukum`, `id_pengesahan_badan_hukum`, `tahun_ind_usaha`, `nama_notaris`, `npwp`, `nib`, `nib_tanggal_terbit`, `nib_dikeluarkan_oleh`, `nib_penanggungjawab`, `surat_izin_tempat_usaha`, `surat_izin_tempat_usaha_tanggal_terbit`, `surat_izin_tempat_usaha_dikeluarkan_oleh`, `surat_izin_tempat_usaha_masa_berlaku`, `surat_izin_tempat_usaha_penanggungjawab`, `id_tingkat_resiko`, `id_skala_usaha`, `nilai_investasi`, `id_status_permodalan`, `luas_tanah`, `luas_bangunan`, `tki_pria`, `tki_wanita`, `tka_pria`, `tka_wanita`, `id_status_verifikasi`, `catatan_verifikasi_petugas`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(26,'TAN ZHAO SHENG',1462,NULL,NULL,10,14,'Kp. Warung Dua Rt.02/ RW.10, Desa/Kelurahan Sukaraksa, Kec. Cigudeg, Kab. Bogor, Provinsi Jawa Barat,Kode Pos: 16660',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2009220026437',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(27,'PT TRIA AGRO PERKASA',1461,NULL,NULL,38,389,'Kp. Baturuyuk Rt.002/Rw.005, Kel. Selawangi, Kec. Tanjungsari, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16840',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2408210030175',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(28,'CV. BROSE GROUP',1461,NULL,NULL,20,425,'Jalan gang kecil, Desa/Kelurahan Curug, Kec. Jasinga, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16670',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2809210044189',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(29,'SUWHONO SE',1461,NULL,NULL,22,341,'Kp Bangkong Reang RT 03/08 Desa Pabuaran, Kecamatan Kemang, Kabupaten Bogor, Kel. Pabuaran, Kec. Kemang, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16310',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2810210022184',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(30,'MIKAEL K. BOLI WURAN',1461,NULL,NULL,15,357,'DESA BABAKAN PULO, Kel. Babakan, Kec. Ciseeng, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16310',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1611210019199',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(31,'WAHYU BUDI PRATOMO',1461,NULL,NULL,20,200,'Kampung Pematang, Kel. Barengkok, Kec. Jasinga, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16670',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2111210006595',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(32,'NUGROHO EDI WICAKSONO',1461,NULL,NULL,39,255,'Kampung Dungus Biuk, Desa Babakan, Desa/Kelurahan Babakan, Kec. Tenjo, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16370',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2511210030177',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(33,'PT FARMINDO KARYAMEKAR SEJAHTERA',1461,NULL,NULL,4,392,'KP LENAD RT 10 RW 03 DESA KARYA MEKAR, Desa/Kelurahan Karyamekar, Kec. Cariu, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16840',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0402220012502',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(34,'YUKHI',1461,NULL,NULL,21,395,'Kampung Dayeuh Paledang, Desa/Kelurahan Sukanegara, Kec. Jonggol, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16830',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120010121134',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(35,'PT TIRTA DYNARA PERKASA',1411,NULL,NULL,18,167,'Kota Wisata Florida 02/33A RT.006 RW.007, Desa/Kelurahan Ciangsana, Kec. Gunung Putri, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16968',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1102220010531',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(36,'WISMARIANTO BANGUN ANTARSO',1461,NULL,NULL,8,193,'Jl. Kh. Abdul Hamid, Desa/Kelurahan Situ Udik, Kec. Cibungbulang, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16630',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2104220050485',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(37,'CV PITIK WALIK JAMBUL',1461,NULL,NULL,20,425,'Kampung Ngasuh Blok Singkup, Desa/Kelurahan Curug, Kec. Jasinga, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16670',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1410210042313',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(38,'CARIU AGRO FARM',1441,NULL,NULL,4,390,'Kp. Nameng Lebak Rt. 001 Rw. 02, Kel. Bantarkuning, Kec. Cariu, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16840',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0712210014623',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(39,'INTAN TAAT ANUGRAH',1463,NULL,NULL,20,200,'Kp. Barenang, Desa/Kelurahan Barengkok, Kec. Jasinga, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16670',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'9120116121225',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(40,'INTAN TAAT ANUGRAH',1469,NULL,NULL,11,74,'KAMPUNG GEBLUG, Desa/Kelurahan Palasari, Kec. Cijeruk, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16740',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'9120116121225',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(41,'CENTRALAVIAN PERTIWI',1468,NULL,NULL,32,252,'Kp.Medang RT 001 RW 008, Desa/Kelurahan Sukamulya, Kec. Rumpin, Kab. Bogor, Provinsi Jawa Barat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120214182096',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(42,'MILENA IHSANTI SUWARNA',1461,NULL,NULL,31,427,'DESA CIMULANG, KAMPUNG CIHELEUT RT 001 RW 02, Desa/Kelurahan Cimulang, Kec. Ranca Bungur, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16311',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0107220014633',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(43,'SREEYA SEWU INDONESIA',1461,NULL,NULL,10,204,'Kp Ciahok, Desa/Kelurahan Cigudeg, Kec. Cigudeg, Kab. Bogor, Provinsi Jawa Barat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(44,'SREEYA SEWU INDONESIA',1468,NULL,NULL,10,204,'Desa Cigudeg Kecamatan Cigudeg (TCU 2), Desa/Kelurahan Cigudeg, Kec. Cigudeg, Kab. Bogor, Provinsi Jawa Barat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(45,'SREEYA SEWU INDONESIA',1461,NULL,NULL,19,423,'Kp Cibinong RT 001 RW 005, Desa/Kelurahan Cibinong, Kec. Gunung Sindur, Kab. Bogor, Provinsi Jawa Barat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(46,'SREEYA SEWU INDONESIA',1461,NULL,NULL,32,259,'Desa Rabak, Desa/Kelurahan Rabak, Kec. Rumpin, Kab. Bogor, Provinsi Jawa Barat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(47,'SREEYA SEWU INDONESIA',1461,NULL,NULL,32,38,'Kp Cidokom RT.01 RW.01, Desa/Kelurahan Cidokom, Kec. Rumpin, Kab. Bogor, Provinsi Jawa Barat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(48,'SREEYA SEWU INDONESIA',1468,NULL,NULL,30,53,'Desa/Kelurahan Lumpang, Kec. Parung Panjang, Kab. Bogor, Provinsi Jawa Barat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(49,'SREEYA SEWU INDONESIA',1461,NULL,NULL,15,48,'Kp Parigi, Desa/Kelurahan Parigi Mekar, Kec. Ciseeng, Kab. Bogor, Provinsi Jawa Barat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(50,'SREEYA SEWU INDONESIA',1468,NULL,NULL,29,113,'Jl. Raya Parung, Desa/Kelurahan Pamegarsari, Kec. Parung, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16330',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(51,'SREEYA SEWU INDONESIA',1468,NULL,NULL,29,113,'Jalan Raya Parung KM. 18, Desa/Kelurahan Pamegarsari, Kec. Parung, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16330',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004971529',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(52,'INTERTAMA TRIKENCANA BERSINAR',1468,NULL,NULL,38,389,'Kp. Tenjo Laut RT 06 RW 01, Desa/Kelurahan Selawangi, Kec. Tanjungsari, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16841',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120113021714',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(53,'PRIYO SUBAGIO SURYONO',1461,NULL,NULL,20,232,'Tegalwangi, Jasinga, Desa/Kelurahan Tegalwangi, Kec. Jasinga, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16670',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1612220027189',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(54,'JAPFA COMFEED INDONESIA',1468,NULL,NULL,37,24,'Farm Tamansari, Bogor, Kampung sukamantri RT 03 Rw 012, Desa/Kelurahan Sukamantri, Kec. Tamansari, Kab. Bogor, Provinsi Jawa Barat Nama Penerbit Izin: Kepala Kantor Pertanahan Kab. Bogor Nomor Izin: HGB No.00001 Tanggal terbit: 17 Mei 1997',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120004782505',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(55,'CIOMAS ADI SATWA',1461,NULL,NULL,10,223,'Kp Banar, Desa/Kelurahan Sukamaju, Kec. Cigudeg, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16660',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8120113040682',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(56,'SUMBER UNGGAS GLOBAL',1462,NULL,NULL,31,332,'Kp Keracak RT 1 RW 7 , Desa/Kelurahan Rancabungur, Kec. Ranca Bungur, Kab. Bogor, Provinsi, Jawa Barat, Kode Pos: 16310',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2801220039491',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(57,'SUMBER UNGGAS GLOBAL',1463,NULL,NULL,31,332,'Kp Keracak RT 1 RW 7 , Desa/Kelurahan Rancabungur, Kec. Ranca Bungur, Kab. Bogor, Provinsi, Jawa Barat, Kode Pos: 16311',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2801220039491',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(58,'IR.BUDI SANTOSO',1461,NULL,NULL,12,409,'KP.MALIMPING	RT 015/006, Kel. Mampir, Kec. Cileungsi, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16820',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0110210027154',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(59,'PT SADENG JAMBU',1411,NULL,NULL,7,381,'Kp. Tarikolot, Jl. Gor Pakansari RT. 004 RW. 003, Kel. Nanggewer, Kec. Cibinong, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16912',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1210210061569',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL),
	(60,'H MOMO',1461,NULL,NULL,11,178,'Kp. Pondok Bitung Rt. 003 Rw. 001, Kel. Sukaharja, Kec. Cijeruk, Kab. Bogor, Provinsi Jawa Barat, Kode Pos: 16740',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1008210010603',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,'2024-10-09 13:09:09','2024-10-09 13:09:09',NULL,27,27,NULL);

/*!40000 ALTER TABLE `peternakan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table peternakan_berkas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `peternakan_berkas`;

CREATE TABLE `peternakan_berkas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_peternakan` bigint(20) unsigned DEFAULT NULL,
  `id_berkas_peternakan` bigint(20) unsigned DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_berkas` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peternakan_berkas_id_peternakan_index` (`id_peternakan`),
  KEY `peternakan_berkas_id_berkas_peternakan_index` (`id_berkas_peternakan`),
  CONSTRAINT `peternakan_berkas_id_berkas_peternakan_foreign` FOREIGN KEY (`id_berkas_peternakan`) REFERENCES `mst_berkas_peternakan` (`id`),
  CONSTRAINT `peternakan_berkas_id_peternakan_foreign` FOREIGN KEY (`id_peternakan`) REFERENCES `peternakan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table peternakan_produksi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `peternakan_produksi`;

CREATE TABLE `peternakan_produksi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_peternakan` bigint(20) unsigned DEFAULT NULL,
  `tanggal_produksi_dari` date DEFAULT NULL,
  `tanggal_produksi_sampai` date DEFAULT NULL,
  `jumlah_kandang` bigint(20) DEFAULT NULL,
  `jumlah_kandang_id_satuan` bigint(20) unsigned DEFAULT NULL,
  `jumlah_populasi` bigint(20) DEFAULT NULL,
  `jumlah_populasi_id_satuan` bigint(20) unsigned DEFAULT NULL,
  `jumlah_produksi` bigint(20) DEFAULT NULL,
  `jumlah_produksi_id_satuan` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peternakan_produksi_id_peternakan_index` (`id_peternakan`),
  KEY `peternakan_produksi_jumlah_kandang_id_satuan_index` (`jumlah_kandang_id_satuan`),
  KEY `peternakan_produksi_jumlah_populasi_id_satuan_index` (`jumlah_populasi_id_satuan`),
  KEY `peternakan_produksi_jumlah_produksi_id_satuan_index` (`jumlah_produksi_id_satuan`),
  CONSTRAINT `peternakan_produksi_id_peternakan_foreign` FOREIGN KEY (`id_peternakan`) REFERENCES `peternakan` (`id`),
  CONSTRAINT `peternakan_produksi_jumlah_kandang_id_satuan_foreign` FOREIGN KEY (`jumlah_kandang_id_satuan`) REFERENCES `mst_satuan` (`id`),
  CONSTRAINT `peternakan_produksi_jumlah_populasi_id_satuan_foreign` FOREIGN KEY (`jumlah_populasi_id_satuan`) REFERENCES `mst_satuan` (`id`),
  CONSTRAINT `peternakan_produksi_jumlah_produksi_id_satuan_foreign` FOREIGN KEY (`jumlah_produksi_id_satuan`) REFERENCES `mst_satuan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
