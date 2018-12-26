<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 26 Nov 2014 14:08:36 WIB 
// Nama Berkas 		: mencetak_hambatan.php
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
<h3><p class="text-center"><a href="<?php echo base_url();?>guru/formmencetak/21">Hambatan Belajar Siswa</a></p></h3>
<?php
$lebartabel= '100%';
$kelas = '';
$mapel = '';
$tmapel = $this->db->query("select * from m_mapel where id_mapel='$id_mapel'");
foreach($tmapel->result_array() as $dm)
{
	$kelas = $dm["kelas"];
	$mapel = $dm['mapel'];
}
?>
<table width="100%">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
</table>

<table width="<?php echo $lebartabel;?>" class="table table-striped table-bordered">
<tr align="center">
	<td><strong>No.</strong></td><td>
	<strong>Nama</strong></td>
	<td><strong>Hambatan Siswa</strong></td>
</tr>
<?php
$tsiskel = $this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and `semester` = '$semester' and kelas='$kelas'");
$nomor=1;
foreach($tsiskel->result_array() as $t)
{
	$nis = $t['nis'];
	echo '<tr><td align="center">'.$nomor.'</td><td >'.nis_ke_nama($nis).'</td><td>';
	$thambatansiswa = $this->db->query("select * from siswa_hambatan where thnajaran='$thnajaran' and nis='$nis' and mapel='$mapel'");
	foreach($thambatansiswa->result_array() as $tt)
	{
		echo $tt["hambatan"];

	}
	echo '</td></tr>';
	$nomor++;		
}
?>
</table>
<?php
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
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


