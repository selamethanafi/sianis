<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:23:28 WIB 
// Nama Berkas 		: daftarnilai.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<p><a href="<?php echo base_url();?>guru/walikelas" class="btn btn-info">Ke halaman tugas walikelas</a> <a href="<?php echo base_url();?>guru/daftarsiswa/<?php echo $id_walikelas;?>" class="btn btn-info">Ke halaman daftar siswa</a> </p>

<form class="form-horizontal" role="form">
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $thnajaran;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Semester</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $semester;?></div></div>
<div class="form-group row row"><div class="col-sm-5"><label class="control-label">Kelas</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $kelas;?></div></div>
</form>
<?php
if($aksi == 'perbarui')
{
	foreach($daftar_siswa->result() as $t)
	{
		$nis = $t->nis;
		$ta = $this->db->query("select `nis`,`thnajaran`,`semester`,`wali` from `kepribadian` where `thnajaran`= '$thnajaran' and `semester`='$semester' and `nis`='$nis'");
		$adata = $ta->num_rows();
		if($adata == 0)
		{
			$this->db->query("insert into `kepribadian` (`nis`,`thnajaran`,`semester`,`kelas`) values ('$nis', '$thnajaran', '$semester', '$kelas')");
		}
	}
	$daftar_siswa=$this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
}
	if(count($daftar_siswa->result())>0)
	{
		if($aksi == 'ubah')
		{
			echo form_open('guru/tanggapanwalikelas/'.$id_walikelas,'class="form-horizontal" role="form"');
		}
		if($aksi != 'ubah')
		{
			echo '<div class="alert alert-info">Klik tautan Catatan Walikelas untuk mengisi tanggapan</div>';
		}
		?>

		<div class="table-responsive">
		<table class="table table-hover table-striped table-bordered">
		<tr align="center"><td width="50"><strong>No</strong></td><td width="20%"><strong>Nama</strong></td><td><a href="<?php echo base_url();?>guru/tanggapanwalikelas/<?php echo $id_walikelas;?>/ubah" title="Ubah tanggapan"><b>Catatan Walikelas</b></a></td></tr>
		<?php
		$nomor = 1;
		foreach($daftar_siswa->result() as $t)
		{
			$nis = $t->nis;
			$namasiswa = nis_ke_nama($nis);
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td>';
			//cari tanggapan
			$ta = $this->db->query("select `id_kepribadian`,`nis`,`thnajaran`,`semester`,`wali` from `kepribadian` where `thnajaran`= '$thnajaran' and `semester`='$semester' and `nis`='$nis'");
			$adata = $ta->num_rows();
			if($aksi == 'ubah')
			{
					foreach($ta->result() as $a)
					{
						echo '<td><input type="hidden" name="id_kepribadian_'.$nomor.'" value="'.$a->id_kepribadian.'"><textarea name="tanggapan_'.$nomor.'" rows="2" class="form-control">'.$a->wali.'</textarea></td>';
					}

			}
			else
			{
				if($adata == 0)
				{
					echo '<td><div class="alert alert-info">Perbarui daftar siswa</div></td>';
				}
				else
				{
					foreach($ta->result() as $a)
					{
						echo '<td>'.$a->wali.'</td>';
					}
				}
			}
			echo '</tr>';
			$nomor++;
		}
		echo '</table></div>';
		if($aksi == 'ubah')
		{
			$cacahsiswa = $nomor - 1;
			echo '<input type="hidden" name="cacahsiswa" value="'.$cacahsiswa.'">';
			echo '<p class="text-center"><input type="submit" value="Simpan Tanggapan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/tanggapanwalikelas/'.$id_walikelas.'" class="btn btn-info">Batal</a></p></form>';
		}
		else
		{
			echo '<p class="text-center"><a href="'.base_url().'guru/tanggapanwalikelas/'.$id_walikelas.'/perbarui" class="btn btn-info">Perbarui Daftar Siswa</a></p>';
		}

	}
	else
	{
		echo '<div class="alert alert-danger">Galat! Tidak ada di siswa di kelas ini</div>';
	}

?>
</div>
