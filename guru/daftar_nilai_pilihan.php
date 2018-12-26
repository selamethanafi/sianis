<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:23:28 WIB 
// Nama Berkas 		: daftarnilai.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$jenis_deskripsi = 0;
$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
foreach($tmapel->result() as $dtmapel)
{
	$jenis_deskripsi = $dtmapel->jenis_deskripsi;
}
if ($jenis_deskripsi==1)
{$jenis_deskripsine = "Berdasarkan Ulangan (Deskripsi Otomatis)";
}
if ($jenis_deskripsi==2)
{
	$jenis_deskripsine = "Berdasarkan Nilai Akhir (Deskripsi Otomatis)";
}
if ($jenis_deskripsi==5)
{
	$jenis_deskripsine = "Berdasarkan Nilai Sekolah (Deskripsi Otomatis)";
}
if ($jenis_deskripsi==3)
{
	$jenis_deskripsine = "Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)";
}
if ($jenis_deskripsi==0)
{$jenis_deskripsine = "Kopi Paste / Manual";
}
if ($jenis_deskripsi==6)
{$jenis_deskripsine = $this->config->item('versi_deskripsi');
}
if ($jenis_deskripsi==4)
{$jenis_deskripsine = "Berdasar bank deskripsi";
}
$ta = $this->db->query("SELECT * FROM `m_mapel_rapor` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `nama_mapel_portal` like '%Prakarya%'");
foreach($ta->result() as $a)
{
	$no_urut_mapel = $a->no_urut;
}
if($pilihan == '1')
{
	$pilihane = 'Pilihan';
}
elseif($pilihan == 0)
{
	$pilihane = 'Wajib';
}
$this->db->query("update `nilai_pilihan` set `kd_mapel` = '$no_urut_mapel' where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel'");

$query = $this->db->query("select * from `nilai_pilihan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut`");
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php
if(($kurikulum == '2013') and ($ranah != 'KPA'))
{
	echo '<div class="alert alert-danger">"Awas, ranah tidak sesuai dengan kurikulum. <strong>Ranah seharusnya KPA</</strong></div>';
}
if(($kurikulum == '2015') and ($ranah != 'KP'))
{
	echo '<div class="alert alert-danger">"Awas, ranah tidak sesuai dengan kurikulum. <strong>Ranah seharusnya KP</</strong></div>';
}

$thnajaranskr = cari_thnajaran();
if($thnajaran != $thnajaranskr)
{
	echo '<p><a href="'.base_url().'guru/nilailama/" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> <b>Kelas Lain Semester Lalu</b></a>&nbsp;&nbsp;&nbsp;&nbsp;';
}
else
{
	echo '<p><a href="'.base_url().'guru/nilai/" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> <b>Kelas Lain</b></a>&nbsp;&nbsp;&nbsp;&nbsp;';
}
if(($jenis_deskripsi == 6) or ($jenis_deskripsi == 1) or ($jenis_deskripsi == 5))
{?>
	<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>deskripsi/hapus/<?php echo $id_mapel;?>/mapel','yes','scrollbars=yes,width=550,height=400')"  class='btn btn-danger'> HAPUS DESKRIPSI</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<?php
}
echo '<a href="'.base_url().'guru/statusketuntasan/'.$id_mapel.'" class="btn btn-success"><b>PROSES DESKRIPSI RAPOR</b></a></p> ';
?>
<form class="form-horizontal" role="form">
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $thnajaran;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Semester</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $semester;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Kelas</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $kelas;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $mapel;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Ranah Penilaian</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $ranah;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">KKM / Cacah Ulangan Harian / Cacah Kuis / Cacah Tugas</label></div><div class="col-sm-7"><p class="form-control-static"><strong><?php echo $kkm;?> </strong> / <strong><?php echo $cacah_ulangan_harian;?></strong>/ <strong><?php echo $cacah_kuis;?></strong> / <strong><?php echo $cacah_tugas;?></strong> <a href="<?php echo base_url();?>guru/ubahkkm/<?php echo $id_mapel;?>" title="Ubah KKM dll"><span class="fa fa-edit"></span></a></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Bobot Ulangan Harian + Bobot Kuis + Bobot Tugas + Mid + Semester</label></div><div class="col-sm-7"><p class="form-control-static"><?php 
$persentase = $nbobot_ulangan_harian + $nbobot_kuis + $nbobot_tugas + $nbobot_mid + $nbobot_semester;
echo '<strong>'.$nbobot_ulangan_harian;?>% </strong> + <strong><?php echo $nbobot_kuis;?>% </strong> + <strong><?php echo $nbobot_tugas;?>%</strong> + <strong><?php echo $nbobot_mid;?>%</strong> + <strong><?php echo $nbobot_semester;?>%</strong> = <strong><?php echo $persentase;?>%</strong>  <a href="<?php echo base_url();?>guru/ubahkkm/<?php echo $id_mapel;?>" title="Ubah KKM dll"><span class="fa fa-edit"></span></a></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Jenis Deskripsi</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $jenis_deskripsi;?> <?php echo $jenis_deskripsine;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Kurikulum</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $kurikulum;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Status Mata Pelajaran</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $pilihane;?></div></div>
</form>
<?php
/*
if($nbuh1+$nbuh2+$nbuh3+$nbuh4>$cacah_ulangan_harian)
{
	echo '<div class="alert alert-danger">Awas, bobot uh 1 + bobot uh 2 + bobot uh 3 + bobot uh 4 melebihi cacah ulangan harian, ubah KKM di <a href="'.base_url().'guru/ubahkkm/'.$id_mapel.'">sini</a></div>';
}
*/
if(($jenis_deskripsi == 6) or ($jenis_deskripsi == 1))
{
	echo '<div class="alert alert-warning">Bila menentukan jenis deskripsi ini setelah mengisi nilai (nilai sudah ada), maka semua nilai harus dikirim ulang. Klik UH1 / Penilaian 1 /KD1 lalu klik tombol Simpan, berikutnya Klik UH2/KD2 lalu klik tombol Simpan, dst.</div>';
}
?>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered"><thead>
<tr align="center"><td><strong>No</strong></td><td><strong>Nama</strong></td>
<?php
if($kkm_uh1 == 0)
{
	$kkm_uh1 = $kkm;
}
if($kkm_uh2 == 0)
{
	$kkm_uh2 = $kkm;
}
if($kkm_uh3 == 0)
{
	$kkm_uh3 = $kkm;
}
if($kkm_uh4 == 0)
{
	$kkm_uh4 = $kkm;
}
$kkm_uh5 = $kkm;
$kkm_uh6 = $kkm;
$kkm_uh7 = $kkm;
$kkm_uh8 = $kkm;
$kkm_uh9 = $kkm;
$kkm_uh10 = $kkm;
if($kkm_mid == 0)
{
	$kkm_mid = $kkm;
}
if($kkm_uas == 0)
{
	$kkm_uas = $kkm;
}
if ($cacah_ulangan_harian>0)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi1))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/1" title="Ubah Nilai KD '.$materi1.'"><strong>KD1</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/1" title="Ubah Penilaian Harian 1"><strong>PH1</strong></a></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/1" title="Ubah Nilai Ulangan Harian 1"><strong>UH1</strong></a></td>';
		}


	}
}
if ($cacah_ulangan_harian>1)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi2))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/2" title="Ubah Nilai KD '.$materi2.'"><strong>KD2</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/2" title="Ubah Penilaian Harian 2"><strong>PH2</strong></a><br /></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/2" title="Ubah Nilai Ulangan Harian 2"><strong>UH2</strong></a><br /></td>';
		}

	}
}
if ($cacah_ulangan_harian>2)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi3))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/3" title="Ubah Nilai KD '.$materi3.'"><strong>KD3</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/3" title="Ubah Penilaian Harian 3"><strong>PH3</strong></a><br /></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/3" title="Ubah Nilai Ulangan Harian 3"><strong>UH3</strong></a><br /></td>';
		}

	}
}
if ($cacah_ulangan_harian>3)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi4))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/11" title="Ubah Nilai KD '.$materi4.'"><strong>KD4</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/11" title="Ubah Penilaian Harian 4"><strong>PH4</strong></a><br /></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/11" title="Ubah Nilai Ulangan Harian 4"><strong>UH4</strong></a><br /></td>';
		}
		
	}
}
if ($cacah_ulangan_harian>4)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi5))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/18" title="Ubah Nilai KD '.$materi5.'"><strong>KD5</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/18" title="Ubah Penilaian Harian 5"><strong>PH5</strong></a><br /></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/18" title="Ubah Nilai Ulangan Harian 5"><strong>UH5</strong></a><br /></td>';
		}

	}
}
if ($cacah_ulangan_harian>5)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi6))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/19" title="Ubah Nilai KD '.$materi6.'"><strong>KD6</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/19" title="Ubah Penilaian Harian 6"><strong>PH6</strong></a><br /></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/19" title="Ubah Nilai Ulangan Harian 6"><strong>UH6</strong></a><br /></td>';
		}

	}
}
if ($cacah_ulangan_harian>6)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi7))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/20" title="Ubah Nilai KD '.$materi7.'"><strong>KD7</strong></a></td>';
		}
	}
	else
	{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/20" title="Ubah Nilai Ulangan Harian 7"><strong>UH7</strong></a><br /></td>';
	}
}
if ($cacah_ulangan_harian>7)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi8))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/21" title="Ubah Nilai KD '.$materi8.'"><strong>KD8</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/21" title="Ubah Penilaian Harian 8"><strong>PH8</strong></a><br /></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/21" title="Ubah Nilai Ulangan Harian 8"><strong>UH8</strong></a><br /></td>';
		}

	}
}
if ($cacah_ulangan_harian>8)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi9))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/22" title="Ubah Nilai KD '.$materi9.'"><strong>KD9</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/22" title="Ubah Penilaian Harian 9"><strong>PH9</strong></a><br /></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/22" title="Ubah Nilai Ulangan Harian 9"><strong>UH9</strong></a><br /></td>';
		}

	}
}
if ($cacah_ulangan_harian>9)
{
	if($jenis_deskripsi == 6)
	{
		if(empty($materi10))
		{
			echo '<td>KD masih kosong</td>';
		}
		else
		{
		echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/23" title="Ubah Nilai KD '.$materi10.'"><strong>KD10</strong></a></td>';
		}
	}
	else
	{
		if($kurikulum == '2015')
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/23" title="Ubah Penilaian Harian 10"><strong>PH10</strong></a><br /></td>';
		}
		else
		{
			echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/23" title="Ubah Nilai Ulangan Harian 10"><strong>UH10</strong></a><br /></td>';
		}

	}
}
if($cacah_ulangan_harian>0)
{
	if($kurikulum == '2015')
	{
		echo '<td align="center"><strong>Rata<br />Rata</strong><br />'.$nbobot_ulangan_harian.'%</td>';
	}
	else
	{
		echo '<td align="center"><strong>RUH</strong><br />'.$nbobot_ulangan_harian.'%</td>';
	}

}
if ($cacah_kuis>0)
{echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/14" title="Ubah Nilai Kuis 1"><strong>KU1</strong></a></td>';}
if ($cacah_kuis>1)
{echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/15" title="Ubah Nilai Kuis 2"><strong>KU2</strong></a></td>';}
if ($cacah_kuis>2)
{echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/16" title="Ubah Nilai Kuis 3"><strong>KU3</strong></a></td>';}
if ($cacah_kuis>3)
{echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/17" title="Ubah Nilai Kuis 4"><strong>KU4</strong></a></td>';}
if($cacah_kuis>0)
{
	echo '<td align="center"><strong>RKUIS</strong><br />'.$nbobot_kuis.'%</td>';
}
if ($cacah_tugas>0)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/4" title="Ubah Nilai Tugas 1"><strong>TU1</strong></a></td>';}
if ($cacah_tugas>1)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/5" title="Ubah Nilai Tugas 2"><strong>TU2</strong></a></td>';}
if ($cacah_tugas>2)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/6" title="Ubah Nilai Tugas 3"><strong>TU3</strong></a></td>';}
if ($cacah_tugas>3)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/12" title="Ubah Nilai Tugas 4"><strong>TU4</strong></a></td>';}
if ($cacah_tugas>4)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/24" title="Ubah Nilai Tugas 5"><strong>TU5</strong></a></td>';}
if ($cacah_tugas>5)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/25" title="Ubah Nilai Tugas 6"><strong>TU6</strong></a></td>';}
if ($cacah_tugas>6)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/26" title="Ubah Nilai Tugas 7"><strong>TU7</strong></a></td>';}
if ($cacah_tugas>7)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/27" title="Ubah Nilai Tugas 8"><strong>TU8</strong></a></td>';}
if ($cacah_tugas>8)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/28" title="Ubah Nilai Tugas 9"><strong>TU9</strong></a></td>';}
if ($cacah_tugas>9)
{
echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/29" title="Ubah Nilai Tugas 10"><strong>TU10</strong></a></td>';}

if($cacah_tugas>0)

{
	echo '<td align="center"><strong>RTU</strong><br />'.$nbobot_tugas.'%</td>';
}
if($kurikulum == '2015')
{
	echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/7" title="Ubah Penilaian Tengah Semester"><strong>PTS</strong></a><br />'.$nbobot_mid.'%<br /><a href="'.base_url().'guru/deskripsimid/'.$id_mapel.'/proses" title="Ubah Deskripsi Penilaian Tengah Semester">Deskripsi</a></td><td>';
	if($semester == '1')
	{
		echo '<a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/8" title="Ubah Penilaian Akhir Semester"><strong>PAS</strong></a>';
	}
	else
	{
		echo '<a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/8" title="Ubah Penilaian Akhir Tahun"><strong>PAT</strong></a>';
	}
	echo '<br />'.$nbobot_semester.'%</td><td><strong>NA</strong></td>';
}
else
{
	echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/7" title="Ubah Nilai Mid"><strong>MID</strong></a><br />'.$nbobot_mid.'%<br /><a href="'.base_url().'guru/deskripsimid/'.$id_mapel.'/proses" title="Ubah Deskripsi Ulangan Tengah Semester">Deskripsi</a></td><td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/8" title="Ubah Nilai Ulangan Akhir Semester"><strong>SMT</strong></a><br />'.$nbobot_semester.'%</td><td><strong>NA</strong></td>';
}

if($jujug == 'T')
{
	if($kurikulum == '2013')
	{
	echo '<td colspan="2"><strong>NS</strong></td></tr>';
	}
	else
	{
	echo '<td><strong>NS</strong></td></tr>';
	}
}
else
{
	if($kurikulum == '2013')
	{
	echo '<td colspan="2"><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/13" title="Ubah Nilai Sekolah"><strong>NS</strong></a></td></tr>';
	}
	else
	{
	echo '<td><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/13" title="Ubah Nilai Sekolah"><strong>NS</strong></a></td></tr>';
	}
}
?>
</thead>
<?php
$nomor=1;
$rata_nilai_uh1= 0;
$rata_nilai_uh2= 0;
$rata_nilai_uh3= 0;
$rata_nilai_uh4= 0;
$rata_nilai_uh5= 0;
$rata_nilai_uh6= 0;
$rata_nilai_uh7= 0;
$rata_nilai_uh8= 0;
$rata_nilai_uh9= 0;
$rata_nilai_uh10= 0;
$rata_nilai_ruh= 0;
$rata_nilai_tu1= 0;
$rata_nilai_tu2= 0;
$rata_nilai_tu3= 0;
$rata_nilai_tu4= 0;
$rata_nilai_tu5= 0;
$rata_nilai_tu6= 0;
$rata_nilai_tu7= 0;
$rata_nilai_tu8= 0;
$rata_nilai_tu9= 0;
$rata_nilai_tu10= 0;
$rata_nilai_rtu= 0;
$rata_nilai_mid= 0;
$rata_nilai_uas= 0;
$rata_nilai_na= 0;
$rata_nilai_nr= 0;
$cacah_di_bawah_kkm_uh1= 0;
$cacah_di_bawah_kkm_uh2= 0;
$cacah_di_bawah_kkm_uh3= 0;
$cacah_di_bawah_kkm_uh4= 0;
$cacah_di_bawah_kkm_uh5= 0;
$cacah_di_bawah_kkm_uh6= 0;
$cacah_di_bawah_kkm_uh7= 0;
$cacah_di_bawah_kkm_uh8= 0;
$cacah_di_bawah_kkm_uh9= 0;
$cacah_di_bawah_kkm_uh10= 0;

$cacah_di_bawah_kkm_mid= 0;
$cacah_di_bawah_kkm_uas= 0;
$cacah_di_bawah_kkm_na= 0;
$cacah_di_bawah_kkm_nr= 0;

$tertinggi_nilai_uh1= 0;
$tertinggi_nilai_uh2= 0;
$tertinggi_nilai_uh3= 0;
$tertinggi_nilai_uh4= 0;
$tertinggi_nilai_uh5= 0;
$tertinggi_nilai_uh6= 0;
$tertinggi_nilai_uh7= 0;
$tertinggi_nilai_uh8= 0;
$tertinggi_nilai_uh9= 0;
$tertinggi_nilai_uh10= 0;
$tertinggi_nilai_ruh= 0;
$tertinggi_nilai_tu1= 0;
$tertinggi_nilai_tu2= 0;
$tertinggi_nilai_tu3= 0;
$tertinggi_nilai_tu4= 0;
$tertinggi_nilai_tu5= 0;
$tertinggi_nilai_tu6= 0;
$tertinggi_nilai_tu7= 0;
$tertinggi_nilai_tu8= 0;
$tertinggi_nilai_tu9= 0;
$tertinggi_nilai_tu10= 0;
$tertinggi_nilai_rtu= 0;
$tertinggi_nilai_mid= 0;
$tertinggi_nilai_uas= 0;
$tertinggi_nilai_na= 0;
$tertinggi_nilai_nr= 0;
$terendah_nilai_uh1= 101;
$terendah_nilai_uh2= 101;
$terendah_nilai_uh3= 101;
$terendah_nilai_uh4= 101;
$terendah_nilai_uh5= 101;
$terendah_nilai_uh6= 101;
$terendah_nilai_uh7= 101;
$terendah_nilai_uh8= 101;
$terendah_nilai_uh9= 101;
$terendah_nilai_uh10= 101;
$terendah_nilai_ruh= 101;
$terendah_nilai_tu1= 101;
$terendah_nilai_tu2= 101;
$terendah_nilai_tu3= 101;
$terendah_nilai_tu4= 101;
$terendah_nilai_tu5= 101;
$terendah_nilai_tu6= 101;
$terendah_nilai_tu7= 101;
$terendah_nilai_tu8= 101;
$terendah_nilai_tu9= 101;
$terendah_nilai_tu10= 101;
$terendah_nilai_rtu= 101;
$terendah_nilai_mid= 101;
$terendah_nilai_uas= 101;
$terendah_nilai_na= 101;
$terendah_nilai_nr= 101;
$cacahsiswa = $query->num_rows();
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		$namasiswa = nis_ke_nama($nis);
	echo '<tr><td align="center">'.$nomor.'</td><td><a href="'.base_url().'guru/nilaipersiswa/'.$nomor.'/'.$id_mapel.'/proses">'.$namasiswa.'</a></td>';
	if ($kurikulum == '2013')
	{
		if($cacah_ulangan_harian>0)
		{
			if($t->nilai_uh1>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh1).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh1.'</td>';
				}

			}
		}
		if($cacah_ulangan_harian>1)
		{
			if($t->nilai_uh2>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh2).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh2.'</td>';
				}

			}
		}
		if($cacah_ulangan_harian>2)
		{
			if($t->nilai_uh3>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh3).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh3.'</td>';
				}

			}
		}
		if($cacah_ulangan_harian>3)
		{
			if($t->nilai_uh4>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh4).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh4.'</td>';
				}

			}
		}
		if($cacah_ulangan_harian>4)
		{
			if($t->nilai_uh5>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh5).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh5.'</td>';
				}
			}
		}
		if($cacah_ulangan_harian>5)
		{
			if($t->nilai_uh6>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh6).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh6.'</td>';
				}
			}
		}
		if($cacah_ulangan_harian>6)
		{
			if($t->nilai_uh7>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh7).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh7.'</td>';
				}

			}
		}
		if($cacah_ulangan_harian>7)
		{
			if($t->nilai_uh8>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh8).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh8.'</td>';
				}

			}
		}
		if($cacah_ulangan_harian>8)
		{
			if($t->nilai_uh9>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uh9).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uh9.'</td>';
				}

			}
		}
		if($cacah_ulangan_harian>9)
		{
			if($t->nilai_uh10>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.konversi_nilai($t->nilai_uh10).'</td>';
			}
		}

		if($cacah_ulangan_harian>0)
		{
			$ruh = $t->nilai_ruh;
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($ruh).'</td>';
				}
				else
				{
					echo '<td align="center">'.round($ruh,2).'</td>';
				}
		}
		if($cacah_kuis>0)
		{	
		if($t->nilai_ku1>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_ku1).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_ku1.'</td>';
				}

		}
		}
		if($cacah_kuis>1)
		{	
		if($t->nilai_ku2>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_ku2).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_ku2.'</td>';
				}

		}	
		}
		if($cacah_kuis>2)
		{	
		if($t->nilai_ku3>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_ku3).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_ku3.'</td>';
				}

		}
		}
		if($cacah_kuis>3)
		{	
		if($t->nilai_ku4>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_ku4).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_ku4.'</td>';
				}

		}	
		}
		if($cacah_kuis>0)
		{
			$rku = ($t->nilai_ku1 + $t->nilai_ku2 + $t->nilai_ku3 + $t->nilai_ku4)/$cacah_kuis;
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($rku).'</td>';
				}
				else
				{
					echo '<td align="center">'.$rku.'</td>';
				}

		}
		if($cacah_tugas>0)
		{	
			if($t->nilai_tu1>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu1).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu1.'</td>';
				}

			}
		}
		if($cacah_tugas>1)
		{	
		if($t->nilai_tu2>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu2).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu2.'</td>';
				}

		}
		}
		if($cacah_tugas>2)
		{	
			if($t->nilai_tu3>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu3).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu3.'</td>';
				}

			}
		}
		if($cacah_tugas>3)
		{	
			if($t->nilai_tu4>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu4).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu4.'</td>';
				}
			}
		}
		if($cacah_tugas>4)
		{	
			if($t->nilai_tu5>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu5).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu5.'</td>';
				}

			}
		}
		if($cacah_tugas>5)
		{	
			if($t->nilai_tu6>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu6).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu6.'</td>';
				}

			}
		}
		if($cacah_tugas>6)
		{	
			if($t->nilai_tu7>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu7).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu7.'</td>';
				}

			}
		}
		if($cacah_tugas>7)
		{	
			if($t->nilai_tu8>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu8).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu8.'</td>';
				}

			}
		}
		if($cacah_tugas>8)
		{	
			if($t->nilai_tu9>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu9).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu9.'</td>';
				}

			}
		}
		if($cacah_tugas>9)
		{	
			if($t->nilai_tu19>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_tu19).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_tu10.'</td>';
				}

			}
		}

		if($cacah_tugas>0)
		{
			$rtu = ($t->nilai_tu1 + $t->nilai_tu2 + $t->nilai_tu3 + $t->nilai_tu4 + $t->nilai_tu5 + $t->nilai_tu6 + $t->nilai_tu7 + $t->nilai_tu8 + $t->nilai_tu9 + $t->nilai_tu10) /$cacah_tugas ;
			if($this->config->item('skala_empat') == 'Y')
			{
				echo '<td align="center">'.konversi_nilai($rtu).'</td>';
			}
			else
			{
				echo '<td align="center">'.$rtu.'</td>';
			}
		}
		if($t->nilai_mid>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_mid).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_mid.'</td>';
				}

		}	
		if($t->nilai_uas>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_uas).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_uas.'</td>';
				}

		}	
		if($this->config->item('predikat_nilai') == '2015')
		{
			if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_na).'</td><td align="center">'.konversi_nilai($t->kog).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_na.'</td><td align="center">'.$t->kog.'</td>';
				}
			echo '<td align="center">'.predikat_nilai_2015($t->kog,$this->config->item('versi_predikat_nilai')).'</td>';
		}
		else
		{
				if($this->config->item('skala_empat') == 'Y')
				{
					echo '<td align="center">'.konversi_nilai($t->nilai_na).'</td><td align="center">'.konversi_nilai($t->kog).'</td>';
				}
				else
				{
					echo '<td align="center">'.$t->nilai_na.'</td><td align="center">'.$t->kog.'</td><td align="center">'.predikat_nilai($t->kog).'</td>';
				}

		}

	}
	else
	{
		if($cacah_ulangan_harian>0)
		{
			if($t->nilai_uh1>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh1.'</td>';
			}
		}
		if($cacah_ulangan_harian>1)
		{
			if($t->nilai_uh2>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh2.'</td>';
			}
		}
		if($cacah_ulangan_harian>2)
		{
			if($t->nilai_uh3>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh3.'</td>';
			}
		}
		if($cacah_ulangan_harian>3)
		{
			if($t->nilai_uh4>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh4.'</td>';
			}
		}
		if($cacah_ulangan_harian>4)
		{
			if($t->nilai_uh5>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh5.'</td>';
			}
		}
		if($cacah_ulangan_harian>5)
		{
			if($t->nilai_uh6>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh6.'</td>';
			}
		}
		if($cacah_ulangan_harian>6)
		{
			if($t->nilai_uh7>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh7.'</td>';
			}
		}
		if($cacah_ulangan_harian>7)
		{
			if($t->nilai_uh8>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh8.'</td>';
			}
		}
		if($cacah_ulangan_harian>8)
		{
			if($t->nilai_uh9>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh9.'</td>';
			}
		}
		if($cacah_ulangan_harian>9)
		{
			if($t->nilai_uh10>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh10.'</td>';
			}
		}

		if($cacah_ulangan_harian>0)
		{
			$ruh = $t->nilai_ruh;
			echo '<td align="center">'.round($ruh,2).'</td>';

		}
		if($cacah_kuis>0)
		{
		if($t->nilai_ku1>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
			echo '<td align="center">'.$t->nilai_ku1.'</td>';
		}
		}
		if($cacah_kuis>1)
		{
		if($t->nilai_ku2>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
			echo '<td align="center">'.$t->nilai_ku2.'</td>';
		}	
		}
		if($cacah_kuis>2)
		{
		if($t->nilai_ku3>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
			echo '<td align="center">'.$t->nilai_ku3.'</td>';
		}	
		}
		if($cacah_kuis>3)
		{
		if($t->nilai_ku4>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
			echo '<td align="center">'.$t->nilai_ku4.'</td>';
		}
		}
		if($cacah_kuis>0)
		{
			$rku = ($t->nilai_ku1 + $t->nilai_ku2 + $t->nilai_ku3 + $t->nilai_ku4)/$cacah_kuis;
			echo '<td align="center">'.round($rku,2).'</td>';
		}
		if($cacah_tugas>0)
		{
		if($t->nilai_tu1>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
			echo '<td align="center">'.$t->nilai_tu1.'</td>';
		}	
		}
		if($cacah_tugas>1)
		{
			if($t->nilai_tu2>100)
			{
			echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu2.'</td>';
			}	
		}
		if($cacah_tugas>2)
		{
			if($t->nilai_tu3>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu3.'</td>';
			}	
		}
		if($cacah_tugas>3)
		{
			if($t->nilai_tu4>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu4.'</td>';
			}
		}
		if($cacah_tugas>4)
		{
			if($t->nilai_tu5>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu5.'</td>';
			}
		}
		if($cacah_tugas>5)
		{
			if($t->nilai_tu6>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu6.'</td>';
			}
		}
		if($cacah_tugas>6)
		{
			if($t->nilai_tu7>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu7.'</td>';
			}
		}
		if($cacah_tugas>7)
		{
			if($t->nilai_tu8>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu8.'</td>';
			}
		}
		if($cacah_tugas>8)
		{
			if($t->nilai_tu9>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu9.'</td>';
			}
		}
		if($cacah_tugas>10)
		{
			if($t->nilai_tu4>100)
			{
				echo '<td align="center">lebih dari 100</td>';
			}
			else
			{
				echo '<td align="center">'.$t->nilai_tu10.'</td>';
			}
		}
		if($cacah_tugas>0)
		{
			$rtu = ($t->nilai_tu1 + $t->nilai_tu2 + $t->nilai_tu3 + $t->nilai_tu4 + $t->nilai_tu5 + $t->nilai_tu6 + $t->nilai_tu7 + $t->nilai_tu8 + $t->nilai_tu9 + $t->nilai_tu10) /$cacah_tugas;
			echo '<td align="center">'.round($rtu,2).'</td>';
		}
		if($t->nilai_mid>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
			echo '<td align="center">'.$t->nilai_mid.'</td>';
		}	
		if($t->nilai_uas>100)
		{
			echo '<td align="center">lebih dari 100</td>';
		}
		else
		{
			echo '<td align="center">'.$t->nilai_uas.'</td>';
		}
	echo '<td align="center">'.round($t->nilai_na,2).'</td><td align="center">'.$t->kog.'</td>';
	}
	echo '</tr>';
	if ($t->nilai_uh1 < $kkm_uh1)
		{
		$cacah_di_bawah_kkm_uh1++;
		}
	if ($t->nilai_uh2 < $kkm_uh2)
		{
		$cacah_di_bawah_kkm_uh2++;
		}
	if ($t->nilai_uh3 < $kkm_uh3)
		{
		$cacah_di_bawah_kkm_uh3++;
		}
	if ($t->nilai_uh4 < $kkm_uh4)
		{
		$cacah_di_bawah_kkm_uh4++;
		}
	if ($t->nilai_uh5 < $kkm_uh5)
		{
		$cacah_di_bawah_kkm_uh5++;
		}
	if ($t->nilai_uh6 < $kkm_uh6)
		{
		$cacah_di_bawah_kkm_uh6++;
		}
	if ($t->nilai_uh7 < $kkm_uh7)
		{
		$cacah_di_bawah_kkm_uh7++;
		}
	if ($t->nilai_uh8 < $kkm_uh8)
		{
		$cacah_di_bawah_kkm_uh8++;
		}
	if ($t->nilai_uh9 < $kkm_uh9)
		{
		$cacah_di_bawah_kkm_uh9++;
		}
	if ($t->nilai_uh10 < $kkm_uh10)
		{
		$cacah_di_bawah_kkm_uh10++;
		}

	if ($t->nilai_mid < $kkm_mid)
		{
		$cacah_di_bawah_kkm_mid++;
		}
	if ($t->nilai_uas < $kkm_uas)
		{
		$cacah_di_bawah_kkm_uas++;
		}
	if ($t->nilai_na < $kkm)
		{$cacah_di_bawah_kkm_na++;
		}
	if ($t->nilai_nr < $kkm)
		{
		$cacah_di_bawah_kkm_nr++;
		}

	if ($tertinggi_nilai_mid < $t->nilai_mid)
		{$tertinggi_nilai_mid = $t->nilai_mid;}
	if ($tertinggi_nilai_uh1 < $t->nilai_uh1)
		{$tertinggi_nilai_uh1 = $t->nilai_uh1;}
	if ($tertinggi_nilai_uh2 < $t->nilai_uh2)
		{$tertinggi_nilai_uh2 = $t->nilai_uh2;}
	if ($tertinggi_nilai_uh3 < $t->nilai_uh3)
		{$tertinggi_nilai_uh3 = $t->nilai_uh3;}
	if ($tertinggi_nilai_uh4 < $t->nilai_uh4)
		{$tertinggi_nilai_uh4 = $t->nilai_uh4;}
	if ($tertinggi_nilai_ruh < $t->nilai_ruh)
		{$tertinggi_nilai_ruh = $t->nilai_ruh;}
	if ($tertinggi_nilai_tu1 < $t->nilai_tu1)
		{$tertinggi_nilai_tu1 = $t->nilai_tu1;}
	if ($tertinggi_nilai_tu2 < $t->nilai_tu2)
		{$tertinggi_nilai_tu2 = $t->nilai_tu2;}
	if ($tertinggi_nilai_tu3 < $t->nilai_tu3)
		{$tertinggi_nilai_tu3 = $t->nilai_tu3;}
	if ($tertinggi_nilai_tu4 < $t->nilai_tu4)
		{$tertinggi_nilai_tu4 = $t->nilai_tu4;}
	if ($tertinggi_nilai_rtu < $t->nilai_rtu)
		{$tertinggi_nilai_rtu = $t->nilai_rtu;}
	if ($tertinggi_nilai_uas < $t->nilai_uas)
		{$tertinggi_nilai_uas = $t->nilai_uas;}
	if ($tertinggi_nilai_na < $t->nilai_na)
		{$tertinggi_nilai_na = $t->nilai_na;}
	if ($tertinggi_nilai_nr < $t->nilai_nr)
		{$tertinggi_nilai_nr = $t->nilai_nr;}
	if ($terendah_nilai_mid > $t->nilai_mid)
		{$terendah_nilai_mid = $t->nilai_mid;}
	if ($terendah_nilai_uh1 > $t->nilai_uh1)
		{$terendah_nilai_uh1 = $t->nilai_uh1;}
	if ($terendah_nilai_uh2 > $t->nilai_uh2)
		{$terendah_nilai_uh2 = $t->nilai_uh2;}
	if ($terendah_nilai_uh3 > $t->nilai_uh3)
		{$terendah_nilai_uh3 = $t->nilai_uh3;}
	if ($terendah_nilai_uh4 > $t->nilai_uh4)
		{$terendah_nilai_uh4 = $t->nilai_uh4;}
	if ($terendah_nilai_ruh > $t->nilai_ruh)
		{$terendah_nilai_ruh = $t->nilai_ruh;}
	if ($terendah_nilai_tu1 > $t->nilai_tu1)
		{$terendah_nilai_tu1 = $t->nilai_tu1;}
	if ($terendah_nilai_tu2 > $t->nilai_tu2)
		{$terendah_nilai_tu2 = $t->nilai_tu2;}
	if ($terendah_nilai_tu3 > $t->nilai_tu3)
		{$terendah_nilai_tu3 = $t->nilai_tu3;}
	if ($terendah_nilai_tu4 > $t->nilai_tu4)
		{$terendah_nilai_tu4 = $t->nilai_tu4;}
	if ($terendah_nilai_rtu > $t->nilai_rtu)
		{$terendah_nilai_rtu = $t->nilai_rtu;}
	if ($terendah_nilai_uas > $t->nilai_uas)
		{$terendah_nilai_uas = $t->nilai_uas;}
	if ($terendah_nilai_na > $t->nilai_na)
		{$terendah_nilai_na = $t->nilai_na;}
	if ($terendah_nilai_nr > $t->nilai_nr)
		{$terendah_nilai_nr = $t->nilai_nr;}

	$rata_nilai_uh1= $rata_nilai_uh1 + $t->nilai_uh1 ;
	$rata_nilai_uh2= $rata_nilai_uh2 + $t->nilai_uh2 ;
	$rata_nilai_uh3= $rata_nilai_uh3 + $t->nilai_uh3 ;
	$rata_nilai_uh4= $rata_nilai_uh4 + $t->nilai_uh4 ;
	$rata_nilai_ruh= $rata_nilai_ruh + $t->nilai_ruh ;
	$rata_nilai_tu1= $rata_nilai_tu1 + $t->nilai_tu1 ;
	$rata_nilai_tu2= $rata_nilai_tu2 + $t->nilai_tu2 ;
	$rata_nilai_tu3= $rata_nilai_tu3 + $t->nilai_tu3 ;
	$rata_nilai_tu4= $rata_nilai_tu4 + $t->nilai_tu4 ;
	$rata_nilai_rtu= $rata_nilai_rtu + $t->nilai_rtu ;
	$rata_nilai_mid= $rata_nilai_mid + $t->nilai_mid ;
	$rata_nilai_uas= $rata_nilai_uas + $t->nilai_uas ;
	$rata_nilai_na= $rata_nilai_na + $t->nilai_na ;
	$rata_nilai_nr= $rata_nilai_nr + $t->nilai_nr ;
	$nomor++;	
	}
$jmlsiswa = $nomor-1;
$rata_nilai_uh1= $rata_nilai_uh1 / $jmlsiswa;
$rata_nilai_uh2= $rata_nilai_uh2 / $jmlsiswa;
$rata_nilai_uh3= $rata_nilai_uh3 / $jmlsiswa;
$rata_nilai_uh4= $rata_nilai_uh4 / $jmlsiswa;
$rata_nilai_uh5= $rata_nilai_uh5 / $jmlsiswa;
$rata_nilai_uh6= $rata_nilai_uh6 / $jmlsiswa;
$rata_nilai_uh7= $rata_nilai_uh7 / $jmlsiswa;
$rata_nilai_uh8= $rata_nilai_uh8 / $jmlsiswa;
$rata_nilai_uh9= $rata_nilai_uh9 / $jmlsiswa;
$rata_nilai_uh10= $rata_nilai_uh10 / $jmlsiswa;
$rata_nilai_ruh= $rata_nilai_ruh / $jmlsiswa;
$rata_nilai_tu1= $rata_nilai_tu1 / $jmlsiswa;
$rata_nilai_tu2= $rata_nilai_tu2 / $jmlsiswa;
$rata_nilai_tu3= $rata_nilai_tu3 / $jmlsiswa;
$rata_nilai_tu4= $rata_nilai_tu4 / $jmlsiswa;
$rata_nilai_tu5= $rata_nilai_tu5 / $jmlsiswa;
$rata_nilai_tu6= $rata_nilai_tu6 / $jmlsiswa;
$rata_nilai_tu7= $rata_nilai_tu7 / $jmlsiswa;
$rata_nilai_tu8= $rata_nilai_tu8 / $jmlsiswa;
$rata_nilai_tu9= $rata_nilai_tu9 / $jmlsiswa;
$rata_nilai_tu10= $rata_nilai_tu10 / $jmlsiswa;
$rata_nilai_rtu= $rata_nilai_rtu / $jmlsiswa;
$rata_nilai_mid= $rata_nilai_mid / $jmlsiswa;
$rata_nilai_uas= $rata_nilai_uas / $jmlsiswa;
$rata_nilai_na= $rata_nilai_na / $jmlsiswa;
$rata_nilai_nr= $rata_nilai_nr / $jmlsiswa;
//kkm
if ($kurikulum == '2013')
	{
echo '<tr><td align="center"></td><td>KKM</td>';
		if($cacah_ulangan_harian>0)
		{
		echo '<td align="center">'.konversi_nilai($kkm_uh1).'</td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center">'.konversi_nilai($kkm_uh2).'</td>';
		}
		if($cacah_ulangan_harian>2)
		{
		echo '<td align="center">'.konversi_nilai($kkm_uh3).'</td>';
		}
		if($cacah_ulangan_harian>3)
		{
		echo '<td align="center">'.konversi_nilai($kkm_uh4).'</td>';
		}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td></td>';
		}
		if ($cacah_kuis>0)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if ($cacah_kuis>2)
		{echo '<td></td>';}
		if ($cacah_kuis>3)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if($cacah_tugas>0)
		{
			echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>1)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>2)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>3)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>4)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>5)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>6)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>7)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>8)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>9)
		{
		echo '<td align="center">&nbsp;</td>';
		}
		if($cacah_tugas>1)
		{
		echo '<td></td>';
		}

		echo '<td align="center">'.konversi_nilai($kkm_mid).'</td><td align="center">'.konversi_nilai($kkm_uas).'</td><td align="center">&nbsp;</td><td align="center">'.konversi_nilai($kkm).'</td><td colspan="3" align="center"></td></tr>';
	}
	else
	{
	echo '<tr><td align="center"></td><td>KKM</td>';
	if($cacah_ulangan_harian>0)
		{
		echo '<td align="center">'.$kkm_uh1.'</td>';
		}
	if($cacah_ulangan_harian>1)
		{
		echo '<td align="center">'.$kkm_uh2.'</td>';
		}
	if($cacah_ulangan_harian>2)
		{
		echo '<td align="center">'.$kkm_uh3.'</td>';
		}
	if($cacah_ulangan_harian>3)
		{
		echo '<td align="center">'.$kkm_uh4.'</td>';
		}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
		echo '<td align="center">'.$kkm_mid.'</td><td align="center">'.$kkm_uas.'</td><td align="center" colspan="2"></td></tr>';
	}
// rata - rata
if ($kurikulum == '2013')
	{
echo '<tr><td align="center"></td><td>Rata - rata</td>';
	if($cacah_ulangan_harian>0)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_uh1), 2).'</td>';
		}
	if($cacah_ulangan_harian>1)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_uh2), 2).'</td>';
		}
	if($cacah_ulangan_harian>2)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_uh3), 2).'</td>';
		}
	if($cacah_ulangan_harian>3)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_uh4), 2).'</td>';
		}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
	if($cacah_ulangan_harian>1)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_kuis>0)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_kuis>1)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_kuis>2)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_kuis>3)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_kuis>1)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_tugas>0)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu1), 2).'</td>';
		}
	if($cacah_tugas>1)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu2), 2).'</td>';
		}
	if($cacah_tugas>2)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu3), 2).'</td>';
		}
	if($cacah_tugas>3)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu4), 2).'</td>';
		}
	if($cacah_tugas>4)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu5), 2).'</td>';
		}
	if($cacah_tugas>5)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu6), 2).'</td>';
		}
	if($cacah_tugas>6)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu7), 2).'</td>';
		}
	if($cacah_tugas>7)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu8), 2).'</td>';
		}
	if($cacah_tugas>8)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu9), 2).'</td>';
		}
	if($cacah_tugas>9)
		{
		echo '<td align="center">'.round(konversi_nilai($rata_nilai_tu10), 2).'</td>';
		}
	if($cacah_tugas>0)
		{
		echo '<td align="center"></td>';
		}

		echo '<td align="center">'.round(konversi_nilai($rata_nilai_mid), 2).'</td><td align="center">'.round(konversi_nilai($rata_nilai_uas), 2).'</td><td align="center">'.round(konversi_nilai($rata_nilai_na), 2).'</td><td colspan="3"></td></tr>';
	}
	else
	{
echo '<tr><td align="center"></td><td>Rata - rata</td>';
		if($cacah_ulangan_harian>0)
		{
		echo '<td align="center">'.round($rata_nilai_uh1, 2).'</td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center">'.round($rata_nilai_uh2, 2).'</td>';
		}
		if($cacah_ulangan_harian>2)
		{
		echo '<td align="center">'.round($rata_nilai_uh3, 2).'</td>';}
		if($cacah_ulangan_harian>3)
		{
		echo '<td align="center">'.round($rata_nilai_uh4, 2).'</td>';}
		if($cacah_ulangan_harian>4)
		{
		echo '<td align="center">'.round($rata_nilai_uh5, 2).'</td>';}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center">'.round($rata_nilai_uh6, 2).'</td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center">'.round($rata_nilai_uh7, 2).'</td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center">'.round($rata_nilai_uh8, 2).'</td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center">'.round($rata_nilai_uh9, 2).'</td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center">'.round($rata_nilai_uh10, 2).'</td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center"></td>';
		}
		if ($cacah_kuis>0)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if ($cacah_kuis>2)
		{echo '<td></td>';}
		if ($cacah_kuis>3)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		if($cacah_tugas>0)
		{
		echo '<td align="center">'.round($rata_nilai_tu1, 2).'</td>';}
		if($cacah_tugas>1)
		{
		echo '<td align="center">'.round($rata_nilai_tu2, 2).'</td>';}
		if($cacah_tugas>2)
		{
		echo '<td align="center">'.round($rata_nilai_tu3, 2).'</td>';}
		if($cacah_tugas>3)
		{
		echo '<td align="center">'.round($rata_nilai_tu4, 2).'</td>';}
		if($cacah_tugas>4)
		{
		echo '<td align="center">'.round($rata_nilai_tu5, 2).'</td>';}
		if($cacah_tugas>5)
		{
		echo '<td align="center">'.round($rata_nilai_tu6, 2).'</td>';}
		if($cacah_tugas>6)
		{
		echo '<td align="center">'.round($rata_nilai_tu7, 2).'</td>';}
		if($cacah_tugas>7)
		{
		echo '<td align="center">'.round($rata_nilai_tu8, 2).'</td>';}
		if($cacah_tugas>8)
		{
		echo '<td align="center">'.round($rata_nilai_tu9, 2).'</td>';}
		if($cacah_tugas>9)
		{
		echo '<td align="center">'.round($rata_nilai_tu10, 2).'</td>';}

		if($cacah_tugas>0)
		{
		echo '<td align="center">'.round($rata_nilai_rtu, 2).'</td>';
		}
		echo '<td align="center">'.round($rata_nilai_mid, 2).'</td><td align="center">'.round($rata_nilai_uas, 2).'</td><td align="center">'.round($rata_nilai_na, 2).'</td><td colspan="2"></td></tr>';

	}
//simpangan baku
	$xi_uh1=0;
	$xi_uh2=0;
	$xi_uh3=0;
	$xi_uh4=0;
	$xi_uh5=0;
	$xi_uh6=0;
	$xi_uh7=0;
	$xi_uh8=0;
	$xi_uh9=0;
	$xi_uh10=0;
	$xi_ruh=0;
	$xi_tu1=0;
	$xi_tu2=0;
	$xi_tu3=0;
	$xi_tu4=0;
	$xi_tu5=0;
	$xi_tu6=0;
	$xi_tu7=0;
	$xi_tu8=0;
	$xi_tu9=0;
	$xi_tu10=0;
	$xi_rtu=0;
	$xi_mid=0;
	$xi_uas=0;
	$xi_na= 0;
	$xi_nr= 0;
	foreach($query->result() as $t)
	{
	$x_uh1= $rata_nilai_uh1 - $t->nilai_uh1 ;
	$x_uh2= $rata_nilai_uh2 - $t->nilai_uh2 ;
	$x_uh3= $rata_nilai_uh3 - $t->nilai_uh3 ;
	$x_uh4= $rata_nilai_uh4 - $t->nilai_uh4 ;
	$x_uh5= $rata_nilai_uh5 - $t->nilai_uh5 ;
	$x_uh6= $rata_nilai_uh6 - $t->nilai_uh6 ;
	$x_uh7= $rata_nilai_uh7 - $t->nilai_uh7 ;
	$x_uh8= $rata_nilai_uh8 - $t->nilai_uh8 ;
	$x_uh9= $rata_nilai_uh9 - $t->nilai_uh9 ;
	$x_uh10= $rata_nilai_uh10 - $t->nilai_uh10 ;
	$x_ruh= $rata_nilai_ruh - $t->nilai_ruh ;
	$x_tu1= $rata_nilai_tu1 - $t->nilai_tu1 ;
	$x_tu2= $rata_nilai_tu2 - $t->nilai_tu2 ;
	$x_tu3= $rata_nilai_tu3 - $t->nilai_tu3 ;
	$x_tu4= $rata_nilai_tu4 - $t->nilai_tu4 ;
	$x_tu5= $rata_nilai_tu5 - $t->nilai_tu5 ;
	$x_tu6= $rata_nilai_tu6 - $t->nilai_tu6 ;
	$x_tu7= $rata_nilai_tu7 - $t->nilai_tu7 ;
	$x_tu8= $rata_nilai_tu8 - $t->nilai_tu8 ;
	$x_tu9= $rata_nilai_tu9 - $t->nilai_tu9 ;
	$x_tu10= $rata_nilai_tu10 - $t->nilai_tu10 ;
	$x_rtu= $rata_nilai_rtu - $t->nilai_rtu ;
	$x_mid= $rata_nilai_mid - $t->nilai_mid ;
	$x_uas= $rata_nilai_uas - $t->nilai_uas ;
	$x_na= $rata_nilai_na - $t->nilai_na ;
	$x_nr= $rata_nilai_nr - $t->nilai_nr ;
	$xx_uh1= $x_uh1 * $x_uh1 ;
	$xx_uh2= $x_uh2 * $x_uh2 ;
	$xx_uh3= $x_uh3 * $x_uh3 ;
	$xx_uh4= $x_uh4 * $x_uh4 ;
	$xx_uh5= $x_uh5 * $x_uh5 ;
	$xx_uh6= $x_uh6 * $x_uh6 ;
	$xx_uh7= $x_uh7 * $x_uh7 ;
	$xx_uh8= $x_uh8 * $x_uh8 ;
	$xx_uh9= $x_uh9 * $x_uh9 ;
	$xx_uh10= $x_uh10 * $x_uh10 ;
	$xx_ruh= $x_ruh * $x_ruh ;
	$xx_tu1= $x_tu1 * $x_tu1 ;
	$xx_tu2= $x_tu2 * $x_tu2 ;
	$xx_tu3= $x_tu3 * $x_tu3 ;
	$xx_tu4= $x_tu4 * $x_tu4 ;
	$xx_tu5= $x_tu5 * $x_tu5 ;
	$xx_tu6= $x_tu6 * $x_tu6 ;
	$xx_tu7= $x_tu7 * $x_tu7 ;
	$xx_tu8= $x_tu8 * $x_tu8 ;
	$xx_tu9= $x_tu9 * $x_tu9 ;
	$xx_tu10= $x_tu10 * $x_tu10;
	$xx_rtu= $x_rtu * $x_rtu ;
	$xx_mid= $x_mid * $x_mid ;
	$xx_uas= $x_uas * $x_uas ;
	$xx_na= $x_na * $x_na ;
	$xx_nr= $x_nr * $x_nr ;

	$xi_uh1= $xi_uh1 + $xx_uh1 ;
	$xi_uh2= $xi_uh2 + $xx_uh2 ;
	$xi_uh3= $xi_uh3 + $xx_uh3 ;
	$xi_uh4= $xi_uh4 + $xx_uh4 ;
	$xi_uh5= $xi_uh5 + $xx_uh5 ;
	$xi_uh6= $xi_uh6 + $xx_uh6 ;
	$xi_uh7= $xi_uh7 + $xx_uh7 ;
	$xi_uh8= $xi_uh8 + $xx_uh8 ;
	$xi_uh9= $xi_uh9 + $xx_uh9 ;
	$xi_uh10= $xi_uh10 + $xx_uh10;
	$xi_ruh= $xi_ruh + $xx_ruh ;
	$xi_tu1= $xi_tu1 + $xx_tu1 ;
	$xi_tu2= $xi_tu2 + $xx_tu2 ;
	$xi_tu3= $xi_tu3 + $xx_tu3 ;
	$xi_tu4= $xi_tu4 + $xx_tu4 ;
	$xi_tu5= $xi_tu5 + $xx_tu5 ;
	$xi_tu6= $xi_tu6 + $xx_tu6 ;
	$xi_tu7= $xi_tu7 + $xx_tu7 ;
	$xi_tu8= $xi_tu8 + $xx_tu8 ;
	$xi_tu9= $xi_tu9 + $xx_tu9 ;
	$xi_tu10= $xi_tu10 + $xx_tu10;
	$xi_rtu= $xi_rtu + $xx_rtu ;
	$xi_mid= $xi_mid + $xx_mid ;
	$xi_uas= $xi_uas + $xx_uas ;
	$xi_na= $xi_na + $xx_na ;
	$xi_nr= $xi_nr + $xx_nr ;
	$nomor++;	
	}
	$xi_uh1= $xi_uh1 / $jmlsiswa;
	$xi_uh2= $xi_uh2 / $jmlsiswa;
	$xi_uh3= $xi_uh3 / $jmlsiswa;
	$xi_uh4= $xi_uh4 / $jmlsiswa;
	$xi_uh5= $xi_uh5 / $jmlsiswa;
	$xi_uh6= $xi_uh6 / $jmlsiswa;
	$xi_uh7= $xi_uh7 / $jmlsiswa;
	$xi_uh8= $xi_uh8 / $jmlsiswa;
	$xi_uh9= $xi_uh9 / $jmlsiswa;
	$xi_uh10= $xi_uh10 / $jmlsiswa;
	$xi_ruh= $xi_ruh / $jmlsiswa;
	$xi_tu1= $xi_tu1 / $jmlsiswa;
	$xi_tu2= $xi_tu2 / $jmlsiswa;
	$xi_tu3= $xi_tu3 / $jmlsiswa;
	$xi_tu4= $xi_tu4 / $jmlsiswa;
	$xi_tu5= $xi_tu5 / $jmlsiswa;
	$xi_tu6= $xi_tu6 / $jmlsiswa;
	$xi_tu7= $xi_tu7 / $jmlsiswa;
	$xi_tu8= $xi_tu8 / $jmlsiswa;
	$xi_tu9= $xi_tu9 / $jmlsiswa;
	$xi_tu10= $xi_tu10 / $jmlsiswa;
	$xi_rtu= $xi_rtu / $jmlsiswa;
	$xi_mid= $xi_mid / $jmlsiswa;
	$xi_uas= $xi_uas / $jmlsiswa;
	$xi_na= $xi_na / $jmlsiswa;
	$xi_nr= $xi_nr / $jmlsiswa;

	$xi_uh1= sqrt($xi_uh1);
	$xi_uh2= sqrt($xi_uh2);
	$xi_uh3= sqrt($xi_uh3);
	$xi_uh4= sqrt($xi_uh4);
	$xi_uh5= sqrt($xi_uh5);
	$xi_uh6= sqrt($xi_uh6);
	$xi_uh7= sqrt($xi_uh7);
	$xi_uh8= sqrt($xi_uh8);
	$xi_uh9= sqrt($xi_uh9);
	$xi_uh10= sqrt($xi_uh10);
	$xi_ruh= sqrt($xi_ruh);
	$xi_tu1= sqrt($xi_tu1);
	$xi_tu2= sqrt($xi_tu2);
	$xi_tu3= sqrt($xi_tu3);
	$xi_tu4= sqrt($xi_tu4);
	$xi_tu5= sqrt($xi_tu5);
	$xi_tu6= sqrt($xi_tu6);
	$xi_tu7= sqrt($xi_tu7);
	$xi_tu8= sqrt($xi_tu8);
	$xi_tu9= sqrt($xi_tu9);
	$xi_tu10= sqrt($xi_tu10);
	$xi_rtu= sqrt($xi_rtu);
	$xi_mid= sqrt($xi_mid);
	$xi_uas= sqrt($xi_uas);
	$xi_na= sqrt($xi_na);
	$xi_nr= sqrt($xi_nr);
if ($kurikulum == '2013')
	{
	echo '<tr><td align="center"></td><td>Simpangan Baku</td>';
		if($cacah_ulangan_harian>0)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh1), 2).'</td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh2), 2).'</td>';
		}
		if($cacah_ulangan_harian>2)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh3), 2).'</td>';
		}
		if($cacah_ulangan_harian>3)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh4), 2).'</td>';
		}
		if($cacah_ulangan_harian>4)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh5), 2).'</td>';
		}
		if($cacah_ulangan_harian>5)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh6), 2).'</td>';
		}
		if($cacah_ulangan_harian>6)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh7), 2).'</td>';
		}
		if($cacah_ulangan_harian>7)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh8), 2).'</td>';
		}
		if($cacah_ulangan_harian>8)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh9), 2).'</td>';
		}
		if($cacah_ulangan_harian>9)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_uh10), 2).'</td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center"></td>';
		}
		if($cacah_kuis>0)
		{
		echo '<td align="center"></td>';
		}
		if($cacah_kuis>1)
		{
		echo '<td align="center"></td>';
		}
		if($cacah_kuis>2)
		{
		echo '<td align="center"></td>';
		}
		if($cacah_kuis>3)
		{
		echo '<td align="center"></td>';
		}
		if($cacah_kuis>1)
		{
		echo '<td align="center"></td>';
		}
		if($cacah_tugas>0)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu1), 2).'</td>';
		}
		if($cacah_tugas>1)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu2), 2).'</td>';
		}
		if($cacah_tugas>2)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu3), 2).'</td>';
		}
		if($cacah_tugas>3)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu4), 2).'</td>';
		}
		if($cacah_tugas>4)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu5), 2).'</td>';
		}
		if($cacah_tugas>5)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu6), 2).'</td>';
		}
		if($cacah_tugas>6)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu7), 2).'</td>';
		}
		if($cacah_tugas>7)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu8), 2).'</td>';
		}
		if($cacah_tugas>8)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu9), 2).'</td>';
		}
		if($cacah_tugas>9)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_tu10), 2).'</td>';
		}

		if($cacah_tugas>1)
		{
		echo '<td align="center">'.round(konversi_nilai($xi_rtu), 2).'</td>';
		}
		echo '<td align="center">'.round(konversi_nilai($xi_mid), 2).'</td><td align="center">'.round($xi_uas, 2).'</td><td align="center">'.round(konversi_nilai($xi_na), 2).'</td><td colspan="3"></td></tr>';
	}
	else
	{
echo '<tr><td align="center"></td><td>Simpangan Baku</td>';
		if($cacah_ulangan_harian>0)
		{
		echo '<td align="center">'.round($xi_uh1, 2).'</td>';}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center">'.round($xi_uh2, 2).'</td>';}
		if($cacah_ulangan_harian>2)
		{
		echo '<td align="center">'.round($xi_uh3, 2).'</td>';}
		if($cacah_ulangan_harian>3)
		{
		echo '<td align="center">'.round($xi_uh4, 2).'</td>';}
		if($cacah_ulangan_harian>4)
		{
		echo '<td align="center">'.round($xi_uh5, 2).'</td>';
		}
		if($cacah_ulangan_harian>5)
		{
		echo '<td align="center">'.round($xi_uh6, 2).'</td>';
		}
		if($cacah_ulangan_harian>6)
		{
		echo '<td align="center">'.round($xi_uh7, 2).'</td>';
		}
		if($cacah_ulangan_harian>7)
		{
		echo '<td align="center">'.round($xi_uh8, 2).'</td>';
		}
		if($cacah_ulangan_harian>8)
		{
		echo '<td align="center">'.round($xi_uh9, 2).'</td>';
		}
		if($cacah_ulangan_harian>9)
		{
		echo '<td align="center">'.round($xi_uh10, 2).'</td>';
		}
		if ($cacah_ulangan_harian>1)
		{echo '<td></td>';}
		if ($cacah_kuis>0)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if ($cacah_kuis>2)
		{echo '<td></td>';}
		if ($cacah_kuis>3)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if ($cacah_tugas>0)
		{echo '<td align="center">'.round($xi_tu1, 2).'</td>';}
		if ($cacah_tugas>1)
		{echo '<td align="center">'.round($xi_tu2, 2).'</td>';}
		if ($cacah_tugas>2)
		{echo '<td align="center">'.round($xi_tu3, 2).'</td>';}
		if ($cacah_tugas>3)
		{echo '<td align="center">'.round($xi_tu4, 2).'</td>';}
		if ($cacah_tugas>4)
		{echo '<td align="center">'.round($xi_tu5, 2).'</td>';}
		if ($cacah_tugas>5)
		{echo '<td align="center">'.round($xi_tu6, 2).'</td>';}
		if ($cacah_tugas>6)
		{echo '<td align="center">'.round($xi_tu7, 2).'</td>';}
		if ($cacah_tugas>7)
		{echo '<td align="center">'.round($xi_tu8, 2).'</td>';}
		if ($cacah_tugas>8)
		{echo '<td align="center">'.round($xi_tu9, 2).'</td>';}
		if ($cacah_tugas>9)
		{echo '<td align="center">'.round($xi_tu10, 2).'</td>';}
		if ($cacah_tugas>0)
		{echo '<td align="center">'.round($xi_rtu, 2).'</td>';}
		echo '<td align="center">'.round($xi_mid, 2).'</td><td align="center">'.round($xi_uas, 2).'</td><td align="center">'.round($xi_na, 2).'</td><td></td></tr>';
	}
if ($kurikulum == '2013')
	{
	echo '<tr><td align="center"></td><td>Nilai Tertinggi</td>';
	if($cacah_ulangan_harian>0)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh1).'</td>';
		}
	if($cacah_ulangan_harian>1)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh2).'</td>';
		}
	if($cacah_ulangan_harian>2)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh3).'</td>';
		}
	if($cacah_ulangan_harian>3)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh4).'</td>';
		}
		if($cacah_ulangan_harian>4)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh5).'</td>';
		}
		if($cacah_ulangan_harian>5)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh6).'</td>';
		}
		if($cacah_ulangan_harian>6)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh7).'</td>';
		}
		if($cacah_ulangan_harian>7)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh8).'</td>';
		}
		if($cacah_ulangan_harian>8)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh9).'</td>';
		}
		if($cacah_ulangan_harian>9)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_uh10).'</td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center"></td>';
		}

	if($cacah_kuis>0)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_kuis>1)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_kuis>2)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_kuis>3)
		{
		echo '<td align="center"></td>';
		}
		if($cacah_kuis>1)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_tugas>0)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu1).'</td>';
		}
	if($cacah_tugas>1)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu2).'</td>';
		}
	if($cacah_tugas>2)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu3).'</td>';
		}
	if($cacah_tugas>3)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu4).'</td>';
		}
	if($cacah_tugas>4)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu5).'</td>';
		}
	if($cacah_tugas>5)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu6).'</td>';
		}
	if($cacah_tugas>6)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu7).'</td>';
		}
	if($cacah_tugas>7)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu8).'</td>';
		}
	if($cacah_tugas>8)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu9).'</td>';
		}
	if($cacah_tugas>9)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_tu10).'</td>';
		}
	if($cacah_tugas>0)
		{
		echo '<td align="center">'.konversi_nilai($tertinggi_nilai_rtu).'</td>';
		}
	echo '<td align="center">'.konversi_nilai($tertinggi_nilai_mid).'</td><td align="center">'.konversi_nilai($tertinggi_nilai_uas).'</td><td align="center">'.konversi_nilai($tertinggi_nilai_na).'</td><td colspan="3"></td></tr>';
	}
	else
	{
echo '<tr><td align="center"></td><td>Nilai Tertinggi</td>';
		if ($cacah_ulangan_harian>0)
		{echo '<td align="center">'.$tertinggi_nilai_uh1.'</td>';}
		if ($cacah_ulangan_harian>1)
		{echo '<td align="center">'.$tertinggi_nilai_uh2.'</td>';}
		if ($cacah_ulangan_harian>2)
		{echo '<td align="center">'.$tertinggi_nilai_uh3.'</td>';}
		if ($cacah_ulangan_harian>3)
		{echo '<td align="center">'.$tertinggi_nilai_uh4.'</td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center">'.$tertinggi_nilai_uh5.'</td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center">'.$tertinggi_nilai_uh6.'</td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center">'.$tertinggi_nilai_uh7.'</td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center">'.$tertinggi_nilai_uh8.'</td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center">'.$tertinggi_nilai_uh9.'</td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center">'.$tertinggi_nilai_uh10.'</td>';
		}
		if ($cacah_ulangan_harian>1)
		{echo '<td align="center"></td>';}
		if ($cacah_kuis>0)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if ($cacah_kuis>2)
		{echo '<td></td>';}
		if ($cacah_kuis>3)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if ($cacah_tugas>0)
		{echo '<td align="center">'.$tertinggi_nilai_tu1.'</td>';}
		if ($cacah_tugas>1)
		{echo '<td align="center">'.$tertinggi_nilai_tu2.'</td>';}
		if ($cacah_tugas>2)
		{echo '<td align="center">'.$tertinggi_nilai_tu3.'</td>';}
		if ($cacah_tugas>3)
		{echo '<td align="center">'.$tertinggi_nilai_tu4.'</td>';}
		if ($cacah_tugas>4)
		{echo '<td align="center">'.$tertinggi_nilai_tu5.'</td>';}
		if ($cacah_tugas>5)
		{echo '<td align="center">'.$tertinggi_nilai_tu6.'</td>';}
		if ($cacah_tugas>6)
		{echo '<td align="center">'.$tertinggi_nilai_tu7.'</td>';}
		if ($cacah_tugas>7)
		{echo '<td align="center">'.$tertinggi_nilai_tu8.'</td>';}
		if ($cacah_tugas>8)
		{echo '<td align="center">'.$tertinggi_nilai_tu9.'</td>';}
		if ($cacah_tugas>9)
		{echo '<td align="center">'.$tertinggi_nilai_tu10.'</td>';}
		if ($cacah_tugas>0)
		{echo '<td align="center">'.$tertinggi_nilai_rtu.'</td>';}
		echo '<td align="center">'.$tertinggi_nilai_mid.'</td><td align="center">'.$tertinggi_nilai_uas.'</td><td align="center">'.$tertinggi_nilai_na.'</td><td></td></tr>';
	}

if ($kurikulum == '2013')
	{
echo '<tr><td align="center"></td><td>Nilai terendah</td>';
	if($cacah_ulangan_harian>0)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_uh1).'</td>';
	}
	if($cacah_ulangan_harian>1)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_uh2).'</td>';
	}
	if($cacah_ulangan_harian>2)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_uh3).'</td>';
	}
	if($cacah_ulangan_harian>3)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_uh4).'</td>';
	}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center">'.konversi_nilai($terendah_nilai_uh5).'</td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center">'.konversi_nilai($terendah_nilai_uh6).'</td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center">'.konversi_nilai($terendah_nilai_uh7).'</td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center">'.konversi_nilai($terendah_nilai_uh8).'</td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center">'.konversi_nilai($terendah_nilai_uh9).'</td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center">'.konversi_nilai($terendah_nilai_uh10).'</td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center"></td>';
		}

	if($cacah_kuis>0)
	{
		echo '<td align="center"></td>';
	}
	if($cacah_kuis>1)
	{
		echo '<td align="center"></td>';
	}
	if($cacah_kuis>2)
	{
		echo '<td align="center"></td>';
	}
	if($cacah_kuis>3)
	{
		echo '<td align="center"></td>';
	}
		if($cacah_kuis>1)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_tugas>0)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu1).'</td>';
	}
	if($cacah_tugas>1)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu2).'</td>';
	}
	if($cacah_tugas>2)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu3).'</td>';
	}
	if($cacah_tugas>3)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu4).'</td>';
	}
	if($cacah_tugas>4)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu5).'</td>';
	}
	if($cacah_tugas>5)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu6).'</td>';
	}
	if($cacah_tugas>6)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu7).'</td>';
	}
	if($cacah_tugas>7)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu8).'</td>';
	}
	if($cacah_tugas>8)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu9).'</td>';
	}
	if($cacah_tugas>9)
	{
		echo '<td align="center">'.konversi_nilai($terendah_nilai_tu10).'</td>';
	}

		if($cacah_tugas>1)
		{
		echo '<td align="center"></td>';
		}

	echo '<td align="center">'.konversi_nilai($terendah_nilai_mid).'</td><td align="center">'.konversi_nilai($terendah_nilai_uas).'</td><td align="center">'.konversi_nilai($terendah_nilai_na).'</td><td colspan="3"></td></tr>';
	}
	else
	{
echo '<tr><td align="center"></td><td>Nilai terendah</td>';
		if ($cacah_ulangan_harian>0)
		{echo '<td align="center">'.$terendah_nilai_uh1.'</td>';}
		if ($cacah_ulangan_harian>1)
		{echo '<td align="center">'.$terendah_nilai_uh2.'</td>';}
		if ($cacah_ulangan_harian>2)
		{echo '<td align="center">'.$terendah_nilai_uh3.'</td>';}
		if ($cacah_ulangan_harian>3)
		{echo '<td align="center">'.$terendah_nilai_uh4.'</td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center">'.$terendah_nilai_uh5.'</td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center">'.$terendah_nilai_uh6.'</td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center">'.$terendah_nilai_uh7.'</td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center">'.$terendah_nilai_uh8.'</td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center">'.$terendah_nilai_uh9.'</td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center">'.$terendah_nilai_uh10.'</td>';
		}
		if ($cacah_ulangan_harian>1)
		{echo '<td align="center"></td>';}
		if ($cacah_kuis>0)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if ($cacah_kuis>2)
		{echo '<td></td>';}
		if ($cacah_kuis>3)
		{echo '<td></td>';}
		if ($cacah_kuis>1)
		{echo '<td></td>';}
		if ($cacah_tugas>0)
		{echo '<td align="center">'.$terendah_nilai_tu1.'</td>';}
		if ($cacah_tugas>1)
		{echo '<td align="center">'.$terendah_nilai_tu2.'</td>';}
		if ($cacah_tugas>2)
		{echo '<td align="center">'.$terendah_nilai_tu3.'</td>';}
		if ($cacah_tugas>3)
		{echo '<td align="center">'.$terendah_nilai_tu4.'</td>';}
		if ($cacah_tugas>4)
		{echo '<td align="center">'.$terendah_nilai_tu5.'</td>';}
		if ($cacah_tugas>5)
		{echo '<td align="center">'.$terendah_nilai_tu6.'</td>';}
		if ($cacah_tugas>6)
		{echo '<td align="center">'.$terendah_nilai_tu7.'</td>';}
		if ($cacah_tugas>7)
		{echo '<td align="center">'.$terendah_nilai_tu8.'</td>';}
		if ($cacah_tugas>8)
		{echo '<td align="center">'.$terendah_nilai_tu9.'</td>';}
		if ($cacah_tugas>9)
		{echo '<td align="center">'.$terendah_nilai_tu10.'</td>';}
		if ($cacah_tugas>0)
		{echo '<td align="center">'.$terendah_nilai_rtu.'</td>';}

		if ($cacah_tugas>0)
		{echo '<td align="center">'.$terendah_nilai_rtu.'</td>';}

		echo '<td align="center">'.$terendah_nilai_mid.'</td><td align="center">'.$terendah_nilai_uas.'</td><td align="center">'.$terendah_nilai_na.'</td><td></td></tr>';
	}

$klasikal1='';
$klasikal2='';
$klasikal3='';
$klasikal4='';
$klasikal5='';
$klasikal6='';
$klasikal7='';
$klasikal8='';
$klasikal9='';
$klasikal10='';
$klasikal11='';
$klasikal12='';
$klasikal13='';
$klasikal14='';

$cacah_di_atas_kkm_uh1 = $cacahsiswa - $cacah_di_bawah_kkm_uh1;
$cacah_di_atas_kkm_uh2 = $cacahsiswa - $cacah_di_bawah_kkm_uh2;
$cacah_di_atas_kkm_uh3 = $cacahsiswa - $cacah_di_bawah_kkm_uh3;
$cacah_di_atas_kkm_uh4 = $cacahsiswa - $cacah_di_bawah_kkm_uh4;
$cacah_di_atas_kkm_uh5 = $cacahsiswa - $cacah_di_bawah_kkm_uh5;
$cacah_di_atas_kkm_uh6 = $cacahsiswa - $cacah_di_bawah_kkm_uh6;
$cacah_di_atas_kkm_uh7 = $cacahsiswa - $cacah_di_bawah_kkm_uh7;
$cacah_di_atas_kkm_uh8 = $cacahsiswa - $cacah_di_bawah_kkm_uh8;
$cacah_di_atas_kkm_uh9 = $cacahsiswa - $cacah_di_bawah_kkm_uh9;
$cacah_di_atas_kkm_uh10 = $cacahsiswa - $cacah_di_bawah_kkm_uh10;

$cacah_di_atas_kkm_mid = $cacahsiswa - $cacah_di_bawah_kkm_mid;
$cacah_di_atas_kkm_uas = $cacahsiswa - $cacah_di_bawah_kkm_uas;
$cacah_di_atas_kkm_na = $cacahsiswa - $cacah_di_bawah_kkm_na;
$cacah_di_atas_kkm_nr = $cacahsiswa - $cacah_di_bawah_kkm_nr;
$persentase_di_atas_kkm_uh1 = $cacah_di_atas_kkm_uh1 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh2 = $cacah_di_atas_kkm_uh2 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh3 = $cacah_di_atas_kkm_uh3 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh4 = $cacah_di_atas_kkm_uh4 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh5 = $cacah_di_atas_kkm_uh5 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh6 = $cacah_di_atas_kkm_uh6 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh7 = $cacah_di_atas_kkm_uh7 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh8 = $cacah_di_atas_kkm_uh8 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh9 = $cacah_di_atas_kkm_uh9 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uh10 = $cacah_di_atas_kkm_uh10 * 100 / $cacahsiswa;
$persentase_di_atas_kkm_mid = $cacah_di_atas_kkm_mid * 100 / $cacahsiswa;
$persentase_di_atas_kkm_uas = $cacah_di_atas_kkm_uas * 100 / $cacahsiswa;
$persentase_di_atas_kkm_na = $cacah_di_atas_kkm_na * 100 / $cacahsiswa;
$persentase_di_atas_kkm_nr = $cacah_di_atas_kkm_nr * 100 / $cacahsiswa;
if ($rata_nilai_uh1 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh1 < $this->config->item('persentase_klasikal'))
		{
		$klasikal1='Y';
		}
		else
		{
		$klasikal1='T';
		}
	}
if ($rata_nilai_uh2 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh2 < $this->config->item('persentase_klasikal'))
		{
		$klasikal2='Y';
		}
		else
		{
		$klasikal2='T';
		}
	}
if ($rata_nilai_uh3 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh3 < $this->config->item('persentase_klasikal'))
		{
		$klasikal3='Y';
		}
		else
		{
		$klasikal3='T';
		}
	}
if ($rata_nilai_uh4 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh4<$this->config->item('persentase_klasikal'))
		{
		$klasikal4='Y';
		}
		else
		{
		$klasikal4='T';
		}
	}
if ($rata_nilai_uh5 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh9<$this->config->item('persentase_klasikal'))
		{
		$klasikal9='Y';
		}
		else
		{
		$klasikal9='T';
		}
	}
if ($rata_nilai_uh6 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh10<$this->config->item('persentase_klasikal'))
		{
		$klasikal10='Y';
		}
		else
		{
		$klasikal10='T';
		}
	}
if ($rata_nilai_uh7 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh11<$this->config->item('persentase_klasikal'))
		{
		$klasikal11='Y';
		}
		else
		{
		$klasikal11='T';
		}
	}
if ($rata_nilai_uh8 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh12<$this->config->item('persentase_klasikal'))
		{
		$klasikal12='Y';
		}
		else
		{
		$klasikal12='T';
		}
	}
if ($rata_nilai_uh9 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh13<$this->config->item('persentase_klasikal'))
		{
		$klasikal13='Y';
		}
		else
		{
		$klasikal13='T';
		}
	}
if ($rata_nilai_uh10 > 0 )
	 {
	if ($persentase_di_atas_kkm_uh14<$this->config->item('persentase_klasikal'))
		{
		$klasikal14='Y';
		}
		else
		{
		$klasikal14='T';
		}
	}




if ($rata_nilai_mid > 0 )
	 {
	if ($persentase_di_atas_kkm_mid < $this->config->item('persentase_klasikal'))
		{
		$klasikal5='Y';
		}
		else
		{
		$klasikal5='T';
		}
	}
if ($rata_nilai_uas > 0 )
	 {
	if ($persentase_di_atas_kkm_uas < $this->config->item('persentase_klasikal'))
		{
		$klasikal6='Y';
		}
		else
		{
		$klasikal6='T';
		}
	}
if ($rata_nilai_na > 0 )
	 {
	if ($persentase_di_atas_kkm_na < $this->config->item('persentase_klasikal'))
		{
		$klasikal7='Y';
		}
		else
		{
		$klasikal7='T';
		}
	}
if ($rata_nilai_nr > 0 )
	 {
	if ($persentase_di_atas_kkm_nr < $this->config->item('persentase_klasikal'))
		{
		$klasikal8='Y';
		}
		else
		{
		$klasikal8='T';
		}
	}

	echo '<tr><td align="center"></td><td>Klasikal *</td>';
	if($cacah_ulangan_harian>0)
	{
	echo '<td align="center">'.$klasikal1.'</td>';
	}
	if($cacah_ulangan_harian>1)
	{
	echo '<td align="center">'.$klasikal2.'</td>';
	}
	if($cacah_ulangan_harian>2)
	{
	echo '<td align="center">'.$klasikal3.'</td>';
	}
	if($cacah_ulangan_harian>3)
	{
	echo '<td align="center">'.$klasikal4.'</td>';
	}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center">'.$klasikal9.'</td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center">'.$klasikal10.'</td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center">'.$klasikal11.'</td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center">'.$klasikal12.'</td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center">'.$klasikal13.'</td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center">'.$klasikal14.'</td>';
		}
		if($cacah_ulangan_harian>1)
		{
		echo '<td align="center"></td>';
		}

	if($cacah_kuis>0)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_kuis>1)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_kuis>2)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_kuis>3)
	{
	echo '<td align="center"></td>';
	}
		if($cacah_kuis>1)
		{
		echo '<td align="center"></td>';
		}
	if($cacah_tugas>0)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>1)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>2)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>3)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>4)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>5)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>6)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>7)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>8)
	{
	echo '<td align="center"></td>';
	}
	if($cacah_tugas>9)
	{
	echo '<td align="center"></td>';
	}

		if($cacah_tugas>1)
		{
		echo '<td align="center"></td>';
		}

	echo '<td align="center">'.$klasikal5.'</td><td align="center">'.$klasikal6.'</td><td align="center">'.$klasikal7.'</td><td colspan="3"></td></tr>';
echo '<tr><td align="center"></td><td>Pengembalian Hasil Ulangan</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh1" title="Pengembalian Hasil UH1" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh2" title="Pengembalian Hasil UH2" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh3" title="Pengembalian Hasil UH3" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh4" title="Pengembalian Hasil UH4" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>4)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh5" title="Pengembalian Hasil UH5" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>5)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh6" title="Pengembalian Hasil UH6" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>6)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh7" title="Pengembalian Hasil UH7" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>7)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh8" title="Pengembalian Hasil UH8" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>8)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh9" title="Pengembalian Hasil UH9" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>9)
{echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uh10" title="Pengembalian Hasil UH10" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/mid" title="Pengembalian Hasil MID" target="_blank"><span class="fa fa-bullseye"></span></a></td>';
echo '<td align="center"><a href="'.base_url().'guru/bpu/'.$id_mapel.'/uas" title="Pengembalian Hasil Ulangan Akhir Semester" target="_blank"><span class="fa fa-bullseye"></span></a></td><td colspan="5"></td>';
echo '</tr>';
echo '<tr><td align="center"></td><td>Analisis</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh1" title="Analisis UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh2" title="Analisis UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh3" title="Analisis UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh4" title="Analisis UH4"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>4)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh5" title="Analisis UH5" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>5)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh6" title="Analisis UH6" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>6)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh7" title="Analisis UH7" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>7)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh8" title="Analisis UH8" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>8)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh9" title="Analisis UH9" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>9)
{echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uh10" title="Analisis UH10" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}

if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/mid" title="Analisis MID"><span class="fa fa-bullseye"></span></a></td>';
echo '<td align="center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/uas" title="Analisis Ulangan Akhir Semester"><span class="fa fa-bullseye"></span></a></td><td colspan="5"></td>';
echo '</tr>';

echo '<tr><td align="center"></td><td>Analisis Jawaban Siswa</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh1" title="Analisis Jawaban Siswa UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh2" title="Analisis Jawaban Siswa UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh3" title="Analisis Jawaban Siswa UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh4" title="Analisis Jawaban Siswa UH4"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>4)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh5" title="Analisis Jawaban Siswa UH5" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>5)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh6" title="Analisis Jawaban Siswa UH6" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>6)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh7" title="Analisis Jawaban Siswa UH7" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>7)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh8" title="Analisis Jawaban Siswa UH8" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>8)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh9" title="Analisis Jawaban Siswa UH9" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>9)
{echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uh10" title="Analisis Jawaban Siswa UH10" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}

if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/mid" title="Analisis Jawaban Siswa MID"><span class="fa fa-bullseye"></span></a></td>';
echo '<td align="center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/uas" title="Analisis Jawaban Siswa Ulangan Akhir Semester"><span class="fa fa-bullseye"></span></a></td><td colspan="5"></td></tr>';
echo '<tr><td align="center"></td><td>Hasil Analisis</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh1" title="Lihat Hasil Analisis UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh2" title="Lihat Hasil Analisis UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh3" title="Lihat Hasil Analisis UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh4" title="Lihat Hasil Analisis UH4"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>4)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh5" title="Lihat Hasil Analisis UH5" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>5)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh6" title="Lihat Hasil Analisis UH6" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>6)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh7" title="Lihat Hasil Analisis UH7" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>7)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh8" title="Lihat Hasil Analisis UH8" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>8)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh9" title="Lihat Hasil Analisis UH9" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>9)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh10" title="Lihat Hasil Analisis UH10" target="_blank"><span class="fa fa-bullseye"></span></a></td>';}

if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/mid" title="Lihat Hasil Analisis MID"><span class="fa fa-bullseye"></span></a></td>';
echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uas" title="Lihat Hasil Analisis Ulangan Akhir Semester"><span class="fa fa-bullseye"></span></a></td><td colspan="5"></td></tr>';
echo '<tr><td align="center"></td><td>hasil analisis ditandatangani kepala</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh1/ttd" title="Lihat Hasil Analisis UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh2/ttd" title="Lihat Hasil Analisis UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh3/ttd" title="Lihat Hasil Analisis UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh4/ttd" title="Lihat Hasil Analisis UH4"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>4)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh5/ttd" title="Lihat Hasil Analisis UH5" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>5)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh6/ttd" title="Lihat Hasil Analisis UH6" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>6)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh7/ttd" title="Lihat Hasil Analisis UH7" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>7)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh8/ttd" title="Lihat Hasil Analisis UH8" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>8)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh9/ttd" title="Lihat Hasil Analisis UH9" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>9)
{echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uh10/ttd" title="Lihat Hasil Analisis UH10" ><span class="fa fa-bullseye"></span></a></td>';}

if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/mid/ttd" title="Lihat Hasil Analisis MID"><span class="fa fa-bullseye"></span></a>';
echo '<td align="center"><a href="'.base_url().'guru/hasilanalisis/'.$id_mapel.'/uas/ttd" title="Lihat Hasil Analisis Ulangan Akhir Semester"><span class="fa fa-bullseye"></span></a>';
echo '</td><td colspan="5"></td></tr>';
//data tindaklanjut
echo '<tr><td align="center"></td><td>Program Remidial / Pengayaan</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh1" title="Data Tanggal Pelaksanaan, Tindakan dsb"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh2" title="Data Tanggal Pelaksanaan, Tindakan dsb"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh3" title="Data Tanggal Pelaksanaan, Tindakan dsb"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh4" title="Data Tanggal Pelaksanaan, Tindakan dsb"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>4)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh5" title="Data Tanggal Pelaksanaan, Tindakan dsb untuk tindak lanjut UH5" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>5)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh6" title="Data Tanggal Pelaksanaan, Tindakan dsb untuk tindak lanjut UH6" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>6)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh7" title="Data Tanggal Pelaksanaan, Tindakan dsb untuk tindak lanjut UH7" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>7)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh8" title="Data Tanggal Pelaksanaan, Tindakan dsb untuk tindak lanjut UH8" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>8)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh9" title="Data Tanggal Pelaksanaan, Tindakan dsb untuk tindak lanjut UH9" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>9)
{echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uh10" title="Data Tanggal Pelaksanaan, Tindakan dsb untuk tindak lanjut UH10" ><span class="fa fa-bullseye"></span></a></td>';}

if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/mid" title="Data Tanggal Pelaksanaan, Tindakan dsb"><span class="fa fa-bullseye"></span></a>';
echo '<td align="center"><a href="'.base_url().'guru/tindaklanjut/'.$id_mapel.'/uas" title="Data Tanggal Pelaksanaan, Tindakan dsb"><span class="fa fa-bullseye"></span></a>';
echo '</td><td colspan="5"></td></tr>';
//rancangan remidial
echo '<tr><td align="center"></td><td>Rancangan Program Remidial</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'akreditasi/rancanganremidial/'.$id_mapel.'/uh1" title="Rancangan Program Remidial UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'akreditasi/rancanganremidial/'.$id_mapel.'/uh2" title="Rancangan Program Remidial UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'akreditasi/rancanganremidial/'.$id_mapel.'/uh3" title="Rancangan Program Remidial UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'akreditasi/rancanganremidial/'.$id_mapel.'/uh4" title="Rancangan Program Remidial UH4"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>4)
{echo '<td align="center"><a href="'.base_url().'guru/rancanganremidial/'.$id_mapel.'/uh5" title="Rancangan Program Remidial UH5" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>5)
{echo '<td align="center"><a href="'.base_url().'guru/rancanganremidial/'.$id_mapel.'/uh6" title="Rancangan Program Remidial UH6" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>6)
{echo '<td align="center"><a href="'.base_url().'guru/rancanganremidial/'.$id_mapel.'/uh7" title="Rancangan Program Remidial UH7" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>7)
{echo '<td align="center"><a href="'.base_url().'guru/rancanganremidial/'.$id_mapel.'/uh8" title="Rancangan Program Remidial UH8" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>8)
{echo '<td align="center"><a href="'.base_url().'guru/rancanganremidial/'.$id_mapel.'/uh9" title="Rancangan Program Remidial UH9" ><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>9)
{echo '<td align="center"><a href="'.base_url().'guru/rancanganremidial/'.$id_mapel.'/uh10" title="Rancangan Program Remidial UH10" ><span class="fa fa-bullseye"></span></a></td>';}

if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'akreditasi/rancanganremidial/'.$id_mapel.'/mid" title="Rancangan Program Remidial MID / PTS"><span class="fa fa-bullseye"></span></a></td>';
echo '<td colspan="6"></td></tr>';
echo '<tr><td align="center"></td><td>Pengayaan</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh1" title="Lihat Peserta Program Pengayaan UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh2" title="Lihat Peserta Program Pengayaan UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh3" title="Lihat Peserta Program Pengayaan UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh4" title="Lihat Peserta Program Pengayaan UH4"><span class="fa fa-bullseye"></span></a></td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/mid" title="Lihat Peserta Program Pengayaan MID"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uas" title="Lihat Peserta Program Pengayaan UAS"><span class="fa fa-bullseye"></span></a>';
echo '</td><td colspan="5"></td></tr>';
echo '<tr><td align="center"></td><td>Pengayaan ditandatangani kepala</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh1/ttd" title="Lihat Peserta Program Pengayaan UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh2/ttd" title="Lihat Peserta Program Pengayaan UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh3/ttd" title="Lihat Peserta Program Pengayaan UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh4/ttd" title="Lihat Peserta Program Pengayaan UH4"><span class="fa fa-bullseye"></span></a></td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh5/ttd" title="Lihat Peserta Program Pengayaan UH5"><span class="fa fa-bullseye"></span></a></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh6/ttd" title="Lihat Peserta Program Pengayaan UH6"><span class="fa fa-bullseye"></span></a></td>';

		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh7/ttd" title="Lihat Peserta Program Pengayaan UH7"><span class="fa fa-bullseye"></span></a></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh8/ttd" title="Lihat Peserta Program Pengayaan UH8"><span class="fa fa-bullseye"></span></a></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh9/ttd" title="Lihat Peserta Program Pengayaan UH9"><span class="fa fa-bullseye"></span></a></td>';

		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uh10/ttd" title="Lihat Peserta Program Pengayaan UH10"><span class="fa fa-bullseye"></span></a></td>';

		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/mid/ttd" title="Lihat Peserta Program Pengayaan MID"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'guru/pengayaan/'.$id_mapel.'/uas/ttd" title="Lihat Peserta Program Pengayaan UAS"><span class="fa fa-bullseye"></span></a>';
echo '</td><td colspan="5"></td></tr>';
//nilai remidial
//impor 
echo '<tr><td align="center"></td><td>Nilai Remidi</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/nilairemidi/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_mapel.'/uh1" title="Daftar Nilai Remidi UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/nilairemidi/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_mapel.'/uh2" title="Daftar Nilai Remidi UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/nilairemidi/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_mapel.'/uh3" title="Daftar Nilai Remidi UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/nilairemidi/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_mapel.'/uh4" title="Daftar Nilai Remidi UH4"><span class="fa fa-bullseye"></span></a></td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/nilairemidi/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_mapel.'/mid" title="Daftar Nilai Remidi MID"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'guru/nilairemidi/'.$id_mapel.'/uas" title="Daftar Nilai Remidi UAS"><span class="fa fa-bullseye"></span></a></td><td colspan="5"></td></tr>';
//ketuntasan
echo '<tr><td align="center"></td><td>Ketuntasan</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.substr($thnajaran,0,4).'/'.$semester.'/uh1" title="Lihat Ketuntasan UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uh2" title="Lihat Ketuntasan UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uh3" title="Lihat Ketuntasan UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uh4" title="Lihat Ketuntasan UH4"><span class="fa fa-bullseye"></span></a></td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/mid" title="Lihat Ketuntasan MID"><span class="fa fa-bullseye"></span></a>';
echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uas" title="Lihat Ketuntasan Ulangan Akhir Semester"><span class="fa fa-bullseye"></span></a>';
echo '</td><td colspan="5"></td></tr>';
//ketuntasan di tandatangani kepala
echo '<tr><td align="center"></td><td>Ketuntasan ditandatangani kepala</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uh1/ttd" title="Lihat Ketuntasan UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uh2/ttd" title="Lihat Ketuntasan UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uh3/ttd" title="Lihat Ketuntasan UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uh4/ttd" title="Lihat Ketuntasan UH4"><span class="fa fa-bullseye"></span></a></td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/mid/ttd" title="Lihat Ketuntasan MID"><span class="fa fa-bullseye"></span></a>';
echo '<td align="center"><a href="'.base_url().'guru/ketuntasan/'.$id_mapel.'/uas/ttd" title="Lihat Ketuntasan Ulangan Akhir Semester"><span class="fa fa-bullseye"></span></a>';
echo '</td><td colspan="5"></td></tr>';

//impor 
echo '<tr><td align="center"></td><td>Impor Nilai</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/uh1" title="Impor Nilai UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/uh2" title="Impor Nilai UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/uh3" title="Impor Nilai UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/uh4" title="Impor Nilai UH4"><span class="fa fa-bullseye"></span></a></td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/tu1" title="Impor Nilai Tugas 1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>1)
{echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/tu2" title="Impor Nilai Tugas 2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>2)
{echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/tu3" title="Impor Nilai Tugas 3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>3)
{echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/tu4" title="Impor Nilai Tugas 4"><span class="fa fa-bullseye"></span></a> </td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/mid" title="Impor Nilai MID"><span class="fa fa-bullseye"></span></a> <p class="text-center"> <a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/mid/pemindai" title="Impor Ulangan Tengah Semester dari Hasil Pemindaian" class="btn btn-info">PEMINDAI</a></p></td>';
echo '<td align="center"><a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/uas" title="Impor Nilai Ulangan Akhir Semester"><span class="fa fa-bullseye"></span></a><p class="text-center"> <a href="'.base_url().'guru/unggahnilai/'.$id_mapel.'/uas/pemindai" title="Impor Ulangan Akhir Semester dari Hasil Pemindaian" class="btn btn-info">PEMINDAI</a></p>';
echo '</td>';
echo '<td colspan="3"></td></tr>';
//impor nilai remidial
echo '<tr><td align="center"></td><td>Impor Nilai Remidial</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'guru/imporremidial/'.$id_mapel.'/uh1" title="Impor Nilai Remidial UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'guru/imporremidial/'.$id_mapel.'/uh2" title="Impor Nilai Remidial UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'guru/imporremidial/'.$id_mapel.'/uh3" title="Impor Nilai Remidial UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'guru/imporremidial/'.$id_mapel.'/uh4" title="Impor Nilai Remidial UH4"><span class="fa fa-bullseye"></span></a></td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_tugas>0)
{echo '<td></td>';}
if ($cacah_tugas>1)
{echo '<td></td>';}
if ($cacah_tugas>2)
{echo '<td></td>';}
if ($cacah_tugas>3)
{echo '<td></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';}
echo '<td align="center"><a href="'.base_url().'guru/imporremidial/'.$id_mapel.'/mid" title="Impor Nilai Remidial MID"><span class="fa fa-bullseye"></span></a></td>';
echo '<td align="center"><a href="'.base_url().'guru/imporremidial/'.$id_mapel.'/uas" title="Impor Nilai Remidial Ulangan Akhir Semester"><span class="fa fa-bullseye"></span></a></td>';
echo '<td colspan="5"></td></tr>';
//saran
echo '<tr><td align="center"></td><td>Komentar / Saran</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/uh1" title="Komentar / Saran hasil UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/uh2" title="Komentar / Saran hasil UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/uh3" title="Komentar / Saran hasil UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/uh4" title="Komentar / Saran hasil UH4"><span class="fa fa-bullseye"></span></a></td>';}
		if($cacah_ulangan_harian>4)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>5)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>6)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>7)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>8)
		{
			echo '<td align="center"></td>';
		}
		if($cacah_ulangan_harian>9)
		{
			echo '<td align="center"></td>';
		}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{echo '<td></td>';}
if ($cacah_kuis>1)
{echo '<td></td>';}
if ($cacah_kuis>2)
{echo '<td></td>';}
if ($cacah_kuis>3)
{echo '<td></td>';}
if ($cacah_kuis>1)
{
	echo '<td></td>';
}

if ($cacah_tugas>0)
{echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/tu1" title="Komentar / Saran hasil Tugas 1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>1)
{echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/tu2" title="Komentar / Saran hasil Tugas 2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>2)
{echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/tu3" title="Komentar / Saran hasil tugas 3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>3)
{echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/tu4" title="Komentar / Saran hasil tugas4"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';	
}
echo '<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/mid" title="Komentar / Saran hasil ulangan tengah semester"><span class="fa fa-bullseye"></span></a></td>
<td align="center"><a href="'.base_url().'akreditasi/saran/'.$id_mapel.'/uas" title="Komentar / Saran hasil ulangan semester / kenaikan kelas"><span class="fa fa-bullseye"></span></a></td><td colspan="5"></td></tr>';
//telegram bpu
echo '<tr><td align="center"></td><td>Telegram Hasil Penilaian</td>';
if ($cacah_ulangan_harian>0)
{echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh1" title="Kirim telegram hasil UH1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>1)
{echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh2" title="Kirim telegram hasil UH2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>2)
{echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh3" title="Kirim telegram hasil UH3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_ulangan_harian>3)
{echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh4" title="Kirim telegram hasil UH4"><span class="fa fa-bullseye"></span></a></td>';}
if($cacah_ulangan_harian>4)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh5" title="Kirim telegram hasil UH5"><span class="fa fa-bullseye"></span></a></td>';
}
if($cacah_ulangan_harian>5)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh6" title="Kirim telegram hasil UH6"><span class="fa fa-bullseye"></span></a></td>';
}
if($cacah_ulangan_harian>6)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh7" title="Kirim telegram hasil UH7"><span class="fa fa-bullseye"></span></a></td>';
}
if($cacah_ulangan_harian>7)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh8" title="Kirim telegram hasil UH8"><span class="fa fa-bullseye"></span></a></td>';
}
if($cacah_ulangan_harian>8)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh9" title="Kirim telegram hasil UH9"><span class="fa fa-bullseye"></span></a></td>';
}
if($cacah_ulangan_harian>9)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uh10" title="Kirim telegram hasil UH10"><span class="fa fa-bullseye"></span></a></td>';
}
if ($cacah_ulangan_harian>1)
{echo '<td></td>';}
if ($cacah_kuis>0)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/ku1" title="Kirim telegram hasil kuis 1"><span class="fa fa-bullseye"></span></a></td>';
}
if ($cacah_kuis>1)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/ku2" title="Kirim telegram hasil kuis 2"><span class="fa fa-bullseye"></span></a></td>';
}
if ($cacah_kuis>2)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/ku3" title="Kirim telegram hasil kuis 3"><span class="fa fa-bullseye"></span></a></td>';
}
if ($cacah_kuis>3)
{
	echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/ku4" title="Kirim telegram hasil kuis 4"><span class="fa fa-bullseye"></span></a></td>';
}
if ($cacah_kuis>1)
{
	echo '<td></td>';
}
if ($cacah_tugas>0)
{echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/tu1" title="Kirim telegram hasil Tugas 1"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>1)
{echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/tu2" title="Kirim telegram hasil Tugas 2"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>2)
{echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/tu3" title="Kirim telegram hasil tugas 3"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>3)
{echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/tu4" title="Kirim telegram hasil tugas4"><span class="fa fa-bullseye"></span></a></td>';}
if ($cacah_tugas>4)
{echo '<td></td>';}
if ($cacah_tugas>5)
{echo '<td></td>';}
if ($cacah_tugas>6)
{echo '<td></td>';}
if ($cacah_tugas>7)
{echo '<td></td>';}
if ($cacah_tugas>8)
{echo '<td></td>';}
if ($cacah_tugas>9)
{echo '<td></td>';}

if ($cacah_tugas>1)
{echo '<td></td>';	
}
echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/mid" title="Kirim telegram hasil ulangan tengah semester"><span class="fa fa-bullseye"></span></a></td>
<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/uas" title="Kirim telegram hasil ulangan semester / kenaikan kelas"><span class="fa fa-bullseye"></span></a></td><td colspan="5"></td></tr>';

}
else{
echo '<tr><td colspan="5">Belum ada daftar nilai semester ini</td></tr>';
}
?>
</table></div>
<?php
	
	$mapele = strtolower($mapel);
echo '* : Klasikal bila persentase cacah siswa di atas kkm &gt; '.$this->config->item('persentase_klasikal').'<br />';
if ((!empty($id_mapel)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
{
	
	if ($pilihan == '1') 
		{
		echo '<p class="text-center"><a href="'.base_url().'guru/daftarnilai/'.$id_mapel.'/tambahsiswa" class="btn btn-primary"><b> Perbarui Daftar Siswa</b></a></p>';
		}
	elseif($pilihan == '0')
		{
			echo form_open('guru/perbaruidaftarsiswa');?>
			<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
			<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
			<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
			<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
			<input type="hidden" name="kurikulum" value="<?php echo $kurikulum;?>">
			<input type="hidden" name="semester" value="<?php echo $semester;?>">
			<input type="hidden" name="kd_mapel" value="<?php echo $kd_mapel;?>">
			<input type="hidden" name="kkm" value="<?php echo $kkm;?>">
			<p class="text-center"><input type="submit" value="Perbarui Daftar Siswa" class="btn btn-primary"></p>
</form>
			<?php
		}

	else
		{
		echo '<div class="alert alert-danger">Status mata pelajaran belum ditentukan, silakan menghubungi kurikulum untuk mengubah status lewat menu <strong>Mata Pelajaran -&gt; Daftar Mata Pelajaran Rapor</strong></div>';
		}
}
?>
</div>
