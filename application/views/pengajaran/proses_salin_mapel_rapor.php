<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: proses_salin_mapel_rapor.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
echo 'Sumber '.$thnajaran.' - '.$semester.' '.$kelas;
echo '<br>ke</br>';
echo $thnajaranx.' - '.$semesterx.' '.$kelasx;
if((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)) and (!empty($thnajaranx)) and (!empty($semesterx)) and (!empty($kelasx)))
{
	$ta = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
	$adadatamapelrapor = $ta->num_rows();
	if($adadatamapelrapor>0)
	{
		foreach($ta->result() as $a)
		{
			$nama_mapel = $a->nama_mapel;
			$nama_mapel_portal = $a->nama_mapel_portal;
			$no_urut = $a->no_urut;
			$pilihan = $a->pilihan;
			$komponen = $a->komponen;
			$tb = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaranx' and `semester`='$semesterx' and `kelas`='$kelasx' and `nama_mapel`='$nama_mapel' and `nama_mapel_portal`='$nama_mapel_portal'");
			$sudahadamapelrapor = $tb->num_rows();
			if($sudahadamapelrapor == 0)
			{
				$this->db->query("insert into `m_mapel_rapor` (`thnajaran`,`semester`,`kelas`,`komponen`,`nama_mapel`,`nama_mapel_portal`,`no_urut`,`pilihan`) values ('$thnajaranx','$semesterx','$kelasx','$komponen','$nama_mapel','$nama_mapel_portal','$no_urut','$pilihan')");
			}
			else
			{
				$this->db->query("update `m_mapel_rapor` set  `no_urut` = '$no_urut', `komponen`='$komponen', `pilihan` = '$pilihan'  where `thnajaran`='$thnajaranx' and `semester`='$semesterx' and `kelas`='$kelasx' and `nama_mapel`='$nama_mapel' and `nama_mapel_portal`='$nama_mapel_portal'");
			}
		}
	}
	$tahun1x = substr($thnajaran,0,4);
	$tc = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaranx' and `semester`='$semesterx' and `kelas`='$kelasx'");
	$adatc = $tc->num_rows();
	if($adatc == 0)
	{
		$this->db->query("insert into `m_walikelas` (`thnajaran`,`semester`,`kelas`) values ('$thnajaranx','$semesterx','$kelasx')");
	}
	$tc = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaranx' and `semester`='$semesterx' and `kelas`='$kelasx'");
	foreach($tc->result() as $c)
	{
		$id_kelasx = $c->id_walikelas;
	}
	echo 'Tersalin';
	header('Location: '.base_url().'pengajaran/mapelrapor/tampil/'.$tahun1x.'/'.$semesterx.'/'.$id_kelasx);
}
else
{
	header('Location: '.base_url().'pengajaran/mapelrapor');
}
