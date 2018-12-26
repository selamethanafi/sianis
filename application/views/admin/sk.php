<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: guru.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Jum 20 Mei 2016 20:31:15 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$ta = $this->db->query("select * from `p_pegawai` where `status`='Y' and `guru`='Y'");
foreach($ta->result() as $a)
{
	$kode = $a->kode;
	$tb = $this->db->query("select * from `p_tugas_tambahan` where `thnajaran`='2014/2015' and `semester` = '2' and `kodeguru`='$kode'");
	foreach($tb->result() as $b)
	{
		$idskawal = $b->id_sk;
		$this->db->query("update `ppk_pns` set `skawal` = $idskawal where `tahun`='2015' and `kode`='$kode'");
	}
	$tc = $this->db->query("select * from `p_tugas_tambahan` where `thnajaran`='2015/2016' and `semester` = '1' and `kodeguru`='$kode'");
	foreach($tc->result() as $c)
	{
		$idskakhir = $c->id_sk;
		$this->db->query("update `ppk_pns` set `skakhir` = $idskakhir where `tahun`='2015' and `kode`='$kode'");
	}
	$this->db->query("update `ppk_pns` set `tawal` = '2015-01-02', `takhir`='2015-12-31' where `tahun`='2015' and `kode`='$kode'");
}
?>

</div></div></div>
