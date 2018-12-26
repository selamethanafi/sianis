<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kredit_pelanggaran.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h3>Data Pelanggaran Tata Tertib</h3>
<p><?php echo '<a href="'.base_url().'guru/daftarsiswa/'.$id_walikelas.'" class="btn btn-info"><b>Kembali ke daftar siswa</b></a></p>';?>
<form class="form-horizontal" role="form">
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Siswa</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo nis_ke_nama($nis);?></p></div></div></form>
<?php
if (!empty($id_pemberitahuan))
{
	echo form_open('guru/simpanpenanganan','class="form-horizontal" role="form"');
	$diproses = 0;
	$ta = $this->db->query("select * from `pemberitahuan` where `id`= '$id_pemberitahuan'");
	if(count($ta->result())>0)
	{
		foreach($ta->result() as $a)
		{
			echo '
			<div class="form-group row row">
				<div class="col-sm-3"><label class="control-label">Penanganan ke -</label></div>
				<div class="col-sm-9"><p class="form-control-static"><strong>'.$a->ke.'</strong></p></div>
			</div>
			<div class="form-group row row"><div class="col-sm-12"><label class="control-label"><strong>Tindakan</strong></label></div></div>';

			echo '<div class="form-group row row"><div class="col-sm-12"><textarea name="isi_berita" rows="10" class="form-control">'.$a->tindakan_walikelas.'</textarea></div></div><p class="text-center"><input type="hidden" name="nis" value="'.$nis.'"><input type="hidden" name="id_walikelas" value="'.$id_walikelas.'"><input type="hidden" name="id_pemberitahuan" value="'.$id_pemberitahuan.'"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().'guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/2" class="btn btn-info">Batal</a></p>';
		}
	}
	else
	{
		echo '<div class="alert alert-warning"><strong>Penanganan tidak diketahui atau data telah hilang</strong>, <a href="'.base_url().'guru/detilsiswa/'.$nis.'/'.$id_walikelas.'/2">Batal</a></div>';
	}
			echo '</form>';
}
else
{
	$tsa = $this->db->query("select * from siswa_kredit where nis='$nis' and thnajaran='$thnajaran' and semester='$semester' order by tanggal");
	$ada = count($tsa->result());
	if ($ada>0)
	{
		$jmlpoin = 0;
		echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Pelanggaran</strong></td><td><strong>Nilai</strong></td><td><strong>Petugas</strong></td></tr>';
		$nomor=1;
		foreach($tsa->result() as $d)
		{
			$str = $d->tanggal;	
			$tanggalabsen = date_to_long_string($str);
			$namapelanggaran = kode_ke_pelanggaran($d->kd_pelanggaran);
			echo "<tr><td align=\"center\">".$nomor."</td><td>".$tanggalabsen."</td><td>".$namapelanggaran."</td><td align=\"center\">".$d->point."</td><td align=\"center\">".$d->kodeguru."</td></tr>";
			$jmlpoin = $jmlpoin + $d->point;
			$nomor++;
		}
		echo "<tr><td colspan=\"3\" align=\"center\">Jumlah Nilai Pelanggaran</td><td align=\"center\">".$jmlpoin."</td><td></td></tr>";
		$remisi = remisi($nis);
		echo "<tr><td colspan=\"3\" align=\"center\">Pengurangan Nilai Pelanggaran</td><td align=\"center\">".$remisi."</td><td></td></tr>";
		$poin = $jmlpoin - $remisi;
		echo "<tr><td colspan=\"3\" align=\"center\">Jumlah Akhir Nilai Pelanggaran </td><td align=\"center\">".$poin."</td><td></td></tr>";
		echo '</table>';
		//penanganan
		$tb = $this->db->query("select * from `pemberitahuan` where `thnajaran`='$thnajaran' and `nis`='$nis'");
		echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Penanganan Ke-</strong></td><td><strong>Saran / Tindakan Wali</strong></td><td><strong>Saran / Tindakan BP</strong></td><td><strong>Saran / Tindakan Kesiswaan</strong></td><td><strong>Aksi</strong></td></tr>';
		$nomor=1;
		foreach($tb->result() as $b)
		{
			echo "<tr><td align=\"center\">".$nomor."</td><td>".$b->ke."</td><td>".$b->tindakan_walikelas."</td><td align=\"center\">".$b->tindakan_bp."</td><td align=\"center\">".$b->tindakan_kesiswaan."</td><td align=\"center\"><a href='".base_url()."guru/detilsiswa/".$b->nis."/".$id_walikelas."/2/".$b->id."' title='Penanganan Akumulasi Pelanggaran'><span class=\"fa fa-bullseye\"></a></td></tr>";
			$nomor++;
		}
		echo '</table>';
	}
	else
	{
		echo "Belum Ada Data / Selalu tertib";
	}
}
?>


</div>


