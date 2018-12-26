<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_rph.php
// Lokasi      		: application/views/guru/
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
$lebartabel="95%";
?>
<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center">
<a href="<?php echo base_url(); ?>guru/mencetakperangkat/33"><h3>Rencana Pelaksanaan Harian</h3></a></td></tr></table>
<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
</table>
<?php
$tanggalcetak ='';
$trph = $this->db->query("select * from `guru_rph_ringkas` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal ASC limit 0,1");
foreach($trph->result_array() as $d)
	{
	$tanggalcetak = $d['tanggal'];
	}
$trph = $this->db->query("select * from `guru_rph_ringkas` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal ASC, jamke ASC");
$ada = $trph->num_rows();
if ($ada == 0)
	{
	echo "Belum ada data RPH";
	}
else
{
?>
<div class="landscape">';
<div class="CSSTableGenerator">
<table>
<tr align="center"><td>No.</td><td>Tanggal</td><td>Jam Ke-</td><td>Kelas</td><td>Mapel</td><td>SK/KD</td><td>Rencana</td><td>Keterangan</td></tr>
<?php
$nomor =1;
foreach($trph->result_array() as $d)
	{
	$dinane = tanggal_ke_hari($d['tanggal']);
	$id_guru_rpp_induk = $d['kode_rpp'];
	$sk = '';
	$rencana = '';
	$keterangan = '';
	$tb = $this->db->query("SELECT * FROM `guru_rpp_induk` where kodeguru='$kodeguru' and id_guru_rpp_induk='$id_guru_rpp_induk'");
	foreach($tb->result() as $b)
	{
		$sk = tanpa_paragraf($b->standar_kompetensi.' '.$b->kompetensi_dasar);
		$rencana = tanpa_paragraf($b->rencana);
		$rencana = tanpa_tabel($rencana);
	}
	echo '<tr  valign="top"><td align="center">'.$nomor.'</td><td >'.$dinane.', '.date_to_long_string($d['tanggal']).'</td><td align="center">'.$d['jamke'].'</td><td align="center">'.$d['kelas'].'</td><td>'.$d['mapel'].'</td><td>Kode RPP: '.$id_guru_rpp_induk.'<br />'.$sk.'</td><td>'.$rencana.'</td><td>'.$d['keterangan'].'</td></tr>';
	$nomor++;
	}

}
?>
</table></div>
<?php
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
echo '';
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
</div>


