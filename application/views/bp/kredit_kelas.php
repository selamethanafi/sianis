<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 16:13:10 WIB 
// Nama Berkas 		: kredit_siswa.php
// Lokasi      		: application/views/bp/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<?php
if($this->config->item('sms') != 1)
{
	if(empty($id_kelas))
	{
		$this->db->query("delete from siswa_kredit_total");
		$tx = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester'");
		foreach($tx->result() as $dx)
		{	
			$nis = $dx->nis;
			// hitung
			$ty = $this->db->query("select * from siswa_kredit where thnajaran = '$thnajaran' and nis='$nis'");
			$nilai =0;
			foreach($ty->result() as $dy)
			{
				$nilai = $nilai+$dy->point;
			}
			// masukkan ke siswa kredit toal
			if ($nilai>0)
			{
				$this->db->query("INSERT INTO `siswa_kredit_total` (`nis`, `nilai`) VALUES ('$nis', '$nilai')");
			}
		}
	}
}
$xloc = base_url().'bp/kreditperkelas';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php

echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$id_kelas.'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\"  class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$id_kelas.'">'.$semester.'</option>';
	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
	}
	echo '<option value="'.$xloc.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select></div></div>';
	$kelas = $kelasxx;
echo '</div></div></form>';
if(!empty($kelas))
{
	$nomor = 1;
	$ta = $this->Bp_model->Tampil_Siswa_Kelas($thnajaran,$semester,$kelas)
	?>
	<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
		<tr><td>Nomor</td><td>NIS</td><td>Nama</td><td>Jumlah Kredit</td></tr>
		<?php
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			$kredit = '';
			$tb = $this->db->query("select * from `siswa_kredit_total` where `nis`='$nis'");
			foreach($tb->result() as $b)
			{

				$kredit = $b->nilai;
			}
			$jumlahkredit = $kredit;
			if($kredit>=25)
			{
				$jumlahkredit = '<div class="alert alert-info text-center">'.$kredit.'</div>';
			}

			echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.nis_ke_nama($nis).'</td><td>'.$jumlahkredit.'</td></tr>';
			$nomor++;
		}
		?>
		</table>
	</div>
	<?php
}
?>

</div></div></div>
