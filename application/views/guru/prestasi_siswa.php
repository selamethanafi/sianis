<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 10 Nov 2014 20:46:37 WIB 
// Nama Berkas 		: nilai.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<div class="container-fluid"><h3>Modul Prestasi / Organisasi Siswa</h3>
<?php
if($aksi == 'hapusprestasi')
	{
	$td = $this->db->query("select * from `siswa_prestasi` where `id_siswa_prestasi`='$id_siswa_prestasi'");
	foreach($td->result() as $d)
		{
		$thnajaran = $d->thnajaran;
		}
	$this->db->query("delete from `siswa_prestasi` where `id_siswa_prestasi`='$id_siswa_prestasi'");
	$aksi = '';
	}
if($aksi == 'hapusorganisasi')
	{
	$tc = $this->db->query("select * from `siswa_organisasi` where `id_siswa_prestasi`='$id_siswa_prestasi'");
	foreach($tc->result() as $c)
		{
		$thnajaran = $c->thnajaran;
		}
	$this->db->query("delete from `siswa_organisasi` where `id_siswa_prestasi`='$id_siswa_prestasi'");
	$aksi = '';
	}

if($proses == 'ubahdata')
	{
	if ($tipedata == 'prestasi')
		{
		$this->db->query("update `siswa_prestasi` set `thnajaran`='$thnajaran', `nis`='$nis', `kegiatan`= '$kegiatan', `keterangan`= '$keterangan' where `id_siswa_prestasi`='$id_siswa_prestasi_ubah'");
		}
		else
		{
		$this->db->query("update `siswa_organisasi` set `thnajaran`='$thnajaran', `nis`='$nis', `organisasi`='$kegiatan', `keterangan`= '$keterangan' where `id_siswa_prestasi`='$id_siswa_prestasi_ubah'");
		}
	$aksi = '';
	}
if($aksi == 'ubahprestasi')
	{
	echo form_open('guru/prestasisiswa');
	echo '<table class="table">';
	$td = $this->db->query("select * from `siswa_prestasi` where `id_siswa_prestasi`='$id_siswa_prestasi'");
	$adadata = $td->num_rows();
	if($adadata>0)
		{
		foreach($td->result() as $d)
			{
			$thnajaran = $d->thnajaran;
			$nis = $d->nis;
			$kegiatan = $d->kegiatan;
			$keterangan = $d->keterangan;
			}
		echo '<tr><td>Tahun Pelajaran</td><td>
		<input name="id_siswa_prestasi_ubah" type="hidden" value="'.$id_siswa_prestasi.'"><input name="proses" type="hidden" value="ubahdata"><input name="thnajaran" type="hidden" value="'.$thnajaran.'">'.$thnajaran.'</td></tr>';
		echo '<tr><td>Siswa</td><td>
		<select name="nis" class="form-control">';
		echo "<option value='".$nis."'>".nis_ke_nama($nis)."</option>";
		echo '</select><font color="#FF0000"><strong> Pilih Siswa</strong></font></td></tr>';
		echo '<tr><td>Prestasi / Organisasi</td><td>
		<select name="tipedata" class="form-control">';
		echo "<option value='prestasi'>prestasi</option>";
		echo '</select><font color="#FF0000"><strong> Pilih Tipe Data</strong></font></td></tr>';
		echo '<tr><td>Kegiatan / Organisasi</td><td>
		<input name="kegiatan" size="40" type="text" class="form-control" value="'.$kegiatan.'"></td></tr>';
		echo '<tr><td>Keterangan</td><td>
		<input name="keterangan" type="text" size="40" class="form-control" value="'.$keterangan.'"></td></tr>';
		echo '<tr><td></td><td>';
		echo '<input type="submit" value="Ubah Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/prestasisiswa"><b>Batal</b></a></td></tr>';
		}
		else
		{
		echo 'data tidak ada';
		}
	echo '</table></form>';
	}
if($aksi == 'ubahorganisasi')
	{
	echo form_open('guru/prestasisiswa');
	echo '<table class="table">';
	$te = $this->db->query("select * from `siswa_organisasi` where `id_siswa_prestasi`='$id_siswa_prestasi'");
	$adadata = $te->num_rows();
	if($adadata>0)
		{
		foreach($te->result() as $e)
			{
			$thnajaran = $e->thnajaran;
			$nis = $e->nis;
			$kegiatan = $e->organisasi;
			$keterangan = $e->keterangan;
			}
		echo '<tr><td>Tahun Pelajaran</td><td>
		<input name="id_siswa_prestasi_ubah" type="hidden" value="'.$id_siswa_prestasi.'"><input name="proses" type="hidden" value="ubahdata"><input name="thnajaran" type="hidden" value="'.$thnajaran.'">'.$thnajaran.'</td></tr>';
		echo '<tr><td>Siswa</td><td>
		<select name="nis" class="form-control">';
		echo "<option value='".$nis."'>".nis_ke_nama($nis)."</option>";
		echo '</select></td></tr>';
		echo '<tr><td>Prestasi / Organisasi</td><td>
		<select name="tipedata" class="form-control">';
		echo "<option value='organisasi'>organisasi</option>";
		echo '</select></td></tr>';
		echo '<tr><td>Kegiatan / Organisasi</td><td>
		<input name="kegiatan" type="text" class="form-control" value="'.$kegiatan.'"></td></tr>';
		echo '<tr><td>Keterangan</td><td>
		<input name="keterangan" type="text"  class="form-control" value="'.$keterangan.'"></td></tr>';
		echo '<tr><td></td><td>';
		echo '<input type="submit" value="Ubah Data" class="btn btn-primary"> <a href="'.base_url().'guru/prestasisiswa" class="btn btn-info"> <b>Batal</b></a></td></tr>';
		}
		else
		{
		echo 'data tidak ada';
		}
	echo '</table></form>';
	}

if ((!empty($thnajaran)) and (!empty($nis)) and (!empty($tipedata)) and (!empty($kegiatan)))
	{
	if(empty($proses))
		{
		if ($tipedata == 'prestasi')
			{
			$this->db->query("insert into `siswa_prestasi` (`thnajaran`,`nis`,`kegiatan`,`keterangan`,`valid`) values ('$thnajaran','$nis','$kegiatan','$keterangan','1')");
			}
			else
			{
			$this->db->query("insert into `siswa_organisasi` (`thnajaran`,`nis`,`organisasi`,`keterangan`,`valid`) values ('$thnajaran','$nis','$kegiatan','$keterangan','1')");
			}
		}
	}
if(empty($aksi))
{
echo form_open('guru/prestasisiswa');
echo '<table class="table">';
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
	{
	echo '<tr><td>Tahun Pelajaran</td><td>
	<input name="thnajaran" type="hidden" value="'.$thnajaran.'">'.$thnajaran.'</td></tr>';
	echo '<tr><td>Semester</td><td>
	<input name="semester" type="hidden" value="'.$semester.'">'.$semester.'</td></tr>';
	echo '<tr><td>Kelas</td><td>
	<input name="kelas" type="hidden" value="'.$kelas.'">'.$kelas.'</td></tr>';
	}
if ((empty($thnajaran)) or (empty($semester)) or (empty($kelas)))
	{
	echo '<tr><td>Tahun Pelajaran</td><td>
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
		foreach($daftar_tapel->result_array() as $k)
		{
		echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
		echo '</select></td></tr>';
		echo '<tr><td>Semester</td><td>
		<select name="semester" class="form-control">';
		echo '<option value="1">1</option>';
		echo '<option value="2">2</option></select></td></tr>';
	echo '<tr><td>Kelas</td><td>
	<select name="kelas" class="form-control">';
	echo "<option value='".$kelas."'>".$kelas."</option>";
	$daftar_kelas = $this->db->query("SELECT * from `m_ruang` order by `ruang`");
		foreach($daftar_kelas->result_array() as $ka)
		{
		echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
		}
	echo '</select></td></tr>';
	echo '<tr><td></td><td>';
	echo '<input type="submit" value="Lanjut" class="btn btn-primary"></td></tr>';
	}
else
{
	$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
	echo '<tr><td>Siswa</td><td>
	<select name="nis" class="form-control">';
	echo "<option value=''>pilih siswa</option>";
	foreach($tc->result_array() as $c)
	{
	echo "<option value='".$c["nis"]."'>".nis_ke_nama($c["nis"])."</option>";
	}
	echo '</select></td></tr>';
	echo '<tr><td>Prestasi / Orgnisasi</td><td>
	<select name="tipedata" class="form-control">';
	echo "<option value=''>pilih organisasi / prestasi</option>";
	echo "<option value='prestasi'>prestasi</option><option value='organisasi'>organisasi</option>";
	echo '</select></td></tr>';
	echo '<tr><td>Kegiatan / Organisasi</td><td>
	<input name="kegiatan" type="text" placeholder="kegiatan atau kejuaran yang diikuti" class="form-control" required></td></tr>';
	echo '<tr><td>Keterangan</td><td>
	<input name="keterangan" type="text" placeholder = "juara / prestasi / jabatan dalam organisasi" class="form-control" required></td></tr>';
	echo '<tr><td></td><td>';
	echo '<input type="submit" value="Tambah Data" class="btn btn-primary"> <a href="'.base_url().'guru/prestasisiswa" class="btn btn-info"><b>KELAS LAIN</b></a></td></tr>';
}
echo '</table></form>';
if(!empty($thnajaran))
{
$ta = $this->db->query("select * from `siswa_prestasi` where `thnajaran`='$thnajaran' order by `nis`");
$tb = $this->db->query("select * from `siswa_organisasi` where `thnajaran`='$thnajaran' order by `nis`");
echo '<div class="row">';
echo '<div class="col-sm-6">
		<table class="table table-hover table-striped table-bordered">
		<tr align="center"><td colspan="7"><strong>Daftar Prestasi yang dicapai Siswa</strong></td></tr>';
		$nomor=1;
		foreach($ta->result() as $a)
		{
		$nis = $a->nis;
		$kelassiswa = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		if($kelassiswa == $kelas)
		{
			echo "<tr><td align=\"center\">".$nomor."</td><td>".nis_ke_nama($a->nis)."</td><td align=\"left\">".$a->kegiatan."</td><td align=\"left\">".$a->keterangan."</td><td>".$a->valid."</td><td align=\"center\"><a href='".base_url()."guru/prestasisiswa/ubahprestasi/".$a->id_siswa_prestasi."'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."guru/prestasisiswa/hapusprestasi/".$a->id_siswa_prestasi."' onClick=\"return confirm('Anda yakin ingin menghapus data Prestasi ".$a->thnajaran." nama ".nis_ke_nama($a->nis)." ".$a->kegiatan." ".$a->keterangan." ?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
		$nomor++;
		}
		}
		echo '</table>
	</div>
	<div class="col-sm-6">
		<table class="table table-hover table-striped table-bordered">
		<tr align="center"><td colspan="7"><strong>Daftar Organisasi yang diikuti Siswa</strong></td></tr>';
		$nomor=1;
		foreach($tb->result() as $b)
		{
		$nis = $b->nis;
		$kelassiswa = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		if($kelassiswa == $kelas)
		{
			echo "<tr><td align=\"center\">".$nomor."</td><td>".nis_ke_nama($b->nis)."</td><td align=\"left\">".$b->organisasi."</td><td align=\"left\">".$b->keterangan."</td><td>".$b->valid."</td><td align=\"center\"><a href='".base_url()."guru/prestasisiswa/ubahorganisasi/".$b->id_siswa_prestasi."'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."guru/prestasisiswa/hapusorganisasi/".$b->id_siswa_prestasi."' onClick=\"return confirm('Anda yakin ingin menghapus data Organisasi ".$b->thnajaran." nama ".nis_ke_nama($b->nis)." ".$b->organisasi." ".$b->keterangan." ?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
			$nomor++;
		}
		}
echo '
		</table>
	</div>
</div>';
}
}
echo '</div>';
?>
