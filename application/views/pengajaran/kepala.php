<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 03:47:18 WIB 
// Nama Berkas 		: kepala.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman.' '.$this->config->item('sek_tipe');?></h3></div>
	<div class="card-body">

<?php
if($aksi == 'tambah')
{
	echo '<a href="'.base_url().'pengajaran/kepala" class="btn btn-info" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Daftar Penjabat Kepala</a><p> </p>';
	echo form_open('pengajaran/kepala/tampil','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9">
		<select name="thnajaran" class="form-control" required>
		<?php
		echo "<option value=''></option>";
		foreach($daftar_tapel->result_array() as $k)
		{
		echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
		?>
		</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Semester</label></div>
		<div class="col-sm-9">
			<select name="semester" class="form-control"  required>
			<?php
			echo "<option value=''></option>";
			echo "<option value='1'>1</option>";
			echo "<option value='2'>2</option>";
			?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Nama Kepala</label></div>
		<div class="col-sm-9"><select name="kodeguru" class="form-control" required>
			<?php
			echo "<option value=''></option>";
			foreach($daftar_guru->result_array() as $ka)
			{
			echo "<option value='".$ka["kd"]."'>".$ka["nama"]."</option>";
			}
			?>
			</select>
		</div>
	</div>
	<table class="table table-striped table-hover table-bordered">
		<tr align="center"><td>Tanda Tangan Untuk</td><td>Margin Kiri</td><td>Posisi relatif dari teks kepala (vertikal)</td><td>Lebar tanda tangan</td><td>Tinggi tanda tangan</td></tr>
		<tr><td>Rapor Kurikulum 2013</td>
			<td>
				<div class="input-group"><input type="number" name="posisi_x" min="0" max="20" class="form-control"><span class="input-group-addon">milimeter</span></div> <p class="help-block">0 berarti 2 cm disebelah kiri teks kepala, 10 berarti 1 cm disebelah kiri teks kepala, 20 berarti tepat segaris di bawah teks kepala</p>
			</td>
			<td>
				<div class="input-group"><input type="number" name="posisi_y" class="form-control" min="0" max="20"><span class="input-group-addon">milimeter</span></div> <p class="help-block">0 .s.d. 20 mm</p></td><td><div class="input-group"><input type="number" name="lebar" class="form-control"  min="0" max="40"><span class="input-group-addon">milimeter</span></div><p class="help-block"></td><td><div class="input-group"><input type="number" name="tinggi" class="form-control"  min="0" max="30"><span class="input-group-addon">milimeter</span></div></td>
</tr>
		<tr><td>Rapor Kurikulum 2006</td>
			<td>
				<div class="input-group"><input type="number" name="px_rapor" min="0" max="20" class="form-control"><span class="input-group-addon">milimeter</span></div> <p class="help-block">0 berarti 2 cm disebelah kiri teks kepala, 10 berarti 1 cm disebelah kiri teks kepala, 20 berarti tepat segaris di bawah teks kepala</p>
			</td>
			<td>
				<div class="input-group"><input type="number" name="py_rapor" class="form-control" min="0" max="20"><span class="input-group-addon">milimeter</span></div> <p class="help-block">0 .s.d. 20 mm</p></td><td><div class="input-group"><input type="number" name="l_rapor" class="form-control"  min="0" max="40"><span class="input-group-addon">milimeter</span></div><p class="help-block"></td><td><div class="input-group"><input type="number" name="t_rapor" class="form-control"  min="0" max="30"><span class="input-group-addon">milimeter</span></div></td>
</tr>
			<tr><td>UTS</td><td><div class="input-group"><input type="number" name="px_uts" class="form-control" min="75"><span class="input-group-addon">milimeter</span></div><p class="help-block">minimum 75</p></td><td><div class="input-group"><input type="number" name="py_uts" class="form-control" min="0" max="20"><span class="input-group-addon">milimeter</span></div><p class="help-block">0 .s.d. 20 mm</p></div></td><td><div class="input-group"><input type="number" name="l_uts" class="form-control"  min="0" max="40"><span class="input-group-addon">milimeter</span></div></td><td><div class="input-group"><input type="number" name="t_uts" class="form-control"  min="0" max="30"><span class="input-group-addon">milimeter</span></div></td>
</tr>
			<tr><td>Kartu Tes</td><td><div class="input-group"><input type="number" name="px_kartu" class="form-control" min="116"><span class="input-group-addon">milimeter</span></div><p class="help-block">minimum 116 mm</p></td><td><div class="input-group"><input type="number" name="py_kartu" class="form-control" min="0" max="20"><span class="input-group-addon">milimeter</span></div><p class="help-block">0 .s.d. 20 mm</p></td><td><div class="input-group"><input type="number" name="l_kartu" class="form-control"  min="0" max="40"><span class="input-group-addon">milimeter</span></div></td><td><div class="input-group"><input type="number" name="t_kartu" class="form-control"  min="0" max="30"><span class="input-group-addon">milimeter</span></div></td>
</tr></table>
	<input type="hidden" name="proses" value="baru">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN DATA</button></p>
	</form>
	<?php
}
elseif($aksi == 'ubah')
{
	echo '<a href="'.base_url().'pengajaran/kepala" class="btn btn-info" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Daftar Penjabat Kepala</a><p> </p>';
	if (empty($id))
	{
		header('Location: '.base_url().'pengajaran/kepala/tampil');
	}
	else
	{
		$daftar_kepala=$this->Admin_model->Tampil_Data_Kepala($id);
		if(count($daftar_kepala->result())==0)
		{
			echo 'Data kepala yang dimaksud tidak ada';
		}
		else
		{
			foreach($daftar_kepala->result() as $kk)
			{
				$thnajaran = $kk->thnajaran;
				$semester = $kk->semester;
				$posisi_x = $kk->posisi_x;
				$posisi_y = $kk->posisi_y;
				$lebar = $kk->lebar;
				$tinggi = $kk->tinggi;
				$px_uts = $kk->px_uts;
				$py_uts = $kk->py_uts;
				$l_uts = $kk->l_uts;
				$t_uts = $kk->t_uts;
				$px_kartu = $kk->px_kartu;
				$py_kartu = $kk->py_kartu;
				$l_kartu = $kk->l_kartu;
				$t_kartu = $kk->t_kartu;
				$kodeguru = $kk->kodeguru;
				$nama = $kk->nama;
				$nip = $kk->nip;
				$px_rapor = $kk->px_rapor;
				$py_rapor = $kk->py_rapor;
				$l_rapor = $kk->l_rapor;
				$t_rapor = $kk->t_rapor;

			}
			echo form_open('pengajaran/kepala/tampil','class="form-horizontal" role="form"');?>
			<div class="form-group row">
				<div class="col-sm-3"><label for="" class="control-label">Tahun Pelajaran</label></div>
				<div class="col-sm-9"><select name="thnajaran" class="form-control">
				<?php
				echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
				?>
				</select></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Semester</label></div>
				<div class="col-sm-9"><select name="semester" class="form-control">
					<?php
					echo "<option value='".$semester."'>".$semester."</option>";
					?>
				</select></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Nama Kepala</label></div>
				<div class="col-sm-9">
				<select name="kodeguru" class="form-control">
				<?php
				$tguru = $this->db->query("select * from `p_pegawai` where `kd`='$kodeguru'");
				foreach($tguru->result() as $dg)
				{
					$nama_kepala = $dg->nama;
					$nip_kepala = $dg->nip;
				}
				echo "<option value='".$kodeguru."'>".$nama_kepala."</option>";
				foreach($daftar_guru->result_array() as $ka)
				{
					echo "<option value='".$ka["kd"]."'>".$ka["nama"]."</option>";
				}
				?>
				</select></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Nama Saat Menjabat Kepala</label></div>
				<div class="col-sm-9">
				<?php
				if(empty($nama))
				{
					echo '<input type="text" name="nama" value="'.$nama_kepala.'" class="form-control">';
				}
				else
				{
					echo '<input type="text" name="nama" value="'.$nama.'" class="form-control">';
				}
				?>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Nama Saat Menjabat Kepala</label></div>
				<div class="col-sm-9">
				<?php
				if(empty($nip))
				{
					echo '<input type="text" name="nip" value="'.$nip_kepala.'" class="form-control">';
				}
				else
				{
					echo '<input type="text" name="nip" value="'.$nip.'" class="form-control">';
				}
				?>
				</div>
			</div>

			<table class="table table-striped table-hover table-bordered"><tr align="center"><td>Tanda Tangan Untuk</td><td>Margin Kiri</td><td>Posisi relatif dari teks kepala (vertikal)</td><td>Lebar tanda tangan</td><td>Tinggi tanda tangan</td></tr>
			<tr><td>Rapor  Kurikulum 2013</td><td><div class="input-group"><input type="number" name="posisi_x" class="form-control" value="<?php echo $posisi_x;?>"><span class="input-group-addon">milimeter</span></div>  <p class="help-block">( 0 berarti 2 cm disebelah kiri teks kepala, 10 berarti 1 cm disebelah kiri teks kepala, 20 berarti tepat segaris di bawah teks kepala )</p></td><td><div class="input-group"><input type="number" name="posisi_y" class="form-control" value="<?php echo $posisi_y;?>" min="0" max="20"><span class="input-group-addon">milimeter</span></div><p class="help-block">(0 .s.d. 20 mm)</p></td><td><div class="input-group"><input type="number" name="lebar" class="form-control" value="<?php echo $lebar;?>"><span class="input-group-addon">milimeter</span></div></td><td><div class="input-group"><input type="text" name="tinggi" class="form-control" value="<?php echo $tinggi;?>"><span class="input-group-addon">milimeter</span></div></td>
</tr>
		<tr><td>Rapor Kurikulum 2006</td>
			<td>
				<div class="input-group"><input type="number" name="px_rapor" min="0" max="20" value="<?php echo $px_rapor;?>" class="form-control"><span class="input-group-addon">milimeter</span></div> <p class="help-block">0 berarti 2 cm disebelah kiri teks kepala, 10 berarti 1 cm disebelah kiri teks kepala, 20 berarti tepat segaris di bawah teks kepala</p>
			</td>
			<td>
				<div class="input-group"><input type="number" name="py_rapor" value="<?php echo $py_rapor;?>"  class="form-control" min="0" max="20"><span class="input-group-addon">milimeter</span></div> <p class="help-block">0 .s.d. 20 mm</p></td><td><div class="input-group"><input type="number" name="l_rapor" value="<?php echo $l_rapor;?>" class="form-control"  min="0" max="40"><span class="input-group-addon">milimeter</span></div><p class="help-block"></td><td><div class="input-group"><input type="number" name="t_rapor" value="<?php echo $t_rapor;?>" class="form-control"  min="0" max="30"><span class="input-group-addon">milimeter</span></div></td>
</tr>

			<tr><td>UTS</td><td><div class="input-group"><input type="number" name="px_uts" class="form-control" value="<?php echo $px_uts;?>" min="75"><span class="input-group-addon">milimeter</span></div><p class="help-block">75 &lt; ... </p></td><td><div class="input-group"><input type="number" name="py_uts" class="form-control" value="<?php echo $py_uts;?>" min="0" max="20"> <p class="help-block">0 .s.d. 20 mm</p></td><td><div class="input-group"><input type="number" name="l_uts" class="form-control" value="<?php echo $l_uts;?>"><span class="input-group-addon">milimeter</span></div></td><td><div class="input-group"><input type="text" name="t_uts" class="form-control" value="<?php echo $t_uts;?>"><span class="input-group-addon">milimeter</span></div> </td>
</tr>
			<tr><td>Kartu Tes</td><td><div class="input-group"><input type="number" name="px_kartu" class="form-control" value="<?php echo $px_kartu;?>" min="116"><span class="input-group-addon">milimeter</span></div>  <p class="help-block">116 &lt; ... </p></td><td><div class="input-group"><input type="number" name="py_kartu" class="form-control" value="<?php echo $py_kartu;?>" min="0" max="20"><span class="input-group-addon">milimeter</span></div> <p class="help-block">0 .s.d. 20 mm</td><td><div class="input-group"><input type="number" name="l_kartu" class="form-control" value="<?php echo $l_kartu;?>"><span class="input-group-addon">milimeter</span></div> </td><td><div class="input-group"><input type="text" name="t_kartu" class="form-control" value="<?php echo $t_kartu;?>"><span class="input-group-addon">milimeter</span></div> </td>
</tr>
<tr><td colspan="5"><input type="hidden" name="proses" value="lama"><input type="hidden" name="id_kepala" value="<?php echo $id;?>"><p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN DATA</button></p></td></table></form>
		<?php
		}
	}
}
else
{?>
	<a href="<?php echo base_url(); ?>pengajaran/kepala/tambah" class="btn btn-info"><span class="fa fa-plus"></span> <b>Kepala <?php echo ucwords($this->config->item('sek_tipe'));?></b></a><p></p>
	<div class="table-responsive"><table class="table table-hover table-striped table-bordered">	
	<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Nama</strong></td><td><strong>NIP</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
	<?php
	$nomor=$page+1;
	foreach($query->result() as $b)
	{
	echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->thnajaran."</td><td align=\"center\">".$b->semester."</td><td>".$b->nama."</td><td>".$b->nip."</td><td align=\"center\"><a href='".base_url()."pengajaran/kepala/ubah/".$b->id_kepala."' title='Edit'><span class=\"fa fa-edit\"></span></a></td>
</tr>";
	$nomor++;
	}
	?>
	</table></div>
	<?php
	if (!empty($paginator))
	{
		?>
		<p class="text-center"><?php echo $paginator;?></p>
		<?php 
	}
}?>
</div></div></div>
