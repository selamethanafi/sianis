<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: ketidakhadiran_siswa_harian.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sen 16 Mei 2016 23:09:23 WIB 
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
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.autocomplete.js"></script>

    <!-- Memanggil file .css untuk style saat data dicari dalam filed -->
    <link href="<?php echo base_url();?>assets/css/jquery.autocomplete.css" rel="stylesheet" />
    <script type='text/javascript'>
        var site = "<?php echo site_url();?>";
        $(function(){
            $('.autocomplete').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/autocomplete/search',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                    $('#v_nis').val(''+suggestion.nis); // membuat id 'v_nim' untuk ditampilkan
                    $('#v_kelas').val(''+suggestion.kelas); // membuat id 'v_jurusan' untuk ditampilkan
                }
            });
        });
    </script>

<div class="container-fluid"><h2>Pencatatan Ketidakhadiran Siswa Per Tanggal</h2>
<a href="<?php echo base_url(); ?>bp/ketidakhadiransiswa" class="btn btn-info"><strong> Tanggal Lain</strong></a><p></p>
<?php
$dinane = tanggal_ke_hari($id);
if($dinane == '?')
{
	echo '<div class="alert alert-danger">Galat!, tanggal '.date_to_long_string($id).' harinya tidak jelas</div>';
}
elseif ($dinane == 'Minggu')
{
	echo '<div class="alert alert-danger">Galat!, tanggal '.date_to_long_string($id).' hari Minggu lagi!</div>';
}
elseif (empty($dinane))
{
	echo '<div class="alert alert-danger">Galat!, tanggal kosong</div>';
}

else
{
echo form_open('bp/simpanabsensi','class="form-horizontal" role="form"');?>
	<div class="card">
	<div class="card-header"><h4><?php echo $judulhalaman;?></h4></div>
	<div class="card-body">
	<div class="alert alert-warning">Menu tidak berfungsi. Untuk mengaktifkan menu silakan meng-klik menu Beranda</div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	?>
	</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	if (empty($semester))
	{$semester=$semesterx;}

	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	?>
	</select></div></div>
<?php
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9"> <strong>'.$dinane.'</strong> ';
	echo '<input type="hidden" name="tanggaltidakmasuk" value="'.tanggal($id).'">'.date_to_long_string($id);
	echo '</div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="search" class="autocomplete form-control" id="autocomplete1" required/></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_kelas" disabled></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIS</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_nis" name="nis" required readonly></div></div>';
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9">
<select name="alasan" class="form-control">
<option value="S">Sakit</option>
<option value="I">Izin</option>
<option value="A">Tanpa Keterangan</option>
<option value="T">Terlambat masuk sekolah</option>
<option value="B">Membolos</option>
<option value="M">Meninggalkan Sekolah</option>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan Tambahan</label></div><div class="col-sm-9"><input name="keterangan" type="text" class="form-control"></div></div>
<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN DATA</button><input type="hidden" name="id" value="<?php echo $id;?>">  <a href="<?php echo base_url(); ?>bp/ketidakhadiransiswaharian/<?php echo $besok;?>" class="btn btn-info"> <strong>Hari Selanjutnya</strong></a></p>
</div></div></form>
<table class="table table-hover table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Alasan</strong></td><td><strong>Keterangan</strong></td><td><strong>Kode Guru</strong></td></tr>
		<?php
		$nomor=1;
		foreach($query->result() as $ba)
		{
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
			$alasane = 'Meninggalkan Sekolah';
			}
	$nis = $ba->nis;
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	$namasiswa = nis_ke_nama($nis);
	$str = $ba->tanggal;	
	$tanggalabsen = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

		echo "<tr><td>".$nomor."</td><td>".$namasiswa."</td><td>".$kelas."</td><td>".$alasane."</td><td>".$ba->keterangan."</td><td>".$ba->kode_guru."</td></tr>";
		$nomor++;
		}
		echo '</table>';
}
?>

</div>
