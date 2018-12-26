<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_informasi_penilaian.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/formmencetak">Informasi Penilaian</a></p></h3>
<table width="100%" cellpadding="2" cellspacing="1" >
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
</table>
<div class="CSSTableGenerator"><table width="100%">
<tr align="center"><td width="30"><strong>No</strong></td><td><strong>Hari, Tanggal</strong></td><td><strong>Kelas</strong></td><td><strong>Ulangan</strong></td><td><strong>SK/KD/Materi</strong></td><td><strong>Informasi</strong></td><td><strong>Penerima Informasi</strong></td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from guru_bip where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	$dinane = tanggal_ke_hari($t->tanggal);
	echo '<tr valign="top"><td align="center">'.$nomor.'</a></td><td>'.$dinane.', '.date_to_long_string($t->tanggal).'</td>
<td align="center">'.$t->kelas.'</td><td>'.$t->jenisulangan.'</td><td>'.$t->skkdmateri.'</td><td>'.$t->isiinformasi.'</td>
<td>'.$t->penerima.'</td></tr>';
	$nomor++;
	}
}
?>
</table></div>
<?php
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
</div></body></html>


