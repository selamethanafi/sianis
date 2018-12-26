<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : organiasi_edit.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/organisasi" class="btn btn-info"><b>Kembali ke Daftar Organisasi</b></a></p>
<?php echo form_open('guru/updatedataorganisasi','class="form-horizontal" role="form"');?>
<?php
foreach($query->result() as $t)
	{
	$usernamepegawai = $t->idpegawai;
	$tpeg = $this->db->query("select * from p_pegawai where kd='$usernamepegawai'");
	foreach($tpeg->result() as $dpeg)
		{
		$namapegawai = $dpeg->nama;
		$nip = $dpeg->nip;
		}

	echo '
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$namapegawai.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9"><p class="form-control-static">'.$nip.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tingkat</label></div><div class="col-sm-9"><select name="tingkat" class="form-control">';
	//terpilih
	echo '<option value="'.$t->tingkat.'">'.$t->tingkat.'</option>';
	echo ' <option value="SLTA">SLTA ke bawah</option>
                <option value="PT">Perguruan Tinggi</option>
                <option value="Pegawai">Setelah Perguruan Tinggi atau selama menjadi pegawai</option>
		</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Organisasi</label></div><div class="col-sm-9"><input type="text" name="nama_organisasi" value="'.$t->nama_organisasi.'" class="form-control" required></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kedudukan</label></div><div class="col-sm-9"><input type="text" name="kedudukan" value="'.$t->kedudukan.'" class="form-control" required></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Dalam Tahun</label></div><div class="col-sm-4"><input type="text" name="tahun_awal" value="'.$t->tahun_awal.'" class="form-control"></div><div class="col-sm-1"><p class="form-control-static text-center">s.d.</p></div><div class="col-sm-4"><input type="text" name="tahun_akhir" value="'.$t->tahun_akhir.'" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat</label></div><div class="col-sm-9"><input type="text" name="tempat" value="'.$t->tempat.'" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Pimpinan</label></div><div class="col-sm-9"><input type="text" name="nama_pimpinan" value="'.$t->nama_pimpinan.'" class="form-control" required></div></div>';
	

}	
?>
<input type="hidden" name="id" value="<?php echo $id;?>">
<input type="hidden" name="kd" value="<?php echo $usernamepegawai;?>">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
</div></div></div>
