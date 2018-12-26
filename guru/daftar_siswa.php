<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: daftar_siswa.php
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
<div class="container-fluid"><h3>Modul Daftar Siswa</h3>
<p><?php echo '<a href="'.base_url().'guru/walikelas" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> <b>Kembali ke daftar Tugas Walikelas</b></a>';?></p>
<form class="form-horizontal" role="form">
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kurikulum</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kurikulum;?></p></div></div>
</form>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>NIS</strong></td><td rowspan="2"><strong>Nama</strong></td><td rowspan="2"><strong>Data Siswa</strong></td><td rowspan="2">Peringkat</td><td colspan="7"><strong>Ketidakhadiran</strong></td><td rowspan="2"><strong>Pelanggaran</strong></td><td rowspan="2"><strong>Pembayaran Keuangan</strong></td><td rowspan="2" colspan="2"><strong>Rapor</strong></td></tr><tr><td>S</td><td>I</td><td>TK</td><td>M</td><td>B</td><td>T</td><td>Lihat</td></tr>
<?php
$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
foreach($td->result() as $d)
{
$id_thnajaran = $d->id;
}
$model = '';
if($kurikulum == '2015')
{
	$model = '2015';
}
if($kurikulum == '2018')
{
	$model = '2018';
}

$nomor=1;
if(count($daftar_siswa->result())>0)
{
	foreach($daftar_siswa->result() as $b)
	{
	echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$b->nis.'</td><td>'.nis_ke_nama($b->nis).'</td><td align="center"><a href="'.base_url().'guru/detilsiswa/'.$b->nis.'/'.$id_walikelas.'" title="Data '.nis_ke_nama($b->nis).'"><span class="fa fa-bullseye"></span></a></td>';
	$nis = $b->nis;
	$tg = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and `nis`='$nis' and semester='$semester'");
	$peringkat = '';
	foreach($tg->result() as $g)
	{
		$peringkat = $g->peringkat_kelas;
	}
	echo '<td align="center">'.$peringkat.'</td>';
	$tabs = $this->db->query("select * from siswa_absensi where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$sakit =0;
	$izin = 0;
	$alpa = 0;
	$bolos = 0;
	$izinx = 0;
	$terlambat = 0;

	foreach($tabs->result() as $dabs)
	{
		if ($dabs->alasan=='S')
			$sakit=$sakit+1;
		if ($dabs->alasan=='I')
			$izin=$izin+1;
		if ($dabs->alasan=='A')
			$alpa=$alpa+1;
		if ($dabs->alasan=='T')
			$terlambat=$terlambat+1;
		if ($dabs->alasan=='B')
			$bolos=$bolos+1;
		if ($dabs->alasan=='M')
			$izinx=$izinx+1;
	}

	if ($sakit>0)
		{
		echo '<td align="center">'.$sakit.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($izin>0)
		{
		echo '<td align="center">'.$izin.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($alpa>0)
		{
		echo '<td align="center">'.$alpa.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($izinx>0)
		{
		echo '<td align="center">'.$izinx.'</td>';
		}
		else
		{
		echo '<td></td>';
		}

	if ($bolos>0)
		{
		echo '<td align="center">'.$bolos.'</td>';
		}
		else
		{
		echo '<td></td>';
		}

	if ($terlambat>0)
		{
		echo '<td align="center">'.$terlambat.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	echo '<td align="center">';
	if (($sakit>0) or ($izin>0) or ($alpa>0) or ($izinx>0) or ($bolos>0) or ($terlambat>0))
	{
		echo '<a href="'.base_url().'guru/detilsiswa/'.$b->nis.'/'.$id_walikelas.'/1" title="Data Ketidakhadiran '.nis_ke_nama($b->nis).'"><span class="fa fa-bullseye"></span></a>';
	}
	echo '</td><td align="center">';
	$tsa = $this->db->query("select * from siswa_kredit where nis='$nis' and thnajaran='$thnajaran' and semester='$semester' order by tanggal");
	$jmlpoin = '';
	foreach($tsa->result() as $d)
	{
		$jmlpoin = $jmlpoin + $d->point;
	}
	echo '<a href="'.base_url().'guru/detilsiswa/'.$b->nis.'/'.$id_walikelas.'/2" title="Data Pelanggaran Tata Tertib '.nis_ke_nama($b->nis).'"><strong>'.$jmlpoin.'</strong></a></td><td align="center"><a href="'.base_url().'guru/detilsiswa/'.$b->nis.'/'.$id_walikelas.'/3" title="Data Pembayaran Keuangan '.nis_ke_nama($b->nis).'" target="_blank"><span class="fa fa-bullseye"></span></a></td>';

if($kurikulum == 'KTSP')
	{
	echo '<td align="center"><a href="'.base_url().'guru/detilsiswa/'.$b->nis.'/'.$id_walikelas.'/4" title="Laporan Hasil Belajar '.nis_ke_nama($b->nis).'" target="_blank"><strong>Lihat</strong></a></td><td align="center">';
	?>
	<a href="javascript:;" onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis;?>','yes','scrollbars=yes,width=550,height=400')" title="pastikan nilai sudah terkunci semua"><strong>PDF</strong></a><?php 
	echo '</td>';
	}
elseif($kurikulum == '2013')
	{
	echo '<td align="center"><a href="'.base_url().'guru/detilsiswa/'.$b->nis.'/'.$id_walikelas.'/5" title="Laporan Capaian Kompetensi Peserta Didik '.nis_ke_nama($b->nis).'" target="_blank"><strong>Lihat</strong></a></td><td align="center">';
		?>
<a href="javascript:;" onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis.'/akhir/2013';?>','yes','scrollbars=yes,width=550,height=400')" title="pastikan nilai sudah terkunci semua"><strong>PDF</strong></a> </td><td align="center"><a href="<?php echo base_url();?>guru/rapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis.'/akhir/'.$kurikulum;?>" target="_blank" title="pastikan nilai sudah terkunci semua. Cocok kalau menggunakan google chrome atau chromium"><strong>HTML</strong></a> 
		<?php echo '</td>';
	}
elseif(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
	echo '<td align="center"><a href="'.base_url().'guru/detilsiswa/'.$b->nis.'/'.$id_walikelas.'/9" title="Lihat Rapor '.nis_ke_nama($b->nis).'" target="_blank"><strong>LIHAT</strong></a></td>
		<td align="center">';
		?>
<a href="javascript:;" onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis.'/akhir/2018/'.$ttd;?>','yes','scrollbars=yes,width=550,height=400')" title="pastikan nilai sudah terkunci semua"><strong>PDF</strong></a> </td>
		<td align="center"><a href="<?php echo base_url();?>guru/rapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis.'/akhir/'.$kurikulum;?>" target="_blank" title="pastikan nilai sudah terkunci semua. Cocok kalau menggunakan google chrome atau chromium"><strong>HTML</strong></a> 
		<?php echo '</td>';
	}

else
	{
	echo '<td align="center">Kurikulum ?</td>';
	}

$nomor++;
}
echo '</table></div>';
}
else{
echo '<div class="alert alert-info">Belum ada daftar siswa, silakan hubungi Admin atau Pengajaran</div>';
}


?>

</div></div></div>
