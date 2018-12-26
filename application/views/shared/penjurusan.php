<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_siswa_kelas.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 05 Jan 2016 11:06:22 WIB 
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
<?php echo form_open($tautan_balik.'/penjurusan','class="form-horizontal" role="form"');?>
<div class="card">
    <div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
    <div class="card-body">
<?php
if(($penjurusan == 'Penjurusan') or ($penjurusan == 'Kenaikan Kelas'))
{
	$semester = '2';
}
?>
<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Penjurusan / Kenaikan / Mutasi Massal</label></div>
	<div class="col-sm-9"><select name="penjurusan" class="form-control">
		<option value="<?php echo $penjurusan;?>"><?php echo $penjurusan;?></option>
		<option value="Mutasi Semester 1 ke Semester 2">Mutasi Semester 1 ke Semester 2</option>
		<option value="Penjurusan">Penjurusan</option><option value="Mutasi Massal">Mutasi Massal</option>
		<option value="Kenaikan Kelas">Kenaikan Kelas</option>
		</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran Lama</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">
<?php
$thnajaranbaru1 = substr($thnajaran,0,4)+1;
$thnajaranbaru2 = substr($thnajaran,0,4)+2;
$thnajaranbaru = $thnajaranbaru1."/".$thnajaranbaru2;
echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
foreach($daftartahun->result_array() as $k)
{
echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
}
?>
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">
	<?php
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	?>
	</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
<select name="kelas" class="form-control">

<?php
echo "<option value='".$kelas."'>".$kelas."</option>";
foreach($daftarkelas->result_array() as $ka)
{
echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
}
?>
</select></div></div>
<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Tampilkan Daftar Siswa</button></p></div></div></form>
<?php
if((!empty($thnajaran)) and (!empty($kelas)) and (!empty($semester)))
{
echo form_open($tautan_balik.'/penjurusan');
if($penjurusan == 'Penjurusan')
{
	$nl = 0;
	$np = 0;
	$nx = 0;
$daftarsiswa = $this->db->query("select * from `siswa_kelas`  where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by no_urut");
echo '<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jenis Kelamin</strong></td><td><strong>Proses</strong></td><td><strong>Kelas Baru</strong></td></tr>';
$nomor=1;
	foreach($daftarsiswa->result() as $b)
	{
	$nis= $b->nis;
	$kelamin = jenkel_siswa($nis,0);
	if($kelamin == 'P')
		{
		$np++;
		}
	elseif($kelamin == 'L')
		{
		$nl++;
		}
	else
		{
		$nx++;
		}

	echo '<tr><td>'.$nomor.'</td><td>'.$b->nis.'</td><td>'.nis_ke_nama($nis).'</td><td align="center">'.$kelamin.'</td><td align="center">';
	?>
	<a title="Peminatan" onclick="window.open('<?php echo base_url();?>index.php/<?php echo $tautan_balik;?>/prosespenjurusan/<?php echo $b->nis;?>/<?php echo substr($thnajaran,0,4);?>','proses','width=1024,height=600,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-20)+'');return false;" href="<?php echo base_url();?>index.php/<?php echo $tautan_balik;?>/penjurusan" target="_blank">Proses</a>
	<?php
	echo '</td>';
	$tkelassekarang = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaranbaru' and `semester`='1' and `nis`='$nis' and `status`='Y'");
	$kelassekarang ='Belum diproses';
	foreach($tkelassekarang->result() as $c)
		{
		$kelassekarang = $c->kelas;
		}
	echo '<td>'.$kelassekarang.'</td></tr>';
	$nomor++;
	}
echo '<tr><td colspan="5">Cacah Siswa Laki - laki</td><td>'.$nl.'</td></td><tr><td colspan="5">Cacah Siswa Perempuan</td></td>'.$np.'</td></tr>';
if($nx>0)
	{echo '<tr><td colspan="5">Cacah Siswa Lain</td><td>'.$nx.'</td></tr>';
	}
echo '</table>';

}
	elseif ($penjurusan == 'Kenaikan Kelas')
{
	$nl = 0;
	$np = 0;
	$nx = 0;

$daftarsiswa = $this->db->query("select * from `siswa_kelas`  where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by no_urut");
echo '<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jenis Kelamin</strong></td><td><strong>Naik ke kelas</strong></td></tr>';
$nomor=1;
	foreach($daftarsiswa->result() as $b)
	{
	$nis = $b->nis;
	$kelamin = jenkel_siswa($nis,0);
	if($kelamin == 'P')
		{
		$np++;
		}
	elseif($kelamin == 'L')
		{
		$nl++;
		}
	else
		{
		$nx++;
		}
	echo "<tr><td width=\"50\">".$nomor."</td><td width=\"100\">".$b->nis."</td><td >".nis_ke_nama($nis)."</td><td align=\"center\">".$kelamin."<td align=\"center\">";
	
	$ta = $this->db->query("select * from `m_ruang` order by ruang");
	if(substr($kelas,0,2)=='X-')
		{
		$ta = $this->db->query("select * from `m_ruang` where `ruang` like 'XI-%' order by ruang");
		}
	if(substr($kelas,0,3)=='XI-')
		{
		$ta = $this->db->query("select * from `m_ruang` where `ruang` like 'XII-%' order by ruang");
		}
	$tkelassekarang = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaranbaru' and `semester`='1' and `nis`='$nis' and `status`='Y'");
	$kelassekarang ='Naik ke kelas';
	$kelassekarange ='';
	foreach($tkelassekarang->result() as $c)
		{
		$kelassekarang = $c->kelas;
		$kelassekarange = $c->kelas;
		}
	echo '<select name="kelasmutasi_'.$nomor.'" class="form-control"><option value="'.$kelassekarange.'">'.$kelassekarang.'</option>';
	foreach($ta->result_array() as $a)
	{
	echo "<option value='".$a["ruang"]."'>".$a["ruang"]."</option>";
	}
	echo '<option value="-">Tunda Mutasi</option>';
	echo '</select><input type="hidden" name="nis_'.$nomor.'" value="'.$b->nis.'"></td></tr>';
	$nomor++;
	}
	$cacahsiswa = $nomor-1;
	echo '<tr><td></td><td><input type="hidden" name="penjurusan" value="'.$penjurusan.'"><input type="hidden" name="thnajaranbaru" value="'.$thnajaranbaru.'"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><input type="hidden" name="semester" value="1"><input type="hidden" name="kelas" value="'.$kelas.'"><input type="hidden" name="cacahsiswa" value="'.$cacahsiswa.'"></td><td></td></tr>';
echo '<tr><td colspan="4">Cacah Siswa Laki - laki</td><td> '.$nl.'</td></tr><tr><td colspan="4">Cacah Siswa Perempuan</td><td> '.$np.'</td></tr>';
if($nx>0)
	{echo '<tr><td colspan="4">Cacah Siswa Lain</td><td>'.$nx.'</td></tr>';
	}
echo '</table><p class="text-center"><input type="submit" value="Proses Kenaikan Kelas Siswa Tahun '.$thnajaranbaru.' Semester 1" class="btn btn-primary"></p></form>';

}
	elseif ($penjurusan == 'Mutasi Semester 1 ke Semester 2')
{
	$nl = 0;
	$np = 0;
	$nx = 0;

$daftarsiswa = $this->db->query("select * from `siswa_kelas`  where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by no_urut");
echo '<table class="table table-hover table-striped table-bordered">
<tr><td width="50"><strong>No.</strong></td><td width="100"><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jenis Kelamin</strong></td><td><strong>Mutasi ke kelas</strong></td></tr>';
$nomor=1;
	foreach($daftarsiswa->result() as $b)
	{
	$nis = $b->nis;
	$kelamin = jenkel_siswa($nis,0);
	if($kelamin == 'P')
		{
		$np++;
		}
	elseif($kelamin == 'L')
		{
		$nl++;
		}
	else
		{
		$nx++;
		}
	echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".nis_ke_nama($nis)."</td><td align=\"center\">".$kelamin."<td align=\"center\">";
	
	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' order by kelas");
	if(substr($kelas,0,2)=='X-')
		{
		$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'X-%' order by kelas");
		}
	if(substr($kelas,0,3)=='XI-')
		{
		$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'XI-%' order by kelas");
		}
	if(substr($kelas,0,4)=='XII-')
		{
		$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'X-%' order by kelas");
		}

	$tkelassekarang = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='1' and `nis`='$nis' and `status`='Y'");
	$kelassekarang ='Mutasi ke kelas';
	$kelassekarange ='';
	foreach($tkelassekarang->result() as $c)
		{
		$kelassekarang = $c->kelas;
		$kelassekarange = $c->kelas;
		}
	echo '<select name="kelasmutasi_'.$nomor.'" class="form-control"><option value="'.$kelassekarange.'">'.$kelassekarang.'</option>';
	foreach($ta->result_array() as $a)
	{
	echo "<option value='".$a["ruang"]."'>".$a["ruang"]."</option>";
	}
	echo '<option value="-">Tunda Mutasi</option>';
	echo '</select><input type="hidden" name="nis_'.$nomor.'" value="'.$b->nis.'"><input type="hidden" name="no_urut_'.$nomor.'" value="'.$b->no_urut.'"></td></tr>';
	$nomor++;
	}
	$cacahsiswa = $nomor-1;
	echo '<tr><td></td><td><input type="hidden" name="penjurusan" value="'.$penjurusan.'"><input type="hidden" name="thnajaranbaru" value="'.$thnajaran.'"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><input type="hidden" name="tipemutasi" value="1"><input type="hidden" name="semester" value="2"><input type="hidden" name="kelas" value="'.$kelas.'"><input type="hidden" name="cacahsiswa" value="'.$cacahsiswa.'"></td><td></td></tr>';
echo '<tr><td colspan="4">Cacah Siswa Laki - laki</td><td> '.$nl.'</td></tr><tr><td colspan="4">Cacah Siswa Perempuan</td><td> '.$np.'</td></tr>';
if($nx>0)
	{echo '<tr><td colspan="4">Cacah Siswa Lain</td><td>'.$nx.'</td></tr>';
	}
echo '</table><p class="text-center"><input type="submit" value="Proses Mutasi Semester 1 ke Semester 2 Tahun '.$thnajaran.'" class="btn btn-primary"></p></form>';
}

	else
{
$daftarsiswa = $this->db->query("select * from `siswa_kelas`  where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by no_urut");
echo '<table class="table table-hover table-striped table-bordered">
<tr><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jenis Kelamin</strong></td><td><strong>Mutasi ke kelas</strong></td></tr>';
$nomor=1;
	$nl = 0;
	$np = 0;
	$nx = 0;
	foreach($daftarsiswa->result() as $b)
	{
	$nis = $b->nis;
	$kelamin = jenkel_siswa($nis,0);
	if($kelamin == 'P')
		{
		$np++;
		}
	elseif($kelamin == 'L')
		{
		$nl++;
		}
	else
		{
		$nx++;
		}

	echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td width=\"50\">".nis_ke_nama($nis)."</td><td align=\"center\" width=\"50\">".$kelamin."</td><td align=\"center\">";
	
	$ta = $this->db->query("select * from `m_ruang` order by ruang");
	if(substr($kelas,0,2)=='X-')
		{
		$ta = $this->db->query("select * from `m_ruang` where `ruang` like 'X-%' order by ruang");
		}
	if(substr($kelas,0,3)=='XI-')
		{
		$ta = $this->db->query("select * from `m_ruang` where `ruang` like 'XI-%' order by ruang");
		}
	if(substr($kelas,0,4)=='XII-')
		{
		$ta = $this->db->query("select * from `m_ruang` where `ruang` like 'XII-%' order by ruang");
		}

	$tkelassekarang = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y'");
	$kelassekarang ='Mutasi ke kelas';
	$kelassekarange ='';
	foreach($tkelassekarang->result() as $c)
		{
		$kelassekarang = $c->kelas;
		$kelassekarange = $c->kelas;
		}
	echo '<select name="kelasmutasi_'.$nomor.'" class="form-control"><option value="'.$kelassekarange.'">'.$kelassekarang.'</option>';
	foreach($ta->result_array() as $a)
	{
	echo "<option value='".$a["ruang"]."'>".$a["ruang"]."</option>";
	}
	echo '<option value="-">Tunda Mutasi</option>';
	echo '</select><input type="hidden" name="nis_'.$nomor.'" value="'.$b->nis.'"></td></tr>';
	$nomor++;
	}
	$cacahsiswa = $nomor-1;
	echo '<tr><td></td><td><input type="hidden" name="penjurusan" value="'.$penjurusan.'"><input type="hidden" name="thnajaranbaru" value="'.$thnajaran.'"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><input type="hidden" name="semester" value="'.$semester.'"><input type="hidden" name="kelas" value="'.$kelas.'"><input type="hidden" name="cacahsiswa" value="'.$cacahsiswa.'"></td><td></td></tr>';
echo '<tr><td colspan="4">Cacah Siswa Laki - laki</td><td> '.$nl.'</td></tr><tr><td colspan="4">Cacah Siswa Perempuan</td><td> '.$np.'</td></tr>';
if($nx>0)
	{echo '<tr><td colspan="4">Cacah Siswa Lain</td><td>'.$nx.'</td></tr>';
	}
echo '</table><p class="text-center"><input type="submit" value="Proses Mutasi Siswa Tahun '.$thnajaran.' Semester '.$semester.'" class="btn btn-primary"></p>';
}
echo '</form>';
}
echo '</div>';
