<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 15 Mei 2016 22:21:22 WIB 
// Nama Berkas 		: siswa_kelas.php
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
<div class="container-fluid">
<?php echo form_open($tautan_balik.'/siswakelas','class="form-horizontal" role="form"');?>
<div class="card">
    <div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
    <div class="card-body">

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">
<?php
echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
foreach($daftartahun->result_array() as $k)
{
echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
}
?>
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">
<?php
echo "<option value='".$semester."'>".$semester."</option>";
echo "<option value='1'>1</option>";
echo "<option value='2'>2</option>";
?>
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
<select name="kelas" class="form-control">
<?php
echo "<option value='".$kelas."'>".$kelas."</option>";
foreach($daftarkelas->result_array() as $ka)
{
echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
}
?>
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Urut</label></div><div class="col-sm-9">
<select name="urutkan" class="form-control">
<?php
if(empty($urutkan))
	{
	echo '<option value="Nomor Urut">Nomor Urut</option>';
	echo '<option value="NIS">NIS</option>';
	}
else
	{
	echo '<option value="'.$urutkan.'">'.$urutkan.'</option>';
	echo '<option value="NIS">NIS</option>';
	echo '<option value="Nomor Urut">Nomor Urut</option>';
	}
?>
</select></div></div>
<p class="text-center"><button type="submit" class="btn btn-primary">Tampilkan Daftar Siswa</button></p></div></div></form>
<?php echo form_open($tautan_balik.'/siswakelas');?>
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="75"><strong>Nomor Urut</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jenis Kelamin</strong></td><td><strong>Status Penerima PIP/BSM</strong></td><td><strong>Alasan Menerima PIP/BSM</strong></td></tr>
<?php
$cacah_bsm = 0;
$nomor=1;
$nl = 0;
$np = 0;
$nx = 0;
if($urutkan == 'NIS')
	{
	$daftarsiswa =$this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `nis`");
	}
else
	{
	$daftarsiswa =$this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	}

foreach($daftarsiswa->result() as $b)
{
	$nis = $b->nis;
	$kelamin = jenkel_siswa($nis,0);
	$status = $b->status;
	if($status == 'Y')
	{
		if($kelamin == 'P')
		{
		$np++;
		}
		elseif($kelamin == 'L')
		{
		$nl++;
		}
		else
		{
		$nx++;
		}
	$nis = $b->nis;
	$ta = $this->db->query("select `nisn`, `nis`,`yatim`,`kip`,`sktm`,`pkh`,`kks`, `kps` from `datsis` where `nis`='$nis'");
	$nisn = '';
	$kip = '';
	$sktm = '';
	$pkh = '';
	$kks = '';
	$yatim = '';
	$kps = '';
	foreach($ta->result() as $a)
	{
		$kip = $a->kip;
		$sktm = $a->sktm;
		$pkh = $a->pkh;
		$kks = $a->kks;
		$yatim = $a->yatim;
		$kps = $a->kps;
		$nisn = $a->nisn;
	}
	echo '<tr><td><input type="hidden" name="status_'.$nomor.'" value="Y"><input type="hidden" name="nis_'.$nomor.'" value="'.$b->nis.'"><input type="text" name="no_urut_'.$nomor.'" value="'.$b->no_urut.'" class="form-control"></td><td>'.$nis.'</td><td>'.nis_ke_nama($b->nis).'<br />NISN '.$nisn.'<br />KIP '.$kip.'<br />SKTM '.$sktm.'<br />PKH '.$pkh.'<br />KPS '.$kps.'<br />KKS '.$kks.'<br />Yatim '.$yatim.'</td><td align="center">'.$kelamin.'</td><td align="center">';
	echo '<select name="bsm_'.$nomor.'" class="form-control">';
	if($b->bsm == 1)
	{
		$cacah_bsm++;
		echo '<option value="1">Penerima PIP/BSM atau diusulkan sebagai penerima PIP/BSM</option>';
		echo '<option value="0">Bukan penerima PIP/BSM atau tidak diusulkan sebagai penerima PIP/BSM</option>';

	}
	else
	{
		echo '<option value="0">Bukan penerima atau tidak diusulkan sebagai penerima PIP/BSM</option>';
		echo '<option value="1">Penerima PIP/BSM atau diusulkan sebagai penerima PIP/BSM</option>';
	}
	echo '</select></td>';
	echo '<td>';
	echo '<select name="alasan_bsm_'.$nomor.'" class="form-control">';
	$kode_alasan_bsm = $b->alasan_bsm;
	if(empty($kode_alasan_bsm))
	{
		$kode_alasan_bsm = 7;
	}
	if($b->alasan_bsm == 1)
	{
		$alasan_bsm = 'Pemegang KIP';
	}
	elseif($b->alasan_bsm == 2)
	{
		$alasan_bsm = 'Memiliki Surat Keterangan Tidak Mampu';
	}
	elseif($b->alasan_bsm == 3)
	{
		$alasan_bsm = 'Yatim/Piatu';
	}
	elseif($b->alasan_bsm == 4)
	{
		$alasan_bsm = 'Terancam Putus Sekolah';
	}
	elseif($b->alasan_bsm == 5)
	{
		$alasan_bsm = 'Kelainan Fisik';
	}
	elseif($b->alasan_bsm == 6)
	{
		$alasan_bsm = 'Korban Bencana';
	}
	else
	{
		$alasan_bsm = 'Lainnya';
	}
	echo '<option value="'.$kode_alasan_bsm.'">'.$alasan_bsm.'</option>';
	if(!empty($kip))
	{
		echo '<option value="1">Pemegang KIP</option>';
	}
	if(!empty($sktm))
	{
		echo '<option value="2">Memiliki Surat Keterangan Tidak Mampu</option>';
	}
	if($yatim != 'Bukan diantaranya')
	{
		echo '<option value="3">Yatim/Piatu</option>';
	}
	echo '<option value="4">Terancam Putus Sekolah</option>';
	echo '<option value="5">Kelainan Fisik</option>';
	echo '<option value="6">Korban Bencana</option>';
	if((!empty($pkh)) or (!empty($kks)))
	{
		echo '<option value="7">Lainnya</option>';
	}
	echo '</select></td>';
	echo '</tr>';
	$nomor++;
	}
}
echo '<tr><td colspan="3">Cacah Siswa Laki - laki</td><td align="center">'.$nl.'</td><td>Cacah Penerima BSM/PIP</td><td align="center">'.$cacah_bsm.'</td></tr><tr><td colspan="3">Cacah Siswa Perempuan</td><td align="center">'.$np.'</td><td colspan="2"></td></tr>';
if($nx>0)
	{echo '<tr><td colspan="3">Cacah Siswa Lain</td><td valign="top" align="center">'.$nx.'</td><td colspan="2"></td></tr>';
	}
$cacahsiswa = $nomor-1;
	echo '</table>';
	if(($nl>0) or ($np>0))
	{
		echo '<p class="text-center"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><input type="hidden" name="semester" value="'.$semester.'"><input type="hidden" name="kelas" value="'.$kelas.'"><input type="hidden" name="cacahsiswa" value="'.$cacahsiswa.'"><button type="submit" class="btn btn-primary">Perbarui Nomor Urut Siswa</button></p>';
	}
	else
	{
		echo '<div class="alert alert-danger">Periksa jenis kelamin siswa</div>';
	}
	echo '</form>';
	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
	$id_walikelas = '';
	foreach($ta->result() as $a)
	{
		$id_walikelas= $a->id_walikelas;
	}
	echo '<p><a href="'.base_url().$tautan_balik.'/cetakdaftarsiswa/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_walikelas.'" target="_blank">Cetak Daftar Siswa</a></p>';
echo '</div>';
