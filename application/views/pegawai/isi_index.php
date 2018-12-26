<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : isi_index.php
// Lokasi      : application/views/guru
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container">
<?php
$tahun = date("Y");
// cek pns / cpns
$ta = $this->db->query("select * from `p_pegawai` where `kd`='$nim'");
$nip = '';
$pns = 'NonPNS';
foreach($ta->result() as $a)
{
	$nip = $a->nip;
	$pns = $a->status_kepegawaian;
}
if(($pns == 'PNS') or ($pns == 'CPNS'))
{
	//cek skp
	$tb = $this->db->query("select * from `skp_skor_guru` where `nip`='$nip' and `tahun`='$tahun'");
	if($tb->num_rows()>0)
	{
		$tc = $this->db->query("select * from `ppk_pns` where `kode`='$nip' and `tahun`='$tahun'");
		$permanen = '';
		foreach($tc->result() as $c)
		{
			$permanen = $c->permanen;
		}
		if($permanen != 1)
		{
			echo '<div class="alert alert-danger">SKP tahun '.$tahun.' belum dipermanenkan</div>';
		}
	}
	else
	{
		echo '<div class="alert alert-danger">SKP tahun '.$tahun.' belum dibuat</div>';
	}
}
?>
<div class="panel panel-default">
	<div class="panel-heading"><h3>Selamat Datang di Control Panel Guru</h3>Assalamu alaikum wr.wb., <b><?php echo $nama; ?></b></h3></div>
	<div class="panel-body">
<ul>
<li><b>Beranda</b>- Tampilan utama Control Panel</li>
<li><b>Portal</b>- Menulis <b>berita</b>, <b>pengumuman</b>, <b>Materi Pelajaran</b> di situs <?php echo $this->config->item('nama_web');?></li>
<li><b>Akademik</b>- Mengolah nilai, rapor, walikelas, ekstrakurikuler </li>
<li><b>Pribadi</b>- Mengolah data pribadi, riwayat pendidikan, riwayat kepegawaian, dp3
<li><b>Upload</b>- Upload file-file seperti materi, e-book, tugas, dan lainnya</li>
<li><b>Log Out</b>- Keluar dari control panel dan akhiri login</li>
</ul>
<p>
Pilih tampilan klik di <a href="<?php echo base_url();?>guru/csstema">sini</a>
</p>
</div></div></div>
