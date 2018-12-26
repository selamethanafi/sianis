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
<input type="button" value="Tutup jendela ini" onclick="self.close()" class="btn btn-primary">
atau gunakan Ctrl + W

<h3><p class="text-center text-success">Laporan Hasil Belajar Siswa (AKHIR)<p></h3>
<?php
//cari id_tahun_pelajaran
$id_thnajaran = '';
$cacahkunci = 0;
$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
foreach($td->result() as $d)
{
$id_thnajaran = $d->id;
}

$twalikelas = $this->Nilai_model->Walikelas($thnajaran,$semester,$kelas);
$namawalikelas = '';
$nipwalikelas = '';
$kodewalikelas = '';
foreach($twalikelas->result() as $dwalikelas)
	{
		$kodewalikelas = $dwalikelas->kodeguru;
		}
$namawalikelas = cari_nama_pegawai($kodewalikelas);
?>
<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="40%"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Nama Siswa</strong></td><td>: <strong><?php echo nis_ke_nama($nis);?></strong></td></tr>
<tr><td><strong>Wali Kelas</strong></td><td>: <strong><?php echo $namawalikelas;?></strong></td></tr>
</table>
<?php
if ($penanganan == 'ketuntasan')
	{

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
				if ($a->kog < $kkm)
					{
					$keterangan = 'Belum kompeten';
					}
			}
		if( ($ranah == 'PA') or  ($ranah == 'KPA'))
			{
				if ($a->psi < $kkm)
					{
					$keterangan = 'Belum kompeten';
					}
			}
	if (($a->afektif !='A')  and ($a->afektif!='B') and ($a->afektif !='SB'))
		{
			$keterangan = 'Belum kompeten';
		}
		$this->db->query("update `nilai` set `ket_akhir`='$keterangan' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
	}
}
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
	echo '<table width="95%"><tr align="center"><td><strong>No.</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>KKM</strong></td><td  colspan="2"><strong>Kognitif</strong></td><td colspan="2"><strong>Psikomotor</strong></td><td><strong>Afektif</strong></td><td><strong>Kompeten</strong></td><td><strong>Keterangan</strong></td></tr>';
	$tb = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	$nomor=1;
	foreach($tb->result() as $b)
	{	$mapel_portal = $b->nama_mapel_portal;
		$mapel = $b->nama_mapel;
		$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel_portal' and `status`='Y'");
		foreach($ta->result() as $a)
		{
			if(($nomor%2)==0){
				$warna=$warna1;
			} else{
				$warna=$warna2;
			}
			echo '<tr bgcolor="'.$warna.'"><td width="3%" align="center">'.$b->komponen.'</td><td width="15%">'.$mapel.'</td>';
			$data_kkm = $this->Nilai_model->Cari_KKM($thnajaran,$semester,$kelas,$mapel_portal);
			$kkm = '-';
			$ranah = '';
			foreach($data_kkm->result() as $dkkm)
			{
				$kkm = $dkkm->kkm;
				$ranah = $dkkm->ranah;
			}
			echo '<td align="center">'.$kkm.'</td>';
			if (($ranah=='KPA') or ($ranah=='KA'))
		    		{
				echo '<td align="center">'.$a->nilai_nr.'</td><td align="center"><input type="text" name="kog_'.$nomor.'" value ="'.$a->kog.'" size="1" class="textfield"></td>';
				}
				else
		    		{
			echo '<td align="center">-</td><td align="center"><input type="hidden" name="kog_'.$nomor.'" value ="" size="1" class="textfield">-</td>';
			}
			if (($ranah=='KPA') or ($ranah=='PA'))
	    		{
			echo '<td align="center">'.$a->psikomotor.'</td><td align="center"><input type="text" name="psi_'.$nomor.'" value ="'.$a->psi.'" size="1" class="textfield"></td>';
			}
			else
	    		{echo '<td align="center">-</td><td align="center"><input type="hidden" name="psi_'.$nomor.'" value ="" size="1" class="textfield">-</td>';}
		echo '<td align="center">'.$a->afektif.'</td><td align="center">';
	if(substr($a->ket_akhir,0,5)=='Belum')
		{
			echo '<font color="#FF0000">'.$a->ket_akhir.'</font>';
		}
		else
		{
			echo $a->ket_akhir;
		}
		echo '</td><td>'.$a->keterangan.'<input type="hidden" name="kd_'.$nomor.'"  value ='.$a->kd.'></td></tr>';
		} // akhir tabel nilai	
	$nomor++;
	}
	$cacah_mapel = $nomor - 1;
	echo '</table><input type="hidden" name="cacah_mapel"  value ='.$cacah_mapel.'><input type="hidden" name="tautan"  value ="detilsiswa/'.$nis.'/'.$id_walikelas.'/4"><input type="hidden" name="nis"  value ='.$nis.'><input type="submit" value="Simpan Nilai" class="tombol"></form>';

	}

}
if($penanganan != 'ubah')
{
$tb = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
$nomor=1;
$adamapelrapor = $tb->num_rows();
if ($adamapelrapor>0)
{
echo '<h2>Akademik</h2>';
	$nomor=1;
	echo '<table class="table table-striped table-hover table-bordered">
	<tr><td width="50" align="center"><strong>Nomor</strong></td><td align="center"><strong>Mata Pelajaran</strong></td><td align="center"><strong>KKM</strong></td><td align="center"><strong>Kognitif</strong></td><td align="center"><strong>Psikomotor</strong></td><td align="center"><strong>Afektif</strong></td><td align="center"><strong>Ketuntasan</strong></td><td align="center"><strong>Keterangan</strong></td><td align="center"><strong>Status Nilai</strong></td><td align="center"><strong>Aksi</strong></td></tr>';
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
			$tg = $this->db->query("select * from `p_pegawai` where `kodeguru`='$kodeguru'");
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
		echo '<tr><td align="center">'.$nourut.'</td><td>'.$mapel.'<br /><strong>'.$namaguru.'</strong></td><td align="center">'.$kkm.'</td>';
		$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel_portal' and `nis`='$nis' and `status`='Y'");
		$nk = '?';
		$np = '?';
		$ket = '?';
		foreach($tc->result() as $datax)
			{
			
			$afektif = $datax->afektif;
			if(($afektif == 'A') or ($afektif == 'B') or ($afektif == 'SB'))
				{
				$afektif = $afektif;
				}
				else
				{
				$afektif = '<font color="#FF0000">'.$afektif.'</font>';
				}

			if (($ranah=='KPA') or ($ranah=='KA'))
		    		{
				$nk=$datax->kog;
				if($nk<$kkm)
					{
					$nk = '<font color="#FF0000">'.$nk.'</font>';
					}
				}
				else
		    		{$nk = '-';}
			if (($ranah=='KPA') or ($ranah=='PA'))
		    		{
				$np =$datax->psi;
				if($np<$kkm)
					{
					$np = '<font color="#FF0000">'.$np.'</font>';
					}
				}
				else
		    		{$np = '-';}
			$ket = $datax->ket_akhir;
			if (substr($ket,0,5)=='Belum')
				{
				$ket = '<font color="#FF0000">'.$ket.'</font>';
				}
			echo '<td align="center">'.$nk.'</td><td align="center">'.$np.'</td><td align="center">'.$afektif.'</td><td>'.$ket.'</td>';
			echo '<td>'.$datax->keterangan.'</td><td align="center">';
			if (empty($datax->kunci))
				{
				echo '<img src="'.base_url().'images/unlock.png" alt="tidak terkunci">';
				}
				else
				{
				echo '<span class="glyphicon glyphicon-lock"></span>';
				}
			echo '</td><td align="center">';
			if (empty($datax->kunci))
				{
				echo '<a href="'.base_url().'index.php/guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/kunci/'.$datax->kd.'"><span class="glyphicon glyphicon-lock"></span>';
				$cacahkunci++;
				}
				else
				{
				echo '<a href="'.base_url().'index.php/guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/buka/'.$datax->kd.'"><img src="'.base_url().'images/unlock.png" alt="buka kunci"></span>';
				}
			echo '</td></tr>';
			}
	$nomor++;
		}
	}
	echo '</table><h1>* Nilai rapor diambil dari kolom NS dan NP*</h1>';
	echo '<a href="'.base_url().'index.php/guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/ketuntasan/">PERBARUI STATUS KETUNTASAN</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/buka/semua"><img src="'.base_url().'images/unlock.png" alt="buka kunci"></a> semua atau <a href="'.base_url().'index.php/guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/kunci/semua"><span class="glyphicon glyphicon-lock"></span></a> semua atau <a href="'.base_url().'index.php/guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/'.$item.'/ubah">Ubah Nilai</a><br /><br /><br />';

}
else
{
echo 'tidak ada data mata pelajaran yang tampil di rapor, hubungi pengajaran';
}
	echo '<h2>Pengembangan Diri</h2>';
	echo '<table>
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
	echo '<p class="text-info">Tidak ada data kehadiran / kepribadian</p>';
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
	echo '<p class="text-info">Tidak ada data prestasi siswa</p>';
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
	echo '<p class="text-info">Tidak ada data organisasi</p>';
	}
	if($cacahkunci == 0)
	{
	?>
	<p><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo $id_thnajaran.'/'.$semester.'/'.$nis;?>','yes','scrollbars=yes,width=550,height=400')"> Cetak LHB  <img border="0" src="/images/pdf.gif"></a></p>
	<?php
	}
	else
	{
	echo '<p><strong>Belum bisa dicetak karena ada '.$cacahkunci.' mapel yang belum dikunci</strong></p>';
	}

} //kalau tidak ada penanganan
?>

</div>
