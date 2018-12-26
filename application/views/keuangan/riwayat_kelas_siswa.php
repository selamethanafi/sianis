<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : set.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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

<?php
$xloc = base_url().'keuangan/buatsiswakelas';
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
?>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
<?php
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result() as $a)
{
	echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'">'.$a->thnajaran.'</option>';
}
?>
</select></div></div></form>
<?php
if(!empty($thnajaran))
{
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran'");
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		$kelas = $a->kelas;
		//cari di riwayat
		$tb = $this->db->query("select * from `siswa_kelas_tahun` where `thnajaran`='$thnajaran' and `nis`='$nis'");
		$adatb = $tb->num_rows();
		if($adatb == 0)
		{
			$this->db->query("insert into `siswa_kelas_tahun` (`thnajaran`,`nis`,`kelas`) values ('$thnajaran', '$nis', '$kelas')");
		}
	}
	echo '<div class="alert alert-success">Selesai</div>';
}
?>
</div></div></div>
