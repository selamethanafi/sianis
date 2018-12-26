<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : nomor_skbk_skmt.php
// Lokasi      : application/views/tatausaha
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$oke = 1;
$is_new = 1;
$nomor_surat = '';
$nomor_skbk = '';
$nomor_skmt = '';
$nama_pengawas = '';
$nip_pengawas = '';
$kode_surat = '';
$nomor_aktif = '';
if (!empty($id_nomor_skbk))
	{
	$ta = $this->db->query("select * from `nomor_skbk_skmt` where `id_nomor_skbk`='$id_nomor_skbk'");
	$ada = $ta->num_rows();
	if ($ada > 0 )
		{
		foreach($ta->result() as $a)
			{
			$tanggalskbk = $a->tanggal;
			$tanggalaktif = $a->tanggal_aktif;
			$nomor_skbkq = $a->nomor_skbk;
			$nomor_skmtq = $a->nomor_skmt;
			$nomor_aktifq = $a->nomor_aktif;
			$nama_pengawas = $a->nama_pengawas;
			$nip_pengawas = $a->nip;
			$thnajaran = $a->thnajaran;
			$semester = $a->semester;
			}
		$is_new = 0;
		$nomor_skbk = $nomor_skbkq;
		$nomor_skmt = $nomor_skmtq;
		$nomor_aktif = $nomor_aktifq;
		}
		else
		{
		echo '<strong>Galat, Anda tidak dapat mengakses data ini</strong>';
		echo 'Kalau Halaman ini tidak berpindah, klik  <a href="'.base_url().'tatausaha/nomorskbkskmt">di sini</a>';
		$oke = 0;

		}
	}
if ($oke == 1)
{
echo form_open('tatausaha/nomorskbkskmt','class="form-horizontal" role="form"');
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><input type="hidden" name="thnajaran" value="'.$thnajaran.'">'.$thnajaran.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><input type="hidden" name="semester" value="'.$semester.'">'.$semester.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor SKBK</label></div><div class="col-sm-9">
<input type="text" name="nomor_skbk" value="'.$nomor_skbk.'" class="form-control" required></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor SKMT</label></div><div class="col-sm-9">
<input type="text" name="nomor_skmt" value="'.$nomor_skmt.'" class="form-control" required></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">tanggal SKBK/SKMT</label></div><div class="col-sm-9">';
	echo '<select name="tglsurat">';
	if ( (empty($tanggalskbk)) or (strlen($tanggalskbk)<10) )
		{
		$postedhari= date("d");
		}
		else
		{
		$postedhari= substr($tanggalskbk,8,2);
		}
	if ((empty($tanggalskbk)) or (strlen($tanggalskbk)<10) )
		{
		$postedbulan=date("m");
		}
		else
		{
		$postedbulan= substr($tanggalskbk,5,2);
		}

	if ((empty($tanggalskbk)) or (strlen($tanggalskbk)<10) )
		{
		$postedtahun=date("Y");
		}
		else
		{
		$postedtahun= substr($tanggalskbk,0,4);
		}

	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
		{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
	for($i=10;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
	echo '</select>';
	echo '<select name="blnsurat" class="textfield-option">';
			$bulan = gantibulan($postedbulan);
			echo '<option value="'.$postedbulan.'">'.$bulan.'</option>';	
			echo '<option value="01">Januari</option>';
			echo '<option value="02">Februari</option>';
			echo '<option value="03">Maret</option>';
			echo '<option value="04">April</option>';
			echo '<option value="05">Mei</option>';
			echo '<option value="06">Juni</option>';
			echo '<option value="07">Juli</option>';
			echo '<option value="08">Agustus</option>';
			echo '<option value="09">September</option>';
			echo '<option value="10">Oktober</option>';
			echo '<option value="11">November</option>';
			echo '<option value="12">Desember</option>';
	echo '</select>';
	echo '<select name="thnsurat" class="textfield-option">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
	  	$th=date("Y");
	        $awal_th=$th;
	        $akhir_th=$th-20;
		$i = $awal_th;
		do
		{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
		}
		while ($i>=$akhir_th);
	echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor SK Aktif Mengajar</label></div><div class="col-sm-9"><input type="text" name="nomor_aktif" value="'.$nomor_aktif.'" class="form-control"></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">tanggal SK Aktif</label></div><div class="col-sm-9">';
	echo '<select name="tglsurataktif">';
	if ( (empty($tanggalaktif)) or (strlen($tanggalaktif)<10) )
		{
		$postedhari= date("d");
		}
		else
		{
		$postedhari= substr($tanggalaktif,8,2);
		}
	if ((empty($tanggalaktif)) or (strlen($tanggalaktif)<10) )
		{
		$postedbulan=date("m");
		}
		else
		{
		$postedbulan= substr($tanggalaktif,5,2);
		}

	if ((empty($tanggalaktif)) or (strlen($tanggalaktif)<10) )
		{
		$postedtahun=date("Y");
		}
		else
		{
		$postedtahun= substr($tanggalaktif,0,4);
		}

	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
		{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
	for($i=10;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
	echo '</select>';
	echo '<select name="blnsurataktif" class="textfield-option">';
			 $bulan = gantibulan($postedbulan);
			echo '<option value="'.$postedbulan.'">'.$bulan.'</option>';	
			echo '<option value="01">Januari</option>';
			echo '<option value="02">Februari</option>';
			echo '<option value="03">Maret</option>';
			echo '<option value="04">April</option>';
			echo '<option value="05">Mei</option>';
			echo '<option value="06">Juni</option>';
			echo '<option value="07">Juli</option>';
			echo '<option value="08">Agustus</option>';
			echo '<option value="09">September</option>';
			echo '<option value="10">Oktober</option>';
			echo '<option value="11">November</option>';
			echo '<option value="12">Desember</option>';
	echo '</select>';
	echo '<select name="thnsurataktif" class="textfield-option">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
	  	$th=date("Y");
	        $awal_th=$th;
	        $akhir_th=$th-20;
		$i = $awal_th;
		do
		{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
		}
		while ($i>=$akhir_th);
	echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Pengawas</label></div><div class="col-sm-9">
<input type="text" name="nama_pengawas" value = "'.$nama_pengawas.'" class="form-control" required></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP Pengawas</label></div><div class="col-sm-9">
<input type="text" name="nip_pengawas" value = "'.$nip_pengawas.'" class="form-control" required></div></div>
<p class="text-center"><input type="hidden" name="is_new" value="'.$is_new.'"><input type="submit" value="Simpan Surat" class="btn btn-primary"></div></form>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Nomor</strong></td><td><strong>Tanggal Surat</strong></td><td><strong>Nomor SKBK</strong></td><td><strong>Nomor SKMT</strong></td><td><strong>Tanggal SK Aktif</strong></td><td><strong>Nomor SK Aktif</strong></td><td><strong>Pengawas</strong></td><td><strong>NIP Pengawas</strong></td><td><strong>Aksi</strong></td></tr>';
$tabel_nomor_skbk_skmt = $this->db->query("select * from `nomor_skbk_skmt` order by `thnajaran` DESC, `semester` DESC");
$nomor=1;
foreach($tabel_nomor_skbk_skmt->result() as $b)
{
echo "<tr><td>".$nomor."</td>
<td>".date_to_long_string($b->tanggal)."</td>
<td>".$b->nomor_skbk."</td><td>".$b->nomor_skmt."</td><td>".date_to_long_string($b->tanggal_aktif)."</td><td>".$b->nomor_aktif."</td><td>".$b->nama_pengawas."</td><td>".$b->nip."</td><td align=center><a href='".base_url()."tatausaha/nomorskbkskmt/".$b->id_nomor_skbk."' title='Menyunting Nomor SKBK, SKMT, SK Aktif Mengajar'><span class=\"fa fa-edit\"></span></a></td></tr>";
$nomor++;
}
echo '</table></div>';
}
echo '</div></div></div>';
