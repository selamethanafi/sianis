<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: belum_kompeten.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
<p><?php echo '<a href="'.base_url().'guru/walikelas" class="btn btn-info"><b>Kembali ke daftar Tugas Walikelas</b></a></p>';?>

<table>
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></td></tr>
</table>

<?php
if ((!empty($thnajaran)) and (!empty($kelas)) and (!empty($semester)))
{
?>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Mapel</strong></td><td width="30"><strong>K</strong></td></tr>
<?php
$nomor=1;
	$k1=0;
	$k2=0;
	$k3=0;
	$k4=0;
	$k5=0;
	$k6=0;
	$k7=0;
	$k8=0;
	$k9=0;
	$k0=0;
	$k10=0;

foreach($daftar_siswa->result() as $b)
{
	echo "<tr><td>".$nomor."</td><td>".nis_ke_nama($b->nis)."</td>";
	$nis  = $b->nis;
$daftar_nilai_belum_kompeten= $this->Guru_model->Tampil_Nilai_Mapel_Belum_Kompeten($thnajaran,$semester,$nis);
	$mapel = '';
	$k=0;
	foreach($daftar_nilai_belum_kompeten->result() as $bc)
		{
		$mapel .= $bc->mapel.", ";
		$k++;
		}
	if ($k==0)
		{
		$k0++;
		}	
	if ($k==1)
		{
		$k1++;
		}	
	if ($k==2)
		{
		$k2++;
		}	
	if ($k==3)
		{
		$k3++;
		}	
	if ($k==4)
		{
		$k4++;
		}	
	if ($k==5)
		{
		$k5++;
		}	
	if ($k==6)
		{
		$k6++;
		}	
	if ($k==7)
		{
		$k7++;
		}	
	if ($k==8)
		{
		$k8++;
		}	
	if ($k==9)
		{
		$k9++;
		}	
	if ($k>9)
		{
		$k10++;
		}	


	echo '<td>'.$mapel.'</td><td align="center">'.$k.'</td></tr>';

$nomor++;
}
echo 
'</table></div>
<h2>Rangkuman</h2>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>K</strong></td><td><strong>Cacah Siswa</strong></td></tr>';
$nomor = 1;
for($i=0;$i<10;$i++)
{
	
	$kne = 'k'.$i;
	echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$i.'</td><td align="center"><strong>'.$$kne.' </td></tr>';
	$nomor++;
}
	echo '</table>';
}
?>
</div></div></div>
