<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: harian.php
// Lokasi      		: application/views/sieka/
// Terakhir diperbarui	: Sen 07 Jan 2019 20:10:09 WIB 
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
$thnskr = date("Y");
$blnskr = date("m");
$tglskr = date("d");
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$xloc = base_url().'sieka/harian';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';
if(empty($thn))
{
	$thn = $thnskr;
}
if(!empty($thn))
{
	$tc = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun </label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$thn.'">'.$thn.'</option>';
	echo '<option value="'.$xloc.'/'.$thnskr.'">'.$thnskr.'</option>';
	foreach($tc->result() as $c)
	{
		echo '<option value="'.$xloc.'/'.substr($c->thnajaran,0,4).'">'.substr($c->thnajaran,0,4).'</option>';
	}
	echo '</select></div></div>';
}
if(!empty($bln))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bulan </label></div><div class="col-sm-9">';
	echo "<select name=\"bln\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$thn.'/'.$bln.'">'.$bln.'</option>';
	echo '<option value="'.$xloc.'/'.$thn.'/'.$blnskr.'">'.$blnskr.'</option>';
	for($i=1;$i<=12;$i++)
	{
		$bl = $i;
		if($bl<10)
		{
			$bl = '0'.$i;
		}
		echo '<option value="'.$xloc.'/'.$thn.'/'.$bl.'">'.$bl.'</option>';
	}
	echo '</select></div></div>';
}
if(!empty($tgl))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal </label></div><div class="col-sm-9">';
	echo "<select name=\"bln\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$thn.'/'.$bln.'/'.$tgl.'">'.$tgl.'</option>';
	echo '<option value="'.$xloc.'/'.$thn.'/'.$bln.'/'.$tglskr.'">'.$tglskr.'</option>';
	for($i=1;$i<=31;$i++)
	{
		$bl = $i;
		if($bl<10)
		{
			$bl = '0'.$i;
		}
		echo '<option value="'.$xloc.'/'.$thn.'/'.$bln.'/'.$bl.'">'.$bl.'</option>';
	}
	echo '</select></div></div>';
}

if(empty($thn))
{
	$tc = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$thn.'">'.$thn.'</option>';
	echo '<option value="'.$xloc.'/'.$thnskr.'">'.$thnskr.'</option>';
	foreach($tc->result() as $c)
	{
		echo '<option value="'.$xloc.'/'.substr($c->thnajaran,0,4).'">'.substr($c->thnajaran,0,4).'</option>';
	}
	echo '</select></div></div>';
}
elseif(empty($bln))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bulan </label></div><div class="col-sm-9">';
	echo "<select name=\"bln\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$thn.'/'.$bln.'">'.$bln.'</option>';
	echo '<option value="'.$xloc.'/'.$thn.'/'.$blnskr.'">'.$blnskr.'</option>';
	for($i=1;$i<=12;$i++)
	{
		$bl = $i;
		if($bl<10)
		{
			$bl = '0'.$i;
		}
		echo '<option value="'.$xloc.'/'.$thn.'/'.$bl.'">'.$bl.'</option>';
	}
	echo '</select></div></div>';
}
elseif(empty($tgl))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal </label></div><div class="col-sm-9">';
	echo "<select name=\"bln\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$thn.'/'.$bln.'/'.$tgl.'">'.$tgl.'</option>';
	echo '<option value="'.$xloc.'/'.$thn.'/'.$bln.'/'.$tglskr.'">'.$tglskr.'</option>';
	for($i=1;$i<=31;$i++)
	{
		$bl = $i;
		if($bl<10)
		{
			$bl = '0'.$i;
		}
		echo '<option value="'.$xloc.'/'.$thn.'/'.$bln.'/'.$bl.'">'.$bl.'</option>';
	}
	echo '</select></div></div>';
}

echo '</form>';
if((!empty($thn)) and (!empty($bln)) and (!empty($tgl)))
{
	$tanggal = $thn.'-'.$bln.'-'.$tgl;
	$namahari = tanggal_ke_hari($tanggal);
	echo 'Hari, tanggal : '.$namahari.', '.tanggal($tanggal);
	$tanggalhariini = $tanggal;
	$x = substr($tanggalhariini,0,4);
	$y = substr($tanggalhariini,5,2);
	$z = substr($tanggalhariini,8,2);
	$dina = date("l", mktime(0, 0, 0, $y, $z, $x));
	$bulan = angka_jadi_bulan($y);
	$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan '.$bulan.' '.$x;
	$te = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and semester='$semester' and `kodeguru`='$nim' order by kelas");
	foreach($te->result() as $e)
	{
		$id_mapel = $e->id_mapel;
		$ta = $this->db->query("select * from `tharitatapmuka` where `thnajaran`='$thnajaran' and `semester`='$semester' and `hari_tatap_muka` = '$dina' and `id_mapel`='$id_mapel' and `kodeguru`='$nim'");
		$mapel = '';
		$kelas = '';
		foreach($ta->result() as $a)
		{
			$jam_mulai = $a->jam_mulai;
			$jam_selesai = $a->jam_selesai;
			$menit_mulai = $a->menit_mulai;
			$menit_selesai = $a->menit_selesai;
			$jtm = $a->jtm;
			$tc = $this->db->query("select * FROM `p_pegawai` where `kd`='$nim'");
			$nip = '';
			foreach($tc->result() as $c)
			{
				$nip = $c->nip;
				$pns = $c->status_kepegawaian;
			}
			if(($pns == 'PNS') or ($pns == 'CPNS'))
			{
				$mapel = id_mapel_jadi_mapel($id_mapel);
				$kelas = id_mapel_jadi_kelas($id_mapel);
				$td = $this->db->query("select * from `sieka_bulanan` where `tahun`='$x' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
				$id_bulanan = '';
				foreach($td->result() as $d)
				{
					$id_bulanan = $d->id_bulanan;
				}
				$harian = 'melaksanakan kegiatan pembelajaran mata pelajaran '.$mapel.' di kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
				$tb = $this->db->query("select * FROM `sieka_harian` where `kegiatan`='$harian' and `tanggal`='$tanggalhariini' and `nip`='$nip'");
				if($tb->num_rows() == 0)
				{
					if(!empty($id_bulanan))
					{
						$this->db->query("insert into `sieka_harian` (`tahun`, `nip`, `kegiatan`, `tanggal`, `id_bulanan`, `jam_mulai`, `menit_mulai`, `jam_selesai`, `menit_selesai`, `kuantitas`) values ('$x','$nip', '$harian', '$tanggalhariini', '$id_bulanan', '$jam_mulai', '$menit_mulai', '$jam_selesai', '$menit_selesai','$jtm')");
					}
				}
			} // kalau pns cpns
		}
		$kegiatan_rencana = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan '.$bulan.' '.$x;
		$ta = $this->db->query("select * from `tharitatapmuka` where `thnajaran`='$thnajaran' and `semester`='$semester' and `rencana_hari_tatap_muka` = '$dina' and `id_mapel`='$id_mapel' and `kodeguru`='$nim'");
		$mapel = '';
		$kelas = '';
		foreach($ta->result() as $a)
		{
			$jam_mulai = $a->rencana_jam_mulai;
			$jam_selesai = $a->rencana_jam_selesai;
			$menit_mulai = $a->rencana_menit_mulai;
			$menit_selesai = $a->rencana_menit_selesai;
			$tc = $this->db->query("select * FROM `p_pegawai` where `kd`='$nim'");
			$nip = '';
			foreach($tc->result() as $c)
			{
				$nip = $c->nip;
				$pns = $c->status_kepegawaian;
			}
			if(($pns == 'PNS') or ($pns == 'CPNS'))
			{
				$mapel = id_mapel_jadi_mapel($id_mapel);
				$kelas = id_mapel_jadi_kelas($id_mapel);
				$td = $this->db->query("select * from `sieka_bulanan` where `tahun`='$x' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
				$id_bulanan = '';
				foreach($td->result() as $d)
				{
					$id_bulanan = $d->id_bulanan;
				}
				$harian = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran mata pelajaran '.$mapel.' di kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
				$tb = $this->db->query("select * FROM `sieka_harian` where `kegiatan`='$harian' and `tanggal`='$tanggalhariini' and `nip`='$nip'");
				if($tb->num_rows() == 0)
				{
					if(!empty($id_bulanan))
					{
						$this->db->query("insert into `sieka_harian` (`tahun`, `nip`, `kegiatan`, `tanggal`, `id_bulanan`, `jam_mulai`, `menit_mulai`, `jam_selesai`, `menit_selesai`, `kuantitas`) values ('$x','$nip', '$harian', '$tanggalhariini', '$id_bulanan', '$jam_mulai', '$menit_mulai', '$jam_selesai', '$menit_selesai','1')");
					}
				}
			}
		}
	}
	$ta = $this->db->query("select * from `sieka_harian` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `tanggal`='$tanggal' order by `terkirim`, `tanggal` DESC");
	echo '<table class="table table-striped table-hover table-bordered"><tr><td align="center">Nomor</td><td>Tanggal</td><td>Kegiatan</td><td align="center">ID Bulanan</td><td align="center">Kirim ke Sieka</td><td align="center">Hapus</td></tr>';
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
}
?>
</div></div></div>
