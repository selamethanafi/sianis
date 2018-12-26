<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:53:40 WIB 
// Nama Berkas 		: peringkat_siswa.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
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
$tahun1 = substr($thnajaran,0,4);
?>

<a href="<?php echo base_url(); ?>pengajaran/peringkat/3/p/<?php echo $tahun1;?>/<?php echo $semester;?>" target="_blank" class="btn btn-info"><b>3 Besar Kog</b></a>&nbsp;&nbsp; 
<a href="<?php echo base_url(); ?>pengajaran/peringkat/5/p/<?php echo $tahun1;?>/<?php echo $semester;?>" target="_blank" class="btn btn-info"><b>5 Besar Kog</b></a>&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>pengajaran/peringkat/10/p/<?php echo $tahun1;?>/<?php echo $semester;?>" target="_blank" class="btn btn-info"><b>10 Besar Kog</b></a>
<a href="<?php echo base_url(); ?>pengajaran/peringkat/3/a/<?php echo $tahun1;?>/<?php echo $semester;?>" target="_blank" class="btn btn-info"><b>3 Besar Kog + Psi</b></a>&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>pengajaran/peringkat/5/a/<?php echo $tahun1;?>/<?php echo $semester;?>" target="_blank" class="btn btn-info"><b>5 Besar Kog + Psi</b></a>&nbsp;&nbsp; 
<a href="<?php echo base_url(); ?>pengajaran/peringkat/10/a/<?php echo $tahun1;?>/<?php echo $semester;?>" target="_blank" class="btn btn-info"><b>10 Besar Kog + Psi</b></a></p>
	<?php echo form_open('pengajaran/peringkat','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">

	<?php
	echo "<option value='".$kelas."'>".$kelas."</option>";
	foreach($daftar_kelas->result_array() as $ka)
	{
	echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
	}
	?>
	</select></div></div>
	<p class="text-center"><input type="submit" value="Proses" class="btn btn-primary"></p>
</form>
<?php
if ((!empty($thnajaran)) and (!empty($kelas)) and (!empty($semester)))
{
	$this->db->query("delete from siswa_peringkat where thnajaran ='$thnajaran' and kelas='$kelas' and semester='$semester'");
	$tingkat = kelas_jadi_tingkat($kelas);
	$program = kelas_jadi_program($kelas);
	$tsiskel = $this->db->query("select * from siswa_kelas where thnajaran ='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester'");

	foreach($tsiskel->result() as $b)
	{
		$nis=$b->nis;
		//jumlah nilai
		$kog = 0;
		$psi = 0;
		$tnilai = $this->db->query("select * from nilai where thnajaran ='$thnajaran' and semester='$semester' and nis='$nis' and `status`='Y'");
		foreach($tnilai->result() as $c)
		{		
			$kog = $kog + $c->kog;
			$psi = $psi + $c->psi;
			$kunci = $c->kunci;
			if($kunci != 1)
			{
				die($c->mapel.' belum terkunci. <a href="'.base_url().'pengajaran/peringkat"><b>Ulang / Kelas Lain</b></a>');
			}

		}
 		$jml = $kog + $psi;
		$this->db->query("insert into siswa_peringkat (`thnajaran`,`semester`,`tingkat`,`program`,`kelas`,`nis`,`jumlah_kognitif`,`jumlah_psikomotor`,`jumlah`) values ('$thnajaran','$semester','$tingkat','$program','$kelas','$nis','$kog','$psi','$jml')");
}
	$tperingkat = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and semester='$semester' and kelas='$kelas' order by jumlah_kognitif DESC");
	$peringkat = 1;
	foreach($tperingkat->result() as $d)
	{
	$nis = $d->nis;
	$this->db->query("update siswa_peringkat set peringkat_kelas='$peringkat' where thnajaran ='$thnajaran' and semester='$semester' and nis='$nis'");
	$peringkat++;
	}

	$tperingkatb = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and semester='$semester' and kelas='$kelas' order by jumlah DESC");
	$peringkatb = 1;
	foreach($tperingkatb->result() as $e)
	{
	$nis = $e->nis;
	$this->db->query("update siswa_peringkat set peringkat_kelas_kumulatif='$peringkatb' where thnajaran ='$thnajaran' and semester='$semester' and nis='$nis'");
	$peringkatb++;
	}

	?>
<h3>Peringkat Siswa Berdasarkan Jumlah Nilai Kognitif</h3>
	<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jumlah Kognitif</strong></td><td><strong>Jumlah Psikomotor</strong></td><td><strong>Jumlah</strong></td><td><strong>Peringkat Kelas</strong></td></tr>

<?php
$nomor=1;
$tf = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and kelas='$kelas' and semester='$semester' order by jumlah_kognitif DESC");
foreach($tf->result() as $f)
{
		$nis=$f->nis;
		$nama = nis_ke_nama($nis);
	echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$nis."</td><td>".$nama."</td><td align=\"center\">".$f->jumlah_kognitif."</td><td align=\"center\">".$f->jumlah_psikomotor."</td><td align=\"center\">".$f->jumlah."</td><td align=\"center\">".$f->peringkat_kelas."</td></tr>";

$nomor++;
}
?>
</table><br>
<h3>Peringkat Siswa Berdasarkan Jumlah Nilai Kognitif dan Psikomotor</h3>
	<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Jumlah Kognitif</strong></td><td><strong>Jumlah Psikomotor</strong></td><td><strong>Jumlah</strong></td><td><strong>Peringkat Kelas</strong></td></tr>

<?php
$nomor=1;
$tg = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and kelas='$kelas' and semester='$semester' order by jumlah DESC");
foreach($tg->result() as $g)
{
		$nis=$g->nis;
		$nama = nis_ke_nama($nis);
	echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$nis."</td><td>".$nama."</td><td align=\"center\">".$g->jumlah_kognitif."</td><td align=\"center\">".$g->jumlah_psikomotor."</td><td align=\"center\">".$g->jumlah."</td><td align=\"center\">".$g->peringkat_kelas_kumulatif."</td></tr>";

$nomor++;
}

}
?>
</table>
</div></div></div>
