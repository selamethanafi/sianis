<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: bg_atas_cetak.php
// Lokasi      		: application/views/shared/
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<style>
body{
	font-family:Arial, Helvetica, sans-serif;
	font-size: <?php echo $fontsize;?>px;
}
</style>
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?>_Versi 2018</title>
<?php
$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
$peminatan = kelas_jadi_program($kelas);
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak='';
$ttglcetak = $this->db->query("select * from `m_tapel` where `thnajaran` = '$thnajaran'");
foreach($ttglcetak->result() as $dtglcetak)
	{
	if ($semester=='1')
		{$tanggalcetak=$dtglcetak->akhir1;}
		else
		{$tanggalcetak=$dtglcetak->akhir2;}
	}
$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
			$kodeguru = '??';
			$namawalikelas = '';
			$nipwalikelas = '';
			foreach($twalikelas->result() as $dwalikelas)
				{
				$kodeguru = $dwalikelas->kodeguru;
				}
			$namawalikelas = cari_nama_pegawai($kodeguru);
			$nipwalikelas = cari_nip_pegawai($kodeguru);

?>
<div class="container-fluid">
<table width="100%">
<tr><td>Nama <?php echo ucwords(strtolower($sek_tipe));?></td><td><?php echo $sek_nama;?></td><td>Kelas</td><td><?php echo nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);?></td></tr>

<tr><td>Alamat <?php echo $sek_tipe;?></td><td><?php echo $sek_alamat;?></td><td>Tahun Pelajaran</td><td><?php echo $thnajaran;?></td></tr>
<tr><td>Nama Peserta Didik</td><td><?php echo nis_ke_nama($nis);?></td><td>Semester</td><td><?php echo $semester;?></td></tr>
<tr><td>NIS / NISN</td><td><?php echo $nis;?> / <?php echo nisn($nis);?></td><td>Peminatan</td><td><?php echo $peminatan;?></td></tr></table>
<?php
$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
$peminatan = kelas_jadi_program($kelas);
$adayangbelumdikunci = 0;
$namamapel = '';
	$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y'");
	foreach($ta->result() as $a)
	{
		if($a->mapel != 'Bimbingan Teknologi Informasi dan Komunikasi')
		{
			if(empty($a->kunci))
			{
				$adayangbelumdikunci++;
				if(empty($namamapel))
				{
					$namamapel .= $a->mapel;
				}
				else
				{
					$namamapel .= ', '.$a->mapel;
				}

			}
		}
			
	}
	if($adayangbelumdikunci>0)
	{
		echo '<div class="alert alert-danger"><strong>Nilai ('.$namamapel.') belum dikunci oleh wali kelas</strong></div>';
	}
	//sikap antar mapel
	$td = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$sikap_spiritual = '';
	$sikap_sosial = '';
	$pred1 = '';
	$pred2 = '';
	foreach($td->result() as $d)
	{
		$pred1 = $d->satu;
		$pred2 = $d->dua;
		$sikap_spiritual = $d->kom1;
		$sikap_sosial = $d->kom2;
	}
	echo '<h3><p class="text-center">CAPAIAN HASIL BELAJAR</p></h3>';
	echo '<h4>A. Sikap Spiritual dan Sosial</h4>';
	echo '<h4>1. Sikap Spiritual</h4>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td width="20%">Predikat</td><td>Deskripsi</td></tr>';
	echo '<tr><td>'.$pred1.' ('.predikat_sikap($pred1).')</td><td>'.$sikap_spiritual.'</td></tr></table>';
	echo '<h4>2. Sikap Sosial</h4>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td width="20%">Predikat</td><td>Deskripsi</td></tr>';
	echo '<tr><td>'.$pred2.' ('.predikat_sikap($pred2).')</td><td>'.$sikap_sosial.'</td></tr></table>';
	echo '<h4>B. Pengetahuan dan Keterampilan</h4>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td rowspan="2" width="50">Nomor</td><td rowspan="2">Mata Pelajaran</td><td rowspan="2">KKM</td><td colspan="2">Pengetahuan</td><td colspan="2">Keterampilan</td></tr><tr align="center"><td>Nilai</td><td>Predikat</td><td>Nilai</td><td>Predikat</td></tr>';
	$tmapel = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	$nomor = 1;
	foreach($tmapel->result() as $dm)
	{
		$mapel = $dm->nama_mapel_portal;
		$mapele = $dm->nama_mapel;
		$komponen = $dm->komponen;
		if(empty($mapel))
		{
			echo '<tr><td align="center">'.$komponen.'</td><td colspan="6">'.$mapele.'</td></tr>';
		}
		else
		{
			$kunci = '';
			$penggalan = substr($mapele,0,8);
			$penggalan = strtoupper($penggalan);
			$prakarya = 0;
			if(($penggalan == 'PRAKARYA') or ($penggalan == 'KETERAMP') or ($penggalan == 'KETRAMPI'))
			{
				$tc = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel` like '%prakarya%' and `nis`='$nis' and `status`='Y'");
				foreach($tc->result() as $c)
				{
					$mapel = $c->mapel;
				}
				$prakarya = $tc->num_rows();
				//cari guru
				$kodeguru ='??';
				$tf = $this->db->query("select * from `m_mapel` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester'");
				$namaguru = '';
				foreach($tf->result() as $f)
				{
					$kodeguru = $f->kodeguru;
					if (empty($namaguru))
					{
						$namaguru = cari_nama_pegawai($kodeguru);
					}
					else
					{
						$namaguru .= ', '.cari_nama_pegawai($kodeguru);
					}
				}

			}
			if($prakarya == 0)
			{
				$tc = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
				//cari guru
				$kodeguru ='??';
				$tf = $this->db->query("select * from `m_mapel` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester'");
				$namaguru = '';
				foreach($tf->result() as $f)
				{
					$kodeguru = $f->kodeguru;
					if (empty($namaguru))
					{
						$namaguru = cari_nama_pegawai($kodeguru);
					}
					else
					{
						$namaguru .= ', '.cari_nama_pegawai($kodeguru);
					}
				}
			}
			echo '<tr><td align="center">'.$komponen.'</td><td>'.$mapele;
			echo '<br />'.$namaguru.'</td>';
			$adanilai = $tc->num_rows();
			if($adanilai>0)
			{
				foreach($tc->result() as $c)
				{
					$mapel = $c->mapel;
					$kunci = $c->kunci;
					$kkm = cari_kkm($thnajaran,$semester,$kelas,$mapel);
					if($status_nilai == 'akhir')
					{
						if(empty($kunci))
						{
							echo '<td colspan="5"><div class="alert alert-danger"><strong>Nilai belum dikunci oleh wali kelas</strong></div></td></tr>';
						}
						else
						{

						echo '<td align="center">'.$kkm.'</td>';
						echo '<td align="center">'.$c->kog.'</td>';
						echo '<td align="center">'.predikat_nilai_2018($c->kog,$kkm).'</td>';
						echo '<td align="center">'.$c->psi.'</td>';
						echo '<td align="center">'.predikat_nilai_2018($c->psi,$kkm).'</td>';
						}
					}
					elseif($status_nilai == 'sementara')
					{
						echo '<td align="center">'.$kkm.'</td>';
						echo '<td align="center">'.$c->nilai_nr.'</td>';
						echo '<td align="center">'.predikat_nilai_2018($c->nilai_nr,$kkm).'</td>';
						echo '<td align="center">'.$c->psikomotor.'</td>';
						echo '<td align="center">'.predikat_nilai_2015($c->psikomotor,$kkm).'</td>';
					}
					else
					{
						echo '<td align="center">Status nilai ?</td>';
					}

				}
			} //kalau ada nilai
			else
			{

				echo '<td align="center" colspan="5">Siswa tidak mengikuti mata pelajaran ini</td>';
			}

			echo '</tr>';
		}
	}
		echo '</table>';
	echo '<h5>Deskripsi Pengetahuan dan Keterampilan</h5>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td width="50">Nomor</td><td>Mata Pelajaran</td><td>Aspek</td><td>Deskripsi</td></tr>';
	$tmapel = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	foreach($tmapel->result() as $dm)
	{
		$mapel = $dm->nama_mapel_portal;
		$mapele = $dm->nama_mapel;
		$komponen = $dm->komponen;
		if(empty($mapel))
			{
			echo '<tr><td align="center">'.$komponen.'</td><td colspan="3">'.$mapele.'</td></tr>';
			}
		else
		{
			echo '<tr><td align="center" rowspan="2">'.$komponen.'</td><td rowspan="2" width="200">'.$mapele.'</td><td>Pengetahuan</td><td>';
			$desk = '';
			$ketpsi = '';
			$penggalan = substr($mapele,0,8);
			$penggalan = strtoupper($penggalan);
			$prakarya = 0;
			if(($penggalan == 'PRAKARYA') or ($penggalan == 'KETERAMP') or ($penggalan == 'KETRAMPI'))
			{
				$td = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel` like '%prakarya%' and `nis`='$nis' and `status`='Y'");
				foreach($td->result() as $d)
				{
					$desk = $d->keterangan;
					$ketpsi = $d->deskripsi;
				}
				$prakarya = $td->num_rows();
			}
			if($prakarya == 0)
			{
				$td = $this->db->query("select * from `nilai` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis`='$nis'");
				foreach($td->result() as $d)
				{
					$desk = $d->keterangan;
					$ketpsi = $d->deskripsi;
				}

			}
			echo $desk.'</td></tr><tr><td>Keterampilan</td><td>';
			echo $ketpsi.'</td></tr>';
		}
	} // akhir deskripsi 
	echo '</table>';
	echo '<h4>C. Ekstrakurikuler</h4>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td width="50">Nomor</td><td>Kegiatan Ekstrakurikuler</td><td>Nilai</td><td>Deskripsi</td></tr>';
	$nilai_ekstra = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$adaekstra = $nilai_ekstra->num_rows();
	if ($adaekstra>0)
	{
		$no = 1;
		foreach($nilai_ekstra->result() as $dne)
		{
			echo '<tr><td align="center">'.$no.'</td><td>'.$dne->nama_ekstra.'</td><td align="center">'.$dne->nilai.'</td><td>'.$dne->keterangan.'</td></tr>';
			$no++;
		}
	}
	else
	{
	    echo '<tr><td colspan="4">NIHIL</td></tr>';
	}
	echo '</table>';
	//prestasi
	echo '<h4>D. Prestasi</h4>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td width="50">Nomor</td><td>Jenis Kegiatan</td><td>Keterangan</td></tr>';
	//cari prestasi
	$tpres = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran'");
	$adapres = $tpres->num_rows();
	if ($adapres>0)
			{
	$no = 1;
	foreach($tpres->result() as $dpres)
		{
		echo '<tr><td align="center">'.$no.'</td><td>'.$dpres->kegiatan.'</td><td>'.$dpres->keterangan.'</td></tr>';
		$no++;
		}
	}
	else
	{
	    echo '<tr><td colspan="3">NIHIL</td></tr>';
	}
	echo '</table>';
	// ketidak hadiran
	$catatanwalikelas = '';
	echo '<h4>E. Ketidakhadiran</h4>';
	echo '<table class="table table-black-bordered">';

	$nilai_pribadi = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$adapribadi = $nilai_pribadi->num_rows();
	if ($adapribadi>0)
	{
		foreach($nilai_pribadi->result() as $d)
		{
			$catatanwalikelas = $d->wali;
			echo '<tr align="center"><td width="50">Nomor</td><td>Ketidakhadiran</td><td>Keterangan</td></tr>';
			echo '<tr><td align="center">1</td><td>Sakit</td><td>'.$d->sakit.' hari</td></tr>';
			echo '<tr><td align="center">2</td><td>Izin</td><td>'.$d->izin.' hari</td></tr>';
			echo '<tr><td align="center">3</td><td>Tanpa Keterangan</td><td>'.$d->tanpa_keterangan.' hari</td></tr>';
			echo '<tr><td align="center">4</td><td>Terlambat</td><td>'.$d->terlambat.' kali</td></tr>';
			echo '<tr><td align="center">5</td><td>Membolos</td><td>'.$d->membolos.' kali</td></tr>';
			echo '<tr><td align="center">6</td><td>Kredit Pelanggaran</td><td>'.$d->angka_kredit.'</td></tr>';
		}
	} //kalau ada pribadi
	else
	{
		echo '<tr><td colspan="3">BELUM ADA DATA</td></tr>';
	}
	
	echo '</table>';
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
	echo '<h4>F. Catatan Walikelas</h4>';
	echo '<table class="table table-black-bordered"><tr><td><p>'.$catatanwalikelas.'</p></td></tr></table>';
	echo '<h4>G. Tanggapan Orang Tua / Wali</h4>';
	echo '<table class="table table-black-bordered"><tr><td><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td></tr></table>';
	if($siswa == 'ya')
	{
	echo '<table width="100%">
		<tr><td width="30%">Mengetahui</td><td width="36%"></td><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'</td></tr>
		<tr><td>Orang tua / wali</td><td></td><td>Walikelas</td></tr>
		<tr><td><br /><br /><br /></td><td></td><td></td></tr>
		<tr><td>______________________</td><td></td><td>'.$namawalikelas.'</td></tr>
		<tr><td></td><td></td><td>NIP '.$nipwalikelas.'</td></tr>
		<tr><td></td><td><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td></tr></table>';
	}
	else
	{
		if($semester == '2')
		{
			$kelasnaik = '';
			$kelasajeg = '';
			if(substr($kelas,0,2) == 'X-')
			{
				$kelasnaik = 'XI (sebelas)';
				$kelasajeg = 'X (sepuluh)';
			}
			if(substr($kelas,0,3) == 'XI-')
			{
				$kelasnaik = 'XII (dua belas)';
				$kelasajeg = 'XI (sebelas)';
			}
			$k1 = 1;
			if(substr($kelas,0,4) == 'XII-')
			{
				$keputusan = '<p>Keputusan</p><p>Berdasar kriteria kelulusan satuan pendidikan peserta didik ditetapkan lulus / tidak lulus</p>';
			}
			else
			{
				$keputusan = '<p>Keputusan</p><p>Berdasar pencapaian kompetensi pada semester 1, semester 2 dan kriteria kenaikan kelas, peserta didik ditetapkan</p><p>naik ke kelas '.$kelasnaik.'</p><p>tinggal di kelas '.$kelasajeg.'</p>';
			}
			echo '<table width="100%"><tr><td width="50%">'.$keputusan.'</td></tr></table>';

		}
	echo '<table width="100%">
		<tr><td width="30%">Mengetahui</td><td></td><td width="30%">'.$lokasi.', '.date_to_long_string($tanggalcetak).'</td></tr>
		<tr><td>Orang tua / wali</td><td></td><td>Walikelas</td></tr>
		<tr><td><br /><br /><br /></td><td></td><td></td></tr>
		<tr><td>______________________</td><td></td><td>'.$namawalikelas.'</td></tr>
		<tr><td></td><td></td><td>NIP '.$nipwalikelas.'</td></tr></table>';
		if($semester == '2')
		{
			echo '<table width="100%">
		<tr><td width="25%"></td><td>';
			if($tanda_tangan == 'YA')
			{
				echo '<table height="135" width="400" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table>';
			}
			else
			{
					echo '<table height="135" width="400"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table>';
			}
			echo '</td></tr></table>';
		}

	}
		

?>
</div>

