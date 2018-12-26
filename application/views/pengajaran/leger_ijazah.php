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
if($id == 0)
{
	$this->db->query("delete from `leger_ijazah` where `thnajaran`='$thnajaran'");
}
echo '<h2>Mohon bersabar</h2>';
if($id <= $total_siswa)
{
	$persen = $id/$total_siswa * 100;
	$persen = round($persen);
	echo '<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" style="width:'.$persen.'%;">
		'.$id.' dari '.$total_siswa.' siswa ('.$persen.'%) terproses
		</div>
	      </div>';
	//echo 'Persentase '.$persen;
	$ta = $this->db->query("select * from siswa_kelas where `thnajaran`='$thnajaran' and `kelas` like 'XII-%' and status='Y' and `semester`='2' order by `nis` ASC limit $id,1");
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		$kelas = $a->kelas;
		$jurusan = $this->helper->kelas_jadi_program($kelas);
		$kurikulum = $this->helper->cari_kurikulum($thnajaran,'2',$kelas);

		$this->db->query("insert into `leger_ijazah` (`nis`, `thnajaran`) values ('$nis','$thnajaran')");
		$tb = $this->db->query("select * from `m_mapel_ijazah` where thnajaran='$thnajaran' and `jurusan`='$jurusan' order by `no_urut`");
		foreach($tb->result() as $b)
		{
			$mapel = $b->mapel;
			$pembagi = $b->cacah_semester;
			$no_urut = $b->no_urut;
			$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
			$nilai = 0;
			foreach($tc->result() as $c)
			{
				$thnajaranx = $c->thnajaran_penilaian;
				$semesterx = $c->semester;
				$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx'");			
				foreach($td->result() as $d)
				{
					if (($mapel == 'Seni Budaya') and ($kurikulum == 'KTSP'))
					{
						$nilai = $nilai + $d->psi;
					}
					else
					{
						$nilai = $nilai + $d->kog;
					}
				}

			}
			$nilai = $nilai / $pembagi;
			$nilai = round($nilai,2);
			$field = 'r'.$no_urut;
			$this->db->query("update `leger_ijazah` set `$field`='$nilai' where `thnajaran`='$thnajaran' and `nis`='$nis'");
			
		}
	}
	$id++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran/legerijazah/<?php echo $tahun1;?>/<?php echo $tahun2;?>/<?php echo $id;?>';
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
		   window.location.href= '<?php echo base_url();?>pengajaran/tampillegerijazah/<?php echo $thnajaran;?>';
		},1000);
			</script>
	<?php
}
?>
</div></div></div>
