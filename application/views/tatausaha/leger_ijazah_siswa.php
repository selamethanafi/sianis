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
$tb = $this->db->query("select * from `m_mapel_ijazah` where thnajaran='$thnajaran' and `jurusan` = '$jurusan' order by `no_urut`");
foreach($tb->result() as $b)
{
	$mapel = $b->mapel;
	$pembagi = $b->cacah_semester;
	$no_urut = $b->no_urut;
	echo $no_urut.' '.$mapel.'<br />';
	$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
	$nilai = 0;
	foreach($tc->result() as $c)
	{
		$thnajaranx = $c->thnajaran_penilaian;
		$semesterx = $c->semester;
		$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx'");			
		foreach($td->result() as $d)
		{
			if (($mapel == 'Seni Budaya') and ($kurikulum == 'KTSP'))
			{
				$nilai = $nilai + $d->psi;
			}
			else
			{
				$nilai = $nilai + $d->kog;
			}
		}
	}
	$nilai = $nilai / $pembagi;
	$nilai = round($nilai,2);
	$field = 'r'.$no_urut;
	$this->db->query("update `leger_ijazah` set `$field`='$nilai' where `thnajaran`='$thnajaran' and `nis`='$nis'");
}
?>
<div class="alert alert-info">Proses leger nilai siswa ini <?php echo $nis.' / '.nis_ke_nama($nis);?></div>
</div></div></div>
