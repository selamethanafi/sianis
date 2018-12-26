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
<title>Surat Pernyataan Penerima Tunjangan Profesi - <?php echo $this->config->item('nama_web');?></title>
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
	$bulany = gantibulan($bulan);
	if(empty($bulany))
		{
		$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;Juli '.$tahunpencairan.'';
		}
		else
		{
		$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;'.$bulany.' '.$tahunpencairan.'';
		}

	}
if($semester==2)
	{
	$semesterx='Genap';
	$tahunpencairan = substr($thnajaran,5,4);
	$pencairan = '<strong>PENCAIRAN PERIODE : Bulan Januari - Juni '.$tahunpencairan.'</strong>';
	$bulany = gantibulan($bulan);
	if(empty($bulany))
		{
		$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;Juli '.$tahunpencairan.'';
		}
		else
		{
		$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;'.$bulany.' '.$tahunpencairan.'';
		}
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
<tr align="center"><td></td><td><table width="600" cellpadding="2" cellspacing="1" class="widget-small">
<tr align="center"><td><a href="'.base_url().'index.php/'.$tautan_balik.'">SURAT PERNYATAAN</a></TD></TR>
</table><BR />';
echo '<table width="600" cellpadding="2" cellspacing="1" class="widget-small" >
<tr><td colspan="3"><p>Yang bertanda tangan di bawah ini, saya :</p>';
echo '<tr><td width="250">Nomor Peserta PLPG</td><td>:</td><td>'.$r->no_peserta_sertifikasi.'</td></tr>
<tr><td>Nama</td><td>:</td><td>'.cari_nama_pegawai($kodeguru).'</td></tr>
<tr><td>NIP</td><td>:</td><td>'.cari_nip_pegawai($kodeguru).'</td></tr>
<tr><td>NUPTK</td><td>:</td><td>'.$r->nuptk.'</td></tr>
<tr><td>Nomor Registrasi Guru</td><td>:</td><td>'.$r->nrg.'</td></tr>
<tr><td>Tempat, tanggal lahir</td><td>:</td><td>'.$r->tempat.', '.date_to_long_string($r->tanggallahir).'</td></tr>';
if ($r->jenkel == 'Lk')
	{$kelamin = 'Laki - laki';}
else if ($r->jenkel == 'Pr')
	{$kelamin = 'Perempuan';}
else
	{$kelamin = '';}
echo '<tr><td>Jenis Kelamin</td><td>:</td><td>'.$kelamin.'</td></tr>
<tr><td>Mapel yang diampu</td><td>:</td><td>'.$mapele.'</td></tr><tr><td>Tugas tambahan</td><td>:</td><td>'.$tambahan.'</td></tr><tr><td>Nama Madrasah</td><td>:</td><td>'.$this->config->item('sek_nama').'</td></tr>
<tr><td>Alamat</td><td>:</td><td>Desa '.$this->config->item('sek_desa').' Kecamatan '.$this->config->item('sek_kec').'</td></tr>
<tr><td>Nomor Telepon Madrasah</td><td>:</td><td>'.$this->config->item('sek_telepon').'</td></tr>
<tr><td>Nomor telepon / telepon seluler</td><td>:</td><td>'.$r->seluler.'</td></tr>
<tr><td colspan="3"><p>menyatakan dengan sesungguhnya, bahwa saya :</p></td></tr></table>
<table width="600" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top">1.</td><td>Melaksanakan tugas sebagai guru madrasah dengan total beban kerja per minggu '.$jtm4.' (<strong>'.number_to_long_string($jtm4).'</strong>) jam tatap muka.</td></tr>
<tr><td valign="top">2.</td><td>Dengan menerima tunjangan profesi ini, <strong>akan meningkatkan motivasi, profesionalisme, dan kinerja serta layanan, khususnya kepada peserta didik untuk meningkatkan kualitas hasil belajar mengajar dan prestasi belajar mereka</strong></td></tr>
<tr><td valign="top">3.</td><td>Akan mengembalikan dana tunjangan profesi sejumlah yang saya terima ke kas negara atau menerima sanksi lainnya sesuai dengan ketentuan yang berlaku jika pernyataan yang saya buat terbukti tidak benar</td></tr></table>
<table width="600" cellpadding="2" cellspacing="1" class="widget-small"><tr><td><p>Demikian pernyataan ini saya buat dengan sadar, sungguh - sungguh dan penuh tanggung jawab. Jika di kemudian hari ternyata saya tidak memenuhi pernyataan yang saya buat ini, maka saya bersedia menerima sanksi yang diberikan oleh Kementerian Agama sesuai dengan ketentuan yang berlaku atau dituntut berdasarkan hukum yang berlaku.</p></td></tr></table><br /><br />
<table width="600" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="100"></td><td width="250">Mengetahui,<br />Kepala '.$this->config->item('sek_nama').'<br /><br /><br /><br />'.$namakepala.'<br />NIP '.$nipkepala.'</td><td width="50"></td><td>'.$this->config->item('lokasi').',   '.$tanggalpencairan.'<br />Guru<br /><br /><br /><br />'.cari_nama_pegawai($kodeguru).'<br />NIP '.cari_nip_pegawai($kodeguru).'</td></tr></table>
</td></tr></table>';
}
?>
