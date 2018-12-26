<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kekurangan_siswa.php
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
<?php echo form_open('keuangan/kekurangansiswa','class="form-horizontal" role="form"');?>
<?php
$kekurangan = 0;
if (empty($nama))
{
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control"></div></div>';
echo '<p class="text-center"><input type="submit" value="Cari Siswa" class="btn btn-primary">&nbsp&nbsp&nbsp<a href="'.base_url().'keuangan/kekurangansiswa" class="btn btn-info"><b>Batal</b></a></p>';
}
else
{
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><p class="form-control-static
"><input type="hidden" name="nis" value="'.$nis.'">
'.$nama.' </p></div></div>';
?>
<?php
echo '<p class="text-center"><a href="'.base_url().'keuangan/kekurangansiswa" class="btn btn-info"><b>Batal / Siswa Lain</b></a></p>';
}
?>
</form>
<?php
if (empty($nis))
{
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Status</strong></td><td width="30"><strong>Pilih</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
$ket='';
		if ($b->ket=='Y')
			{
			$ket = 'Aktif';
			}
		if ($b->ket=='T')
			{
			$ket = 'Keluar';
			}
		if ($b->ket=='P')
			{
			$ket = 'Pindah';
			}
		if ($b->ket=='L')
			{
			$ket = 'Lulus';
			}
		$nis2 = $b->nis;
		$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis2'");
		echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".$b->nama."</td>";
		echo '<td>';
		foreach($ta->result() as $a)
		{
			echo $a->kelas.' '.$a->thnajaran.' '.$a->semester.'<br />';
		}	
		echo '</td>';
		echo "<td>".$ket."</td><td><a href='".base_url()."keuangan/kekurangansiswa/".$b->nis."' title='Pilih Siswa'><span class=\"fa fa-edit\"></span></a></td></tr>";

$nomor++;
}
}
?>
</table>
<?php
if (!empty($nis))
{
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
	$te = $this->db->query("SELECT * FROM `non_komite_besar` where `nis`='$nis'");
	if($te->num_rows()>0)
	{
		$kekurangan2 = 0;
		echo '<tr><td colspan="5">Kekurangan NonKomite</td></tr>';
		foreach($te->result() as $e)
		{
			$id_non_komite = $e->id_non_komite;
			$tagihan2 = $e->besar;
			$tf = $this->db->query("select * from `non_komite_bayar` where `id_non_komite`='$id_non_komite' and `nis`='$nis'");
			$terbayar2 = 0;
			foreach($tf->result() as $f)
			{
				$terbayar2 = $terbayar2 + $f->besar;
			}
			$kurang2 = $tagihan2 - $terbayar2;
			$tg = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
			$nama_tunggakan = '';
			foreach($tg->result() as $g)
			{
				$nama_tunggakan = $g->nama_tunggakan;
			}
			?>
			<tr><td></td><td></td><td><?php echo $nama_tunggakan;?></td><td><?php echo $tagihan2;?><td><?php echo $terbayar2;?></td></tr>
		<?php
		}
	}
	$kekurangan2 = $jmltagihan - $jmlterbayar;
	if($kekurangan2 < 0)
	{
		echo '<tr align="right"><td colspan="3">Kelebihan</td><td colspan="2"><div class="alert alert-danger">'.xduit($kekurangan2).'</div></td></tr>';
	}
	else
	{
		echo '<tr align="right"><td colspan="3">Kekurangan</td><td colspan="2"><p class="text-info">'.xduit($kekurangan2).'</p></td></tr>';
	}
	echo '</table>';	
?>
<br>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun</strong></td><td><strong>Macam Pembayaran</strong></td>
<td><strong>Tanggal</strong></td><td><strong>Besar</strong></td></tr>
<?php
$nomor=1;
$jumlahbayar = 0;
if(count($querybayar->result())>0)
{
foreach($querybayar->result() as $qb)
	{
	$tanggalbayar = date_to_long_string($qb->tanggal);
echo "<tr><td align='center'>".$nomor."</td><td>".$qb->thnajaran."</td><td>".$qb->macam_pembayaran."</td><td>".$tanggalbayar."</td>
<td align=\"right\">".xduit($qb->besar)."</td></tr>";
	$jumlahbayar = $jumlahbayar + $qb->besar;
$nomor++;	
	}
	echo '<tr><td colspan="3" align="right">Jumlah Pembayaran</td><td colspan="2" align="right">'.xduit($jumlahbayar).'</td></tr>';
}
else{
echo "<tr><td colspan='5'>Belum Ada Data</td></tr>";
}

?>
</table><br />
<?php	
}
?>
</div></div></div>
