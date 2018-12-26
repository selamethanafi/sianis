<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: tahun.php
// Lokasi      		: application/views/tatausaha/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<h3>Tahun Penilaian : <?php echo $tahun;?></h3>
<?php
if ($aksi == 'tambah')
	{
	?>
	<p><a href="<?php echo base_url(); ?>tatausaha/pejabatpenilaippk" class="btn btn-info"><b>Daftar Pejabat Penilai</b></a></p>
	<?php echo form_open('tatausaha/pejabatpenilaippk','class="form-horizontal" role="form"');
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-9"><p class="form-control-static">'.$tahun.'</div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Untuk Menilai</label></div><div class="col-sm-9"><select name="dinilai" class="form-control">';
	echo "<option value='guru'>guru</option>";
	echo "<option value='tatausaha'>tatausaha</option>";
	echo "<option value='kepala'>kepala</option>";
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="nama_penilai" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="nip_penilai" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pangkat Golongan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="pangkat_golongan" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jabatan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="jabatan" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Unit Organiasi Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="unit_organisasi" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="nama_atasan" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="nip_atasan" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pangkat Golongan Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="pangkat_golongan_atasan" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jabatan Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="jabatan_atasan" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Unit Organisasi Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="unit_organisasi_atasan" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label"></td><td></td><td><input type="hidden" name="proses" class="form-control" size="5" value="oke"><input type="submit" value="Simpan Data" class="tombol-merah"></div></div>
</table></form>';
	}
elseif ($aksi == 'ubah')
	{
	if (empty($id))
		{
		echo 'Galat, data tidak ditemukan, karena kode kosong <a href="'.base_url().'tatausaha/pejabatpenilaippk"><b>Kembali</b></a>';

		}
		else
		{
		$ta=$this->db->query("SELECT * from `pejabat_penilai` where `id_pejabat`='$id'");
		if(count($ta->result()) == 0)
			{

			echo 'Galat, data tidak ditemukan <a href="'.base_url().'tatausaha/pejabatpenilaippk"><b>Kembali</b></a>';
			}
			else
			{
				foreach($ta->result() as $a)
				{
				$dinilai = $a->dinilai;	
				$nama_penilai = $a->nama_penilai;	
				$nip_penilai = $a->nip_penilai;
				$pangkat_golongan = $a->pangkat_golongan;
				$jabatan = $a->jabatan;
				$unit_organisasi = $a->unit_organisasi;
				$nama_atasan = $a->nama_atasan;
				$nip_atasan = $a->nip_atasan;
				$pangkat_golongan_atasan = $a->pangkat_golongan_atasan;
				$jabatan_atasan = $a->jabatan_atasan;
				$unit_organisasi_atasan = $a->unit_organisasi_atasan;
				}
			?>
			<a href="<?php echo base_url(); ?>tatausaha/pejabatpenilaippk"><div class="pagingpage"><b> + Daftar Pejabat Penilai </b></div></a>
			<?php echo form_open('tatausaha/pejabatpenilaippk','class="form-horizontal" role="form"');
			echo 'Ubah Data 
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-9">'.$tahun.'</div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Untuk Menilai</label></div><div class="col-sm-9"><select name="dinilai" class="form-control">';
	echo "<option value='".$dinilai."'>".$dinilai."</option>";
	echo "<option value='guru'>guru</option>";
	echo "<option value='tatausaha'>tatausaha</option>";
	echo "<option value='kepala'>kepala</option>";
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="nama_penilai" class="form-control"  value="'.$nama_penilai.'"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="nip_penilai" class="form-control" value="'.$nip_penilai.'" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pangkat Golongan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="pangkat_golongan" class="form-control"  value="'.$pangkat_golongan.'"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jabatan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="jabatan" class="form-control"  value="'.$jabatan.'"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Unit Organiasi Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="unit_organisasi" class="form-control"  value="'.$unit_organisasi.'"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="nama_atasan" class="form-control"  value="'.$nama_atasan.'"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="nip_atasan" class="form-control"  value="'.$nip_atasan.'"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pangkat Golongan Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="pangkat_golongan_atasan" class="form-control"  value="'.$pangkat_golongan_atasan.'"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jabatan Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="jabatan_atasan" class="form-control"  value="'.$jabatan_atasan.'"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Unit Organisasi Atasan Pejabat Penilai</label></div><div class="col-sm-9"><input type="text" name="unit_organisasi_atasan" class="form-control"  value="'.$unit_organisasi_atasan.'"></div></div><input type="hidden" name="id_pejabat" class="form-control" size="5" value="'.$id.'"><input type="hidden" name="proses" class="form-control" size="5" value="oke"><p class="text-center"><input type="submit" value="Ubah Data Pejabat Penilai" class="btn btn-primary"></p></form>';
			}
		}
	}

else
{
?>
<p><a href="<?php echo base_url(); ?>tatausaha/pejabatpenilaippk/tambah" class="btn btn-info"><b>Tambah Pejabat Penilai</b></a></p>
<?php }?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="50"><strong>No.</strong></td><td><strong>Untuk Menilai</strong></td><td><strong>Pejabat Penilai</strong></td><td><strong>Atasan Pejabat Penilai</strong></td><td colspan="2"><strong>Aksi</strong></div></div>
<?php
$nomor=1;
foreach($query->result() as $b)
{
echo "<tr align=\"center\"><td>".$nomor."</td><td>".$b->dinilai."</td><td>".$b->nama_penilai." / ".$b->nip_penilai." / ".$b->pangkat_golongan." / ".$b->jabatan." / ".$b->unit_organisasi."</td><td>".$b->nama_atasan." / ".$b->nip_atasan." / ".$b->pangkat_golongan_atasan." / ".$b->jabatan_atasan." / ".$b->unit_organisasi_atasan."</td><td><a href='".base_url()."tatausaha/pejabatpenilaippk/ubah/".$b->id_pejabat."' title='Edit'><span class=\"fa fa-edit\"></span></a></td><td><a href='".base_url()."tatausaha/pejabatpenilaippk/hapus/".$b->id_pejabat."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;
}
?>
</table>
</div></div></div>
