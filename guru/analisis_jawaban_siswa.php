<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: analisis_jawaban_siswa.php
// Terakhir diperbarui	: Jum 13 Mei 2016 21:53:11 WIB 
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
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

<?php

if (empty($id_mapel))
	{
	echo '<a href="'.base_url().'guru/nilai"><b>Kembali</b></a>';
	}
else
{
?>
<a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>"><b> Kembali</b></a>

<?php
$skor = 1;
$skormaks = $nsoal * $skor;
?>
<table>
<tr><td>Tahun Pelajaran</td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td>Semester</td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td>Kelas</td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td>Mata Pelajaran</td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td>Analisis</td><td>: <strong><?php echo $ulangan;?></strong></td></tr>
<tr><td>KKM Mapel</td><td>: <strong><?php echo $kkm;?> </strong> </td></tr>
<tr><td>Soal Bagian A : Cacah Soal A / Skor tiap soal / Skor maksimal / Jumlah Skor </td><td>: <strong><?php echo $kkm_ulangan;?> </strong> / <strong><?php echo $nsoal;?></strong> / <strong><?php echo $skor;?></strong> / <strong><?php echo $skormaks;?></strong> / <strong><?php echo $skora;?></td></tr>
<tr><td>Soal Bagian B : Cacah soal </td><td>: <strong><?php echo $nsoalb;?></strong></td></tr>
<?php
$pkunci = strlen($kunci);

if ($pkunci <> $nsoal)
	{
	echo '<tr><td colspan="3"><strong>Cacah kunci A tidak sama dengan cacah soal</strong></td></tr>';
	}
$pkuncib = strlen($kuncib);
if ($pkuncib <> $nsoal)
	{
	echo '<tr><td colspan="3"><strong>Cacah kunci B tidak sama dengan cacah soal, abaikan bila tidak menggunakan kunci B</strong></td></tr>';
	}

?>
<tr><td>Kunci Jawaban Kelompok A</td><td>: <strong><?php echo $kunci.' '.$pkunci;?> </strong></td></tr>
<tr><td>Kunci Jawaban Kelompok B</td><td>: <strong><?php echo $kuncib.' '.$pkuncib;?> </strong></td></tr>
</table>

<?php
if ($nsoal==0)
{
	echo 'ubah cacah soal di <a href="'.base_url().'guru/ubahkkm/'.$id_mapel.'" class="btn btn-primary"><b>sini</b></a>';
}
else
{
	$kegiatanharian = 'menganalisis hasil penilaian pembelajaran mata pelajaran '.$mapel.' kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
	$tahun = tahunsaja(tanggal_hari_ini());
	$bulan = bulansaja(tanggal_hari_ini());
	$bulane = angka_jadi_bulan($bulan);
	$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan '.$bulane.' '.$tahun;
	$tc = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	$id_bulanan = '';
	foreach($tc->result() as $c)
	{
		$id_bulanan = $c->id_bulanan;
	}
	if(empty($id_bulanan))
	{
		echo '<div class="alert alert-warning">Data klasifikasi kegiatan bulanan belum ditentukan</div>';
	}
	else
	{
		$tanggalhariini = tanggal_hari_ini();
		$jam = jam_saja();
		$menit = menit_saja();
		$tb = $this->db->query("select * from `sieka_harian` where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatanharian' and `tanggal`='$tanggalhariini'");
		if($tb->num_rows() == 0)
		{
			$this->db->query("insert into `sieka_harian` (`tahun`, `nip`, `kegiatan`, `tanggal`, `id_bulanan`, `jam_mulai`, `menit_mulai`) values ('$tahun','$nip', '$kegiatanharian', '$tanggalhariini', '$id_bulanan', '$jam', '$menit')");
		}
	}

echo '<div class="table-responsive">
<table class="table table-hover table-bordered">';
?>
<tr><td align="center">No</td><td align="center">Nama Siswa</td><td align="center">Kelompok</td><td align="center">Jawaban Siswa</td><td align="center">Analisis</td><td align="center">SKOR</td><?php 
if ($nsoalb>0)
	{
	$kolomuraian = 0;
	do
	{
		$kolomuraian++;
		echo '<td align="center">'.$kolomuraian.'</td>';


	}
	while ($kolomuraian<$nsoalb);
	echo '<td align="center">SKOR</td>';
	}
echo '<td align="center">Nilai</td></tr><tr align="center">';
$nomor=1;
if(count($query->result())>0)
{

	foreach($query->result() as $t)
	{
	$nis = $t->nis;
	$namasiswa = nis_ke_nama($nis);

	$jawaban = $t->jawaban;
	if (empty($t->kelompok))
		{
		$kelompok = 'A';
		}
		else
		{
		$kelompok = 'B';
		}

	$nis = $t->nis;
	echo "<tr><td align='center'>";
	echo ''.$nomor.'</td><td><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/'.$ulangan.'/'.$t->id_analisis.'/sekaligus">'.$namasiswa.'</a></td>';
	echo '<td>'.$kelompok.'</td><td>'.$jawaban.'</td>';
	$analisis ='';
	$skore = 0;
	for($i=1;$i<=$nsoal;$i++)
	{
		$posisi = $i - 1;
		if ($kelompok== 'A')
			{
			$kuncine = substr($kunci,$posisi,1);
			}
			else
			{
			$kuncine = substr($kuncib,$posisi,1);
			}

		$jawabane = substr($jawaban,$posisi,1);
		if ($kuncine == $jawabane)
			{
				$analisis .= $jawabane;
				if($id_analisis== 'proses')
					{
					$this->db->query("update analisis set `nilai_s$i`='$skor' where `nis`='$nis' and `mapel`='$mapel' and `ulangan`='$ulangan' and `semester`='$semester' and `thnajaran`='$thnajaran'");
					}
				$skore++;
			}
			else
			{
				if($id_analisis== 'proses')
					{

					$this->db->query("update analisis set `nilai_s$i`='0' where `nis`='$nis' and `mapel`='$mapel' and `ulangan`='$ulangan' and `semester`='$semester' and `thnajaran`='$thnajaran'");
					}

				$analisis .= '-';
			}
	}
	$skore = $skore * $skor;
	$skorea = $skore / $skormaks * $skora;
	$kurang = 0;
	$skoruraian = $t->uraian_1 + $t->uraian_2 + $t->uraian_3 + $t->uraian_4 + $t->uraian_5 + $t->uraian_6 + $t->uraian_7 + $t->uraian_8 + $t->uraian_9 + $t->uraian_10;

		if ($nsoal > strlen($jawaban))
			{
			$kurang = $nsoal - strlen($jawaban);
			$analisis .= ' kurang '.$kurang;
			}

		if ($nsoal < strlen($jawaban))
			{
			$lebih = strlen($jawaban) - $nsoal;
			$analisis .= ' lebih '.$lebih;
			}
	if($nsoal == $kurang)
		{
		$skorea = 0;
		}

	$nilaiulangan = $skorea + $skoruraian; 
	$skorea = round($skorea,2);
	echo '<td>'.$analisis.'</td><td align="center">'.$skorea.'</td>';
	if ($nsoalb>0)
		{
		$kolomuraian = 0;
		do
			{
			$kolomuraian++;
			$itemuraian = 'uraian_'.$kolomuraian;
			$skor_uraian = $t->$itemuraian;
			echo '<td align="center">'.$skor_uraian.'</td>';


			}
		while ($kolomuraian<$nsoalb);
		echo '<td align="center">'.$skoruraian.'</td>';
		}
	$nilaiulangan = round($nilaiulangan,2);
	echo '<td align="center">'.$nilaiulangan.'</td></tr>';
	$nomor++;	
	}
}
else{
echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
}
?>
</table></div><br />
<?php
if($id_analisis== 'buka')
	{
	$this->db->query("update analisis set `terkunci`='0' where `mapel`='$mapel' and `ulangan`='$ulangan' and `semester`='$semester' and `thnajaran`='$thnajaran'");
	}

if ((!empty($id_mapel)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
{
echo form_open('guru/perbaruidaftarsiswaanalisis');?>
<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
<input type="hidden" name="semester" value="<?php echo $semester;?>">
<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
<input type="hidden" name="kkm" value="<?php echo $kkm;?>">
<input type="submit" value="Perbarui Daftar Siswa" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/proses"><b> Proses</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/unduh"><b> Unduh Jawaban</b></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>gurukeren/dayabeda/<?php echo $id_mapel;?>/<?php echo $ulangan;?>"><b> Cetak Analisis</b></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/cetak"><b> Cetak Analisis lembar ini</b></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/unggah"><b> Unggah Jawaban</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/buka"><b>Izinkan Siswa Mengirim Jawaban</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<br />Kirim ke daftar nilai&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim"><b>Tanpa Bonus</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/1"><b>+1</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/2"><b>+2</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/3"><b>+3</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/4"><b>+4</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/5"><b>+5</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/6"><b>+6</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/7"><b>+7</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/8"><b>+8</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/9"><b>+9</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim/10"><b>+10</b></a>
</form>
<?php
}
}
} // kalau id_mapel tidak  kosong
?>
</div></div></div>


