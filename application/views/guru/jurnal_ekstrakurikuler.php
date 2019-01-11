<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: ekstrakurikuler.php
// Terakhir diperbarui	: Kam 10 Jan 2019 20:09:56 WIB 
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
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
   <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$bisa = 0;
$xloc = base_url().'ekstrakurikuler/jurnal';
echo form_open($xloc,'class="form-horizontal" role="form"');
?>
<div class="form-group row">
	<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9">
		<select name="thnajaran" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
		foreach($daftar_tapel->result() as $k)
		{
			$thn1 = substr($k->thnajaran,0,4);
			echo '<option value="'.$xloc.'/'.$thn1.'">'.$k->thnajaran.'</option>';
		}
		?>
		</select>
        </div>
</div>
<div class="form-group row">	
	<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
	<div class="col-sm-9">
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo "<option value='".$semester."'>".$semester."</option>";
		$thn1 = substr($thnajaran,0,4);
		echo '<option value="'.$xloc.'/'.$thn1.'/1">1</option>';
		echo '<option value="'.$xloc.'/'.$thn1.'/2">2</option>';
		echo '</select>';
		?>
	</div>
</div>
<?php
	$namaekstra = '';
	$kelasekstra = '';
	$kelas = '';
	$tpengampu = $this->db->query("select * from m_pengampu_ekstra where id_pengampu_ekstra = '$id_pengampu_ekstra'");
	foreach($tpengampu->result() as $dp)
		{
		$namaekstra = $dp->namaekstra;
		$kelasekstra = $dp->kelas;
		}
?>
<div class="form-group row">	
	<div class="col-sm-3"><label for="semester" class="control-label">Ekstrakurikuler</label></div>
	<div class="col-sm-9">
		<select name="id_pengampu_ekstra" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
			echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra.'">'.$namaekstra.'</option>';
		$tpengampu1 = $this->db->query("select * from m_pengampu_ekstra where id_pengampu_ekstra != '$id_pengampu_ekstra' and `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and `semester`='$semester'");
		foreach($tpengampu1->result() as $dp1)
		{
			$namaekstra1 = $dp1->namaekstra;
			$kelasekstra1 = $dp1->kelas;
			$id_pengampu_ekstra1 = $dp1->id_pengampu_ekstra;
			$thn1 = substr($thnajaran,0,4);
			echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra1.'">'.$namaekstra1.'</option>';
		}
		echo '</select>';
		?>
	</div>
</div>
</form>
<?php
if((empty($aksi)) and (!empty($namaekstra)))
{
	echo '<p><a href="'.base_url().'ekstrakurikuler/jurnal/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra1.'/tambah" class="btn btn-primary">Tambah</a></p>';
	$ta = $this->db->query("select * from `jurnal_ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$nim' order by tanggal DESC");
	echo '<table class="table table-striped table-bordered table-hover"><tr align="center"><td>Nomor</td><td>Tanggal</td><td>Keterangan</td><td>Aksi</td></tr>';
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		echo '<tr align="center"><td>'.$nomor.'</td><td>'.tanggal($a->tanggal).'</td><td>'.$a->keterangan.'</td><td><a href="'.base_url().'ekstrakurikuler/jurnal/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra1.'/hapus/'.$a->id.'" data-confirm="Hendak menghapus '.$a->keterangan.'?"><span class="fa fa-trash"></span></a></td></tr>';
		$nomor++;
	}
	
	echo '</table>';
}
if($aksi == 'tambah')
{
	echo form_open('ekstrakurikuler/jurnal/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra1.'/baru', 'class="form-horizontal" role="form"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9">';
		$tglhariini = tanggal_slash(tanggal_hari_ini());
		?>
		<input id="datepicker" format="dd-mm-yyyy" name="tanggal" value="<?php echo $tglhariini;?>"  width="276" />
		<script>
		        $('#datepicker').datepicker({ format: 'dd-mm-yyyy',
				            uiLibrary: 'bootstrap4'
		        });
		</script>
		<?php
	echo '</div></div>';
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Keterangan</label></div>
		<div class="col-sm-9"><textarea name="keterangan" row="2" class="form-control"></textarea></div>
	     </div>';

	echo '<p class="text-center"><input type="hidden" name="nama_ekstra" value="'.$namaekstra1.'"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
		echo '</form>';
}
?>
</div></div></div>
