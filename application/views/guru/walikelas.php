<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: walikelas.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//               	  selamethanafi@yahoo.co.id
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
<div class="container-fluid"><div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>Tahun Pelajaran</strong></td><td rowspan="2"><strong>Semester</strong></td><td rowspan="2"><strong>Kelas</strong></td><td rowspan="2"><strong>Kurikulum</strong></td><td colspan="2"><strong>Nilai Terkunci</strong></td><td rowspan="2"><strong>Akhlak Mulia / Sikap Spiritual dan Sosial</strong></td><td rowspan="2"><strong>Daftar Siswa</strong></td><td rowspan="2"><strong>Ketercapaian KKM</strong></td><td rowspan="2"><strong>Tanggapan Walikelas</strong></td><td rowspan="2"><strong>Kirim ke ARD</strong></td></tr><tr><td>Persentase</td><td>Buka Kunci</td></tr>
<?php
$nomor=$page+1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
if ($t->semester=='1')
	{
	$semestere = 'Gasal';
	}
	else
	{
	$semestere = 'Genap';
	}


echo "<tr><td align='center'>".$nomor."</td><td align='center'>".$t->thnajaran."</td><td align=center>".$t->semester."</td><td align='center'>".$t->kelas."</td><td align='center'>".$t->kurikulum."</td><td align=\"center\"> <a href='".base_url()."guru/daftarsiswa/".$t->id_walikelas."/kunci' title='Kunci Nilai Mata Pelajaran ".$t->kelas." tahun ".$t->thnajaran." semester ".$t->semester."'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"> <a href='".base_url()."walikelas/bukakunci/".$t->id_walikelas."' title='Buka Kunci Nilai Mata Pelajaran ".$t->kelas." tahun ".$t->thnajaran." semester ".$t->semester."'><span class=\"fa fa-edit\"></span></a></td><td align='center'>";
if(($t->kurikulum == '2013') or ($t->kurikulum == '2015') or ($t->kurikulum == '2018'))
	{
	echo "<a href='".base_url()."guru/daftarsiswa/".$t->id_walikelas."/spiritual/hitung' title='Proses Sikap Spiritual dan Sosial ".$t->kelas." tahun ".$t->thnajaran." semester ".$t->semester."'><span class=\"fa fa-edit\"></span></a></td>";
	}

echo "<td align='center'><a href='".base_url()."guru/daftarsiswa/".$t->id_walikelas."' title='Daftar Siswa Kelas ".$t->kelas." tahun ".$t->thnajaran." semester ".$t->semester."'><span class=\"fa fa-edit\"></span></a></td><td align='center'><a href='".base_url()."guru/ketercapaiankkm/".$t->id_walikelas."' title='Daftar Ketercapaian KKM \nSiswa Kelas ".$t->kelas." tahun ".$t->thnajaran." semester ".$t->semester."'><span class=\"fa fa-edit\"></span></a></td><td align='center'>";
if(($t->kurikulum == '2015') or ($t->kurikulum == '2018'))
	{
		echo "<a href='".base_url()."guru/tanggapanwalikelas/".$t->id_walikelas."' title='Tanggapan Wali \nKelas ".$t->kelas." tahun ".$t->thnajaran." semester ".$t->semester."'><span class=\"fa fa-edit\"></span></a>";
	}
echo "</td><td align='center'>";
	echo "<a href='".base_url()."guruard/ard/tanggapanwalikelas/".$t->id_walikelas."' title='Kirim ke ARD \nKelas ".$t->kelas." tahun ".$t->thnajaran." semester ".$t->semester."'><span class=\"fa fa-upload\"></span></a>";
echo "</td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Belum ada Walikelas, silakan hubungi Admin atau Pengajaran</td></tr>";
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

