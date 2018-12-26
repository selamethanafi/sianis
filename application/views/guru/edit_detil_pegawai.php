<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: edit_detil_pegawai.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
<div class="container-fluid"><h3>Sunting Data Umum Pegawai</h3>
<p><a href="<?php echo base_url();?>guru/umum" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> <b>Batal</b></a></p>
<?php echo form_open('guru/updatedataumum','class="form-horizontal" role="form"');?>
<?php
foreach($query->result() as $t)
{
	echo '
	<div class="form-group row row">
		<label class="col-sm-3 control-label"><strong>Jabatan Struktural / Fungsional</strong></label>
		<div class="col-sm-9"><input type="text" name="jabatan" value="'.$t->jabatan.'" class="form-control" placeholder="wajib diisi"></div>
	</div>';
	echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>NIK / NO KTP  </strong></label><div class="col-sm-9"><input type="text" name="nik" value="'.$t->nik.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>NUPTK</strong></label><div class="col-sm-9"><input type="text" name="nuptk" value="'.$t->nuptk.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>NPK </strong></label><div class="col-sm-9"><input type="text" name="npk" value="'.$t->npk.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>NIP </strong></label><div class="col-sm-9"><input type="text" name="nip" value="'.$t->nip.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>NIP Lama) </strong></label><div class="col-sm-9"><input type="text" name="nip_lama" value="'.$t->nip_lama.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nama</strong></label><div class="col-sm-9"><input type="text" name="nama" value="'.$t->nama.'" class="form-control" placeholder="wajib diisi" required></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nama (tanpa gelar) </strong></label><div class="col-sm-9"><input type="text" name="nama_tanpa_gelar" value="'.$t->nama_tanpa_gelar.'" class="form-control" placeholder="wajib diisi" required></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Gelar Akademik Depan</strong></label><div class="col-sm-3"><select name="gelar_depan" class="form-control">
	<option value="'.$t->gelar_depan.'">'.$t->gelar_depan.'</option>
	<option value=""></option>
	<option value="Drs.">Drs.</option>
	<option value="Dra.">Dra.</option>
	<option value="Ir.">Ir.</option>
	<option value="Dr.">Dr.</option>
	<option value="Prof.">Prof.</option>
	</select>
        </div>
	<label class="col-sm-3 control-label"><strong>isi sendiri bila tidak ada</strong></label><div class="col-sm-3"><input type="text" name="gelar_depan_kustom" class="form-control"></div>
</div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Gelar Akademik Belakang</strong></label><div class="col-sm-3"><select name="gelar_belakang" class="form-control">
	<option value="'.$t->gelar_belakang.'">'.$t->gelar_belakang.'</option>
	<option value=""></option>
	<option value="AP.">AP.</option>
	<option value="A.Ma.">A.Ma.</option>
	<option value="A.Md.">A.Md.</option>
	<option value="BA.">BA.</option>
	<option value="B.Sc.">B.Sc.</option>
	<option value="L.L.B.">L.L.B.</option>
	<option value="L.L.M.">L.L.M.</option>
	<option value="Lc.">Lc.</option>
	<option value="S.Ag.">S.Ag.</option>
	<option value="S.E.">S.E.</option>
	<option value="S.E.I">S.E.I</option>
	<option value="S.H.">S.H.</option>
	<option value="S.H.I">S.H.I</option>
	<option value="S.Hum.">S.Hum.</option>
	<option value="S.Hut.">S.Hut.</option>
	<option value="S.IP.">S.IP.</option>
	<option value="S.Ked.">S.Ked.</option>
	<option value="S.KG.">S.KG.</option>
	<option value="S.KH.">S.KH.</option>
	<option value="S.KM.">S.KM.</option>
	<option value="S.Kom.">S.Kom.</option>
	<option value="S.P.">S.P.</option>
	<option value="S.Pd.">S.Pd.</option>
	<option value="S.Pd.I.">S.Pd.I</option>
	<option value="S.Pi.">S.Pi.</option>
	<option value="S.Psi.">S.Psi.</option>
	<option value="S.Pt.">S.Pt.</option>
	<option value="S.S.">S.S.</option>
	<option value="S.Si.">S.Si.</option>
	<option value="S.Sn.">S.Sn.</option>
	<option value="S.Sos.">S.Sos.</option>
	<option value="S.T.">S.T.</option>
	<option value="S.TP.">S.TP.</option>
	<option value="M.A.">M.A.</option>
	<option value="M.Ag.">M.Ag.</option>
	<option value="M.B.A.">M.B.A.</option>
	<option value="M.Ec.">M.Ec.</option>
	<option value="M.Ed.">M.Ed.</option>
	<option value="M.Eng.">M.Eng.</option>
	<option value="M.M.">M.M.</option>
	<option value="M.Kes.">M.Kes.</option>
	<option value="M.Kom.">M.Kom</option>
	<option value="M.Hum.">M.Hum.</option>
	<option value="M.P.">M.P.</option>
	<option value="M.Pd.">M.Pd.</option>
	<option value="M.Pd.I">M.Pd.I</option>
	<option value="M.Sc.">M.Sc.</option>
	<option value="M.Si.">M.Si.</option>
	<option value="M.T.">M.T.</option>
	<option value="M.Th.">M.Th.</option>
	<option value="Ed.D.">Ed.D.</option>
	<option value="Ph.D">Ph.D.</option>
	<option value="Th.D">Th.D.</option>
	</select>
        </div>	<label class="col-sm-3 control-label"><strong>isi sendiri bila tidak ada</strong></label><div class="col-sm-3"><input type="text" name="gelar_belakang_kustom" class="form-control"></div>
</div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Tempat lahir </strong></label><div class="col-sm-9"><input type="text" name="tempat" value="'.$t->tempat.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Tanggal lahir </strong></label><div class="col-sm-2"><select name="harilahir"  class="form-control">';
	$postedhari=substr($t->tanggallahir,8,2);
	$postedbulan=substr($t->tanggallahir,5,2);
	$postedtahun=substr($t->tanggallahir,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="bulanlahir" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
        for($i=1;$i<10;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="tahunlahir" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
        $th=date("Y");
        $awal_th=$th-60;
        $akhir_th=$th-17;
        for($i=$awal_th;$i<=$akhir_th;$i++)
	{
       		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">&nbsp;</div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Jenis Kelamin </strong></label><div class="col-sm-9"><select name="jenkel" class="form-control">';
	if ($t->jenkel=='Lk')
	{
		echo '<option value="Lk">Laki - Laki</option>
                <option value="Pr">Perempuan</option>';
	}
	else
	{
		echo '<option value="Pr">Perempuan</option>
                <option value="Lk">Laki-laki</option>';
	}
        echo '</select></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Agama </strong></label><div class="col-sm-9"><select name="agama" class="form-control">
	<option value="'.$t->agama.'">'.$t->agama.'</option>
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Hindu">Hindu</option></select></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Status Perkawinan</strong></label><div class="col-sm-9"><select name="status_perkawinan" class="form-control">
	<option value="'.$t->status_perkawinan.'">'.$t->status_perkawinan.'</option>
        <option value="Belum Kawin">Belum Kawin</option>
        <option value="Kawin">Kawin</option>
        <option value="Duda">Duda</option>
	<option value="Janda">Janda</option></select>
        </div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Cacah Anak Kandung</strong></label><div class="col-sm-9"><input type="text" name="cacah_anak_kandung" value="'.$t->cacah_anak_kandung.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Alamat Rumah </strong></label><div class="col-sm-9"><input type="text" name="alamat" value="'.$t->alamat.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Jalan </strong></label><div class="col-sm-9"><input type="text" name="jalan" value="'.$t->jalan.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>RT / RW </strong></label>
	<div class="col-sm-1"><input type="text" name="rt" value="'.$t->rt.'" class="form-control"></div>
	<div class="col-sm-1"><input type="text" name="rw" value="'.$t->rw.'" class="form-control"></div>
	</div>';
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
	<?php
	echo '
	<div class="form-group row row"><label class="col-sm-3 control-label">Kode Pos</label>
	<div class="col-sm-3"><input type="text" name="kodepos" value="'.$t->kodepos.'" class="form-control" placeholder="wajib diisi"></div>
	</div>

	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Kategori Tempat Tinggal</strong></label><div class="col-sm-9"><select name="jenis_tempat_tinggal" class="form-control">
	<option value="'.$t->jenis_tempat_tinggal.'">'.$t->jenis_tempat_tinggal.'</option>
	<option value=""></option>
        <option value="Rumah Sendiri">Rumah Sendiri</option>
        <option value="Rumah Dinas">Rumah Dinas</option>
        <option value="Sewa / Kontrak">Sewa / Kontrak</option>
	<option value="Rumah Family">Rumah Family</option></select>
        </div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Golongan Darah</strong></label><div class="col-sm-9"><select name="golongan_darah" class="form-control">
	<option value="'.$t->golongan_darah.'">'.$t->golongan_darah.'</option>
	<option value=""></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="AB">AB</option>
	<option value="O">O</option></select>
        </div></div>
	<div class="form-group row row">
	<label class="col-sm-3 control-label"><strong>Telpon Rumah</strong></label>
	<div class="col-sm-9"><input type="text" name="telpon" value="'.$t->telpon.'" class="form-control"></div>
	</div>
	<div class="form-group row row">
	<label class="col-sm-3 control-label"><strong>Telpon Seluler</strong></label>
	<div class="col-sm-9"><input type="text" name="seluler" value="'.$t->seluler.'" class="form-control" placeholder="wajib diisi"></div>
	</div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Alamat Email</strong></label><div class="col-sm-9"><input type="text" name="email" value="'.$t->email.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor Kartu Pegawai (PNS)</strong></label><div class="col-sm-9"><input type="text" name="karpeg" value="'.$t->karpeg.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor ASKES (PNS)</strong></label><div class="col-sm-9"><input type="text" name="askes" value="'.$t->askes.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor Taspen (PNS)</strong></label><div class="col-sm-9"><input type="text" name="taspen" value="'.$t->taspen.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor KARIS/KARSU (PNS)</strong></label><div class="col-sm-9"><input type="text" name="karis_karsu" value="'.$t->karis_karsu.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor KPE</strong></label><div class="col-sm-9"><input type="text" name="kpe" value="'.$t->kpe.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>NPWP </strong></label><div class="col-sm-9"><input type="text" name="npwp" value="'.$t->npwp.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>EFIN </strong></label><div class="col-sm-9"><input type="text" name="efin" value="'.$t->efin.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nama Bank Pembayar Tunjangan Profesi </strong></label><div class="col-sm-9"><input type="text" name="bank" value="'.$t->bank.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nama pada Rekening Bank Pembayar Tunjangan Profesi </strong></label><div class="col-sm-9"><input type="text" name="nama_rekening_bank" value="'.$t->nama_rekening_bank.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor Rekening Bank Pembayar Tunjangan Profesi </strong></label><div class="col-sm-9"><input type="text" name="nomor_rekening_bank" value="'.$t->nomor_rekening_bank.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nama Ibu </strong></label><div class="col-sm-9"><input type="text" name="ibu" value="'.$t->ibu.'" class="form-control" placeholder="wajib diisi"></div></div>';
	if ($t->guru=='Y')
	{
		echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Apakah sudah ikut program sertifikasi guru? </strong></label><div class="col-sm-9"><select name="sudah_sertifikasi" class="form-control">
		<option value="'.$t->sudah_sertifikasi.'">'.$t->sudah_sertifikasi.'</option>
                <option value="Ya">Ya</option>
                <option value="Belum">Belum</option>
		</select>
		</div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Jika sudah ikut sertifikasi, apakah sudah lulus? </strong></label><div class="col-sm-9"><select name="lulus_sertifikasi" class="form-control">
		<option value="'.$t->lulus_sertifikasi.'">'.$t->lulus_sertifikasi.'</option>
                <option value="Ya">Ya</option>
                <option value="Belum">Belum</option>
		<option value="Masih Proses">Masih Proses</option>
		</select>
  	        </div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Jika sudah lulus program sertifikasi guru, sertifikasi mapel/bidang studi? </strong></label><div class="col-sm-9"><select name="mapel_sertifikasi" class="form-control">
		<option value="'.$t->mapel_sertifikasi.'">'.$t->mapel_sertifikasi.'</option>
		<option value=""></option>
		<option value = "Al Quran dan Hadits">Al Quran dan Hadits</option>
		<option value = "Antropologi">Antropologi</option>
		<option value = "Aqidah dan Akhlak">Aqidah dan Akhlak</option>
		<option value = "Balaghah">Balaghah</option>
		<option value = "Bhs. Arab">Bhs. Arab</option>
		<option value = "Bhs. Asing Lainnya">Bhs. Asing Lainnya</option>
		<option value = "Bhs. Daerah">Bhs. Daerah</option>
		<option value = "Bhs. Indonesia">Bhs. Indonesia</option>
		<option value = "Bhs. Inggris">Bhs. Inggris</option>
		<option value = "Bhs. Jerman">Bhs. Jerman</option>
		<option value = "Bhs. Perancis">Bhs. Perancis</option>
		<option value = "Biologi">Biologi</option>
		<option value = "Doa Harian">Doa Harian</option>
		<option value = "Ekonomi">Ekonomi</option>
		<option value = "Fiqih">Fiqih</option>
		<option value = "Fisik (Motorik Halus dan Kasar)">Fisik (Motorik Halus dan Kasar)</option>
		<option value = "Fisika">Fisika</option>
		<option value = "Geografi">Geografi</option>
		<option value = "Hadits / Ulumul Hadits">Hadits / Ulumul Hadits</option>
		<option value = "Huruf Hijaiyah">Huruf Hijaiyah</option>
		<option value = "Ilmu Falaq">Ilmu Falaq</option>
		<option value = "Ilmu Faraidh">Ilmu Faraidh</option>
		<option value = "Ilmu Hadits">Ilmu Hadits</option>
		<option value = "Ilmu Kalam">Ilmu Kalam</option>
		<option value = "Ilmu Mantiq">Ilmu Mantiq</option>
		<option value = "IPA">IPA</option>
		<option value = "IPS">IPS</option>
		<option value = "Kalimat Thoyibah">Kalimat Thoyibah</option>
		<option value = "Kegiatan Khusus">Kegiatan Khusus</option>
		<option value = "Kerajinan Tangan dan Kesenian">Kerajinan Tangan dan Kesenian</option>
		<option value = "Kimia">Kimia</option>
		<option value = "Kognitif">Kognitif</option>
		<option value = "Matematika">Matematika</option>
		<option value = "Muatan Lokal (Mulok)">Muatan Lokal (Mulok)</option>
		<option value = "PAI">PAI</option>
		<option value = "Penjaskes">Penjaskes</option>
		<option value = "Pkn">Pkn</option>
		<option value = "Praktik Ibadah">Praktik Ibadah</option>
		<option value = "Program Keterampilan">Program Keterampilan</option>
		<option value = "Sejarah Kebudayaan Islam">Sejarah Kebudayaan Islam</option>
		<option value = "Sejarah Nasional dan Umum">Sejarah Nasional dan Umum</option>
		<option value = "Sosial Emosional / Akhlaq">Sosial Emosional / Akhlaq</option>
		<option value = "Sosiologi">Sosiologi</option>
		<option value = "Surat Pendek Al Quran">Surat Pendek Al Quran</option>
		<option value = "Tafsir / Ilmu Tafsir">Tafsir / Ilmu Tafsir</option>
		<option value = "Tasawuf">Tasawuf</option>
		<option value = "Tata Negara">Tata Negara</option>
		<option value = "Tek. Info dan Komunikasi (TIK)">Tek. Info dan Komunikasi (TIK)</option>
		<option value = "Ushul Fiqh">Ushul Fiqh</option>
		<option value = "Lainnya">Lainnya</option>
		</select>
        	</div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>TMT Guru </strong></label><div class="col-sm-2"><select name="tgl_tmt_guru" class="form-control">';
		$postedhari=substr($t->tmt_guru,8,2);
		$postedbulan=substr($t->tmt_guru,5,2);
		$postedtahun=substr($t->tmt_guru,0,4);
		echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
		echo '<option value="00"></option>';
		for($i=1;$i<=9;$i++)
		{
			echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
		for($i=10;$i<=31;$i++)
		{
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select></div><div class="col-sm-2">';
		echo '<select name="bulan_tmt_guru" class="form-control">';
		echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
		echo '<option value="00"></option>';
        	for($i=1;$i<10;$i++)
		{
			echo '<option value="0'.$i.'">0'.$i.'</option>';
		}
		echo '<option value="10">10</option>';
		echo '<option value="11">11</option>';
		echo '<option value="12">12</option>';
		echo '</select></div><div class="col-sm-2">';
		echo '<select name="tahun_tmt_guru" class="form-control">';
		echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
		echo '<option value="0000"></option>';
	        $th=date("Y");
	       	$awal_th=$th;
	        $akhir_th=$th-50;
		$i = $awal_th;
		do
		{
		       	echo '<option value="'.$i.'">'.$i.'</option>';
			$i=$i-1;
		}
		while ($i>=$akhir_th);
		echo '</select></div><div class="col-sm-3">&nbsp;</div></div>';
	}
	echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>TMT di sekolah ini</strong></label><div class="col-sm-2"><select name="tgl_tmt_di_sekolah" class="form-control">';
	$postedhari=substr($t->tmt_di_sekolah,8,2);
	$postedbulan=substr($t->tmt_di_sekolah,5,2);
	$postedtahun=substr($t->tmt_di_sekolah,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	echo '<option value="00"></option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="bulan_tmt_di_sekolah" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
	echo '<option value="00"></option>';
        for($i=1;$i<10;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="tahun_tmt_di_sekolah" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
	echo '<option value="0000"></option>';
        $th=date("Y");
       	$awal_th=$th;
        $akhir_th=$th-50;
	$i = $awal_th;
	do
	{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
	}
	while ($i>=$akhir_th);
	echo '</select></div><div class="col-sm-3"></div></div>	';
	if ($t->guru=='Y')
	{
		echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Tanggal Lulus Sertifikasi </strong></label><div class="col-sm-2"><select name="harilulus_sertifikasi" class="form-control">';
		$postedhari=substr($t->tgl_lulus_sertifikasi,8,2);
		$postedbulan=substr($t->tgl_lulus_sertifikasi,5,2);
		$postedtahun=substr($t->tgl_lulus_sertifikasi,0,4);
		echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
		echo '<option value="00"></option>';
		for($i=1;$i<=9;$i++)
		{
			echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
		for($i=10;$i<=31;$i++)
		{
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select></div><div class="col-sm-2">';
		echo '<select name="bulanlulus_sertifikasi" class="form-control">';
		echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
		echo '<option value="00"></option>';
	        for($i=1;$i<10;$i++)
		{
			echo '<option value="0'.$i.'">0'.$i.'</option>';
		}
		echo '<option value="10">10</option>';
		echo '<option value="11">11</option>';
		echo '<option value="12">12</option>';
		echo '</select></div><div class="col-sm-2">';
		echo '<select name="tahunlulus_sertifikasi" class="form-control">';
		echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
		echo '<option value="0000"></option>';
	        $th=date("Y");
	       	$awal_th=$th;
	        $akhir_th=$th-50;
		$i = $awal_th;
		do
		{
		       	echo '<option value="'.$i.'">'.$i.'</option>';
			$i=$i-1;
		}
		while ($i>=$akhir_th);
		echo '</select></div><div class="col-sm-3"></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Kode Mapel Sertifikasi </strong></label><div class="col-sm-9"><input type="text" name="kode_mapel_sertifikasi" value="'.$t->kode_mapel_sertifikasi.'" class="form-control" placeholder="wajib diisi"></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Kode Mapel Utama (EMISS)</strong></label><div class="col-sm-9"><select name="kode_mapel_utama" class="form-control">';
		$kode_mapel_utama = $t->kode_mapel_utama;
		$ta = $this->db->query("select * from `kode_mapel_utama` where `kode` = '$kode_mapel_utama'");
		$mapel = '';
		foreach($ta->result() as $a)
		{
			$mapel = $a->mapel;
		}
		echo '<option value="'.$kode_mapel_utama.'">'.$mapel.'</option>';
		$ta = $this->db->query("select * from `kode_mapel_utama` where `kode` != '$kode_mapel_utama'");
		foreach($ta->result() as $a)
		{
			echo '<option value="'.$a->kode.'">'.$a->mapel.'</option>';
		}
		echo '</select></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Peg ID (Simpatika)</strong></label><div class="col-sm-9"><input type="text" name="pegid" value="'.$t->pegid.'" class="form-control"></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>NRG </strong></label><div class="col-sm-9"><input type="text" name="nrg" value="'.$t->nrg.'" class="form-control" placeholder="wajib diisi"></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Jalur Sertifikasi </strong></label><div class="col-sm-9">
		<select name="jalur_sertifikasi" class="form-control">';
		if($t->jalur_sertifikasi == '1')
		{
			echo '<option value="1">Portofolio</option>';
		}
		elseif($t->jalur_sertifikasi == '2')
		{
			echo '<option value="2">PLPG</option>';
		}
		elseif($t->jalur_sertifikasi == '3')
		{
			echo '<option value="3">PSPL</option>';
		}
		elseif($t->jalur_sertifikasi == '4')
		{
			echo '<option value="4">PPG dalam Jabatan (PPGJ)</option>';
		}
		elseif($t->jalur_sertifikasi == '5')
		{
			echo '<option value="5">PPG Pra Jabatan</option>';
		}
		elseif($t->jalur_sertifikasi == '6')
		{
			echo '<option value="6">Lainnya</option>';
		}
		else
		{
			echo '<option value=""></option>';
		}
		echo '<option value="1">Portofolio</option>';
		echo '<option value="2">PLPG</option>';
		echo '<option value="3">PSPL</option>';
		echo '<option value="4">PPG dalam Jabatan (PPGJ)</option>';
		echo '<option value="5">PPG Pra Jabatan</option>';
		echo '<option value="6">Lainnya</option>';
		echo '</select></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>LPTK Sertifikasi </strong></label><div class="col-sm-9">
		<select name="kode_lptk" class="form-control">';
		$kode_lptk = $t->kode_lptk;
		$lptk = '';
		$tb = $this->db->query("select * from `kode_lptk` where `kode`='$kode_lptk'");
		foreach($tb->result() as $b)
		{
			$lptk = $b->lptk;
		}
		echo '<option value="'.$kode_lptk.'">'.$lptk.'</option>';
		$tb = $this->db->query("select * from `kode_lptk` where `kode` !='$kode_lptk' order by `lptk`");
		foreach($tb->result() as $b)
		{
			$lptk = $b->lptk;
			echo '<option value="'.$b->kode.'">'.$lptk.'</option>';
		}
		echo '</select></div></div>';
		echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor peserta sertifikasi </strong></label><div class="col-sm-9"><input type="text" name="no_peserta_sertifikasi" value="'.$t->no_peserta_sertifikasi.'" class="form-control" placeholder="wajib diisi"></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor Sertifikat </strong></label><div class="col-sm-9"><input type="text" name="no_sertifikat" value="'.$t->no_sertifikat.'" class="form-control" placeholder="wajib diisi"></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Tanggal Sertifikat </strong></label><div class="col-sm-2"><select name="hari_sertifikat" class="form-control">';
		$postedhari=substr($t->tanggal_sertifikat,8,2);
		$postedbulan=substr($t->tanggal_sertifikat,5,2);
		$postedtahun=substr($t->tanggal_sertifikat,0,4);
		echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
		echo '<option value="00"></option>';
		for($i=1;$i<=9;$i++)
		{
			echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
		for($i=10;$i<=31;$i++)
		{
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select></div><div class="col-sm-2">';
		echo '<select name="bulan_sertifikat" class="form-control">';
		echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
		echo '<option value="00"></option>';
	        for($i=1;$i<10;$i++)
		{
			echo '<option value="0'.$i.'">0'.$i.'</option>';
		}
		echo '<option value="10">10</option>';
		echo '<option value="11">11</option>';
		echo '<option value="12">12</option>';
		echo '</select></div><div class="col-sm-2">';
		echo '<select name="tahun_sertifikat" class="form-control">';
		echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
		echo '<option value="0000"></option>';
	        $th=date("Y");
	       	$awal_th=$th;
	        $akhir_th=$th-50;
		$i = $awal_th;
		do
		{
		       	echo '<option value="'.$i.'">'.$i.'</option>';
			$i=$i-1;
		}
		while ($i>=$akhir_th);
		echo '</select></div><div class="col-sm-3"></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Tugas Pokok </strong></label><div class="col-sm-9"><select name="tugas_pokok" class="form-control">
		<option value="'.$t->tugas_pokok.'">'.$t->tugas_pokok.'</option>
	        <option value="Guru mapel pada RA/Madrasah">Guru Mapel pada RA/Madrasah</option>
		<option value="Guru kelas">Guru kelas</option>
		</select>
		</div></div>';
		echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nomor SK Dirjen tentang NRG </strong></label><div class="col-sm-9"><input type="text" name="nomor_sk_dirjen" value="'.$t->nomor_sk_dirjen.'" class="form-control" placeholder="wajib diisi"></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Status Tempat Tugas</label></div><div class="col-sm-9">';
			echo '<select name="status_tempat_tugas" class="form-control">';
			if (($t->status_tempat_tugas =='0') or ($t->status_tempat_tugas ==''))
				{
				echo '<option value="0">Bukan Induk / Bukan Pangkalan</option>';		
				echo '<option value="1">Induk / Pangkalan</option>';
				}
				else
				{
				echo '<option value="1">Induk / Pangkalan</option>';
				echo '<option value="0">Bukan Induk / Bukan Pangkalan</option>';		
				}
			echo '</select></div></div>';

	}
	//kgb pertama
	echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Kenaikan Gaji Berkala</strong></label><div class="col-sm-2"><select name="haripertama" class="form-control">';
	$postedhari=substr($t->kgb_pertama,8,2);
	$postedbulan=substr($t->kgb_pertama,5,2);
	$postedtahun=substr($t->kgb_pertama,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="bulanpertama" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
        for($i=1;$i<10;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="tahunpertama" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
        $th=date("Y");
       	$awal_th=$th;
        $akhir_th=$th-50;
	$i = $awal_th;
	do
	{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
	}
	while ($i>=$akhir_th);
	echo '</select></div><div class="col-sm-3"></div></div>';
	//kgb terakhir
	echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Kenaikan Gaji Berkala Terakhir</strong></label><div class="col-sm-2"><select name="harikgb" class="form-control">';
	$postedhari=substr($t->kgb,8,2);
	$postedbulan=substr($t->kgb,5,2);
	$postedtahun=substr($t->kgb,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="bulankgb" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
        for($i=1;$i<10;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="tahunkgb" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
        $th=date("Y");
       	$awal_th=$th;
        $akhir_th=$th-50;
	$i = $awal_th;
	do
	{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
	}
	while ($i>=$akhir_th);
	echo '</select></div><div class="col-sm-3"></div></div>';
	echo '<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Usia pensiun</strong></label><div class="col-sm-9"><input type="text" name="usiapensiun" value="'.$t->usiapensiun.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Tanggal Pensiun</strong></label><div class="col-sm-9">';echo date_to_long_string($t->tanggalpensiun);echo '</div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Bangsa</strong></label><div class="col-sm-9"><input type="text" name="bangsa" value="Indonesia" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nama Ayah</strong></label><div class="col-sm-9"><input type="text" name="ayah" value="'.$t->ayah.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Alamat Orang Tua</strong></label><div class="col-sm-9"><input type="text" name="alamatortu" value="'.$t->alamatortu.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nama Ayah Mertua</strong></label><div class="col-sm-9"><input type="text" name="ayahmertua" value="'.$t->ayahmertua.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Nama Ibu Mertua</strong></label><div class="col-sm-9"><input type="text" name="ibumertua" value="'.$t->ibumertua.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Alamat mertua</strong></label><div class="col-sm-9"><input type="text" name="alamatmertua" value="'.$t->alamatmertua.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Tinggi Badan</strong></label><div class="col-sm-9"><input type="text" name="tb" value="'.$t->tb.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Berat Badan</strong></label><div class="col-sm-9"><input type="text" name="bb" value="'.$t->bb.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Rambut</strong></label><div class="col-sm-9"><input type="text" name="rambut" value="'.$t->rambut.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Bentuk Muka</strong></label><div class="col-sm-9"><input type="text" name="bentuk_muka" value="'.$t->bentuk_muka.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Warna Kulit</strong></label><div class="col-sm-9"><input type="text" name="warna_kulit" value="'.$t->warna_kulit.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Ciri Khas</strong></label><div class="col-sm-9"><input type="text" name="ciri_khas" value="'.$t->ciri_khas.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Cacat Tubuh</strong></label><div class="col-sm-9"><input type="text" name="cacat_tubuh" value="'.$t->cacat_tubuh.'" class="form-control"></div></div>
	<div class="form-group row row"><label class="col-sm-3 control-label"><strong>Kegemaran</strong></label><div class="col-sm-9"><input type="text" name="kegemaran" value="'.$t->kegemaran.'" class="form-control"></div></div>';
	echo '</table>';
}
?>
<input type="hidden" name="kd" value="<?php echo $kd;?>">
<p class="text-center"><input type="submit" value="Perbarui Data" class="btn btn-primary"></p>
</form>
</div>
