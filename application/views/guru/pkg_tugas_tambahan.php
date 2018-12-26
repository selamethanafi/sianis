<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 04 Nov 2014 22:51:02 WIB 
// Nama Berkas 		: pkg_tugas_tambahan.php
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
<div class="container-fluid"><h2>Modul Penilaian Kinerja Guru Mendapat Tugas Tambahan</h2>
<?php
/*
kalab 15 - 21
kurikulum 22 - 26
sarana 27 - 31
siswa 32 - 36
humas 37 -41
kamad 52 - 57
kapus 42 - 51
*/
//cek apakah mendapat tugas tambahan
$tahun = $tahunpenilaian;
$awal = $tahunpenilaian;
$akhir = $tahunpenilaian+1;
$thnajaran = $awal."/".$akhir;
$semester = 1;
echo '<h4>Tahun '.$tahun.' Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'</h4>';
$skorex=2;
$untuk='xxxxx';
$bisa = 0;
$ta = $this->db->query("select * from `p_tugas_tambahan` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and semester='$semester'");
if(count($ta->result())>0)
{
	foreach($ta->result() as $a)
	{
		$tambahan = $a->nama_tugas;
		$next='';
		$prev = '';
		if (substr($tambahan,0,10)=='Kepala Mad')
		{
			$untuk = 'kepala madrasah';
			$skorx = 4;
			if(($id>=52) and ($id<=57))
			{
				$bisa = 1;
			}
			if(($id>52) and ($id<=57))
			{
				$prev = $id - 1;
			}
			if(($id>=52) and ($id<57))
			{
				$next = $id + 1;
			}

		}
		if (substr($tambahan,0,18)=='Waka Madrasah Kuri')
		{
			$untuk = 'waka kurikulum';
			$skorx = 4;
			if(($id>=22) and ($id<=26))
			{
				$bisa = 1;
			}
			if(($id>22) and ($id<=26))
			{
				$prev = $id - 1;
			}
			if(($id>=22) and ($id<26))
			{
				$next = $id + 1;
			}

		}
		if (substr($tambahan,0,18)=='Waka Madrasah Sara')
		{
			$untuk = 'waka sarana';
			$skorx = 4;
			if(($id>=27) and ($id<=31))
			{
				$bisa = 1;
			}
			if(($id>27) and ($id<=31))
			{
				$prev = $id - 1;
			}
			if(($id>=27) and ($id<31))
			{
				$next = $id + 1;
			}

		}
		if (substr($tambahan,0,18)=='Waka Madrasah Kesi')
		{
			$untuk = 'waka kesiswaan';
			$skorx = 4;
			if(($id>=32) and ($id<=36))
			{
				$bisa = 1;
			}
			if(($id>32) and ($id<=36))
			{
				$prev = $id - 1;
			}
			if(($id>=32) and ($id<36))
			{
				$next = $id + 1;
			}

		}
		if (substr($tambahan,0,18)=='Waka Madrasah Huma')
		{
			$untuk = 'waka humas';
			$skorx = 4;
			if(($id>=37) and ($id<=41))
			{
				$bisa = 1;
			}
			if(($id>37) and ($id<=41))
			{
				$prev = $id - 1;
			}
			if(($id>=37) and ($id<41))
			{
				$next = $id + 1;
			}

		}
		if (substr($tambahan,0,18)=='Kepala Laboratoriu')
		{
			$untuk = 'kepala laboratorium';
			$skorx = 4;
			if(($id>=15) and ($id<=21))
			{
				$bisa = 1;
			}
			if(($id>15) and ($id<=21))
			{
				$prev = $id - 1;
			}
			if(($id>=15) and ($id<21))
			{
				$next = $id + 1;
			}

		}
		if (substr($tambahan,0,18)=='Kepala Perpustakaa')
		{
			$untuk = 'kepala perpustakaan';
			$skorx = 4;
			if(($id>=42) and ($id<=51))
			{
				$bisa = 1;
			}
			if(($id>42) and ($id<=51))
			{
				$prev = $id - 1;
			}
			if(($id>=42) and ($id<51))
			{
				$next = $id + 1;
			}

		}
	}

}
if (empty($id))
{
	?>
	<p><a href="<?php echo base_url(); ?>pkg" class="btn btn-danger"><b>Kembali ke PKG</b></a></p>
	<?php
	$bisa = 1;
}
else
{

	if($bisa == 1)
	{
		echo '<p><a href="'.base_url().'pkg/tambahan" class="btn btn-success"><b>Kembali ke PKG Tugas Tambahan</b></a>';
		if(!empty($prev))
		{
			echo ' <a href="'.base_url().'pkg/tambahan/'.$prev.'" class="btn btn-info"><b>Sebelumnya</b></a>';
		}
		if(!empty($next))
		{
			echo ' <a href="'.base_url().'pkg/tambahan/'.$next.'" class="btn btn-primary"><b>Berikutnya</b></a>';
		}

	}
	else
	{
		echo '<p><a href="'.base_url().'pkg" class="btn btn-success"><b>Kembali ke PKG</b></a></p>';
	}
}
if ($untuk != 'xxxxx')
{
	if($bisa == 0)
	{
		echo '<div class="alert alert-info">Galat, indikator penilaian tidak tepat</div>';
	}
	else
	{
		echo '<h4>Tugas Tambahan : '.$tambahan.'</h4>';
		if (!empty($id))
		{
			$tc = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id' order by nourut");
			foreach($tc->result() as $c)
			{
				$id_indikator = $c->id_pkg_m_indikator;
				//cari di nilai guru
				$td = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");
				if(count($td->result())==0)
				{
					$this->db->query("insert into  pkg_t_nilai (`id_indikator`,`nip`,`tahun`) values ('$id_indikator','$nippegawai','$tahun')");
				}
			}
			$kompetensi = id_ke_kompetensi_guru($id);
			?>
			<table class="table table-bordered">
			<tr><td><strong>Tahun Pelajaran.</strong></td><td><strong><?php echo $thnajaran?></strong></td></tr>
			<tr><td><strong>Semester</strong></td><td><strong><?php echo $semester;?></strong></td></tr>
			<tr><td><strong>Komponen</strong></td><td><strong><?php echo $kompetensi;?></strong></td></tr>
			</table>
			<?php echo form_open('pkg/updateskorpkg','class="form-horizontal" role="form"');?>
			<table class="table table-striped table-hover table-bordered">
			<tr align="center"><td><strong>No.</strong></td><td><strong>Kriteria</strong></td><td><strong>Skor</strong></td><td><strong>Ubah Skor</strong></td></tr>
			<?php
			$td = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id' order by nourut");
			$nomor = 1;
			$jskor = 0;
			foreach($td->result() as $d)
			{
				$id_indikator = $d->id_pkg_m_indikator;
				echo "<tr><td align='center'>".$nomor."</td><td>".$d->indikator."</td><td align='center'>";
				//cari nilai
				$te = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");
				foreach($te->result() as $e)
				{
					$skore = $e->skor;
					$id_pkg_t_nilai = $e->id_pkg_t_nilai;
				}
				echo ''.$skore.'</td><td>';
				echo '<select name="skor_'.$nomor.'" class="form-control">';
				if ($skore == 1)
				{
					$skorh = 'Bukti tidak ada';
					echo '<option value="'.$skore.'">'.$skorh.'</option>';
					echo '<option value="4">Bukti sangat meyakinkan</option>';
					echo '<option value="3">Bukti meyakinkan</option>';
					echo '<option value="2">Bukti tidak menyakinkan</option>';
					echo '</select>';
				}
				elseif ($skore == 2)
				{
					$skorh = 'Bukti tidak meyakinkan';
					echo '<option value="'.$skore.'">'.$skorh.'</option>';
					echo '<option value="4">Bukti sangat meyakinkan</option>';
					echo '<option value="3">Bukti meyakinkan</option>';
					echo '<option value="1">Bukti tidak ada</option></select>';
				}
				elseif ($skore == 3)
				{
					$skorh = 'Bukti meyakinkan';
					echo '<option value="'.$skore.'">'.$skorh.'</option>';
					echo '<option value="4">Bukti sangat meyakinkan</option>';
					echo '<option value="2">Bukti tidak meyakinkan</option>';
					echo '<option value="1">Bukti tidak ada</option></select>';
				}
				elseif ($skore == 4) 
				{
					$skorh = 'Bukti sangat meyakinkan';
					echo '<option value="'.$skore.'">'.$skorh.'</option>';
					echo '<option value="3">Bukti meyakinkan</option>';
					echo '<option value="2">Bukti tidak meyakinkan</option>';
					echo '<option value="1">Bukti tidak ada</option></select>';
				}
				else
				{
					$skorh = 'Bukti tidak ada';
					echo '<option value="1">'.$skorh.'</option>';
					echo '<option value="4">Bukti sangat meyakinkan</option>';
					echo '<option value="3">Bukti meyakinkan</option>';
					echo '<option value="2">Bukti tidak meyakinkan</option></select>';
				}
				echo '<input type="hidden" name="id_pkg_t_nilai_'.$nomor.'"  value ='.$id_pkg_t_nilai.'>';
				echo "</td></tr>";
				$jskor = $jskor + $skore;
				$nomor++;
			}
			$cacah_indikator = $nomor - 1;
			echo '<tr><td></td><td align="center">Jumlah Skor</td><td align="center">'.$jskor.'</td><td align="center">
			<input type="hidden" name="cacah_indikator"  value ="'.$cacah_indikator.'">
			<input type="hidden" name="tugas_tambahan"  value ="'.$untuk.'">
			<input type="hidden" name="id_kompetensi"  value ="'.$id.'"><input type="submit" value="Perbarui Skor" class="btn btn-primary"></td></tr>';
			$ratarata = $jskor / $cacah_indikator;
			echo '<tr><td></td><td align="center">Skor rata rata</td><td align="center">'.round($ratarata,2).'</td><td></td></tr>
			</table></form>';
		}
		else
		{
			$jskor = 0;
			$nomor =1;
			$cacah_kompetensi = 0;
			$tb = $this->db->query("select * from pkg_m_kompetensi where untuk='$untuk' order by nourut");	
			echo '<table class="table table-hover table-striped table-bordered">
			<tr align="center"><td>Nomor</td><td>Kompetensi</td><td width="50">Skor</td><td width="50">Langsung</td><td width="50">Rinci</td></tr>';
			foreach($tb->result() as $a)
			{
				$id_kompetensi = $a->id_pkg_m_kompetensi;
				echo '<tr><td width="50" align="center">'.$nomor.'</td><td>'.$a->kompetensi.'</td>';
				//cari indikator
				$tf = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
				$nskor = 0;
				$cacah_indikator = 0;
				foreach($tf->result() as $f)
				{
					$id_indikator = $f->id_pkg_m_indikator;
					//cari skor per indikator
					$tg = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahunpenilaian'");
					foreach($tg->result() as $g)
					{
						$nskor = $nskor + $g->skor;
					}
					$cacah_indikator++;
				}
				$rata = $nskor / $cacah_indikator;
				$jskor = $jskor + $rata;
				echo '<td align="center">'.round($rata,2).'</td>';
				echo '<td align="center"><a href="'.base_url().'pkg/tambahan/'.$a->id_pkg_m_kompetensi.'"><span class="fa fa-edit"></span></a></td>
				<td align="center"><a href="'.base_url().'pkg/prosestambahan/'.$a->id_pkg_m_kompetensi.'"><span class="fa fa-edit"></span></a></td></tr>';
				//echo '<a href="'.base_url().'pkg/tambahan/'.$a->id_pkg_m_kompetensi.'">'.$a->kompetensi.'</a>';
				$nomor++;
				$cacah_kompetensi++;
			}
			$cacah_kompetensi = $nomor - 1;
			$skortertinggi = $skorx * $cacah_kompetensi;
			if ($skortertinggi > 0 )
			{
				$jskore = $jskor / $skortertinggi * 100;
			}
			else
			{
				$jskore = 0;
			}
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
				$sebutan = '<div class="alert alert-warning">Amat Baik</div>';
			}
			if ($jskore > 91)
			{
				$sebutan = '<div class="alert alert-warning">Amat Baik</div>';
			}
			echo '<tr><td></td><td align="center">Total Skor Rata - rata</td><td align="center" colspan="3">'.round($jskor,2).'</td></tr>
<tr><td></td><td align="center">Persentase Skor</td><td align="center" colspan="3">'.round($jskore,2).'</td></tr><tr><td></td><td align="center">Sebutan</td><td align="center" colspan="3">'.$sebutan.'</td></tr></table>';
		}
	}
}
else
{
echo 'Galat, Anda tidak mendapat tugas tambahan atau belum membuat tugas tambahan';
}
?>
</div>
<div class="clear padding40"></div>

</div>
