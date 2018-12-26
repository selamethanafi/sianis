<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: akhlak.php
// Terakhir diperbarui	: Kam 12 Mei 2016 07:34:24 WIB 
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
<?php
$adadata = count($query->result());
?>
<div class="container-fluid"><div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<div class="alert alert-info"><strong>Info.</strong> Bila belum terdapat data penilaian akhlak mulia, silakan hubungi BP atau mungkin data terdapat di halaman<a href="<?php echo base_url();?>guru/nilaiakhlakk13" class="btn btn-success">I N I</a></div>
<?php
$nomor=$page+1;
if($adadata>0){
?>
<div class="table-responsive">
<table class="table table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Nilai</strong></td></tr>
<?php
foreach($query->result() as $t)
{
$thnajaran=$t->thnajaran; 
$semester=$t->semester;
$kelas=$t->kelas;
if ($t->semester=='1')
	{
	$semestere = 'Gasal';
	}
	else
	{
	$semestere = 'Genap';
	}
echo "<tr><td align='center'>".$nomor."</td><td>".$kelas."</td><td>".$thnajaran."</td><td align=center>".$semester."</td>";
echo "<td align=\"center\"><a href='".base_url()."guru/daftarnilaiakhlak/".$t->id_m_akhlak."' title='Lihat Daftar Nilai Akhlak Kelas $kelas tahun $thnajaran Semester $semestere'><span class='fa fa-bullseye'></span></a></td></tr>";
$nomor++;
}
echo '</table></div>';
}
else{
echo '<div class="alert alert-danger">Belum ada data penilaian akhlak mulia, silakan hubungi BP</div>';
}
?>

<?php
if (!empty($paginator))
	{
	?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>
</div></div>
</div>
