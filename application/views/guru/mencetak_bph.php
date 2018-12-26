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
$lebartabel="95%";
if($id_mapel == 'Semua')
	{
	$trph = $this->db->query("select * from `guru_rph` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal ASC, jamke ASC");
	$kelasmapel = 'Semua / Semua';
	}
	else
	{
	$mapel = id_mapel_jadi_mapel($id_mapel);
	$kelas = id_mapel_jadi_kelas($id_mapel);
	$trph = $this->db->query("select * from `guru_rph` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and `mapel`='$mapel' and `kelas`='$kelas' order by tanggal ASC, jamke ASC");
	$kelasmapel = $kelas.' / '.$mapel;
	}
?>
<h3><p class="text-center"><a href="<?php echo base_url(); ?>index.php/guru/formmencetak">Buku Pelaksanaan Harian</a></p></h3>
<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas / Mapel</strong></td><td>: <strong><?php echo $kelasmapel;?></strong></td></tr>
</table>
<?php
$ada = count($trph->result());
if ($ada == 0)
	{
	echo "Belum ada data BPH";
	}
else
{
?>
<div class="CSSTableGenerator">
<table width="<?php echo $lebartabel;?>">
<tr align="center"><td>No.</td><td>Tanggal</td><td>Jam Ke-</td><td>Kelas</td><td>Mapel</td><td>SK/KD</td><td>Materi</td><td>Materi Selanjutnya</td><td>Tugas</td><td>Siswa tidak hadir</td></tr>
<?php
$nomor =1;
	foreach ($trph->result() as $d)
	{
	$materi = $d->materi;
	$materi = preg_replace("/<p>/","",$materi);
	$materi = preg_replace("/<\/p>/","",$materi);
	$materi_selanjutnya = $d->materi_selanjutnya;
	$materi_selanjutnya = preg_replace("/<p>/","",$materi_selanjutnya);
	$materi_selanjutnya = preg_replace("/<\/p>/","",$materi_selanjutnya);
	$dinane = tanggal_ke_hari($d->tanggal_bph);
	$tanggalkbmx = $d->tanggal_bph;
	$kelas = $d->kelas;
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
	$selesai = '';
	if ($d->is_mandiri=='1')
		{
		$tugas = 'Mandiri';
		}
	else if ($d->is_mandiri=='0')
		{
		$tugas = 'Tak Terstruktur';
		}
	else if ($d->is_mandiri=='2')
		{
		$tugas = 'Terstruktur';
		$selesai = 'Dikumpulkan paling lambat '.date_to_long_string($d->tanggal_bph);
		}
	else
		{
		$tugas = '';
		}

	if (substr($keterangan,0,5) != 'TIDAK')
		{
		echo '<tr><td align="center" width="30">'.$nomor.'</td><td width="100">'.$dinane.', '.date_to_long_string($d->tanggal_bph).'</td><td align="center" width="30">'.$d->jamke.'</td><td align="center" width="60">'.$d->kelas.'</td><td>'.$d->mapel.'</td><td><b>'.tanpa_paragraf($d->sk).'</b>'.tanpa_paragraf($d->kd).'</td><td>'.tanpa_paragraf($materi).'</td><td>'.tanpa_paragraf($materi_selanjutnya).'</td><td><strong>'.$tugas.'</strong>'.tanpa_paragraf($d->tugas).' '.$selesai.'</td><td>'.$namasiswa.'</td></tr>';
		$nomor++;
		}

	}

}
?>
</table></div>Keterangan: <b>S</b> = sakit, <b>I</b> = izin, <b>A</b> = tanpa keterangan, <b>M</b> = izin pulang / meninggalkan madrasah / ke puskesmas, <b>B</b> = membolos, <b>L</b> = terlambat mengikuti KBM.
<?php
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
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


