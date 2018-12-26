<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
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
<?php
$xloc = base_url().'guru/daftarsiswa';
?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$siswa = $aksi;
if(empty($siswa))
{
	$siswa = 0;
}
if($siswa == 0)
{
	$this->db->query("delete from siswa_peringkat where thnajaran ='$thnajaran' and kelas='$kelas' and semester='$semester'");

}
$tsiskel = $this->db->query("select * from siswa_kelas where thnajaran ='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' ");
$cacahsiswa = $tsiskel->num_rows();
$persensiswa = $siswa/$cacahsiswa * 100;
				echo '<div class="progress">
				<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:'.round($persensiswa,0).'%;">
				siswa ke-'.$siswa.' dari '.$cacahsiswa.' ('.round($persensiswa,0).'%) terproses
				</div>
			      </div><br />';
$tsiskel = $this->db->query("select * from siswa_kelas where thnajaran ='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by `nis` limit $siswa,1");
	$tingkat = kelas_jadi_tingkat($kelas);
	$program = kelas_jadi_program($kelas);

foreach($tsiskel->result() as $b)
{
	$nis=$b->nis;
	//jumlah nilai
	$kog = 0;
	$psi = 0;
	$tnilai = $this->db->query("select * from nilai where thnajaran ='$thnajaran' and semester='$semester' and nis='$nis'");
	foreach($tnilai->result() as $c)
	{		
		$kog = $kog + $c->kog;
		$psi = $psi + $c->psi;
		$kunci = $c->kunci;
		if($kunci != 1)
		{
			die('Belum terkunci <a href="'.base_url().'guru/walikelas"><b>Kembali ke daftar Tugas Walikelas</b></a>');
		}
	}
	$jml = $kog + $psi;
	$this->db->query("insert into siswa_peringkat (`thnajaran`, `semester`, `tingkat`, `program`, `kelas`, `nis`, `jumlah_kognitif`, `jumlah_psikomotor`,`jumlah`) values ('$thnajaran', '$semester', '$tingkat','$program','$kelas','$nis','$kog','$psi','$jml')");
	$siswa++;
?>
	<script>setTimeout(function () {
				  window.location.href= '<?php echo base_url();?>guru/daftarsiswa/<?php echo $id_walikelas;?>/peringkat/<?php echo $siswa;?>';
						},10);
	</script>
	<?php

}
if($siswa>=$cacahsiswa)
{
?>
	<script>setTimeout(function () {
				  window.location.href= '<?php echo base_url();?>guru/daftarsiswa/<?php echo $id_walikelas;?>/peringkatlanjut';
						},10);
	</script>
	<?php
}
?>
</div></div></div>
