<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><?php echo '<a href="'.base_url().'guru/walikelas" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> <b>Kembali ke daftar Tugas Walikelas</b></a>';?></p>
<?php
$tperingkat = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and semester='$semester' and kelas='$kelas' order by jumlah_kognitif DESC");
	$peringkat = 1;
	foreach($tperingkat->result() as $d)
	{
	$nis = $d->nis;
	$this->db->query("update siswa_peringkat set peringkat_kelas='$peringkat' where thnajaran ='$thnajaran' and semester='$semester' and nis='$nis'");
	$peringkat++;
	}

	$tperingkatb = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and semester='$semester' and kelas='$kelas' order by jumlah DESC");
	$peringkatb = 1;
	foreach($tperingkatb->result() as $e)
	{
	$nis = $e->nis;
	$this->db->query("update siswa_peringkat set peringkat_kelas_kumulatif='$peringkatb' where thnajaran ='$thnajaran' and semester='$semester' and nis='$nis'");
	$peringkatb++;
	}

	?>
<h4>Peringkat Siswa Berdasarkan Jumlah Nilai Kognitif</h4>
	<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jumlah Kognitif</strong></td><td><strong>Jumlah Psikomotor</strong></td><td><strong>Jumlah</strong></td><td><strong>Peringkat Kelas</strong></td></tr>

<?php
$nomor=1;
$tf = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and kelas='$kelas' and semester='$semester' order by jumlah_kognitif DESC");
foreach($tf->result() as $f)
{
		$nis=$f->nis;
		$nama = nis_ke_nama($nis);
	echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$nis."</td><td>".$nama."</td><td align=\"center\">".$f->jumlah_kognitif."</td><td align=\"center\">".$f->jumlah_psikomotor."</td><td align=\"center\">".$f->jumlah."</td><td align=\"center\">".$f->peringkat_kelas."</td></tr>";

$nomor++;
}
?>
</table><br>
<h4>Peringkat Siswa Berdasarkan Jumlah Nilai Kognitif dan Psikomotor</h4>
	<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jumlah Kognitif</strong></td><td><strong>Jumlah Psikomotor</strong></td><td><strong>Jumlah</strong></td><td><strong>Peringkat Kelas</strong></td></tr>

<?php
$nomor=1;
$tg = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and kelas='$kelas' and semester='$semester' order by jumlah DESC");
foreach($tg->result() as $g)
{
		$nis=$g->nis;
		$nama = nis_ke_nama($nis);
	echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$nis."</td><td>".$nama."</td><td align=\"center\">".$g->jumlah_kognitif."</td><td align=\"center\">".$g->jumlah_psikomotor."</td><td align=\"center\">".$g->jumlah."</td><td align=\"center\">".$g->peringkat_kelas_kumulatif."</td></tr>";

$nomor++;
}
?>
</div></div></div>
