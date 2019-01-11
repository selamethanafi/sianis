<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
/////// Sistem Informasi Madrasah 			///////
///////////////////////////////////////////////////////////////
/////// Dibuat oleh : Selamet Hanafi, S.Si		///////
/////// email	 : selamethanafi@yahoo.co.id		///////
/////// Hp	 : 081212187658				///////
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
$tanggalhariini = tanggal_hari_ini();
$x = substr($tanggalhariini,0,4);
$y = substr($tanggalhariini,5,2);
$z = substr($tanggalhariini,8,2);
$dina = date("l", mktime(0, 0, 0, $y, $z, $x));
$jam = jam_saja();
if(($jam_paksa > 0 ) and ($jam_paksa < 25))
{
	$jam = $jam_paksa;
	if($jam_paksa < 10)
	{
		$jam = '0'.$jam_paksa;
	}
}
$menit = menit_saja();
$bulan = angka_jadi_bulan($y);
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan '.$bulan.' '.$x;
$ta = $this->db->query("select * from `tharitatapmuka` where `thnajaran`='$thnajaran' and `semester`='$semester' and `jam_mulai`='$jam' and `hari_tatap_muka` = '$dina'");
$mapel = '';
$kelas = '';
foreach($ta->result() as $a)
{
	$id_mapel = $a->id_mapel;
	$kodeguru = $a->kodeguru;
	$jam_mulai = $a->jam_mulai;
	$jam_selesai = $a->jam_selesai;
	$menit_mulai = $a->menit_mulai;
	$menit_selesai = $a->menit_selesai;
	$tc = $this->db->query("select * FROM `p_pegawai` where `kd`='$kodeguru'");
	$nip = '';
	foreach($tc->result() as $c)
	{
		$nip = $c->nip;
		$pns = $c->status_kepegawaian;
	}
	if(($pns == 'PNS') or ($pns == 'CPNS'))
	{
		$mapel = id_mapel_jadi_mapel($id_mapel);
		$kelas = id_mapel_jadi_kelas($id_mapel);
		$td = $this->db->query("select * from `sieka_bulanan` where `tahun`='$x' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
		$id_bulanan = '';
		foreach($td->result() as $d)
		{
			$id_bulanan = $d->id_bulanan;
		}
		$harian = 'melaksanakan kegiatan pembelajaran mata pelajaran '.$mapel.' di kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
		$tb = $this->db->query("select * FROM `sieka_harian` where `kegiatan`='$harian' and `tanggal`='$tanggalhariini' and `nip`='$nip'");
		if($tb->num_rows() == 0)
		{
			if(!empty($id_bulanan))
			{
				$this->db->query("insert into `sieka_harian` (`tahun`, `nip`, `kegiatan`, `tanggal`, `id_bulanan`, `jam_mulai`, `menit_mulai`, `jam_selesai`, `menit_selesai`) values ('$x','$nip', '$harian', '$tanggalhariini', '$id_bulanan', '$jam_mulai', '$menit_mulai', '$jam_selesai', '$menit_selesai')");
			}
		}
	}
}
$kegiatan_rencana = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan '.$bulan.' '.$x;
$ta = $this->db->query("select * from `tharitatapmuka` where `thnajaran`='$thnajaran' and `semester`='$semester' and `rencana_jam_mulai`='$jam' and `rencana_hari_tatap_muka` = '$dina'");
$mapel = '';
$kelas = '';
foreach($ta->result() as $a)
{
	$id_mapel = $a->id_mapel;
	$kodeguru = $a->kodeguru;
	$jam_mulai = $a->rencana_jam_mulai;
	$jam_selesai = $a->rencana_jam_selesai;
	$menit_mulai = $a->rencana_menit_mulai;
	$menit_selesai = $a->rencana_menit_selesai;
	$tc = $this->db->query("select * FROM `p_pegawai` where `kd`='$kodeguru'");
	$nip = '';
	foreach($tc->result() as $c)
	{
		$nip = $c->nip;
		$pns = $c->status_kepegawaian;
	}
	if(($pns == 'PNS') or ($pns == 'CPNS'))
	{
		$mapel = id_mapel_jadi_mapel($id_mapel);
		$kelas = id_mapel_jadi_kelas($id_mapel);
		$td = $this->db->query("select * from `sieka_bulanan` where `tahun`='$x' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
		$id_bulanan = '';
		foreach($td->result() as $d)
		{
			$id_bulanan = $d->id_bulanan;
		}
		$harian = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran mata pelajaran '.$mapel.' di kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
		$tb = $this->db->query("select * FROM `sieka_harian` where `kegiatan`='$harian' and `tanggal`='$tanggalhariini' and `nip`='$nip'");
		if($tb->num_rows() == 0)
		{
			if(!empty($id_bulanan))
			{
				$this->db->query("insert into `sieka_harian` (`tahun`, `nip`, `kegiatan`, `tanggal`, `id_bulanan`, `jam_mulai`, `menit_mulai`, `jam_selesai`, `menit_selesai`) values ('$x','$nip', '$harian', '$tanggalhariini', '$id_bulanan', '$jam_mulai', '$menit_mulai', '$jam_selesai', '$menit_selesai')");
			}
		}
	}
}

?>
