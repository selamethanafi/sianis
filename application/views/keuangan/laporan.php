<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: laporan.php
// Lokasi      		: application/views/keuangan
// Terakhir diperbarui	: Rab 01 Jul 2015 11:34:03 WIB 
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
<div id="bg-isi"><h2>Laporan Pembayaran - <?php echo $this->config->item('nama_web');?></h2><br>

<ul>
<li class="li-class"><a href="<?php echo base_url();?>index.php/keuangan/kekurangansiswa"><b>Kekurangan Pembayaran Siswa</b></a><br></li>
<li class="li-class"><a href="<?php echo base_url();?>index.php/keuangan/kekurangansiswaperkelas"><b>Kekurangan Pembayaran Siswa per kelas</b></a><br></li>
<li class="li-class"><a href="<?php echo base_url();?>index.php/keuangan/kekurangansiswaperkelaspertahun"><b>Kekurangan Pembayaran Siswa per kelas per Tahun (Tanpa Tunggakan)</b></a><br></li>
</ul>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
</div>
<?php
/*
<li class="li-class"><a href="<?php echo base_url();?>index.php/keuangan/daftarpembayaran"><b>Daftar Pembayaran Siswa</b><br></a></li>
<li class="li-class"><a href="<?php echo base_url();?>index.php/keuangan/rekapkekurangan"><b>Rekapitulasi Kekurangan Pembayaran Siswa per Kelas</b></a><br></li>
<li class="li-class"><a href="<?php echo base_url();?>index.php/keuangan/siswakurang"><b>Kekurangan Pembayaran Siswa</b><br></a></li>
<li class="li-class"><a href="<?php echo base_url();?>index.php/keuangan/rekapkekurangansemuasiswa"><b>Kekurangan Pembayaran Semua Siswa</b><br></a></li>
*/
?>
