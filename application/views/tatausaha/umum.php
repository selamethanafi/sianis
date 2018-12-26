<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: umum.php
// Lokasi      		: application/views/tatausaha/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
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

<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">

<p><a href="<?php echo base_url(); ?>tatausaha/umum"><b>Pegawai Lain</b></a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>tatausaha/umumdrh"><b>Pegawai Lain (DRH)</b></a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>tatausaha/keluarga"><b>Keluarga</b></a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>tatausaha/pendidikan"><b>Pendidikan</b></a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>tatausaha/kepegawaian"><b>Kepegawaian</b></a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>tatausaha/diklat"><b>Diklat / Workshop / Kursus / Seminar</b></a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>tatausaha/organisasi"><b>Organisasi</b></a>&nbsp;&nbsp;&nbsp;

<?php
if (empty($usernamepegawai))
{
	$xloc = base_url().'tatausaha/umum/';
	$ta = $this->db->query("select `kd`,`nama_tanpa_gelar`,`nama` from `p_pegawai` where `status` = 'Y'");
	echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form"><div class="form-group row"><div class="col-sm-3"><label class="control-label">Pilih Pegawai</label></div><div class="col-sm-9">';
	echo "<select name=\"kd\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value="'.$usernamepegawai.'">'.$tahunpenilaian.'</option>';
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$xloc.''.$a->kd.'">'.$a->nama_tanpa_gelar.' '.$a->nama.'</option>';
	}
	echo '</select></div></div>';
}
echo '</form>';
 echo form_open_multipart('tatausaha/umum/'.$usernamepegawai,'class="form-horizontal" role="form"');?>
	<?php
	if (!empty($usernamepegawai))
		{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9">
		<select name="usernamepegawai" class="form-control"><option value="'.$usernamepegawai.'">'.$namapegawai.'</option></select><font color="#FF0000"><strong> '.$terupdate.'</strong></font></div></div>';
		foreach($query->result() as $t)
			{
			if (!empty($t->foto))
			{
			$fotone = ''.base_url().'images/foto_guru_pegawai/'.$t->foto.'';
			echo '<center><img src="'.$fotone.'" height="200" class="im img-rounded"></center>';
			}

			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Foto</label></div><div class="col-sm-9"><input type="file" name="userfile" class="textfield"> * Bila foto tidak diganti, silahkan dikosongkan saja. Resolusi max 320x420 pix</div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status Kepegawaian</label></div><div class="col-sm-9">
		<select name="status_kepegawaian" class="form-control"><option value="'.$t->status_kepegawaian.'">'.$t->status_kepegawaian.'</option><option value="CPNS">CPNS</option><option value="PNS">PNS</option><option value="NonPNS">NonPNS</option>
</select></div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Apakah Guru atau Tatausaha</label></div><div class="col-sm-9">
		<select name="guru" class="form-control">';
			if ($t->guru=='Y')
				{
				echo '<option value="'.$t->guru.'">Guru</option>';
				echo '<option value="T">Tatausaha</option>';
				}
			if ($t->guru=='T')
				{
				echo '<option value="'.$t->guru.'">Tatausaha</option>';
				echo '<option value="Y">Guru</option>';
				}
			if ($t->guru=='')
				{
				echo '<option value="T">Tatausaha</option>';
				echo '<option value="Y">Guru</option>';
				}
	
			echo '</select></div></div>';

			echo '
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jabatan Struktural / Fungsional</label></div><div class="col-sm-9"><input type="text" class="form-control" name="jabatan" value="'.$t->jabatan.'" ><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>';
			if ($t->guru=='T')
				{
				echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tugas Utama Ketatausahaan</label></div><div class="col-sm-9"><input type="text" class="form-control" name="tugas_utama_non_guru" value="'.$t->tugas_utama_non_guru.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>';
				}

echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIK / NO KTP *) </label></div><div class="col-sm-9"><input type="text" class="form-control" name="nik" value="'.$t->nik.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">NUPTK</label></div><div class="col-sm-9"><input type="text" class="form-control" name="nuptk" value="'.$t->nuptk.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIP </label></div><div class="col-sm-9"><input type="text" class="form-control" name="nip" value="'.$t->nip.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIP Lama) </label></div><div class="col-sm-9"><input type="text" class="form-control" name="nip_lama" value="'.$t->nip_lama.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" class="form-control" name="nama" value="'.$t->nama.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama (tanpa gelar) *)</label></div><div class="col-sm-9"><input type="text" class="form-control" name="nama_tanpa_gelar" value="'.$t->nama_tanpa_gelar.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Gelar Akademik Depan</label></div><div class="col-sm-9"><select class="form-control" name="gelar_depan" >
	<option value="'.$t->gelar_depan.'">'.$t->gelar_depan.'</option>
	<option value="Drs.">Drs.</option>
	<option value="Dra.">Dra.</option>
	<option value="Ir.">Ir.</option>
	<option value="Dr.">Dr.</option>
	<option value="Prof.">Prof.</option>
	</select>
              </div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Gelar Akademik Belakang</label></div><div class="col-sm-9"><select class="form-control" name="gelar_belakang" >
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
              </div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat, tanggal lahir *)</label></div><div class="col-sm-9"><input type="text" size="30" name="tempat" value="'.$t->tempat.'">, <select name="harilahir">';
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
	echo '</select>';
	echo '<select name="bulanlahir" >';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	echo '<select name="tahunlahir" >';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
        $th=date("Y");
        $awal_th=$th-60;
        $akhir_th=$th-17;
        for($i=$awal_th;$i<=$akhir_th;$i++)
	{
       	echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Kelamin *)</label></div><div class="col-sm-9"><select class="form-control" name="jenkel" >';

		if ($t->jenkel=='Lk')
			{
			echo '<option value="Lk">Laki - Laki</option>
		                <option value="Pr">Perempuan</option></select>';
			}
			else
			{
			echo '<option value="Pr">Perempuan</option>
	                <option value="Lk">Laki-laki</option></select>';
			}
			
              echo '<font color="#FF0000"><strong> wajib diisi</strong></font></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama *)</label></div><div class="col-sm-9"><select class="form-control" name="agama" >
		<option value="'.$t->agama.'">'.$t->agama.'</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option></select>
              <font color="#FF0000"><strong> wajib diisi</strong></font></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status Perkawinan</label></div><div class="col-sm-9"><select class="form-control" name="status_perkawinan" >
		<option value="'.$t->status_perkawinan.'">'.$t->status_perkawinan.'</option>
                <option value="Belum Kawin">Belum Kawin</option>
                <option value="Kawin">Kawin</option>
                <option value="Duda">Duda</option>
		<option value="Janda">Janda</option></select>
              </div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Anak Kandung</label></div><div class="col-sm-9"><input type="text" class="form-control" name="cacah_anak_kandung" value="'.$t->cacah_anak_kandung.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat Rumah *)</label></div><div class="col-sm-9"><input type="text" class="form-control" name="alamat" value="'.$t->alamat.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jalan *)</label></div><div class="col-sm-9"><input type="text" class="form-control" name="jalan" value="'.$t->jalan.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">RT / RW *)</label></div><div class="col-sm-9"><input type="text" size="3" name="rt" value="'.$t->rt.'"> / <input type="text" size="3" name="rw" value="'.$t->rw.'"> Kode Pos :<input type="text" size="3" name="kodepos" value="'.$t->kodepos.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>';
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
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kategori Tempat Tinggal</label></div><div class="col-sm-9"><select class="form-control" name="jenis_tempat_tinggal" >
		<option value="'.$t->jenis_tempat_tinggal.'">'.$t->jenis_tempat_tinggal.'</option>
		<option value=""></option>
                <option value="Rumah Sendiri">Rumah Sendiri</option>
                <option value="Rumah Dinas">Rumah Dinas</option>
                <option value="Sewa / Kontrak">Sewa / Kontrak</option>
		<option value="Rumah Family">Rumah Family</option></select>
              </div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Golongan Darah</label></div><div class="col-sm-9"><select class="form-control" name="golongan_darah" >
		<option value="'.$t->golongan_darah.'">'.$t->golongan_darah.'</option>
		<option value=""></option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
		<option value="O">O</option></select>
              </div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Telpon Rumah</label></div><div class="col-sm-9"><input type="text" class="form-control" name="telpon" value="'.$t->telpon.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">HP</label></div><div class="col-sm-9"><input type="text" class="form-control" name="seluler" value="'.$t->seluler.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat Email</label></div><div class="col-sm-9"><input type="text" class="form-control" name="email" value="'.$t->email.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Kartu Pegawai (PNS)</label></div><div class="col-sm-9"><input type="text" class="form-control" name="karpeg" value="'.$t->karpeg.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor ASKES (PNS)</label></div><div class="col-sm-9"><input type="text" class="form-control" name="askes" value="'.$t->askes.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Taspen (PNS)</label></div><div class="col-sm-9"><input type="text" class="form-control" name="taspen" value="'.$t->taspen.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor KARIS/KARSU (PNS)</label></div><div class="col-sm-9"><input type="text" class="form-control" name="karis_karsu" value="'.$t->karis_karsu.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor KPE</label></div><div class="col-sm-9"><input type="text" class="form-control" name="kpe" value="'.$t->kpe.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">NPWP</label></div><div class="col-sm-9"><input type="text" class="form-control" name="npwp" value="'.$t->npwp.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Ibu</label></div><div class="col-sm-9"><input type="text" class="form-control" name="ibu" value="'.$t->ibu.'"><font color="#FF0000"><strong> wajib diisi</strong></font></div></div>';
	if ($t->guru=='Y')
	{
	echo'
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Apakah sudah ikut program sertifikasi guru?</label></div><div class="col-sm-9"><select class="form-control" name="sudah_sertifikasi" >
		<option value="'.$t->sudah_sertifikasi.'">'.$t->sudah_sertifikasi.'</option>
                <option value="Ya">Ya</option>
                <option value="Belum">Belum</option>
		</select>
              </div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jika sudah ikut sertifikasi, apakah sudah lulus?</label></div><div class="col-sm-9"><select class="form-control" name="lulus_sertifikasi" >
		<option value="'.$t->lulus_sertifikasi.'">'.$t->lulus_sertifikasi.'</option>
                <option value="Ya">Ya</option>
                <option value="Belum">Belum</option>
		<option value="Masih Proses">Masih Proses</option>
		</select>
              </div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jika sudah lulus program sertifikasi guru, sertifikasi mapel/bidang studi?</label></div><div class="col-sm-9"><select class="form-control" name="mapel_sertifikasi" >
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

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Lulus Sertifikasi</label></div><div class="col-sm-9"><select name="harilulus_sertifikasi">';
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
	echo '</select>';
	echo '<select name="bulanlulus_sertifikasi" >';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
	echo '<option value="00"></option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	echo '<select name="tahunlulus_sertifikasi" >';
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
	echo '</select></div></div>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">NRG</label></div><div class="col-sm-9"><input type="text" class="form-control" name="nrg" value="'.$t->nrg.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor peserta sertifikasi</label></div><div class="col-sm-9"><input type="text" class="form-control" name="no_peserta_sertifikasi" value="'.$t->no_peserta_sertifikasi.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Sertifikat</label></div><div class="col-sm-9"><input type="text" class="form-control" name="no_sertifikat" value="'.$t->no_sertifikat.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tugas Pokok</label></div><div class="col-sm-9"><select class="form-control" name="tugas_pokok" >
		<option value="'.$t->tugas_pokok.'">'.$t->tugas_pokok.'</option>
                <option value="Guru mapel pada RA/Madrasah">Guru Mapel pada RA/Madrasah</option>
		<option value="Guru kelas">Guru kelas</option>
		</select>
              </div></div>';
	} // kalau guru
	//kgb pertama
	echo '
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kenaikan Gaji Berkala</label></div><div class="col-sm-9"><select name="haripertama">';
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
	echo '</select>';
	echo '<select name="bulanpertama" >';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	echo '<select name="tahunpertama" >';
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
	echo '</select></div></div>';

	//kgb terakhir
	echo '
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kenaikan Gaji Berkala Terakhir</label></div><div class="col-sm-9"><select name="harikgb">';
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
	echo '</select>';
	echo '<select name="bulankgb" >';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	echo '<select name="tahunkgb" >';
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
	echo '</select></div></div>';
	echo '
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Usia pensiun</label></div><div class="col-sm-9"><input type="text" class="form-control" name="usiapensiun" value="'.$t->usiapensiun.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Pensiun</label></div><div class="col-sm-9">';echo $t->tanggalpensiun;echo '</div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bangsa</label></div><div class="col-sm-9"><input type="text" class="form-control" name="bangsa" value="Indonesia"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Ayah</label></div><div class="col-sm-9"><input type="text" class="form-control" name="ayah" value="'.$t->ayah.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat Orang Tua</label></div><div class="col-sm-9"><input type="text" class="form-control" name="alamatortu" value="'.$t->alamatortu.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Ayah Mertua</label></div><div class="col-sm-9"><input type="text" class="form-control" name="ayahmertua" value="'.$t->ayahmertua.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Ibu Mertua</label></div><div class="col-sm-9"><input type="text" class="form-control" name="ibumertua" value="'.$t->ibumertua.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat mertua</label></div><div class="col-sm-9"><input type="text" class="form-control" name="alamatmertua" value="'.$t->alamatmertua.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tinggi Badan</label></div><div class="col-sm-9"><input type="text" class="form-control" name="tb" value="'.$t->tb.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berat Badan</label></div><div class="col-sm-9"><input type="text" class="form-control" name="bb" value="'.$t->bb.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Rambut</label></div><div class="col-sm-9"><input type="text" class="form-control" name="rambut" value="'.$t->rambut.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bentuk Muka</label></div><div class="col-sm-9"><input type="text" class="form-control" name="bentuk_muka" value="'.$t->bentuk_muka.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Warna Kulit</label></div><div class="col-sm-9"><input type="text" class="form-control" name="warna_kulit" value="'.$t->warna_kulit.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ciri Khas</label></div><div class="col-sm-9"><input type="text" class="form-control" name="ciri_khas" value="'.$t->ciri_khas.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacat Tubuh</label></div><div class="col-sm-9"><input type="text" class="form-control" name="cacat_tubuh" value="'.$t->cacat_tubuh.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kegemaran</label></div><div class="col-sm-9"><input type="text" class="form-control" name="kegemaran" value="'.$t->kegemaran.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Chat ID Telegram</label></div><div class="col-sm-9"><input type="text" class="form-control" name="chat_id" value="'.$t->chat_id.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Termasuk Daftar Emiss</label></div><div class="col-sm-9"><input type="text" class="form-control" name="emiss" value="'.$t->emiss.'"></div></div>';

			}
		echo '<p class="text-center"><input type="hidden" name="terupdate" value="oke"><input type="submit" value="Simpan Data Umum Pegawai" class="btn btn-primary"> <a href="'.base_url().'tatausaha/umum" class="btn btn-info"><b>Batal</b></a></p>';

		}
?>
</form>
</div></div></div>
