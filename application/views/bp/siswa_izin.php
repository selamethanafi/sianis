<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: siswa.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sen 16 Mei 2016 10:19:00 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php $tanggalhariini = tanggal_hari_ini();?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' '.date_to_long_string($tanggalhariini);?></h3></div>
<div class="card-body">
<?php
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$nohp = '';
$ta = $this->db->query("select * from `tbllogin` where `username`= '$nim'");
foreach($ta->result() as $a)
{
	$nohp = $a->idlink;
}
if(empty($nohp))
{
	echo '<div class="alert alert-warning">Nomor HP dibutuhkan, silakan menghubungi admin</div>';
}
else
{
	echo '<h4>Nomor Seluler '.$nohp.'</div>';
}

$query = $this->db->query("select * from `siswa_proses_izin` where `tanggal`='$tanggalhariini'");
if($query->num_rows()==0)
{
	echo '<div class="alert alert-info">Belum ada siswa yang mengajukan izin</div>';
}
else
{
	echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>NIS</td><td>Nama</td><td>Kelas</td><td>status</td><td>Aksi</td></tr>';
	$nomor=1;
	$ket='';
	foreach($query->result() as $b)
	{
		$link_setuju = anchor('bp/aproved/'.$b->token,'<span class="fa fa-bullseye"></span>', array('title' => 'disetujui', 'data-confirm' => 'Anda yakin akan menyetujui izin '.nis_ke_nama($b->nis).'?'));
		$link_hapus = anchor('bp/hapusizin/'.$b->token,'<span class="glyphicon glyphicon-trash"></span>', array('title' => 'Hapus', 'data-confirm' => 'Anda yakin akan menghapus izin '.nis_ke_nama($b->nis).'?'));
		$link_pending = anchor('bp/pending/'.$b->token,'<span class="fa fa-trash-alt"></span>', array('title' => 'Tunda', 'data-confirm' => 'Anda yakin akan menunda proses izin '.nis_ke_nama($b->nis).'?'));
		if($b->valid == '1')
		{
			echo '<tr class="success"><td>'.$nomor.'</td><td>'.$b->nis.'</td><td>'.nis_ke_nama($b->nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($b->nis,$thnajaran,$semester).'</td>';
			echo '<td>disetujui</td>';
			if($b->kode_guru == $nohp)
			{
				echo '<td>'.$link_pending.'</td>';
			}
			else
			{
				echo '<td></td>';
			}

		}
		else
		{
			echo '<tr class="danger"><td>'.$nomor.'</td><td>'.$b->nis.'</td><td>'.nis_ke_nama($b->nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($b->nis,$thnajaran,$semester).'</td>';
			if($b->kode_guru == $nohp)
			{
				echo '<td>ditunda</td><td>'.$link_setuju.'</td>';
			}
			else
			{
				echo '<td></td>';
			}

		}
	$nomor++;
	}
	?>
	</table>
<?php
}?>
</div></div></div>
