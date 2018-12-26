<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<?php
$xloc = base_url().'pkg/golskp/';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun </label></div><div class="col-sm-9">';
echo "<select name=\"tahun\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$tahun.'">'.$tahun.'</option>';
	echo '<option value="'.$xloc.'semua">semua</option>';
$tz = $this->db->query("select * from `ppk_pns` where `kode`='$nippegawai' order by tahun DESC");
foreach($tz->result() as $z)
{
	echo '<option value="'.$xloc.''.$z->tahun.'">'.$z->tahun.'</option>';
}

echo '</select></div></div>';
echo '</form>';
if($tahun == 'semua')
{
	$ta=$this->db->query("select * from `skp_skor_guru` where `nip`='$nippegawai' order by `tahun` DESC, `nourut` ASC");
}
else
{
	$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nippegawai' and `tahun`='$tahun'");
	foreach($tb->result() as $b)
	{
		$idskawal = $b->skawal;
	}
	$gol1 = id_sk_jadi_golongan($idskawal) ;
	$gol = Pangkat_Sesudah($gol1);
	$this->db->query("update `skp_skor_guru` set `golongan` = '$gol' where `tahun`='$tahun' and `nip`='$nippegawai'");
	//$this->db->query("update `skp_skor_guru_kedua` set `golongan` = '$gol' where `tahun`='$tahun' and `nip`='$nippegawai'");
	$this->db->query("update `skp_skor_guru_revisi` set `golongan` = '$gol' where `tahun`='$tahun' and `nip`='$nippegawai'");
	$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$nippegawai' order by `tahun` DESC, `nourut` ASC");
}
$nomor=1;

echo '<table class="table table-striped table-hover table-bordered">
<tr><td>No</td><td>Tahun</td><td colspan="2" align="center">KEGIATAN TUGAS JABATAN</td><td align="center">AK</td><td align="center">AK Terealisasi</td><td align="center">Untuk PAK Gol</td></tr>';
$jak_target = 0;
$nomor = 1;
$nourut = 1;
$adarevisi = 0;
if(count($ta->result())>0)
{
foreach($ta->result() as $a)
	{
	if(($a->kegiatan == 'Unsur utama') or ($a->kegiatan == 'Unsur Penunjang Tugas Guru') or ($a->kegiatan == 'Unsur PKB'))
		{
		}
		else
		{
			echo '<tr>';
			$id_skp_skor_guru_revisi = $a->id_skp_skor_guru;
			$td = $this->db->query("SELECT * FROM `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` ='$id_skp_skor_guru_revisi' and `nip`='$nippegawai'");
			$adatd = $td->num_rows();
			if($adatd==0)
			{
				echo '<td align="center">'.$nourut.'</td><td align="center">'.$a->tahun.'</td><td>'.$a->kegiatan;
				if(substr($a->kegiatan,0,7) == 'Panitia')
				{
					echo '<div class="alert alert-danger">SKP ini harus dihapus</div>';
				}
				echo '</td><td align="center">'.$a->ak.'</td><td align="center"><strong>'.$a->ak_target.'</strong></td><td align="center">'.$a->ak_r.'</td><td align="center">'.$a->golongan.'</td></tr>';
			}
			else
			{
				$adarevisi = 1;
				foreach($td->result() as $d)
				{
					$rkuantitas = $d->kuantitas;
					$rkualitas = $d->kualitas;
					$rwaktu = $d->waktu;
					$rbiaya = $d->biaya;
					$swaktu = $d->satuanwaktu;
				}

				echo '<td align="center">'.$nourut.'</td><td align="center">'.$a->tahun.'</td><td>'.$a->kegiatan.' (direvisi)</td><td align="center">'.$a->ak.'</td><td align="center"><strong>'.$a->ak_target.'</strong></td><td align="center">'.$a->ak_r.'</td><td align="center">'.$a->golongan.'</td></tr>';
			}

		$jak_target = $jak_target + $a->ak_target ;
		$nourut++;
		}
	$nomor++;
	}
}

echo '<tr><td align="center"></td><td align="center"></td><td align="center"></td><td colspan="2">Jumlah Angka Kredit</td><td align="center">'.$jak_target.'</td><td align="center"></td></tr>';
/*
if($tahun == 'semua')
{
	$ta=$this->db->query("select * from `skp_skor_guru_kedua` where `nip`='$nippegawai' order by `tahun` DESC, `nourut` ASC");
}
else
{
	$ta=$this->db->query("select * from `skp_skor_guru_kedua` where `tahun`='$tahun' and `nip`='$nippegawai' order by `tahun` DESC, `nourut` ASC");
}
if($adarevisi == 1)
{
	//kedua
	$nomor=1;

	echo '<tr><td colspan="7">SKP Tambahan karena ada revisi</td></tr>';
	if(count($ta->result())>0)
	{
		foreach($ta->result() as $a)
		{	
			if(($a->kegiatan == 'Unsur utama') or ($a->kegiatan == 'Unsur Penunjang Tugas Guru') or ($a->kegiatan == 'Unsur PKB'))	
			{
				
			}
			else
			{
				echo '<td align="center">'.$nourut.'</td><td align="center">'.$a->tahun.'</td><td>'.$a->kegiatan.'</td><td align="center">'.$a->ak.'</td><td align="center"><strong>'.$a->ak_target.'</strong></td><td align="center"><strong>'.$a->ak_r.'</strong><td align="center">'.$a->golongan.'</td></tr>';
				$jak_target = $jak_target + $a->ak_target ;
				$nourut++;
			}
		}
	}
	echo '<tr><td align="center" colspan="3"></td><td colspan="2">Jumlah Angka Kredit</td><td align="center">'.$jak_target.'</td><td align="center"></td></tr>';
}
else
{
	$this->db->query("delete from `skp_skor_guru_kedua` where `tahun`='$tahun' and `nip`='$nippegawai' and `kegiatan`='Unsur utama'");
	$this->db->query("delete from `skp_skor_guru_kedua` where `tahun`='$tahun' and `nip`='$nippegawai' and `kegiatan`='Unsur Penunjang Tugas Guru'");
	$this->db->query("delete from `skp_skor_guru_kedua` where `tahun`='$tahun' and `nip`='$nippegawai' and `kegiatan`='Unsur PKB'");
	if($ta->num_rows() > 0)
	{
		echo '<tr><td colspan="5"><div class="alert alert-danger">DI BAWAH INI HARUS DIHAPUS</div></tr>';
		foreach($ta->result() as $a)
		{
			echo '<td align="center">'.$nourut.'</td><td align="center">'.$tahun.'</td><td>'.$a->kegiatan.'</td><td align="center">'.$a->ak.'</td><td align="center"><strong>'.$a->ak_target.'</strong></td><td align="center"><strong>'.$a->ak_r.'</strong><td align="center">'.$a->golongan.'</td></tr>';
			$nourut++;
		}
	}
}
echo '</table>';
*/
 // akhir filter tahun 
?>
</div></div></div>
