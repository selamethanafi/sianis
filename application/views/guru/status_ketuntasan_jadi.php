<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 09 Jan 2019 19:03:00 WIB 
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
if(($ranah == 'KPA') or ($ranah == 'PA'))
{
	echo '<h2 class="text-warning">Mohon perhatian, pastikan penilaian sikap dan keterampilan sudah diselesaikan lebih dahulu!</h2>';
}
if($ranah == 'KP')
{
	echo '<h2 class="text-warning">Mohon perhatian, pastikan penilaian keterampilan sudah diselesaikan lebih dahulu!</h2>';
}

echo '<h2>Mohon bersabar</h2>';
$desk = '';
if(($id <= $total_siswa) and ($total_siswa > 0))
{
	$persen = $id/$total_siswa * 100;
	$persen = round($persen);
	echo '<div class="progress">
		<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:'.$persen.'%;">
		'.$id.' dari '.$total_siswa.' siswa ('.$persen.'%) terproses
		</div>
	      </div>';
	//echo 'Persentase '.$persen;
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	$ta = $this->db->query("select * from nilai where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' limit $id,1");
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		$kd = $a->kd;
		$kog = $a->kog;
		$psi = $a->psi;
		$afektif = $a->afektif;
		$ket_akhir = 'Belum kompeten';
		$k1 = 1;
		$k2 = 1;
		$k3 = 0;
		if($kog < $kkm)
		{
			$k1 = 0;

		}
		if($psi < $kkm)
		{
			$k2 = 0;

		}
		if(($afektif == 'A' ) or ($afektif == 'B' ) or ($afektif == 'AB' ) or ($afektif == 'SB' ))
		{
			$k3 = 1;

		}
		if($ranah == 'KP')
		{
			if(($k1 == 1) and ($k2 == 1))
			{
				$ket_akhir = 'Sudah kompeten';
			}
		}
		elseif($ranah == 'PA')
		{
			if(($k2 == 1) and ($k3 == 1))
			{
				$ket_akhir = 'Sudah kompeten';
			}
		}
		elseif($ranah == 'KA')
		{
			if(($k1 == 1) and ($k3 == 1))
			{
				$ket_akhir = 'Sudah kompeten';
			}
		}
		else
		{
			if(($k1 == 1) and ($k2 == 1) and ($k3 == 1))
			{
				$ket_akhir = 'Sudah kompeten';
			}
		}
		if(($jenis_deskripsi==1) or ($jenis_deskripsi==3) or ($jenis_deskripsi==6))
		{
			$td = $this->db->query("select * from deskripsi_capaian_nilai where `id_mapel`='$id_mapel' and nis='$nis' and `positif`='1' order by nis ASC,ket ASC");
			$ket = '';
			$des1 = '';
			$des2 = '';
			$materine1='';
			$materine2='';
			$deske='';
			foreach($td->result() as $d)
			{
				$kete = $d->ket;
				if ($ket != $kete)
				{
				$ket = $kete;
				if (empty($des1))
					{
					$des1 .= $kete." ".$d->materi;
					}
					else
					{
					$des1 .= ", ".$kete." ".$d->materi;
					}

				} 
				else
				{
					if (empty($des1))
					{
					$des1 .= $d->materi;
					}
					else
					{
					$des1 .= ", ".$d->materi;
					}
				}
				if (empty($materine1))
				{
					$materine1 .= $d->materi;
				}
				else
				{
				$materine1 .= ", ".$d->materi;
				}
				if (empty($deske))
				{
					$deske .= $d->ket." ".$d->materi;
				}
				else
				{
					$deske .= ", ".$d->ket." ".$d->materi;
				}

			}
			$desk = $des1;	
			$ket = '';
			$td = $this->db->query("select * from deskripsi_capaian_nilai where `id_mapel`='$id_mapel' and `nis` = '$nis' and `positif`='0' order by nis ASC,ket ASC");
			foreach($td->result() as $d)
			{
				$kete = $d->ket;
				if ($ket != $kete)
				{
					$ket = $kete;
					if (empty($des2))
					{
					$des2 .= $ket." ".$d->materi;
					}
					else
					{
					$des2 .= ", ".$ket." ".$d->materi;
					}

				} 
				else
				{
					if (empty($des2))
					{
						$des2 .= $d->materi;
					}
					else
					{
						$des2 .= ", ".$d->materi;
					}
				}

			}
			if (empty($desk))
			{
				$desk = $des2;	
			}
			else
			{
				if (!empty($des2))
				{
				$desk .= ", ".$des2;	
				}
			}
			if($jenis_deskripsi == 6)
			{
				if(!empty($des1))
				{
					$desk = 'Ananda '.$desk;
				}
				else
				{
					$desk = ucfirst($desk);
				}
			}
			else
			{
				$desk = ucfirst($desk);
			}
			if($jenis_deskripsi==6)
			{
				$ket26 = '????';
				if($kurikulum > 2015)
				{
					if($kog < $kkm)
					{
						$ket26 = 'belum tuntas';
					}
					else
					{
						$ket26 = 'sudah tuntas';
					}
				}
				elseif($kurikulum == '2015')
				{
					if($kog < $kkm)
					{
						$ket26 = 'belum tuntas';
					}
					else
					{
						$ket26 = 'sudah tuntas';
					}
				}
				elseif($kurikulum == '2013')
				{
					if($kog < $kkm)
					{
						$ket26 = 'belum tuntas';
					}
					else
					{
						$ket26 = 'sudah tuntas';
					}
				}
				else
				{
					if($ket_akhir == 'Belum kompeten')
					{
						$ket26 = 'belum tuntas';
					}
					else
					{
						$ket26 = 'sudah tuntas';
					}
				}
				$predikatkog = predikat_deskripsi_nilai_2018($kog,$kkm);
/*
				if($k
				{
					$predikatkog = 'sangat baik';
				}
				elseif($kog >= 76)
				{
					$predikatkog = 'baik';
				}
				elseif($kog >= $kkm)
				{
					$predikatkog = 'cukup';
				}
				else
				{
					$predikatkog = 'kurang';
				}
*/
				$desk = 'Capaian kompetensi '.$ket26.' dengan predikat '.$predikatkog.'. '.$desk;
			}
			$desk = nopetik($desk);
			$this->db->query("update `nilai` set `ket_akhir` = '$ket_akhir', `keterangan`='$desk' where `kd`='$kd'");
		} // akhir jeni 1, 3, 6
		if(($jenis_deskripsi=='2') or ($jenis_deskripsi=='5'))
		{
			$te = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' ");
			foreach($te->result() as $e)
			{
				$nilai_nr = $e->nilai_nr;
				$psikomotor = $e->psikomotor;
				$afektif = $e->afektif;
				$kog = $e->kog;
				$psi = $e->psi;
			}
			if($kurikulum == '2013')
			{
				if($jenis_deskripsi=='2')
				{
					$nilaipengetahuan = konversi_nilai($nilai_nr);
				}
				else
				{
					$nilaipengetahuan = konversi_nilai($kog);
				}
				if($ranah == 'PA')
				{
					if($jenis_deskripsi=='2')
					{
						$nilaipengetahuan = konversi_nilai($psikomotor);
					}
					else
					{
						$nilaipengetahuan = konversi_nilai($psi);
					}
				}
				if ($nilaipengetahuan >= 3.67)
				{
					$desk = $materi1;
				}
				elseif ($nilaipengetahuan >= 3.34)
				{
					$desk = $materi2;
				}
				elseif ($nilaipengetahuan >= 3.01)
				{
					$desk = $materi3;
				}
				elseif ($nilaipengetahuan >= 2.67)
				{
					$desk = $materi4;
				}
				elseif ($nilaipengetahuan >= 2.34)
				{
					$desk = $materi5;
				}
				else 	
				{
					$desk = $materi6;
				}
			}
			else
			{
				if($jenis_deskripsi=='2')
				{
					$nilaipengetahuan = $nilai_nr;
				}
				else
				{
					$nilaipengetahuan = $kog;
				}
				if($ranah == 'PA')
				{
					if($jenis_deskripsi=='2')
					{
						$nilaipengetahuan = $psikomotor;
					}
					else
					{
						$nilaipengetahuan = $psi;
					}
				}
				if ($nilaipengetahuan >= $batas1)
				{
					$desk = $materi1;
				}
				elseif ($nilaipengetahuan >= $batas2)
				{
					$desk = $materi2;
				}
				elseif ($nilaipengetahuan >= $batas3)
				{
					$desk = $materi3;
				}
				elseif ($nilaipengetahuan >= $batas4)
				{
					$desk = $materi4;
				}
				elseif ($nilaipengetahuan >= $batas5)
				{
					$desk = $materi5;
				}
				else 	
				{
					$desk = $materi6;
				}
			}
			$desk = nopetik($desk);
			$this->db->query("update `nilai` set `keterangan`='$desk', `ket_akhir`='$ket_akhir' where `kd`='$kd'");
		}//akhir deskripsi == 2 dan 5;

		if(($jenis_deskripsi == 4) or ($jenis_deskripsi == 0))
		{
			$this->db->query("update `nilai` set `ket_akhir` = '$ket_akhir' where `kd`='$kd'");
		}
	}
	$id++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/statusketuntasan/<?php echo $id_mapel?>/<?php echo $id?>';
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
?>
</div></div></div>
