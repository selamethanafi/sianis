<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 08 Jan 2016 09:44:23 WIB 
// Nama Berkas 		: skp.php
// Lokasi      		: application/views/kepala/
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$tm = $this->db->query("select * from `pkg_masa` order by tahun DESC");
$xloc = base_url().'kepala/periksaskp';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-9"><select name="tahun" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$tahun.'">'.$tahun.'</option>';
	foreach($tm->result() as $m)
	{
	echo '<option value="'.$xloc.'/'.$m->tahun.'">'.$m->tahun.'</option>';
	}
	echo '</select></div></div>';
if(!empty($tahun))
{
	if(empty($nip))
	{
		$ta = $this->db->query("select * from `p_pegawai` where nip !='' and `status`='Y' order by nama_tanpa_gelar");
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Guru</label></div><div class="col-sm-9">';
		?>
		<select name="nip" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$nip.'">'.$namagurune.'</option>';
		foreach($ta->result() as $a)
		{
			echo '<option value="'.$xloc.'/'.$tahun.'/'.$a->nip.'">'.$a->nama_tanpa_gelar.'</option>';
		}
		echo '</select></div></div>';

	}
	else
	{
		$ta = $this->db->query("select * from `p_pegawai` where nip ='$nip'");
		$namagurune = '';
		foreach($ta->result() as $a)
		{
			$namagurune = $a->nama_tanpa_gelar;
		}
		$ta = $this->db->query("select * from `p_pegawai` where nip !='' and `status`='Y' order by nama_tanpa_gelar");
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Guru</label></div><div class="col-sm-9">';
		?>
		<select name="nip" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$nip.'">'.$namagurune.'</option>';
		foreach($ta->result() as $a)
		{
			echo '<option value="'.$xloc.'/'.$tahun.'/'.$a->nip.'">'.$a->nama_tanpa_gelar.'</option>';
		}
		echo '</select></div></div>';
	}
}
if((!empty($nip)) and (!empty($tahun)))
{
	$nomor =1;
	$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nip' and `tahun`='$tahun'");
	if($tb->num_rows() == 0)
	{
		echo 'Belum ada status skp';
	}
	else
	{
		foreach($tb->result() as $b)
		{
			$idskawal = $b->skawal;
			$idskakhir = $b->skakhir;
			$tawal = $b->tawal;
			$takhir = $b->takhir;
		}
		$gol1 = id_sk_jadi_golongan($idskawal) ;
		$pangkat1 = golongan_jadi_pangkat($gol1);
		$jabatan1 = golongan_jadi_jabatan($gol1);
		$ref_ak = 0;
		$tc = $this->db->query("select * from `skp_skor` where `golongan`='$gol1' and `kriteria`='b'");
		foreach($tc->result() as $c)
		{
			$ref_ak = $c->skor;
		}
		$p100 = $ref_ak;
		$p75 = 0.75 * $p100;
		$p50 = 0.5 * $p100;
		$p25 = 0.25 * $p100;
		$p5 = 0.05 * $p100;
		$p2 = 0.2 * $p100;
		echo '<table class="table table-bordered"><tr align="center"><td>Golongan</td><td>AK 100%</td><td>AK 75%</td><td>AK 50%</td><td>AK 25%</td><td>AK 5%</td><td>AK 2%</td></tr>';
		echo '<tr align="center"><td>'.$gol1.'</td><td>'.$p100.'</td><td>'.$p75.'</td><td>'.$p50.'</td><td>'.$p25.'</td><td>'.$p5.'</td><td>'.$p2.'</td></tr></table>';
	}
	echo '<table class="table table-striped table-hover table-bordered">
<tr><td>No</td><td>KEGIATAN</td><td>Realisasi</td><td>AK</td><td>T. AK</td><td>R. AK</td><td>Kuantitas</td><td>Output</td><td>T. Waktu</td><td>R. Waktu</td><td>Waktu</td></tr>';
	$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$nip' order by `nourut`");
	if(count($ta->result())>0)
	{
		$jak = 0;
		$jakt = 0;
		$jakr = 0;
		foreach($ta->result() as $a)
		{
			if(($a->kegiatan == 'Unsur utama') or ($a->kegiatan == 'Unsur Penunjang Tugas Guru') or ($a->kegiatan == 'Unsur PKB'))
			{
			}
			else
			{
				$id = $a->id_skp_skor_guru;
				$ta3=$this->db->query("select * from `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi`='$id'");
				if($ta3->num_rows() > 0)
				{
/*
					if(($a->satuanwaktu == 'bl') or ($a->satuanwaktu == 'Bl'))
					{
						if(($a->waktu < 12) or ($a->waktu_r < 12))
						{
							echo '<tr class="danger">';
						}
						else
						{
							echo '<tr>';
						}
					}
					else
					{
*/						echo '<tr>';
/*					}
*/
					echo '<td align="center"><a href="'.base_url().'kepala/hapusskp/'.$tahun.'/'.$nip.'/'.$a->id_skp_skor_guru.'" data-confirm="Yakin hendak dihapus '.strip_tags($a->kegiatan).'" class="btn btn-danger">'.$nomor.'</a></td><td><a href="'.base_url().'kepala/revak/'.$tahun.'/'.$nip.'/'.$a->id_skp_skor_guru.'" data-confirm="Yakin hendak mengubah angka kredit '.strip_tags($a->kegiatan).'" class="btn btn-warning">'.$a->kegiatan.'</a>';
			echo '</td><td align="center">'.$a->ak.'</td><td align="center">'.$a->ak_target.'</td><td align="center">'.$a->ak_r.'</td><td align="center">'.$a->kuantitas.'</td><td align="center">'.$a->kuantitas_r.'</td><td align="center">'.$a->waktu.'</td><td align="center">'.$a->waktu_r.'</td><td align="center">'.$a->satuanwaktu.'</td></tr>';
				}
				else
				{
/*
					if(($a->satuanwaktu == 'bl') or ($a->satuanwaktu == 'Bl'))
					{
						if(($a->waktu < 12) or ($a->waktu_r < 12))
						{
							echo '<tr class="danger">';
						}
						else
						{
							echo '<tr>';
						}
					}
					else
					{
*/
						echo '<tr>';
/*
					}
*/
					echo '<td align="center"><a href="'.base_url().'kepala/hapusskp/'.$tahun.'/'.$nip.'/'.$a->id_skp_skor_guru.'" data-confirm="Yakin hendak dihapus '.strip_tags($a->kegiatan).'" class="btn btn-danger">'.$nomor.'</a></td><td><a href="'.base_url().'kepala/ubahskp/'.$tahun.'/'.$nip.'/'.$a->id_skp_skor_guru.'" data-confirm="Yakin hendak mengubah '.strip_tags($a->kegiatan).'">'.$a->kegiatan.'</a> ';
			echo ' <a href="'.base_url().'kepala/revisiskp/'.$tahun.'/'.$nip.'/'.$a->id_skp_skor_guru.'" data-confirm="Yakin hendak merevisi '.strip_tags($a->kegiatan).'" class="btn btn-warning">Revisi</a>  <a href="'.base_url().'kepala/tambahrealisasi/'.$tahun.'/'.$nip.'/'.$a->id_skp_skor_guru.'" data-confirm="Yakin hendak menambah realisasi '.strip_tags($a->kegiatan).'" class="btn btn-info">Realisasi</a>  <a href="'.base_url().'kepala/nilaiskp/'.$tahun.'/'.$nip.'/'.$a->id_skp_skor_guru.'" data-confirm="Yakin hendak menilai '.strip_tags($a->kegiatan).'" class="btn btn-success">Nilai</a></td>';
			$id_skp = $a->id_skp_skor_guru;
			$td = $this->db->query("select * from `skp_realisasi` where `id_skp`='$id_skp'");
			$adatd = $td->num_rows();
			$bulanrealisasi = '';
			foreach($td->result() as $d)
			{
				if(empty($bulanrealisasi))
				{
					$bulanrealisasi .= '<a href="'.base_url().'kepala/hapusrealisasiskp/'.$tahun.'/'.$nip.'/'.$d->id_skp_realisasi.'" title="Menghapus Realisasi" data-confirm="Yakin hendak dihapus" class="btn btn-danger">'.gantibulan($d->bulan).'</a>';
				}
				else
				{
					$bulanrealisasi .= '<br /><a href="'.base_url().'kepala/hapusrealisasiskp/'.$tahun.'/'.$nip.'/'.$d->id_skp_realisasi.'" title="Menghapus Realisasi" data-confirm="Yakin hendak dihapus" class="btn btn-danger">'.gantibulan($d->bulan).'</a>';
				}

			}
			echo '<td>'.$bulanrealisasi.'</td><td align="center">'.$a->ak.'</td><td align="center">'.$a->ak_target.'</td><td align="center">'.$a->ak_r.'</td><td align="center">'.$a->kuantitas.'</td><td align="center">'.$a->kuantitas_r.'</td><td align="center">'.$a->waktu.'</td><td align="center">'.$a->waktu_r.'</td><td align="center">'.$a->satuanwaktu.'</td></tr>';

				}
			$jak = $jak + $a->ak;
			$jakt = $jakt + $a->ak_target;
			$jakr = $jakr + $a->ak_r;
			$nomor++;
			}
		}
	echo '<tr><td align="center" colspan="3">Jumlah</td><td align="center">'.$jak.'</td><td align="center">'.$jakt.'</td><td align="center">'.$jakr.'</td><td colspan="5"></td></tr>';

	}
	/*** Revisi ***/
	$ta3=$this->db->query("select * from `skp_skor_guru_revisi` where `tahun`='$tahun' and `nip`='$nip' order by `nourut`");
	if(count($ta3->result())>0)
	{
		echo '<tr><td colspan="15"><h2>SKP Revisi</h2></td></tr>';
		$jak3 = 0;
		$jakt3 = 0;
		$jakr3 = 0;
		foreach($ta3->result() as $a3)
		{
			if(($a3->kegiatan == 'Unsur utama') or ($a3->kegiatan == 'Unsur Penunjang Tugas Guru') or ($a3->kegiatan == 'Unsur PKB'))
			{
			}
			else
			{
				$id = $a3->id_skp_skor_guru_revisi;
				$kegiatan ='?';
				$ta=$this->db->query("select * from `skp_skor_guru` where `id_skp_skor_guru`='$id'");
				if($ta->num_rows() > 0)
				{
					foreach($ta->result() as $a)
					{
						$kegiatan = $a->kegiatan;
					}
				}
				echo '<tr><td align="center"><a href="'.base_url().'kepala/hapusskprevisi/'.$tahun.'/'.$nip.'/'.$a3->id_skp_skor_guru_revisi.'" data-confirm="Yakin hendak dihapus Revisi '.strip_tags($kegiatan).'" class="btn btn-danger">'.$nomor.'</a></td><td colspan="4"> <a href="'.base_url().'kepala/revisiskp/'.$tahun.'/'.$nip.'/'.$a->id_skp_skor_guru.'" data-confirm="Yakin hendak merevisi '.strip_tags($a->kegiatan).'" class="btn btn-warning">'.$kegiatan.'</a></td></tr>';
				$nomor++;
			}
		}
	}
	/*** tambahan ***/
	$tx = $this->db->query("select * from `p_pegawai` where `nip` = '$nip'");
	$usernameguru = 'xx';
	foreach($tx->result() as $xx)
	{
		$usernameguru = $xx->kd;
	}
	$ta3=$this->db->query("select * from `dupak_skp` where `tahun`='$tahun' and `username`='$usernameguru'");
	if(count($ta3->result())>0)
	{
		echo '<tr><td colspan="15">SKP Tambahan</td></tr>';
		$jak3 = 0;
		$jakt3 = 0;
		$jakr3 = 0;
		foreach($ta3->result() as $a3)
		{
			$kode = $a3->kode;
			$kegiatan ='?';
			$ta=$this->db->query("select * from `skp_tabel_skor` where `kode`='$kode'");
			if($ta->num_rows() > 0)
			{
				foreach($ta->result() as $a)
				{
					$kegiatan = $a->kegiatan;
				}
				$te=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$nip' and `kode` = '$kode'");
				$pesan = '';
				if($te->num_rows() >0)
				{
					$pesan = '<div class="alert alert-danger">Sudah ada di SKP</div>';
				}
				
				echo '<tr><td align="center">';
				if($te->num_rows() == 0)
				{ echo '<a href="'.base_url().'kepala/pindahskptambahan/'.$tahun.'/'.$nip.'/'.$a3->id_dupak_skp.'" data-confirm="Yakin hendak dipindahkan ke borang SKP '.strip_tags($kegiatan).'" class="btn btn-success">'.$nomor.'</a>';
				}
				else
				{
					echo $nomor;
				}
				echo '</td><td>'.$kegiatan.' '.$pesan.'</td><td></td><td align="center">'.$a3->ak.'</td>';
				$ak_target = $a3->kuantitas * $a3->ak;
				echo '<td align="center">'.$ak_target.'</td><td align="center">'.$ak_target.'</td><td align="center">'.$a3->kuantitas.'</td><td align="center">'.$a3->kuantitas.'</td><td align="center"></td><td align="center"></td><td align="center"></td></tr>';
				$nomor++;
			}
		}
	}

	echo '</table>';
}
echo '</form>';

?>
</div>
