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
echo '<h4 class="text-center"><a href="'.base_url().'guru/formmencetak">Jurnal Penilaian Sikap Sosial dan Spritual</a></h4>';
?>
<table width="<?php echo $lebartabel;?>">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
</table>
<table class="table table-striped table-black-bordered">
<tr align="center"><td width="30">No.</td><td>Waktu</td><td>Nama</td><td>Kejadian/Perilaku</td><td>Butir Sikap</td><td>Pos / Neg</td><td>Tindak Lanjut</td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from `siswa_kredit` where `thnajaran` = '$thnajaran' and `semester` = '$semester' and `kodeguru`='$kodeguru' order by `tanggal` ASC");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	$jenis = '';
	$nis = $t->nis;
	$kd_pelanggaran = $t->kd_pelanggaran;
	$nama_pelanggaran = '';
	$butir = '';
	$tb = $this->db->query("select * from `m_kredit` where `kode` = '$kd_pelanggaran'");
	foreach($tb->result() as $b)
	{
		$nama_pelanggaran = $b->nama_pelanggaran;
		$butir = $b->butir;
	}
	if(substr($kd_pelanggaran,0,1) == 'Z')
	{
		$nama_pelanggaran = $t->kejadian;
		$butir = $t->butir;
		$pos = '+';
	}
	else
	{
		$pos = '-';
	}
	$tindak_lanjut = '';
	if(empty($t->tindak_lanjut))
	{
		$tindak_lanjut = 'Mengingatkan siswa supaya tidak mengulangi dan melaporkan ke wali kelas dan BP';
	}
	echo '<tr><td align="center">'.$nomor.'</td><td>'.tanggal($t->tanggal).'</td><td>'.nis_ke_nama($nis).'</td><td>'.$nama_pelanggaran.'</td><td>'.$butir.'</td><td align="center">'.$pos.'</td><td>'.$tindak_lanjut.'</td></tr>';
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
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.' Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.' Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
?>



