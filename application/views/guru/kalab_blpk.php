<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kalab_blpk.php
// Lokasi      : application/views/guru
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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

echo '<div class="container-fluid">
<div class="card">
<div class="card-header"><h3>'.$judulhalaman.' '.$namatugas.'</h3></div>
<div class="card-body">';
if (empty($id))
	{
	echo '<div class="alert alert-warning>"><strong>Galat, parameter id tugas tambahan tidak disertakan (kosong)</strong></div>';
	echo 'Kalau Halaman ini tidak berpindah, klik  <a href="'.base_url().''.$tugase.'" class="btn btn-info">di sini</a>';
	}
if (!empty($id))
	{
	$ta = $this->db->query("select * from `p_tugas_tambahan` where kodeguru='$kodeguru'  and id_tambahan= '$id'");
	$ada = $ta->num_rows();
	if ($ada == 0)
		{
		echo '<div class="alert alert-warning>"><strong>Galat, Anda tidak dapat mengakses data tugas tambahan ini</strong>';
		echo 'Kalau Halaman ini tidak berpindah, klik  <a href="'.base_url().''.$tugase.'" class="btn btn-info">di sini</a>';
		}
		else
		{
		echo '<p><a href="'.base_url().''.$tugase.'" class="btn btn-primary">Menu Utama '.$namatugas.'</a></p>';
			$thnajaran = '';
			$semester = '';

		foreach($ta->result() as $a)
			{
			$thnajaran = $a->thnajaran;
			$semester = $a->semester;
			}
		$query = $this->db->query("select * from `kalab_harian` where kodeguru='$kodeguru'  and thnajaran = '$thnajaran' and `semester`='$semester' order by tanggal DESC");
		$nomor=1;
		if(count($query->result())>0)
			{
				echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>Tahun Pelajaran</strong></td><td rowspan="2"><strong>Semester</strong></td><td rowspan="2"><strong>Tanggal</strong></td><td rowspan="2"><strong>Nama Kegiatan</strong></td><td rowspan="2"><strong>Waktu</strong></td><td colspan="2"><strong>Tingkat Ketercapaian</strong><td rowspan="2"><strong>Keterangan</strong></td><td rowspan="2"><strong>Aksi</strong></td></tr><tr align="center"><td><strong>Terlaksana</strong></td><td><strong>Persentase</strong></td></tr>';
				foreach($query->result() as $t)
				{
				echo "<tr><td align='center'>".$nomor."</td><td>".$t->thnajaran."</td><td>".$t->semester."</td><td>".date_to_long_string($t->tanggal)."</td><td>".$t->namakegiatan."</td><td align=center>".$t->waktu."</td><td align=center>".$t->terlaksana."</td><td align=center>".$t->persentase."</td><td align='center'>".$t->keterangan_pelaksanaan."</td><td align=center><a href='".base_url()."".$tugase."/blpk/".$id."/ubah/".$t->id_kalab_harian."' title='Menyunting Buku Pelaksanaan Kegiatan'><span class=\"fa fa-edit\"></span></a></td></tr>";
				$nomor++;
				}
			echo '</table></div>';
			} // kalau ada
			else
			{
			echo '<div class="alert alert-info">Belum ada pelaksanaan kegiatan tahun '.$thnajaran.' Semester '.$semester.'</div>';
			}
		}
	}
?>
</div></div></div>

