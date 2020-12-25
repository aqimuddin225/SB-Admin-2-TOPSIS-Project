-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_praksi
CREATE DATABASE IF NOT EXISTS `db_praksi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_praksi`;

-- Dumping structure for view db_praksi.1pembagi
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `1pembagi` (
	`idkriteria` INT(11) NOT NULL,
	`idalter` INT(11) NULL,
	`bagi` DOUBLE NULL,
	`id_wisata` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_praksi.2normalisasi
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `2normalisasi` (
	`id_wisata` INT(11) NULL,
	`idnilai` INT(11) NOT NULL,
	`idkasus` INT(11) NULL,
	`idkriteria` INT(11) NULL,
	`idalternatif` INT(11) NULL,
	`idbobot` INT(11) NULL,
	`idskala` INT(11) NULL,
	`normalisasi` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_praksi.3terbobot
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `3terbobot` (
	`id_wisata` INT(11) NULL,
	`idnilai` INT(11) NOT NULL,
	`idkasus` INT(11) NULL,
	`idkriteria` INT(11) NULL,
	`idalternatif` INT(11) NULL,
	`idbobot` INT(11) NULL,
	`idskala` INT(11) NULL,
	`normalisasi` DOUBLE NULL,
	`value` INT(11) NULL,
	`terbobot` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_praksi.4amax_amin
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `4amax_amin` (
	`id_wisata` INT(11) NULL,
	`idkasus` INT(11) NULL,
	`idkriteria` INT(11) NULL,
	`maximum` DOUBLE NULL,
	`minimum` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_praksi.5nilaid
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `5nilaid` (
	`id_wisata` INT(11) NULL,
	`idalternatif` INT(11) NULL,
	`dplus` DOUBLE NULL,
	`dmin` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_praksi.6value
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `6value` (
	`id_wisata` INT(11) NULL,
	`idalternatif` INT(11) NULL,
	`val` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for table db_praksi.alternatif
CREATE TABLE IF NOT EXISTS `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_praksi.alternatif: ~3 rows (approximately)
/*!40000 ALTER TABLE `alternatif` DISABLE KEYS */;
REPLACE INTO `alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
	(1, 'Recommended'),
	(2, 'Average'),
	(3, 'Not Recommended');
/*!40000 ALTER TABLE `alternatif` ENABLE KEYS */;

-- Dumping structure for table db_praksi.bobot
CREATE TABLE IF NOT EXISTS `bobot` (
  `id_bobot` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_skala` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bobot`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_skala` (`id_skala`),
  CONSTRAINT `FK_bobot_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  CONSTRAINT `FK_bobot_skala` FOREIGN KEY (`id_skala`) REFERENCES `skala` (`id_skala`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_praksi.bobot: ~3 rows (approximately)
/*!40000 ALTER TABLE `bobot` DISABLE KEYS */;
REPLACE INTO `bobot` (`id_bobot`, `id_kriteria`, `id_skala`) VALUES
	(1, 1, 2),
	(2, 2, 1),
	(3, 3, 3);
/*!40000 ALTER TABLE `bobot` ENABLE KEYS */;

-- Dumping structure for table db_praksi.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_praksi.jenis: ~2 rows (approximately)
/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
REPLACE INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
	(1, 'Wisata Air'),
	(2, 'Wisata Perkebunan'),
	(3, 'Wisata Religi');
/*!40000 ALTER TABLE `jenis` ENABLE KEYS */;

-- Dumping structure for table db_praksi.kriteria
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_praksi.kriteria: ~2 rows (approximately)
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
REPLACE INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
	(1, 'Biaya'),
	(2, 'Keindahan'),
	(3, 'Sarpras');
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;

-- Dumping structure for table db_praksi.nilai
CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_wisata` int(11) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_skala` int(11) DEFAULT NULL,
  `id_bobot` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `FK_nilai_wisata` (`id_wisata`),
  KEY `FK_nilai_alternatif` (`id_alternatif`),
  KEY `FK_nilai_kriteria` (`id_kriteria`),
  KEY `FK_nilai_skala` (`id_skala`),
  KEY `FK_nilai_bobot` (`id_bobot`),
  CONSTRAINT `FK_nilai_alternatif` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`),
  CONSTRAINT `FK_nilai_bobot` FOREIGN KEY (`id_bobot`) REFERENCES `bobot` (`id_bobot`),
  CONSTRAINT `FK_nilai_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  CONSTRAINT `FK_nilai_skala` FOREIGN KEY (`id_skala`) REFERENCES `skala` (`id_skala`),
  CONSTRAINT `FK_nilai_wisata` FOREIGN KEY (`id_wisata`) REFERENCES `wisata` (`id_wisata`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table db_praksi.nilai: ~9 rows (approximately)
/*!40000 ALTER TABLE `nilai` DISABLE KEYS */;
REPLACE INTO `nilai` (`id_nilai`, `id_wisata`, `id_alternatif`, `id_kriteria`, `id_skala`, `id_bobot`) VALUES
	(1, 1, 1, 1, 2, 2),
	(2, 1, 1, 2, 1, 1),
	(3, 1, 1, 3, 1, 3),
	(25, 1, 2, 1, 1, 2),
	(26, 1, 2, 2, 1, 1),
	(27, 1, 2, 3, 1, 3),
	(28, 1, 2, 1, 2, 2),
	(29, 1, 2, 2, 2, 1),
	(30, 1, 2, 3, 2, 3);
/*!40000 ALTER TABLE `nilai` ENABLE KEYS */;

-- Dumping structure for table db_praksi.skala
CREATE TABLE IF NOT EXISTS `skala` (
  `id_skala` int(11) NOT NULL,
  `nama_skala` varchar(50) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_skala`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_praksi.skala: ~2 rows (approximately)
/*!40000 ALTER TABLE `skala` DISABLE KEYS */;
REPLACE INTO `skala` (`id_skala`, `nama_skala`, `value`) VALUES
	(1, 'baik', 3),
	(2, 'sedang', 2),
	(3, 'buruk', 1);
/*!40000 ALTER TABLE `skala` ENABLE KEYS */;

-- Dumping structure for table db_praksi.wisata
CREATE TABLE IF NOT EXISTS `wisata` (
  `id_wisata` int(11) NOT NULL AUTO_INCREMENT,
  `nama_wisata` varchar(50) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_wisata`),
  KEY `id_jenis` (`id_jenis`),
  CONSTRAINT `FK_wisata_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_praksi.wisata: ~0 rows (approximately)
/*!40000 ALTER TABLE `wisata` DISABLE KEYS */;
REPLACE INTO `wisata` (`id_wisata`, `nama_wisata`, `lokasi`, `id_jenis`) VALUES
	(1, 'Sumber Maron', 'Gondanglegi', 1),
	(2, 'Waduk Selorejo', 'Kandangan', 1);
/*!40000 ALTER TABLE `wisata` ENABLE KEYS */;

-- Dumping structure for view db_praksi.1pembagi
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `1pembagi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `1pembagi` AS select `kriteria`.`id_kriteria` AS `idkriteria`,`nilai`.`id_alternatif` AS `idalter`,sqrt(sum(pow(`skala`.`value`,2))) AS `bagi` , nilai.id_wisata
from ((`nilai` join `skala`) join `kriteria`) 
where `skala`.`id_skala` = `nilai`.`id_skala` and `kriteria`.`id_kriteria` = `nilai`.`id_kriteria`
group by `kriteria`.`id_kriteria` , `nilai`.`id_alternatif` ,`nilai`.`id_wisata` ;

-- Dumping structure for view db_praksi.2normalisasi
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `2normalisasi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `2normalisasi` AS select nilai.id_wisata, `nilai`.`id_nilai` AS `idnilai`,`nilai`.`id_wisata` AS `idkasus`,`nilai`.`id_kriteria` AS `idkriteria`,`nilai`.`id_alternatif` AS `idalternatif`,`nilai`.`id_bobot` AS `idbobot`,`nilai`.`id_skala` AS `idskala`,`skala`.`value` / `1pembagi`.`bagi` AS `normalisasi` from ((`nilai` join `1pembagi`) join `skala`) where `nilai`.`id_skala` = `skala`.`id_skala` and `1pembagi`.`idkriteria` = `nilai`.`id_kriteria` group by `nilai`.`id_nilai` , normalisasi ;

-- Dumping structure for view db_praksi.3terbobot
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `3terbobot`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `3terbobot` AS select 2normalisasi.id_wisata, `2normalisasi`.`idnilai` AS `idnilai`,`2normalisasi`.`idkasus` AS `idkasus`,`2normalisasi`.`idkriteria` AS `idkriteria`,`2normalisasi`.`idalternatif` AS `idalternatif`,`2normalisasi`.`idbobot` AS `idbobot`,`2normalisasi`.`idskala` AS `idskala`,`2normalisasi`.`normalisasi` AS `normalisasi`,`skala`.`value` AS `value`,`skala`.`value` * `2normalisasi`.`normalisasi` AS `terbobot` from ((`2normalisasi` join `bobot`) join `skala`) where `bobot`.`id_skala` = `skala`.`id_skala` and `bobot`.`id_kriteria` = `2normalisasi`.`idkriteria` group by `2normalisasi`.`idnilai` , 2normalisasi.id_wisata , normalisasi  , terbobot, normalisasi, skala.value ;

-- Dumping structure for view db_praksi.4amax_amin
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `4amax_amin`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `4amax_amin` AS select 3terbobot.id_wisata, `3terbobot`.`idkasus` AS `idkasus`,`3terbobot`.`idkriteria` AS `idkriteria`,max(`3terbobot`.`terbobot`) AS `maximum`,min(`3terbobot`.`terbobot`) AS `minimum` from `3terbobot` group by `3terbobot`.`idkriteria` , 3terbobot.id_wisata ;

-- Dumping structure for view db_praksi.5nilaid
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `5nilaid`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `5nilaid` AS select 3terbobot.id_wisata,`3terbobot`.`idalternatif` AS `idalternatif`,sqrt(sum(pow(`4amax_amin`.`maximum` - `3terbobot`.`terbobot`,2))) AS `dplus`,sqrt(sum(pow(`4amax_amin`.`minimum` - `3terbobot`.`terbobot`,2))) AS `dmin` from (`3terbobot` join `4amax_amin`) where `3terbobot`.`idkriteria` = `4amax_amin`.`idkriteria` group by `3terbobot`.`idalternatif`, 3terbobot.id_wisata ;

-- Dumping structure for view db_praksi.6value
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `6value`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `6value` AS SELECT 5nilaid.id_wisata, 5nilaid.idalternatif as idalternatif , 5nilaid.dmin/(5nilaid.dplus+5nilaid.dmin) as val from 5nilaid ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
