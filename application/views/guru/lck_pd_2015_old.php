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
<?php
//cari id_tahun_pelajaran
$id_thnajaran = '';
$cacahkunci = 0;
$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
foreach($td->result() as $d)
{
$id_thnajaran = $d->id;
}

$kodewali = $kodeguru;
$ta = $this->db->query("SELECT * FROM `m_walikelas` where `kodeguru`='$kodewali' and `id_walikelas`='$id_walikelas'");
if(count($query->result())==0)
{
	echo 'Data Walikelas tidak tepat';
}
else
{
$namawalikelas = cari_nama_pegawai($kodewali);

if (!empty($penanganan))
{
if ($penanganan == 'buka')
	{
		if ($yangdikunci == 'semua')
		{
		$this->db->query("update `nilai` set `kunci`='' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
		}
		else
		{
		$this->db->query("update `nilai` set `kunci`='' where `kd`='$yangdikunci' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
		}
	}
if ($penanganan == 'kunci')
	{
		if ($yangdikunci == 'semua')
		{
		$this->db->query("update `nilai` set `kunci`='1' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
		}
		else
		{
		$this->db->query("update `nilai` set `kunci`='1' where `kd`='$yangdikunci' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
		}

	}
if ($penanganan == 'ubah')
	{
	echo form_open('guru/updatenilairapor');
	echo '<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td><strong>No.</strong></td><td><strong>Mata Pelajaran</strong></td>
	<td><strong>KKM</strong></td><td  colspan="2"><strong>Kognitif</strong></td>
	<td colspan="2"><strong>Psikomotor</strong></td><td><strong>Kompeten</strong></td>
	<td><strong>Keterangan</strong></td></tr>';
	$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y' order by kd_mapel ASC");
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		echo '<tr><td width="3%" align="center">'.$nomor.'</td><td width="15%">'.$a->mapel.'</td>';
		$mapel = $a->mapel;
		$data_kkm = $this->Nilai_model->Cari_KKM($thnajaran,$semester,$kelas,$mapel);
		$kkm = '-';
		$ranah = '';
		foreach($data_kkm->result() as $dkkm)
		{
			$kkm = $dkkm->kkm;
			$ranah = $dkkm->ranah;
		}
		echo '<td align="center">'.$kkm.'</td>';
		echo '<td align="center">'.$a->nilai_nr.'</td><td align="center"><input type="number" name="kog_'.$nomor.'" value ="'.$a->kog.'" min="0" max="100" class="form-control"></td>';
		echo '<td align="center">'.$a->psikomotor.'</td><td align="center"><input type="number" name="psi_'.$nomor.'" value ="'.$a->psi.'" min="0" max="100" class="form-control"></td><td>';
	if(substr($a->ket_akhir,0,5)=='Belum')
		{
			echo '<font color="#FF0000">'.$a->ket.'</font>';
		}
		else
		{
			echo $a->ket;
		}
	echo '</td><td>'.$a->keterangan.'<input type="hidden" name="kd_'.$nomor.'"  value ='.$a->kd.'></td></tr>';
	$nomor++;
	}
	$cacah_mapel = $nomor - 1;
	echo '</table><p class="text-center"><input type="hidden" name="cacah_mapel"  value ='.$cacah_mapel.'><input type="hidden" name="tautan"  value ="detilsiswa/'.$nis.'/'.$id_walikelas.'/9"><input type="hidden" name="nis"  value ='.$nis.'><input type="submit" value="Simpan Nilai" class="btn btn-primary"></p></form>';

	}

}

if($penanganan != 'ubah')
{
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
	if ($a->kog < $kkm)
		{
		$keterangan = 'Belum kompeten';
		}
	if ($a->psi < $kkm)
		{
		$keterangan = 'Belum kompeten';
		}
	$this->db->query("update `nilai` set `ket_akhir`='$keterangan' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
	}

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
		<input type="button" value="Tutup jendela ini" onclick="self.close()" class="btn btn-primary">atau gunakan Ctrl + W
	<?php
	echo '<h3><p class="text-center">RAPOR</p></h3>';?>
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
	echo '<h3><p class="text-center">CAPAIAN HASIL BELAJAR</p></h3>';
	echo '<h4>A. Sikap</h4><h5>1. Sikap Spiritual</h5>';
	echo '<table class="table table-hover table-striped table-bordered"><tr><td width="200">Predikat</td><td>Deskripsi</td></tr>';
	echo '<tr><td><p> '.$pred1.' ('.predikat_sikap($pred1).')</p></td><td>'.$sikap_spiritual.'</td></tr></table>';
	echo '<table class="table table-hover table-striped table-bordered"><tr><td width="200">Predikat</td><td>Deskripsi</td></tr>';
	echo '<tr><td><p> '.$pred2.' ('.predikat_sikap($pred2).')</p></td><td>'.$sikap_sosial.'</td></tr></table>';
	echo '<h4>B. Pengetahuan dan Keterampilan</h4>';
	echo '<table class="table table-hover table-striped table-bordered">
	<tr ><td width="270" align="center" rowspan="2" colspan="2">Mata Pelajaran</td><td align="center" colspan="2">Pengetahuan</td><td align="center" colspan="2">Keterampilan</td>
<td rowspan="2" align="center"><strong>Tuntas</strong></td><td rowspan="2" align="center"><strong>Status Nilai</strong></td><td rowspan="2" align="center"><strong>Aksi</strong></td></tr>
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

				$nilai_pengetahuan = $d->kog;
				$nilai_keterampilan = $d->psi;
				$nilai_afektif = $d->afektif;
				$ket = $d->ket_akhir;
				$kd = $d->kd;
				$kunci = $d->kunci;
				if (substr($ket,0,5)=='Belum')
					{
					$ket = '<font color="#FF0000">'.$ket.'</font>';
					}
				$qa = $nilai_pengetahuan;
				$qc = $nilai_keterampilan;
				if($this->config->item('predikat_nilai') == '2015')
				{
					$qb = predikat_nilai_2015($nilai_pengetahuan,$this->config->item('versi_predikat_nilai'));
					$qd = predikat_nilai_2015($nilai_keterampilan,$this->config->item('versi_predikat_nilai'));
				}
				else
				{
					$qb = predikat_nilai($nilai_pengetahuan);
					$qd = predikat_nilai($nilai_keterampilan);
				}
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
				echo '<td align="center">'.$ket.'</td><td align="center" valign="center">';
				if (empty($kunci))
					{
					echo '<img src="'.base_url().'images/unlock.png" alt="bisa diubah">';
					}
					else
					{
					echo '<span class="glyphicon glyphicon-lock"></span>';
					}
				echo '</td><td align="center">';
				if (empty($kunci))
					{
					echo '<a href="'.base_url().'guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/kunci/'.$kd.'"><span class="glyphicon glyphicon-lock"></span>';
					$cacahkunci++;
					}
					else
					{
					echo '<a href="'.base_url().'guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/buka/'.$kd.'"><img src="'.base_url().'images/unlock.png" alt="buka-kunci">';
					}
				echo '</td>';
				}
				echo '</tr>';
				$nomor++;
				}
			}
		}
		// akhir kelompok A
		echo '</table><div class="alert alert-info">* <strong>Nilai rapor diambil dari kolom NS dan NP*</strong>&nbsp;&nbsp;&nbsp;';
	echo '<a href="'.base_url().'guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/buka/semua"><img src="'.base_url().'images/unlock.png" alt="buka-kunci"> semua</a> atau <a href="'.base_url().'guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/kunci/semua"><span class="glyphicon glyphicon-lock"></span> semua</a> atau <a href="'.base_url().'guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/ubah">Ubah Nilai</a></div>';
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
					$ketpsi = '';
					foreach($td->result() as $d)
						{
						$desk = $d->keterangan;
						$ketpsi = $d->deskripsi;
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
	$catatanwali = '';
	//ketidakhadiran
	echo '<h4>E. Ketidakhadiran</h4>';
		$nilai_pribadi = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
		$adapribadi = $nilai_pribadi->num_rows();
		if ($adapribadi>0)
			{
			
			echo '<table class="table table-hover table-striped table-bordered">';
			foreach($nilai_pribadi->result() as $d)
				{
					$catatanwali = $d->wali;
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
	echo '<h5>F. Catatan Walikelas</h5>';
	echo '<table class="table table-hover table-striped table-bordered"><tr><td>'.$catatanwali.'</td></tr></table>';
	
	if($cacahkunci == 0)
	{
		$model = '';
		$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
		if($kurikulum == '2015')
		{
			$model = '2015';
		}
			
	?>
	<p class="text-center"><a href="javascript:;" onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo $id_thnajaran.'/'.$semester.'/'.$nis.'/akhir/'.$model;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary"><span class="glyphicon glyphicon-print"> <strong>LHB</strong> </a>  <a href="javascript:;" onClick="window.open('<?php echo base_url();?>guru/rapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis.'/akhir/'.$kurikulum;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary" title="cocok kalau menggunakan google chrome atau chromium"><span class="glyphicon glyphicon-print"> <strong>LHB HTML</strong> </a> 
	<?php
	}
	else
	{
	echo '<strong>Belum bisa dicetak karena ada '.$cacahkunci.' mapel yang belum dikunci</strong>';
	}
} // kalau data ada
}
?>
</div>
