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
<?php echo form_open('keuangan/terima/'.$nis.'/'.substr($thnajaran,0,4).'/'.$semester,'class="form-horizontal" role="form"');?>
<?php
$thnajaranini = cari_thnajaran();
$namasiswa = nis_ke_nama($nis);
		$total_terbayar = 0;
		$total_per_tahun = 0;
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
$tingkat = '';
$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
$tingkat = kelas_jadi_tingkat($kelas);
$tabel_pembayaran=$this->Keuangan_model->Daftar_Besar_Pembayaran($tingkat,$thnajaran);	
if(empty($tingkat))
{
	echo '<div class="alert alert-danger">Bahaya, kelas tidak dikenali sistem</div>';
}
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
	if($kurang>0)
	{
	?>
	<div class="form-group row">
		<input type="hidden" name="macam_pembayaran_<?php echo $noitem;?>" value="<?php echo $c->macam_pembayaran;?>">
		<div class="col-sm-3"><label class="control-label"><?php echo $c->macam_pembayaran;?> (<?php echo $tagihan;?>) [<?php echo $kurang;?>] </label></div>
		<div class="col-sm-3"><input name="besar_<?php echo $noitem;?>" type="number" class="form-control" onblur="findTotal()" id="qty_<?php echo $noitem;?>" min="0" max="<?php echo $kurang;?>"> </div>
		<div class="col-sm-6"><input name="keterangan_<?php echo $noitem;?>" type="text" placeholder="keterangan tambahan" class="form-control"></div>
	</div>
	<?php
	$noitem++;
	}
}
?>
<div class="form-group row">
<div class="col-sm-3"><label class="control-label">Total</label></div>
<div class="col-sm-9"><input type="text" name="total" id="total" class="form-control" disabled></div>
</div>
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
	<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>keuangan/siswa" class="btn btn-info"><b>Batal</b></a></p>
<?php
}
?>
</form>
<?php
if (!empty($nis))
{
	$adadaftar_pembayaran = $daftar_pembayaran->num_rows();
	if($adadaftar_pembayaran>0)
	{
	?>
		<h4>Tahun Pelajaran <?php echo $thnajaran;?></h4>
		<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
		<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Pembayaran</strong></td><td><strong>Besar</strong><td><strong>Keterangan</strong></td><td><strong>User</strong></td><td><strong>Hapus</strong></td></tr>
		<?php
		$nomor=1;
		foreach($daftar_pembayaran->result() as $ba)
		{
			$str = $ba->tanggal;	
			echo "<tr><td>".$nomor."</td><td>".date_to_long_string($str)."</td><td>".$ba->macam_pembayaran."</td>
<td align='right'>".xduit($ba->besar)."</td><td>".$ba->keterangan."</td><td>".$ba->user."</td><td align=\"center\"><a href='".base_url()."keuangan/hapuspembayaran/".$ba->id_siswa_bayar."/".$nis."/".substr($ba->thnajaran,0,4)."/".$semester."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Pembayaran Siswa'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
			$nomor++;
			$total_per_tahun = $total_per_tahun + $ba->besar;
		}
		echo '<tr><td colspan="3">Jumlah</td><td align="right">'.xduit($total_per_tahun).'</td><td colspan="3"></td></tr></table></div>';
	}
	$adadaftar_semua_pembayaran = $daftar_semua_pembayaran->num_rows();
	$adadaftar_semua_pembayaran_non_komite = $daftar_semua_pembayaran_non_komite->num_rows();
	if(($adadaftar_semua_pembayaran>0) or ($adadaftar_semua_pembayaran_non_komite>0))
	{
	?>
		<h4>Daftar Penerimaan</h4>
		<?php
		 echo form_open('keuangan/cetakkuitansi','class="form-horizontal" role="form"');?>
		<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
		<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Pembayaran</strong></td><td><strong>Besar</strong><td><strong>Keterangan</strong></td><td><strong>User</strong></td><td><strong>Cetak<br />Kuitansi</strong></td><td><strong>Hapus</strong></td></tr>
		<?php
		$nomor=1;
		foreach($daftar_semua_pembayaran->result() as $ba)
		{
			$str = $ba->tanggal;
			$total_terbayar = $total_terbayar + $ba->besar;
			echo "<tr><td>".$nomor."</td><td>".date_to_long_string($str)."</td><td>".$ba->macam_pembayaran."</td>
<td align='right'>".xduit($ba->besar)."</td><td>".$ba->keterangan."</td><td>".$ba->user."</td><td align=\"center\">";
			echo form_checkbox('pilihan_'.$nomor, '1', FALSE);
			echo '<input type="hidden" name="id_siswa_bayar_'.$nomor.'" value="'.$ba->id_siswa_bayar.'">';
			echo "</td><td align=\"center\"><a href='".base_url()."keuangan/hapuspembayaran/".$ba->id_siswa_bayar."/".$nis."/".substr($thnajaran,0,4)."/".$semester."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Pembayaran Siswa'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
		$nomor++;
		}
		$cacah = $nomor - 1;
		$nomor2=1;
		foreach($daftar_semua_pembayaran_non_komite->result() as $banon)
		{
			$str = $banon->tanggal;	
			$id_non_komite = $banon->id_non_komite;
			$tg = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
			$nama_tunggakan = '';
			foreach($tg->result() as $g)
			{
				$nama_tunggakan = $g->nama_tunggakan;
			}

			echo "<tr><td>".$nomor."</td><td>".date_to_long_string($str)."</td><td>".$nama_tunggakan."</td>
<td align='right'>".xduit($banon->besar)."</td><td>".$banon->keterangan."</td><td>".$banon->user."</td><td align=\"center\">";
			echo form_checkbox('pilihan2_'.$nomor2, '1', FALSE);
			echo '<input type="hidden" name="id_siswa_bayar2_'.$nomor2.'" value="'.$banon->id_siswa_bayar.'">';
			echo "</td><td align=\"center\"><a href='".base_url()."keuangan/hapuspembayarannonkomite/".$banon->id_siswa_bayar."/".$nis."/".substr($thnajaran,0,4)."/".$semester."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Pembayaran Non Komite Siswa'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
		$nomor2++;
			$total_terbayar = $total_terbayar + $banon->besar;
			$nomor++;
		}

		echo '<tr><td colspan="3">Jumlah</td><td align="right">'.xduit($total_terbayar).'</td><td colspan="4"></td></tr></table></div>';
		$cacah2 = $nomor2 - 1;
		echo '<p class="text-center"><div class="form-group">Pilih printer <select name="tipe_printer" class="form-control" required><option value=""></option><option value="Thermal">Thermal</option><option value="Biasa">NonThermal</option></select></p></div>';
		?>
		<input type="hidden" name="tahun1" value="<?php echo substr($thnajaran,0,4);?>">
		<input type="hidden" name="semester" value="<?php echo $semester;?>">
		<?php
		echo '<p class="text-center"><input type="hidden" name="nis" value="'.$nis.'"><input type="hidden" name="cacah" value="'.$cacah.'"><input type="hidden" name="cacah2" value="'.$cacah2.'"><input type="submit" value="Cetak Kuitansi" class="btn btn-primary"></p>';
	}
}
if (!empty($nis))
{
	echo '<h4>Kekurangan Pembayaran</h4>';
	$taa = $this->db->query("select * from `siswa_kelas` where `nis`='$nis'");
	foreach($taa->result() as $aa)
	{
		$nis = $aa->nis;
		$kelas = $aa->kelas;
		$thnajaran = $aa->thnajaran;
		//cari di riwayat
		$tba = $this->db->query("select * from `siswa_kelas_tahun` where `thnajaran`='$thnajaran' and `nis`='$nis'");
		$adatba = $tba->num_rows();
		if($adatba == 0)
		{
			$this->db->query("insert into `siswa_kelas_tahun` (`thnajaran`,`nis`,`kelas`) values ('$thnajaran', '$nis', '$kelas')");
		}
	}

	$jmltagihan = 0;
	$jmlterbayar = 0;
	$tmacam = $this->db->query("select * from m_uang order by `nomor_urut`");
	echo '<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td>Tahun Pelajaran</td><td>Kelas</td><td>Macam Pembayaran</td>';
	echo '<td align="center" width="12%">Besar</td><td align="center" width="12%">Terbayar</td></tr>';
	$tsk = $this->db->query("select * from `siswa_kelas_tahun` where nis = '$nis' order by `thnajaran`");
	$jmltagihan = 0;
	foreach($tsk->result() as  $dsk)
	{
		$thnajaran = $dsk->thnajaran;
		$kelas = $dsk->kelas;
		$tingkat = kelas_jadi_tingkat($kelas);
		$tset = $this->db->query("select * from m_uang_besar where thnajaran='$thnajaran' and tingkat='$tingkat' order by `nomor_urut`");
		foreach($tset->result() as  $dset)
		{
			$macam_pembayaran = $dset->macam_pembayaran;
			$besar = $dset->besar;
			echo '<tr><td>'.$thnajaran.'</td><td>'.$kelas.'</td>';
			echo '<td>'.$macam_pembayaran.'</td><td align="right">'.number_format($besar).'</td>';
			$jmltagihan = $jmltagihan + $besar;
			//cari jumlah pembayaran
			$tby = $this->db->query("select * from siswa_bayar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and nis='$nis'");
			$terbayar = 0;
			foreach($tby->result() as $dby)
			{
				$terbayar = $terbayar + $dby->besar;
			}
			//terbayar
			$jmlterbayar = $jmlterbayar + $terbayar;
			echo '<td align="right">'.number_format($terbayar).'</td>';

		}

	
	}

	echo '</tr>';
	echo '<tr align="right"><td colspan="3">Jumlah</td><td>'.xduit($jmltagihan).'</td><td>'.xduit($jmlterbayar).'</td></tr>';
	$kekurangan = $jmltagihan - $total_terbayar;
	if($kekurangan < 0)
	{
		echo '<tr align="right"><td colspan="3">Kelebihan</td><td colspan="2"><div class="alert alert-danger">'.xduit($kekurangan).'</div></td></tr>';
	}
	else
	{
		echo '<tr align="right"><td colspan="3">Kekurangan</td><td colspan="2"><p class="text-info">'.xduit($kekurangan).'</p></td></tr>';
	}
	echo '</table>';	
	echo '<h4>Kekurangan Pembayaran Non Komite</h4>';
	$jmltagihan2 = 0;
	$jmlterbayar2 = 0;
	$tmacam = $this->db->query("select * from `non_komite_besar` where `nis`='$nis'");
	if($tmacam->num_rows()>0)
	{
		echo '<table class="table table-striped table-hover table-bordered">
		<tr align="center"><td>Macam Pembayaran</td>';
		echo '<td align="center">Besar</td><td align="center">Terbayar</td></tr>';
		foreach($tmacam->result() as $h)
		{
			$id_non_komite = $h->id_non_komite;
			$besar2 = $h->besar;
			$jmltagihan2 = $jmltagihan2 + $besar2;
			$ti = $this->db->query("select * from `non_komite_bayar` where `id_non_komite`='$id_non_komite' and nis='$nis'");
			$terbayar2 = 0;
			foreach($ti->result() as $di)
			{
				$terbayar2 = $terbayar2 + $di->besar;
			}
			$tg = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
			$nama_tunggakan = '';
			foreach($tg->result() as $g)
			{
				$nama_tunggakan = $g->nama_tunggakan;
			}

			//terbayar
			$jmlterbayar2 = $jmlterbayar2 + $terbayar2;
			echo '<tr><td>'.$nama_tunggakan.'</td><td align="right">'.number_format($besar2).'</td><td align="right">'.number_format($terbayar2).'</td></tr>';

		}

	}
	echo '</tr>';
	echo '<tr align="right"><td>Jumlah</td><td>'.xduit($jmltagihan2).'</td><td>'.xduit($jmlterbayar2).'</td></tr>';
	$kekurangan2 = $jmltagihan2 - $jmlterbayar2;
	if($kekurangan2 < 0)
	{
		echo '<tr align="right"><td>Kelebihan</td><td  colspan="2"><div class="alert alert-danger">'.xduit($kekurangan2).'</div></td></tr>';
	}
	else
	{
		echo '<tr align="right"><td>Kekurangan</td><td colspan="2"><p class="text-info">'.xduit($kekurangan2).'</p></td></tr>';
	}
	echo '</table>';	

}
?>
<script type="text/javascript">
function findTotal(){
    var besar_1 = document.getElementsByName('besar_1');
    var besar_2 = document.getElementsByName('besar_2');
    var besar_3 = document.getElementsByName('besar_3');
    var besar_4 = document.getElementsByName('besar_4');
    var besar_5 = document.getElementsByName('besar_5');
    var besar_6 = document.getElementsByName('besar_6');
    var besar_7 = document.getElementsByName('besar_7');
    var besar_8 = document.getElementsByName('besar_8');
    var besar_9 = document.getElementsByName('besar_9');
    var besar_10 = document.getElementsByName('besar_10');
    var besar_11 = document.getElementsByName('besar_11');
    var besar_12 = document.getElementsByName('besar_12');
    var besar_13 = document.getElementsByName('besar_13');
    var besar_14 = document.getElementsByName('besar_14');
    var besar_15 = document.getElementsByName('besar_15');
    var besar_16 = document.getElementsByName('besar_16');
    var besar_17 = document.getElementsByName('besar_17');
    var besar_18 = document.getElementsByName('besar_18');
    var besar_19 = document.getElementsByName('besar_19');
    var besar_20 = document.getElementsByName('besar_20');
    var besar_21 = document.getElementsByName('besar_21');
    var besar_22 = document.getElementsByName('besar_22');
    var besar_23 = document.getElementsByName('besar_23');
    var besar_24 = document.getElementsByName('besar_24');
    var besar_25 = document.getElementsByName('besar_25');
    var besar_26 = document.getElementsByName('besar_26');
    var besar_27 = document.getElementsByName('besar_27');
    var besar_28 = document.getElementsByName('besar_28');
    var besar_29 = document.getElementsByName('besar_29');
    var besar_30 = document.getElementsByName('besar_30');

    var tot=0;
    for(var i=0;i<besar_1.length;i++){
        if(parseInt(besar_1[i].value))
            tot += parseInt(besar_1[i].value);
    }
    for(var i=0;i<besar_2.length;i++){
        if(parseInt(besar_2[i].value))
            tot += parseInt(besar_2[i].value);
    }
    for(var i=0;i<besar_3.length;i++){
        if(parseInt(besar_3[i].value))
            tot += parseInt(besar_3[i].value);
    }
    for(var i=0;i<besar_4.length;i++){
        if(parseInt(besar_4[i].value))
            tot += parseInt(besar_4[i].value);
    }
    for(var i=0;i<besar_5.length;i++){
        if(parseInt(besar_5[i].value))
            tot += parseInt(besar_5[i].value);
    }
    for(var i=0;i<besar_6.length;i++){
        if(parseInt(besar_6[i].value))
            tot += parseInt(besar_6[i].value);
    }
    for(var i=0;i<besar_7.length;i++){
        if(parseInt(besar_7[i].value))
            tot += parseInt(besar_7[i].value);
    }
    for(var i=0;i<besar_8.length;i++){
        if(parseInt(besar_8[i].value))
            tot += parseInt(besar_8[i].value);
    }
    for(var i=0;i<besar_9.length;i++){
        if(parseInt(besar_9[i].value))
            tot += parseInt(besar_9[i].value);
    }
    for(var i=0;i<besar_10.length;i++){
        if(parseInt(besar_10[i].value))
            tot += parseInt(besar_10[i].value);
    }
    for(var i=0;i<besar_11.length;i++){
        if(parseInt(besar_11[i].value))
            tot += parseInt(besar_11[i].value);
    }
    for(var i=0;i<besar_12.length;i++){
        if(parseInt(besar_12[i].value))
            tot += parseInt(besar_12[i].value);
    }
    for(var i=0;i<besar_13.length;i++){
        if(parseInt(besar_13[i].value))
            tot += parseInt(besar_13[i].value);
    }
    for(var i=0;i<besar_14.length;i++){
        if(parseInt(besar_14[i].value))
            tot += parseInt(besar_14[i].value);
    }
    for(var i=0;i<besar_15.length;i++){
        if(parseInt(besar_15[i].value))
            tot += parseInt(besar_15[i].value);
    }
    for(var i=0;i<besar_16.length;i++){
        if(parseInt(besar_16[i].value))
            tot += parseInt(besar_16[i].value);
    }
    for(var i=0;i<besar_17.length;i++){
        if(parseInt(besar_17[i].value))
            tot += parseInt(besar_17[i].value);
    }
    for(var i=0;i<besar_18.length;i++){
        if(parseInt(besar_18[i].value))
            tot += parseInt(besar_18[i].value);
    }
    for(var i=0;i<besar_19.length;i++){
        if(parseInt(besar_19[i].value))
            tot += parseInt(besar_19[i].value);
    }
    for(var i=0;i<besar_20.length;i++){
        if(parseInt(besar_20[i].value))
            tot += parseInt(besar_20[i].value);
    }
    for(var i=0;i<besar_21.length;i++){
        if(parseInt(besar_21[i].value))
            tot += parseInt(besar_21[i].value);
    }
    for(var i=0;i<besar_22.length;i++){
        if(parseInt(besar_22[i].value))
            tot += parseInt(besar_22[i].value);
    }
    for(var i=0;i<besar_23.length;i++){
        if(parseInt(besar_23[i].value))
            tot += parseInt(besar_23[i].value);
    }
    for(var i=0;i<besar_24.length;i++){
        if(parseInt(besar_24[i].value))
            tot += parseInt(besar_24[i].value);
    }
    for(var i=0;i<besar_25.length;i++){
        if(parseInt(besar_25[i].value))
            tot += parseInt(besar_25[i].value);
    }
    for(var i=0;i<besar_26.length;i++){
        if(parseInt(besar_26[i].value))
            tot += parseInt(besar_26[i].value);
    }
    for(var i=0;i<besar_27.length;i++){
        if(parseInt(besar_27[i].value))
            tot += parseInt(besar_27[i].value);
    }
    for(var i=0;i<besar_28.length;i++){
        if(parseInt(besar_28[i].value))
            tot += parseInt(besar_28[i].value);
    }
    for(var i=0;i<besar_29.length;i++){
        if(parseInt(besar_29[i].value))
            tot += parseInt(besar_29[i].value);
    }
    for(var i=0;i<besar_30.length;i++){
        if(parseInt(besar_30[i].value))
            tot += parseInt(besar_20[i].value);
    }
    document.getElementById('total').value = tot;
}

    </script></div></div></div>
