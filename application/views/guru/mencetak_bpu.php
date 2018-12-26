<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_bpu.php
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
$lebartabel= '100%';
?>
<h3 class="text-center"><a href="<?php echo base_url(); ?>index.php/guru/formmencetak">Buku Pengembalian Ulangan</a></h3>
<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
</table>
<div class="CSSTableGenerator"><table width="<?php echo $lebartabel;?>" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr align="center"><td width="30"><strong>No</strong></td><td><strong>Hari, Tanggal Ulangan</strong></td><td><strong>Kelas</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Ulangan ke-</strong></td><td><strong>SK/KD/Materi</strong></td><td><strong>Tanggal Pengembalian</strong></td><td><strong>Wakil Siswa</strong></td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from guru_bpu where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	$dinane = tanggal_ke_hari($t->tanggalulangan);
	echo '<tr valign="top"><td align="center">'.$nomor.'</a></td><td>'.$dinane.', '.date_to_long_string($t->tanggalulangan).'</td>
<td align="center">'.$t->kelas.'</td><td>'.$t->mapel.'</td><td>'.$t->jenisulangan.'</td><td>'.tanpa_paragraf($t->skkdmateri).'</td><td>'.date_to_long_string($t->tanggal).'</td><td>'.$t->wakil.'</td></tr>';
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
</div>
</body>
</html>
