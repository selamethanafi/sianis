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
$ta = $this->db->query("select * from `aspek_afektif_old` order by `id_aspek_afektif`");
$adata = $ta->num_rows();
$ta = $this->db->query("select * from `aspek_afektif_old` order by `id_aspek_afektif` limit $id,1");
foreach($ta->result() as $a)
{
	$thnajaran = $a->thnajaran;
	$semester = $a->semester;
	$mapel = $a->mapel;
	$kelas = $a->kelas;
	$p1 = $a->p1;
	$p2 = $a->p2;
	$p3 = $a->p3;
	$p4 = $a->p4;
	$p5 = $a->p5;
	$p6 = $a->p6;
	$p7 = $a->p7;
	$p8 = $a->p8;
	$p9 = $a->p9;
	$p10 = $a->p10;
	$p11 = $a->p11;
	$p12 = $a->p12;
	$p13 = $a->p13;
	$p14 = $a->p14;
	$p15 = $a->p15;
	$ns = $a->np;
	$this->db->query("update `m_mapel` set `s1` = '$p1', `s2` = '$p2', `s3` = '$p3', `s4` = '$p4', `s5` = '$p5', `s6` = '$p6', `s7` = '$p7', `s8` = '$p8', `s9` = '$p9', `s10` = '$p10' , `s11` = '$p11' , `s12` = '$p12' , `s13` = '$p13' , `s14` = '$p14' , `s15` = '$p15', `ns`='$ns' where `thnajaran` = '$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");
}
$id2 = $id + 1;
if(($id <= $adata) and ($adata > 0))
{
	$persen = $id/$adata * 100;
	$persen = round($persen);
	echo $id.' dari '.$adata.' mapel ('.$persen.'%) terproses. '.$thnajaran.' '.$semester.' Kelas '.$kelas.' Mapel '.$mapel;
	$id2++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>admin/pindahaspekafektif/<?php echo $id2;?>';
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


