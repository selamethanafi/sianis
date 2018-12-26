<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 14 Jan 2016 08:26:47 WIB 
// Nama Berkas 		: mencetak_perilakupns.php
// Lokasi      		: application/views/shared/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>Buku Catatan Perilaku PNS - <?php echo $this->config->item('nama_web');?></title>
</head>
<?php
$tc = $this->db->query("select * from `p_pegawai` where `nip` = '$nip'");
foreach($tc->result() as $c)
{
	$nama_pegawai = $c->nama;
}

if($rekap == 'rekap')
{
	$td = $this->db->query("select * from `pkg_masa` where tahun = '$tahun'");
	foreach($td->result() as $d)
	{
		$t1 = $d->awal;
		$t2 = $d->akhir;
	}

	$lebar = "670";
	$hasil_skp = '';
	$tb = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and `kode` = '$nip'");
	foreach($tb->result() as $b)
	{
		$hasil_skp = $b->skp;
	}
	$ta = $this->db->query("select * from `perilaku_pns` where tahun = '$tahun' and `nip` = '$nip' order by bulan limit $awal,$akhir");
	$ada = $ta->num_rows();
	//tanggal awal
	$bulane = $awal;
	$bulane++;
	if($awal < 10)
	{
		$bulane = '0'.$bulane;
	}
	$tb = $this->db->query("select * from `perilaku_pns` where tahun = '$tahun' and `nip` = '$nip' and `bulan` = '$bulane'");
	foreach($tb->result() as $b)
	{
		$bulan = angka_jadi_bulan($b->bulan);
		$tanggalawal = $b->awal_bulan.' '.$bulan.' '.$tahun;
	}
	$bulane = $akhir;
	if($akhir < 10)
	{
		$bulane = '0'.$bulane;
	}

	$tb = $this->db->query("select * from `perilaku_pns` where tahun = '$tahun' and `nip` = '$nip' and `bulan` = '$bulane'");
	foreach($tb->result() as $b)
	{
		$bulan2 = angka_jadi_bulan($b->bulan);
		$tanggalakhir = $b->akhir_bulan.' '.$bulan2.' '.$tahun;
	}
	echo '<div id="isi"><table width="'.$lebar.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td align ="center"><a href="'.base_url().''.$tautanbalik.'"><h2>BUKU CATATAN PERILAKU PEGAWAI NEGERI SIPIL</h2></a></td></tr></table><br /><br />';
	if ($ada==0)
	{
		echo 'Belum ada catatan perilaku atas nama '.$nama_pegawai.' <a href="'.base_url().''.$tautanbalik.'"><h2>Kembali</h2></a>';
	}
	else
	{
		$masa = $akhir - $awal;
		echo '<table width="'.$lebar.'" bgcolor="#FFF" cellpadding="2" cellspacing="1" class="widget-small"><tr><td width="100">Nama</td><td width="5">:</td><td>'.$nama_pegawai.'</td></tr><tr><td>NIP</td><td>:</td><td>'.$nip.'</td></tr><tr><td>Unit organisasi</td><td>:</td><td>'.$this->config->item('sek_nama').'</td></tr></table><br />';
		echo '<table width="'.$lebar.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small"><tr bgcolor="#FFF"><td width="50" align ="center">NO</td><td width="150" align ="center">Tanggal</td><td width="220" align ="center">URAIAN</td><td align ="center">Nama/NIP dan <br />Paraf Pejabat Penilai</td></tr><tr bgcolor="#FFF"><td width="50" align ="center">1</td><td width="150" align ="center">2</td><td width="220" align ="center">3</td><td align ="center">4</td></tr>';
		$pelayanan = 0;
		$komitmen = 0;
		$integritas = 0;
		$disiplin = 0;
		$kerjasama = 0;
		$kepemimpinan = 0;
		foreach($ta->result() as $a)
		{
			$pelayanan = $pelayanan + $a->pelayanan;
			$komitmen = $komitmen + $a->komitmen;
			$integritas = $integritas + $a->integritas;
			$disiplin = $disiplin + $a->disiplin;
			$kerjasama = $kerjasama + $a->kerjasama;
			$kepemimpinan = $kepemimpinan + $a->kepemimpinan;
		}
		if((empty($hasil_skp)) or ($hasil_skp == 0))
		{
			$hasil_skp = '-';
		}
		$pelayanan = round($pelayanan / $masa,2	);
		$komitmen = round($komitmen / $masa,2);
		$integritas = round($integritas / $masa,2);
		$disiplin = round($disiplin / $masa,2);
		$kerjasama = round($kerjasama / $masa,2);
		$kepemimpinan = round($kepemimpinan / $masa,2);
		/*
		if($kepemimpinan >0)
		{
			$jumlahperilaku = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama + $kepemimpinan;
			$rataperilaku = round($jumlahperilaku / 6,2);
		}
		else
		{
		*/
		$jumlahperilaku = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama;
		$rataperilaku = round($jumlahperilaku / 5,2);
		//	}
		echo '<tr bgcolor="#FFF"><td align="center">'.$nomor.'</td><td  align="center">'.$tanggalawal.'<br />s.d.<br />'.$tanggalakhir.'</td><td><br />Penilaian SKP sampai dengan akhir '.$bulan2.' '.$tahun.' = '.$hasil_skp.'<br />Penilaian perilaku kerja sebagai berikut:<br /><table><tr><td>Orientasi Pelayanan</td><td> = '.$pelayanan.' '.predikat_perilaku($pelayanan).'</td></tr><tr><td>Integritas</td><td> = '.$integritas.' '.predikat_perilaku($integritas).'</td></tr><tr><td>Komitmen</td><td> = '.$komitmen.' '.predikat_perilaku($komitmen).'</td></tr><tr><td>Disiplin</td><td> = '.$disiplin.' '.predikat_perilaku($disiplin).'</td></tr><tr><td>Kerjasama</td><td> = '.$kerjasama.' '.predikat_perilaku($kerjasama).'</td></tr><tr><td>Kepemimpinan</td>';
		/*
		if($a->kepemimpinan>0)
		{
			echo '<td> = '.$a->kepemimpinan.' '.predikat_perilaku($a->kepemimpinan).'</td>';
		}
		else
		{
		*/
		echo '<td> = </td>';

		//	}
		echo '</tr><tr><td colspan="3">------------------------------------------</td></tr><tr><td>Jumlah</td><td> = '.$jumlahperilaku.'</td></tr><tr><td>Nilai rata - rata</td><td> = '.$rataperilaku.' '.predikat_perilaku($rataperilaku).'</td></tr></table><br /></td><td align="center">'.$a->jabatan_penilai.'<br /><br /><br /><br />'.$a->nama_penilai.'<br />';
		if (!empty($a->nip_penilai))
		{echo 'NIP '.$a->nip_penilai.'';}
		echo '</td></tr>';
		$nomor++;
	}
	echo '</table>';

}
else
{
	$lebar = "670";
	$ta = $this->db->query("select * from `perilaku_pns` where tahun = '$tahun' and `nip` = '$nip'");
	if ((empty($awal)) and (empty($akhir)))
	{
		$ta = $this->db->query("select * from `perilaku_pns` where tahun = '$tahun' and `nip` = '$nip'");
	}
	else
	{
		$ta = $this->db->query("select * from `perilaku_pns` where tahun = '$tahun' and `nip` = '$nip' limit $awal,$akhir");
		

	}
	$ada = $ta->num_rows();
	echo '<div id="isi"><table width="'.$lebar.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td align ="center"><a href="'.base_url().''.$tautanbalik.'"><h2>BUKU CATATAN PERILAKU PEGAWAI NEGERI SIPIL</h2></a></td></tr></table><br /><br />';
	if ($ada==0)
	{
		echo 'Belum ada catatan perilaku atas nama '.cari_nama_pegawai($kode).' <a href="'.base_url().''.$tautanbalik.'"><h2>Kembali</h2></a>';
}
else
{


echo '<table width="'.$lebar.'" bgcolor="#FFF" cellpadding="2" cellspacing="1" >
<tr><td width="100">Nama</td><td width="5">:</td><td>'.$nama_pegawai.'</td></tr>
<tr><td>NIP</td><td>:</td><td>'.$nip.'</td></tr>
<tr><td>Unit organisasi</td><td>:</td><td>'.$this->config->item('sek_nama').'</td></tr>
</table><br />';
echo '<table width="'.$lebar.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr bgcolor="#FFF"><td width="50" align ="center">NO</td><td width="150" align ="center">Tanggal</td><td width="220" align ="center">URAIAN perbulan</td><td align ="center">Nama/NIP dan <br />Paraf Pejabat Penilai</td></tr><tr bgcolor="#FFF"><td width="50" align ="center">1</td><td width="150" align ="center">2</td><td width="220" align ="center">3</td><td align ="center">4</td></tr>';
$nomor = $awal+1;
foreach($ta->result() as $a)
	{
	$bulan = angka_jadi_bulan($a->bulan);
	$tanggalawal = $a->awal_bulan.' '.$bulan.' '.$tahun;
	$tanggalakhir = $a->akhir_bulan.' '.$bulan.' '.$tahun;
	$pelayanan = $a->pelayanan;
	$komitmen = $a->komitmen;
	$integritas = $a->integritas;
	$disiplin = $a->disiplin;
	$kerjasama = $a->kerjasama;
	$kepemimpinan = $a->kepemimpinan;
	$hasil_skp = $a->hasil_skp;
	if((empty($hasil_skp)) or ($hasil_skp == 0))
		{
		$hasil_skp = '-';
		}
	$kepemimpinan = round($kepemimpinan / 12,2);
	if($kepemimpinan>0)
	{
		$jumlahperilaku = 511;//$pelayanan + $komitmen + $integritas + $disiplin + $kerjasama + $kepemimpinan;
		$rataperilaku = round($jumlahperilaku/6,2);
	}
	else
	{
		$jumlahperilaku = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama + $kepemimpinan;
		$rataperilaku = round($jumlahperilaku / 5,2);
	}

	echo '<tr bgcolor="#FFF"><td align="center">'.$nomor.'</td><td  align="center">'.$tanggalawal.'<br />s.d.<br />'.$tanggalakhir.'</td><td><br />Penilaian SKP sampai dengan akhir '.$bulan.' '.$tahun.' = '.$hasil_skp.'<br />Penilaian perilaku kerja sebagai berikut:<br /><table><tr><td>Orientasi Pelayanan</td><td> = '.$a->pelayanan.' '.predikat_perilaku($a->pelayanan).'</td></tr><tr><td>Integritas</td><td> = '.$a->integritas.' '.predikat_perilaku($a->integritas).'</td></tr><tr><td>Komitmen</td><td> = '.$a->komitmen.' '.predikat_perilaku($a->komitmen).'</td></tr><tr><td>Disiplin</td><td> = '.$a->disiplin.' '.predikat_perilaku($a->disiplin).'</td></tr><tr><td>Kerjasama</td><td> = '.$a->kerjasama.' '.predikat_perilaku($a->kerjasama).'</td></tr><tr><td>Kepemimpinan</td>';
	if($a->kepemimpinan>0)
	{
		echo '<td> = '.$a->kepemimpinan.' '.predikat_perilaku($a->kepemimpinan).'</td>';
	}
	else
	{
		echo '<td> = </td>';

	}
	echo '</tr><tr><td colspan="3">------------------------------------------</td></tr><tr><td>Jumlah</td><td> = '.$jumlahperilaku.'</td></tr><tr><td>Nilai rata - rata</td><td> = '.$rataperilaku.' '.predikat_perilaku($rataperilaku).'</td></tr></table><br /></td><td align="center">'.$a->jabatan_penilai.'<br /><br /><br /><br />'.$a->nama_penilai.'<br />';
if (!empty($a->nip_penilai))
		{echo 'NIP '.$a->nip_penilai.'';}
	echo '</td></tr>';
	$nomor++;
	}

echo '</table>';
}
}
echo '<br /></div>';
?>
<script>window.print()</script>
