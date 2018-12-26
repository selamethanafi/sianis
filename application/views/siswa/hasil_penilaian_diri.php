<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 29 Okt 2015 07:05:08 WIB 
// Nama Berkas 		: penilaian_diri.php
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
<?php
if((empty($thnajaran)) or (empty($semester)))
{
	$tb = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by `thnajaran`, `semester`");
	echo '<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Aksi</strong></td></tr>';
	$nomor =1;
	foreach($tb->result() as $b)
	{
		$tahun1 = substr($b->thnajaran,0,4);
		$semester = $b->semester;
		echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$b->thnajaran.'</td><td align="center">'.$semester.'</td><td align="center"><a href="'.base_url().'siswa/hasilpenilaiandiri/'.$tahun1.'/'.$semester.'" title="Melihat / Mengubah Hasil Penilaian Diri Semester '.$semester.' Tahun '.$b->thnajaran.'"><span class="fa fa-edit"></span></a></td></tr>';
		$nomor++;
	}
	echo '</table>';
}
else
{
	//cari kurikulum
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	$tg = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	$cacahsiswa = $tg->num_rows();
	if($cacahsiswa>1)
		{
		$cacahsiswa = $cacahsiswa - 1;
		}

	echo 'Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'<br />';
	$tahun1 = substr($thnajaran,0,4);
	$ta = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' ORDER BY `golongan` , `id_sikap_spiritual` ");
	$adata = $ta->num_rows();
	$simpulansistem = '';
	if($adata>0)
	{
		$td = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`!='$nis'");
		$adatd = $td->num_rows();
		$tf = $this->db->query("select * from nilai_akhlak where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		$cacahguru = $tf->num_rows();
		$nomor =1;
		echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>Aspek yang diamati</strong></td><td colspan="4"><strong>Anda</strong></td><td colspan="4"><strong>Cacah Teman<br />'.$adatd.'</strong></td><td colspan="4"><strong>Cacah Guru<br />'.$cacahguru.'</strong></td><td colspan="4"><strong>Nilai Akhir</strong></td><tr align="center"><td><strong>1</strong></td><td><strong>2</strong></td><td><strong>3</strong></td><td><strong>4</strong></td><td><strong>1</strong></td><td><strong>2</strong></td><td><strong>3</strong></td><td><strong>4</strong></td><td><strong>1</strong></td><td><strong>2</strong></td><td><strong>3</strong></td><td><strong>4</strong></td><td><strong>1</strong></td><td><strong>2</strong></td><td><strong>3</strong></td><td><strong>4</strong></td></tr>';

		foreach($ta->result() as $a)
		{	
			$cacah1 = 0;
			$cacah2 = 0;
			$cacah3 = 0;
			$cacah4 = 0;
			//cari nilai
			$tc = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`='$nis'");
			$iteme = 'i'.$nomor;
			$skor = '';
			foreach($tc->result() as $c)
				{
				$skor = $c->$iteme;
				}
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->item.'</td>';
			if($skor == 4)
				{echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td>';}
			elseif($skor == 3)
				{echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td>';}
			elseif($skor == 2)
				{echo '<td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td>';}
			elseif($skor == 1)
				{echo '<td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';}
			else
				{echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';}
			//cari hasil teman
			$itemjumlah1 = 0;
			$itemjumlah2 = 0;
			$itemjumlah3 = 0;
			$itemjumlah4 = 0;
			$td = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`!='$nis'");
			$simpulan = '';
			if($adatd>0)
			{
				foreach($td->result() as $d)
				{
					if($d->$iteme == '1')
					{
						$itemjumlah1++; 			
					}
					if($d->$iteme == '2')
					{
						$itemjumlah2++; 			
					}
					if($d->$iteme == '3')
					{
							$itemjumlah3++; 			
					}
					if($d->$iteme == '4')
					{
						$itemjumlah4++; 			
					}
				}
				$tertinggi = max($itemjumlah1,$itemjumlah2,$itemjumlah3,$itemjumlah4);
				if($tertinggi == $itemjumlah1)
					{
					$simpulan = 1;
					}
				if($tertinggi == $itemjumlah2)
				{
					$simpulan = 2;
				}
				if($tertinggi == $itemjumlah3)
				{
					$simpulan = 3;
				}
				if($tertinggi == $itemjumlah4)
				{
					$simpulan = 4;
				}

				if($cacahsiswa > 0)
				{
				$itemjumlah1 = round($itemjumlah1/$cacahsiswa*100,0).'%';
				$itemjumlah2 = round($itemjumlah2/$cacahsiswa*100,0).'%';
				$itemjumlah3 = round($itemjumlah3/$cacahsiswa*100,0).'%';
				$itemjumlah4 = round($itemjumlah4/$cacahsiswa*100,0).'%';
				}
			}
				if($simpulan == '')
				{
				echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			if($simpulan == '1')
			{
			echo '<td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			if($simpulan == '2')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			if($simpulan == '3')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td>';
			}
			if($simpulan == '4')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td>';
			}
			//dari guru
			$itemjumlahguru1 = 0;
			$itemjumlahguru2 = 0;
			$itemjumlahguru3 = 0;
			$itemjumlahguru4 = 0;
			if($nomor == 1)
				{
				$itemeguru = 'satu';
				}
			if($nomor == 2)
				{
				$itemeguru = 'dua';
				}
			if($nomor == 3)
				{
				$itemeguru = 'tiga';
				}
			if($nomor == 4)
				{
				$itemeguru = 'empat';
				}
			if($nomor == 5)
				{
				$itemeguru = 'lima';
				}
			if($nomor == 6)
				{
				$itemeguru = 'enam';
				}
			if($nomor == 7)
				{
				$itemeguru = 'tujuh';
				}
			if($nomor == 8)
				{
				$itemeguru = 'delapan';
				}
			if($nomor == 9)
				{
				$itemeguru = 'sembilan';
				}
			if($nomor == 10)
				{
				$itemeguru = 'sepuluh';
				}
			if($nomor>10)
			{
				$itemeguru = 'sepuluh';
			}
			if($nomor>11)
			{
				$itemeguru = 'i11';
			}
			if($nomor>12)
			{
				$itemeguru = 'i12';
			}
			if($nomor>13)
			{
				$itemeguru = 'i13';
			}
			if($nomor>14)
			{
				$itemeguru = 'i14';
			}
			if($nomor>15)
			{
				$itemeguru = 'i15';
			}
			if($nomor>15)
			{
				$itemeguru = 'i15';
			}

			foreach($tf->result() as $f)
			{
				if($f->$itemeguru == '1')
				{
					$itemjumlahguru1++; 			
				}
				if($f->$itemeguru == '2')
				{
					$itemjumlahguru2++; 			
				}
				if($f->$itemeguru == '3')
				{
					$itemjumlahguru3++; 			
				}
				if($f->$itemeguru == '4')
				{
					$itemjumlahguru4++; 			
				}
			}
			$simpulanguru = '';
			$tertinggiguru = max($itemjumlahguru1,$itemjumlahguru2,$itemjumlahguru3,$itemjumlahguru4);
			if($tertinggiguru == $itemjumlahguru1)
				{
				$simpulanguru = 1;
				}

			if($tertinggiguru == $itemjumlahguru2)
				{
				$simpulanguru = 2;
				}
			if($tertinggiguru == $itemjumlahguru3)
				{
				$simpulanguru = 3;
				}
			if($tertinggiguru == $itemjumlahguru4)
				{
				$simpulanguru = 4;
				}

		
			if($cacahguru > 0)
			{
				$itemjumlahguru1 = round($itemjumlahguru1/$cacahguru*100,0).'%';
				$itemjumlahguru2 = round($itemjumlahguru2/$cacahguru*100,0).'%';
				$itemjumlahguru3 = round($itemjumlahguru3/$cacahguru*100,0).'%';
				$itemjumlahguru4 = round($itemjumlahguru4/$cacahguru*100,0).'%';
			}
			if(($simpulanguru == '') or ($cacahguru == 0))
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			elseif($simpulanguru == '1')
			{
			echo '<td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			elseif($simpulanguru == '2')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			elseif($simpulanguru == '3')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td>';
			}
			elseif($simpulanguru == '4')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td>';
			}
			else
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			//simpulan sistem
			if($kurikulum == '2015')
			{
				$th = $this->db->query("select * from nilai_akhlak where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and `kodeguru`='00'");
				if($nomor == 1)
				{
					$itemewalikelas = 'satu';
				}
				if($nomor == 2)
				{
				$itemewalikelas = 'dua';
				}
				if($nomor == 3)
				{
				$itemewalikelas = 'tiga';
				}
				if($nomor == 4)
				{
				$itemewalikelas = 'empat';
				}
				if($nomor == 5)
				{
				$itemewalikelas = 'lima';
				}
				if($nomor == 6)
				{
				$itemewalikelas = 'enam';
				}
				if($nomor == 7)
				{
				$itemewalikelas = 'tujuh';
				}
				if($nomor == 8)
				{
				$itemewalikelas = 'delapan';
				}
				if($nomor == 9)
				{
				$itemewalikelas = 'sembilan';
				}
				if($nomor == 10)
				{
				$itemewalikelas = 'sepuluh';
				}
				if($nomor>10)
				{
					$itemewalikelas = 'sepuluh';
				}
				if($nomor>11)
				{
				$itemewalikelas = 'i11';
				}
				if($nomor>12)
				{
					$itemewalikelas = 'i12';
				}
				if($nomor>13)
				{
					$itemewalikelas = 'i13';
				}
				if($nomor>14)
				{
					$itemewalikelas = 'i14';
				}
				if($nomor>15)
				{
					$itemewalikelas = 'i15';
				}
				if($nomor>16)
				{
					$itemewalikelas = 'i15';
				}
				foreach($th->result() as $h)
				{
				if($h->$itemewalikelas == '1')
				{
					$simpulansistem = '1';
				}
				if($h->$itemewalikelas == '2')
				{
					$simpulansistem = '2';
				}
				if($h->$itemewalikelas == '3')
				{
					$simpulansistem = '3';
				}
				if($h->$itemewalikelas == '4')
				{
					$simpulansistem = '4';
				}
			}

				
			}
			else
			{
				if($skor == 1)
				{
				$cacah1++;
				}
				if($simpulan == 1)
				{
				$cacah1++;
				}
				if($simpulanguru == 1)	
				{
				$cacah1++;
				}
				if($skor == 2)
				{
				$cacah2++;
				}
				if($simpulan == 2)
				{
				$cacah2++;
				}
				if($simpulanguru == 2)
				{
				$cacah2++;
				}
				if($skor == 3)
				{
				$cacah3++;
				}
				if($simpulan == 3)
				{
				$cacah3++;
				}
				if($simpulanguru == 3)
				{
				$cacah3++;
				}
				if($skor == 4)
				{
				$cacah4++;
				}
				if($simpulan == 4)
				{
				$cacah4++;
				}
				if($simpulanguru == 4)
				{
					$cacah4++;
				}
				$tertinggisistem = max($cacah1,$cacah2,$cacah3,$cacah4);
				if($tertinggisistem == $cacah1)
				{
					$simpulansistem = 1;
				}
				if($tertinggisistem == $cacah2)
				{
				$simpulansistem = 2;
				}
				if($tertinggisistem == $cacah3)
				{
				$simpulansistem = 3;
				}
				if($tertinggisistem == $cacah4)
				{
				$simpulansistem = 4;
				}
			}
			if($simpulansistem == '')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			elseif($simpulansistem == '1')
			{
			echo '<td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40">'.$cacah.'</td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			elseif($simpulansistem == '2')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			elseif($simpulansistem == '3')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td>';
			}
			elseif($simpulansistem == '4')
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td>';
			}
			else
			{
			echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';
			}
			echo '</tr>';
		$nomor++;
		}
		echo '</table>';

	}
	else
	{
	echo '<div class="alert alert-warning">Belum ada Aspek yand diamati silakan menghubungi wali, pengajaran, atau waka kurikulum</div>';
	}
}

echo '</div></div></div>';
