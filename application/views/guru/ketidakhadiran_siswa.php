<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : ketidakhadiran_siswa.php
// Lokasi      : application/views/guru/
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
<div class="container-fluid"><h3>Ketidakhadiran Siswa</h3>
<p><?php echo '<a href="'.base_url().'guru/daftarsiswa/'.$id_walikelas.'" class="btn btn-info"><b>Kembali ke daftar siswa</b></a></p>';?>
<form class="form-horizontal" role="form">
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Siswa</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo nis_ke_nama($nis);?></p></div></div>
</form>

<?php
$tsa = $this->db->query("select * from siswa_absensi where nis='$nis' and thnajaran='$thnajaran' and semester='$semester' order by tanggal");
$ada = $tsa->num_rows();

if ($ada>0)
{
echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Alasan</strong></td><td><strong>Keterangan</strong></td><td><strong>Guru</strong></td></tr>';
		$nomor=1;
		foreach($tsa->result() as $d)
		{
		if ($d->alasan=='S')
			{
			$alasane = 'Sakit';
			}
		if ($d->alasan=='I')
			{
			$alasane = 'Izin';
			}

		if ($d->alasan=='A')
			{
			$alasane = 'Tanpa Keterangan';
			}

		if ($d->alasan=='T')
			{
			$alasane = 'Terlambat';
			}

		if ($d->alasan=='B')
			{
			$alasane = 'Membolos';
			}
		if ($d->alasan=='M')
			{
			$alasane = 'Meninggalkan Sekolah';
			}
		$str = $d->tanggal;	
		$tanggalabsen = date_to_long_string($str);

		echo "<tr><td>".$nomor."</td><td>".$tanggalabsen."</td><td>".$alasane."</td><td>".$d->keterangan."</td><td>".$d->kode_guru."</td></tr>";
		$nomor++;

		}
		
		echo '</table><div>';

}
else{
echo '<div class="alert alert-info">Belum Ada Data / Selalu hadir</div>';
}
?>

</div>
