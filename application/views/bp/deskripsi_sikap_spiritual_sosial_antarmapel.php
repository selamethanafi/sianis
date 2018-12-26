<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 20:39:33 WIB 
// Nama Berkas 		: deskripsi_sikap_spiritual_sosial_antarmapel.php
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
<div class="container-fluid">
<?php
$xloc = base_url().'bp/nilaispiritualantarmapel';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if(!empty($tahun1))
	{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	}
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$k->thnajaran.'</option>';
	}

	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1/'.$id_kelas.'">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2/'.$id_kelas.'">2</option>';
	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
	}
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `kurikulum`='2013' and `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select></div></div>';
	$kelas = $kelasxx;
echo '</div></div></form>';
if((!empty($thnajaran)) and(!empty($semester)) and (!empty($id_kelas)))
{
		$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by id_sikap_spiritual");
		$itemke = 1;
		foreach($tb->result() as $b)
		{
			$des[$itemke] = $b->item;
		$itemke++;
		}
		$adatb = $tb->num_rows();
		if(($adatb == 0) and (!empty($thnajaran)))
		{
			echo 'Tabel item penilaian sikap spiritual kosong';
		}
		else
		{
			//jmlguru
			$tma = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='T' and `kelas`='$kelas' order by `kodeguru`,kelas");
			$adagurubelum = $tma->num_rows();
			$rekapkodeguru = '';
			foreach($tma->result() as $dma)
			{
				if(empty($rekapkodeguru))
				{
					$rekapkodeguru .= '<strong>'.$dma->kodeguru.'</strong>';
				}
				else
				{
					$rekapkodeguru .= ', <strong>'.$dma->kodeguru.'</strong>';
				}
			}
			if($aksi == 'proses')
			{
				$adagurubelum = 0;
			}
			if($adagurubelum>0)
			{
				echo 'Daftar Guru Belum mengirim penilaian sikap spiritual dan sosial antarmapel<p>';
				echo $rekapkodeguru;
				echo '</p><div class="alert alert-danger"><strong>Belum dapat diproses</strong>, <a href="'.base_url().'bp/nilaispiritualantarmapel/'.$tahun1.'/'.$semester.'/'.$id_kelas.'/proses" class="btn btn-danger">Proses saja</a></div>';
			}
			else
			{
				$tmak = $this->db->query("select * from m_akhlak where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas'");
				$pembagi = count($tmak->result());
				$daftarsiswa = $this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and `status`='Y'");
				$nomor=1;
				foreach($daftarsiswa->result() as $b)
				{
					$nis = $b->nis;
					$namasiswa = nis_ke_nama($nis);
					$tnilaiakhlak = $this->db->query("select * from `siswa_penilaian_diri_rekap` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
					$jsatu1=0;
					$jsatu2=0;
					$jsatu3=0;
					$jsatu4=0;
					$jdua1=0;
					$jdua2=0;
					$jdua3=0;
					$jdua4=0;
					$jtiga1=0;
					$jtiga2=0;
					$jtiga3=0;
					$jtiga4=0;
					$jempat1=0;
					$jempat2=0;
					$jempat3=0;
					$jempat4=0;
					$jlima1=0;
					$jlima2=0;
					$jlima3=0;
					$jlima4=0;
					$jenam1=0;
					$jenam2=0;
					$jenam3=0;
					$jenam4=0;
					$jtujuh1=0;
					$jtujuh2=0;
					$jtujuh3=0;
					$jtujuh4=0;
					$jdelapan1=0;
					$jdelapan2=0;
					$jdelapan3=0;
					$jdelapan4=0;
					$jsembilan1=0;
					$jsembilan2=0;
					$jsembilan3=0;
					$jsembilan4=0;
					$jsepuluh1=0;
					$jsepuluh2=0;
					$jsepuluh3=0;
					$jsepuluh4=0;
					foreach($tnilaiakhlak->result() as $d)
					{
						if($d->i1 == '1')
						{
						$jsatu1++; 			
		}
		if($d->i1 == '2')
		{
			$jsatu2++; 			
		}
		if($d->i1 == '3')
		{
			$jsatu3++; 			
		}
		if($d->i1 == '4')
		{
			$jsatu4++; 			
		}
		if($d->i2 == '1')
		{
			$jdua1++; 			
		}
		if($d->i2 == '2')
		{
			$jdua2++; 			
		}
		if($d->i2 == '3')
		{
			$jdua3++; 			
		}
		if($d->i2 == '4')
		{
			$jdua4++; 			
		}
		if($d->i3 == '1')
		{
			$jtiga1++; 			
		}
		if($d->i3 == '2')
		{
			$jtiga2++; 			
		}
		if($d->i3 == '3')
		{
			$jtiga3++; 			
		}
		if($d->i3 == '4')
		{
			$jtiga4++; 			
		}
		if($d->i4 == '1')
		{
			$jempat1++; 			
		}
		if($d->i4 == '2')
		{
			$jempat2++; 			
		}
		if($d->i4 == '3')
		{
			$jempat3++; 			
		}
		if($d->i4 == '4')
		{
			$jempat4++; 			
		}
		if($d->i5 == '1')
		{
			$jlima1++; 			
		}
		if($d->i5 == '2')
		{
			$jlima2++; 			
		}
		if($d->i5 == '3')
		{
			$jlima3++; 			
		}
		if($d->i5 == '4')
		{
			$jlima4++; 			
		}
		if($d->i6 == '1')
		{
			$jenam1++; 			
		}
		if($d->i6 == '2')
		{
			$jenam2++; 			
		}
		if($d->i6 == '3')
		{
			$jenam3++; 			
		}
		if($d->i6 == '4')
		{
			$jenam4++; 			
		}
		if($d->i7 == '1')
		{
			$jtujuh1++; 			
		}
		if($d->i7 == '2')
		{
			$jtujuh2++; 			
		}
		if($d->i7 == '3')
		{
			$jtujuh3++; 			
		}
		if($d->i7 == '4')
		{
			$jtujuh4++; 			
		}
		if($d->i8 == '1')
		{
			$jdelapan1++; 			
		}
		if($d->i8 == '2')
		{
			$jdelapan2++; 			
		}
		if($d->i8 == '3')
		{
			$jdelapan3++; 			
		}
		if($d->i8 == '4')
		{
			$jdelapan4++; 			
		}
		if($d->i9 == '1')
		{
			$jsembilan1++; 			
		}
		if($d->i9 == '2')
		{
			$jsembilan2++; 			
		}
		if($d->i9 == '3')
		{
			$jsembilan3++; 			
		}
		if($d->i9 == '4')
		{
			$jsembilan4++; 			
		}
		if($d->i10 == '1')
		{
			$jsepuluh1++; 			
		}
		if($d->i10 == '2')
		{
			$jsepuluh2++; 			
		}
		if($d->i10 == '3')
		{
			$jsepuluh3++; 			
		}
		if($d->i10 == '4')
		{
			$jsepuluh4++; 			
		}

	}
	$rataratajsatu = max($jsatu1,$jsatu2,$jsatu3,$jsatu4);
	if($rataratajsatu == $jsatu4)
	{
		$predikatsatu = 'SB';
	}
	elseif($rataratajsatu == $jsatu3)
	{
		$predikatsatu = 'B';
	}
	elseif($rataratajsatu == $jsatu2)
	{
		$predikatsatu = 'C';
	}

	else
	{
		$predikatsatu = 'K';
	}
	$rataratajdua = max($jdua1,$jdua2,$jdua3,$jdua4);
	if($rataratajdua == $jdua4)
	{
		$predikatdua = 'SB';
	}
	elseif($rataratajdua == $jdua3)
	{
		$predikatdua = 'B';
	}
	elseif($rataratajdua == $jdua2)
	{
		$predikatdua = 'C';
	}

	else
	{
		$predikatdua = 'K';
	}
	$rataratajtiga = max($jtiga1,$jtiga2,$jtiga3,$jtiga4);
	if($rataratajtiga == $jtiga4)
	{
		$predikattiga = 'SB';
	}
	elseif($rataratajtiga == $jtiga3)
	{
		$predikattiga = 'B';
	}
	elseif($rataratajtiga == $jtiga2)
	{
		$predikattiga = 'C';
	}

	else
	{
		$predikattiga = 'K';
	}
	$rataratajempat = max($jempat1,$jempat2,$jempat3,$jempat4);
	if($rataratajempat == $jempat4)
	{
		$predikatempat = 'SB';
	}
	elseif($rataratajempat == $jempat3)
	{
		$predikatempat = 'B';
	}
	elseif($rataratajempat == $jempat2)
	{
		$predikatempat = 'C';
	}

	else
	{
		$predikatempat = 'K';
	}
	$rataratajlima = max($jlima1,$jlima2,$jlima3,$jlima4);
	if($rataratajlima == $jlima4)
	{
		$predikatlima = 'SB';
	}
	elseif($rataratajlima == $jlima3)
	{
		$predikatlima = 'B';
	}
	elseif($rataratajlima == $jlima2)
	{
		$predikatlima = 'C';
	}

	else
	{
		$predikatlima = 'K';
	}
	$rataratajenam = max($jenam1,$jenam2,$jenam3,$jenam4);
	if($rataratajenam == $jenam4)
	{
		$predikatenam = 'SB';
	}
	elseif($rataratajenam == $jenam3)
	{
		$predikatenam = 'B';
	}
	elseif($rataratajenam == $jenam2)
	{
		$predikatenam = 'C';
	}

	else
	{
		$predikatenam = 'K';
	}
	$rataratajtujuh = max($jtujuh1,$jtujuh2,$jtujuh3,$jtujuh4);
	if($rataratajtujuh == $jtujuh4)
	{
		$predikattujuh = 'SB';
	}
	elseif($rataratajtujuh == $jtujuh3)
	{
		$predikattujuh = 'B';
	}
	elseif($rataratajtujuh == $jtujuh2)
	{
		$predikattujuh = 'C';
	}
	else
	{
		$predikattujuh = 'K';
	}
	$rataratajdelapan = max($jdelapan1,$jdelapan2,$jdelapan3,$jdelapan4);
	if($rataratajdelapan == $jdelapan4)
	{
		$predikatdelapan = 'SB';
	}
	elseif($rataratajdelapan == $jdelapan3)
	{
		$predikatdelapan = 'B';
	}
	elseif($rataratajdelapan == $jdelapan2)
	{
		$predikatdelapan = 'C';
	}

	else
	{
		$predikatdelapan = 'K';
	}
	$rataratajsembilan = max($jsembilan1,$jsembilan2,$jsembilan3,$jsembilan4);
	if($rataratajsembilan == $jsembilan4)
	{
		$predikatsembilan = 'SB';
	}
	elseif($rataratajsembilan == $jsembilan3)
	{
		$predikatsembilan = 'B';
	}
	elseif($rataratajsembilan == $jsembilan2)
	{
		$predikatsembilan = 'C';
	}

	else
	{
		$predikatsembilan = 'K';
	}
	$rataratajsepuluh = max($jsepuluh1,$jsepuluh2,$jsepuluh3,$jsepuluh4);
	if($rataratajsepuluh == $jsepuluh4)
	{
		$predikatsepuluh = 'SB';
	}
	elseif($rataratajsepuluh == $jsepuluh3)
	{
		$predikatsepuluh = 'B';
	}
	elseif($rataratajsepuluh == $jsepuluh2)
	{
		$predikatsepuluh = 'C';
	}

	else
	{
		$predikatsepuluh = 'K';
	}
	$deskripsi_AB ='';
	$deskripsi_B ='';
	$deskripsi_C ='';
	$deskripsi_K ='';
	if (!empty($des[1]))
	{
		if ($predikatsatu == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[1];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[1];
			}
		}
		if ($predikatsatu == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[1];
			}
			else
			{
				$deskripsi_B .= ", ".$des[1];
			}
		}
		if (($predikatsatu == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[1];
			}
			else
			{
				$deskripsi_C .= ", ".$des[1];
			}
		}
		if (($predikatsatu == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[1];
			}
			else
			{
				$deskripsi_K .= ", ".$des[1];
			}
		}

	}
	if (!empty($des[2]))
	{
		if ($predikatdua == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[2];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[2];
			}
		}
		if ($predikatdua == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[2];
			}
			else
			{
				$deskripsi_B .= ", ".$des[2];
			}
		}
		if (($predikatdua == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[2];
			}
			else
			{
				$deskripsi_C .= ", ".$des[2];
			}
		}
		if (($predikatdua == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[2];
			}
			else
			{
				$deskripsi_K .= ", ".$des[2];
			}
		}

	}
	if (!empty($des[3]))
	{
		if ($predikattiga == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[3];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[3];
			}
		}
		if ($predikattiga == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[3];
			}
			else
			{
				$deskripsi_B .= ", ".$des[3];
			}
		}
		if (($predikattiga == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[3];
			}
			else
			{
				$deskripsi_C .= ", ".$des[3];
			}
		}
		if (($predikattiga == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[3];
			}
			else
			{
				$deskripsi_K .= ", ".$des[3];
			}
		}

	}
	if (!empty($des[4]))
	{
		if ($predikatempat == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[4];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[4];
			}
		}
		if ($predikatempat == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[4];
			}
			else
			{
				$deskripsi_B .= ", ".$des[4];
			}
		}
		if (($predikatempat == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[4];
			}
			else
			{
				$deskripsi_C .= ", ".$des[4];
			}
		}
		if (($predikatempat == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[4];
			}
			else
			{
				$deskripsi_K .= ", ".$des[4];
			}
		}

	}
	if (!empty($des[5]))
	{
		if ($predikatlima == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[5];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[5];
			}
		}
		if ($predikatlima == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[5];
			}
			else
			{
				$deskripsi_B .= ", ".$des[5];
			}
		}
		if (($predikatlima == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[5];
			}
			else
			{
				$deskripsi_C .= ", ".$des[5];
			}
		}
		if (($predikatlima == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[5];
			}
			else
			{
				$deskripsi_K .= ", ".$des[5];
			}
		}

	}
	if (!empty($des[6]))
	{
		if ($predikatenam == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[6];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[6];
			}
		}
		if ($predikatenam == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[6];
			}
			else
			{
				$deskripsi_B .= ", ".$des[6];
			}
		}
		if (($predikatenam == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[6];
			}
			else
			{
				$deskripsi_C .= ", ".$des[6];
			}
		}
		if (($predikatenam == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[6];
			}
			else
			{
				$deskripsi_K .= ", ".$des[6];
			}
		}

	}
	if (!empty($des[7]))
	{
		if ($predikattujuh == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[7];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[7];
			}
		}
		if ($predikattujuh == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[7];
			}
			else
			{
				$deskripsi_B .= ", ".$des[7];
			}
		}
		if (($predikattujuh == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[7];
			}
			else
			{
				$deskripsi_C .= ", ".$des[7];
			}
		}
		if (($predikattujuh == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[7];
			}
			else
			{
				$deskripsi_K .= ", ".$des[7];
			}
		}

	}
	if (!empty($des[8]))
	{
		if ($predikatdelapan == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[8];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[8];
			}
		}
		if ($predikatdelapan == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[8];
			}
			else
			{
				$deskripsi_B .= ", ".$des[8];
			}
		}
		if (($predikatdelapan == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[8];
			}
			else
			{
				$deskripsi_C .= ", ".$des[8];
			}
		}
		if (($predikatdelapan == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[8];
			}
			else
			{
				$deskripsi_K .= ", ".$des[8];
			}
		}

	}
	if (!empty($des[9]))
	{
		if ($predikatsembilan == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[9];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[9];
			}
		}
		if ($predikatsembilan == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[9];
			}
			else
			{
				$deskripsi_B .= ", ".$des[9];
			}
		}
		if (($predikatsembilan == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[9];
			}
			else
			{
				$deskripsi_C .= ", ".$des[9];
			}
		}
		if (($predikatsembilan == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[9];
			}
			else
			{
				$deskripsi_K .= ", ".$des[9];
			}
		}

	}
	if (!empty($des[10]))
	{
		if ($predikatsepuluh == 'SB')
		{
			if (empty($deskripsi_AB))
			{
				$deskripsi_AB .= $des[10];
			}
			else
			{
				$deskripsi_AB .= ", ".$des[10];
			}
		}
		if ($predikatsepuluh == 'B')
		{
			if (empty($deskripsi_B))
			{
				$deskripsi_B .= $des[10];
			}
			else
			{
				$deskripsi_B .= ", ".$des[10];
			}
		}
		if (($predikatsepuluh == 'C'))
		{
			if (empty($deskripsi_C))
			{
				$deskripsi_C .= $des[10];
			}
			else
			{
				$deskripsi_C .= ", ".$des[10];
			}
		}
		if (($predikatsepuluh == 'K'))
		{
			if (empty($deskripsi_K))
			{
				$deskripsi_K .= $des[10];
			}
			else
			{
				$deskripsi_K .= ", ".$des[10];
			}
		}

	}

		$deskripsi = '';
		if (!empty($deskripsi_AB))
			{
				$deskripsi = "Peserta didik sudah bersungguh-sungguh (konsisten) menerapkan sikap ".$deskripsi_AB.".";
			}
		if (!empty($deskripsi_B))
			{
			if (!empty($deskripsi))
				{
				$deskripsi .= " Peserta didik sudah menerapkan sikap ".$deskripsi_B.".";
				}
				else
				{
				$deskripsi .= "Peserta didik sudah menerapkan sikap ".$deskripsi_B.".";
				}
			}
		if (!empty($deskripsi_C))
			{
			if (!empty($deskripsi))
				{
				$deskripsi .= " Peserta didik sudah menerapkan sikap ".$deskripsi_C.".";
				}
				else
				{
				$deskripsi .= "Peserta didik sudah menerapkan sikap ".$deskripsi_C.".";
				}
			}
		if (!empty($deskripsi_K))
			{
			if (!empty($deskripsi))
				{
				$deskripsi .= " Peserta didik tidak pernah menerapkan sikap ".$deskripsi_K.".";
				}
				else
				{
				$deskripsi .= "Peserta didik tidak pernah menerapkan sikap ".$deskripsi_K.".";
				}
			}

		$ta = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");

		if(count($ta->result())==0)
			{
			$this->db->query("insert into `kepribadian`  (`kom1`, `thnajaran`, `semester`, `nis`,`kelas`) values ('$deskripsi', '$thnajaran', '$semester', '$nis', '$kelas')");
			}
			else
			{
			$this->db->query("update kepribadian set kom1 = '$deskripsi' where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
			}

}
?>
</table>
<?php

$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ASC");
echo '<div class="table-responsive"><table class="table table-hover table-bordered">
<tr align="center"><td width="50"><strong>No.</strong></td><td width="50"><strong>NIS</strong></td><td width="200"><strong>Nama</strong></td><td><strong>Deskripsi</strong></td></tr>';
$nomor = 1;
foreach($tdata_siswa->result() as $e)
{
	$nis = $e->nis;
	$namasiswa = nis_ke_nama($nis);
	$ta = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	foreach($ta->result() as $a)
	{
	echo "<tr><td>".$nomor."</td><td>".$nis."</td><td>".$namasiswa."</td><td>".$a->kom1."</td></tr>";
	}
	$nomor++;

}
echo '</table></div>';
}
} // akhir kalau semua sudah mengirim
}
?>
</div>
