<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 09 Jan 2019 19:03:29 WIB 
// Nama Berkas 		: status_ketuntasan.php
// Lokasi      		: application/views/guru
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
<?php
echo '<h2>Mohon bersabar</h2>';
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
$batas_sangat_baik = batas_sangat_baik($kkm);
$batas_baik = batas_baik($kkm);

if($kurikulum > 2012)
{
	if($id <= $total_siswa)
	{
		$persen = $id/$total_siswa * 100;
		$persen = round($persen);
		echo '<div class="progress">
		<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:'.$persen.'%;">
		'.$id.' dari '.$total_siswa.' siswa ('.$persen.'%) terproses
		</div>
	      </div>';

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
		$tf = $this->db->query("select * from nilai where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' limit $id,1");
		$nis = '';
		$psi = '';
		
		foreach($tf->result() as $f)
		{
			$nis = $f->nis;
			$psi = $f->psi;
		}
		$ketpsi = '';
		$sangatbaik = '';
		$baik = '';
		$cukup = '';
		$kurang = '';
		$item = 1;
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
				$ketpsi = 'Capaian kompetensi belum tuntas.';
			}
		}
		if($tf->num_rows()>0)
		{
		foreach($tf->result() as $f)
		{
			$ketp = '';
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
						elseif($f->$aspek>=$kkm)
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

						else
						{
							if(empty($kurang))
							{
								$kurang .= $p[$item];
							}
							else
							{
								$kurang .= ', '.$p[$item];
							}
						}
					}
					else
					{
						if($f->$aspek>0)
						{
							if (empty($ketp))
							{
								$ketpsi .= ' Ananda '.strtolower(deskripsi_nilai_keterampilan($f->$aspek)).' '.$p[$item];
								$ketp ='j';
							}
							else
							{
								$ketpsi .= ", ".strtolower(deskripsi_nilai_keterampilan($f->$aspek)).' '.$p[$item];
							}
						}
						else
						{
							$ketpsi .= '<p class="text-danger">deskripsi penilaian '.$item.' tidak bisa dibuat karena tidak ada nilai</p>';
						}

					}
				}
				$item++;
			} // end of do
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
					$ketpsi .= 'Ananda cukup baik dalam '.$cukup;
				}
				else
				{
					$ketpsi .= '. Ananda cukup baik dalam '.$cukup;
				}
			}

			if(!empty($kurang))
			{
				if(empty($ketpsi))
				{
					$ketpsi .= 'Dengan bimbingan lebih, Ananda akan dapat meningkatkan kemampuan dalam '.$kurang;
				}
				else
				{
					$ketpsi .= '. Dengan bimbingan lebih, Ananda akan dapat meningkatkan kemampuan dalam '.$kurang;			
				}
			}
			$ketpsi = ucfirst(hilangkanpetik($ketpsi));
			$this->db->query("update `nilai` set `deskripsi`='$ketpsi' where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
		}
		} //daftar nilai psikomotor
		$id++;
		?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/deskripsiketerampilan/<?php echo $id_mapel?>/<?php echo $id?>';
			},1);
			</script>
		<?php
	}
	else
	{
		$persen = 100;
		echo '<div class="progress">
		<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:'.$persen.'%;">
		'.$persen.'% terproses
		</div>
	      </div>';
		?>
		<h3>tunggu sampai berpindah halaman</h3>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/lck2/<?php echo $id_mapel;?>';
		},100);
			</script>
		<?php
	}
}
else
{?>
<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/lck2/<?php echo $id_mapel;?>';
		},100);
			</script>
<?php
}
?>
</div></div></div>
