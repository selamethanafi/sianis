<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : cetak_penerimaan.php
// Lokasi      : application/views/keuangan
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
if ((!empty($thnajaran)) and ($proses == 1))
{
	$totalpenerimaan = 0;
	$tahun1 = substr($thnajaran,0,4);
	$tahun2 = substr($thnajaran,5,4);
	echo '<h3><p class="text-center"><a href="'.base_url().'keuangan/penerimaan">REKAPITULASI PENERIMAAN PEMBAYARAN SISWA TAHUN '.$thnajaran.'</a></p></h3>';
	$nomor=1;
	$totalpenerimaantingkat = 0;
	echo '<div class="CSSTableGenerator"><table width="100%">';
	echo '<tr align="center"><td align="center">Bulan</td><td width="6%">Juli  '.$tahun1.'</td><td width="6%">Agustus</td><td width="6%">September</td><td width="6%">Oktober</td><td width="6%">November</td><td width="6%">Desember</td><td width="6%">Januari</td><td width="6%">Februari</td><td width="6%">Maret</td><td width="6%">April</td><td width="6%">Mei</td><td width="6%">Juni</td><td width="6%">Jumlah</td><tr>';
	echo "<tr><td align=\"center\">Penerimaan</td>";
	//cari pembayaran
	$urutan = 1;
	$peritem = 0;
	$total = 0;
	do
	{
		$bulan = $urutan + 6;
		if ($urutan > 6)
		{
			$bulan = $urutan - 6;
		}
		if ($bulan<10)
		{
			$bulane = '0'.$bulan;
		}
		else
		{
			$bulane = $bulan;
		}
		if ($urutan > 6)
		{
			$thnbln = $tahun2.'-'.$bulane.'%';
		}
		else
		{
			$thnbln = $tahun1.'-'.$bulane.'%';
		}
		$td = $this->db->query("select * from `siswa_bayar` where `tanggal` like '$thnbln'");
		$ada = $td->num_rows();
		$perbln = 0;
		foreach($td->result() as $d)
		{
			$perbln = $perbln + $d->besar;
		}
		$peritem = $peritem + $perbln;
		echo '<td align="right">'.buang_rp(xduit($perbln)).'</td>';
		$urutan++;
	}
	while ($urutan<13);
	echo '<td align="right">'.buang_rp(xduit($peritem)).'</td></tr></table></div>';
	echo '<p>Jumlah Penerimaan <strong>'.xduit($peritem).'</strong> Terbilang <strong>'.xduitf($peritem).'</strong><p>';	
	$jumlahpenerimaan = $peritem;
	//cari pembayaran kelas X
	$nomor=1;
	$urutan = 1;
	do
	{
		$tbln[$urutan]=0;
		$urutan++;
	}
	while ($urutan<14);
	$totalpenerimaantingkat = 0;
	$tingkat = 'X';
	echo '<p>Tingkat : <strong> '.$tingkat.'</strong><p>';	
	echo '<div class="CSSTableGenerator"><table width="100%">';
	echo '<tr align="center"><td>Macam Pembayaran</td><td width="6%">Juli</td><td width="6%">Agustus</td><td width="6%">September</td><td width="6%">Oktober</td><td width="6%">November</td><td width="6%">Desember</td><td width="6%">Januari</td><td width="6%">Februari</td><td width="6%">Maret</td><td width="6%">April</td><td width="6%">Mei</td><td width="6%">Juni</td><td width="6%">Jumlah</td><tr>';
	$te = $this->db->query("select * from `m_uang_besar` where `thnajaran`='$thnajaran' and `tingkat`='$tingkat'");
	foreach($te->result() as $e)
	{
		$macam_pembayaran = $e->macam_pembayaran;
		$urutan = 1;
		echo '<tr><td>'.$macam_pembayaran.'</td>';

		$peritem = 0;
		$total = 0;
		do
		{
			$bulan = $urutan + 6;
			if ($urutan > 6)
			{
				$bulan = $urutan - 6;
			}
			if ($bulan<10)
			{
				$bulane = '0'.$bulan;
			}
			else
			{
				$bulane = $bulan;
			}
			if ($urutan > 6)
			{
				$thnbln = $tahun2.'-'.$bulane.'%';
			}
			else
			{
				$thnbln = $tahun1.'-'.$bulane.'%';
			}
			$td = $this->db->query("select * from `siswa_bayar` where `macam_pembayaran` = '$macam_pembayaran' and `tanggal` like '$thnbln'");
			$ada = $td->num_rows();
			$perbln = 0;
			foreach($td->result() as $d)
			{
				$nis = $d->nis;
				$tc = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' and `thnajaran`='$thnajaran'");
				$kelase = '';
				foreach($tc->result() as $c)
				{
					$kelase = $c->kelas;
				}
				if(substr($kelase,0,2) == 'X-')
				{
					$perbln = $perbln + $d->besar;
				}
			}
			$tbln[$urutan]= $tbln[$urutan] + $perbln;
			$peritem = $peritem + $perbln;
			echo '<td align="right">'.buang_rp(xduit($perbln)).'</td>';
			$urutan++;
		}
		while ($urutan<13);
		echo '<td align="right">'.buang_rp(xduit($peritem)).'</td></tr>';
	}
	echo '<tr bgcolor="#FFF" align="center"><td>Jumlah</td>';
	$urutan = 1;
	$total = 0;
	do
	{
		echo '<td width="6%" align="right">'.buang_rp(xduit($tbln[$urutan])).'</td>';
		$total = $total + $tbln[$urutan];
		$urutan++;
	}
	while ($urutan<13);
	echo '<td>'.buang_rp(xduit($total)).'</td></tr></table></div>';
	$totalpenerimaantingkat = $totalpenerimaantingkat + $total;
	//cari pembayaran kelas XI
	$nomor=1;

	$urutan = 1;
	do
	{
		$tbln[$urutan]=0;
		$urutan++;
	}
	while ($urutan<14);
	$tingkat = 'XI';
	echo '<p>Tingkat : <strong> '.$tingkat.'</strong><p>';	
	echo '<div class="CSSTableGenerator"><table width="100%">';
	echo '<tr align="center"><td>Macam Pembayaran</td><td width="6%">Juli</td><td width="6%">Agustus</td><td width="6%">September</td><td width="6%">Oktober</td><td width="6%">November</td><td width="6%">Desember</td><td width="6%">Januari</td><td width="6%">Februari</td><td width="6%">Maret</td><td width="6%">April</td><td width="6%">Mei</td><td width="6%">Juni</td><td width="6%">Jumlah</td><tr>';
	$te = $this->db->query("select * from `m_uang_besar` where `thnajaran`='$thnajaran' and `tingkat`='$tingkat'");
	foreach($te->result() as $e)
	{
		$macam_pembayaran = $e->macam_pembayaran;
		$urutan = 1;
		echo '<tr><td>'.$macam_pembayaran.'</td>';

		$peritem = 0;
		$total = 0;
		do
		{
			$bulan = $urutan + 6;
			if ($urutan > 6)
			{
				$bulan = $urutan - 6;
			}
			if ($bulan<10)
			{
				$bulane = '0'.$bulan;
			}
			else
			{
				$bulane = $bulan;
			}
			if ($urutan > 6)
			{
				$thnbln = $tahun2.'-'.$bulane.'%';
			}
			else
			{
				$thnbln = $tahun1.'-'.$bulane.'%';
			}
			$td = $this->db->query("select * from `siswa_bayar` where `macam_pembayaran` = '$macam_pembayaran' and `tanggal` like '$thnbln'");
			$ada = $td->num_rows();
			$perbln = 0;
			foreach($td->result() as $d)
			{
				$nis = $d->nis;
				$tc = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' and `thnajaran`='$thnajaran'");
				$kelase = '';
				foreach($tc->result() as $c)
				{
					$kelase = $c->kelas;
				}
				if(substr($kelase,0,3) == 'XI-')
				{
					$perbln = $perbln + $d->besar;
				}
			}
			$tbln[$urutan]= $tbln[$urutan] + $perbln;
			$peritem = $peritem + $perbln;
			echo '<td align="right">'.buang_rp(xduit($perbln)).'</td>';
			$urutan++;
		}
		while ($urutan<13);
		echo '<td align="right">'.buang_rp(xduit($peritem)).'</td></tr>';
	}
	echo '<tr bgcolor="#FFF" align="center"><td>Jumlah</td>';
	$urutan = 1;
	$total = 0;
	do
	{
		echo '<td width="6%" align="right">'.buang_rp(xduit($tbln[$urutan])).'</td>';
		$total = $total + $tbln[$urutan];
		$urutan++;
	}
	while ($urutan<13);
	echo '<td>'.buang_rp(xduit($total)).'</td></tr></table></div>';
	$totalpenerimaantingkat = $totalpenerimaantingkat + $total;
	//cari pembayaran kelas XI
	$nomor=1;

	$urutan = 1;
	do
	{
		$tbln[$urutan]=0;
		$urutan++;
	}
	while ($urutan<14);
	$tingkat = 'XII';
	echo '<p>Tingkat : <strong> '.$tingkat.'</strong><p>';	
	echo '<div class="CSSTableGenerator"><table width="100%">';
	echo '<tr align="center"><td>Macam Pembayaran</td><td width="6%">Juli</td><td width="6%">Agustus</td><td width="6%">September</td><td width="6%">Oktober</td><td width="6%">November</td><td width="6%">Desember</td><td width="6%">Januari</td><td width="6%">Februari</td><td width="6%">Maret</td><td width="6%">April</td><td width="6%">Mei</td><td width="6%">Juni</td><td width="6%">Jumlah</td><tr>';
	$te = $this->db->query("select * from `m_uang_besar` where `thnajaran`='$thnajaran' and `tingkat`='$tingkat'");
	foreach($te->result() as $e)
	{
		$macam_pembayaran = $e->macam_pembayaran;
		$urutan = 1;
		echo '<tr><td>'.$macam_pembayaran.'</td>';

		$peritem = 0;
		$total = 0;
		do
		{
				$bulan = $urutan + 6;
			if ($urutan > 6)
			{
				$bulan = $urutan - 6;
			}
			if ($bulan<10)
			{
				$bulane = '0'.$bulan;
			}
			else
			{
				$bulane = $bulan;
			}
			if ($urutan > 6)
			{
				$thnbln = $tahun2.'-'.$bulane.'%';
			}
			else
			{
				$thnbln = $tahun1.'-'.$bulane.'%';
			}
			$td = $this->db->query("select * from `siswa_bayar` where `macam_pembayaran` = '$macam_pembayaran' and `tanggal` like '$thnbln'");
			$ada = $td->num_rows();
			$perbln = 0;
			$adatc = 0;
			foreach($td->result() as $d)
			{
				$nis = $d->nis;
				$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `nis`='$nis'");
				$kelase = '';
				foreach($tc->result() as $c)
				{
					$kelase = $c->kelas;
				}
				if(substr($kelase,0,4) == 'XII-')
				{
					$perbln = $perbln + $d->besar;
				}
			}
			$tbln[$urutan]= $tbln[$urutan] + $perbln;
			$peritem = $peritem + $perbln;
			echo '<td align="right">'.buang_rp(xduit($perbln)).'</td>';
			$urutan++;
		}
		while ($urutan<13);
		echo '<td align="right">'.buang_rp(xduit($peritem)).'</td></tr>';
	}
	echo '<tr bgcolor="#FFF" align="center"><td>Jumlah</td>';
	$urutan = 1;
	$total = 0;
	do
	{
		echo '<td width="6%" align="right">'.buang_rp(xduit($tbln[$urutan])).'</td>';
		$total = $total + $tbln[$urutan];
		$urutan++;
	}
	while ($urutan<13);
	echo '<td>'.buang_rp(xduit($total)).'</td></tr></table></div>';
	$totalpenerimaantingkat = $totalpenerimaantingkat + $total;
	$kelebihan = $jumlahpenerimaan - $totalpenerimaantingkat;
	echo '<p>Jumlah Penerimaan <strong>'.xduit($totalpenerimaantingkat).'</strong> Terbilang <strong>'.xduitf($totalpenerimaantingkat).'</strong><p>';
	if($kelebihan != 0)
	{
		echo '<p>Jumlah Penerimaan Tunggakan <strong>'.xduit($kelebihan).'</strong> Terbilang <strong>'.xduitf($kelebihan).'</strong><p>';		
	}
}
else
{
	echo 'parameter yang dibutuhkan tidak disertakan atau data tidak ditemukan<br />';
}
echo '<p>per tanggal '.date_to_long_string(tanggal_hari_ini()).'</p>';
?>
</div></body></html>
