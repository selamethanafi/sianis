<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : isi_index.php
// Lokasi      : application/views/guru
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<style>
.container {
    position: relative;
}
.centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>

<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if(($nomor == 1) or ($nomor == 2) or ($nomor == 3) or ($nomor == 4) or ($nomor == 5) or ($nomor == 6))
{
	$cp = 'caption_slide_'.$nomor;
	$scp = 'sub_caption_slide_'.$nomor;
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = '$cp'");
	foreach($tb->result() as $b)
	{
		$caption_slide = $b->nilai;
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = '$scp'");
	foreach($tb->result() as $b)
	{
		$sub_caption_slide = $b->nilai;
	}

	echo form_open_multipart('admin/simpanslide/'.$nomor);
	echo '<div class="form-group row">
	<label for="berkas" class="col-sm-3 control-label">Berkas (format jpg, ukuran disarankan 940 x 360 px)</label>
		<div class="col-sm-9" ><input type="file" name="userfile"></div>
	</div>
	<div class="form-group row">
	<label for="berkas" class="col-sm-3 control-label">Caption</label>
		<div class="col-sm-9" ><input type="text" name="caption" value="'.$caption_slide.'" class="form-control"></div>
	</div>
<div class="form-group row">
	<label for="berkas" class="col-sm-3 control-label">Subcaption</label>
		<div class="col-sm-9" ><input type="text" name="subcaption" value="'.$sub_caption_slide.'"  class="form-control"></div>
	</div>
	<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p>
</form>';
}
else
{

echo '<p class="text-info">Klik gambar untuk menggunggah atau mengubah caption</p>';
$caption_slide_1 = '';
$caption_slide_2 = '';
$caption_slide_3 = '';
$caption_slide_4 = '';
$caption_slide_5 = '';
$caption_slide_6 = '';
$sub_caption_slide_1 = '';
$sub_caption_slide_2 = '';
$sub_caption_slide_3 = '';
$sub_caption_slide_4 = '';
$sub_caption_slide_5 = '';
$sub_caption_slide_6 = '';
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_1'");
foreach($tb->result() as $b)
{
	$caption_slide_1 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_2'");
foreach($tb->result() as $b)
{
	$caption_slide_2 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_3'");
foreach($tb->result() as $b)
{
	$caption_slide_3 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_4'");
foreach($tb->result() as $b)
{
	$caption_slide_4 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_5'");
foreach($tb->result() as $b)
{
	$caption_slide_5 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_6'");
foreach($tb->result() as $b)
{
	$caption_slide_6 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_1'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_1 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_2'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_2 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_3'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_3 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_4'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_4 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_5'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_5 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_6'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_6 = $b->nilai;
}
echo '<div class="container-fluid"><a href="'.base_url().'admin/slide/1"><img src="'.base_url().'images/1.jpg" alt="'.$caption_slide_1.'"><div class="centered"><h3>'.$caption_slide_1.'</h3><p>'.$sub_caption_slide_1.'</p></div></a></div>';
echo '<div class="container-fluid"><a href="'.base_url().'admin/slide/2"><img src="'.base_url().'images/2.jpg" alt="'.$caption_slide_2.'"><div class="centered"><h3>'.$caption_slide_2.'</h3><p>'.$sub_caption_slide_2.'</p></div></a></div>';
echo '<div class="container-fluid"><a href="'.base_url().'admin/slide/3"><img src="'.base_url().'images/3.jpg" alt="'.$caption_slide_3.'"><div class="centered"><h3>'.$caption_slide_3.'</h3><p>'.$sub_caption_slide_3.'</p></div></a></div>';
echo '<div class="container-fluid"><a href="'.base_url().'admin/slide/4"><img src="'.base_url().'images/4.jpg" alt="'.$caption_slide_4.'"><div class="centered"><h3>'.$caption_slide_4.'</h3><p>'.$sub_caption_slide_4.'</p></div></a></div>';
echo '<div class="container-fluid"><a href="'.base_url().'admin/slide/5"><img src="'.base_url().'images/5.jpg" alt="'.$caption_slide_5.'"><div class="centered"><h3>'.$caption_slide_5.'</h3><p>'.$sub_caption_slide_5.'</p></div></a></div>';
echo '<div class="container-fluid"><a href="'.base_url().'admin/slide/6"><img src="'.base_url().'images/6.jpg" alt="'.$caption_slide_6.'"><div class="centered"><h3>'.$caption_slide_6.'</h3><p>'.$sub_caption_slide_6.'</p></div></a></div>';
}
?>

</div></div></div>
