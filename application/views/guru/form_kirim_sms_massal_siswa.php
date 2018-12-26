<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: form_kirim_sms_massal_siswa.php
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
<?php
if (empty($id_sms_user))
{
	echo '<div class="container-fluid"><div class="card"><div class="card-header"><h3>Mengirim SMS Massal</h3></div><div class="card-body">';
	echo '<div class="alert alert-danger"><strong>Nomor ID Pengguna SMS belum ditentukan, hubungi admin.</strong></div>';
	echo '</div></div></div>';
}
else
{
if ($aksi == 'unduh')
{
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$filename = 'template_pesan_massal_kelas_'.$kelas.''; 	
	$kelas = $kelas."-";
	$csv_output = '"nis","nama","kelas","Number","pesan"';
	$csv_output .= "\n";
	$tb =$this->db->query("select * from `siswa_kelas` where kelas like '$kelas%' and `status`='Y' and `thnajaran`='$thnajaran' and `semester` = '$semester' order by kelas ASC,no_urut ASC");
	foreach($tb->result() as $b)
	{
		$nis = $b->nis;
		$kelas = $b->kelas;
		$ta =$this->db->query("select * from datsis where `nis`= '$nis' and ket='Y'");
		foreach($ta->result() as $a)
		{
			if(!empty($a->hp))
			{
			$csv_output .= '"'.$a->nis.'","'.$a->nama.'","'.$kelas.'","'.$a->hp.'",""';
			$csv_output .= "\n";
			}
		}
	}

	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: csv" . date("Y-m-d") . ".csv");
	header( "Content-disposition: filename=".$filename.".csv");
	print $csv_output;
}

else
{
if ($aksi == 'coba')
{
	if (empty($seluler))
		{
		echo 'Nomor seluler Anda belum ditentukan';
		}
		else
		{
		$ta =$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$seluler','Layanan SMS berjalan','$id_sms_user')");
		}
}

	echo '<div class="container-fluid"><div class="card"><div class="card-header"><h3>Mengirim SMS Massal</h3></div><div class="card-body">';
	echo '<p><a href="'.base_url().'guru/pesanmassalsiswa/" class="btn btn-info"><b>Muat Ulang</b></a>&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/pesanmassalsiswa/coba" class="btn btn-info"><b>TES SMS</b></a>';
	echo form_open_multipart('guru/pesanmassalsiswa','class="form-horizontal" role="form"');
	echo '<p class="help-block">format data</p><p class="text-info">"nis","nama","kelas","Number","pesan"</p>';
	?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile"></div></div>
	<p class="text-center"><input type="hidden" name="proses" value="oke">
<input type="submit" value="Kirim Berkas" class="btn btn-primary"></form></p>
Unduh daftar siswa <a href="<?php echo base_url();?>guru/pesanmassalsiswa/unduh/x">Kelas X</a>&nbsp;&nbsp;<a href="<?php echo base_url();?>guru/pesanmassalsiswa/unduh/xi">Kelas XI</a>&nbsp;&nbsp;<a href="<?php echo base_url();?>guru/pesanmassalsiswa/unduh/xii">Kelas XII</a></p>

<?php
$query = $this->db->query("select * from `outbox` where `id_sms_user`='$id_sms_user'");
echo '<p class="text-info">Kotak Keluar</p>';
echo '<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Nomor Telepon</strong></td><td><strong>Pesan</strong></td></tr>';
$nomor=1;
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	$hp = $t->DestinationNumber;
	$namasiswa = '';
	$kelas = '';
	$tb =$this->db->query("select * from datsis where hp = '$hp'");
	foreach($tb->result() as $b)
		{
		$namasiswa = $b->nama;
		$kelas = $b->kdkls;
		}
	echo '<tr><td>'.$namasiswa.'</td><td>'.$kelas.'</td><td>'.$hp.'</td><td>'.$t->TextDecoded.'</td>';
	$nomor++;
	}
}
echo '</table>';
echo '</div></div></div>';
}
}
