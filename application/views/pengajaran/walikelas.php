<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 03:51:09 WIB 
// Nama Berkas 		: walikelas.php
// Lokasi      		: application/views/pengajaran/
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
	$server_pusate = $url_ard_unduh;
	$server_pusat = $url_ard_unduh;
	$port = substr($url_ard_unduh,-2);
	$port_host = 80;
	if(is_numeric($port))
	{
		$port_host = $port;
	}
	if(strpos($server_pusat, 'https://') !== false)
	{
		$server_pusate = 'ssl://'.str_replace('https://','',$server_pusat);
		$port_host = '443';
	}
	if(strpos($server_pusat, 'http://') !== false)
	{
		$server_pusate = str_replace('http://','',$server_pusat);
	}
	if($socket =@ fsockopen($server_pusate, $port_host, $errno, $errstr, 30))
	{
		$online = 1;
		fclose($socket);
	}
	else 
	{
		$online = 0;
		echo 'Server ARD Unduh '.$server_pusate.' tidak menyala';
	}
//	echo ' Status Server ARD port '.$port_host.' - '.$online;
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
	echo form_open('pengajaran/walikelas','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	echo "<option value='".$semester."'>".$semester."</option>";
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	?>
	</select></div></div>

	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama </label></div><div class="col-sm-9">
	<select name="kode_guru" class="form-control">

	<?php
	echo "<option value=''></option>";
	foreach($daftar_guru->result_array() as $ka)
	{
	echo "<option value='".$ka["kd"]."'>".$ka["nama_tanpa_gelar"]." ".$ka["nama"]."</option>";
	}
	echo '
	</select><p class="help-block">Kosongkan bila hendak menampilkan daftar walikelas</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">';
	echo "<option value=''></option>";
	$daftar_kelas = $this->db->query("SELECT * from `m_ruang` order by `ruang`");
	foreach($daftar_kelas->result_array() as $ka)
	{
	echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
	}
	echo '</select><p class="help-block">Kosongkan bila hendak menampilkan daftar walikelas</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kurikulum</label></div><div class="col-sm-9">
	<select name="kurikulum" class="form-control">';
	echo "<option value='2018'>2018</option>";
	echo "<option value='2015'>2015</option>";
	echo "<option value='2013'>2013</option>";
	echo "<option value='KTSP'>KTSP</option>";
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kode Rombel ARD</label></div><div class="col-sm-9"><input type="text" name="kode_rombel"  value="" class="form-control"></div></div>';
	?>
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Tampilkan / Simpan</button></p></form>
<?php
if ((!empty($thnajaran)) and (!empty($semester)))
{
	if ((!empty($kode_guru)) and (!empty($kelas)))
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
			if(count($ta->result())==0)
				{
				$this->db->query("insert into `m_walikelas` (`thnajaran`,`semester`,`kelas`,`kodeguru`,`kurikulum`, `kode_rombel`) value ('$thnajaran','$semester','$kelas','$kode_guru','$kurikulum', '$kode_rombel')");
				}
				else
				{
				$this->db->query("update `m_walikelas` set `kode_rombel`='$kode_rombel', `kodeguru` = '$kode_guru', `kurikulum`='$kurikulum' where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
				}
				
		}
?>
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Thnajaran</strong></td><td><strong>Semester</strong></td><td><strong>Kelas</strong></td><td><strong>Nama Guru</strong></td><td><strong>Kurikulum</strong></td><td><strong>Kode Rombel ARD</strong></td><td><strong>Hapus</strong></td></tr>
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

	if($online == 1)
	{
		$file = file_get_contents($url_ard_unduh.'/api/sekolah.php');
		$json = json_decode($file, true);
		$school_id = $json[0]['school_id'];
		if($school_id == 'ada')
		{
			$file = file_get_contents($url_ard_unduh.'/api/kelas.php?category_level_id='.$level.'&school_class_name='.$namakelas.'&category_majors_id='.$category_majors_id);
			$json = json_decode($file, true);
			$school_class_id = $json[0]['school_class_id'];
			if($school_class_id != 'tidak ada data')
			{
				$this->db->query("update `m_walikelas` set `kode_rombel`='$school_class_id' where `id_walikelas`='$id_walikelas'");
			}
		}
//		echo $school_id;
	}
//	echo $url_ard_unduh.'/api/kelas.php?category_level_id='.$level.'&school_class_name='.$namakelas.'&category_majors_id='.$category_majors_id;

}

$nomor=1;
$jtm = 0;
$daftar_mapel = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
foreach($daftar_mapel->result() as $b)
{
	$kurikulum=cari_kurikulum($b->thnajaran,$b->semester,$b->kelas);
echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->thnajaran."</td><td align=\"center\">".$b->semester."</td><td align=\"center\">".$b->kelas."</td><td>";
if(!empty($b->kodeguru))
{
	echo cari_nama_pegawai($b->kodeguru);
}
else
{
	echo '<p class="text-danger">Walikelas belum ditentukan</p>';
}
echo "</td><td align=\"center\">".$kurikulum."</td><td align=\"center\">".$b->kode_rombel."</td><td align=\"center\"><a href='".base_url()."index.php/pengajaran/walikelas/".$b->id_walikelas."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Walikelas'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;
}
echo '</table></div>';
}
?>
<?php
if (!empty($paginator))
	{
	?>
	<?php echo $paginator;?>
	<?php }?>
</div></div></div>
