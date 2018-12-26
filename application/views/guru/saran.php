<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rapor.php
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
<p><a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>" class="btn btn-primary"><b>Kembali</b></a></p>
<?php
$lanjut1 = 0;
$lanjut2 = 0;
$pesan = '';
if(empty($id_mapel))
{
	$pesan .= 'Indeks Mata pelajaran tidak ditemukan';
	$lanjut1 = 0;
}
else
{
	$kodegurux = id_mapel_jadi_kodeguru($id_mapel);
	if($kodegurux == $kodeguru)
	{
		$lanjut1 = 1;
	}
	else
	{
		$lanjut1 = 0;
		$pesan .= 'Indeks Mata pelajaran tidak sesuai dengan guru.';
	}

}
if(($itemnilai == 'uh1') or ($itemnilai == 'uh2') or ($itemnilai == 'uh3') or ($itemnilai == 'uh4') or ($itemnilai == 'tu1') or ($itemnilai == 'tu2') or ($itemnilai == 'tu3') or ($itemnilai == 'tu4') or ($itemnilai == 'mid'))
{
	$lanjut2 = 1;
}
else
{
	$lanjut2 = 0;
	$pesan .= 'Ulangan atau tugas tidak sesuai, seharusnya uh1, uh2, uh3, uh4, tu1, tu2, tu3, tu4, atau mid.';
}
if(($lanjut1 == 0) or ($lanjut2==0))
{
	echo $pesan;echo '';
}
else
{
	//buat daftar siswa dulu
	$thnajaran = id_mapel_jadi_thnajaran($id_mapel);
	$semester = id_mapel_jadi_semester($id_mapel);
	$kelas = id_mapel_jadi_kelas($id_mapel);
	$mapel = id_mapel_jadi_mapel($id_mapel);
	if(($itemnilai == 'uh1') or ($itemnilai == 'uh2') or ($itemnilai == 'uh3') or ($itemnilai == 'uh4') or ($itemnilai == 'mid'))
	{
		$kkm = id_mapel_jadi_kkm_ulangan($id_mapel,$itemnilai);
	}
	else
		{
		$kkm = id_mapel_jadi_kkm($id_mapel);
		}
	$tsiswa = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by no_urut");
	$cacah_siswa = $tsiswa->num_rows();
	foreach($tsiswa->result() as $a)
	{
		$nis = $a->nis;
		$td= $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
		$adanilai = $td->num_rows();
		if($adanilai>0)
		{
			$ta = $this->db->query("select * from `komentar` where `id_mapel`='$id_mapel' and `nis`='$nis'");
			$ada = $ta->num_rows();
			if($ada == 0)
				{
				$this->db->query("insert into `komentar` (`id_mapel`,`nis`) values ('$id_mapel','$nis')");
				}
		}
	}
	$lebartabel = "100%";
	$bgcolor="#ccc";
	echo '<table width="'.$lebartabel.'" bgcolor="'.$bgcolor.'" cellpadding="2" cellspacing="1" class="widget-small">
	<tr><td width="300"><strong>Tahun Pelajaran</strong></td><td>: <strong>'.$thnajaran.'</strong></td></tr>
	<tr><td><strong>Semester</strong></td><td>: <strong>'.$semester.'</strong></td></tr>
	<tr><td><strong>Kelas</strong></td><td>: <strong>'.$kelas.'</strong></td></tr>
	<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong>'.$mapel.'</strong></td></tr>
	<tr><td><strong>KKM</strong></td><td>: <strong>'.$kkm.'</strong></td></tr>
	</table>';
	if($tersimpan == 'Tersimpan')
	{
	echo '<div class="alert alert-success">Tersimpan</div>';
	echo '<p class="text-center"><a href ="'.base_url().'akreditasi/saran/'.$id_mapel.'/'.$itemnilai.'" class="btn btn-primary">Ubah Saran</a><p>';
	echo '<div class="table-responsive"><table width="'.$lebartabel.'" class="table table-striped table-hover table-bordered"><tr align="center"><td width="30"><strong>No.</strong></td><td width="250"><strong>Nama</strong></td><td width="50"><strong>'.$itemnilai.'</strong></td><td><strong>Saran / Komentar / Ketercapaian</td></tr>';
	$nomor=1;
	$itemnilaine = 'nilai_'.$itemnilai;
	$itemkomentar = 'komentar_'.$itemnilai;
	foreach($tsiswa->result() as $a)
	{
		$nis = $a->nis;
		$namasiswa = nis_ke_nama($nis);
		//cari nilai siswa
		$tb = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
		$adanilai = $tb->num_rows();
		if($adanilai>0)
		{
			$nilai = '?';
			foreach($tb->result() as $b)
			{
				$nilai = $b->$itemnilaine;
			}
			//komentar
			$komentar = '';
			$tc = $this->db->query("select * from `komentar` where `id_mapel`='$id_mapel' and `nis`='$nis'");
			foreach($tc->result() as $c)
			{
				$komentar = $c->$itemkomentar;
				$id_komentar = $c->id_komentar;
			}
		echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td><td align="center">'.$nilai.'</td><td>'.$komentar.'</td></tr>';
		$nomor++;
		}
		
	}
	echo '</table></div>';
	echo '<p class="text-center"><a href ="'.base_url().'index.php/akreditasi/saran/'.$id_mapel.'/'.$itemnilai.'" class="btn btn-primary">Ubah Saran</a></p>';
	}
	else
	{
	echo form_open('akreditasi/saran/'.$id_mapel.'/'.$itemnilai);
	echo '<div class="table-responsive"><table width="'.$lebartabel.'" class="table table-striped table-hover table-bordered"><tr align="center"><td width="30"><strong>No.</strong></td><td width="250"><strong>Nama</strong></td><td width="50"><strong>'.$itemnilai.'</strong></td><td><strong>Saran / Komentar / Ketercapaian</strong></td></tr>';
	$nomor=1;
	$itemnilaine = 'nilai_'.$itemnilai;
	$itemkomentar = 'komentar_'.$itemnilai;
	foreach($tsiswa->result() as $a)
	{
		$nis = $a->nis;
		$namasiswa = nis_ke_nama($nis);
		//cari nilai siswa
		$tb = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
		$adanilai = $tb->num_rows();
		if($adanilai>0)
		{
			$nilai = '?';
			foreach($tb->result() as $b)
			{
				$nilai = $b->$itemnilaine;
			}
			//komentar
			$komentar = '';
			$tc = $this->db->query("select * from `komentar` where `id_mapel`='$id_mapel' and `nis`='$nis'");
			foreach($tc->result() as $c)
			{
				$komentar = $c->$itemkomentar;
				$id_komentar = $c->id_komentar;
			}
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td><td align="center">'.$nilai.'</td><td><input type="text" name="komentar_'.$nomor.'" value ="'.$komentar.'" class="form-control"><input type="hidden" name="id_komentar_'.$nomor.'"  value ="'.$id_komentar.'"></td></tr>';
			$nomor++;
		}		
	}
	echo '</table></div><p class="text-center"><input type="hidden" name="cacah_siswa"  value ="'.$cacah_siswa.'"><input type="submit" value="Simpan Saran" class="btn btn-primary"></p></form>';

	}
}
?>
</div></div></div>
