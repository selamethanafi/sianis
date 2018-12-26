<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: afektif.php
// Terakhir diperbarui	: Sel 26 Jan 2016 08:08:54 WIB 
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
<div class="container-fluid">
<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td></td><td><strong>Parameter</strong></td><td><strong>Nilai</strong></td></tr>
<?php
$nomor=$page+1;

if(count($query->result())>0){
foreach($query->result() as $t)
{
	$thnajaran=$t->thnajaran; 
	$semester=$t->semester;
	$kelas=$t->kelas;
	$mapel=$t->mapel;
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	if(($kurikulum == '2013') or ($kurikulum == 'KTSP'))
	{
		if ($t->semester=='1')
		{
			$semestere = 'Gasal';
		}
		else
		{
		$semestere = 'Genap';
		}
		//cek ada aspek 
		$tap = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		$cap = 0;
		foreach($tap->result() as $dap)
		{
			$cap = $dap->np;
		}
		echo "<tr><td align='center'>".$nomor."</td><td>".$kelas."</td><td>".$mapel."</td><td>".$thnajaran."</td><td align=center>".$semester."</td><td align=center><a href='".base_url()."guru/aspekafektif/".$t->id_mapel."' title='Kriteria penilaian afektif kelas ".$kelas." mapel ".$mapel." tahun ".$thnajaran." semester ".$semestere."'><span class='fa fa-edit'></span></a></td>";
		echo "<td align=center>";
		if ($cap>0)
		{
			echo "<a href='".base_url()."guru/daftarnilaiafektif/".$t->id_mapel."' title='Lihat / Ubah Daftar Nilai Psikomotor ".$t->kelas."  Semester $semestere'><span class='fa fa-bullseye'></span></a>";
		}
		echo "</td></tr>";
		$nomor++;
	}
}
}
else{
echo "<tr><td colspan='8'><div class='alert alert-warning'>Peringatan! Belum ada data Mata Pelajaran Semester Ini, silakan hubungi Admin atau Pengajaran atau ubah ranah penilaian</div></td></tr>";
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
</div></div></div>
