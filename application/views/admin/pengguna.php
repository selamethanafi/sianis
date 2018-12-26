<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pengguna.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Sen 11 Apr 2016 05:24:39 WIB 
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
if($aksi == 'tambah')
{
	echo form_open('admin/simpanuser','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Username</label></div><div class="col-sm-9"><input type="text" name="username" class="form-control" required><span class="text-danger"><?php echo $galat1; ?></span></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control" required></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Password</label></div><div class="col-sm-9"><input type="text" name="pswd" class="form-control" required></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Hak Akses</label></div><div class="col-sm-9"><select name="tipeuser" class="form-control">
		<option value=""></option><option value="PA">Guru</option><option value="Kepala">Kepala</option>
		<option value="admin">admin</option>
		<option value="Keuangan">Keuangan</option>
		<option value="Panitia_Tes">Panitia Tes</option>
		<option value="Pengajaran">Pengajaran</option>
		<option value="Pengawas">Pengawas</option>
		<option value="Tatausaha">Tatausaha</option>
		<option value="BP">BP</option>
		<option value="Pegawai">Pegawai</option>
		<option value="Siswa">Siswa</option>
		</select></div></div>
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>
	</form>
	<?php	
}
elseif($aksi == 'edit')
{
	$pengguna = balikin($pengguna);
	$query=$this->Admin_model->Tampil_User($pengguna);
	$adaq = $query->num_rows();
	if($adaq == 0)
	{
		echo '<div class="alert alert-warning">Galat! Pengguna tidak ditemukan.</div>';
	}
	else
	{
		foreach($query->result() as $c)
		{
			$username = $c->username;
			$namapengguna = $c->nama;
			$akses = $c->status;
			$idlink = $c->idlink;
			$aktif = $c->aktif;
		}
		echo form_open_multipart('admin/updateuser','class="form-horizontal" role="form"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Username</label></div><div class="col-sm-9"><input type="text" name="username" class="form-control" value="'.$username.'" required readonly></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control" value="'.$namapengguna.'" required></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Password</label></div><div class="col-sm-9"><input type="text" name="pswd" class="form-control"></div></div>';
		if($akses == 'Siswa')
		{
			$chat_id = '';
			$ta = $this->db->query("select `nis`,`chat_id` from `datsis` where `nis`='$username'");
			foreach($ta->result() as $a)
			{
				$chat_id = $a->chat_id;
			}
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">ID Telegram</label></div><div class="col-sm-9"><input type="text" name="idlink" value="'.$chat_id.'" class="form-control"></div></div>';
		}
		else
		{
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">ID Telegram (khusus BK)</label></div><div class="col-sm-9"><input type="text" name="idlink" value="'.$idlink.'" class="form-control"></div></div>';
		}

		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Hak Akses</label></div><div class="col-sm-9"><select name="tipeuser" class="form-control">';
		if($akses == 'Siswa')
		{
			echo '<option value="Siswa">Siswa</option>';
		}
		else
		{
		echo '	<option value="'.$akses.'">'.$akses.'</option><option value="admin">admin</option><option value="PA">Guru</option><option value="Kepala">Kepala</option>
				<option value="Keuangan">Keuangan</option>
		<option value="Panitia_Tes">Panitia Tes</option>
		<option value="Pengajaran">Pengajaran</option>
		<option value="Pengawas">Pengawas</option>
		<option value="Tatausaha">Tatausaha</option>
		<option value="BP">BP</option>
		<option value="Pegawai">Pegawai</option>';
		}
		echo '</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keaktifan</label></div><div class="col-sm-9"><select name="aktif" class="form-control">';
		if($aktif == 'Y')
		{
		echo '<option value="Y">Ya</option><option value="N">Tidak</option>';
		}
		else
		{
			echo '<option value="N">Tidak</option><option value="Y">Ya</option>';
		}
		echo '</select></div></div>';

		$tandatangan='';
		$tguru = $this->db->query("select * from `p_pegawai` where `kd`='$username'");
		foreach($tguru->result() as $dguru)
		{
			$tandatangan = $dguru->tandatangan;
		}
		?>
		<div class="form-group row">
			<div class="col-sm-3">
				<label class="control-label">Tanda Tangan</label></div>
				<div class="col-sm-9">
				<?php
				if (!empty($tandatangan))
				{
					?>
					<img src="<?php echo base_url(); ?>images/ttd/<?php echo $tandatangan;?>" alt="berkas tanda tangan"/>
					<?php
				}
				?>
			</div>
		</div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas tanda tangan</label></div><div class="col-sm-9"><input type="file" name="userfile"><p class="text-info">* Bila gambar tidak diganti, silakan dikosongkan saja. Resolusi max 400x400 pix</p></div></div>
		<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p></form>
		<?php
	}
}

else
{
?>
<a href="<?php echo base_url(); ?>admin/pengguna/tambah" class="btn btn-info"> <span class="fa fa-plus"></span><b> Pengguna</b></a><p></p>

<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Nama Pengguna</strong></td><td><strong>Hak Akses Pengguna</strong></td><td><strong>Batas Login</strong></td><td colspan="2" width="50"><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
$status = $b->status;
if ($b->nama=='Administrator')
	{
	echo "<tr><td>".$nomor."</td><td>".$b->nama."</td><td>".$b->username."</td><td>";
		if($status == 'PA')
		{
			echo 'Guru';
		}
		else
		{
			echo $status;
		}
		echo "</td>";
		echo '<td align="center">'.$b->next_login.'</td>';
		echo "<td align=\"center\"><a href='".base_url()."admin/pengguna/edit/".cegah($b->username)."' title='Edit'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"></td></tr>";
	}
	else
	{
	echo "<tr><td>".$nomor."</td><td>".$b->nama."</td><td>".$b->username."</td><td>";
		if($status == 'PA')
		{
			echo 'Guru';
		}
		else
		{
			echo $status;
		}
		echo "</td>";
		echo '<td align="center">'.$b->next_login.'</td>';
		echo "<td align=\"center\"><a href='".base_url()."admin/pengguna/edit/".cegah($b->username)."' title='Edit'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."admin/hapuspengguna/".cegah($b->username)."'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
	}

$nomor++;
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	?>
	<?php echo $paginator;?>
	<?php }?>
<?php
}
?>
</div></div></div>
