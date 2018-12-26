<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: form_mencetak_lhb_mapel.php
// Terakhir diperbarui	: Kam 12 Mei 2016 20:23:06 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<form class="form-horizontal" role="form" action="<?php echo base_url();?>guru/intake" method="post">
	<div class="form-group row row">
		<div class="col-sm-4" ><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-8" >
 			<select name="thnajaran" class="form-control">
				<?php
				echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
				foreach($daftar_tapel->result_array() as $k)
				{
					echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
				}
				echo '</select>';
				?>
		</div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-4" ><label for="semester" class="control-label">Semester</label></div>
		<div class="col-sm-8" >
 			<select name="semester" class="form-control">
				<?php
				echo '<option value="'.$semester.'">'.$semester.'</option>';
				echo '<option value="1">1</option>';
				echo '<option value="2">2</option>';
				?>
			</select>
		</div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-4" ><label for="tingkat" class="control-label">Kelas</label></div>
		<div class="col-sm-8" >
 			<select name="tingkat" class="form-control">
				<?php
				echo '<option value="'.$tingkat.'">'.$tingkat.'</option>';
				echo '<option value="X">X</option>';
				echo '<option value="XI">XI</option>';
				echo '<option value="XII">XII</option>';
				?>
			</select>
		</div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-4" ><label for="program" class="control-label">Program / Jurusan / Peminatan</label></div>
		<div class="col-sm-8" >
 			<select name="program" class="form-control">
				<?php
				$tprogram = $this->db->query("select * from `m_program`");
				echo "<option value='".$program."'>".$program."</option>";
				echo "<option value='semua'>semua</option>";
				foreach($tprogram->result_array() as $kx)
				{
					echo "<option value='".$kx["program"]."'>".$kx["program"]."</option>";
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-4" ><label for="mapel" class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-8" >
 			<select name="mapel" class="form-control">
				<?php
				echo '<option value="'.$mapel.'">'.$mapel.'</option>';
				$tc = $this->db->query("SELECT * from tblkategoritutorial order by `nama_kategori`");
				foreach($tc->result() as $c)
				{
					$namamapel = $c->nama_kategori;
					echo "<option value='".$c->nama_kategori."'>".$c->nama_kategori."</option>";
				}
				?>
			</select>
		</div>
	</div>
	<p class="text-center"><button type="submit" class="btn btn-primary">Tampilkan</button></p>
</form>
<?php
if( (!empty($thnajaran)) and (!empty($tingkat)) and (!empty($semester)) and (!empty($mapel)) and (!empty($program)))
{
	echo '<h3>Daya dukung Siswa</h3>';
	if($program == 'semua')
	{
		$truang = $this->db->query("select * from `m_ruang` where `tingkat`='$tingkat'");
	}
	else
	{
		$truang = $this->db->query("select * from `m_ruang` where `tingkat`='$tingkat' and `program`='$program'" );
	}
	$cacah_siswa = 0;
	$ns = 0;
	$nr = 0;
	foreach($truang->result() as $r)
	{
		$kelas = $r->ruang;
		$tnilai = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas` = '$kelas'");
		$cacah_nilai_kosong = 0;
		$cacah = $tnilai->num_rows();
		if($cacah>0)
		{
			$cacah_siswa = $cacah_siswa +$cacah;
			foreach($tnilai->result() as $a)
			{
				$nr = $nr + $a->nilai_nr;
				$ns = $ns + $a->kog;
				if($a->kog == 0)
					{
					$cacah_nilai_kosong++;
					}
			}
		}
	}
			echo '<table class="table table-striped table-hover table-bordered">';
			echo '<tr><td>Cacah Siswa</td><td align="right">'.$cacah_siswa.'</td></tr>';
			echo '<tr><td>Jumlah Nilai Rapor Sementara</td><td align="right">'.$nr.'</td></tr>';
			echo '<tr><td>Jumlah Nilai Rapor Akhir</td><td align="right">'.$ns.'</td></tr>';
		if($cacah_siswa>0)
		{
			$nr = $nr / $cacah_siswa;
			$ns = $ns / $cacah_siswa;
			echo '<tr><td>Rata - rata Nilai Rapor sementara</td><td align="right">'.round($nr,2).'</td></tr>';
			echo '<tr><td>Rata - rata Nilai Rapor Akhir</td><td align="right">'.round($ns,2).'</td></tr>';
			echo '<tr><td>Cacah Nilai Rapor Akhir yang kosong</td><td align="right">'.$cacah_nilai_kosong.'</td></tr>';
			echo '</table>';	
		}

		else
		{
		echo '<div class="alert alert-danger"><strong>Tidak ada data</strong>, silakan memeriksa kesesuaian tahun pelajaran, semester, tingkat, jurusan dan mata pelajaran</div>';
		}
}
?>
</div></div>
</div>
