<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lhb.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<h3><p class="text-center text-warning">Laporan Hasil Belajar Siswa (SEMENTARA)</p></h3>
<h3><p class="text-center text-info">Untuk Laporan Hasil Belajar <strong>Akhir</strong> klik di  
<?php
echo "<a href='".base_url()."guru/detilsiswa/".$nis."/".$id_walikelas."/4' title='Laporan Hasil Belajar ".nis_ke_nama($nis)."'>sini</a>";
?>
</p></h3>
<?php
$twalikelas = $this->Nilai_model->Walikelas($thnajaran,$semester,$kelas);
$namawalikelas = '';
$nipwalikelas = '';
$kodewalikelas = '';
foreach($twalikelas->result() as $dwalikelas)
	{
		$kodewalikelas = $dwalikelas->kodeguru;
		}
$namawalikelas = cari_nama_pegawai($kodewalikelas);
echo '';
echo '<a href="'.base_url().'guru/daftarsiswa/'.$id_walikelas.'"><b>Kembali ke daftar siswa</b></a>';?>
<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Nama Siswa</strong></td><td>: <strong><?php echo nis_ke_nama($nis);?></strong></td></tr>
<tr><td><strong>Wali Kelas</strong></td><td>: <strong><?php echo $namawalikelas;?></strong></td></tr>
</table>
<?php
$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y' order by kd_mapel ASC");
	$nomor = 1;
	foreach($ta->result() as $a)
	{

	$keterangan = 'Sudah kompeten';
	$nis = $a->nis;
	$mapel = $a->mapel;
	//cari ranah
	$ranah = '';
	$kkm = '';
	$tmapel = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
	foreach($tmapel->result() as $dtmapel)
	{
		$ranah = $dtmapel->ranah;
		$kkm = $dtmapel->kkm;
	}
		if (($ranah == 'KPA') or ($ranah == 'KA'))
			{
				if ($a->nilai_nr < $kkm)
					{
					$keterangan = 'Belum kompeten';
					}
			}
		if( ($ranah == 'PA') or  ($ranah == 'KPA'))
			{
				if ($a->psikomotor < $kkm)
					{
					$keterangan = 'Belum kompeten';
					}
			}
	if (($a->afektif !='A')  and ($a->afektif!='B') and ($a->afektif !='SB'))
		{
			$keterangan = 'Belum kompeten';
		}
		$this->db->query("update `nilai` set `ket`='$keterangan' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
	}
$tb = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
$nomor=1;
$adamapelrapor = $tb->num_rows();
if ($adamapelrapor>0)
{
echo '<h2>Akademik</h2>';
	$nomor=1;
	echo '<table class="table table-striped table-hover table-bordered">
	<tr><td width="50" align="center"><strong>Nomor</strong></td><td align="center"><strong>Mata Pelajaran</strong></td><td align="center"><strong>KKM</strong></td><td align="center"><strong>Kognitif</strong></td><td align="center"><strong>Psikomotor</strong></td><td align="center"><strong>Afektif</strong></td><td align="center"><strong>Ketuntasan</strong></td><td align="center"><strong>Keterangan</strong></td></tr>';
	foreach($tb->result() as $b)
	{
		$mapel = $b->nama_mapel;
		$nourut = $b->komponen;
		$mapel_portal = $b->nama_mapel_portal;
		if(empty($mapel_portal))
			{
			echo '<tr><td width="30" align="center">'.$nourut.'</td>';
			echo '<td colspan="9">'.$mapel.'</td></tr>';
			$nomor++;
			}
			else
			{

		$data_kkm = $this->Nilai_model->Cari_KKM($thnajaran,$semester,$kelas,$mapel_portal);
		$kkm = '-';
		$ranah = '';
		$namaguru='';
		foreach($data_kkm->result() as $dkkm)
		{
			$kkm = $dkkm->kkm;
			$ranah = $dkkm->ranah;
			$kodeguru = $dkkm->kodeguru;
			$tg = $this->db->query("select * from `p_pegawai` where `kd`='$kodeguru'");
			$namaguru ='';
			foreach($tg->result() as $g)
				{
				if (empty($namaguru))
					{
					$namaguru = $g->nama;
					}
					else
					{
					$namaguru .= ', '.$g->nama;
					}

				}

		}
		$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel_portal' and `nis`='$nis' and `status`='Y'");
		$nk = '?';
		$np = '?';
		$ket = '?';
		$afe = '?';
		foreach($tc->result() as $datax)
			{
			echo '<tr><td align="center">'.$nourut.'</td><td>'.$mapel.'<p><strong>'.$namaguru.'</strong></p></td><td align="center">'.$kkm.'</td>';
			if (($ranah=='KPA') or ($ranah=='KA'))
		    		{
				$nk=$datax->nilai_nr;
				if($nk<$kkm)
					{
					$nk = '<font color="#FF0000">'.$nk.'</font>';
					}
				}
				else
		    		{$nk = '-';}
			if (($ranah=='KPA') or ($ranah=='PA'))
		    		{
				$np =$datax->psikomotor;
				if($np<$kkm)
					{
					$np = '<font color="#FF0000">'.$np.'</font>';
					}

				}
				else
		    		{$np = '-';}
			$afektif = $datax->afektif;
			$ket = $datax->ket;
			if(($afektif == 'A') or ($afektif == 'B') or ($afektif == 'SB'))
				{
				$afektif = $afektif;
				}
				else
				{
				$afektif = '<font color="#FF0000">'.$afektif.'</font>';
				}

			if (substr($ket,0,5)=='Belum')
				{
				$ket = '<font color="#FF0000">'.$ket.'</font>';
				}
			echo '<td align="center">'.$nk.'</td><td align="center">'.$np.'</td><td align="center">'.$afektif.'</td><td>'.$ket.'</td>';
			echo '<td>'.$datax->keterangan.'</td></tr>';
			}
	$nomor++;
		}
	}
	echo '</table>* <strong>Nilai rapor diambil dari kolom NR dan NP</strong>';
}
else
{
echo 'tidak ada data mata pelajaran yang tampil di rapor, hubungi pengajaran';
}
	echo '<h2>Pengembangan Diri</h2>';
	echo '<table class="table table-striped table-hover table-bordered">
	<tr><td width="5%"><strong>Nomor</strong></td><td width="20%"><strong>Ekstrakurikulter</strong></td><td><strong>Nilai</strong></td></tr>';
	$nilai_ekstra = $this->Nilai_model->Ekstra($thnajaran,$semester,$nis);
	$adaekstra = $nilai_ekstra->num_rows();
	if ($adaekstra>0)
	{
	$no = 1;
	foreach($nilai_ekstra->result() as $dne)
		{
		echo '<tr><td align="center">'.$no.'</td><td>'.$dne->nama_ekstra.'</td><td>';
		if (!empty($dne->nilai))
			{
			echo $dne->nilai;
			if (!empty($dne->keterangan))
				{
				echo ". ".$dne->keterangan;
				}
			}
			else
			{
			if (!empty($dne->keterangan))
				{
				echo $dne->keterangan;
				}
			}
			echo '</td><td align="center"></tr>';
		$no++;
		}
	}
	else
	{
		echo '<tr><td colspan="3" align="center">Belum ada nilai atau siswa tidak mengikuti kegiatan pengembangan diri</td></tr>';
	}
	echo '</table>';
	// ketidak hadiran
	echo '<h2>Ketidakhadiran Siswa</h2>';

	$nilai_pribadi = $this->Nilai_model->Kepribadian($thnajaran,$semester,$nis);
	$adapribadi = $nilai_pribadi->num_rows();
	if ($adapribadi>0)
	{
	echo '<table class="table table-striped table-hover table-bordered">
	<tr><td width="5%"><strong>Nomor</strong></td><td width="20%"><strong>Ketidakhadiran</strong></td><td><strong>Keterangan</strong></td></tr>';

	foreach($nilai_pribadi->result() as $d)
		{
		echo '<tr><td align="center">1</td><td>Sakit</td><td>'.$d->sakit.' hari</td></tr>';
		echo '<tr><td align="center">2</td><td>Izin</td><td>'.$d->izin.' hari</td></tr>';
		echo '<tr><td align="center">3</td><td>Tanpa Keterangan</td><td>'.$d->tanpa_keterangan.' hari</td></tr>';
		echo '<tr><td align="center">4</td><td>Terlambat</td><td>'.$d->terlambat.' kali</td></tr>';
		echo '<tr><td align="center">5</td><td>Membolos</td><td>'.$d->membolos.' kali</td></tr>';

		}
	echo '</table>';
	// akhlak mulia dan kehadiran		
	echo '<h2>Akhlak Mulia dan Kepribadian</h2>';
	echo '<table class="table table-striped table-hover table-bordered">
	<tr><td width="5%"><strong>Nomor</strong></td><td width="20%"><strong>Aspek</strong></td><td><strong>Keterangan</strong></td></tr>';
	echo '<tr><td align="center">1</td><td>Kedisiplinan</td><td>'.$d->satu.'</td></tr>';
	echo '<tr><td align="center">2</td><td>Kebersihan</td><td>'.$d->dua.'</td></tr>';
	echo '<tr><td align="center">3</td><td>Kesehatan</td><td>'.$d->tiga.'</td></tr>';
	echo '<tr><td align="center">4</td><td>Tanggung jawab</td><td>'.$d->empat.'</td></tr>';
	echo '<tr><td align="center">5</td><td>Sopan santun</td><td>'.$d->lima.'</td></tr>';
	echo '<tr><td align="center">6</td><td>Percaya diri</td><td>'.$d->enam.'</td></tr>';
	echo '<tr><td align="center">7</td><td>Kompetitif</td><td>'.$d->tujuh.'</td></tr>';
	echo '<tr><td align="center">8</td><td>Hubungan Sosial</td><td>'.$d->delapan.'</td></tr>';
	echo '<tr><td align="center">9</td><td>Kejujuran</td><td>'.$d->sembilan.'</td></tr>';
	echo '<tr><td align="center">10</td><td>Ibadah ritual</td><td>'.$d->sepuluh.'</td></tr></table>';
	echo '<h2>Kredit pelanggaran tata tertib madrasah : '.$d->angka_kredit.'</h2>';	

	}
	else
	{
	echo 'Tidak ada data kehadiran / kepribadian';
	}
	// Prestasi dan Organisasi
	echo '<h2>Prestasi Siswa</h2>';
	$td = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran'");
	$adaprestasi = $td->num_rows();
	if ($adaprestasi>0)
	{
	echo '<table class="table table-striped table-hover table-bordered">
	<tr><td width="5%"><strong>Nomor</strong></td><td width="45%"><strong>Kegiatan</strong></td><td width="45%"><strong>Keterangan</strong></td><td><strong>Valid</strong></td></tr>';
	$no = 1;
	foreach($td->result() as $d)
		{
		echo '<tr><td align="center">'.$no.'</td><td>'.$d->kegiatan.'</td><td>'.$d->keterangan.'</td><td>';
		if($d->valid=='1')
			{
			echo 'Ya';
			}
			else
			{
			echo 'Tdk';
			}
		echo '</td></tr>';
		$no++;
		}
	echo '</table>';
	}
	else
	{
	echo 'Tidak ada data prestasi siswa';
	}

	// organisasi
	echo '<h2>Organisasi</h2>';
	$te = $this->db->query("select * from `siswa_organisasi` where `nis`='$nis' and `thnajaran`='$thnajaran'");
	$adaorganisasi = $te->num_rows();
	if ($adaorganisasi>0)
	{
	echo '<table class="table table-striped table-hover table-bordered">
	<tr><td width="5%"><strong>Nomor</strong></td><td width="45%"><strong>Organisasi</strong></td><td width="45%"><strong>Keterangan</strong></td><td><strong>Valid</strong></td></tr>';
	$no = 1;
	foreach($te->result() as $e)
		{
		echo '<tr><td align="center">'.$no.'</td><td>'.$e->organisasi.'</td><td>'.$e->keterangan.'</td><td>';
		if($e->valid=='1')
			{
			echo 'Ya';
			}
			else
			{
			echo 'Tdk';
			}
		echo '</td></tr>';
		$no++;
		}
	echo '</table>';

	}
	else
	{
	echo 'Tidak ada data organisasi';
	}
?>
</div>
