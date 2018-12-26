<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 20:39:51 WIB 
// Nama Berkas 		: nisn.php
// Lokasi      		: application/views/bp/
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
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php
$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and status='Y' and kelas like 'XII-%' and `semester`='$semester' order by no_urut ");
?>
<div class="table-responsive">
<table class="table table-hover table-bordered">
<tr align="center"><td width="50"><strong>No.</strong></td><td width="50"><strong>NIS</strong></td><td width="200"><strong>Nama</strong></td><td><strong>NISN</strong></td><td><strong>NISN SNMPTN</strong></td><td><strong>Ubah</strong></td></tr>
<?php
$nomor=1;
foreach($ta->result() as $a)
{
		$nis = $a->nis;
		$nama = nis_ke_nama($a->nis);
		$nisn = '';
		$nisn2 = '';
		$tb = $this->db->query("select * from datsis where nis='$nis'");
		foreach($tb->result() as $b)
		{
			$nisn = $b->nisn;
			$nisn2 = $b->nisn_snmptn;
		}
/*
		if (empty($nisn))
			{
			$nisne = $nis.'000000';
			$this ->db->query("update datsis set nisn_snmptn='$nisne' where nis='$nis'");
			}
			else
			{
			$this ->db->query("update datsis set nisn_snmptn='$nisn' where nis='$nis'");
			}
*/
echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$nis."</td><td>".$nama."</td><td align=\"center\">".$nisn."</td><td align=\"center\">".$nisn2."</td><td <td align=\"center\"><a href='".base_url()."bp/editnisnsnmptn/".$b->nis."' title='Ubah NISN Untuk SNMPTN'><span class=\"fa fa-edit\"></span></a></td></tr>";
$nomor++;
}
?>
</table></div>
</div>
