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
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="hidden" name="nis" value="'.$nis.'"><p class="form-control-static">'.$namasiswa;
	$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by thnajaran DESC, semester DESC");
	foreach($ta->result() as $a)
	{
		$thnajaranx = $a->thnajaran;
		$kelas = $a->kelas;
		$semester = $a->semester;
		echo '&nbsp;&nbsp;&nbsp;<a href="'.base_url().'keuangan/terima/'.$nis.'/'.substr($thnajaranx,0,4).'/'.$semester.'" title="terima pembayaran">'.$kelas.' '.$thnajaranx.' '.$semester.'</a>';
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
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Guna membayar</label></div><div class="col-sm-9">
<select name="macam_pembayaran" class="form-control">
<?php
$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
$tingkat = kelas_jadi_tingkat($kelas);
$tabel_pembayaran=$this->Keuangan_model->Daftar_Besar_Pembayaran($tingkat,$thnajaran);	
foreach($tabel_pembayaran->result() as $c)
{
       	echo '<option value="'.$c->macam_pembayaran.'">'.$c->macam_pembayaran.' '.$thnajaran.'</option>';
}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar</label></div><div class="col-sm-9"><input name="besar" type="number" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan Tambahan</label></div><div class="col-sm-9"><input name="keterangan" type="text" class="form-control"></div></div>
<input type="hidden" name="thnajaranini" value="<?php echo $thnajaranini;?>">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>keuangan/siswa" class="btn btn-info"><b>Batal</b></a></p>
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
		<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Pembayaran</strong></td><td><strong>Besar</strong><td><strong>Keterangan</strong></td><td><strong>User</strong></td><td><strong>Hapus</strong></div></div>
		<?php
		$nomor=1;
		foreach($daftar_pembayaran->result() as $ba)
		{
			$str = $ba->tanggal;	
			echo "<tr><td>".$nomor."</td><td>".date_to_long_string($str)."</td><td>".$ba->macam_pembayaran."</td>
<td align='right'>".xduit($ba->besar)."</td><td>".$ba->keterangan."</td><td>".$ba->user."</td>
<td align=\"center\"><a href='".base_url()."keuangan/hapuspembayaran/".$ba->id_siswa_bayar."/".$nis."/".substr($ba->thnajaran,0,4)."/".$semester."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Pembayaran Siswa'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
			$nomor++;
		}
		echo '</table></div>';
	}
	$adadaftar_semua_pembayaran = $daftar_semua_pembayaran->num_rows();
	if($adadaftar_semua_pembayaran>0)
	{
	?>
		<h4>Daftar Penerimaan</h4>
		<?php echo form_open('keuangan/cetakkuitansi','class="form-horizontal" role="form"');?>
		<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
		<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Pembayaran</strong></td><td><strong>Besar</strong><td><strong>Keterangan</strong></td><td><strong>User</strong></td><td><strong>Cetak<br />Kuitansi</strong></td><td><strong>Hapus</strong></div></div>
		<?php
		$nomor=1;
		foreach($daftar_semua_pembayaran->result() as $ba)
		{
			$str = $ba->tanggal;	
			echo "<tr><td>".$nomor."</td><td>".date_to_long_string($str)."</td><td>".$ba->macam_pembayaran."</td>
<td align='right'>".xduit($ba->besar)."</td><td>".$ba->keterangan."</td><td>".$ba->user."</td><td align=\"center\">";
			echo form_checkbox('pilihan_'.$nomor, '1', FALSE);
			echo '<input type="hidden" name="id_siswa_bayar_'.$nomor.'" value="'.$ba->id_siswa_bayar.'">';
			echo "</td><td align=\"center\"><a href='".base_url()."keuangan/hapuspembayaran/".$ba->id_siswa_bayar."/".$nis."/".substr($thnajaran,0,4)."/".$semester."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Pembayaran Siswa'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
		$nomor++;
		}
		echo '</table></div>';
		$cacah = $nomor - 1;
		echo '<p class="text-center"><input type="hidden" name="nis" value="'.$nis.'"><input type="hidden" name="cacah" value="'.$cacah.'"><input type="submit" value="Cetak Kuitansi" class="btn btn-primary"></p>';
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
	$tmacam = $this->db->query("select * from m_uang");
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
		$tset = $this->db->query("select * from m_uang_besar where thnajaran='$thnajaran' and tingkat='$tingkat'");
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
			echo '<td align="right">'.xduit($terbayar).'</td>';

		}

	
	}

	echo '</tr>';
	echo '<tr align="right"><td colspan="3">Jumlah</td><td>'.xduit($jmltagihan).'</td><td>'.xduit($jmlterbayar).'</td></tr>';
	$kekurangan = $jmltagihan - $jmlterbayar;
	if($kekurangan < 0)
	{
		echo '<tr align="right"><td colspan="3">Kelebihan</td><td colspan="2"><div class="alert alert-danger">'.xduit($kekurangan).'</div></td></tr>';
	}
	else
	{
		echo '<tr align="right"><td colspan="3">Kekurangan</td><td colspan="2"><p class="text-info">'.xduit($kekurangan).'</p></td></tr>';
	}
	echo '</table>';	
}
?>
</div></div></div>
