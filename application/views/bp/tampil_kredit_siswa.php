<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: tampil_kredit_siswa.php
// Lokasi      		: application/views/bp
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
<div class="container-fluid"><h3>Daftar Kredit Pelanggaran Siswa <?php echo nis_ke_nama($nis);?></h3>
<p><a href="<?php echo base_url(); ?>bp/carisiswa" class="btn btn-info"><strong>Siswa Lain</strong></a></p>
<?php
$ta = $this->db->query("select * from `siswa_kelas` where `nis` = '$nis' order by `thnajaran`");
$thnajarane = '';
foreach($ta->result() as $a)
{
	$thnajaran = $a->thnajaran;
	$kelas = $a->kelas;
	if($thnajarane != $thnajaran)
	{
		$thnajarane = $thnajaran;
	$query = $this->db->query("select * from `siswa_kredit` where `nis`='$nis' and `thnajaran`='$thnajaran'");
?>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered"><tr><td><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Kode<br>Pelanggaran</strong></td><td><strong>Pelanggaran</strong><td><strong>Point</strong><td><strong>Kode Guru</strong></td><td><strong>Hapus</strong></td></tr>
		<?php
		$nomor=1;
		$jml=0;
		foreach($query->result() as $ba)
		{
	$nis = $ba->nis;
	$str = $ba->tanggal;	
	$tanggalabsen = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$kode = $ba->kd_pelanggaran;
	$namasiswa = nis_ke_nama($nis);
	$tkred = $this->db->query("select * from m_kredit where kode = '$kode'");
	$namapelanggaran ='';
	foreach($tkred->result() as $dkred)
		{
		$namapelanggaran = $dkred->nama_pelanggaran;
		}
	$jml = $jml + $ba->point;
		echo "<tr><td>".$nomor."</td><td>".$tanggalabsen."</td><td>".$namasiswa."</td><td>".$kelas."</td><td>".$kode."</td><td>".$namapelanggaran."</td><td>".$ba->point."</td><td>".$ba->kodeguru."</td><td><a href='".base_url()."bp/hapuskredit/".$ba->id_siswa_kredit."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus kredit pelanggaran Siswa'><span class='fa fa-trash-alt'></span></a></td></tr>";
		$nomor++;
		}
		echo '</table></div>';
echo '<p>Jumlah Kredit : <button class="btn btn-danger">'.$jml.'</button></p>';
	}
}
?>
</div>
