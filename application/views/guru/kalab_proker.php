<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kalab_proker.php
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
<div class="card-header"><h3>Program Kerja '.$namatugas.'</h3></div>
<div class="card-body">';
if (empty($id))
	{
	echo '<div class="alert alert-warning"><strong>Galat, parameter id tugas tambahan tidak disertakan (kosong)</strong></div>';
	echo 'Kalau Halaman ini tidak berpindah, klik  <a href="'.base_url().''.$tugase.'" class="btn btn-info">di sini</a>';
	}
if (!empty($id))
	{
	$ta = $this->db->query("select * from `p_tugas_tambahan` where kodeguru='$kodeguru'  and id_tambahan= '$id'");
	$ada = $ta->num_rows();
	if ($ada == 0)
		{
		echo '<div class="alert alert-warning"><strong>Galat, Anda tidak dapat mengakses data tugas tambahan ini</strong></div>';
		echo 'Kalau Halaman ini tidak berpindah, klik  <a href="'.base_url().''.$tugase.'/" class="btn btn-info">di sini</a>';
		}
		else
		{
		echo '<p><a href="'.base_url().''.$tugase.'" class="btn btn-info">Menu Utama '.$namatugas.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<a href="'.base_url().''.$tugase.'/proker/'.$id.'/tambah" class="btn btn-info">Tambah Program Kerja</a></p>';
			$thnajaran = '';
			$semester = '';

		foreach($ta->result() as $a)
			{
			$thnajaran = $a->thnajaran;
			$semester = $a->semester;
			}
		$query = $this->db->query("select * from `kalab_proker` where kodeguru='$kodeguru'  and thnajaran = '$thnajaran' and `semester` = '$semester' order by nourut DESC");
		$nomor=1;
		if(count($query->result())>0)
			{
				echo '<div class="tabl-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Nama Kegiatan</strong></td><td><strong>Tujuan</strong></td><td><strong>Sasaran</strong></td><td><strong>Waktu</strong></td><td><strong>Sumber Dana</strong></td><td><strong>Hasilyanghendakdicapai</strong></td><td><strong>Keterangan</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>';
				foreach($query->result() as $t)
				{
				echo "<tr><td align='center'>".$t->nourut."</td><td>".$t->thnajaran."</td><td>".$t->semester."</td><td>".tanpa_paragraf($t->namakegiatan)."</td><td>".tanpa_paragraf($t->tujuan)."</td><td align=center>".tanpa_paragraf($t->sasaran)."</td><td align=center>".tanpa_paragraf($t->waktu)."</td><td align=center>".tanpa_paragraf($t->sumberdana)."</td><td align=center>".tanpa_paragraf($t->hasil)."</td><td align=center>".tanpa_paragraf($t->keterangan)."</td><td align=center><a href='".base_url()."".$tugase."/proker/".$id."/ubah/".$t->id."' title='Menyunting Program kerja'><span class=\"fa fa-edit\"></span></a></td><td align=center><a href='".base_url()."".$tugase."/proker/".$id."/hapus/".$t->id."' onClick=\"return confirm('Anda yakin ingin menghapus program kerja ini?')\" title='Hapus Program kerja'><span class=\"fa fa-trash-alt\"></span></a></tr>";
				$nomor++;
				}
			echo '</table></div>';
			} // kalau ada
			else
			{
			echo '<div class="alert alert-info">Belum ada program kerja tahun '.$thnajaran.'</div>';
			}
		}
	}
?>
</div></div></div>

