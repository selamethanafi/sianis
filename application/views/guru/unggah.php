<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : keluarga_edit.php
// Lokasi      : application/views/guru/
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
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$tautan_balik = base_url().'guru';
if(($item == 'akta_kelahiran') or ($item == 'askes_keluarga'))
{
	$tautan_balik = base_url().'guru/keluarga';
	echo '<p><a href="'.$tautan_balik.'" class="btn btn-info"><b>Batal </b></a></p>';
	echo form_open_multipart('unggah/prosesunggahberkas/'.$item.'/'.$id,'class="form-horizontal" role="form"');
	foreach($query->result() as $t)
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Anggota Keluarga</label></div><div class="col-sm-9"><p class="form-control-static">'.$t->nama.'</p></div></div>';

	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas Pindai '.$nama_item.'</label></div><div class="col-sm-9"><input type="file" name="userfile" class="form-control"></div></div>';
	echo '<input type="hidden" name="nama_pegawai" value="'.$nama.'"><input type="hidden" name="nama_ybs" value="'.$t->nama.'">';
	}
}
elseif(($item == 'nip') or ($item == 'ktp') or ($item == 'karpeg') or ($item == 'askes') or ($item == 'kpe') or ($item == 'taspen') or ($item == 'npwp') or ($item == 'karsu') or ($item == 'rekening') or ($item == 'sertifikat_pendidik') or ($item == 'foto') or ($item == 'akta_nikah') or ($item == 'akta_cerai') or ($item == 'kartu_keluarga'))
{
	$tautan_balik = base_url().'guru/umum';
	echo '<p><a href="'.$tautan_balik.'" class="btn btn-info"><b>Batal </b></a></p>';
	echo form_open_multipart('unggah/prosesunggahberkas/'.$item,'class="form-horizontal" role="form"');
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas Pindai '.$nama_item.'</label></div><div class="col-sm-9"><input type="file" name="userfile" class="form-control"></div></div>';
	echo '<input type="hidden" name="nama_pegawai" value="'.$nama.'">';
}
elseif($item == 'pendidikan')
{
	$tautan_balik = base_url().'guru/pendidikan';
	foreach($query->result() as $a)
	{
		$tingkat = $a->tingkat;
		$sekolah = $a->namasekolah;
	}
	echo '<p><a href="'.$tautan_balik.'" class="btn btn-info"><b>Batal </b></a></p>';
	echo form_open_multipart('unggah/prosesunggahberkas/'.$item.'/'.$id,'class="form-horizontal" role="form"');
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Sekolah</label></div><div class="col-sm-9"><p class="form-control-static">'.$sekolah.'</p></div></div>';

	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas Pindai '.$nama_item.'</label></div><div class="col-sm-9"><input type="file" name="userfile" class="form-control"></div></div>';
	echo '<input type="hidden" name="nama_pegawai" value="'.$nama.'"><input type="hidden" name="tingkat" value="'.$tingkat.'">';
}
elseif($item == 'kepegawaian')
{
	$tautan_balik = base_url().'guru/kepegawaian';
	foreach($query->result() as $a)
	{
		$tingkat = $a->uraian;
	}
	echo '<p><a href="'.$tautan_balik.'" class="btn btn-info"><b>Batal </b></a></p>';
	echo form_open_multipart('unggah/prosesunggahberkas/'.$item.'/'.$id,'class="form-horizontal" role="form"');
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Uraian</label></div><div class="col-sm-9"><p class="form-control-static">'.$tingkat.'</p></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas Pindai '.$nama_item.'</label></div><div class="col-sm-9"><input type="file" name="userfile" class="form-control"></div></div>';
	echo '<input type="hidden" name="nama_pegawai" value="'.$nama.'"><input type="hidden" name="uraian" value="'.$tingkat.'">';
}
elseif($item == 'sertifikat')
{
	$tautan_balik = base_url().'guru/sertifikat';
	foreach($query->result() as $a)
	{
		$tingkat = $a->kegiatan;
	}
	echo '<p><a href="'.$tautan_balik.'" class="btn btn-info"><b>Batal </b></a></p>';
	echo form_open_multipart('unggah/prosesunggahberkas/'.$item.'/'.$id,'class="form-horizontal" role="form"');
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas Pindai '.$nama_item.'</label></div><div class="col-sm-9"><input type="file" name="userfile" class="form-control"></div></div>';
	echo '<input type="hidden" name="nama_pegawai" value="'.$nama.'"><input type="hidden" name="uraian" value="'.$tingkat.'">';
}
elseif($item == 'lain')
{
	echo form_open_multipart('unggah/prosesunggahberkas/'.$item.'/'.$id,'class="form-horizontal" role="form"');
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama berkas</label></div><div class="col-sm-9"><input type="text" name="nama_berkas" class="form-control"></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas Pindai </label></div><div class="col-sm-9"><input type="file" name="userfile" class="form-control"></div></div>';
}

?>


<p class="text-center"><input type="submit" value="Unggah <?php echo $nama_item;?>" class="btn btn-primary"></p>
</form>
<?php
if($item == 'lain')
{
	$ta = $this->db->query("select * from `p_berkas` where `kd`='$nim' order by `nama_berkas`");
	echo '<table class="table table-striped table-hover table-bordered"><tr><td align="center">Nomor</td><td>Nama Berkas</td><td>Berkas Pindaian</td><td>Hapus</td></tr>';
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		echo '<tr><td>'.$nomor.'</td><td>'.$a->nama_berkas.'</td><td><a href="'.base_url().'images/berkas_guru_pegawai/'.$a->berkas.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$a->berkas.'" width="200" class="img-fluid img-thumbnail" alt="berkas tidak ditemukan"></a></td><td align="center"><a href="'.base_url().'unggah/hapus/lain/'.$a->id_berkas.'" data-confirm="Hapus berkas pindaian '.$a->nama_berkas.'?" class="btn btn-danger"><span class="fa fa-times"></span></a></td></tr>';
		$nomor++;
	}
	echo '</table>';
}
?>
</div></div></div>
