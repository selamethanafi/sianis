<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 16:13:10 WIB 
// Nama Berkas 		: kredit_siswa.php
// Lokasi      		: application/views/bp/
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
if(empty($tahun1))
{
	$thnajaran = '';
}
else
{
	$tahun2 = $tahun1+1;
	$thnajaran = $tahun1.'/'.$tahun2;
}
$xloc = base_url().'bp/penerimabsm';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';?>
<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$thnajaran.'</option>';
$ta = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
foreach($ta->result() as $a)
{
$xtahun1 = substr($a->thnajaran,0,4);
$xtahun2 = $xtahun1+1;
$xthnajaran = $xtahun1.'/'.$xtahun2;
echo '<option value="'.$xloc.'/'.$xtahun1.'/'.$semester.'">'.$xthnajaran.'</option>';
}
echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">';
echo 'Semester </label></div><div class="col-sm-9">';
echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
if($semester==1)
	{
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	}
if($semester==2)
	{
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	}
else
	{
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	}
echo '</select></div></div>';
echo '</form>';
if((!empty($tahun1)) and (!empty($semester)))
{
	echo '<p class="text-info">Klik Nama Siswa untuk memutakhirkan data</p>';
	$nomor = 1;
	$np = 0;
	$nl = 0;
	$daftarsiswa =$this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `bsm`='1' order by `kelas` ASC, `no_urut`");
	$cacah_bsm = $daftarsiswa->num_rows();
	echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>NIS</td><td>Nama</td><td>Jenis Kelamin</td><td>Kelas</td><td>Alasan menerima BSM</td></tr>';
	foreach($daftarsiswa->result() as $b)
	{
		?>
		<?php
		$nis = $b->nis;
		$kelamin = jenkel_siswa($nis,0);
		$status = $b->status;
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

		echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td><a href="'.base_url().''.$tautan_balik.'/datapenerimabsm/'.$nis.'" target="_blank">'.nis_ke_nama($nis).'</a></td><td>'.$kelamin.'</td><td>'.$b->kelas.'</td>';
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
		elseif($b->alasan_bsm == 7)
		{
			$alasan_bsm = 'Lainnya';
		}
		else
		{
			$alasan_bsm= '?';
		}
	
		echo '<td>'.$alasan_bsm.'</td></tr>';
		$nomor++;
	}
	echo '<tr><td colspan="3">Cacah Siswa Laki - laki</td><td colspan="2">'.$nl.'</td></tr>';
	echo '<tr><td colspan="3">Cacah Siswa Perempuan</td><td colspan="2">'.$np.'</td></tr>';
	echo '<tr><td colspan="3">Cacah Penerima BSM/PIP</td><td colspan="2">'.$cacah_bsm.'</td></tr>';
	echo '</table>';
}
?>

</div></div></div>
