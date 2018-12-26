<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: akhlak.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 17 Mei 2016 18:30:58 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$kelasax ='';
$xloc = base_url().'bp/sikap';
$thn1 = substr($thnajaran,0,4);
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
		<div class="card-body">
			<?php echo form_open($xloc,'class="form-horizontal" role="form"');?>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
				<select name="thnajaran" onChange="MM_jumpMenu('self',this,0)" class="form-control">
				<?php
				echo '<option value="'.$thnajaran.'">'.$thnajaran.'</option>';
				?>
				</select>
			</div>
		</div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
<?php
	echo '<option value="'.$semester.'">'.$semester.'</option>';
?>
</select></div></div>
<?php
if(empty($id_kelas))
{
	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kurikulum`='2015' order by `kelas`	");
?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="id_kelas" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value="">pilih kelas</option>';
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
	}
	?>
	</select></div></div></form>
<?php

}
else
{
	$tax = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	foreach($tax->result() as $ax)
	{
		$kelasax = $ax->kelas;
	}
	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kurikulum`='2015' order by `kelas`");
?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="id_kelas" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value="">'.$kelasax.'</option>';
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
	}
	?>
	</select></div></div>
	<?php
	$tmapel = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasax' order by mapel");
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Guru</label></div><div class="col-sm-9">
	<select name="kodeguru" class="form-control" required>
	<?php
	echo '<option value="">pilih guru</option>';
	foreach($tmapel->result() as $d)
	{
		$kodeguru = $d->kodeguru;
		$tb = $this->db->query("select * from `m_akhlak_2015` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasax' and `kodeguru`='$kodeguru'");
		$adaguru = $tb->num_rows();
		if($adaguru == 0)
		{
			echo '<option value="'.$d->kodeguru.'">'.$d->mapel.' '.cari_nama_pegawai($d->kodeguru).'</option>';
		}
	}
	?>
	</select></div></div>
	<?php
}
?>
<p class="text-center"><input type="hidden" name="post_id_kelas" value="<?php echo $id_kelas;?>"><input type="hidden" name="post_thnajaran" value="<?php echo $thnajaran;?>"><input type="hidden" name="post_semester" value="<?php echo $semester;?>"><input type="hidden" name="post_kelas" value="<?php echo $kelasax;?>"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>
</form>
<?php
if((!empty($thnajaran)) and (!empty($semester)))
{
	echo '<div class="alert alert-info">Untuk menghapus, klik nama guru</div>';
	$nomor = 1;
	echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td>Nomor</td><td>Nama Guru</td><td>Kelas</td><td>Mata Pelajaran</td></tr>';
	$tb = $this->db->query("select * from `m_akhlak_2015` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasax' order by kelas");
	$kodegurune = '';
	foreach($tb->result() as $b)
	{
		$kodeguruini = $b->kodeguru;
		$kelasini = $b->kelas;
		$mapel = '';
		$tmapel = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguruini' and `kelas`='$kelasini'");
		foreach($tmapel->result() as $dmapel)
		{
			if(empty($mapel))
			{
				$mapel .= $dmapel->mapel;
			}
			else
			{
				$mapel .= ', '.$dmapel->mapel;
			}

		}
		echo '<tr><td align="center">'.$nomor.'</td><td><a href="'.base_url().'bp/hapuspenilaisikap/'.$id_kelas.'/'.$b->id_m_akhlak.'" title="hapus">'.cari_nama_pegawai($b->kodeguru).'</a></td><td align="center">'.$kelasini.'</td><td align="center">'.$mapel.'</td></tr>';
		$nomor++;
	}
	echo '</table>';
}
?>
</div></div></div>
