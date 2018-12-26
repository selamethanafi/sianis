<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: sk_semester.php
// Lokasi      		: application/views/guru/
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url();?>pkg/skp" class="btn btn-info">Ke SKP</a></p>
<?php echo form_open('pkg/sk','class="form-horizontal" role="form"');
if (empty($thnajaran))
	{
	$thnajaran = cari_thnajaran();
	}
if (empty($semester))
	{
	$semester = cari_semester();
	}
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option></select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">SK yang berlaku</label></div><div class="col-sm-9">
	<select name="id_sk" class="form-control">';
	foreach($query->result() as $l)
	{
	echo "<option value='".$l->id."'>".$l->uraian." - ".$l->pangkat." ".substr($l->gol,3,20)."</option>";
	}
	echo '</select></div></div><input type="hidden" name="kodeguru" value="'.$kodeguru.'">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>';
echo '<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>SK</strong></td><td><strong>Tanggal</strong></td><td><strong>Uraian / Angka Kredit</strong></td><td><strong>Pangkat / Gol/ruang / Jabatan</strong></td><td><strong>Gaji Pokok</strong></td><td><strong>TMT</strong></td><td><strong>Masa Kerja</strong></td></tr>';
$ttambahan = $this->db->query("select * from `p_tugas_tambahan` where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC");
$nomor=1;
foreach($ttambahan->result() as $dp)
{
echo "<tr><td align='center'>".$nomor."</td><td align='center'>".$dp->thnajaran."</td><td align='center'>".$dp->semester."</td>";
		$id_sk = $dp->id_sk;
		$tkepeg = $this->db->query("select * from `p_kepegawaian` where id = '$id_sk'");
		$adask = $tkepeg->num_rows();
		if ($adask == 0)
			{
			echo '<td colspan="7">Semester ini belum dimutakhirkan? atau SK tidak ditemukan atau sudah terhapuskah?</div></div>';
			}
			else
			{
			foreach($tkepeg->result() as $t)
				{
				echo '<td>'.$t->jenis_sk.'</td><td>'.$t->tanggal.'</td><td>'.$t->uraian.' / '.$t->pak.'</td><td>'.$t->pangkat.' / '.substr($t->gol,2,10).' / '.$t->jabatan.'</td><td>'.$t->gapok.'</td><td>'.date_to_long_string($t->tmt).'</td><td>'.$t->tahun.' / '.$t->bulan.'</td></tr>';
				}
			}
	$nomor++;	
}

?>
</table></div>
</div></div></div>
