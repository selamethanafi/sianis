<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	 Min 09 Nov 2014 160028 WIB 
// Nama Berkas 		 edit_siswa.php
// Lokasi      		 application/views/tatausaha/
// Author      		 Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<script type="text/javascript">

function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;

</script> 
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url();?>tatausaha/carisiswa" class="btn btn-info"><b>Pencarian Data Siswa</b></a></p>
<?php
echo $pesan;
echo form_open($tautan_balik.'/datapenerimabsm/'.$nis,'class="form-horizontal" role="form"');
?>
<?php
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		?>
		<h4>DATA PRIBADI SISWA</h4>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9"><?php echo $t->ket;?></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Induk Siswa</label></div><div class="col-sm-9"><?php echo $t->nis;?></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIS Nasional</label></div><div class="col-sm-9"><input type="text" name="nisn" value="<?php echo $t->nisn;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"> <?php echo $t->nama;?>  <input type="hidden" name="nama" value="<?php echo $t->nama;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><?php echo $t->tmpt;?><input type="hidden" name="tmpt" value="<?php echo $t->tmpt;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal lahir</label></div><div class="col-sm-9"><?php $str = $t->tgllhr;echo ''.date_to_long_string($str).'';?></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9"><select name="agama" class="form-control">  <option value="<?php echo $t->agama;?>"><?php echo $t->agama;?></option><option value="Islam">Islam</option><option value="Katolik">Katolik</option><option value="Kristen">Kristen</option><option value="Hindu">Hindu</option><option value="Budha">Budha</option></select> </div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Kelamin</label></div><div class="col-sm-9"><select name="jenkel" class="form-control">  <option value="<?php echo $t->jenkel;?>"><?php echo $t->jenkel;?></option><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9"><input type="text" name="wn" value="<?php echo $t->wn;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Induk Kependudukan (NIK) Siswa</label></div><div class="col-sm-9"><input type="text" name="nik" value="<?php echo $t->nik;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Kartu Kependudukan</label></div><div class="col-sm-9"><input type="text" name="nokk" value="<?php echo $t->nokk;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor KPS</label></div><div class="col-sm-9"><input type="text" name="kps" value="<?php echo $t->kps;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor PKH</label></div><div class="col-sm-9"><input type="text" name="pkh" value="<?php echo $t->pkh;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor KIP</label></div><div class="col-sm-9"><input type="text" name="kip" value="<?php echo $t->kip;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor KKS</label></div><div class="col-sm-9"><input type="text" name="kks" value="<?php echo $t->kks;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Anak Yatim-Piatu</label></div><div class="col-sm-9"><select name="yatim" class="form-control">  <option value="<?php echo $t->yatim;?>"><?php echo $t->yatim;?></option><option value="Bukan diantaranya">Bukan diantaranya</option><option value="Yatim">Yatim</option><option value="Piatu">Piatu</option><option value="Yatim Piatu">Yatim Piatu</option></select></div></div>
		<h4>TEMPAT TINGGAL</h4>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jalan</label></div><div class="col-sm-9"><input type="text" name="jalan" value="<?php echo $t->jalan;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">RT</label></div><div class="col-sm-9"> <input type="text" name="rt" value="<?php echo $t->rt;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">RW</label></div><div class="col-sm-9"> <input type="text" name="rw" value="<?php echo $t->rw;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Dusun</label></div><div class="col-sm-9"> <input type="text" name="dusun" value="<?php echo $t->dusun;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Desa</label></div><div class="col-sm-9"><input type="text" name="desa" value="<?php echo $t->desa;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kecamatan.</label></div><div class="col-sm-9"><input type="text" name="kec" value="<?php echo $t->kec;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kabupaten</label></div><div class="col-sm-9"><input type="text" name="kab" value="<?php echo $t->kab;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Provinsi</label></div><div class="col-sm-9"><input type="text" name="prov" value="<?php echo $t->prov;?>" class="form-control"></div></div>   
		<h4>ORANG TUA</h4>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Ayah</label></div><div class="col-sm-9"><input type="text" name="nmayah" value="<?php echo $t->nmayah;?>" class="form-control"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Ibu</label></div><div class="col-sm-9"> <input type="text" name="nmibu" value="<?php echo $t->nmibu;?>" class="form-control"></div></div>

		<input type="hidden" name="nise" value="<?php echo $t->nis;?>">
		<p class="text-center"><button type="submit" class="btn btn-primary">PERBARUI DATA SISWA</button> <a href="<?php echo base_url();?>index.php/tatausaha/carisiswa" class="btn btn-info">Batal</a></p>
		<?php
	}
}
else{
echo '<div class="alert alert-danger">Data siswa tidak ditemukan</div>';
}
?>
</form>
</div>

