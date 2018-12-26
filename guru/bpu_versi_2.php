<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: cetak_daftar_nilai.php
// Terakhir diperbarui	: Jum 13 Mei 2016 21:49:03 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
$adatmapel = $tmapel->num_rows();
if($adatmapel == 0)
{
	echo 'Tidak ditemukan, kode mapel dan kode guru tidak sesuai';
}

else
{
	if(($ulangan == 'uh1') or ($ulangan == 'uh2') or ($ulangan == 'uh3') or ($ulangan == 'uh4') or ($ulangan == 'mid') or ($ulangan == 'uas'))
	{
	$itemnilai =$ulangan;
		foreach($tmapel->result() as $dtmapel)
		{
			$kelas = $dtmapel->kelas;
			$mapel = $dtmapel->mapel;
			$thnajaran = $dtmapel->thnajaran;
			$semester = $dtmapel->semester;
			$kkm = $dtmapel->kkm;
			$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
			$cacah_tugas = $dtmapel->cacah_tugas;
			$ranah = $dtmapel->ranah;
			$no_urut_rapor = $dtmapel->no_urut_rapor;
			$bobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
			$bobot_tugas = $dtmapel->bobot_tugas;
			$bobot_mid = $dtmapel->bobot_mid;
			$bobot_semester = $dtmapel->bobot_semester;
			$kkm_uh1 = $dtmapel->kkm_uh1;
			$kkm_uh2 = $dtmapel->kkm_uh2;
			$kkm_uh3 = $dtmapel->kkm_uh3;
			$kkm_uh4 = $dtmapel->kkm_uh4;
			$kkm_mid = $dtmapel->kkm_mid;
			$kkm_uas = $dtmapel->kkm_uas;
			$cacah_kuis = $dtmapel->nkuis;
			$bobot_kuis = $dtmapel->bobot_kuis;
		}
		$kurikulum=cari_kurikulum($thnajaran,$semester,$kelas);
$penilaiane = 'BELUM DIDUKUNG APLIKASI';
if ($itemnilai=='uh1')
{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN HARIAN I';
	}
	else
	{
		$penilaiane = 'ULANGAN HARIAN I';
	}
	
}
if ($itemnilai=='uh2')
{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN HARIAN II';
	}
	else
	{
		$penilaiane = 'ULANGAN HARIAN II';
	}
}
if ($itemnilai=='uh3')
{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN HARIAN III';
	}
	else
	{
		$penilaiane = 'ULANGAN HARIAN III';
	}
}
if ($itemnilai=='uh4')
{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN HARIAN IV';
	}
	else
	{
		$penilaiane = 'ULANGAN HARIAN IV';
	}

}
if ($itemnilai=='mid')
	{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN TENGAH SEMESTER';
	}
	else
	{
		$penilaiane = 'ULANGAN TENGAH SEMESTER';
	}

	}
if ($itemnilai=='uas')
	{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN AKHIR SEMESTER';
	}
	else
	{
		$penilaiane = 'ULANGAN AKHIR SEMESTER';
	}
	}
		$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas` = '$kelas' and `mapel`='$mapel' and `status`='Y'");
		?>
		<h3 class="text-center"><a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>"><b>DAFTAR PENGEMBALIAN HASIL <?php echo $penilaiane;?></b></a></h3>
</td></tr></table>
		<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">
		<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
		<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
		<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
		<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
		<tr><td><strong>Kurikulum</strong></td><td>: <strong><?php echo $kurikulum;?></strong></td></tr>
		</table>
		<div class="CSSTableGenerator">
		<table>
		<tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Nilai</strong></td><td><strong>Tanda Tangan</strong></td></tr>
		<?php
		$nomor=1;
		$itemnilai = 'nilai_'.$ulangan;
		if(count($query->result())>0)
		{
			foreach($query->result() as $t)
			{
				echo "<tr><td align='center'>".$nomor."</td><td>".nis_ke_nama($t->nis)."</td>";
				echo "<td align='center'>".$t->$itemnilai."</td><td></td></tr>";
			$nomor++;
			}
		}
		else
		{
		echo "<tr><td colspan='4'>Belum ada daftar nilai</td></tr>";
		}
		echo '</table></div>';
		$namakepala = cari_kepala($thnajaran,$semester);
		$nipkepala = cari_nip_kepala($thnajaran,$semester);
		$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
		$tanggalcetak = tanggalcetak($thnajaran,$semester);
		$namapegawai = cari_nama_pegawai($kodeguru);
		$nipguru = cari_nip_pegawai($kodeguru);
		$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
		echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small"><tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.' Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', <br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
	}
	else
	{
		echo 'Galat, ulangan tidak sesuai';
	}
}
?>

</body></html>
