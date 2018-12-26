<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: inbox.php
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
<?php
if($aksi == 'baca')
{
	$this->Admin_model->Update_Pesan($page);
	echo '<p><a href="'.base_url().'admin/inbox" class="btn btn-info">Kotak Pesan</a></p>';
	echo form_open('admin/inbox', 'class="form-horizontal" role="form"');
	echo '<table cellspacing="1" class="widget-small" cellspacing="0" cellpadding="1" width="100%">';
	foreach($detail->result_array() as $isi)
	{?>
		 <div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Dari</label></div><div class="col-sm-9" ><p class="form-control-static"><?php echo $isi["nama"];?></p></div>
    </div>
		<?php
		echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Subjek Pesan</label></div><div class="col-sm-9" ><input type="text" name="subjek" value="'.$isi["subjek"].'" readonly="readonly" class="form-control"></div></div>';
		if ($isi["subjek"]=='Pembatalan SKP')
			{
			echo'<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Isi Pesan</label></div><div class="col-sm-9" ><p class="form-control-static">'.$isi["pesan"].'</div></div>';

		}
		echo'<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Balas Pesan</label></div><div class="col-sm-9" ><textarea name="pesan" rows="5">'.$isi["pesan"].'<br><br>================<b>BALAS</b>================<br><br><b>'.$nama.'</b> : </textarea></div></div>';
		echo '<p class="text-center"><input type="hidden" name="tujuan" value="'.$isi["username"].'"><input type="hidden" name="username" value="'.$isi["tujuan"].'"><input type="hidden" name="id_inbox" value="'.$isi["id_inbox"].'"><input type="hidden" name="adabalas" value="Y"><input type="submit" value="Kirim Pesan ke '.$isi["nama"].'" class="btn btn-primary"></p>';
	}
	?>
	</form>
	<?php
}
else
{
?>
<table class="table table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Pengirim</strong></td><td><strong>Subjek Pesan</strong></td><td><strong>Waktu</strong></td><td><strong>Status</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
		if(($t->status_pesan)=="N")
		{
		$tanda_awal="<b>";
		$tanda_blk="</b>";
		$st="Belum dibaca";
		}
		else
		{
		$tanda_awal=" ";
		$tanda_blk=" ";
		$st="Sudah dibaca";
		}
$sambung="9002".$t->id_inbox."";
$coded = base64_encode($sambung);
$str = preg_replace("/=/", "eqsmdng", $coded);
echo '<tr><td align="center">'.$tanda_awal.''.$nomor.''.$tanda_blk.'</td>
<td>'.$tanda_awal.''.$t->nama.''.$tanda_blk.'</td>
<td><a href="'.base_url().'admin/inbox/baca/'.$str.'">'.$tanda_awal.''.$t->subjek.''.$tanda_blk.'</a></td>
<td>'.$tanda_awal.''.$t->waktu.''.$tanda_blk.'</td><td>'.$tanda_awal.''.$st.''.$tanda_blk.'</td>
<td align="center"><a href="'.base_url().'admin/inbox/hapus/'.$str.'" data-confirm="Anda yakin ingin menghapus pesan ini?" title="Hapus Pesan"><span class="fa fa-trash-alt"></span></a></td></tr>';
$nomor++;	
}
}
else{
echo '<tr><td colspan="5">Inbox Pesan anda masih kosong.</td></tr>';
}
?>
</table>
<?php echo $paginator;
} // kalau tidak ada aksi
?>
</div></div></div>
