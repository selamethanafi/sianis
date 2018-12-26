<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: absensi.php
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
<script src="<?php echo base_url(); ?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggaltidakmasuk").mask("99-99-9999")
	});
</script>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
echo $pesan;
echo form_open('guru/siswaabsen/'.$nis,'class="form-horizontal" role="form"');
	if(!empty($nama_siswa))
	{
		$ta = $this->db->query("select * from `datsis` where `nama` like '%$nama_siswa%' and `ket`='Y' order by `nama`");
		if($ta->num_rows()>0)
		{
			$nomor = 1;
			echo '<div class="alert alert-info">Untuk memilih siswa, silakan klik kelas siswa</div>';
			echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>NIS</td><td>Nama</td><td>Kelas</td></tr>';
			foreach($ta->result() as $a)
			{
				$a_nis = $a->nis;
				$kelas = nis_ke_kelas_thnajaran_semester($a_nis,$thnajaran,$semester);
				echo '<tr><td>'.$nomor.'</td><td>'.$a_nis.'</td><td>'.$a->nama.'</td><td><a href="'.base_url().'guru/siswaabsen/'.$a_nis.'">'.$kelas.'</a></td></tr>';
				$nomor++;
			}
			echo '</table>';
		}

	}

if(empty($nis))
{
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9">';
	echo '<input type="text" name="nama_siswa" class="form-control" placeholder="nama siswa" required></div></div>';
echo '<p class="text-center"><input type="submit" value="Cari Siswa" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/carisiswa" class="btn btn-info"><b>Batal</b></a></p>';
}
else
{

	?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran / Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran;?> / <?php echo $semester;?></p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIS/ Nama / Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $nis;?> / <?php echo nis_ke_nama($nis);?> / <?php echo nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);?><input type="hidden" name="nis_post" value="<?php echo $nis;?>"></p></div></div>
<?php
$tanggalhariini = tanggal(tanggal_hari_ini());
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9">';
	echo '<input type="text" name="tanggaltidakmasuk" class="form-control" id="tanggaltidakmasuk" value="'.$tanggalhariini.'" required></div></div>';
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><select name="alasan" class="form-control">
<option value="S">Sakit</option>';
<option value="I">Izin</option>';
<option value="A">Tanpa Keterangan</option>';
<option value="T">Terlambat masuk sekolah</option>';
<option value="B">Membolos</option>';
<option value="M">Izin meninggalkan <?php echo $sek_tipe;?></option>';
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan Tambahan</label></div><div class="col-sm-9"><input name="keterangan" class="form-control" type="text"></div></div>
<?php
echo '<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/carisiswa" class="btn btn-info"><b>Batal</b></a></p>';
}
?>
</form>
<?php
if (!empty($nis))
{
		$daftar_absensi=$this->Bp_model->Daftar_Absensi_Siswa($thnajaran,$nis);
?>
		<table class="table table-striped table-hover table-bordered">	
		<tr><td align="center"><strong>Nomor</strong></td><td align="center"><strong>NIS</strong></td><td align="center"><strong>Nama</strong></td><td align="center"><strong>Tanggal</strong></td><td align="center"><strong>Alasan</strong></td><td align="center"><strong>Keterangan</strong></td></tr>
		<?php
		$nomor=1;
		foreach($daftar_absensi->result() as $ba)
		{
		$nis = $ba->nis;
		$alasane='';
		if ($ba->alasan=='S')
			{
			$alasane = 'Sakit';
			}
		if ($ba->alasan=='I')
			{
			$alasane = 'Izin';
			}

		if ($ba->alasan=='A')
			{
			$alasane = 'Tanpa Keterangan';
			}

		if ($ba->alasan=='T')
			{
			$alasane = 'Terlambat';
			}

		if ($ba->alasan=='B')
			{
			$alasane = 'Membolos';
			}
		if ($ba->alasan=='M')
			{
			$alasane = 'Izin meninggalkan '.$this->config->item('sek_tipe').'';
			}
		$tanggalabsen = tanggal($ba->tanggal);
		echo '<tr><td align="center">'.$nomor.'</td><td>'.$nis.'</td><td>'.nis_ke_nama($nis).'</td><td>'.$tanggalabsen.'</td><td>'.$alasane.'</td><td>'.$ba->keterangan.'</td></tr>';
		$nomor++;
		}
		echo '</table>';
}
?>
</div></div></div>
