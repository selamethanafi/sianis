<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 02 Jan 2019 20:30:52 WIB 
// Nama Berkas 		: walikelas.php
// Lokasi      		: application/views/sinkronad/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               admin@mantengaran.sch.id
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
$xloc = base_url().'sinkronard/walikelas';
	if (!empty($id_walikelas))
		{
		$this->db->query("delete from `m_walikelas` where `id_walikelas`='$id_walikelas'");
		}
	if (empty($thnajaran))
		{
		$thnajaran = cari_thnajaran();
		}
	if (empty($semester))
		{
		$semester = cari_semester();
		}
	echo form_open('pengajaran/walikelas','class="form-horizontal" role="form"');
if(empty($tahun1))
{
	$tahun1 = substr(cari_thnajaran(),0,4);
}
if(empty($semester))
{
	$semester = cari_semester();
}
$tahun2 = $tahun1+1;
$thnajaran = $tahun1.'/'.$tahun2;
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran </label></div><div class="col-sm-9">';
echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result() as $c)
{
	echo '<option value="'.$xloc.'/'.substr($c->thnajaran,0,4).'">'.$c->thnajaran.'</option>';
}
echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	echo '</select></div></div>';
echo '</form>';
if ((!empty($thnajaran)) and (!empty($semester)))
{

?>
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Nama Guru</strong></td><td><strong>Kurikulum</strong></td><td><strong>Kode Rombel ARD</strong></td></tr>
<?php
$daftar_mapel = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
foreach($daftar_mapel->result() as $b)
{
	$id_walikelas = $b->id_walikelas;
	$kelas = $b->kelas;
	$tingkat = kelas_jadi_tingkat($kelas);
	if($tingkat == 'X')
	{
		$level = 10;
	}
	elseif($tingkat == 'XI')
	{
		$level = 11;
	}
	else
	{
		$level = 12;
	}
	$namakelas = substr($kelas,-1);
	if(!is_numeric($namakelas))
	{
		$namakelas = 1;
	}
	$query=$this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
	foreach($query->result() as $c)
	{
		$category_majors_id = $c->category_majors_id;
	}
	$online = cek_host_ard($url_ard_unduh);
	if($online == 1)
	{
		$mysqld = koneksi_mysql($url_ard_unduh);
		if($mysqld == 'ada')
		{
			$json = via_curl($url_ard_unduh.'/api/sekolah.php');
			$school_id = $json[0]['school_id'];
			if($school_id == 'ada')
			{
				$json = via_curl($url_ard_unduh.'/api/kelas.php?category_level_id='.$level.'&school_class_name='.$namakelas.'&category_majors_id='.$category_majors_id);
				$school_class_id = $json[0]['school_class_id'];
				if($school_class_id != 'tidak ada data')
				{
					$this->db->query("update `m_walikelas` set `kode_rombel`='$school_class_id' where `id_walikelas`='$id_walikelas'");
				}
			}
		}
		else
		{
			echo $mysqld;
		}
	}
	else
	{
		echo '<h4 class="text-danger">Tidak terhubung ke server ARD '.$url_ard_unduh.'</h4>';
	}
}

$nomor=1;
$jtm = 0;
$daftar_mapel = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
foreach($daftar_mapel->result() as $b)
{
	$kurikulum=cari_kurikulum($b->thnajaran,$b->semester,$b->kelas);
echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->kelas."</td><td>";
if(!empty($b->kodeguru))
{
	echo cari_nama_pegawai($b->kodeguru);
}
else
{
	echo '<p class="text-danger">Walikelas belum ditentukan</p>';
}
echo "</td><td align=\"center\">".$kurikulum."</td><td align=\"center\">".$b->kode_rombel."</td></tr>";
$nomor++;
}
echo '</table></div>';
}
?>
</div></div></div>
