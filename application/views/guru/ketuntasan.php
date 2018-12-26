<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 07 Mar 2015 20:06:21 WIB 
// Nama Berkas 		: ketuntasan.php
// Lokasi      		: application/views/guru
// Author      		: Selamet Hanafi
//              	 selamethanafi@yahoo.co.id
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
<?php
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
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

$tb = $this->db->query("select * from `guru_tindak_lanjut` where `id_guru_tindak_lanjut`='$id_mapel' and ulangan='$itemnilai'");
if(count($tb->result())>0)
{
	foreach($tb->result() as $b)
	{
	$tanggalrp = $b->tanggal;
	$tindakan_pengayaan = $b->tindakan_pengayaan;
	$tindakan_satu = $b->tindakan_satu;
	$tindakan_dua = $b->tindakan_dua;
	}
}
else
{
echo '<h1>BELUM ADA DATA PROGRAM PELAKSANAAN REMIDIAL ATAU PENGAYAAN</h1>';
?>
<a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>"><b>Kembali</b></a>
<?php
}
if(count($tb->result())>0)
{
?>
<table width="670" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center">
<a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>"><b>KETUNTASAN BELAJAR</b></a>
</td></tr></table>
<table width="670" cellpadding="2" cellspacing="1">

<tr><td><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Penilaian</strong></td><td>: <strong><?php echo $penilaiane;?></strong></td></tr>
<tr><td><strong>KKM Ulangan</strong></td><td>: <strong><?php echo $kkm;?> </strong></td></tr>
<tr><td><strong>Tanggal Remidial</strong></td><td>: <strong><?php echo date_to_long_string($tanggalrp);?></strong></td></tr>
</table>
<?php
$jmlsiswa=0;
$jmlblmtuntas=0;
$namasiswa='';
$tebal=0;
$query = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and kelas='$kelas' and status='Y' order by no_urut");

if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	if ($itemnilai=='uh1')
		{
		$nilaine = $t->nilai_uh1;
		}
	if ($itemnilai=='uh2')
		{
		$nilaine = $t->nilai_uh2;
		}
	if ($itemnilai=='uh3')
		{
		$nilaine = $t->nilai_uh3;
		}
	if ($itemnilai=='uh4')
		{
		$nilaine = $t->nilai_uh4;
		}
	if ($itemnilai=='mid')
		{
		$nilaine = $t->nilai_mid;
		}
	if ($itemnilai=='uas')
		{
		$nilaine = $t->nilai_uas;
		}
	if ($nilaine<$kkm)
		{
		$jmlblmtuntas++;
		}
	$jmlsiswa++;
	}
}
$jmltuntas = $jmlsiswa - $jmlblmtuntas;
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="20">1.</td><td colspan="3">Perseorangan</td></tr>
<tr><td></td><td colspan="2">Banyak siswa seluruhnya</td><td width="100">: '.$jmlsiswa.' siswa</td></tr>
<tr><td></td><td colspan="2">Banyak siswa yang belum tuntas belajar</td><td>: '.$jmlblmtuntas.' siswa</td></tr>
<tr><td></td><td colspan="2">Banyak siswa yang tuntas belajar</td><td>: '.$jmltuntas.' siswa</td></tr>';
$persen=round($jmltuntas/$jmlsiswa*100,2);
echo '<tr><td></td><td colspan="2">Persentase banyak siswa yang tuntas belajar</td><td>: '.$persen.' %</td></tr>';
if($persen<$persentase_klasikal)
	{
	$klasikal = "<strong>Ya</strong>";
	}
	else
	{
	$klasikal = "Tidak";
	}
echo '<tr><td width="20">2.</td><td colspan="2">Klasikal</td><td>: '.$klasikal.'</td></tr>
<tr><td width="20"></td><td colspan="3">Suatu kelas dinyatakan Klasikal apabila cacah siswa yang mencapai nilai minimal '.$kkm.' tidak mencapai '.$persentase_klasikal.'% dari seluruh siswa</td></tr>
<tr><td width="20">3.</td><td colspan="3">Simpulan</td></tr>
<tr><td></td><td width="20">a.</td><td colspan="2">Perlu perbaikan klasikal untuk soal nomor ';
$tTampil_Semua_Nilai_Analisis=$this->db->query("select * from analisis where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and ulangan='$itemnilai' and status='Y' order by no_urut");
$cacahsiswa = count($tTampil_Semua_Nilai_Analisis->result());
$skormakspersoal = $skor * $cacahsiswa;

$nomor=1;
$skormaks = $nsoal * $skor;
		$kolom = 0;
		do
		{	
			$nil[$kolom]=0;
			$kolom++;
		}
		while ($kolom<$nsoal);
$nomorsoal ='';
if(count($tTampil_Semua_Nilai_Analisis->result())>0)
{
	foreach($tTampil_Semua_Nilai_Analisis->result() as $u)
	{

		$kolom = 0;
		$nilaine=0;
		do
		{
			$nokol = $kolom + 1;
			$item = 'nilai_s'.$nokol.'';
			$nilaine = $u->$item;
			$nil["$kolom"]=$nil["$kolom"]+$nilaine;
			$kolom++;
		}
		while ($kolom<$nsoal);
	$nomor++;	
		
	}

	$kolom = 0;

	do
	{
		$nokol = $kolom + 1;
		$persentase = $nil[$kolom] / $skormakspersoal * 100;
		if ($persentase<$kkm)
			{
			if (empty($nomorsoal))
				{	
				$nomorsoal .= '<b>'.$nokol.'</b>';
				}
				else
				{	
				$nomorsoal .= ', <b>'.$nokol.'</b>';
				}

			}
		$kolom++;
	}
	while ($kolom<$nsoal);
}
echo $nomorsoal;
echo '</td><tr><tr><td></td><td width="20">b.</td><td colspan="2">Perlu perbaikan secara individual untuk siswa sebagai berikut :</td><tr></table>'
?>
<div class="CSSTableGenerator"><table>
<tr  align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Nilai <?php echo $itemnilai;?></strong></td><td><strong>Tindak Lanjut</strong></td><td><strong>Nilai Remidi</strong></td><td><strong>Tuntas</strong></td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and kelas='$kelas' and status='Y' order by no_urut");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	$nis = $t->nis;
	if ($itemnilai=='uh1')
		{
		$nilaine = $t->nilai_uh1;
		}
	if ($itemnilai=='uh2')
		{
		$nilaine = $t->nilai_uh2;
		}
	if ($itemnilai=='uh3')
		{
		$nilaine = $t->nilai_uh3;
		}
	if ($itemnilai=='uh4')
		{
		$nilaine = $t->nilai_uh4;
		}
	if ($itemnilai=='mid')
		{
		$nilaine = $t->nilai_mid;
		}
	if ($itemnilai=='uas')
		{
		$nilaine = $t->nilai_uas;
		}
	$nis = $t->nis;
	$nama = nis_ke_nama($nis);
	$kd = $t->kd;
	//cari nilai remidi
	$td = $this->db->query("select * from `nilai_remidi` where `kd`='$kd' and ulangan='$itemnilai'");
	$ada = $td->num_rows();
			$nilairemidi = 0;
			$nilaiuh = 0;
			foreach($td->result() as $d)
				{
				$nilairemidi = $d->nilai;
				$nilaiuh = $d->nilai_uh;
				}

		if ($nilaiuh < 50)
			{
			$tindakan = $tindakan_satu;
			}
			else
			{
			$tindakan = $tindakan_dua;
			}
	if($ada>0)
		{
		$tuntas = "Tuntas";
		if($nilairemidi<$kkm)
			{
			$tuntas = 'Belum';
			}
		echo "<tr><td align='center'>".$nomor."</td><td>".$nama."</td><td align='center'>".$nilaiuh."</td><td>".tanpa_paragraf($tindakan)."</td><td align=\"center\">$nilairemidi</td><td align=\"center\">".$tuntas."</td></tr>";
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
$tanggalcetak = $tanggalrp;
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
$ttd = cari_ttd_kepala($thnajaran,$semester);
if ($ditandatangani=='ya')
{
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.' Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.' Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
}
?>
</div>
</body></html>
