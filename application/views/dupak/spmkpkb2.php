<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: bg_atas_cetak.php
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
</head>
<body>
<div class="potret">
<table width="100%">
<tr><td></td><td width="15%">LAMPIRAN III :</td><td width="40%" colspan="2">PERATURAN BERSAMA</td></tr>
<tr><td></td><td></td><td colspan="2">MENTERI PENDIDIKAN NASIONAL DAN</td></tr>
<tr><td></td><td></td><td colspan="2">KEPALA BADAN KEPEGAWAIAN NEGARA</td></tr>
<tr><td></td><td></td><td>NOMOR</td><td>: 03/V/PB/2010</td></tr>
<tr><td></td><td></td><td>NOMOR</td><td>: 14 Tahun 2010 </td></tr>
<tr><td></td><td></td><td>TANGGAL</td><td>:  6 Mei 2010</td></tr>
</table>
<br />
<?php
$thnajaran = cari_thnajaran();
$semester = cari_semester();
?>
<p class="text-center">SURAT PERNYATAAN<br />
MELAKUKAN KEGIATAN PENGEMBANGAN KEPROFESIAN BERKELANJUTAN</p>
<table width="100%">
<tr><td colspan="3">Yang bertanda tangan di bawah ini :</td></tr>
<tr><td width="5%"><td width="30%">Nama</td><td>: <?php echo cari_kepala($thnajaran,$semester);?></td></tr>
<tr><td></td><td>NIP</td><td>: <?php echo cari_nip_kepala($thnajaran,$semester);?></td></tr>
<?php
	$nipkepala = cari_nip_kepala($thnajaran,$semester);
	$usernamekepala = $this->dupak->nip_jadi_username($nipkepala);
	$datapangkatkepala = $this->dupak->datapangkatterakhir($usernamekepala);
?>
<tr><td></td><td>Pangkat / Golongan Ruang / TMT</td><td>: <?php echo $datapangkatkepala['pangkat'].' / '.$datapangkatkepala['gol'].' / '.$datapangkatkepala['tmt'];?></td></tr>
<tr><td></td><td>Jabatan</td><td>: Kepala Madrasah</td></tr>
<tr><td></td><td>Unit Kerja</td><td>: <?php echo $this->config->item('unit_kerja').' '.$this->config->item('sek_kab');?></td></tr>
<tr><td colspan="3">Menyatakan bahwa :</td></tr>
<tr><td width="5%"><td width="30%">Nama</td><td>: <?php echo $dataguru['nama'];?></td></tr>
<tr><td></td><td>NIP</td><td>: <?php echo $dataguru['nip'];?></td></tr>
<tr><td></td><td>NUPTK / NPK</td><td>: <?php 
if(empty($dataguru['nuptk']))
{
	echo '-';
}
else
{
	echo $dataguru['nuptk'];
}

echo ' / '.$dataguru['npk'];?></td></tr>
<tr><td></td><td>Pangkat / Golongan Ruang / TMT</td><td>: <?php echo $datapangkat['pangkat'].' / '.$datapangkat['gol'].' / '.$datapangkat['tmt'];?></td></tr>

<tr><td></td><td>Jabatan</td><td>: <?php echo $datapangkat['jabatan'];?></td></tr></table>
Telah melakukan kegiatan pengembangan keprofesian berkelanjutan, sebagai berikut :
<table width="100%"  class="table table-black-bordered">
<tr align="center"><td width="25">No</td><td colspan="2">Uraian Kegiatan </td><td>Tanggal</td><td>Satuan Hasil</td><td>Jumlah Volume Kegiatan</td><td>Angka Kredit</td><td>Jumlah Angka Kredit</td><td>Bukti Fisik</td></tr>
<tr align="center"><td>1</td><td colspan="2">2</td><td>3</td><td width="100">4</td><td width="50">5</td><td width="50">6</td><td width="50">7</td><td>8</td></tr>
<?php
$golongann = Pangkat_Sesudah($golongan);
$tc = $this->db->query("SELECT * FROM `dupak_dupak` where `username` = '$username' and `golongan`='$golongann'");
$nomor = 1;
$jpd = 0;
echo '<tr><td align="center">A</td><td colspan="9">Melaksanakan Pengembangan Diri</td></tr>';
foreach($tc->result() as $c)
{
	$kode = $c->kode; 
	$tipepd = $this->dupak->Tipe_Pd($kode);
	if($tipepd == 'pd')
	{
		$ta = $this->db->query("SELECT * FROM `dupak_pd` where `username`='$nim' and `golongan`='$golongann' and `kode`='$kode'");
		$nama_kegiatan = '<ol type="a">';
		$tanggal = '<ol>';
		$cacahpd = 0;
		$sudah = 0;
		foreach($ta->result() as $a)
		{
			
			$nama_kegiatan .= '<li>'.$a->nama_kegiatan.'</li>';
			$tanggal .= '<li>'.$a->tanggal.'</li>';
			if((empty($a->nama_kegiatan)) or (empty($a->tanggal)))
			{
				$sudah++;
			}
			$cacahpd++;
		}
		$nama_kegiatan .= '</ol>';
		$tanggal .= '</ol>';
		$jak = $cacahpd * $this->dupak->Cari_Ak($kode);
		echo '<tr><td></td><td align="center">'.$nomor.'</td><td>'.$nama_kegiatan.'</td><td width="100">'.$tanggal.'</td><td width="50">'.$this->dupak->Cari_Satuan($kode).'</td><td width="50" align="center">'.$cacahpd.'</td><td width="50" align="center">'.$this->dupak->Cari_Ak($kode).'</td><td align="center">'.$jak.'</td><td>'.$this->dupak->Cari_Satuan($kode).'</td></tr>';
		if($sudah>0)
		{
		echo '<tr class="danger"><td></td><td align="center">'.$nomor.'</td><td align="center" colspan="7">Masih ada '.$sudah.' kekurangan data. Silakan memeriksa nama kegiatan dan tanggal kegiatan</td></tr>';

		}

		$nomor++;
		$jpd = $jpd+$jak;
	}

}
echo '<tr><td></td><td align="center"></td><td colspan="5" align="center">Jumlah</td><td align="center">'.$jpd.'</td><td></td></tr>';
echo '<tr><td align="center">B</td><td colspan="9">Melaksanakan Publikasi Ilmiah</td></tr>';
$jpi = 0;
$jak = 0;
foreach($tc->result() as $c)
{
	$kode = $c->kode; 
	$tipepd = $this->dupak->Tipe_Pd($kode);
	if($tipepd == 'pi')
	{
		$ta = $this->db->query("SELECT * FROM `dupak_pd` where `username`='$nim' and `golongan`='$golongann' and `kode`='$kode'");
		$nama_kegiatan = '';
		$tanggal = '';
		$cacahpd = 0;
		$sudah = 0;
		foreach($ta->result() as $a)
		{
			if(empty($nama_kegiatan))
			{
				$nama_kegiatan .= $a->nama_kegiatan;
			}
			else
			{
				$nama_kegiatan .= '; '.$a->nama_kegiatan;
			}
			if(empty($tanggal))
			{
				$tanggal .= $a->tanggal;
			}
			else
			{
				$tanggal .= '; '.$a->tanggal;
			}
			if((empty($a->nama_kegiatan)) or (empty($a->tanggal)))
			{
				$sudah++;
			}
			$cacahpd++;
		}
		$jak = $cacahpd * $this->dupak->Cari_Ak($kode);
		echo '<tr><td></td><td align="center">'.$nomor.'</td><td>'.$nama_kegiatan.'</td><td width="100">'.$tanggal.'</td><td width="50">'.$this->dupak->Cari_Satuan($kode).'</td><td width="50" align="center">'.$cacahpd.'</td><td width="50">'.$this->dupak->Cari_Ak($kode).'</td><td>'.$jak.'</td><td>'.$this->dupak->Cari_Satuan($kode).'</td></tr>';
		if($sudah>0)
		{
		echo '<tr class="danger"><td></td><td align="center">'.$nomor.'</td><td align="center" colspan="7">Masih ada '.$sudah.' kekurangan data. Silakan memeriksa nama kegiatan dan tanggal kegiatan</td></tr>';

		}
		$nomor++;
		$jpi = $jpi + $jak;
	}

}
echo '<tr><td></td><td align="center"></td><td colspan="5" align="center">Jumlah</td><td align="center">'.$jpi.'</td><td></td></tr>';
$jak = 0;
$jki = 0;
echo '<tr><td align="center">C</td><td colspan="9">Melaksanakan Karya Inovatif</td></tr>';
foreach($tc->result() as $c)
{
	$kode = $c->kode; 
	$tipepd = $this->dupak->Tipe_Pd($kode);
	if($tipepd == 'ki')
	{
		$ta = $this->db->query("SELECT * FROM `dupak_pd` where `username`='$nim' and `golongan`='$golongann' and `kode`='$kode'");
		$nama_kegiatan = '';
		$tanggal = '';
		$cacahpd = 0;
		$sudah = 0;
		foreach($ta->result() as $a)
		{
			if(empty($nama_kegiatan))
			{
				$nama_kegiatan .= $a->nama_kegiatan;
			}
			else
			{
				$nama_kegiatan .= '; '.$a->nama_kegiatan;
			}
			if(empty($tanggal))
			{
				$tanggal .= $a->tanggal;
			}
			else
			{
				$tanggal .= '; '.$a->tanggal;
			}
			if((empty($a->nama_kegiatan)) or (empty($a->tanggal)))
			{
				$sudah++;
			}

			$cacahpd++;
		}
		$jak = $cacahpd * $this->dupak->Cari_Ak($kode);
		echo '<tr><td></td><td align="center">'.$nomor.'</td><td>'.$nama_kegiatan.'</td><td width="100">'.$tanggal.'</td><td width="50">'.$this->dupak->Cari_Satuan($kode).'</td><td width="50" align="center">'.$cacahpd.'</td><td width="50">'.$this->dupak->Cari_Ak($kode).'</td><td>'.$jak.'</td><td>'.$this->dupak->Cari_Satuan($kode).'</td></tr>';
		if($sudah>0)
		{
		echo '<tr class="danger"><td></td><td align="center">'.$nomor.'</td><td align="center" colspan="7">Masih ada '.$sudah.' kekurangan data. Silakan memeriksa nama kegiatan dan tanggal kegiatan</td></tr>';

		}

		$nomor++;
		$jki = $jki + $jak;
	}

}
$jpkb = $jpi + $jpd + $jki;
echo '<tr><td></td><td align="center"></td><td colspan="5" align="center">Jumlah</td><td align="center">'.$jki.'</td><td></td></tr>';
echo '<tr><td></td><td align="center"></td><td colspan="5" align="center">Jumlah Angka Kredit Unsur PKB</td><td align="center">'.$jpkb.'</td><td></td></tr>';
?>
</table>
Demikian pernyataan ini dibuat dengan melampirkan hasil penilaian kinerja dan bukti fisik masing - masing,untuk dapat dipergunakan sebagaimana mestinya.<br />
<?php
$datamasa = $this->dupak->datamasa($nim,$golongann);
		echo '<table width="100%">
		<tr><td width="10%"></td><td></td><td  width="40%">'.$this->config->item('lokasi').',  '.date_to_long_string($datamasa['tanggal']).'</td></tr>
		<tr><td></td><td></td><td>Kepala Sekolah,<br /><br /><br /></td></tr>
		<tr><td></td><td></td><td>'.cari_kepala($thnajaran,$semester).'<br />NIP '.cari_nip_kepala($thnajaran,$semester).'</td></tr>
		</table>';
?>
</div>
</body>
</html>
