<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: siswa.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sen 16 Mei 2016 10:19:00 WIB 
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
<?php $tanggalhariini = tanggal_hari_ini();?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' '.nis_ke_nama($nis);?></h3></div>
<div class="card-body">
<?php
if($aksi == 'hapus')
{
	$q1 = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `id_siswa_absensi`='$id_siswa_absensi'");
	if($q1->num_rows() > 0)
	{
		foreach($q1->result() as $dq1)
		{
			$alasanawal = $dq1->alasan;
			$tanggal = $dq1->tanggal;
		}
		if($alasanawal == 'A')
		{
			$kode = $this->config->item('kode_tanpa_keterangan');
		}
		if($alasanawal == 'B')
		{
			$kode = $this->config->item('kode_membolos');
		}
		if($alasanawal == 'T')
		{
			$kode = $this->config->item('kode_terlambat');
		}
		if(($alasanawal == 'A') or ($alasanawal == 'B') or ($alasanawal == 'T'))
		{
			$this->db->query("delete from `siswa_kredit` where `tanggal`='$tanggal' and `nis`='$nis' and `kd_pelanggaran`='$kode'");
		}
		$this->db->query("delete from `siswa_absensi` where `tanggal`='$tanggal' and `nis`='$nis'");
		header('Location: '.base_url().'bp/absensi/'.$nis);
	}
}
elseif($aksi == 'ubah')
{
	$q1 = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `id_siswa_absensi`='$id_siswa_absensi'");
	if($q1->num_rows() > 0)
	{
		foreach($q1->result() as $dq1)
		{
			$alasanawal = $dq1->alasan;
			$tanggal = $dq1->tanggal;
		}
		echo form_open('bp/absensi/'.$nis.'/simpan/'.$id_siswa_absensi,'class="form-horizontal" role="form"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Tidak Hadir</label></div><div class="col-sm-9"><p class="form-control-static">'.tanggal($tanggal).'<input type="hidden" name="tanggal" value="'.$tanggal.'"></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Alasan Sebelumnya</label></div><div class="col-sm-9"><p class="form-control-static">'.$alasanawal.'<input type="hidden" name="alasanawal" value="'.$alasanawal.'"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alasan</label></div>
		<div class="col-sm-9"><select name="alasan" class="form-control">';
		if($alasanawal == 'S')
		{
			echo '<option value="S">Sakit</option>';
			echo '<option value="I">Izin</option>';
			echo '<option value="A">Tanpa Keterangan</option>';
		}
		elseif($alasanawal == 'I')
		{
			echo '<option value="S">Sakit</option>';
			echo '<option value="A">Tanpa Keterangan</option>';
		}
		else
		{
			echo '<option value="S">Sakit</option>';
			echo '<option value="I">Izin</option>';
		}
		echo '</select></div></div>';
		echo '<p class="text-center"><button type="submit" class="btn btn-primary">Simpan Perubahan</button></p>';
	}
	else
	{
		echo 'Data tidak ditemukan';
	}
}
else
{
	$query = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester'");
	if($query->num_rows()==0)
	{
		echo '<div class="alert alert-info">Tidak ada data</div>';
	}
	else
	{
		echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>Tanggal</td><td>Keterangan Tidak Masuk</td><td>Keterangan Tambahan</td><td colspan="2" width="100">Aksi</td></tr>';
		$nomor=1;
		foreach($query->result() as $b)
		{
			$link_hapus = anchor('bp/absensi/'.$nis.'/hapus/'.$b->id_siswa_absensi,'<span class="fa fa-trash"></span>', array('title' => 'Hapus', 'data-confirm' => 'Anda yakin akan menghapus ketidakhadiran '.nis_ke_nama($b->nis).' tanggal '.tanggal($b->tanggal).' karena '.$b->alasan.'?'));
			$link_ubah = anchor('bp/absensi/'.$nis.'/ubah/'.$b->id_siswa_absensi,'<span class="fa fa-edit"></span>', array('title' => 'Ubah', ''));
			echo '<tr><td>'.$nomor.'</td><td>'.tanggal($b->tanggal).'</td><td>'.$b->alasan.'</td><td>'.$b->keterangan.'</td>';
			echo '<td>'.$link_ubah.'</td><td>'.$link_hapus.'</td>';
			$nomor++;
		}
		?>
		</table>
		<?php
	}
}
?>
</div></div></div>
