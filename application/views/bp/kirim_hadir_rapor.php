<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 20:40:31 WIB 
// Nama Berkas 		: nilai_akhlak.php
// Lokasi      		: application/views/bp/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<?php
$xloc = base_url().'bp/kirimhadirrapor';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if(!empty($tahun1))
	{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	}
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$k->thnajaran.'</option>';
	}

	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1/'.$id_kelas.'">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2/'.$id_kelas.'">2</option>';
	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
	}
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select></div></div>';
	$kelas = $kelasxx;
echo '</div></div></form>';
if((!empty($thnajaran)) and(!empty($semester)) and (!empty($id_kelas)))
{
	$ts = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut");
	$nomor =1;
	foreach($ts->result() as $ds)
	{
		$nis = $ds->nis;
		$namasiswa = nis_ke_nama($nis);
		//sakit
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

		//kredit
		$tk = $this->db->query("select * from siswa_kredit where thnajaran='$thnajaran' and nis='$nis'");
		$poin=0;
		foreach($tk->result() as $dk)
			{
			$poin = $poin + $dk->point;
			}
		$tanpa_keterangan = $alpa;
		$membolos = $bolos;
		$angka_kredit = $poin;
		$tCek_Nilai_Hadir=$this->db->query("select * from kepribadian where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		$ada = $tCek_Nilai_Hadir->num_rows();
			if($ada>0) 
			{
				$this->db->query("update kepribadian set sakit = '$sakit', izin = '$izin', tanpa_keterangan = '$tanpa_keterangan', membolos = '$membolos', terlambat='$terlambat', angka_kredit = '$angka_kredit' where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
			}
			else
			{
			$simpanloginsiswa=$this->db->query("INSERT INTO `kepribadian` (`thnajaran` ,`semester` ,`kelas` ,`nis` , `sakit`, `izin`, `tanpa_keterangan`, `membolos`, `terlambat`,`angka_kredit`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$sakit', '$izin', '$tanpa_keterangan', '$membolos', '$terlambat','$angka_kredit')");
			}

		$nomor++;
	}

	?>
	<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Sakit</strong></td><td><strong>Izin</strong></td><td><strong>Tanpa Keterangan</strong></td><td><strong>Membolos</strong></td><td><strong>Terlambat</strong></td><td><strong>Angka Kredit</strong></td></tr>
	<?php
	$ts = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut");
	$nomor=1;
	foreach($ts->result() as $b)
	{
		$nis = $b->nis;
		$namasiswa = nis_ke_nama($nis);
		$ta = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		foreach($ta->result() as $a)
			{
			echo "<tr><td>".$nomor."</td><td>".$nis."</td><td width=\"200\">".$namasiswa."</td><td align=\"center\">".$a->sakit."</td><td align=\"center\">".$a->izin."</td><td align=\"center\">".$a->tanpa_keterangan."</td><td align=\"center\">".$a->membolos."</td><td align=\"center\">".$a->terlambat."</td><td align=\"center\">".$a->angka_kredit."</td></tr>";
			}
	$nomor++;

	}
	echo '</table><br>';
} //akhir kalau bisa diproses
echo '</div>';
