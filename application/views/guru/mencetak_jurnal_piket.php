<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_jurnal_piket.php
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
$tanggaljurnal = $tahunhadir."-".$bulanhadir."-".$tanggalhadir;
$tanggaljurnalpiket = date_to_long_string($tanggaljurnal);
$haripiket = tanggal_ke_hari($tanggaljurnal);
	$tb = $this->db->query("select * from siswa_absensi where tanggal = '$tanggaljurnal' limit 0,1");

	foreach($tb->result() as $b)
		{
		$thnajaranx = $b->thnajaran;
		$semesterx = $b->semester;	
		}
	if (!empty($thnajaranx))
		{$thnajaran = $thnajaranx;
		}
	if (!empty($semesterx))
		{$semester= $semesterx;
		}

?>
<h4><p class="text-center"><a href="<?php echo base_url();?>guru/formmencetak">Jurnal Piket</a></p></h4>
<table width="100%">
<tr><td width="300">Tahun Pelajaran</td><td>:</td><td><?php echo $thnajaran;?></td></tr>
<tr><td>Semester</td><td>:</td><td><?php echo $semester;?></td></tr>
<tr><td>Hari, tanggal</td><td>:</td><td><?php echo tanggal_ke_hari($tanggaljurnal);?>, <?php echo $tanggaljurnalpiket;?></td></tr>
</table><br />
<?php
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by kelas");
echo '<div class="CSSTableGenerator">';
echo '<table width="100%">
<tr><td width="75" align="center">Kelas</td><td align="center">Cacah Siswa</td><td align="center">Siswa Tidak Hadir / Terlambat</td><td width="30" align="center">S</td><td width="30" align="center">I</td><td width="30" align="center">TK</td><td width="30" align="center">T</td><td width="30" align="center">B</td><td width="30" align="center">M</td><td align="center">Cacah Siswa Hadir</td></tr>';
foreach($ta->result() as $a)
	{
	$kelas = $a->kelas;
	//cari ketidakhadiran siswa
	$s = 0;
	$i = 0;
	$tk = 0;
	$t = 0;
	$bolos = 0;
	$m = 0;
	//cari jumlah siswa
	$tc = $this->db->query("select * from `siswa_kelas` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y'");	
	$cacahsiswa = count($tc->result());
	if ($cacahsiswa>0)
	{
	echo '<tr><td align="center">'.$kelas.'</td><td align="center">'.$cacahsiswa.'</td><td>';
	$tb = $this->db->query("select * from siswa_absensi where tanggal = '$tanggaljurnal'");
	foreach($tb->result() as $b)
		{
		$nama_nama ='';
		$nis = $b->nis;
		$alasan = $b->alasan;
		$nama_siswa = nis_ke_nama($nis);
		$kelase = nis_ke_kelas($nis);
		if ($kelas == $kelase)
			{
			if ($alasan == "S")
				{
				$s++;
				}
			if ($alasan == "I")
				{
				$i++;
				}
			if ($alasan == "A")
				{
				$tk++;
				}
			if ($alasan == "B")
				{
				$bolos++;
				}
			if ($alasan == "T")
				{
				$t++;
				}
			if ($alasan == "M")
				{
				$m++;
				}
			$nama_nama .= '<b>'.ucwords(strtolower($nama_siswa))."</b> (".$alasan."), ";
			}
		echo ''.$nama_nama.'';
		}
	$ntdkhadir = $s+$i+$tk+$m+$bolos;
	$nhadir = $cacahsiswa-$ntdkhadir;
	echo '</td><td align="center">'.$s.'</td><td align="center">'.$i.'</td><td align="center">'.$tk.'</td><td align="center">'.$t.'</td><td align="center">'.$bolos.'</td><td align="center">'.$m.'</td><td align="center">'.$nhadir.'</td></tr>';
	} // kalau ada
	} //akhir looping daftar kelas
echo '</table></div><br />';
//cari kejadian
$siswa_izin_meninggalkan_madrasah = '';
//siswa izin meninggalkan madrasah
$tg = $this->db->query("select * from `siswa_absensi` where `tanggal`= '$tanggaljurnal' and `alasan` = 'M'");
if(count($tg->result())>0)
{
	foreach($tg->result() as $g)
	{
		if (empty($siswa_izin_meninggalkan_madrasah))
			{
				$siswa_izin_meninggalkan_madrasah .= nis_ke_nama($g->nis).' ('.$g->keterangan.')';
			}
			else
			{
				$siswa_izin_meninggalkan_madrasah .= ', '.nis_ke_nama($g->nis).' ('.$g->keterangan.')';
			}

			
	} 
	$siswa_izin_meninggalkan_madrasah = 'Daftar siswa izin meninggalkan sekolah :'.$siswa_izin_meninggalkan_madrasah;
}
$kejadian = $siswa_izin_meninggalkan_madrasah;


$te = $this->db->query("select * from `tblpiket` where `tanggal`= '$tanggaljurnal'");
foreach($te->result() as $e)
	{
	$kejadian .= $e->kejadian;
	} 
if(!empty($kejadian))
{
echo '<div class="CSSTableGenerator">';
echo '<table width="100%">';
	echo '<tr><td>Keterangan / Peristiwa</td></tr>';
	echo '<tr><td>'.$kejadian.'</td></tr>';
echo '</table></div><br />';
}
//cari tugas
$tf = $this->db->query("select * from `guru_tugas` where `tanggal`= '$tanggaljurnal'");
echo '<div class="CSSTableGenerator">';
echo '<table width="100%">
<tr align="center"><td colspan="6"><strong>Tugas dari Guru Berhalangan</strong></td></tr>
<tr align="center"><td><strong>No.</strong></td><td><strong>Nama Guru</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Kelas</strong></td><td><strong>Jam ke-</strong></td><td><strong>Tugas</strong></td></tr>';
	$nomor=1;
	if(count($tf->result())>0)
		{
			foreach($tf->result() as $t)
				{
			echo "<tr><td align='center'>".$nomor."</td><td>".cari_nama_pegawai($t->kodeguru)."</td><td>".$t->mapel."</td><td align=center>".$t->kelas."</td><td>".$t->jamke."</td><td>".tanpa_paragraf($t->tugas)."</td></tr>";
		$nomor++;	
			}
		}
		else
		{
		echo "<tr><td align='center' colspan='6'>Semua guru hadir</td></tr>";
		}
	echo '</table></div><br />';
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
$hariing = tanggal_ke_day($tanggaljurnal);
echo '<table width="100%" cellpadding="2" cellspacing="1">
<tr><td width="330">
	<table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'">
		<tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br />NIP '.$nipkepala.'</td></tr>
	</table>
</td><td width="70"></td><td>	<table height="135" width="240"><tr><td colspan="2">'.$this->config->item('lokasi').', '.$tanggaljurnalpiket.'</td></tr>
	<tr><tr><td colspan="2">Piket,</tr>';
$td = $this->db->query("select * from guru_piket where thnajaran='$thnajaran' and semester='$semester' and hari='$hariing'");
foreach($td->result() as $d)
{
	$namapegawai = cari_nama_pegawai($d->kode_guru);
	echo '<tr><td>'.$namapegawai.'</td><td><br>....................</td></tr>';
}
echo '</table></td></tr></table>';

?>
</div>
</body>
</html>

