<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: deskripsi_keterampilan.php
// Lokasi      		: application/views/deskripsi/
// Terakhir diperbarui	: Min 06 Jan 2019 20:27:14 WIB 
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
foreach($tmapel->result() as $a)
{
	$mapel = $a->mapel;
	$kelas = $a->kelas;
	$id_mapel = $a->id_mapel;	
	$jenis_deskripsi = $a->jenis_deskripsi;
	$kkm = $a->kkm;
}
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
$sukses = 'galat/'.$id_mapel;
$batas_sangat_baik = batas_sangat_baik($kkm);
$batas_baik = batas_baik($kkm);
if($kurikulum >= 2013)
{
	$tg = $this->db->query("select * from `m_mapel` where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester'");
	foreach($tg->result() as $g)
	{
		$p[1]=$g->p1;
		$p[2]=$g->p2;
		$p[3]=$g->p3;
		$p[4]=$g->p4;
		$p[5]=$g->p5;
		$p[6]=$g->p6;
		$p[7]=$g->p7;
		$p[8]=$g->p8;
		$p[9]=$g->p9;
		$p[10]=$g->p10;
		$p[11]=$g->p11;
		$p[12]=$g->p12;
		$p[13]=$g->p13;
		$p[14]=$g->p14;
		$p[15]=$g->p15;
		$p[16]=$g->p16;
		$p[17]=$g->p17;
		$p[18]=$g->p18;
	}
	$ta = $this->db->query("select * from nilai where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
	if(count($ta->result())>0)
	{
		foreach($ta->result() as $t)
		{
			$nis = $t->nis;
			$desk = $t->keterangan;
			//keterampilan
			$tf = $this->db->query("select * from `nilai` where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
			$ketpsi = '';
			$sangatbaik = '';
			$baik = '';
			$cukup = '';
			$item = 1;
			$psi = $t->psi;
			if($jenis_deskripsi == 6)
			{
				if($psi>=$batas_sangat_baik)
				{
					$ketpsi = 'Capaian kompetensi sudah tuntas dengan predikat sangat baik';
				}
				elseif($psi>=$batas_baik)
				{
					$ketpsi = 'Capaian kompetensi sudah tuntas dengan predikat baik';
				}
				elseif($psi>=$kkm)
				{
					$ketpsi = 'Capaian kompetensi sudah tuntas dengan predikat cukup';
				}
				else
				{
					$ketpsi = 'Capaian kompetensi masih kurang';
				}
			}
			foreach($tf->result() as $f)
			{
				do
				{
					$aspek = "p$item";
					if (!empty($p[$item]))
					{
						if($jenis_deskripsi == 6)
						{
							if($f->$aspek>=$batas_sangat_baik)
							{
								if(empty($sangatbaik))
								{
									$sangatbaik .= $p[$item];
								}
								else
								{
									$sangatbaik .= ', '.$p[$item];
								}
							}
							elseif($f->$aspek>=$batas_baik)
							{
								if(empty($baik))
								{
									$baik .= $p[$item];
								}
								else
								{
									$baik .= ', '.$p[$item];
								}
							}
							else
							{
								if(empty($cukup))
								{
									$cukup .= $p[$item];
								}
								else
								{
									$cukup .= ', '.$p[$item];
								}
							}
						}
						else
						{
							if (empty($ketpsi))
							{
								$ketpsi .= strtolower(deskripsi_nilai_keterampilan($f->$aspek)).' '.$p[$item];
							}
							else
							{
								$ketpsi .= ", ".strtolower(deskripsi_nilai_keterampilan($f->$aspek)).' '.$p[$item];							}
						}
					}
					$item++;
				}
				while ($item<19);
				if(!empty($sangatbaik))
				{
					if(empty($ketpsi))
					{
						$ketpsi .= 'Ananda sangat baik dalam '.$sangatbaik;
					}
					else
					{
						$ketpsi .= '. Ananda sangat baik dalam '.$sangatbaik;
					}
				}
				if(!empty($baik))
				{
					if(empty($ketpsi))
					{
						$ketpsi .= 'Ananda sudah baik dalam '.$baik;
					}
					else
					{
						$ketpsi .= '. Ananda sudah baik dalam '.$baik;
					}
				}
				if(!empty($cukup))
				{
					if(empty($ketpsi))
					{
						$ketpsi .= 'Dengan bimbingan lebih, Ananda akan dapat meningkatkan kemampuan dalam '.$cukup;
					}
					else
					{
						$ketpsi .= '. Dengan bimbingan lebih, Ananda akan dapat meningkatkan kemampuan dalam '.$cukup;					
					}
				}
				$ketpsi = ucfirst(hilangkanpetik($ketpsi));
				$this->db->query("update `nilai` set `deskripsi`='$ketpsi' where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
			} //daftar nilai psikomotor
		}
	} //akhir daftar siswa
	$sukses = 'sukses';
} // akhir kurikulum
else
{
	$sukses = 'galat/tidakperlu/'.$id_mapel;
}
if($sumber == 'mapel')
{
?>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>deskripsi/<?php echo $sukses;?>/mapel'; // the redirect goes here

},100);
			</script>
<?php

}
elseif($sumber == 'lck')
{
?>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>guru/psikomotor'; // the redirect goes here

},100);
			</script>
<?php

}

else
{
echo '<img src="'.base_url().'images/loading.gif"><br />';
	echo 'Halaman ini akan berpindah otomatis, bila dalam 5 detik tidak berpindah klik <a href="'.base_url().'deskripsi/praproses/keterampilan/'.$nomor.'">di sini</a>'; // manual redirect
	?>
	<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>deskripsi/praproses/keterampilan/<?php echo $nomor;?>'; // the redirect goes here

},5000);
			</script>
<?php
}
