<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_daftar_buku_pegangan.php
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
<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/formmencetak/14">Daftar Buku Pegangan Guru dan Siswa</a></p></h3>
<div class="CSSTableGenerator"><table width="100%">
<tr align="center"><td width="30"><strong>No</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Kelas</strong></td><td><strong>Judul, Pengarang, Penerbit</strong></td><td><strong>Keterangan</strong></td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from guru_buku_pegangan where kodeguru='$kodeguru'");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	if ($t->keterangan == '1')
		{
		$keterangan = 'Utama';
		}
		else
		{
		$keterangan = 'Pendukung';
		}
	$judul = '';
	if (!empty($t->judul))
		{
		$judul .= $t->judul;
		}
	if (!empty($t->pengarang))
		{
		$judul .= ", <strong>".$t->pengarang."</strong>";
		}
	if (!empty($t->penerbit))
		{
		$judul .= ", ".$t->penerbit;
		}
	echo "<tr><td align='center'>".$nomor."</td><td>".$t->mapel."</td>
<td align='center'>".$t->tingkat."</td>
<td>".$judul."</td>
<td>".$keterangan."</td></tr>";
	$nomor++;
	}
}
?>
</table></div>
<?php
if (empty($thnajaran))
	{
	$thnajaran=cari_thnajaran();
	}
if (empty($semester))
	{$semester=cari_semester();}
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
</div>


