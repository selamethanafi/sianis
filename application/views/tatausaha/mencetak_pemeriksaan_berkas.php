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
<title>Pemeriksaan Berkas - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<?php
$bulan = '';
$cacahbulan = '';
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
$bulanakhir = '';
$bulanawal = '';
$bulany = gantibulan($bulan);
if($cacahbulan>1)
{
	if($bulan == 12)
	{
	$bulanawal = 11;
	$bulanakhir = 12;
	}
	else
	{
	$bulanawal = $bulan - $cacahbulan;
	$bulanakhir = $bulan - 1;
	}
}
if($semester==1)
	{
	$semesterx='Gasal';
	$tahunpencairan = substr($thnajaran,0,4);
	if(empty($bulany))
		{
		$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;Desember '.$tahunpencairan.'';
		$pencairan = '<strong>PENCAIRAN : Bulan Juli - Desember '.$tahunpencairan.'</strong>';
		}
		else
		{
			if($cacahbulan == 1)
			{
				$bulanpencairan = $bulan;
				$bulan = $bulan - 1;
				$bulany = gantibulan($bulan);
				$pencairan = '<strong>PENCAIRAN : Bulan '.$bulany.' '.$tahunpencairan.'</strong>';
				$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;'.gantibulan($bulanpencairan).' '.$tahunpencairan.'';
			}
			else
			{
				$pencairan = '<strong>PENCAIRAN : Bulan '.gantibulan($bulanawal).' s.d. '.gantibulan($bulanakhir).' '.$tahunpencairan.'</strong>';
				$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;'.$bulany.' '.$tahunpencairan.'';
			}

		}
	}
if($semester==2)
	{
	$semesterx='Genap';
	$tahunpencairan = substr($thnajaran,5,4);
	if(empty($bulany))
		{
		$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;Juli '.$tahunpencairan.'';
		$pencairan = '<strong>PENCAIRAN : Bulan Januari - Juni '.$tahunpencairan.'</strong>';
		}
		else
		{
			if($cacahbulan == 1)
			{
				$bulanpencairan = $bulan;
				$bulan = $bulan - 1;
				$bulany = gantibulan($bulan);
				$pencairan = '<strong>PENCAIRAN : Bulan '.$bulany.' '.$tahunpencairan.'</strong>';
				$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;'.gantibulan($bulanpencairan).' '.$tahunpencairan.'';
			}
			else
			{
				$pencairan = '<strong>PENCAIRAN : Bulan '.gantibulan($bulanawal).' s.d. '.gantibulan($bulanakhir).' '.$tahunpencairan.'</strong>';
				$tanggalpencairan = '&nbsp;&nbsp;&nbsp;&nbsp;'.$bulany.' '.$tahunpencairan.'';
			}

		}

	}
$qdty = $this->db->query("SELECT * from p_pegawai where lulus_sertifikasi='Ya' and kode='$kodeguru' ");
if(count($qdty->result())==0)
{
	echo '<h2>data pegawai dimaksud tidak ada atau belum lulus sertifikasi</h2><a href="'.base_url().''.$tautan_balik.'">Kembali</a>';
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
<tr align="center"><td><a href="'.base_url().''.$tautan_balik.'">DAFTAR PEMERIKSAAN</a><br />BERKAS PERSYARATAN<br />CALON PENERIMA TUNJANGAN PROFESI GURU MADRASAH</TD></TR>
</table><BR />';
echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small"><tr><td>'.$pencairan.'</td></tr></table>';
echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small" >';
echo '<tr ><td width="300">Nama</td><td width="15">:</td><td>'.cari_nama_pegawai($kodeguru).'</td></tr>
<tr><td>NIP</td><td>:</td><td>'.cari_nip_pegawai($kodeguru).'</td></tr>
<tr><td>Tempat Tugas</td><td>:</td><td>'.$this->config->item('sek_nama').'</td></tr>
<tr><td>Nomor SK Dirjen</td><td>:</td><td>'.$r->nomor_sk_dirjen.'</td></tr>
<tr><td>NRG</td><td>:</td><td>'.$r->nrg.'</td></tr></table>
<table width="670" bgcolor="#2d2c1f" cellpadding="2" cellspacing="1" class="widget-small">
<tr bgcolor="#fff"><td width="60" rowspan="2" align="center">Nomor</td><td rowspan="2" width="500" align="center">Item Persyaratan</td><td colspan="2" align="center">Berkas</td></tr><tr bgcolor="#fff"><td align="center" width="50">Ada</td><td align="center" width="60">Tidak ada</td></tr>';
		$daftar_berkas = '0000000000';
		$ta = $this->db->query("SELECT * from p_tugas_tambahan where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
		foreach($ta->result() as $a)
			{
			$daftar_berkas = $a->daftar_berkas;
			}

		echo '<tr bgcolor="#fff"><td align="center">1</td><td>Foto kopi sertifikat pendidikan dilegalisasi LPTK</td>';
		echo '<td></td><td align="center"></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">2</td><td>Foto kopi SK Dirjen Penerima Tunjangan Profesi dan NRG</td>';
		echo '<td></td><td align="center"></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">3</td><td>Foto kopi SK Awal, SK Terakhir, KGB terakhir dilegalisasi</td>';
		echo '<td align="center"></td><td></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">4</td><td>SKMT asli</td>';
		echo '<td align="center"></td><td></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">5</td><td>SKBK asli</td>';
		echo '<td align="center"></td><td></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">6</td><td>Surat pernyataan bermeterai</td>';
		echo '<td align="center"></td><td></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">7</td><td>Foto kopi Rekening</td>';
		echo '<td align="center"></td><td></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">8</td><td>Foto kopi NPWP</td>';
		echo '<td align="center"></td><td></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">9</td><td>SK Pembagian Tugas</td>';
		echo '<td align="center"></td><td></td></tr>';
		echo '<tr bgcolor="#fff"><td align="center">10</td><td>Jadwal Mengajar</td>';
		echo '<td align="center"></td><td></td></tr></table>';

echo '<br /><br /><table width="670" cellpadding="0" cellspacing="0" class="widget-small">
<tr><td width="100"></td><td width="300">Mengetahui,<br />Pengawas Madrasah<br /><br /><br /><br />'.$namapengawas.'<br />NIP '.$nippengawas.'</td><td width="100"></td><td>Tengaran,   '.$tanggalpencairan.'<br />Kepala '.$this->config->item('sek_nama').'<br /><br /><br /><br />'.$namakepala.'<br />NIP '.$nipkepala.'</td></tr></table>';
}
?>
