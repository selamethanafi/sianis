<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 07 Mar 2015 20:06:21 WIB 
// Nama Berkas 		: mencetak_deskripsi_lck.php
// Lokasi      		: application/views/guru
// Author      		: Selamet Hanafi
//              	 selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$te = $this->db->query("select * from m_mapel where `id_mapel`='$id_mapel'");
foreach($te->result() as $e)
	{
	$kelas = $e->kelas;
	$mapel = $e->mapel;
	$kelompok = $e->kelompok;
	$kkm = $e->kkm;
	$jenis_deskripsi = $e->jenis_deskripsi;
	$materi1 = $e->materi1;
	$materi2 = $e->materi2;
	$materi3 = $e->materi3;
	$materi4 = $e->materi4;
	$materi5 = $e->materi5;
	$materi6 = $e->materi6;

	}
$tb = $this->db->query("select * from m_mapel where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and `kodeguru`='$kodeguru'");
foreach($tb->result() as $b)
	{
	$materi1 = $b->materi1;
	$materi2 = $b->materi2;
	$materi3 = $b->materi3;
	$materi4 = $b->materi4;
	$materi5 = $b->materi5;
	$materi6 = $b->materi6;
	}
$tg = $this->db->query("select * from `aspek_psikomotorik` where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester'");
foreach($tg->result() as $g)
	{
	$p[1]=$g->p1;
	$p[2]=$g->p2;
	$p[3]=$g->p3;
	$p[4]=$g->p4;
	$p[5]=$g->p5;
	$p[6]=$g->p6;
	$p[7]=$g->p7;
	$p[8]=$g->p8;
	$p[9]=$g->p9;
	$p[10]=$g->p10;
	$p[11]=$g->p11;
	$p[12]=$g->p12;
	$p[13]=$g->p13;
	$p[14]=$g->p14;
	$p[15]=$g->p15;
	$p[16]=$g->p16;
	$p[17]=$g->p17;
	$p[18]=$g->p18;
	}

$th = $this->db->query("select * from `aspek_afektif` where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester'");
foreach($th->result() as $h)
	{
	$afe[1]=$h->p1;
	$afe[2]=$h->p2;
	$afe[3]=$h->p3;
	$afe[4]=$h->p4;
	$afe[5]=$h->p5;
	$afe[6]=$h->p6;
	$afe[7]=$h->p7;
	$afe[8]=$h->p8;
	$afe[9]=$h->p9;
	$afe[10]=$h->p10;
	$afe[11]=$h->p11;
	$afe[12]=$h->p12;
	$afe[13]=$h->p13;
	$afe[14]=$h->p14;
	$afe[15]=$h->p15;
	}

?>
<br />
<p class="text-center"><a href="<?php echo base_url(); ?>guru/formmencetak"><strong>Deskripsi Capaian Kompetensi Peserta Didik</strong></a></p>

<table>
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
</table>
<table class="table table-striped table-bordered">
<?php
if($kurikulum == '2015')
{
	echo '<tr align="center"><td  width="20">No.</td><td>Nama</td><td width="210">Pengetahuan (KI-3)</td><td width="210">Keterampilan (KI-4)</td></tr>';
}
elseif($kurikulum == '2013')
{
	echo '<tr align="center"><td  width="20">No.</td><td >Nama</td><td width="160">Pengetahuan (KI-3)</td><td width="160">Keterampilan (KI-4)</td><td>Sikap (KI-1 dan KI-2)</td></tr>';
}
else
{
	echo '<tr align="center"><td  width="20">No.</td><td >Nama</td><td>Deskripsi</td></tr>';
}
$nomor=1;
$ta = $this->db->query("select * from nilai where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	$nis = $t->nis;

	$desk = $t->keterangan;
	$ketpsi = $t->deskripsi;
	//sikap
	$ti = $this->db->query("select * from afektif where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
	$ketafektif='';
	foreach($ti->result() as $i)
		{
		$ketafektif = $i->deskripsi;
		}

	if($kurikulum == '2015')
	{	
		echo "<tr><td align='center'>".$nomor."</td><td>".nis_ke_nama($t->nis)."</td>
		<td>".$desk."</td><td>".$ketpsi."</td></tr>";
	}
	elseif($kurikulum == '2013')
	{	
		echo "<tr><td align='center'>".$nomor."</td><td>".nis_ke_nama($t->nis)."</td>
		<td>".$desk."</td><td>".$ketpsi."</td><td>".$ketafektif."</td></tr>";
	}
	else
	{	
		echo "<tr><td align='center'>".$nomor."</td><td>".nis_ke_nama($t->nis)."</td>
		<td>".$desk."</td></tr>";
	}

	$nomor++;
	}
}


echo '</table>';
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
if ($ditandatangani=='ya')
{
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
?>


