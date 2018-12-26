<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 16 Jan 2015 08:43:21 WIB 
// Nama Berkas 		: mencetak_skp.php
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
<?php
$qdty = $this->db->query("SELECT * from p_pegawai where lulus_sertifikasi='Ya' and kode='$kodeguru' ");
if((empty($thnajaran)) or (empty($semester)) or (empty($kodeguru)))
	{
	echo 'Galat, ada parameter yang tidak didefinisikan';
	}
elseif(count($qdty->result())==0)
{
	echo '<h2>data pegawai dimaksud tidak ada atau belum lulus sertifikasi</h2><br /><a href="'.base_url().'index.php/'.$tautan_balik.'">Kembali</a>';
}

else
{
foreach($qdty->result() as $r)
	{
	$nuptk = $r->nuptk;
	$nrg = $r->nrg;
	$no_sertifikat = $r->no_sertifikat;
	$tanggal_sertifikat = $r->tanggal_sertifikat;
	}
$namapegawai = cari_nama_pegawai($kodeguru);
$title = 'HASIL SUPERVISI TAHUN '.$thnajaran.' SEMESTER '.$semester.' AN '.$namapegawai;
$title = berkas($title);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>css/skbk-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $title;?></title>
</head>
<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td align ="center"><a href="<?php echo base_url();?>index.php/<?php echo $tautan_balik;?>"><h2>BORANG INSTRUMEN PEMANTAUAN KINERJA GURU YANG<br />BERSERTIFIKAT PROFESI PENDIDIK</h2></a></td></tr></table>
<div id="isi">
<?php
$oke = 1;
$skor2=0;
$jskort = 0;
$jmlrombel = 0;
$jmlsiswa = 0;
$pesan = '';
$tz = $this->db->query("select * from `m_ruang`");
foreach($tz->result() as $z)
	{
	$kelas = $z->ruang;
	$ty = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `status`='Y' and `kelas`='$kelas' and `semester`='$semester'");
	if($ty->num_rows()>0)
		{
		$jmlsiswa = $jmlsiswa + $ty->num_rows();
		$jmlrombel++;
		}
	}
$str='';
$tx = $this->db->query("select * from `nomor_skbk_skmt` where `thnajaran`='$thnajaran' and `semester`='$semester'");
foreach($tx->result() as $x)
	{
	$str = $x->tanggal_supervisi;
	}
$harisupervisi = tanggal_ke_hari($str);
if ($jmlrombel == 0)
	{
	$oke = 0;
	$pesan .= 'Jumlah Rombel masih kosong<br >';
	}
if (substr($str,2)=='00')
	{
	$oke = 0;
	$pesan .= 'Tanggal supervisi belum sesuai<br />';
	}
//cari kesesuaian jtm di pembagian tugas dan hari tatap muka
	$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' order by mapel ASC");
	$jtm = 0;
	$jtmhari = 0;
	$senin = 0;
	$selasa = 0;
	$rabu = 0;
	$kamis = 0;
	$jumat = 0;
	$sabtu = 0;
	foreach($tmapel->result() as $dmapel)
	{
		$mapelguru = $dmapel->mapel;
		$jtm = $jtm + $dmapel->jam;
		$id_mapel = $dmapel->id_mapel;
		// data di hari tatap muka
		$tc = $this->db->query("SELECT * FROM `tharitatapmuka` where `id_mapel`='$id_mapel'");
		foreach($tc->result() as $c)
		{
			$jtmhari = $jtmhari + $c->jtm;
			if ($c->hari_tatap_muka == 'Monday')
				{
				$senin = $senin + $c->jtm;
				}
			if ($c->hari_tatap_muka == 'Tuesday')
				{
				$selasa = $selasa + $c->jtm;
				}
			if ($c->hari_tatap_muka == 'Wednesday')
				{
				$rabu = $rabu + $c->jtm;
				}
			if ($c->hari_tatap_muka == 'Thursday')
				{
				$kamis = $kamis + $c->jtm;
				}
			if ($c->hari_tatap_muka == 'Friday')
				{
				$jumat = $jumat + $c->jtm;
				}
			if ($c->hari_tatap_muka == 'Saturday')
				{
				$sabtu = $sabtu + $c->jtm;
				}
		}

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
if ($jtm == 0)
	{
	$oke = 0;
	$pesan .= 'JTM pada tabel pembagian tugas masih kosong<br >';
	}
if ($jtmhari == 0)
	{
	$oke = 0;
	$pesan .= 'JTM pada tabel hari tatap muka masih kosong<br >';
	}
if (($jtm > 0) and ($jtmhari>0))
	{
	if ($jtm != $jtmhari)
		{
		$oke = 0;
		$pesan .= 'JTM pada tabel hari tatap muka ('.$jtmhari.') tidak sama dengan JTM pada tabel pembagian tugas ('.$jtm.')<br >';
		$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' order by mapel ASC");
			foreach($tmapel->result() as $dmapel)
			{
				$mapelguru = $dmapel->mapel;
				$kelas = $dmapel->kelas;
				$id_mapel = $dmapel->id_mapel;
				echo 'ID '.$id_mapel.' Mapel '.$mapelguru.' Kelas '.$kelas.' ';
				// data di hari tatap muka
				$tc = $this->db->query("SELECT * FROM `tharitatapmuka` where `id_mapel`='$id_mapel'");
				foreach($tc->result() as $c)
				{
					echo $c->jtm;
				}	
				echo '<br />';
	
			}
		}

	}


if ($oke == 0)
{
	echo '<h2>Instrumen an '.$namapegawai.' belum bisa tercetak karena kekurangan data</h2><br />'.$pesan.'<a href="'.base_url().'index.php/'.$tautan_balik.'">Kembali</a>';

}
else
{
	// cari mapel

	echo '<table width="670" bgcolor="#fff" cellpadding="2" cellspacing="1" class="widget-small">';
	echo '<tr><td>Nama Sekolah / Madrasah</td><td>:</td><td>'.$this->config->item('sek_nama').'</td></tr>
	<tr><td>Status Akreditasi</td><td>:</td><td>'.$this->config->item('akreditasi').' (Nilai '.$this->config->item('nilai_akreditasi').' Tahun '.$this->config->item('tahun_akreditasi').')</td></tr>
	<tr><td>Jumlah Rombel</td><td>:</td><td>'.$jmlrombel.' Jumlah Siswa : '.$jmlsiswa.'</td></tr>
	<tr><td>Hari,Tanggal Pemantauan</td><td>:</td><td></td></tr>';
	echo '<tr><td colspan="3"><h2>A. Guru yang dipantau</h2></td></tr>		
    <tr><td>Nama Guru<td>:</td><td>'.cari_nama_pegawai($kodeguru).'</td></tr>
<tr><td>NIP<td>:</td><td>'.cari_nip_pegawai($kodeguru).'</td></tr>
<tr><td>NUPTK<td>:</td><td>'.$nuptk.'</td></tr>
<tr><td>NRG<td>:</td><td>'.$nrg.'</td></tr>
<tr><td>Lulus Sertifikasi Pendidik<td>:</td><td>Tanggal '.date_to_long_string($tanggal_sertifikat).' Nomor '.$no_sertifikat.'</td></tr>
<tr><td>Beban mengajar tiap minggu<td>:</td><td>'.$jtm4.' JTM</td></tr>
<tr><td>Mapel<td>:</td><td>'.$mapele.'</td></tr>';
	echo '</table>';
	echo '<table width="670" bgcolor="#000" cellpadding="2" cellspacing="1" class="widget-small">';
	echo '<tr bgcolor="#fff"><td align="center">NO</td><td align="center">Kegiatan</td><td align="center">Senin</td><td align="center">Selasa</td><td align="center">Rabu</td><td align="center">Kamis</td><td align="center">Jumat</td><td align="center">Sabtu</td></tr>';
echo '<tr bgcolor="#fff"><td align="center">1</td><td>Pembelajaran</td><td align="center">'.$senin.'</td><td align="center">'.$selasa.'</td><td align="center">'.$rabu.'</td><td align="center">'.$kamis.'</td><td align="center">'.$jumat.'</td><td align="center">'.$sabtu.'</td></tr><tr bgcolor="#fff"><td align="center">2</td><td>Tambahan</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td></tr></table>';
echo '<br /><h2>B. Hasil Pemantauan Perangkat Administrasi Guru (Semester '.$semester.' TP. '.$thnajaran.')</h2>';

	echo '<table width="670" bgcolor="#000" cellpadding="2" cellspacing="1" class="widget-small">';
	echo '<tr bgcolor="#8ed6d7" align="center"><td rowspan="2">Nomor</td><td width="300" rowspan="2">Jenis Perangkat Administrasi Guru</td><td width="300" colspan="4">Skor</td></tr><tr bgcolor="#8ed6d7"><td width="75" align="center">Tidak Ada</td><td width="75" align="center">Kurang Lengkap</td><td width="75" align="center">Lengkap</td><td width="75" align="center">Sangat Lengkap</td></tr>';

	// SUB A
	echo '<tr bgcolor="#ecc5d7"><td width="50" valign="middle" align="center"><strong>I</strong></td><td valign="middle"><strong>Administrasi Pembelajaran</strong></td><td></td><td></td><td></td><td></td></tr>';
	$ta = $this->db->query("select * from `m_macam_perangkat` where `tipe`='guru' and `sub`='A' order by `nomor");
	foreach($ta->result() as $a)
		{
		//cari nilai kalau ada
		$nomor = $a->nomor;
		$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$kodeguru'");
		$skor = 0;
		foreach($tb->result() as $b)
			{
			$skor = $b->skor;
			$kd = $b->id_supervisi_nilai;
			}
			if(($nomor%2)==0){
				$warna="#C8E862";
			} else{
				$warna="#D6F3FF";
			}

		echo '<tr bgcolor="#fff"><td width="50" valign="middle" align="center">'.$nomor.'</td><td valign="middle">'.$a->perangkat.'</td>';
			echo '<td align="center" valign="middle"></td><td></td><td></td><td></td>';
		echo '</tr>';

		}
	// SUB B
	echo '<tr bgcolor="#ecc5d7"><td width="50" valign="middle" align="center"><strong>II</strong></td><td valign="middle"><strong>Kegiatan Penilaian</strong></td><td></td><td></td><td></td><td></td></tr>';
	$ta = $this->db->query("select * from `m_macam_perangkat` where `tipe`='guru' and `sub`='B' order by `nomor");
	foreach($ta->result() as $a)
		{
		//cari nilai kalau ada
		$nomor = $a->nomor;
		$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$kodeguru'");
		$skor = 0;
		foreach($tb->result() as $b)
			{
			$skor = $b->skor;
			$kd = $b->id_supervisi_nilai;
			}
			if(($nomor%2)==0){
				$warna="#C8E862";
			} else{
				$warna="#D6F3FF";
			}

		echo '<tr bgcolor="#fff"><td width="50" valign="middle" align="center">'.$nomor.'</td><td valign="middle">'.$a->perangkat.'</td>';
			echo '<td align="center" valign="middle"></td><td></td><td></td><td></td>';
		echo '</tr>';

		}
	// SUB C
	echo '<tr bgcolor="#ecc5d7"><td width="50" valign="middle" align="center"><strong>III<strong></td><td valign="middle"><strong>Perangkat Tambahan</strong></td><td></td><td></td><td></td><td></td></tr>';
	$ta = $this->db->query("select * from `m_macam_perangkat` where `tipe`='guru' and `sub`='C' order by `nomor");
	foreach($ta->result() as $a)
		{
		//cari nilai kalau ada
		$nomor = $a->nomor;
		$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$kodeguru'");
		$skor = 0;
		foreach($tb->result() as $b)
			{
			$skor = $b->skor;
			$kd = $b->id_supervisi_nilai;
			}
			if(($nomor%2)==0){
				$warna="#C8E862";
			} else{
				$warna="#D6F3FF";
			}

		echo '<tr bgcolor="#fff"><td width="50" valign="middle" align="center">'.$nomor.'</td><td valign="middle">'.$a->perangkat.'</td>';
		echo '<td align="center" valign="middle"></td><td></td><td></td><td></td>';
		echo '</tr>';

		}
		echo '</tr>';
echo '</table><br />';
echo '<h2>C. Tugas tambahan Guru (Sebagai  Ka Mad/Ka Sek, Waka,Ka perpus,Ka Lab )</h2>';
//cek dapat tugas tambahan
$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
$tambahan = '';
$jtmtambahan = 0;
foreach ($ttambahan->result() as $dtambahan)
	{
	$tambahan = $dtambahan->nama_tugas;
	$jtmtambahan = $dtambahan->jtm;
	}
	echo '<table width="670" bgcolor="#000" cellpadding="2" cellspacing="1" class="widget-small">';
echo '<tr bgcolor="#8ed6d7" align="center"><td width="50">Nomor</td><td width="300">Tugas Tambahan
</td><td>Ekuivalen Jam Tatap Muka</td></tr>';
if($jtmtambahan>0)
	{
	echo '<tr bgcolor="#fff" align="center"><td>1</td><td align="left">'.$tambahan.'</td><td>'.$jtmtambahan.'</td></tr>';
	}
	else
	{
	echo '<tr bgcolor="#fff" align="center"><td colspan="3" align="center">Tidak mendapat tugas tambahan</td></tr>';
	}
echo '</table><br />';
if($jtmtambahan>0)
	{
	echo '<table width="670" bgcolor="#fff" cellpadding="2" cellspacing="1" class="widget-small">';
	echo '<tr><td>Didukung fotocopy SK Pengangkatan dalam Jabatan untuk Kepala Perpustakaan dan Kepala Laboratorium juga didukung fotocopy Sertifikat Pendidikan dan Pelatihan yang mendukung.</td></tr></table><br />';
	}
echo '<h2>D. Hasil Pemantauan Perangkat Administrasi Tugas Tambahan (Semester '.$semester.' TP. '.$thnajaran.')</h2>';
echo '<table width="670" bgcolor="#000" cellpadding="2" cellspacing="1" class="widget-small"><tr bgcolor="#8ed6d7" align="center"><td rowspan="2">Nomor</td><td width="300" rowspan="2">Jenis Perangkat Administrasi</td><td width="300" colspan="4">Skor</td></tr><tr bgcolor="#8ed6d7"><td width="75" align="center">Tidak Ada</td><td width="75" align="center">Kurang Lengkap</td><td width="75" align="center">Lengkap</td><td width="75" align="center">Sangat Lengkap</td></tr>';
if($jtmtambahan==0)
{

	echo '<tr bgcolor="#fff"><td colspan="6" align="center">Tidak mendapat tugas tambahan</td></tr>';

}
else
{


	$ta = $this->db->query("select * from `m_macam_perangkat` where `tipe`='tambahan' order by `nomor");
$skort0 = 0;
$skort1 = 0;
$skort2 = 0;
$skort3 = 0;
foreach($ta->result() as $a)
		{
		//cari nilai kalau ada
		$nomor = $a->nomor;
		$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$kodeguru'");
				
		foreach($tb->result() as $b)
			{
			$skort = $b->skor;
			$kd = $b->id_supervisi_nilai;
			}
			if(($nomor%2)==0){
				$warna="#C8E862";
			} else{
				$warna="#D6F3FF";
			}

		echo '<tr bgcolor="#fff"><td width="50" valign="middle" align="center">'.$nomor.'</td><td valign="middle">'.$a->perangkat.'</td>';
		echo '<td align="center" valign="middle"></td><td></td><td></td><td></td>';
		echo '</tr>';

		}
}
	echo '</table><br />';

$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
$lebartabel=670;
$namapengawas = cari_pengawas($thnajaran,$semester);
$nippengawas = cari_nip_pengawas($thnajaran,$semester);

echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="100"></td><td valign="top" width="300"><br>Guru yang disupervisi,<br><br><br></td><td valign="top" >'.$this->config->item('lokasi').', '.date_to_long_string($str).'<br>Supervisor / Pengawas Madrasah</tr>
<tr><td valign="top" width="100"></td><td valign="top">'.$namapegawai.'<br>NIP '.$nipguru.'</td><td>'.$namapengawas.'<br>NIP '.$nippengawas.'</td></tr></table><br /><br /><br />';

} //kalau oke;
}
echo '</div>';
