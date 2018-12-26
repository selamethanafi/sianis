<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: detil_nilai_psikomotor.php
// Lokasi      		: application/views/siswa/
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
$ta = $this->db->query("select * from `nilai` where `kd`='$kd' and `nis`='$nim'");
if($ta->num_rows()>0)
{
	foreach($ta->result() as $t)
	{
		$thnajaran = $t->thnajaran;
		$mapel = $t->mapel;
		$semester = $t->semester;
		$kelas = $t->kelas;
		?>
		<p><a href="<?php echo base_url(); ?>siswa/psikomotor/<?php echo substr($thnajaran,0,4);?>/<?php echo $semester;?>" class="btn btn-primary"><b>Kembali</b></a></p>
		<table class="table table-striped table-hover table-bordered">
		<tr><td width="350"><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
		<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
		<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
		<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
		</table>
		<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
		<tr align="center"><td><strong>No.</strong></td><td><strong>Aspek Penilaian</strong></td><td><strong>Nilai</strong></td>
		</td></tr>
		<?php
		$tap = $this->db->query("select * from aspek_psikomotorik where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		$np = 0;
		foreach($tap->result() as $dap)
		{
			$np = $dap->np;
			$nomor = 0;
			$ratarata=0;
			do
			{
				$item = $nomor+1;	
				$iteme = "p$item";
				$dapitem[$item]= $dap->$iteme;
				$nomor++;
			}
			while ($nomor<$np);
		}
		$tkkm = $this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		$kkm = 0;
		foreach($tkkm->result() as $dkkm)
		{
			$kkm = $dkkm->kkm;
		}
		$nomor = 0;
		$ratarata=0;
		do
		{
			$item = $nomor+1;
			$iteme = "p$item";
			echo '
			<tr><td align="center">'.$item.'</td><td>'.$dapitem[$item].'</td><td align="center">'.$t->$iteme.'</td></tr>';
			$ratarata = $t->$iteme + $ratarata;
			$nomor++;
		}
		while ($nomor<$np);
		if ($np>0)
		{
			$ratarata = round($ratarata / $np,2);
			if ($kkm>0)
			{
				if ($ratarata<$kkm)
				{
					$tuntas = "Belum";
				}
				else
				{
					$tuntas = "Ya";
				}
			}
			else
			{
				$tuntas = "?";
			}
		}
		else
		{$ratarata ='?';
		}
		echo '<tr align="center"><td><strong></strong></td><td><strong>Nilai rata - rata</strong></td><td><strong>'.$ratarata.'</strong></td></tr>';
		echo '<tr align="center"><td><strong></strong></td><td><strong>Ketuntasan / Kelulusan </strong></td><td><strong>'.$tuntas.'</strong></td></tr>';
	}
	?>
	</table></div>
	<?php
}
else
{
	echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
}
?>
</div></div></div>
