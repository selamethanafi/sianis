<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_catatan_hambatan.php
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
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>CATATAN HAMBATAN BELAJAR SISWA - <?php echo $this->config->item('nama_web');?></title>
</head>
<?php
$lebartabel="95%";
?>
<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/mencetakperangkat/37">CATATAN HAMBATAN BELAJAR SISWA</a></p></h3>
<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
</table>
<div class="CSSTableGenerator"><table width="<?php echo $lebartabel;?>" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr align="center"><td width="20"><strong>No</strong></td><td width="90"><strong>Tanggal</strong></td><td width="60"><strong>Kelas</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>SK/KD/Materi</strong></td><td><strong>Hambatan</strong></td><td><strong>Solusi</strong></td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from guru_rph_ringkas where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' order by `tanggal` ");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	$kode_rpp = $t->kode_rpp;
	$trpp = $this->db->query("select * from `guru_rpp_induk` where `id_guru_rpp_induk`='$kode_rpp'");
	$sk ='';
	$kd = '';
	$materi ='';
	foreach($trpp->result() as $rpp)
		{
		$materi = $rpp->materi_pembelajaran;
		$sk = $rpp->standar_kompetensi;
		$kd = $rpp->kompetensi_dasar;
		}

	$dinane = tanggal_ke_hari($t->tanggal);
	$keterangan = strip_tags($t->hambatan_siswa);
	$keterangan = strtoupper($keterangan);
	if (substr($keterangan,0,5) != 'TIDAK') 
		{
		if (!empty($keterangan))
			{ 	
			echo '<tr valign="top"><td align="center">'.$nomor.'</td><td>'.date_to_long_string($t->tanggal).'</td>
<td align="center">'.$t->kelas.'</td><td>'.$t->mapel.'</td><td>'.$sk.' '.$kd.' '.substr(strip_tags($materi),0,250).' </td><td>'.$t->hambatan_siswa.'</td><td>'.$t->solusi.'</td></tr>';
			$nomor++;
			}
		}
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



