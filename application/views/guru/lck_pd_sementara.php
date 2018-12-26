<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_pd.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
    <title><?php echo $judulhalaman;?></title>
    <?php
	$ta = $this->db->query("select * from `temauser` where `user`='$nim'");
	$adata = $ta->num_rows();
	if($adata==0)
	{?>
	    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
	<?php
	}
	else
	{
		$temacss = '';
		$ta = $this->db->query("select * from `temauser` where `user`='$nim'");
		foreach($ta->result() as $a)
		{
			$temacss = $a->temacss;
		}
		if(!empty($temacss))
		{?>
		    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
		    <link href="<?php echo base_url();?>assets/css/<?php echo $temacss;?>" rel="stylesheet"/>
		<?php
		}
	}

     ?>
    <link rel="stylesheet" href="<?php echo base_url();?>css/teks.css">		
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />

    <script src="<?php echo base_url();?>assets/js/jquery.min-1.12.0.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<div class="alert alert-danger">
<p class="text-center">Laporan Capaian Kompetensi Peserta Didik (SEMENTARA)</p></div>
<div class="alert alert-info">
<p class="text-center">
Untuk Capaian Kompetensi Peserta Didik <strong>Akhir</strong> klik di  <?php
echo "<a href='".base_url()."guru/detilsiswa/".$nis."/".$id_walikelas."/5' title='Laporan Capaian Kompetensi Peserta Didik ".nis_ke_nama($nis)."'>sini</a>";
?>
</p></div>
<?php
$kodewali = $kodeguru;
$ta = $this->db->query("SELECT * FROM `m_walikelas` where `kodeguru`='$kodewali' and `id_walikelas`='$id_walikelas'");
if(count($query->result())==0)
{
	echo 'Data Walikelas tidak tepat';
}
else
{
$namawalikelas = cari_nama_pegawai($kodewali);
$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y' order by kd_mapel ASC");
	$nomor = 1;
	foreach($ta->result() as $a)
	{
	$keterangan = 'Sudah kompeten';
	$nis = $a->nis;
	$mapel = $a->mapel;
	//cari ranah
	$kkm = '';
	$tmapel = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
	foreach($tmapel->result() as $dtmapel)
	{
		$kkm = $dtmapel->kkm;
	}
	if ($a->nilai_nr < $kkm)
		{
		$keterangan = 'Belum kompeten';
		}
	if ($a->psikomotor < $kkm)
		{
		$keterangan = 'Belum kompeten';
		}
	if (($a->afektif !='A')  and ($a->afektif!='B') and ($a->afektif !='SB'))
		{
			$keterangan = 'Belum kompeten';
		}
$this->db->query("update `nilai` set `ket`='$keterangan' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
	}
$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' and `nis` = '$nis'");
	if(count($tdata_siswa->result())==0)
		{
		echo 'Siswa tidak ditemukan';
		}
	else
	{
	$tabel = 'nilai';
	$status = "and status='Y'";
	$no_urut = '';
	foreach($tdata_siswa->result() as $dd)
		{
		$no_urut = $dd->no_urut;
		}
	$namasiswa = nis_ke_nama($nis);
	$nisn = nisn($nis);
	$peminatan = kelas_jadi_program($kelas);
	echo '<table><tr><td colspan="6" align="center"><h3><a href="'.base_url().'guru/daftarsiswa/'.$id_walikelas.'">LAPORAN CAPAIAN KOMPETENSI PESERTA DIDIK</h3></a></TD><TR><tr><td width="10%">Nama Madrasah</td><td width="2">:</td><td width="25%">'.$this->config->item('sek_nama').'</td><td width="10%">Kelas</td><td width="2">:</td><td>'.$kelas.'</td></tr>
<tr><td>Alamat</td><td>:</td><td>'.$this->config->item('sek_alamat').'</td><td>Semester</td><td>:</td><td>'.$semester.'</td></tr>
<tr><td>Nama Peserta Didik</td><td>:</td><td>'.$namasiswa.'</td><td>Tahun Pelajaran</td><td>:</td><td>'.$thnajaran.'</td></tr>
<tr><td>Nomor Induk / NISN</td><td>:</td><td>'.$nis.' / '.$nisn.'</td><td>Wali kelas</td><td>:</td><td>'.$namawalikelas.'</td></tr></table>';
	echo '<table class="table table-hover table-striped table-bordered">
	<tr ><td width="270" align="center" rowspan="3" colspan="2">Mata Pelajaran</td><td align="center" colspan="2">Pengetahuan (KI-3)</td><td align="center" colspan="2">Keterampilan (KI-4)</td><td width="100" align="center" rowspan="2">Sikap Spiritual dan Sosial (KI 1 dan KI 2) Dalam Mapel</td><td rowspan="3" align="center"><strong>Tuntas</strong></td></tr><tr><td align="center">Angka</td><td align="center">Predikat</td><td align="center">Angka</td><td align="center">Predikat</td></tr>';
	echo '<tr ><td align="center">1 - 4</td><td align="center"></td><td align="center">1 - 4</td><td align="center"></td><td align="center">SB/B/C/K</td></tr>';
	$tc =$this->db->query("select * FROM `m_mapel_rapor` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and kelas = '$kelas' order by no_urut");
	$nomor=1;
	foreach($tc->result() as $c)
		{
		$mapelportal = $c->nama_mapel_portal;
		$mapel = $c->nama_mapel;
		$no_urut_rapor = $c->no_urut;
		$komponen = $c->komponen;
		if(empty($mapelportal))
			{
			echo '<tr><td width="30" align="center">'.$komponen.'</td>';
			echo '<td colspan="7">';
			if($mapel == 'Peminatan')
				{
				echo $mapel.' <strong>'.$peminatan.'</strong>';
				}
				else
				{
				echo $mapel;
				}
			echo '</td></tr>';
			$nomor++;
			}
			else
			{
			echo '<tr><td width="30" align="center">'.$komponen.'</td>';
				$kodeguru ='??';			
				$tf = $this->db->query("select * from `m_mapel` where `mapel`='$mapelportal' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester'");
				$kkm = 0;
				foreach($tf->result() as $f)
					{
					$kodeguru = $f->kodeguru;
					$tg = $this->db->query("select * from `p_pegawai` where `kd`='$kodeguru'");
					$namaguru ='';
					$kkm = $f->kkm;
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
				echo '<td><p>'.$mapel.'</p><p><strong>'.$namaguru.'</strong></p></td>';

			//cari nilai
			$td = $this->db->query("select * from `nilai` where `mapel`='$mapelportal' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis`='$nis' and `status`='Y'");
			$nilai_pengetahuan = 0;
			$nilai_keterampilan = 0;
			$nilai_afektif = '';
			$ket='';
			$kunci = '';
			$kd = '';
			foreach($td->result() as $d)
				{
				//cari guru
				$nilai_pengetahuan = $d->nilai_nr;
				$nilai_keterampilan = $d->psikomotor;
				$nilai_afektif = $d->afektif;
				$ket = $d->ket;
				$kd = $d->kd;
				$kunci = $d->kunci;
				if (substr($ket,0,5)=='Belum')
					{
					$ket = '<font color="#FF0000">'.$ket.'</font>';
					}
				$qa = konversi_nilai($nilai_pengetahuan);
				$qb = predikat_nilai($nilai_pengetahuan);
				$qc = konversi_nilai($nilai_keterampilan);
				$qd = predikat_nilai($nilai_keterampilan);
				$qe = predikat_afektif($nilai_afektif);
				if (substr($ket,0,5)=='Belum')
					{
					$ket = '<font color="#FF0000">'.$ket.'</font>';
					}
				if($nilai_pengetahuan<$kkm)
					{
					echo '<td align="center"><font color="#FF0000">'.$qa.'</font></td><td align="center"><font color="#FF0000">'.$qb.'</font></td>';
					}
					else
					{
					echo '<td align="center">'.$qa.'</td>
					<td align="center">'.$qb.'</td>';
					}
				if($nilai_keterampilan<$kkm)
					{
					echo '<td align="center"><font color="#FF0000">'.$qc.'</font></td><td align="center"><font color="#FF0000">'.$qd.'</font></td>';
					}
					else
					{
					echo '<td align="center">'.$qc.'</td>
					<td align="center">'.$qd.'</td>';
					}
				if(($nilai_afektif =='A') or ($nilai_afektif =='B') or ($nilai_afektif =='SB'))
					{
					echo '<td align="center">'.$qe.'</td>';
					}
					else
					{
					echo '<td align="center"><font color="#FF0000">'.$qe.'</font></td>';
					}
				echo '<td align="center">'.$ket.'</td></tr>';
			$nomor++;
				}
			}
		}
		// akhir kelompok A
		echo '</table>* <strong>Nilai rapor diambil dari kolom NR dan NP</strong>';
		echo '<table class="table table-hover table-striped table-bordered">';
		//sikap antar mapel
		$td = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		$sikap_antarmapel = '';
		foreach($td->result() as $d)
			{
			$sikap_antarmapel = $d->kom1;
			}
		echo '<tr><td align="center">Sikap Spiritual dan Sosial Antarmapel</td><tr>
			<tr><td>'.$sikap_antarmapel.'</td></tr></table>';
		echo '<table class="table table-hover table-striped table-bordered">';
		echo '<tr align="center"><td width="30" align="center">NO</td><td align="center" width="100">Ekstrakurikuler</td><td align="center">Kegiatan yang diikuti</td></tr>';
		$nilai_ekstra = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
		$adaekstra = $nilai_ekstra->num_rows();
		if ($adaekstra>0)
		{
		$no = 1;
		$nomor = 1;
		foreach($nilai_ekstra->result() as $dne)
			{
				echo '<tr><td align="center">'.$no.'</td><td width="100">'.$dne->nama_ekstra.'</td><td>'.$dne->keterangan.'</td></tr>';
				$no++;
				$nomor++;
			}
		}
		echo '</table>';
		//ketidakhadiran
		$nilai_pribadi = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
		$adapribadi = $nilai_pribadi->num_rows();
		if ($adapribadi>0)
			{
			
			echo '<table class="table table-hover table-striped table-bordered">';
			foreach($nilai_pribadi->result() as $d)
				{
					echo '<tr><td align="center">NO</td><td align="center">Ketidakhadiran</td><td align="center">Keterangan</td></tr>
					<tr><td align="center">1</td><td>Sakit</td><td align="center">'.$d->sakit.' hari</td></tr>
					<tr><td align="center">2</td><td>Izin</td><td align="center">'.$d->izin.' hari</td></tr>
					<tr><td align="center">3</td><td>Tanpa Keterangan</td><td align="center">'.$d->tanpa_keterangan.' hari</td></tr>
					<tr><td align="center">4</td><td>Terlambat</td><td align="center">'.$d->terlambat.' kali</td></tr>
					<tr><td align="center">5</td><td>Membolos</td><td align="center">'.$d->membolos.' kali</td></tr>
					<tr><td align="center">6</td><td>Kredit Pelanggaran</td><td align="center">'.$d->angka_kredit.'</td></tr>';
				}
			echo '</table>';
			} //kalau ada pribadi
//deskripsi capaian
			echo '<table class="table table-hover table-striped table-bordered">';
			echo '<tr align="center"><td colspan="4">Deskripsi Capaian Kompetensi Siswa</td></tr>';
			echo '<tr><td colspan="2">Mata Pelajaran</td><td align="center" width="100">Kompetensi</td><td align="center">Deskripsi</td></tr>';
			$th =$this->db->query("select * FROM `m_mapel_rapor` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and kelas = '$kelas' order by no_urut");
			$nomor = 1;
			foreach($th->result() as $h)
				{
					$mapelportal = $h->nama_mapel_portal;
					$mapel = $h->nama_mapel;
					$komponen = $h->komponen;
					
					if(empty($mapelportal))
					{
					echo '<tr><td colspan="4">'.$komponen.'. ';
						if($mapel == 'Peminatan')
							{
							echo $mapel.' <strong>'.$peminatan.'</strong>';
							}
							else
							{
							echo $mapel;
							}
					echo '</td></tr>';
					}
					else
					{
					//cari nilai
					$td = $this->db->query("select * from `$tabel` where `mapel`='$mapelportal' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis`='$nis'");
					$desk = '';
					foreach($td->result() as $d)
						{
						$desk = $d->keterangan;
						}
//keterampilan
					$ti = $this->db->query("select * from psikomotorik where `mapel`='$mapelportal' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
					$ketpsi='';
					foreach($ti->result() as $i)
						{
							$ketpsi = $i->deskripsi;
						}
//sikap
					$tj = $this->db->query("select * from `afektif` where `mapel`='$mapelportal' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
					$ketafektif='';
					foreach($tj->result() as $j)
						{
							$ketafektif = $j->deskripsi;
						}
					$mengikuti = $td->num_rows();
					if($mengikuti>0)
						{
						echo '<tr><td width="5%" align="center" rowspan="3">'.$komponen.'</td><td  rowspan="3" width="25%">'.$mapel.'</td><td>Pengetahuan</td><td>'.$desk.'</td></tr><tr><td>Keterampilan</td><td>'.$ketpsi.'</td></tr><tr><td>Sikap Spiritual dan Sosial</td><td>'.$ketafektif.'</td></tr>';
						$nomor++;
						}		
					}
				
			} // akhir deskripsi

			echo '</table>';
	}
	// Prestasi dan Organisasi
	echo '<h2>Prestasi Siswa</h2>';
	$td = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran'");
	$adaprestasi = $td->num_rows();
	if ($adaprestasi>0)
	{
	echo '<table>
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
	echo '<table>
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
	echo '';
} // kalau data ada

?>
</div>




