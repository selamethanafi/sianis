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
<a href="<?php echo base_url();?>kepala/skp/<?php echo $tahun;?>/<?php echo $nip;?>"><h3 class="text-center">PERHITUNGAN PENILAIAN CAPAIAN SASARAN KERJA<BR />PEGAWAI NEGERI SIPIL</h3></a>
<?php
$tahunpenilaian = $tahun;
$awal1 = $tahunpenilaian - 1;
$akhir1 = $tahunpenilaian;
$awal2 = $tahunpenilaian;
$akhir2 = $tahunpenilaian + 1;
$tambahan1 = '';
$tambahan2 = '';
$thnajaran1 = $awal1."/".$akhir1;
$thnajaran2 = $awal2."/".$akhir2;
$persentase1 = 1;
$persentase2 = 1;
$ta = $this->db->query("select * from `p_tugas_tambahan` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran1' and semester='2'");
if(count($ta->result())>0)
{
	foreach($ta->result() as $a)
	{
		$tambahan1 = $a->nama_tugas;
	}
}
$ta = $this->db->query("select * from `p_tugas_tambahan` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran2' and semester='1'");
if(count($ta->result())>0)
{
	foreach($ta->result() as $a)
	{
		$tambahan2 = $a->nama_tugas;
	}
}
if(!empty($tambahan1))
{
	if($tambahan1 !== $tambahan2)
	{
		echo '<div class="alert alert-danger">';
		if(empty($tambahan2))
		{
			echo '<p>Tidak mendapat tugas tambahan tahun pelajaran '.$thnajaran2.' semester 1</p>';
		}
		else
		{
			echo '<p>Tugas tambahan tahun pelajaran '.$thnajaran2.' semester 1 '.$tambahan2.'</p>';
		}
		echo '<p>Tugas tambahan tahun pelajaran '.$thnajaran1.' semester 2 '.$tambahan1.'</p><p>Ybs. harus merevisi target skp</p><p><strong>Revisi target ditandai dengan adanya target yang dicoret</strong></p></div>';
	}
}
echo form_open('kepala/updaterealisasiskp/'.$tahun);
$tg = $this->db->query("select * from `skp_skor_guru` where `nip`='$nip' and `tahun`='$tahun' order by `nourut`");
if($tg->num_rows()>0)
{	
	echo '<table class="table table-striped table-bordered"><tr align="center"><td>Kegiatan</td><td width="7%">AK</td><td width="7%">T. AK</td><td  width="7%">R. AK</td><td width="7%">T. OUTPUT</td><td width="7%">R. OUTPUT</td><td width="7%">T. MUTU</td><td width="10%">R. MUTU</td><td width="7%">T. WAKTU</td><td width="10%">R. WAKTU</td><td width="7%">T. BIAYA</td><td width="7%">R. BIAYA</td></tr>';
	$item = 1;
	foreach($tg->result() as $g)
	{
		$id = $g->id_skp_skor_guru;
		$kodeunsur = $g->kode;
		$kodeunsur = substr($kodeunsur,0,2);
		if(($g->kegiatan == 'Unsur utama') or ($g->kegiatan == 'Unsur Penunjang Tugas Guru') or ($g->kegiatan == 'Unsur PKB'))
		{
			echo '<tr><td>'.$g->kegiatan.'</td></tr>';
		}
		else
		{
			echo '<tr><td>'.$g->kegiatan.'</td><td align="center">'.$g->ak.'</td><td align="center">'.$g->ak_target.'</td>';
			if($kodeunsur == '00') //pkg
			{
				//cari angka kredit pkg
				$th = $this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` like '%Melaksanakan Proses Pembelajaran (PKG)%'");
				$ak_r = '??';
				$nilaipkg = 0;
				foreach($th->result() as $h)
				{
					$ak_r = $h->ak;
				}
				$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip'");
				$npk = 0;
				foreach($tz->result() as $z)
				{
					$npk = $z->pkg;
				}
				$nak_r = $npk * $g->ak_target / 100;
/*
				if(empty($tambahan2))
				{
					$nak_r = $nak_r * 2;
					$npk = 200;
				}
				if($tambahan1 !== $tambahan2)
				{
					$nak_r = $nak_r * 2;
					$npk = 200;
				}
*/
				echo '<td align="center"><input type="hidden" name="ak_r_'.$item.'" value="'.$nak_r.'">'.$npk.'% * '.$g->ak_target.' = ';

				echo '<p class="text-danger">'.$nak_r.'</p></td>';
			}
			elseif($kodeunsur == '01')
			{
				//cari angka kredit pkg
				$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip'");
				$npktambahan = 0;
				foreach($tz->result() as $z)
				{
					$npktambahan = $z->pkg_tambahan;
				}
				$nak_rtambahan = $npktambahan * $g->ak_target / 100;
				echo '<td align="center"><input type="hidden" name="ak_r_'.$item.'" value="'.$nak_rtambahan.'">'.$npktambahan.'% * '.$g->ak_target.' = ';

				echo '<p class="text-danger">'.$nak_rtambahan.'</p></td>';
			}
			else
			{
				echo '<td align="center">'.$g->ak.'</td>';
			}
			$te = $this->db->query("select * from `skp_realisasi` where `id_skp`='$id'");
			$adate = $te->num_rows();
			$td = $this->db->query("SELECT * FROM `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` ='$id' and `nip`='$nip'");
			$adatd = $td->num_rows();
			if($adatd == 0)
			{

				echo '<td align="center"><input type="hidden" name="ak_r_'.$item.'" value="'.$g->ak.'">'.$g->kuantitas.'</td><td align="center">Usul Guru = '.$adate.'<input type="number" name="kuantitas_'.$item.'" value="'.$g->kuantitas_r.'" min="0" max="'.$adate.'" class="form-control"></td><td align="center">'.$g->kualitas.'</td><td align="center"><input type="number" name="kualitas_'.$item.'" min="0" max="100" value="'.$g->kualitas_r.'" class="form-control"></td><td align="center">'.$g->waktu.'</td><td align="center"><input type="number" min="0" max="12" name="waktu_'.$item.'" value="'.$g->waktu_r.'" class="form-control"></td><td align="center">'.$g->biaya.'</td><td align="center"><input type="number" min="0" name="biaya_'.$item.'" value="'.$g->biaya_r.'" class="form-control"><input type="hidden" name="id_skp_skor_guru_'.$item.'"  value ="'.$id.'"><input type="hidden" name="kodeunsur_'.$item.'"  value ="'.$kodeunsur.'"></td></tr>';
			}
			else
			{
				foreach($td->result() as $d)
				{
					$rkuantitas = $d->kuantitas;
					$rkualitas = $d->kualitas;
					$rwaktu = $d->waktu;
					$rbiaya = $d->biaya;
				}
				if($kodeunsur == '01')
				{
					echo '<td align="center"><s>'.$g->kuantitas.'</s><br />'.$rkuantitas.'</td><td align="center">Usul Guru = '.$adate.'<input type="number" name="kuantitas_'.$item.'" value="'.$g->kuantitas_r.'" min="0" max="'.$adate.'" class="form-control"></td><td align="center"><s>'.$g->kualitas.'</s><br />'.$rkualitas.'</td><td align="center"><input type="number" name="kualitas_'.$item.'" min="0" max="100" value="'.$g->kualitas_r.'" class="form-control"></td><td align="center"><s>'.$g->waktu.'</s><br />'.$rwaktu.'</td><td align="center"><input type="number" min="0" max="12" name="waktu_'.$item.'" value="'.$g->waktu_r.'" class="form-control"></td><td align="center"><s>'.$g->biaya.'</s><br />'.$rbiaya.'</td><td align="center"><input type="number" min="0" name="biaya_'.$item.'" value="'.$g->biaya_r.'" class="form-control"><input type="hidden" name="id_skp_skor_guru_'.$item.'"  value ="'.$id.'"><input type="hidden" name="kodeunsur_'.$item.'"  value ="'.$kodeunsur.'"></td></tr>';
				}
				else
				{
					echo '<td align="center"><s>'.$g->kuantitas.'</s><br />'.$rkuantitas.'</td><td align="center">Usul Guru = '.$adate.'<input type="number" name="kuantitas_'.$item.'" value="'.$g->kuantitas_r.'" min="0" max="'.$adate.'" class="form-control"></td><td align="center"><s>'.$g->kualitas.'</s><br />'.$rkualitas.'</td><td align="center"><input type="number" name="kualitas_'.$item.'" min="0" max="100" value="'.$g->kualitas_r.'" class="form-control"></td><td align="center"><s>'.$g->waktu.'</s><br />'.$rwaktu.'</td><td align="center"><input type="number" min="0" max="12" name="waktu_'.$item.'" value="'.$g->waktu_r.'" class="form-control"></td><td align="center"><s>'.$g->biaya.'</s><br />'.$rbiaya.'</td><td align="center"><input type="number" min="0" name="biaya_'.$item.'" value="'.$g->biaya_r.'" class="form-control"><input type="hidden" name="id_skp_skor_guru_'.$item.'"  value ="'.$id.'"><input type="hidden" name="kodeunsur_'.$item.'"  value ="'.$kodeunsur.'"></td></tr>';
				}

			}

		$item++;
		}
	}
		$cacahitem = $item - 1;
	echo '</table><br /><p class="text-center"><input type="hidden" name="nip"  value ="'.$nip.'"><input type="hidden" name="cacahitem"  value ="'.$cacahitem.'"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
	echo '</form><br /><br />';
}
?>
</div>
