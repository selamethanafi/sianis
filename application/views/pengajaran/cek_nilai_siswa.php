<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: cek_nilai_siswa.php
// Lokasi      		: application/views/pengajaran/
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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php echo form_open('pengajaran/ceknilaisiswa','class="form-horizontal" role="form"');?>
<?php
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9"><select name="thnajaran" class="form-control">';	
			echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
			foreach($daftar_tapel->result_array() as $k)
			{
			echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
			}
		echo '</select></div></div>';
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Semester</label></div>
		<div class="col-sm-9"><input type="text" name="semester" value="2" class="form-control" readonly></div></div>';
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kelas</label></div>
		<div class="col-sm-9"><select name="kelas" class="form-control">';
			echo "<option value='".$kelas."'>".$kelas."</option>";
			$daftar_kelas = $this->db->query("select * from m_ruang where ruang like 'XII-%' order by ruang");
			foreach($daftar_kelas->result() as $l)
			{
			echo "<option value='".$l->ruang."'>".$l->ruang."</option>";
			}
		echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/pengajaran/ceknilaisiswa" class="btn btn-info"><b>Kelas Lain</b></a></p>';
?>
</form><br>
<?php
if (!empty($kelas))
{
$urutan =1;
$nomor=1;
?>
<table class="table table-hover table-bordered table-striped>
<tr align="center"><td>Nomor</td><td>NIS</td><td>Nama</td><td>Tahun Pelajaran</td><td>Semester</td><td>Kelas</td><td>Mapel</td><td>NR</td><td>NS</td><td>NP</td><td>NP*</td><td>Afektif</td></tr>
<?php
	$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester' and `status`='Y' order by no_urut ");
	foreach($ta->result() as $a)
	{	
		$nis = $a->nis;
		$nama = nis_ke_nama($nis);
		$tb = $this->db->query("select * from nilai where nis='$nis' order by mapel ASC");
		foreach($tb->result() as $b)
		{
			$thnajarane = $b->thnajaran;
			$semestere = $b->semester;
			$kelase = $b->kelas;
			$mapele = $b->mapel;
			//cari kkm
			$tc = $this->db->query("select * from m_mapel where mapel='$mapele' and thnajaran='$thnajarane' and semester='$semestere' and kelas='$kelase' order by `kodeguru`");

			$kkm = 0;
			$ranah = '';
			$status = 'Belum';
			$status_akhir = 'Belum';
			$kog = 0;
			$psi = 1;
			$afe = 0;
			$kog_akhir = 0;
			$psi_akhir = 1;
			$kodeguru = '??';
			foreach($tc->result() as $c)
			{
				$kkm = $c->kkm;
				$ranah = $c->ranah;
				$kodeguru = $c->kodeguru;
			}
			$namaguru = cari_nama_pegawai($kodeguru);
			if ($ranah == 'KPA')
				{
					if ($b->nilai_nr<$kkm)
					{
					$kog = 0;
					}
					else
					{
					$kog = 1;
					}
				if ($b->psikomotor<$kkm)
					{
					$psi = 0;
					}
					else
					{
					$psi = 1;
					}

				}
			if ($ranah == 'KA')
				{
				if ($b->nilai_nr<$kkm)
					{
					$kog = 0;
					}
					else
					{
					$kog = 1;
					}
	
				}
			if ($ranah == 'PA')
				{
				$kog = 1;
				if ($b->psikomotor<$kkm)
					{
					$psi = 0;
					}
					else
					{
					$psi = 1;
					}
				}

			if (($b->afektif=='A') or ($b->afektif=='B') or ($b->afektif=='AB') or ($b->afektif=='SB'))
				{
				$afe = 1;
				}
				else
				{
				$afe = 0;
				}
			if ($ranah == 'KPA')
				{
					if ($b->kog<$kkm)
					{
					$kog_akhir = 0;
					}
					else
					{
					$kog_akhir = 1;
					}
				if ($b->psi<$kkm)
					{
					$psi_akhir = 0;
					}
					else
					{
					$psi_akhir = 1;
					}

				}
			if ($ranah == 'KA')
				{
				if ($b->kog<$kkm)
					{
					$kog_akhir = 0;
					}
					else
					{
					$kog_akhir = 1;
					}
	
				}
			if ($ranah == 'PA')
				{
				$kog_akhir = 1;
				if ($b->psi<$kkm)
					{
					$psi_akhir = 0;
					}
					else
					{
					$psi_akhir = 1;
					}
				}
			if (($kog==1) and ($psi==1) and ($afe==1))
				{
				$status = '';
				}
			if (($kog_akhir==1) and ($psi_akhir==1) and ($afe==1))
				{
				$status_akhir = '';
				}
		if(($thnajaran == $thnajarane) and ($semester == $semestere))
		{
		}
		else
		{
		if (!empty($status_akhir))
			{
			echo '<tr><td>'.$urutan.'</td><td>'.$nis.'</td><td>'.nis_ke_nama($nis).'</td><td>'.$thnajarane.'</td><td>'.$semestere.'</td><td>'.$kelase.'</td><td>'.$mapele.'<br>'.$namaguru.'</td><td>'.$b->nilai_nr.'</td><td>'.$b->kog.'</td><td>'.$b->psikomotor.'</td><td>'.$b->psi.'</td><td>'.$b->afektif.'</td></tr>';
			$urutan++;		
			}
		}
		}
	}
	echo '</table>';
}

?>
</div>
