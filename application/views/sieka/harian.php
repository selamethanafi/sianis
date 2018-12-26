<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp.php
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
?><div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<div class="alert alert-warning"><h2>Pastikan sudah login di sieka, sebelum mengirim kegiatan harian</h2></div>
<?php
$ta = $this->db->query("select * from `sieka_harian` where `tahun`='$tahunpenilaian' and `nip`='$nip' order by `terkirim`, `tanggal` DESC");
echo '<table class="table table-striped table-hover table-bordered">
<tr><td align="center">Nomor</td><td>Tanggal</td><td>Kegiatan</td><td align="center">ID Bulanan</td><td align="center">Kirim ke Sieka</td><td align="center">Hapus</td></tr>';
$nomor = 1;
foreach($ta->result() as $a)
{
	echo '<tr><td align="center">'.$nomor.'</td><td>'.tanggal($a->tanggal).'</td><td>'.$a->kegiatan.'</td><td align="center">'.$a->id_bulanan.'</td><td align="center">';
	if($a->terkirim == 1)
	{
	?>
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>sieka/kirim/<?php echo $a->id_sieka_harian;?>','yes','scrollbars=yes,width=1024,height=600')" class="btn btn-danger"><strong>Kirim Ulang</strong></a>
	<?php
	}
	else
	{
	?>
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>sieka/kirim/<?php echo $a->id_sieka_harian;?>','yes','scrollbars=yes,width=1024,height=600')" class="btn btn-success"><strong>Kirim</strong></a>
	<?php

	}
	echo '</td><td align="center"><a href="'.base_url().'sieka/hapus/'.$a->id_sieka_harian.'" data-confirm="Yakin hendak menghapus kegiatan '.tanggal($a->tanggal).' - '.$a->kegiatan.'?"><span class="fa fa-trash"></span></a></tr>';
	$nomor++;
}
echo '</table>';
?>
</div></div></div>
