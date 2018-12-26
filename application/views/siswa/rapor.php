<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 10:00:20 WIB  
// Nama Berkas 		: afektif.php
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
if(($bulan == '06') or ($bulan == '12'))
{
	echo 'Sementara belum bisa diakses';
}
else
{
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
			echo ' <a href="'.base_url().'siswa/rapor/'.substr($a->thnajaran,0,4).'/'.$a->semester.'" class="btn btn-info">'.$a->kelas.' smt '.$a->semester.'</a>';
		}
		else
		{
			echo ' <a href="'.base_url().'siswa/rapor/'.substr($a->thnajaran,0,4).'/'.$a->semester.'" class="btn btn-primary">'.$a->kelas.' smt '.$a->semester.'</a>';
		}
	}
	echo '</p>';
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	echo '<h3>Kurikulum '.$kurikulum.'</h3>';
	$query = $this->db->query("select * from `nilai` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `mapel`");
	$nomor=1;
	$adaq = count($query->result());
	$bisadiunduh = 0;
	if($adaq>0)
	{
		if($kurikulum == '2015')
		{
			?><table class="table table striped table-hover table-bordered">
			<tr align="center"><td><strong>No.</strong></td><td><strong>Mapel</strong></td><td><strong>Pengetahuan</strong></td><td><strong>Keterampilan</strong></td><td><strong>Lulus</strong></td><td><strong>Keterangan</td></tr>
			<?php
		}
		elseif($kurikulum == '2013')
		{?>
			<table class="table table striped table-hover table-bordered">
			<tr align="center"><td><strong>No.</strong></td><td><strong>Mapel</strong></td><td><strong>Pengetahuan</strong></td><td><strong>Keterampilan</strong></td><td><strong>Sikap</strong></td><td><strong>Lulus</strong></td><td><strong>Keterangan</td></tr>
			<?php
		}
		else
		{?>
			<table class="table table striped table-hover table-bordered">
			<tr align="center"><td><strong>No.</strong></td><td><strong>Mapel</strong></td><td><strong>Kognitif</strong></td><td><strong>Psikomotor</strong></td><td><strong>Afektif</strong></td><td><strong>Lulus</strong></td><td><strong>Keterangan</td></tr>
			<?php
		}
		foreach($query->result() as $t)
		{
			$mapel = $t->mapel;
			$ta = $this->db->query("select * from `m_mapel_rapor` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nama_mapel_portal`='$mapel'");
			if($ta->num_rows() > 0)
			{
				if ($t->rapor == 1)
				{
					if($kurikulum == '2015')
					{
						echo "<tr><td align='center'>".$nomor."</td><td>".$t->mapel."</td><td align='center'>".$t->kog."</td><td align='center'>".$t->psi."</td><td>".substr($t->ket_akhir,0,5)."</td><td>".$t->keterangan."</td></tr>";
					}
					else
					{
					echo "<tr><td align='center'>".$nomor."</td><td>".$t->mapel."</td><td align='center'>".$t->kog."</td><td align='center'>".$t->psi."</td><td align='center'>".$t->afektif."</td><td>".substr($t->ket_akhir,0,5)."</td><td>".$t->keterangan."</td></tr>";
					}
				}
				else
				{
					$bisadiunduh++;
					echo "<tr><td align='center'>".$nomor."</td><td>".$t->mapel."</td><td colspan=\"5\">masih dalam proses</td></tr>";
				}
			}
			$nomor++;
		}
		echo '</table>';
	}
	else
	{
		echo '<div class="alert alert-info">Belum Ada Nilai</div>';
	}
	if($bisadiunduh == 0)
	{
	?>
		<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>siswa/unduhrapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/akhir/'.$kurikulum;?>','yes','scrollbars=yes,width=550,height=400')"><button class="btn btn-primary">UNDUH</button></a>
		 <?php echo '<a href="'.base_url().'siswa/cetakrapor/'.substr($thnajaran,0,4).'/'.$semester.'/'.$kurikulum.'" title = "format html  (cocok kalau menggunakan chromium atau google chrome)" target="_blank"><button class="btn btn-info"><span class="glyphicon glyphicon-print"></span></button></a></p>';
	}
}
?>

</div></div></div>

