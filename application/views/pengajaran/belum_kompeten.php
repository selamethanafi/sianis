<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:49:28 WIB 
// Nama Berkas 		: belum_kompeten.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
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
$xloc = base_url().'pengajaran/belumkompeten';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
 <div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"> 
<select name="thnajaran" onChange="MM_jumpMenu('self',this,0)" class="form-control">
<?php
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result() as $k)
{
	echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'/'.$semester.'/'.$id_walikelas.'">'.$k->thnajaran.'</option>';
}
?>
</select></div></div>
 <div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</td></label></div><div class="col-sm-9"> 
<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1/'.$id_walikelas.'">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2/'.$id_walikelas.'">2</option>';
	?>
	</select></div></div>
 <div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</td></label></div><div class="col-sm-9"> 
<select name="id_walikelas" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$kelas.'</option>';
	foreach($daftar_walikelas->result() as $ka)
	{
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$ka->id_walikelas.'">'.$ka->kelas.'</option>';
	}
	?>
	</select></div></div>
</form>
</table>
<?php
if ((!empty($thnajaran)) and (!empty($kelas)) and (!empty($semester)))
{
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td width="200"><strong>Nama</strong></td><td><strong>Mapel</strong></td><td><strong>Cacah Mapel Belum Kompeten</strong></td></tr>
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
	$nis  = $b->nis;
	$daftar_nilai_belum_kompeten= $this->Pengajaran_model->Tampil_Nilai_Akhir_Mapel_Belum_Kompeten($thnajaran,$semester,$nis);
	$mapel = '';
	$k=0;
	foreach($daftar_nilai_belum_kompeten->result() as $bc)
		{
		if (empty($mapel))
			{
			$mapel .= $bc->mapel;
			}
			else
			{
			$mapel .= ", ".$bc->mapel;
			}

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
	if($k>3)
	{
		echo "<tr class=\"table-danger\"><td>".$nomor."</td><td>".$b->nis."</td><td>".nis_ke_nama($b->nis)."</td>";	
		echo '<td>'.$mapel.'</td><td align="center">'.$k.'</td></tr>';
	}
	else
	{
		echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".nis_ke_nama($b->nis)."</td>";	
		echo '<td>'.$mapel.'</td><td align="center">'.$k.'</td></tr>';
	}


$nomor++;
}
echo 
'</table><br><br><strong>
Rangkuman</strong>

<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Cacah Mapel Belum Kompeten</strong></td><td><strong>Cacah Siswa</strong></td></tr>
<tr><td align="center">1</td><td align="center">0</td><td align="center"><strong>'.$k0.' </strong></td></tr>
<tr><td align="center">2</td><td align="center">1</td><td align="center"><strong>'.$k1.' </strong></td></tr>
<tr><td align="center">3</td><td align="center">2</td><td align="center"><strong>'.$k2.' </strong></td></tr>
<tr><td align="center">4</td><td align="center">3</td><td align="center"><strong>'.$k3.' </strong></td></tr>
<tr><td align="center">5</td><td align="center">4</td><td align="center"><strong>'.$k4.' </strong></td></tr>
<tr><td align="center">6</td><td align="center">5</td><td align="center"><strong>'.$k5.' </strong></td></tr>
<tr><td align="center">7</td><td align="center">6</td><td align="center"><strong>'.$k6.' </strong></td></tr>
<tr><td align="center">8</td><td align="center">7</td><td align="center"><strong>'.$k7.' </strong></td></tr>
<tr><td align="center">9</td><td align="center">8</td><td align="center"><strong>'.$k8.' </strong></td></tr>
<tr><td align="center">10</td><td align="center">9</td><td align="center"><strong>'.$k9.' </strong></td></tr>
<tr><td align="center">11</td><td align="center">> 9</td><td align="center"><strong>'.$k10.' </strong></td></tr>
</table>';
}
?>
</div></div></div>
