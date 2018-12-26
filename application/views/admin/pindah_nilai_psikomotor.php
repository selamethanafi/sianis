<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_per_ruang.php
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
<!DOCTYPE html>
<body>
<?php
$id = $id - 1;
$ta = $this->db->query("select * from `psikomoto rik` where `thnajaran`='2017/2018' order by `id_psikomotor` ");
$adata = $ta->num_rows();
$ta = $this->db->query("select * from `psikomotorik` where `thnajaran`='2017/2018' order by `id_psikomotor`  limit $id,1");
foreach($ta->result() as $a)
{
	$thnajaran= hilangkanpetik($a->thnajaran);
	$semester= hilangkanpetik($a->semester);
	$mapel= hilangkanpetik($a->mapel);
	$kelas= hilangkanpetik($a->kelas);
	$nis = hilangkanpetik($a->nis);
	$p1= hilangkanpetik($a->p1);
	$p2= hilangkanpetik($a->p2);
	$p3= hilangkanpetik($a->p3);
	$p4= hilangkanpetik($a->p4);
	$p5= hilangkanpetik($a->p5);
	$p6= hilangkanpetik($a->p6);
	$p7= hilangkanpetik($a->p7);
	$p8= hilangkanpetik($a->p8);
	$p9= hilangkanpetik($a->p9);
	$p10= hilangkanpetik($a->p10);
	$p11= hilangkanpetik($a->p11);
	$p12= hilangkanpetik($a->p12);
	$p13= hilangkanpetik($a->p13);
	$p14= hilangkanpetik($a->p14);
	$p15= hilangkanpetik($a->p15);
	$p16= hilangkanpetik($a->p16);
	$p17= hilangkanpetik($a->p17);
	$p18= hilangkanpetik($a->p18);
	$this->db->query("update `nilai` set `p1` = '$p1', `p2` = '$p2', `p3` = '$p3', `p4` = '$p4', `p5` = '$p5', `p6` = '$p6', `p7` = '$p7', `p8` = '$p8', `p9` = '$p9', `p10` = '$p10' , `p11` = '$p11' , `p12` = '$p12' , `p13` = '$p13' , `p14` = '$p14' , `p15` = '$p15', `p16` = '$p16', `p17`='$p17', `p18`='$p18' where `thnajaran` = '$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `nis`='$nis'");
}
$id2 = $id + 1;
if(($id <= $adata) and ($adata > 0))
{
	$persen = $id/$adata * 100;
	$persen = round($persen,3);
	echo $id.' dari '.$adata.' mapel ('.$persen.'%) terproses. '.$thnajaran.' '.$semester.' Kelas '.$kelas.' Mapel '.$mapel;
	$id2++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>admin/pindahnilaipsikomotor/<?php echo $id2;?>';
	},1);
			</script>
	<?php
}
else
{
	$persen = 100;
	echo $persen.'% terproses';
	?>
	<h3>tunggu sampai berpindah halaman</h3>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>admin';
		},100);
			</script>
		<?php
}
?>
<body></html>


