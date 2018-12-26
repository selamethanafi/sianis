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
<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/formmencetak">Daftar Tugas Siswa</a></p></h3>
<table cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
</table>
<?php
$trph = $this->db->query("select * from `guru_rph_ringkas` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal ASC");
if(count($trph->result())==0)
	{
	echo "Belum ada data";
	}
else
{
?>
<div class="CSSTableGenerator"><table>
<tr align="center"><td>No.</td><td>Tanggal</td><td>Mapel / Kelas / Jam ke-</td><td>SK/KD/Materi</td><td>Jenis</td><td>Tugas</td></tr>
<?php
$nomor =1;
foreach($trph->result() as $d)
	{
	$kode_rpp = $d->kode_rpp;
	$trpp = $this->db->query("select * from `guru_rpp_induk` where `id_guru_rpp_induk`='$kode_rpp'");
	$rencana ='';
	$sk = '';
	$kd ='';
	$materi = '';
	$tanggalselesai = '';
	$jenis = '';
	foreach($trpp->result() as $rpp)
		{
			$sk = $rpp->standar_kompetensi;
			$kd = $rpp->kompetensi_dasar;
			$materi = $rpp->materi_pembelajaran;
			$tugas = $rpp->tugas;
			$jenis = $rpp->jenis;
		}
	$jenise = jenis_tugas($jenis);
	$adatugas = strip_tags($tugas);
	if(!empty($adatugas))
	{
		echo '<tr valign="top"><td align="center">'.$nomor.'</td><td>'.date_to_long_string($d->tanggal).'</td><td>'.$d->mapel.'<br /> '.$d->kelas.' <br /> '.$d->jamke.'</td><td>'.tanpa_paragraf($sk).'<br />'.tanpa_paragraf($kd).'<br />'.substr(strip_tags($materi),0,250).'</td>';
		echo '<td>'.$jenise.'</td><td>'.tanpa_paragraf($tugas).'</td>';
		$nomor++;
	}
	}

}
?>
</table></div>
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
