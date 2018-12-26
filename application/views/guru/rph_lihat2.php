<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lihat_rph.php
// Lokasi      : application/views/guru/
// Author: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><?php echo '<a href="'.base_url().'guru/rph2" class="btn btn-info"><b>Tampil Semua RPH</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphlain2" class="btn btn-info"><b>Tambah, Ubah RPH</b></a></p>';
if ( (!empty($thnajaran)) or (!empty($semester)) or (!empty($kelas)) or (!empty($kodeguru)) or (!empty($mapel)) or (!empty($tanggalrph)))
{
?>
<div class="form-group row row">
	<div class="col-sm-3">
		<label class="control-label">Tahun Pelajaran</label>
	</div>
	<div class="col-sm-9"><?php echo $thnajaran;?></div>
</div>
<div class="form-group row row">
	<div class="col-sm-3">
		<label class="control-label">Semester</label>
	</div>
	<div class="col-sm-9"><?php echo $semester;?></div>
</div>
<?php
echo '<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Jam Ke-</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong></td><td><strong>Kode RPP</strong></td><td><strong>Rencana</strong></td><td><strong>Keterangan</strong></td><td colspan="2"><strong>Aksi</div></div>';
$nomor =1;
$ta = $this->db->query("select * from guru_rph_ringkas where thnajaran ='$thnajaran' and semester='$semester' and kodeguru='$kodeguru' and kelas='$kelas' and mapel='$mapel' and tanggal='$tanggalrph'");
foreach($ta->result() as $a)
	{
	$dinane = tanggal_ke_hari($a->tanggal);
	$kode_rpp = $a->kode_rpp;
	$trpp = $this->db->query("select * from `guru_rpp_induk` where `id_guru_rpp_induk`='$kode_rpp'");
	$rencana ='';
	foreach($trpp->result() as $rpp)
		{
		$rencana = tanpa_tabel($rpp->rencana);
		}
	echo "<tr valign=\"top\"><td>".$nomor."</td><td>".$dinane.", ".date_to_long_string($a->tanggal)."</td><td>".$a->jamke."</td><td>".$a->kelas."</td><td>".$a->mapel."</td><td><b>".tanpa_paragraf($a->kode_rpp)."</b></td><td>".tanpa_paragraf($rencana)."</td><td>".tanpa_paragraf($a->keterangan)."</td><td>
<a href='".base_url()."guru/ubahrph/".$a->id_rph."' title='Ubah Rencana Pelaksanaan Harian'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."guru/hapusrph2/".$a->id_rph."' onClick=\"return confirm('Anda yakin ingin menghapus data RPH dan BPH ini?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
	$nomor++;
	}
echo '</table>';
}
?>
</div></div></div>
