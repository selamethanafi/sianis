<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kalab_bltpk.php
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
<div class="card-header"><h3>Buku Tindak Lanjut Pelaksanaan Kegiatan '.$namatugas.'</h3></div>
<div class="card-body">';
if (empty($id))
	{
	echo '<div class="alert alert-warning"><strong>Galat, parameter id tugas tambahan tidak disertakan (kosong)</strong></div>';
	echo 'Kalau Halaman ini tidak berpindah, klik  <a href="'.base_url().''.$tugase,'/">di sini</a>';
	}
if (!empty($id))
	{
	$ta = $this->db->query("select * from `p_tugas_tambahan` where kodeguru='$kodeguru'  and id_tambahan= '$id'");
	$ada = $ta->num_rows();
	if ($ada == 0)
		{
		echo '<div class="alert alert-warning"><strong>Galat, Anda tidak dapat mengakses data tugas tambahan ini</strong></div>';
		echo 'Kalau Halaman ini tidak berpindah, klik  <a href="'.base_url().''.$tugase.'/">di sini</a>';
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
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Tanggal</strong></td><td><strong>Nama Kegiatan</strong></td><td><strong>Dukungan</strong></td><td><strong>Hambatan</strong></td><td><strong>Solusi</strong></td><td><strong>Keterangan</strong></td><td><strong>Aksi</strong></td></tr>';
				foreach($query->result() as $t)
				{
				echo "<tr><td align='center'>".$nomor."</td><td>".$t->thnajaran."</td><td>".$t->semester."</td><td>".date_to_long_string($t->tanggal)."</td><td>".tanpa_paragraf($t->namakegiatan)."</td><td align=center>".tanpa_paragraf($t->dukungan)."</td><td align=center>".tanpa_paragraf($t->hambatan)."</td><td align=center>".tanpa_paragraf($t->solusi)."</td><td align=center>".tanpa_paragraf($t->keterangan_tindak_lanjut)."</td><td align=center><a href='".base_url()."".$tugase."/btlpk/".$id."/ubah/".$t->id_kalab_harian."' title='Menyunting Buku Pelaksanaan Kegiatan'><span class=\"fa fa-edit\"></span></a></td></tr>";
				$nomor++;
				}
			echo '</table></div>';
			} // kalau ada
			else
			{
			echo '<div class="alert alert-info">Belum ada pelaksanaan kegiatan tahun '.$thnajaran.'</div>';
			}
		}
	}
?>
</div></div></div>

