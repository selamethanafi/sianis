<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: edit_data_tindak_lanjut.php
// Terakhir diperbarui	: Kam 31 Des 2015 12:36:05 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>" class="btn btn-primary"><b>Kembali Ke Daftar Nilai</b></a></p>
<?php
//echo $itemnilai;echo '';
foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester= $dtmapel->semester;
			}
//echo 'mapel '.$mapel.' thn '.$thnajaran.' semester '.$semester.' kelas '.$kelas.'';
if ((empty($mapel)) or (empty($thnajaran)) or (empty($semester)) or (empty($kelas)))
{

	echo '<div class="alert alert-warning"><strong>KKM mata pelajaran dimaksud tidak ada, sama dengan 0, tidak boleh disunting, atau Anda tidak mengampu mata pelajaran ini.</strong></div>.';
}

else
{
$ta = $this->db->query("select * from `guru_tindak_lanjut` where `id_guru_tindak_lanjut`='$id_mapel' and ulangan='$itemnilai'");
	if(count($ta->result())==0)
	{
		$this->db->query("INSERT INTO `guru_tindak_lanjut` (`id_guru_tindak_lanjut`, `thnajaran`, `semester`, `kelas`, `mapel`, `kodeguru`,`ulangan`) VALUES ('$id_mapel', '$thnajaran', '$semester', '$kelas', '$mapel', '$kodeguru','$itemnilai')");
	}
	$ta = $this->db->query("select * from `guru_tindak_lanjut` where `id_guru_tindak_lanjut`='$id_mapel' and ulangan='$itemnilai'");
	foreach($ta->result() as $a)
	{
	$tanggalrp = $a->tanggal;
	$tindakan_pengayaan = $a->tindakan_pengayaan;
	$tindakan_satu = $a->tindakan_satu;
	$tindakan_dua = $a->tindakan_dua;
	$jam_mulai = $a->jam_mulai;
	$menit_mulai = $a->menit_mulai;
	$jam_selesai = $a->jam_selesai;
	$menit_selesai = $a->menit_selesai;

	}
	if (empty($tindakan_satu))
	{
	$tindakan_satu = 'Remidi PB/SPB dengan mendapat pembinaan khusus dari guru (pengulangan materi)';
	}
	if (empty($tindakan_dua))
	{
	$tindakan_dua = '<ol style="list-style-type: lower-alpha;">
<li>Pekerjaan rumah membuat ikhtisar / rangkuman materi</li>
<li>mengerjakan soal ulangan yang belum dijawab dengan benar</li>
<li>...................</li>
</ol>';	
	}
	if (empty($tindakan_pengayaan))
	{
	$tindakan_pengayaan = '<ol>
<li>Mempelajari buku .........................<ol style="list-style-type: lower-alpha;">
<li>Membuat rangkuman</li>
<li>Mengerjakan soal halaman </li>
</ol></li>
<li>Mengerjakan soal khusus yang diberikan guru mapel</li>
<li>...........................</li>
</ol>';
	}

echo form_open('guru/tindaklanjut','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-6"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-6"><p class="form-control"><strong><?php echo $thnajaran?></strong></p></div></div>
<div class="form-group row"><div class="col-sm-6"><label class="control-label">Semester</label></div><div class="col-sm-6"><p class="form-control"><strong><?php echo $semester?></strong></p></div></div>
<div class="form-group row">
<div class="col-sm-6"><label class="control-label">Kelas</label></div><div class="col-sm-6"><p class="form-control"><strong><?php echo $kelas;?></strong></p></div></div>
<div class="form-group row">
<div class="col-sm-6"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-6"><p class="form-control"><strong><?php echo $mapel;?></strong></div></div>
<?php
echo '<div class="form-group row"><div class="col-sm-6"><label class="control-label">Tanggal Pelaksanaan Remidial / Pengayaan</label></div><div class="col-sm-6">';
				if($tanggalrp == '0000-00-00')
				{
					$tanggalrp = tanggal_hari_ini();
				}
				$tglhariini = tanggal($tanggalrp);
				?>
				<input id="datepicker" format="dd-mm-yyyy" name="tanggal" value="<?php echo $tglhariini;?>"  width="276" />
				<script>
				        $('#datepicker').datepicker({ format: 'dd-mm-yyyy',
					            uiLibrary: 'bootstrap4'
				        });
				</script>
				<?php
				echo '</div></div>';
	echo '<div class="form-group row"><div class="col-sm-6"><label class="control-label">Waktu mulai</label></div><div class="col-sm-6"><select name="jam_mulai">
	<option value="'.$jam_mulai.'">'.$jam_mulai.'</option>
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
	<div class="form-group row"><div class="col-sm-6"><label class="control-label">Waktu selesai</label></div><div class="col-sm-6"><select name="jam_selesai">
	<option value="'.$jam_selesai.'">'.$jam_selesai.'</option>
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
</div></div>
<div class="form-group row">
<div class="col-sm-12"><label class="control-label">Tindak lanjut bila nilai siswa kurang dari 50</strong></div></div>
<div class="form-group row">
<div class="col-sm-12"><textarea name="tindakan_satu" rows="5" class="form-control">'.$tindakan_satu.'</textarea></div></div>
<div class="form-group row">
<div class="col-sm-12"><label class="control-label">Tindak lanjut bila nilai siswa lebih atau sama 50 dan kurang dari KKM</strong></div>
<div class="col-sm-12"><textarea name="tindakan_dua" rows="5" class="form-control">'.$tindakan_dua.'</textarea></div></div>
<div class="form-group row">
<div class="col-sm-12"><label class="control-label">Tindak lanjut bila nilai siswa lebih atau sama dengan KKM</strong></div></div>
<div class="form-group row">
<div class="col-sm-12"><textarea name="tindakan_pengayaan" rows="5" class="form-control">'.$tindakan_pengayaan.'</textarea></div></div>';
?>
<p class="text-center"><input type="hidden" name="id_guru_tindak_lanjut" value="<?php echo $id_mapel;?>"><input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>"><input type="hidden" name="semester" value="<?php echo $semester;?>"><input type="hidden" name="mapel" value="<?php echo $mapel;?>"><input type="hidden" name="kelas" value="<?php echo $kelas;?>"><input type="hidden" name="post_aksi" value="ubah_data"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
<?php
}//akhir berhak
?>

</div></div></div>
