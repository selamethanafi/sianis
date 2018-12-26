<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2018 12:23:28 WIB 
// Nama Berkas 		: ard_login.php
// Lokasi      		: application/views/ard/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
if($hal == 'umum')
{
	$judulhalaman = 'Kirim data guru ke ARD';
	?>
	<div class="container-fluid">
	<div class="card">
		<div class="card-header"><h3><?php echo $judulhalaman;?> <small>masih dalam percobaan</small></h3></div>
		<div class="card-body">
		<iframe src="<?php echo base_url().'tatausaha/umumard/'.$kd;?>" width="100%" height="600"></iframe>
<?php
}
if($hal == 'tanggapanwalikelas')
{
	$judulhalaman = 'Kirim Rapor Walikelas ke ARD';
	?>
	<div class="container-fluid">
	<div class="card">
		<div class="card-header"><h3><?php echo $judulhalaman;?> <small>masih dalam percobaan</small></h3></div>
		<div class="card-body">
		<?php
		$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
		$cacahsiswa = $query->num_rows();
		$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut` limit $nomor,1 ");
		$cacahsiswa = $cacahsiswa - 1;
		$next = $nomor+1;
		$prev = $nomor - 1;
		foreach($query->result() as $t)
		{
			$nis = $t->nis;
			$tb = $this->db->query("select `nis`,`id_ard_siswa` from `datsis` where `nis`='$nis'");
			foreach($tb->result() as $b)
			{
				$student_id = $b->id_ard_siswa;
			}
			$namasiswa = nis_ke_nama($nis);
		}

		if($nomor == 0)
		{
			//selanjutnya
			echo '<p class="text-center"><a href="'.base_url().'guruard/ard/tanggapanwalikelas/'.$id_walikelas.'/'.$next.'" class="btn btn-primary">Selanjutnya</a></p>';
		}
		elseif(($nomor < $cacahsiswa) and ($nomor > 0))
		{
			echo '<p class="text-center"><a href="'.base_url().'guruard/ard/tanggapanwalikelas/'.$id_walikelas.'/'.$prev.'" class="btn btn-primary">Sebelumnya</a> <a href="'.base_url().'guruard/ard/tanggapanwalikelas/'.$id_walikelas.'/'.$next.'" class="btn btn-info">Selanjutnya</a></p>';
		}
		elseif($nomor == $cacahsiswa)
		{
			echo '<p class="text-center"><a href="'.base_url().'guruard/ard/tanggapanwalikelas/'.$id_walikelas.'/'.$prev.'" class="btn btn-primary">Sebelumnya</a></p>';
		}
		else
		{
		}
		?>
		<iframe src="<?php echo $url_ard.'/ma/guru/wali_kelas_siswa?student_report=student_report&student_id='.$student_id;?>" width="100%" height="200"></iframe>
		<iframe src="<?php echo base_url().'guruard/tanggapanwalikelas/'.$id_walikelas.'/'.$nomor;?>" width="100%" height="200"></iframe>
<?php
}?>
</div></div></div>
