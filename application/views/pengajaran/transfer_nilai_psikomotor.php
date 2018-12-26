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
<div class="panel-heading"><h3>Transfer</h3></div>
<div class="panel-body">
<?php
$thnajaran = '2016/2017';
$semester = '2';
$kelas = 'X-MIA 1';
//$sql = "select * from `psikomotorik` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'";
$sql = "select * from `psikomotorik`";
$sql2 = $sql.'  order by `nis` limit '.$id.',1';
$ta = $this->db->query($sql);
$total = $ta->num_rows();
//echo '<h2>Mohon bersabar Tahun '.$thnajaran.' Semester '.$semester.' Kelas '.$kelas.' '.$total.' baris akan diproses</h2>';
echo '<h2>Mohon bersabar '.$total.' baris akan diproses</h2>';
if($id <= $total)
{
	$persen = $id/$total * 100;
	$persen = round($persen,2);
	echo $id.' dari '.$total.' record ('.$persen.'%) terproses';
	$tb = $this->db->query($sql2);
	foreach($tb->result() as $b)
	{
		$thnajaran = $b->thnajaran;
		$semester = $b->semester;
		$kelas = $b->kelas;
		$mapel = $b->mapel;
		$nis = $b->nis;
		$nama = $b->nama;
		$p1 = $b->p1;
		$p2 = $b->p2;
		$p3 = $b->p3;
		$p4 = $b->p4;
		$p5 = $b->p5;
		$p6 = $b->p6;
		$p7 = $b->p7;
		$p8 = $b->p8;
		$p9 = $b->p9;
		$p10 = $b->p10;
		$p11 = $b->p11;
		$p12 = $b->p12;
		$p13 = $b->p13;
		$p14 = $b->p14;
		$p15 = $b->p15;
		$p16 = $b->p16;
		$p17 = $b->p17;
		$p18 = $b->p18;
		$np = $b->nilai;
		$deskripsi = nopetik($b->deskripsi);
		$this->db->query("update `nilai` set `p1` = '$p1', `p2` = '$p2', `p3` = '$p3', `p4` = '$p4', `p5` = '$p5', `p6` = '$p6', `p7` = '$p7', `p8` = '$p8', `p9` = '$p9', `p10` = '$p10', `p11` = '$p11', `p12` = '$p12',`p13` = '$p13', `p14` = '$p14', `p15` = '$p15', `p16` = '$p16', `p17` = '$p17', `p18` = '$p18', `np` = '$np', `deskripsi`='$deskripsi' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis` = '$nis' and `mapel`='$mapel'");
	//echo $nis;
	}

	$id++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran/transfernilaipsikomotor/<?php echo $id;?>';
		},1);
			</script>
	<?php
}
else
{
	$persen = 100;
	echo $persen.'% terproses';
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran';
		},500);
			</script>
	<?php
}
?><br />
<a href="<?php echo base_url();?>pengajaran">Batal</a>
</body></html>
