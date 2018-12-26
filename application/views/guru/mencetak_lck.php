<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_lck.php
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
$kelas = id_mapel_jadi_kelas($id_mapel);
$mapel = id_mapel_jadi_mapel($id_mapel);
$kelompok = id_mapel_jadi_kelompok($id_mapel);
?>
<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/formmencetak">Laporan Capaian Kompetensi Peserta Didik</a></p></h3>
<table width="<?php echo $lebartabel;?>">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Kelompok Mata Pelajaran</strong></td><td>: <strong><?php echo $kelompok;?></strong></td></tr>
</table>
<table width="<?php echo $lebartabel;?>" class="table table-striped table-bordered">
<tr align="center"><td rowspan="2" width="30">No.</td><td  rowspan="2">Nama</td><td colspan="2">Pengetahuan (KI-3)</td><td colspan="2">Keterampilan (KI-4)</td><td rowspan="2">Sikap</td></tr>
<tr align="center"><td>Angka</td><td>Predikat</td><td>Angka</td><td>Predikat</td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from nilai where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	echo "<tr><td align='center'>".$nomor."</a></td><td>".nis_ke_nama($t->nis)."</td>";
				if ($t->kog==0)
					{
					$predikat_nilaik = predikat_nilai($t->nilai_nr).' *';
					$nilaik = konversi_nilai($t->nilai_nr).' *';
					}
					else
					{
					$predikat_nilaik = predikat_nilai($t->kog);
					$nilaik = konversi_nilai($t->kog);
					}
				if ($t->psi==0)
					{
					$predikat_nilaip = predikat_nilai($t->psikomotor).' *';
					$nilaip = konversi_nilai($t->psikomotor).' *';
					}
					else
					{
					$predikat_nilaip = predikat_nilai($t->psi);
					$nilaip = konversi_nilai($t->psi);
					}

		echo '<td align="center">'.$nilaik.'</td><td align="center">'.$predikat_nilaik.'</td>
	<td align="center">'.$nilaip.'</td><td align="center">'.$predikat_nilaip.'</td><td align="center">'.predikat_afektif($t->afektif).'</td></tr>';
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



