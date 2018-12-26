-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: mante392_akademik
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `afektif`
--

DROP TABLE IF EXISTS `afektif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `afektif` (
  `id_afektif` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(10) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(10) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `no_urut` int(2) NOT NULL,
  `p1` decimal(6,2) NOT NULL,
  `p2` decimal(6,2) NOT NULL,
  `p3` decimal(6,2) NOT NULL,
  `p4` decimal(6,2) NOT NULL,
  `p5` decimal(6,2) NOT NULL,
  `p6` decimal(6,2) NOT NULL,
  `p7` decimal(6,2) NOT NULL,
  `p8` decimal(6,2) NOT NULL,
  `p9` decimal(6,2) NOT NULL,
  `p10` decimal(6,2) NOT NULL,
  `p11` decimal(6,2) NOT NULL,
  `p12` decimal(6,2) NOT NULL,
  `p13` decimal(6,2) NOT NULL,
  `p14` decimal(6,2) NOT NULL,
  `p15` decimal(6,2) NOT NULL,
  `status` varchar(5) CHARACTER SET latin1 NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_afektif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aim`
--

DROP TABLE IF EXISTS `aim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aim` (
  `item` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isi` text COLLATE utf8_unicode_ci,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `analisis`
--

DROP TABLE IF EXISTS `analisis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `analisis` (
  `id_analisis` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(1) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(100) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(12) CHARACTER SET latin1 NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `no_urut` int(2) NOT NULL,
  `ulangan` varchar(3) CHARACTER SET latin1 NOT NULL,
  `jawaban` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nilai_s1` int(3) NOT NULL,
  `nilai_s2` int(3) NOT NULL,
  `nilai_s3` int(3) NOT NULL,
  `nilai_s4` int(3) NOT NULL,
  `nilai_s5` int(3) NOT NULL,
  `nilai_s6` int(3) NOT NULL,
  `nilai_s7` int(3) NOT NULL,
  `nilai_s8` int(3) NOT NULL,
  `nilai_s9` int(3) NOT NULL,
  `nilai_s10` int(3) NOT NULL,
  `nilai_s11` int(3) NOT NULL,
  `nilai_s12` int(3) NOT NULL,
  `nilai_s13` int(3) NOT NULL,
  `nilai_s14` int(3) NOT NULL,
  `nilai_s15` int(3) NOT NULL,
  `nilai_s16` int(3) NOT NULL,
  `nilai_s17` int(3) NOT NULL,
  `nilai_s18` int(3) NOT NULL,
  `nilai_s19` int(3) NOT NULL,
  `nilai_s20` int(3) NOT NULL,
  `nilai_s21` int(3) NOT NULL,
  `nilai_s22` int(3) NOT NULL,
  `nilai_s23` int(3) NOT NULL,
  `nilai_s24` int(3) NOT NULL,
  `nilai_s25` int(3) NOT NULL,
  `nilai_s26` int(3) NOT NULL,
  `nilai_s27` int(3) NOT NULL,
  `nilai_s28` int(3) NOT NULL,
  `nilai_s29` int(3) NOT NULL,
  `nilai_s30` int(3) NOT NULL,
  `nilai_s31` int(3) NOT NULL,
  `nilai_s32` int(3) NOT NULL,
  `nilai_s33` int(3) NOT NULL,
  `nilai_s34` int(3) NOT NULL,
  `nilai_s35` int(3) NOT NULL,
  `nilai_s36` int(3) NOT NULL,
  `nilai_s37` int(3) NOT NULL,
  `nilai_s38` int(3) NOT NULL,
  `nilai_s39` int(3) NOT NULL,
  `nilai_s40` int(3) NOT NULL,
  `nilai_s41` int(3) NOT NULL,
  `nilai_s42` int(3) NOT NULL,
  `nilai_s43` int(3) NOT NULL,
  `nilai_s44` int(3) NOT NULL,
  `nilai_s45` int(3) NOT NULL,
  `nilai_s46` int(3) NOT NULL,
  `nilai_s47` int(3) NOT NULL,
  `nilai_s48` int(3) NOT NULL,
  `nilai_s49` int(3) NOT NULL,
  `nilai_s50` int(3) NOT NULL,
  `dicapai` decimal(6,2) NOT NULL,
  `nilai_ideal` int(3) NOT NULL,
  `persentase` decimal(6,2) NOT NULL,
  `ketuntasan` varchar(10) CHARACTER SET latin1 NOT NULL,
  `status` varchar(1) CHARACTER SET latin1 NOT NULL,
  `uraian_1` float(4,2) NOT NULL,
  `uraian_2` float(4,2) NOT NULL,
  `uraian_3` float(4,2) NOT NULL,
  `uraian_4` float(4,2) NOT NULL,
  `uraian_5` float(4,2) NOT NULL,
  `uraian_6` float(4,2) DEFAULT NULL,
  `uraian_7` float(4,2) DEFAULT NULL,
  `uraian_8` float(4,2) DEFAULT NULL,
  `uraian_9` float(4,2) DEFAULT NULL,
  `uraian_10` float(4,2) DEFAULT NULL,
  `nilai_akhir` float(5,2) NOT NULL,
  `terkunci` int(1) NOT NULL,
  `kelompok` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_analisis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `analisis_dayabeda`
--

DROP TABLE IF EXISTS `analisis_dayabeda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `analisis_dayabeda` (
  `id_mapel` bigint(20) NOT NULL,
  `ulangan` varchar(4) CHARACTER SET latin1 NOT NULL,
  `nilai_s1` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s2` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s3` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s4` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s5` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s6` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s7` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s8` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s9` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s10` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s11` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s12` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s13` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s14` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s15` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s16` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s17` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s18` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s19` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s20` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s21` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s22` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s23` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s24` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s25` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s26` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s27` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s28` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s29` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s30` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s31` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s32` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s33` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s34` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s35` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s36` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s37` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s38` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s39` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s40` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s41` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s42` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s43` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s44` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s45` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s46` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s47` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s48` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s49` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_s50` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dipakai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `analisis_skor`
--

DROP TABLE IF EXISTS `analisis_skor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `analisis_skor` (
  `id_mapel` bigint(20) NOT NULL,
  `itemnilai` varchar(4) CHARACTER SET latin1 NOT NULL,
  `s1` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s2` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s3` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s4` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s5` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s6` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s7` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s8` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s9` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s10` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s11` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s12` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s13` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s14` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s15` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s16` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s17` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s18` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s19` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s20` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s21` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s22` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s23` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s24` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s25` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s26` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s27` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s28` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s29` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s30` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s31` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s32` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s33` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s34` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s35` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s36` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s37` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s38` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s39` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s40` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s41` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s42` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s43` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s44` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s45` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s46` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s47` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s48` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s49` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s50` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dipakai` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ard_login`
--

DROP TABLE IF EXISTS `ard_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ard_login` (
  `username` varchar(100) DEFAULT NULL,
  `username_ard` varchar(100) DEFAULT NULL,
  `password_ard` text,
  `teacher_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ard_mapel`
--

DROP TABLE IF EXISTS `ard_mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ard_mapel` (
  `id_mapel` varchar(100) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `tingkat` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aspek_afektif`
--

DROP TABLE IF EXISTS `aspek_afektif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aspek_afektif` (
  `id_aspek_afektif` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 DEFAULT NULL,
  `semester` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `kelas` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `p1` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p2` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p3` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p4` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p5` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p6` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p7` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p8` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p9` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p10` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p11` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p12` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p13` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p14` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p15` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `np` int(2) NOT NULL,
  `nmax` decimal(6,2) NOT NULL,
  `namat` decimal(6,2) NOT NULL,
  `nbaik` decimal(6,2) NOT NULL,
  `kurikulum` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_aspek_afektif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aspek_afektif_old`
--

DROP TABLE IF EXISTS `aspek_afektif_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aspek_afektif_old` (
  `id_aspek_afektif` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 DEFAULT NULL,
  `semester` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `kelas` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `p1` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p2` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p3` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p4` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p5` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `p6` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p7` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p8` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p9` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p10` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p11` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p12` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p13` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p14` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p15` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `np` int(2) NOT NULL,
  `nmax` decimal(6,2) NOT NULL,
  `namat` decimal(6,2) NOT NULL,
  `nbaik` decimal(6,2) NOT NULL,
  `kurikulum` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_aspek_afektif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aspek_psikomotorik`
--

DROP TABLE IF EXISTS `aspek_psikomotorik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aspek_psikomotorik` (
  `id_aspek_psikomotor` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(10) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(5) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `p1` text COLLATE utf8_unicode_ci,
  `p2` text COLLATE utf8_unicode_ci,
  `p3` text COLLATE utf8_unicode_ci,
  `p4` text COLLATE utf8_unicode_ci,
  `p5` text COLLATE utf8_unicode_ci,
  `p6` text COLLATE utf8_unicode_ci,
  `p7` text COLLATE utf8_unicode_ci,
  `p8` text COLLATE utf8_unicode_ci,
  `p9` text COLLATE utf8_unicode_ci,
  `p10` text CHARACTER SET ucs2 COLLATE ucs2_unicode_ci,
  `p11` text COLLATE utf8_unicode_ci,
  `p12` text COLLATE utf8_unicode_ci,
  `p13` text COLLATE utf8_unicode_ci,
  `p14` text COLLATE utf8_unicode_ci,
  `p15` text COLLATE utf8_unicode_ci,
  `p16` text COLLATE utf8_unicode_ci,
  `p17` text COLLATE utf8_unicode_ci,
  `p18` text COLLATE utf8_unicode_ci,
  `np` int(2) NOT NULL,
  PRIMARY KEY (`id_aspek_psikomotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aspek_psikomotorik_old`
--

DROP TABLE IF EXISTS `aspek_psikomotorik_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aspek_psikomotorik_old` (
  `id_aspek_psikomotor` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(10) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(5) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `p1` text COLLATE utf8_unicode_ci,
  `p2` text COLLATE utf8_unicode_ci,
  `p3` text COLLATE utf8_unicode_ci,
  `p4` text COLLATE utf8_unicode_ci,
  `p5` text COLLATE utf8_unicode_ci,
  `p6` text COLLATE utf8_unicode_ci,
  `p7` text COLLATE utf8_unicode_ci,
  `p8` text COLLATE utf8_unicode_ci,
  `p9` text COLLATE utf8_unicode_ci,
  `p10` text CHARACTER SET ucs2 COLLATE ucs2_unicode_ci,
  `p11` text COLLATE utf8_unicode_ci,
  `p12` text COLLATE utf8_unicode_ci,
  `p13` text COLLATE utf8_unicode_ci,
  `p14` text COLLATE utf8_unicode_ci,
  `p15` text COLLATE utf8_unicode_ci,
  `p16` text COLLATE utf8_unicode_ci,
  `p17` text COLLATE utf8_unicode_ci,
  `p18` text COLLATE utf8_unicode_ci,
  `np` int(2) NOT NULL,
  PRIMARY KEY (`id_aspek_psikomotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bank_deskripsi`
--

DROP TABLE IF EXISTS `bank_deskripsi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_deskripsi` (
  `id_bank_deskripsi` int(11) NOT NULL AUTO_INCREMENT,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_bank_deskripsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimtik_aspek_psikomotorik`
--

DROP TABLE IF EXISTS `bimtik_aspek_psikomotorik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimtik_aspek_psikomotorik` (
  `id_aspek_psikomotor` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(10) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(5) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `p1` text COLLATE utf8_unicode_ci,
  `p2` text COLLATE utf8_unicode_ci,
  `p3` text COLLATE utf8_unicode_ci,
  `p4` text COLLATE utf8_unicode_ci,
  `p5` text COLLATE utf8_unicode_ci,
  `p6` text COLLATE utf8_unicode_ci,
  `p7` text COLLATE utf8_unicode_ci,
  `p8` text COLLATE utf8_unicode_ci,
  `p9` text COLLATE utf8_unicode_ci,
  `p10` text CHARACTER SET ucs2 COLLATE ucs2_unicode_ci,
  `p11` text COLLATE utf8_unicode_ci,
  `p12` text COLLATE utf8_unicode_ci,
  `p13` text COLLATE utf8_unicode_ci,
  `p14` text COLLATE utf8_unicode_ci,
  `p15` text COLLATE utf8_unicode_ci,
  `p16` text COLLATE utf8_unicode_ci,
  `p17` text COLLATE utf8_unicode_ci,
  `p18` text COLLATE utf8_unicode_ci,
  `np` int(2) NOT NULL,
  PRIMARY KEY (`id_aspek_psikomotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimtik_deskripsi_capaian_nilai`
--

DROP TABLE IF EXISTS `bimtik_deskripsi_capaian_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimtik_deskripsi_capaian_nilai` (
  `id_mapel` int(11) NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `ket` text CHARACTER SET latin1 NOT NULL,
  `positif` int(1) NOT NULL,
  `materi` text COLLATE utf8_unicode_ci NOT NULL,
  `nomor_materi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimtik_haritatapmuka`
--

DROP TABLE IF EXISTS `bimtik_haritatapmuka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimtik_haritatapmuka` (
  `id_hari_tatap_muka` int(11) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(11) NOT NULL,
  `hari_tatap_muka` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `jam_ke` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jtm` int(2) NOT NULL,
  PRIMARY KEY (`id_hari_tatap_muka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimtik_mapel`
--

DROP TABLE IF EXISTS `bimtik_mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimtik_mapel` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `program` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kkm` int(2) NOT NULL,
  `ranah` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `sk` text COLLATE utf8_unicode_ci NOT NULL,
  `cacah_ulangan_harian` int(1) NOT NULL,
  `cacah_tugas` int(1) NOT NULL,
  `bobot_ulangan_harian` int(2) NOT NULL,
  `bobot_tugas` int(2) NOT NULL,
  `bobot_mid` int(2) NOT NULL,
  `bobot_semester` int(2) NOT NULL,
  `jam` int(1) NOT NULL,
  `adamid` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `kkm_uh1` int(3) NOT NULL,
  `kkm_uh2` int(3) NOT NULL,
  `kkm_uh3` int(3) NOT NULL,
  `kkm_uh4` int(3) NOT NULL,
  `kkm_mid` int(3) NOT NULL,
  `kkm_uas` int(3) NOT NULL,
  `nsoal_uh1` int(3) NOT NULL,
  `nsoal_uh2` int(3) NOT NULL,
  `nsoal_uh3` int(3) NOT NULL,
  `nsoal_uh4` int(3) NOT NULL,
  `nsoal_mid` int(3) NOT NULL,
  `nsoal_uas` int(3) NOT NULL,
  `skor_uh1` float(5,2) NOT NULL,
  `skor_uh2` float(5,2) NOT NULL,
  `skor_uh3` float(5,2) NOT NULL,
  `skor_uh4` float(5,2) NOT NULL,
  `skor_mid` float(5,2) NOT NULL,
  `skor_uas` float(5,2) NOT NULL,
  `hari_tatap_muka` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `jam_ke` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuh1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuh2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuh3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuh4` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kuncimid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `materi1` text COLLATE utf8_unicode_ci NOT NULL,
  `materi2` text COLLATE utf8_unicode_ci NOT NULL,
  `materi3` text COLLATE utf8_unicode_ci NOT NULL,
  `materi4` text COLLATE utf8_unicode_ci NOT NULL,
  `materi5` text COLLATE utf8_unicode_ci NOT NULL,
  `materi6` text COLLATE utf8_unicode_ci NOT NULL,
  `materi7` text COLLATE utf8_unicode_ci,
  `materi8` text COLLATE utf8_unicode_ci,
  `materi9` text COLLATE utf8_unicode_ci,
  `materi10` text COLLATE utf8_unicode_ci,
  `kelompok` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `jenis_deskripsi` int(1) NOT NULL,
  `keterampilan1` text COLLATE utf8_unicode_ci NOT NULL,
  `keterampilan2` text COLLATE utf8_unicode_ci NOT NULL,
  `kuncibuh1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibuh2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibuh3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibuh4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibmid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibuas` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_maks_bagian_a_uh1` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_uh2` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_uh3` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_uh4` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_mid` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_uas` int(3) DEFAULT NULL,
  `nsoal_b_uh1` int(3) DEFAULT NULL,
  `nsoal_b_uh2` int(3) DEFAULT NULL,
  `nsoal_b_uh3` int(3) DEFAULT NULL,
  `nsoal_b_uh4` int(3) DEFAULT NULL,
  `nsoal_b_mid` int(3) DEFAULT NULL,
  `nsoal_b_uas` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uh1` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uh2` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uh3` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uh4` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_mid` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uas` int(3) DEFAULT NULL,
  `nkuis` tinyint(1) DEFAULT NULL,
  `bobot_kuis` int(2) DEFAULT NULL,
  `sertifikasi` tinyint(1) NOT NULL DEFAULT '1',
  `batas1` int(2) NOT NULL,
  `batas2` int(2) NOT NULL,
  `batas3` int(2) NOT NULL,
  `batas4` int(2) NOT NULL,
  `batas5` int(2) NOT NULL,
  `batas6` int(2) NOT NULL,
  PRIMARY KEY (`id_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimtik_nilai`
--

DROP TABLE IF EXISTS `bimtik_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimtik_nilai` (
  `kd` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(2) DEFAULT NULL,
  `nilai_uh1` float(6,2) DEFAULT NULL,
  `nilai_uh2` float(6,2) DEFAULT NULL,
  `nilai_uh3` float(6,2) DEFAULT NULL,
  `nilai_uh4` float(6,2) DEFAULT NULL,
  `nilai_uh5` float(6,2) DEFAULT NULL,
  `nilai_uh6` float(6,2) DEFAULT NULL,
  `nilai_uh7` float(6,2) DEFAULT NULL,
  `nilai_uh8` float(6,2) DEFAULT NULL,
  `nilai_uh9` float(6,2) DEFAULT NULL,
  `nilai_uh10` float(6,2) DEFAULT NULL,
  `nilai_tu1` decimal(6,2) DEFAULT NULL,
  `nilai_tu2` decimal(6,2) DEFAULT NULL,
  `nilai_tu3` decimal(6,2) DEFAULT NULL,
  `nilai_tu4` decimal(6,2) DEFAULT NULL,
  `nilai_tu5` decimal(6,2) DEFAULT NULL,
  `nilai_tu6` decimal(6,2) DEFAULT NULL,
  `nilai_tu7` decimal(6,2) DEFAULT NULL,
  `nilai_tu8` decimal(6,2) DEFAULT NULL,
  `nilai_tu9` decimal(6,2) DEFAULT NULL,
  `nilai_tu10` decimal(6,2) DEFAULT NULL,
  `nilai_rtu` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_ruh` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_mid` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_uas` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_na` decimal(6,2) DEFAULT NULL,
  `nilai_tu` decimal(6,2) DEFAULT NULL,
  `nilai_nr` int(3) DEFAULT NULL,
  `ket` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`kd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimtik_psikomotorik`
--

DROP TABLE IF EXISTS `bimtik_psikomotorik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimtik_psikomotorik` (
  `id_psikomotor` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(10) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(10) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `no_urut` int(2) NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  `p1` int(3) NOT NULL,
  `p2` int(3) NOT NULL,
  `p3` int(3) NOT NULL,
  `p4` int(3) NOT NULL,
  `p5` int(3) NOT NULL,
  `p6` int(3) NOT NULL,
  `p7` int(3) NOT NULL,
  `p8` int(3) NOT NULL,
  `p9` int(3) NOT NULL,
  `p10` int(3) NOT NULL,
  `p11` int(3) NOT NULL,
  `p12` int(3) NOT NULL,
  `p13` int(3) NOT NULL,
  `p14` int(3) NOT NULL,
  `p15` int(3) NOT NULL,
  `p16` int(3) NOT NULL,
  `p17` int(3) NOT NULL,
  `p18` int(3) NOT NULL,
  `nilai` decimal(6,2) NOT NULL,
  `nilai_akhir` int(3) NOT NULL,
  `status` varchar(5) CHARACTER SET latin1 NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_psikomotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimtik_rph`
--

DROP TABLE IF EXISTS `bimtik_rph`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimtik_rph` (
  `id_rph` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jamke` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_bph` date NOT NULL,
  `hambatan_siswa` text COLLATE utf8_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8_unicode_ci NOT NULL,
  `alat_dan_bahan` text COLLATE utf8_unicode_ci,
  `kode_rpp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kode_rpp2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lab` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_rph`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimtik_rpp`
--

DROP TABLE IF EXISTS `bimtik_rpp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimtik_rpp` (
  `id_bimtik_rpp` int(11) NOT NULL AUTO_INCREMENT,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `no_rpp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `waktu` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `standar_kompetensi` text COLLATE utf8_unicode_ci,
  `kompetensi_dasar` text COLLATE utf8_unicode_ci,
  `indikator_pencapaian_kompetensi` text COLLATE utf8_unicode_ci,
  `tujuan_pembelajaran` text COLLATE utf8_unicode_ci,
  `materi_pembelajaran` text COLLATE utf8_unicode_ci,
  `model_pembelajaran` text COLLATE utf8_unicode_ci,
  `strategi_pembelajaran` text COLLATE utf8_unicode_ci,
  `sumber_belajar` text COLLATE utf8_unicode_ci,
  `pendahuluan` text COLLATE utf8_unicode_ci,
  `eksplorasi` text COLLATE utf8_unicode_ci,
  `elaborasi` text COLLATE utf8_unicode_ci,
  `konfirmasi` text COLLATE utf8_unicode_ci,
  `penutup` text COLLATE utf8_unicode_ci,
  `penilaian` text COLLATE utf8_unicode_ci,
  `tugas` text COLLATE utf8_unicode_ci,
  `rencana` text COLLATE utf8_unicode_ci,
  `jenis` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  PRIMARY KEY (`id_bimtik_rpp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bk_individu`
--

DROP TABLE IF EXISTS `bk_individu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bk_individu` (
  `id_bk_individu` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nis` varchar(10) NOT NULL,
  `username` text,
  `masalah` text,
  `diagnosis` text,
  `pronosis` text,
  `tujuan` text,
  `pendekatan` text,
  `tahap_awal` text,
  `pertengahan` text,
  `akhir` text NOT NULL,
  `hasil` text,
  `tindak_lanjut` text,
  PRIMARY KEY (`id_bk_individu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `datsis`
--

DROP TABLE IF EXISTS `datsis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datsis` (
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `nisn` varchar(30) CHARACTER SET latin1 NOT NULL,
  `nik` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `nokk` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `skhun` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  `panggilan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kdkls` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tmpt` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tgllhr` date NOT NULL,
  `jenkel` varchar(9) CHARACTER SET latin1 NOT NULL,
  `agama` varchar(10) CHARACTER SET latin1 NOT NULL,
  `wn` varchar(50) CHARACTER SET latin1 NOT NULL,
  `yatim` varchar(30) CHARACTER SET latin1 NOT NULL,
  `anakke` int(2) NOT NULL,
  `kandung` int(2) NOT NULL,
  `tiri` int(2) NOT NULL,
  `angkat` int(2) NOT NULL,
  `bhs` varchar(20) CHARACTER SET latin1 NOT NULL,
  `jalan` varchar(30) CHARACTER SET latin1 NOT NULL,
  `rt` varchar(4) CHARACTER SET latin1 NOT NULL,
  `rw` varchar(4) CHARACTER SET latin1 NOT NULL,
  `dusun` varchar(30) CHARACTER SET latin1 NOT NULL,
  `desa` varchar(30) CHARACTER SET latin1 NOT NULL,
  `kec` varchar(30) CHARACTER SET latin1 NOT NULL,
  `kab` varchar(30) CHARACTER SET latin1 NOT NULL,
  `prov` varchar(30) CHARACTER SET latin1 NOT NULL,
  `jarak` varchar(20) CHARACTER SET latin1 NOT NULL,
  `jenrumah` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tinggal` varchar(30) CHARACTER SET latin1 NOT NULL,
  `transportasi` varchar(30) CHARACTER SET latin1 NOT NULL,
  `bb` varchar(3) CHARACTER SET latin1 NOT NULL,
  `tb` varchar(3) CHARACTER SET latin1 NOT NULL,
  `goldarah` varchar(2) CHARACTER SET latin1 NOT NULL,
  `sakit` varchar(50) CHARACTER SET latin1 NOT NULL,
  `jasmani` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sltp` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nosttb` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tglsttb` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lama` varchar(1) CHARACTER SET latin1 NOT NULL,
  `pinsek` varchar(50) CHARACTER SET latin1 NOT NULL,
  `alasan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `kls` varchar(8) CHARACTER SET latin1 NOT NULL,
  `tglditerima` date NOT NULL,
  `nmayah` varchar(50) CHARACTER SET latin1 NOT NULL,
  `alayah` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tmpayah` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tglayah` date NOT NULL,
  `agayah` varchar(10) CHARACTER SET latin1 NOT NULL,
  `wnayah` varchar(30) CHARACTER SET latin1 NOT NULL,
  `payah` varchar(50) CHARACTER SET latin1 NOT NULL,
  `dayah` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sekayah` varchar(20) CHARACTER SET latin1 NOT NULL,
  `hdpayah` varchar(5) CHARACTER SET latin1 NOT NULL,
  `thnayah` varchar(4) CHARACTER SET latin1 NOT NULL,
  `nmibu` varchar(50) CHARACTER SET latin1 NOT NULL,
  `alibu` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tmpibu` varchar(30) CHARACTER SET latin1 NOT NULL,
  `tglibu` date NOT NULL,
  `agibu` varchar(10) CHARACTER SET latin1 NOT NULL,
  `wnibu` varchar(30) CHARACTER SET latin1 NOT NULL,
  `pibu` varchar(50) CHARACTER SET latin1 NOT NULL,
  `dibu` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sekibu` varchar(20) CHARACTER SET latin1 NOT NULL,
  `hdpibu` varchar(5) CHARACTER SET latin1 NOT NULL,
  `thnibu` varchar(4) CHARACTER SET latin1 NOT NULL,
  `nmwali` varchar(50) CHARACTER SET latin1 NOT NULL,
  `awali` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tmpwali` varchar(30) CHARACTER SET latin1 NOT NULL,
  `tglwali` date NOT NULL,
  `agwali` varchar(10) CHARACTER SET latin1 NOT NULL,
  `wnwali` varchar(30) CHARACTER SET latin1 NOT NULL,
  `pwali` varchar(50) CHARACTER SET latin1 NOT NULL,
  `dwali` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sekwali` varchar(20) CHARACTER SET latin1 NOT NULL,
  `ket` varchar(1) CHARACTER SET latin1 NOT NULL,
  `foto` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `jenis` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `sandi` varchar(15) CHARACTER SET latin1 NOT NULL,
  `telepon` varchar(15) CHARACTER SET latin1 NOT NULL,
  `hp` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ijazah` varchar(5) CHARACTER SET latin1 NOT NULL,
  `pemilo` varchar(1) CHARACTER SET latin1 NOT NULL,
  `tayah` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tibu` varchar(20) CHARACTER SET latin1 NOT NULL,
  `twali` varchar(20) CHARACTER SET latin1 NOT NULL,
  `kesenian` text CHARACTER SET latin1 NOT NULL,
  `olahraga` text CHARACTER SET latin1 NOT NULL,
  `organisasi` text CHARACTER SET latin1 NOT NULL,
  `lain` text CHARACTER SET latin1 NOT NULL,
  `beasiswa` text CHARACTER SET latin1 NOT NULL,
  `tanggalkeluar` date NOT NULL,
  `alasankeluar` text CHARACTER SET latin1 NOT NULL,
  `tamatbelajar` date NOT NULL,
  `nosttbma` varchar(100) CHARACTER SET latin1 NOT NULL,
  `melanjutkan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tanggalbekerja` date NOT NULL,
  `namaperusahaan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `penghasilan` int(9) NOT NULL,
  `lihatrapor` varchar(5) CHARACTER SET latin1 NOT NULL,
  `kode_pes_lama` varchar(50) CHARACTER SET latin1 NOT NULL,
  `alamat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cita_cita` varchar(50) CHARACTER SET latin1 NOT NULL,
  `dortu` varchar(50) CHARACTER SET latin1 NOT NULL,
  `hobi` varchar(100) CHARACTER SET latin1 NOT NULL,
  `paralel` varchar(2) CHARACTER SET latin1 NOT NULL,
  `jurusan` varchar(20) CHARACTER SET latin1 NOT NULL,
  `sltpasal` varchar(1) CHARACTER SET latin1 NOT NULL,
  `nmortu` varchar(100) CHARACTER SET latin1 NOT NULL,
  `sekolahtujuan` text CHARACTER SET latin1 NOT NULL,
  `nosurat` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nomor_pendaftaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `password_tes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nisn_snmptn` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kps` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pkh` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated` tinyint(1) NOT NULL,
  `thnajaran` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kodepadamu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nik_kk` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nik_ibu` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_blanko_skhun` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nik_wali` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `npsn_sltp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kodepos` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kks` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis_sltp` int(1) DEFAULT NULL,
  `sktm` text COLLATE utf8_unicode_ci,
  `kota_sltp` text COLLATE utf8_unicode_ci,
  `cacah_spm` int(1) DEFAULT NULL,
  `cacah_mobil` int(1) DEFAULT NULL,
  `lantai` text COLLATE utf8_unicode_ci,
  `dinding` text COLLATE utf8_unicode_ci,
  `ternak` text COLLATE utf8_unicode_ci,
  `elektronik` text COLLATE utf8_unicode_ci,
  `chat_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chat_id_valid` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuliah` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Tidak',
  `id_siswa` text COLLATE utf8_unicode_ci,
  `kode_rombel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rombel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_jurusan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jurusan_emiss` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_ard_siswa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_desa` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rombel_ard` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deskripsi_capaian_nilai`
--

DROP TABLE IF EXISTS `deskripsi_capaian_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deskripsi_capaian_nilai` (
  `id_mapel` int(11) NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `ket` text CHARACTER SET latin1 NOT NULL,
  `positif` int(1) NOT NULL,
  `materi` text COLLATE utf8_unicode_ci NOT NULL,
  `nomor_materi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detil_aspek_afektif`
--

DROP TABLE IF EXISTS `detil_aspek_afektif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detil_aspek_afektif` (
  `id_detil_aspek_afektif` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(10) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(5) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(10) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `p1` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p2` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p3` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p4` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p5` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p6` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p7` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p8` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p9` varchar(100) CHARACTER SET latin1 NOT NULL,
  `p10` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nomoraspek` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `np` int(2) NOT NULL,
  `teknik` text COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_detil_aspek_afektif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detil_aspek_psikomotor`
--

DROP TABLE IF EXISTS `detil_aspek_psikomotor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detil_aspek_psikomotor` (
  `id_detil_aspek_psikomotor` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(10) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(5) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(10) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `p1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p3` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p4` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p5` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p6` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p7` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p8` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p9` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p10` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nomoraspek` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `np` int(2) NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `s1` int(2) DEFAULT NULL,
  `s2` int(2) DEFAULT NULL,
  `s3` int(2) DEFAULT NULL,
  `s4` int(2) DEFAULT NULL,
  `s5` int(2) DEFAULT NULL,
  `s6` int(2) DEFAULT NULL,
  `s7` int(2) DEFAULT NULL,
  `s8` int(2) DEFAULT NULL,
  `s9` int(2) DEFAULT NULL,
  `s10` int(2) DEFAULT NULL,
  `jenis` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_detil_aspek_psikomotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detil_keterampilan`
--

DROP TABLE IF EXISTS `detil_keterampilan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detil_keterampilan` (
  `id_detil_keterampilan` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(10) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(10) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nomoraspek` int(2) NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `no_urut` int(2) NOT NULL,
  `p1` int(3) NOT NULL,
  `p2` int(3) NOT NULL,
  `p3` int(3) NOT NULL,
  `p4` int(3) NOT NULL,
  `p5` int(3) NOT NULL,
  `p6` int(3) NOT NULL,
  `p7` int(3) NOT NULL,
  `p8` int(3) NOT NULL,
  `p9` int(3) NOT NULL,
  `p10` int(3) NOT NULL,
  `nilai` decimal(6,2) NOT NULL,
  `status` varchar(5) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_detil_keterampilan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detil_sikap`
--

DROP TABLE IF EXISTS `detil_sikap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detil_sikap` (
  `id_detil_sikap` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(10) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(10) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nomoraspek` int(2) NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `no_urut` int(2) NOT NULL,
  `p1` int(3) NOT NULL,
  `p2` int(3) NOT NULL,
  `p3` int(3) NOT NULL,
  `p4` int(3) NOT NULL,
  `p5` int(3) NOT NULL,
  `p6` int(3) NOT NULL,
  `p7` int(3) NOT NULL,
  `p8` int(3) NOT NULL,
  `p9` int(3) NOT NULL,
  `p10` int(3) NOT NULL,
  `nilai` decimal(6,2) NOT NULL,
  `status` varchar(5) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_detil_sikap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `regency_id` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_id_index` (`regency_id`),
  CONSTRAINT `districts_regency_id_foreign` FOREIGN KEY (`regency_id`) REFERENCES `regencies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupak_dupak`
--

DROP TABLE IF EXISTS `dupak_dupak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupak_dupak` (
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `golongan` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lama` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cacah` int(3) DEFAULT NULL,
  `ref_ak` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ak_item` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `jumlah` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_urut` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupak_dupak_lama`
--

DROP TABLE IF EXISTS `dupak_dupak_lama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupak_dupak_lama` (
  `id_dupak_dupak_lama` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `ak_pbm` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_dupak_dupak_lama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupak_masa`
--

DROP TABLE IF EXISTS `dupak_masa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupak_masa` (
  `id_dupak_masa` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `awal_penilaian` date DEFAULT NULL,
  `akhir_penilaian` date DEFAULT NULL,
  `golongan` varchar(11) NOT NULL,
  `awal` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `versi` int(3) DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `tahun` int(2) DEFAULT NULL,
  `bulan` int(2) DEFAULT NULL,
  `tahun_baru` varchar(2) DEFAULT NULL,
  `bulan_baru` varchar(2) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_dupak_masa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupak_pak`
--

DROP TABLE IF EXISTS `dupak_pak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupak_pak` (
  `id_dupak_pak` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `awal_penilaian` date DEFAULT NULL,
  `akhir_penilaian` date DEFAULT NULL,
  `pendidikan` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pangkat` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `golongan` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `jabatan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tahun_lama` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bulan_lama` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tahun` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bulan` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tugas` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ak_pendidikan` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ak_sttpl` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ak_pbm` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ak_pkb` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ak_penunjang` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ak` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_dupak_pak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupak_pd`
--

DROP TABLE IF EXISTS `dupak_pd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupak_pd` (
  `id_dupak_pd` bigint(20) NOT NULL AUTO_INCREMENT,
  `golongan` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_kegiatan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tanggal` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `materi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `peran` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `jam` int(100) DEFAULT NULL,
  `fasilitator` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tempat` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `penyelenggara` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `bukti` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_dupak_pd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupak_pj`
--

DROP TABLE IF EXISTS `dupak_pj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupak_pj` (
  `id_dupak_pj` bigint(20) NOT NULL AUTO_INCREMENT,
  `golongan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_kegiatan` text CHARACTER SET ucs2 COLLATE ucs2_unicode_ci,
  `tanggal` text COLLATE utf8_unicode_ci,
  `keterangan` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_dupak_pj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupak_skp`
--

DROP TABLE IF EXISTS `dupak_skp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupak_skp` (
  `id_dupak_skp` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `ak` float(8,3) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tahun` int(4) NOT NULL,
  `golongan` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_dupak_skp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupak_tapel`
--

DROP TABLE IF EXISTS `dupak_tapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupak_tapel` (
  `id_dupak_tahun` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `semester` int(1) NOT NULL,
  `versi` int(1) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  PRIMARY KEY (`id_dupak_tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ekstrakurikuler`
--

DROP TABLE IF EXISTS `ekstrakurikuler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ekstrakurikuler` (
  `id_siswa_ekstra` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `nis` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `nama_ekstra` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_siswa_ekstra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `entity__category_subjects`
--

DROP TABLE IF EXISTS `entity__category_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity__category_subjects` (
  `category_subjects_id` int(255) NOT NULL AUTO_INCREMENT,
  `category_level_id` int(11) DEFAULT NULL,
  `category_majors_id` int(11) DEFAULT NULL,
  `category_subjects_code` varchar(255) DEFAULT NULL,
  `category_subjects_name` varchar(255) DEFAULT NULL,
  `category_subjects_group` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_subjects_id`),
  KEY `category_level_id` (`category_level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `evaluasi_diri`
--

DROP TABLE IF EXISTS `evaluasi_diri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluasi_diri` (
  `tahun` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nim` varchar(200) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci DEFAULT NULL,
  `kode` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `kompetensi_inti` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `evaluasi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rencana` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `oleh` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `evaluasi_diri_tanggal`
--

DROP TABLE IF EXISTS `evaluasi_diri_tanggal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluasi_diri_tanggal` (
  `tahun` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `thnajaran` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_bip`
--

DROP TABLE IF EXISTS `guru_bip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_bip` (
  `id_guru_bip` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jenisulangan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `skkdmateri` text COLLATE utf8_unicode_ci NOT NULL,
  `isiinformasi` text COLLATE utf8_unicode_ci NOT NULL,
  `penerima` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_guru_bip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_bpu`
--

DROP TABLE IF EXISTS `guru_bpu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_bpu` (
  `id_guru_bpu` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jenisulangan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `skkdmateri` text COLLATE utf8_unicode_ci NOT NULL,
  `tanggalulangan` date NOT NULL,
  `wakil` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_guru_bpu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_buku_pegangan`
--

DROP TABLE IF EXISTS `guru_buku_pegangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_buku_pegangan` (
  `id_guru_buku_pegangan` int(11) NOT NULL AUTO_INCREMENT,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `judul` text COLLATE utf8_unicode_ci NOT NULL,
  `pengarang` text COLLATE utf8_unicode_ci NOT NULL,
  `penerbit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_guru_buku_pegangan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_data_supervisi`
--

DROP TABLE IF EXISTS `guru_data_supervisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_data_supervisi` (
  `id_data_supervisi` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `thnajaran` varchar(9) CHARACTER SET latin1 DEFAULT NULL,
  `semester` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `kelas` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `mapel` text CHARACTER SET latin1,
  `jamke` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `jtm` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `tanggal_supervisi_mengajar` date DEFAULT NULL,
  `tanggal_supervisi_perangkat` date DEFAULT NULL,
  `supervisor` varchar(8) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_data_supervisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_piket`
--

DROP TABLE IF EXISTS `guru_piket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_piket` (
  `id_guru_piket` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hari` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `urutan_hari` int(1) NOT NULL,
  PRIMARY KEY (`id_guru_piket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_rph`
--

DROP TABLE IF EXISTS `guru_rph`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_rph` (
  `id_rph` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jamke` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rencana` text COLLATE utf8_unicode_ci NOT NULL,
  `sk` text COLLATE utf8_unicode_ci NOT NULL,
  `kd` text COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `materi` text COLLATE utf8_unicode_ci NOT NULL,
  `materi_selanjutnya` text COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_bph` date NOT NULL,
  `hambatan_siswa` text COLLATE utf8_unicode_ci NOT NULL,
  `tugas` text COLLATE utf8_unicode_ci NOT NULL,
  `tanggalselesai` date NOT NULL,
  `is_mandiri` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8_unicode_ci NOT NULL,
  `alat_dan_bahan` text COLLATE utf8_unicode_ci,
  `lab` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_rph`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_rph_ringkas`
--

DROP TABLE IF EXISTS `guru_rph_ringkas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_rph_ringkas` (
  `id_rph` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jamke` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_bph` date NOT NULL,
  `hambatan_siswa` text COLLATE utf8_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8_unicode_ci NOT NULL,
  `alat_dan_bahan` text COLLATE utf8_unicode_ci,
  `kode_rpp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kode_rpp2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lab` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_rph`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_rpp_induk`
--

DROP TABLE IF EXISTS `guru_rpp_induk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_rpp_induk` (
  `id_guru_rpp_induk` int(11) NOT NULL AUTO_INCREMENT,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `no_rpp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `waktu` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `standar_kompetensi` text COLLATE utf8_unicode_ci,
  `kompetensi_dasar` text COLLATE utf8_unicode_ci,
  `indikator_pencapaian_kompetensi` text COLLATE utf8_unicode_ci,
  `tujuan_pembelajaran` text COLLATE utf8_unicode_ci,
  `materi_pembelajaran` text COLLATE utf8_unicode_ci,
  `model_pembelajaran` text COLLATE utf8_unicode_ci,
  `strategi_pembelajaran` text COLLATE utf8_unicode_ci,
  `sumber_belajar` text COLLATE utf8_unicode_ci,
  `pendahuluan` text COLLATE utf8_unicode_ci,
  `eksplorasi` text COLLATE utf8_unicode_ci,
  `elaborasi` text COLLATE utf8_unicode_ci,
  `konfirmasi` text COLLATE utf8_unicode_ci,
  `penutup` text COLLATE utf8_unicode_ci,
  `penilaian` text COLLATE utf8_unicode_ci,
  `tugas` text COLLATE utf8_unicode_ci,
  `rencana` text COLLATE utf8_unicode_ci,
  `jenis` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  PRIMARY KEY (`id_guru_rpp_induk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_tindak_lanjut`
--

DROP TABLE IF EXISTS `guru_tindak_lanjut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_tindak_lanjut` (
  `id_guru_tindak_lanjut` int(11) NOT NULL,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ulangan` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tindakan_pengayaan` text COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tindakan_satu` text COLLATE utf8_unicode_ci NOT NULL,
  `tindakan_dua` text COLLATE utf8_unicode_ci NOT NULL,
  `jam_mulai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menit_mulai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jam_selesai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menit_selesai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guru_tugas`
--

DROP TABLE IF EXISTS `guru_tugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru_tugas` (
  `id_guru_tugas` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jamke` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tugas` text COLLATE utf8_unicode_ci NOT NULL,
  `kodegurupiket` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_guru_tugas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gurubk`
--

DROP TABLE IF EXISTS `gurubk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gurubk` (
  `user_bp` varchar(50) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hadir`
--

DROP TABLE IF EXISTS `hadir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hadir` (
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(1) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(12) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL,
  `ada` varchar(1) CHARACTER SET latin1 NOT NULL,
  `pos` varchar(1) CHARACTER SET latin1 NOT NULL,
  `alamat_ip` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `indikator`
--

DROP TABLE IF EXISTS `indikator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indikator` (
  `id_indikator` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 DEFAULT NULL,
  `semester` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `mapel` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `kelas` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `ulangan` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `jawaban` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i_1` text COLLATE utf8_unicode_ci,
  `i_2` text COLLATE utf8_unicode_ci,
  `i_3` text COLLATE utf8_unicode_ci,
  `i_4` text COLLATE utf8_unicode_ci,
  `i_5` text COLLATE utf8_unicode_ci,
  `i_6` text COLLATE utf8_unicode_ci,
  `i_7` text COLLATE utf8_unicode_ci,
  `i_8` text COLLATE utf8_unicode_ci,
  `i_9` text COLLATE utf8_unicode_ci,
  `i_10` text COLLATE utf8_unicode_ci,
  `i_11` text COLLATE utf8_unicode_ci,
  `i_12` text COLLATE utf8_unicode_ci,
  `i_13` text COLLATE utf8_unicode_ci,
  `i_14` text COLLATE utf8_unicode_ci,
  `i_15` text COLLATE utf8_unicode_ci,
  `i_16` text COLLATE utf8_unicode_ci,
  `i_17` text COLLATE utf8_unicode_ci,
  `i_18` text COLLATE utf8_unicode_ci,
  `i_19` text COLLATE utf8_unicode_ci,
  `i_20` text COLLATE utf8_unicode_ci,
  `i_21` text COLLATE utf8_unicode_ci,
  `i_22` text COLLATE utf8_unicode_ci,
  `i_23` text COLLATE utf8_unicode_ci,
  `i_24` text COLLATE utf8_unicode_ci,
  `i_25` text COLLATE utf8_unicode_ci,
  `i_26` text COLLATE utf8_unicode_ci,
  `i_27` text COLLATE utf8_unicode_ci,
  `i_28` text COLLATE utf8_unicode_ci,
  `i_29` text COLLATE utf8_unicode_ci,
  `i_30` text COLLATE utf8_unicode_ci,
  `i_31` text COLLATE utf8_unicode_ci,
  `i_32` text COLLATE utf8_unicode_ci,
  `i_33` text COLLATE utf8_unicode_ci,
  `i_34` text COLLATE utf8_unicode_ci,
  `i_35` text COLLATE utf8_unicode_ci,
  `i_36` text COLLATE utf8_unicode_ci,
  `i_37` text COLLATE utf8_unicode_ci,
  `i_38` text COLLATE utf8_unicode_ci,
  `i_39` text COLLATE utf8_unicode_ci,
  `i_40` text COLLATE utf8_unicode_ci,
  `i_41` text COLLATE utf8_unicode_ci,
  `i_42` text COLLATE utf8_unicode_ci,
  `i_43` text COLLATE utf8_unicode_ci,
  `i_44` text COLLATE utf8_unicode_ci,
  `i_45` text COLLATE utf8_unicode_ci,
  `i_46` text COLLATE utf8_unicode_ci,
  `i_47` text COLLATE utf8_unicode_ci,
  `i_48` text COLLATE utf8_unicode_ci,
  `i_49` text COLLATE utf8_unicode_ci,
  `i_50` text COLLATE utf8_unicode_ci,
  `uraian_1` text COLLATE utf8_unicode_ci,
  `uraian_2` text COLLATE utf8_unicode_ci,
  `uraian_3` text COLLATE utf8_unicode_ci,
  `uraian_4` text COLLATE utf8_unicode_ci,
  `uraian_5` text COLLATE utf8_unicode_ci,
  `kelompok` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_indikator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info` (
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kalab_harian`
--

DROP TABLE IF EXISTS `kalab_harian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kalab_harian` (
  `id_kalab_harian` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `semester` varchar(1) DEFAULT NULL,
  `kodeguru` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `tempat` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `waktu` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `namakegiatan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `terlaksana` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `persentase` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keterangan_pelaksanaan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dukungan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `hambatan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keterangan_analisis` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `solusi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keterangan_tindak_lanjut` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_kalab_harian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kalab_proker`
--

DROP TABLE IF EXISTS `kalab_proker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kalab_proker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nourut` int(3) NOT NULL,
  `thnajaran` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `semester` varchar(1) DEFAULT NULL,
  `kodeguru` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `namakegiatan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tujuan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sasaran` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `waktu` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sumberdana` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `hasil` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kartu_ubk`
--

DROP TABLE IF EXISTS `kartu_ubk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kartu_ubk` (
  `nis1` varchar(10) DEFAULT NULL,
  `nis2` varchar(10) DEFAULT NULL,
  `baris` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kepribadian`
--

DROP TABLE IF EXISTS `kepribadian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kepribadian` (
  `id_kepribadian` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(1) CHARACTER SET latin1 NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(15) CHARACTER SET latin1 NOT NULL,
  `sakit` int(2) NOT NULL,
  `izin` int(2) NOT NULL,
  `tanpa_keterangan` int(2) NOT NULL,
  `membolos` int(2) NOT NULL,
  `terlambat` int(2) NOT NULL,
  `angka_kredit` int(3) NOT NULL,
  `satu` text CHARACTER SET latin1 NOT NULL,
  `kom1` text CHARACTER SET latin1 NOT NULL,
  `dua` text CHARACTER SET latin1 NOT NULL,
  `kom2` text CHARACTER SET latin1 NOT NULL,
  `tiga` text CHARACTER SET latin1 NOT NULL,
  `kom3` text CHARACTER SET latin1 NOT NULL,
  `empat` text CHARACTER SET latin1 NOT NULL,
  `kom4` text CHARACTER SET latin1 NOT NULL,
  `lima` text CHARACTER SET latin1 NOT NULL,
  `kom5` text CHARACTER SET latin1 NOT NULL,
  `enam` text CHARACTER SET latin1 NOT NULL,
  `kom6` text CHARACTER SET latin1 NOT NULL,
  `tujuh` text CHARACTER SET latin1 NOT NULL,
  `kom7` text CHARACTER SET latin1 NOT NULL,
  `delapan` text CHARACTER SET latin1 NOT NULL,
  `kom8` text CHARACTER SET latin1 NOT NULL,
  `sembilan` text CHARACTER SET latin1 NOT NULL,
  `kom9` text CHARACTER SET latin1 NOT NULL,
  `sepuluh` text CHARACTER SET latin1 NOT NULL,
  `kom10` text CHARACTER SET latin1 NOT NULL,
  `status` varchar(5) CHARACTER SET latin1 NOT NULL,
  `predikat` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wali` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_kepribadian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kode_lptk`
--

DROP TABLE IF EXISTS `kode_lptk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kode_lptk` (
  `kode` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `lptk` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kode_mapel_utama`
--

DROP TABLE IF EXISTS `kode_mapel_utama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kode_mapel_utama` (
  `kode` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentar` (
  `id_komentar` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_mapel` bigint(20) DEFAULT NULL,
  `nis` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `komentar_uh1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `komentar_uh2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `komentar_uh3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `komentar_uh4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `komentar_tu1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `komentar_tu2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `komentar_tu3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `komentar_tu4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `komentar_mid` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_komentar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kompetensi_dasar`
--

DROP TABLE IF EXISTS `kompetensi_dasar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kompetensi_dasar` (
  `id_kd` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `program` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(3) NOT NULL,
  `sk` text COLLATE utf8_unicode_ci NOT NULL,
  `kd` text COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kosong`
--

DROP TABLE IF EXISTS `kosong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kosong` (
  `id_kosong` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomor` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`id_kosong`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `label`
--

DROP TABLE IF EXISTS `label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `label` (
  `ruang` varchar(2) NOT NULL,
  `awal` varchar(10) NOT NULL,
  `akhir` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `leger_ijazah`
--

DROP TABLE IF EXISTS `leger_ijazah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leger_ijazah` (
  `nis` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r1` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r2` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r3` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r4` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r5` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r6` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r7` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r8` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r9` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r10` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r11` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r12` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r13` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r14` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r15` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r16` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r17` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r18` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r19` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r20` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r21` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r22` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `leger_ijazah_2017_2018`
--

DROP TABLE IF EXISTS `leger_ijazah_2017_2018`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leger_ijazah_2017_2018` (
  `nis` varchar(10) NOT NULL,
  `mapel` text NOT NULL,
  `no_urut` int(2) NOT NULL,
  `nilai` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `leger_info`
--

DROP TABLE IF EXISTS `leger_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leger_info` (
  `thnajaran` varchar(9) DEFAULT NULL,
  `item` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `konten` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `leger_nilai`
--

DROP TABLE IF EXISTS `leger_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leger_nilai` (
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kelas` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nis` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l1` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k1` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p1` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s1` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l2` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k2` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p2` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s2` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l3` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k3` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p3` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s3` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l4` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k4` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p4` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s4` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l5` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k5` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p5` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s5` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l6` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k6` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p6` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s6` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l7` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k7` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p7` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s7` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l8` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k8` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p8` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s8` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l9` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k9` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p9` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s9` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l10` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k10` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p10` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s10` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l11` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k11` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p11` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s11` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l12` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k12` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p12` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s12` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l13` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k13` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p13` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s13` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l14` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k14` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p14` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s14` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l15` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k15` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p15` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s15` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l16` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k16` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p16` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s16` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l17` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k17` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p17` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s17` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l18` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k18` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p18` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s18` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l19` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k19` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p19` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s19` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l20` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k20` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p20` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s20` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l21` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k21` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p21` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s21` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l22` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k22` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p22` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s22` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_ak_lama_guru_mapel`
--

DROP TABLE IF EXISTS `m_ak_lama_guru_mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_ak_lama_guru_mapel` (
  `id` int(2) DEFAULT NULL,
  `II` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IIIab` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IIIcd` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IV` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_akhlak`
--

DROP TABLE IF EXISTS `m_akhlak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_akhlak` (
  `id_m_akhlak` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'T',
  PRIMARY KEY (`id_m_akhlak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_akhlak_2015`
--

DROP TABLE IF EXISTS `m_akhlak_2015`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_akhlak_2015` (
  `id_m_akhlak` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'T',
  PRIMARY KEY (`id_m_akhlak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_cita`
--

DROP TABLE IF EXISTS `m_cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_cita` (
  `kode` varchar(2) CHARACTER SET latin1 NOT NULL,
  `nama_cita` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_duit`
--

DROP TABLE IF EXISTS `m_duit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_duit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `besar` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_ekstra`
--

DROP TABLE IF EXISTS `m_ekstra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_ekstra` (
  `id_ekstra` int(11) NOT NULL AUTO_INCREMENT,
  `namaekstra` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `wajib` tinyint(1) NOT NULL DEFAULT '0',
  `school_extracurricular_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_ekstra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_ekstra_wajib`
--

DROP TABLE IF EXISTS `m_ekstra_wajib`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_ekstra_wajib` (
  `id_ekstra_wajib` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `namaekstra` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_ekstra_wajib`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_frasa_awal`
--

DROP TABLE IF EXISTS `m_frasa_awal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_frasa_awal` (
  `id_frasa_awal` int(11) NOT NULL AUTO_INCREMENT,
  `frasa` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_frasa_awal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_hobi`
--

DROP TABLE IF EXISTS `m_hobi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_hobi` (
  `nama` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_instrumen_supervisi_mengajar`
--

DROP TABLE IF EXISTS `m_instrumen_supervisi_mengajar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_instrumen_supervisi_mengajar` (
  `bagian` int(1) DEFAULT NULL,
  `nomor` int(2) DEFAULT NULL,
  `instrumen` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_jarak`
--

DROP TABLE IF EXISTS `m_jarak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_jarak` (
  `jarak` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_jenis_pengeluaran`
--

DROP TABLE IF EXISTS `m_jenis_pengeluaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_jenis_pengeluaran` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` text COLLATE utf8_unicode_ci NOT NULL,
  `sumber` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_kelas`
--

DROP TABLE IF EXISTS `m_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_kelompok_mapel`
--

DROP TABLE IF EXISTS `m_kelompok_mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_kelompok_mapel` (
  `id_kelompok_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `no_urut` int(11) NOT NULL,
  `kelompok_mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kelompok_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_kepala`
--

DROP TABLE IF EXISTS `m_kepala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_kepala` (
  `id_kepala` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `posisi_x` int(3) NOT NULL,
  `posisi_y` int(2) NOT NULL,
  `lebar` int(3) NOT NULL,
  `tinggi` int(3) NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `px_uts` int(3) NOT NULL,
  `py_uts` int(3) NOT NULL,
  `l_uts` int(3) NOT NULL,
  `t_uts` int(3) NOT NULL,
  `px_kartu` int(3) NOT NULL,
  `py_kartu` int(3) NOT NULL,
  `l_kartu` int(3) NOT NULL,
  `t_kartu` int(3) NOT NULL,
  `px_rapor` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `py_rapor` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l_rapor` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `t_rapor` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_kepala`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_kode_surat`
--

DROP TABLE IF EXISTS `m_kode_surat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_kode_surat` (
  `kd` int(11) NOT NULL AUTO_INCREMENT,
  `kode_surat` varchar(20) CHARACTER SET latin1 NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`kd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_kredit`
--

DROP TABLE IF EXISTS `m_kredit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_kredit` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kode` varchar(3) CHARACTER SET latin1 NOT NULL,
  `nama_pelanggaran` text CHARACTER SET latin1 NOT NULL,
  `point` int(3) NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `jenis` int(1) DEFAULT NULL,
  `butir` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_logo`
--

DROP TABLE IF EXISTS `m_logo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_logo` (
  `id_logo` int(11) NOT NULL AUTO_INCREMENT,
  `posisi_y` int(2) NOT NULL,
  `lebar` int(3) NOT NULL,
  `tinggi` int(3) NOT NULL,
  `pilihan` varchar(1) NOT NULL,
  `ttd` enum('0','1') NOT NULL,
  PRIMARY KEY (`id_logo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_macam_perangkat`
--

DROP TABLE IF EXISTS `m_macam_perangkat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_macam_perangkat` (
  `sub` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nomor` int(2) NOT NULL,
  `perangkat` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipe` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_macam_perangkat_k13`
--

DROP TABLE IF EXISTS `m_macam_perangkat_k13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_macam_perangkat_k13` (
  `sub` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nomor` int(2) NOT NULL,
  `perangkat` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipe` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_mapel`
--

DROP TABLE IF EXISTS `m_mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_mapel` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `program` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kkm` int(2) NOT NULL,
  `ranah` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut_rapor` int(2) NOT NULL,
  `cacah_ulangan_harian` int(1) NOT NULL,
  `cacah_tugas` int(1) NOT NULL,
  `bobot_ulangan_harian` int(2) NOT NULL,
  `bobot_tugas` int(2) NOT NULL,
  `bobot_mid` int(2) NOT NULL,
  `bobot_semester` int(2) NOT NULL,
  `jam` int(1) NOT NULL,
  `adamid` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `kkm_uh1` int(3) NOT NULL,
  `kkm_uh2` int(3) NOT NULL,
  `kkm_uh3` int(3) NOT NULL,
  `kkm_uh4` int(3) NOT NULL,
  `kkm_mid` int(3) NOT NULL,
  `kkm_uas` int(3) NOT NULL,
  `nsoal_uh1` int(3) NOT NULL,
  `nsoal_uh2` int(3) NOT NULL,
  `nsoal_uh3` int(3) NOT NULL,
  `nsoal_uh4` int(3) NOT NULL,
  `nsoal_mid` int(3) NOT NULL,
  `nsoal_uas` int(3) NOT NULL,
  `skor_uh1` float(5,2) NOT NULL,
  `skor_uh2` float(5,2) NOT NULL,
  `skor_uh3` float(5,2) NOT NULL,
  `skor_uh4` float(5,2) NOT NULL,
  `skor_mid` float(5,2) NOT NULL,
  `skor_uas` float(5,2) NOT NULL,
  `hari_tatap_muka` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `jam_ke` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuh1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuh2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuh3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuh4` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kuncimid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kunciuas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `materi1` text COLLATE utf8_unicode_ci NOT NULL,
  `materi2` text COLLATE utf8_unicode_ci NOT NULL,
  `materi3` text COLLATE utf8_unicode_ci NOT NULL,
  `materi4` text COLLATE utf8_unicode_ci NOT NULL,
  `materi5` text COLLATE utf8_unicode_ci NOT NULL,
  `materi6` text COLLATE utf8_unicode_ci NOT NULL,
  `materi7` text COLLATE utf8_unicode_ci,
  `materi8` text COLLATE utf8_unicode_ci,
  `materi9` text COLLATE utf8_unicode_ci,
  `materi10` text COLLATE utf8_unicode_ci,
  `kelompok` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `jenis_deskripsi` int(1) NOT NULL,
  `keterampilan1` text COLLATE utf8_unicode_ci NOT NULL,
  `keterampilan2` text COLLATE utf8_unicode_ci NOT NULL,
  `kuncibuh1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibuh2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibuh3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibuh4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibmid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kuncibuas` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_maks_bagian_a_uh1` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_uh2` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_uh3` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_uh4` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_mid` int(3) DEFAULT NULL,
  `nilai_maks_bagian_a_uas` int(3) DEFAULT NULL,
  `nsoal_b_uh1` int(3) DEFAULT NULL,
  `nsoal_b_uh2` int(3) DEFAULT NULL,
  `nsoal_b_uh3` int(3) DEFAULT NULL,
  `nsoal_b_uh4` int(3) DEFAULT NULL,
  `nsoal_b_mid` int(3) DEFAULT NULL,
  `nsoal_b_uas` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uh1` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uh2` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uh3` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uh4` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_mid` int(3) DEFAULT NULL,
  `nilai_maks_bagian_b_uas` int(3) DEFAULT NULL,
  `nkuis` tinyint(1) DEFAULT NULL,
  `bobot_kuis` int(2) DEFAULT NULL,
  `sertifikasi` tinyint(1) NOT NULL DEFAULT '1',
  `batas1` int(2) NOT NULL,
  `batas2` int(2) NOT NULL,
  `batas3` int(2) NOT NULL,
  `batas4` int(2) NOT NULL,
  `batas5` int(2) NOT NULL,
  `batas6` int(2) NOT NULL,
  `pilihan` int(1) NOT NULL DEFAULT '0',
  `cukup` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '70',
  `baik` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '80',
  `sangat` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '90',
  `p1` text COLLATE utf8_unicode_ci,
  `p2` text COLLATE utf8_unicode_ci,
  `p3` text COLLATE utf8_unicode_ci,
  `p4` text COLLATE utf8_unicode_ci,
  `p5` text COLLATE utf8_unicode_ci,
  `p6` text COLLATE utf8_unicode_ci,
  `p7` text COLLATE utf8_unicode_ci,
  `p8` text COLLATE utf8_unicode_ci,
  `p9` text COLLATE utf8_unicode_ci,
  `p10` text COLLATE utf8_unicode_ci,
  `p11` text COLLATE utf8_unicode_ci,
  `p12` text COLLATE utf8_unicode_ci,
  `p13` text COLLATE utf8_unicode_ci,
  `p14` text COLLATE utf8_unicode_ci,
  `p15` text COLLATE utf8_unicode_ci,
  `p16` text COLLATE utf8_unicode_ci,
  `p17` text COLLATE utf8_unicode_ci,
  `p18` text COLLATE utf8_unicode_ci,
  `np` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s1` text COLLATE utf8_unicode_ci,
  `s2` text COLLATE utf8_unicode_ci,
  `s3` text COLLATE utf8_unicode_ci,
  `s4` text COLLATE utf8_unicode_ci,
  `s5` text COLLATE utf8_unicode_ci,
  `s6` text COLLATE utf8_unicode_ci,
  `s7` text COLLATE utf8_unicode_ci,
  `s8` text COLLATE utf8_unicode_ci,
  `s9` text COLLATE utf8_unicode_ci,
  `s10` text COLLATE utf8_unicode_ci,
  `s11` text COLLATE utf8_unicode_ci,
  `s12` text COLLATE utf8_unicode_ci,
  `s13` text COLLATE utf8_unicode_ci,
  `s14` text COLLATE utf8_unicode_ci,
  `s15` text COLLATE utf8_unicode_ci,
  `ns` int(2) DEFAULT NULL,
  `subjects_value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ard` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bobot_praktik` int(3) DEFAULT NULL,
  `bobot_projek` int(3) DEFAULT NULL,
  `bobot_portofolio` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_mapel_emiss`
--

DROP TABLE IF EXISTS `m_mapel_emiss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_mapel_emiss` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mapel` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_mapel_ijazah`
--

DROP TABLE IF EXISTS `m_mapel_ijazah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_mapel_ijazah` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mapel` text COLLATE utf8_unicode_ci,
  `cacah_semester` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jurusan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_urut` int(2) NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `komponen` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `teks_mapel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_mapel_rapor`
--

DROP TABLE IF EXISTS `m_mapel_rapor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_mapel_rapor` (
  `id_mapel_rapor` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) NOT NULL,
  `semester` varchar(1) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `komponen` varchar(2) NOT NULL,
  `no_urut` int(2) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `nama_mapel_portal` varchar(100) NOT NULL,
  `pilihan` int(11) NOT NULL,
  `urut_smptn` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_mapel_rapor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_mapel_skbk`
--

DROP TABLE IF EXISTS `m_mapel_skbk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_mapel_skbk` (
  `id_mapel_skbk` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_mapel_skbk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_pekerjaan`
--

DROP TABLE IF EXISTS `m_pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pekerjaan` text COLLATE utf8_unicode_ci NOT NULL,
  `kode_pekerjaan` varchar(2) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_pengampu_ekstra`
--

DROP TABLE IF EXISTS `m_pengampu_ekstra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_pengampu_ekstra` (
  `id_pengampu_ekstra` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `namaekstra` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `wajib` int(1) NOT NULL,
  PRIMARY KEY (`id_pengampu_ekstra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_prakarya`
--

DROP TABLE IF EXISTS `m_prakarya`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_prakarya` (
  `id_prakarya` int(11) NOT NULL AUTO_INCREMENT,
  `mapel` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_prakarya`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_predikat`
--

DROP TABLE IF EXISTS `m_predikat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_predikat` (
  `id_predikat` int(11) NOT NULL AUTO_INCREMENT,
  `penilaian` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `batas` int(2) NOT NULL,
  `konversi` float(5,2) NOT NULL,
  `predikat` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `positif` int(1) NOT NULL,
  `keterangan2` text COLLATE utf8_unicode_ci,
  `predikat_2015` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_predikat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_program`
--

DROP TABLE IF EXISTS `m_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kode_uambnbk` int(11) DEFAULT NULL,
  `category_majors_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_referensi`
--

DROP TABLE IF EXISTS `m_referensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_referensi` (
  `id_referensi` int(11) NOT NULL AUTO_INCREMENT,
  `opsi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `nilai` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keterangan` text,
  PRIMARY KEY (`id_referensi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_ruang`
--

DROP TABLE IF EXISTS `m_ruang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_ruang` (
  `id_ruang` int(11) NOT NULL AUTO_INCREMENT,
  `tingkat` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `program` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `ruang` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `no_tengah` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ruang_tes_satu` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ruang_tes_dua` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `category_majors_id` int(11) DEFAULT NULL,
  `school_class_name` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ruang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_sekolah`
--

DROP TABLE IF EXISTS `m_sekolah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kode` varchar(1) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_sikap_spiritual`
--

DROP TABLE IF EXISTS `m_sikap_spiritual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_sikap_spiritual` (
  `id_sikap_spiritual` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `golongan` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_sikap_spiritual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_tapel`
--

DROP TABLE IF EXISTS `m_tapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_tapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `awal` date NOT NULL,
  `akhir1` date NOT NULL,
  `awal2` date NOT NULL,
  `akhir2` date NOT NULL,
  `aktif` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_transportasi`
--

DROP TABLE IF EXISTS `m_transportasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_transportasi` (
  `nama` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_tugas_tambahan`
--

DROP TABLE IF EXISTS `m_tugas_tambahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_tugas_tambahan` (
  `id_tugas_tambahan` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_tugas_tambahan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tugas_tambahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_uang`
--

DROP TABLE IF EXISTS `m_uang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_uang` (
  `kd` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `nomor_urut` int(4) DEFAULT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_uang_besar`
--

DROP TABLE IF EXISTS `m_uang_besar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_uang_besar` (
  `id_uang_besar` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `macam_pembayaran` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `besar` int(7) NOT NULL,
  `nomor_urut` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_uang_besar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_walikelas`
--

DROP TABLE IF EXISTS `m_walikelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_walikelas` (
  `id_walikelas` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kurikulum` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_urut` int(2) DEFAULT NULL,
  `kode_rombel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_walikelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mapel_uambn`
--

DROP TABLE IF EXISTS `mapel_uambn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mapel_uambn` (
  `id_mapel_uambn` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `program` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nmapel` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(2) NOT NULL,
  PRIMARY KEY (`id_mapel_uambn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mapel_un`
--

DROP TABLE IF EXISTS `mapel_un`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mapel_un` (
  `id_mapel_un` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `program` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nmapel` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(2) NOT NULL,
  `pilihan` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mapel_un`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nama_tes`
--

DROP TABLE IF EXISTS `nama_tes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nama_tes` (
  `id_nama_tes` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `nama_tes` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pelaksanaan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_nama_tes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nilai`
--

DROP TABLE IF EXISTS `nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai` (
  `kd` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kd_mapel` int(2) DEFAULT NULL,
  `no_urut` int(2) DEFAULT NULL,
  `nilai_uh1` float(6,2) DEFAULT NULL,
  `nilai_uh2` float(6,2) DEFAULT NULL,
  `nilai_uh3` float(6,2) DEFAULT NULL,
  `nilai_uh4` float(6,2) DEFAULT NULL,
  `nilai_ruh` decimal(6,2) DEFAULT NULL,
  `nilai_tu1` int(3) DEFAULT NULL,
  `nilai_tu2` int(3) DEFAULT NULL,
  `nilai_tu3` int(3) DEFAULT NULL,
  `nilai_tu4` int(3) DEFAULT NULL,
  `nilai_tu5` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu6` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu7` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu8` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu9` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu10` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_rtu` decimal(6,2) DEFAULT NULL,
  `nilai_nh` decimal(6,2) DEFAULT NULL,
  `nilai_mid` decimal(6,2) DEFAULT NULL,
  `nilai_uas` decimal(6,2) DEFAULT NULL,
  `nilai_na` decimal(6,2) DEFAULT NULL,
  `nilai_nr` int(3) DEFAULT NULL,
  `psikomotor` int(3) DEFAULT NULL,
  `afektif` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  `kog` int(3) DEFAULT NULL,
  `psi` int(3) DEFAULT NULL,
  `afe` int(11) DEFAULT NULL,
  `nilai_ku1` int(3) DEFAULT NULL,
  `nilai_ku2` int(3) DEFAULT NULL,
  `nilai_ku3` int(3) DEFAULT NULL,
  `nilai_ku4` int(3) DEFAULT NULL,
  `nilai_rku` float(6,2) DEFAULT NULL,
  `rapor` tinyint(4) NOT NULL DEFAULT '0',
  `id_mapel` int(11) NOT NULL,
  `kunci` char(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `ket_akhir` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_uh5` float(6,2) DEFAULT NULL,
  `nilai_uh6` float(6,2) DEFAULT NULL,
  `nilai_uh7` float(6,2) DEFAULT NULL,
  `nilai_uh8` float(6,2) DEFAULT NULL,
  `nilai_uh9` float(6,2) DEFAULT NULL,
  `nilai_uh10` float(6,2) DEFAULT NULL,
  `p1` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p2` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p3` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p4` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p5` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p6` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p7` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p8` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p9` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p10` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p11` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p12` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p13` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p14` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p15` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p16` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p17` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p18` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `np` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci,
  `chat_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rata` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `rata_rapor` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s1` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s2` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s3` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s4` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s5` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s6` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s7` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s8` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s9` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s10` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s11` int(1) DEFAULT NULL,
  `s12` int(1) DEFAULT NULL,
  `s13` int(1) DEFAULT NULL,
  `s14` int(1) DEFAULT NULL,
  `s15` int(1) DEFAULT NULL,
  `deskripsi_sikap` text COLLATE utf8_unicode_ci,
  `student_value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nilai_akhlak`
--

DROP TABLE IF EXISTS `nilai_akhlak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_akhlak` (
  `id_nilai_akhlak` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(1) CHARACTER SET latin1 NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) CHARACTER SET latin1 NOT NULL,
  `no_urut` int(2) NOT NULL,
  `kelas` varchar(15) CHARACTER SET latin1 NOT NULL,
  `satu` int(1) NOT NULL DEFAULT '3',
  `kom1` text CHARACTER SET latin1 NOT NULL,
  `dua` int(1) NOT NULL DEFAULT '3',
  `kom2` text CHARACTER SET latin1 NOT NULL,
  `tiga` int(1) NOT NULL DEFAULT '3',
  `kom3` text CHARACTER SET latin1 NOT NULL,
  `empat` int(1) NOT NULL DEFAULT '3',
  `kom4` text CHARACTER SET latin1 NOT NULL,
  `lima` int(1) NOT NULL DEFAULT '3',
  `kom5` text CHARACTER SET latin1 NOT NULL,
  `enam` int(1) NOT NULL DEFAULT '3',
  `kom6` text CHARACTER SET latin1 NOT NULL,
  `tujuh` int(1) NOT NULL DEFAULT '3',
  `kom7` text CHARACTER SET latin1 NOT NULL,
  `delapan` int(1) NOT NULL DEFAULT '3',
  `kom8` text CHARACTER SET latin1 NOT NULL,
  `sembilan` int(1) NOT NULL DEFAULT '3',
  `kom9` text CHARACTER SET latin1 NOT NULL,
  `sepuluh` int(1) NOT NULL DEFAULT '3',
  `kom10` text CHARACTER SET latin1 NOT NULL,
  `status` varchar(5) CHARACTER SET latin1 NOT NULL,
  `i11` int(1) DEFAULT NULL,
  `i12` int(1) DEFAULT NULL,
  `i13` int(1) DEFAULT NULL,
  `i14` int(1) DEFAULT NULL,
  `i15` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_nilai_akhlak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nilai_buang`
--

DROP TABLE IF EXISTS `nilai_buang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_buang` (
  `kd` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kd_mapel` int(2) DEFAULT NULL,
  `no_urut` int(2) DEFAULT NULL,
  `nilai_uh1` float(6,2) DEFAULT NULL,
  `nilai_uh2` float(6,2) DEFAULT NULL,
  `nilai_uh3` float(6,2) DEFAULT NULL,
  `nilai_uh4` float(6,2) DEFAULT NULL,
  `nilai_ruh` decimal(6,2) DEFAULT NULL,
  `nilai_tu1` int(3) DEFAULT NULL,
  `nilai_tu2` int(3) DEFAULT NULL,
  `nilai_tu3` int(3) DEFAULT NULL,
  `nilai_tu4` int(3) DEFAULT NULL,
  `nilai_tu5` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu6` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu7` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu8` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu9` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu10` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_rtu` decimal(6,2) DEFAULT NULL,
  `nilai_nh` decimal(6,2) DEFAULT NULL,
  `nilai_mid` decimal(6,2) DEFAULT NULL,
  `nilai_uas` decimal(6,2) DEFAULT NULL,
  `nilai_na` decimal(6,2) DEFAULT NULL,
  `nilai_nr` int(3) DEFAULT NULL,
  `psikomotor` int(3) DEFAULT NULL,
  `afektif` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  `kog` int(3) DEFAULT NULL,
  `psi` int(3) DEFAULT NULL,
  `afe` int(11) DEFAULT NULL,
  `nilai_ku1` int(3) DEFAULT NULL,
  `nilai_ku2` int(3) DEFAULT NULL,
  `nilai_ku3` int(3) DEFAULT NULL,
  `nilai_ku4` int(3) DEFAULT NULL,
  `nilai_rku` float(6,2) DEFAULT NULL,
  `rapor` tinyint(4) NOT NULL DEFAULT '0',
  `id_mapel` int(11) NOT NULL,
  `kunci` char(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `ket_akhir` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_uh5` float(6,2) DEFAULT NULL,
  `nilai_uh6` float(6,2) DEFAULT NULL,
  `nilai_uh7` float(6,2) DEFAULT NULL,
  `nilai_uh8` float(6,2) DEFAULT NULL,
  `nilai_uh9` float(6,2) DEFAULT NULL,
  `nilai_uh10` float(6,2) DEFAULT NULL,
  `p1` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p2` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p3` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p4` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p5` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p6` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p7` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p8` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p9` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p10` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p11` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p12` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p13` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p14` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p15` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p16` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p17` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p18` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `np` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci,
  `chat_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rata` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `rata_rapor` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nilai_pilihan`
--

DROP TABLE IF EXISTS `nilai_pilihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_pilihan` (
  `kd` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kd_mapel` int(2) DEFAULT NULL,
  `no_urut` int(2) DEFAULT NULL,
  `nilai_uh1` float(6,2) DEFAULT NULL,
  `nilai_uh2` float(6,2) DEFAULT NULL,
  `nilai_uh3` float(6,2) DEFAULT NULL,
  `nilai_uh4` float(6,2) DEFAULT NULL,
  `nilai_ruh` decimal(6,2) DEFAULT NULL,
  `nilai_tu1` int(3) DEFAULT NULL,
  `nilai_tu2` int(3) DEFAULT NULL,
  `nilai_tu3` int(3) DEFAULT NULL,
  `nilai_tu4` int(3) DEFAULT NULL,
  `nilai_tu5` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu6` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu7` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu8` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu9` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_tu10` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_rtu` decimal(6,2) DEFAULT NULL,
  `nilai_nh` decimal(6,2) DEFAULT NULL,
  `nilai_mid` decimal(6,2) DEFAULT NULL,
  `nilai_uas` decimal(6,2) DEFAULT NULL,
  `nilai_na` decimal(6,2) DEFAULT NULL,
  `nilai_nr` int(3) DEFAULT NULL,
  `psikomotor` int(3) DEFAULT NULL,
  `afektif` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  `kog` int(3) DEFAULT NULL,
  `psi` int(3) DEFAULT NULL,
  `afe` int(11) DEFAULT NULL,
  `nilai_ku1` int(3) DEFAULT NULL,
  `nilai_ku2` int(3) DEFAULT NULL,
  `nilai_ku3` int(3) DEFAULT NULL,
  `nilai_ku4` int(3) DEFAULT NULL,
  `nilai_rku` float(6,2) DEFAULT NULL,
  `rapor` tinyint(4) NOT NULL DEFAULT '0',
  `id_mapel` int(11) NOT NULL,
  `kunci` char(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `ket_akhir` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_uh5` float(6,2) DEFAULT NULL,
  `nilai_uh6` float(6,2) DEFAULT NULL,
  `nilai_uh7` float(6,2) DEFAULT NULL,
  `nilai_uh8` float(6,2) DEFAULT NULL,
  `nilai_uh9` float(6,2) DEFAULT NULL,
  `nilai_uh10` float(6,2) DEFAULT NULL,
  `p1` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p2` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p3` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p4` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p5` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p6` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p7` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p8` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p9` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p10` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p11` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p12` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p13` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p14` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p15` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p16` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p17` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p18` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `np` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci,
  `chat_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rata` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `rata_rapor` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nilai_praktik`
--

DROP TABLE IF EXISTS `nilai_praktik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_praktik` (
  `thnajaran` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `ruang` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nis` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nilai_remidi`
--

DROP TABLE IF EXISTS `nilai_remidi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_remidi` (
  `id_nilai_remidi` int(11) NOT NULL AUTO_INCREMENT,
  `kd` int(11) NOT NULL,
  `ulangan` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` int(11) NOT NULL,
  `nilai_uh` tinyint(3) NOT NULL,
  PRIMARY KEY (`id_nilai_remidi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nilai_ujian`
--

DROP TABLE IF EXISTS `nilai_ujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_ujian` (
  `id_nilai_ujian` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `ruang` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(2) NOT NULL,
  `nis` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` decimal(6,2) NOT NULL,
  `praktik` decimal(6,2) NOT NULL,
  `oleh` int(1) NOT NULL,
  `d` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `b` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `c` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `t` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_nilai_ujian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nilai_un`
--

DROP TABLE IF EXISTS `nilai_un`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_un` (
  `nis` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `un` float(5,2) NOT NULL,
  `ns` float(5,2) NOT NULL,
  `na` float(5,2) NOT NULL,
  `no_urut` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nomor_skbk_skmt`
--

DROP TABLE IF EXISTS `nomor_skbk_skmt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nomor_skbk_skmt` (
  `id_nomor_skbk` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_skbk` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_skmt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pengawas` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_aktif` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_aktif` date DEFAULT NULL,
  `tanggal_supervisi` date DEFAULT NULL,
  PRIMARY KEY (`id_nomor_skbk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `non_komite_bayar`
--

DROP TABLE IF EXISTS `non_komite_bayar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `non_komite_bayar` (
  `id_siswa_bayar` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `nis` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `id_non_komite` bigint(20) NOT NULL,
  `besar` int(8) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_siswa_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `non_komite_besar`
--

DROP TABLE IF EXISTS `non_komite_besar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `non_komite_besar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_non_komite` int(11) NOT NULL,
  `besar` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `non_komite_macam`
--

DROP TABLE IF EXISTS `non_komite_macam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `non_komite_macam` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_tunggakan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `outbox`
--

DROP TABLE IF EXISTS `outbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DestinationNumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TextDecoded` text COLLATE utf8_unicode_ci NOT NULL,
  `id_sms_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_berkas`
--

DROP TABLE IF EXISTS `p_berkas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_berkas` (
  `id_berkas` bigint(20) NOT NULL AUTO_INCREMENT,
  `kd` text,
  `nama_berkas` text,
  `berkas` text,
  PRIMARY KEY (`id_berkas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_jabatan`
--

DROP TABLE IF EXISTS `p_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpegawai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama_jabatan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `golongan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gaji_pokok` int(8) NOT NULL,
  `pejabat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nomor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_sk` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_keluar_negeri`
--

DROP TABLE IF EXISTS `p_keluar_negeri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_keluar_negeri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpegawai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `negara` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tujuan_kunjungan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pembiaya` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_keluarga`
--

DROP TABLE IF EXISTS `p_keluarga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_keluarga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 NOT NULL,
  `jenkel` varchar(2) CHARACTER SET latin1 NOT NULL,
  `hubungan` text CHARACTER SET latin1 NOT NULL,
  `tempat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tanggallahir` date NOT NULL,
  `status` varchar(1) CHARACTER SET latin1 NOT NULL,
  `urut` int(2) NOT NULL,
  `tanggal_nikah` date NOT NULL,
  `pekerjaan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_pisah` date NOT NULL,
  `akta_kelahiran` text COLLATE utf8_unicode_ci,
  `kis` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_kepegawaian`
--

DROP TABLE IF EXISTS `p_kepegawaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_kepegawaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urut` int(4) NOT NULL,
  `idpegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `jenis_sk` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `pejabat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `instansi` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL,
  `nomorsurat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `uraian` text CHARACTER SET latin1 NOT NULL,
  `tmt` date NOT NULL,
  `pangkat` varchar(50) CHARACTER SET latin1 NOT NULL,
  `jabatan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `gol` varchar(10) CHARACTER SET latin1 NOT NULL,
  `gapok` int(7) NOT NULL,
  `tahun` int(2) NOT NULL,
  `bulan` int(2) NOT NULL,
  `aktif` varchar(1) CHARACTER SET latin1 NOT NULL,
  `status_tugas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `golongan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_keaktifan` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status_kepegawaian` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `instansi_yang_mengangkat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pendataan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pak` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `berkas` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_organisasi`
--

DROP TABLE IF EXISTS `p_organisasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_organisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tingkat` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nama_organisasi` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tahun_awal` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `tahun_akhir` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `tempat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nama_pimpinan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kedudukan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_pegawai`
--

DROP TABLE IF EXISTS `p_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_pegawai` (
  `id_p_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `kd` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nip` varchar(18) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tempat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tanggallahir` date NOT NULL,
  `jenkel` varchar(2) CHARACTER SET latin1 NOT NULL,
  `usiapensiun` int(2) NOT NULL,
  `tanggalpensiun` date NOT NULL,
  `ayah` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ibu` varchar(100) CHARACTER SET latin1 NOT NULL,
  `alamatortu` text CHARACTER SET latin1 NOT NULL,
  `alamat` text CHARACTER SET latin1 NOT NULL,
  `telpon` varchar(20) CHARACTER SET latin1 NOT NULL,
  `seluler` varchar(20) CHARACTER SET latin1 NOT NULL,
  `bangsa` varchar(50) CHARACTER SET latin1 NOT NULL,
  `agama` varchar(12) CHARACTER SET latin1 NOT NULL,
  `ayahmertua` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ibumertua` varchar(50) CHARACTER SET latin1 NOT NULL,
  `alamatmertua` varchar(254) CHARACTER SET latin1 NOT NULL,
  `nuptk` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nrg` varchar(100) CHARACTER SET latin1 NOT NULL,
  `npwp` varchar(100) CHARACTER SET latin1 NOT NULL,
  `kgb_pertama` date NOT NULL,
  `kgb` date NOT NULL,
  `kgb_yad` date NOT NULL,
  `kgb_sms` date NOT NULL,
  `nama_tanpa_gelar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gelar_depan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gelar_belakang` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_perkawinan` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cacah_anak_kandung` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `jalan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rt` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `rw` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `desa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kecamatan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kabupaten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `provinsi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jenis_tempat_tinggal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `golongan_darah` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `karpeg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `askes` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `taspen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `karis_karsu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama_ibu_kandung` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nik` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sudah_sertifikasi` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `no_peserta_sertifikasi` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `no_sertifikat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lulus_sertifikasi` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_lulus_sertifikasi` date NOT NULL,
  `mapel_sertifikasi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tugas_pokok` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tugas_utama_non_guru` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tugas_tambahan_non_guru` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kodepos` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kpe` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tb` int(3) NOT NULL,
  `bb` int(3) NOT NULL,
  `rambut` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bentuk_muka` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `warna_kulit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ciri_khas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cacat_tubuh` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kegemaran` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nip_lama` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `tandatangan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `status_kepegawaian` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `guru` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kode_mapel_sertifikasi` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut_padamu` int(3) NOT NULL,
  `tmt_guru` date NOT NULL,
  `pegid` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status_inpassing` tinyint(1) DEFAULT NULL,
  `tmt_inpassing` date DEFAULT NULL,
  `status_tempat_tugas` tinyint(1) DEFAULT NULL,
  `status_penerima_tpg` tinyint(1) DEFAULT NULL,
  `tpg_pertama` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `besar_tpg_terakhir` int(11) DEFAULT NULL,
  `besar_tpg_pertama` int(11) DEFAULT NULL,
  `tmt_di_sekolah` date NOT NULL,
  `id_sms_user` int(11) DEFAULT NULL,
  `tanggal_sertifikat` date NOT NULL,
  `bank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_rekening_bank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama_rekening_bank` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_sk_dirjen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `madrasah_induk` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `npk` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `efin` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_mapel_utama` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jalur_sertifikasi` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_lptk` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emiss` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `chat_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `berkas_nip` text COLLATE utf8_unicode_ci,
  `berkas_ktp` text COLLATE utf8_unicode_ci,
  `berkas_karpeg` text COLLATE utf8_unicode_ci,
  `berkas_kpe` text COLLATE utf8_unicode_ci,
  `berkas_askes` text COLLATE utf8_unicode_ci,
  `berkas_taspen` text COLLATE utf8_unicode_ci,
  `berkas_karsu` text COLLATE utf8_unicode_ci,
  `berkas_npwp` text COLLATE utf8_unicode_ci,
  `berkas_rekening` text COLLATE utf8_unicode_ci,
  `berkas_akta_nikah` text COLLATE utf8_unicode_ci,
  `berkas_akta_cerai` text COLLATE utf8_unicode_ci,
  `berkas_sertifikat_pendidik` text COLLATE utf8_unicode_ci,
  `berkas_kartu_keluarga` text COLLATE utf8_unicode_ci,
  `id_desa` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_p_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_pendidikan`
--

DROP TABLE IF EXISTS `p_pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_pendidikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tingkat` varchar(50) CHARACTER SET latin1 NOT NULL,
  `namasekolah` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tahunlulus` int(4) NOT NULL,
  `tanggalijazah` date NOT NULL,
  `nomorijazah` varchar(50) CHARACTER SET latin1 NOT NULL,
  `fakultas` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jurusan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alamatsekolah` text COLLATE utf8_unicode_ci NOT NULL,
  `namakepala` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `akta` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pendataan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gelar` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kelprodi` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `berkas` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_penghargaan`
--

DROP TABLE IF EXISTS `p_penghargaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_penghargaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpegawai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama_penghargaan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tahun_perolehan` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `pemberi_penghargaan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_sertifikat`
--

DROP TABLE IF EXISTS `p_sertifikat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_sertifikat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpegawai` varchar(50) CHARACTER SET latin1 NOT NULL,
  `jenis` varchar(20) CHARACTER SET latin1 NOT NULL,
  `instansi` text CHARACTER SET latin1 NOT NULL,
  `tanggalsertifikat` date NOT NULL,
  `nomor` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tanggalpelaksanaan` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tempat` varchar(250) CHARACTER SET latin1 NOT NULL,
  `kegiatan` text CHARACTER SET latin1 NOT NULL,
  `jamdiklat` int(3) NOT NULL,
  `lampiran` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kode_penataran` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `penyelenggara` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `angkatan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `pendataan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `berkas` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_tugas_tambahan`
--

DROP TABLE IF EXISTS `p_tugas_tambahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_tugas_tambahan` (
  `id_tambahan` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `nama_tugas` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jtm` int(2) NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tpg` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `daftar_berkas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tambahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p_tugas_tambahan_luar`
--

DROP TABLE IF EXISTS `p_tugas_tambahan_luar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_tugas_tambahan_luar` (
  `id_tambahan` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `nama_tugas` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama_sekolah` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jtm` int(2) NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `npsn` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_tambahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pejabat_penilai`
--

DROP TABLE IF EXISTS `pejabat_penilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pejabat_penilai` (
  `id_pejabat` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `dinilai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama_penilai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nip_penilai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unit_organisasi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama_atasan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nip_atasan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pangkat_golongan_atasan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan_atasan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unit_organisasi_atasan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_pejabat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pemberitahuan`
--

DROP TABLE IF EXISTS `pemberitahuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemberitahuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `ke` int(1) NOT NULL,
  `tindakan_walikelas` text COLLATE utf8_unicode_ci NOT NULL,
  `tindakan_bp` text COLLATE utf8_unicode_ci NOT NULL,
  `tindakan_kesiswaan` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `perilaku_pns`
--

DROP TABLE IF EXISTS `perilaku_pns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perilaku_pns` (
  `id_perilaku` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(4) NOT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bulan` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `pelayanan` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `integritas` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `komitmen` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `disiplin` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kerjasama` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kepemimpinan` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `rata` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `awal_bulan` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `akhir_bulan` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nama_penilai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nip_penilai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan_penilai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hasil_skp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_perilaku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pkg_m_indikator`
--

DROP TABLE IF EXISTS `pkg_m_indikator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pkg_m_indikator` (
  `id_pkg_m_indikator` int(11) NOT NULL AUTO_INCREMENT,
  `id_pkg_m_kompetensi` int(11) NOT NULL,
  `nourut` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `indikator` text COLLATE utf8_unicode_ci NOT NULL,
  `satu` int(1) NOT NULL,
  `dua` int(1) NOT NULL,
  PRIMARY KEY (`id_pkg_m_indikator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pkg_m_kompetensi`
--

DROP TABLE IF EXISTS `pkg_m_kompetensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pkg_m_kompetensi` (
  `id_pkg_m_kompetensi` int(11) NOT NULL AUTO_INCREMENT,
  `nourut` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `kelompok` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `kompetensi` text COLLATE utf8_unicode_ci NOT NULL,
  `untuk` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_pkg_m_kompetensi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pkg_masa`
--

DROP TABLE IF EXISTS `pkg_masa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pkg_masa` (
  `id_masa` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(4) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `aktif` int(1) NOT NULL,
  `tpejabat` date NOT NULL,
  `tybs` date NOT NULL,
  `tatasanpejabat` date NOT NULL,
  `tskp` date DEFAULT NULL,
  `tpenilaian` date DEFAULT NULL,
  PRIMARY KEY (`id_masa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pkg_parameter`
--

DROP TABLE IF EXISTS `pkg_parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pkg_parameter` (
  `id_parameter` int(11) NOT NULL AUTO_INCREMENT,
  `id_indikator` int(11) NOT NULL,
  `nourut` int(2) NOT NULL,
  `parameter` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_parameter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pkg_proses`
--

DROP TABLE IF EXISTS `pkg_proses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pkg_proses` (
  `id_pkg_proses` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_parameter` int(11) NOT NULL,
  `nilai` int(1) NOT NULL,
  PRIMARY KEY (`id_pkg_proses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pkg_t_nilai`
--

DROP TABLE IF EXISTS `pkg_t_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pkg_t_nilai` (
  `id_pkg_t_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_indikator` int(11) NOT NULL,
  `skor` int(1) NOT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tahun` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_pkg_t_nilai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pkg_tim_penilai`
--

DROP TABLE IF EXISTS `pkg_tim_penilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pkg_tim_penilai` (
  `id_tim_penilai` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kode_penilai` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_penilai` text,
  `kode_ternilai` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_tim_penilai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ppk_pns`
--

DROP TABLE IF EXISTS `ppk_pns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppk_pns` (
  `tahun` int(4) NOT NULL,
  `kode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `skp` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `pelayanan` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `integritas` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `komitmen` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `disiplin` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kerjasama` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kepemimpinan` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `rata` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `permanen` int(1) NOT NULL DEFAULT '0',
  `kepala` tinyint(1) NOT NULL DEFAULT '0',
  `pkg` tinyint(1) NOT NULL DEFAULT '0',
  `pkg_tambahan` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `batas_skp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `npk` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `tawal` date DEFAULT NULL,
  `takhir` date DEFAULT NULL,
  `skawal` int(11) DEFAULT NULL,
  `skakhir` int(11) DEFAULT NULL,
  `tambah` int(11) NOT NULL,
  `permanen_pkg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ppk_pns_kedua`
--

DROP TABLE IF EXISTS `ppk_pns_kedua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppk_pns_kedua` (
  `tahun` int(4) NOT NULL,
  `kode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `skp` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `pelayanan` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `integritas` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `komitmen` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `disiplin` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kerjasama` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kepemimpinan` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `rata` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `permanen` int(1) NOT NULL DEFAULT '0',
  `kepala` tinyint(1) NOT NULL DEFAULT '0',
  `pkg` tinyint(1) NOT NULL DEFAULT '0',
  `pkg_tambahan` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `batas_skp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `npk` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `tawal` date DEFAULT NULL,
  `takhir` date DEFAULT NULL,
  `skawal` int(11) DEFAULT NULL,
  `skakhir` int(11) DEFAULT NULL,
  `tambah` int(11) NOT NULL,
  `permanen_pkg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provinces` (
  `id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `psikomotorik`
--

DROP TABLE IF EXISTS `psikomotorik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `psikomotorik` (
  `id_psikomotor` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(10) CHARACTER SET latin1 NOT NULL,
  `kelas` varchar(10) CHARACTER SET latin1 NOT NULL,
  `mapel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `no_urut` int(2) NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  `p1` int(3) NOT NULL,
  `p2` int(3) NOT NULL,
  `p3` int(3) NOT NULL,
  `p4` int(3) NOT NULL,
  `p5` int(3) NOT NULL,
  `p6` int(3) NOT NULL,
  `p7` int(3) NOT NULL,
  `p8` int(3) NOT NULL,
  `p9` int(3) NOT NULL,
  `p10` int(3) NOT NULL,
  `p11` int(3) NOT NULL,
  `p12` int(3) NOT NULL,
  `p13` int(3) NOT NULL,
  `p14` int(3) NOT NULL,
  `p15` int(3) NOT NULL,
  `p16` int(3) NOT NULL,
  `p17` int(3) NOT NULL,
  `p18` int(3) NOT NULL,
  `nilai` decimal(6,2) NOT NULL,
  `nilai_akhir` int(3) NOT NULL,
  `status` varchar(5) CHARACTER SET latin1 NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_psikomotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rapor`
--

DROP TABLE IF EXISTS `rapor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rapor` (
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kelompok` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_urut_rapor` int(2) DEFAULT NULL,
  `no_urut` int(2) DEFAULT NULL,
  `kognitif` int(3) DEFAULT NULL,
  `pengetahuan` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `predikat_pengetahuan` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deskripsi_pengetahuan` text COLLATE utf8_unicode_ci,
  `psikomotor` int(3) DEFAULT NULL,
  `keterampilan` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `predikat_keterampilan` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deskripsi_keterampilan` text COLLATE utf8_unicode_ci,
  `predikat_sikap` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deskripsi_sikap` text COLLATE utf8_unicode_ci,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rata_rapor`
--

DROP TABLE IF EXISTS `rata_rapor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rata_rapor` (
  `nis` varchar(10) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `nilai` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `regencies`
--

DROP TABLE IF EXISTS `regencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regencies` (
  `id` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `regencies_province_id_index` (`province_id`),
  CONSTRAINT `regencies_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reset_password`
--

DROP TABLE IF EXISTS `reset_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_password` (
  `noseluler` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `kode_reset` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `server_ubk`
--

DROP TABLE IF EXISTS `server_ubk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_ubk` (
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sieka_bulanan`
--

DROP TABLE IF EXISTS `sieka_bulanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sieka_bulanan` (
  `id_sieka_bulanan` bigint(20) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `kegiatan` text,
  `id_bulanan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sieka_bulanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sieka_harian`
--

DROP TABLE IF EXISTS `sieka_harian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sieka_harian` (
  `id_sieka_harian` bigint(20) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `kegiatan` text NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_bulanan` varchar(11) NOT NULL,
  `terkirim` int(1) NOT NULL DEFAULT '0',
  `diterima` int(1) NOT NULL DEFAULT '0',
  `jam_mulai` varchar(2) DEFAULT NULL,
  `menit_mulai` varchar(2) DEFAULT NULL,
  `jam_selesai` varchar(2) DEFAULT NULL,
  `menit_selesai` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_sieka_harian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sieka_user`
--

DROP TABLE IF EXISTS `sieka_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sieka_user` (
  `nip` varchar(20) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `id_pns` varchar(11) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_absensi`
--

DROP TABLE IF EXISTS `siswa_absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_absensi` (
  `id_siswa_absensi` bigint(20) NOT NULL AUTO_INCREMENT,
  `nis` varchar(4) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL,
  `thnajaran` char(9) CHARACTER SET latin1 NOT NULL,
  `semester` char(1) CHARACTER SET latin1 NOT NULL,
  `alasan` char(1) CHARACTER SET latin1 NOT NULL,
  `keterangan` text CHARACTER SET latin1 NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `terunduh` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'T',
  `lama_terlambat` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kembali` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_siswa_absensi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_bayar`
--

DROP TABLE IF EXISTS `siswa_bayar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_bayar` (
  `id_siswa_bayar` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `nis` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `macam_pembayaran` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `besar` int(8) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_siswa_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_denah_tempat_duduk`
--

DROP TABLE IF EXISTS `siswa_denah_tempat_duduk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_denah_tempat_duduk` (
  `ruang` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `baris` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kiri1` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kiri2` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kiri3` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kiri4` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kanan1` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kanan2` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kanan3` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kanan4` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_hambatan`
--

DROP TABLE IF EXISTS `siswa_hambatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_hambatan` (
  `id_siswa_hambatan` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hambatan` text COLLATE utf8_unicode_ci NOT NULL,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_siswa_hambatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_kelas`
--

DROP TABLE IF EXISTS `siswa_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_kelas` (
  `id_siswa_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(2) NOT NULL,
  `nis` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `bsm` int(1) NOT NULL DEFAULT '0',
  `alasan_bsm` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_siswa_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_kelas_tahun`
--

DROP TABLE IF EXISTS `siswa_kelas_tahun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_kelas_tahun` (
  `id_siswa_kelas_tahun` bigint(20) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_siswa_kelas_tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_kredit`
--

DROP TABLE IF EXISTS `siswa_kredit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_kredit` (
  `id_siswa_kredit` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `semester` varchar(2) CHARACTER SET latin1 NOT NULL,
  `nis` char(4) CHARACTER SET latin1 NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kd_pelanggaran` char(3) CHARACTER SET latin1 NOT NULL,
  `point` int(3) NOT NULL,
  `tanggal` date NOT NULL,
  `entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `terunduh` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'T',
  `tindak_lanjut` text COLLATE utf8_unicode_ci NOT NULL,
  `kejadian` text COLLATE utf8_unicode_ci,
  `jenis` int(1) NOT NULL DEFAULT '0',
  `butir` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_siswa_kredit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_kredit_total`
--

DROP TABLE IF EXISTS `siswa_kredit_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_kredit_total` (
  `nis` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_nomor_tes`
--

DROP TABLE IF EXISTS `siswa_nomor_tes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_nomor_tes` (
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `no_peserta` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ruang` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `no_unik` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_nomor_tes_un`
--

DROP TABLE IF EXISTS `siswa_nomor_tes_un`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_nomor_tes_un` (
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `no_peserta` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ruang` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `no_unik` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_organisasi`
--

DROP TABLE IF EXISTS `siswa_organisasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_organisasi` (
  `id_siswa_prestasi` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `organisasi` text COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `valid` int(1) NOT NULL,
  PRIMARY KEY (`id_siswa_prestasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_penilaian_diri`
--

DROP TABLE IF EXISTS `siswa_penilaian_diri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_penilaian_diri` (
  `id_siswa_penilaian_diri` bigint(20) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `penilai` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `i1` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i2` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i3` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i4` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i5` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i6` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i7` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i8` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i9` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i10` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i11` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i12` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i13` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i14` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i15` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_siswa_penilaian_diri`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_penilaian_diri_rekap`
--

DROP TABLE IF EXISTS `siswa_penilaian_diri_rekap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_penilaian_diri_rekap` (
  `thnajaran` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `i1` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i2` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i3` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i4` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i5` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i6` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i7` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i8` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i9` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i10` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i11` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i12` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i13` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i14` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `i15` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_peringkat`
--

DROP TABLE IF EXISTS `siswa_peringkat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_peringkat` (
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` int(1) NOT NULL,
  `tingkat` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `program` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `kelas` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `nis` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_kognitif` int(4) NOT NULL,
  `jumlah_psikomotor` int(4) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `peringkat_kelas` int(3) NOT NULL,
  `peringkat_paralel` int(3) NOT NULL,
  `peringkat_kelas_kumulatif` int(3) NOT NULL,
  `peringkat_paralel_kumulatif` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_prestasi`
--

DROP TABLE IF EXISTS `siswa_prestasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_prestasi` (
  `id_siswa_prestasi` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kegiatan` text COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `valid` int(1) NOT NULL,
  `semester` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_siswa_prestasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_proses_bayar`
--

DROP TABLE IF EXISTS `siswa_proses_bayar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_proses_bayar` (
  `nis` varchar(10) NOT NULL,
  `besar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_proses_izin`
--

DROP TABLE IF EXISTS `siswa_proses_izin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_proses_izin` (
  `token` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `alasan` text COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kembali` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'T',
  `tokenmd5` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jamke` text COLLATE utf8_unicode_ci,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid` int(1) NOT NULL,
  `dispensasi` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `siswa_remisi`
--

DROP TABLE IF EXISTS `siswa_remisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_remisi` (
  `id_siswa_remisi` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `point` int(3) NOT NULL,
  PRIMARY KEY (`id_siswa_remisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `skp_pegawai`
--

DROP TABLE IF EXISTS `skp_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp_pegawai` (
  `id_skp_pegawai` bigint(20) NOT NULL AUTO_INCREMENT,
  `kodepegawai` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kegiatan` text COLLATE utf8_unicode_ci,
  `satuan` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_skp_pegawai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `skp_realisasi`
--

DROP TABLE IF EXISTS `skp_realisasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp_realisasi` (
  `id_skp_realisasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_skp` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_skp_realisasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `skp_realisasi_kedua`
--

DROP TABLE IF EXISTS `skp_realisasi_kedua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp_realisasi_kedua` (
  `id_skp_realisasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_skp` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_skp_realisasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `skp_skor`
--

DROP TABLE IF EXISTS `skp_skor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp_skor` (
  `kriteria` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `skor` float(6,3) NOT NULL,
  `golongan` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `skp_skor_guru`
--

DROP TABLE IF EXISTS `skp_skor_guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp_skor_guru` (
  `id_skp_skor_guru` int(11) NOT NULL AUTO_INCREMENT,
  `unsur` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `kode` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `kegiatan` text COLLATE utf8_unicode_ci NOT NULL,
  `ak` float(8,3) NOT NULL,
  `ak_target` float(8,3) NOT NULL,
  `ak_r` float(10,5) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `satuan` text COLLATE utf8_unicode_ci NOT NULL,
  `kualitas` int(3) NOT NULL,
  `waktu` int(3) NOT NULL,
  `satuanwaktu` text COLLATE utf8_unicode_ci NOT NULL,
  `biaya` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tahun` int(4) NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `kuantitas_r` int(3) NOT NULL,
  `kualitas_r` int(3) NOT NULL,
  `waktu_r` int(3) NOT NULL,
  `biaya_r` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perhitungan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `capaian_skp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nourut` int(2) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `golongan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cacah` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tahunan` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_skp_skor_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `skp_skor_guru_kedua`
--

DROP TABLE IF EXISTS `skp_skor_guru_kedua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp_skor_guru_kedua` (
  `id_skp_skor_guru` int(11) NOT NULL AUTO_INCREMENT,
  `unsur` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `kode` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `kegiatan` text COLLATE utf8_unicode_ci NOT NULL,
  `ak` float(8,3) NOT NULL,
  `ak_target` float(8,3) NOT NULL,
  `ak_r` float(8,3) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `satuan` text COLLATE utf8_unicode_ci NOT NULL,
  `kualitas` int(3) NOT NULL,
  `waktu` int(3) NOT NULL,
  `satuanwaktu` text COLLATE utf8_unicode_ci NOT NULL,
  `biaya` int(11) NOT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tahun` int(4) NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `kuantitas_r` int(3) NOT NULL,
  `kualitas_r` int(3) NOT NULL,
  `waktu_r` int(3) NOT NULL,
  `biaya_r` int(11) NOT NULL,
  `perhitungan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `capaian_skp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nourut` int(2) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `golongan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cacah` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_skp_skor_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `skp_skor_guru_revisi`
--

DROP TABLE IF EXISTS `skp_skor_guru_revisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp_skor_guru_revisi` (
  `id_skp_skor_guru_revisi` int(11) NOT NULL,
  `unsur` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `kode` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `kegiatan` text COLLATE utf8_unicode_ci NOT NULL,
  `ak` float(8,3) NOT NULL,
  `ak_target` float(8,3) NOT NULL,
  `ak_r` float(8,3) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `satuan` text COLLATE utf8_unicode_ci NOT NULL,
  `kualitas` int(3) NOT NULL,
  `waktu` int(3) NOT NULL,
  `satuanwaktu` text COLLATE utf8_unicode_ci NOT NULL,
  `biaya` int(11) NOT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tahun` int(4) NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `kuantitas_r` int(3) NOT NULL,
  `kualitas_r` int(3) NOT NULL,
  `waktu_r` int(3) NOT NULL,
  `biaya_r` int(11) NOT NULL,
  `perhitungan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `capaian_skp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nourut` int(2) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `golongan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cacah` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_skp_skor_guru_revisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `skp_tabel_skor`
--

DROP TABLE IF EXISTS `skp_tabel_skor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp_tabel_skor` (
  `kode` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `unsur` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `kegiatan` text COLLATE utf8_unicode_ci NOT NULL,
  `kegiatan_lengkap` text COLLATE utf8_unicode_ci NOT NULL,
  `satuan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ak` float(8,3) NOT NULL,
  `kode_resmi` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `standar_kompetensi`
--

DROP TABLE IF EXISTS `standar_kompetensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `standar_kompetensi` (
  `id_sk` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `program` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mapel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(3) NOT NULL,
  `sk` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_sk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `supervisi_mengajar_nilai`
--

DROP TABLE IF EXISTS `supervisi_mengajar_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supervisi_mengajar_nilai` (
  `id_supervisi_mengajar_nilai` bigint(20) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `supervisor` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_perangkat` int(2) NOT NULL,
  `skor` int(1) NOT NULL,
  PRIMARY KEY (`id_supervisi_mengajar_nilai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `supervisi_nilai`
--

DROP TABLE IF EXISTS `supervisi_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supervisi_nilai` (
  `id_supervisi_nilai` bigint(20) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `oleh` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_perangkat` int(2) NOT NULL,
  `skor` int(1) NOT NULL,
  `tipe` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_supervisi_nilai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `surat_keluar`
--

DROP TABLE IF EXISTS `surat_keluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `kode_surat` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nomor_surat` varchar(10) CHARACTER SET latin1 NOT NULL,
  `tahun_surat` varchar(4) CHARACTER SET latin1 NOT NULL,
  `isi_ringkas` text CHARACTER SET latin1 NOT NULL,
  `tanggal_surat` date NOT NULL,
  `kepada` varchar(200) CHARACTER SET latin1 NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_surat_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `surat_masuk`
--

DROP TABLE IF EXISTS `surat_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `kode_surat` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nomor_surat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nomor_urut` varchar(5) CHARACTER SET latin1 NOT NULL,
  `tahun_surat` varchar(4) CHARACTER SET latin1 NOT NULL,
  `tanggal_surat` date NOT NULL,
  `asal` varchar(200) CHARACTER SET latin1 NOT NULL,
  `isi` text CHARACTER SET latin1 NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_surat_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tahun_penilaian`
--

DROP TABLE IF EXISTS `tahun_penilaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tahun_penilaian` (
  `id_tahun_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `thnajaran_penilaian` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `tingkat` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tahun_penilaian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblagenda`
--

DROP TABLE IF EXISTS `tblagenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblagenda` (
  `id_agenda` int(5) NOT NULL AUTO_INCREMENT,
  `tema_agenda` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_posting` date NOT NULL,
  `tempat` varchar(150) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblberita`
--

DROP TABLE IF EXISTS `tblberita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblberita` (
  `id_berita` int(3) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(3) NOT NULL,
  `judul_berita` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `counter` int(7) NOT NULL,
  `penuh` int(1) DEFAULT NULL,
  `terbit` int(1) NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblberitautama`
--

DROP TABLE IF EXISTS `tblberitautama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblberitautama` (
  `id_berita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbldownload`
--

DROP TABLE IF EXISTS `tbldownload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldownload` (
  `id_download` int(5) NOT NULL AUTO_INCREMENT,
  `id_kat` int(5) NOT NULL,
  `judul_file` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `author` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblhasil`
--

DROP TABLE IF EXISTS `tblhasil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblhasil` (
  `id_hasil` int(10) NOT NULL AUTO_INCREMENT,
  `id_mk` int(10) NOT NULL,
  `no_soal` int(10) NOT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `salah` int(5) NOT NULL,
  `benar` int(5) NOT NULL,
  `hasil` varchar(5) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblinbox`
--

DROP TABLE IF EXISTS `tblinbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblinbox` (
  `id_inbox` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `tujuan` varchar(20) NOT NULL,
  `subjek` varchar(200) NOT NULL,
  `pesan` text NOT NULL,
  `waktu` varchar(30) NOT NULL,
  `status_pesan` varchar(1) NOT NULL,
  PRIMARY KEY (`id_inbox`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbljawabanpoll`
--

DROP TABLE IF EXISTS `tbljawabanpoll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbljawabanpoll` (
  `id_jawaban_poll` int(3) NOT NULL AUTO_INCREMENT,
  `id_soal_poll` int(3) NOT NULL,
  `jawaban` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `counter` int(5) NOT NULL,
  PRIMARY KEY (`id_jawaban_poll`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbljawabsoal`
--

DROP TABLE IF EXISTS `tbljawabsoal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbljawabsoal` (
  `id_jawaban` int(10) NOT NULL AUTO_INCREMENT,
  `id_soal` int(10) NOT NULL,
  `no_soal` int(10) NOT NULL,
  `jawaban` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `kunci` varchar(5) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_jawaban`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblkategori`
--

DROP TABLE IF EXISTS `tblkategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblkategori` (
  `id_kategori` int(3) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblkategoridownload`
--

DROP TABLE IF EXISTS `tblkategoridownload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblkategoridownload` (
  `id_kategori_download` int(3) NOT NULL AUTO_INCREMENT,
  `nama_kategori_download` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori_download`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblkategoriprofil`
--

DROP TABLE IF EXISTS `tblkategoriprofil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblkategoriprofil` (
  `id_kategori` int(3) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblkategoritutorial`
--

DROP TABLE IF EXISTS `tblkategoritutorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblkategoritutorial` (
  `id_kategori_tutorial` int(3) NOT NULL AUTO_INCREMENT,
  `parent_id` int(2) NOT NULL,
  `nama_kategori` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_kategori_tutorial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblkeluar`
--

DROP TABLE IF EXISTS `tblkeluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblkeluar` (
  `id_keluar` bigint(20) NOT NULL AUTO_INCREMENT,
  `jenis` text COLLATE utf8_unicode_ci,
  `tanggal` date DEFAULT NULL,
  `besar` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guna` text COLLATE utf8_unicode_ci,
  `keterangan` text COLLATE utf8_unicode_ci,
  `penerima` text COLLATE utf8_unicode_ci,
  `sumber` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblkomentarberita`
--

DROP TABLE IF EXISTS `tblkomentarberita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblkomentarberita` (
  `id_komen_berita` int(3) NOT NULL AUTO_INCREMENT,
  `id_berita` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `komentar` tinytext NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  PRIMARY KEY (`id_komen_berita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblkp4`
--

DROP TABLE IF EXISTS `tblkp4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblkp4` (
  `tanggal` date NOT NULL,
  `peraturan` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbllogin`
--

DROP TABLE IF EXISTS `tbllogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbllogin` (
  `username` varchar(100) NOT NULL,
  `psw` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `idlink` varchar(100) NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT 'N',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` bit(1) NOT NULL DEFAULT b'0',
  `chat_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `next_login` datetime DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblmatkul`
--

DROP TABLE IF EXISTS `tblmatkul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblmatkul` (
  `id_mk` int(10) NOT NULL AUTO_INCREMENT,
  `semester` int(2) NOT NULL,
  `kode_mk` int(10) NOT NULL,
  `nama_mk` varchar(200) NOT NULL,
  `sks` int(2) NOT NULL,
  `id_dosen` int(10) NOT NULL,
  `prasyarat` varchar(20) NOT NULL,
  `prodi` varchar(2) NOT NULL,
  PRIMARY KEY (`id_mk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblpenerimaan`
--

DROP TABLE IF EXISTS `tblpenerimaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpenerimaan` (
  `id_penerimaan` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jenis` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `besar` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_penerimaan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblpengumuman`
--

DROP TABLE IF EXISTS `tblpengumuman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpengumuman` (
  `id_pengumuman` int(5) NOT NULL AUTO_INCREMENT,
  `judul_pengumuman` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `isi` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `penulis` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_pengumuman`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblpiket`
--

DROP TABLE IF EXISTS `tblpiket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpiket` (
  `id_piket` int(11) NOT NULL AUTO_INCREMENT,
  `thnajaran` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `kejadian` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_piket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblprofil`
--

DROP TABLE IF EXISTS `tblprofil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblprofil` (
  `id_berita` int(3) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(3) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `counter` int(3) NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblsaran`
--

DROP TABLE IF EXISTS `tblsaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblsaran` (
  `id_saran` bigint(11) NOT NULL AUTO_INCREMENT,
  `nama_tamu` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nosel_tamu` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `saran` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `terproses` enum('false','true') NOT NULL DEFAULT 'false',
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_saran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblsoal`
--

DROP TABLE IF EXISTS `tblsoal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblsoal` (
  `id_soal` int(10) NOT NULL AUTO_INCREMENT,
  `no_soal` int(10) NOT NULL,
  `id_matkul` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `pertanyaan` text COLLATE latin1_general_ci NOT NULL,
  `jwb_a` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `jwb_b` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `jwb_c` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `jwb_d` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `jwb_e` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `kunci` varchar(2) COLLATE latin1_general_ci NOT NULL,
  `author` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblsoalpolling`
--

DROP TABLE IF EXISTS `tblsoalpolling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblsoalpolling` (
  `id_soal_poll` int(3) NOT NULL AUTO_INCREMENT,
  `soal_poll` text COLLATE latin1_general_ci NOT NULL,
  `status` char(1) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_soal_poll`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbltautan`
--

DROP TABLE IF EXISTS `tbltautan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbltautan` (
  `id_tautan` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `teks` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(3) NOT NULL,
  PRIMARY KEY (`id_tautan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbltutorial`
--

DROP TABLE IF EXISTS `tbltutorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbltutorial` (
  `id_tutorial` int(3) NOT NULL AUTO_INCREMENT,
  `id_kategori_tutorial` int(3) NOT NULL,
  `judul_tutorial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isi` text COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `counter` int(3) NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_tutorial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telegram`
--

DROP TABLE IF EXISTS `telegram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telegram` (
  `chat_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8_unicode_ci,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `terkirim` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tema`
--

DROP TABLE IF EXISTS `tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tema` (
  `namacss` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temauser`
--

DROP TABLE IF EXISTS `temauser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temauser` (
  `user` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `temacss` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tharitatapmuka`
--

DROP TABLE IF EXISTS `tharitatapmuka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tharitatapmuka` (
  `id_hari_tatap_muka` int(11) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(11) NOT NULL,
  `hari_tatap_muka` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `jam_ke` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kodeguru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jtm` int(2) NOT NULL,
  `jam_mulai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menit_mulai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jam_selesai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menit_selesai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thnajaran` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `semester` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rencana_hari_tatap_muka` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rencana_jam_mulai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rencana_menit_mulai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rencana_jam_selesai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rencana_menit_selesai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_hari_tatap_muka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `villages`
--

DROP TABLE IF EXISTS `villages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `villages` (
  `id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `villages_district_id_index` (`district_id`),
  CONSTRAINT `villages_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-26  5:34:24
