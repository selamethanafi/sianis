<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:30:45 WIB 
// Nama Berkas 		: analisis.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$totalsoal = $nsoal + $nsoalb;

$tb = $this->db->query("select * from `analisis_dayabeda` where `id_mapel`='$id_mapel' and `ulangan`='$ulangan'");
if($tb->num_rows() == 0)
{
	$this->db->query("insert into `analisis_dayabeda` (`id_mapel`, `ulangan`) values ('$id_mapel', '$ulangan')");
}
$ta = $this->db->query("select * from `analisis_skor` where `id_mapel`='$id_mapel' and `itemnilai`='$ulangan'");
if($ta->num_rows() > 0)
{
	foreach($ta->result() as $a)
	{
		$dipakai = $a->dipakai;
	}
	if($dipakai == 1)
	{
		$iteme = 's'.$id;
		$skor = $a->$iteme;
	}
}
$itemanalisis = 'nilai_s'.$id;
$query = $this->db->query("select * from analisis where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and ulangan='$ulangan' and status='Y' order by $itemanalisis DESC");
$cacahsiswa = $query->num_rows();
$cacahatas = floor($cacahsiswa / 3);
$ntengah = $cacahatas + 1;
$nbawah = $cacahatas + $cacahatas + 1;
$nomor=1;
$nilaiatas = 0;
$nilaibawah = 0;
$cbawah = 0;
$catas = 0;
foreach($query->result() as $q)
{
	if($id>$nsoal)
	{
		$idne = $id - $nsoal;
		$itemanalisis = 'uraian_'.$idne;
		$nilai = $q->$itemanalisis;
	}
	else
	{
		$nilai = $q->$itemanalisis;
	}

	echo $q->nis.' '.$nilai.'<br />';
	if($nomor<=$cacahatas)
	{
		$nilaiatas = $nilaiatas + $nilai;
		$catas++;
	}
	if($nomor>=$nbawah)
	{
		$nilaibawah = $nilaibawah + $nilai;
		$cbawah++;
	}
	$nomor++;
}
$rataatas = $nilaiatas / $catas;
$ratabawah = $nilaibawah / $cbawah;
$dp = ($rataatas - $ratabawah) / $skor;
$itemanalisis = 'nilai_s'.$id;
$this->db->query("update `analisis_dayabeda` set `$itemanalisis` = '$dp' where `id_mapel`='$id_mapel' and `ulangan`='$ulangan'");
echo $totalsoal;
$id++;
if($id<=$totalsoal)
{?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>gurukeren/dayabeda/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/<?php echo $id;?>';
		},10);
			</script>
<?php
}
else
{?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/analisis/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/cetak/ya';
		},10);
			</script>
<?php
}

?>
</div></div></div>
