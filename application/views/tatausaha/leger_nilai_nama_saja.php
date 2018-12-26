<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_ijazah.php
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
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
if($id <= $total_siswa)
{
	$persen = $id/$total_siswa * 100;
	$persen = round($persen);
	echo '<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" style="width:'.$persen.'%;">
		'.$persen.'% terproses
		</div>
	      </div>';
	//echo 'Persentase '.$persen;
	$ta = $this->db->query("select * from siswa_kelas where `thnajaran`='$thnajaran' and `kelas` = '$kelas' and status='Y' and `semester`='$semester' order by `nis` ASC limit $id,1");
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		$tc = $this->db->query("select * from `leger_nilai` where `thnajaran` = '$thnajaran' and `semester`= '$semester' and `kelas` = '$kelas' and `nis`='$nis'");
		if($tc->num_rows() == 0)
		{
			$this->db->query("insert into `leger_nilai` (`thnajaran`,`semester`,`kelas`,`nis`) values ('$thnajaran','$semester', '$kelas','$nis')");
		}
	}
	$id++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>tatausaha/legernilainamasaja/<?php echo $tahun1."/".$semester."/".$id_walikelas."/".$id;?>';
		},10);
			</script>
	<?php
}
else
{
	$persen = 100;
	echo '<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" style="width:'.$persen.'%;">
		'.$persen.'% terproses
		</div>
	      </div>';
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>tatausaha/legernilai/<?php echo $tahun1."/".$semester."/".$id_walikelas;?>';
		},10);
			</script>
	<?php
}
?>
</div></div></div>
