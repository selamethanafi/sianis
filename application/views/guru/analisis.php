<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:30:45 WIB 
// Nama Berkas 		: analisis.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>"><b> Kembali</b></a>
<?php
$nsoale = $nsoal + $nsoalb;
$lebarkolom = 10;
$skormaks = $nsoal * $skor;
$lebartabel = 455 + (($nsoal+$nsoalb)*$lebarkolom);
if ($nsoale==0)
{
	$lebartabel = 455 + (10*$lebarkolom);
}
if($kkm_ulangan == 0) 
{
	$kkm_ulangan = $kkm;
}
?>
<table>
<tr><td><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Analisis</strong></td><td>: <strong><?php echo $ulangan;?></strong></td></tr>
<tr><td><strong>KKM Mapel / Ulangan</strong></td><td>: <strong><?php echo $kkm;?> </strong> / <strong><?php echo $kkm_ulangan;?> </strong></td></tr>
<tr><td><strong>Soal Bagian A : Cacah Soal A / Skor tiap soal / Skor maksimal / Jumlah Skor </strong></td><td>: <strong><?php echo $nsoal;?></strong> / <strong><?php echo $skor;?></strong> / <strong><?php echo $skormaks;?></strong> / <strong><?php echo $skora;?></td></tr>
<tr><td><strong>Soal Bagian B : Cacah soal </strong></td><td>: <strong><?php echo $nsoalb;?></strong></td></tr>
</table>
<?php
if ($nsoale==0)
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
	$dipakai = 0;
	$ta = $this->db->query("select * from `analisis_skor` where `id_mapel`='$id_mapel' and `itemnilai`='$ulangan'");
	if($ta->num_rows() == 0)
	{
		echo '<div class="alert alert-info">Apakah nilai tiap soal berbeda?, jika ya, klik di <a href="'.base_url().'gurukeren/skor/'.$id_mapel.'/'.$ulangan.'" class="btn btn-info">sini</a></div>';
	}
	else
	{
		foreach($ta->result() as $a)
		{
			$dipakai = $a->dipakai;
		}
		if($dipakai == 1)
		{
			echo '<div class="alert alert-info">Tampaknya nilai tiap soal berbeda. Jika nilai tiap soal sama, klik di <a href="'.base_url().'gurukeren/skor/'.$id_mapel.'/'.$ulangan.'/tidakdipakai" class="btn btn-info">sini</a> atau kalau hendak mengubah skor tiap soal klik di <a href="'.base_url().'gurukeren/skor/'.$id_mapel.'/'.$ulangan.'" class="btn btn-info">sini</a></div>';
			$skormaks = 0;
			$nsoaladaskor = 0;
			for($i=1;$i<=50;$i++)
			{
				$iteme = 's'.$i;
				$skormaks = $skormaks + $a->$iteme;
				if($a->$iteme>0)
				{
					$nsoaladaskor++;
				}
			}
			echo '<div class="alert alert-info">Total skor menjadi = '.$skormaks.' dari '.$nsoaladaskor.' soal</div>';
			if($nsoal != $nsoaladaskor)
			{
				echo '<div class="alert alert-danger">Cacah soal tidak sama. Di halaman ubah KKM ada '.$nskor.' soal, di halaman skor soal ada '.$nsoaladaskor.' soal</div>';
			}
		}
		else
		{
			echo '<div class="alert alert-info">Apakah nilai tiap soal berbeda?, jika ya, klik di <a href="'.base_url().'gurukeren/skor/'.$id_mapel.'/'.$ulangan.'" class="btn btn-info">sini</a></div>';
		}
	}
echo 'Klik nomor urut atau atau nama siswa untuk mengisi nilai 
<div class="table-responsive">
<table class="table table-hover table-bordered">';
?>
<tr align="center">	  
		    <td align="center" rowspan="2">No</td>
		    <td align="center" rowspan="2">Nama Siswa</td>
		    <td align="center" colspan="<?php echo $nsoale;?>">SKOR YANG DICAPAI</td>
		    <td align="center" colspan="2">SKOR</td>
		    <td align="center" rowspan="2">Ketuntasan</td>
			<?php
			if($nsoal+$nsoalb>25)
			{
				echo '<td align="center" rowspan="2">Nama Siswa</td>';
			}
			?>
		  </tr>
<tr align="center">
<?php
$kolom = 0;
do
{	
	$nokol = $kolom + 1;
	$nil[$kolom]=0;
	echo '<td align="center">'.$nokol.'</td>';
	$kolom++;
}
while ($kolom<$nsoale);
echo '<td align="center">Dicapai</td><td align="center">Nilai</td>';
echo '</tr>';
$nomor=1;
$cacahsiswa = count($query->result());
$skormakspersoal = $skor * $cacahsiswa;
if ($nsoalb>0)
	{
	$skormakspersoalb = $skorb * $cacahsiswa / $nsoalb;
	}
//echo 'jmlskor siswa maks '.$skormakspersoalb;
if(count($query->result())>0)
{
	$kolom = 0;
	do
		{
		$nil[$kolom]=0;
		$kolom++;
		}
	while ($kolom<$nsoal);
	$kolomb = 0;
	do
		{
		$nilb[$kolomb]=0;
		$kolomb++;
		}
	while ($kolomb<$nsoalb);

	foreach($query->result() as $t)
	{
	$nis = $t->nis;
	$namasiswa = nis_ke_nama($nis);

	echo '<tr><td align="center">';
	echo '<a href="'.base_url().'guru/analisis/'.$id_mapel.'/'.$ulangan.'/'.$t->id_analisis.'">'.$nomor.'</a></td><td><a href="'.base_url().'guru/analisis/'.$id_mapel.'/'.$ulangan.'/'.$t->id_analisis.'/sekaligus">'.$namasiswa.'</a></td>';

	$kolom = 0;
	$nilaipersiswa= 0;
	do
	{	
	$nilaine=0;
	$nokol = $kolom + 1;
	$item = 'nilai_s'.$nokol.'';
	$nilaine = $t->$item;
	$nil[$kolom]=$nil[$kolom]+$nilaine;
	$nilaipersiswa= $nilaipersiswa + $nilaine;
	echo '<td align="center">'.$nilaine.'</td>';
	$kolom++;
	}
	while ($kolom<$nsoal);
	$nilaipersiswab= 0;
	if ($nsoalb>0)
	{
		$kolomb = 0;

		do
		{	
		$nilaineb=0;
		$nokolb = $kolomb + 1;
		$item = 'uraian_'.$nokolb.'';
		$nilaineb = $t->$item;
		$nilb[$kolomb]=$nilb[$kolomb]+$nilaineb;
		$nilaipersiswab= $nilaipersiswab + $nilaineb;
		echo '<td align="center">'.$nilaineb.'</td>';
		$kolomb++;
		}
	while ($kolomb<$nsoalb);
	}
	$persentase =round($nilaipersiswa / $skormaks * $skora,2);
	$nilaiulangan = $persentase + $nilaipersiswab;
	
	if ($nilaiulangan < $kkm_ulangan)
		{
		$tuntas = "Tidak";
		}
		else
		{
		$tuntas = "Ya";
		}
	if ($id_analisis == 'kirim')
		{
		//$this->db->query("update `nilai` set `nilai_$ulangan`= '$nilaiulangan' where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis` = '$nis'");
		}
	if ($nsoalb>0)
		{
		echo '<td align="center">'.$persentase.' '.$nilaipersiswab.'</td><td align="center">'.$nilaiulangan.'</td><td align="center">'.$tuntas.'</td>';
		}
		else
		{
		echo '<td align="center">'.$nilaipersiswa.'</td><td align="center">'.$nilaiulangan.'</td><td align="center">'.$tuntas.'</td>';
		}
	//$this->db->query("update `analisis` set `nilai_akhir`= '$nilaiulangan' where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis` = '$nis' and `ulangan`='$ulangan'");

		if($nsoal+$nsoalb>25)
		{
			echo '<td>'.$namasiswa.'</td></tr>';
		}


	$nomor++;	
	}
	echo '<tr bgcolor=""><td align="center"></td><td>Jumlah Nilai</td>';
	$kolom = 0;
	do
	{	
	$nokol = $kolom + 1;
	echo '<td align="center">'.$nil[$kolom].'</td>';
	$kolom++;
	}
	while ($kolom<$nsoal);
	$kolomb = 0;
		do
		{	
		$nokolb = $kolomb + 1;
		echo '<td align="center">'.$nilb[$kolomb].'</td>';
		$kolomb++;
		}
		while ($kolomb<$nsoalb);
	
	if($nsoal+$nsoalb>25)
	{
		echo '<td></td><td></td><td></td><td></td></tr>';
	}
	else
	{
		echo '<td></td><td></td><td></td></tr>';
	}

	echo '<tr><td align="center"></td><td>Rata - rata</td>';
	$kolom = 0;
	do
	{
		if($dipakai == 1)
		{
			$nokol = $kolom + 1;
			$iskor = 's'.$nokol;
		}
		$rata_rata[$kolom] = round($nil[$kolom]/$cacahsiswa,2);
		echo '<td align="center"> '.$rata_rata[$kolom].'</td>';
		$kolom++;
	}
	while ($kolom<$nsoal);
	if ($nsoalb>0)
	{
		$kolomb = 0;
		do
		{
			$rata_ratab[$kolomb] = round($nilb[$kolomb]/$cacahsiswa,2);
			echo '<td align="center">'.$rata_ratab[$kolomb].'</td>';
			$kolomb++;
		}
		while ($kolomb<$nsoalb);
	}
	if($nsoal+$nsoalb>25)
	{
		echo '<td></td><td></td><td></td><td></td></tr>';
	}
	else
	{
		echo '<td></td><td></td><td></td></tr>';
	}
	echo '<tr><td align="center"></td><td>Tingkat Kesukaran</td>';
	$kolom = 0;
	do
	{
		if($dipakai == 1)
		{
			$nokol = $kolom + 1;
			$iskor = 's'.$nokol;
			$skormakspersoal= $a->$iskor;
		}
		$TK = $rata_rata[$kolom]/$skormakspersoal;
		if($TK <= 1)
		{
			$dtk = 'Mdh';
		} 
		if($TK <= 0.7)
		{
			$dtk = 'Sdg';
		} 
		if($TK <= 0.3)
		{
			$dtk = 'Skr';
		} 

		echo '<td align="center"> '.$dtk.'</td>';
		$kolom++;
	}
	while ($kolom<$nsoal);
	if ($nsoalb>0)
	{
		$persoal = $skorb / $nsoalb;
		$kolomb = 0;
		do
		{
			$TKb = $rata_ratab[$kolomb] / $skorb * $nsoalb;	
			if($TKb <= 1)
			{
				$dtkb = 'Mdh';
			} 
			if($TKb <= 0.7)
			{
				$dtkb = 'Sdg';
			} 
			if($TKb <= 0.3)
			{
				$dtkb = 'Skr';
			} 
			echo '<td align="center">'.$dtkb.'</td>';

			$kolomb++;
		}
		while ($kolomb<$nsoalb);
	}
	if($nsoal+$nsoalb>25)
	{
		echo '<td></td><td></td><td></td><td></td></tr>';
	}
	else
	{
		echo '<td></td><td></td><td></td></tr>';
	}


}
else{
echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
}
?>
</table></div></div>
<div class="container-fluid">
<?php
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
<div class="clear padding10"></div>
<button type="submit" class="btn btn-primary">Perbarui Daftar Siswa</button>&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url(); ?>guru/analisis/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/unduh"><b> Unduh Analisis</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>"><b> Analisis Butir Soal</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>gurukeren/dayabeda/<?php echo $id_mapel;?>/<?php echo $ulangan;?>"><b>Cetak Hasil Analisis</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisis/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/unggah"><b> Unggah Analisis</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisis/<?php echo $id_mapel;?>/<?php echo $ulangan;?>/kirim"><b> Kirim ke Daftar Nilai</b></a>
</form>
<?php
}
}
?>
</div>
