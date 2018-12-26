<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 15 Mei 2016 19:26:37 WIB 
// Nama Berkas 		: siswa_baru_pindahan.php
// Lokasi		: application/views/tatausaha/
// Author		: Selamet Hanafi
// 		 selamethanafi@yahoo.co.id
//
// (c) Copyright:
//MAN Tengaran
//www.mantengaran.sch.id
//admin@mantengaran.sch.id
//
// License:
// Copyright (C) 2014 MAN Tengaran
// Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#smpmts").mask("2-99-99-99-999-999-9")
	$("#nisn").mask("9999999999")
	$("#tanggallahirsiswa").mask("99-99-9999")
	$("#tanggallahirayah").mask("99-99-9999")
	$("#tanggallahiribu").mask("99-99-9999")
	$("#tanggallahirwali").mask("99-99-9999")
	$("#tanggalijazah").mask("99-99-9999")
	$("#tanggalditerima").mask("99-99-9999")
	$("#paketb").mask("B-99-99-99-99-999")
	$("#pontren").mask("C-99-99-99-999-999")
	$("#sttbpaketb").mask("9999999")
	$("#sttbmts").mask("MTs. 999999999")
	$("#sttbsmp").mask("DN-03 DI 9999999")
	});
</script>

<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php
echo form_open('tatausaha/updatedatasiswa','class="form-horizontal" role="form"');
?>
<h4>DATA PRIBADI SISWA</h4>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Induk Siswa</label></div><div class="col-sm-9" ><?php echo $nisterakhir;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIS Nasional</label></div><div class="col-sm-9" ><input type="text" name="nisn" value="" id="nisn" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Kartu Kependudukan</label></div><div class="col-sm-9" ><input type="text" name="nokk" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Induk Kependudukan (NIK)</label></div><div class="col-sm-9" ><input type="text" name="nik" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9" ><input type="text" name="nama" value=""  class="form-control" required></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9" ><input type="text" name="tmpt" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal lahir</label></div><div class="col-sm-9" ><input type="text" name="tgllhr" value="" id="tanggallahirsiswa" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9" ><select name="agama" class="form-control"><option value=""></option><option value="Islam">Islam</option><option value="Katolik">Katolik</option><option value="Kristen">Kristen</option><option value="Hindu">Hindu</option><option value="Budha">Budha</option></select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Kelamin</label></div><div class="col-sm-9" ><select name="jenkel" class="form-control"><option value=""></option><option value="Laki-laki">Laki-laki</option>	<option value="Perempuan">Perempuan</option></select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9" >	
	 	<?php
		echo '<select name="kdkls" class="form-control">';
		echo '<option value=""></option>';
		foreach($daftar_ruang->result() as $u)
		{
			echo '<option value="'.$u->ruang.'">'.$u->ruang.'</option>';
		}
		?>
		</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9" ><input type="text" name="wn" value=""  class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Anak Yatim-Piatu</label></div><div class="col-sm-9" >
	<select name="yatim" class="form-control">
	<option value=""></option><option value="Bukan diantaranya">Bukan diantaranya</option>
	<option value="Yatim">Yatim</option>
	<option value="Piatu">Piatu</option>
	<option value="Yatim Piatu">Yatim Piatu</option>
	</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Anak ke</label></div><div class="col-sm-9" ><input type="text" name="anakke" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Kandung</label></div><div class="col-sm-9" >	<input type="text" name="kandung" value="" class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Tiri</label></div><div class="col-sm-9" ><input type="text" name="tiri" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Angkat</label></div><div class="col-sm-9" ><input type="text" name="angkat" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Bahasa Sehari-hari</label></div><div class="col-sm-9" >
	<select name="bhs" class="form-control">
	<option value=""></option>
	<option value="Indonesia">Indonesia</option>
	<option value="Arab">Arab</option>
	<option value="Inggris">Inggris</option>
	<option value="Asing">Asing Lainnya</option>
	<option value="Jawa">Jawa</option>
	<option value="Daerah">Daerah Lain</option></select>
	</div></div>
<h4>TEMPAT TINGGAL</h4>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9" ></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jalan</label></div><div class="col-sm-9" ><input type="text" name="jalan" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">RT</label></div><div class="col-sm-9" ><input type="text" name="rt" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">RW</label></div><div class="col-sm-9" ><input type="text" name="rw" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Dusun</label></div><div class="col-sm-9" ><input type="text" name="dusun" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Desa</label></div><div class="col-sm-9" ><input type="text" name="desa" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kecamatan</label></div><div class="col-sm-9" ><input type="text" name="kec" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kabupaten</label></div><div class="col-sm-9" ><input type="text" name="kab" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Provinsi</label></div><div class="col-sm-9" ><input type="text" name="prov" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jarak ke sekolah</label></div><div class="col-sm-9" ><select name="jarak" class="form-control">
		<option value=""></option>
		<?php
		foreach($tdaftar_jarak->result() as $daftar_jarak)
		{
			echo '<option value="'.$daftar_jarak->jarak.'">'.$daftar_jarak->jarak.'</option>';
		}
		
		?>	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Tempat Tinggal</label></div><div class="col-sm-9" >	<select name="jenrumah" class="form-control">	<option value=""></option>	<option value="Pribadi">Pribadi</option>	<option value="Kontrak">Kontrak</option>	<option value="Kost">Kost</option>	<option value="Asrama">Asrama</option>	<option value="tidak diketahui">tidak diketahui</option>	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tinggal dengan</label></div><div class="col-sm-9" ><input type="text" name="tinggal" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Transportasi</label></div><div class="col-sm-9" ><select name="transportasi" class="form-control"><option value=""></option><option value="Kendaraan Umum">Kendaraan Umum</option>	<option value="Kendaraan Sendiri">Kendaraan sendiri</option>	<option value="Berjalan Kaki">Berjalan kaki</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Telepon Rumah</label></div><div class="col-sm-9" ><input type="text" name="telepon" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">HP</label></div><div class="col-sm-9" ><input type="text" name="hp" value="" class="form-control"></div></div>
<h4>KESEHATAN</h4>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Berat Badan</label></div><div class="col-sm-9" >
	<input type="text" name="bb" value="" class="form-control"> kg
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tinggi Badan</label></div><div class="col-sm-9" > 
	<input type="text" name="tb" value="" class="form-control"> cm
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Golongan Darah</label></div><div class="col-sm-9" >	<select name="goldarah" class="form-control">	<option value=""></option>	<option value="O">O</option>	<option value="A">A</option>	<option value="B">B</option>	<option value="AB">AB</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Sakit yang pernah diderita</label></div><div class="col-sm-9" >
	<input type="text" name="sakit" value="" class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kebutuhan Khusus</label></div><div class="col-sm-9" > 
	<input type="text" name="jasmani" value=""  class="form-control">
	</div></div>
<h4>SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?></h4>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">SLTP / Paket B</label></div><div class="col-sm-9" > 
	<input type="text" name="sltp" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">No STTB / Ijazah SLTP / Paket B</label></div><div class="col-sm-9" >	
			<input type="text" name="nosttb" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Peserta UN SLTP</label></div><div class="col-sm-9" >
			<input type="text" name="skhun" value="" class="form-control">
		
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Lama Belajar di SLTP</label></div><div class="col-sm-9" >
	<input type="text" name="lama" value="" class="form-control"> Tahun
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal STTB</label></div><div class="col-sm-9" >
		<input type="text" name="tglsttb" value="" id="tanggalijazah" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pindahan dari</label></div><div class="col-sm-9" >
	<input type="text" name="pinsek" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alasan pindah</label></div><div class="col-sm-9" >
	<input type="text" name="alasan" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Diterima di kelas</label></div><div class="col-sm-9" >
	 	<?php
		echo '<select name="kls"  class="form-control">';
		echo '<option value=""></option>';
		foreach($daftar_ruang->result() as $u)
		{
			echo '<option value="'.$u->ruang.'">'.$u->ruang.'</option>';
		}
		?>
		</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal diterima</label></div><div class="col-sm-9" ><input type="text" name="tanggalditerima" value="" id="tanggalditerima" class="form-control"></div></div>
<h4>DATA AYAH SISWA</h4>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9" >
	<input type="text" name="nmayah"  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9" >
	<input type="text" name="alayah" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9" >
	<input type="text" name="tmpayah"  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9" ><input type="text" name="tanggallahirayah" value="" id="tanggallahirayah" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9" >	<select name="agayah" class="form-control">	<option value=""></option>	<option value="Islam">Islam</option>	<option value="Katolik">Katolik</option>	<option value="Kristen">Kristen</option>	<option value="Hindu">Hindu</option>	<option value="Budha">Budha</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9" >
	<select name="wnayah" class="form-control">	<option value=""></option>	<option value="Indonesia">Indonesia</option>	<option value="Asing">Asing</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9" ><input type="text" name="tayah" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9" >
	<select name="payah" class="form-control">
		<option value=""></option>
		<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan");
		foreach($tm_pekerjaan->result() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan->nama_pekerjaan;
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}
		?>	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9" >Rp 
		<select name="dayah" class="form-control">
		<option value=""></option>
		<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit");
		foreach($tm_pekerjaan->result() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan->besar;
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}
		?>
		</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9" >	<select name="sekayah" class="form-control">	<option value=""></option>
		<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['jenjang'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}
		?>	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Masih hidup</label></div><div class="col-sm-9" >	<select name="hdpayah" class="form-control">	<option value=""></option>	<option value="Ya">Ya</option>	<option value="Tidak">Tidak</option>	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jika sudah meninggal, meninggal tahun</label></div><div class="col-sm-9" >	<input type="text" name="thnayah" value="" class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><h3>DATA IBU SISWA</h3></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9" >
	<input type="text" name="nmibu"  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9" >	<input type="text" name="alibu" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9" >
	<input type="text" name="tmpibu"  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9" ><input type="text" name="tanggallahiribu" value="" id="tanggallahiribu" class="form-control"></div></div>
 <div class="form-group row row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9" >	<select name="agibu" class="form-control">	<option value=""></option>	<option value="Islam">Islam</option>	<option value="Katolik">Katolik</option>	<option value="Kristen">Kristen</option>	<option value="Hindu">Hindu</option>	<option value="Budha">Budha</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9" >	<select name="wnibu" class="form-control">	<option value=""></option>	<option value="Indonesia">Indonesia</option>	<option value="Asing">Asing</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9" ><input type="text" name="tibu" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9" >	<select name="pibu" class="form-control">	<option value=""></option>
		<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['nama_pekerjaan'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}
		?>	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9" >Rp 
	<select name="dibu" class="form-control">
		<option value=""></option>
	<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['besar'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}

		?>
		</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9" >	<select name="sekibu" class="form-control">	<option value=""></option>
	<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['jenjang'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}

		?></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Masih hidup</label></div><div class="col-sm-9" >	<select name="hdpibu" class="form-control">	<option value=""></option>	<option value="Ya">Ya</option>	<option value="Tidak">Tidak</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jika sudah meninggal, meninggal tahun</label></div><div class="col-sm-9" >
	<input type="text" name="thnibu" value="" class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penghasilan Ayah + penghasilan Ibu </label></div><div class="col-sm-9" >Rp 
		<select name="dortu" class="form-control">
		<option value=""></option>
	<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan);
			{
			$peker=$dm_pekerjaan['besar'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}

		?>
		</select>
	</div></div>
<h4>DATA WALI SISWA</h4>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9" >
	<input type="text" name="nmwali"  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9" >
	<input type="text" name="awali" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9" >
	<input type="text" name="tmpwali"  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9" ><input type="text" name="tanggallahirwali" value="" id="tanggallahirwali" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9" >	<select name="agwali" class="form-control">	<option value=""></option>	<option value="Islam">Islam</option>	<option value="Katolik">Katolik</option>	<option value="Kristen">Kristen</option>	<option value="Hindu">Hindu</option>	<option value="Budha">Budha</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9" >	<select name="wnwali" class="form-control">	<option value=""></option>	<option value="Indonesia">Indonesia</option>	<option value="Asing">Asing</option></select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9" ><input type="text" name="twali" value=""  class="form-control">
	</div></div>

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9" >	<select name="pwali" class="form-control">	<option value=""></option>
		<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['nama_pekerjaan'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}

		?>	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9" >Rp 
		<select name="dwali" class="form-control">
		<option value=""></option>
	<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['besar'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}

		?>
		</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9" >	<select name="sekwali" class="form-control">	<option value=""></option>
		<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['jenjang'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}

		?></select>
	</div></div>
<h4>KEGEMARAN SISWA</h4>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cita - Cita</label></div><div class="col-sm-9" >	<select name="cita" class="form-control">
		<option value=""></option>
		<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_cita");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['nama_cita'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}

		?>	</select>
	</div></div> 	 <div class="form-group row row"><div class="col-sm-3"><label class="control-label">Hobi Utama</label></div><div class="col-sm-9" >	<select name="hobi" class="form-control">
		<option value=""></option>
		<?php
		$tm_pekerjaan = $this->db->query("SELECT * FROM m_hobi");
		foreach($tm_pekerjaan->result_array() as $dm_pekerjaan)
			{
			$peker=$dm_pekerjaan['nama'];
			echo '<option value="'.$peker.'">'.$peker.'</option>';
			}

		?>	</select>
	</div></div> 
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kesenian</label></div><div class="col-sm-9" > 
	<input type="text" name="kesenian" value=""  class="form-control">
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Olahraga</label></div><div class="col-sm-9" > 
	<input type="text" name="olahraga" value=""  class="form-control">
	</div></div>	 <div class="form-group row row"><div class="col-sm-3"><label class="control-label">Organisasi</label></div><div class="col-sm-9" >
	<input type="text" name="organisasi" value=""  class="form-control">
	</div></div>

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Lain - lain</label></div><div class="col-sm-9" >
	<input type="text" name="lain" value=""  class="form-control">
	</div></div>
<tr>
</table></div>
		<input type="hidden" name="nis" value="<?php echo $nisterakhir;?>">
		<input type="hidden" name="ket" value="Y">
		<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN DATA SISWA</button>
		<a href="<?php echo base_url(); ?>" class="btn btn-info" role="button">BATAL</a></p>
</form>
</div>

