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
	$xloc = base_url().strtolower($status).'/supervisi';
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
		{ echo form_open('pengawas/supervisi/'.$kodeguru);
		}
		if($status =="Kepala")
		{ echo form_open('kepala/supervisi/'.$kodeguru);
		}
		$ta = $this->db->query("select * from `m_macam_perangkat_k13` where `tipe`='guru' order by `nomor`");
		foreach($ta->result() as $a)
		{
			//cari nilai kalau ada
			$nomor = $a->nomor;
			$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' and `oleh`='$status' and `nomor_perangkat`='$nomor'");
			if ($tb->num_rows() == 0)
			{
				$this->db->query("insert into `supervisi_nilai` (`thnajaran`, `semester`, `kodeguru`, `nomor_perangkat`, `oleh`, `tipe`,`skor`) value ('$thnajaran','$semester','$kodeguru','$nomor','$status', 'guru','3')");
			}

		}

		echo '<table class="table table-striped table-bordered table-bordered">';
		echo '<tr align="center"><td rowspan="2" width="5%">No</td><td rowspan="2" width="55%">Aspek yang diamati</td><td>Tidak ada</td><td>Kurang Lengkap</td><td>Lengkap</td><td>Sangat Lengkap</td></tr><tr align="center"><td  width="10%">1</td><td width="10%">2</td><td width="10%">3</td><td width="10%">4</td></tr>';
		echo '<tr><td colspan="2">Perangkat Administrasi Guru</td></tr>';
		$ta = $this->db->query("select * from `m_macam_perangkat_k13` where `tipe`='guru' order by `nomor`");

		foreach($ta->result() as $a)
		{
			//cari nilai kalau ada
			$nomor = $a->nomor;
			$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$kodeguru'");
			$skor = 0;
			foreach($tb->result() as $b)
			{
				$skor = $b->skor;
				$kd = $b->id_supervisi_nilai;
			}
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->perangkat.'</td>';
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
		$td = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
		$skor = 0;
		foreach($td->result() as $d)
		{
			$skor = $skor+$d->skor;
		}
		$skor1 = $skor;
		echo '<tr><td valign="middle" colspan="2">Total Skor</td><td colspan="4">';
		echo ''.$skor.'</td></tr>';
		echo '<tr><td valign="middle" colspan="2">Nilai Kinerja</td><td colspan="4">';
		$nilaikinerja = round($skor/87*100,2);
		echo ''.$nilaikinerja.'%</td></tr>';
		echo '<tr><td valign="middle" colspan="2">Nilai Administrasi Guru</td><td colspan="4">';
		$nilaikinerja = round($skor/87*100,0);
		if($nilaikinerja >=91)
		{
			$predikat = "Amat Baik";
		}
		elseif($nilaikinerja>=76)
		{
			$predikat = "Baik";
		}
		elseif($nilaikinerja>=56)
		{
			$predikat = "Cukup";
		}
		else
		{
			$predikat ="Kurang";
		}
		echo ''.$nilaikinerja.'&nbsp;&nbsp;<strong>'.$predikat.'</strong></td></tr></table>';
		//tugas tambahan
		$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
		$tambahan = '';
		$jtmtambahan = 0;
		foreach ($ttambahan->result() as $dtambahan)
		{
			$tambahan = $dtambahan->nama_tugas;
			$jtmtambahan = $dtambahan->jtm;
		}
		if($jtmtambahan==0)
		{
			$this->db->query("delete from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' and `oleh`='$status'");
		}
		if($jtmtambahan>0)
		{
			echo '<table><tr><td colspan="2">Perangkat Administrasi Tugas Tambahan '.$tambahan.'</td></tr>';
			$ta = $this->db->query("select * from `m_macam_perangkat_k13` where `tipe`='tambahan' order by `nomor`");
			foreach($ta->result() as $a)
			{
				//cari nilai kalau ada
				$nomor = $a->nomor;
				$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' and `oleh`='$status' and `nomor_perangkat`='$nomor'");
				if ($tb->num_rows() == 0)
				{
					$this->db->query("insert into `supervisi_nilai` (`thnajaran`,`semester`,`kodeguru`,`nomor_perangkat`,`oleh`, `tipe`,`skor`) value ('$thnajaran','$semester','$kodeguru','$nomor','$status','tambahan','3')");
				}
			}
			$ta = $this->db->query("select * from `m_macam_perangkat_k13` where `tipe`='tambahan' order by `nomor`");
			foreach($ta->result() as $a)
			{
				//cari nilai kalau ada
				$nomor = $a->nomor;
				$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$kodeguru'");
				foreach($tb->result() as $b)
				{
					$skor = $b->skor;
					$kd = $b->id_supervisi_nilai;
				}
				echo '<tr><td width="400" valign="top">'.$a->perangkat.'<input type="hidden" name="kd_tambahan_'.$nomor.'" value="'.$kd.'"></td>';
				if ($skor == 0)
				{
					echo '<td align="center"><input type="radio" name="tambahan_'.$nomor.'" value="0" checked></td>';
				}
				else
				{
					echo '<td align="center"><input type="radio" name="tambahan_'.$nomor.'" value="0"></td>';
				}
				if ($skor == 1)
				{
					echo '<td align="center"><input type="radio" name="tambahan_'.$nomor.'" value="1" checked></td>';
				}
				else
				{
					echo '<td align="center"><input type="radio" name="tambahan_'.$nomor.'" value="1"></td>';
				}
				if ($skor == 2)
				{
					echo '<td align="center"><input type="radio" name="tambahan_'.$nomor.'" value="2" checked></td>';
				}
				else
				{
					echo '<td align="center"><input type="radio" name="tambahan_'.$nomor.'" value="2"></td>';
				}
				if ($skor == 3)
				{
					echo '<td align="center"><input type="radio" name="tambahan_'.$nomor.'" value="3" checked></td>';
				}
				else
				{
					echo '<td align="center"><input type="radio" name="tambahan_'.$nomor.'" value="3"></td>';
				}
				echo '</tr>';
			}
			$td = $this->db->query("select * from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
			foreach($td->result() as $d)
			{
				$skor2 = $skor2+$d->skor;
			}
			echo '<tr><td valign="middle">Total Skor</td><td>';
			echo ''.$skor2.'</td></tr>';
			echo '<tr><td valign="middle">Nilai Kinerja</td><td>';
			$nilaikinerja2 = round($skor2/18*100,2);
			echo ''.$nilaikinerja2.'%</td></tr>';
			echo '<tr><td valign="middle">Nilai Administrasi Guru Tambahan</td><td>';
			$nilaikinerja2 = round($skor2/18*100,0);
			if($nilaikinerja2 >=91)
			{
				$predikat = "Amat Baik";
			}
			elseif($nilaikinerja2>=76)
			{
				$predikat = "Baik";
			}
			elseif($nilaikinerja2>=56)
			{
				$predikat = "Cukup";
			}
			else
			{
				$predikat ="Kurang";
			}
			echo ''.$nilaikinerja2.'&nbsp;&nbsp;<strong>'.$predikat.'</strong></td></tr>';
		}
		if($jtmtambahan>0)
		{
			$total = $skor1 + $skor2;
		}
		else
		{
			$total = $skor1;
		}
		if($jtmtambahan>0)
		{
			echo '<tr><td valign="middle">Nilai Administrasi Guru dan Guru Tugas Tambahan</td><td>';
			$total = round($total/102*100,0);
			if($total >=91)
			{
				$predikat = "Amat Baik";
			}
			elseif($total>=76)
			{
				$predikat = "Baik";
			}
			elseif($total>=56)
			{
				$predikat = "Cukup";
			}
			else
			{
				$predikat ="Kurang";
			}
			$cacahtambahan  = $nomor;
			echo ''.$total.'&nbsp;&nbsp;<strong>'.$predikat.'</strong><input type="hidden" name="cacahtambahan" value="'.$cacahtambahan.'"></td></tr>';
		}
		echo '</table></div><center><input type="hidden" name="cacahperangkat" value="'.$cacahperangkat.'">';
		echo '<input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().''.strtolower($status).'/supervisi" class="btn btn-info">Kembali</a></p>';
		echo '</form>';
	}
}
else
{
	echo 'Tidak berhak';
}
?>
</div></div></div>
