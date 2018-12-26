<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 07 Mar 2015 20:39:26 WIB 
// Nama Berkas 		: pemeriksaan_berkas.php
// Lokasi      		: application/views/tatausaha
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>SKBK - <?php echo $this->config->item('nama_web');?></title>
</head>

<body>
<?php
$tanggalsurat = '';
$namakepala = '';
$nipkepala = '';
$namapengawas = '';
$nippengawas = '';
$nomor_skbk = '';
$tm = $this->db->query("SELECT * from nomor_skbk_skmt where thnajaran='$thnajaran' and semester='$semester'");
foreach($tm->result() as $p)
	{
	$nomor_skbk = $p->nomor_skmt;
	$tanggalsurat = date_to_long_string($p->tanggal);
	}
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$namapengawas = cari_pengawas($thnajaran,$semester);
$nippengawas = cari_nip_pengawas($thnajaran,$semester);

if($semester==1)
	{
	$semesterx='Gasal';
	}
if($semester==2)
	{
	$semesterx='Genap';
	}
$ta = $this->db->query("SELECT * from p_tugas_tambahan where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
$daftar_berkas = '';
$bisa = 0;
foreach($ta->result() as $a)
	{
	$daftar_berkas = $a->daftar_berkas;
	}
if($daftar_berkas == '1111111111')
	{
	$bisa = 1;
	}
$qdty = $this->db->query("SELECT * from p_pegawai where lulus_sertifikasi='Ya' and kode='$kodeguru' ");
if((count($qdty->result())==0) or ($bisa == 0))
{
	echo '<h2>data pegawai dimaksud tidak ada atau belum lulus sertifikasi atau berkas belum memenuhi syarat</h2><a href="'.base_url().'index.php/'.$tautan_balik.'">Kembali</a>';
}
else
{
foreach($qdty->result() as $r)
	{

	$tanggallahirpegawai = date_to_long_string($r->tanggallahir);
	$status_tempat_tugas = $r->status_tempat_tugas;
	$kodeguru = $r->kode;
	//cari data kepegawaian
	$usernamepegawai = $r->kd;
	//cari pangkat golongan
	$pangkat ='';
	$golongan = '';
	$jabatan = '';
	$id_sk = id_sk_per_semester($kodeguru,$thnajaran,$semester);
	$golongan = id_sk_jadi_golongan($id_sk) ;
	$jabatan = golongan_jadi_jabatan($golongan);
	$pangkat = golongan_jadi_pangkat($golongan); 
	$pangkatgolongan = $pangkat.', '.$golongan;
	if (empty($pangkat))
		{
		$pangkatgolongan = '-';
		}
	// cari mapel
	$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' order by mapel ASC");
	$jtm = 0;
	foreach($tmapel->result() as $dmapel)
	{
		$mapelguru = $dmapel->mapel;
		$jtm = $jtm + $dmapel->jam;

	}
	$huruf = strtolower(number_to_long_string($jtm));
	// cari mapel skbk
	$tmapelx = $this->db->query("select * from m_mapel_skbk where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	$mapele = '';
	foreach($tmapelx->result() as $dmapelx)
	{
		if (!empty($mapele))
			{
			$mapele .= ', '.$dmapelx->mapel;
			}
			else
			{
			$mapele .= $dmapelx->mapel;
			}
	}
	// cari tambahan
	$tambahan = '';
	$jtm2 = '';
	$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	foreach($ttambahan->result() as $dtambahan)
		{
		$tambahan = $dtambahan->nama_tugas;
		$jtm2 = $dtambahan->jtm;
		}
	// cari tambahan di sekolah lain
	$namatugas = '';
	$jtm3 = '';
	$namasekolah = '';
	$ttambahanluar = $this->db->query("select * from p_tugas_tambahan_luar where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	foreach($ttambahanluar->result() as $dtambahanluar)
		{
		$namatugas = $dtambahanluar->nama_tugas;
		$jtm3 = $dtambahanluar->jtm;
		$namasekolah = $dtambahanluar->nama_sekolah;
		}
	$jtm4 = $jtm + $jtm2 + $jtm3 ;
	$huruf2 = strtolower(number_to_long_string($jtm2));
	$huruf4 = strtolower(number_to_long_string($jtm4));
}
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="100"><img src ="'.base_url().'/images/depag.png" width="75"> </td><td align="center">'.$this->config->item('baris1').'<br />'.$this->config->item('baris2').'<br />'.$this->config->item('baris3').'<br />'.$this->config->item('baris4').'</TD><TR>
</table>';
echo '<table width="670" cellpadding="0"  border="1" cellspacing="0" class="widget-small"><tr><td></td></tr></table><br /><br />';
echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small" >';
echo '<tr ><td colspan ="3" align="center"><b>SURAT KETERANGAN MELAKSANAKAN TUGAS (SKMT)</b></td></tr>
<tr><td colspan ="3" align="center">'.$nomor_skbk.'<br /><br /></td></tr>
<tr><td colspan ="3">Yang bertanda tangan di bawah ini, </td></tr>
<tr><td width="300">Nama Lengkap</td><td width="15">:</td><td>'.$namakepala.'</td></tr>
<tr><td>NIP</td><td>:</td><td>'.$nipkepala.'</td></tr>
<tr><td>Jabatan</td><td>:</td><td>Kepala '.$this->config->item('sek_nama').'</td></tr>
<tr><td>Alamat Madrasah<td>:</td><td>Jalan Raya Solo Semarang km 10 kode pos 50775
		Telepon (0298) 610288 Desa Tengaran Kecamatan
		Tengaran Kabupaten Semarang</td></tr>';
if($status_tempat_tugas == 1)
	{
	echo '<tr><td>Status Madrasah</td><td>:</td><td>Induk / Pangkalan</td></tr>';
	}
	else
	{
	echo '<tr><td>Status Madrasah</td><td>:</td><td>Noninduk / Bukan Pangkalan</td></tr>';
	}
echo '<tr><td colspan ="3">Menerangkan dengan sebenarnya, bahwa</td></tr></table>
<table width="670" cellpadding="0" cellspacing="0" class="widget-small">
<tr><td width="40">(1)</td><td>Guru atas nama : '.$r->nama.' lahir di '.$r->tempat.' pada tanggal '.$tanggallahirpegawai.' aktif melaksanakan tugas sebagai Guru Mata Pelajaran '.$mapele.'</td></tr><tr>
<td>(2)</td><td>Guru yang namanya tercantum pada diktum nomor (1) di atas pada semester '.$semesterx.' tahun pelajaran '.$thnajaran.' melaksanakan tugas dengan beban kerja sebanyak  '.$jtm4.' ('.$huruf4.') Jam Tatap Muka (JTM), yang terdiri dari: </td></tr>
<tr><td></td><td>
<table><tr><td width="30" valign="top">a</td><td width="480">Tugas utama sebagai guru, mengajar '.$mapele.'</td><td align="center" width="70">'.$jtm.'</td><td>JTM</td></tr>
<tr><td valign="top">b</td><td>Tugas tambahan lainnya, sebagai '.$tambahan.'</td><td align="center">'.$jtm2.'</td><td>JTM</td></tr>';
if ($jtm3>0)
	{
	echo '<tr><td>c</td><td>Tugas mengajar '.$namatugas.' di '.$namasekolah.'</td><td align="center">'.$jtm3.'</td><td>JTM</td></tr>';
	}
echo '</table>
</td></tr>';
echo '</table>';
echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small"><tr><td><p>Demikian surat keterangan ini dibuat dengan sebenarnya, dan untuk dipergunakan sebagimana mestinya.</p></td><tr></table>
<table width="670" cellpadding="0" cellspacing="0" class="widget-small">
<tr><td width="100"></td><td width="300">Mengetahui,<br />Pengawas<br /><br /><br /><br />'.$namapengawas.'<br />NIP '.$nippengawas.'</td><td width="100"></td><td>Tengaran, '.$tanggalsurat.'<br />Kepala<br /><br /><br /><br />'.$namakepala.'<br />NIP '.$nipkepala.'</td></tr></table>';
}
echo '<a href="'.base_url().'index.php/tatausaha/formcetakskbk">.</a>';
?>
