<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: deskripsi_sikap_spiritual_sosial_antarmapel_2015.php
// Lokasi      		: application/views/guru/
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
<div class="container-fluid"><h3>Proses Deskripsi Sikap Spiritual dan Sosial</h3>
<p><a href="<?php echo base_url();?>guru/daftarsiswa/<?php echo $id_walikelas;?>/spiritual" class="btn btn-info">Kembali ke Penilaian</a> <a href="<?php echo base_url();?>guru/walikelas" class="btn btn-info">Kembali ke Tugas Walikelas</a> <a href="<?php echo base_url();?>guru/daftarsiswa/<?php echo $id_walikelas;?>" class="btn btn-info">Kembali ke Daftar Siswa</a> </p>
<?php
$adagurubelum = 0;
if((!empty($thnajaran)) and(!empty($semester)) and (!empty($id_walikelas)))
{
	$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by golongan,id_sikap_spiritual");
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
				$namaguru = cari_nama_pegawai($dma->kodeguru);
			if(empty($rekapkodeguru))
			{

				$rekapkodeguru .= '<strong>'.$namaguru.'</strong>';
			}
			else
			{
				$rekapkodeguru .= ', <strong>'.$namaguru.'</strong>';
			}
		}
		if($aksi == 'acuhkan')
		{
			$adagurubelum = 0;
		}
		if($adagurubelum>0)
		{
			echo '<div class="alert alert-danger"><strong>Belum dapat diproses.</strong><p>Ada guru yang belum mengirim penilaian sikap spiritual dan sosial antarmapel</p><p>';
			echo $rekapkodeguru;
			echo '</p></div>';
			echo '<p class="text-center"><a href="'.base_url().'guru/daftarsiswa/'.$id_walikelas.'/proses/acuhkan" class="btn btn btn-primary">Proses dengan mengabaikan penilaian dari guru</a></p>';

		}
		else
		{

			$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by golongan,id_sikap_spiritual");
			$itemke = 1;
			$cacahe=0;
			$cacahspiritual = 0;
			$cacahsosial = 0;
			foreach($tb->result() as $b)
			{
				$golongan = $b->golongan;
				if(empty($golongan))
				{
					$des[$itemke] = $b->item;
					$cacahspiritual++;
				}
				else
				{
					$des[$itemke] = $b->item;
					$cacahsosial++;
				}
				$itemke++;

			}
			$cacahe = $itemke;
			$daftarsiswa = $this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and `status`='Y'");
			$nomor=1;
			foreach($daftarsiswa->result() as $b)
			{
				$nis = $b->nis;
				$namasiswa = nis_ke_nama($nis);
				$tnilaiakhlak = $this->db->query("select * from `siswa_penilaian_diri_rekap` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
				$des_AB1 = '';
				$des_B1 = '';
				$des_C1 = '';
				$des_K1 = '';
				$c_AB1 = 0;
				$c_B1 = 0;
				$c_C1 = 0;
				$c_K1 = 0;
				$des_AB2 = '';
				$des_B2 = '';
				$des_C2 = '';
				$des_K2 = '';
				$c_AB2 = 0;
				$c_B2 = 0;
				$c_C2 = 0;
				$c_K2 = 0;

				//golo
				$itemke = 1;
				do
				{
					$j["$itemke"] = 0;
					$iteme = 'i'.$itemke;
					$deskripsi = '';
					foreach($tnilaiakhlak->result() as $d)
					{
						if($itemke>$cacahspiritual)
						{
							if($d->$iteme == '4')
							{
								if(empty($des_AB1))
								{
									$des_AB1 .= $des[$itemke];
								}
								else
								{
									$des_AB1.= ', '.$des[$itemke];
								}
								$c_AB1++;
							}
							elseif($d->$iteme == '3')
							{
								if(empty($des_B1))
								{
									$des_B1 .= $des[$itemke];
								}
								else
								{
									$des_B1 .= ', '.$des[$itemke];
								}
								$c_B1++;
							}
							elseif($d->$iteme == '2')
							{
								if(empty($des_C1))
								{
									$des_C1 .= ''.$des[$itemke];
								}
								else
								{
									$des_C1 .= ', '.$des[$itemke];
								}
								$c_C1++;
							}
							else
							{
								if(empty($des_K1))
								{
									$des_K1 .= ''.$des[$itemke];
								}
								else
								{
									$des_K1 .= ', '.$des[$itemke];
								}
								$c_K1++;
							}

						}
						else
						{
							if($d->$iteme == '4')
							{
								if(empty($des_AB2))
								{
									$des_AB2 .= $des[$itemke];
								}
								else
								{
									$des_AB2.= ', '.$des[$itemke];
								}
								$c_AB2++;
							}
							elseif($d->$iteme == '3')
							{
								if(empty($des_B2))
								{
									$des_B2 .= $des[$itemke];
								}
								else
								{
									$des_B2 .= ', '.$des[$itemke];
								}
								$c_B2++;
							}
							elseif($d->$iteme == '2')
							{
								if(empty($des_C2))
								{
									$des_C2 .= $des[$itemke];
								}
								else
								{
									$des_C2 .= ', '.$des[$itemke];
								}
								$c_C2++;
							}
							else
							{
								if(empty($des_K2))
								{
									$des_K2 .= $des[$itemke];
								}
								else
								{
									$des_K2 .= ', '.$des[$itemke];
								}
								$c_K2++;
							}

						}

					}
					$itemke++;
				}
				while($itemke<$cacahe);
				$deskripsi1 = '';
				$deskripsi2 = '';
				if (!empty($des_AB1))
				{
					$deskripsi1 = "Peserta didik sudah bersungguh-sungguh (konsisten) menerapkan sikap ".$des_AB1.".";
				}
				if (!empty($des_B1))
				{
					if (!empty($deskripsi1))
					{
						$deskripsi1 .= " Peserta didik sudah menerapkan sikap ".$des_B1.".";
					}
					else
					{
						$deskripsi1 .= "Peserta didik sudah menerapkan sikap ".$des_B1.".";
					}
				}
				if (!empty($des_C1))
				{
					if (!empty($deskripsi1))
					{
						$deskripsi1 .= " Peserta didik belum bersungguh - sungguh menerapkan sikap ".$des_C1.".";
					}
					else
					{
						$deskripsi1 .= "Peserta didik belum bersungguh - sungguh menerapkan sikap ".$des_C1.".";
					}
				}
				if (!empty($des_K1))
				{
					if (!empty($deskripsi1))
					{
						$deskripsi1 .= " Peserta didik tidak pernah menerapkan sikap ".$des_K1.".";
					}
					else
					{
						$deskripsi1 .= "Peserta didik tidak pernah menerapkan sikap ".$des_K1.".";
					}
				}
				$predikat1 = max($c_K1,$c_C1,$c_B1,$c_AB1);
				if($predikat1 == $c_AB1)
				{
					$simpulanwali1 = 'A';
				}
				elseif($predikat1 == $c_B1)
				{
					$simpulanwali1 = 'B';
				}
				elseif($predikat1 == $c_C1)
				{
					$simpulanwali1 = 'C';
				}
				elseif($predikat1 == $c_K1)
				{
					$simpulanwali1 = 'K';
				}
				if($predikat1 == 0)
				{
					$simpulanwali1 = 'X';
				}
				if (!empty($des_AB2))
				{
					$deskripsi2 = "Peserta didik sudah bersungguh-sungguh (konsisten) menerapkan sikap ".$des_AB2.".";
				}
				if (!empty($des_B2))
				{
					if (!empty($deskripsi2))
					{
						$deskripsi2 .= " Peserta didik sudah menerapkan sikap ".$des_B2.".";
					}
					else
					{
						$deskripsi2 .= "Peserta didik sudah menerapkan sikap ".$des_B2.".";
					}
				}
				if (!empty($des_C2))
				{
					if (!empty($deskripsi2))
					{
						$deskripsi2 .= " Peserta didik belum bersungguh - sungguh menerapkan sikap ".$des_C2.".";
					}
					else
					{
						$deskripsi2 .= "Peserta didik belum bersungguh - sungguh menerapkan sikap ".$des_C2.".";
					}
				}
				if (!empty($des_K2))
				{
					if (!empty($deskripsi2))
					{
						$deskripsi2 .= " Peserta didik tidak pernah menerapkan sikap ".$des_K2.".";
					}
					else
					{
						$deskripsi2 .= "Peserta didik tidak pernah menerapkan sikap ".$des_K2.".";
					}
				}
				$predikat2 = max($c_K2,$c_C2,$c_B2,$c_AB2);
				if($predikat2 == $c_AB2)
				{
					$simpulanwali2 = 'A';
				}
				elseif($predikat2 == $c_B2)
				{
					$simpulanwali2 = 'B';
				}
				elseif($predikat2 == $c_C2)
				{
					$simpulanwali2 = 'C';
				}
				elseif($predikat2 == $c_K2)
				{
					$simpulanwali2 = 'K';
				}
				if($predikat2 == 0)
				{
					$simpulanwali2 = 'X';
				}

				$ta = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
				if(count($ta->result())==0)
				{
					$this->db->query("insert into `kepribadian`  (`kom1`, `thnajaran`, `semester`, `nis`,`kelas`) values ('$deskripsi', '$thnajaran', '$semester', '$nis', '$kelas')");
				}
					$this->db->query("update kepribadian set `satu`='$simpulanwali2', kom1 = '$deskripsi2', `dua`='$simpulanwali1', kom2 = '$deskripsi1' where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
				
			}
	
		}
	}
	if($adagurubelum==0)
	{
		$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ASC");
		echo '<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
		<tr align="center"><td width="50"><strong>No.</strong></td><td width="50"><strong>NIS</strong></td><td width="200"><strong>Nama</strong></td><td><strong>Deskripsi Sikap Spiritual</strong></td><td><strong>Deskripsi Sikap Sosial</strong></td></tr>';
		$nomor = 1;
		foreach($tdata_siswa->result() as $e)
		{
			$nis = $e->nis;
			$namasiswa = nis_ke_nama($nis);
			$ta = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
			foreach($ta->result() as $a)
			{
			echo "<tr><td>".$nomor."</td><td>".$nis."</td><td>".$namasiswa."</td><td>";
			if(($a->satu == 'A') or ($a->satu == 'B'))
				{echo '<div class="alert alert-success">'.predikat_sikap($a->satu).'</div>';}
			else
				{echo '<div class="alert alert-danger">'.predikat_sikap($a->satu).'</div>';}
			echo $a->kom1."</td><td>";
			if(($a->dua == 'A') or ($a->dua == 'B'))
				{echo '<div class="alert alert-success">'.predikat_sikap($a->dua).'</div>';}
			else
			{echo '<div class="alert alert-danger">'.predikat_sikap($a->dua).'</div>';}
			echo $a->kom2."</td></tr>";
			}
			$nomor++;
		}
		echo '</table></div>';
	}	
} // akhir kalau semua sudah mengirim
?>
</div>
