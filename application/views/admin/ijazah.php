<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: siswa.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Jum 20 Mei 2016 20:02:58 WIB 
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='2016/2017' and `semester`='1' and `kelas` like 'X-%' order by `nis`");
foreach($query->result() as $b)
{
	$nis = $b->nis;
	$ta = $this->db->query("select `nis`,`nosttb`,`tglsttb`, `skhun` from `datsis` where `nis`='$nis'");
	foreach($ta->result() as $a)
	{
		$tahunsttb = substr($a->tglsttb,0,4);
		$nosttb = $a->nosttb;
		$skhun = $a->skhun;
		if((substr($nosttb,0,9) != 'DN-03 DI/') and ($tahunsttb == '2016'))
		{	
			if((substr($skhun,0,14) == '2-16-03-30-036') or (substr($skhun,0,14) == '2-16-03-30-035'))
			{
				$nosttb = preg_replace("/DN-03 DI/","DN-03 DI/13", $nosttb);
			}
			else
			{
				$nosttb = preg_replace("/DN-03 DI/","DN-03 DI/06", $nosttb);
			}

			$this->db->query("update `datsis` set `nosttb`='$nosttb' where `nis`='$nis'");		
		}


	}
	
}
?>
<div class="table-responsive"><table class="table table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td width="300"><strong>NIS</strong></td><td width="460"><strong>Nama</strong></td><td><strong>Nomor Ijazah</strong></td></tr>
<?php
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='2016/2017' and `semester`='1' and `kelas` like 'X-%' order by `nis`");
$nomor=1;
foreach($query->result() as $b)
{
	$nis = $b->nis;
	$ta = $this->db->query("select `nis`,`nosttb`,`tglsttb` from `datsis` where `nis`='$nis'");
	foreach($ta->result() as $a)
	{
		$nosttb = $a->nosttb;
	}
	echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".nis_ke_nama($nis)."</td><td align=\"center\">".$nosttb."</td></tr>";
	$nomor++;
}
?>
</table></div>

</div></div></div>
