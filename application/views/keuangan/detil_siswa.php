<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : bg_menu.php
// Lokasi      : application/views/keuangan
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
<div class="container-fluid"><h3>Data Siswa - <?php echo $this->config->item('nama_web');?></h3>
<a href="<?php echo base_url(); ?>index.php/keuangan/siswa"><b> Siswa Lain</b></a>
<table width="100%">
<?php
$warna1="#C8E862";
$warna2="#D6F3FF";
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	?>
    <tr bgcolor="<?php echo $warna2;?>">
                <td colspan="3" bgcolor="#0033CC" align="center">
                 <font size="2" color="#FFFF00"><b>DATA PRIBADI SISWA </b></font>
                </td>
    </tr>
    <tr>
                <td width="22%">Nomor Peserta UN SLTP</td>
                <td width="76%" colspan="2">: <?php echo $t->skhun;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Nomor Induk Siswa</td>
                <td width="76%" colspan="2">: <?php echo $t->nis;?>
                </td>
    </tr>
   <tr>
                <td width="22%">NIS Nasional</td>
                <td width="76%" colspan="2">: <?php echo $t->nisn;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Password</td>
                <td width="76%" colspan="2">: <?php echo $t->sandi;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Nama
                </td>
                <td colspan="2">: <?php echo $t->nama;?>
		<?php
		if ($t->ijazah<>'Ya')
			{echo '<strong><font color="#FF0000">NAMA BELUM SESUAI IJAZAH!</strong>';}
		?>
                </td>
              </tr>
              <tr>
                <td width="22%">
                  Tempat Lahir
                </td>
                <td width="76%" colspan="2">: <?php echo $t->tmpt;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Tanggal lahir</td>
                <td width="76%" colspan="2">: <?php echo $t->tgllhr;?>
              </tr>
              <tr>
                <td width="22%">Agama</td>
                <td width="76%" colspan="2">: <?php echo $t->agama;?>
                </td>
              </tr>
              <tr>
                <td width="22%">
                  Jenis Kelamin
                </td>
                <td width="76%" colspan="2">
                  : <?php echo $t->jenkel;?>
                </td>
              </tr>

              <tr>
                <td width="22%">Kelas</td>
                <td width="76%" colspan="2">: <?php echo $t->kdkls;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Kewarganegaraan</td>
                <td width="76%" colspan="2">: <?php echo $t->wn;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Anak Yatim-Piatu</td>
                <td width="76%" colspan="2">: <?php echo $t->yatim;?>
                </td>
              </tr>

              <tr>
                <td width="22%">Anak ke</td>
                <td width="76%" colspan="2">: <?php echo $t->anakke;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Jumlah Saudara Kandung</td>
                <td width="76%" colspan="2">: <?php echo $t->kandung;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Jumlah Saudara Tiri</td>
                <td width="76%" colspan="2">: <?php echo $t->tiri;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Jumlah Saudara Angkat</td>
                <td width="76%" colspan="2">: <?php echo $t->angkat;?>
                </td>
              </tr>
              <tr>
                <td width="22%">Bahasa Sehari-hari</td>
                <td width="76%" colspan="2">: <?php echo $t->bhs;?>
                </td>
              </tr>
              <tr>
              <tr>
                <td colspan="3" bgcolor="#0033CC"  align="center">
                  <font size="2" color="#FFFF00"><b>TEMPAT TINGGAL</b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Alamat </font></td>
                <td width="76%" colspan="2"><font size="2">: Jalan <?php echo $t->jalan;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2"> </font></td>
                <td width="76%" colspan="2"><font size="2">: RT <?php echo $t->rt;?> RW <?php echo $t->rw;?> Dusun <?php echo $t->dusun;?> </font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2"> </font></td>
                <td width="76%" colspan="2"><font size="2">: Desa <?php echo $t->desa;?> Kec. <?php echo $t->kec;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2"> </font></td>
                <td width="76%" colspan="2"><font size="2">: Kab. <?php echo $t->kab;?> Prov. <?php echo $t->prov;?></font>
                </td>
              </tr>
	      <tr>
                <td width="22%"><font size="2"> </font></td>
                <td width="76%" colspan="2"><font size="2">:<b> <?php echo $t->alamat;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Jarak ke sekolah</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->jarak;?> km</font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Jenis Tempat Tinggal</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->jenrumah;?>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Tinggal dengan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tinggal;?></font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Jenis Transportasi</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->transportasi;?></font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Nomor Telepon</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->telepon;?> / HP : <?php echo $t->hp;?></font>
                </td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFF00"><b>KESEHATAN</b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Berat Badan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->bb;?> kg</font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Tinggi Badan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tb;?> cm</font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Golongan Darah</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->goldarah;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Sakit yang pernah diderita</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->sakit;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Kebutuhan Jasmani</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->jasmani;?></font>
                </td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFF00"><b>SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?></b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">SLTP</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->sltp;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">No STTB SLTP</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->nosttb;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">No Peserta UN SLTP</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->skhun;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Tanggal STTB</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tglsttb;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Lama Belajar di SLTP</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->lama;?> Tahun</font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Pindahan dari</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->pinsek;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Alasan pindah</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->alasan;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Diterima di kelas</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->kls;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Tanggal di terima</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tglditerima;?></font>
                </td>
              </tr>

              <tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFF00"><b>DATA KELUARGA SISWA</b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFFF0"><b>DATA AYAH SISWA</b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Nama</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->nmayah;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Alamat</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->alayah;?></font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Tempat Lahir</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tmpayah;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Tanggal Lahir</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tglayah;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Agama</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->agayah;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Kewarganegaraan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->wnayah;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Pekerjaan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->payah;?></font>
                 </td>
               </tr>
              <tr>
                <td width="22%"><font size="2">Penghasilan</font></td>
                <td width="76%" colspan="2"><font size="2">: Rp <?php echo $t->dayah;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Pendidikan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->sekayah;?></font>
                 </td>
               </tr>
              <tr>
                <td width="22%"><font size="2">Masih hidup</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->hdpayah;?></font>
                 </td>
               </tr>
              <tr>
                <td width="22%"><font size="2">Jika tidak, meninggal tahun</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->thnayah;?></font>
                </td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFFF0"><b>DATA IBU SISWA</b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Nama</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->nmibu;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Alamat</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->alibu;?></font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Tempat Lahir</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tmpibu;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Tanggal Lahir</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tglibu;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Agama</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->agibu;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Kewarganegaraan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->wnibu;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Pekerjaan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->pibu;?></font>
                 </td>
               </tr>
              <tr>
                <td width="22%"><font size="2">Penghasilan</font></td>
                <td width="76%" colspan="2"><font size="2">: Rp <?php echo $t->dibu;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Pendidikan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->sekibu;?></font>
                 </td>
               </tr>
              <tr>
                <td width="22%"><font size="2">Masih hidup</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->hdpibu;?></font>
                 </td>
               </tr>
              <tr>
                <td width="22%"><font size="2">Jika tidak, meninggal tahun</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->thnibu;?></font>
                </td>
              </tr>
		<?php
		$dnmwali = $t->nmwali;
		if (! empty($dnmwali))
		{


		?>
              <tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFFF0"><b>DATA WALI SISWA</b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Nama</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->nmwali;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Alamat</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->awali;?></font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Tempat Lahir</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tmpwali;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Tanggal Lahir</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tglwali;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Agama</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->agwali;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Kewarganegaraan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->wnwali;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Telepon</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->twali;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Pekerjaan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->pwali;?></font>
                 </td>
               </tr>
              <tr>
                <td width="22%"><font size="2">Penghasilan</font></td>
                <td width="76%" colspan="2"><font size="2">: Rp <?php echo $t->dwali;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Pendidikan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->sekwali;?></font>
                 </td>
              </tr>
		<?php
		}
	?>
<tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFFF0"><b>KEGEMARAN SISWA</b>
                  </font>
                 </td>
              </tr>
	      <tr>
                <td width="22%"><font size="2">Cita - cita</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->cita_cita;?></font>
                </td>
              </tr>
	      <tr>
                <td width="22%"><font size="2">Hobi utama</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->hobi;?></font>
                </td>
              </tr>
              <tr>
              <tr>
              <tr>
                <td width="22%"><font size="2">Kesenian</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->kesenian;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Olahraga</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->olahraga;?></font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Organisasi</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->organisasi;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Lain - lain</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->lain;?></font>
                </td>
              </tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFFF0"><b>PERKEMBANGAN SISWA</b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Beasiswa</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->beasiswa;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Meninggalkan Madrasah</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tanggalkeluar;?></font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Alasan Meninggalkan Madrasah</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->alasankeluar;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Tanggal STTB</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tamatbelajar;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Nomor STTB</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->nosttbma;?></font>
                </td>
              </tr>
                <td colspan="3" bgcolor="#0033CC" align="center">
                  <font size="2" color="#FFFFF0"><b>INFORMASI SETELAH SELESAI SEKOLAH</b>
                  </font>
                 </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Melanjutkan di</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->melanjutkan;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Mulai bekerja</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->tanggalbekerja;?></font>
                </td>
              </tr>

              <tr>
                <td width="22%"><font size="2">Bekerja di</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->namaperusahaan;?></font>
                </td>
              </tr>
              <tr>
                <td width="22%"><font size="2">Penghasilan</font></td>
                <td width="76%" colspan="2"><font size="2">: <?php echo $t->penghasilan;?></font>
                </td>
              </tr>
	</table>
<?php
	}
}
?>
<div class="clear padding40"></div>
</div>

