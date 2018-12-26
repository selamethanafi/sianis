<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: bg_atas_cetak.php
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
</head>
<body>
<div class="potret">
<table width="100%">
<tr><td></td><td width="15%">Lampiran V :</td><td width="40%" colspan="2">Keputusan Menteri Pendidikan</td></tr>
<tr><td></td><td></td><td colspan="2">dan Kebudayaan</td></tr>
<tr><td></td><td></td><td>Nomor</td><td>: 025/O/1995</td></tr>
<tr><td></td><td></td><td>Tanggal</td><td>: 8 Maret 1995</td></tr>
</table>
<br />
<?php
$thnajaran = '2013/2014';
$semester = '1';
?>
<p class="text-center">SURAT PERNYATAAN MELAKUKAN KEGIATAN<br />
PROSES BELAJAR  MENGAJAR ATAU BIMBINGAN</p>
<table width="100%">
<tr><td colspan="3">Yang bertanda tangan di bawah ini :</td></tr>
<tr><td width="5%"><td width="30%">Nama</td><td>: <?php echo cari_kepala_baru($thnajaran,$semester);?></td></tr>
<tr><td></td><td>NIP</td><td>: <?php echo cari_nip_kepala_baru($thnajaran,$semester);?></td></tr>
<?php
	$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
	$usernamekepala = $this->dupak->nip_jadi_username($nipkepala);
	$datapangkatkepala = $this->dupak->datapangkatterakhir($usernamekepala);
?>
<tr><td></td><td>Pangkat / Golongan Ruang / TMT</td><td>: <?php echo $datapangkatkepala['pangkat'].' / '.$datapangkatkepala['gol'].' / '.$datapangkatkepala['tmt'];?></td></tr>
<tr><td></td><td>Jabatan</td><td>: Kepala Madrasah</td></tr>
<tr><td></td><td>Nama dan Alamat Sekolah</td><td>: <?php echo $sek_nama.' '.$sek_alamat;?></td></tr>
<tr><td colspan="3">Menyatakan bahwa :</td></tr>
<tr><td width="5%"><td width="30%">Nama</td><td>: <?php echo $dataguru['nama'];?></td></tr>
<tr><td></td><td>NIP</td><td>: <?php echo $dataguru['nip'];?></td></tr>
<tr><td></td><td>Pangkat / Golongan Ruang / TMT</td><td>: <?php echo $datapangkat['pangkat'].' / '.$datapangkat['gol'].' / '.$datapangkat['tmt'];?></td></tr>
<tr><td></td><td>Jabatan</td><td>: <?php echo $datapangkat['jabatan'];?></td></tr>
<tr><td></td><td>Nama dan Alamat Sekolah</td><td>: <?php echo $this->config->item('sek_nama').' '.$this->config->item('sek_alamat');?></td></tr>
<tr><td></td><td>Jenis guru</td><td>: Guru Mata pelajaran</td></tr>

<tr><td colspan="3">Telah melakukan kegiatan Proses Belajar Mengajar atau Bimbingan mulai tahun pelajaran
<?php
$golongann = Pangkat_Sesudah($golongan);
$ta = $this->db->query("SELECT * FROM `dupak_tapel` where `username` = '$username' and `versi`='0' and `golongan`='$golongann'");
$adata = $ta->num_rows();
$tsemester = 0;
foreach($ta->result() as $a)
{
	$tsemester = $tsemester + $a->semester;
}
$ta = $this->db->query("SELECT * FROM `dupak_tapel` where `username` = '$username' and `versi`='0' and `golongan`='$golongann' order by `tahun` ASC limit 0,1");
$thnajaran = '';
if($adata == 1)
{
	foreach($ta->result() as $a)
	{
		$csemester = $a->semester;
		if($csemester == 1)
		{
			$tahun2 = $a->tahun + 1;
			$thnajaran = $a->tahun.'/'.$tahun2;
		}
		else
		{
			$tahun1 = $a->tahun - 1;
			$tahun2 = $a->tahun + 1;
			$thnajaran = $tahun1.'/'.$a->tahun.' s.d. '.$a->tahun.'/'.$tahun2;
		}
	}
}
else
{
	foreach($ta->result() as $a)
	{
		$csemester = $a->semester;
		if($csemester == 1)
		{
			$tahun2 = $a->tahun + 1;
			$thnajaran = $a->tahun.'/'.$tahun2;
		}
		else
		{
			$tahun1 = $a->tahun - 1;
			$thnajaran = $tahun1.'/'.$a->tahun;
		}
	}
}
$t1 = substr($thnajaran,0,4);
$t2 = substr($thnajaran,0,4);
$th1 = substr($thnajaran,5,4);
$th2 = substr($thnajaran,5,4);
echo ' '.$thnajaran;
if($adata>1)
{
	$ta = $this->db->query("SELECT * FROM `dupak_tapel` where `username` = '$username' and `versi`='0' and `golongan`='$golongann' order by `tahun` DESC limit 0,1");
	$thnajaran = '';
	foreach($ta->result() as $a)
	{
		$csemester = $a->semester;
		if($csemester == 1)
		{
			$tahun1 = $a->tahun - 1;
			$thnajaran = $tahun1.'/'.$a->tahun;
		}
		else
		{
			$tahun2 = $a->tahun + 1;
			$thnajaran = $a->tahun.'/'.$tahun2;
		}
	}
	echo ' s.d. '.$thnajaran;
	$t2 = substr($thnajaran,0,4);
}
?>
</td></tr>
</table>
<table width="100%" class="table table-bordered">
<tr><td align="center" rowspan="2" width="25">No</td><td align="center" rowspan="2">KEGIATAN</td>
<?php
//echo $t2.' '.$t1;
$selisih = $t2 - $t1;
//echo 'selisih '.$selisih;
$kolom = 0;
if($t2 == $t1)
{
	echo '<td colspan="2" align="center">'.$thnajaran.'</td>';
	$kolom = 2;
}
else
{
	for($i=0;$i<=$selisih;$i++)
	{
		$tt1 = $t1 + $i;
		$tth1 = $th1 + $i;
		if($tt1 == '2013')
		{
			echo '<td align="center">'.$tt1.'/<br />'.$tth1.'</td>';
			$kolom = $kolom + 1;
		}
		else
		{
			echo '<td colspan="2" align="center">'.$tt1.'/'.$tth1.'</td>';
			$kolom = $kolom + 2;
		}

	}
}
echo '<tr>';
if($t2 == $t1)
{
	echo '<td align="center">Smt 1</td><td align="center">Smt 2</td>';
}
else
{
	for($i=0;$i<=$selisih;$i++)
	{
		$tt1 = $t1 + $i;
		$tth1 = $th1 + $i;
		if($tt1 == '2013')
		{
			echo '<td align="center" width="50">Smt 1</td>';
		}
		else
		{
			echo '<td align="center" width="50">Smt 1</td><td width="50" align="center">Smt 2</td>';
		}

	}
}
?>
</tr>

<?php
$dibagi = $tsemester / 2;
$bulat = round($dibagi,0);
echo '<tr><td>1</td><td>Menyusun Program Pengajaran</td>';
if($dibagi == $bulat) // genap
{
	echo '<td align="center"></td>';
	for($i=1;$i<$kolom;$i++)
	{
		echo '<td align="center">'.$tsemester.'</td>';
	}
}
else
{
	for($i=1;$i<=$kolom;$i++)
	{
		echo '<td align="center">V</td>';
	}
}
echo '</tr>';
echo '<tr><td>2</td><td>Penyajian Program Pengajaran</td>';
if($dibagi == $bulat) // genap
{
	echo '<td align="center"></td>';
	for($i=1;$i<$kolom;$i++)
	{
		echo '<td align="center">'.$tsemester.'</td>';
	}
}
else
{
	for($i=1;$i<=$kolom;$i++)
	{
		echo '<td align="center">V</td>';
	}
}
echo '</tr>';
echo '<tr><td>3</td><td>Melaksanakan Evaluasi Belajar</td>';
if($dibagi == $bulat) // genap
{
	echo '<td align="center"></td>';
	for($i=1;$i<$kolom;$i++)
	{
		echo '<td align="center">'.$tsemester.'</td>';
	}
}
else
{
	for($i=1;$i<=$kolom;$i++)
	{
		echo '<td align="center">V</td>';
	}
}
echo '</tr>';
echo '<tr><td>4</td><td>Melaksanakan Analisis Hasil Evaluasi Belajar</td>';
if($dibagi == $bulat) // genap
{
	echo '<td align="center"></td>';
	for($i=1;$i<$kolom;$i++)
	{
		echo '<td align="center">'.$tsemester.'</td>';
	}
}
else
{
	for($i=1;$i<=$kolom;$i++)
	{
		echo '<td align="center">V</td>';
	}
}
echo '</tr>';
echo '<tr><td>5</td><td>Melaksanakan Program Perbaikan dan Pengayaan</td>';
if($dibagi == $bulat) // genap
{
	echo '<td align="center"></td>';
	for($i=1;$i<$kolom;$i++)
	{
		echo '<td align="center">'.$tsemester.'</td>';
	}
}
else
{
	for($i=1;$i<=$kolom;$i++)
	{
		echo '<td align="center">V</td>';
	}
}
echo '</tr>';

?>
</table>
Demikian pernyataan ini dibuat dengan melampirkan hasil penilaian kinerja dan bukti fisik masing - masing,untuk dapat dipergunakan sebagaimana mestinya.<br />
<?php
$thnajaran = '2013/2014';
$semester = '1';
$datamasa = $this->dupak->datamasa($nim,$golongann);
		echo '<table width="100%">
		<tr><td width="10%"></td><td></td><td  width="40%">'.$this->config->item('lokasi').',  31 Desember 2014</td></tr>
		<tr><td></td><td></td><td>Kepala Sekolah,<br /><br /><br /></td></tr>
		<tr><td></td><td></td><td>'.cari_kepala_baru($thnajaran,$semester).'<br />NIP '.cari_nip_kepala_baru($thnajaran,$semester).'</td></tr>
		</table>';
?>
</div>
</body>
</html>
