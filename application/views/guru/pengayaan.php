<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pengayaan.php
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
}
?>
<table width="100%" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center">
<a href="<?php echo base_url(); ?>index.php/guru/daftarnilai/<?php echo $id_mapel;?>"><b>PROGRAM PENGAYAAN</b></a>
</td></tr></table>
<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">

<tr><td><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Penilaian</strong></td><td>: <strong><?php echo $penilaiane;?></strong></td></tr>
<tr><td><strong>KKM </strong></td><td>: <strong><?php echo $kkm;?> </strong></td></tr>
<tr><td><strong>Tanggal </strong></td><td>: <strong><?php echo date_to_long_string($tanggalrp);?></strong></td></tr>
</table>
<div class="CSSTableGenerator"><table width="100%">
<tr  align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Nilai <?php echo $itemnilai;?></strong></td><td><strong>Tindak Lanjut</strong></td></tr>
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
	if ($nilaine>=$kkm)
		{
		$td = $this->db->query("select * from `nilai_remidi` where `kd`='$kd' and ulangan='$itemnilai'");
		$ada = $td->num_rows();
		if($ada==0)
			{
			$tindakan = $tindakan_pengayaan;
			echo "<tr><td align='center'>".$nomor."</td><td>".$nama."</td><td align='center'>".$nilaine."</td><td>".tanpa_paragraf($tindakan)."</td></tr>";
			$nomor++;
			}
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
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
if ($ditandatangani=='ya')
{
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="100%" cellpadding="2" cellspacing="1">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.' Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="100%" cellpadding="2" cellspacing="1">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.' Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}

?>
</div>
</body></html>
