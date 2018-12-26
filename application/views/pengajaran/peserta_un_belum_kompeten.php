<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: peserta_un_belum_kompeten.php
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
<div class="container-fluid">
<?php echo form_open('pengajaran/siswabelumtuntas','class="form-horizontal" role="form"');?>
	<div class="panel panel-default">
	<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="panel-body">
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="thnajaran" class="form-control">
				<?php
				echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
				foreach($daftar_tapel->result_array() as $k)
				{
					echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
				}
				?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Kelas</label></div>
			<div class="col-sm-9">
				<select name="kelas" class="form-control">
				<?php
				echo "<option value='".$kelas."'>".$kelas."</option>";
				foreach($daftar_kelas->result_array() as $ka)
				{
					echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
				}
				?>
				</select>
			</div>
		</div>
			<p class="text-center"><input type="submit" value="Proses" class="btn btn-primary"></p>

	</div></div>
</form>
<?php
if ((!empty($thnajaran)) and (!empty($kelas)))
{
$semester = 1;
// kelas XII semester 1
?>

<b>Tahun Pelajaran <?php echo $thnajaran;echo ' Semester '.$semester.'</b>';

$tahunawal = substr($thnajaran,0,4);
$tahun1 = $tahunawal - 1;
$tahun2 = $tahunawal - 2;
$tahun12 = $tahun1 + 1;
$tahun22 = $tahun2 + 1;

$thnajaran1 = ''.$tahun1.'/'.$tahun12.'';
$thnajaran2 = ''.$tahun2.'/'.$tahun22.'';
?>
<table  class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Mapel</strong></td><td><strong>Cacah Mapel Belum Kompeten</strong></td></tr>
<?php
$nomor=1;
foreach($daftar_siswa->result() as $b)
{
	echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".nis_ke_nama($b->nis)."</td>";
	$nis  = $b->nis;
	$daftar_nilai_belum_kompeten= $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and ket_akhir like 'Belum%'");
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
	


	echo '<td>'.$mapel.'</td><td>'.$k.'</td></tr>';

$nomor++;
}
// kelas XI semester 2
$thnajaran = $thnajaran1;
$semester = 2;
echo 
'</table>
<b>Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'</b>';
?>
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Mapel</strong></td><td><strong>Cacah Mapel Belum Kompeten</strong></td></tr>
<?php
$nomor=1;

foreach($daftar_siswa->result() as $b)
{
	echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".nis_ke_nama($b->nis)."</td>";
	$nis  = $b->nis;
//$daftar_nilai_belum_kompeten= $this->Pengajaran_model->Tampil_Nilai_Mapel_Belum_Kompeten($thnajaran,$semester,$nis);
	$daftar_nilai_belum_kompeten= $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and ket_akhir like 'Belum%'");
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
	


	echo '<td>'.$mapel.'</td><td>'.$k.'</td></tr>';

$nomor++;
}
echo 
'</table>';
// kelas XI semester 1
$thnajaran = $thnajaran1;
$semester = 1;
echo 
'<b>Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'</b>';
?>
<table  class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Mapel</strong></td><td><strong>Cacah Mapel Belum Kompeten</strong></td></tr>
<?php
$nomor=1;

foreach($daftar_siswa->result() as $b)
{
	echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".nis_ke_nama($b->nis)."</td>";
	$nis  = $b->nis;
	$daftar_nilai_belum_kompeten= $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and ket_akhir like 'Belum%'");
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
	


	echo '<td>'.$mapel.'</td><td>'.$k.'</td></tr>';

$nomor++;
}
echo 
'</table>';
// kelas X semester 2
$thnajaran = $thnajaran2;
$semester = 2;
echo 
'<b>Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'</b>';
?>
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Mapel</strong></td><td><strong>Cacah Mapel Belum Kompeten</strong></td></tr>
<?php
$nomor=1;
foreach($daftar_siswa->result() as $b)
{
	echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".nis_ke_nama($b->nis)."</td>";
	$nis  = $b->nis;
	$daftar_nilai_belum_kompeten= $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and ket_akhir like 'Belum%'");
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
	echo '<td>'.$mapel.'</td><td>'.$k.'</td></tr>';
$nomor++;
}
echo 
'</table>';
// kelas X semester 1
$thnajaran = $thnajaran2;
$semester = 1;
echo 
'<b>Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'</b>';
?>
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Mapel</strong></td><td><strong>Cacah Mapel Belum Kompeten</strong></td></tr>
<?php
$nomor=1;

foreach($daftar_siswa->result() as $b)
{
	$nis  = $b->nis;
	echo "<tr><td>".$nomor."</td><td>".$nis."</td><td>".nis_ke_nama($b->nis)."</td>";
	$daftar_nilai_belum_kompeten= $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and ket_akhir like 'Belum%'");
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
	echo '<td>'.$mapel.'</td><td>'.$k.'</td></tr>';

$nomor++;
}
echo 
'</table>';
}
?>
</div>
