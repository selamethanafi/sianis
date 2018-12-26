<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: sertifikasi.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<a href="<?php echo base_url();?>perangkat/tambahan"><b>Proses SKBK / SKMT</b></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>perangkat/tambahanluar"><b>Tugas Tambahan di Madrasah Lain</b></a>
<?php
$tpeg = $this->db->query("select * from p_pegawai where kodeguru='$kode_guru'");
foreach($tpeg->result_array() as $do)
{
echo '
	<table class="table table-stripe table-bordered">
	<tr><td colspan="2"><strong>Identitas Pegawai</strong></td></tr>
	<tr><td>NRG</td><td>'.$do['nrg'].'</td></tr>
	<tr><td>No Peserta Sertifikasi</td><td>'.$do['no_peserta_sertifikasi'].'</td></tr>
	<tr><td>No Sertifikat</td><td>'.$do['no_sertifikat'].'</td></tr>
	<tr><td>Tanggal Lulus Sertifikasi</td><td>'.date_to_long_string($do['tgl_lulus_sertifikasi']).'</td></tr>
	</table>';
}
?>
<div class="table-responsive"><table class="table table-stripe table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>JTM</strong></td><td><strong>Tugas Tambahan</strong></td><td><strong>JTM</strong></td><td><strong>Tugas Tambahan di Sekolah Lain</strong></td><td><strong>JTM</strong></td><td><strong>JTM Kumulatif</strong></td><td><strong>Pangkat, Golongan, Jabatan</strong></td></tr>
<?php
$tmapelskbk = $this->db->query("select * from m_mapel_skbk where kodeguru='$kode_guru' order by thnajaran DESC, semester DESC");
$nomor=1;
foreach($tmapelskbk->result() as $dp)
{
	//hapus dulu
	$thnajaran = $dp->thnajaran;
	$semester = $dp->semester;
	// cari mapel
	$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kode_guru' order by mapel ASC");
	$jtm = 0;
	foreach ($tmapel->result() as $dmapel)
	{
		$mapelguru = $dmapel->mapel;
		$jtm = $jtm + $dmapel->jam;

	}
	// cari tambahan
	$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kode_guru'");
	$tambahan = '';
	$jtmtambahan = '';
	$id_sk = '';
	foreach ($ttambahan->result() as $dtambahan)
		{
		$tambahan = $dtambahan->nama_tugas;
		$jtmtambahan = $dtambahan->jtm;
		$id_sk = $dtambahan->id_sk;

		}
	$golongan = id_sk_jadi_golongan($id_sk);
	$pangkat = golongan_jadi_pangkat($golongan);
	$jabatan = golongan_jadi_jabatan($golongan);

	// cari tambahan di sekolah lain
	$ttambahanluar = $this->db->query("select * from p_tugas_tambahan_luar where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kode_guru'");
	$tambahanluar = '';
	$jtmtambahanluar = '';
	$namasekolah = '';
	foreach($ttambahanluar->result() as $dtambahanluar)
		{
			$tambahanluar = $dtambahanluar->nama_tugas;
			$jtmtambahanluar = $dtambahanluar->jtm;
			$namasekolah = $dtambahanluar->nama_sekolah;
		}
	$jtmk = $jtm + $jtmtambahan + $jtmtambahanluar;
	
echo "<tr><td align='center'>".$nomor."</td><td align='center'>".$thnajaran."</td><td align='center'>".$semester."</td><td>".$dp->mapel."</td><td align='center'>".$jtm."</td><td>".$tambahan."</td><td>".$jtmtambahan."</td><td>";
	if ($jtmtambahanluar>0)
		{echo ''.$tambahanluar.' di '.$namasekolah.'';
		}
	echo "</td><td align='center'>".$jtmtambahanluar."</td><td align='center'>".$jtmk."</td><td>".$pangkat.", ".$golongan.", ".$jabatan."</td></tr>";
	$nomor++;	
}

?>
</table></div>
<div class="clear padding20"></div>
</div>
