-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table knn.kehamilan
CREATE TABLE IF NOT EXISTS `kehamilan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pasien_id` bigint(20) unsigned NOT NULL,
  `usia_ibu` int(11) NOT NULL COMMENT 'Usia ibu saat hamil',
  `usia_kehamilan` int(11) NOT NULL COMMENT 'Usia kehamialan dalam minggu',
  `hamil_ke` int(11) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `tinggi_badan` double(8,2) NOT NULL,
  `lila` double(8,2) NOT NULL COMMENT 'lingkar lengan atas',
  `hb` double(8,2) NOT NULL,
  `tesni_a` double(8,2) NOT NULL COMMENT 'tensi atas',
  `tesni_b` double(8,2) NOT NULL COMMENT 'tensi bawah',
  `jarak_hamil` double(8,2) NOT NULL,
  `imunisasi` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_imunisasi` date NOT NULL,
  `buku_kia` enum('Ya','Tidak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ya',
  `skor_awal` int(11) NOT NULL DEFAULT '2',
  `lambat_hamil_pertama` int(11) NOT NULL DEFAULT '0' COMMENT 'Lambat hamil ',
  `lama_hamil_lagi` int(11) NOT NULL DEFAULT '0' COMMENT '>= 10 tahun',
  `gagal_hamil` int(11) NOT NULL DEFAULT '0' COMMENT 'Pernah gagal hamil ',
  `lahir_vakum` int(11) NOT NULL DEFAULT '0' COMMENT 'Pernah melahirkan dengan vakum',
  `lahir_dirogoh` int(11) NOT NULL DEFAULT '0' COMMENT 'Pernah melahirkan dengan uri dirogoh ',
  `lahir_transfusi` int(11) NOT NULL DEFAULT '0' COMMENT 'Pernah melahirkan dengan transfusi ',
  `pernah_sesar` int(11) NOT NULL,
  `penyakit_kurang_darah` int(11) NOT NULL DEFAULT '0' COMMENT 'penyakit ibu hamil kurang darah',
  `penyakit_malaria` int(11) NOT NULL DEFAULT '0' COMMENT 'penyakit ibu hamil malaria',
  `penyakit_tbc` int(11) NOT NULL DEFAULT '0' COMMENT 'penyakit ibu hamil tbc',
  `penyakit_jantung` int(11) NOT NULL DEFAULT '0' COMMENT 'penyakit ibu hamil payah jantung',
  `penyakit_kencing_manis` int(11) NOT NULL DEFAULT '0' COMMENT 'penyakit ibu hamil kencing manis',
  `penyakit_pms` int(11) NOT NULL DEFAULT '0' COMMENT 'penyakit ibu hamil PMS',
  `hamil_kembar` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `terlalu_muda_hamil` int(11) NOT NULL DEFAULT '0',
  `terlalu_tua_hamil` int(11) NOT NULL DEFAULT '0',
  `cepat_hamil_lagi` int(11) NOT NULL DEFAULT '0' COMMENT '< 2 Tahun',
  `banyak_anak` int(11) NOT NULL DEFAULT '0' COMMENT '4 / lebih',
  `umur_terlalu_tua` int(11) NOT NULL DEFAULT '0' COMMENT '>= 35 Tahun',
  `terlalu_pendek` int(11) NOT NULL DEFAULT '0' COMMENT '<= 145>',
  PRIMARY KEY (`id`),
  KEY `kehamilan_pasien_id_foreign` (`pasien_id`),
  CONSTRAINT `kehamilan_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table knn.kehamilan: ~7 rows (approximately)
/*!40000 ALTER TABLE `kehamilan` DISABLE KEYS */;
INSERT INTO `kehamilan` (`id`, `pasien_id`, `usia_ibu`, `usia_kehamilan`, `hamil_ke`, `berat_badan`, `tinggi_badan`, `lila`, `hb`, `tesni_a`, `tesni_b`, `jarak_hamil`, `imunisasi`, `tgl_imunisasi`, `buku_kia`, `skor_awal`, `lambat_hamil_pertama`, `lama_hamil_lagi`, `gagal_hamil`, `lahir_vakum`, `lahir_dirogoh`, `lahir_transfusi`, `pernah_sesar`, `penyakit_kurang_darah`, `penyakit_malaria`, `penyakit_tbc`, `penyakit_jantung`, `penyakit_kencing_manis`, `penyakit_pms`, `hamil_kembar`, `created_at`, `updated_at`, `terlalu_muda_hamil`, `terlalu_tua_hamil`, `cepat_hamil_lagi`, `banyak_anak`, `umur_terlalu_tua`, `terlalu_pendek`) VALUES
	(1, 1, 39, 30, 3, 50, 145.00, 23.00, 10.00, 110.00, 69.00, 2.50, 'TT4', '2021-05-16', 'Ya', 2, 0, 0, 4, 0, 0, 0, 8, 4, 0, 0, 0, 0, 0, 0, '2021-08-08 09:24:19', '2021-08-08 09:24:19', 0, 4, 0, 0, 4, 0),
	(2, 2, 30, 24, 1, 60, 158.00, 30.00, 12.00, 120.00, 80.00, 0.00, 'TT1', '2021-06-10', 'Ya', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, '2021-08-09 05:59:27', '2021-08-09 05:59:27', 0, 4, 0, 0, 0, 0),
	(3, 3, 32, 31, 3, 57, 152.00, 30.00, 13.40, 110.00, 70.00, 3.50, 'TT5', '2021-05-10', 'Ya', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:06:14', '2021-08-09 06:06:14', 0, 0, 0, 0, 0, 0),
	(4, 4, 30, 18, 2, 64, 160.00, 31.00, 12.50, 100.00, 70.00, 4.00, 'TT3', '2021-07-01', 'Ya', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:09:22', '2021-08-09 06:09:22', 0, 0, 0, 0, 0, 0),
	(5, 5, 33, 27, 2, 59, 154.00, 29.00, 11.70, 105.00, 66.00, 3.50, 'TT3', '2021-06-01', 'Ya', 2, 0, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:11:23', '2021-08-09 06:11:23', 0, 0, 0, 0, 0, 0),
	(6, 6, 37, 11, 3, 63, 161.00, 29.00, 13.10, 140.00, 92.00, 1.50, 'TT3', '2021-01-01', 'Ya', 2, 0, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:13:16', '2021-08-09 06:13:16', 0, 0, 4, 4, 0, 0),
	(7, 7, 33, 9, 1, 60, 150.00, 32.00, 12.80, 100.00, 70.00, 0.00, 'TT1', '2021-03-30', 'Ya', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:16:15', '2021-08-09 06:16:15', 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `kehamilan` ENABLE KEYS */;


-- Dumping structure for table knn.kunjungan
CREATE TABLE IF NOT EXISTS `kunjungan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kehamilan_id` bigint(20) unsigned NOT NULL,
  `bengkak_muka` int(11) NOT NULL DEFAULT '0',
  `hidraniom` int(11) NOT NULL DEFAULT '0' COMMENT 'Banyak air ketuban',
  `bayi_mati` int(11) NOT NULL DEFAULT '0' COMMENT 'bayi meninggal dalam kandungan',
  `lebih_bulan` int(11) NOT NULL DEFAULT '0' COMMENT 'kehamilan lebih bulan',
  `sungsang` int(11) NOT NULL DEFAULT '0' COMMENT 'posisi bayi sungsang',
  `lintang` int(11) NOT NULL DEFAULT '0' COMMENT 'posisi bayi letak lintang',
  `pendarahan` int(11) NOT NULL DEFAULT '0' COMMENT 'Pendarahan dalam kehamilan',
  `peb` int(11) NOT NULL DEFAULT '0' COMMENT 'PEB atau Eklamsia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pasien_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kunjungan_kehamilan_id_foreign` (`kehamilan_id`),
  KEY `kunjungan_pasien_id_foreign` (`pasien_id`),
  CONSTRAINT `kunjungan_kehamilan_id_foreign` FOREIGN KEY (`kehamilan_id`) REFERENCES `kehamilan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kunjungan_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table knn.kunjungan: ~7 rows (approximately)
/*!40000 ALTER TABLE `kunjungan` DISABLE KEYS */;
INSERT INTO `kunjungan` (`id`, `kehamilan_id`, `bengkak_muka`, `hidraniom`, `bayi_mati`, `lebih_bulan`, `sungsang`, `lintang`, `pendarahan`, `peb`, `created_at`, `updated_at`, `pasien_id`) VALUES
	(1, 1, 0, 0, 0, 0, 8, 0, 8, 0, '2021-08-09 05:54:29', '2021-08-09 05:54:29', 1),
	(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:01:19', '2021-08-09 06:01:19', 2),
	(3, 3, 0, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:06:51', '2021-08-09 06:06:51', 3),
	(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:09:50', '2021-08-09 06:09:50', 4),
	(5, 5, 0, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:14:22', '2021-08-09 06:14:22', 5),
	(6, 6, 4, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:14:35', '2021-08-09 06:14:35', 6),
	(7, 7, 0, 0, 0, 0, 0, 0, 0, 0, '2021-08-09 06:16:33', '2021-08-09 06:16:33', 7);
/*!40000 ALTER TABLE `kunjungan` ENABLE KEYS */;


-- Dumping structure for table knn.pasien
CREATE TABLE IF NOT EXISTS `pasien` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rekam_medik` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_suami` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_darah` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pasien_rekam_medik_unique` (`rekam_medik`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table knn.pasien: ~10 rows (approximately)
/*!40000 ALTER TABLE `pasien` DISABLE KEYS */;
INSERT INTO `pasien` (`id`, `rekam_medik`, `nama_ibu`, `nama_suami`, `alamat`, `golongan_darah`, `created_at`, `updated_at`) VALUES
	(1, 'A1234', 'Karni', 'Nawar', 'Tegal gede RT 01/RW 01', 'O', '2021-08-08 08:49:22', '2021-08-08 08:49:22'),
	(2, 'A1235', 'Muna', 'Rizal', 'Tegal gede RT 01/RW 01', 'A', '2021-08-08 09:01:33', '2021-08-08 09:01:33'),
	(3, 'A1236', 'Wati', 'Yanto', 'Tegal gede RT 01/RW 02', 'A', '2021-08-08 09:01:33', '2021-08-08 09:01:33'),
	(4, 'A1237', 'Ana', 'Rafa', 'Tegal gede RT 01/RW 02', 'B', '2021-08-08 09:01:33', '2021-08-08 09:01:33'),
	(5, 'A1238', 'Diana', 'Agus', 'Tegal gede RT 01/RW 02', 'O', '2021-08-08 09:01:33', '2021-08-08 09:01:33'),
	(6, 'A1239', 'Yanti', 'Wanto', 'Tegal gede RT 01/RW 03', 'AB', '2021-08-08 09:01:33', '2021-08-08 09:01:33'),
	(7, 'A1240', 'Ita', 'Lukman', 'Tegal gede RT 01/RW 03', 'AB', '2021-08-08 09:01:33', '2021-08-08 09:01:33'),
	(8, 'A1241', 'Festi', 'Wawan', 'Tegal gede RT 01/RW 04', 'O', '2021-08-08 09:01:33', '2021-08-08 09:01:33'),
	(9, 'A1242', 'Santi', 'Ahmad', 'Tegal gede RT 01/RW 04', 'O', '2021-08-08 09:01:33', '2021-08-08 09:01:33'),
	(10, 'A1243', 'Ifa', 'Udin', 'Tegal gede RT 01/RW 04', 'A', '2021-08-08 09:01:33', '2021-08-08 09:01:33');
/*!40000 ALTER TABLE `pasien` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
