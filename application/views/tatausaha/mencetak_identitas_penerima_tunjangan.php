<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_identitas_penerima_tunjangan.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>Identitas Calon Penerima Tunjangan Profesi - <?php echo $this->config->item('nama_web');?></title>
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
	$nomor_skbk = $p->nomor_skbk;
	$tanggalsurat = date_to_long_string($p->tanggal);
	}
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$namapengawas = cari_pengawas($thnajaran,$semester);
$nippengawas = cari_nip_pengawas($thnajaran,$semester);

if($semester==1)
	{
	$semesterx='Gasal';
	$tahunpencairan = substr($thnajaran,0,4);
	$pencairan = '<strong>PENCAIRAN PERIODE : Bulan Juli - Desember '.$tahunpencairan.'</strong>';
	$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;Juli '.$tahunpencairan.'';
	}
if($semester==2)
	{
	$semesterx='Genap';
	$tahunpencairan = substr($thnajaran,5,4);
	$pencairan = '<strong>PENCAIRAN PERIODE : Bulan Januari - Juni '.$tahunpencairan.'</strong>';
	$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;Januari '.$tahunpencairan.'';
	}
$qdty = $this->db->query("SELECT * from p_pegawai where lulus_sertifikasi='Ya' and kode='$kodeguru' ");
if(count($qdty->result())==0)
{
	echo '<h2>data pegawai dimaksud tidak ada atau belum lulus sertifikasi</h2><a href="'.base_url().'index.php/'.$tautan_balik.'">Kembali</a>';
}
else
{
foreach($qdty->result() as $r)
	{

	$tanggallahirpegawai = date_to_long_string($r->tanggallahir);
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
	$gapok = id_sk_jadi_gapok($id_sk);
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
	$jtm2 = '0';
	$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	foreach($ttambahan->result() as $dtambahan)
		{
		$tambahan = $dtambahan->nama_tugas;
		$jtm2 = $dtambahan->jtm;
		}
	// cari tambahan di sekolah lain
	$namatugas = '';
	$jtm3 = '0';
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
<tr align="center"><td>IDENTITAS GURU<br />CALON PENERIMA TUNJANGAN PROFESI GURU MADRASAH</TD></TR>
</table><BR />';
echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small"><tr><td>'.$pencairan.'</td></tr></table>';
echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small" >';
echo '<tr ><td align="center">1</td><td width="250">Nomor Peserta PLPG</td><td>:</td><td colspan="2">'.$r->no_peserta_sertifikasi.'</td></tr>
<tr><td align="center">2</td><td>Nama</td><td>:</td><td colspan="2">'.cari_nama_pegawai($kodeguru).'</td></tr>
<tr><td align="center">3</td><td>NIP</td><td>:</td><td colspan="2">'.cari_nip_pegawai($kodeguru).'</td></tr>
<tr><td align="center">4</td><td>NUPTK</td><td>:</td><td colspan="2">'.$r->nuptk.'</td></tr>
<tr><td align="center">5</td><td>Nomor Registrasi Guru</td><td>:</td><td colspan="2">'.$r->nrg.'</td></tr>';
if ($r->jenkel == 'Lk')
	{$kelamin = 'Laki - laki';}
else if ($r->jenkel == 'Pr')
	{$kelamin = 'Perempuan';}
else
	{$kelamin = '';}
echo '<tr><td align="center">6</td><td>Jenis Kelamin</td><td>:</td><td colspan="2">'.$kelamin.'</td></tr>
<tr><td align="center">7</td><td>Tempat, tanggal lahir</td><td>:</td><td colspan="2">'.$r->tempat.', '.date_to_long_string($r->tanggallahir).'</td></tr>
<tr><td align="center">8</td><td>Nama Madrasah</td><td>:</td><td colspan="2">'.$this->config->item('sek_nama').'</td></tr>
<tr><td align="center">9</td><td>Alamat</td><td>:</td><td colspan="2">Desa '.$this->config->item('sek_desa').' Kecamatan '.$this->config->item('sek_kec').'</td></tr>
<tr><td align="center">10</td><td>Jenjang pada satminkal</td><td>:</td><td colspan="2">MA</td></tr>
<tr><td align="center">11</td><td>Tugas / Mapel yang diampu</td><td>:</td><td colspan="2">'.$mapele.'</td></tr>
<tr><td align="center">12</td><td>Tugas tambahan</td><td>:</td><td colspan="2">'.$tambahan.'</td></tr>
<tr><td align="center" rowspan="4" valign="top">13</td><td rowspan="4" valign="top">Jumlah Total JTM</td><td rowspan="4" valign="top">:</td><td>Tugas Pokok </td><td align="right">'.$jtm.' JTM</td></tr><tr><td>Tugas Tambahan </td><td align="right">'.$jtm2.' JTM</td></tr><tr><td>Tugas Tambahan di noninduk </td><td align="right">'.$jtm3.' JTM</td></tr><tr><td>Total </td><td align="right">'.$jtm4.' JTM</td></tr>
<tr><td align="center">14</td><td>Jenjang sesuai sertifikat</td><td>:</td><td colspan="2">MA</td></tr>
<tr><td align="center">15</td><td>Mapel sesuai sertifikat</td><td>:</td><td colspan="2">'.$r->mapel_sertifikasi.'</td></tr>
<tr><td align="center">16</td><td>Nomor Sertifikat</td><td>:</td><td colspan="2">'.$r->no_sertifikat.'</td></tr>
<tr><td align="center">17</td><td>Tanggal ttd Sertifikat</td><td>:</td><td colspan="2">'.date_to_long_string($r->tanggal_sertifikat).'</td></tr>
<tr><td align="center">18</td><td>Nomor Telepon Madrasah</td><td>:</td><td colspan="2">'.$this->config->item('sek_telepon').'</td></tr>
<tr><td align="center">19</td><td>Nomor telepon / telepon seluler</td><td>:</td><td colspan="2">'.$r->seluler.'</td></tr>
<tr><td align="center">20</td><td>Gaji Pokok Terakhir</td><td>:</td><td colspan="2">'.xduit($gapok).'</td></tr>
<tr><td align="center">21</td><td>Nama BANK</td><td>:</td><td colspan="2">'.$r->bank.'</td></tr>
<tr><td align="center">22</td><td>Nama pada Rekening BANK</td><td>:</td><td colspan="2">'.$r->nama_rekening_bank.'</td></tr>
<tr><td align="center">23</td><td>Nomor rekening BANK</td><td>:</td><td colspan="2">'.$r->nomor_rekening_bank.'</td></tr>
<tr><td align="center">24</td><td>NPWP</td><td>:</td><td colspan="2">'.$r->npwp.'</td></tr>
</table><br /><br />
<table width="670" cellpadding="0" cellspacing="0" class="widget-small">
<tr><td width="100"></td><td width="300">Mengetahui,<br />Kepala '.$this->config->item('sek_nama').'<br /><br /><br /><br />'.$namakepala.'<br />NIP '.$nipkepala.'</td><td width="100"></td><td>'.$this->config->item('lokasi').',   '.$tanggalpencairan.'<br />Guru Ybs.<br /><br /><br /><br />'.cari_nama_pegawai($kodeguru).'<br />NIP '.cari_nip_pegawai($kodeguru).'</td></tr></table>';
}
echo '<a href="'.base_url().'index.php/'.$tautan_balik.'">.</a>';
?>
