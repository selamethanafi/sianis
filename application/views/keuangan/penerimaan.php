<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : penerimaan.php
// Lokasi      : application/views/keuangan
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
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
echo form_open('keuangan/penerimaan','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</td></label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">
<option value="<?php echo $thnajaran;?>"><?php echo $thnajaran;?></option>
<?php
	$ta = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
	foreach($ta->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
?>
</select></div></div>
<p class="text-center"><input name="proses" type="hidden" value="1"><input type="submit" value="Proses" class="btn btn-primary"></p>
</form>
</div></div></div>
