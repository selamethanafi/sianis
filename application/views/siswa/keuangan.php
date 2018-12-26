<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: keuangan.php
// Lokasi      		: application/views/siswa/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
if (!empty($nis))
{
	$taa = $this->db->query("select * from `siswa_kelas` where `nis`='$nis'");
	foreach($taa->result() as $aa)
	{
		$nis = $aa->nis;
		$kelas = $aa->kelas;
		$thnajaran = $aa->thnajaran;
		//cari di riwayat
		$tba = $this->db->query("select * from `siswa_kelas_tahun` where `thnajaran`='$thnajaran' and `nis`='$nis'");
		$adatba = $tba->num_rows();
		if($adatba == 0)
		{
			$this->db->query("insert into `siswa_kelas_tahun` (`thnajaran`,`nis`,`kelas`) values ('$thnajaran', '$nis', '$kelas')");
		}
	}

	$jmltagihan = 0;
	$jmlterbayar = 0;
	$tmacam = $this->db->query("select * from m_uang");
	echo '<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td>Tahun Pelajaran</td><td>Kelas</td><td>Macam Pembayaran</td>';
	echo '<td align="center" width="12%">Besar</td><td align="center" width="12%">Terbayar</td></tr>';
	$tsk = $this->db->query("select * from `siswa_kelas_tahun` where nis = '$nis' order by `thnajaran`");
	$jmltagihan = 0;
	foreach($tsk->result() as  $dsk)
	{
		$thnajaran = $dsk->thnajaran;
		$kelas = $dsk->kelas;
		$tingkat = kelas_jadi_tingkat($kelas);
		$tset = $this->db->query("select * from m_uang_besar where thnajaran='$thnajaran' and tingkat='$tingkat'");
		foreach($tset->result() as  $dset)
		{
			$macam_pembayaran = $dset->macam_pembayaran;
			$besar = $dset->besar;
			echo '<tr><td>'.$thnajaran.'</td><td>'.$kelas.'</td>';
			echo '<td>'.$macam_pembayaran.'</td><td align="right">'.number_format($besar).'</td>';
			$jmltagihan = $jmltagihan + $besar;
			//cari jumlah pembayaran
			$tby = $this->db->query("select * from siswa_bayar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and nis='$nis'");
			$terbayar = 0;
			foreach($tby->result() as $dby)
			{
				$terbayar = $terbayar + $dby->besar;
			}
			//terbayar
			$jmlterbayar = $jmlterbayar + $terbayar;
			echo '<td align="right">'.xduit($terbayar).'</td>';

		}

	
	}

	echo '</tr>';
	echo '<tr align="right"><td colspan="3">Jumlah</td><td>'.xduit($jmltagihan).'</td><td>'.xduit($jmlterbayar).'</td></tr>';
	$kekurangan = $jmltagihan - $jmlterbayar;
	if($kekurangan < 0)
	{
		echo '<tr align="right"><td colspan="3">Kelebihan</td><td colspan="2"><div class="alert alert-danger">'.xduit($kekurangan).'</div></td></tr>';
	}
	else
	{
		echo '<tr align="right"><td colspan="3">Kekurangan</td><td colspan="2"><p class="text-info">'.xduit($kekurangan).'</p></td></tr>';
	}
	echo '</table>';	
?>
<br>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun</strong></td><td><strong>Macam Pembayaran</strong></td>
<td><strong>Tanggal</strong></td><td><strong>Besar</strong></td></tr>
<?php
$nomor=1;
$jumlahbayar = 0;
if(count($querybayar->result())>0)
{
foreach($querybayar->result() as $qb)
	{
	$tanggalbayar = date_to_long_string($qb->tanggal);
echo "<tr><td align='center'>".$nomor."</td><td>".$qb->thnajaran."</td><td>".$qb->macam_pembayaran."</td><td>".$tanggalbayar."</td>
<td align=\"right\">".xduit($qb->besar)."</td></tr>";
	$jumlahbayar = $jumlahbayar + $qb->besar;
$nomor++;	
	}
	echo '<tr><td colspan="3" align="right">Jumlah Pembayaran</td><td colspan="2" align="right">'.xduit($jumlahbayar).'</td></tr>';
}
else{
echo "<tr><td colspan='5'>Belum Ada Data</td></tr>";
}

?>
</table><br />
<?php	
}
?>

</div>
