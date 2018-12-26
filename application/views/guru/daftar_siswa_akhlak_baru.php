<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: status_ketuntasan.php
// Lokasi      		: application/views/guru
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<?php
echo '<h2>Mohon bersabar</h2>';
if($id <= $total_siswa)
{
	$persen = $id/$total_siswa * 100;
	$persen = round($persen);
	$ta = $this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by `no_urut` limit $id,1");
	$nis = '';
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		$no_urut = $a->no_urut;
	}
	$tampilnilai=$this->db->query("select * from nilai_akhlak where thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kodeguru' and nis='$nis'");
	echo $id.' dari '.$total_siswa.' siswa ('.$persen.'%) terproses';
	$adacek = $tampilnilai->num_rows();
	if(empty($nis))
	{$adacek = 1;
	}
	if($adacek==0)
	{
		$this->db->query("INSERT INTO `nilai_akhlak` (`thnajaran`, `semester`, `kelas`, `nis`, `kodeguru`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$kodeguru','$no_urut','Y')");
	}
	if($cacahitem == 1)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 2)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 3)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 4)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 5)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 6)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5', `enam`='6' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 7)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5', `enam`='6', `tujuh`='7' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 8)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5', `enam`='6', `tujuh`='7', `delapan`='8' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 9)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5', `enam`='6', `tujuh`='7', `delapan`='8', `sembilan`='9' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 10)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 11)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 12)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3', `i12`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 13)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3', `i12`='3', `i13`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	elseif($cacahitem == 14)
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3', `i12`='3', `i13`='3', `i14`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	else
	{
		$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3', `i12`='3', `i13`='3', `i14`='3', `i15`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
	}
	$rekap=$this->db->query("select * from `siswa_penilaian_diri_rekap` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	if($rekap->num_rows() == 0)
	{
		$this->db->query("INSERT INTO `siswa_penilaian_diri_rekap` (`thnajaran`, `semester`, `nis`) VALUES ('$thnajaran', '$semester', '$nis')");
	}
	$id++;
	?>
	<script>setTimeout(function () {
	   window.location.href= '<?php echo base_url();?>gurukeren/perbaruidaftarsiswaakhlak/<?php echo $id_m_akhlak;?>/<?php echo $cacahitem;?>/<?php echo $id;?>';
			},1);
			</script>
		<?php
}
else
{
		$persen = 100;
		echo $persen.'% terproses';
		?>
		<h3>tunggu sampai berpindah halaman</h3>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/daftarnilaiakhlak/<?php echo $id_m_akhlak;?>';
		},100);
			</script>
		<?php
}
?>
</div></div></div>
