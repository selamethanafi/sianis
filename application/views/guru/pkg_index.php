<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:58:42 WIB 
// Nama Berkas 		: pkg_index.php
// Lokasi      		: application/views/guru/
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
<?php
$tahun = $tahunpenilaian;
$namapenilai = '';
$nippenilai = '';
$tanggal = '';
$tahunkemarin = $tahun - 1;
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' '.$tahun;?></h3></div>
<div class="card-body">
<?php echo $alert;
$tx = $this->db->query("select * from p_pegawai where `kd`='$nim'");
foreach($tx->result() as $x)
{
	$nippegawai = $x->nip;
}
$gurubk = 0;
$jskore2 = 0;
$tc = $this->db->query("select * from `gurubk` where `nip` = '$nippegawai'");
if($tc->num_rows()>0)
{
	$gurubk = 1;
}
$tf = $this->db->query("select * from `pkg_tim_penilai` where `kode_ternilai` = '$nippegawai' and `tahun`='$tahun'");
foreach($tf->result() as $f)
{
	$nippenilai = $f->kode_penilai;
	$namapenilai = $f->nama_penilai;
	$tanggal = $f->tanggal;
}
echo '<h4>Data Penilai PKG</h4>';
echo '<div class="table-responsive"><table class="table"><tr><td>Nama</td><td>: '.$namapenilai.'</td></tr><tr><td>NIP Penilai</td><td>: '.$nippenilai.' <a href="'.base_url().'pkg/penilai">Ubah Penilai</a></td></tr><tr><td>Tanggal PKG</td><td>: '.date_to_long_string($tanggal).' <a href="'.base_url().'pkg/penilai">Ubah Tanggal</a></td></tr>';

echo '</table></div>';
if($gurubk == 1)
{
	echo '<h4>Daftar Kompetensi Guru BK</h4>';
	$totalskorpkg = 68;
	$totalskorpkgkemarin = 68;
}
else
{
	echo '<h4>Daftar Kompetensi Guru</h4>';
	$totalskorpkg = 56;
	$totalskorpkgkemarin = 56;
}
?>

<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr><td>Nomor</td><td>Kompetensi</td><td>Skor <?php echo $tahunkemarin;?></td><td>Skor</td><td>Langsung</td>
<?php
if($gurubk == 0)
{
	echo '<td>Rinci</td>';
}
echo '</tr>';
$nomor =1;
if($gurubk == 1)
{
	$ta = $this->db->query("select * from pkg_m_kompetensi where untuk='bk' order by nourut");
}
else
{
	$ta = $this->db->query("select * from pkg_m_kompetensi where untuk='guru' order by nourut");
}

$jskor = 0;
$jskorkemarin = 0;
foreach($ta->result() as $a)
{
	$skor = 0;
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$nskorkemarin = 0;
	$cacah_indikator = 0;
	$cacah_indikatorkemarin = 0;
	foreach($tb->result() as $b)
	{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");

		foreach($tc->result() as $c)
		{
			$nskor = $nskor + $c->skor;
		}
		$tckemarin = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahunkemarin'");

		foreach($tckemarin->result() as $ckemarin)
		{
			$nskorkemarin = $nskorkemarin + $ckemarin->skor;
		}

		$cacah_indikator++;
		$cacah_indikatorkemarin++;
	}
	$skormaks = 2 * $cacah_indikator;
	if($skormaks > 0)
	{
		$persentase = $nskor / $skormaks * 100;
	}
	else
	{
		$persentase = 0;
	}

	$nilai = 0;
	if (($persentase > 0) and ($persentase<=25))
	{
		$nilai = 1;
	}
	if (($persentase > 25) and ($persentase<=50))
	{
		$nilai = 2;
	}
	if (($persentase > 50) and ($persentase<=75))
	{
		$nilai = 3;
	}
	if ($persentase > 75)
	{
		$nilai = 4;
	}
	$jskor = $jskor + $nilai;
	// kemarin
	$skormakskemarin = 2 * $cacah_indikatorkemarin;
	if($skormakskemarin > 0)
	{
		$persentasekemarin = $nskorkemarin / $skormakskemarin * 100;
	}
	else
	{
		$persentasekemarin = 0;
	}

	$nilaikemarin = 0;
	if (($persentasekemarin > 0) and ($persentasekemarin<=25))
	{
		$nilaikemarin = 1;
	}
	if (($persentasekemarin > 25) and ($persentasekemarin<=50))
	{
		$nilaikemarin = 2;
	}
	if (($persentasekemarin > 50) and ($persentasekemarin<=75))
	{
		$nilaikemarin = 3;
	}
	if ($persentasekemarin > 75)
	{
		$nilaikemarin = 4;
	}
	$jskorkemarin = $jskorkemarin + $nilaikemarin;

	echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->kompetensi.'</td><td align="center">'.$nilaikemarin.'</td><td align="center">'.$nilai.'</td>';
	if($status_pkg == '1')
	{
		if($gurubk == 0)
		{
			echo '<td></td><td></td></tr>';
		}
		else
		{
			echo '<td></td></tr>';
		}

	}
	else
	{
		echo '<td align="center"><a href="'.base_url().'pkg/entry/'.$a->id_pkg_m_kompetensi.'"><span class="fa fa-bullseye"></span></a></td>';
		if($gurubk == 0)
		{
			echo '<td align="center"><a href="'.base_url().'pkg/proses/'.$a->id_pkg_m_kompetensi.'"><span class="fa fa-bullseye"></span></a></td>';
		}
		echo '</tr>';
	}
	$nomor++;
}

$jskore = $jskor / $totalskorpkg * 100;
$sebutan = '<div class="alert alert-danger">Buruk</div>';
if ($jskore > 76)
	{
	$sebutan = '<div class="alert alert-success">Baik</div>';
	}
if ($jskore == 76)
	{
	$sebutan = '<div class="alert alert-success">Baik</div>';
	}
if ($jskore == 91)
	{
	$sebutan = '<div class="alert alert-success">Amat Baik</div>';
	}

if ($jskore > 91)
	{
	$sebutan = '<div class="alert alert-success">Amat Baik</div>';
	}
//kemarin
$jskorekemarin = $jskorkemarin / $totalskorpkgkemarin * 100;
$sebutankemarin = '<div class="alert alert-danger">Buruk</div>';
if ($jskorekemarin > 76)
	{
	$sebutankemarin = '<div class="alert alert-success">Baik</div>';
	}
if ($jskorekemarin == 76)
	{
	$sebutankemarin = '<div class="alert alert-success">Baik</div>';
	}
if ($jskorekemarin == 91)
	{
	$sebutankemarin = '<div class="alert alert-success">Amat Baik</div>';
	}

if ($jskorekemarin > 91)
	{
	$sebutankemarin = '<div class="alert alert-success">Amat Baik</div>';
	}

echo '<tr><td colspan="2">Jumlah Skor</td><td align="center">'.$jskorkemarin.''.$sebutankemarin.'</td><td align="center">'.$jskor.'</td><td colspan="2">'.$sebutan.'</td></tr></table></div>';
if($gurubk == 0)
{
?>
<h3>Tugas Tambahan</h3>
<?php
$tahun = $tahunpenilaian;
	//2014 JADI 2014/2015 SMT 1
	$awal = $tahunpenilaian;
	$akhir = $tahunpenilaian+1;
	$thnajaran = $awal."/".$akhir;
	$semester = 1;
	echo '<h4>Tahun '.$tahun.' Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'</h4>';
	$skorex=2;
	$untuk='xxxxx';
	$tat = $this->db->query("select * from `p_tugas_tambahan` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and semester='$semester'");
	if(count($tat->result())>0)
	{
		foreach($tat->result() as $at)
		{
			$tambahan = $at->nama_tugas;
			if (substr($tambahan,0,10)=='Kepala Mad')
			{
				$untuk = 'kepala madrasah';
				$skorx = 4;
			}
			if (substr($tambahan,0,18)=='Waka Madrasah Kuri')
			{
				$untuk = 'waka kurikulum';
				$skorx = 4;
			}
			if (substr($tambahan,0,18)=='Waka Madrasah Sara')
			{
				$untuk = 'waka sarana';
				$skorx = 4;
			}
			if (substr($tambahan,0,18)=='Waka Madrasah Kesi')
			{
				$untuk = 'waka kesiswaan';
				$skorx = 4;
			}
			if (substr($tambahan,0,18)=='Waka Madrasah Huma')
			{
				$untuk = 'waka humas';
				$skorx = 4;
			}
			if (substr($tambahan,0,18)=='Kepala Laboratoriu')
			{
				$untuk = 'kepala laboratorium';
				$skorx = 4;
			}
			if (substr($tambahan,0,18)=='Kepala Perpustakaa')
			{
				$untuk = 'kepala perpustakaan';
				$skorx = 4;
			}
		}
	}
	if ($untuk != 'xxxxx')
	{
		echo '<h4>Tugas Tambahan : '.$tambahan.'</h4>';
		$nomor =1;
		$jskor2 = 0;
		$cacah_kompetensi2 = 0;
		$tb = $this->db->query("select * from pkg_m_kompetensi where untuk='$untuk' order by nourut");	
		echo '<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
		<tr align="center"><td>Nomor</td><td>Kompetensi</td><td width="50">Skor</td><td width="50">Langsung</td><td width="50">Rinci</td></tr>';
		foreach($tb->result() as $a)
		{
			$id_kompetensi = $a->id_pkg_m_kompetensi;
			echo '<tr><td width="50" align="center">'.$nomor.'</td><td>'.$a->kompetensi.'</td>';
			//cari indikator
			$tf = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
			$nskor2 = 0;
			$cacah_indikator2 = 0;
			foreach($tf->result() as $f)
			{
				$id_indikator = $f->id_pkg_m_indikator;
				//cari skor per indikator
				$tg = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahunpenilaian'");
				foreach($tg->result() as $g)
				{
					$nskor2 = $nskor2 + $g->skor;
				}
				$cacah_indikator2++;
			}
			$rata2 = $nskor2 / $cacah_indikator2;
			$jskor2 = $jskor2 + $rata2;
			echo '<td align="center">'.round($rata2,2).'</td>';
			if($status_pkg == '1')
			{
				if($gurubk == 0)
				{
					echo '<td></td><td></td></tr>';
				}
				else
				{
					echo '<td></td></tr>';
				}
			}
			else
			{
				echo '<td align="center"><a href="'.base_url().'pkg/tambahan/'.$a->id_pkg_m_kompetensi.'"><span class="fa fa-edit"></span></a></td>
				<td align="center"><a href="'.base_url().'pkg/prosestambahan/'.$a->id_pkg_m_kompetensi.'"><span class="fa fa-edit"></span></a></td></tr>';
			//echo '<a href="'.base_url().'pkg/tambahan/'.$a->id_pkg_m_kompetensi.'">'.$a->kompetensi.'</a>';
			}
			$nomor++;
			$cacah_kompetensi2++;
		}
		$cacah_kompetensi2 = $nomor - 1;
		$skortertinggi = $skorx * $cacah_kompetensi2;
		if ($skortertinggi > 0 )
		{
			$jskore2 = $jskor2 / $skortertinggi * 100;
		}
		else
		{
			$jskore2 = 0;
		}
		$sebutan2 = '<div class="alert alert-danger">Buruk</div>';
		if ($jskore2 > 76)
		{
			$sebutan2 = '<div class="alert alert-success">Baik</div>';
		}
		if ($jskore2 == 76)
		{
			$sebutan2 = '<div class="alert alert-success">Baik</div>';
		}
		if ($jskore2 == 91)
		{
			$sebutan2 = '<div class="alert alert-warning">Amat Baik</div>';
		}
		if ($jskore2 > 91)
		{
			$sebutan2 = '<div class="alert alert-warning">Amat Baik</div>';
		}
		echo '<tr><td></td><td align="center">Total Skor Rata - rata</td><td align="center" colspan="3">'.round($jskor2,2).'</td></tr>
<tr><td></td><td align="center">Persentase Skor</td><td align="center" colspan="3">'.round($jskore2,2).'</td></tr><tr><td></td><td align="center">Sebutan</td><td align="center" colspan="3">'.$sebutan2.'</td></tr></table>';
		
		echo '</table></div>';
	}
	else
	{
		echo 'Galat, Anda tidak mendapat tugas tambahan atau belum membuat tugas tambahan';
	}
//akhir tugas tambahan
}
if($status_pkg != '1')
{
	echo '<p class="text-center"><a href="'.base_url().'pkg/permanenpkg" class="btn btn-primary">PERMANENKAN PKG</a></p>';
}
else
{
	$npk = 25;
	if (($jskore>51) or ($jskore==51))
	{
		$npk = 50;
	}
	if (($jskore>61) or ($jskore==61))
	{
		$npk = 75;
	}
	if (($jskore>76) or ($jskore==76))
	{
		$npk = 100;
	}
	if ( ($jskore>91) or ($jskore==91))
	{
		$npk = 125;
	}
	$npk2 = 0;
	if (($jskore2>51) or ($jskore2==51))
	{
		$sebutan = 'Sedang';
		$npk2 = 50;
	}
	if (($jskore2>61) or ($jskore2==61))
	{
		$sebutan = 'Cukup';
		$npk2 = 75;
	}
	if (($jskore2>76) or ($jskore2==76))
	{
		$sebutan = 'Baik';
		$npk2 = 100;
	}
	if ( ($jskore2>91) or ($jskore2==91))
	{
		$sebutan = 'Amat Baik';
		$npk2 = 125;
	}
	$this->db->query("update `ppk_pns` set `pkg`='$npk', `pkg_tambahan` = '$npk2' where `tahun`='$tahun' and `kode`='$kodeguru'");
	echo '<p class="text-center">';
	?><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/pkg/<?php echo $tahunpenilaian.'/'.$kodeguru.'';?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-success"><strong>Cetak Hasil PKG</strong></a> 
	<?php
	echo '<a href="'.base_url().'pkg/permanenpkg/batal" class="btn btn-primary">BATAL PERMANEN PKG</a></p>';
}
?>

</div></div></div>
