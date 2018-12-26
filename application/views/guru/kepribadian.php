<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: kepribadian.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo '<p><a href="'.base_url().'guru/walikelas" class="btn btn-info"><b>Kembali ke daftar Tugas Walikelas</b></a></p>';?>

<table>
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
</table>
<?php
if(!empty($nis))
{
			$satu = '';
			$satu = '';
			$dua = '';
			$tiga = '';
			$empat = '';
			$lima = '';
			$enam = '';
			$tujuh = '';
			$delapan = '';
			$sembilan = '';
			$sepuluh = '';
	//cari nilai akhlak
	$tn = $this->db->query("select * from `kepribadian` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester'");
	foreach($tn->result() as $n)
	{
			$satu = $n->satu;
			$dua = $n->dua;
			$tiga = $n->tiga;
			$empat = $n->empat;
			$lima = $n->lima;
			$enam = $n->enam;
			$tujuh = $n->tujuh;
			$delapan = $n->delapan;
			$sembilan = $n->sembilan;
			$sepuluh = $n->sepuluh;

	}
echo form_open('guru/kepribadian/'.$id_walikelas.'');
echo '<table>
<tr><td width="350"><strong>Nama</strong></td><td>: <strong>'.nis_ke_nama($nis).'</strong></td></tr>
<tr><td><strong>Kedisiplinan</strong></td><td>: <select name="satu" class="textfield-option"><option value="'.$satu.'">'.$satu.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Kebersihan</strong></td><td>: <select name="dua" class="textfield-option"><option value="'.$dua.'">'.$dua.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Kesehatan</strong></td><td>: <select name="tiga" class="textfield-option"><option value="'.$tiga.'">'.$tiga.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Tanggung jawab</strong></td><td>: <select name="empat" class="textfield-option"><option value="'.$empat.'">'.$empat.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Sopan santun</strong></td><td>: <select name="lima" class="textfield-option"><option value="'.$lima.'">'.$lima.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Percaya diri</strong></td><td>: <select name="enam" class="textfield-option"><option value="'.$enam.'">'.$enam.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Kompetitif</strong></td><td>: <select name="tujuh" class="textfield-option"><option value="'.$tujuh.'">'.$tujuh.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Hubungan Sosial</strong></td><td>: <select name="delapan" class="textfield-option"><option value="'.$delapan.'">'.$delapan.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Kejujuran</strong></td><td>: <select name="sembilan" class="textfield-option"><option value="'.$sembilan.'">'.$sembilan.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Ibadah ritual</strong></td><td>: <select name="sepuluh" class="textfield-option"><option value="'.$sepuluh.'">'.$sepuluh.'</option><option value="Amat Baik">Amat Baik</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></td></tr>
<tr><td><strong>Kunci</strong></td><td>: <select name="status" class="textfield-option"><option value="Ya">Ya</option><option value="">Tidak</option></select></td></tr>
<tr><tr><td></td><td><input type="hidden" name="proses" value="overide"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><input type="hidden" name="semester" value="'.$semester.'"><input type="hidden" name="nis" value="'.$nis.'">
<input type="submit" value="Simpan Nilai" class="tombol-merah"></td></tr></table>';
}
else
{
	$nomor=1;
	if(count($data_kehadiran->result())>0)
	{
	?>
		<div class="alert alert-info">Untuk mengubah nilai, klik nomor urut siswa. Beritahu BP sudaya TIDAK mengirim nilai akhlak mulia dan kepribadian</div>
		<table class="table table-striped table-hover table-bordered">
		<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Kedisiplinan</strong></td><td><strong>Kebersihan</strong></td><td><strong>Kesehatan</strong></td><td><strong>Tanggung jawab</strong></td><td><strong>Sopan santun</strong></td><td><strong>Percaya diri</strong></td><td><strong>Kompetitif</strong></td><td><strong>Hubungan Sosial</strong></td><td><strong>Kejujuran</strong></td><td><strong>Ibadah ritual</strong></td></tr>
		<?php
		foreach($data_kehadiran->result() as $b)
		{
			echo "<tr><td align=\"center\"><a href='".base_url()."guru/kepribadian/".$id_walikelas."/".$b->nis."' class=\"btn btn-primary\">".$nomor."</a></td><td>".nis_ke_nama($b->nis)."</td><td>".$b->satu.". ".$b->kom1."</td><td>".$b->dua.". ".$b->kom2."</td><td>".$b->tiga.". ".$b->kom3."</td><td>".$b->empat.". ".$b->kom4."</td><td>".$b->lima.". ".$b->kom5."</td><td>".$b->enam."".$b->kom6."</td><td>".$b->tujuh.". ".$b->kom7."</td><td>".$b->delapan.". ".$b->kom8."</td><td>".$b->sembilan.". ".$b->kom9."</td><td>".$b->sepuluh.". ".$b->kom10."</td></tr>";
		$nomor++;
		}
		echo '</table>';
	}
	else
	{
	echo '<div class="alert alert-warning">Belum ada data kepribadian, silakan hubungi BP</div>';
	}
}
?>
</div></div></div>
