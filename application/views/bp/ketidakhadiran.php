<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: ketidakhadiran.php
// Lokasi      		: application/views/bp
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggaltidakmasuk").mask("99-99-9999")
	});
</script>
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

<div class="container-fluid">
<?php echo form_open('bp/simpanabsensi','class="form-horizontal" role="form"');?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
	<div class="alert alert-warning">Menu tidak berfungsi. Untuk mengaktifkan menu silakan meng-klik menu Beranda</div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Tahun Pelajaran</div>
	<div class="col-sm-9">
		<select name="thnajaran" class="form-control" required>
		<?php
		echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
		?>
		</select></div>
	</div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Semester</div>
		<div class="col-sm-9">
		<select name="semester" class="form-control" required>
		<option value="<?php echo $semester;?>"><?php echo $semester;?></option>';
		</select></div>
	</div>
<?php
echo '
<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Nama</div>
		<div class="col-sm-9"><input type="search" class="autocomplete form-control" id="autocomplete1" placeholder="ketik sebagian nama siswa tanpa spasi" required/></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Kelas</div>
		<div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_kelas" disabled></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>NIS</div>
		<div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_nis" name="nis" required readonly></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Tanggal</div>
		<div class="col-sm-9">';
	echo '<input type="text" name="tanggaltidakmasuk" class="form-control" id="tanggaltidakmasuk" required></div></div>';
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Keterangan</div>
		<div class="col-sm-9">
<select name="alasan" class="form-control" required>
<option value="S">Sakit</option>
<option value="I">Izin</option>
<option value="A">Tanpa Keterangan</option>
<option value="T">Terlambat masuk sekolah</option>
<option value="B">Membolos</option>
<option value="M">Meninggalkan Sekolah</option>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Keterangan Tambahan</div>
		<div class="col-sm-9"> <input name="keterangan" type="text" class="form-control"></div></div>
<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN DATA</button></p>
</div></div></form>
<table class="table table-hover table-bordered"><tr aling="center"><td><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Alasan</strong></td><td><strong>Keterangan</strong></td><td><strong>Guru</strong></td></tr>
		<?php
		$nomor=1;
		foreach($query->result() as $ba)
		{
		$alasane = '';
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
	$tanggalabsen = tanggal($ba->tanggal);
	$kodeguru = $ba->kodeguru;
	$namaguru = $kodeguru;
	$ta = $this->db->query("select `kd`,`nama` from `p_pegawai` where `kd`='$kodeguru'");
	foreach($ta->result() as $a)
	{
		$namaguru = $a->nama;
	}

		echo "<tr><td>".$nomor."</td><td>".$tanggalabsen."</td><td>".$namasiswa."</td><td>".$kelas."</td><td>".$alasane."</td><td>".$ba->keterangan."</td><td>".$namaguru."</td></tr>";
		$nomor++;
		}
		echo '</table>';
if (!empty($paginator))
	{
	?>
	<?php echo $paginator;?>
	<?php }?>
</div>	
