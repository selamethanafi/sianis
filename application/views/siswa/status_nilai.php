<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: status_nilai.php
// Lokasi      		: application/views/siswa/
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<div class="alert alert-info">Hubungi guru mapel, kalau ada yang hendak ditanyakan</div>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>Tahun</strong></td><td><strong>Semester</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong><td><strong>KKM</strong></td><td><strong>Kognitif</strong></td><td><strong>Psikomotor</strong></td><td><strong>Afektif</strong></td><td><strong>Status</strong></td></tr>
<?php
$query = $this->db->query("select * from nilai where nis='$nim' order by thnajaran ASC, semester ASC, mapel ASC");
$nomor=1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
		//cari kkm
		$thnajarane = $t->thnajaran;
		$semestere = $t->semester;
		$kelase = $t->kelas;	
		$mapel = $t->mapel;
		$tc = $this->db->query("select * from m_mapel where mapel='$mapel' and thnajaran='$thnajarane' and semester='$semestere' and kelas='$kelase'");
		$kkm = 0;
		$ranah = '';
		$status = '<strong>Remidi</strong>';
		$kog = 0;
		$psi = 1;
		$afe = 0;
		foreach($tc->result() as $c)
		{
			$kkm = $c->kkm;
			$ranah = $c->ranah;
		}
		if ($kkm > 0)
		{
		if ($ranah == 'KPA')
			{
			if ($t->kog<$kkm)
				{
				$kog = 0;
				}
				else
				{
				$kog = 1;
				}
			if ($t->psi<$kkm)
				{
				$psi = 0;
				}
				else
				{
				$psi = 1;
				}

			}
		if ($ranah == 'KP')
			{
			if ($t->kog<$kkm)
				{
				$kog = 0;
				}
				else
				{
				$kog = 1;
				}
			if ($t->psi<$kkm)
				{
				$psi = 0;
				}
				else
				{
				$psi = 1;
				}
			$afe = '1';
			}

		if ($ranah == 'KA')
			{
			$psi = 1;
			if ($t->kog<$kkm)
				{
				$kog = 0;
				}
				else
				{
				$kog = 1;
				}

			}
		if ($ranah == 'PA')
			{
			$kog = 1;
			if ($t->psi<$kkm)
				{
				$psi = 0;
				}
				else
				{
				$psi = 1;
				}

			}
		if(($ranah == 'KPA') or ($ranah == 'KA') or ($ranah == 'PA'))
		{
			if (($t->afektif=='A') or ($t->afektif=='B') or ($t->afektif=='AB') or ($t->afektif=='SB'))
				{
				$afe = 1;
				}
				else
				{
				$afe = 0;
				}
		}
		else
		{
			$afe = 1;
		}
		if (($kog==1) and ($psi==1) and ($afe==1))
			{
			$status = 'Sudah kompeten';
			}
		}
		else
		{
			$status = 'KKM kosong, hubungi guru';
		}
if ($status=='<strong>Remidi</strong>')
	{
echo "<tr><td align='center'>".$nomor."</td><td align='center'>".$t->thnajaran."</td><td align='center'>".$t->semester."</td><td align='center'>".$t->kelas."</td><td>".$t->mapel."</td><td align='center'>".$kkm."</td><td align='center'>".$t->kog."</td><td align='center'>".$t->psi."</td><td align='center'>".$t->afektif."</td><td align='center'>".$status."</td></tr>";
$nomor++;
	}	
}
}
else{
echo "<tr><td colspan='5'>Belum Ada Nilai</td></tr>";
}
?>
</table><br />
</div>
