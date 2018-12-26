<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: daftar_nilai_ekstrakurikuler.php
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
?><div class="container-fluid"><div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$tekstra = $this->db->query("select * from m_pengampu_ekstra where id_pengampu_ekstra='$id_pengampu_ekstra'");
foreach($tekstra->result() as $dekstra)
	{
	$mapel = $dekstra->namaekstra;
	$thnajaran = $dekstra->thnajaran;
	$semester = $dekstra->semester;
	$kelas = $dekstra->kelas;
	$wajib = $dekstra->wajib;
	}
$wajib = 0;
$thn1 = substr($thnajaran,0,4);
?>
<?php echo form_open('guru/ekstrakurikuler/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra, 'class="form-horizontal" role="form"');
if ($proses == 'oke')
	{
	$ta = $this->db->query("select * from ekstrakurikuler where thnajaran='$thnajaran' and semester='$semester' and nama_ekstra='$mapel' and `nis`='$nis'");
	$kelas_siswa = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	if(count($ta->result())==0)
		{
		$this->db->query("insert into `ekstrakurikuler` (`thnajaran`,`semester`,`nama_ekstra`,`kelas`,`nis`,`nilai`,`keterangan`,`status`) values ('$thnajaran','$semester','$mapel','$kelas_siswa','$nis','$nilai','$keterangan','Y')");
		}
		else
		{
		$this->db->query("update `ekstrakurikuler` set `kelas`='$kelas_siswa', `status`='Y',`nilai`='$nilai',`keterangan`='$keterangan' where thnajaran='$thnajaran' and semester='$semester' and nama_ekstra='$mapel' and `nis`='$nis' ");
		}

	}
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9" ><p class="form-control-static"><?php echo $thnajaran;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9" ><p class="form-control-static"><?php echo $semester;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9" ><p class="form-control-static"><?php echo $kelas;?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Ekstrakurikuler</label></div><div class="col-sm-9" ><p class="form-control-static"><?php echo $mapel;?></p></div></div>

<?php
$nomor=1;
$tsiswa = $this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ");
$tsisek = $this->db->query("select * from ekstrakurikuler where thnajaran='$thnajaran' and semester='$semester' and nama_ekstra='$mapel' and kelas='$kelas' order by `nis`");
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Siswa</label></div><div class="col-sm-9">';
	echo '<select name="nis" class="form-control">';
	echo '<option value=""></option>';
	foreach($tsiswa->result() as $a)
		{
		echo '<option value="'.$a->nis.'">'.nis_ke_nama($a->nis).'</option>';
		}
	echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nilai / Predikat</label></div><div class="col-sm-9">';
	echo '<select name="nilai" class="form-control">';
	echo '<option value=""></option>';
	echo '<option value="A">Amat Baik</option>';
	echo '<option value="B">Baik</option>';
	echo '<option value="C">Cukup</option>';
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><input type="text" name="keterangan" class="form-control"><input type="hidden" name="proses" value ="oke" ></div></div>';
?>
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary" role="button"> <a href="<?php echo base_url(); ?>guru/ekstrakurikuler" class="btn btn-info"><b>Kembali</b></a></p>
</form>
<?php
echo '<div class="alert alert-info"><p>Klik nama siswa untuk menghapus</p><p>Untuk menilai, bisa menggunakan borang (form) di atas atau bisa langsung menilai satu kelas dengan mengklik tautan Nilai atau Keterangan</p></div>';
$ada = count($tsisek->result());
if($ada>0)
{
	echo '<table class="table table-hover table-striped table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td>Kelas</td>';
	echo '<td><a href="'.base_url().'guru/nilaiekstrakurikuler/'.$id_pengampu_ekstra.'/1" title="Ubah Nilai"><strong>Nilai</strong></a></td><td><a href="'.base_url().'guru/nilaiekstrakurikuler/'.$id_pengampu_ekstra.'/2" title="Ubah keterangan"><strong>Keterangan</strong></a></td></tr>';

	foreach($tsisek->result() as $t)
	{
	$nis = $t->nis;
	$namasiswa = nis_ke_nama($nis);
	echo "<tr><td align='center'>".$nomor."</td><td>".$nis."</td><td>";
	if($wajib == 0)
	{
		echo "<a href='".base_url()."guru/ekstrakurikuler/".$thn1."/".$semester."/".$id_pengampu_ekstra."/hapus/".$t->id_siswa_ekstra."' onClick=\"return confirm('Anda yakin ingin menghapus nilai $namasiswa?')\" title='Hapus'>".$namasiswa."</a>";
	}
	else
	{
		echo $namasiswa;
	}
	echo "</td><td>".$t->kelas."</td><td align='center'>";
	if($t->nilai == 'A')
	{
		echo 'Amat Baik';
	}
	elseif($t->nilai == 'B')
	{
		echo 'Baik';
	}
	elseif($t->nilai == 'C')
	{
		echo 'Cukup';
	}
	else
	{
		echo '';
	}
	echo "</td><td align='center'>".$t->keterangan."</td></tr>";
	$nomor++;	
	}
echo "<table>";
}
else{
echo '<div class="alert alert-warning"><strong>Belum / tidak ada siswa mendaftar</div>';
}
?>
</table>
<p class="text-center"><a href="<?php echo base_url(); ?>guru/cetakdaftarnilaiekstra/<?php echo $id_pengampu_ekstra;?>" class="btn btn-info"><span class="glyphicon glyphicon-print"></span> <b>Daftar Nilai</b></a></p>
</div></div></div>
