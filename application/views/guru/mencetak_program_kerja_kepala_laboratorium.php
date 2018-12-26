<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_program_kerja_kepala_laboratorium.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/table.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>Program Kerja <?php echo $namatugas;?> - <?php echo $this->config->item('nama_web');?></title>
</head>
<?php
$lebartabel="100%";
echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="100"><img src ="'.base_url().'/images/depag.png" width="90"> </td><td align="center"><h3>'.$this->config->item('baris1').'</h3><h3>'.$this->config->item('baris2').'</h3><h3>'.$this->config->item('baris3').'</h3><h3>'.$this->config->item('baris4').'</h3></TD><TR>
</table>';
?>
<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center">
<a href="<?php echo base_url(); ?>index.php/guru/formmencetak"><h3>Program Kerja <?php echo $namatugas;?></h3></a></td></tr></table>

<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td width="350"><strong>Semester</strong></td><td>: <strong><?php echo $semester?></strong></td></tr>
</table>
<?php
$trph = $this->db->query("select * from `kalab_proker` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and `semester`='$semester' order by nourut ASC");
$ada = count($trph->result());
if ($ada == 0)
	{
	echo "Belum ada data Program Kerja";
	}
else
{
?>
<div class="landscape">';
<div class="CSSTableGenerator">
<table>
<tr align="center"><td>No.</td><td>Nama Kegiatan</td><td>Tujuan</td><td>Sasaran</td><td>Waktu</td><td>Sumber Dana</td><td>Hasil yang hendak dicapai</td><td>Keterangan</td></tr>
<?php
$nomor =1;
	foreach ($trph->result() as $d)
	{
	echo '<tr><td align="center" width="30">'.$d->nourut.'</td><td>'.$d->namakegiatan.'</td><td>'.$d->tujuan.'</td><td>'.$d->sasaran.'</td><td>'.$d->waktu.'</td><td>'.$d->sumberdana.'</td><td>'.$d->hasil.'</td><td>'.$d->keterangan.'</td></tr>';

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


