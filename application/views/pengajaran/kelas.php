<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 02:59:11 WIB 
// Nama Berkas 		: jurusan.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2014 selamet hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if(($jenjang == 'MA/SMA') or ($jenjang == 'MTs/SMP') or ($jenjang == 'MI/SD'))
{
if($aksi == 'tambah')
{
	?>
	<p><a href="<?php echo base_url(); ?>pengajaran/kelas" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> <b>Daftar Kelas </b></a></p>
	<?php echo $galat;?> 
	<?php echo form_open('pengajaran/simpankelas','class="form-horizontal" role="form"');?>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Jenjang</label></div>

			<div class="col-sm-9"><?php echo $jenjang;?>
				
			</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Kelas</label></div>
			<div class="col-sm-9"><input type="text" name="ruang" class="form-control" required>
				<?php
				if($jenjang == 'MA/SMA')
				{
						echo '<p class="help-block">Contoh X-  untuk tingkat X, XI- untuk kelas XI, XII- untuk kelas XII. tanda dash(<strong>-</strong>) harus ada</p>';
				}
				if($jenjang == 'MTs/SMP')
				{
						echo '<p class="help-block">Contoh VII-  untuk tingkat VII, VIII- untuk kelas VIII, IX- untuk kelas IX. tanda dash(<strong>-</strong>) harus ada</p>';
				}
				if($jenjang == 'MI/SD')
				{
						echo '<p class="help-block">Contoh I-  untuk tingkat I, II- untuk kelas II, III- untuk kelas III. tanda dash(<strong>-</strong>) harus ada</p>';
				}
				?>

			</div>
		</div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tingkat</label></div><div class="col-sm-9">
	<select name="tingkat" class="form-control" required>
		<?php
		if($jenjang == 'MA/SMA')
		{
			echo '<option value="X">X</option>';
			echo '<option value="XI">XI</option>';
			echo '<option value="XII">XII</option>';
		}
		
		if($jenjang == 'MTs/SMP')
		{
			echo '<option value="VII">VII</option>';
			echo '<option value="VIII">VIII</option>';
			echo '<option value="IX">IX</option>';
		}
		if($jenjang == 'MI/SD')
		{
			echo '<option value="I">I</option>';
			echo '<option value="II">II</option>';
			echo '<option value="III">III</option>';
			echo '<option value="IV">IV</option>';
			echo '<option value="V">V</option>';
			echo '<option value="VI">VI</option>';

		}
		?>
	</select>
	</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Program</label></div><div class="col-sm-9">
	<select name="program" class="form-control" required>
	<?php
	foreach($daftarprogram->result_array() as $kx)
	{
		echo "<option value='".$kx["program"]."'>".$kx["program"]."</option>";
	}
	?>
	</select>
	</div></div>
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data Kelas</button></p>
	</form>
	<?php

}
elseif($aksi == 'ubah')
{
	$adadata = $tampileditkelas->num_rows();
	if($adadata==0)
		{
		header('Location: '.base_url().'pengajaran/kelas');
		}
	?>
	<a href="<?php echo base_url(); ?>pengajaran/kelas" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> <b>Daftar Jurusan / Program / Minat </b></a><p></p>
	<?php echo $galat;?> 
	<?php
	foreach($tampileditkelas->result() as $c)
	{
		$id = $c->id_ruang;
		$tingkat = $c->tingkat;
		$program = $c->program;
		$ruang = $c->ruang;
	}
	echo form_open('pengajaran/simpankelas','class="form-horizontal" role="form"');?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Kelas</label></div><div class="col-sm-9"><input type="text" name="ruang" value="<?php echo $ruang;?>" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tingkat</label></div><div class="col-sm-9">
	<select name="tingkat" class="form-control">
		<?php
		echo "<option value='".$tingkat."'>".$tingkat."</option>";
		if($jenjang == 'MA/SMA')
		{
			echo '<option value="X">X</option>';
			echo '<option value="XI">XI</option>';
			echo '<option value="XII">XII</option>';
		}
		
		if($jenjang == 'MTs/SMP')
		{
			echo '<option value="VII">VII</option>';
			echo '<option value="VIII">VIII</option>';
			echo '<option value="IX">IX</option>';
		}
		if($jenjang == 'MI/SD')
		{
			echo '<option value="I">I</option>';
			echo '<option value="II">II</option>';
			echo '<option value="III">III</option>';
			echo '<option value="IV">IV</option>';
			echo '<option value="V">V</option>';
			echo '<option value="VI">VI</option>';

		}
		?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Program</label></div><div class="col-sm-9">
		<select name="program" class="form-control">
		<?php
		echo "<option value='".$program."'>".$program."</option>";
		foreach($daftarprogram->result_array() as $prog)
		{
		echo "<option value='".$prog["program"]."'>".$prog["program"]."</option>";
		}
		?>
		</select>
	</div></div>
	<input type="hidden" name="id_ruang" value="<?php echo $id;?>">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Perubahan</button></p>
	</form>
	<?php
}
else
{
?>
<a href="<?php echo base_url(); ?>pengajaran/kelas/tambah" class="btn btn-info"><span class="fa fa-plus"></span> <b>Kelas</b></a><p></p>
<div class="table-responsive"><table class="table table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Tingkat</strong></td><td><strong>Program</strong></td><td>category_majors_id</td><td>school_class_name</td><td width="30"><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
	if($b->category_majors_id == 0)
	{
		$category_majors_id = 'NON JURUSAN';
	}
	elseif($b->category_majors_id == 1)
	{
		$category_majors_id = 'IPA';
	}
	elseif($b->category_majors_id == 2)
	{
		$category_majors_id = 'IPS';
	}
	elseif($b->category_majors_id == 3)
	{
		$category_majors_id = 'BAHASA';
	}
	elseif($b->category_majors_id == 4)
	{
		$category_majors_id = 'KEAGAMAAN';
	}
	else
	{
		$category_majors_id = 'BELUM JELAS';
	}

echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->ruang."</td><td align=\"center\">".$b->tingkat."</td><td >".$b->program."</td><td >".$category_majors_id."</td><td >".$b->school_class_name."</td><td align=\"center\"><a href='".base_url()."pengajaran/kelas/ubah/".$b->id_ruang."' title='Edit'><span class=\"fa fa-edit\"></span></a></td></tr>";

//<td align=\"center\"><a href='".base_url()."pengajaran/kelas/hapus/".$b->id_ruang."' onClick=\"return confirm('Anda yakin ingin menghapus kelas ".$b->ruang." ?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;
}
?>
</table>
</div>
<?php
echo $paginator;?>
<?php
}
}
else
{
	echo '<div class="alert alert-danger">Peringatan: Jenjang sekolah tidak didukung, jenjang yang didukung, MI/SD, MTs/SMP, atau MA/SMA, silakan ubah jenjang lewat akun admin, menu Situs Web -&gt; Pengaturan</div>';
}?>

</div></div></div>
