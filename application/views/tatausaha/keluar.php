<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: keluar.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
jQuery(function($){
$("#tanggalkeluar").mask("99/99/9999")
});
</script>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">

<a href="<?php echo base_url();?>tatausaha/carisiswa"><b>Pencarian Data Siswa</b></a>
<?php
echo form_open('tatausaha/updatedatasiswakeluar','class="form-horizontal" role="form"');?>
<?php
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<?php
		echo '<select name="thnajaran" class="form-control">';
		if (empty($t->thnajaran))
			{
			echo '<option value="'.$thnajaran.'">'.$thnajaran.'</option>';
			}
			else
			{
			echo '<option value="'.$t->thnajaran.'">'.$t->thnajaran.'</option>';
			}
		$tb = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
		foreach($tb->result() as $b)
		{
		       	echo '<option value="'.$b->thnajaran.'">'.$b->thnajaran.'</option>';
		}
		?>
		</select></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
		<?php
		echo '<select name="semester" class="form-control">';
		if (empty($t->semester))
			{
			echo '<option value="'.$semester.'">'.$semester.'</option>';
			}
			else
			{
			echo '<option value="'.$t->semester.'">'.$t->semester.'</option>';
			}
		       	echo '<option value="1">1</option>';
		       	echo '<option value="2">2</option>';
		?>
		</select></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Induk Siswa</label></div><div class="col-sm-9"><?php echo $t->nis;?></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIS Nasional</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->nisn;?></p></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->nama;?></p></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat, tanggal Lahir</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $t->tmpt;?>, 
		<?php
		$str = $t->tgllhr;	
		$tanggalle = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo $tanggalle;
		echo '</p></div></div>';
	 	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Meninggalkan Madrasah</label></div><div class="col-sm-9">';
		if ((empty($t->tanggalkeluar)) or ($t->tanggalkeluar=='0000-00-00'))
			{
			$tanggalsekarang = date("d/m/Y");
			}
			else
			{
			$str = $t->tanggalkeluar;	
			$tanggalle = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
			$tanggalsekarang = $tanggalle;
			}
		?>
		<input type="text" name="tanggalkeluar" value="<?php echo $tanggalsekarang;?>" id="tanggalkeluar" class="form-control">
		<?php
		echo '</div></div>
            <div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alasan Meninggalkan Madrasah</label></div><div class="col-sm-9"><input type="text" name="alasankeluar" value="'.$t->alasankeluar.'" class="form-control">
              </div></div>
	    <div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pindah ke sekolah</label></div><div class="col-sm-9"><input type="text" name="sekolahtujuan" value="'.$t->sekolahtujuan.'" class="form-control"></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Surat Pindah / Keluar </label></div><div class="col-sm-9"><input type="text" name="nosurat" value="'.$t->nosurat.'" class="form-control"></div></div>';
		?>
		<p class="text-center">
		<input type="submit" value="Simpan Data" class="btn btn-primary">
		<input type="hidden" name="nis" value="<?php echo $t->nis;?>">
		<a href="<?php echo base_url();?>tatausaha/carisiswa" class="btn btn-primary"> &nbsp;&nbsp;Batal</a></p>
		<?php
	}
}
else{
echo '<div class="alert alert-alert-info">Belum Ada Data</div>';
}
?>
</form>

</div></div></div>

