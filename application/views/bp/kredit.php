<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 16:01:46 WIB 
// Nama Berkas 		: kredit.php
// Lokasi      		: application/views/bp/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
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
<?php echo form_open('bp/simpankredit','class="form-horizontal" role="form"');?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
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
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	?>
	</select></div></div>
<?php
echo '
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div>
<div class="col-sm-9"><input type="search" class="autocomplete form-control" id="autocomplete" placeholder="ketik sebagian nama siswa tanpa spasi" required/></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_kelas" disabled></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIS</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_nis" name="nis" required readonly></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9">';
echo '<input type="text" name="tanggaltidakmasuk" class="form-control" id="tanggaltidakmasuk" required></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pelanggaran</label></div><div class="col-sm-9">';
echo '<select name="kode" class="form-control">';
	echo '<option value="">--- Pelanggaran ---</option>';
	foreach($tabel_kredit->result() as $dkredit)
	{
	echo '<option value="'.$dkredit->kode.'">'.$dkredit->nama_pelanggaran.' '.$dkredit->kode.' '.$dkredit->point.'</option>';
	}
	echo '</select></div></div>';
echo '<input type="hidden" name="kodeguru" value="BP">';
echo '<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN DATA</button></p>';
?>
</div></div></form>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Kode<br>Pelanggaran / Kejadian</strong></td><td><strong>Pelanggaran / Kejadian</strong><td><strong>Point</strong><td><strong>Kode / Nama <br/>Guru</strong></td><td><strong>Hapus</strong></td></tr>
		<?php
		$nomor=1;
		foreach($query->result() as $ba)
		{
	$nis = $ba->nis;
	$thnajaran = $ba->thnajaran;
	$semester = $ba->semester;
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	$namasiswa = nis_ke_nama($nis);
	$tanggalabsen = tanggal($ba->tanggal);
	$kode = $ba->kd_pelanggaran;
	$tkred = $this->db->query("select * from m_kredit where kode = '$kode'");
	$namapelanggaran ='';
	foreach($tkred->result() as $dkred)
		{
		$namapelanggaran = $dkred->nama_pelanggaran;
		}
	$kodeguru = $ba->kodeguru;
	$namaguru = $kodeguru;
	$ta = $this->db->query("select `kd`,`nama` from `p_pegawai` where `kd`='$kodeguru'");
	foreach($ta->result() as $a)
	{
		$namaguru = $a->nama;
	}
		echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$tanggalabsen.'</td><td width="200">'.$namasiswa.'</td><td align="center">'.$kelas.'</td><td align="center">'.$kode.'</td><td>'.$namapelanggaran.''.$ba->kejadian.'</td><td align="center">'.$ba->point.'</td><td align="center">'.$namaguru.'</td><td align="center">';
		if($kode == 'Z')
		{
			echo "<a href='".base_url()."bp/hapuskredit/".$ba->id_siswa_kredit."' onClick=\"return confirm('Anda yakin ingin menghapus jurnal sikap ".$namasiswa." ".$ba->kejadian." ".$tanggalabsen." dicatat oleh ".$namaguru."?')\" title='Hapus pelanggaran siswa'><span class='fa fa-trash-alt'></span></a>";
		}
		else
		{
			echo "<a href='".base_url()."bp/hapuskredit/".$ba->id_siswa_kredit."' onClick=\"return confirm('Anda yakin ingin menghapus pelanggaran ".$namasiswa." ".$namapelanggaran." ".$tanggalabsen."?')\" title='Hapus pelanggaran siswa'><span class='fa fa-trash-alt'></span></a>";
		}
		echo "</td></tr>";
		$nomor++;
		}
		echo '</table></div>';
if (!empty($paginator))
	{
	?>
	<?php echo $paginator;?>
	<?php }?>
</div>
