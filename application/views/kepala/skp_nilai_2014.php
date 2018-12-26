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
echo form_open('kepala/updaterealisasiskp2014/'.$tahun);
$tg = $this->db->query("select * from `skp_skor_guru` where `nip`='$nip' and `tahun`='$tahun' order by `nourut`");
if($tg->num_rows()>0)
{	
	echo '<table class="table table-striped table-bordered"><tr align="center"><td>Kegiatan</td><td width="7%">Nomor Urut</td><td width="7%">AK</td><td width="7%">T. AK</td><td  width="15%">R AK</td><td width="7%">T. OUTPUT</td><td width="7%">R. OUTPUT</td><td width="7%">T. MUTU</td><td width="10%">R. MUTU</td><td width="7%">T. WAKTU</td><td width="10%">R. WAKTU</td></tr>';
	$item = 1;
	foreach($tg->result() as $g)
	{
		$id = $g->id_skp_skor_guru;
		$kodeunsur = $g->kode;
		$kodeunsur = substr($kodeunsur,0,2);
		if(($g->kegiatan == 'Unsur utama') or ($g->kegiatan == 'Unsur Penunjang Tugas Guru') or ($g->kegiatan == 'Unsur PKB'))
		{
			echo '<tr><td>'.$g->kegiatan.'</td><td align="center"><input type="text" name="nourut_'.$item.'" value="'.$g->nourut.'" class="form-control"><input type="hidden" name="id_skp_skor_guru_'.$item.'"  value ="'.$id.'"></td></tr>';
		}
		else
		{
			echo '<tr><td>'.$g->kegiatan.'</td><td align="center"><input type="text" name="nourut_'.$item.'" value="'.$g->nourut.'" class="form-control"></td><td align="center">'.$g->ak.'</td><td align="center">'.$g->ak_target.'</td>';
			echo '<td align="center">'.$g->ak_target;
			echo '<input type="text" name="ak_r_'.$item.'" value="'.$g->ak_r.'" class="form-control"></td>';
			echo '<td align="center"><input type="text" name="kuantitas_'.$item.'" value="'.$g->kuantitas.'" class="form-control"></td><td align="center"><input type="text" name="kuantitas_r_'.$item.'" value="'.$g->kuantitas_r.'" class="form-control"></td><td align="center"><input type="text" name="kualitas_'.$item.'" value="'.$g->kualitas.'" class="form-control"</td><td align="center"><input type="text" name="kualitas_r_'.$item.'" value="'.$g->kualitas_r.'" class="form-control"></td><td align="center"><input type="text" name="waktu_'.$item.'" value="'.$g->waktu.'" class="form-control"></td><td align="center"><input type="text" name="waktu_r_'.$item.'" value="'.$g->waktu_r.'" class="form-control"></td><input type="hidden" name="id_skp_skor_guru_'.$item.'"  value ="'.$id.'"><input type="hidden" name="kodeunsur_'.$item.'"  value ="'.$kodeunsur.'"></td></tr>';
		}
			$item++;
	}
		$cacahitem = $item - 1;
	echo '</table><br /><p class="text-center"><input type="hidden" name="nip"  value ="'.$nip.'"><input type="hidden" name="cacahitem"  value ="'.$cacahitem.'"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
	echo '</form><br /><br />';
}
?>
</div>
