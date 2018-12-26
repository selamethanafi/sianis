<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: form_mencetak.php
// Lokasi      		: application/views/shared/
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$dapatdiakses = 0;
$cacahperangkat = 0;
$nomor = 0;
//echo 'tanggal '.$tanggalsupervisi;
//echo $status;
$skor2=0;
$skor = 0;
if($status =="Pengawas")
{
		$dapatdiakses = 1;
}
elseif($status =="Kepala")
{
	$dapatdiakses = 1;
}
else
{
	echo "Galat, Anda tidak mempunyai wewenang mengakses halaman ini";
}
if ($dapatdiakses == 1)
{
	$xloc = base_url().strtolower($status).'/supervisimengajar';
	echo '<a href="'.$xloc.'">Kembali</a>';
	echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">'.$thnajaran.'</div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">'.$semester.'</div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Guru</label></div><div class="col-sm-9">';
	echo "<select name=\"kodeguru\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		$tbx = $this->db->query("select * from `p_pegawai` where `kd`='$kodeguru'");
		foreach($tbx->result() as $bx)
		{
			echo '<option value="'.$xloc.'/'.$kodeguru.'">'.$bx->nama_tanpa_gelar.' ('.$bx->nama.')</option>';
		}
		$tb = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y' order by nama_tanpa_gelar");
		echo '<option value=""></option>';
		foreach($tb->result() as $b)
			{
			echo '<option value="'.$xloc.'/'.$b->kd.'">'.$b->nama_tanpa_gelar.' ('.$b->nama.')</option>';
			}
		echo '</select></div></div>';
	echo '</form>';
	if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kodeguru)))
	{
		if($status =="Pengawas")
		{ echo form_open('pengawas/supervisimengajar/'.$kodeguru);
		}
		if($status =="Kepala")
		{ echo form_open('kepala/supervisimengajar/'.$kodeguru);
		}
		echo '<table class="table table-striped table-bordered table-bordered">';
		$ta = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` order by `nomor`");
		foreach($ta->result() as $a)
		{
			//cari nilai kalau ada
			$nomor = $a->nomor;
			$tb = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' and `supervisor`='$status' and `nomor_perangkat`='$nomor'");
			if ($tb->num_rows() == 0)
			{
				$this->db->query("insert into `supervisi_mengajar_nilai` (`thnajaran`,`semester`,`kodeguru`,`nomor_perangkat`,`supervisor`,`skor`) value ('$thnajaran','$semester','$kodeguru','$nomor','$status','3')");
			}
		}
		echo '<tr align="center"><td rowspan="2" width="5%">No</td><td rowspan="2" width="55%">Aspek yang diamati</td><td>Tidak ada</td><td>Kurang Lengkap</td><td>Lengkap</td><td>Sangat Lengkap</td></tr><tr align="center"><td  width="10%">1</td><td width="10%">2</td><td width="10%">3</td><td width="10%">4</td></tr>';
		$ta = $this->db->query("select * from `m_instrumen_supervisi_mengajar` order by `nomor`");
		foreach($ta->result() as $a)
		{
			//cari nilai kalau ada
			$nomor = $a->nomor;
			$tb = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$kodeguru' and `supervisor`='$status'");
			$skor = 0;
			foreach($tb->result() as $b)
			{
				$skor = $b->skor;
				$kd = $b->id_supervisi_mengajar_nilai;
			}
			if($nomor == 1)
			{
				echo '<tr><td valign="top">I</td><td><strong>PENDAHULUAN</strong></td></tr>';
			}
			if($nomor == 5)
			{
				echo '<tr><td valign="top">II</td><td><strong>PENGEMBANGAN UNSUR MATERI</strong></td></tr>';
			}
			if($nomor == 10)
			{
				echo '<tr><td valign="top">III</td><td><strong>UNSUR PEMBELAJARAN</strong></td></tr>';
			}
			if($nomor == 18)
			{
				echo '<tr><td valign="top">IV</td><td><strong>UNSUR PENILAIAN</strong></td></tr>';
			}
			if($nomor == 22)
			{
				echo '<tr><td valign="top">V</td><td><strong>PENAMPILAN</strong></td></tr>';
			}
			if($nomor == 25)
			{
				echo '<tr><td valign="top">VI</td><td><strong>PENUTUP</strong></td></tr>';
			}

			echo '<tr><td valign="top">'.$nomor.'</td><td>'.$a->instrumen.'</td>';
			if ($skor == 0)
			{
				echo '<td align="center"><input type="radio" name="item_'.$nomor.'" value="0" checked></td>';
			}
			else
			{
				echo '<td align="center"><input type="radio" name="item_'.$nomor.'" value="0"></td>';
			}
			if ($skor == 1)
			{
				echo '<td align="center"><input type="radio" name="item_'.$nomor.'" value="1" checked></td>';
			}
			else
			{
				echo '<td align="center"><input type="radio" name="item_'.$nomor.'" value="1"></td>';
			}
			if ($skor == 2)
			{
				echo '<td align="center"><input type="radio" name="item_'.$nomor.'" value="2" checked></td>';
			}
			else
			{
				echo '<td align="center"><input type="radio" name="item_'.$nomor.'" value="2"></td>';
			}
			if ($skor == 3)
			{
				echo '<td align="center"><input type="radio" name="item_'.$nomor.'" value="3" checked></td>';
			}
			else
			{
				echo '<td align="center"><input type="radio" name="item_'.$nomor.'" value="3"></td>';
			}
			echo '<input type="hidden" name="kd_'.$nomor.'" value="'.$kd.'"></td></tr>';
		}
		$cacahperangkat = $nomor;
		$td = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' and `supervisor`='$status'");
		$skor = 0;
		foreach($td->result() as $d)
		{
			$skor = $skor+$d->skor;
		}
		$skor1 = $skor;
		echo '<tr><td valign="middle" colspan="5">Total Skor</td><td align="center"><h1>'.$skor.'</h1></td></tr>';
		echo '<tr><td valign="middle" colspan="5">Nilai Kinerja</td><td align="center">';
		$nilaikinerja = round($skor/81*100,2);
		//echo ''.$nilaikinerja.'%</td></tr>';
		$nilaikinerja = round($nilaikinerja,0);
		if($nilaikinerja >=91)
		{
		$predikat = '<div class="alert alert-warning"><h1>Amat Baik</h1></div>';
		}
		elseif($nilaikinerja>=76)
		{
		$predikat = '<div class="alert alert-success"><h1>Baik</h1></div>';
		}
		elseif($nilaikinerja>=56)
		{
		$predikat = '<div class="alert alert-danger"><h1>Cukup</h1></div>';
		}
		else
		{
		$predikat = '<div class="alert alert-danger"><h1>Kurang</h1></div>';
		}
		echo '<h1>'.$nilaikinerja.'</h1></td></tr><tr><td valign="middle" colspan="5">Predikat</td><td>'.$predikat.'</td></tr></table>';
		echo '</table></div><p class="text-center"><input type="hidden" name="cacahperangkat" value="'.$cacahperangkat.'">';
		echo '<input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().''.strtolower($status).'/supervisimengajar" class="btn btn-info">Kembali</a></p>';
	echo '</form>';
	}
}
else
{
	echo 'Tidak berhak';
}
?>
</div></div></div>
