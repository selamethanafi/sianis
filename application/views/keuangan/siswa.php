<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : siswa.php
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
<p><a href="<?php echo base_url(); ?>keuangan/siswakelas" class="btn btn-info"><b> Daftar Siswa per Kelas</b></a></p>
<?php echo form_open('keuangan/siswa','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama / NIS</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control"></div></div>
<p class="text-center"><input type="submit" value="Cari Siswa" class="btn btn-primary"></p>
</form>
<p class="text-info">Klik kelas untuk menerima pembayaran</p>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS.</strong></td><td><strong>Nama</strong></td><td><strong>Status</strong><td><strong>Kelas / Tahun Pelajaran / Semester</strong></td><td width="50"><strong>Input Tunggakan Nonkomite</strong></td><td width="50"><strong>Aksi</strong></td></tr>
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
	$nis = $b->nis;
	$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by thnajaran DESC, semester DESC");
echo "<tr><td></td><td>".$b->nis."</td><td>".$b->nama."</td><td>".$b->ket." -
 ".$ket."</td><td>";
	foreach($ta->result() as $a)
	{
		$thnajaran = $a->thnajaran;
		$kelas = $a->kelas;
		$semester = $a->semester;
		echo '<p><a href="'.base_url().'keuangan/terima/'.$b->nis.'/'.substr($thnajaran,0,4).'/'.$semester.'" title="terima pembayaran">'.$kelas.' '.$thnajaran.' '.$semester.'</a></p>';
	}
	echo "</td><td><a href='".base_url()."keuangan/tunggakannonkomite/".$b->nis."' title='Tunggakan Nonkomite'><span class=\"fa fa-pencil-alt\"></span></a></td><td><a href='".base_url()."keuangan/detilsiswa/".$b->nis."' title='Detil Siswa'><span class=\"fa fa-edit\"></span></a></td></tr>";
$nomor++;
}
?>
</table></div>
</div></div></div>
