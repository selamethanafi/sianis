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
	$ta = $this->db->query("select * from siswa_kelas where `thnajaran`='$thnajaran' and `kelas` like 'XII-%' and status='Y' and `semester`='2' order by `nis` ASC limit $id,1");
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		$tc = $this->db->query("select * from `leger_ijazah` where `thnajaran` = '$thnajaran' and `nis`='$nis'");
		if($tc->num_rows() == 0)
		{
			$this->db->query("insert into `leger_ijazah` (`nis`, `thnajaran`) values ('$nis','$thnajaran')");
		}
	}
	$id++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran/legerijazahnamasaja/<?php echo $id;?>';
		},0);
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
		   window.location.href= '<?php echo base_url();?>pengajaran/tampillegerijazah/<?php echo $thnajaran;?>';
		},1000);
			</script>
	<?php
}
?>
</div></div></div>
