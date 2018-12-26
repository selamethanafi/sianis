<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_pd.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
foreach($twali->result() as $dtwali)
{
	$kelas = $dtwali->kelas;
	$thnajaran = $dtwali->thnajaran;
	$semester = $dtwali->semester;
}
$kodewali = $kodeguru;
$ta = $this->db->query("SELECT * FROM `m_walikelas` where `kodeguru`='$kodewali' and `id_walikelas`='$id_walikelas'");
?>
<p><?php echo '<a href="'.base_url().'guru/walikelas" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> <b>Kembali ke daftar Tugas Walikelas</b></a>';?></p>
<?php
echo 'Tahun Pelajaran '.$thnajaran.'<br />Semester '.$semester.'<br />Kelas '.$kelas;
$tb = $this->db->query("SELECT * FROM `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y'");
$cacahsiswa = $tb->num_rows();
if($cacahsiswa == 0)
{
	echo 'Tidak ada daftar siswa';
}
else
{
	$xloc = base_url().'walikelas/bukakunci/'.$id_walikelas;
	echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata pelajaran</label></div><div class="col-sm-9">';
	$td = $this->db->query("SELECT * FROM `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `mapel`");
	$tdx = $this->db->query("SELECT * FROM `m_mapel` where `id_mapel` = '$id_mapel'");
	$mapel = '';
	foreach($tdx->result() as $ddx)
	{
		$mapel = $ddx->mapel;

	}
	echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="">'.$mapel.'</option>';	
	foreach($td->result() as $d)
	{
		$kelasxx = $d->kelas;
		echo '<option value="'.$xloc.'/'.$d->id_mapel.'">'.$d->mapel.'</option>';
	}
	echo '</select></div></div></form>';
}
if(!empty($mapel))
{
	echo form_open('walikelas/bukakunci/'.$id_walikelas.'/'.$id_mapel.'/proses','class="form-horizontal" role="form"');
	echo '<table class="table table-hover table-striped table-bordered"><tr align="center"><td><strong>Nomor</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td>Pengetahuan</td><td><Keterampilan</td><td>Ketuntasan</td><td><strong>Status</strong></td><td>Kunci / Buka Kunci</td></tr>';
	$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y'");
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		$kettuntas2 = substr($a->ket_akhir,0,5);
		if($kettuntas2 == 'Belum')
		{
			$kettuntas2 = '<p class="text-danger">Belum</p>';
		}
		else
		{
			$kettuntas2 = '<p class="text-success">Sudah</p>';
		}
		echo '<tr><td  align="center">'.$nomor.'</td><td>'.$a->nis.'</td><td>'.nis_ke_nama($a->nis).'</td><td>'.$a->kog.'<p>'.$a->keterangan.'</p></td><td>'.$a->psi.'<p>'.$a->deskripsi.'</p></td><td>'.$kettuntas2.'</td><td>';
		if ($a->kunci == 1)
			{
				echo 'Terkunci';
			}
			else
			{
				echo 'Terbuka';
			}
		echo '</td><td>';
		if ($a->kunci == 0)
			{
				echo form_checkbox('pilihan_'.$nomor, '1', FALSE);
			}
			else
			{
				echo form_checkbox('pilihan_'.$nomor, '1', TRUE);
			}
		echo '<input type="hidden" name="kd_'.$nomor.'" value="'.$a->kd.'">';
		echo '</td></tr>';
		$nomor++;

	}
	echo '</table>';
	$cacah_siswa = $nomor - 1;
	echo '<p class="text-center"><input type="hidden" name="cacah_siswa" value="'.$cacah_siswa.'"><input type="submit" value="Proses" class="btn btn-primary" role="button"></p></form>';

}
?>
</div></div></div>
