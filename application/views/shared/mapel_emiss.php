<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_emiss.php
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
<?php
if($tahun1>0)
{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
}
else
{
	$tahun2 = '';
	$thnajaran = '';
}
echo '<div class="card">
	<div class="card-header"><h3>'.$judulhalaman.'</h3></div>
	<div class="card-body">';
if($aksi == 'tambah')
{
	echo '<h3>Tambah Mata Pelajaran</h3>';
	$td = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas' and `thnajaran`='$thnajaran' and `semester` = '$semester'");
	if($td->num_rows()>0)
	{
		echo '<form name="formx" method="post" action="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'" class="form-horizontal" role="form">';

		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
		echo '<select name="thnajaran" class="form-control">';
		echo '<option value="'.$thnajaran.'">'.$thnajaran.'</option>';
		echo '</select></div></div>';
		//semester
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
		echo '<select name="semester" class="form-control">';
		echo '<option value="'.$semester.'">'.$semester.'</option>';
		echo '</select></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
		echo '<select name="kelas" class="form-control">';
		foreach($td->result() as $d)
		{
			$id_kelasx = $d->id_walikelas;
			$kelasx = $d->kelas;
			echo '<option value="'.$kelasx.'">'.$kelasx.'</option>';
		}
		echo '</select></div></div>';
		$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester` = '$semester' and `kelas`='$kelasx' order by mapel");
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">';

		echo '<select name="mapel" class="form-control">';
			echo '<option value="MAPEL KOSONG">MAPEL KOSONG</option>';
		foreach($tb->result() as $b)
		{
			$mapel = $b->mapel;
			echo '<option value="'.$b->mapel.'">'.$b->mapel.'</option>';
		}
		echo '</select></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input type="number" name="no_urut" class="form-control"><input type="hidden" name="proses" value="tambah" class="form-control"></div></div>';		
		echo '<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>';
		echo '</form>';
	}	
	else
	{
		echo '<div class="alert alert-warning">Data tidak ditemukan, <a href="'.base_url().'tatausaha/mapelemiss" class="btn btn-primary">Batal</a></div>';
	}
}
elseif($aksi == 'ubah')
{
	echo '<h3>Ubah Nomor Urut Mata Pelajaran</h3>';
	$td = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas' and `thnajaran`='$thnajaran' and `semester` = '$semester'");
	if($td->num_rows()>0)
	{
		echo '<form name="formx" method="post" action="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'" class="form-horizontal" role="form">';

		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
		echo '<select name="thnajaran" class="form-control">';
		echo '<option value="'.$thnajaran.'">'.$thnajaran.'</option>';
		echo '</select></div></div>';
		//semester
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
		echo '<select name="semester" class="form-control">';
		echo '<option value="'.$semester.'">'.$semester.'</option>';
		echo '</select></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
		echo '<select name="kelas" class="form-control">';
		foreach($td->result() as $d)
		{
			$id_kelasx = $d->id_walikelas;
			$kelasx = $d->kelas;
			echo '<option value="'.$kelasx.'">'.$kelasx.'</option>';
		}
		echo '</select></div></div>';
		$tb = $this->db->query("select * from `m_mapel_emiss` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by `no_urut`");
		$nomor = 1;
		foreach($tb->result() as $b)
		{
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->mapel.'</label></div><div class="col-sm-9"><input type="number" name="no_urut_'.$nomor.'" value="'.$b->no_urut.'" class="form-control"><input type="hidden" name="id_'.$nomor.'" value="'.$b->id.'"></div></div>';
			$nomor++;
		}
		$cacah = $nomor - 1;
		echo '<input type="hidden" name="cacah" value="'.$cacah.'"><input type="hidden" name="proses" value="ubah" class="form-control"></div></div>';		
		echo '<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>';
		echo '</form>';
	}	
	else
	{
		echo '<div class="alert alert-warning">Data tidak ditemukan, <a href="'.base_url().'tatausaha/mapelemiss" class="btn btn-primary">Batal</a></div>';
	}

}
else
{
$xloc = base_url().'tatausaha/mapelemiss';
$kelasx ='';
$adamapel = 0;
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
if(empty($tahun1))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}

	echo '</select></div></div>';

}
elseif(empty($semester))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'tatausaha/mapelemiss">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_walikelas.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1/'.$id_kelas.'">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2/'.$id_kelas.'">2</option>';
	echo '</select></div></div>';
}
elseif(empty($id_walikelas))
{
	//thnajaran
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'tatausaha/mapelemiss">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
	//semester
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'">Semester</a></label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_walikelas.'">'.$semester.'</option>';
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_walikelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_walikelas.'"></option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select><p class="help-block">Kalau kelas tidak muncul, silakan cek daftar walikelas</p></div></div>';
	$kelas = $kelasx;
}
else
{
//thnajaran
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'tatausaha/mapelemiss">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
	//semester
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'">Semester</a></label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_walikelas.'">'.$semester.'</option>';
	echo '</select></div></div>';
	$td = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
	if($td->num_rows()>0)
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'/'.$semester.'">Kelas</a></label></div><div class="col-sm-9">';
		echo "<select name=\"id_walikelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		foreach($td->result() as $d)
		{
			$id_kelasx = $d->id_walikelas;
			$kelasx = $d->kelas;
			echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
		}
		echo '</select></div></div>';
		if($aksi == 'ambil')
		{
			$ta = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by `no_urut`");
			foreach($ta->result() as $a)
			{
				$mapel = $a->nama_mapel_portal;
				if(!empty($mapel))
				{
					$tb = $this->db->query("select * from `m_mapel_emiss` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' and `mapel` = '$mapel'");
					if($tb->num_rows() == 0)
					{
						$this->db->query("insert into `m_mapel_emiss` (`thnajaran`,`semester`,`kelas`,`mapel`) values ('$thnajaran','$semester','$kelasx','$mapel')");
					}
				}
			}
		}
		echo '<p class="text-center"><a href="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/ambil" class="btn btn-success">AMBIL DARI MAPEL RAPOR</a></p> ';
		$tb = $this->db->query("select * from `m_mapel_emiss` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by `no_urut`");
		$adamapel = $tb->num_rows();
		echo '<table class="table table-striped table-hover table-bordered"><td>Nomor</td><td>Mapel</td><td>HAPUS</td></tr>';
		foreach($tb->result() as $b)
		{
			echo '<td>'.$b->no_urut.'</td><td>'.$b->mapel.'</td><td><a href="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/hapus/'.$b->id.'" data-confirm="Yakin menghapus data ini?"><span class="fa fa-trash-alt"></span></td></tr>';

		}
		echo '</tr></table>';
		if($adamapel > 0)
		{
			echo '<p class="text-center"><a href="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/tambah" class="btn btn-danger">TAMBAH MAPEL</a> <a href="'.base_url().'tatausaha/mapelemiss/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/ubah" class="btn btn-info">UBAH NOMOR URUT</a> <a href="'.base_url().'tatausaha/legernilainamasaja/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'" class="btn btn-success">PROSES LEGER</a> <a href="'.base_url().'tatausaha/unduhrapor/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'" class="btn btn-success">UNDUH NILAI RAPOR</a></p>';
		}

	}
	else
	{
		echo 'Data kelas tidak ditemukan';
	}
	$kelas = $kelasx;
	echo '</form>';
}
} 
?>
</div></div></div>
