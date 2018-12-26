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
$pembagine = 5;
$bobot_ujian_tertulis = $this->config->item('bobot_ujian_tertulis') / 100;
$bobot_ujian_praktik = $this->config->item('bobot_ujian_praktik') / 100;

$thnajaran = cari_thnajaran();
$tsiskel = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'XII-%'and `status`='Y'");
$total_siswa = $tsiskel->num_rows();
$tsk =  $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'XII-%' and `status`='Y' limit $id,1");
if($id <= $total_siswa)
{
	$adasiswa = $tsk->num_rows();
	if($adasiswa > 0)
	{
		foreach($tsk->result() as $dsk)
		{
			$nis = $dsk->nis;
			$kelas = $dsk->kelas;
		}
		$persen = $id/$total_siswa * 100;
		$persen = round($persen);
		echo '<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" style="width:'.$persen.'%;">
		'.$id.' dari '.$total_siswa.' siswa ('.$persen.'%) terproses
		</div>
      	</div>';
//	$this->db->query("delete from `rata_rapor` where `nis`='$nis'");
		$ta = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas`='$kelas' order by no_urut ASC");
		foreach($ta->result() as $a)
		{
			$mapel = $a->nama_mapel_portal;
			$no_urut = $a->no_urut;
			if(!empty($mapel))
			{

//				$td = $this->db->query("select avg(`kog`) as rata from `nilai` where nis='$nis' and mapel='$mapel' and `status`='Y' and `rata`='Y'");
//				$pembagi = $td->num_rows();

				$td = $this->db->query("SELECT avg(`t1`.`kog`) as `rata` from `nilai` `t1`, `tahun_penilaian` `t2` where `t2`.`thnajaran`='$thnajaran' and `t1`.`nis`= '$nis' and `t1`.`mapel`='$mapel' and `t1`.`thnajaran`=`t2`.`thnajaran_penilaian` and `t1`.`semester`=`t2`.`semester` and `t1`.`status` = 'Y'");
				$nsem = 0;
				foreach($td->result() as $d)
				{
					$nsem = $d->rata;
				}
				//$this->db->query("insert into `rata_rapor` (`nis`,`mapel`,`nilai`) values ('$nis', '$mapel', '$nijazah')");
				$this->db->query("update `nilai` set `rata_rapor` = '$nsem' where nis='$nis' and mapel='$mapel' and `thnajaran`='$thnajaran' and `semester`='2'");
			}
		}

		
		$id++;
		?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran/ratarapor/<?php echo $id?>';
			},1);
			</script>
		<?php
	}
	else
	{
		$persen = 100;
		echo '<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" style="width:'.$persen.'%;">
		'.$persen.'% terproses
		</div>
	      </div>';
		?>
		<h3>tunggu sampai berpindah halaman</h3>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran';
		},100);
			</script>
		<?php
	}
}
else
{?>
<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran';
		},100);
			</script>
<?php
}
?>
</div></div></div>
