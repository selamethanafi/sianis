<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: hasil_cari_siswa.php
// Lokasi      		: application/views/admin
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>admin/carisiswa" class="btn btn-info"><b>Pencarian Siswa</b></a></p>
<p class="text-info">Hasil Pencarian dengan kunci <strong><?php echo $kunci_nama;?></strong></p>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Kelas Terakhir</strong></td><td width="75"><strong>ID Telegram</strong></td><td width="75"><strong>Status</strong></td><td width="75"><strong>Ubah</strong></td></tr>
<?php
$nomor = 1;
if(count($hasilpencarian->result())>0){
foreach($hasilpencarian->result() as $t)
{
		$ket = $t->ket;
		if ($t->ket=='Y')
			{
			$ket='Aktif';
			}
		if ($t->ket=='P')
			{
			$ket='Pindah';
			}
		if ($t->ket=='L')
			{
			$ket='Lulus';
			}
		if ($t->ket=='K')
			{
			$ket='Keluar';
			}
		if ($t->ket=='T')
			{
			$ket='Tidak jelas';
			}
echo "<tr><td align='center'>".$nomor."</td><td>".$t->nis."</td><td>".$t->nama."</td><td>".$t->kdkls."</td>";
	echo '<td align="center"><a href="https://api.telegram.org/bot'.$this->config->item('token_bot').'/sendMessage?chat_id='.$t->chat_id.'&text=hallo" target="_blank">'.$t->chat_id.'<td>'.$ket.'</td>';
echo '<td><a href="'.base_url().'admin/pengguna/edit/'.$t->nis.'" title="Edit Data Siswa"><span class="fa fa-edit"></span></a></td>';
	?>
</tr>
<?php
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Tidak ada siswa dengan nama yang mengandung karakter <strong>$kunci_nama</strong></td></tr>";
}?>
</table></div>
</div></div></div>
