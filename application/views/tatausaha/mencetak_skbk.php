<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 07 Mar 2015 20:39:26 WIB 
// Nama Berkas 		: mencetak_skbk.php
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
$nomor_skbk = '';
$tanggalsurat = '';
$tm = $this->db->query("SELECT * from nomor_skbk_skmt where thnajaran='$thnajaran' and semester='$semester'");
foreach($tm->result() as $p)
	{
	$nomor_skbk = $p->nomor_skbk;
	$tanggalsurat = date_to_long_string($p->tanggal);
	}
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
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
$qdtyx = $this->db->query("SELECT * from p_pegawai where kode='$kodeguru' ");
$qdty = $this->db->query("SELECT * from p_pegawai where lulus_sertifikasi='Ya' and kode='$kodeguru' ");
if((count($qdty->result())==0) or ($bisa == 0) or (count($qdtyx->result())==0))
{
	if(count($qdtyx->result())==0)
		{
		echo '<h2>'.cari_nama_pegawai($kodeguru).' tidak ada</h2><a href="'.base_url().'index.php/'.$tautan_balik.'">Kembali</a>';
		}
	elseif(count($qdty->result())==0)
		{
		echo '<h2>'.cari_nama_pegawai($kodeguru).' belum lulus sertifikasi</h2><a href="'.base_url().'index.php/'.$tautan_balik.'">Kembali</a>';
		}
	elseif($bisa == 0)
		{
		echo '<h2>berkas '.cari_nama_pegawai($kodeguru).' belum memenuhi syarat, periksa lagi berkas pencairan, atau belum memproses skbk guru</h2><a href="'.base_url().'index.php/'.$tautan_balik.'">Kembali</a>';
		}
	else
		{
		echo '<h2>data pegawai dimaksud tidak ada atau belum lulus sertifikasi atau berkas belum memenuhi syarat</h2><a href="'.base_url().'index.php/'.$tautan_balik.'">Kembali</a>';
		}

}
else
{
foreach($qdty->result() as $r)
	{
	$tanggallahirpegawai = date_to_long_string($r->tanggallahir);
	$status_tempat_tugas = $r->status_tempat_tugas;
	$madrasah_induk = $r->madrasah_induk;
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
	$jtmtambahan = '';
	$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	foreach($ttambahan->result() as $dtambahan)
		{
		$tambahan = $dtambahan->nama_tugas;
		$jtmtambahan = $dtambahan->jtm;
		}
	// cari tambahan di sekolah lain
	$tambahanluar = '';
	$jtm2 = '';
	$namasekolah = '';
	$ttambahanluar = $this->db->query("select * from p_tugas_tambahan_luar where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	foreach($ttambahanluar->result() as $dtambahanluar)
		{
		$tambahanluar = $dtambahanluar->nama_tugas;
		$jtm2 = $dtambahanluar->jtm;
		$namasekolah = $dtambahanluar->nama_sekolah;
		}
	$jtm3 = $jtmtambahan;
	$jtm4 = $jtm + $jtm2 + $jtm3 ;
}
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="100"><img src ="'.base_url().'/images/depag.png" width="75"></td><td align="center">'.$this->config->item('baris1').'<br />'.$this->config->item('baris2').'<br />'.$this->config->item('baris3').'<br />'.$this->config->item('baris4').'</TD><TR>
</table>';
echo '<table width="670" cellpadding="0"  border="1" cellspacing="0" class="widget-small"><tr><td></td></tr></table><br />';
echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small" >';
echo '<tr><td colspan ="3" align="center"><b>SURAT KETERANGAN BEBAN KERJA (SKBK)</b></td></tr>
<tr><td colspan ="3" align="center">'.$nomor_skbk.'<br /><br /></td></tr>
<tr><td colspan ="3">Yang bertanda tangan di bawah ini, </td></tr>
<tr><td width="300">Nama Lengkap</td><td width="15">:</td><td>'.$namakepala.'</td></tr>
<tr><td>NIP</td><td>:</td><td>'.$nipkepala.'</td></tr>
<tr><td>Jabatan</td><td>:</td><td>Kepala '.$this->config->item('sek_nama').'</td></tr>
<tr><td colspan ="3">menerangkan bahwa Guru berikut ini,</td><tr>
<tr><td width="300">Nama Lengkap<td>:</td><td>'.$r->nama.'</td></tr>
<tr><td>NIP<td>:</td><td>'.$r->nip.'</td></tr>
<tr><td>Tempat/Tanggal Lahir<td>:</td><td>'.$r->tempat.', '.$tanggallahirpegawai.'</td></tr>
<tr><td>Pangkat/Golongan<td>:</td><td>'.$pangkatgolongan.'</td></tr>
<tr><td>Mata Pelajaran<td>:</td><td>'.$mapele.'</td></tr>';
if($status_tempat_tugas == 1)
	{
	echo '<tr><td>Madrasah/Sekolah Pangkal<td>:</td><td>'.$this->config->item('sek_nama').'</td></tr>';
echo '<tr><td>Alamat Madrasah<td>:</td><td>'.$this->config->item('sek_alamat').' Telepon '.$this->config->item('sek_telepon').' Desa '.$this->config->item('sek_desa').' Kecamatan '.$this->config->item('sek_kec').' '.$this->config->item('sek_kab').'</td></tr>';
	}
	else
	{
	echo '<tr><td>Madrasah/Sekolah Pangkal<td>:</td><td>'.$madrasah_induk.'</td></tr>';
	}
echo '<tr><td>Total Beban Kerja</td><td>:</td><td>'.$jtm4.' JTM (kumulatif)</td></tr>';
echo '</table>';
if($status_tempat_tugas == 1)
	{
	echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small"><tr><td>
<p>Dalam melaksanakan tugasnya sebagai Guru, pada semester '.$semesterx.' tahun pelajaran '.$thnajaran.', secara kumulatif TELAH MEMENUHI BEBAN KERJA MINIMAL dan yang bersangkutan berhak menerima tunjangan profesi sesuai dengan ketentuan yang berlaku.</p>
<p>
Demikian surat keterangan ini dibuat dengan sebenarnya guna melengkapi persyaratan yang diperlukan untuk menerima tunjangan profesi tahun '.date('Y').'.</p></td><tr></table>';
	}
	else
	{
	echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small"><tr><td><p>
Demikian surat keterangan ini dibuat dengan sebenarnya guna melengkapi persyaratan yang diperlukan untuk menerima tunjangan profesi tahun '.date('Y').'.</p></td><tr></table>';
	}


echo '<table width="670" cellpadding="0" cellspacing="0" class="widget-small"><tr><td width="400"></td><td>Tengaran, '.$tanggalsurat.'<br />Kepala<br /><br /><br /><br />'.$namakepala.'<br />NIP '.$nipkepala.'</td></tr></table>';
}
echo '<a href="'.base_url().'index.php/tatausaha/formcetakskbk">.</a>';
?>
