<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: detil_siswa_foto.php
// Lokasi      		: application/views/tatausaha
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//   MAN Tengaran
//   www.mantengaran.sch.id
//   selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<?php

if(isset($tautan))
	{
	echo '<a href="'.base_url().''.$tautan.'/carisiswa" class="btn btn-info"><b>Pencarian Data Siswa</b></a>';
	echo '<h3>'.$judulhalaman.'</h3>';
	}
else
{
	echo '<h3>'.$judulhalaman.'</h3>';
?>
<a href="<?php echo base_url();?>tatausaha/carisiswa" class="btn btn-info"><b>Pencarian Data Siswa</b></a>
<a href="<?php echo base_url();?>tatausaha/editsiswa/<?php echo $nis;?>" class="btn btn-info"><b>Ubah Data</b></a>
<a href="<?php echo base_url();?>tatausaha/foto/<?php echo $nis;?>" class="btn btn-info"><b>Unggah Foto</b></a>
<a href="<?php echo base_url();?>tatausaha/ijazah/<?php echo $nis;?>" class="btn btn-info"><b>Data Ijazah</b></a>
<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>tatausaha/detilsiswa/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-info"><span class="glyphicon glyphicon-new-window"></span><b> Cetak Data Siswa</b></a><p></p>
<?php
}
if(count($query->result())>0)
{
?>
 
    <iframe width="100%" height="200" frameborder="0" marginheight="0" marginwidth="0" src="<?php echo base_url().'tatausaha/kirimard/'.$nis;?>"></iframe>
	<?php
	foreach($query->result() as $t)
	{
		if (!empty($t->foto))
			{
			$fotone = ''.base_url().$this->config->item('folderfotosiswa').'/'.$t->foto.'';
			echo '<center><img src="'.$fotone.'" height="200"></center>';
			}

		?>
		<div class="form-horizontal">  <h4>DATA PRIBADI SISWA</h4>
		<div class="form-group row row">
			<label for="thnajaran" class="col-sm-3 control-label">Status</label>
			<div class="col-sm-9"><?php echo $t->ket;?></div>
		</div>
<div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">Nomor Induk Siswa</label><div class="col-sm-9"><?php echo $t->nis;?>
		</div></div>
<div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">NIS Nasional</label><div class="col-sm-9"><?php echo $t->nisn;?>
		</div></div><div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">Nomor Induk Kependudukan (NIK) Siswa</label><div class="col-sm-9"><?php echo $t->nik;?>
		</div></div><div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">Nomor Kartu Kependudukan</label><div class="col-sm-9"><?php echo $t->nokk;?>
		</div></div><div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">Nomor KPS</label><div class="col-sm-9"><?php echo $t->kps;?>
		</div></div><div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">Nomor PKH</label><div class="col-sm-9"><?php echo $t->pkh;?>
		</div></div>
	    <div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">Nama</label><div class="col-sm-9"><?php echo $t->nama;?>		<?php
		if ($t->ijazah<>'Ya')
			{echo '<strong><font color="#FF0000">NAMA BELUM SESUAI IJAZAH!</font></strong>';}
		?>

		</div></div>
		<div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">Tempat Lahir</label><div class="col-sm-9"><?php echo $t->tmpt;?>
		</div></div>
		<div class="form-group row row">
		<label for="thnajaran" class="col-sm-3 control-label">Tanggal lahir</label><div class="col-sm-9"><?php
		  echo date_to_long_string($t->tgllhr);
		?>
		</div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Agama</label><div class="col-sm-9"><?php echo $t->agama;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jenis Kelamin</label><div class="col-sm-9"><?php echo $t->jenkel;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Kelas</label><div class="col-sm-9"><?php echo $t->kdkls;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Kewarganegaraan</label><div class="col-sm-9"><?php echo $t->wn;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Anak Yatim-Piatu</label><div class="col-sm-9"><?php echo $t->yatim;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Anak ke</label><div class="col-sm-9"><?php echo $t->anakke;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jumlah Saudara Kandung</label><div class="col-sm-9"><?php echo $t->kandung;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jumlah Saudara Tiri</label><div class="col-sm-9"><?php echo $t->tiri;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jumlah Saudara Angkat</label><div class="col-sm-9"><?php echo $t->angkat;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Bahasa Sehari-hari</label><div class="col-sm-9"><?php echo $t->bhs;?></div></div>
		<h4>TEMPAT TINGGAL</h4>
		<div class="form-group row row"><label class="col-sm-3 control-label">Alamat</label><div class="col-sm-9"><?php echo $t->jalan;?> RT <?php echo $t->rt;?> RW  <?php echo $t->rw;?> Dusun   <?php echo $t->dusun;?>
		Desa <?php echo $t->desa;?> Kec.   <?php echo $t->kec;?> <?php echo $t->kab;?> Prov   <?php echo $t->prov;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jarak ke sekolah</label><div class="col-sm-9"><?php echo $t->jarak;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jenis Tempat Tinggal</label><div class="col-sm-9"><?php echo $t->jenrumah;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Dinding Rumah</label></div><div class="col-sm-9">
				<?php echo $t->dinding;?>
			</div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Lantai Rumah</label></div><div class="col-sm-9">
				<?php echo $t->lantai;?>
			</div></div>

		<div class="form-group row row"><label class="col-sm-3 control-label">Tinggal dengan</label><div class="col-sm-9"><?php echo $t->tinggal;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jenis Transportasi</label><div class="col-sm-9"><?php echo $t->transportasi;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Nomor Telepon Rumah</label><div class="col-sm-9"><?php echo $t->telepon;?> / HP : <?php echo $t->hp;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah Sepeda Motor</label></div>
		<div class="col-sm-9"><?php echo $t->cacah_spm;?></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah Mobil</label></div>
		<div class="col-sm-9"><?php echo $t->cacah_mobil;?></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ternak</label></div>
		<div class="col-sm-9"><?php echo $t->ternak;?></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Barang elektronik</label></div>
		<div class="col-sm-9"><?php echo $t->elektronik;?></div></div>
		<h4>KESEHATAN</h4>
		<div class="form-group row row"><label class="col-sm-3 control-label">Berat Badan</label><div class="col-sm-9"><?php echo $t->bb;?> kg</div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tinggi Badan</label><div class="col-sm-9"><?php echo $t->tb;?> cm</div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Golongan Darah</label><div class="col-sm-9"><?php echo $t->goldarah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Sakit yang pernah diderita</label><div class="col-sm-9"><?php echo $t->sakit;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Kebutuhan Khusus</label><div class="col-sm-9"><?php echo $t->jasmani;?></div></div>
		<h4>SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?></h4>
		<div class="form-group row row"><label class="col-sm-3 control-label">SLTP / Paket B</label><div class="col-sm-9"><?php echo $t->sltp;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">No STTB / Ijazah SLTP / Paket B</label><div class="col-sm-9"><?php echo $t->nosttb;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Nomor Peserta UN SLTP</label><div class="col-sm-9"><?php echo $t->skhun;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Lama Belajar di SLTP</label><div class="col-sm-9"><?php echo $t->lama;?> Tahun</div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tanggal STTB</label><div class="col-sm-9">
			<?php
			$str = $t->tglsttb;	
			$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
			  echo $tglsttb;
		?>
		</div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Pindahan dari</label><div class="col-sm-9"><?php echo $t->pinsek;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Alasan pindah</label><div class="col-sm-9"><?php echo $t->alasan;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Diterima di kelas</label><div class="col-sm-9"><?php echo $t->kls;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tanggal diterima</label><div class="col-sm-9"><?php
		$str = $t->tglditerima;	
		$tglditerima = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		  echo $tglditerima;
		echo '</div></div>';
		?>
		<h4>DATA KELUARGA SISWA  </h4>
		<h5>DATA AYAH SISWA </h5>
 		<div class="form-group row row"><label class="col-sm-3 control-label">Nama</label><div class="col-sm-9"><?php echo $t->nmayah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Nomor Induk Kependudukan (NIK)</label><div class="col-sm-9"><?php echo $t->nik_kk;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Alamat</label><div class="col-sm-9"><?php echo $t->alayah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tempat Lahir</label><div class="col-sm-9"><?php echo $t->tmpayah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tanggal Lahir</label><div class="col-sm-9">
			<?php
			$str = $t->tglayah;	
			$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
			  echo $tglsttb;
		echo '</div></div>';
		?>
<div class="form-group row row"><label class="col-sm-3 control-label">Agama</label><div class="col-sm-9"><?php echo $t->agayah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Kewarganegaraan</label><div class="col-sm-9"><?php echo $t->wnayah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Telepon</label><div class="col-sm-9"><?php echo $t->tayah;?></div></div>
		
<div class="form-group row row"><label class="col-sm-3 control-label">Pekerjaan</label><div class="col-sm-9"><?php echo $t->payah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Penghasilan</label><div class="col-sm-9">Rp 
		<?php echo $t->dayah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Pendidikan</label><div class="col-sm-9"><?php echo $t->sekayah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Masih hidup</label><div class="col-sm-9"><?php echo $t->hdpayah;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jika sudah meninggal, meninggal tahun</label><div class="col-sm-9"><?php echo $t->thnayah;?></div></div>
		<h5>DATA IBU SISWA</h5>
		<div class="form-group row row"><label class="col-sm-3 control-label">Nama</label><div class="col-sm-9"><?php echo $t->nmibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Nomor Induk Kependudukan (NIK)</label><div class="col-sm-9"><?php echo $t->nik_ibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Alamat</label><div class="col-sm-9"><?php echo $t->alibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tempat Lahir</label><div class="col-sm-9"><?php echo $t->tmpibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tanggal Lahir</label><div class="col-sm-9">
			<?php
			$str = $t->tglibu;	
			$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
			  echo $tglsttb;
			echo '</div></div>';
		?>       
		<div class="form-group row row"><label class="col-sm-3 control-label">Agama</label><div class="col-sm-9"><?php echo $t->agibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Kewarganegaraan</label><div class="col-sm-9"><?php echo $t->wnibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Telepon</label><div class="col-sm-9"><?php echo $t->tibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Pekerjaan</label><div class="col-sm-9"><?php echo $t->pibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Penghasilan</label><div class="col-sm-9">Rp <?php echo $t->dibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Pendidikan</label><div class="col-sm-9"><?php echo $t->sekibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Masih hidup</label><div class="col-sm-9"><?php echo $t->hdpibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Jika sudah meninggal, meninggal tahun</label><div class="col-sm-9"><?php echo $t->thnibu;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Penghasilan Ayah + penghasilan Ibu </label><div class="col-sm-9">Rp 
		<?php echo $t->dortu;?></div></div>
		<h5>DATA WALI SISWA </h5>
 		<div class="form-group row row"><label class="col-sm-3 control-label">Nama</label><div class="col-sm-9"><?php echo $t->nmwali;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Alamat</label><div class="col-sm-9"><?php echo $t->awali;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tempat Lahir</label><div class="col-sm-9"><?php echo $t->tmpwali;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tanggal Lahir</label><div class="col-sm-9"><?php
		$str = $t->tglwali;	
		$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

		  echo $tglsttb;
		echo '</div></div>';
		?>

<div class="form-group row row"><label class="col-sm-3 control-label">Agama</label><div class="col-sm-9"><?php echo $t->agwali;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Kewarganegaraan</label><div class="col-sm-9"><?php echo $t->wnwali;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Telepon</label><div class="col-sm-9"><?php echo $t->twali;?></div></div>
		
<div class="form-group row row"><label class="col-sm-3 control-label">Pekerjaan</label><div class="col-sm-9"><?php echo $t->pwali;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Penghasilan</label><div class="col-sm-9">Rp 
		<?php echo $t->dwali;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Pendidikan</label><div class="col-sm-9"><?php echo $t->sekwali;?></div></div>
		<h4>KEGEMARAN SISWA</h4>
		<div class="form-group row row"><label class="col-sm-3 control-label">Cita - Cita</label><div class="col-sm-9"><?php echo $t->cita_cita;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Hobi Utama</label><div class="col-sm-9"><?php echo $t->hobi;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Kesenian</label><div class="col-sm-9"><?php echo $t->kesenian;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Olahraga</label><div class="col-sm-9"><?php echo $t->olahraga;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Organisasi</label><div class="col-sm-9"><?php echo $t->organisasi;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Lain - lain</label><div class="col-sm-9"><?php echo $t->lain;?></div></div>
		<h4>PERKEMBANGAN SISWA</h4>
		<div class="form-group row row"><label class="col-sm-3 control-label">Beasiswa</label><div class="col-sm-9"><?php echo $t->beasiswa;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Meninggalkan Madrasah</label><div class="col-sm-9"><?php echo tanggal($t->tanggalkeluar);?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Alasan Meninggalkan Madrasah</label><div class="col-sm-9"><?php echo $t->alasankeluar;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Pindah ke sekolah lain</label><div class="col-sm-9"><?php echo $t->sekolahtujuan;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Nomor Surat</label><div class="col-sm-9"><?php echo $t->nosurat;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Tanggal STTB</label><div class="col-sm-9"><?php echo tanggal($t->tamatbelajar);?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Nomor STTB</label><div class="col-sm-9"><?php echo $t->nosttbma;?></div></div>
		<div class="form-group row row"><label class="col-sm-3 control-label">Chat ID Telegram</label><div class="col-sm-9"><?php echo $t->chat_id;?></div></div>
		</div>
			<?php
		if(!empty($t->alasankeluar))
		{
?>
				<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/keluar/lhb/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary"><span class="glyphicon glyphicon-download"> </span> KETERANGAN KELUAR LHB</a> 
				<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/keluar/lck/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary"><span class="glyphicon glyphicon-download"> </span> KETERANGAN KELUAR LCK</a></td>
				<?php
		}
	}
}
else{
echo "Belum Ada Data";
}
?>
</div>

