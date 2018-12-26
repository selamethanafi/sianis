<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: proses_nomor_tes.php
// Lokasi      		: application/views/panitiates/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
if($format == '1')
{
	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `no_urut`");
	$nomortes = 1;
	$nomor_unik = 8;
	$kodedepan = $this->config->item('kode_un_kab');
	$kodedepan .= '-'.$this->config->item('kode_un_sekolah');
	foreach($ta->result() as $a)
	{
		$kelas = $a->kelas;
		$truang = $this->db->query("select * from m_ruang where `ruang`='$kelas'");
		foreach($truang->result_array() as $druang)
		{
			$ruang = $druang['ruang'];
			$kdruang1 = $druang['ruang_tes_satu'];
			$kdruang2 = $druang['ruang_tes_dua'];
			$nomor = $druang['no_tengah'];	
			$tsiskelx = $this->db->query("select * from siswa_kelas where status='Y' and thnajaran='$thnajaran' and `semester`='$semester' and kelas='$kelas' order by no_urut ASC");
			$adasiswa = $tsiskelx->num_rows();
			$noperkelas = 1;
			if ($adasiswa>0)
			{
				foreach($tsiskelx->result_array() as $dsiskelx)
				{
					$nis = $dsiskelx['nis'];
					if ($nomortes < 10)
					{
						$xnomor = $kodedepan.'-00'.$nomortes;
					}
					elseif ($nomortes < 100)
					{
						$xnomor = $kodedepan.'-0'.$nomortes;
					}
					else
					{
						$xnomor = $kodedepan.'-'.$nomortes;
					}

					if ($noperkelas > $nomor)
						{$ruangsiswa = $kdruang2;}
						else
						{$ruangsiswa = $kdruang1;}
					$this->db->query("INSERT INTO `siswa_nomor_tes` (`nis`,`no_peserta`,`kelas`,`ruang`,`no_unik`) VALUES ('$nis','$xnomor','$ruang','$ruangsiswa','$nomor_unik')");
					$nomor_unik = $nomor_unik - 1;
					if($nomor_unik < 2)
					{
						$nomor_unik = 9;
					}

					$noperkelas++;
					$nomortes++;
				}
			}
			$noperkelas = 1;		
		}
	}
}
else
{
$ttingkat = $this->db->query("select * from m_kelas order by kelas ASC");
foreach($ttingkat ->result_array() as $dtingkat)
{
	$nomortes=1;
	$tingkat = $dtingkat['kelas'];
	$truang = $this->db->query("select * from m_ruang where tingkat='$tingkat' order by ruang ASC");
	if ($tingkat=='X')
		{$kelase='1';}
	if ($tingkat=='XI')
		{$kelase='2';}
	if ($tingkat=='XII')
		{$kelase='3';}
	$kodedepan = $kelase;
	foreach($truang->result_array() as $druang)
	{
		$ruang = $druang['ruang'];
		$kdruang1 = $druang['ruang_tes_satu'];
		$kdruang2 = $druang['ruang_tes_dua'];
		$nomor = $druang['no_tengah'];	
		$tsiskelx = $this->db->query("select * from siswa_kelas where status='Y' and thnajaran='$thnajaran' and `semester`='$semester' and kelas='$ruang' order by no_urut ASC");
			$adasiswa = $tsiskelx->num_rows();
			$noperkelas = 1;
			if ($adasiswa>0)
			{
				foreach($tsiskelx->result_array() as $dsiskelx)
				{
					$nis = $dsiskelx['nis'];
					if ($nomortes < 10)
					{
						$xnomor = ''.$kodedepan.'00'.$nomortes.'';
					}
					else if ($nomortes < 100)
					{
						$xnomor = ''.$kodedepan.'0'.$nomortes.'';
					}
					else
					{
						$xnomor = ''.$kodedepan.''.$nomortes.'';
					}
					if ($noperkelas > $nomor)
						{$ruangsiswa = $kdruang2;}
						else
						{$ruangsiswa = $kdruang1;}
			$this->db->query("INSERT INTO `siswa_nomor_tes` (`nis`,`no_peserta`,`kelas`,`ruang`) VALUES ('$nis','$xnomor','$ruang','$ruangsiswa')");
				$noperkelas++;
				$nomortes++;
				}
			}
			$noperkelas = 1;		

	}

}
}
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<div class="alert alert-success">Berhasil, lanjut mengatur tempat duduk <a href="<?php echo base_url();?>panitiates/denahtempatduduk" class="btn btn-info">di sini</a></div>
</div></div></di>
