<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: rph_tanggal_tampil.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><?php echo '<a href="'.base_url().'guru/rph" class="btn btn-info"><b>Tampil Semua RPH</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphlain2" class="btn btn-info"><b>Tambah RPH</b></a>&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphtanggal2" class="btn btn-info"><b>Tampil/Ubah RPH/BPH tanggal tertentu</b></a>';
if ((!empty($kodeguru)) or (!empty($tanggalrph)))
{
$tanggalrphe = ''.substr($tanggalrph,0,4).'-'.substr($tanggalrph,4,2).'-'.substr($tanggalrph,6,2).'';
$tb = $this->db->query("select * from `guru_rph_ringkas` where `kodeguru`='$kodeguru' and `tanggal`='$tanggalrphe' order by jamke");
if(count($tb->result())>0)
{
	foreach($tb->result() as $b)
	{
	$thnajaran = $b->thnajaran;
	$semester = $b->semester;
	}

	?>
<table width="100%">
<tr><td>Tahun Pelajaran</td><td>:</td><td><strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td>Semester</td><td>:</td><td><strong><?php echo $semester;?></strong></td></tr>
<tr><td>Tanggal RPH</td><td>:</td><td><strong><?php echo date_to_long_string($tanggalrphe);?></strong></td></tr>
</table>

<?php
echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Jam Ke-</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong></td><td><strong>Kode RPP</strong></td><td><strong>Rencana</strong></td><td><strong>Keterangan</strong></td><td colspan="2"><strong>Aksi</strong></td><td colspan="2"><strong>Salin Thnajaran baru</strong></td></tr>';
$nomor =1;
$ta = $this->db->query("select * from guru_rph_ringkas where kodeguru='$kodeguru' and tanggal='$tanggalrphe' order by jamke");
foreach($ta->result() as $a)
	{
	$dinane = tanggal_ke_hari($a->tanggal);
	$tahun1 = substr($thnajaran,0,4);
	$tahun1 = $tahun1+1;
	$kode_rpp = $a->kode_rpp;
	$trpp = $this->db->query("select * from `guru_rpp_induk` where `id_guru_rpp_induk`='$kode_rpp'");
	$rencana ='';
	foreach($trpp->result() as $rpp)
		{
			$rencana = $rpp->rencana;
		}

	echo "<tr><td>".$nomor."</td><td>".$dinane.", ".date_to_long_string($a->tanggal)."</td><td>".$a->jamke."</td><td>".$a->kelas."</td><td>".$a->mapel."</td><td>".$kode_rpp."</td><td>".tanpa_paragraf($rencana)."</td><td>".tanpa_paragraf($a->keterangan)."</td><td>
<a href='".base_url()."guru/ubahrph/".$a->id_rph."' title='Ubah Rencana Pelaksanaan Harian' target='_blank'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."guru/hapusrph2/".$a->id_rph."' onClick=\"return confirm('Anda yakin ingin menghapus data RPH dan BPH ini?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td><td align=\"center\"><a href='".base_url()."guru/ubahrph/".$a->id_rph."/".$tahun1."/1' title='Salin ke Semester 1' target='_blank'>SMT 1</a></td><td align=\"center\"><a href='".base_url()."guru/ubahrph/".$a->id_rph."/".$tahun1."/2' title='Salin ke Semester 2' target='_blank'>SMT 2</a></td></tr>";
	$nomor++;
	}
echo '</table></div>';
if (!empty($paginator))
	{
	?>
	<h5><?php echo $paginator;?></h5>
	<?php 
	}
}
else
{
	echo '<div class="alert alert-info">Belum ada RPH pada tanggal '.date_to_long_string($tanggalrphe).'</div>';
}

}
?>
</div></div></div>
