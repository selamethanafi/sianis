<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: lihat_nilai_peserta_un.php
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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php echo form_open('pengajaran/nilaiun','class="form-horizontal" role="form"');?>
<?php
if (!empty($kelas))
	{
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kelas</label></div>
		<div class="col-sm-9"><input name="kelas" type="text" value="'.$kelas.'" class="form-control" readonly></div></div>';
	}

if (!empty($mapel))
	{
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-9"><input name="mapel" type="text" value="'.$mapel.'" class="form-control" readonly></div></div>';
	}

if ((empty($kelas)) or (empty($mapel)))

{
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kelas</label></div>
		<div class="col-sm-9"><select name="kelas" class="form-control">';
	echo "<option value='".$kelas."'>".$kelas."</option>";
	$daftar_kelas = $this->db->query("select * from m_ruang where ruang like 'XII-%' order by ruang");
	foreach($daftar_kelas->result() as $l)
	{
	echo "<option value='".$l->ruang."'>".$l->ruang."</option>";
	}
	
	echo '</select></div></div>';
	$ta = $this->db->query("select * from tblkategoritutorial order by nama_kategori");
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-9"><select name="mapel" class="form-control">';
	echo "<option value='".$mapel."'>".$mapel."</option>";
	foreach($ta->result() as $a)
	{
	echo "<option value='".$a->nama_kategori."'>".$a->nama_kategori."</option>";
	}
	
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/nilaiun" class="btn btn-info"><b>Batal</b></a></p>';
}
else
{
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Tampil Nilai" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/nilaiun" class="btn btn-info"><b>Batal</b></a></p>';
}

?>
</form>
<?php
//if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)) and (!empty($mapel)))
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($mapel)))
	{
	$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester' and status='Y'  ");
?>
<?php
$nourut = 1;
$baris = 1;
$pembagiujian = 1;
foreach($ta->result() as $a)
{	
	$baris++;
	$nis = $a->nis;
	$nama = nis_ke_nama($nis);
	$romawi = 1;
	echo '<strong>'.$nis.' '.$nama.' '.$a->kelas.'</strong><br>';
	echo '<table class="table table-hover table-bordered table-striped">
<tr align="center"><td width="50"><strong>SMT</strong></td><td width="50"><strong>Kog</strong></td><td width="50"><strong>Psi</strong></td><td width="50"><strong>Sikap</strong></td><td width="50"><strong>Kelas</strong></td><td width="100"><strong>Tuntas</strong></td><td width="100"><strong>Tahun</strong></td><td width="50"><strong>Semester</strong></td><td><strong>Keterangan</strong></td></tr>';
	$tb = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' order by thnajaran ASC, semester ASC");
	$pembagi = 1 ;
	$cacahnilai = 0;
	$cacahnilaiseharusnya = 6;
	$rom='';
	foreach($tb->result() as $b)
	{

		$thnajarane = $b->thnajaran;
		$semestere = $b->semester;
		$kelase = $b->kelas;
		//cari kkm
		$status = 'Belum';
		$tc = $this->db->query("select * from m_mapel where mapel='$mapel' and thnajaran='$thnajarane' and semester='$semestere' and kelas='$kelase'");
		if(count($tc->result())>0)
			{
			foreach($tc->result() as $c)
				{
				$kkmx = $c->kkm;
				}
			}
			else
			{
			$kkmx=100;
			$status ='KKM tidak ada';
			}
		if ((substr($kelase,0,4)=='XII-') or (substr($kelase,0,3)=='XI-'))
			{
			$kkm = 80;
			}
			else
			{
			$kkm = $kkmx;
			}
		$ranah = '';

		$kog = 0;
		$psi = 1;
		$afe = 0;
		foreach($tc->result() as $c)
		{
			$ranah = $c->ranah;
		}
		if ($romawi==7)
			{$romawi = '1';}

		if ($romawi==1)
			{$rom = 'I';}
		if ($romawi==2)
			{$rom = 'II';}
		if ($romawi==3)
			{$rom = 'III';}
		if ($romawi==4)
			{$rom = 'IV';}
		if ($romawi==5)
			{$rom = 'V';}
		if ($romawi==6)
			{$rom = 'VI';}
		if ($ranah == 'KPA')
			{
			$pembagi = 6;
			$pembagiujian = 2;
			if ($b->kog<$kkm)
				{
				$kog = 0;
				}
				else
				{
				$kog = 1;
				}
			if ($b->psi<$kkm)
				{
				$psi = 0;
				}
				else
				{
				$psi = 1;
				}

			}
		if ($ranah == 'KA')
			{
			$pembagi = 3;
			$psi = 1;
			$pembagiujian = 1;
			if ($b->kog<$kkm)
				{
				$kog = 0;
				}
				else
				{
				$kog = 1;
				}

			}
		if ($ranah == 'PA')
			{
			$kog = 1;
			$pembagi = 3;
			$pembagiujian = 1;
			if ($b->psi<$kkm)
				{
				$psi = 0;
				}
				else
				{
				$psi = 1;
				}

			}
		if (($b->afektif=='A') or ($b->afektif=='B') or ($b->afektif=='AB'))
				{
				$afe = 1;
				}
				else
				{
				$afe = 0;
				}
		if (($kog==1) and ($psi==1) and ($afe==1))
			{
			$status = '';
			}

		echo '<tr bgcolor="#FFF" align="center"><td>'.$rom.'</td><td>'.$b->kog.'</td><td>'.$b->psi.'</td><td>'.$b->afektif.'</td><td>'.$b->kelas.'</td><td>'.$status.'</td><td>'.$b->thnajaran.'</td><td>'.$b->semester.'</td><td align="left">'.$b->ket.' '.$b->keterangan.'</td></tr>';

		$cacahnilai++;
		$romawi++;
	}
	//ujian sekolah
	$simpulan ='';
	$tc = $this->db->query("select * from nilai_ujian where nis='$nis' and mapel='$mapel'");
	
	if(count($tc->result())>0)
		{
		foreach($tc->result() as $c)
		{	
			$nu = $c->nilai;
			$np = $c->praktik;

		}
		$us = $nu+$np;
		
		echo '<tr bgcolor="#FFF" align="center"><td>US</td><td>'.$nu.'</td><td>'.$np.'</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
		}
		else
		{
		echo '<tr bgcolor="#FFF" align="center"><td>US</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
		$simpulan = 'Nilai Ujian belum ada';
		}
	echo '</table>';

	if ($cacahnilai<$cacahnilaiseharusnya)
		{
		if (empty($simpulan))
			{
			$simpulan = 'Nilai Rapor tidak lengkap';
			}
			else
			{
			$simpulan .= ', Nilai Rapor tidak lengkap';
			}

		}
	if (!empty($simpulan))
	{
		echo 'Simpulan : '.$simpulan.'';
	}
	echo '<br><br>';
	
}


}
?>
</div>
