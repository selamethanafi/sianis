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
if(($ranah == 'KPA') or ($ranah == 'KA') or ($ranah == 'PA'))
{
	
	if($id <= $total_siswa)
	{
		$persen = $id/$total_siswa * 100;
		$persen = round($persen);
		$ta = $this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by `no_urut` limit $id,1");
		$nis = '';
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
		}
		$cek_afektif =  $this->db->query("select * from `afektif` where thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and `mapel`='$mapel' and `nis`='$nis'");
		echo $id.' dari '.$total_siswa.' siswa ('.$persen.'%) terproses';
		$adacek = $cek_afektif->num_rows();
		if(empty($nis))
		{$adacek = 1;
		}
		if($adacek==0)
		{
			$this->db->query("insert into `afektif` (`nis`, `thnajaran`,`semester`,`kelas`,`mapel`,`status`) values ('$nis', '$thnajaran','$semester','$kelas','$mapel','Y')");
		}
		$tap = $this->db->query("select * from aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		foreach($tap->result() as $dap)
		{
			$cacahitem = $dap->np;
			$dapnbaik = $dap->nbaik;
			$dapnmax = $dap->nmax;
			$dapnamat = $dap->namat;
			$dapp1 = $dap->p1;
			$dapp2 = $dap->p2;
			$dapp3 = $dap->p3;
			$dapp4 = $dap->p4;
			$dapp5 = $dap->p5;
			$dapp6 = $dap->p6;
			$dapp7 = $dap->p7;
			$dapp8 = $dap->p8;
			$dapp9 = $dap->p9;
			$dapp10 = $dap->p10;
			$dapp11 = $dap->p11;
			$dapp12 = $dap->p12;
			$dapp13 = $dap->p13;
			$dapp14 = $dap->p14;
			$dapp15 = $dap->p15;
		}
		if(!empty($dapp1))
		{
			$this->db->query("update `afektif` set `p1`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp2))
		{
			$this->db->query("update `afektif` set `p2`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp3))
		{
			$this->db->query("update `afektif` set `p3`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp4))
		{
			$this->db->query("update `afektif` set `p4`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp5))
		{
			$this->db->query("update `afektif` set `p5`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp6))
		{
			$this->db->query("update `afektif` set `p6`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp7))
		{
			$this->db->query("update `afektif` set `p7`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp8))
		{
			$this->db->query("update `afektif` set `p8`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp9))
		{
			$this->db->query("update `afektif` set `p9`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp10))
		{
			$this->db->query("update `afektif` set `p10`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp11))
		{
			$this->db->query("update `afektif` set `p11`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp12))
		{
			$this->db->query("update `afektif` set `p12`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp13))
		{
			$this->db->query("update `afektif` set `p13`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp14))
		{
			$this->db->query("update `afektif` set `p14`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		if(!empty($dapp15))
		{
			$this->db->query("update `afektif` set `p15`='$dapnbaik' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
		}
		$id++;
		?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/perbaruidaftarsiswaafektif/<?php echo $id_mapel?>/<?php echo $id?>';
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
		   window.location.href= '<?php echo base_url();?>guru/daftarnilaiafektif/<?php echo $id_mapel;?>';
		},100);
			</script>
		<?php
	}
}
else
{?>
<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/afektif';
		},100);
			</script>
<?php
}
?>
</div></div></div>
