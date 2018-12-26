<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : nilai_psikomotor.php
// Lokasi      : application/views/guru
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<p><a href="<?php echo base_url(); ?>guru/daftarnilaipsikomotor/<?php echo $id_mapel;?>"><b> Kembali</b></a></p>
<?php
$itemnilai='';
if ((empty($id_mapel)) or (empty($nomoraspek)))
{
	echo 'Kode Mapel tidak disertakan dan atau kode aspek klik  <a href="'.base_url().'guru/psikomotor">di sini</a>';
}
else
{
	$ta = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	$ada = $ta->num_rows();
	if ($ada == 0)
	{
		echo 'Kode Mapel tidak ada atau bukan yang diampu, klik  <a href="'.base_url().'guru/psikomotor/'.$id_mapel.'">di sini</a>';
	}
	else
	{
		foreach($ta->result() as $dtmapel)
		{
			$kelas = $dtmapel->kelas;
			$mapel = $dtmapel->mapel;
			$thnajaran = $dtmapel->thnajaran;
			$semester= $dtmapel->semester;
		}
		$tb = $this->db->query("select * from detil_aspek_psikomotor where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek'");
		$adab = $tb->num_rows();
		$skore = 0;
		foreach($tb->result() as $b)
			{
			$nindikator = $b->np;
			$keterangan = $b->keterangan;
			$skore = $b->s1 + $b->s2 + $b->s3 + $b->s4 + $b->s5 + $b->s6 + $b->s7 + $b->s8 + $b->s9 + $b->s10; 
			}			
		$tc = $this->db->query("select * from aspek_psikomotorik where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		$aspek ='';
		$iteme = "p".$nomoraspek;
		foreach($tc->result() as $c)
			{
			$aspek = $c->$iteme;
			}

		echo '<form class="form-horizontal" role="form"><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">'.$thnajaran.'</p></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">'.$semester.'</p></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static">'.$kelas.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">'.$mapel.'</p></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penilaian Keterampilan</label></div><div class="col-sm-9"><p class="form-control-static">'.$aspek.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah Indikator</label></div><div class="col-sm-9"><p class="form-control-static">'.$nindikator.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jumlah Skor</label></div><div class="col-sm-9"><p class="form-control-static">'.$skore.'</p></div></div></form>';		
		echo $keterangan;
		$td = $this->db->query("select * from `detil_keterampilan` where `id_detil_keterampilan`='$id_nilai'");
		$ada_td = $td->num_rows();
		if($ada_td==0)
		{
			echo '<div class="alert alert-warning">Data nilai tidak ditemukan</div>';
		}
		else
		{
			foreach($td->result() as $d)
			{
				$nis = $d->nis;
				$namasiswa = nis_ke_nama($d->nis);
				$np1 = $d->p1;
				$np2 = $d->p2;
				$np3 = $d->p3;
				$np4 = $d->p4;
				$np5 = $d->p5;
				$np6 = $d->p6;
				$np7 = $d->p7;
				$np8 = $d->p8;
				$np9 = $d->p9;
				$np10 = $d->p10;
			}
			echo form_open('k2013/perbaruipenilaianketerampilanpersiswa','class="form-horizontal" role="form"');
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Siswa</label></div><div class="col-sm-9"><p class="form-control-static">'.$namasiswa.'</p></div></div>';
			foreach($tb->result() as $b)
			{
				if(!empty($b->p1))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p1.'</label></div><div class="col-sm-9"><select name="p1" class="form-control">
					<option value="'.$np1.'">'.$np1.'</option>';
					for($i=1;$i<=$b->s1;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p2))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p2.'</label></div><div class="col-sm-9"><select name="p2" class="form-control">
					<option value="'.$np2.'">'.$np2.'</option>';
					for($i=1;$i<=$b->s2;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p3))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p3.'</label></div><div class="col-sm-9"><select name="p3" class="form-control">
					<option value="'.$np3.'">'.$np3.'</option>';
					for($i=1;$i<=$b->s3;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p4))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p4.'</label></div><div class="col-sm-9"><select name="p4" class="form-control">
					<option value="'.$np4.'">'.$np4.'</option>';
					for($i=1;$i<=$b->s4;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p5))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p5.'</label></div><div class="col-sm-9"><select name="p5" class="form-control">
					<option value="'.$np5.'">'.$np5.'</option>';
					for($i=1;$i<=$b->s5;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p6))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p6.'</label></div><div class="col-sm-9"><select name="p6" class="form-control">
					<option value="'.$np6.'">'.$np6.'</option>';
					for($i=1;$i<=$b->s6;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p7))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p7.'</label></div><div class="col-sm-9"><select name="p7" class="form-control">
					<option value="'.$np7.'">'.$np7.'</option>';
					for($i=1;$i<=$b->s7;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p8))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p8.'</label></div><div class="col-sm-9"><select name="p8" class="form-control">
					<option value="'.$np8.'">'.$np8.'</option>';
					for($i=1;$i<=$b->s8;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p9))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p9.'</label></div><div class="col-sm-9"><select name="p9" class="form-control">
					<option value="'.$np9.'">'.$np9.'</option>';
					for($i=1;$i<=$b->s9;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
				if(!empty($b->p10))
				{
					echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">'.$b->p10.'</label></div><div class="col-sm-9"><select name="p10" class="form-control">
					<option value="'.$np10.'">'.$np10.'</option>';
					for($i=1;$i<=$b->s10;$i++)
					{
					echo '<option value="'.$i.'">'.$i.'</option>';
					}
					echo '</select></div></div>';
				}
			}
				if(empty($b->p1))
				{
					echo '<input type="hidden" class="form-control" name="p1" value="'.$np1.'">';
				}
				if(empty($b->p2))
				{
					echo '<input type="hidden" class="form-control" name="p2" value="'.$np2.'">';
				}
				if(empty($b->p3))
				{
					echo '<input type="hidden" class="form-control" name="p3" value="'.$np3.'">';
				}
				if(empty($b->p4))
				{
					echo '<input type="hidden" class="form-control" name="p4" value="'.$np4.'">';
				}
				if(empty($b->p5))
				{
					echo '<input type="hidden" class="form-control" name="p5" value="'.$np5.'">';
				}
				if(empty($b->p6))
				{
					echo '<input type="hidden" class="form-control" name="p6" value="'.$np6.'">';
				}
				if(empty($b->p7))
				{
					echo '<input type="hidden" class="form-control" name="p7" value="'.$np7.'">';
				}
				if(empty($b->p8))
				{
					echo '<input type="hidden" class="form-control" name="p8" value="'.$np8.'">';
				}
				if(empty($b->p9))
				{
					echo '<input type="hidden" class="form-control" name="p9" value="'.$np9.'">';
				}
				if(empty($b->p10))
				{
					echo '<input type="hidden" class="form-control" name="p10" value="'.$np10.'">';
				}
		if($skore>0)
		{
		echo '<input type="hidden" name="nis" value="'.$nis.'"><input type="hidden" name="skore" value="'.$skore.'"><input type="hidden" name="id_mapel" value="'.$id_mapel.'"><input type="hidden" name="cacahindikator" value="'.$nindikator.'"><input type="hidden" name="mapel" value="'.$mapel.'"><input type="hidden" name="kelas" value="'.$kelas.'"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><input type="hidden" name="semester" value="'.$semester.'"><input type="hidden" name="nomoraspek" value="'.$nomoraspek.'"><input type="hidden" name="id_detil_keterampilan" value="'.$id_nilai.'"><input type="submit" value="Simpan Nilai" class="btn btn-primary">';
		}
		else
		{
			'<div class="alert alert-warning">Belum bisa disimpan karena jumlah skor = 0</div>';
		}
		echo '</form>';
		}
	} //akhir kalau guru ybs
} // kalau ada id mapel dan nomor aspek
?>
</div></div></div>
