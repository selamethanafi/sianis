<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 10:00:20 WIB
// Nama Berkas 		: nilai.php
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
$tanggal = tanggal_hari_ini();
$bulan = bulansaja($tanggal);

echo '<p>';

$kelas = '';
$tb = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester'");
foreach($tb->result() as $b)
{
	$kelas = $b->kelas;
}
$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by thnajaran DESC, semester DESC");
foreach($ta->result() as $a)
{
	if(($thnajaran == $a->thnajaran) and ($semester == $a->semester) and ($kelas == $a->kelas))
	{
		echo ' <a href="'.base_url().'siswa/nilai/'.substr($a->thnajaran,0,4).'/'.$a->semester.'" class="btn btn-info">'.$a->kelas.' smt '.$a->semester.'</a>';
	}
	else
	{
		echo ' <a href="'.base_url().'siswa/nilai/'.substr($a->thnajaran,0,4).'/'.$a->semester.'" class="btn btn-primary">'.$a->kelas.' smt '.$a->semester.'</a>';

	}
}
echo '</p>';
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
echo '<h3>Kurikulum '.$kurikulum.'</h3>';
$query = $this->db->query("select * from `nilai` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `mapel`");
$adaq = $query->num_rows();
$nomor=1;
if($adaq>0)
{
	?>
	<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td><strong>No.</strong></td><td><strong>Mapel</strong></td><td><strong>UH1</strong></td><td><strong>UH2</strong></td><td><strong>UH3</strong></td><td><strong>UH4</strong></td><td><strong>KU1</strong></td><td><strong>KU2</strong></td><td><strong>TU1</strong></td><td><strong>TU2</strong></td><td><strong>TU3</strong></td><td><strong>MID</strong></td><td><strong>SMT</strong></td>
	<?php
	if(($bulan == '06') or ($bulan == '12'))
	{
		echo '</tr>';
	}
	else
	{
	echo '<td><strong>NA</strong></td></tr>';
	}
	foreach($query->result() as $t)
	{
		$mapel = $t->mapel;
		$ta = $this->db->query("select * from `m_mapel_rapor` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nama_mapel_portal`='$mapel'");
		if($ta->num_rows() > 0)
		{
			echo "<tr><td align='center'>".$nomor."</td><td>".$t->mapel."</td><td align=\"center\">".$t->nilai_uh1."</td><td align=\"center\">".$t->nilai_uh2."</td><td align=\"center\">".$t->nilai_uh3."</td><td align=\"center\">".$t->nilai_uh4."</td><td align=\"center\">".$t->nilai_ku1."</td><td align=\"center\">".$t->nilai_ku2."</td><td align=\"center\">".$t->nilai_tu1."</td><td align=\"center\">".$t->nilai_tu2."</td><td align=\"center\">".$t->nilai_tu3."</td><td align=\"center\">".$t->nilai_mid."</td><td align=\"center\">".$t->nilai_uas."</td>";
			if(($bulan == '06') or ($bulan == '12'))
			{
				echo '</tr>';
			}
			else
			{
				echo "<td align=\"center\">".$t->nilai_na."</td></tr>";
			}
			$nomor++;	
		}
	}
	echo '</table>';
}
else
{
	echo '<div class="alert alert-info">Belum Ada Nilai</div>';
}
?>
</table>
</div></div></div>
