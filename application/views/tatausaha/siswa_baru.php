<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: siswa_baru.php
// Lokasi      		: application/views/tatausaha
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h3>Daftar peserta Didik Baru</h3>
Tahun Pelajaran : <strong><?php echo $thnajaran;echo '</strong><br />';
$tanggalpenerimaan ='';
$ta = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
foreach($ta->result() as $a)
{
	$tanggalpenerimaan = $a->awal;
}
echo 'Tanggal Penerimaan : <strong>'.date_to_long_string($tanggalpenerimaan).'</strong><br />';
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="50"><strong>Nomor</strong><td width="50"><strong>NIS</strong></td><td width="50"><strong>No Daftar</strong></td><td width="200"><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Tempat, Tanggal Lahir</strong></td><td><strong>L/P</strong></td><td><strong>Asal SLTP</strong></td><td width="50"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
$tsiswa_kelas = $this->db->query("select * from `datsis` where `ket`='Y' and `tglditerima`='$tanggalpenerimaan' order by nama ASC");
foreach($tsiswa_kelas->result() as $b)
{
	$nis = $b->nis;
	$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='1' and `nis`='$nis'");
	$kelas = '';
	foreach($tc->result() as $c)
	{
		$kelas = $c->kelas;
	}
	echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->nis."</td><td align=\"center\">".$b->nomor_pendaftaran."</td><td>".$b->nama."</td><td align=\"center\">".$kelas."</td></td><td>".$b->tmpt.", ".date_to_long_string($b->tgllhr)."</td><td valign=\"center\">".$b->jenkel."</td><td valign=\"center\">".$b->sltp."</td>
<td><a href='".base_url()."index.php/tatausaha/ijazah/".$b->nis."' title='Ubah Data Siswa'><span class=\"fa fa-edit\"></span></a></td></tr>";

$nomor++;
}

?>
</table>
</div>
