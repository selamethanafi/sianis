<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: harian_kirim.php
// Lokasi      		: application/views/sieka/
// Terakhir diperbarui	: Sen 07 Jan 2019 20:10:40 WIB  
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
?><div class="container-fluid"><div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
$id_tahunan = '';
$tc = $this->db->query("select * from `sieka_user` where `nip`='$nip'");
foreach($tc->result() as $c)
{
	$id_pns = $c->id_pns;
}

$tb = $this->db->query("select * from `skp_skor_guru` where `nip`='$nip' and `kegiatan` like '%Melaksanakan Proses Pembelajaran%' and `tahun`='$tahunpenilaian'");
foreach($tb->result() as $b)
{
	$id_tahunan = $b->id_tahunan;
}
$ta = $this->db->query("select * from `sieka_harian` where `id_sieka_harian`='$id' and `nip`='$nip'");
$this->db->query("update `sieka_harian` set `terkirim` ='1' where `id_sieka_harian`='$id' and `nip`='$nip'");
if($ta->num_rows() > 0)
{
	echo form_open_multipart("http://sieka.kemenag.go.id/kinerja/?menu=kegiatan_harian&judul=Tambah%20Kegiatan%20Harian&aksi=tambah");
	foreach($ta->result() as $a)
	{
	$tanggal = substr($a->tanggal,8,2);
	$bulan = substr($a->tanggal,5,2);
	$tahun = substr($a->tanggal,0,4);
	$jtm = $a->kuantitas;
	$satuan = 'dokumen';
	if(substr($a->kegiatan,0,5) == 'melak')
	{
		$satuan = 'jam tatap muka';
	}
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><input type="hidden" name ="nama_kegiatan" value = "'.$a->kegiatan.'" class="form-control">'.$a->kegiatan.'</div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-3"><input type="text" name="tanggal" value = "'.$tanggal.'" class="form-control"></div><div class="col-sm-3"><input type="text" name="bulan" value = "'.$bulan.'" class="form-control"></div><div class="col-sm-3"><input type="text" name="tahun" value = "'.$tahun.'" class="form-control"></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kuantitas</label></div><div class="col-sm-9"><input type="text" name ="kuantitas" value = "'.$jtm.'" class="form-control"></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Satuan</label></div><div class="col-sm-9"><input type="text" name ="satuan" value = "'.$satuan.'" class="form-control"></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Klasifikasi Tahunan</label></div><div class="col-sm-9"><input type="text" name ="klasifikasi" value = "'.$id_tahunan.'" class="form-control" readonly></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Klasifikasi Bulanan</label></div><div class="col-sm-9"><input type="text" name ="klasifikasi_bulanan" value = "'.$a->id_bulanan.'" class="form-control" readonly></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jam Mulai</label></div><div class="col-sm-9">
<select name="jam_mulai">
	<option value="'.$a->jam_mulai.'">'.$a->jam_mulai.'</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	</select>
	<select name="menit_mulai">
	<option value="'.$a->menit_mulai.'">'.$a->menit_mulai.'</option>
	<option value="00">00</option>
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="10">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
	<option value="32">32</option>
	<option value="33">33</option>
	<option value="34">34</option>
	<option value="35">35</option>
	<option value="36">36</option>
	<option value="37">37</option>
	<option value="38">38</option>
	<option value="39">39</option>
	<option value="40">40</option>
	<option value="41">41</option>
	<option value="42">42</option>
	<option value="43">43</option>
	<option value="44">44</option>
	<option value="45">45</option>
	<option value="46">46</option>
	<option value="47">47</option>
	<option value="48">48</option>
	<option value="49">49</option>
	<option value="50">50</option>
	<option value="51">51</option>
	<option value="52">52</option>
	<option value="53">53</option>
	<option value="54">54</option>
	<option value="55">55</option>
	<option value="56">56</option>
	<option value="57">57</option>
	<option value="58">58</option>
	<option value="59">59</option>
	</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jam Selesai</label></div><div class="col-sm-9"><select name="jam_selesai">
	<option value="'.$a->jam_selesai.'">'.$a->jam_selesai.'</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	</select>
	<select name="menit_selesai">
	<option value="'.$a->menit_selesai.'">'.$a->menit_selesai.'</option>
	<option value="00">00</option>
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="10">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
	<option value="32">32</option>
	<option value="33">33</option>
	<option value="34">34</option>
	<option value="35">35</option>
	<option value="36">36</option>
	<option value="37">37</option>
	<option value="38">38</option>
	<option value="39">39</option>
	<option value="40">40</option>
	<option value="41">41</option>
	<option value="42">42</option>
	<option value="43">43</option>
	<option value="44">44</option>
	<option value="45">45</option>
	<option value="46">46</option>
	<option value="47">47</option>
	<option value="48">48</option>
	<option value="49">49</option>
	<option value="50">50</option>
	<option value="51">51</option>
	<option value="52">52</option>
	<option value="53">53</option>
	<option value="54">54</option>
	<option value="55">55</option>
	<option value="56">56</option>
	<option value="57">57</option>
	<option value="58">58</option>
	<option value="59">59</option>
	</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">File pendukung</label></div><div class="col-sm-9"><input type="file" name ="pendukung"></div></div>';
	echo '<input type="hidden" name ="id_pns" value="'.$id_pns.'">';
		echo '<p class="text-center"><input type="submit" value="Kirim ke Sieka" class="btn btn-primary"></p>';
echo '</form>';
	}
}
?>
</div></div></div>
