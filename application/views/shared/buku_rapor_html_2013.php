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
<?php $fontsize = $this->config->item('fontsize_rapor');?>
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
<title><?php echo $judulhalaman;?></title>
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
<tr><td>Nama <?php echo ucwords(strtolower($this->config->item('sek_tipe')));?></td><td><?php echo $this->config->item('sek_nama');?></td><td>Kelas</td><td><?php echo nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);?></td></tr>

<tr><td>Alamat <?php echo $this->config->item('sek_tipe');?></td><td><?php echo $this->config->item('sek_alamat');?></td><td>Tahun Pelajaran</td><td><?php echo $thnajaran;?></td></tr>
<tr><td>Nama Peserta Didik</td><td><?php echo nis_ke_nama($nis);?></td><td>Semester</td><td><?php echo $semester;?></td></tr>
<tr><td>NIS / NISN</td><td><?php echo $nis;?> / <?php echo nisn($nis);?></td><td>Peminatan</td><td><?php echo $peminatan;?></td></tr></table><br /><br />
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
	echo '<table class="table table-black-bordered">
		<tr align="center"><td rowspan="3" colspan="2" width="35%">Mata Pelajaran</td><td colspan="3">Pengetahuan (KI-3)</td><td colspan="3">Keterampilan (KI-4)</td><td width="10%">Sikap spiritual dan sosial dalam mapel</td></tr><tr align="center"><td colspan="2">Angka</td><td>Predikat</td><td colspan="2">Angka</td><td>Predikat</td></tr><tr align="center"><td>1-100</td><td>1-4</td><td></td><td>1-100</td><td>1-4</td><td></td></tr> ';
	$tmapel = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	$nomor = 1;
	foreach($tmapel->result() as $dm)
	{
		$mapel = $dm->nama_mapel_portal;
		$mapele = $dm->nama_mapel;
		$komponen = $dm->komponen;
		if(empty($mapel))
		{
			echo '<tr><td align="center">'.$komponen.'</td><td colspan="7">'.$mapele.'</td></tr>';
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
						if((empty($kunci)) or ($kunci == '0'))
						{
							echo '<td colspan="5"><div class="alert alert-danger"><strong>Nilai belum dikunci oleh wali kelas</strong></div></td></tr>';
						}
						else
						{
							echo '<td align="center">'.$c->kog.'</td>';
							echo '<td align="center">'.konversi_nilai($c->kog).'</td>';
							if($this->config->item('predikat_nilai') == '2015')
							{
								echo '<td align="center">'.predikat_nilai_2015($c->kog,$this->config->item('versi_predikat_nilai')).'</td>';
							}
							else
							{
								echo '<td align="center">'.predikat_nilai($c->kog).'</td>';
							}
							echo '<td align="center">'.$c->psi.'</td>';
							echo '<td align="center">'.konversi_nilai($c->psi).'</td>';
							if($this->config->item('predikat_nilai') == '2015')
							{
								echo '<td align="center">'.predikat_nilai_2015($c->psi,$this->config->item('versi_predikat_nilai')).'</td>';
							}
							else
							{
								echo '<td align="center">'.predikat_nilai($c->psi).'</td>';
							}
						}
					}
					else
					{
						echo '<td align="center">Status nilai ?</td>';
					}
					echo '<td align="center">'.$c->afektif.'</td>';

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
	$td = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$sikap_antarmapel = '';
	foreach($td->result() as $d)
	{
		$sikap_antarmapel = $d->kom1;
	}
	echo '<table class="table table-black-bordered">
		<tr align="center"><td>Sikap Spiritual dan Sosial Antarmata pelajaran</td></tr><tr><td><p>'.$sikap_antarmapel.'</td><tr></table>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td width="10%">Nomor</td><td width="30%">Ekstrakurikuler</td><td >Keikutsertaan dalam kegiatan</td><tr>';
	$nilai_ekstra = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$adaekstra = $nilai_ekstra->num_rows();
	if ($adaekstra>0)
	{
		$no = 1;
		foreach($nilai_ekstra->result() as $dne)
		{
			echo '<tr><td align="center">'.$no.'</td><td>'.$dne->nama_ekstra.'</td><td>'.$dne->keterangan.'</td></tr>';
			$no++;
		}
	}
	else
	{
		echo '<tr align="center"><td colspan="3">tidak ada data atau siswa tidak mengikuti kegiatan ekstrakurikuler</td><tr>';
	}
	echo '</table>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td width="10%">Nomor</td><td width="30%">Ketidakhadiran</td><td>Keterangan</td><tr>';
	$nilai_pribadi = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$adapribadi = $nilai_pribadi->num_rows();
	if ($adapribadi>0)
	{
		foreach($nilai_pribadi->result() as $d)
		{
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
		echo '<tr><td>belum ada data</td></tr>';
	}
	echo '</table><br /><br />';
	echo '<h4>DESKRIPSI KOMPETENSI</h4>';
	echo '<table class="table table-black-bordered">
		<tr align="center"><td colspan="2" width="30%">Mata Pelajaran</td><td>Kompetensi</td><td>Catatan</td><tr>';
	$tmapel = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	foreach($tmapel->result() as $dm)
	{
		$mapel = $dm->nama_mapel_portal;
		$mapele = $dm->nama_mapel;
		$komponen = $dm->komponen;
		if($mapele == 'Peminatan')
		{
			echo '<tr><td>'.$komponen.'</td><td>'.$mapele.' '.$peminatan.'</td></tr>';
		}
		elseif(empty($mapel))
		{
			echo '<tr><td>'.$komponen.'</td><td>'.$mapele.'</td></tr>';
		}
		else
		{
			echo '<tr><td rowspan="3">'.$komponen.'</td><td rowspan="3">'.$mapele.'</td><td>Pengetahuan</td>';
			$desk = '';
			$ketpsi='';
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
			echo '<td>'.$desk.'</td></tr>';
			echo '<tr><td>Keterampilan</td>';
			echo '<td>'.$ketpsi.'</td></tr>';
			echo '<tr><td>Sikap spiritual dan sosial</td>';
			//sikap
			$tj = $this->db->query("select * from `afektif` where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
			$ketafektif='';
			foreach($tj->result() as $j)
			{
				$ketafektif = $j->deskripsi;
			}
			echo '<td>'.$ketafektif.'</td></tr>';
		}
	} // akhir deskripsi 
	echo '</table>';
	if($semester == '1')
	{
		echo '<table width="100%">
		<tr><td width="10%"></td><td>Mengetahui</td><td  width="40%">'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'</td></tr>
		<tr><td></td><td>Orang tua / wali</td><td>Walikelas</td></tr>
		<tr><td></td><td><br /><br /><br /><br /></td><td></td></tr>
		<tr><td></td><td>______________________</td><td>'.$namawalikelas.'<br />NIP '.$nipwalikelas.'</td></tr>
		</table>';
	}
	else
	{
		$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
		echo '<table width="100%">
		<tr><td width="10%"></td><td width="30%">Walikelas<br /><br /><br /><br />'.$namawalikelas.'<br />NIP '.$nipwalikelas.'</td><td><p>Keputusan</p>';
		if(substr($kelas,0,4) == 'XII-')
		{
			echo '<p>Berdasarkan kriteria kelulusan satuan pendidikan, peserta didik ditetapkan LULUS  /  TIDAK LULUS</p>';
		}
		else
		{
			echo '<p>Berdasarkan hasil yang dicapai pada semester 1 dan 2, peserta didik ditetapkan</p><p>naik ke kelas .................................. (.........................................)</p><p>tinggal di kelas ................................ (.........................................)</p>';
		}
		echo '</td></table><br /><table width="100%"><tr><td width="10%"></td><td width="40%"></td><td width="150"></td><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'</td></tr><tr><td></td><td>Orangtua / Wali Siswa<br /><br /><br /><br /><br />______________________</td><td colspan="2">';
	echo '<table height="135" width="400" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Kepala<br /><br /><br /><br />'.$namakepala.'<br />NIP '.$nipkepala.'</td></tr></table>';
	echo '</td></tr></table>';
	}
?>
</div>

