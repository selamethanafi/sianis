<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: lck.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
	$jenis_deskripsi = 0;
	$tingkat = '';
	$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	foreach($tmapel->result() as $dtmapel)
	{
		$jenis_deskripsi = $dtmapel->jenis_deskripsi;
		$materi1 = $dtmapel->materi1;
		$materi2 = $dtmapel->materi2;
		$materi3 = $dtmapel->materi3;
		$materi4 = $dtmapel->materi4;
		$materi5 = $dtmapel->materi5;
		$materi6 = $dtmapel->materi6;
		$kelas =$dtmapel->kelas;
	}
	$tingkat = kelas_jadi_tingkat($kelas);
if($kurikulum == '2013')
{
	$ranah = 'KPA';
}
if($kurikulum == '2015')
{
	$ranah = 'KP';
}

if($kkm_mid == 0)
{
	$kkm_mid = $kkm;
}
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/nilai"><span class="glyphicon glyphicon-arrow-left"></span> <b>Kembali</b></a></p>
<?php
	if ($jenis_deskripsi==1)
		{$jenis_deskripsine = "Berdasarkan Ulangan (Deskripsi Otomatis)";
		}
	if ($jenis_deskripsi==2)
		{
		$jenis_deskripsine = "Berdasarkan Nilai Akhir (Deskripsi Otomatis)";
		}
	if ($jenis_deskripsi==5)
		{
		$jenis_deskripsine = "Berdasarkan Nilai Sekolah (NS) (Deskripsi Otomatis)";
		}

	if ($jenis_deskripsi==3)
		{
		$jenis_deskripsine = "Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)";
		}
	if ($jenis_deskripsi==0)
		{$jenis_deskripsine = "Kopi Paste / Manual";
		}
	if ($jenis_deskripsi==4)
		{$jenis_deskripsine = "Berdasar bank deskripsi";
		}

if(empty($itemnilai))
{

if(($jenis_deskripsi==1) or ($jenis_deskripsi==3))
{
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
			$td = $this->db->query("select * from deskripsi_capaian_nilai where `id_mapel`='$id_mapel' and `nis` = '$nis' and `positif`='0' order by nis ASC,ket ASC");
			foreach($td->result() as $d)
			{
				$kete = $d->ket;
				if ($ket != $kete)
				{
					$ket = $kete;
					if (empty($des2))
					{
					$des2 .= $kete." ".$d->materi;
					}
					else
					{
					$des2 .= ", ".$kete." ".$d->materi;
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
				$desk .= ", namun ".$des2;	
				}
			}
		
		$desk = ucfirst($desk);
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
							{$ket = 'Belum Kompeten';$ket2 = 'Belum Kompeten';
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

		$desk = nopetik($desk);
		$this->db->query("update `nilai` set `keterangan`='$desk', `ket_akhir`='$ket2', `ket`='$ket' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' ");
		}

	} //akhir kalau ada daftar nilai
}//akhir deskripsi == 1;
//kalau deskripsi == 2
if(($jenis_deskripsi=='2') or ($jenis_deskripsi=='5'))
{
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
			if ($nilaipengetahuan >= 90)
			{
				$desk = $materi1;
			}
			elseif ($nilaipengetahuan >= 85)
			{
				$desk = $materi2;
			}
			elseif ($nilaipengetahuan >= 75)
			{
				$desk = $materi3;
			}
			elseif ($nilaipengetahuan >= 70)
			{
				$desk = $materi4;
			}
			elseif ($nilaipengetahuan >= 60)
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
						{$ket = 'Belum Kompeten';$ket2 = 'Belum Kompeten';
						}
					}
		$desk = nopetik($desk);
		$this->db->query("update `nilai` set `keterangan`='$desk', `ket_akhir`='$ket2', `ket`='$ket' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' ");
		} 
	} //akhir kalau ada daftar nilai


}//akhir deskripsi == 2;
	if(($jenis_deskripsi == '') or ($jenis_deskripsi == 0) or ($jenis_deskripsi == 4))
	{

		if(count($query->result())>0)
		{
			foreach($query->result() as $t)
			{
				$ket_akhir = 'Sudah kompeten';
				$ket = 'Sudah kompeten';
				$nis = $t->nis;
				if ($ranah == 'KP') 
				{
					if ($t->kog < $kkm)
					{
					$ket_akhir = 'Belum kompeten';
					}
					if ($t->nilai_nr < $kkm)
					{
					$ket = 'Belum kompeten';
					}
					if ($t->psi < $kkm)
					{
						$ket_akhir = 'Belum kompeten';
					}
					if ($t->psikomotor < $kkm)
					{
						$ket = 'Belum kompeten';
					}

				}

				if ($ranah == 'KPA') 
				{
					if ($t->kog < $kkm)
					{
					$ket_akhir = 'Belum kompeten';
					}
					if ($t->nilai_nr < $kkm)
					{
					$ket = 'Belum kompeten';
					}
				}
				if ($ranah == 'KA') 
				{
					if ($t->kog < $kkm)
					{
					$ket_akhir = 'Belum kompeten';
					}
					if ($t->nilai_nr < $kkm)
					{
					$ket = 'Belum kompeten';
					}
				}
				if (($ranah == 'PA') or ($ranah == 'KPA'))
				{
					if ($t->psi < $kkm)
					{
						$ket_akhir = 'Belum kompeten';
					}
					if ($t->psikomotor < $kkm)
					{
						$ket = 'Belum kompeten';
					}
				}
				if(($ranah == 'KPA') or ($ranah == 'PA') or ($ranah == 'KA'))
				{
					if (($t->afektif !='A')  and ($t->afektif!='B') and ($t->afektif !='SB'))
					{
						$ket_akhir = 'Belum kompeten';
						$ket = 'Belum kompeten';
					}
				}
				$this->db->query("update `nilai` set `ket`='$ket', `ket_akhir`='$ket_akhir' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
			}
		}
	}
}

if(count($query->result())>0){
if($jenis_deskripsi == 3)
	{
	echo form_open('guru/updatelck','class="form-horizontal" role="form"');
	}
	else
	{
	echo form_open('guru/updaterapor','class="form-horizontal" role="form"');
	}

?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $mapel;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ranah Penilaian</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $ranah;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">KKM</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kkm;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Deskripsi</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $jenis_deskripsi.' '.$jenis_deskripsine;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kurikulum</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kurikulum;?></p></div></div>
<p class="text-info">Jika kolom rapor tercentang atau Y maka siswa dapat melihat nilai rapor. Jika kolom rapor tidak tercentang atau T maka siswa tidak dapat melihat nilai rapor</p>
<?php
$k1 = 25;
$k2 = 150;
echo '<div class="table-responsive">
<table class="table table-hover table-striped table-bordered"><tr align="center"><td width="'.$k1.'" rowspan="2"><strong>No.</strong></td><td width="'.$k2.'" rowspan="2"><strong>Nama</strong></td>';
if($kurikulum == '2013')
{
	$k3 = 25;
	$k4 = $k3;
	$k34 = $k3+$k4;
	$k5 = $k3;
	$k6 = $k3;
	$k7 = $k3;
	$k8 = 40;
	$k345678 = $k3+$k4+$k5+$k6+$k7+$k8;
	$k9 = $k3;
	$k10 = $k3;
	$k11 = $k3;
	$k12 = $k3;
	$k13 = $k3;
	$k14 = $k3;
	$k91011121314 = $k9+$k10+$k11+$k12+$k13+$k14;
	$k910 = $k9+$k10;
	$k15 = $k1;
	echo '<td width="25"rowspan="2"><strong>MID</strong></td><td width="'.$k345678.'" colspan="6"><strong>Sementara</strong></td><td width="'.$k91011121314.'" colspan="6"><strong>FINAL</strong></td><td width="'.$k15.'" rowspan="2"><strong>Rapor</strong></td><td rowspan="2"><a href="'.base_url().'guru/lck/'.$id_mapel.'/4" title="Ubah Deskripsi Capaian Kompetensi"><strong>Keterangan</strong></a></p></div></div>';
echo '<tr bgcolor="#fff" align="center"><td width="'.$k34.'" colspan="2" bgcolor="#fff"><strong><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/10">Kog</strong></a></td><td width="'.$k34.'" colspan="2"><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'"><strong>Psi</strong></a></td><td width="'.$k5.'"><a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'"><strong>Afe</strong></a></td><td width="'.$k6.'"><strong>Tuntas</strong></td><td width="'.$k910.'" colspan="2" bgcolor="#fff"><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/13"><strong>Kog</strong></a></td><td width="'.$k910.'" colspan="2"><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'/19"><strong>Psi</strong></a></td><td width="'.$k11.'"><a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'"><strong>Afe</strong></a></td><td width="'.$k12.'"><strong>Ketuntasan</p></div></div>';
	}
elseif(($kurikulum == 'KTSP') or ($kurikulum == '2015'))
{
	$k3 = 25;
	$k4 = $k3;
	$k5 = $k3;
	$k6 = $k3;
	$k3456 = $k3+$k4+$k5+$k6;
	$k7 = $k3;
	$k8 = $k3;
	$k9 = $k3;
	$k10 = $k3;
	$k345678 = $k3+$k4+$k5+$k6+$k7+$k8;
	$k78910 = $k7+$k8+$k9+$k10;
	$k11 = $k3;
	$k12 = $k3;
	$k13 = $k3;
	$k14 = $k3;
	$k91011121314 = $k9+$k10+$k11+$k12+$k13+$k14;
	$k910 = $k9+$k10;
	$k15 = $k1;
	if($ranah == 'KP')
	{
		echo '<td width="25"rowspan="2"><strong>MID</strong></td><td width="'.$k3456.'" colspan="3"><strong>LHB</strong></td><td width="'.$k78910.'" colspan="3"><strong>FINAL</strong></td>';
		echo '<td rowspan="2" width="'.$k7.'"><strong>Rapor</strong></td><td rowspan="2">
		<a href="'.base_url().'guru/lck/'.$id_mapel.'/4" title="Ubah Keterangan Ketuntasan"><strong>Keterangan</strong></a></p></div></div><tr align="center"><td width="25"><strong><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/10">NR</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'">NP</a></strong></td><td width="30">TUNTAS</td><td width="25"><strong><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/13">NS</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'/19">NP*</a></strong></td><td width="30">TUNTAS</p></div></div>';
	}
	elseif($ranah == 'KA')
	{
		echo '<td width="25"rowspan="2"><strong>MID</strong></td><td width="'.$k3456.'" colspan="3"><strong>LHB</strong></td><td width="'.$k78910.'" colspan="3"><strong>FINAL</strong></td>';
		echo '<td rowspan="2" width="'.$k7.'"><strong>Rapor</strong></td><td rowspan="2">
		<a href="'.base_url().'guru/lck/'.$id_mapel.'/4" title="Ubah Keterangan Ketuntasan"><strong>Keterangan</strong></a></p></div></div><tr align="center"><td width="25"><strong><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/10">NR</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'">AFE</a></strong><td width="30">TUNTAS</td><td width="25"><strong><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/13">NS</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'">AFE</a></strong><td width="30">TUNTAS</p></div></div>';
	}
	elseif($ranah == 'PA')
	{
		echo '<td width="'.$k3456.'" colspan="3"><strong>LHB</strong></td><td width="'.$k78910.'" colspan="3"><strong>FINAL</strong></td>';
		echo '<td rowspan="2" width="'.$k7.'"><strong>Rapor</strong></td><td rowspan="2">
		<a href="'.base_url().'guru/lck/'.$id_mapel.'/4" title="Ubah Keterangan Ketuntasan"><strong>Keterangan</strong></a></p></div></div><tr align="center"><td width="25"><strong><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'">NP</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'">AFE</a></strong><td width="30">TUNTAS</td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'/19">NP*</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'">AFE</a></strong><td width="30">TUNTAS</p></div></div>';
	}

	else
	{
		echo '<td width="25"rowspan="2"><strong>MID</strong></td><td width="'.$k3456.'" colspan="4"><strong>LHB</strong></td><td width="'.$k78910.'" colspan="4"><strong>FINAL</strong></td>';
		echo '<td rowspan="2" width="'.$k7.'"><strong>Rapor</strong></td><td rowspan="2">
		<a href="'.base_url().'guru/lck/'.$id_mapel.'/4" title="Ubah Keterangan Ketuntasan"><strong>Keterangan</strong></a></p></div></div><tr align="center"><td width="25"><strong><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/10">NR</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'">NP</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'">AFE</a></strong><td width="30">TUNTAS</td><td width="25"><strong><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/13">NS</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'/19">NP*</a></strong></td><td width="25"><strong><a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'">AFE</a></strong><td width="30">TUNTAS</p></div></div>';
	}

}
else
{
	echo '<td width="'.$k345678.'" colspan="6"><strong></strong></td><td width="'.$k91011121314.'" colspan="6"><strong>FINAL</strong></td><td width="'.$k15.'" rowspan="2"><strong>r</strong></td><td rowspan="2"></p></div></div>';
echo '<tr bgcolor="#fff" align="center"><td width="'.$k34.'" colspan="2" bgcolor="#fff"></td><td width="'.$k34.'" colspan="2"></td><td width="'.$k5.'"></td><td width="'.$k6.'"></td><td width="'.$k910.'" colspan="2" bgcolor="#fff"></td><td width="'.$k910.'" colspan="2"></td><td width="'.$k11.'"><</td><td width="'.$k12.'"></p></div></div>';

}
$nomor=1;
$ta = $tf = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by no_urut ");
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$namasiswa = nis_ke_nama($nis);
	$nilai_nr = '?';
	$id_nilai = '';
	$afektif ='';
	$psikomotor = '';
	$psi = '';
	$kettuntas1 = '?';
	$kettuntas2 = '?';
	echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td>';
	$tf = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`= '$nis' order by no_urut ");
	foreach($tf->result() as $t)
	{
		$nilai_nr = $t->nilai_nr;
		$nilai_nre = $nilai_nr;
		$predikat_nilai_nr = predikat_nilai($nilai_nr);
		$kog = $t->kog;
		$nilai_mid = $t->nilai_mid;
		$predikat_kog = predikat_nilai($kog);
		$psikomotor = $t->psikomotor;
		$psikomotore = $t->psikomotor;
		$predikat_psikomotor = predikat_nilai($psikomotor);
		$psi = $t->psi;
		$predikat_psi = predikat_nilai($psi);
		$afektif = $t->afektif;
		$afektife = $t->afektif;
		$ket = $t->ket;
		if($nilai_mid < $kkm)
			{
			$nilai_mid = '<div class="alert alert-danger">'.$nilai_mid.'</div>';	
			}
		if($nilai_nr < $kkm)
		{
		$predikat_nilai_nr = '<div class="alert alert-danger">'.predikat_nilai($nilai_nr).'</div>';
		$nilai_nr = '<div class="alert alert-danger">'.$nilai_nr.'</div>';	

		}
		if($psikomotor < $kkm)
		{
		$predikat_psikomotor = '<div class="alert alert-danger">'.predikat_nilai($psikomotor).'</div>';
		$psikomotor = '<div class="alert alert-danger">'.$psikomotor.'</div>';	
		}
		if($kog < $kkm)
		{
		$predikat_kog = '<div class="alert alert-danger">'.predikat_nilai($kog).'</div>';
		$kog = '<div class="alert alert-danger">'.$kog.'</div>';	
		}
		if($psi < $kkm)
		{
		$predikat_psi = '<div class="alert alert-danger">'.predikat_nilai($psi).'</div>';
		$psi = '<div class="alert alert-danger">'.$psi.'</div>';	
		}
		$id_nilai = $t->kd;
		$kettuntas1 = substr($t->ket,0,5);
		if($kettuntas1 == 'Belum')
			{
			$kettuntas1 = '<div class="alert alert-danger">Belum</div>';
			}
			else
			{
			$kettuntas1 = '<p class="text-success">Sudah</p>';
			}

		$kettuntas2 = substr($t->ket_akhir,0,5);
		if($kettuntas2 == 'Belum')
			{
			$kettuntas2 = '<div class="alert alert-danger">Belum</div>';
			}
			else
			{
			$kettuntas2 = '<p class="text-success">Sudah</p>';
			}

		if (($afektif !='A')  and ($afektif!='B') and ($afektif !='SB'))
				{
				$afektif = '<div class="alert alert-danger">'.$afektif.'</div>';
				}


	}
	if($kurikulum == '2013')
		{
		echo '<td align="center">'.$nilai_mid.'</td>';
		echo '<td align="center">'.$nilai_nr.'</td>';
		echo '<td align="center">'.$predikat_nilai_nr.'</td>';
		echo '<td align="center">'.$psikomotor.'</td>';
		echo '<td align="center">'.$predikat_psikomotor.'</td>';
		echo '<td align="center">'.$afektif.'</td>';
		echo '<td align="center">'.$kettuntas1.'</td>';
		echo '<td align="center">'.$kog.'</td>';
		echo '<td align="center">'.$predikat_kog.'</td>';
		echo '<td align="center">'.$psi.'</td>';
		echo '<td align="center">'.$predikat_psi.'</td>';
		echo '<td align="center">'.$afektif.'</td>';
		echo '<td align="center">'.$kettuntas2.'';
	echo '<input type="hidden" name="nilai_nr_'.$nomor.'" value ="'.$nilai_nre.'"><input type="hidden" name="psikomotor_'.$nomor.'" value ="'.$psikomotore.'"><input type="hidden" name="afektif_'.$nomor.'" value ="'.$afektife.'" size="2"><input type="hidden" name="kd_'.$nomor.'"  value ='.$id_nilai.'><input type="hidden" name="nis_'.$nomor.'"  value ='.$nis.'></td>';
		}
	elseif(($kurikulum == 'KTSP') or ($kurikulum == '2015'))
		{
		if(($ranah== 'KPA') or ($ranah== 'KA') or ($ranah=='KP'))
		{
			echo '<td align="center">'.$nilai_mid.'</td>';
		}
		if(($ranah== 'KPA') or ($ranah== 'KA') or ($ranah=='KP'))
		{
			echo '<td align="center">'.$nilai_nr.'</td>';
		}
		if(($ranah== 'KPA') or ($ranah=='KP') or ($ranah=='PA'))
		{
			echo '<td align="center">'.$psikomotor.'</td>';
		}
		if(($ranah== 'KPA') or ($ranah== 'KA') or ($ranah=='PA'))
		{
			echo '<td align="center">'.$afektif.'</td>';
		}
		echo '<td align="center">'.$kettuntas1.'</td>';
		if(($ranah== 'KPA') or ($ranah== 'KA') or ($ranah=='KP'))
		{
			echo '<td align="center">'.$kog.'</td>';
		}
		if(($ranah== 'KPA') or ($ranah=='KP') or ($ranah=='PA'))
		{
			echo '<td align="center">'.$psi.'</td>';
		}
		if(($ranah== 'KPA') or ($ranah== 'KA') or ($ranah=='PA'))
		{
			echo '<td align="center">'.$afektif.'</td>';
		}
		echo '<td align="center">'.$kettuntas2.'';
	echo '<input type="hidden" name="nilai_nr_'.$nomor.'" value ="'.$nilai_nre.'"><input type="hidden" name="psikomotor_'.$nomor.'" value ="'.$psikomotore.'"><input type="hidden" name="afektif_'.$nomor.'" value ="'.$afektife.'" size="2"><input type="hidden" name="kd_'.$nomor.'"  value ='.$id_nilai.'><input type="hidden" name="nis_'.$nomor.'"  value ='.$nis.'></td>';
		}
	else
	{

	}

if ($itemnilai=='4')
	{
	echo '<td>';
	if ($t->rapor == 0)
					{
					echo form_checkbox('pilihan_'.$nomor, '1', FALSE);
					}
					else
					{
					echo form_checkbox('pilihan_'.$nomor, '1', TRUE);
					}
	echo '</td>';

		echo '<td>';
	if ($jenis_deskripsi=='1')
		{
		echo '<input type="hidden" name="keterangan_'.$nomor.'" value ="'.$t->keterangan.'">'.$t->keterangan;
		}

	elseif ($jenis_deskripsi=='2')
		{
		echo '<input type="hidden" name="keterangan_'.$nomor.'" value ="'.$t->keterangan.'">'.$t->keterangan;
		}

	elseif ($jenis_deskripsi=='0')
		{
		echo '<input type="text" name="keterangan_'.$nomor.'" value ="'.$t->keterangan.'" size="40" class="textfield">';
		}
	elseif ($jenis_deskripsi=='3')
		{
		$ti = $this->db->query("select * from `m_frasa_awal` order by `frasa`");
					$capaian ='';
					$skore = 0;

				if(!empty($materi1))
				{
					$tg = $this->db->query("select * from `deskripsi_capaian_nilai` where `id_mapel`='$id_mapel' and `nomor_materi`='1' and `nis`='$nis'");
					$capaian ='';
					$skore = 0;
					foreach($tg->result() as $g)
						{
						$skore = $g->positif;
						$capaian = $g->ket;
						}
					echo '<select name = "awalan1_'.$nomor.'" class="form-control">
						<option value="'.$capaian.'">'.$capaian.'</option>
						<option value=""></option>';
						foreach($ti->result() as $di)
						{
							echo '<option value="'.$di->frasa.'">'.$di->frasa.'</option>';
						}
						echo '</select>';

					if ($skore == 0)
					{
					echo form_checkbox('skor1_'.$nomor, '1', FALSE);
					}
					else
					{
					echo form_checkbox('skor1_'.$nomor, '1', TRUE);
					}
					echo ''.$materi1.'<input type="hidden" name="materi1_'.$nomor.'" value="'.$materi1.'">';

				}
				if(!empty($materi2))
				{
					$tg = $this->db->query("select * from `deskripsi_capaian_nilai` where `id_mapel`='$id_mapel' and `nomor_materi`='2' and `nis`='$nis'");

					foreach($tg->result() as $g)
						{
						$skore = $g->positif;
						$capaian = $g->ket;
						}
					echo '<select name = "awalan2_'.$nomor.'" class="form-control">
						<option value="'.$capaian.'">'.$capaian.'</option>
						<option value=""></option>';
						foreach($ti->result() as $di)
						{
							echo '<option value="'.$di->frasa.'">'.$di->frasa.'</option>';
						}
						echo '</select>';

					if ($skore == 0)
					{
					echo form_checkbox('skor2_'.$nomor, '1', FALSE);
					}
					else
					{
					echo form_checkbox('skor2_'.$nomor, '1', TRUE);
					}
					echo ''.$materi2.'<input type="hidden" name="materi2_'.$nomor.'" value="'.$materi2.'">';

				}
				if(!empty($materi3))
				{
					$tg = $this->db->query("select * from `deskripsi_capaian_nilai` where `id_mapel`='$id_mapel' and `nomor_materi`='3' and `nis`='$nis'");

					foreach($tg->result() as $g)
						{
						$skore = $g->positif;
						$capaian = $g->ket;
						}
					echo '<select name = "awalan3_'.$nomor.'" class="form-control">
						<option value="'.$capaian.'">'.$capaian.'</option>
						<option value=""></option>';
						foreach($ti->result() as $di)
						{
							echo '<option value="'.$di->frasa.'">'.$di->frasa.'</option>';
						}
						echo '</select>';

					if ($skore == 0)
					{
					echo form_checkbox('skor3_'.$nomor, '1', FALSE);
					}
					else
					{
					echo form_checkbox('skor3_'.$nomor, '1', TRUE);
					}
					echo ''.$materi3.'<input type="hidden" name="materi3_'.$nomor.'" value="'.$materi3.'">';

				}
				if(!empty($materi4))
				{
					$tg = $this->db->query("select * from `deskripsi_capaian_nilai` where `id_mapel`='$id_mapel' and `nomor_materi`='4' and `nis`='$nis'");

					foreach($tg->result() as $g)
						{
						$skore = $g->positif;
						$capaian = $g->ket;
						}
					echo '<select name = "awalan4_'.$nomor.'" class="form-control">
						<option value="'.$capaian.'">'.$capaian.'</option>
						<option value=""></option>';
						foreach($ti->result() as $di)
						{
							echo '<option value="'.$di->frasa.'">'.$di->frasa.'</option>';
						}
						echo '</select>';

					if ($skore == 0)
					{
					echo form_checkbox('skor4_'.$nomor, '1', FALSE);
					}
					else
					{
					echo form_checkbox('skor4_'.$nomor, '1', TRUE);
					}
					echo ''.$materi4.'<input type="hidden" name="materi4_'.$nomor.'" value="'.$materi4.'">';

				}
				if(!empty($materi5))
				{
					$tg = $this->db->query("select * from `deskripsi_capaian_nilai` where `id_mapel`='$id_mapel' and `nomor_materi`='5' and `nis`='$nis'");

					foreach($tg->result() as $g)
						{
						$skore = $g->positif;
						$capaian = $g->ket;
						}
					echo '<select name = "awalan5_'.$nomor.'" class="form-control">
						<option value="'.$capaian.'">'.$capaian.'</option>
						<option value=""></option>';
						foreach($ti->result() as $di)
						{
							echo '<option value="'.$di->frasa.'">'.$di->frasa.'</option>';
						}
						echo '</select>';

					if ($skore == 0)
					{
					echo form_checkbox('skor5_'.$nomor, '1', FALSE);
					}
					else
					{
					echo form_checkbox('skor5_'.$nomor, '1', TRUE);
					}
					echo ''.$materi5.'<input type="hidden" name="materi5_'.$nomor.'" value="'.$materi5.'">';

				}
				if(!empty($materi6))
				{
					$tg = $this->db->query("select * from `deskripsi_capaian_nilai` where `id_mapel`='$id_mapel' and `nomor_materi`='6' and `nis`='$nis'");

					foreach($tg->result() as $g)
						{
						$skore = $g->positif;
						$capaian = $g->ket;
						}
					echo '<select name = "awalan6_'.$nomor.'" class="form-control">
						<option value="'.$capaian.'">'.$capaian.'</option>
						<option value=""></option>';
						foreach($ti->result() as $di)
						{
							echo '<option value="'.$di->frasa.'">'.$di->frasa.'</option>';
						}
						echo '</select>';

					if ($skore == 0)
					{
					echo form_checkbox('skor6_'.$nomor, '1', FALSE);
					}
					else
					{
					echo form_checkbox('skor6_'.$nomor, '1', TRUE);
					}
					echo ''.$materi6.'<input type="hidden" name="materi6_'.$nomor.'" value="'.$materi6.'">';

				}
		}
	elseif ($jenis_deskripsi==4)
		{
		$th = $this->db->query("select * from `bank_deskripsi` where `tingkat`='$tingkat' and `mapel`='$mapel' order by deskripsi DESC");
		echo '<select name="keterangan_'.$nomor.'" class="form-control">';
				echo '<option value="'.$t->keterangan.'">'.$t->keterangan.'</option>';
		foreach($th->result() as $h)
			{
			echo '<option value="'.$h->deskripsi.'">'.$h->deskripsi.'</option>';
			}
		echo '</select>';
		}

		echo '</td>';

	}

	else
	{
	echo '<td align="center">';
	if ($t->rapor == 0)
					{
					echo 'T';
					}
					else
					{
					echo 'Y';
					}
	echo '</td>';

	echo '<td><input type="hidden" name="keterangan_'.$nomor.'" value ="'.$t->keterangan.'">'.$t->keterangan.'</td>';
	}

echo '</tr>';
$nomor++;	
}
echo '</table></div>';
if ((!empty($id_mapel)) and (!empty($semester)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
{
	if ($itemnilai==4)
	{
	$cacah_siswa = $nomor - 1;
	?>
	<p class="text-center"><input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
	<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
	<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
	<input type="hidden" name="kkm" value="<?php echo $kkm;?>">
	<input type="hidden" name="ranah" value="<?php echo $ranah;?>">
	<input type="hidden" name="dari" value="lck">
	<input type="hidden" name="jenis_deskripsi" value="<?php echo $jenis_deskripsi;?>">
	<input type="hidden" name="cacah_siswa" value ="<?php echo $cacah_siswa;?>">
	<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
	<input type="hidden" name="semester" value="<?php echo $semester;?>">
	<input type="submit" value="Simpan Deskripsi" class="btn btn-primary" role="button"></p>
	<?php
	}
}
echo '</form>';
}
else{
echo "Belum ada daftar nilai";
}
?>
</div></div></div>
