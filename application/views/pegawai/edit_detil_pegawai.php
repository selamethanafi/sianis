<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: edit_detil_pegawai.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?><div class="container"><h3>Sunting Data Umum Pegawai</h3>
<p><a href="<?php echo base_url();?>pegawai/umum" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> <b>Batal</b></a></p>
<?php echo form_open('pegawai/updatedataumum','class="form-horizontal" role="form"');?>
<?php
foreach($query->result() as $t)
{
	echo '
	<div class="form-group">
		<label class="col-sm-3 control-label"><strong>Jabatan Struktural / Fungsional</strong></label>
		<div class="col-sm-9"><input type="text" name="jabatan" value="'.$t->jabatan.'" class="form-control" placeholder="wajib diisi"></div>
	</div>';
	echo '<div class="form-group"><label class="col-sm-3 control-label"><strong>NIK / NO KTP  </strong></label><div class="col-sm-9"><input type="text" name="nik" value="'.$t->nik.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>NUPTK</strong></label><div class="col-sm-9"><input type="text" name="nuptk" value="'.$t->nuptk.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>NIP </strong></label><div class="col-sm-9"><input type="text" name="nip" value="'.$t->nip.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>NIP Lama) </strong></label><div class="col-sm-9"><input type="text" name="nip_lama" value="'.$t->nip_lama.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nama</strong></label><div class="col-sm-9"><input type="text" name="nama" value="'.$t->nama.'" class="form-control" placeholder="wajib diisi" required></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nama (tanpa gelar) </strong></label><div class="col-sm-9"><input type="text" name="nama_tanpa_gelar" value="'.$t->nama_tanpa_gelar.'" class="form-control" placeholder="wajib diisi" required></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Gelar Akademik Depan</strong></label><div class="col-sm-9"><select name="gelar_depan" class="form-control">
	<option value="'.$t->gelar_depan.'">'.$t->gelar_depan.'</option>
	<option value=""></option>
	<option value="Drs.">Drs.</option>
	<option value="Dra.">Dra.</option>
	<option value="Ir.">Ir.</option>
	<option value="Dr.">Dr.</option>
	<option value="Prof.">Prof.</option>
	</select>
        </div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Gelar Akademik Belakang</strong></label><div class="col-sm-9"><select name="gelar_belakang" class="form-control">
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
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Tempat lahir </strong></label><div class="col-sm-9"><input type="text" name="tempat" value="'.$t->tempat.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Tanggal lahir </strong></label><div class="col-sm-2"><select name="harilahir"  class="form-control">';
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
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Jenis Kelamin </strong></label><div class="col-sm-9"><select name="jenkel" class="form-control">';
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
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Agama </strong></label><div class="col-sm-9"><select name="agama" class="form-control">
	<option value="'.$t->agama.'">'.$t->agama.'</option>
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Hindu">Hindu</option></select></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Status Perkawinan</strong></label><div class="col-sm-9"><select name="status_perkawinan" class="form-control">
	<option value="'.$t->status_perkawinan.'">'.$t->status_perkawinan.'</option>
        <option value="Belum Kawin">Belum Kawin</option>
        <option value="Kawin">Kawin</option>
        <option value="Duda">Duda</option>
	<option value="Janda">Janda</option></select>
        </div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Cacah Anak Kandung</strong></label><div class="col-sm-9"><input type="text" name="cacah_anak_kandung" value="'.$t->cacah_anak_kandung.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Alamat Rumah </strong></label><div class="col-sm-9"><input type="text" name="alamat" value="'.$t->alamat.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Jalan </strong></label><div class="col-sm-9"><input type="text" name="jalan" value="'.$t->jalan.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>RT / RW </strong></label>
	<div class="col-sm-1"><input type="text" name="rt" value="'.$t->rt.'" class="form-control"></div>
	<div class="col-sm-1"><input type="text" name="rw" value="'.$t->rw.'" class="form-control"></div>
	</div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Provinsi </strong></label><div class="col-sm-9"><input type="text" name="provinsi" value="'.$t->provinsi.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Kabupaten / Kota </strong></label><div class="col-sm-9"><input type="text" name="kabupaten" value="'.$t->kabupaten.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Kecamatan </strong></label><div class="col-sm-9"><input type="text" name="kecamatan" value="'.$t->kecamatan.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Kelurahan </strong></label><div class="col-sm-9"><input type="text" name="desa" value="'.$t->desa.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label">Kode Pos</label>
	<div class="col-sm-3"><input type="text" name="kodepos" value="'.$t->kodepos.'" class="form-control" placeholder="wajib diisi"></div>
	</div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Kategori Tempat Tinggal</strong></label><div class="col-sm-9"><select name="jenis_tempat_tinggal" class="form-control">
	<option value="'.$t->jenis_tempat_tinggal.'">'.$t->jenis_tempat_tinggal.'</option>
	<option value=""></option>
        <option value="Rumah Sendiri">Rumah Sendiri</option>
        <option value="Rumah Dinas">Rumah Dinas</option>
        <option value="Sewa / Kontrak">Sewa / Kontrak</option>
	<option value="Rumah Family">Rumah Family</option></select>
        </div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Golongan Darah</strong></label><div class="col-sm-9"><select name="golongan_darah" class="form-control">
	<option value="'.$t->golongan_darah.'">'.$t->golongan_darah.'</option>
	<option value=""></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="AB">AB</option>
	<option value="O">O</option></select>
        </div></div>
	<div class="form-group">
	<label class="col-sm-3 control-label"><strong>Telpon Rumah</strong></label>
	<div class="col-sm-9"><input type="text" name="telpon" value="'.$t->telpon.'" class="form-control"></div>
	</div>
	<div class="form-group">
	<label class="col-sm-3 control-label"><strong>Telpon Seluler</strong></label>
	<div class="col-sm-9"><input type="text" name="seluler" value="'.$t->seluler.'" class="form-control" placeholder="wajib diisi"></div>
	</div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Alamat Email</strong></label><div class="col-sm-9"><input type="text" name="email" value="'.$t->email.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nomor Kartu Pegawai (PNS)</strong></label><div class="col-sm-9"><input type="text" name="karpeg" value="'.$t->karpeg.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nomor ASKES (PNS)</strong></label><div class="col-sm-9"><input type="text" name="askes" value="'.$t->askes.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nomor Taspen (PNS)</strong></label><div class="col-sm-9"><input type="text" name="taspen" value="'.$t->taspen.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nomor KARIS/KARSU (PNS)</strong></label><div class="col-sm-9"><input type="text" name="karis_karsu" value="'.$t->karis_karsu.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nomor KPE</strong></label><div class="col-sm-9"><input type="text" name="kpe" value="'.$t->kpe.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>NPWP </strong></label><div class="col-sm-9"><input type="text" name="npwp" value="'.$t->npwp.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>EFIN </strong></label><div class="col-sm-9"><input type="text" name="efin" value="'.$t->efin.'" class="form-control" placeholder="wajib diisi"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nama Ibu </strong></label><div class="col-sm-9"><input type="text" name="ibu" value="'.$t->ibu.'" class="form-control" placeholder="wajib diisi"></div></div>';
	echo '<div class="form-group"><label class="col-sm-3 control-label"><strong>TMT di sekolah ini</strong></label><div class="col-sm-2"><select name="tgl_tmt_di_sekolah" class="form-control">';
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
	//kgb pertama
	echo '<div class="form-group"><label class="col-sm-3 control-label"><strong>Kenaikan Gaji Berkala</strong></label><div class="col-sm-2"><select name="haripertama" class="form-control">';
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
	echo '<div class="form-group"><label class="col-sm-3 control-label"><strong>Kenaikan Gaji Berkala Terakhir</strong></label><div class="col-sm-2"><select name="harikgb" class="form-control">';
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
	echo '<div class="form-group"><label class="col-sm-3 control-label"><strong>Usia pensiun</strong></label><div class="col-sm-9"><input type="text" name="usiapensiun" value="'.$t->usiapensiun.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Tanggal Pensiun</strong></label><div class="col-sm-9">';echo date_to_long_string($t->tanggalpensiun);echo '</div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Bangsa</strong></label><div class="col-sm-9"><input type="text" name="bangsa" value="Indonesia" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nama Ayah</strong></label><div class="col-sm-9"><input type="text" name="ayah" value="'.$t->ayah.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Alamat Orang Tua</strong></label><div class="col-sm-9"><input type="text" name="alamatortu" value="'.$t->alamatortu.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nama Ayah Mertua</strong></label><div class="col-sm-9"><input type="text" name="ayahmertua" value="'.$t->ayahmertua.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Nama Ibu Mertua</strong></label><div class="col-sm-9"><input type="text" name="ibumertua" value="'.$t->ibumertua.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Alamat mertua</strong></label><div class="col-sm-9"><input type="text" name="alamatmertua" value="'.$t->alamatmertua.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Tinggi Badan</strong></label><div class="col-sm-9"><input type="text" name="tb" value="'.$t->tb.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Berat Badan</strong></label><div class="col-sm-9"><input type="text" name="bb" value="'.$t->bb.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Rambut</strong></label><div class="col-sm-9"><input type="text" name="rambut" value="'.$t->rambut.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Bentuk Muka</strong></label><div class="col-sm-9"><input type="text" name="bentuk_muka" value="'.$t->bentuk_muka.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Warna Kulit</strong></label><div class="col-sm-9"><input type="text" name="warna_kulit" value="'.$t->warna_kulit.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Ciri Khas</strong></label><div class="col-sm-9"><input type="text" name="ciri_khas" value="'.$t->ciri_khas.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Cacat Tubuh</strong></label><div class="col-sm-9"><input type="text" name="cacat_tubuh" value="'.$t->cacat_tubuh.'" class="form-control"></div></div>
	<div class="form-group"><label class="col-sm-3 control-label"><strong>Kegemaran</strong></label><div class="col-sm-9"><input type="text" name="kegemaran" value="'.$t->kegemaran.'" class="form-control"></div></div>';
	echo '</table>';
}
?>
<input type="hidden" name="kd" value="<?php echo $kd;?>">
<p class="text-center"><input type="submit" value="Perbarui Data" class="btn btn-primary"></p>
</form>
</div>
