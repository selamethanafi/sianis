<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_agenda_harian_kepala_laboratorium.php
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
<?php
$lebartabel="100%";
?>
<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/formmencetak">Buku Tindak Lanjut Pelaksanaan Kegiatan <?php echo $namatugas;?></a></p></h3>
<table width="<?php echo $lebartabel;?>">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td width="350"><strong>Semester</strong></td><td>: <strong><?php echo $semester?></strong></td></tr>
</table>
<?php
$trph = $this->db->query("select * from `kalab_harian` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and `semester`='$semester' order by tanggal ASC");
$ada = count($trph->result());
if ($ada == 0)
	{
	echo "Belum ada data";
	}
else
{

echo '<div class="CSSTableGenerator"><table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Nama Kegiatan</strong></td><td><strong>Dukungan</strong></td><td><strong>Hambatan</strong></td><td><strong>Solusi</strong></td><td><strong>Keterangan</strong></td></tr>';
$nomor =1;
	foreach ($trph->result() as $t)
	{
		echo '<tr valign="top"><td align="center">'.$nomor.'</td><td>'.date_to_long_string($t->tanggal).'</td><td>'.$t->namakegiatan.'</td><td align=center>'.$t->dukungan.'</td><td align=center>'.$t->hambatan.'</td><td align=center>'.$t->solusi.'</td><td align=center>'.$t->keterangan_tindak_lanjut.'</td></tr>';
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


