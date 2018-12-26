<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: perilaku.php
// Lokasi      		: application/views/kepala
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
echo '<div class="container-fluid">';
echo $aksi;
$tm = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
$xloc = base_url().'kepala/statusppk';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
	<h3>Tahun Penilaian <select name="tahun" onChange="MM_jumpMenu('self',this,0)" class="form-control-static">";
	<?php
	echo '<option value="'.$xloc.'/'.$tahun.'">'.$tahun.'</option>';
	foreach($tm->result() as $m)
	{
	echo '<option value="'.$xloc.'/'.substr($m->thnajaran,0,4).'">'.substr($m->thnajaran,0,4).'</option>';
	}
	echo '</select></h3>';
echo '</form>';
echo '<div class="container-fluid"><h2>Daftar Guru / Pegawai, <small><a href="'.base_url().'kepala/statusppk/'.$tahun.'/nama">Urut Nama</a> <a href="'.base_url().'kepala/statusppk/'.$tahun.'">Urut Status PPK</a></small></h2>';
echo '<div class="table-responsive">
<table class="table table-striped table-bordered table-hover"><tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>PKG</strong></td><td><strong>SKP</strong></td><td><strong>PPK (DP3)</strong></td></tr>';
if($aksi == 'nama')
{
	$ta = $this->db->query("select * from `p_pegawai` where nip !='' and `status`='Y' and `status_tempat_tugas` = '1' order by nama_tanpa_gelar");
		$nomor=1;
	foreach($ta->result() as $a)
	{
		$nip = $a->nip;
		$namapegawai = $a->nama_tanpa_gelar;
		$tb = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and `kode`='$nip'");
		$permanen = '';
		$permanenkepala = '';
		$permanen_pkg = '';
		foreach($tb->result() as $b)
		{
			$permanen = $b->permanen;
			$permanenkepala = $b->kepala;
			$permanen_pkg = $b->permanen_pkg;

		}
		if($permanenkepala == '1')
		{
			echo '<tr class="success"><td>'.$nomor.'</td><td>'.$namapegawai.'<br />'.$nip.'</td>';
		}
		else
		{
			echo '<tr class="danger"><td>'.$nomor.'</td><td>'.$namapegawai.'<br />'.$nip.'</td>';
		}
		if($permanen_pkg == '1')
		{
			echo '<td align="center"><span class="fa fa-check"></span></td>';
		}
		else
		{
			echo '<td align="center"><span class="fa fa-times"></span></td>';
		}
		if($permanen == 1)
		{
			echo '<td align="center"><span class="fa fa-check"></span>';
		}
		else
		{
			echo '<td align="center"><span class="fa fa-times"></span></td>';
		}
		if($permanenkepala == 1)
		{
			echo '<td align="center"><span class="fa fa-check"></span></td>';
		}
		else
		{
			echo '<td align="center"><span class="fa fa-times"></span></td>';
		}
		echo '</tr>';
		$nomor++;

	}

}
else
{
	$ta = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' order by `kepala` ASC");
	$nomor=1;
	foreach($ta->result() as $a)
	{
		$urutan = 1;
		$nip = $a->kode;
		$permanen = $a->permanen;
		$permanenkepala = $a->kepala;
		$permanen_pkg = $a->permanen_pkg;
		$tb = $this->db->query("select * from `p_pegawai`  where nip = '$nip'");
		$namapegawai = '?';
		foreach($tb->result() as $b)
		{
			$namapegawai = $b->nama;
		}
		if($permanenkepala == '1')
		{
			echo '<tr class="success"><td>'.$nomor.'</td><td>'.$namapegawai.'<br />'.$nip.'</td>';
		}
		else
		{
			echo '<tr class="danger"><td>'.$nomor.'</td><td>'.$namapegawai.'<br />'.$nip.'</td>';
		}
		if($permanen_pkg == '1')
		{
			echo '<td align="center"><span class="fa fa-check"></span></td>';
		}
		else
		{
			echo '<td align="center"><span class="fa fa-times"></span></td>';
		}
		if($permanen == 1)
		{
			echo '<td align="center"><span class="fa fa-check"></span>';
		}
		else
		{
			echo '<td align="center"><span class="fa fa-times"></span></td>';
		}
		if($permanenkepala == 1)
		{
			echo '<td align="center"><span class="fa fa-check"></span></td>';
		}
		else
		{
			echo '<td align="center"><span class="fa fa-times"></span></td>';
		}
		echo '</tr>';
		$nomor++;
	}
}
echo '</table></div>';
echo '</div>';
?>
