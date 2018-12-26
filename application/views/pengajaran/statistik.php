<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: statistik.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<?php echo form_open('pengajaran/statistik','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
	<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="panel-body">
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="thnajaran" class="form-control">
				<?php
				echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
				foreach($daftar_tapel->result_array() as $k)
				{
				echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
				}
				?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Semester</label></div>
			<div class="col-sm-9">
				<select name="semester" class="form-control">
				<?php
				echo '<option value="'.$semester.'">'.$semester.'</option>';
				echo "<option value='1'>1</option>";
				echo "<option value='2'>2</option>";
				?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Kelas</label></div>
			<div class="col-sm-9">
				<select name="kelas" class="form-control">
				<?php
				echo "<option value='".$kelas."'>".$kelas."</option>";
				foreach($daftar_kelas->result_array() as $ka)
				{
					echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
				}
				?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Ulangan</label></div>
			<div class="col-sm-9">
				<select name="ulangan" class="form-control">
				<?php
				echo "<option value='".$ulangan."'>".$ulangan."</option>";
				echo "<option value='uh1'>Ulangan Harian I</option>";
				echo "<option value='uh2'>Ulangan Harian II</option>";
				echo "<option value='uh3'>Ulangan Harian III</option>";
				echo "<option value='uh4'>Ulangan Harian IV</option>";
				echo "<option value='mid'>Ulangan Tengah Semester</option>";
				echo "<option value='uas'>Ulangan Akhir Semester</option>";
				?>
				</select>
			</div>
		</div>
		<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Tampilkan</button></p>
	</div>
</div>
</form>
<?php
if ((!empty($thnajaran)) and (!empty($kelas)))
{
?>
<div class="table-responsive">
<table class="table table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Thnajaran</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong></td><td><strong>Kode Guru</strong></td></tr>
<?php
$nomor=1;
foreach($daftar_mapel->result() as $b)
{

echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->thnajaran."</td><td align=\"center\">".$b->kelas."</td><td align=\"center\">".$b->mapel."</td><td align=\"center\">".$b->kodeguru."</td></tr>";

$nomor++;
}
?>
</table></div>
<?php
}
?>
</div>
