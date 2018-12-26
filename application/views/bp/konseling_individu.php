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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if(($aksi == 'tambah') or ($aksi=='ubah'))
{?>
	<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript">
	jQuery(function($){
	$("#tanggal").mask("99-99-9999")
	});
	</script>
<?php
}
$ta = $this->db->query("select `nis`,`nama`,`agama`,`jenkel`,`foto`,`ket` from `datsis` where `nis`='$nis'");
if($ta->num_rows()>0)
{
	foreach($ta->result() as $a)
	{
		$namasiswa = $a->nama;
		$agama = $a->agama;
		$jenkel = $a->jenkel;
	}
	$kelas = '';
	$tb = $this->db->query("select * from `siswa_kelas` where `nis` = '$nis' order by `thnajaran` DESC limit 0,1");
	foreach($tb->result() as $b)
	{
		$kelas = $b->kelas.' '.$b->thnajaran;
	}

	?>
	<h3>Riwayat Konseling</h3>
	<form class="form-horizontal" role="form">
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Nama</label></div>
			<div class="col-sm-9"><p class="form-control-static"><?php echo $namasiswa;?></p></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Kelas Terakhir</label></div>
			<div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Agama</label></div>
			<div class="col-sm-9"><p class="form-control-static"><?php echo $agama;?></p></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Jenis Kelamin</label></div>
			<div class="col-sm-9"><p class="form-control-static"><?php echo $jenkel;?></p></div>
		</div>
	</form>
	<?php
	if($aksi == 'tambah')
	{?>
		<form class="form-horizontal" role="form" action="<?php echo base_url().'bp/konseling/'.$nis.'/simpan';?>" method="post">
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Tanggal Konseling</label></div>
				<div class="col-sm-9" ><input type="text" name="tanggal" id="tanggal" placeholder="tgl-bln-tahun" class="form-control"></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Masalah</label></div>
				<div class="col-sm-9"><textarea name="masalah" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Diagnosis</label></div>
				<div class="col-sm-9"><textarea name="diagnosis" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Pronosis</label></div>
				<div class="col-sm-9"><textarea name="pronosis" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Tujuan Konseling</label></div>
				<div class="col-sm-9"><textarea name="tujuan" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Pendekatan</label></div>
				<div class="col-sm-9"><textarea name="pendekatan" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Tahap Awal</label></div>
				<div class="col-sm-9"><textarea name="tahap_awal" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Pertengahan</label></div>
				<div class="col-sm-9"><textarea name="pertengahan" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Akhir</label></div>
				<div class="col-sm-9"><textarea name="akhir" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Hasil yang Dicapai</label></div>
				<div class="col-sm-9"><textarea name="hasil" rows="2" class="form-control"></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Tindak Lanjut</label></div>
				<div class="col-sm-9"><textarea name="tindak_lanjut" rows="2" class="form-control"></textarea></div>
			</div>
			<p class="text-center"><input type="submit" value="SIMPAN" class="btn btn-primary"> <a href="<?php echo base_url().'bp/konseling/'.$nis;?>" class="btn btn-info">Batal</a></p>
		</form>


	<?php
	}
	elseif($aksi == 'ubah')
	{
		$td = $this->db->query("select * from `bk_individu` where `nis`='$nis' and `id_bk_individu` = '$id_bk_individu'");
		if($td->num_rows() > 0)
		{
			foreach($td->result() as $d)?>
		<form class="form-horizontal" role="form" action="<?php echo base_url().'bp/konseling/'.$nis.'/simpan';?>" method="post">
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Tanggal Konseling</label></div>
				<div class="col-sm-9" ><input type="text" name="tanggal" value="<?php echo tanggal($d->tanggal);?>" id="tanggal" placeholder="tgl-bln-tahun" class="form-control"></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Masalah</label></div>
				<div class="col-sm-9"><textarea name="masalah" rows="2" class="form-control"><?php echo $d->masalah;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Diagnosis</label></div>
				<div class="col-sm-9"><textarea name="diagnosis" rows="2" class="form-control"><?php echo $d->diagnosis;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Pronosis</label></div>
				<div class="col-sm-9"><textarea name="pronosis" rows="2" class="form-control"><?php echo $d->pronosis;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Tujuan Konseling</label></div>
				<div class="col-sm-9"><textarea name="tujuan" rows="2" class="form-control"><?php echo $d->tujuan;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Pendekatan</label></div>
				<div class="col-sm-9"><textarea name="pendekatan" rows="2" class="form-control"><?php echo $d->pendekatan;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Tahap Awal</label></div>
				<div class="col-sm-9"><textarea name="tahap_awal" rows="2" class="form-control"><?php echo $d->tahap_awal;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Pertengahan</label></div>
				<div class="col-sm-9"><textarea name="pertengahan" rows="2" class="form-control"><?php echo $d->pertengahan;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Akhir</label></div>
				<div class="col-sm-9"><textarea name="akhir" rows="2" class="form-control"><?php echo $d->akhir;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Hasil yang Dicapai</label></div>
				<div class="col-sm-9"><textarea name="hasil" rows="2" class="form-control"><?php echo $d->hasil;?></textarea></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Tindak Lanjut</label></div>
				<div class="col-sm-9"><textarea name="tindak_lanjut" rows="2" class="form-control"><?php echo $d->tindak_lanjut;?></textarea></div>
			</div>
			<p class="text-center"><input type="hidden" name="id_bk_individu" value="<?php echo $id_bk_individu;?>"><input type="submit" value="SIMPAN" class="btn btn-primary"> <a href="<?php echo base_url().'bp/konseling/'.$nis;?>" class="btn btn-info">Batal</a></p>
		</form>
			<?php

		}
		else
		{
			echo '<div class="alert alert-info">Data riwayat konseling siswa tidak ditemukan, atau Anda tidak berhak mengubah, <a href="'.base_url().'bp/carisiswa" class="btn btn-primary">cari siswa lain?</a> atau <a href="'.base_url().'bp/konseling/'.$nis.'" class="btn btn-info">Batal</a></div>';

		}
	}
	else
	{
	?>
	<p><a href="<?php echo base_url().'bp/konseling/'.$nis.'/tambah';?>" class="btn btn-primary">Tambah Riwayat</a> <a href="<?php echo base_url().'bp/carisiswa';?>" class="btn btn-warning">Cari Siswa Lain</a></p>
	<table class="table table-hover table-bordered table-condensed">
	<tr align="center"><td><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Masalah</strong></td><td><strong>Diagnosis</strong></td><td><strong>Pronosis</strong></td><td><strong>Tujuan Konseling</strong></td><td><strong>Pendekatan</strong></td><td><strong>Tahap Awal</strong></td><td><strong>Pertengahan</strong></td><td><strong>Akhir</strong></td><td><strong>Hasil yang Dicapai</strong></td><td><strong>Tindak Lanjut</strong></td><td><strong>Konselor</strong></td><td colspan="3"><strong>Aksi</strong></td></tr>
	<?php
	$query = $this->db->query("select * from `bk_individu` where `nis`='$nis' order by `tanggal` DESC");
	$nomor=1;
	$ket='';
	foreach($query->result() as $c)
	{
		$link_edit = anchor('bp/konseling/'.$nis.'/ubah/'.$c->id_bk_individu, '<span class="fa fa-edit"></span>', array('title' => 'Ubah data riwayat konseling'));
                $link_hapus = anchor('bp/konseling/'.$nis.'/hapus/'.$c->id_bk_individu,'<span class="fa fa-trash-alt"></span>', array('title' => 'Menghapus riwayat konseling', 'data-confirm' => 'Anda yakin akan menghapus data ini?'));
		$link_cetak = anchor('bp/konseling/'.$nis.'/cetak/'.$c->id_bk_individu,'<span class="glyphicon glyphicon-print"></span>', array('title' => 'mencetak riwayat konseling'));
		echo '<tr><td>'.$nomor.'</td><td>'.tanggal($c->tanggal).'</td><td>'.$c->masalah.'</td><td>'.$c->diagnosis.'</td><td>'.$c->pronosis.'</td><td>'.$c->tujuan.'</td><td>'.$c->pendekatan.'</td><td>'.$c->tahap_awal.'</td><td>'.$c->pertengahan.'</td><td>'.$c->akhir.'</td><td>'.$c->hasil.'</td><td>'.$c->tindak_lanjut.'</td>';
		$username = $c->username;
		$konselor = '';
		$te = $this->db->query("select * from `tbllogin` where `username`='$username'");
		foreach($te->result() as $e)
		{
			$konselor = $e->nama;
		}
		echo '<td>'.$konselor.'</td>';
		echo '<td>'.$link_cetak.'</td>';
		if($username == $nim)
		{
			echo '<td>'.$link_edit.'</td><td>'.$link_hapus.'</td>';
		}
		else
		{	echo '<td colspan="3"</td>';
		}
		echo '</tr>';
		$nomor++;
	}
	?>
	</table>
<?php
	}
}
else
{
	echo '<div class="alert alert-info">Siswa tidak ditemukan, <a href="'.base_url().'bp/carisiswa" class="btn btn-primary">cari siswa lain?</a></div>';
}
?>
</div></div></div>
