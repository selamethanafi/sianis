<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : pkg_proses_entry.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tahun = $tahunpenilaian;
$tahunkemarin = $tahun - 1;
$pesan = '';
if (!empty($id_indikator))
{
	$tx = $this->db->query("select * from p_pegawai where `kd`='$nim'");
	foreach($tx->result() as $x)
	{
		$nippegawai = $x->nip;
	}
	$gurubk = 0;
	$tc = $this->db->query("select * from `gurubk` where `nip` = '$nippegawai'");
	if($tc->num_rows()>0)
	{
		$gurubk = 1;
	}
	if($gurubk == 1)
	{
		echo '<div class="container-fluid"><h3>Penilaian Kinerja Guru BK</h3><p><a href="'.base_url().'pkg/proses/'.$id.'" class="btn btn-info"><b>Kembali</b></a></p>';
	}
	else
	{
		echo '<div class="container-fluid"><h3>Penilaian Kinerja Guru</h3><p><a href="'.base_url().'pkg/proses/'.$id.'" class="btn btn-info"><b>Kembali</b></a></p>';
	}
	//perbarui daftar dahulu
	$adg = 0;      
	$ta = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_indikator`='$id_indikator' and  `id_pkg_m_kompetensi` = '$id'");
	$ada = $ta->num_rows();
	if($gurubk == 0) 
	{
		if(($id_indikator >0) and ($id_indikator < 79))
		{
			$adg = 1;
		}
	}
	else
	{
		if(($id_indikator>57) and ($id_indikator < 74))
		{
			$adg = 1;
		}
	}
	if(($ada==0) or ($adg==0))
	{
		echo 'Galat, kode parameter tidak ditemukan';
	}
	else
	{
		foreach($ta->result() as $a)
		{
			$id_indikator = $a->id_pkg_m_indikator;
			$indikator = $a->indikator;
			$satu = $a->satu;
			$dua = $a->dua;
		}
		//buat data baru di tabel pkg_proses
		$td = $this->db->query("select * from `pkg_parameter` where `id_indikator`='$id_indikator' order by nourut");
		foreach($td->result() as $d)
		{
			$id_parameter = $d->id_parameter;
			//cari di nilai guru
			$nilaikemarin = 0;
			$tbkemarin = $this->db->query("select * from `pkg_proses` where `id_parameter`='$id_parameter' and `nip`='$nippegawai' and `tahun`='$tahunkemarin'");
			foreach($tbkemarin->result() as $bkemarin)
			{
				$nilaikemarin = $bkemarin->nilai;
			}

			$tb = $this->db->query("select * from `pkg_proses` where `id_parameter`='$id_parameter' and `nip`='$nippegawai' and `tahun`='$tahun'");


			if(count($tb->result())==0)
			{
				$this->db->query("insert into pkg_proses (`id_parameter`,`nip`,`tahun`, `nilai`) values ('$id_parameter','$nippegawai','$tahun', '$nilaikemarin')");
				$pesan = '<div class="alert alert-info">Mengambil penilaian tahun '.$tahun.'</div>';
			}
		}
		$kompetensi = id_ke_kompetensi_guru($id);
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $tahun?></p></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kompetensi</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kompetensi;?></p></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Indikator Kompetensi</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $indikator;?></p></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ambang Penilaian</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo '... &lt; '.$satu.' bernilai 0, '.$satu.' =&lt; ... &lt; '.$dua.' bernilai 1, '.$dua.' =&lt; ... bernilai 2';?></p></div></div>
		</table>
		<?php
		echo $pesan;
		$ta = $this->db->query("select * from `pkg_parameter` where `id_indikator`='$id_indikator' order by nourut");
		$nomor = 1;
		$jskor = 0;
		if($ta->num_rows()>0)
		{
			echo form_open('pkg/updateskorpkgproses','class="form-horizontal" role="form"');?>
			<table class="table table-striped table-hover table-bordered">
			<tr align="center"><td><strong>No.</strong></td><td><strong>Indikator</strong></td><td><strong>Ada / Tidak *</strong></td></tr>
			<?php
			foreach($ta->result() as $a)
			{
				$id_parameter = $a->id_parameter;
				echo "<tr><td align='center'>".$nomor."</td><td>".$a->parameter."</td><td align='center'>";
				//cari nilai
				$tc = $this->db->query("select * from `pkg_proses` where `id_parameter`='$id_parameter' and `nip`='$nippegawai' and `tahun`='$tahun'");
				foreach($tc->result() as $c)
				{
					$skore = $c->nilai;
					$id_proses = $c->id_pkg_proses;
				}
			 	echo '<input type="hidden" name="id_proses_'.$nomor.'"  value ='.$id_proses.'>';
				if ($skore == 0)
				{
					echo form_checkbox('parameter_'.$nomor, '1', FALSE);
				}
				else
				{
					echo form_checkbox('parameter_'.$nomor, '1', TRUE);
				}
				$jskor = $jskor + $skore;
				$nomor++;
			}
			$cacah_parameter = $nomor - 1;
			echo '<tr><td></td><td align="center">Cacah Parameter = '.$cacah_parameter.'</td><td align="center">
			<input type="hidden" name="cacah_parameter"  value ="'.$cacah_parameter.'"><input type="hidden" name="tahun"  value ="'.$tahun.'">
			<input type="hidden" name="id_indikator"  value ="'.$id_indikator.'">
			<input type="hidden" name="satu"  value ="'.$satu.'">
			<input type="hidden" name="dua"  value ="'.$dua.'">
			<input type="hidden" name="id_kompetensi"  value ="'.$id.'"><input type="submit" value="Simpan" class="btn btn-primary"></td></tr></table></form>';
			echo '* centang jika ada.';
		}// kalau ada rincian
		else
		{
			echo 'belum ada rincian';
		}
	}
}
else
{
	echo 'Galat, kode kompetensi tidak ditemukan';
}

?>
	<div class="clear padding20"></div>
</div>
