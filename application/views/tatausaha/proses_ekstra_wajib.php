<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: proses_ekstra_wajib.php
// Lokasi      		: application/views/tatausaha
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2>Modul Peserta Ekstrakurikuler Wajib</h2>
<?php
//ubah status ke T
//$this->db->query("update ekstrakurikuler set status='T' where thnajaran='$thnajaran' and semester='$semester'");

//tabel m_ekstra_wajib
$tm_ekstra_wajib = $this->db->query("select * from `m_pengampu_ekstra` where thnajaran='$thnajaran' and semester='$semester' and `wajib`='1'");
foreach ($tm_ekstra_wajib->result() as $dm_ekstra_wajib)
{
	$namaekstra = $dm_ekstra_wajib->namaekstra;
	$kelas = $dm_ekstra_wajib->kelas;
	//cari daftar siswa kelas
	$tsiswa_kelas = $this->db->query("select * from `siswa_kelas` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y'");
	foreach($tsiswa_kelas->result() as $dsiswa_kelas)
	{
			$nis = $dsiswa_kelas->nis;
			$tsisek = $this->db->query("select * from ekstrakurikuler where nis='$nis' and thnajaran='$thnajaran' and semester='$semester' and nama_ekstra='$namaekstra'");
			$ada = $tsisek->num_rows();
			if ($ada == 0)
				{
				$this->db->query("insert into ekstrakurikuler (`thnajaran`,`semester`,`kelas`,`nis`,`nama_ekstra`) values ('$thnajaran','$semester','$kelas','$nis','$namaekstra')");
				}
				else
				{
				$this->db->query("update ekstrakurikuler set status='Y' where nis='$nis' and thnajaran='$thnajaran' and semester='$semester' and nama_ekstra='$namaekstra'");
				}
	}
}
?>
<div class="alert alert-success">Selesai</div>

</div>
