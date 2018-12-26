<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: detil_siswa.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo '<p><a href="'.base_url().'guru/daftarsiswa/'.$id_walikelas.'"><b>Kembali ke daftar siswa</b></a></p>';
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		if (!empty($t->foto))
			{
			$fotone = ''.base_url().$this->config->item('folderfotosiswa').'/'.$t->foto.'';
			echo '<center><img src="'.$fotone.'" height="200" class="img img-rounded"></center>';
			}

		?>
<table width="100%">
	<tr>
              <td align="center" valign="center" colspan="3" bgcolor="#0033CC">
                <p><font size="2" color="#FFFF00"><b>DATA PRIBADI SISWA</b></font></p>

              </td>
            </tr>
            <tr>
              <td width="300">Nomor Induk Siswa</td>
              <td width="5">:</td><td>
                <?php echo $t->nis;?>
              </td>
            </tr>
            <tr>
              <td>NIS Nasional</td>
              <td>:</td><td>
              <?php echo $t->nisn;?>
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
              <td>Nama</td>
              <td>:</td><td> <?php echo $t->nama;?>
              </td>
            </tr>
            <tr>
              <td>
                 Tempat Lahir
              </td>
              <td>:</td><td>
                <?php echo $t->tmpt;?>
              </td>
            </tr>
            <tr>
              <td>Tanggal lahir</td>
              <td>:</td><td>
		<?php
		$str = $t->tgllhr;	
		$tgllhr = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

		  echo $tgllhr;
		?>
            <tr>
              <td>Agama</td>
              <td>:</td><td>
                <?php echo $t->agama;?>
               </td>
            </tr>
            <tr>
              <td>
                Jenis Kelamin
              </td>
              <td>:</td><td><?php echo $t->jenkel;?>
              </td>
            </tr>
            <tr>
              <td>Kelas</td>
              <td>:</td><td>
                <?php echo $t->kdkls;?>
              </td>
            </tr>
            <tr>
              <td>Kewarganegaraan</td>
              <td>:</td><td>
                <?php echo $t->wn;?>
              </td>
            </tr>
            <tr>
              <td>Anak Yatim-Piatu</td>
              <td>:</td><td>
                <?php echo $t->yatim;?>
              </td>
            </tr>
            <tr>
              <td>Anak ke</td>
              <td>:</td><td>
                <?php echo $t->anakke;?>
              </td>
            </tr>
            <tr>
              <td>Jumlah Saudara Kandung</td>
              <td>:</td><td>
                <?php echo $t->kandung;?>
              </td>
            </tr>
            <tr>
              <td>Jumlah Saudara Tiri</td>
              <td>:</td><td>
               <?php echo $t->tiri;?>
              </td>
            </tr>
            <tr>
              <td>Jumlah Saudara Angkat</td>
              <td>:</td><td>
              <?php echo $t->angkat;?>
              </td>
            </tr>
            <tr>
              <td>Bahasa Sehari-hari</td>
              <td>:</td><td>
               <?php echo $t->bhs;?>
              </td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#0033CC">
                <p align="center"><font size="2" color="#FFFF00"><b>
                TEMPAT TINGGAL
                </b></font>
              </td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td><td> Jalan 
                <?php echo $t->jalan;?>
              </td>
            </tr>
            <tr>
              <td> </td>
              <td>:</td><td> RT
                <?php echo $t->rt;?>
                 RW
                <?php echo $t->rw;?>
                 Dusun 
                <?php echo $t->dusun;?>
              </td>
            </tr>
            <tr>
              <td> </td>
              <td>:</td><td> Desa
                <?php echo $t->desa;?>
                 Kec. 
                <?php echo $t->kec;?>
              </td>
            </tr>
            <tr>
              <td> </td>
              <td>:</td><td> Kab.
                <?php echo $t->kab;?>
                 Prov 
                <?php echo $t->prov;?>
              </td>
            </tr>

           <tr>
              <td>Jarak ke sekolah</td>
              <td>:</td><td>
		<?php echo $t->jarak;?>

              </td>
            </tr>
            <tr>
              <td>Jenis Tempat Tinggal</td>
              <td>:</td><td>
                <?php echo $t->jenrumah;?>
              </td>
            </tr>
            <tr>
              <td>Tinggal dengan</td>
              <td>:</td><td>
              <?php echo $t->tinggal;?>
              </td>
            </tr>
            <tr>
              <td>Jenis Transportasi</td>
              <td>:</td><td>
                <?php echo $t->transportasi;?>
              </td>
            </tr>
            <tr>
              <td>Nomor Telepon Rumah</td>
              <td>:</td><td> 
                <?php echo $t->telepon;?> / HP : <?php echo $t->hp;?>
              </td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#0033CC">
                <p align="center"><font size="2" color="#FFFF00"><b>KESEHATAN
                </b></font></p>
              </td>
            </tr>
            <tr>
              <td>Berat Badan</td>
              <td>:</td><td> 
              <?php echo $t->bb;?> kg
              </td>
            </tr>
            <tr>
              <td>Tinggi Badan</td>
              <td>:</td><td> 
              <?php echo $t->tb;?> cm
              </td>
            </tr>
	    <tr>
              <td>Golongan Darah</td>
              <td>:</td><td>
                <?php echo $t->goldarah;?>
              </td>
            </tr>

            <tr>
              <td>Sakit yang pernah diderita</td>
              <td>:</td><td>
              <?php echo $t->sakit;?>
              </td>
            </tr>
            <tr>
              <td>Kebutuhan Khusus</td>
              <td>:</td><td> 
              <?php echo $t->jasmani;?>
              </td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#0033CC">
                <p align="center"><font size="2" color="#FFFF00"><b>
                SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?>
                </b></font></p>
              </td>
            </tr>
            <tr>
              <td>SLTP / Paket B</td>
              <td>:</td><td> <?php echo $t->sltp;?>
              </td>
            </tr>
            <tr>
              <td>No STTB / Ijazah SLTP / Paket B</td>
              <td>:</td><td>
              	<?php echo $t->nosttb;?>
              </td>
            </tr>
<tr>
              <td>Nomor Peserta UN SLTP</td>
              <td>:</td><td>
		<?php echo $t->skhun;?>
              </td>
            </tr>
            <tr>
              <td>Lama Belajar di SLTP</td>
              <td>:</td><td>
              <?php echo $t->lama;?> Tahun
              </td>
            </tr>

            <tr>
              <td>Tanggal STTB</td>
              <td>:</td><td>
		<?php

		$str = $t->tglsttb;	
		$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

		  echo $tglsttb;
		?>
            <tr>
              <td>Pindahan dari</td>
              <td>:</td><td>
             <?php echo $t->pinsek;?>
              </td>
            </tr>
            <tr>
              <td>Alasan pindah</td>
              <td>:</td><td>
             <?php echo $t->alasan;?>
              </td>
            </tr>
            <tr>
              <td>Diterima di kelas</td>
              <td>:</td><td>
	      	<?php echo $t->kls;?>
              </td>
		</tr>
            <tr>
              <td>Tanggal diterima</td>
              <td>:</td><td>
		<?php
		$str = $t->tglditerima;	
		$tglditerima = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		  echo $tglditerima;
		echo '</td></tr>';
		?>
            <tr>
              <td colspan="3" bgcolor="#0033CC">
                <p align="center"><font size="2" color="#FFFF00"><b>DATA KELUARGA SISWA
                </b></font></p>
              </td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#0033CC">
                <p align="center"><font size="2" color="#FFFFF0"><b>DATA AYAH SISWA
                </b></font></p>
               </td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td><td>
              <?php echo $t->nmayah;?>
              </td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td><td>
             <?php echo $t->alayah;?>
              </td>
            </tr>
            <tr>
              <td>Tempat Lahir</td>
              <td>:</td><td>
             <?php echo $t->tmpayah;?>
              </td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td>:</td><td>
		<?php
		$str = $t->tglayah;	
		$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

		  echo $tglsttb;
		echo '</td></tr>';
		?>
            <tr>
              <td>Agama</td>
              <td>:</td><td>
               <?php echo $t->agayah;?>
              </td>
            </tr>
            <tr>
              <td>Kewarganegaraan</td>
              <td>:</td><td>
              <?php echo $t->wnayah;?>
              </td>
            </tr>
            <tr>
              <td>Telepon</td>
              <td>:</td><td> <?php echo $t->tayah;?>
              </td>
            </tr>

            <tr>
              <td>Pekerjaan</td>
              <td>:</td><td>
                <?php echo $t->payah;?>
              </td>
            </tr>
            <tr>
              <td>Penghasilan</td>
              <td>:</td><td> Rp 
		<?php echo $t->dayah;?>
              </td>
            </tr>
            <tr>
              <td>Pendidikan</td>
              <td>:</td><td>
                <?php echo $t->sekayah;?>
              </td>
            </tr>
            <tr>
              <td>Masih hidup</td>
              <td>:</td><td>
                <?php echo $t->hdpayah;?>
              </td>
            </tr>
            <tr>
              <td>Jika sudah meninggal, meninggal tahun</td>
              <td>:</td><td>
               <?php echo $t->thnayah;?>
              </td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#0033CC">
                <p align="center">
                <font size="2" color="#FFFFF0"><b>DATA IBU SISWA
                </b></font></p>
              </td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td><td>
              <?php echo $t->nmibu;?>
              </td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td><td>
                <?php echo $t->alibu;?>
              </td>
            </tr>
            <tr>
              <td>Tempat Lahir</td>
              <td>:</td><td>
              <?php echo $t->tmpibu;?>
              </td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td>:</td><td>
 		<?php
		$str = $t->tglibu;	
		$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

		  echo $tglsttb;
		echo '</td></tr>';
		?>
           <tr>
              <td>Agama</td>
              <td>:</td><td>
                <?php echo $t->agibu;?>
              </td>
            </tr>
            <tr>
              <td>Kewarganegaraan</td>
              <td>:</td><td>
                <?php echo $t->wnibu;?>
              </td>
            </tr>
            <tr>
              <td>Telepon</td>
              <td>:</td><td><?php echo $t->tibu;?>
              </td>
            </tr>

            <tr>
              <td>Pekerjaan</td>
              <td>:</td><td>
                <?php echo $t->pibu;?>
              </td>
            </tr>
            <tr>
              <td>Penghasilan</td>
              <td>:</td><td> Rp 
              <?php echo $t->dibu;?>
              </td>
            </tr>
            <tr>
              <td>Pendidikan</td>
              <td>:</td><td>
                <?php echo $t->sekibu;?>
              </td>
            </tr>
            <tr>
              <td>Masih hidup</td>
              <td>:</td><td>
               <?php echo $t->hdpibu;?>
              </td>
            </tr>
            <tr>
              <td>Jika sudah meninggal, meninggal tahun</td>
              <td>:</td><td>
              <?php echo $t->thnibu;?>
              </td>
            </tr>
<tr>
              <td>Penghasilan Ayah + penghasilan Ibu </td>
              <td>:</td><td> Rp 
		<?php echo $t->dortu;?>
              </td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#0033CC">
                <p align="center">
                <font size="2" color="#FFFFF0"><b>DATA WALI SISWA
                </b></font></p>
               </td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td><td>
              <?php echo $t->nmwali;?>
              </td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td><td>
             <?php echo $t->awali;?>
              </td>
            </tr>
            <tr>
              <td>Tempat Lahir</td>
              <td>:</td><td>
              <?php echo $t->tmpwali;?>
              </td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td>:</td><td>
              		<?php
		$str = $t->tglwali;	
		$tglsttb = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

		  echo $tglsttb;
		echo '</td></tr>';
		?>

            <tr>
              <td>Agama</td>
              <td>:</td><td>
                <?php echo $t->agwali;?>
              </td>
            </tr>
            <tr>
              <td>Kewarganegaraan</td>
              <td>:</td><td>
                <?php echo $t->wnwali;?>
              </td>
            </tr>
            <tr>
              <td>Telepon</td>
              <td>:</td><td> <?php echo $t->twali;?>
              </td>
            </tr>

            <tr>
              <td>Pekerjaan</td>
              <td>:</td><td>
                <?php echo $t->pwali;?>
              </td>
            </tr>
            <tr>
              <td>Penghasilan</td>
              <td>:</td><td> Rp 
		<?php echo $t->dwali;?>
              </td>
            </tr>
            <tr>
              <td>Pendidikan</td>
              <td>:</td><td>
                <?php echo $t->sekwali;?>
              </td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#0033CC">
                <p align="center">
                <font size="2" color="#FFFF00"><b>KEGEMARAN SISWA
                </b></font></p>
              </td>
            </tr>
<tr>
              <td>Cita - Cita</td>
              <td>:</td><td>
                <?php echo $t->cita_cita;?>
              </td>
            </tr>        
	    <tr>
              <td>Hobi Utama</td>
              <td>:</td><td>
                <?php echo $t->hobi;?>
              </td>
            </tr>    
            <tr>
              <td>Kesenian</td>
              <td>:</td><td> 
             <?php echo $t->kesenian;?>
              </td>
            </tr>
            <tr>
              <td>Olahraga</td>
              <td>:</td><td> 
              <?php echo $t->olahraga;?>
              </td>
            </tr>
	    <tr>
              <td>Organisasi</td>
              <td>:</td><td>
              <?php echo $t->organisasi;?>
              </td>
            </tr>

            <tr>
              <td>Lain - lain</td>
              <td>:</td><td>
             <?php echo $t->lain;?>
              </td>
            </tr>
                <td colspan="3" bgcolor="#0033CC">
                  <p align="center"><b>
                  <font size="2" color="#FFFFF0">PERKEMBANGAN SISWA
                  </b></font>
                 </td>
              </tr>
              <tr>
                <td>Beasiswa</td>
                <td>:</td><td><?php echo $t->beasiswa;?>
                </td>
              </tr>
              <tr>
                <td>Meninggalkan Madrasah</td>
                <td>: </td><td><?php echo $t->tanggalkeluar;?>
                </td>
              </tr>

              <tr>
                <td>Alasan Meninggalkan Madrasah</td>
                <td>:</td><td><?php echo $t->alasankeluar;?>
                </td>
              </tr>
              <tr>
                <td>Pindah ke sekolah lain</td>
                <td>:</td><td><?php echo $t->sekolahtujuan;?>
                </td>
              </tr>
              <tr>
                <td>Nomor Surat</td>
                <td>:</td><td><?php echo $t->nosurat;?>
                </td>
              </tr>

              <tr>
                <td>Tanggal STTB</td>
                <td>: </td><td><?php echo $t->tamatbelajar;?>
                </td>
              </tr>
              <tr>
                <td>Nomor STTB</td>
                <td>:</td><td><?php echo $t->nosttbma;?>
                </td>
              </tr>


		</table>
		<?php
	}
}
else{
echo "Belum Ada Data";
}
?>


</div>

