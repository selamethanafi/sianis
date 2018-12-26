<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
// Lokasi      		: application/views/guru/
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
?><div class="container-fluid">
<?php
$xloc = base_url().'pengajaran/sikapspiritual';
?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if(is_numeric($tahun1))
{
	$tahun2= $tahun1 + 1;
}
else
{
	$tahun2= '';
}
$thnajaran = $tahun1.'/'.$tahun2;
$tax = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
$kelas = '';
$kodeguru = '';
$kurikulum = '';
foreach($tax->result() as $dax)
{
	$kelas = $dax->kelas;
	$kodeguru = $dax->kodeguru;
	$kurikulum = $dax->kurikulum;
}
$namaguru = cari_nama_pegawai($kodeguru);
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	if (!empty($tahun1))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'" title="Ganti Tahun Pelajaran">Tahun Pelajaran</a></label></div><div class="col-sm-9"><select name="tahun1" class="form-control">';
		echo "<option value='".$tahun1."'>".$thnajaran."</option>";
		echo '</select></div></div>';
	}
	if (!empty($semester))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'/'.$tahun1.'" title="Ganti Semester">Semester</a></label></div><div class="col-sm-9"><select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option></select></div></div>';
	}

if(empty($tahun1))
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
		foreach($daftar_tapel->result() as $k)
		{
			echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
		}
		echo '</select></div></div>';
	}
	elseif(empty($semester))
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		if($semester == 1)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
		}
		elseif($semester == 2)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
		}
		else
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
		}

		echo '</select></div></div>';
	}
	else
	{
		$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<select name="kodeguru" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$kelas.' - '.$namaguru.'</option>';
		foreach($ta->result() as $a)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.' - '.cari_nama_pegawai($a->kodeguru).'</option>';
		}
		echo '</select></div></div>';
	}
	if((!empty($thnajaran)) and (!empty($semester)) and (!empty($id_walikelas)))
	{
		$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas` = '$kelas' and `status`='Y' order by `no_urut`");
		if($kurikulum == '2015')
		{
			echo '<h4>Sikap Spritual dan Sosial serta Ketidakhadiran Siswa</h4>';
			echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>NIS</td><td>Nama</td><td>Sikap Spiritual</td><td>Sikap Sosial</td><td>Tanggapan Wali</td><td>Sakit</td><td>Izin</td><td>Tanpa Keterangan</td></tr>';
			$nomor = 1;
			foreach($tc->result() as $c)
			{
				$nis = $c->nis;
				$namasiswa = nis_ke_nama($nis);
				$td = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
				$sikap_spiritual = '?';
				$sikap_sosial = '?';
				$pred1 = '?';
				$pred2 = '?';
				$s = '?';
				$i = '?';
				$a = '?';
				$wali = '?';
				foreach($td->result() as $d)
				{
					$pred1 = $d->satu;
					$pred2 = $d->dua;
					$sikap_spiritual = $d->kom1;
					$sikap_sosial = $d->kom2;
					$s = $d->sakit;
					$i = $d->izin;
					$a = $d->tanpa_keterangan;
					$wali = $d->wali;

				}

				echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.$namasiswa.'</td>';
				if(($pred1 == 'A') or ($pred1 == 'B'))
				{
					echo '<td><p class="text-success">'.$pred1.' ('.predikat_sikap($pred1).')</p><p class="text-success">'.$sikap_spiritual.'</p></td>';
				}
				else
				{
					echo '<td><p class="text-danger">'.$pred1.' ('.predikat_sikap($pred1).')</p><p class="text-danger">'.$sikap_spiritual.'</p></td>';

				}
				if(($pred2 == 'A') or ($pred2 == 'B'))
				{
					echo '<td><p class="text-success">'.$pred2.' ('.predikat_sikap($pred2).')</p><p class="text-success">'.$sikap_spiritual.'</p></td>';
				}
				else
				{
					echo '<td><p class="text-danger">'.$pred2.' ('.predikat_sikap($pred2).')</p><p class="text-danger">'.$sikap_spiritual.'</p></td>';
				}
				echo '<td>'.$wali.'</td><td>'.$s.'</td><td>'.$i.'</td><td>'.$a.'</td></tr>';
				$nomor++;
			}
			echo '</table>';
		}
		else
		{
			echo '<h4>Sikap Spritual dan Sosial Antarmapel serta Ketidakhadiran Siswa</h4>';
			echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>NIS</td><td>Nama</td><td>Sikap Spiritual dan Sikap Sosial Antarmapel</td><td>Sakit</td><td>Izin</td><td>Tanpa Keterangan</td></tr>';
			$nomor = 1;
			foreach($tc->result() as $c)
			{
				$nis = $c->nis;
				$namasiswa = nis_ke_nama($nis);
				$sikap_antar_mapel = '?';
				$s = '?';
				$i = '?';
				$a = '?';
				$td = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");

				foreach($td->result() as $d)
				{
					$sikap_antar_mapel = $d->kom1;
					$s = $d->sakit;
					$i = $d->izin;
					$a = $d->tanpa_keterangan;
				}
				echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.$namasiswa.'</td><td>'.$sikap_antar_mapel.'</td><td>'.$s.'</td><td>'.$i.'</td><td>'.$a.'</td></tr>';
				$nomor++;
			}
			echo '</table>';
		}

	}
?>
</form>
</div></div></div>
