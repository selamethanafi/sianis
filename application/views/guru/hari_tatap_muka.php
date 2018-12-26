<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : hari_tatap_muka.php
// Lokasi      : application/views/guru
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
if ($is_new=='yes')
{
	$mapel = id_mapel_jadi_mapel($id_mapel);
	$kelas = id_mapel_jadi_kelas($id_mapel);
	$this->db->query("INSERT INTO `tharitatapmuka` (`id_mapel`, `hari_tatap_muka`,`jam_ke`,`kodeguru`,`jtm`, `jam_mulai`, `menit_mulai`, `jam_selesai`, `menit_selesai`, `thnajaran`, `semester`, `rencana_hari_tatap_muka`, `rencana_jam_mulai`, `rencana_menit_mulai`, `rencana_jam_selesai`, `rencana_menit_selesai`) VALUES ('$id_mapel', '$hari_tatap_muka','$jam_ke','$kodeguru','$jtm', '$jam_mulai', '$menit_mulai', '$jam_selesai', '$menit_selesai', '$thnajaran', '$semester', '$rencana_hari_tatap_muka', '$rencana_jam_mulai', '$rencana_menit_mulai', '$rencana_jam_selesai', '$rencana_menit_selesai')");
}
if ($is_new=='no')
{
	$this->db->query("update `tharitatapmuka` set `hari_tatap_muka`='$hari_tatap_muka',`jam_ke`='$jam_ke', `jtm`='$jtm',`id_mapel`='$id_mapel', `jam_mulai` = '$jam_mulai', `menit_mulai`='$menit_mulai', `jam_selesai`='$jam_selesai', `menit_selesai`='$menit_selesai', `rencana_hari_tatap_muka`='$rencana_hari_tatap_muka', `rencana_jam_mulai` = '$rencana_jam_mulai', `rencana_menit_mulai`='$rencana_menit_mulai', `rencana_jam_selesai`='$rencana_jam_selesai', `rencana_menit_selesai`='$rencana_menit_selesai', `thnajaran`='$thnajaran', `semester`='$semester' where id_hari_tatap_muka='$id_hari' and kodeguru='$kodeguru'");
}
if ($aksi=='hapus')
{
	$this->db->query("delete from `tharitatapmuka` where `id_hari_tatap_muka`='$id_hari_tatap_muka' and kodeguru='$kodeguru'");
	$aksi = '';	
}
if($aksi=='tambah')
{
	echo form_open('guru/haritatapmuka','class="form-horizontal" role="form"');
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">'.$thnajaran.'</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">'.$semester.'</p></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div><div class="col-sm-9">';
	$tb = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");
		echo '<select name="id_mapel" class="form-control" required>';
	foreach ($tb->result() as $b)
	{
		echo '<option value="'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
	}
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Hari Tatap Muka</label></div><div class="col-sm-9"><select name="hari_tatap_muka" class="form-control" required>
	<option value=""></option>
	<option value="Monday">Senin</option>
	<option value="Tuesday">Selasa</option>
	<option value="Wednesday">Rabu</option>
	<option value="Thursday">Kamis</option>
	<option value="Friday">Jumat</option>
	<option value="Saturday">Sabtu</option>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Jam</label></div><div class="col-sm-9"><select name="jtm" class="form-control" required>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jam ke -</label></div><div class="col-sm-9"><input type="text" name="jam_ke" class="form-control" required></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu mulai</label></div><div class="col-sm-9"><select name="jam_mulai">
	<option value=""></option>
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
	</select>
	<select name="menit_mulai">
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
	</select>
</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu Selesai</label></div><div class="col-sm-9"><select name="jam_selesai" required>
	<option value=""></option>
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
	</select>
	<select name="menit_selesai" required>
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
	</select>
</div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Hari Perencanaan</label></div><div class="col-sm-9"><select name="rencana_hari_tatap_muka" class="form-control" required>
	<option value=""></option>
	<option value="Monday">Senin</option>
	<option value="Tuesday">Selasa</option>
	<option value="Wednesday">Rabu</option>
	<option value="Thursday">Kamis</option>
	<option value="Friday">Jumat</option>
	<option value="Saturday">Sabtu</option>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu mulai perencanaan</label></div><div class="col-sm-9"><select name="rencana_jam_mulai" required>
	<option value=""></option>
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
	</select>
	<select name="rencana_menit_mulai" required>
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
	</select>
</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu selesai perencanaan</label></div><div class="col-sm-9"><select name="rencana_jam_selesai" required>
	<option value=""></option>
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
	</select>
	<select name="rencana_menit_selesai" required>
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
	</select>
</div></div>
';
	echo '<p class="text-center"><input type="submit" value="Tambah Hari" class="btn btn-primary"><input type="hidden" name="is_new" value="yes">
	<a href="'.base_url().'guru/haritatapmuka/" class="btn btn-info"><b> Batal</b></a></p></form>';
	}//akhir tambah
elseif($aksi=='ubah')
	{
	echo form_open('guru/haritatapmuka','class="form-horizontal" role="form"');
	$tc = $this->db->query("select * from `tharitatapmuka` where `id_hari_tatap_muka`='$id_hari_tatap_muka'");
	foreach($tc->result() as $c)
		{
		$harine = day_to_hari($c->hari_tatap_muka);
		$id_mapel = $c->id_mapel;
		$mapel = id_mapel_jadi_mapel($id_mapel);
		$kelas = id_mapel_jadi_kelas($id_mapel);
		$jam_ke = $c->jam_ke;
		$jtm = $c->jtm;
		$jam_mulai = $c->jam_mulai;
		$menit_mulai = $c->menit_mulai;
		$jam_selesai = $c->jam_selesai;
		$menit_selesai = $c->menit_selesai;
		$harine_rencana = day_to_hari($c->rencana_hari_tatap_muka);
		$rencana_jam_mulai = $c->rencana_jam_mulai;
		$rencana_menit_mulai = $c->rencana_menit_mulai;
		$rencana_jam_selesai = $c->rencana_jam_selesai;
		$rencana_menit_selesai = $c->rencana_menit_selesai;
		}

	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">'.$thnajaran.'</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">'.$semester.'</div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div><div class="col-sm-9">';
	$td = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and kelas = '$kelas' and mapel='$mapel'");
	foreach($td->result() as $d)
		{
		$id_mapele = $d->id_mapel;
		}
	
		echo '<select name="id_mapel" class="form-control" required>';
	echo '<option value="'.$id_mapele.'">'.$mapel.' '.$kelas.'</option>';
	$tb = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");
	foreach ($tb->result() as $b)
	{
		echo '<option value="'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
	}
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Hari Tatap Muka</label></div><div class="col-sm-9"><select name="hari_tatap_muka" class="form-control" required>
	<option value="'.$c->hari_tatap_muka.'">'.$harine.'</option>
	<option value="Monday">Senin</option>
	<option value="Tuesday">Selasa</option>
	<option value="Wednesday">Rabu</option>
	<option value="Thursday">Kamis</option>
	<option value="Friday">Jumat</option>
	<option value="Saturday">Sabtu</option>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Jam</label></div><div class="col-sm-9"><select name="jtm" class="form-control" required>
	<option value="'.$jtm.'">'.$jtm.'</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	</select></div></div>

	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jam ke -</label></div><div class="col-sm-9"><input type="text" name="jam_ke" value="'.$jam_ke.'" class="form-control" required><input type="hidden" name="id_hari" value="'.$id_hari_tatap_muka.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu mulai</label></div><div class="col-sm-9"><select name="jam_mulai" required>
	<option value="'.$jam_mulai.'">'.$jam_mulai.'</option>
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
	</select>
	<select name="menit_mulai" required>
	<option value="'.$menit_mulai.'">'.$menit_mulai.'</option>
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
	</select>
</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu Selesai</label></div><div class="col-sm-9"><select name="jam_selesai" required>
	<option value="'.$jam_selesai.'">'.$jam_selesai.'</option>
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
	</select>
	<select name="menit_selesai" required>
	<option value="'.$menit_selesai.'">'.$menit_selesai.'</option>
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
	</select>
</div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Hari Perencanaan</label></div><div class="col-sm-9"><select name="rencana_hari_tatap_muka" class="form-control" required>
	<option value="'.$c->rencana_hari_tatap_muka.'">'.$harine_rencana.'</option>
	<option value="Monday">Senin</option>
	<option value="Tuesday">Selasa</option>
	<option value="Wednesday">Rabu</option>
	<option value="Thursday">Kamis</option>
	<option value="Friday">Jumat</option>
	<option value="Saturday">Sabtu</option>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu mulai perencanaan</label></div><div class="col-sm-9"><select name="rencana_jam_mulai" required>
	<option value="'.$rencana_jam_mulai.'">'.$rencana_jam_mulai.'</option>
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
	</select>
	<select name="rencana_menit_mulai" required>
	<option value="'.$rencana_menit_mulai.'">'.$rencana_menit_mulai.'</option>
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
	</select>
</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu selesai perencanaan</label></div><div class="col-sm-9"><select name="rencana_jam_selesai" required>
	<option value="'.$rencana_jam_selesai.'">'.$rencana_jam_selesai.'</option>
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
	</select>
	<select name="rencana_menit_selesai" required>
	<option value="'.$rencana_menit_selesai.'">'.$rencana_menit_selesai.'</option>
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
	</select>
</div></div>
';
	echo '<p class="text-center"><input type="submit" value="Ubah Data" class="btn btn-primary"><input type="hidden" name="is_new" value="no"><input type="hidden" name="id_hari_tatap_muka" value="'.$id_hari_tatap_muka.'">
	<a href="'.base_url().'guru/haritatapmuka" class="btn btn-info"><b> Batal</b></a></p></form>';
	}//akhir ubah
else
{
	echo '<p><a href="'.base_url().'guru/haritatapmuka/tambah" class="btn btn-info"><b>Tambah Hari Tatap Muka</b></a></p>';
echo '<form class="form-horizontal" role="form"><div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9"><p class="form-control-static">'.$thnajaran.'</p></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Semester</label></div>
			<div class="col-sm-9"><p class="form-control-static">'.$semester.'</p></div>
		</div>';
	echo '</form>';
$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and semester='$semester' and `kodeguru`='$kodeguru' order by kelas");
$adata  = $ta->num_rows();
if(count($ta->result())>0)
{
	?>
	<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr><td align="center"><strong>No</strong></td><td align="center"><strong>Kelas</strong></td><td align="center"><strong>Mata Pelajaran</strong></td><td align="center"><strong>Hari</strong></td><td align="center"><strong>Jam Ke-</strong></td><td align="center"><strong>JTM</strong></td><td align="center"><strong>Mulai</strong></td><td align="center"><strong>Selesai</strong></td><td align="center" colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($ta->result() as $a)
	{
	$id_mapel = $a->id_mapel;
	$tb = $this->db->query("select * from `tharitatapmuka` where `id_mapel`='$id_mapel'");
	foreach($tb->result() as $b)
		{
		$harine = day_to_hari($b->hari_tatap_muka);
		$rencana_harine = day_to_hari($b->rencana_hari_tatap_muka);
	echo '<tr align="center"><td>'.$nomor.'</td><td>'.$a->kelas.'</td><td>'.$a->mapel.'</td>';

	echo "<td>".$harine."<p class=\"text-info\">".$rencana_harine."</p></td><td>".$b->jam_ke."</td><td>".$b->jtm."</td><td>".$b->jam_mulai.":".$b->menit_mulai."<p class=\"text-info\">".$b->rencana_jam_mulai.":".$b->rencana_menit_mulai."</p></td><td>".$b->jam_selesai.":".$b->menit_selesai."<p class=\"text-info\">".$b->rencana_jam_selesai.":".$b->rencana_menit_selesai."</p></td><td align=\"center\"><a href='".base_url()."guru/haritatapmuka/ubah/".$b->id_hari_tatap_muka."' title='Edit'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."guru/haritatapmuka/hapus/".$b->id_hari_tatap_muka."' onClick=\"return confirm('Anda yakin ingin menghapus hari ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
	$nomor++;
		}

	}
echo '</table></div>';
}
else
{
echo 'Belum ada data';
}
}
?>
</div></div></div>
