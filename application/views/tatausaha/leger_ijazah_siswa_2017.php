<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_ijazah.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
echo '<h2>Selesai</h2>';
$kelas = $this->helper->nis_ke_kelas_thnajaran_semester($nis,$thnajaran,'2');
$jurusan = $this->helper->kelas_jadi_program($kelas);
$kurikulum = $this->helper->cari_kurikulum($thnajaran,'2',$kelas);
$bobot_ujian_tertulis = $this->config->item('bobot_ujian_tertulis') / 100;
$bobot_ujian_praktik = $this->config->item('bobot_ujian_praktik') / 100;

$tb = $this->db->query("select * from `m_mapel_ijazah` where thnajaran='$thnajaran' and `jurusan` = '$jurusan' order by `no_urut`");
foreach($tb->result() as $b)
{
	$mapel = $b->mapel;
	$pembagi = $b->cacah_semester;
	$no_urut = $b->no_urut;
	$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
	$nilai = 0;
	foreach($tc->result() as $c)
	{
		$thnajaranx = $c->thnajaran_penilaian;
		$semesterx = $c->semester;
		$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx' and `status` = 'Y'");			
		foreach($td->result() as $d)
		{
			$nilai = $nilai + $d->kog;
		}

	}
	$tujian = $this->db->query("select * from `nilai_ujian` where `mapel`='$mapel' and `nis`= '$nis'");
	$nujian = 0;
	foreach($tujian->result() as $t)
	{
		$nujian = ($bobot_ujian_tertulis * $t->nilai) + ($bobot_ujian_praktik * $t->praktik);
	}
	$nilai = $nilai / $pembagi;
	$nijazah = ($nilai + $nujian) / 2;
	$nijazah = round($nijazah,0);
	$field = 'r'.$no_urut;
	echo $no_urut.' '.$mapel.' '.$nujian.' '.$nilai.'<br />';
	$this->db->query("update `leger_ijazah` set `$field`='$nijazah' where `thnajaran`='$thnajaran' and `nis`='$nis'");
}
?>
<div class="alert alert-info">Proses leger nilai siswa ini <?php echo $nis.' / '.nis_ke_nama($nis);?></div>
</div></div></div>
