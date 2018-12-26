<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: nilai_ujian_nasional.php
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
<?php
$thnajaran = cari_thnajaran();
$semester = '2';
?>
<?php echo form_open('pengajaran/nilaiujiannasional','class="form-horizontal" role="form"');?>
<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9"><input type="text" name="thnajaran" class="form-control" value="<?php echo $thnajaran;?>"></div></div>
<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Semester</label></div>
	<div class="col-sm-9"><input type="text" name="semester" class="form-control" value="<?php echo $semester;?>"></div></div>

<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Siswa</label></div><div class="col-sm-9"><select name="nis" class="form-control">
<?php
if (!empty($nis))
	{
	$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `nis`='$nis'");
	$kelas = '';
	foreach($tb->result() as $b)
		{	
		$kelas = $b->kelas;
		}
	$program = kelas_jadi_program($kelas);
	$namasiswa = nis_ke_nama($nis);
	echo '<option value="'.$nis.'">'.$namasiswa.'</option>';
	echo '</select></div></div>	';
	echo '<table class="table table-hover table-bordered table-striped">';
	//cari mapel un

	$tc = $this->db->query("select * from `mapel_un` where `thnajaran`='$thnajaran' and `program`='$program' order by no_urut");
	foreach($tc->result() as $c)
		{
		$mapel = $c->mapel;
		$no_urut = $c->no_urut;
		// masukkan ke daftar nilai siswa
		$td = $this->db->query("select * from `nilai_un` where `nis`='$nis' and `mapel`='$mapel'");
		if(count($td->result())==0)
			{
			$this->db->query("insert into `nilai_un` (`nis`,`mapel`,`no_urut`) values ('$nis','$mapel','$no_urut')");
			}

		}
	//
	if($thnajaran == '2014/2015')
		{
		$te = $this->db->query("select * from `nilai_un` where `nis`='$nis' order by no_urut");	
		$nomor = 1;
		$jun = 0;
		$jns = 0;
		$jna = 0;
		foreach($te->result() as $e)
			{
			$jun = $jun + $e->un;
			$jns = $jns + $e->ns;
			$jna = $jna + $e->na;
			$nomor++;
			}
			$cacah_mapel = $nomor - 1;
			if($cacah_mapel>0)
				{
				$rata = $jna / $cacah_mapel;
				$rata = round($rata,1);
				}
				else
				{
				$rata = 0;
				}
		//judul mapel
		echo '<tr bgcolor="#ccc" align="center"><td><strong>NILAI</strong></td>';
		$nomor = 1;
		foreach($te->result() as $e)
			{
			echo '<td width="15%"><strong>'.$nomor.'. '.$e->mapel.'</strong></td>';
			$nomor++;
			}
		echo '</tr>';
		//ujian nasional
		echo '<tr align="center"><td>UN</td>';
		$nomor = 1;
		foreach($te->result() as $e)
			{
			echo '<td width="15%"><input type="text" name="un_'.$nomor.'" value="'.$e->un.'" class="form-control"></td>';
			$nomor++;
			}
		echo '</tr>';
		//nilai sekolah
		echo '<tr align="center"><td>NS</td>';
		$nomor = 1;
		foreach($te->result() as $e)
			{
			echo '<td width="15%"><input type="text" name="ns_'.$nomor.'" value="'.$e->ns.'" class="form-control"></td>';
			$nomor++;
			}
		echo '</tr></table>';

			

		}
		else
	{
	echo '<tr><td><strong>Program Studi </strong></td> <strong>'.$program.'</strong></td><td>UN</td><td>NS</td><td>NA</td></tr>';
	$te = $this->db->query("select * from `nilai_un` where `nis`='$nis' order by no_urut");	
	$nomor = 1;
		$jun = 0;
		$jns = 0;
		$jna = 0;
	foreach($te->result() as $e)
		{
		$jun = $jun + $e->un;
		$jns = $jns + $e->ns;
		$jna = $jna + $e->na;
		echo '<tr><td><strong>'.$nomor.'. '.$e->mapel.'</strong></td><td><input type="text" name="un_'.$nomor.'" value="'.$e->un.'" class="form-control"></td><td><input type="text" name="ns_'.$nomor.'" value="'.$e->ns.'" class="form-control"></td><td><input type="text" name="na_'.$nomor.'" value="'.$e->na.'" class="form-control">';
		echo '</td></tr>';
		$nomor++;
		}
		$cacah_mapel = $nomor - 1;
		if($cacah_mapel>0)
			{
			$rata = $jna / $cacah_mapel;
			$rata = round($rata,1);
			}
			else
			{
			$rata = 0;
			}
	echo '<tr><td>Rata rata nilai akhir</td><td>: <strong>'.$rata.'<strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$keterangan.'</strong></td></tr></table>';
	} // akhir bukan tahun 2014/2015

	echo '<p class="text-center"><input type="hidden" value="'.$cacah_mapel.'" name="cacah_mapel"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/nilaiujiannasional" class="btn btn-info"><b>Batal</b></a></p>';
	
	}
else
	{
	echo '<option value="">Pilih siswa</option>';
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and kelas like 'XII-%' order by no_urut");
	foreach($ta->result() as $a)
		{
		
		$namasiswane = nis_ke_nama($a->nis);
		echo '<option value="'.$a->nis.'">'.$namasiswane.'</option>';

		}
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary"> <a href="'.base_url().'pengajaran/nilaiujiannasional" class="btn btn-info"><b>Batal</b></a></p>';

	}

echo '</form>';
?>
</div>


