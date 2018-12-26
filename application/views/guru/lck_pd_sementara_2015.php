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
?>
<div class="container-fluid">
<div class="alert alert-danger">
<p class="text-center">CAPAIAN HASIL BELAJAR (SEMENTARA)</p></div>
<div class="alert alert-info">
<p class="text-center">
Untuk rapor <strong>Akhir</strong> klik di  <?php
echo "<a href='".base_url()."guru/detilsiswa/".$nis."/".$id_walikelas."/9' title='Rapor ".nis_ke_nama($nis)."'>sini</a>";
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
foreach($ta->result() as $a)
	{
	$thnajaran = $a->thnajaran;
	$semester = $a->semester;
	$kelas = $a->kelas;
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
	?>
	<form class="form-horizontal" role="form">
	    <div class="form-group row row">
	<div class="col-sm-2"><label class="control-label">Nama Sekolah</label></div>
		<div class="col-sm-4" ><p class="form-control-static"><?php echo $this->config->item('sek_nama');?></p></div>
	<div class="col-sm-2"><label class="control-label">Kelas</label></div>
		<div class="col-sm-4" ><p class="form-control-static"><?php echo $kelas;?></p></div>
	<div class="col-sm-2"><label class="control-label">Alamat</label></div>
		<div class="col-sm-4" ><p class="form-control-static"><?php echo $this->config->item('sek_alamat');?></p></div>
	<div class="col-sm-2"><label class="control-label">Semester</label></div>
		<div class="col-sm-4" ><p class="form-control-static"><?php echo $semester;?></p></div>
	<div class="col-sm-2"><label class="control-label">Nama Peserta Didik</label></div>
		<div class="col-sm-4" ><p class="form-control-static"><?php echo $namasiswa;?></p></div>
	<div class="col-sm-2"><label class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-4" ><p class="form-control-static"><?php echo $thnajaran;?></p></div>
	<div class="col-sm-2"><label class="control-label">Nomor Induk / NISN</label></div>
		<div class="col-sm-4" ><p class="form-control-static"><?php echo $nis.' / '.$nisn;?></p></div>
	<div class="col-sm-2"><label class="control-label">Wali kelas</label></div>
		<div class="col-sm-4" ><p class="form-control-static"><?php echo $namawalikelas;?></p></div>
	</div>
	<?php
	//sikap spiritual dan sosial
	$td = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$sikap_spiritual = '';
	$sikap_sosial = '';
	$pred1 = '';
	$pred2 = '';
	foreach($td->result() as $d)
	{
		$sikap_spiritual = $d->kom1;
		$sikap_sosial = $d->kom2;
		$pred1 = $d->satu;
		$pred2 = $d->dua;
	}
	echo '<h3><p class="text-center"><a href="'.base_url().'guru/daftarsiswa/'.$id_walikelas.'">CAPAIAN HASIL BELAJAR</a></p></h3>';
	echo '<h4>A. Sikap</h4><h5>1. Sikap Spiritual</h5>';
	echo '<table class="table table-hover table-striped table-bordered"><tr><td width="200">Predikat</td><td>Deskripsi</td></tr>';
	echo '<tr><td><p> '.$pred1.' ('.predikat_sikap($pred1).')</p></td><td>'.$sikap_spiritual.'</td></tr></table>';
	echo '<table class="table table-hover table-striped table-bordered"><tr><td width="200">Predikat</td><td>Deskripsi</td></tr>';
	echo '<tr><td><p> '.$pred2.' ('.predikat_sikap($pred2).')</p></td><td>'.$sikap_sosial.'</td></tr></table>';
	echo '<h4>B. Pengetahuan dan Keterampilan</h4>';
	echo '<table class="table table-hover table-striped table-bordered">
	<tr ><td width="270" align="center" rowspan="2" colspan="2">Mata Pelajaran</td><td align="center" colspan="2">Pengetahuan</td><td align="center" colspan="2">Keterampilan</td>
<td rowspan="2" align="center"><strong>Tuntas</strong></td></tr>
<tr><td align="center">Angka</td><td align="center">Predikat</td><td align="center">Angka</td><td align="center">Predikat</td></tr>';
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
			echo '<td colspan="9">';
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
			//cari guru
			$kodeguru ='??';			
			$tf = $this->db->query("select * from `m_mapel` where `mapel`='$mapelportal' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester'");
			$kkm = 0;
			foreach($tf->result() as $f)
				{
				$kodeguru = $f->kodeguru;
				$tg = $this->db->query("select * from `p_pegawai` where `kodeguru`='$kodeguru'");
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
			//cari nilai
			$td = $this->db->query("select * from `nilai` where `mapel`='$mapelportal' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis`='$nis' and `status`='Y'");
			$nilai_pengetahuan = 0;
			$nilai_keterampilan = 0;
			$nilai_afektif = '';
			$ket='';
			$kunci = '';
			$kd = '';
			echo '<tr><td width="30" align="center">'.$komponen.'</td>';
			echo '<td>'.$mapel.'<br /><strong>'.$namaguru.'</strong></td>';
			foreach($td->result() as $d)
				{

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
				$qa = $nilai_pengetahuan;
				$qb = predikat_nilai_2015($nilai_pengetahuan);
				$qc = $nilai_keterampilan;
				$qd = predikat_nilai_2015($nilai_keterampilan);
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
				echo '<td align="center">'.$ket.'</td>';
				}
				echo '</tr>';
				$nomor++;
				}
			}
		}
		// akhir kelompok A
		echo '</table><div class="alert alert-info">* <strong>Nilai rapor diambil dari kolom NA dan NP</strong></div>';

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
						echo '<tr><td width="5%" align="center" rowspan="2">'.$komponen.'</td><td  rowspan="2" width="25%">'.$mapel.'</td><td>Pengetahuan</td><td>'.$desk.'</td></tr><tr><td>Keterampilan</td><td>'.$ketpsi.'</td></tr>';
						$nomor++;
						}		
					}
				
			} // akhir deskripsi

			echo '</table>';
	}
	echo '<h4>C. Ekstrakurikuler</h4>';
		echo '<table class="table table-hover table-striped table-bordered">';
		echo '<tr align="center"><td width="30" align="center">NO</td><td align="center" width="300">Ekstrakurikuler</td><td align="center">Kegiatan yang diikuti</td></tr>';
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

	// Prestasi dan Organisasi
	echo '<h4>D. Prestasi</h4>';
	$td = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran'");
	$adaprestasi = $td->num_rows();
	if ($adaprestasi>0)
	{
	echo '<table  class="table table-hover table-striped table-bordered">
	<tr><td width="50"><strong>Nomor</strong></td><td width="300"><strong>Kegiatan</strong></td><td><strong>Keterangan</strong></td><td><strong>Valid</strong></td></tr>';
	$no = 1;
	foreach($td->result() as $d)
		{
		echo '<tr><td align="center">'.$no.'</td><td>'.$d->kegiatan.'</td><td>'.$d->ket_akhirerangan.'</td><td>';
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
	$cacatanwali = '';
	//ketidakhadiran
	echo '<h4>E. Ketidakhadiran</h4>';
		$nilai_pribadi = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
		$adapribadi = $nilai_pribadi->num_rows();
		if ($adapribadi>0)
			{
			
			echo '<table class="table table-hover table-striped table-bordered">';
			foreach($nilai_pribadi->result() as $d)
				{
					$cacatanwali = $d->wali;
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
	echo '<h5>F. Catatan Walikelas</h4>';
	echo '<table class="table table-hover table-striped table-bordered"><tr><td>'.$cacatanwali.'</td></tr></table>';
} // kalau data ada
?>
</div>
