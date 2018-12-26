<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		pembagian_tugas.php
// Lokasi      		application/views/guru/
// Author      		Selamet Hanafi
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php 
echo 'Mapel '.$guru;
if(($aksi == 'hapus') and (!empty($id_mapel)))
{
	$this->db->query("delete from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
}
if($guru == 'wajib')
{
	$pilihan = 0;
}
else
{
	$pilihan = 1;
}

$kelas = '';
$kurikulum = '?';
$tb = $this->db->query("select * from `m_walikelas` where `id_walikelas`= '$id_walikelas'");
foreach($tb->result() as $b)
{
	$kelas = $b->kelas;
	$kurikulum = $b->kurikulum;
}
$xloc = base_url().'guru/pembagiantugas/'.$guru;
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
?>
	<div class="form-group row row">
		<div class="col-sm-3" ><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $thnajaran;?></p></div>
	</div>
<div class="form-group row row">
		<div class="col-sm-3" ><label for="semester" class="control-label">Semester</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $semester;?></p></div>
	</div>
<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
echo "<select name=\"id_walikelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value="'.$xloc.'/'.$id_walikelas.'">'.$kelas.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}
	echo '</select><p class="help-block">Kalau belum ada kelas, silakan menghubungi pengajaran untuk menata walikelas</p></div></div>';


echo '</form>';
if(!empty($id_walikelas))
{
	echo 'Kurikulum : '.$kurikulum;
?>
<form class="form-horizontal" role="form" action="<?php echo base_url().'guru/pembagiantugas/'.$guru.'/'.$id_walikelas;?>" method="post">
	
	<div class="form-group row row">
		<div class="col-sm-3" ><label for="mapel" class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-9" >
 			<select name="mapel" class="form-control" required>
				<?php
				if($guru == 'wajib')
				{
					echo '<option value="'.$mapel.'">'.$mapel.'</option>';
					$tc = $this->db->query("SELECT * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `nama_mapel_portal`");
					foreach($tc->result() as $c)
					{
						$namamapel = $c->nama_mapel_portal;
						if(!empty($namamapel))
						{
							echo "<option value='".$c->nama_mapel_portal."'>".$c->nama_mapel_portal."</option>";
						}
					}
				}
				else
				{
					echo '<option value="'.$mapel.'">'.$mapel.'</option>';
					$tc = $this->db->query("SELECT * from `tblkategoritutorial`where `nama_kategori` like '%prakarya%' order by `nama_kategori`");
					foreach($tc->result() as $c)
					{
						$namamapel = $c->nama_kategori;
						echo "<option value='".$c->nama_kategori."'>".$c->nama_kategori."</option>";
					}
				}

				echo '</select>';
				?>
		</div>
	</div>
	
	<div class="form-group row row">
		<div class="col-sm-3" ><label for="ranah" class="control-label">Ranah Penilaian</label></div>
		<div class="col-sm-9" >
 			<select name="ranah" class="form-control" required>
				<?php
				if($kurikulum == '2018')
				{
					echo '<option value="KP">Pengetahuan dan Keterampilan</option>';
				}
				elseif($kurikulum == '2015')
				{
					echo '<option value="KP">Pengetahuan dan Keterampilan</option>';
				}
				elseif($kurikulum == '2013')
				{
					echo '<option value="KPA">Kognitif Psikomotor Afektif</option>';
				}
				elseif($kurikulum == 'KTSP')
				{
					echo '<option value="KPA">Kognitif Psikomotor Afektif</option>
					<option value="KA">Kognitif Afektif</option>
					<option value="PA">Psikomotor Afektif</option>';
				}
				else
				{
					echo '<option value="">Kurikulum penilaian belum ditentukan</option>';
				}
			?>
			</select>
		</div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label for="jam" class="control-label">Jam Tatap Muka</label></div>
		<div class="col-sm-9" ><input type="text" name="jam" placeholder="cacah jam tatap muka" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label for="kkm" class="control-label">KKM</label></div>
		<div class="col-sm-9" ><input type="text" name="kkm" placeholder="kkm" class="form-control" required></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label for="kkm" class="control-label">Jenis Deskripsi</label></div>
		<div class="col-sm-9" >
			<select name="jenis_deskripsi" class="form-control">
				<option value="6"><?php echo $this->config->item('versi_deskripsi');?></option>
				<option value="1">Berdasarkan Ulangan (Deskripsi Otomatis)</option>
				<option value="5">Berdasarkan Nilai Rapor (Deskripsi Otomatis)</option>
				<option value="3">Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)</option>
				<option value="4">Berdasar bank deskripsi</option>
				<option value="">Copy Paste / Manual</option>
			</select>
		</div>
	</div>

	<p class="text-center"><input type="hidden" name="kelas" value="<?php echo $kelas;?>"><input type="hidden" name="pilihan" value="<?php echo $pilihan;?>"><input type="hidden" name="kode_guru" value="<?php echo $kodeguru;?>"><input type="hidden" name="semester" value="<?php echo $semester;?>" class="form-control"><input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>" class="form-control"><button type="submit" class="btn btn-primary">Simpan</button></p>
</form>
<?php
}
echo '<div class="table-responsive"><table class="table table-hover table-bordered"><thead>
<tr align="center"><td><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Teks Mapel Tampil di Rapor</strong></td><td><strong>Wajib / Pilihan</strong></td><td><strong>Ranah</strong></td><td><strong>KKM</strong></td><td><strong>JTM</strong></td><td><strong>Hapus</strong></td></tr></thead>';
$nomor=1;
$jtm = 0;
$daftar_mapel = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' and `pilihan`='$pilihan'");
foreach($daftar_mapel->result() as $b)
{
	$mapel = $b->mapel;
	$kelas = $b->kelas;
	if($b->pilihan == 1)
	{
		$pilihan = 'Pilihan';
	}
	else
	{
		$pilihan = 'Wajib';
	}


echo "<tbody><tr><td align='center'>".$nomor."</td><td>".$b->kelas."</td>";
$mapele = '<div class="alert alert-danger">Awas! Mapel <strong>'.$b->mapel.'</strong> ini tidak akan tampil di rapor, hubungi Pengajaran</div>';
$ta = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `nama_mapel_portal`='$mapel'");
$adadirapor = $ta->num_rows();
if($adadirapor >0)
	{
	foreach($ta->result() as $a)
		{
		$mapele = $a->nama_mapel;
		}
	}
else
{
	$tc = $this->db->query("select * from `m_prakarya` where `mapel`='$mapel'");
	$adatc = $tc->num_rows();
	if($adatc>0)
	{
		foreach($tc->result() as $c)
		{
			$mapele = $c->mapel;
		}
	}
}
echo "<td>".$mapele."<p class=\"text-info\">".$mapel."</p></td><td align='center'>".$pilihan."</td><td align='center'>".$b->ranah."</td><td align='center'>".$b->kkm."</td><td align='center'>".$b->jam."</td><td  align='center'>";
if(($adadirapor >0) or ($adatc >0))
	{
	echo '<a href="'.base_url().'guru/pembagiantugas/hapus/'.$b->id_mapel.'" data-confirm="Anda yakin ingin menghapus data '.$b->thnajaran.' smt '.$b->semester.' kelas '.$b->kelas.' mapel '.$b->mapel.'?" title="Hapus Pembagian Tugas"><span class="fa fa-trash-alt"></span></a>';
	}
echo "</td></tr></tbody>";
$jtm = $jtm + $b->jam;
$nomor++;
}
?>
</table></div>
Jumlah JTM = 
<?php
echo $jtm;
if($jtm>0)
{
	//kepala
	$te = $this->db->query("SELECT * FROM `guru_data_supervisi` where `username`='$nim' and `thnajaran` = '$thnajaran' and `semester` = '$semester' and `supervisor`='kepala'");
	if($te->num_rows()==0)
	{
		$this->db->query("insert into `guru_data_supervisi` (`username`, `thnajaran`, `semester`, `supervisor`) values ('$nim',  '$thnajaran', '$semester', 'kepala')");
	}
	//pengawas
	$te = $this->db->query("SELECT * FROM `guru_data_supervisi` where `username`='$nim' and `thnajaran` = '$thnajaran' and `semester` = '$semester' and `supervisor`='pengawas'");
	if($te->num_rows()==0)
	{
		$this->db->query("insert into `guru_data_supervisi` (`username`, `thnajaran`, `semester`, `supervisor`) values ('$nim',  '$thnajaran', '$semester', 'pengawas')");
	}
}
?>
</div></div></div>
