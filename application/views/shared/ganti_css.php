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
<div class="container-fluid">
<div class="card">
	<div class="card-header"><h2><?php echo $judulhalaman;?></h2></div>
	<div class="card-body">

<?php
$ta = $this->db->query("select * from `temauser` where `user`='$nim'");
$adata = $ta->num_rows();
if($adata==0)
{
	$this->db->query("insert into `temauser` (`user`) values ('$nim')");
}
$ta = $this->db->query("select * from `temauser` where `user`='$nim'");
foreach($ta->result() as $a)
{

	$temacss = $a->temacss;
}
echo form_open($status.'/csstema','class="form-horizontal" role="form"');
?>
	<div class="form-group row row">
		<div class="col-sm-3" ><label class="control-label">Ganti Tema Tampilan</label></div>
		<div class="col-sm-9" >
 			<select name="temacss" class="form-control">
				<?php
				if(empty($temacss))
				{
					echo "<option value=''>Bawaan Sistem</option>";
				}
				else
				{
					echo '<option value="'.$temacss.'">'.$temacss.'</option>';
					echo "<option value=''>Bawaan Sistem</option>";
				}
				$tb = $this->db->query("SELECT * from `tema` order by `namacss`");
				foreach($tb->result() as $b)
				{
					echo "<option value='".$b->namacss."'>".$b->namacss."</option>";
				}
				echo '</select>';
				?>
		</div>
	</div>
	<input type="hidden" name="proses" value="kirim">
	<p class="text-center"><button type="submit" class="btn btn-primary">Simpan Tema Tampilan</button></p>
<?php
echo form_close();
?>

</div></div>
