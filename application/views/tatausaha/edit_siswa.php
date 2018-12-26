<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	 Min 09 Nov 2014 160028 WIB 
// Nama Berkas 		 edit_siswa.php
// Lokasi      		 application/views/tatausaha/
// Author      		 Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggallahirayah").mask("99-99-9999")
	$("#tanggallahiribu").mask("99-99-9999")
	$("#tanggallahirwali").mask("99-99-9999")
	$("#tanggalijazah").mask("99-99-9999")
	$("#tanggalditerima").mask("99-99-9999")
	});
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript">
$(function(){

$.ajaxSetup({
type:"POST",
url: "<?php echo base_url('select/ambil_data') ?>",
cache: false,
});

$("#provinsi").change(function(){

var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kabupaten',id:value},
success: function(respond){
$("#kabupaten-kota").html(respond);
}
})
}

});


$("#kabupaten-kota").change(function(){
var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kecamatan',id:value},
success: function(respond){
$("#kecamatan").html(respond);
}
})
}
})

$("#kecamatan").change(function(){
var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kelurahan',id:value},
success: function(respond){
$("#kelurahan-desa").html(respond);
}
})
} 
})

//akhir skrip select
})
</script>

<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<a href="<?php echo base_url();?>tatausaha/carisiswa" class="btn btn-info"><b>Pencarian Data Siswa</b></a>
<p></p>
<?php
echo form_open('tatausaha/updatedatasiswa','class="form-horizontal" role="form"');
?>
<?php
if(count($query->result())>0)
{
	$baru = '';
	foreach($query->result() as $t)
	{
		?>
		<h4>DATA PRIBADI SISWA</h4>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9"><?php echo $t->ket;?></div></div>

		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"> <?php echo $t->nama;?>  <input type="hidden" name="nama" value="<?php echo $t->nama;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><?php echo $t->tmpt;?><input type="hidden" name="tmpt" value="<?php echo $t->tmpt;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal lahir</label></div><div class="col-sm-9"><?php $str = $t->tgllhr;echo ''.date_to_long_string($str).'';?></div></div>

		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Induk Siswa</label></div><div class="col-sm-9"><?php echo $t->nis;?></div></div>
		<?php
			$nisn = $t->nisn;
			if((empty($t->nisn)) or (strlen($t->nisn)<10))
			{
				
				$nisn = $kode_tambahan_nisn_ard.substr($t->tgllhr,8,2).substr($t->tgllhr,5,2).substr($t->tgllhr,2,2);
			}
			?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIS Nasional</label></div><div class="col-sm-9"><input type="text" name="nisn" value="<?php echo $nisn;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Induk Kependudukan (NIK) Siswa</label></div><div class="col-sm-9"><input type="text" name="nik" value="<?php echo $t->nik;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Kartu Kependudukan</label></div><div class="col-sm-9"><input type="text" name="nokk" value="<?php echo $t->nokk;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor KKS</label></div><div class="col-sm-9"><input type="text" name="kks" value="<?php echo $t->kks;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor KPS</label></div><div class="col-sm-9"><input type="text" name="kps" value="<?php echo $t->kps;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor PKH</label></div><div class="col-sm-9"><input type="text" name="pkh" value="<?php echo $t->pkh;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Kartu Indonesia Pintar</label></div><div class="col-sm-9"><input type="text" name="kip" value="<?php echo $t->kip;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9"><select size="1" name="agama" class="form-control">  <option value="<?php echo $t->agama;?>"><?php echo $t->agama;?></option><option value="Islam">Islam</option><option value="Katolik">Katolik</option><option value="Kristen">Kristen</option><option value="Hindu">Hindu</option><option value="Budha">Budha</option></select> </div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Kelamin</label></div><div class="col-sm-9"><select size="1" name="jenkel" class="form-control">  <option value="<?php echo $t->jenkel;?>"><?php echo $t->jenkel;?></option><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas saat ini</label></div><div class="col-sm-9"><?php echo '<select name="kdkls" class="form-control">';echo '<option value="'.$t->kdkls.'">'.$t->kdkls.'</option>';foreach($daftar_ruang->result() as $u){echo '<option value="'.$u->ruang.'">'.$u->ruang.'</option>';}?></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9"><input type="text" name="wn" value="<?php echo $t->wn;?>" size="15" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Anak Yatim-Piatu</label></div><div class="col-sm-9"><select size="1" name="yatim" class="form-control">  <option value="<?php echo $t->yatim;?>"><?php echo $t->yatim;?></option><option value="Bukan diantaranya">Bukan diantaranya</option><option value="Yatim">Yatim</option><option value="Piatu">Piatu</option><option value="Yatim Piatu">Yatim Piatu</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Anak ke</label></div><div class="col-sm-9"><input type="text" name="anakke" value="<?php echo $t->anakke;?>" size="3" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Kandung</label></div><div class="col-sm-9"><input type="text" name="kandung" value="<?php echo $t->kandung;?>"  size="3" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Tiri</label></div><div class="col-sm-9"><input type="text" name="tiri"  value="<?php echo $t->tiri;?>" size="3" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Angkat</label></div><div class="col-sm-9"><input type="text" name="angkat"  value="<?php echo $t->angkat;?>" size="3" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bahasa Sehari-hari</label></div><div class="col-sm-9"><select size="1" name="bhs" class="form-control">  <option value="<?php echo $t->bhs;?>"><?php echo $t->bhs;?></option><option value="Indonesia">Indonesia</option><option value="Arab">Arab</option><option value="Inggris">Inggris</option><option value="Asing">Asing Lainnya</option><option value="Jawa">Jawa</option><option value="Daerah">Daerah Lain</option></select></div></div>
		<h4>TEMPAT TINGGAL / SARANA / FASILITAS</h4>
		<h5>Alamat</h5>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->alamat;?></p></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jalan</label></div><div class="col-sm-9"><input type="text" name="jalan" value="<?php echo $t->jalan;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">RT</label></div><div class="col-sm-9"> <input type="text" name="rt" value="<?php echo $t->rt;?>" size="4" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">RW</label></div><div class="col-sm-9"> <input type="text" name="rw" value="<?php echo $t->rw;?>" size="4" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Dusun</label></div><div class="col-sm-9"> <input type="text" name="dusun" value="<?php echo $t->dusun;?>" class="form-control"></div></div>
<?php
	$datadesa = $this->Model_select->data_desa($t->id_desa);
	$id_kec = $datadesa[2];
	$datakec = $this->Model_select->data_kecamatan($id_kec);
	$id_kab = $datakec[2];
	$datakab = $this->Model_select->data_kabupaten($id_kab);
	$id_prov = $datakab[2];
	$dataprov = $this->Model_select->data_provinsi($id_prov);
	$provinsi = $this->Model_select->provinsi();?>
	<div class="form-group row">
	<div class="col-sm-12"><?php echo $datadesa[1].' '.$datakec[1].' '.$datakab[1].' '.$dataprov[1];?></div>
        <div class="col-sm-3"><?php echo form_label('Provinsi', 'provinsi', array('class' => 'control-label')) ?></div>
        <div class="col-sm-9">
		<select class="form-control" id="provinsi">
		<?php
		if(empty($dataprov[0]))
		{
			echo '<option value="">--pilih--</option>';
		}
		else
		{
			echo '<option value="'.$dataprov[0].'">'.$dataprov[1].'</option>';
		}
		foreach ($provinsi as $prov) {
		echo "<option value='$prov[id]'>$prov[name]</option>";
		}
		?>
		</select>
	</div></div>
	<div class="form-group row">
        <div class="col-sm-3"><?php echo form_label('Kabupaten/kota', 'Kabupaten/kota', array('class' => 'control-label')) ?></div>
	<div class="col-sm-9">
	<select class="form-control" id="kabupaten-kota">
		<?php
		if(empty($datakab[0]))
		{
			echo '<option value="">--pilih--</option>';
		}
		else
		{
			echo '<option value="'.$datakab[0].'">'.$datakab[1].'</option>';
			echo $this->Model_select->kabupaten($datakab[2]);
		}
		?>
	</select>
	</div></div>
	<div class="form-group row">
        <div class="col-sm-3"><?php echo form_label('Kecamatan', 'Kecamatan', array('class' => 'control-label')) ?></div>
	<div class="col-sm-9">
		<select class='form-control' id="kecamatan">
		<?php
		if(empty($datakec[0]))
		{
			echo '<option value="">--pilih--</option>';
		}
		else
		{
			echo '<option value="'.$datakec[0].'">'.$datakec[1].'</option>';
			echo $this->Model_select->kecamatan($datakec[2]);

		}
		?>

		</select>
	</div></div>
	<div class="form-group row">
        <div class="col-sm-3"><?php echo form_label('Kelurahan/Desa', 'kelurahan/desa', array('class' => 'control-label')) ?></div>
	<div class="col-sm-9">
		<select  name="id_desa" class="form-control" id="kelurahan-desa" required>
		<?php
		if(empty($t->id_desa))
		{
			echo '<option value="">--pilih--</option>';
		}
		else
		{
			echo '<option value="'.$t->id_desa.'">'.$datadesa[1].'</option>';
			echo $this->Model_select->kelurahan($datadesa[2]);
		}
		?>
		</select>
	</div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jarak ke sekolah</label></div><div class="col-sm-9"><select size="1" name="jarak" class="form-control"><option value="<?php echo $t->jarak;?>"><?php echo $t->jarak;?></option>
			<?php foreach($tdaftar_jarak->result() as $daftar_jarak)
				{
				echo '<option value="'.$daftar_jarak->jarak.'">'.$daftar_jarak->jarak.'</option>';
				}?>
			</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Tempat Tinggal</label></div><div class="col-sm-9"><select name="jenrumah" class="form-control"><option value="<?php echo $t->jenrumah;?>"><?php echo $t->jenrumah;?></option>
<option value="Rumah Orangtua">Rumah Orangtua</option> 
<option value="Rumah Saudara/Kerabat">Rumah Saudara/Kerabat</option> 
<option value="Asrama Madrasah/Pesantren">Asrama Madrasah/Pesantren</option> 
<option value="Rumah Sewa/Kontrak">Rumah Sewa/Kontrak</option> 
<option value="Panti Asuhan">Panti Asuhan</option> 
<option value="Rumah Singgah">Rumah Singgah</option> 
<option value="Lainnya">Lainnya</option> 
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Dinding Rumah</label></div><div class="col-sm-9">
				<input name="dinding" class="form-control" placeholder="tembok, batu bata, kalsiboard, kayu, cor, bambu, dsb." value="<?php echo $t->dinding;?>">
			</div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Lantai Rumah</label></div><div class="col-sm-9">
				<input name="lantai" class="form-control" placeholder="plester, bata, kayu, keramik, tanah, dsb." value="<?php echo $t->lantai;?>">
			</div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tinggal dengan</label></div><div class="col-sm-9"><input type="text" name="tinggal" value="<?php echo $t->tinggal;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Transportasi</label></div><div class="col-sm-9"><select size="1" name="transportasi" class="form-control">  <option value="<?php echo $t->transportasi;?>"><?php echo $t->transportasi;?></option>
	<option value="Berjalan Kaki">Berjalan kaki</option>
	<option value="Sepeda">Sepeda</option>
	<option value="Sepeda Motor">Sepeda Motor</option>
	<option value="Mobil Pribadi">Mobil Pribadi</option>
	<option value="Antarjemput Sekolah">Antarjemput Sekolah</option>
	<option value="Angkutan Umum">Angkutan Umum</option>
	<option value="Perahu/Sampan">Perahu/Sampan</option>
	<option value="Lainnya">Lainnya</option>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Telepon Rumah</label></div><div class="col-sm-9"> <input type="text" name="telepon" value="<?php echo $t->telepon;?>" size="20" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">HP</label></div><div class="col-sm-9"><input type="text" name="hp" value="<?php echo $t->hp;?>" size="20" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Sepeda Motor</label></div>
		<div class="col-sm-9"><input type="text" name="cacah_spm" value="<?php echo $t->cacah_spm;?>" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Mobil</label></div>
		<div class="col-sm-9"><input type="text" name="cacah_mobil" value="<?php echo $t->cacah_mobil;?>" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ternak</label></div>
		<div class="col-sm-9"><input type="text" name="ternak" value="<?php echo $t->ternak;?>" placeholder="sapi, kambing, ayam, dsb" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Barang elektronik</label></div>
		<div class="col-sm-9"><input type="text" name="elektronik" value="<?php echo $t->elektronik;?>" placeholder="TV, HP, Kulkas, dsb" class="form-control"></div></div>

		<h4>KESEHATAN</h4>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berat Badan</label></div><div class="col-sm-9"><div class="input-group"><input type="text" name="bb" value="<?php echo $t->bb;?>" size="2" class="form-control"><span class="input-group-addon">kg</span></div></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tinggi Badan</label></div><div class="col-sm-9"><div class="input-group"><input type="text" name="tb" value="<?php echo $t->tb;?>" size="2" class="form-control"><span class="input-group-addon">cm</span></div></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Golongan Darah</label></div><div class="col-sm-9"><select size="1" name="goldarah" class="form-control">  <option value="<?php echo $t->goldarah;?>"><?php echo $t->goldarah;?></option><option value="O">O</option><option value="A">A</option><option value="B">B</option><option value="AB">AB</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Sakit yang pernah diderita</label></div><div class="col-sm-9"><input type="text" name="sakit" value="<?php echo $t->sakit;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kebutuhan Khusus</label></div><div class="col-sm-9"> <input type="text" name="jasmani" value="<?php echo $t->jasmani;?>" class="form-control"></div></div>
		<h4>SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?></h4>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">SLTP / Paket B</label></div><div class="col-sm-9"> <?php echo $t->sltp;?></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">No STTB / Ijazah SLTP / Paket B</label></div><div class="col-sm-9"><?php echo $t->nosttb;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status SLTP / Paket B</label></div><div class="col-sm-9"><?php if($t->jenis_sltp == 1)
	{
		echo 'Negeri';
	}
	elseif($t->jenis_sltp == 2)
	{
		echo 'Swasta';
	}
	else
	{
		echo 'Status SLTP belum ditentukan';
	}
;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kabupaten / Kota SLTP / Paket B</label></div><div class="col-sm-9"><?php echo $t->kota_sltp;?></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Peserta UN SLTP</label></div><div class="col-sm-9"><?php echo $t->skhun;?></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Lama Belajar di SLTP</label></div><div class="col-sm-9"><div class="input-group"><input type="text" name="lama" value="<?php echo $t->lama;?>" size="5" class="form-control"><span class="input-group-addon">Tahun</span></div></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal STTB</label></div><div class="col-sm-9"><?php echo date_to_long_string($t->tglsttb);?></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pindahan dari</label></div><div class="col-sm-9"><input type="text" name="pinsek" value="<?php echo $t->pinsek;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alasan pindah</label></div><div class="col-sm-9"><input type="text" name="alasan" value="<?php echo $t->alasan;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Diterima di kelas</label></div><div class="col-sm-9">
			<?php 
			echo '<select name="kls" class="form-control">';
			$kelas = $t->kls;
			echo '<option value="'.$t->kls.'">'.$t->kls.'</option>';
			foreach($daftar_ruang->result() as $u)
			{echo '<option value="'.$u->ruang.'">'.$u->ruang.'</option>';
			}?>
		</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal diterima</label></div><div class="col-sm-9"><?php $str = $t->tglditerima;$tanggalditerima = tanggal($str);?><input type="text" name="tanggalditerima" value="<?php echo $tanggalditerima;?>" id="tanggalditerima" class="form-control"></div></div>
		<h4>DATA KELUARGA SISWA</h4>
		<h5>DATA AYAH SISWA</h5>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nmayah" value="<?php echo $t->nmayah;?>" size="30" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Induk Kependudukan (NIK)</label></div><div class="col-sm-9"><input type="text" name="nik_kk" value="<?php echo $t->nik_kk;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9"><input type="text" name="alayah" value="<?php echo $t->alayah;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><input type="text" name="tmpayah" value="<?php echo $t->tmpayah;?>" size="30" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9"><?php $str = $t->tglayah;$tanggallahirayah = tanggal($str);?><input type="text" name="tanggallahirayah" value="<?php echo $tanggallahirayah;?>" id="tanggallahirayah" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9"><select size="1" name="agayah" class="form-control">  <option value="<?php echo $t->agayah;?>"><?php echo $t->agayah;?></option><option value="Islam">Islam</option><option value="Katolik">Katolik</option><option value="Kristen">Kristen</option><option value="Hindu">Hindu</option><option value="Budha">Budha</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9"><select size="1" name="wnayah" class="form-control">  <option value="<?php echo $t->wnayah;?>"><?php echo $t->wnayah;?></option><option value="Indonesia">Indonesia</option><option value="Asing">Asing</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9"> <input type="text" name="tayah" value="<?php echo $t->tayah;?>" size="15" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9"><select  name="payah" class="form-control"><option value="<?php echo $t->payah;?>"><?php echo $t->payah;?></option><?php $pekerjaan=$t->payah;$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan WHERE nama_pekerjaan <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->nama_pekerjaan;echo '<option value="'.$peker.'">'.$peker.'</option>';}?>  </select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9"> <div class="input-group"><span class="input-group-addon">Rp</span><select name="dayah" class="form-control"><option value="<?php echo $t->dayah;?>"><?php echo $t->dayah;?></option><?php $pekerjaan=$t->dayah;$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit WHERE besar <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->besar;echo '<option value="'.$peker.'">'.$peker.'</option>';}?></select></div></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9"><select size="1" name="sekayah" class="form-control">  <option value="<?php echo $t->sekayah;?>"><?php echo $t->sekayah;?></option><?php $pekerjaan=$t->sekayah;$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah WHERE jenjang <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->jenjang;echo '<option value="'.$peker.'">'.$peker.'</option>';}?>  </select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Masih hidup</label></div><div class="col-sm-9"><select size="1" name="hdpayah" class="form-control">  <option value="<?php echo $t->hdpayah;?>"><?php echo $t->hdpayah;?></option><option value="Ya">Ya</option><option value="Tidak">Tidak</option>  </select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jika sudah meninggal, meninggal tahun</label></div><div class="col-sm-9"><input type="text" name="thnayah" value="<?php echo $t->thnayah;?>" size="4" class="form-control"></div></div>
<h5>DATA IBU SISWA</h5>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nmibu" value="<?php echo $t->nmibu;?>" size="30" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Induk Kependudukan (NIK)</label></div><div class="col-sm-9"><input type="text" name="nik_ibu" value="<?php echo $t->nik_ibu;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9"><input type="text" name="alibu" value="<?php echo $t->alibu;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><input type="text" name="tmpibu" value="<?php echo $t->tmpibu;?>" size="30" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9"><?php $str = $t->tglibu;$tanggallahiribu = tanggal($str);?><input type="text" name="tanggallahiribu" value="<?php echo $tanggallahiribu;?>" id="tanggallahiribu" class="form-control"></div></div>   
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9"><select size="1" name="agibu" class="form-control">  <option value="<?php echo $t->agibu;?>"><?php echo $t->agibu;?></option><option value="Islam">Islam</option><option value="Katolik">Katolik</option><option value="Kristen">Kristen</option><option value="Hindu">Hindu</option><option value="Budha">Budha</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9"><select size="1" name="wnibu" class="form-control">  <option value="<?php echo $t->wnibu;?>"><?php echo $t->wnibu;?></option><option value="Indonesia">Indonesia</option><option value="Asing">Asing</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9"> <input type="text" name="tibu" value="<?php echo $t->tibu;?>" size="15" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9"><select size="1" name="pibu" class="form-control">  <option value="<?php echo $t->pibu;?>"><?php echo $t->pibu;?></option><?php $pekerjaan=$t->pibu;
			$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan WHERE nama_pekerjaan <> '$pekerjaan' ");
			foreach($tm_pekerjaan->result() as $dm_pekerjaan)
			{$peker=$dm_pekerjaan->nama_pekerjaan;
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}?>  </select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9"><div class="input-group"><span class="input-group-addon">Rp</span><select name="dibu" class="form-control"><option value="<?php echo $t->dibu;?>"><?php echo $t->dibu;?></option><?php $pekerjaan=$t->dibu;$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit WHERE besar <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->besar;echo '<option value="'.$peker.'">'.$peker.'</option>';}?></select></div></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9"><select size="1" name="sekibu" class="form-control">  <option value="<?php echo $t->sekibu;?>"><?php echo $t->sekibu;?></option>  <?php $pekerjaan=$t->sekibu;$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah WHERE jenjang <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->jenjang;echo '<option value="'.$peker.'">'.$peker.'</option>';}?></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Masih hidup</label></div><div class="col-sm-9"><select size="1" name="hdpibu" class="form-control">  <option value="<?php echo $t->hdpibu;?>"><?php echo $t->hdpibu;?></option><option value="Ya">Ya</option><option value="Tidak">Tidak</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jika sudah meninggal, meninggal tahun</label></div><div class="col-sm-9"><input type="text" name="thnibu" value="<?php echo $t->thnibu;?>" size="4" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penghasilan Ayah + penghasilan Ibu</label></div><div class="col-sm-9"><div class="input-group"><span class="input-group-addon">Rp</span><select size="1" name="dortu" class="form-control"><option value="<?php echo $t->dortu;?>"><?php echo $t->dortu;?></option><?php $pekerjaan=$t->dortu;$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit WHERE besar <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->besar;echo '<option value="'.$peker.'">'.$peker.'</option>';}?></select></div></div></div>
<h5>DATA WALI SISWA</h5>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nmwali" value="<?php echo $t->nmwali;?>" size="30" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9"><input type="text" name="awali" value="<?php echo $t->awali;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><input type="text" name="tmpwali" value="<?php echo $t->tmpwali;?>" size="30" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9"><?php $str = $t->tglwali;$tanggallahirwali = tanggal($str);?><input type="text" name="tanggallahirwali" value="<?php echo $tanggallahirwali;?>" id="tanggallahirwali" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9"><select size="1" name="agwali" class="form-control">  <option value="<?php echo $t->agwali;?>"><?php echo $t->agwali;?></option><option value="Islam">Islam</option><option value="Katolik">Katolik</option><option value="Kristen">Kristen</option><option value="Hindu">Hindu</option><option value="Budha">Budha</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9"><select size="1" name="wnwali" class="form-control">  <option value="<?php echo $t->wnwali;?>"><?php echo $t->wnwali;?></option><option value="Indonesia">Indonesia</option><option value="Asing">Asing</option></select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9"> <input type="text" name="twali" value="<?php echo $t->twali;?>" size="15" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9"><select size="1" name="pwali" class="form-control">  <option value="<?php echo $t->pwali;?>"><?php echo $t->pwali;?></option><?php $pekerjaan=$t->pwali;$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan WHERE nama_pekerjaan <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->nama_pekerjaan;echo '<option value="'.$peker.'">'.$peker.'</option>';}?>  </select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9"><div class="input-group"><span class="input-group-addon">Rp</span><select name="dwali" class="form-control"><option value="<?php echo $t->dwali;?>"><?php echo $t->dayah;?></option><?php $pekerjaan=$t->dwali;$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit WHERE besar <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->besar;echo '<option value="'.$peker.'">'.$peker.'</option>';}?></select></div></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9"><select size="1" name="sekwali" class="form-control">  <option value="<?php echo $t->sekwali;?>"><?php echo $t->sekwali;?></option><?php $pekerjaan=$t->sekwali;$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah WHERE jenjang <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->jenjang;echo '<option value="'.$peker.'">'.$peker.'</option>';}?></select></div></div>
<h4>KEGEMARAN SISWA</h4>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cita - Cita</label></div><div class="col-sm-9"><select size="1" name="cita" class="form-control"><option value="<?php echo $t->cita_cita;?>"><?php echo $t->cita_cita;?></option><?php $pekerjaan=$t->cita_cita;$tm_pekerjaan = $this->db->query("SELECT * FROM m_cita WHERE nama_cita <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->nama_cita;echo '<option value="'.$peker.'">'.$peker.'</option>';}?>  </select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Hobi Utama</label></div><div class="col-sm-9"><select size="1" name="hobi" class="form-control"><option value="<?php echo $t->hobi;?>"><?php echo $t->hobi;?></option><?php $pekerjaan=$t->hobi;$tm_pekerjaan = $this->db->query("SELECT * FROM m_hobi WHERE nama <> '$pekerjaan' ");foreach($tm_pekerjaan->result() as $dm_pekerjaan){$peker=$dm_pekerjaan->nama;echo '<option value="'.$peker.'">'.$peker.'</option>';}?>  </select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kesenian</label></div><div class="col-sm-9"> <input type="text" name="kesenian" value="<?php echo $t->kesenian;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Olahraga</label></div><div class="col-sm-9"> <input type="text" name="olahraga" value="<?php echo $t->olahraga;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Organisasi</label></div><div class="col-sm-9"><input type="text" name="organisasi" value="<?php echo $t->organisasi;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Lain - lain</label></div><div class="col-sm-9"><input type="text" name="lain" value="<?php echo $t->lain;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Chat ID Telegram</label></div><div class="col-sm-9"><input type="text" name="chat_id" value="<?php echo $t->chat_id;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">ID ARD Siswa</label></div><div class="col-sm-9"><input type="text" name="id_ard_siswa" value="<?php echo $t->id_ard_siswa;?>" class="form-control"></div></div>

		<input type="hidden" name="nis" value="<?php echo $t->nis;?>">
		<input type="hidden" name="ket" value="<?php echo $t->ket;?>">
		<input type="hidden" name="nmortu" value="<?php echo $t->nmortu;?>">
		<input type="hidden" name="baru" value="tidak">
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

