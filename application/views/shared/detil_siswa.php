<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: detil_siswa.php
// Lokasi      		: application/views/shared
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>DATA DIRI SISWA - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<?php
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		
?>
<table width="700" cellpadding="2" cellspacing="1">
    <tr>
                <td colspan="4">
                  <p align="center"><b>
                 DATA PRIBADI SISWA </b>
                </td>
    </tr>
    <tr>
                <td width="200">Nomor Peserta UN SLTP</td>
                <td width="5">: </td><td><?php echo $t->skhun;?>
                </td>
                <td rowspan="12" width="200" valign="top" align="center">
		<?php
		if (!empty($t->foto))
			{
			$fotone = ''.base_url().$this->config->item('folderfotosiswa').'/'.$t->foto.'';
			echo '<img src="'.$fotone.'" width="150" height="200">';
			}
		?>
</td>
              </tr>
              <tr>
                <td>Nomor Induk Siswa</td>
                <td width="5">: </td><td><?php echo $t->nis;?>
                </td>
    </tr>
   <tr>
                <td>NIS Nasional</td>
                <td width="5">: </td><td><?php echo $t->nisn;?>
                </td>
              </tr>
              <tr>
                <td>Nama
                </td>
                <td width="5">: </td><td><?php echo $t->nama;?>
		<?php
		if ($t->ijazah<>'Ya')
			{echo '<strong><font color="#FF0000">NAMA BELUM SESUAI IJAZAH!</font></strong>';}
		?>
                </td>
              </tr>
              <tr>
                <td>
                  Tempat Lahir
                </td>
                <td width="5">: </td><td><?php echo $t->tmpt;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal lahir</td>
                <td width="5">: </td><td><?php 
			$str = $t->tgllhr;	
			$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
			echo $tanggal;?>
              </tr>
              <tr>
                <td>Agama</td>
                <td width="5">: </td><td><?php echo $t->agama;?>
                </td>
              </tr>
              <tr>
                <td>
                  Jenis Kelamin
                </td>
                <td>
                  : </td><td><?php echo $t->jenkel;?>
                </td>
              </tr>

              <tr>
                <td>Kelas</td>
                <td width="5">: </td><td><?php echo $t->kdkls;?>
                </td>
              </tr>
              <tr>
                <td>Kewarganegaraan</td>
                <td width="5">: </td><td><?php echo $t->wn;?>
                </td>
              </tr>
              <tr>
                <td>Anak Yatim-Piatu</td>
                <td width="5">: </td><td><?php echo $t->yatim;?>
                </td>
              </tr>

              <tr>
                <td>Anak ke</td>
                <td width="5">: </td><td><?php echo $t->anakke;?>
                </td>
              </tr>
              <tr>
                <td>Jumlah Saudara Kandung</td>
                <td width="5">: </td><td><?php echo $t->kandung;?>
                </td>
              </tr>
              <tr>
                <td>Jumlah Saudara Tiri</td>
                <td width="5">: </td><td><?php echo $t->tiri;?>
                </td>
              </tr>
              <tr>
                <td>Jumlah Saudara Angkat</td>
                <td width="5">: </td><td><?php echo $t->angkat;?>
                </td>
              </tr>
              <tr>
                <td>Bahasa Sehari-hari</td>
                <td width="5">: </td><td><?php echo $t->bhs;?>
                </td>
              </tr>
            <tr>
              <td>Nomor Induk Kependudukan (NIK)</td>
              <td>:</td><td>
              <?php echo $t->nik;?>
              </td>
            </tr>
            <tr>
              <td>Nomor Kartu Kependudukan</td>
              <td>:</td><td>
              <?php echo $t->nokk;?>
              </td>
            </tr>
            <tr>
              <td>Nomor KPS</td>
              <td>:</td><td>
              <?php echo $t->kps;?>
              </td>
            </tr>
            <tr>
              <td>Nomor PKH</td>
              <td>:</td><td>
              <?php echo $t->pkh;?>
              </td>
            </tr>

</table>
<table width="700" cellpadding="2" cellspacing="1" class="widget-small">
              <tr>
                <td colspan="3">
                  <p align="center"><b>
                  TEMPAT TINGGAL
                  </b>
                 </td>
              </tr>
              <tr>
                <td width="200">Alamat </td>
                <td width="5">: </td><td>Jalan <?php echo $t->jalan;?>
                </td>
              </tr>
              <tr>
                <td> </td>
                <td width="5">: </td><td>RT <?php echo $t->rt;?> RW <?php echo $t->rw;?> Dusun <?php echo $t->dusun;?> 
                </td>
              </tr>
              <tr>
                <td> </td>
                <td width="5">: </td><td>Desa <?php echo $t->desa;?> Kec. <?php echo $t->kec;?>
                </td>
              </tr>
              <tr>
                <td> </td>
                <td width="5">: </td><td>Kab. <?php echo $t->kab;?> Prov. <?php echo $t->prov;?>
                </td>
              </tr>
	      <tr>
                <td> </td>
                <td>:</td><td><b> <?php echo $t->alamat;?></b>
                </td>
              </tr>
              <tr>
                <td>Jarak ke sekolah</td>
                <td width="5">: </td><td><?php echo $t->jarak;?>
                </td>
              </tr>
              <tr>
                <td>Jenis Tempat Tinggal</td>
                <td width="5">: </td><td><?php echo $t->jenrumah;?>
                </td>
              </tr>
              <tr>
                <td>Tinggal dengan</td>
                <td width="5">: </td><td><?php echo $t->tinggal;?>
                </td>
              </tr>

              <tr>
                <td>Jenis Transportasi</td>
                <td width="5">: </td><td><?php echo $t->transportasi;?>
                </td>
              </tr>

              <tr>
                <td>Nomor Telepon Rumah</td>
                <td width="5">: </td><td><?php echo $t->telepon;?> / HP : <?php echo $t->hp;?>
                </td>
              </tr>
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
                <td colspan="3">
                  <p align="center"><b>
                  KESEHATAN
                  </b>
                 </td>
              </tr>
              <tr>
                <td>Berat Badan</td>
                <td width="5">: </td><td><?php echo $t->bb;?> kg
                </td>
              </tr>
              <tr>
                <td>Tinggi Badan</td>
                <td width="5">: </td><td><?php echo $t->tb;?> cm
                </td>
              </tr>
              <tr>
                <td>Golongan Darah</td>
                <td width="5">: </td><td><?php echo $t->goldarah;?>
                </td>
              </tr>
              <tr>
                <td>Sakit yang pernah diderita</td>
                <td width="5">: </td><td><?php echo $t->sakit;?>
                </td>
              </tr>
              <tr>
                <td>Kebutuhan Jasmani</td>
                <td width="5">: </td><td><?php echo $t->jasmani;?>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <p align="center"><b>
                  SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?></b>
                 </td>
              </tr>
              <tr>
                <td>SLTP</td>
                <td width="5">: </td><td><?php echo $t->sltp;?>
                </td>
              </tr>
              <tr>
                <td>No STTB SLTP</td>
                <td width="5">: </td><td><?php echo $t->nosttb;?>
                </td>
              </tr>
              <tr>
                <td>No Peserta UN SLTP</td>
                <td width="5">: </td><td><?php echo $t->skhun;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal STTB</td>
                <td width="5">: </td><td><?php 
			$str = $t->tglsttb;		
			$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
			echo $tanggal;?>
                </td>
              </tr>
              <tr>
                <td>Lama Belajar di SLTP</td>
                <td width="5">: </td><td><?php echo $t->lama;?> Tahun
                </td>
              </tr>

              <tr>
                <td>Pindahan dari</td>
                <td width="5">: </td><td><?php echo $t->pinsek;?>
                </td>
              </tr>
              <tr>
                <td>Alasan pindah</td>
                <td width="5">: </td><td><?php echo $t->alasan;?>
                </td>
              </tr>
              <tr>
                <td>Diterima di kelas</td>
                <td width="5">: </td><td><?php echo $t->kls;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal di terima</td>
                <td width="5">: </td><td><?php 
			$str = $t->tglditerima;	
			$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
			echo $tanggal;?>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <p align="center"><b>
                  DATA AYAH SISWA
                  </b>
                 </td>
              </tr>
              <tr>
                <td>Nama</td>
                <td width="5">: </td><td><?php echo $t->nmayah;?>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td width="5">: </td><td><?php echo $t->alayah;?>
                </td>
              </tr>

              <tr>
                <td>Tempat Lahir</td>
                <td width="5">: </td><td><?php echo $t->tmpayah;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td width="5">: </td><td><?php 
		$str = $t->tglayah;	
		$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tanggal;?>
                </td>
              </tr>
              <tr>
                <td>Agama</td>
                <td width="5">: </td><td><?php echo $t->agayah;?>
                </td>
              </tr>
              <tr>
                <td>Kewarganegaraan</td>
                <td width="5">: </td><td><?php echo $t->wnayah;?>
                </td>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <td width="5">: </td><td><?php echo $t->payah;?>
                 </td>
               </tr>
              <tr>
                <td>Penghasilan</td>
                <td width="5">: </td><td>Rp <?php echo $t->dayah;?>
                </td>
              </tr>
              <tr>
                <td>Pendidikan</td>
                <td width="5">: </td><td><?php echo $t->sekayah;?>
                 </td>
               </tr>
              <tr>
                <td>Masih hidup</td>
                <td width="5">: </td><td><?php echo $t->hdpayah;?>
                 </td>
               </tr>
              <tr>
                <td>Jika tidak, meninggal tahun</td>
                <td width="5">: </td><td><?php echo $t->thnayah;?>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <p align="center"><b>
                  DATA IBU SISWA
                  </b>
                 </td>
              </tr>
              <tr>
                <td>Nama</td>
                <td width="5">: </td><td><?php echo $t->nmibu;?>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td width="5">: </td><td><?php echo $t->alibu;?>
                </td>
              </tr>

              <tr>
                <td>Tempat Lahir</td>
                <td width="5">: </td><td><?php echo $t->tmpibu;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td width="5">: </td><td><?php
			$str = $t->tglibu;	
			$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
			 echo $tanggal;?>
                </td>
              </tr>
              <tr>
                <td>Agama</td>
                <td width="5">: </td><td><?php echo $t->agibu;?>
                </td>
              </tr>
              <tr>
                <td>Kewarganegaraan</td>
                <td width="5">: </td><td><?php echo $t->wnibu;?>
                </td>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <td width="5">: </td><td><?php echo $t->pibu;?>
                 </td>
               </tr>
              <tr>
                <td>Penghasilan</td>
                <td width="5">: </td><td>Rp <?php echo $t->dibu;?>
                </td>
              </tr>
              <tr>
                <td>Pendidikan</td>
                <td width="5">: </td><td><?php echo $t->sekibu;?>
                 </td>
               </tr>
              <tr>
                <td>Masih hidup</td>
                <td width="5">: </td><td><?php echo $t->hdpibu;?>
                 </td>
               </tr>
              <tr>
                <td>Jika tidak, meninggal tahun</td>
                <td width="5">: </td><td><?php echo $t->thnibu;?>
                </td>
              </tr>
		<?php
		$dnmwali = $t->nmwali;
		if (! empty($dnmwali))
		{


		?>
              <tr>
                <td colspan="3">
                  <p align="center"><b>
                  DATA WALI SISWA
                  </b>
                 </td>
              </tr>
              <tr>
                <td>Nama</td>
                <td width="5">: </td><td><?php echo $t->nmwali;?>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td width="5">: </td><td><?php echo $t->awali;?>
                </td>
              </tr>

              <tr>
                <td>Tempat Lahir</td>
                <td width="5">: </td><td><?php echo $t->tmpwali;?>
                </td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td width="5">: </td><td><?php 
		$str = $t->tglwali;	
		$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tanggal;?>
                </td>
              </tr>
              <tr>
                <td>Agama</td>
                <td width="5">: </td><td><?php echo $t->agwali;?>
                </td>
              </tr>
              <tr>
                <td>Kewarganegaraan</td>
                <td width="5">: </td><td><?php echo $t->wnwali;?>
                </td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td width="5">: </td><td><?php echo $t->twali;?>
                </td>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <td width="5">: </td><td><?php echo $t->pwali;?>
                 </td>
               </tr>
              <tr>
                <td>Penghasilan</td>
                <td width="5">: </td><td>Rp <?php echo $t->dwali;?>
                </td>
              </tr>
              <tr>
                <td>Pendidikan</td>
                <td width="5">: </td><td><?php echo $t->sekwali;?>
                 </td>
              </tr>
		<?php
		}
	?>
<tr>
                <td colspan="3">
                  <p align="center"><b>
                  KEGEMARAN SISWA
                  </b>
                 </td>
              </tr>
	      <tr>
                <td>Cita - cita</td>
                <td width="5">: </td><td><?php echo $t->cita_cita;?>
                </td>
              </tr>
	      <tr>
                <td>Hobi utama</td>
                <td width="5">: </td><td><?php echo $t->hobi;?>
                </td>
              </tr>
              <tr>
              <tr>
              <tr>
                <td>Kesenian</td>
                <td width="5">: </td><td><?php echo $t->kesenian;?>
                </td>
              </tr>
              <tr>
                <td>Olahraga</td>
                <td width="5">: </td><td><?php echo $t->olahraga;?>
                </td>
              </tr>

              <tr>
                <td>Organisasi</td>
                <td width="5">: </td><td><?php echo $t->organisasi;?>
                </td>
              </tr>
              <tr>
                <td>Lain - lain</td>
                <td width="5">: </td><td><?php echo $t->lain;?>
                </td>
              </tr>
	      <tr>
                <td colspan="3">
                  <p align="center"><b>
                  PERKEMBANGAN SISWA
                  </b>
                 </td>
              </tr>
              <tr>
                <td>Beasiswa</td>
                <td width="5">: </td><td><?php echo $t->beasiswa;?>
                </td>
              </tr>
              <tr>
                <td>Meninggalkan Madrasah</td>
                <td width="5">: </td><td><?php
		$str = $t->tanggalkeluar;	
		$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		 echo $tanggal;?>
                </td>
              </tr>
</table>
  

<?php
	}
?>
<script type="text/javascript">self.print();</script>
<?php
}
else{
?>
<table width="700" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td colspan='5'>Tidak Ada Data</td></tr></table>
<?php
}
?>

