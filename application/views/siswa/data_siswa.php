<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: data_siswa.php
// Lokasi      		: application/views/siswa/
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
<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#smpmts").mask("2-99-99-99-999-999-9")
	$("#nisn").mask("9999999999")
	$("#tanggallahir").mask("99-99-9999")
	$("#tanggallahirayah").mask("99-99-9999")
	$("#tanggallahiribu").mask("99-99-9999")
	$("#tanggallahirbapak").mask("99-99-9999")
	$("#tanggalijazah").mask("99-99-9999")
	$("#tanggalditerima").mask("99-99-9999")
	$("#paketb").mask("B-99-99-99-99-999")
	$("#pontren").mask("C-99-99-99-999-999")
	$("#sttbpaketb").mask("9999999")
	$("#sttbmts").mask("MTs. 999999999")
	$("#sttbsmp").mask("DN-03 DI 9999999")
	});
</script>

<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
echo form_open('siswa/updatedata','class="form-horizontal" role="form"');
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		if (!empty($t->foto))
			{
			$fotone = ''.base_url().$this->config->item('folderfotosiswa').'/'.$t->foto.'';
			echo '<p class="text-center"><img src="'.$fotone.'" width="150" height="200" class="img-rounded"></p>';
			}
		if ($sunting=="ubah")
		{
		?>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Induk Siswa</label></div><div class="col-sm-9"><p class="form-control-static"><strong><?php echo $t->nis;?></strong></p></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIS Nasional</label></div><div class="col-sm-9"><p class="form-control-static"><input type="text" name="nisn" value="<?php echo $t->nisn;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Induk Kependudukan (NIK) Kepala Keluarga</label></div><div class="col-sm-9"><p class="form-control-static"><input type="text" name="nik_kk" value="<?php echo $t->nik_kk;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Induk Kependudukan (NIK) Siswa</label></div><div class="col-sm-9"><p class="form-control-static"><input type="text" name="nik" value="<?php echo $t->nik;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor KK</label></div><div class="col-sm-9"><p class="form-control-static"><input type="text" name="nokk" value="<?php echo $t->nokk;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><p class="form-control-static"><strong><?php echo $t->nama;?></strong></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><p class="form-control-static"><strong><?php echo $t->tmpt;?></strong></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal lahir</label></div><div class="col-sm-9"><p class="form-control-static"><strong>
				<?php
				$str = $t->tgllhr;	
				echo date_to_long_string($str);
				?>
				</strong></p></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9">
				<select name="agama" class="form-control">
				<option value="<?php echo $t->agama;?>"><?php echo $t->agama;?></option>
				<option value="Islam">Islam</option>
				<option value="Katolik">Katolik</option>
				<option value="Kristen">Kristen</option>
				<option value="Hindu">Hindu</option>
				<option value="Budha">Budha</option></select>
			</div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Kelamin</label></div><div class="col-sm-9">
				<select name="jenkel" class="form-control">
				<option value="<?php echo $t->jenkel;?>"><?php echo $t->jenkel;?></option>
				<option value="Laki-laki">Laki-laki</option>
				<option value="Perempuan">Perempuan</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9"><input type="text" name="wn" value="<?php echo $t->wn;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Anak Yatim-Piatu</label></div><div class="col-sm-9">
				<select name="yatim" class="form-control">
					<option value="<?php echo $t->yatim;?>"><?php echo $t->yatim;?></option>
					<option value="Bukan diantaranya">Bukan diantaranya</option>
					<option value="Yatim">Yatim</option>
					<option value="Piatu">Piatu</option>
					<option value="Yatim Piatu">Yatim Piatu</option>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Anak ke</label></div><div class="col-sm-9"><input type="text" name="anakke" value="<?php echo $t->anakke;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Kandung</label></div><div class="col-sm-9"><input type="text" name="kandung" value="<?php echo $t->kandung;?>"class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Tiri</label></div><div class="col-sm-9"><input type="text" name="tiri"value="<?php echo $t->tiri;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jumlah Saudara Angkat</label></div><div class="col-sm-9"><input type="text" name="angkat"value="<?php echo $t->angkat;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bahasa Sehari-hari</label></div><div class="col-sm-9">
				<select name="bhs" class="form-control">
				<option value="<?php echo $t->bhs;?>"><?php echo $t->bhs;?></option>
				<option value="Indonesia">Indonesia</option>
				<option value="Arab">Arab</option>
				<option value="Inggris">Inggris</option>
				<option value="Asing">Asing Lainnya</option>
				<option value="Jawa">Jawa</option>
				<option value="Daerah">Daerah Lain</option></select></div></div>
			<h4>KETERANGAN TEMPAT TINGGAL</h4>
			<h4>Alamat</h4>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jalan</label></div><div class="col-sm-9"><input type="text" name="jalan" value="<?php echo $t->jalan;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">RT </label></div><div class="col-sm-9"><input type="text" name="rt" value="<?php echo $t->rt;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">RW </label></div><div class="col-sm-9"><input type="text" name="rw" value="<?php echo $t->rw;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Dusun </label></div><div class="col-sm-9"> <input type="text" name="dusun" value="<?php echo $t->dusun;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Desa </label></div><div class="col-sm-9"><input type="text" name="desa" value="<?php echo $t->desa;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kecamatan </label></div><div class="col-sm-9"><input type="text" name="kec" value="<?php echo $t->kec;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kabupaten </label></div><div class="col-sm-9"><input type="text" name="kab" value="<?php echo $t->kab;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Provinsi </label></div><div class="col-sm-9"><input type="text" name="prov" value="<?php echo $t->prov;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jarak ke sekolah</label></div><div class="col-sm-9">
				<select name="jarak" class="form-control">
					<option value="<?php echo $t->jarak;?>"><?php echo $t->jarak;?></option>
					<?php
					foreach($tdaftar_jarak->result() as $daftar_jarak)
					{
						echo '<option value="'.$daftar_jarak->jarak.'">'.$daftar_jarak->jarak.'</option>';
					}
					?>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Tempat Tinggal</label></div><div class="col-sm-9">
				<select name="jenrumah" class="form-control">
				<option value="<?php echo $t->jenrumah;?>"><?php echo $t->jenrumah;?></option>
				<option value="Pribadi">Pribadi</option>
				<option value="Kontrak">Kontrak</option>
				<option value="Kost">Kost</option>
				<option value="Asrama">Asrama</option>
				<option value="tidak diketahui">tidak diketahui</option>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Dinding Rumah</label></div><div class="col-sm-9">
				<input name="dinding" class="form-control" placeholder="tembok, batu bata, kalsiboard, kayu, cor, bambu, dsb." value="<?php echo $t->dinding;?>">
			</div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Lantai Rumah</label></div><div class="col-sm-9">
				<input name="lantai" class="form-control" placeholder="plester, bata, kayu, keramik, tanah, dsb." value="<?php echo $t->lantai;?>">
			</div></div>

			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tinggal dengan</label></div><div class="col-sm-9"><input type="text" name="tinggal" value="<?php echo $t->tinggal;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Transportasi</label></div><div class="col-sm-9">
				<select name="transportasi" class="form-control">
				<option value="<?php echo $t->transportasi;?>"><?php echo $t->transportasi;?></option>
				<option value="Kendaraan Umum">Kendaraan Umum</option>
				<option value="Kendaraan Sendiri">Kendaraan sendiri</option>
				<option value="Berjalan Kaki">Berjalan kaki</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Telepon Rumah</label></div><div class="col-sm-9"><input type="text" name="telepon" value="<?php echo $t->telepon;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">HP</label></div><div class="col-sm-9"><input type="text" name="hp" value="<?php echo $t->hp;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Sepeda Motor</label></div>
					<div class="col-sm-9"><input type="text" name="cacah_spm" value="<?php echo $t->cacah_spm;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Mobil</label></div>
					<div class="col-sm-9"><input type="text" name="cacah_mobil" value="<?php echo $t->cacah_mobil;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ternak</label></div>
					<div class="col-sm-9"><input type="text" name="ternak" value="<?php echo $t->ternak;?>" placeholder="sapi, kambing, ayam, dsb" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Barang elektronik</label></div>
					<div class="col-sm-9"><input type="text" name="elektronik" value="<?php echo $t->elektronik;?>" placeholder="TV, HP, Kulkas, dsb" class="form-control"></div></div>
			<h4>KESEHATAN</h4>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berat Badan</label></div><div class="col-sm-9"><input type="text" name="bb" value="<?php echo $t->bb;?>" class="form-control"> kg</div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tinggi Badan</label></div><div class="col-sm-9"><input type="text" name="tb" value="<?php echo $t->tb;?>" class="form-control"> cm</div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Golongan Darah</label></div><div class="col-sm-9">
				<select name="goldarah" class="form-control">
				<option value="<?php echo $t->goldarah;?>"><?php echo $t->goldarah;?></option>
				<option value="O">O</option>
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="AB">AB</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Sakit yang pernah diderita</label></div><div class="col-sm-9"><input type="text" name="sakit" value="<?php echo $t->sakit;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kebutuhan Khusus</label></div><div class="col-sm-9"><input type="text" name="jasmani" value="<?php echo $t->jasmani;?>" class="form-control"></div></div>
			<h4>SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?></h4>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">SLTP / Paket B</label></div><div class="col-sm-9"><p class="form-control-static"> <?php echo $t->sltp;?></p></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">No STTB / Ijazah SLTP / Paket B</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->nosttb;?></p></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Peserta UN SLTP</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->skhun;?></p></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Lama Belajar di SLTP</label></div><div class="col-sm-9"><input type="text" name="lama" value="<?php echo $t->lama;?>" class="form-control""> Tahun</div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal STTB</label></div><div class="col-sm-9"><p class="form-control-static">
				<?php echo tanggal($t->tglsttb);?></p></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pindahan dari</label></div><div class="col-sm-9"><input type="text" name="pinsek" value="<?php echo $t->pinsek;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alasan pindah</label></div><div class="col-sm-9"><input type="text" name="alasan" value="<?php echo $t->alasan;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Diterima di kelas</label></div><div class="col-sm-9">
				<?php
				echo '<select name="kls" class="form-control">';
				$kelas = $t->kls;
				echo '<option value="'.$t->kls.'">'.$t->kls.'</option>';
				foreach($daftar_ruang->result() as $u)
				{
					echo '<option value="'.$u->ruang.'">'.$u->ruang.'</option>';
				}
				?>
				</select></div></div>
				<?php
				$tanggalditerima = tanggal($t->tglditerima);
				?>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal diterima</label></div><div class="col-sm-9">
				<input type="text" name="tanggalditerima" id="tanggalditerima" class="form-control" value="<?php echo $tanggalditerima;?>" class="form-control"></div></div>
			<h4>DATA KELUARGA SISWA</h4>
			<h4>DATA AYAH SISWA</h4>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nmayah" value="<?php echo $t->nmayah;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9"><input type="text" name="alayah" value="<?php echo $t->alayah;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><input type="text" name="tmpayah" value="<?php echo $t->tmpayah;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9"><input type="text" name="tanggallahirayah" id="tanggallahirayah" value="<?php echo tanggal($t->tglayah);?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9">
				<select name="agayah" class="form-control">
				<option value="<?php echo $t->agayah;?>"><?php echo $t->agayah;?></option>
				<option value="Islam">Islam</option>
				<option value="Katolik">Katolik</option>
				<option value="Kristen">Kristen</option>
				<option value="Hindu">Hindu</option>
				<option value="Budha">Budha</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9">
				<select name="wnayah" class="form-control">
				<option value="<?php echo $t->wnayah;?>"><?php echo $t->wnayah;?></option>
				<option value="Indonesia">Indonesia</option>
				<option value="Asing">Asing</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->tayah;?></p></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9">
				<select name="payah" class="form-control">
				<option value="<?php echo $t->payah;?>"><?php echo $t->payah;?></option>
				<?php
				$pekerjaan=$t->payah;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan WHERE nama_pekerjaan <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->nama_pekerjaan;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9">
				<select name="dayah" class="form-control">
				<option value="<?php echo $t->dayah;?>"><?php echo $t->dayah;?></option>
				<?php
				$pekerjaan=$t->dayah;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit WHERE besar <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->besar;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9">
				<select name="sekayah" class="form-control">
				<option value="<?php echo $t->sekayah;?>"><?php echo $t->sekayah;?></option>
				<?php
				$pekerjaan=$t->sekayah;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah WHERE jenjang <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->jenjang;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Masih hidup</label></div><div class="col-sm-9">
				<select name="hdpayah" class="form-control">
				<option value="<?php echo $t->hdpayah;?>"><?php echo $t->hdpayah;?></option>
				<option value="Ya">Ya</option>
				<option value="Tidak">Tidak</option>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jika sudah meninggal, meninggal tahun</label></div><div class="col-sm-9"><input type="text" name="thnayah" value="<?php echo $t->thnayah;?>" class="form-control"></div></div>
			<h4>DATA IBU SISWA</h4>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nmibu" value="<?php echo $t->nmibu;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9"><input type="text" name="alibu" value="<?php echo $t->alibu;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><input type="text" name="tmpibu" value="<?php echo $t->tmpibu;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9"><input type="text" name="tanggallahiribu" value="<?php echo tanggal($t->tglibu);?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9">
				<select name="agibu" class="form-control">
				<option value="<?php echo $t->agibu;?>"><?php echo $t->agibu;?></option>
				<option value="Islam">Islam</option>
				<option value="Katolik">Katolik</option>
				<option value="Kristen">Kristen</option>
				<option value="Hindu">Hindu</option>
				<option value="Budha">Budha</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9">
				<select name="wnibu" class="form-control">
				<option value="<?php echo $t->wnibu;?>"><?php echo $t->wnibu;?></option>
				<option value="Indonesia">Indonesia</option>
				<option value="Asing">Asing</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->tibu;?></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9">
				<select name="pibu" class="form-control">
				<option value="<?php echo $t->pibu;?>"><?php echo $t->pibu;?></option>
				<?php
				$pekerjaan=$t->pibu;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan WHERE nama_pekerjaan <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
				$peker=$dm_pekerjaan->nama_pekerjaan;
				echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9">
				<select name="dibu" class="form-control">
				<option value="<?php echo $t->dibu;?>"><?php echo $t->dibu;?></option>
				<?php
					$pekerjaan=$t->dibu;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit WHERE besar <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
				$peker=$dm_pekerjaan->besar;
				echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9">
				<select name="sekibu" class="form-control">
				<option value="<?php echo $t->sekibu;?>"><?php echo $t->sekibu;?></option>
				<?php
				$pekerjaan=$t->sekibu;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah WHERE jenjang <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->jenjang;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Masih hidup</label></div><div class="col-sm-9">
				<select name="hdpibu" class="form-control">
				<option value="<?php echo $t->hdpibu;?>"><?php echo $t->hdpibu;?></option>
				<option value="Ya">Ya</option>
				<option value="Tidak">Tidak</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jika sudah meninggal, meninggal tahun</label></div><div class="col-sm-9"><input type="text" name="thnibu" value="<?php echo $t->thnibu;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penghasilan Ayah + penghasilan Ibu </label></div><div class="col-sm-9">
				<select name="dortu" class="form-control">
				<option value="<?php echo $t->dortu;?>"><?php echo $t->dortu;?></option>
				<?php
					$pekerjaan=$t->dortu;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit WHERE besar <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->besar;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			<h4>DATA WALI SISWA</h4>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nmwali" value="<?php echo $t->nmwali;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat</label></div><div class="col-sm-9"><input type="text" name="awali" value="<?php echo $t->awali;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div><div class="col-sm-9"><input type="text" name="tmpwali" value="<?php echo $t->tmpwali;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Lahir</label></div><div class="col-sm-9"><input type="text" name="tanggallahirwali" id="tanggallahirwal" value="<?php echo tanggal($t->tglwali);?>"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Agama</label></div><div class="col-sm-9">
				<select name="agwali" class="form-control">
				<option value="<?php echo $t->agwali;?>"><?php echo $t->agwali;?></option>
				<option value="Islam">Islam</option>
				<option value="Katolik">Katolik</option>
				<option value="Kristen">Kristen</option>
				<option value="Hindu">Hindu</option>
				<option value="Budha">Budha</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kewarganegaraan</label></div><div class="col-sm-9">
				<select name="wnwali" class="form-control">
				<option value="<?php echo $t->wnwali;?>"><?php echo $t->wnwali;?></option>
				<option value="Indonesia">Indonesia</option>
				<option value="Asing">Asing</option></select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Telepon</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->twali;?></p></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9">
				<select name="pwali" class="form-control">
				<option value="<?php echo $t->pwali;?>"><?php echo $t->pwali;?></option>
				<?php
				$pekerjaan=$t->pwali;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_pekerjaan WHERE nama_pekerjaan <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->nama_pekerjaan;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penghasilan</label></div><div class="col-sm-9">
				<select name="dwali" class="form-control">
				<option value="<?php echo $t->dwali;?>"><?php echo $t->dayah;?></option>
				<?php
				$pekerjaan=$t->dwali;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_duit WHERE besar <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->besar;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pendidikan</label></div><div class="col-sm-9">
				<select name="sekwali" class="form-control">
				<option value="<?php echo $t->sekwali;?>"><?php echo $t->sekwali;?></option>
				<?php
				$pekerjaan=$t->sekwali;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_sekolah WHERE jenjang <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->jenjang;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?></select></div></div>
			<h4>KEGEMARAN SISWA</h4>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cita - Cita</label></div><div class="col-sm-9">
				<select name="cita" class="form-control">
				<option value="<?php echo $t->cita_cita;?>"><?php echo $t->cita_cita;?></option>
				<?php
				$pekerjaan=$t->cita_cita;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_cita WHERE nama_cita <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->nama_cita;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
				</select></div></div>
			 <div class="form-group row"><div class="col-sm-3"><label class="control-label">Hobi Utama</label></div><div class="col-sm-9">
				<select name="hobi" class="form-control">
				<option value="<?php echo $t->hobi;?>"><?php echo $t->hobi;?></option>
				<?php
				$pekerjaan=$t->hobi;
				$tm_pekerjaan = $this->db->query("SELECT * FROM m_hobi WHERE nama <> '$pekerjaan' ");
				foreach($tm_pekerjaan->result() as $dm_pekerjaan)
				{
					$peker=$dm_pekerjaan->nama;
					echo '<option value="'.$peker.'">'.$peker.'</option>';
				}
				?>
			</select></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kesenian</label></div><div class="col-sm-9"><input type="text" name="kesenian" value="<?php echo $t->kesenian;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Olahraga</label></div><div class="col-sm-9"><input type="text" name="olahraga" value="<?php echo $t->olahraga;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Organisasi</label></div><div class="col-sm-9"><input type="text" name="organisasi" value="<?php echo $t->organisasi;?>" class="form-control"></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Lain - lain</label></div><div class="col-sm-9"><input type="text" name="lain" value="<?php echo $t->lain;?>" class="form-control"></div></div>
			<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">
		<input type="hidden" name="nis" value="<?php echo $t->nis;?>"></p></form>
		<?php
		
		}
		else
		{
?>
		<table class="table table-striped table-hover table-bordered"><tr>
                <td colspan="2"><h4>DATA PRIBADI SISWA</h4></td></tr>
    <tr>
                <td>Password Tes Daring </td>
                <td><?php echo $t->password_tes;?>
                </td>
              </tr>
     <tr>
                <td>Nomor Induk Siswa</td>
                <td><?php echo $t->nis;?>
                </td>
    </tr>

    <tr>
                <td>Nomor Peserta UN SLTP</td>
                <td><?php echo $t->skhun;?>
                </td>
              </tr>
              <tr>
                <td>Nomor Induk Siswa</td>
                <td><?php echo $t->nis;?>
                </td>
    </tr>
   <tr>
                <td>NIS Nasional</td>
                <td><?php echo $t->nisn;?>
                </td>
              </tr>
   <tr>
                <td>Nomor Induk Kependudukan (NIK) Kepala Keluarga</td>
                <td><?php echo $t->nik_kk;?>
                </td>
              </tr>
   <tr>

   <tr>
                <td>Nomor Induk Kependudukan (NIK) Siswa</td>
                <td><?php echo $t->nik;?>
                </td>
              </tr>
   <tr>
                <td>Nomor KK </td>
                <td><?php echo $t->nokk;?>
                </td>
              </tr>
              <tr>
                <td>Nama
                </td>
                <td><?php echo $t->nama;?>
		<?php
		if ($t->ijazah<>'Ya')
			{echo '<strong><font color="#FF0000">NAMA BELUM SESUAI IJAZAH!</strong>';}
		?>
                </td>
              </tr>
              <tr>
                <td>
                  Tempat Lahir
                </td>
                <td><?php echo $t->tmpt;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal lahir</td>
                <td><?php 
		$str = $t->tgllhr;	
		$tgllhr = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tgllhr;?>
              </tr>
              <tr>
                <td>Agama</td>
                <td><?php echo $t->agama;?>
                </td>
              </tr>
              <tr>
                <td>
                  Jenis Kelamin
                </td>
                <td><?php echo $t->jenkel;?>
                </td>
              </tr>
              <tr>
                <td>Kewarganegaraan</td>
                <td><?php echo $t->wn;?>
                </td>
              </tr>
              <tr>
                <td>Anak Yatim-Piatu</td>
                <td><?php echo $t->yatim;?>
                </td>
              </tr>

              <tr>
                <td>Anak ke</td>
                <td><?php echo $t->anakke;?>
                </td>
              </tr>
              <tr>
                <td>Jumlah Saudara Kandung</td>
                <td><?php echo $t->kandung;?>
                </td>
              </tr>
              <tr>
                <td>Jumlah Saudara Tiri</td>
                <td><?php echo $t->tiri;?>
                </td>
              </tr>
              <tr>
                <td>Jumlah Saudara Angkat</td>
                <td><?php echo $t->angkat;?>
                </td>
              </tr>
              <tr>
                <td>Bahasa Sehari-hari</td>
                <td><?php echo $t->bhs;?>
                </td>
              </tr>
              <tr>
              <tr>
                <td colspan="2"><h4>TEMPAT TINGGAL</h4></td>
              </tr>
              <tr>
                <td rowspan="5">Alamat </td>
                <td>Jalan <?php echo $t->jalan;?>
                </td>
              </tr>
              <tr>
                <td>RT <?php echo $t->rt;?> RW <?php echo $t->rw;?> Dusun <?php echo $t->dusun;?> 
                </td>
              </tr>
              <tr>
                <td>Desa <?php echo $t->desa;?> Kec. <?php echo $t->kec;?>
                </td>
              </tr>
              <tr>
                <td>Kab. <?php echo $t->kab;?> Prov. <?php echo $t->prov;?>
                </td>
              </tr>
	      <tr>
                <td><?php echo $t->alamat;?>
                </td>
              </tr>
              <tr>
                <td>Jarak ke sekolah</td>
                <td colspan="2"><?php echo $t->jarak;?> km
                </td>
              </tr>
              <tr>
                <td>Jenis Tempat Tinggal</td>
                <td colspan="2"><?php echo $t->jenrumah;?>
                </td>
              </tr>
              <tr>
              <tr>
                <td>Dinding Rumah</td>
                <td colspan="2"><?php echo $t->dinding;?>
                </td>
              </tr>
              <tr>
                <td>Lantai Rumah</td>
                <td colspan="2"><?php echo $t->lantai;?>
                </td>
              </tr>
              <tr>
                <td>Cacah Sepeda Motor</td>
                <td colspan="2"><?php echo $t->cacah_spm;?>
                </td>
              </tr>
              <tr>
                <td>Cacah Mobil</td>
                <td colspan="2"><?php echo $t->cacah_mobil;?>
                </td>
              </tr>
              <tr>
                <td>Ternak</td>
                <td colspan="2"><?php echo $t->ternak;?>
                </td>
              </tr>
              <tr>
                <td>Barang Elektronik</td>
                <td colspan="2"><?php echo $t->elektronik;?>
                </td>
              </tr>
              <tr>
              <tr>
                <td>Jenis Tempat Tinggal</td>
                <td colspan="2"><?php echo $t->jenrumah;?>
                </td>
              </tr>
              <tr>
              <tr>
              <tr>
              <tr>
              <tr>
              <tr>

                <td>Tinggal dengan</td>
                <td colspan="2"><?php echo $t->tinggal;?>
                </td>
              </tr>

              <tr>
                <td>Jenis Transportasi</td>
                <td colspan="2"><?php echo $t->transportasi;?>
                </td>
              </tr>

              <tr>
                <td>Nomor Telepon Rumah</td>
                <td colspan="2"><?php echo $t->telepon;?> / HP : <?php echo $t->hp;?>
                </td>
              </tr>
              <tr>
                <td colspan="3"><h4>KESEHATAN</h4>
                 </td>
              </tr>
              <tr>
                <td>Berat Badan</td>
                <td colspan="2"><?php echo $t->bb;?> kg
                </td>
              </tr>
              <tr>
                <td>Tinggi Badan</td>
                <td colspan="2"><?php echo $t->tb;?> cm
                </td>
              </tr>
              <tr>
                <td>Golongan Darah</td>
                <td colspan="2"><?php echo $t->goldarah;?>
                </td>
              </tr>
              <tr>
                <td>Sakit yang pernah diderita</td>
                <td colspan="2"><?php echo $t->sakit;?>
                </td>
              </tr>
              <tr>
                <td>Kebutuhan Khusus</td>
                <td colspan="2"><?php echo $t->jasmani;?>
                </td>
              </tr>
              <tr>
                <td colspan="3"><h4>SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?></h4>
                 </td>
              </tr>
              <tr>
                <td>SLTP</td>
                <td colspan="2"><?php echo $t->sltp;?>
                </td>
              </tr>
              <tr>
                <td>No STTB SLTP</td>
                <td colspan="2"><?php echo $t->nosttb;?>
                </td>
              </tr>
              <tr>
                <td>No Peserta UN SLTP</td>
                <td colspan="2"><?php echo $t->skhun;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal STTB</td>
                <td colspan="2"><?php 
		$str = $t->tglsttb;	
		$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tglsttb;?>
                </td>
              </tr>
              <tr>
                <td>Lama Belajar di SLTP</td>
                <td colspan="2"><?php echo $t->lama;?> Tahun
                </td>
              </tr>

              <tr>
                <td>Pindahan dari</td>
                <td colspan="2"><?php echo $t->pinsek;?>
                </td>
              </tr>
              <tr>
                <td>Alasan pindah</td>
                <td colspan="2"><?php echo $t->alasan;?>
                </td>
              </tr>
              <tr>
                <td>Diterima di kelas</td>
                <td colspan="2"><?php echo $t->kls;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal di terima</td>
                <td colspan="2"><?php 
		$str = $t->tglditerima;	
		$tglditerima = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tglditerima;?>
                </td>
              </tr>

              <tr>
                <td colspan="3"><h4>DATA KELUARGA SISWA</h4>
                 </td>
              </tr>
              <tr>
                <td colspan="3"><h4>DATA AYAH SISWA</h4>
                 </td>
              </tr>
              <tr>
                <td>Nama</td>
                <td colspan="2"><?php echo $t->nmayah;?>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td colspan="2"><?php echo $t->alayah;?>
                </td>
              </tr>

              <tr>
                <td>Tempat Lahir</td>
                <td colspan="2"><?php echo $t->tmpayah;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td colspan="2"><?php 
		$str = $t->tglayah;	
		$tglayah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tglayah;?>
                </td>
              </tr>
              <tr>
                <td>Agama</td>
                <td colspan="2"><?php echo $t->agayah;?>
                </td>
              </tr>
              <tr>
                <td>Kewarganegaraan</td>
                <td colspan="2"><?php echo $t->wnayah;?>
                </td>
              </tr>
		<td>Telepon</td>
              <td colspan="2">
              <?php echo $t->tayah;?>
              </td>
            </tr>

              <tr>
                <td>Pekerjaan</td>
                <td colspan="2"><?php echo $t->payah;?>
                 </td>
               </tr>
              <tr>
                <td>Penghasilan</td>
                <td colspan="2">Rp <?php echo $t->dayah;?>
                </td>
              </tr>
              <tr>
                <td>Pendidikan</td>
                <td colspan="2"><?php echo $t->sekayah;?>
                 </td>
               </tr>
              <tr>
                <td>Masih hidup</td>
                <td colspan="2"><?php echo $t->hdpayah;?>
                 </td>
               </tr>
              <tr>
                <td>Jika tidak, meninggal tahun</td>
                <td colspan="2"><?php echo $t->thnayah;?>
                </td>
              </tr>
              <tr>
		<tr>
                <td colspan="2"><h4>DATA IBU SISWA</h4>
                 </td>
              </tr>
              <tr>
                <td>Nama</td>
                <td colspan="2"><?php echo $t->nmibu;?>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td colspan="2"><?php echo $t->alibu;?>
                </td>
              </tr>

              <tr>
                <td>Tempat Lahir</td>
                <td colspan="2"><?php echo $t->tmpibu;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td colspan="2"><?php 
		$str = $t->tglibu;	
		$tglibu = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tglibu;?>
                </td>
              </tr>
              <tr>
                <td>Agama</td>
                <td colspan="2"><?php echo $t->agibu;?>
                </td>
              </tr>
              <tr>
                <td>Kewarganegaraan</td>
                <td colspan="2"><?php echo $t->wnibu;?>
                </td>
              </tr>
		<td>Telepon</td>
              <td colspan="2">
              <?php echo $t->tibu;?>
              </td>
            </tr>

              <tr>
                <td>Pekerjaan</td>
                <td colspan="2"><?php echo $t->pibu;?>
                 </td>
               </tr>
              <tr>
                <td>Penghasilan</td>
                <td colspan="2">Rp <?php echo $t->dibu;?>
                </td>
              </tr>
              <tr>
                <td>Pendidikan</td>
                <td colspan="2"><?php echo $t->sekibu;?>
                 </td>
               </tr>
              <tr>
                <td>Masih hidup</td>
                <td colspan="2"><?php echo $t->hdpibu;?>
                 </td>
               </tr>
              <tr>
                <td>Jika tidak, meninggal tahun</td>
                <td colspan="2"><?php echo $t->thnibu;?>
                </td>
              </tr>
		<?php
		$dnmwali = $t->nmwali;
		if (! empty($dnmwali))
		{


		?>
              <tr>
               <td colspan="2"><h4>DATA WALI SISWA</h4>
                 </td>
              </tr>
              <tr>
                <td>Nama</td>
                <td colspan="2"><?php echo $t->nmwali;?>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td colspan="2"><?php echo $t->awali;?>
                </td>
              </tr>

              <tr>
                <td>Tempat Lahir</td>
                <td colspan="2"><?php echo $t->tmpwali;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td colspan="2"><?php
		$str = $t->tglwali;	
		$tglwali = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tglwali;?>
                </td>
              </tr>
              <tr>
                <td>Agama</td>
                <td colspan="2"><?php echo $t->agwali;?>
                </td>
              </tr>
              <tr>
                <td>Kewarganegaraan</td>
                <td colspan="2"><?php echo $t->wnwali;?>
                </td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td colspan="2"><?php echo $t->twali;?>
                </td>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <td colspan="2"><?php echo $t->pwali;?>
                 </td>
               </tr>
              <tr>
                <td>Penghasilan</td>
                <td colspan="2">Rp <?php echo $t->dwali;?>
                </td>
              </tr>
              <tr>
                <td>Pendidikan</td>
                <td colspan="2"><?php echo $t->sekwali;?>
                 </td>
              </tr>
		<?php
		}
	?>
<tr>
                <td colspan="2"><h4>KEGEMARAN SISWA</h4>
                 </td>
              </tr>
	      <tr>
                <td>Cita - cita</td>
                <td colspan="2"><?php echo $t->cita_cita;?>
                </td>
              </tr>
	      <tr>
                <td>Hobi utama</td>
                <td colspan="2"><?php echo $t->hobi;?>
                </td>
              </tr>
              <tr>
              <tr>
              <tr>
                <td>Kesenian</td>
                <td colspan="2"><?php echo $t->kesenian;?>
                </td>
              </tr>
              <tr>
                <td>Olahraga</td>
                <td colspan="2"><?php echo $t->olahraga;?>
                </td>
              </tr>

              <tr>
                <td>Organisasi</td>
                <td colspan="2"><?php echo $t->organisasi;?>
                </td>
              </tr>
              <tr>
                <td>Lain - lain</td>
                <td colspan="2"><?php echo $t->lain;?>
                </td>
              </tr>
                <td colspan="2"><h4>PERKEMBANGAN SISWA</h4>
                 </td>
              </tr>
              <tr>
                <td>Beasiswa</td>
                <td colspan="2"><?php echo $t->beasiswa;?>
                </td>
              </tr>
              <tr>
                <td>Meninggalkan Madrasah</td>
                <td colspan="2"><?php echo $t->tanggalkeluar;?>
                </td>
              </tr>

              <tr>
                <td>Alasan Meninggalkan Madrasah</td>
                <td colspan="2"><?php echo $t->alasankeluar;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal STTB</td>
                <td colspan="2"><?php echo $t->tamatbelajar;?>
                </td>
              </tr>
              <tr>
                <td>Nomor STTB</td>
                <td colspan="2"><?php echo $t->nosttbma;?>
                </td>
              </tr>
		<tr>
                <td colspan="2"><h4>INFORMASI SETELAH SELESAI SEKOLAH</h4>
                 </td>
              </tr>
              <tr>
                <td>Melanjutkan di</td>
                <td colspan="2"><?php echo $t->melanjutkan;?>
                </td>
              </tr>
              <tr>
                <td>Mulai bekerja</td>
                <td colspan="2"><?php echo $t->tanggalbekerja;?>
                </td>
              </tr>

              <tr>
                <td>Bekerja di</td>
                <td colspan="2"><?php echo $t->namaperusahaan;?>
                </td>
              </tr>
              <tr>
                <td>Penghasilan</td>
                <td colspan="2"><?php echo $t->penghasilan;?>
                </td>
              </tr></table>
		<p class="text-center"><a href="<?php echo base_url();?>siswa/data/ubah" class="btn btn-info"><b>Ubah Data</b></a></p>
	<?php
	
		}
	}
}
else{
echo '<div class="alert alert-warning">Belum Ada Data</div>';
}
?>
</div></div></div>
