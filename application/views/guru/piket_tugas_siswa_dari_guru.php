<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: piket_tugas_siswa_dari_guru.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo form_open('piket/tambahtugas','class="form-horizontal" role="form"');?>
<?php 
if (!empty($id_guru_tugas))
{
	$tc = $this->db->query("SELECT * FROM `guru_tugas` WHERE  `id_guru_tugas`='$id_guru_tugas'");
	if(count($tc->result())>0)
	{
		foreach($tc->result() as $c)
			{
				$kodeguru = $c->kodeguru;
				$mapel = $c->mapel;
				$kelas = $c->kelas;

				echo '<input name="kodegurupiket" type="hidden" value="'.$kodegurupiket.'">';
				echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">';
				echo $c->thnajaran;
				echo '</select></p></div></div>';
				echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">';
				echo ''.$c->semester.'</p></div></div>';
				$tanggalrph = $c->tanggal;
				$day = tanggal_ke_day($tanggalrph);
				$hari = tanggal_ke_hari($tanggalrph);

				echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Berhalangan Hadir</td><td>: </td><td>'.$hari.', '.date_to_long_string($tanggalrph).'';
				echo '</p></div></div>';
				echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><p class="form-control-static">';
				$daftar_guru = $this->db->query("select * from `p_pegawai` where `kd`='$kodeguru'");
				foreach($daftar_guru->result_array() as $ka)
				{
				echo $ka["nama"];
				}
				echo '</p></div></div>';
				echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel Kelas</label></div><div class="col-sm-9"><p class="form-control-static">';
				echo $mapel." ".$kelas;
				echo '</p></div></div>';
				echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jam ke - </label></div><div class="col-sm-9"><p class="form-control-static">'.$c->jamke.'</p></div></div>';	
				echo '
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tugas<td>:</td><td><textarea name="tugas" cols="65" rows="25" class="textfield">'.$c->tugas.'</textarea></p></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"></td><td><td>';
		echo '<input type="hidden" name="proses" value="ubah"><input type="hidden" name="id_guru_tugas_ubah" value="'.$id_guru_tugas.'"><input type="submit" value="Simpan" class="tombol-merah">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/piket/tambahtugas"><b>Batal</b></a></p></div></div>';

			}

	}
	else
	{
	echo 'Tugas tidak ditemukan';
	}

	
}

else

{
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	echo '<input name="kodegurupiket" type="hidden" value="'.$kodegurupiket.'">';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<input name="thnajaran" type="hidden" value="'.$thnajaran.'">'.$thnajaran.'</p></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">
	<input type="hidden" name="semester" class="form-control" value="'.$semester.'">'.$semester.'</p></div></div>';
if (!empty($tanggalrph))
	{
	$postedhari =substr($tanggalrph,6,2);
	$postedbulan=substr($tanggalrph,4,2);
	$postedtahun=substr($tanggalrph,0,4);
		 $bulan = gantibulan($postedbulan);
	$day = tanggal_ke_day($postedtahun."-".$postedbulan."-".$postedhari);
	$hari = tanggal_ke_hari($postedtahun."-".$postedbulan."-".$postedhari);
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Berhalangan Hadir</label></div><div class="col-sm-9"><p class="form-control-static">'.$hari.',';
	echo '<input type="hidden" name="tanggalhadir" value="'.$postedhari.'">
		<input type="hidden" name="bulanhadir" value="'.$postedbulan.'">';
	echo '<input type="hidden" name="tahunhadir" value="'.$postedtahun.'">';	
	echo $postedhari.' '.$bulan.' '.$postedtahun;
	echo '</p></div></div>';
	
	}
if (!empty($kodeguru))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><p class="form-control-static">
	<select name="kodeguru" class="form-control">';
	$daftar_guru = $this->db->query("select * from `p_pegawai` where `kd`='$kodeguru'");
	foreach($daftar_guru->result_array() as $ka)
	{
	echo "<option value='".$ka["kode"]."'>".$ka["nama"]."</option>";
	}
	echo '</select></p></div></div>';
	}
if (!empty($id_mapel))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel</label></div><div class="col-sm-9"><p class="form-control-static">
	<select name="id_mapel" class="form-control">';
	$daftar_mapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' ");

	foreach($daftar_mapel->result_array() as $kb)
	{
	echo "<option value='".$kb["id_mapel"]."'>".$kb["mapel"]." ".$kb["kelas"]."</option>";
	
	}
	echo '</select></p></div></div>';
	$mapel = $kb["mapel"];
	$kelas = $kb["kelas"];
}
if (empty($tanggalrph))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Berhalangan Hadir</label></div><div class="col-sm-9">';
	echo '<p class="form-control-static"><select name="tanggalhadir">';
	$postedhari= date("d");
	$postedbulan=date("m");
	$postedtahun=date("Y");
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
		{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
	for($i=10;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
	echo '</select>';
	echo '<select name="bulanhadir" >';
			$bulan = gantibulan($postedbulan);
			echo '<option value="'.$postedbulan.'">'.$bulan.'</option>';	
			echo '<option value="01">Januari</option>';
			echo '<option value="02">Februari</option>';
			echo '<option value="03">Maret</option>';
			echo '<option value="04">April</option>';
			echo '<option value="05">Mei</option>';
			echo '<option value="06">Juni</option>';
			echo '<option value="07">Juli</option>';
			echo '<option value="08">Agustus</option>';
			echo '<option value="09">September</option>';
			echo '<option value="10">Oktober</option>';
			echo '<option value="11">November</option>';
			echo '<option value="12">Desember</option>';
	echo '</select>';
	echo '<select name="tahunhadir" >';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
	  	$th=date("Y");
	        $awal_th=$th;
	        $akhir_th=$th-20;
		$i = $awal_th;
		do
		{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
		}
		while ($i>=$akhir_th);
	echo '</select></p></div></div>';
echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'piket/tambahtugas" class="btn btn-info"><b>Batal</b></a></p></div></div>';

}
else if (empty($kodeguru))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><p class="form-control-static">
	<select name="kodeguru" class="form-control">';
	echo "<option value=''></option>";
	$daftar_guru = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y' order by `nama`");

	foreach($daftar_guru->result_array() as $ka)
	{
	echo "<option value='".$ka["kode"]."'>".$ka["nama"]."</option>";
	}
	echo '</select></p></div></div>';
echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'piket/tambahtugas" class="btn btn-info"><b>Batal</b></a></p>';
	
	}
else if(empty($id_mapel))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel Kelas</label></div><div class="col-sm-9"><p class="form-control-static">
	<select name="id_mapel" class="form-control">';
	echo "<option value=''></option>";
	$daftar_mapel = $this->db->query("select * from `m_mapel` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and `semester`='$semester' ");

	foreach($daftar_mapel->result_array() as $kb)
	{
	echo "<option value='".$kb["id_mapel"]."'>".$kb["mapel"]." ".$kb["kelas"]."</option>";
	}
	echo '</select></p></div></div>';
echo '<p class="text-center"> <input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'piket/tambahtugas" class="btn btn-info"><b>Batal</b></a></p>';
	}
else
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jam ke - </label></div><div class="col-sm-9"><p class="form-control-static"><input type="text" name="jamke" class="form-control"></p></div></div>';	
	echo '<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Tugas</label></div></div><div class="form-group row row"><div class="col-sm-12"><textarea name="tugas" rows="10" class="form-control"></textarea></p></div></div>';
echo '<p class="text-center"><input type="hidden" name="proses" value="oke"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'piket/tambahtugas" class="btn btn-info"><b>Batal</b></a></p>';

}

} // akhir kalau tambah
echo '</form>';

if ($proses == 'oke')
	{
	$ta = $this->db->query("SELECT * FROM `guru_tugas` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' and `mapel`='$mapel' and `tanggal`='$tanggalrph' and `jamke`='$jamke'");
	if(count($ta->result())==0)
		{
		$this->db->query("INSERT INTO `guru_tugas` (`thnajaran`, `semester`, `kelas`, `kodeguru`, `mapel`, `tanggal`, `jamke`, `tugas`, `kodegurupiket`) VALUES ('$thnajaran', '$semester', '$kelas', '$kodeguru', '$mapel', '$tanggalrph', '$jamke', '$tugas', '$kodegurupiket')");
		}
	}
if ($proses == 'ubah')
	{
	$this->db->query("update `guru_tugas` set `tugas`='$tugas' where `id_guru_tugas`='$id_guru_tugas_ubah'");
	header('Location: '.base_url().'piket/daftartugas/');
	}

if (!empty($tanggalrph))
	{
	$tb = $this->db->query("SELECT * FROM `guru_tugas` WHERE  `tanggal`='$tanggalrph'");
	echo '<div class="table-responsive">';
	echo '<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Nama Guru</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Kelas</strong></td><td><strong>Jam ke-</strong></td><td><strong>Tugas</strong></p></div></div>';
	$nomor=1;
	if(count($tb->result())>0)
		{
			foreach($tb->result() as $t)
				{
			echo "<tr><td align='center'>".$nomor."</td><td>".cari_nama_pegawai($t->kodeguru)."</td><td>".$t->mapel."</td><td align=center>".$t->kelas."</td><td>".$t->jamke."</td><td>".$t->tugas."</p></div></div>";
		$nomor++;	
			}
		}
	echo '</table></div>';
	}
?>
</div></div></div>
