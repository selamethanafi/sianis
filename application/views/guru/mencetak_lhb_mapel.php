<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: mencetak_lhb_mapel.php
// Terakhir diperbarui	: Sen 17 Agu 2015 10:57:23 WIB 
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
if(!empty($kodebukutugas))
{
	$tc = $this->db->query("select * from `m_mapel` where `id_mapel`='$kodebukutugas'");
	foreach($tc->result() as $dtmapel)
	{
		$id_mapel = $dtmapel->id_mapel;
	}

}
$tc = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	foreach($tc->result() as $dtmapel)
	{
		$kkm = $dtmapel->kkm;
		$mapel = $dtmapel->mapel;
		$thnajaran = $dtmapel->thnajaran;
		$semester = $dtmapel->semester;
		$kodeguru = $dtmapel->kodeguru;
		$kelas = $dtmapel->kelas;
		$ranah = $dtmapel->ranah;
		$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
		$cacah_tugas = $dtmapel->cacah_tugas;
		$cacah_kuis = $dtmapel->nkuis;
	}
?>
<h3><p class="text-center"><a href="<?php echo base_url();?>guru/formmencetak/24"><b> LAPORAN HASIL BELAJAR</b></a></p></h3>
<table width="100%">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Ranah Penilaian</strong></td><td>: <strong><?php echo $ranah;?></strong></td></tr>
<tr><td><strong>KKM </strong></td><td>: <strong><?php echo $kkm;?> </strong></td></tr>
</table>
<table width="100%" class="table table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td>
<?php
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and status='Y' order by no_urut");
echo '<td><strong>Kog</strong></td><td><strong>Psi</strong></td><td><strong>Afektif</strong></td><td><strong>Keterangan</strong></td>';
$nomor=1;
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		echo "<tr><td align='center'>".$nomor."</td><td>".nis_ke_nama($nis)."</td>";
		$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel' and `nis`='$nis'");
		$adanilai = $ta->num_rows();
		if($adanilai == 0)
		{
			echo '<td align="center">Tidak ada memperoleh nilai</td></tr>';
		}
		else
		{
			foreach($ta->result() as $a)
			{
				echo '<td align="center">';
				if (($ranah=='KPA') or ($ranah=='KA'))
				{
					echo $a->kog;
				}
				else
				{
					echo '-';
				}
				echo '</td>';
				echo '<td align="center">';
				if (($ranah=='KPA') or ($ranah=='PA'))
				{
					echo $a->psi;
				}
				else
				{
					echo '-';
				}
				echo '</td>';
				echo '<td align="center">'.$a->afektif.'</td>';
				echo '<td>'.$a->keterangan.'</td></tr>';
			}
		
		}	
		$nomor++;
	}
}
else{
echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
}

echo '</table>';
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
?>
</BODY></html>
