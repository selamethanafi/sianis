<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_kehadiran.php
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
<?php
$lebartabel="95%";
?>
<h3><p class="text-center"><a href="<?php echo base_url();?>guru/formmencetak/38">Daftar Kehadiran Siswa</a></p></h3>
<?php

$tmapel = $this->db->query("select * from m_mapel where id_mapel='$id_mapel'");
foreach($tmapel->result() as $dm)
	{
	$kelas = $dm->kelas;
	$mapel = $dm->mapel;
	}
?>

<table width="100%">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
</table>
<div class="CSSTableGenerator"><table width="<?php echo $lebartabel;?>">
<tr align="center">
	<td><strong>No.</strong></td><td>
	<strong>Nama</strong></td>
<?php
// judul kolom
$ttgl = $this->db->query("select * from guru_rph_ringkas where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and kelas='$kelas' order by tanggal");

$adarph = $ttgl->num_rows();
if ($adarph>0)
{
	foreach($ttgl->result() as $dtgl)
		{
		$tanggalrph = $dtgl->tanggal;
		$dd = substr($tanggalrph,8,2);
		$mm = substr($tanggalrph,5,2);
		//cek apakah terlaksana
		$keterangan = strip_tags($dtgl->keterangan);
		$keterangan = strtoupper($keterangan);
		if (substr($keterangan,0,5) != 'TIDAK')
			{
	
			echo '<td>'.$dd.'-'.$mm.'</td>';
			}
		}
	echo '</tr>';
		$tsiskel = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester' and kelas='$kelas' and status='Y' order by no_urut");
	$nomor=1;
	foreach($tsiskel->result() as $t)
	{
	$nis = $t->nis;
	echo '<tr><td align="center">'.$nomor.'</td><td >'.ucwords(strtolower(nis_ke_nama($t->nis))).'</td>';
	foreach($ttgl->result() as $dtgl)
		{
		//cek apakah terlaksana
		$keterangan = strip_tags($dtgl->keterangan);
		$keterangan = strtoupper($keterangan);
		if (substr($keterangan,0,5) != 'TIDAK')
			{

		$tglrph = $dtgl->tanggal_bph;
		$thadirkbm = $this->db->query("select * from hadir where nis='$nis' and tanggal='$tglrph'");
		$adadiguru = $thadirkbm->num_rows();
		$alasan = '';
		if ($adadiguru>0)
			{
			foreach($thadirkbm->result() as $ttt)
				{
				if (($ttt->ada=="B") or ($ttt->ada=="M"))
					{
					$alasan = $ttt->ada;
					}
	
				}
			}
		$thadir = $this->db->query("select * from siswa_absensi where nis='$nis' and tanggal='$tglrph'");
		$adadiabsen = $thadir->num_rows();
		if (empty($alasan))
			{
				if ($adadiabsen>0)
				{
				foreach($thadir->result() as $tt)
					{
					$alasan = $tt->alasan;
					}

				}
			}

		echo '<td align="center">'.$alasan.'</td>';
			}
		}
	

	echo '</tr>';
	$nomor++;	
	}
	?>
	</table></div>
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

				}//akhir kalau ada
else
{
echo 'tidak ada rph';
}
?>
</div>
</body></html>
