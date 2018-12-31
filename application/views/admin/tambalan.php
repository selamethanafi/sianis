<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: tambalan.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
/* MAN SRAGEN MAN SURUH*/
/*
$this->db->query("ALTER TABLE `datsis` ADD `sktm` VARCHAR(50) NULL AFTER `kota_sltp`");
$this->db->query("ALTER TABLE `datsis` ADD `cacah_spm` INT(1) NULL AFTER `sktm`");
$this->db->query("ALTER TABLE `datsis` ADD `cacah_mobil` INT(1) NULL AFTER `cacah_spm`");
$this->db->query("ALTER TABLE `datsis` ADD `lantai` TEXT NULL AFTER `cacah_mobil`");
$this->db->query("ALTER TABLE `datsis` ADD `dinding` TEXT NULL AFTER `lantai`");
$this->db->query("ALTER TABLE `datsis` ADD `ternak` TEXT NULL AFTER `dinding`");
$this->db->query("ALTER TABLE `datsis` ADD `elektronik` TEXT NULL AFTER `ternak`");
$this->db->query("ALTER TABLE `datsis` ADD `chat_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `elektronik`");
$this->db->query("ALTER TABLE `datsis` ADD `chat_id_valid` VARCHAR(5) NULL AFTER `chat_id`");
$this->db->query("ALTER TABLE `p_pegawai` ADD `chat_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `emiss`");
$this->db->query("ALTER TABLE `tbllogin` ADD `chat_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `valid`");
/*
CREATE TABLE `telegram` (
  `chat_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8_unicode_ci,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
*/
/*
$this->db->query("ALTER TABLE `nilai` ADD `chat_id` VARCHAR(50) NULL AFTER `deskripsi`");
$this->db->query("ALTER TABLE `tbllogin` ADD `next_login` DATETIME NULL AFTER `chat_id`");
$this->db->query("ALTER TABLE `ppk_pns` CHANGE `kode` `kode` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `pkg_tim_penilai` CHANGE `kode_penilai` `kode_penilai` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `kode_ternilai` `kode_ternilai` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL");
$this->db->query("ALTER TABLE `pkg_tim_penilai` ADD `tanggal` DATE NULL AFTER `kode_ternilai`"); 
$this->db->query("ALTER TABLE `pkg_tim_penilai` ADD `nama_penilai` TEXT NULL AFTER `kode_penilai`");
$ta = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y'");
foreach($ta->result() as $a)
{
	$kodeguru = $a->kode;
	$nama = $a->nama;
	$nip = $a->nip;
	$this->db->query("update `ppk_pns` set `kode`='$nip' where `kode`='$kodeguru'");
	$this->db->query("update `pkg_tim_penilai` set `kode_penilai`='$nip', `nama_penilai` = '$nama' where `kode_penilai`='$kodeguru'");
}

*/

/* MAN TENGARAN */
/*
$this->db->query("ALTER TABLE `ppk_pns` CHANGE `kode` `kode` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `pkg_tim_penilai` CHANGE `kode_penilai` `kode_penilai` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `kode_ternilai` `kode_ternilai` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL");
$this->db->query("ALTER TABLE `pkg_tim_penilai` ADD `tanggal` DATE NULL AFTER `kode_ternilai`"); 
$this->db->query("ALTER TABLE `pkg_tim_penilai` ADD `nama_penilai` TEXT NULL AFTER `kode_penilai`");
$ta = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y'");
foreach($ta->result() as $a)
{
	$kodeguru = $a->kode;
	$nama = $a->nama;
	$nip = $a->nip;
	$this->db->query("update `ppk_pns` set `kode`='$nip' where `kode`='$kodeguru'");
	$this->db->query("update `pkg_tim_penilai` set `kode_penilai`='$nip', `nama_penilai` = '$nama' where `kode_penilai`='$kodeguru'");
}
*/

/* SMAN 1 UNGARAN */
/*
$this->db->query("ALTER TABLE `ppk_pns` CHANGE `kode` `kode` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `pkg_tim_penilai` CHANGE `kode_penilai` `kode_penilai` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `kode_ternilai` `kode_ternilai` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL");
$this->db->query("ALTER TABLE `pkg_tim_penilai` ADD `tanggal` DATE NULL AFTER `kode_ternilai`"); 
$this->db->query("ALTER TABLE `pkg_tim_penilai` ADD `nama_penilai` TEXT NULL AFTER `kode_penilai`");
$ta = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y'");
foreach($ta->result() as $a)
{
	$kodeguru = $a->kode;
	$nama = $a->nama;
	$nip = $a->nip;
	$this->db->query("update `ppk_pns` set `kode`='$nip' where `kode`='$kodeguru'");
	$this->db->query("update `pkg_tim_penilai` set `kode_penilai`='$nip', `nama_penilai` = '$nama' where `kode_penilai`='$kodeguru'");
}
*/
/*
$this->db->query("INSERT INTO `m_referensi` (`opsi`, `nilai`) VALUES ('chat_id_admin_skp', '256939625')");
*/
/*
$this->db->query("INSERT INTO `m_referensi` (`opsi`, `nilai`) VALUES ('token_bot', '')");
$this->db->query("ALTER TABLE `ppk_pns` CHANGE `pkg_tambahan` `pkg_tambahan` VARCHAR(5) NULL");
$this->db->query("ALTER TABLE `skp_skor_guru` CHANGE `kodeguru` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `skp_realisasi` CHANGE `kodeguru` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `pkg_t_nilai` CHANGE `kodeguru` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `pkg_proses` CHANGE `kodeguru` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$ta = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y'");
foreach($ta->result() as $a)
{
	$kodeguru = $a->kode;
	$nama = $a->nama;
	$nip = $a->nip;
	$this->db->query("update `skp_skor_guru` set `nip`='$nip' where `nip`='$kodeguru'");
	$this->db->query("update `skp_realisasi` set `nip`='$nip' where `nip`='$kodeguru'");
	$this->db->query("update `pkg_t_nilai` set `nip`='$nip' where `nip`='$kodeguru'");
	$this->db->query("update `pkg_proses` set `nip`='$nip' where `nip`='$kodeguru'");
}
$this->db->query("ALTER TABLE `perilaku_pns` CHANGE `kode` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$ta = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y'");
foreach($ta->result() as $a)
{
	$kodeguru = $a->kode;
	$nama = $a->nama;
	$nip = $a->nip;
	$this->db->query("update `perilaku_pns` set `nip`='$nip' where `nip`='$kodeguru'");
}
*/
//31102017
/*
$this->db->query("ALTER TABLE `bimtik_nilai` ADD `nilai_mid` VARCHAR(5) NULL AFTER `nilai_tu10`, ADD `nilai_uas` VARCHAR(5) NULL AFTER `nilai_mid`");
$this->db->query("ALTER TABLE `bimtik_nilai` ADD `nilai_ruh` VARCHAR(5) NULL AFTER `nilai_tu10`");
$this->db->query("ALTER TABLE `bimtik_nilai` ADD `nilai_rtu` VARCHAR(5) NULL AFTER `nilai_tu10`");
*/
//01112017
/*
$this->db->query("ALTER TABLE `nilai`  ADD `nilai_tu5` VARCHAR(5) NULL  AFTER `nilai_tu4`,  ADD `nilai_tu6` VARCHAR(5) NULL  AFTER `nilai_tu5`,  ADD `nilai_tu7` VARCHAR(5) NULL  AFTER `nilai_tu6`,  ADD `nilai_tu8` VARCHAR(5) NULL  AFTER `nilai_tu7`,  ADD `nilai_tu9` VARCHAR(5) NULL  AFTER `nilai_tu8`,  ADD `nilai_tu10` VARCHAR(5) NULL  AFTER `nilai_tu9`");
*/
/*
$this->db->query("CREATE TABLE `analisis_dayabeda` (
  `id_mapel` bigint(20) NOT NULL,
  `ulangan` varchar(4) CHARACTER SET latin1 NOT NULL,
  `nilai_s1` VARCHAR(5) NULL,
  `nilai_s2` VARCHAR(5) NULL,
  `nilai_s3` VARCHAR(5) NULL,
  `nilai_s4` VARCHAR(5) NULL,
  `nilai_s5` VARCHAR(5) NULL,
  `nilai_s6` VARCHAR(5) NULL,
  `nilai_s7` VARCHAR(5) NULL,
  `nilai_s8` VARCHAR(5) NULL,
  `nilai_s9` VARCHAR(5) NULL,
  `nilai_s10` VARCHAR(5) NULL,
  `nilai_s11` VARCHAR(5) NULL,
  `nilai_s12` VARCHAR(5) NULL,
  `nilai_s13` VARCHAR(5) NULL,
  `nilai_s14` VARCHAR(5) NULL,
  `nilai_s15` VARCHAR(5) NULL,
  `nilai_s16` VARCHAR(5) NULL,
  `nilai_s17` VARCHAR(5) NULL,
  `nilai_s18` VARCHAR(5) NULL,
  `nilai_s19` VARCHAR(5) NULL,
  `nilai_s20` VARCHAR(5) NULL,
  `nilai_s21` VARCHAR(5) NULL,
  `nilai_s22` VARCHAR(5) NULL,
  `nilai_s23` VARCHAR(5) NULL,
  `nilai_s24` VARCHAR(5) NULL,
  `nilai_s25` VARCHAR(5) NULL,
  `nilai_s26` VARCHAR(5) NULL,
  `nilai_s27` VARCHAR(5) NULL,
  `nilai_s28` VARCHAR(5) NULL,
  `nilai_s29` VARCHAR(5) NULL,
  `nilai_s30` VARCHAR(5) NULL,
  `nilai_s31` VARCHAR(5) NULL,
  `nilai_s32` VARCHAR(5) NULL,
  `nilai_s33` VARCHAR(5) NULL,
  `nilai_s34` VARCHAR(5) NULL,
  `nilai_s35` VARCHAR(5) NULL,
  `nilai_s36` VARCHAR(5) NULL,
  `nilai_s37` VARCHAR(5) NULL,
  `nilai_s38` VARCHAR(5) NULL,
  `nilai_s39` VARCHAR(5) NULL,
  `nilai_s40` VARCHAR(5) NULL,
  `nilai_s41` VARCHAR(5) NULL,
  `nilai_s42` VARCHAR(5) NULL,
  `nilai_s43` VARCHAR(5) NULL,
  `nilai_s44` VARCHAR(5) NULL,
  `nilai_s45` VARCHAR(5) NULL,
  `nilai_s46` VARCHAR(5) NULL,
  `nilai_s47` VARCHAR(5) NULL,
  `nilai_s48` VARCHAR(5) NULL,
  `nilai_s49` VARCHAR(5) NULL,
  `nilai_s50` VARCHAR(5) NULL,
  `dipakai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
$this->db->query("CREATE TABLE `analisis_skor` (
  `id_mapel` bigint(20) NOT NULL,
  `itemnilai` varchar(4) CHARACTER SET latin1 NOT NULL,
  `s1` VARCHAR(5) NULL,
  `s2` VARCHAR(5) NULL,
  `s3` VARCHAR(5) NULL,
  `s4` VARCHAR(5) NULL,
  `s5` VARCHAR(5) NULL,
  `s6` VARCHAR(5) NULL,
  `s7` VARCHAR(5) NULL,
  `s8` VARCHAR(5) NULL,
  `s9` VARCHAR(5) NULL,
  `s10` VARCHAR(5) NULL,
  `s11` VARCHAR(5) NULL,
  `s12` VARCHAR(5) NULL,
  `s13` VARCHAR(5) NULL,
  `s14` VARCHAR(5) NULL,
  `s15` VARCHAR(5) NULL,
  `s16` VARCHAR(5) NULL,
  `s17` VARCHAR(5) NULL,
  `s18` VARCHAR(5) NULL,
  `s19` VARCHAR(5) NULL,
  `s20` VARCHAR(5) NULL,
  `s21` VARCHAR(5) NULL,
  `s22` VARCHAR(5) NULL,
  `s23` VARCHAR(5) NULL,
  `s24` VARCHAR(5) NULL,
  `s25` VARCHAR(5) NULL,
  `s26` VARCHAR(5) NULL,
  `s27` VARCHAR(5) NULL,
  `s28` VARCHAR(5) NULL,
  `s29` VARCHAR(5) NULL,
  `s30` VARCHAR(5) NULL,
  `s31` VARCHAR(5) NULL,
  `s32` VARCHAR(5) NULL,
  `s33` VARCHAR(5) NULL,
  `s34` VARCHAR(5) NULL,
  `s35` VARCHAR(5) NULL,
  `s36` VARCHAR(5) NULL,
  `s37` VARCHAR(5) NULL,
  `s38` VARCHAR(5) NULL,
  `s39` VARCHAR(5) NULL,
  `s40` VARCHAR(5) NULL,
  `s41` VARCHAR(5) NULL,
  `s42` VARCHAR(5) NULL,
  `s43` VARCHAR(5) NULL,
  `s44` VARCHAR(5) NULL,
  `s45` VARCHAR(5) NULL,
  `s46` VARCHAR(5) NULL,
  `s47` VARCHAR(5) NULL,
  `s48` VARCHAR(5) NULL,
  `s49` VARCHAR(5) NULL,
  `s50` VARCHAR(5) NULL,
  `dipakai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
*/
/*
$this->db->query("ALTER TABLE `nilai` CHANGE `kunci` `kunci` CHAR(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '0'");
$this->db->query("update `nilai` set `kunci`='0' where `thnajaran`='2017/2018' and `kunci`='T'");
*/
/* dibatalkan
$this->db->query("ALTER TABLE `dupak_dupak` CHANGE `username` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL");
$this->db->query("ALTER TABLE `dupak_dupak_lama` CHANGE `username` `nip` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL");
$this->db->query("ALTER TABLE `dupak_pak` CHANGE `username` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL"); 
$this->db->query("UPDATE `dupak_masa` SET `tanggal` = NULL WHERE `dupak_masa`.`id_dupak_masa` = 6");
$this->db->query("UPDATE `dupak_masa` SET `tanggal` = NULL WHERE `dupak_masa`.`id_dupak_masa` = 10");
$this->db->query("UPDATE `dupak_masa` SET `tanggal` = NULL WHERE `dupak_masa`.`id_dupak_masa` = 15");
$this->db->query("UPDATE `dupak_masa` SET `tanggal` = NULL WHERE `dupak_masa`.`id_dupak_masa` = 27");
$this->db->query("ALTER TABLE `dupak_masa` CHANGE `username` `nip` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL"); 
$this->db->query("ALTER TABLE `dupak_pd` CHANGE `username` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL");
$this->db->query("ALTER TABLE `dupak_pj` CHANGE `username` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL");
$this->db->query("ALTER TABLE `dupak_skp` CHANGE `username` `nip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL");
$this->db->query("ALTER TABLE `dupak_tapel` CHANGE `username` `nip` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL");
$ta = $this->db->query("select * from `p_pegawai`");
foreach($ta->result() as $a)
{
	$kd = $a->kd;
	$nip = $a->nip;
	$this->db->query("update `dupak_dupak` set `nip`='$nip' where `nip`='$kd'");
	$this->db->query("update `dupak_dupak_lama` set `nip`='$nip' where `nip`='$kd'");
	$this->db->query("update `dupak_pak` set `nip`='$nip' where `nip`='$kd'");
	$this->db->query("update `dupak_masa` set `nip`='$nip' where `nip`='$kd'");
	$this->db->query("update `dupak_pd` set `nip`='$nip' where `nip`='$kd'");
	$this->db->query("update `dupak_pj` set `nip`='$nip' where `nip`='$kd'");
	$this->db->query("update `dupak_skp` set `nip`='$nip' where `nip`='$kd'");
}
*/
/*
$this->db->query("ALTER TABLE `skp_skor_guru` CHANGE `ak_r` `ak_r` FLOAT(10,5) NOT NULL"); 
$this->db->query("ALTER TABLE `bank_deskripsi` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `bimtik_haritatapmuka` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `bimtik_mapel` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `bimtik_rph` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `bimtik_rpp` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_bip` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_bpu` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_buku_pegangan` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_piket` CHANGE `kode_guru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_rph` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_rph_ringkas` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_rpp_induk` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_tindak_lanjut` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `guru_tugas` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, CHANGE `kodegurupiket` `kodegurupiket` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `kalab_harian` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `kalab_proker` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `kompetensi_dasar` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `m_akhlak` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `m_akhlak_2015` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `m_kepala` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `m_mapel` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `m_mapel_skbk` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `m_pengampu_ekstra` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `m_walikelas` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `nilai_akhlak` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `p_tugas_tambahan` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `p_tugas_tambahan_luar` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `pkg_tim_penilai` CHANGE `kode_ternilai` `kode_ternilai` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `siswa_absensi` CHANGE `kode_guru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `siswa_kredit` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `siswa_proses_izin` CHANGE `kode_guru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `supervisi_nilai` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$this->db->query("ALTER TABLE `tharitatapmuka` CHANGE `kodeguru` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");

$ta = $this->db->query("select * from `p_pegawai`");
foreach($ta->result() as $a)
{
	$kd = $a->kd;
	$kodeguru = $a->kode;
	$this->db->query("update `bank_deskripsi` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `bimtik_haritatapmuka` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `bimtik_mapel` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `bimtik_rph` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `bimtik_rpp` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_bip` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_bpu` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_buku_pegangan` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_piket` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_rph` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_rph_ringkas` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_rpp_induk` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_tindak_lanjut` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_tugas` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `guru_tugas` set `kodegurupiket`='$kd' where `kodegurupiket`='$kodeguru'");
	$this->db->query("update `kalab_harian` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `kalab_proker` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `kompetensi_dasar` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `m_akhlak` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `m_akhlak_2015` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `m_kepala` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `m_mapel` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `m_mapel_skbk` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `m_pengampu_ekstra` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `m_walikelas` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `nilai_akhlak` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `p_tugas_tambahan` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `p_tugas_tambahan_luar` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `pkg_tim_penilai` set `kode_ternilai`='$kd' where `kode_ternilai`='$kodeguru'");
	$this->db->query("update `siswa_absensi` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `siswa_kredit` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `siswa_proses_izin` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `supervisi_nilai` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
	$this->db->query("update `tharitatapmuka` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
}
$this->db->query("ALTER TABLE `p_pegawai` CHANGE `kode` `kodeguru` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
$ta = $this->db->query("select * from `p_pegawai`");
foreach($ta->result() as $a)
{
	$kd = $a->kd;
	$kodeguru = $a->kodeguru;
	$this->db->query("update `p_pegawai` set `kodeguru`='$kd' where `kodeguru`='$kodeguru'");
}
*/
/*
ALTER TABLE `bimtik_mapel` CHANGE `program` `program` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
*/
//$this->db->query("ALTER TABLE `m_kepala` ADD `nama` VARCHAR(100) NULL DEFAULT NULL AFTER `t_rapor`, ADD `nip` VARCHAR(100) NULL DEFAULT NULL AFTER `nama`");
/*
$this->db->query("ALTER TABLE `pkg_masa` ADD `tskp` DATE NULL DEFAULT NULL AFTER `tatasanpejabat`, ADD `tpenilaian` DATE NULL DEFAULT NULL AFTER `tskp`");
$this->db->query("ALTER TABLE `m_mapel_rapor` ADD `urut_smptn` INT(2) NULL DEFAULT NULL AFTER `pilihan`");
*/

//$this->db->query("ALTER TABLE `siswa_peringkat` CHANGE `program` `program` CHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, CHANGE `kelas` `kelas` CHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");

/*
$this->db->query("UPDATE `skp_tabel_skor` SET `kegiatan` = 'Pemrasaran / narasumber pada pada seminar atau lokakarya ilmiah' WHERE `skp_tabel_skor`.`kode` = '29'");
*/
/*
$this->db->query("ALTER TABLE `m_program` ADD `kode_uambnbk` INT NULL AFTER `program`");
$this->db->query("ALTER TABLE `siswa_nomor_tes_un` CHANGE `no_peserta` `no_peserta` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
*/
$this->db->query("ALTER TABLE `tblberita` ADD `penuh` INT(1) NOT NULL DEFAULT '0' AFTER `counter`");
?>
Selesai
</div></div></div>
