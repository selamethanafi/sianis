<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: siswa.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sen 16 Mei 2016 10:19:00 WIB 
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
<?php
$ta = $this->db->query("select `nis`,`nama`,`agama`,`jenkel`,`foto`,`ket` from `datsis` where `nis`='$nis'");
if($ta->num_rows()>0)
{
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$namakepala = cari_kepala($thnajaran,$semester);
	$nipkepala = cari_nip_kepala($thnajaran,$semester);

	foreach($ta->result() as $a)
	{
		$namasiswa = $a->nama;
		$agama = $a->agama;
		$jenkel = $a->jenkel;
	}
	$kelas = '';
	$tb = $this->db->query("select * from `siswa_kelas` where `nis` = '$nis' order by `thnajaran` DESC limit 0,1");
	foreach($tb->result() as $b)
	{
		$kelas = $b->kelas.' '.$b->thnajaran;
	}

	?>
	<br />
<h3 class="text-center">Layanan Konseling Individu</h3>
<?php
	$query = $this->db->query("select * from `bk_individu` where `id_bk_individu`='$id_bk_individu'");
	if($query->num_rows() == 0)
	{
		echo 'data tidak ditemukan';
	}
	else
	{
		foreach($query->result() as $c)
		$username = $c->username;
		$konselor = '';
		$te = $this->db->query("select * from `tbllogin` where `username`='$username'");
		foreach($te->result() as $e)
		{
			$konselor = $e->nama;
		}

		?>
		<table width="100%">
			<tr><td width="20%">Nama</td><td>: <?php echo $namasiswa;?></td><td width="15%">Jenis Kelamin</td><td width="20%">: <?php echo $jenkel;?></td></tr>
			<tr><td>Kelas Terakhir</td><td>: <?php echo $kelas;?></td><td>Agama</td><td>: <?php echo $agama;?></td></tr>
			<tr><td>Tanggal</td><td>: <?php echo tanggal($c->tanggal);?></td><td></td></tr>
		</table><br /><br />
		<table class="table table-bordered">
		<tr><td><div class="col-sm-2"><strong>Masalah</strong></div><div class="col-sm-10">: <?php echo $c->masalah;?></div></tr>
		<tr><td><div class="col-sm-2"><strong>Diagonis</strong></div><div class="col-sm-10">: <?php echo $c->diagnosis;?></div></tr>
		<tr><td><div class="col-sm-2"><strong>Prognosis</strong></div><div class="col-sm-10">: <?php echo $c->pronosis;?></div></tr>
		<tr><td><div class="col-sm-2"><strong>Tujuan Konseling</strong></div><div class="col-sm-10">: <?php echo $c->tujuan;?></div></tr>
		<tr><td><div class="col-sm-2"><strong>Layanan Konseling</strong><br /><strong>Pendekatan</strong></div><div class="col-sm-10"><br />: <?php echo $c->pendekatan;?></div></tr>
		<tr>
			<td>
				<div class="col-sm-12"><strong>Langkah Konseling</strong></div>
				<div class="col-sm-2"><p>Tahap Awal</p></div>
				<div class="col-sm-10"><p>: <?php echo $c->tahap_awal;?></p></div>
				<div class="col-sm-2"><p>Tahap Pertengahan</p></div>
				<div class="col-sm-10"><p>: <?php echo $c->akhir;?></p></div>
				<div class="col-sm-2"><p>Tahap Akhir</p></div>
				<div class="col-sm-10"><p>: <?php echo $c->akhir;?></p></div>



			</td>
		</tr>
		<tr><td><div class="col-sm-3"><strong>Hasil yang ingin dicapai</strong></div><div class="col-sm-9"><?php echo $c->hasil;?></div></td></tr>
		<tr><td><div class="col-sm-3"><strong>Rencana Tindak Lanjut</strong></div><div class="col-sm-9"><?php echo $c->hasil;?></div></td></tr>

		</table>
		<br />
		<div class="col-sm-1"></div>
		<div class="col-sm-4">Mengetahui,</div><div class="col-sm-3"></div><div class="col-sm-4"><?php echo $this->config->item('lokasi').', '.date_to_long_string($c->tanggal);?></div>
		<div class="col-sm-1"></div>
		<div class="col-sm-4">Kepala,</div><div class="col-sm-3"></div><div class="col-sm-4">Guru BK,</div>
<br /><br /><br /><br /><br />
		<div class="col-sm-1"></div>
		<div class="col-sm-4"><?php echo $namakepala;?></div><div class="col-sm-3"></div><div class="col-sm-4"><?php echo $konselor;?></div>
<div class="col-sm-1"></div>
		<div class="col-sm-4"><?php echo 'NIP '.$nipkepala;?></div><div class="col-sm-3"></div><div class="col-sm-4"></div>
<?php
	}
}
else
{
	echo '<div class="alert alert-info">Siswa tidak ditemukan, <a href="'.base_url().'bp/carisiswa" class="btn btn-primary">cari siswa lain?</a></div>';
}
?>
</div>
