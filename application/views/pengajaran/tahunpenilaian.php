<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 03:54:50 WIB 
// Nama Berkas 		: tahunpenilaian.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

<?php
$thnajaran = cari_thnajaran();

if ((!empty($thnajaranpenilaian)) and (!empty($semesterpenilaian)) and ($proses=='oke'))
	{
	$ta = $this->db->query("select * from `tahun_penilaian` where `thnajaran`='$thnajaran' and `thnajaran_penilaian` = '$thnajaranpenilaian' and `semester`='$semesterpenilaian'");
	if(count($ta->result())==0)
		{
		$this->db->query("insert into `tahun_penilaian` (`thnajaran`,`thnajaran_penilaian`,`semester`,`tingkat`) values ('$thnajaran','$thnajaranpenilaian','$semesterpenilaian','$tingkat')");
		}
		else
		{
			$this->db->query("update `tahun_penilaian` set `tingkat`='$tingkat' where `thnajaran`='$thnajaran' and `thnajaran_penilaian` = '$thnajaranpenilaian' and `semester`='$semesterpenilaian'");
		}
	}
if ($aksi == 'hapus')
	{
	$this->db->query("delete from `tahun_penilaian` where `id_tahun_penilaian`='$id' and `thnajaran`='$thnajaran'");
	$aksi = '';
	}
if ($aksi == 'tambah')
	{
		$daftar_tapel = $this->db->query("select * from `m_tapel` order by `awal` DESC");
		echo '<p class="help-block">Tambah tahun pelajaran yang diperhitungkan menjadi nilai sekolah</p>';
		echo form_open('pengajaran/tahunpenilaianujiannasional','class="form-horizontal" role="form"');?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<select name="thnajaranpenilaian" class="form-control" required>
		<option value=''></option>
		<?php
		foreach($daftar_tapel->result_array() as $k)
		{
			echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
		echo '</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
		<select name="semesterpenilaian" class="form-control" required>';
		echo "<option value=''></option>";
		echo "<option value='1'>1</option>";
		echo "<option value='2'>2</option>";
		echo '</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tingkat</label></div><div class="col-sm-9">
		<select name="tingkat" class="form-control" required>';
		echo "<option value=''></option>";
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
		echo '</select></div></div>';
		?>
		<input type="hidden" name="proses" value="oke">
		<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data Tahun Penilaian</button>
		<a href="<?php echo base_url();?>pengajaran/tahunpenilaianujiannasional" class="btn btn-info" role="button">BATAL</a></p>
		</form>
	<?php
	}
if ((empty($aksi)) or ($aksi == 'hapus'))
	{
	echo '<p><a href="'.base_url().'pengajaran/tahunpenilaianujiannasional/tambah" class="btn btn-info" role="button"><span class="fa fa-plus"></span> <b>Tahun Pelajaran</b></a></p>';
	}

if(empty($aksi))
{
echo '<h5>Tahun Pelajaran saat ini : '.$thnajaran.'</h5>';
echo '<div class="table-responsive">';
echo '<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td>Tingkat</td><td><strong>Hapus</strong></td></tr>';

$query = $this->db->query("select * from `tahun_penilaian` where `thnajaran` = '$thnajaran' order by `thnajaran_penilaian` DESC, `semester` DESC");
$nomor = 1;
foreach($query->result() as $b)
{
echo "<tr align=\"center\"><td>".$nomor."</td><td>".$b->thnajaran_penilaian."</td><td>".$b->semester."</td><td>".$b->tingkat."</td><td><a href='".base_url()."pengajaran/tahunpenilaianujiannasional/hapus/".$b->id_tahun_penilaian."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span>
</a></td>";echo "</tr>";
$nomor++;
}
?>
</table></div>
<?php
}?>
</div>
