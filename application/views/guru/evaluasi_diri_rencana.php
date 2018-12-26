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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' '.$tahun;?></h3></div>
<div class="card-body">
<?php
$nomor = 1;
echo '<p class="text-center"><a href="'.base_url().'evaluasi/rencana/'.$tahun.'/ubah" class="btn btn-primary">Ubah Rencana</a> <a href="'.base_url().'evaluasi/rencana/'.$tahun.'/cetak" class="btn btn-success">Cetak Rencana Evaluasi</a></p>';

echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr><td colspan="2" rowspan="3" width="300">A. Kompetensi</td><td rowspan="3">Rencana Pengembangan Keprofesian Berkelanjutan yang akan dilakukan Guru untuk peningkatan kompetensi terkait</td><td colspan="7">Strategi Pengembangan Keprofesian Berkelanjutan</td></tr><tr align="center"><td rowspan="2">1</td><td rowspan="2">2</td><td rowspan="2">3</td><td rowspan="2">4</td><td colspan="2">5</td><td rowspan="2">6</td><tr><td>a</td><td>b</td></tr>';
echo '<tr><td colspan="10">Pedagogik</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'A%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td width="50">'.$nomor.'</td><td width="250">'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
echo '<tr><td colspan="10"><h4>Kepribadian</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'B%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}

	echo '</tr>';
	$nomor++;
}
echo '<tr><td colspan="10"><h4>Sosial</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'C%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
echo '<tr><td colspan="10"><h4>Profesional</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'D%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="10"><h4>Berbagai hal terkait dengan pemenuhan dan peningkatan kompetensi inti tersebut</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'E%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="10"><h4>B. Kompetensi menghasilkan Publikasi Ilmiah</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'F%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="10"><h4>C. Kompetensi menghasilkan Karya Inovatif</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'G%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="10"><h4>D. Kompetensi untuk penunjang pelaksanaan pembelajaran berkualitas (TIK, Bahasa Asing, dsb)</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'H%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="10"><h4>E. Kompetensi penunjang pelaksanaan tugas tambahan</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'I%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-bullseye"></span></td>';
	}
	else
	{
		echo '<td></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}



echo '</table></div>';
echo '<p class="text-info">Catatan:</p>
<ol><li>Rencana pengembangan keprofesian berkelanjutan yang dilakukan oleh guru sendiri</li>
<li>Rencana pengembangan keprofesian berkelanjutan yang dilakukan bersama guru lain</li>
<li>Rencana pengembangan keprofesian berkelanjutan yang dilaksanakan di sekolah</li>
<li>Rencana pengembangan keprofesian berkelanjutan yang dilaksanakan di KKG</li>
<li>Rencana pengembangan keprofesian berkelanjutan yang dilaksanakan oleh institusi selain sekolah atau KKG</li>
<li>Kebutuhan pengembangan keprofesian berkelanjutan yang belum dapat dipenuhi diajukan/di-koordinasikan oleh Dinas  Pendidikan untuk dipertimbangkan</li>
</ol>';
echo '<p class="text-center"><a href="'.base_url().'evaluasi/rencana/'.$tahun.'/ubah" class="btn btn-primary">Ubah Rencana</a> <a href="'.base_url().'evaluasi/rencana/'.$tahun.'/cetak" class="btn btn-success">Cetak Rencana Evaluasi</a></p>';

?>
</div></div></div>
