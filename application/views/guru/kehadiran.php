<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kehadiran.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><?php echo '<a href="'.base_url().'guru/walikelas" class="btn btn-info"><b>Kembali ke daftar Tugas Walikelas</b></a></p>';?>
<table>
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></td></tr>
</table>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td width="250"><strong>Nama</strong></td><td><strong>Sakit</strong></td><td><strong>Izin</strong></td><td><strong>Tanpa Keterangan</strong></td><td><strong>Terlambat</strong></td><td><strong>Meninggalkan Sekolah</strong></td><td><strong>Membolos</strong></td><td><strong>Angka Kredit</strong></td></tr>
<?php
$nomor=1;
if(count($daftar_siswa->result())>0){
foreach($daftar_siswa->result() as $b)
{
	$nis =$b->nis;
	echo "<tr><td align=\"center\">".$nomor."</td><td width=\"150\">".nis_ke_nama($b->nis)."</td>";
	$tabs = $this->db->query("select * from siswa_absensi where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$sakit =0;
	$izin = 0;
	$alpa = 0;
	$bolos = 0;
	$izinx = 0;
	$terlambat = 0;

	foreach($tabs->result() as $dabs)
	{
		if ($dabs->alasan=='S')
			$sakit=$sakit+1;
		if ($dabs->alasan=='I')
			$izin=$izin+1;
		if ($dabs->alasan=='A')
			$alpa=$alpa+1;
		if ($dabs->alasan=='T')
			$terlambat=$terlambat+1;
		if ($dabs->alasan=='B')
			$bolos=$bolos+1;
		if ($dabs->alasan=='M')
			$izinx=$izinx+1;
	}

		if ($sakit>0)
		{
		echo '<td align="center">'.$sakit.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($izin>0)
		{
		echo '<td align="center">'.$izin.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($alpa>0)
		{
		echo '<td align="center">'.$alpa.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($bolos>0)
		{
		echo '<td align="center">'.$bolos.'</td>';
		}
		else
		{
		echo '<td></td>';
		}

	if ($terlambat>0)
		{
		echo '<td align="center">'.$terlambat.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($izinx>0)
		{
		echo '<td align="center">'.$izinx.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	//kredit
	$tk = $this->db->query("select * from siswa_kredit where thnajaran='$thnajaran' and nis='$nis'");
	$poin=0;
	foreach($tk->result() as $dk)
	{
		$poin = $poin + $dk->point;
	}

	if ($poin>0)
		{
		echo '<td align="center">'.$poin.'</td>';
		}
		else
		{
		echo '<td></td>';
		}

	echo '</tr>';
	$nomor++;
}
	echo '</table></div>';
}
else{
echo '<div class="alert alert-info">Belum ada data kehadiran, silakan hubungi BP';
}

?>

</div></div></div>
