<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: perilaku.php
// Lokasi      		: application/views/kepala
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
$tm = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
$xloc = base_url().'kepala/bukuperilaku';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-9"><select name="tahun" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$tahun.'">'.$tahun.'</option>';
	foreach($tm->result() as $m)
	{
	echo '<option value="'.$xloc.'/'.substr($m->thnajaran,0,4).'">'.substr($m->thnajaran,0,4).'</option>';
	}
	echo '</select></div></div>';
if(!empty($tahun))
{
	$ta = $this->db->query("select * from `p_pegawai` where nip !='' and `status`='Y' order by nama_tanpa_gelar");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Guru</label></div><div class="col-sm-9">';
	?>
	<select name="kodeguru" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	$namaguru = cari_nama_pegawai($kodeguru);
	echo '<option value="'.$xloc.'/'.$tahun.'/'.$kodeguru.'">'.$namaguru.'</option>';
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$a->kode.'">'.$a->nama_tanpa_gelar.' '.$a->nama.'</option>';
	}
	echo '</select></div></div>';
}
echo '</form>';
if(!empty($kodeguru))
{
	for($i=1;$i<=12;$i++)
	{
		$bulane = gantibulan($i);
		$tb = $this->db->query("SELECT * FROM `skp_realisasi` WHERE `kodeguru`='$kodeguru' and `bulan` <= '$i'");
		$adatb  = $tb->num_rows();
		$cacahitem = 0;
		$jskp = 0;
		if($i == 12)
		{
			$ta = $this->db->query("select * from `skp_skor_guru` where `kodeguru`='$kodeguru' and `tahun`= '$tahun'");
			foreach($ta->result() as $a)
			{
				if(($a->kegiatan == 'Unsur utama') or ($a->kegiatan == 'Unsur Penunjang Tugas Guru'))
				{

				}
				else
				{
					$pembagi = 0;
					$to = $a->kuantitas;
					$ro = $a->kuantitas_r;
					$tw = $a->waktu;
					$rw = $a->waktu_r;
					$tk = $a->kualitas;
					$rk = $a->kualitas_r;
					$rb = $a->biaya_r;
					$tb = $a->biaya;
					$aspek_kualitas  = 0;
					$aspek_kuantitas  = 0;
					if ($tk>0)
					{
						$aspek_kualitas  = $rk / $tk * 100;
					}
					if ($to>0)
					{
						$aspek_kuantitas  = $ro / $to * 100;
					}
					if ($tb == 0)
					{
						$persentase_biaya = 0;
					}
					else
					{
						$persentase_biaya = 100 - ($rb/$tb*100);
					}
					if ($tw>0)
					{
						$persentase_waktu = 100 - ($rw/$tw*100);
						if (($persentase_waktu < 24 ) or ($persentase_waktu == 24 ))
						{
							$aspek_waktu = ((1.76*$tw)-$rw)/$tw*100;
						}
						else
						{
							$aspek_waktu_a = ((1.76*$tw)-$rw)/$tw*100;
							$aspek_waktu = 176 - $aspek_waktu_a;
						}
					}
					else
					{
						$aspek_waktu = 0;
					}
					if (($persentase_biaya < 24 ) or ($persentase_biaya == 24 ))
					{
						if ($persentase_biaya == 0)
						{
							$aspek_biaya = 0;
						}
						else
						{
						$aspek_biaya = ((1.76*$tb)-$rb)/$tb*100;
						}
					}
					else
					{
						$aspek_biaya_a = ((1.76*$tb)-$rb)/$tb*100;
						$aspek_biaya = 176 - $aspek_biaya_a;
					}
					if ($aspek_kuantitas != 0)
					{
						$pembagi++;
					} 
					if ($aspek_kualitas != 0)
					{
						$pembagi++;
					} 
					if ($aspek_waktu != 0)
					{
						$pembagi++;
					} 
					if ($aspek_biaya !=0)
					{
						$pembagi++;
					} 
					$perhitungan = $aspek_kuantitas+$aspek_kualitas+$aspek_waktu+$aspek_biaya;
					if ($pembagi == 0)
					{$skp = 0;}
					else
					{
						$skp = $perhitungan/$pembagi;
					}
					$cacahitem++;
					$jskp = $jskp + $skp;
					//echo $pembagi.' '.$jskp.'<br />';
				}
			}
		}
		else
		{
			//echo $adatb.' ';
			$id_skp = '';
			foreach($tb->result() as $b)
			{
				$id_skp_skor_guru = $b->id_skp;
				if($id_skp_skor_guru != $id_skp)
				{
				//echo 'id_skp '.$id_skp.' id_skor_guru '.$id_skp_skor_guru.' ';
					$ta = $this->db->query("select * from `skp_skor_guru` where `id_skp_skor_guru` = $id_skp_skor_guru");
					foreach($ta->result() as $a)
					{
						$pembagi = 0;
						$to = $a->kuantitas;
						$ro = $a->kuantitas_r;
						$tw = $a->waktu;
						$rw = $a->waktu_r;
						$tk = $a->kualitas;
						$rk = $a->kualitas_r;
						$rb = $a->biaya_r;
						$tb = $a->biaya;
						$aspek_kualitas  = 0;
						$aspek_kuantitas  = 0;
						if ($tk>0)
						{
							$aspek_kualitas  = $rk / $tk * 100;
						}
						if ($to>0)
						{
							$aspek_kuantitas  = $ro / $to * 100;
						}
						if ($tb == 0)
						{
							$persentase_biaya = 0;
						}
						else
						{
							$persentase_biaya = 100 - ($rb/$tb*100);
						}
						if ($tw>0)
						{
							$persentase_waktu = 100 - ($rw/$tw*100);
							if (($persentase_waktu < 24 ) or ($persentase_waktu == 24 ))
							{
								$aspek_waktu = ((1.76*$tw)-$rw)/$tw*100;
							}
							else
							{
								$aspek_waktu_a = ((1.76*$tw)-$rw)/$tw*100;
								$aspek_waktu = 176 - $aspek_waktu_a;
							}
						}
						else
						{
							$aspek_waktu = 0;
						}
						if (($persentase_biaya < 24 ) or ($persentase_biaya == 24 ))
						{
							if ($persentase_biaya == 0)
							{
								$aspek_biaya = 0;
							}
							else
							{
								$aspek_biaya = ((1.76*$tb)-$rb)/$tb*100;
							}
						}
						else
						{
							$aspek_biaya_a = ((1.76*$tb)-$rb)/$tb*100;
							$aspek_biaya = 176 - $aspek_biaya_a;
						}
						if ($aspek_kuantitas != 0)
						{
							$pembagi++;
						} 
						if ($aspek_kualitas != 0)
						{
							$pembagi++;
						} 
						if ($aspek_waktu != 0)
						{
							$pembagi++;
						} 
						if ($aspek_biaya !=0)
						{
							$pembagi++;
						} 
						$perhitungan = $aspek_kuantitas+$aspek_kualitas+$aspek_waktu+$aspek_biaya;
						if ($pembagi == 0)
						{$skp = 0;}
						else
						{
							$skp = $perhitungan/$pembagi;
						}
							$cacahitem++;					
						$jskp = $jskp + $skp;
						//echo $id_skp_skor_guru.' t<br />';
					}
				}
				$id_skp = $id_skp_skor_guru;
			}
		}
		if($cacahitem >0)
		{
			$jskp = $jskp / $cacahitem;
		}
		else
		{
			$jskp = 0;
		}
		$bulanpost = $i;
		if($i<10)
		{
			$bulanpost = '0'.$i;
		}
		$jskp = round($jskp,2);
		$this->db->query("update `perilaku_pns` set `hasil_skp`='$jskp' where `tahun`='$tahun' and `bulan`='$bulanpost' and `kode`='$kodeguru'");
		echo ''.$bulane.' '.$jskp.'<br />';
	}
}
?>
</div></div></div>
