<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : daftar_nilai.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
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
<p><a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>" class="btn btn-info"><b> Kembali</b></a></p>
<form class="form-horizontal" role="form">
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $thnajaran;?></p></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Semester</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $semester;?></p></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Kelas</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $kelas;?></p></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $mapel;?></p></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Ranah Penilaian</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $ranah;?></p></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">KKM / Cacah Ulangan Harian / Cacah Tugas</label></div><div class="col-sm-7"><p class="form-control-static"><strong><?php echo $kkm;?> </strong> / <strong><?php echo $cacah_ulangan_harian;?></strong> / <strong><?php echo $cacah_tugas;?></strong></p></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Bobot Ulangan Harian / Bobot Tugas / Mid / Semester</label></div><div class="col-sm-7"><p class="form-control-static"><strong><?php echo $nbobot_ulangan_harian;?>% </strong> / <strong><?php echo $nbobot_tugas;?>%</strong> / <strong><?php echo $nbobot_mid;?>%</strong> / <strong><?php echo $nbobot_semester;?>%</strong></p></div></div>
</form>
<?php
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' order by `no_urut`");
$nomor=1;
echo form_open('guru/perbaruidaftarsiswa','class="form-horizontal" role="form"');
echo '<table class="table table striped table-hover table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><p class="text-info">Centang untuk Menambah, kosongkan untuk menghapus</p></td></tr>';
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$namasiswa = nis_ke_nama($nis);
	$no_urut = $a->no_urut;
	$tf = $this->db->query("select * from `nilai_pilihan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `status`='Y' and `nis`='$nis'");
	$ada = count($tf->result());
	echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.$namasiswa.'</td><td>';
	if ($ada == 0)
					{
					echo form_checkbox('pilihan_'.$nomor, '1', FALSE);
					}
					else
					{
					echo form_checkbox('pilihan_'.$nomor, '1', TRUE);
					}
	echo '<input type="hidden" name="nis_'.$nomor.'" value="'.$nis.'">';
	echo '<input type="hidden" name="no_urut_'.$nomor.'" value="'.$no_urut.'">';
	echo '</td></tr>';
	$nomor++;
}
echo '</table>';
$cacahsiswa = $nomor - 1;
echo '<input type="hidden" name="id_mapel" value="'.$id_mapel.'">
<input type="hidden" name="mapel" value="'.$mapel.'">
<input type="hidden" name="kelas" value="'.$kelas.'">
<input type="hidden" name="thnajaran" value="'.$thnajaran.'">
<input type="hidden" name="semester" value="'.$semester.'">
<input type="hidden" name="kd_mapel" value="'.$kd_mapel.'">
<input type="hidden" name="pilihan" value="1">
<input type="hidden" name="kkm" value="'.$kkm.'"><input type="hidden" name="cacah_siswa" value="'.$cacahsiswa.'">
<p class="text-center"><input type="submit" value="Simpan Daftar Siswa" class="btn btn-primary"></p></form>';
?>
</div></div></div>

