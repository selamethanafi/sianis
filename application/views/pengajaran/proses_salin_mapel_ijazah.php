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
echo 'Sumber '.$thnajaran.' '.$kelas;
echo '<br>ke</br>';
echo $thnajaranx.' - '.$kelasx;
if((!empty($thnajaran)) and (!empty($kelas)) and (!empty($thnajaranx)) and (!empty($kelasx)))
{
	$ta = $this->db->query("select * from `m_mapel_ijazah` where `thnajaran`='$thnajaran' and `kelas`='$kelas'");
	$adadatamapelrapor = $ta->num_rows();
	if($adadatamapelrapor>0)
	{
		foreach($ta->result() as $a)
		{
			$teks_mapel = $a->teks_mapel;
			$nama_mapel_portal = $a->mapel;
			$no_urut = $a->no_urut;
			$komponen = $a->komponen;
			$tb = $this->db->query("select * from `m_mapel_ijazah` where `thnajaran`='$thnajaranx' and `kelas`='$kelasx' and `teks_mapel`='$teks_mapel' and `mapel`='$nama_mapel_portal'");
			$sudahadamapelrapor = $tb->num_rows();
			if($sudahadamapelrapor == 0)
			{
				$this->db->query("insert into `m_mapel_ijazah` (`thnajaran`, `kelas`,`komponen`,`teks_mapel`,`mapel`,`no_urut`) values ('$thnajaranx','$kelasx','$komponen','$teks_mapel','$nama_mapel_portal','$no_urut')");
			}
			else
			{
				$this->db->query("update `m_mapel_ijazah` set  `no_urut` = '$no_urut', `komponen`='$komponen'  where `thnajaran`='$thnajaranx'  and `kelas`='$kelasx' and `teks_mapel`='$teks_mapel' and `mapel`='$nama_mapel_portal'");
			}
		}
	}
	$tahun1x = substr($thnajaran,0,4);
	$tc = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaranx' and `semester`='2' and `kelas`='$kelasx'");
	$adatc = $tc->num_rows();
	if($adatc == 0)
	{
		$this->db->query("insert into `m_walikelas` (`thnajaran`,`semester`,`kelas`) values ('$thnajaranx','2','$kelasx')");
	}
	$tc = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaranx' and `semester`='2' and `kelas`='$kelasx'");
	foreach($tc->result() as $c)
	{
		$id_kelasx = $c->id_walikelas;
	}
	echo 'Tersalin';
	header('Location: '.base_url().'pengajaran/mapelijazah/tampil/'.$tahun1x.'/'.$id_kelasx);
}
else
{
	header('Location: '.base_url().'pengajaran/mapelijazah');
}
