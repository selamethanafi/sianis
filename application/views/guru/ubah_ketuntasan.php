<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: lck.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
foreach($tmapel->result() as $dtmapel)
{
	$kelas =$dtmapel->kelas;
	$thnajaran = $dtmapel->thnajaran;
	$semester = $dtmapel->semester;
	$mapel = $dtmapel->mapel;
	$kkm = $dtmapel->kkm;
	$ranah = $dtmapel->ranah;
}
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
$tingkat = kelas_jadi_tingkat($kelas);
if($kurikulum == '2013')
{
	$ranah = 'KPA';
}
if($kurikulum == '2015')
{
	$ranah = 'KP';
}
$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
foreach($query->result() as $t)
{
	$ket_akhir = 'Sudah kompeten';
	$ket = 'Sudah kompeten';
	$nis = $t->nis;
	if ($ranah == 'KP') 
	{
		if ($t->kog < $kkm)
		{
			$ket_akhir = 'Belum kompeten';
		}
		if ($t->psi < $kkm)
		{
			$ket_akhir = 'Belum kompeten';
		}
	}
	if($ranah == 'KPA')
	{
		if ($t->kog < $kkm)
		{
			$ket_akhir = 'Belum kompeten';
		}
		if ($t->psi < $kkm)
		{
			$ket_akhir = 'Belum kompeten';
		}

	}
	if ($ranah == 'KA') 
	{
		if ($t->kog < $kkm)
		{
			$ket_akhir = 'Belum kompeten';
		}
	}
	if ($ranah == 'PA')
	{
		if ($t->psi < $kkm)
		{
			$ket_akhir = 'Belum kompeten';
		}
	}
	if(($ranah == 'KPA') or ($ranah == 'PA') or ($ranah == 'KA'))
	{
		if (($t->afektif !='A')  and ($t->afektif!='B') and ($t->afektif !='SB'))
		{
			$ket_akhir = 'Belum kompeten';
		}
	}
	$this->db->query("update `nilai` set `ket_akhir`='$ket_akhir' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
}
header('Location: '.base_url().'guru/lck2/'.$id_mapel);
?>
</div></div></div>
