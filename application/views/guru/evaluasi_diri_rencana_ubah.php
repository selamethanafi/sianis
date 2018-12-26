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
$item = 1;
echo form_open('evaluasi/simpanrencana/'.$tahun,'class="form-horizontal" role="form"');
echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr><td colspan="2" width="300">A. Kompetensi</td><td>Rencana Pengembangan Keprofesian Berkelanjutan yang akan dilakukan Guru untuk peningkatan kompetensi terkait</td><td>Strategi Pengembangan Keprofesian Berkelanjutan</td></tr>';
echo '<tr><td colspan="4">Pedagogik</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'A%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td width="50">'.$nomor.'</td><td width="250">'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';
	$nomor++;
	$item++;
}
echo '<tr><tdcolspan="4"><h4>Kepribadian</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'B%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';
	$nomor++;
	$item++;
}
echo '<tr><td colspan="4"><h4>Sosial</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'C%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value=""></option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';

	$nomor++;
	$item++;
}
echo '<tr><td colspan="4"><h4>Profesional</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'D%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';

	$nomor++;
	$item++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>Berbagai hal terkait dengan pemenuhan dan peningkatan kompetensi inti tersebut</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'E%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';

	$nomor++;
	$item++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>B. Kompetensi menghasilkan Publikasi Ilmiah</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'F%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';

	$nomor++;$item++;
}
$nomor = 1;
echo '<tr><tdcolspan="4"><h4>C. Kompetensi menghasilkan Karya Inovatif</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'G%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';

	$nomor++;$item++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>D. Kompetensi untuk penunjang pelaksanaan pembelajaran berkualitas (TIK, Bahasa Asing, dsb)</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'H%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';

	$nomor++;
	$item++;
}
$nomor = 1;
echo '<tr><tdcolspan="4"><h4>E. Kompetensi penunjang pelaksanaan tugas tambahan</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'I%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="rencana_'.$item.'" class="form-control">'.$a->rencana.'</textarea></td>';
	echo '<td align="center"><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"><select name="oleh_'.$item.'" class="form-control">';
	if ($a->oleh == 1)
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<option value="3">sekolah</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<option value="4">KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<option value="7">Kemenag</option>';
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
	}
	else
	{
		echo '<option value="1">guru ybs</option>';
		echo '<option value="2">guru ybs bersama guru lain</option>';
		echo '<option value="3">sekolah</option>';
		echo '<option value="4">KKG</option>';
		echo '<option value="5">selain sekolah atau KKG</option>';
		echo '<option value="7">Kemenag</option>';
	}
	echo '</select></td></tr>';

	$nomor++;$item++;
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
$cacah_item = $item - 1;
echo '<input type="hidden" name="cacah_indikator" value="'.$cacah_item.'">';

?>
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
</form>
</div></div></div>
