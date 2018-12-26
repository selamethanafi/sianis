<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 07 Mar 2015 20:05:35 WIB 
// Nama Berkas 		: mencetak_daftar_tugas.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
$lebartabel= "100%";
?>
<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/formmencetak">Daftar Tugas Siswa</a></p></h3>
<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
</table>
<p>Tugas Terstruktur</p>
<?php
$trph = $this->db->query("select * from `guru_rph` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and tugas != '' and is_mandiri='2' order by tanggal ASC, jamke ASC");
if(count($trph->result())==0)
	{
	echo "Belum ada data Tugas terstruktur";
	}
else
{
?>
<div class="CSSTableGenerator">
<table width="<?php echo $lebartabel;?>">
<tr align="center"><td>No.</td><td>Tanggal</td><td>Mapel</td><td>Kelas</td><td>Jam Ke-</td><td>SK/KD/Materi</td><td>Tugas</td><td>Tanggal Selesai</td></tr>
<?php
$nomor =1;
foreach($trph->result() as $d)
	{
	echo '<tr><td align="center">'.$nomor.'</td><td>'.date_to_long_string($d->tanggal).'</td><td>'.$d->mapel.'</td><td align="center">'.$d->kelas.'</td><td align="center">'.$d->jamke.'</td><td>'.tanpa_paragraf($d->sk).''.tanpa_paragraf($d->kd).''.tanpa_paragraf($d->materi).'</td><td>'.tanpa_paragraf($d->tugas).'</td><td>'.date_to_long_string($d->tanggalselesai).'</td></tr>';

	$nomor++;
	}

}
?>
</table></div>
<p>Tugas Mandiri Tak Terstruktur</p>
<?php
$trph = $this->db->query("select * from `guru_rph` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and tugas != '' and is_mandiri='1' order by tanggal ASC, jamke ASC");
if(count($trph->result())==0)
	{
	echo "Belum ada data Tugas";
	}
else
{
?>
<div class="CSSTableGenerator">
<table width="<?php echo $lebartabel;?>">
<tr align="center"><td>No.</td><td>Tanggal</td><td>Mapel</td><td>Kelas</td><td>Jam Ke-</td><td>SK/KD/Materi</td><td>Tugas</td></tr>
<?php
$nomor =1;
foreach($trph->result() as $d)
	{
	echo '<tr><td align="center">'.$nomor.'</td><td>'.date_to_long_string($d->tanggal).'</td><td>'.$d->mapel.'</td><td align="center">'.$d->kelas.'</td><td align="center">'.$d->jamke.'</td><td>'.tanpa_paragraf($d->sk).''.tanpa_paragraf($d->kd).''.tanpa_paragraf($d->materi).'</td><td>'.tanpa_paragraf($d->tugas).'</td></tr>';
	$nomor++;
	}

}
?>
<?php
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggal_hari_ini();
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
</div></body></html>


