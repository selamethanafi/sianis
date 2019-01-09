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
$thnajaranskr = cari_thnajaran();
$semesterskr = cari_semester();

$tingkat = kelas_jadi_tingkat($kelas);
$ranah = 'KP';
if($kkm_mid == 0)
{
	$kkm_mid = $kkm;
}
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?> Versi 2018</h3></div>
<div class="card-body">
<?php
if(($thnajaran != $thnajaranskr) or ($semester != $semesterskr))
{
	echo '<p><a href="'.base_url().'guru/nilailama" class="btn btn-info"><span class="fa fa-arrow-left"></span> <b>Kelas Lain</b></a> ';
}
else
{
	echo '<p><a href="'.base_url().'guru/nilai" class="btn btn-info"><span class="fa fa-arrow-left"></span> <b>Kelas Lain</b></a> ';
}
echo ' <a href="'.base_url().'guru/psikomotor" class="btn btn-info"><b>Nilai Keterampilan</b></a>';
echo '</p>';
if ($jenis_deskripsi==1)
{$jenis_deskripsine = "Berdasarkan Ulangan (Deskripsi Otomatis)";
}
if ($jenis_deskripsi==2)
{
	$jenis_deskripsine = "Berdasarkan Nilai Akhir (Deskripsi Otomatis)";
}
if ($jenis_deskripsi==5)
{
	$jenis_deskripsine = "Berdasarkan Nilai Rapor (Deskripsi Otomatis)";
}
if ($jenis_deskripsi==3)
{
	$jenis_deskripsine = "Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)";
}
if ($jenis_deskripsi==0)
{$jenis_deskripsine = "Kopi Paste / Manual";
}
if ($jenis_deskripsi==6)
{$jenis_deskripsine = $this->config->item('versi_deskripsi');
}
if ($jenis_deskripsi==4)
{$jenis_deskripsine = "Berdasar bank deskripsi";
}
if($pilihan == 1)
{
	$ta = $this->db->query("select * from `nilai_pilihan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' and `mapel` = '$mapel' order by no_urut ");
}
else
{
	$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' and `mapel` = '$mapel' order by no_urut ");
}
if($ta->num_rows()>0)
{
	if($jenis_deskripsi == 3)
	{
		echo form_open('guru/updatelck/'.$jenis_deskripsi,'class="form-horizontal" role="form"');
	}
	else
	{
	echo form_open('guru/updaterapor/'.$jenis_deskripsi,'class="form-horizontal" role="form"');
	}
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran?></p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $mapel;?></p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ranah Penilaian</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $ranah;?></p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">KKM</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kkm;?></p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Deskripsi</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $jenis_deskripsi.' '.$jenis_deskripsine; ?></p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kurikulum</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kurikulum;?></p></div></div>
	<?php
				$takterkunci = 0;
	if($itemnilai != 4)
	{
		if(($jenis_deskripsi==1) or ($jenis_deskripsi==5) or ($jenis_deskripsi==6))
		{
			echo '<p>Untuk memperbarui deskripsi pengetahuan, klik <a href="'.base_url().'guru/statusketuntasan/'.$id_mapel.'"  class="btn btn-primary">Perbarui Deskripsi Pengetahuan</a></p>';
		}
		echo '<p>Untuk memperbarui deskripsi keterampilan, klik <a href="'.base_url().'guru/deskripsiketerampilan/'.$id_mapel.'" class="btn btn-primary">Perbarui Deskripsi Keterampilan</a></p>';
	}
	if(($jenis_deskripsi==3) or ($jenis_deskripsi=='4') or ($jenis_deskripsi== '0') or (empty($jenis_deskripsi)))
	{
		echo '<div class="alert alert-warning">Untuk mengubah / memperbarui deskripsi pengetahuan atau mengunci nilai, klik tombol Keterangan / Deskripsi / Kunci Nilai</div>';
	}
	$k1 = 25;
	$k2 = 150;
	echo '<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered"><tr><td width="'.$k1.'" rowspan="2"><strong>No.</strong></td><td width="'.$k2.'" rowspan="2"><strong>Nama</strong></td>';
	$k3 = 10;
	$k34 = $k3;
	$k4 = $k3;
	$k5 = $k3;
	$k6 = $k3;
	$k7 = $k3;
	$k8 = 40;
	$k345678 = $k3+$k4+$k5+$k6+$k7+$k8;
	echo '<td width="25" rowspan="2"><strong>MID</strong></td><td width="'.$k345678.'" colspan="5"><strong>Nilai Rapor</strong></td><td width="'.$k3.'" rowspan="2"><strong>Kunci Nilai</strong></td><td rowspan="2"><a href="'.base_url().'guru/lck2/'.$id_mapel.'/4" title="Ubah Deskripsi Capaian Kompetensi atau mengunci nilai" class="btn btn-primary"><strong>Keterangan / Deskripsi / Kunci Nilai</strong></a></td></tr>';
	if($jujug == 'Y')
	{
		echo '<tr align="center"><td width="'.$k3.'" colspan="2"><a href="'.base_url().'guru/nilaiharian/'.$id_mapel.'/13"><strong>Pengetahuan</strong></a></td><td width="'.$k34.'" colspan="2"><a href="'.base_url().'guru/nilaipsikomotor/'.$id_mapel.'/19"><strong>Keterampilan</strong></a></td><td width="'.$k8.'"><strong>Ketuntasan</strong></td></tr>';
	}
	else
	{
		echo '<tr align="center"><td width="'.$k3.'" colspan="2"><a href="'.base_url().'guru/daftarnilai/'.$id_mapel.'"><strong>Pengetahuan</strong></a></td><td width="'.$k34.'" colspan="2"><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'"><strong>Keterampilan</strong></a></td><td width="'.$k8.'"><strong>Ketuntasan</strong></td></tr>';

	}
	$nomor=1;

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
		$nilai_nr = $a->nilai_nr;
		$nilai_nre = $nilai_nr;
		$predikat_nilai_nr = predikat_nilai_2018($nilai_nr,$kkm);
		$kog = $a->kog;
		$nilai_mid = $a->nilai_mid;
		$predikat_kog = predikat_nilai_2018($kog,$kkm);
		$psikomotor = $a->psikomotor;
		$psikomotore = $a->psikomotor;
		$predikat_psikomotor = predikat_nilai_2018($psikomotor,$kkm);
		$psi = $a->psi;
		$predikat_psi = predikat_nilai_2018($psi,$kkm);
		$afektif = $a->afektif;
		$afektife = $a->afektif;
		$ket = $a->ket;
		$kkog = konversi_nilai($kog);
		if($nilai_mid < $kkm)
		{
			$nilai_mid = '<p class="text-danger">'.$nilai_mid.'</p>';	
		}
		if($kog < $kkm)
		{
			$predikat_kog = '<p class="text-danger">'.predikat_nilai_2018($kog,$kkm).'</p>';
			$kog = '<p class="text-danger">'.$kog.'</p>';
		}
		if($psi < $kkm)
		{
			$predikat_psi = '<p class="text-danger">'.predikat_nilai_2015($psi,$kkm).'</p>';
			$psi = '<p class="text-danger">'.$psi.'</p>';	
		}
		$id_nilai = $a->kd;
		$kettuntas1 = substr($a->ket,0,5);
		if($kettuntas1 == 'Belum')
		{
			$kettuntas1 = '<p class="text-danger">Belum</p>';
		}
		else
		{
			$kettuntas1 = '<p class="text-success">Sudah</p>';
		}
		$kettuntas2 = substr($a->ket_akhir,0,5);
		if($kettuntas2 == 'Belum')
		{
			$kettuntas2 = '<p class="text-danger">Belum</p>';
		}
		else
		{
			$kettuntas2 = '<p class="text-success">Sudah</p>';
		}
		if (($afektif !='A')  and ($afektif!='B') and ($afektif !='SB'))
		{
			$kafektif = '<p class="text-danger">'.$afektif.'</p>';
		}
		echo '<td align="center">'.$nilai_mid.'</td>';
		echo '<td align="center">'.$kog.'</td>';
		echo '<td align="center">'.$predikat_kog.'</td>';
		echo '<td align="center">'.$psi.'</td>';
		echo '<td align="center">'.$predikat_psi.'</td>';
		echo '<td align="center">'.$kettuntas2.'';
		echo '<input type="hidden" name="nilai_nr_'.$nomor.'" value ="'.$nilai_nre.'"><input type="hidden" name="psikomotor_'.$nomor.'" value ="'.$psikomotore.'"><input type="hidden" name="afektif_'.$nomor.'" value ="'.$afektife.'" size="2"><input type="hidden" name="kd_'.$nomor.'"  value ='.$id_nilai.'><input type="hidden" name="nis_'.$nomor.'"  value ='.$nis.'></td>';
		if ($itemnilai=='4')
		{
			echo '<td>';
			if ($a->kunci == 1)
			{
				//echo form_checkbox('pilihan_'.$nomor, '1', FALSE);
				echo '<span class="fa fa-lock"></span>';
			}
			else
			{
				//echo '<select name="pilihan_'.$nomor.'"><option value=""></option><option value="1">Kunci</option></select>';
				echo form_checkbox('pilihan_'.$nomor, '1', FALSE);
			}
			echo '</td>';
			echo '<td>';
			if ($jenis_deskripsi=='1')
			{
				echo '<input type="hidden" name="keterangan_'.$nomor.'" value ="'.$a->keterangan.'">'.$a->keterangan;
			}
			elseif ($jenis_deskripsi=='2')
			{
				echo $a->keterangan;
			}
			elseif ($jenis_deskripsi=='0')
			{
				echo '<input type="text" name="keterangan_'.$nomor.'" value ="'.$a->keterangan.'" class="form-control">';
			}
			elseif ($jenis_deskripsi=='6')
			{
				echo $a->keterangan;
			}
			elseif ($jenis_deskripsi=='5')
			{
				echo ''.$a->keterangan;
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
				echo '<option value="'.$a->keterangan.'">'.$a->keterangan.'</option>';
				foreach($th->result() as $h)
				{
					echo '<option value="'.$h->deskripsi.'">'.$h->deskripsi.'</option>';
				}
				echo '</select>';
			}
			echo '</td>';

		} // akhir kunci
		else
		{
			echo '<td align="center">';
			if ($a->kunci == 1)
			{
				echo '<span class="fa fa-lock"></span>';
			}
			else
			{
				$takterkunci++;
				echo '<span class="fa fa-lock-open"></span>';
			}
			echo '</td>';
			//keterampilan
			$ketpsi = $a->deskripsi;
			echo '<td>';
			echo '<strong>Pengetahuan</strong> : '.$a->keterangan.'<br /><strong>Keterampilan</strong> : '.$ketpsi;
			echo '</td>';
		}
		echo '</tr>';
	
		$nomor++;	
	} //kalau ada
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
	if($takterkunci == 0)
	{
		echo '<p class="text-center"><a href="'.base_url().'guru/unduhrapor/'.$id_mapel.'" class="btn btn-success">Unduh Rapor</a></p>';
	}
}
else
{
echo "Belum ada daftar nilai";
}
?>
</div></div></div>
