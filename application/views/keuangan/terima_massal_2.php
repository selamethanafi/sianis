<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : set.php
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
<?php
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;

if($pesan == 'sukses')
{
	?>
	<p><a href="<?php echo base_url().'keuangan/massal2/'.$tahun1.'/'.$semester;?>" class="btn btn-info">Kelas Lain</a></p>
	<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Tanggal</strong></td><td><strong>Macam</strong></td><td><strong>Jumlah</strong></td><td><strong>Hapus</strong></td></tr>
		<?php
		$querysiswa=$this->Admin_model->Tampil_Siswa_Kelas($thnajaran,$semester,$kelas);
		$nomor=1;
		$total = 0;
		foreach($querysiswa->result() as $c)
		{
			$nis = $c->nis;
			$tb = $this->db->query("select * from `siswa_bayar` where `thnajaran`='$thnajaran' and `nis`='$nis'");
			foreach($tb->result() as $b)
			{
				$total = $total + $b->besar;
				echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.nis_ke_nama($nis).'</td><td align="center">'.tanggal($b->tanggal).'</td><td>'.$b->macam_pembayaran.'</td><td align="right">'.number_format($b->besar).'</td>';
				echo "<td align=\"center\"><a href='".base_url()."keuangan/massal/".$tahun1."/".$semester."/".$id_walikelas."/sukses/hapus/".$b->id_siswa_bayar."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Pembayaran Siswa'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
			$nomor++;
			}
		}
		echo '</table></div>';
		echo 'Total : '.xduit($total).' ('.xduitf($total).')';
}
else
{
$xloc = base_url().'keuangan/massal2';
if((!empty($tahun1)) and (!empty($semester)) and (!empty($id_walikelas)))
{
	echo '<form name="formx" method="post" action="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'" class="form-horizontal" role="form">';
}
else
{
	echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
}
if(!empty($tahun1))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo $xloc;?>">Tahun Pelajaran</a></label></div><div class="col-sm-9"><p class="form-control-static"><input name="thnajaran" type="text" value="<?php echo $thnajaran;?>" class="form-control" readonly></p></div></div>
	<?php
}
if(!empty($semester))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo $xloc.'/'.$tahun1;?>">Semester</a></label></div><div class="col-sm-9"><p class="form-control-static"><input name="semester" type="text" value="<?php echo $semester;?>" class="form-control" readonly></p></div></div>
	<?php
}
if(!empty($id_walikelas))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo $xloc.'/'.$tahun1.'/'.$semester;?>">Kelas</a></label></div><div class="col-sm-9"><p class="form-control-static"><input name="id_walikelas" type="text" value="<?php echo $kelas;?>" class="form-control" readonly></p></div></div>
	<?php
}

if(empty($tahun1))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value=""></option>';
	foreach($daftar_tapel->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'">'.$a->thnajaran.'</option>';
	}
	?>
	</select></div></div>
	<?php
}
elseif(empty($semester))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	?>
	</select></div></div>
	<?php
}
elseif(empty($id_walikelas))
{

	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by kelas");
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="id_walikelas" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value=""></option>';
	foreach($ta->result() as $a)
	{
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
	}
	?>
	</select></div></div>
	<?php
}
else
{
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
	$tingkat = kelas_jadi_tingkat($kelas);
	$tabel_pembayaran=$this->Keuangan_model->Daftar_Besar_Pembayaran($tingkat,$thnajaran);	
	?>
	<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Macam Pembayaran</strong></td><td><strong>Kurang</strong></td><td><strong>Jumlah Bayar</strong></td><td><strong>Keterangan</strong></td></tr>
		<?php
		$querysiswa=$this->Admin_model->Tampil_Siswa_Kelas($thnajaran,$semester,$kelas);
		$nomor=1;
		foreach($querysiswa->result() as $c)
		{
			$nis = $c->nis;

			$totalkekurangan = 0;
			foreach($tabel_pembayaran->result() as $c)
			{
				$macam_pembayaran = $c->macam_pembayaran;
				$td = $this->db->query("SELECT * FROM `m_uang_besar` where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and tingkat='$tingkat'");
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
					echo "<tr><td>".$nomor."</td><td>".$nis;
					echo '<input type="hidden" name="nis_'.$nomor.'" value="'.$nis.'">';
					echo "</td><td>".nis_ke_nama($nis)."</td>";
					?>
						<td><input type="hidden" name="macam_pembayaran_<?php echo $nomor;?>" value="<?php echo $c->macam_pembayaran;?>">
						<?php echo $c->macam_pembayaran;?></td><td align="right"><?php echo number_format($kurang);?> </td>
						<td><input name="besar_<?php echo $nomor;?>" type="number" max="<?php echo $kurang;?>"  class="form-control"></td>
						<td><input name="keterangan_<?php echo $nomor;?>" type="text" placeholder="keterangan tambahan" class="form-control"></td></tr>
					<?php
					$nomor++;
				}
			}
		}
		echo '</table></div>';
		$cacah = $nomor - 1;
		echo '<input type="hidden" name="cacah" value="'.$cacah.'"><input type="hidden" name="thnajaran" value="'.$thnajaran.'">';	
	echo '<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'keuangan/massal2" class="btn btn-info"><b>Batal</b></a></p>';

}
?>
</form>
<?php
}
?>
</div></div></div>
