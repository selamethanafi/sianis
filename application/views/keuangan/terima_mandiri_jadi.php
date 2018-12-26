<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : terima.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo form_open('keuangan/bayar/'.$nis.'/'.substr($thnajaran,0,4).'/'.$semester,'class="form-horizontal" role="form"');?>
<?php
$thnajaranini = cari_thnajaran();
$namasiswa = nis_ke_nama($nis);
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="hidden" name="nis" value="'.$nis.'"><p class="form-control-static">'.$namasiswa;
	$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by thnajaran DESC, semester DESC");
	foreach($ta->result() as $a)
	{
		$thnajaranx = $a->thnajaran;
		$kelas = $a->kelas;
		$semesterx = $a->semester;
		echo '&nbsp;&nbsp;&nbsp;<a href="'.base_url().'keuangan/terima/'.$nis.'/'.substr($thnajaranx,0,4).'/'.$semester.'" title="terima pembayaran">'.$kelas.' '.$thnajaranx.' '.$semesterx.'</a>';
	}
echo '</p></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-3">';
	echo '<select name="tanggalhadir" class="form-control">';
	if ( (empty($tanggal)) or (strlen($tanggal)<10) )
		{
		$postedhari= date("d");
		}
		else
		{
		$postedhari= substr($tanggal,8,2);
		}
	if ((empty($tanggal)) or (strlen($tanggal)<10) )
		{
		$postedbulan=date("m");
		}
		else
		{
		$postedbulan= substr($tanggal,5,2);
		}

	if ((empty($tanggal)) or (strlen($tanggal)<10) )
		{
		$postedtahun=date("Y");
		}
		else
		{
		$postedtahun= substr($tanggal,0,4);
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
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanhadir" class="form-control">';
			 if ($postedbulan=="01")
			{
			$bulan = "Januari";
			}
			if ($postedbulan=="02")
			{
			$bulan = "Februari";
			}
			if ($postedbulan=="03")
			{
			$bulan = "Maret";
			}
			if ($postedbulan=="04")
			{
			$bulan = "April";
			}
			if ($postedbulan=="05")
			{
			$bulan = "Mei";
			}
			if ($postedbulan=="06")
			{
			$bulan = "Juni";
			}
			if ($postedbulan=="07")
			{
			$bulan = "Juli";
			}
			if ($postedbulan=="08")
			{
			$bulan = "Agustus";
			}
			if ($postedbulan=="09")
			{
			$bulan = "September";
			}
			if ($postedbulan=="10")
			{
			$bulan = "Oktober";
			}
			if ($postedbulan=="11")
			{
			$bulan = "November";
			}
			if ($postedbulan=="12")
			{
			$bulan = "Desember";
			}
			if (($postedbulan=="00") or ($postedbulan==""))
			{
			$bulan = "-----";
			}
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
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunhadir" class="form-control">';
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
//cari kelas 
?>
<?php
$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
$tingkat = kelas_jadi_tingkat($kelas);
$tabel_pembayaran=$this->Keuangan_model->Daftar_Besar_Pembayaran($tingkat,$thnajaran);	
$besar_ajuan_sekarang = $besar_ajuan;
echo '<h2>Hendak dibayar '.xduit($besar_ajuan).'</h2>';
$noitem = 1;
$totalkekurangan = 0;
foreach($tabel_pembayaran->result() as $c)
{
	$macam_pembayaran = $c->macam_pembayaran;
	$td = $this->db->query("SELECT * FROM `m_uang_besar` where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and tingkat='$tingkat' order by `nomor_urut`");
	$tagihan = 0;
	foreach($td->result() as $d)
	{
		$tagihan = $d->besar;
	}
	$tc = $this->db->query("select * from siswa_bayar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and nis='$nis'");
	$terbayar = 0;
	foreach($tc->result() as $c)
	{
		$terbayar = $terbayar + $c->besar;
	}

	$kurang = $tagihan - $terbayar;
	$totalkekurangan = $totalkekurangan + $kurang;
//	echo $macam_pembayaran.' kurang '.$kurang.' sisa '.$besar_ajuan_sekarang.'<br />';
	if($kurang>0)
	{
		if($besar_ajuan_sekarang > $kurang)
		{
			echo '<div class="form-group row"><input type="hidden" name="macam_pembayaran_'.$noitem.'" value="'.$c->macam_pembayaran.'"><div class="col-sm-3"><label class="control-label">'.$macam_pembayaran.' ('.$tagihan.') ['.$kurang.'] </label></div>
		<div class="col-sm-3"><input type="text" value="'.xduit($kurang).'" readonly><input name="besar_'.$noitem.'" type="hidden" class="form-control" value="'.$kurang.'"> </div>
		<div class="col-sm-6"><input name="keterangan_'.$noitem.'" type="text" placeholder="keterangan tambahan" class="form-control"></div></div>';
		$besar_ajuan_sekarang = $besar_ajuan_sekarang - $kurang;
		$noitem++;

		}
		elseif(($besar_ajuan_sekarang <= $kurang) and ($besar_ajuan_sekarang > 0))
		{
			echo '<div class="form-group row"><input type="hidden" name="macam_pembayaran_'.$noitem.'" value="'.$c->macam_pembayaran.'"><div class="col-sm-3"><label class="control-label">'.$c->macam_pembayaran.' ('.$tagihan.') ['.$kurang.'] </label></div>
		<div class="col-sm-3"><input type="text" value="'.xduit($besar_ajuan_sekarang).'" readonly><input name="besar_'.$noitem.'" type="hidden" class="form-control" value="'.$besar_ajuan_sekarang.'"></div>
		<div class="col-sm-6"><input name="keterangan_'.$noitem.'" type="text" placeholder="keterangan tambahan" class="form-control"></div></div>';
		$besar_ajuan_sekarang = $besar_ajuan_sekarang - $kurang;
		$noitem++;
		}
		else
		{
//			echo $c->nomor_urut.' '.$macam_pembayaran.'<br />';
		}
	}
	else
	{
//		echo '<p>Sudah lunas</p>';
	}
}
?>
<?php
if($noitem > 30)
{
	echo '<div class="alert alert-danger">Penghitungan otomatis hanya bisa sesuai kalau macam pembayaran tidak lebih dari 30</div>';
}
$cacah_item = $noitem - 1;
$cacah_item2 = 0;
$noitem2 = 1;
$te = $this->db->query("SELECT * FROM `non_komite_besar` where `nis`='$nis'");
$cacah_item2 = $te->num_rows();
if($te->num_rows()>0)
{
	echo '<h4>Kekurangan NonKomite</h4>';
	foreach($te->result() as $e)
	{
		$id_non_komite = $e->id_non_komite;
		$tagihan = $e->besar;
		$tf = $this->db->query("select * from `non_komite_bayar` where `id_non_komite`='$id_non_komite' and `nis`='$nis'");
		$terbayar = 0;
		foreach($tf->result() as $f)
		{
			$terbayar = $terbayar + $f->besar;
		}
		$kurang = $tagihan - $terbayar;
		$totalkekurangan = $totalkekurangan + $kurang;
		if($kurang>0)
		{
			$tg = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
			$nama_tunggakan = '';
			foreach($tg->result() as $g)
			{
				$nama_tunggakan = $g->nama_tunggakan;
			}
			?>
			<div class="form-group row">
			<input type="hidden" name="id_non_komite_<?php echo $noitem2;?>" value="<?php echo $id_non_komite;?>">
			<input type="hidden" name="macam_pembayaran2_<?php echo $noitem2;?>" value="<?php echo $nama_tunggakan;?>">
			<div class="col-sm-3"><label class="control-label"><?php echo $nama_tunggakan;?> (<?php echo $tagihan;?>) [<?php echo $kurang;?>] </label></div>
			<div class="col-sm-3"><input name="besar2_<?php echo $noitem2;?>" type="number" max="<?php echo $kurang;?>" class="form-control"></div>
			<div class="col-sm-6"><input name="keterangan2_<?php echo $noitem2;?>" type="text" placeholder="keterangan tambahan" class="form-control"></div>
			</div>
			<?php
			$noitem2++;
		}
	}
}
?>
<input type="hidden" name="cacah_item" value="<?php echo $cacah_item;?>">
<input type="hidden" name="cacah_item2" value="<?php echo $cacah_item2;?>">
<input type="hidden" name="thnajaranini" value="<?php echo $thnajaranini;?>">
<?php
if($totalkekurangan != 0 )
{
	echo '<div class="alert alert-info">Kekurangan '.xduit($totalkekurangan).' ('.xduitf($totalkekurangan).')</div>';
}
if($cacah_item==0)
{
	echo '<div class="alert alert-success">SUDAH LUNAS</div>
	<p class="text-center"><a href="'.base_url().'keuangan/siswa" class="btn btn-info"><b>Siswa Lain</b></a></p>';
}
else
{
	?>
	<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>keuangan/batal/<?php echo $nis;?>" class="btn btn-danger" data-confirm="Yakin hendak menghapus pembayaran mandiri <?php echo $namasiswa;?>"><b>Batal</b></a></p>
<?php
}
?>
</form>
</div></div></div>
