<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_bph.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tkalab = $this->db->query("select * from `p_tugas_tambahan` where `nama_tugas` like '%$lab%' and `thnajaran`='$thnajaran' and `semester`='$semester'");
$kodekalab = '??';
$adakalab = $tkalab->num_rows();
foreach($tkalab->result() as $dkalab)
	{
	$kodekalab = $dkalab->kodeguru;
	}
$trph = $this->db->query("select * from `guru_rph` where `lab` like '%$lab%' and thnajaran='$thnajaran' and semester='$semester' order by tanggal ASC, jamke ASC");
?>

<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/formmencetak">Buku Kegiatan <?php echo $lab;?></a></p></h3>

<table width="100%">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
</table>
<?php
$ada = count($trph->result());
if ($ada == 0)
	{
	echo "Belum ada data Buku Kegiatan Laboratorium";
	}
else
{
?>
<div class="CSSTableGenerator">
<table width="100%">
<tr align="center"><td>No.</td><td>Tanggal</td><td>Jam Ke-</td><td>Kelas</td><td>Mapel</td><td>Materi</td><td>Alat, Bahan, atau Perangkat yang digunakan</td><td>Nama Guru</td><td>Paraf Guru</td><td>Keterangan</td></tr>
<?php
$nomor =1;
	foreach ($trph->result() as $d)
	{
	$kodeguru = $d->kodeguru;
	$namaguru = cari_nama_pegawai($kodeguru);
	$materi = $d->materi;
	$materi = preg_replace("/<p>/","",$materi);
	$materi = preg_replace("/<\/p>/","",$materi);
	$materi_selanjutnya = $d->materi_selanjutnya;
	$materi_selanjutnya = preg_replace("/<p>/","",$materi_selanjutnya);
	$materi_selanjutnya = preg_replace("/<\/p>/","",$materi_selanjutnya);
	$dinane = tanggal_ke_hari($d->tanggal_bph);
	$tanggalkbmx = $d->tanggal_bph;
	$kelas = $d->kelas;
	$alat_dan_bahan = $d->alat_dan_bahan;
	//cari siswa yang tidak masuk karena sakit, izin, tanpa keterangan
	$thadir2 = $this->db->query("select * from `siswa_absensi` where tanggal='$tanggalkbmx' and `alasan` != 'T' ");
	$namasiswa = '';
	foreach ($thadir2->result() as $dd)
		{
			//cek kelas siswa
			$nis = $dd->nis;
			$tkelas = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' and `kelas`='$kelas' and `thnajaran`='$thnajaran'");
			if(count($tkelas->result())>0)
			{
					if (empty($namasiswa))
					{
						$namasiswa .= nis_ke_nama($nis)." (".$dd->alasan.")";
						}
						else
						{
						$namasiswa .= ", ".nis_ke_nama($nis)." (".$dd->alasan.")";
						}
			}
			

		}
	$thadir = $this->db->query("select * from `hadir` where tanggal='$tanggalkbmx'");
	foreach ($thadir->result() as $ddd)
		{
			//cek kelas siswa
			$nis = $ddd->nis;
			//sudah di daftar absen
			$thadir3 = $this->db->query("select * from `siswa_absensi` where tanggal='$tanggalkbmx' and `nis`='$nis'");
			$sudahdiabsen = $thadir3->num_rows();
			if($sudahdiabsen ==0)
			{
				$tkelas = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' and `kelas`='$kelas' and `thnajaran`='$thnajaran'");
				if(count($tkelas->result())>0)
				{
					if (empty($namasiswa))
						{
						$namasiswa .= nis_ke_nama($nis)." (".$ddd->alasan.")";
						}
						else
						{
						$namasiswa .= ", ".nis_ke_nama($nis)." (".$ddd->alasan.")";
						}
				}
			}		

		}

	//cek apakah terlaksana
	$keterangan = strip_tags($d->keterangan);
	$keterangan = strtoupper($keterangan);

	if (substr($keterangan,0,5) != 'TIDAK')
		{
		echo '<tr><td align="center" width="30">'.$nomor.'</td><td width="100">'.$dinane.', '.date_to_long_string($d->tanggal_bph).'</td><td align="center" width="30">'.$d->jamke.'</td><td align="center" width="60">'.$d->kelas.'</td><td>'.$d->mapel.'</td><td>'.tanpa_paragraf($materi).'</td><td>'.$alat_dan_bahan.'</td><td>'.$namaguru.'</td><td></td><td>'.$namasiswa.'</td></tr>';
		$nomor++;
		}

	}

}
?>
</table></div>
<?php
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodekalab);
$nipguru = cari_nip_pegawai($kodekalab);
if ($ditandatangani=='ya')
{
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}

?>


</div></body></html>
