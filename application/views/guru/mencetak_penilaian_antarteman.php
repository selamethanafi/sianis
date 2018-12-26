<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: daftar_nilai_akhlak.php
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
$tc = $this->db->query("select * from `m_mapel` where `id_mapel` = '$id_mapel'");
$adatc = $tc->num_rows();
if($adatc == 0)
{
	echo 'Galat, data guru tidak sesuai';
}
else
{
	foreach($tc->result() as $c)
	{
		$thnajaran = $c->thnajaran;
		$semester = $c->semester;
		$kelas = $c->kelas;
	}
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	echo '<h3><p class="text-center"><a href="'.base_url().'guru/formmencetak/'.$noyangdicetak.'">Penilaian Antarteman</a></p></h3>';
	?>
	<table width="100%">
	<tr><td width="350"><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
	<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Kurikulum</strong></td><td>: <strong><?php echo $kurikulum;?></strong></td></tr>
</table>
<?php
$adaitem = 0;
if ((!empty($id_mapel)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
{
$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by id_sikap_spiritual");
if(count($tb->result())>0)
	{
	$adaitem = 1;
	$itemke = 1;
	foreach($tb->result() as $b)
		{
		$des[$itemke] = $b->item;
		$itemke++;
		}
	}
?>
<div class="CSSTableGenerator"><table>
<tr align="center"><td width="30"><strong>No.</strong></td><td ><strong>Nama</strong></td>

<?php
if ($kurikulum == '')
	{
	echo '<td colspan="4"><strong>Kedisiplinan</strong></td><td colspan="4"><strong>Kebersihan</strong></td><td colspan="4"><strong>Kesehatan</strong></td><td colspan="4"><strong>Tanggung jawab</strong></td><td colspan="4"><strong>Sopan santun</strong></td><td colspan="4"><strong>Percaya diri</strong></td><td colspan="4"><strong>Kompetitif</strong></td><td colspan="4"><strong>Hubungan Sosial</strong></td><td colspan="4"><strong>Kejujuran</strong></td><td colspan="4"><strong>Ibadah ritual</strong></td></tr>';
	$cacahkolom = 11;
	}
elseif($kurikulum == 'KTSP')
	{
	echo '<td><strong>Kedisiplinan</strong></td><td><strong>Kebersihan</strong></td><td><strong>Kesehatan</strong></td><td><strong>Tanggung jawab</strong></td><td><strong>Sopan santun</strong></td><td><strong>Percaya diri</strong></td><td><strong>Kompetitif</strong></td><td><strong>Hubungan Sosial</strong></td><td><strong>Kejujuran</strong></td><td><strong>Ibadah ritual</strong></td></tr>';
	$cacahkolom = 11;
	}
	else
	{
	$itemke = 1;
	foreach($tb->result() as $b)
		{
		echo '<td><strong>'.$b->item.'</strong></td>';
		$itemke++;
		}
	echo '</tr>';
	$cacahkolom = $itemke;
	}
$nomor=1;
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
$cacahsiswa = $query->num_rows();
$cacahsiswa = $cacahsiswa - 0;
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	$nis = $t->nis;
	$tt = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`!='$nis'");
	$td = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`='$nis'");
	echo '<tr>';
	$ta = $this->db->query("select * from `nilai_akhlak` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	echo '<td align="center">'.$nomor.'</td><td>'.nis_ke_nama($nis).'</td>';
	$noitem = 1;
	do
	{
		//nilai diri
		$iteme = 'i'.$noitem;
		$skor = '';
		foreach($td->result() as $d)
		{
			$skor = $d->$iteme;
		}
		//cari hasil teman
		$itemjumlah1 = 0;
		$itemjumlah2 = 0;
		$itemjumlah3 = 0;
		$itemjumlah4 = 0;
		foreach($tt->result() as $t)
			{
				if($t->$iteme == '1')
				{
					$itemjumlah1++; 			
				}
				if($t->$iteme == '2')
				{
					$itemjumlah2++; 			
				}
				if($t->$iteme == '3')
				{
					$itemjumlah3++; 			
				}
				if($t->$iteme == '4')
				{
					$itemjumlah4++; 			
				}
			}
			$simpulan = '';
			$tertinggi = max($itemjumlah1,$itemjumlah2,$itemjumlah3,$itemjumlah4);
			if($tertinggi == $itemjumlah1)
				{
				$simpulan = 'Kurang';
				}

			if($tertinggi == $itemjumlah2)
				{
				$simpulan = 'Cukup';
				}
			if($tertinggi == $itemjumlah3)
				{
				$simpulan = 'Baik';
				}
			if($tertinggi == $itemjumlah4)
				{
				$simpulan = 'Amat Baik';
				}
			if($tertinggi == 0)
			{
				$simpulan = '?';
			}
		$p1 = round($itemjumlah1 / $cacahsiswa * 100,0).'%';
		$p2 = round($itemjumlah2 / $cacahsiswa * 100,0).'%';
		$p3 = round($itemjumlah3 / $cacahsiswa * 100,0).'%';
		$p4 = round($itemjumlah4 / $cacahsiswa * 100,0).'%';
		$itemjumlah5 = $cacahsiswa - $itemjumlah1 - $itemjumlah2 - $itemjumlah3 - $itemjumlah4;
		$p5 = round($itemjumlah5 / $cacahsiswa * 100,0).'%';
		echo '<td align="center" valign="bottom">1 ('.$p1.')<br />2 ('.$p2.')<br />3 ('.$p3.')<br />4 ('.$p4.')<br />0 ('.$p5.')<br /><strong>'.$simpulan.'</strong></td>';
		$noitem++;
	}
	while($noitem<$cacahkolom);
	echo '</tr>';
	$nomor++;
	}
} // kalau ada siswa

?>
</table></div>
<?php
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"></td><td width="70"></td><td>'.$this->config->item('lokasi').', <br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table>';
}
}
?>
</div></body></html>
