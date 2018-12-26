<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp_tugas.php
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
$tahunsekarang=$tahunpenilaian;
$tanggalsekarang = tanggal_hari_ini();
$tahunsaja = tahunsaja($tanggalsekarang);
/*
if($tahunsaja != $tahunsekarang)
{
	echo 'SKP harus dibuat pada tahun berjalan';
}
// harus juga dibulan januari
/*
elseif($bulansaja != '01')
{
	echo 'SKP harus dibuat pada bulan Januari';
}
*/
/*
else
{
*/
	$tahunsekarang=$tahunpenilaian;
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$nip'");
$permanen = 0;
foreach($tz->result() as $z)
	{
	$permanen = $z->permanen;
	}
if($permanen == 1)
{
	$tb = $this->db->query("SELECT * FROM `skp_skor_guru` where `id_skp_skor_guru` ='$id' and `nip`='$nip'");
	$adatb = $tb->num_rows();
	if($adatb>0)
	{
		echo form_open('pkg/realisasiskp/'.$id,'class="form-horizontal" role="form"');
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9">'.$tahunsekarang.'</strong></div></div>';
		foreach($tb->result() as $b)
			{
			//cari nilai ak
			$kode = $b->kode;
			$ak = 0;
			if($kode == '01')
				{
					$ak = $b->ak_target;
				}
				else
				{
					$tc = $this->db->query("SELECT * FROM `skp_tabel_skor` where `kode` ='$kode'");		
					foreach($tc->result() as $c)
					{
					$ak = $c->ak;
					}
				}
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><p class="form-control-static">'.$b->kegiatan.'</p></div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Bulan Pencapaian</label></div><div class="col-sm-9"><p class="form-control-static"><select name="bulan" class="form-control">';
			for($i=1;$i<=12;$i++)
			{
				$bulane = gantibulan($i);
				echo '<option value="'.$i.'">'.$bulane.'</option>';
			}
			echo '</select></p></div></div>';
			echo '<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
			}
		echo '</form>';
	}
echo '<p class="text-info">Klik nama kegiatan untuk menambah cacah realisasi. Klik nama bulan untuk menghapus realisasi</p>';
$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nip' order by `nourut`");
echo '<table class="table table-striped table-hover table-bordered">
<tr><td>No</td><td colspan="2" align="center">III. KEGIATAN TUGAS JABATAN</td><td align="center">TARGET</td><td align="center">Realisasi disetujui</td><td align="center">Usul Realisasi</td><td align="center">Bulan</td></tr>';
$jak_target = 0;
$nomor = 1;
$nourut = 1;
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
			echo '<td align="center">'.$nourut.'</td><td><a href="'.base_url().'pkg/realisasiskp/'.$a->id_skp_skor_guru.'" title="Menambah Cacah Realisasi SKP">'.$a->kegiatan.'</a></td><td align="center">'.$a->ak.'</td><td align="center">'.$a->kuantitas.'</td><td align="center">'.$a->kuantitas_r.'</td>';
			$id_skp = $a->id_skp_skor_guru;
			$td = $this->db->query("select * from `skp_realisasi` where `id_skp`='$id_skp'");
			$adatd = $td->num_rows();
			$bulanrealisasi = '';
			foreach($td->result() as $d)
			{
				if(empty($bulanrealisasi))
				{
					$bulanrealisasi .= '<a href="'.base_url().'pkg/hapusrealisasiskp/'.$d->id_skp_realisasi.'" title="Menghapus Realisasi">'.gantibulan($d->bulan).'</a>';
				}
				else
				{
					$bulanrealisasi .= '<br /><a href="'.base_url().'pkg/hapusrealisasiskp/'.$d->id_skp_realisasi.'" title="Menghapus Realisasi">'.gantibulan($d->bulan).'</a>';
				}

			}
			echo '<td align="center">'.$adatd.'</td><td>'.$bulanrealisasi.'</td></tr>';
		$jak_target = $jak_target + $a->ak_target ;
		$nourut++;
		}
	$nomor++;
	}
}
echo '</table>';
	echo '<p class="text-center"><a href="'.base_url().'pkg/realisasiskp/permanen" class="btn btn-info"><b>Kirim Pemberitahuan kepada Admin</b></a></p> ';
}
else
{
	echo '<div class="alert alert-info">Belum Permanen, permanenkan dulu</div>';
}
//} //akhir tahun
?>

</div></div></div>

