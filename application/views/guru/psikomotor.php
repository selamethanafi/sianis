<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: psikomotor.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 11 Mei 2016 20:46:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

<div class="table-responsive">
<table class="table table-hover table-bordered"><thead>
<tr align="center"><td><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Parameter / KD</strong></td><td><strong>Nilai</strong></td></tr></thead>
<?php
$nomor=$page+1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
$thnajaran=$t->thnajaran; 
$semester=$t->semester;
$kelas=$t->kelas;
$mapel=$t->mapel;
if ($t->semester=='1')
	{
	$semestere = 'Gasal';
	}
	else
	{
	$semestere = 'Genap';
	}


//cek ada aspek 
$tap = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `kodeguru`='$nim'");
$cap =0;
foreach($tap->result() as $dap)
	{
	$cap = $dap->np;
	}

echo "<tr><td align='center'>".$nomor."</td><td>".$kelas."</td><td>".$mapel."</td><td>".$thnajaran."</td><td align=center>".$semester."</td><td align=center>";
if (($t->ranah=='KPA') or ($t->ranah=='PA') or ($t->ranah=='KP'))
	{
	echo "<a href='".base_url()."guru/aspekpsikomotor/".$t->id_mapel."' title='Macam penilaian psikomotor'><span class='fa fa-edit'></span></a>";
	}
echo "</td>";
echo "<td align=center>";
	if ($cap>0)
	{
		$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
		if (($t->ranah=='KPA') or ($t->ranah=='PA') or ($t->ranah=='KP'))
		{
			echo "<a href='".base_url()."guru/daftarnilaipsikomotor/".$t->id_mapel."' title='Lihat / Ubah Daftar Nilai Psikomotor ".$t->kelas."  Semester $semestere'><span class='fa fa-bullseye'></span></a>";
		
		}
		echo "</td>";
	}
echo "</tr>";
$nomor++;
}
}
else{
echo "<tr><td colspan='8'><div class='alert alert-info'>Belum ada data Mata Pelajaran, silakan hubungi Admin atau Pengajaran</div></td></tr>";
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>

</div></div>
</div>


