<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: afektif.php
// Terakhir diperbarui	: Sel 26 Jan 2016 08:08:54 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>

<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$bisa = 0;
$ta = $this->db->query("select * from `analisis_skor` where `id_mapel`='$id_mapel' and `itemnilai`='$itemnilai'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `analisis_skor` (`id_mapel`, `itemnilai`) values ('$id_mapel','$itemnilai')");
}
else
{
	$this->db->query("update `analisis_skor` set `dipakai`='1' where `id_mapel`='$id_mapel'");
}
$tb = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
if(($itemnilai == 'uh1') or ($itemnilai == 'uh2') or ($itemnilai == 'uh3') or ($itemnilai == 'uh4') or ($itemnilai == 'uh5') or ($itemnilai == 'uh6') or ($itemnilai == 'uh7') or ($itemnilai == 'uh8') or ($itemnilai == 'uh9') or ($itemnilai == 'uh10') or ($itemnilai == 'mid') )
{
	$bisa = 1;
}
if(($tb->num_rows()>0) and ($bisa == 1))
{
	foreach($tb->result() as $b)
	{
		$iteme = 'nsoal_'.$itemnilai;
		$nsoal = $b->$iteme;
		$mapel = $b->mapel;
		$kelas = $b->kelas;
		$thnajaran = $b->thnajaran;
		$semester = $b->semester;
	}
	echo '
	<table class="table table-striped table-bordered">
	<tr><td><strong>Tahun Pelajaran</strong></td><td><strong>'.$thnajaran.'</strong></td></tr>
	<tr><td><strong>Semester</strong></td><td><strong>'.$semester.'</strong></td></tr>
	<tr><td><strong>Kelas</strong></td><td><strong>'.$kelas.'</strong></td></tr>
	<tr><td><strong>Mata Pelajaran</strong></td><td><strong>'.$mapel.'</strong></td></tr>
	<tr><td><strong>Analisis</strong></td><td><strong>'.$itemnilai.'</strong></td></tr>
	<tr><td><strong>Cacah Soal</strong></td><td><strong>'.$nsoal.'</strong></td></tr>
	</table>';
	$ta = $this->db->query("select * from `analisis_skor` where `id_mapel`='$id_mapel' and `itemnilai`='$itemnilai'");
	if($nsoal > 0)
	{
		echo form_open('gurukeren/skor/'.$id_mapel.'/'.$itemnilai,'class="form-horizontal" role="form"');
		for($i=1;$i<=$nsoal;$i++)
		{
			echo '<div class="form-group row row">
				<div class="col-sm-3"><div class="input-group">';
		            echo '<span class="input-group-addon">Skor Soal '.$i.'</span>';
			foreach($ta->result() as $a)
			{
				$iteme = 's'.$i;
				$skor = $a->$iteme;
			}
			echo '<input type="number" min="0" max="99" name="s_'.$i.'" value="'.$skor.'" class="form-control"></div>
		</div></div>';
		}
		echo '<p class="text-center"><input type="hidden" name="cacah" value="'.$nsoal.'"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>';
	}
	else
	{
		echo '<div class="alert alert-warning">Cacah soal masih kosong, ubah di <a href="'.base_url().'guru/ubahkkm/'.$id_mapel.'">sini</a></div>';
	}
}
else
{
	echo 'data mapel tidak ditemukan atau jenis ulangan tidak dikenal';
}
?>
</div></div></div>
