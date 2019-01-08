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
<div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo base_url();?>guru">Beranda </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Siswa <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>keuangan/siswa">Pencarian Data Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>keuangan/siswakelas">Siswa per kelas</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>keuangan/buatsiswakelas">Daftar Siswa Per Tahun Pelajaran</a></li>	
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>keuangan/kartupembayaran">Kartu Pembayaran</a></li>
				</ul>
			</li>
                	<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Referensi <b class="caret"></b></a>
                        <ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/macam">Macam Pembayaran</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/macampenerimaan">Macam Penerimaan Nonsiswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/set">Besar Pembayaran</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/macampengeluaran">Macam Pengeluaran</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/macamnonkomite">Macam Tunggakan Nonkomite</a></li>

			</ul>
			</li>
                	<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Transaksi <b class="caret"></b></a>
                        <ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/aim">Pembayaran Lewat AIM</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/siswa">Terima Pembayaran</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/massal">Terima Pembayaran Massal</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/massal2">Terima Pembayaran Massal Versi 2</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan2/transaksi/terima">Terima Pembayaran Versi 2</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/penerimaanlain">Penerimaan / Pengembalian</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/pembayaran">Rekapitulasi Pembayaran Harian</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/keluar">Pengeluaran</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/pengeluaran">Rekapitulasi Pengeluaran</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/entrypenerimaan">Penerimaan</a></li>

			</ul>
			</li>
                	<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Laporan <b class="caret"></b></a>
                        <ul class="dropdown-menu">
				<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/penerimaan">Rekapitulasi Penerimaan Pembayaran Siswa</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/kekurangansiswa">Kekurangan Pembayaran Siswa</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/kekurangansiswaperkelas">Kekurangan Pembayaran Siswa per kelas</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>keuangan/kas">Kas Dana Operasional Syahriyah / DPM</a></li>
			</ul>
			</li>
		</ul>
      <ul class="nav navbar-nav ml-auto">
        <li><a href="<?php echo base_url();?>login/logout" data-confirm="Yakin hendak keluar?"> Keluar <span class="fa fa-sign-out-alt"></span></a></li>
      </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
</div>
