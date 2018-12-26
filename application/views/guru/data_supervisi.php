<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
// Lokasi      		: application/views/guru/
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
<?php $fontsize = $this->config->item('fontsize_rapor');?>
<?php
if($aksi == 'nilai')
{?>
	<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3>Penilaian Supervisi Mengajar</h3></div>
	<div class="card-body">
	<?php
		echo form_open('perangkat/supervisimengajarnilai/'.$thnajaran.'/'.$semester.'/'.$supervisor);
		echo '<table class="table table-striped table-bordered table-bordered">';
		$ta = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` order by `nomor`");
		foreach($ta->result() as $a)
		{
			//cari nilai kalau ada
			$nomor = $a->nomor;
			$tb = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim' and `supervisor`='$supervisor' and `nomor_perangkat`='$nomor'");
			if ($tb->num_rows() == 0)
			{
				$this->db->query("insert into `supervisi_mengajar_nilai` (`thnajaran`,`semester`,`kodeguru`,`nomor_perangkat`,`supervisor`,`skor`) value ('$thnajaran','$semester','$nim','$nomor','$supervisor','3')");
			}
		}
		echo '<tr align="center"><td rowspan="2" width="5%">No</td><td rowspan="2" width="55%">Aspek yang diamati</td><td>Tidak ada</td><td>Kurang Lengkap</td><td>Lengkap</td><td>Sangat Lengkap</td></tr><tr align="center"><td  width="10%">1</td><td width="10%">2</td><td width="10%">3</td><td width="10%">4</td></tr>';
		$ta = $this->db->query("select * from `m_instrumen_supervisi_mengajar` order by `nomor`");
		foreach($ta->result() as $a)
		{
			//cari nilai kalau ada
			$nomor = $a->nomor;
			$tb = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim' and `supervisor`='$supervisor'");
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
		$td = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim' and `supervisor`='$supervisor'");
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
		echo '<h1>'.$nilaikinerja.'</h1></td></tr><tr><td valign="middle" colspan="5">Predikat</td><td>'.$predikat.'</td></tr>';
		echo '</table></div><p class="text-center"><input type="hidden" name="cacahperangkat" value="'.$cacahperangkat.'"><input type="hidden" name="supervisor" value="'.$supervisor.'">';
		echo '<input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'perangkat/supervisi" class="btn btn-info">Batal</a></p>';
	echo '</form>';
	?>
	</div></div></div>

<?php
}
if($aksi == 'nilai1')
{?>
	<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3>Penilaian Supervisi Perangkat</h3></div>
	<div class="card-body">
	<?php
		echo form_open('perangkat/supervisinilai/'.$thnajaran.'/'.$semester.'/'.$supervisor);
$ta = $this->db->query("select * from `m_macam_perangkat_k13` where `tipe`='guru' order by `nomor`");
		foreach($ta->result() as $a)
		{
			//cari nilai kalau ada
			$nomor = $a->nomor;
			$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim' and `oleh`='$supervisor' and `nomor_perangkat`='$nomor'");
			if ($tb->num_rows() == 0)
			{
				$this->db->query("insert into `supervisi_nilai` (`thnajaran`, `semester`, `kodeguru`, `nomor_perangkat`, `oleh`, `tipe`,`skor`) value ('$thnajaran','$semester','$nim','$nomor','$supervisor', 'guru','3')");
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
			$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim'");
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
		$td = $this->db->query("select * from `supervisi_nilai` where `tipe`='guru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim' and `oleh`='$supervisor'");
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
		$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$nim'");
		$tambahan = '';
		$jtmtambahan = 0;
		foreach ($ttambahan->result() as $dtambahan)
		{
			$tambahan = $dtambahan->nama_tugas;
			$jtmtambahan = $dtambahan->jtm;
		}
		if($jtmtambahan==0)
		{
			$this->db->query("delete from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim' and `oleh`='$supervisor'");
		}
		if($jtmtambahan>0)
		{
			echo '<table><tr><td colspan="2">Perangkat Administrasi Tugas Tambahan '.$tambahan.'</td></tr>';
			$ta = $this->db->query("select * from `m_macam_perangkat_k13` where `tipe`='tambahan' order by `nomor`");
			foreach($ta->result() as $a)
			{
				//cari nilai kalau ada
				$nomor = $a->nomor;
				$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim' and `oleh`='$supervisor' and `nomor_perangkat`='$nomor'");
				if ($tb->num_rows() == 0)
				{
					$this->db->query("insert into `supervisi_nilai` (`thnajaran`,`semester`,`kodeguru`,`nomor_perangkat`,`oleh`, `tipe`,`skor`) value ('$thnajaran','$semester','$nim','$nomor','$supervisor','tambahan','3')");
				}
			}
			$ta = $this->db->query("select * from `m_macam_perangkat_k13` where `tipe`='tambahan' order by `nomor`");
			foreach($ta->result() as $a)
			{
				//cari nilai kalau ada
				$nomor = $a->nomor;
				$tb = $this->db->query("select * from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim'");
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
			$td = $this->db->query("select * from `supervisi_nilai` where `tipe`='tambahan' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim'");
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
			$total = round($total/105*100,0);
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
		echo '</table></div><p class="text-center"><input type="hidden" name="cacahperangkat" value="'.$cacahperangkat.'"><input type="hidden" name="supervisor" value="'.$supervisor.'">';
		echo '<input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'perangkat/supervisi" class="btn btn-info">Batal</a></p>';
	echo '</form>';
	?>
	</div></div></div>

<?php
}
elseif($aksi == 'cetak1')
{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
<body>
<div class="container-fluid">
<a href="<?php echo base_url().'perangkat/supervisi';?>"><h4 class="text-center">DAFTAR CEK PENGAMATAN</h4></a><h4 class="text-center">PELAKSANAAN PEMBELAJARAN</h4>
<?php
}
elseif($aksi == 'cetak')
{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
<body>
<div class="container-fluid">
<a href="<?php echo base_url().'perangkat/supervisi';?>"><h4 class="text-center">DAFTAR CEK PENGAMATAN</h4></a><h4 class="text-center">PELAKSANAAN PEMBELAJARAN</h4>
<?php
$nama_guru = cari_nama_pegawai($nim);
$nip_guru =  cari_nip_pegawai($nim);
$mapel = '';
$kelas = '';
$tanggal = '';
$tb = $this->db->query("select * from `guru_data_supervisi` where `thnajaran`='$thnajaran' and `semester`='$semester' and `username`='$nim'");
if($tb->num_rows()>0)
		{
			foreach($tb->result() as $b)
			{
				$mapel = $b->mapel;
				$kelas = $b->kelas;
				$jamke = $b->jamke;
				$tanggal = $b->tanggal_supervisi_mengajar;
				$id_data_supervisi = $b->id_data_supervisi;
			}
		}
$jtm = 0;
		$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim'");
		foreach($ta->result() as $a)
		{
			$jtm = $jtm + $a->jam;
		}
?>
<table width="100%">
<tr><td width="30%">Nama <?php echo ucwords(strtolower($this->config->item('sek_tipe')));?></td><td>: <?php echo $this->config->item('sek_nama');?></td></tr>
<tr><td width="30%">Mata Pelajaran</td><td>: <?php echo $mapel;?></td></tr>
<tr><td width="30%">Nama Guru</td><td>: <?php echo $nama_guru;?></td></tr>
<tr><td width="30%">NIP</td><td>: <?php echo $nip_guru;?></td></tr>
<tr><td width="30%">Kelas</td><td>: <?php echo $kelas;?></td></tr>
<tr><td width="30%">Hari / Tanggal / Jam Ke</td><td>: <?php echo tanggal_ke_hari($tanggal).' / '.tanggal($tanggal).' / '.$jamke;?></td></tr>
<tr><td width="30%">Jumlah jam yang di ampu / minggu</td><td>: <?php echo $jtm;?></td></tr></table>
<table class="table table-striped table-black-bordered"><tr align="center"><td rowspan="2" width="5%">No</td><td rowspan="2" width="55%">Aspek yang diamati</td><td>Tidak ada</td><td>Kurang Lengkap</td><td>Lengkap</td><td>Sangat Lengkap</td></tr><tr align="center"><td  width="10%">1</td><td width="10%">2</td><td width="10%">3</td><td width="10%">4</td></tr>
<?php
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='1' order by `nomor`");
echo '<tr><td align="center">I</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td><td></td><td></td><td></td><td></td></tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='2' order by `nomor`");
echo '<tr><td align="center">II</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td><td></td><td></td><td></td><td></td></tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='3' order by `nomor`");
echo '<tr><td align="center">III</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td><td></td><td></td><td></td><td></td></tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='4' order by `nomor`");
echo '<tr><td align="center">IV</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td><td></td><td></td><td></td><td></td></tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='5' order by `nomor`");
echo '<tr><td align="center">V</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td><td></td><td></td><td></td><td></td></tr>';
}
?>
</table>
<table width="100%">
<tr><td width="50%"></td><td><?php echo $this->config->item('lokasi');?>, <?php echo date_to_long_string($tanggal);?></td></tr>
<?php
//cari pengawas
$te = $this->db->query("SELECT * FROM `nomor_skbk_skmt` where `thnajaran`='$thnajaran' and `semester`='$semester'");
$nama_pengawas = '';
$nip_pengawas = '';
foreach($te->result() as $e)
{
	$nama_pengawas = $e->nama_pengawas;
	$nip_pengawas = $e->nip;

}
echo '<tr><td></td><td>Supervisor / pengawas '.$this->config->item('sek_tipe').'</td></tr><tr><td></td><td><br /><br /><br />'.$nama_pengawas.'</td></tr><tr><td></td><td>NIP '.$nip_pengawas.'</td></tr></table>';
?>
</div></body></html>
<?php
}
elseif($aksi == 'hasil')
{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<style>
body{
	font-family:Arial, Helvetica, sans-serif;
	font-size: 16px;
}
</style>

<title><?php echo $judulhalaman;?></title>
<body>
<div class="container-fluid">
<a href="<?php echo base_url().'perangkat/supervisi';?>"><h4 class="text-center">DAFTAR CEK PENGAMATAN</h4></a><h4 class="text-center">PELAKSANAAN PEMBELAJARAN</h4>
<?php
$nama_guru = cari_nama_pegawai($nim);
$nip_guru =  cari_nip_pegawai($nim);
$mapel = '';
$kelas = '';
$tanggal = '';
$tb = $this->db->query("select * from `guru_data_supervisi` where `thnajaran`='$thnajaran' and `semester`='$semester' and `username`='$nim'");
if($tb->num_rows()>0)
		{
			foreach($tb->result() as $b)
			{
				$mapel = $b->mapel;
				$kelas = $b->kelas;
				$jamke = $b->jamke;
				$tanggal = $b->tanggal_supervisi_mengajar;
				$id_data_supervisi = $b->id_data_supervisi;
			}
		}
$jtm = 0;
		$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim'");
		foreach($ta->result() as $a)
		{
			$jtm = $jtm + $a->jam;
		}
?>
<table width="100%">
<tr><td width="30%">Nama <?php echo ucwords(strtolower($this->config->item('sek_tipe')));?></td><td>: <?php echo $this->config->item('sek_nama');?></td></tr>
<tr><td width="30%">Mata Pelajaran</td><td>: <?php echo $mapel;?></td></tr>
<tr><td width="30%">Nama Guru</td><td>: <?php echo $nama_guru;?></td></tr>
<tr><td width="30%">NIP</td><td>: <?php echo $nip_guru;?></td></tr>
<tr><td width="30%">Kelas</td><td>: <?php echo $kelas;?></td></tr>
<tr><td width="30%">Hari / Tanggal / Jam Ke</td><td>: <?php echo tanggal_ke_hari($tanggal).' / '.tanggal($tanggal).' / '.$jamke;?></td></tr>
<tr><td width="30%">Jumlah jam yang di ampu / minggu</td><td>: <?php echo $jtm;?></td></tr></table>
<table class="table table-condensed table-striped table-black-bordered"><tr align="center"><td rowspan="2" width="5%">No</td><td rowspan="2" width="55%">Aspek yang diamati</td><td>Tidak ada</td><td>Kurang Lengkap</td><td>Lengkap</td><td>Sangat Lengkap</td></tr><tr align="center"><td  width="10%">1</td><td width="10%">2</td><td width="10%">3</td><td width="10%">4</td></tr>
<?php
$j0 = 0;
$j1 = 0;
$j2 = 0;
$j3 = 0;
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='1' order by `nomor`");
echo '<tr><td align="center">I</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
			//cari nilai kalau ada
			$nomor = $a1->nomor;
			$td = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim' and `supervisor`='$supervisor'");
			$skor = 0;
			foreach($td->result() as $d)
			{
				$skor = $d->skor;
			}
			echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td>';
			if($skor == '3')
			{
				$j3 = $j3 + 3;
				echo '<td></td><td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td>';
			}
			elseif($skor == '2')
			{
				$j2 = $j2 + 2;
				echo '<td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td>';
			}
			elseif($skor == '1')
			{
				$j1++;
				echo '<td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td>';
			}
			else
			{
				echo '<td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td><td></td>';
			}
			echo '</tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='2' order by `nomor`");
echo '<tr><td align="center">II</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
			//cari nilai kalau ada
			$nomor = $a1->nomor;
			$td = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim' and `supervisor`='$supervisor'");
			$skor = 0;
			foreach($td->result() as $d)
			{
				$skor = $d->skor;
			}
			echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td>';
			if($skor == '3')
			{
				$j3 = $j3 + 3;
				echo '<td></td><td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td>';
			}
			elseif($skor == '2')
			{
				$j2 = $j2 + 2;
				echo '<td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td>';
			}
			elseif($skor == '1')
			{
				$j1++;
				echo '<td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td>';
			}
			else
			{
				echo '<td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td><td></td>';
			}
			echo '</tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='3' order by `nomor`");
echo '<tr><td align="center">III</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
			//cari nilai kalau ada
			$nomor = $a1->nomor;
			$td = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim' and `supervisor`='$supervisor'");
			$skor = 0;
			foreach($td->result() as $d)
			{
				$skor = $d->skor;
			}
			echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td>';
			if($skor == '3')
			{
				$j3 = $j3 + 3;
				echo '<td></td><td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td>';
			}
			elseif($skor == '2')
			{
				$j2 = $j2 + 2;
				echo '<td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td>';
			}
			elseif($skor == '1')
			{
				$j1++;
				echo '<td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td>';
			}
			else
			{
				echo '<td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td><td></td>';
			}
			echo '</tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='4' order by `nomor`");
echo '<tr><td align="center">IV</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
			//cari nilai kalau ada
			$nomor = $a1->nomor;
			$td = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim' and `supervisor`='$supervisor'");
			$skor = 0;
			foreach($td->result() as $d)
			{
				$skor = $d->skor;
			}
			echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td>';
			if($skor == '3')
			{
				$j3 = $j3 + 3;
				echo '<td></td><td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td>';
			}
			elseif($skor == '2')
			{
				$j2 = $j2 + 2;
				echo '<td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td>';
			}
			elseif($skor == '1')
			{
				$j1++;
				echo '<td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td>';
			}
			else
			{
				echo '<td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td><td></td>';
			}
			echo '</tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='5' order by `nomor`");
echo '<tr><td align="center">V</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
			//cari nilai kalau ada
			$nomor = $a1->nomor;
			$td = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim' and `supervisor`='$supervisor'");
			$skor = 0;
			foreach($td->result() as $d)
			{
				$skor = $d->skor;
			}
			echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td>';
			if($skor == '3')
			{
				$j3 = $j3 + 3;
				echo '<td></td><td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td>';
			}
			elseif($skor == '2')
			{
				$j2 = $j2 + 2;
				echo '<td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td>';
			}
			elseif($skor == '1')
			{
				$j1++;
				echo '<td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td>';
			}
			else
			{
				echo '<td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td><td></td>';
			}
			echo '</tr>';
}
$ta1 = $this->db->query("SELECT * FROM `m_instrumen_supervisi_mengajar` where `bagian`='6' order by `nomor`");
echo '<tr><td align="center">V</td><td>Pendahuluan</td><td></td><td></td><td></td><td></td></tr>';
foreach($ta1->result() as $a1)
{
			//cari nilai kalau ada
			$nomor = $a1->nomor;
			$td = $this->db->query("select * from `supervisi_mengajar_nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nomor_perangkat`='$nomor' and `kodeguru`='$nim' and `supervisor`='$supervisor'");
			$skor = 0;
			foreach($td->result() as $d)
			{
				$skor = $d->skor;
			}
			echo '<tr><td align="center">'.$a1->nomor.'</td><td>'.$a1->instrumen.'</td>';
			if($skor == '3')
			{
				$j3 = $j3 + 3;
				echo '<td></td><td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td>';
			}
			elseif($skor == '2')
			{
				$j2 = $j2 + 2;
				echo '<td></td><td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td>';
			}
			elseif($skor == '1')
			{
				$j1++;
				echo '<td></td><td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td>';
			}
			else
			{
				echo '<td align="center"><span class="glyphicon glyphicon-ok"></span></td><td></td><td></td><td></td>';
			}
			echo '</tr>';
}
	echo '<tr><td></td><td><strong>Jumlah</strong></td><td align="center">'.$j0.'</td><td align="center">'.$j1.'</td><td align="center">'.$j2.'</td><td align="center">'.$j3.'</td></tr>';
$jskor = $j0+$j1+$j2+$j3;
$jk = $jskor / 81 * 100;
	echo '<tr><td></td><td><strong>Total Skor ( I + II + III + IV)</strong></td><td align="center" colspan="4">'.$jskor.'</td></tr>';
	echo '<tr><td></td><td><strong>Nilai Kinerja</strong></td><td align="center" colspan="4">'.round($jk,2).'%</td></tr>';
if($jk >= 91)
{
	$predikat = 'Amat baik';
}
elseif($jk >= 75)
{
	$predikat = 'Baik';
}
elseif($jk >= 55)
{
	$predikat = 'Cukup';
}
else
{
	$predikat = 'Kurang';
}
?>
</table>
<table class="table table-condensed table-striped table-black-bordered"><tr align="center"><td colspan="3">KETERANGAN KETERCAPAIAN PENILAIAN</td></tr> <tr><td align="center" width="50%">Nilai Kuantitatif</td><td align="center" colspan="2">Nilai Kualitatif</td></tr>
<tr><td align="center">91 - 100</td><td align="center">A</td><td>Amat Baik</td></tr>
<tr><td align="center">75 - 90</td><td align="center">B</td><td>Baik</td></tr>
<tr><td align="center">	55 - 74</td><td align="center">C</td><td>Cukup</td></tr>
<tr><td align="center">&lt; 55</td><td align="center">D</td><td>Kurang</td></tr>
<tr align="center"><td colspan="3">KESIMPULAN HASIL PENILAIAN</td></tr> <tr><td width="50%">Nilai Kuantitatif kinerja</td><td colspan="2"><?php echo round($jk,0);?></td></tr>
 <tr><td width="50%">Dengan demikian nilai kualitatif termasuk</td><td colspan="2"><?php echo $predikat;?></td></tr>
</table>
Catatan Tindak Lanjut :<br />
<table class="table table-black-bordered">
<tr><td><br /></td></tr><tr><td><br /></td></tr><tr><td><br /></td></tr><tr><td><br /></td></tr><tr><td><br /></td></tr></table>

<table width="100%">
<tr><td width="10%"></td><td width="50%"></td><td><?php echo $this->config->item('lokasi');?>, <?php echo date_to_long_string($tanggal);?></td></tr>
<?php
//cari pengawas
$te = $this->db->query("SELECT * FROM `nomor_skbk_skmt` where `thnajaran`='$thnajaran' and `semester`='$semester'");
$nama_pengawas = '';
$nip_pengawas = '';
foreach($te->result() as $e)
{
	$nama_pengawas = $e->nama_pengawas;
	$nip_pengawas = $e->nip;

}
$nama_kepala = cari_kepala($thnajaran,$semester);
$nip_kepala = cari_nip_kepala($thnajaran,$semester);
if($supervisor == 'pengawas')
{
	echo '<tr><td></td><td>Guru yang disupervisi</td><td>Supervisor / pengawas '.$this->config->item('sek_tipe').'</td></tr><tr><td></td><td><br /><br /><br />'.$nama_guru.'</td><td><br /><br /><br />'.$nama_pengawas.'</td></tr><tr><td></td><td>NIP '.$nip_guru.'</td><td>NIP '.$nip_pengawas.'</td></tr>';
echo '<tr><td></td><td></td><td><br />Mengetahui,<br />Kepala '.$this->config->item('sek_nama').'</td></tr><tr><td></td><td></td><td><br /><br /><br />'.$nama_kepala.'</td></tr><tr><td></td><td></td><td>NIP '.$nip_kepala.'</td></tr></table>';
}
else
{
	echo '<tr><td></td><td>Guru yang disupervisi</td><td>Supervisor / Kepala '.$this->config->item('sek_nama').'</td></tr><tr><td></td><td><br /><br /><br />'.$nama_guru.'</td><td><br /><br /><br />'.$nama_kepala.'</td></tr><tr><td></td><td>NIP '.$nip_kepala.'</td><td>NIP '.$nip_pengawas.'</td></tr>';
echo '<tr><td></td><td></td><td><br />Mengetahui,<br />Pengawas '.$this->config->item('sek_tipe').'</td></tr><tr><td></td><td></td><td><br /><br /><br />'.$nama_pengawas.'</td></tr><tr><td></td><td></td><td>NIP '.$nip_guru.'</td></tr></table>';
}

?>
</div></body></html>
<?php
}
else
{
?>
	<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript">
	jQuery(function($){
	$("#tanggalsupervisi").mask("99-99-9999")
	$("#tanggalsupervisiperangkat").mask("99-99-9999")
	});
	</script>
	<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
	<?php
	if(empty($aksi))
	{
		$id_mapel = '';
		$jamke = '';
		$id_data_supervisi_mengajar = '';
		$tb = $this->db->query("select * from `guru_data_supervisi` where `thnajaran`='$thnajaran' and `semester`='$semester' and `username`='$nim' and `supervisor`='$supervisor'");
		if($tb->num_rows()>0)
		{
			foreach($tb->result() as $b)
			{
				$mapel = $b->mapel;
				$kelas = $b->kelas;
				$jamke = $b->jamke;
				$tanggal_supervisi_mengajar = $b->tanggal_supervisi_mengajar;
				$tanggal_supervisi_perangkat = $b->tanggal_supervisi_perangkat;
				$id_data_supervisi = $b->id_data_supervisi;
			}
			$tc = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim' and `mapel`='$mapel' and `kelas`='$kelas'");
			foreach($tc->result() as $c)
			{
				$id_mapel = $c->id_mapel;
			}
		}
		echo '<form method="post" action="'.base_url().'perangkat/supervisiguru/'.$thnajaran.'/'.$semester.'/'.$supervisor.'/simpan" class="form-horizontal" role="form">';
		?>
		<div class="form-group row row">
		<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9">
		<select name="thnajaran" class="form-control">";
		<?php
		echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
		?>
		</select>
        	</div>
		</div>
		<div class="form-group row row">
		<div class="col-sm-3"><label for="thnajaran" class="control-label">Semester</label></div>
		<div class="col-sm-9">
		<select name="semester" class="form-control">";
		<?php
		echo "<option value='".$semester."'>".$semester."</option>";
		?>
		</select>
	        </div>
		</div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Supervisi Mengajar</label></div><div class="col-sm-9"><input type="text" name="tanggal_supervisi_mengajar" id="tanggalsupervisi" value ="<?php echo tanggal($tanggal_supervisi_mengajar);?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Supervisi Perangkat</label></div><div class="col-sm-9"><input type="text" name="tanggal_supervisi_perangkat" id="tanggalsupervisiperangkat" value ="<?php echo tanggal($tanggal_supervisi_perangkat);?>" class="form-control"></div></div>

		<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div>
		<div class="col-sm-9">
		<select name="id_mapel" class="form-control">";
		<?php
		$jtm = 0;
		echo '<option value="'.$id_mapel.'">'.$mapel.' '.$kelas.'</option>';
		$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim'");
		foreach($ta->result() as $a)
		{
			$jtm = $jtm + $a->jam;
			echo '<option value="'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.'</option>';
		}
		?>
		</select></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jam ke</label></div><div class="col-sm-9"><input type="text" name="jamke" value="<?php echo $jamke;?>" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jumlah Jam Tatap Muka</label></div><div class="col-sm-9"><input type="text" name="jtm" value ="<?php echo $jtm;?>" class="form-control" readonly></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Supervisor</label></div><div class="col-sm-9"><input type="text" name="supervisor" value ="<?php echo $supervisor;?>" class="form-control" readonly></div></div>

<input type="hidden" name="id_data_supervisi" value ="<?php echo $id_data_supervisi;?>" class="form-control" readonly>
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
		</form>
		</div></div></div>
		<?php
	}
}
?>

