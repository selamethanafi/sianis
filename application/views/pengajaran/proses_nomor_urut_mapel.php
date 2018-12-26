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
	$mapel = '';
	$kelas = '';
	$no_urut = '';
$id = $id - 1;
$tahun2 = $tahun1+1;
$thnajaran = $tahun1.'/'.$tahun2;
$tc = $this->db->query("select * from `m_mapel_rapor` where `thnajaran` = '$thnajaran' and `semester`='$semester'");
$adatb = $tc->num_rows();

$tb = $this->db->query("select * from `m_mapel_rapor` where `thnajaran` = '$thnajaran' and `semester`='$semester' order by `kelas`, `no_urut` limit $id,1");
foreach($tb->result() as $b)
{
	$mapel = $b->nama_mapel_portal;
	$no_urut = $b->no_urut;
	$kelas = $b->kelas;

	if(!empty($mapel))
	{
		$this->db->query("update `nilai` set `kd_mapel` = '$no_urut' where `thnajaran` = '$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");
	}
}
$id2 = $id + 1;
if(($id <= $adatb) and ($adatb > 0))
{
	$persen = $id/$adatb * 100;
	$persen = round($persen);
	echo $id.' dari '.$adatb.' mapel ('.$persen.'%) terproses. Kelas '.$kelas.' Mapel '.$mapel.' Nomor '.$no_urut;
	$id2++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran/nomorurut/<?php echo $tahun1;?>/<?php echo $semester;?>/<?php echo $id2;?>';
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
		   window.location.href= '<?php echo base_url();?>pengajaran/leger2';
		},100);
			</script>
		<?php
}
?>
<body></html>


