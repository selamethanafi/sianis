<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_ijazah.php
// Lokasi      		: application/views/pengajaran/
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
//echo 'Total '.$total_siswa.'<br />';
echo '<h2>Mohon bersabar</h2>';
if($id <= $total_siswa)
{
	$persen = $id/$total_siswa * 100;
	$persen = round($persen);
	echo '<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" style="width:'.$persen.'%;">
		'.$persen.'% terproses
		</div>
	      </div>';
	//echo 'Persentase '.$persen;
	$ta = $this->db->query("select * from siswa_kelas where `thnajaran`='$thnajaran' and `kelas` = '$kelas' and `semester`='$semester' and status='Y' order by `nis` ASC limit $id,1");
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;

		$tb = $this->db->query("select * from `m_mapel_emiss` where thnajaran='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
		foreach($tb->result() as $b)
		{
			$mapel = $b->mapel;
			$no_urut = $b->no_urut;
			$tc = $this->db->query("select * from `m_mapel` where mapel='$mapel' and thnajaran = '$thnajaran' and semester='$semester' and `kelas`='$kelas'");
			if($mapel == 'MAPEL KOSONG')
			{
				$kkm = '';
				$kog = '';
				$psi = '';
				$afe = '';

			}
			else
			{
				$kkm = '?';
				$kog = '?';
				$psi = '?';
				$afe = '?';

			}

			foreach($tc->result() as $c)
			{
				$kkm = $c->kkm;

			}
			$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaran' and semester='$semester'");
			foreach($td->result() as $d)
			{
				$kog = $d->kog;
				$psi = $d->psi;
				$afe = $d->afektif;
			}
			$fkog = 'k'.$no_urut;
			$fpsi = 'p'.$no_urut;
			$fafe = 's'.$no_urut;
			$fkkm = 'l'.$no_urut;
			$this->db->query("update `leger_nilai` set `$fkkm`='$kkm' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");

			$this->db->query("update `leger_nilai` set `$fkog`='$kog' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
			$this->db->query("update `leger_nilai` set `$fpsi`='$psi' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
			$this->db->query("update `leger_nilai` set `$fafe`='$afe' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
			
		}
	}
	$id++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>tatausaha/legernilai/<?php echo $tahun1."/".$semester."/".$id_walikelas."/".$id;?>';
		},5);
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
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>tatausaha/mapelemiss/<?php echo $tahun1."/".$semester."/".$id_walikelas."/".$id;?>';
		},1000);
			</script>
	<?php
}
?>
</div></div></div>
