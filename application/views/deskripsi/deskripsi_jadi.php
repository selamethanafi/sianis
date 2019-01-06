<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: deskripsi_jadi.php
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
	$ranah = $a->ranah;
	$materi1 = $a->materi1;
	$materi2 = $a->materi2;
	$materi3 = $a->materi3;
	$materi4 = $a->materi4;
	$materi5 = $a->materi5;
	$materi6 = $a->materi6;
	$materi7 = $a->materi7;
	$materi8 = $a->materi8;
	$materi9 = $a->materi9;
	$materi10 = $a->materi10;
	$batas1 = $a->batas1;
	$batas2 = $a->batas2;
	$batas3 = $a->batas3;
	$batas4 = $a->batas4;
	$batas5 = $a->batas5;
	$batas6 = $a->batas6;
	$thnajaran = $a->thnajaran;
	$semester = $a->semester;
}
$sukses = 'galat';
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);

if(($jenis_deskripsi==1) or ($jenis_deskripsi==3) or ($jenis_deskripsi==6))
{
	$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y'");
	if(count($query->result())>0)
	{

		foreach($query->result() as $a)
		{
			$nis = $a->nis;
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
/*
				if ($ket != $kete)
				{
					if (empty($des2))
					{
					$des2 .= 'beda';
					}
					else
					{
					$des2 .= ', beda';
					}
				} 
				else
				{
					if (empty($des2))
					{
						$des2 .= 'sama';
					}
					else
					{
						$des2 .= ", sama";
					}
				}
*/

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

//				if (($in["afektif"]=='A') or ($in["afektif"]=='B'))
//							{$in["ket"] = 'Belum tuntas';
//							}
		$te = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' ");
		foreach($te->result() as $e)
			{
			$nilai_nr = $e->nilai_nr;
			$psikomotor = $e->psikomotor;
			$afektif = $e->afektif;
			$kog = $e->kog;
			$psi = $e->psi;
			}	

					$ket='Sudah kompeten';
					$ket2='Sudah kompeten';
					if ($ranah=='KPA') 
						{
						if ($nilai_nr<$kkm)
							{$ket = 'Belum kompeten';
							}
						if ($psikomotor<$kkm)
							{$ket = 'Belum kompeten';
							}
						if ($kog<$kkm)
							{$ket2 = 'Belum kompeten';
							}
						if ($psi<$kkm)
							{$ket2 = 'Belum kompeten';
							}
						}
					if ($ranah=='PA')
						{
						if ($psikomotor<$kkm)
							{$ket = 'Belum kompeten';
							}
						if ($psi<$kkm)
							{$ket2 = 'Belum kompeten';
							}
						}
					if ($ranah=='KA')
						{
						if ($nilai_nr<$kkm)
							{$ket = 'Belum kompeten';
							}
						if ($kog<$kkm)
								{$ket2 = 'Belum kompeten';
								}
						}
				if (($afektif!='A') and ($afektif!='B') and ($afektif!='SB'))
							{$ket = 'Belum kompeten';$ket2 = 'Belum kompeten';
							}
				if ($ranah=='KP') 
				{
					$ket='Sudah kompeten';
					$ket2='Sudah kompeten';

					if ($nilai_nr<$kkm)
						{$ket = 'Belum kompeten';
						}
					if ($psikomotor<$kkm)
						{$ket = 'Belum kompeten';
						}
					if ($kog<$kkm)
						{$ket2 = 'Belum kompeten';
						}
					if ($psi<$kkm)
						{$ket2 = 'Belum kompeten';
						}
				}
		if($jenis_deskripsi==6)
		{
			$ket26 = '????';
			if($kurikulum == '2015')
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
				if($ket2 == 'Belum kompeten')
				{
					$ket26 = 'belum tuntas';
				}
				else
				{
					$ket26 = 'sudah tuntas';
				}
			}

		
			if($kog > 85)
			{
				$predikatkog = 'sangat baik';
			}
			elseif($kog >= $kkm)
			{
				$predikatkog = 'baik';
			}
			else
			{
				$predikatkog = 'cukup';
			}
			$desk = 'Capaian kompetensi '.$ket26.' dengan predikat '.$predikatkog.'. '.$desk;
		}
		$desk = nopetik($desk);
		$this->db->query("update `nilai` set `keterangan`='$desk', `ket_akhir`='$ket2', `ket`='$ket' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' ");
		}

	} //akhir kalau ada daftar nilai
	$sukses = 'sukses';
}//akhir deskripsi == 1;
if(($jenis_deskripsi=='2') or ($jenis_deskripsi=='5'))
{
	$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y'");
	if(count($query->result())>0)
	{

		foreach($query->result() as $a)
		{
			$nis = $a->nis;
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

					$ket='Sudah kompeten';
					$ket2='Sudah kompeten';
					if (($ranah=='KPA') or ($ranah=='KP'))
						{
							if ($nilai_nr<$kkm)
								{$ket = 'Belum kompeten';
								}
							if ($psikomotor<$kkm)
							{$ket = 'Belum kompeten';
							}
							if ($kog<$kkm)
								{$ket2 = 'Belum kompeten';
								}
							if ($psi<$kkm)
							{$ket2 = 'Belum kompeten';
							}

						}

					if ($ranah=='PA')
						{
						if ($psikomotor<$kkm)
							{$ket = 'Belum kompeten';
							}
						if ($psi<$kkm)
							{$ket2 = 'Belum kompeten';
							}


						}

					if ($ranah=='KA')
						{
						if ($nilai_nr<$kkm)
							{$ket = 'Belum kompeten';
							}
							if ($kog<$kkm)
								{$ket2 = 'Belum kompeten';
								}

						}

					if($ranah != 'KP')
					{
						if (($afektif!='A') and ($afektif!='B') and ($afektif!='SB'))
						{$ket = 'Belum kompeten';$ket2 = 'Belum kompeten';
						}
					}
		$desk = nopetik($desk);
		$this->db->query("update `nilai` set `keterangan`='$desk', `ket_akhir`='$ket2', `ket`='$ket' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' ");
		} 
	} //akhir kalau ada daftar nilai
	$sukses = 'sukses';
}//akhir deskripsi == 2;
if($sumber == 'mapel')
{
?>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>deskripsi/<?php echo $sukses;?>/mapel'; // the redirect goes here

},500);
			</script>
<?php

}
elseif($sumber == 'lck')
{
?>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>guru/lck2/<?php echo $id_mapel;?>'; // the redirect goes here

},500);
			</script>
<?php

}
else
{
echo '<img src="'.base_url().'images/loading.gif"><br />';
	echo 'Halaman ini akan berpindah otomatis, bila dalam 5 detik tidak berpindah klik <a href="'.base_url().'deskripsi/praproses/pengetahuan/'.$nomor.'">di sini</a>'; // manual redirect
	?>
	<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>deskripsi/praproses/pengetahuan/<?php echo $nomor;?>'; // the redirect goes here

},5000);
			</script>
<?php
}
