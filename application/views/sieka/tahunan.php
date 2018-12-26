<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp.php
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
?><div class="container-fluid"><h2>Modul Sasaran Kerja Pegawai Negeri Sipil</h2>
			<!-- Modal -->
			<div class="modal fade" id="myModalsms" role="dialog">
			<div class="modal-dialog">
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Kirim SMS ke Admin SKP</h4>
			        </div>
			        <div class="modal-body">
				<?php
					echo 'Silakan menghubungi tatausaha';
				?>
				</div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			        </div>

			      </div>
		        </div>
                        </div>
			<!-- akhir modal -->

<?php echo $this->session->flashdata('pesan_info');
echo '<p><a href="'.base_url().'pkg/" class="btn btn-primary">Ke Halaman PKG</a></p>';
$te = $this->db->query("select * from `pkg_masa` where tahun = '$tahunpenilaian'");
foreach($te->result() as $e)
{
	$tawal = $e->awal;
	$takhir = $e->akhir;
	$tskp = $e->tskp;
	$tpenilaian = $e->tpenilaian;
}

$pangkatgolongan = '';
$tx = $this->db->query("select * from p_pegawai where `kd`='$nim'");
foreach($tx->result() as $x)
{
	$nippegawai = $x->nip;
	$tempat = $x->tempat;
	$tgllhr = $x->tanggallahir;
	$usernamepegawai = $x->kd;
	$tmtguru = $x->tmt_guru;
	$jenkel = $x->jenkel;
}
$adarevisi = 0;
$gurubk = 0;
$tc = $this->db->query("select * from `gurubk` where `nip` = '$nippegawai'");
if($tc->num_rows()>0)
{
	$gurubk = 1;
}
if($gurubk == 1)
{
	echo '<h3>Guru BK</h3>';
}
$tahunsekarang=$tahunpenilaian;
$tanggalsekarang = tanggal_hari_ini();
$tahunsaja = tahunsaja($tanggalsekarang);
$bulansaja = bulansaja($tanggalsekarang);
if($tahunsaja != $tahunsekarang)
{
	if(empty($tahunsekarang))
	{
		echo '<div class="alert alert-warning"><h4><strong>Tahun penilaian belum ditentukan</strong>, silakan menghubungi Tatausaha</h4></div>';
		$tahunsekarang = 'belum ditentukan';
	}
		echo '<div class="alert alert-warning"><h4>SKP seharusnya dibuat pada tahun berjalan. Sekarang tahun '.$tahunsaja.', Tahun Penilaian '.$tahunsekarang.'. Bisa jadi SKP '.$tahunsekarang.' belum selesai. Kalau SKP '.$tahunsekarang.' sudah selesai silakan  memberi tahu admin agar membetulkan data tahun silakan klik tombol berikut =&gt;  <a href="#" data-toggle="modal" data-target="#myModalsms" class="btn btn-info">Kirim SMS</a></h4> </div>';
}
$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nippegawai' and `tahun`='$tahunsekarang'");
$adatb = $tb->num_rows();
if($adatb == 0)
{
	$this->db->query("insert into `ppk_pns` (`tahun`,`kode`) values ('$tahunsekarang','$nippegawai')");
}
$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nippegawai' and `tahun`='$tahunsekarang'");
foreach($tb->result() as $b)
{
	$idskawal = $b->skawal;
	$idskakhir = $b->skakhir;
}
$gol1 = id_sk_jadi_golongan($idskawal) ;
$pangkat1 = golongan_jadi_pangkat($gol1);
$jabatan1 = golongan_jadi_jabatan($gol1);
$gol2 = id_sk_jadi_golongan($idskakhir) ;
$pangkat2 = golongan_jadi_pangkat($gol2);
$jabatan2 = golongan_jadi_jabatan($gol2);

//cari ada tulisan unsur
$tf=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `kegiatan`='Unsur utama'");
if($tf->num_rows()==0)
	{
	$this->db->query("insert into `skp_skor_guru` (`nourut`,`kegiatan`,`nip`,`tahun`) value ('1','Unsur utama','$nippegawai','$tahunpenilaian')");
	}
$tf=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `kegiatan`='Unsur Penunjang Tugas Guru'");
if($tf->num_rows()==0)
	{
	$this->db->query("insert into `skp_skor_guru` (`kegiatan`,`nip`,`tahun`) value ('Unsur Penunjang Tugas Guru','$nippegawai','$tahunpenilaian')");
	}
$tf=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `kegiatan`='Unsur PKB'");
if($tf->num_rows()==0)
	{
	$this->db->query("insert into `skp_skor_guru` (`kegiatan`,`nip`,`tahun`) value ('Unsur PKB','$nippegawai','$tahunpenilaian')");
	}

//urutkan
$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `unsur`='B' order by kode");
$nourut = 2;
foreach($ta->result() as $a)
{
	$id_skp_skor_guru = $a->id_skp_skor_guru;
	$this->db->query("update `skp_skor_guru` set `nourut`='$nourut' where `id_skp_skor_guru` = '$id_skp_skor_guru'");
	$nourut++;
}
$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `unsur`='A' order by kode");
foreach($ta->result() as $a)
{
	$id_skp_skor_guru = $a->id_skp_skor_guru;
	$this->db->query("update `skp_skor_guru` set `nourut`='$nourut' where `id_skp_skor_guru` = '$id_skp_skor_guru'");
	$nourut++;
}

$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `unsur`='Z' order by kode");
foreach($ta->result() as $a)
{
	$id_skp_skor_guru = $a->id_skp_skor_guru;
	$this->db->query("update `skp_skor_guru` set `nourut`='$nourut' where `id_skp_skor_guru` = '$id_skp_skor_guru'");
	$nourut++;
}
$this->db->query("update `skp_skor_guru` set `nourut`='$nourut' where `kegiatan` = 'Unsur PKB' and `nip`='$nippegawai' and  `tahun`='$tahunsekarang'");
$nourut++;

$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `unsur`='C' order by kode");
foreach($ta->result() as $a)
{
	$id_skp_skor_guru = $a->id_skp_skor_guru;
	$this->db->query("update `skp_skor_guru` set `nourut`='$nourut' where `id_skp_skor_guru` = '$id_skp_skor_guru'");
	$nourut++;
}	
$this->db->query("update `skp_skor_guru` set `nourut`='$nourut' where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `kegiatan`='Unsur Penunjang Tugas Guru'");
$nourut++;

$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `unsur`='D' order by kode");
foreach($ta->result() as $a)
{
	$id_skp_skor_guru = $a->id_skp_skor_guru;
	$this->db->query("update `skp_skor_guru` set `nourut`='$nourut' where `id_skp_skor_guru` = '$id_skp_skor_guru'");
	$nourut++;
}	
	
?>
<table class="table table-bordered">
<tr><td>Nama</td><td><?php echo $nama;?></td></tr>
<tr><td>NIP</td><td><?php echo $nippegawai;?></td></tr>
<tr><td>Tempat/Tanggal Lahir</td><td><?php echo $tempat;?>, <?php echo date_to_long_string($tgllhr);?></td></tr>
<tr><td>Masa Penilaian</td><td><?php echo tanggal($tawal);?>  s.d. <?php echo tanggal($takhir);?> </td></tr>
<tr><td>Tanggal Penyusunan SKP</td><td><?php echo tanggal($tskp);?></td></tr>
<tr><td>Tanggal Penilaian SKP</td><td><?php echo tanggal($tpenilaian);?></td></tr>
<tr><td>Pangkat/Jabatan/Golongan Awal Penilaian</td><td><?php echo $pangkat1.' / '.$jabatan1.' / '.$gol1;?></td></tr>
<tr><td>Pangkat/Jabatan/Golongan Akhir Penilaian</td><td><?php echo $pangkat2.' / '.$jabatan2.' / '.$gol2;?></td></tr>
<tr><td>Tahun</td><td><strong><?php echo $tahunsekarang;?></strong></td></tr></table>

<?php
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$nippegawai'");
if(count($tz->result())==0)
{
	$this->db->query("insert into `ppk_pns` (`kode`,`tahun`) values ('$nippegawai','$tahunpenilaian')");
}
$permanen = 1;
$permanenkepala = '';
foreach($tz->result() as $z)
	{
	$permanen = $z->permanen;
	$permanenkepala = $z->kepala;
	}
$nomor=1;
$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' order by `nourut`");
echo '<table class="table table-striped table-hover table-bordered">
<tr><td rowspan="2" align="center">Ubah ID </td><td rowspan="2">No</td><td rowspan="2" colspan="2" align="center">III. KEGIATAN TUGAS JABATAN</td><td rowspan="2" align="center">AK</td><td colspan="6" align="center">TARGET</td></tr>
<tr align="center" id="kolom"><td colspan="2" align="center">KUANTITAS / OUTPUT</td><td>KUALITAS / MUTU</td><td colspan="2">WAKTU</td><td>BIAYA</td></tr>';
$jak_target = 0;
$nomor = 1;
$nourut = 1;
if(count($ta->result())>0)
{
foreach($ta->result() as $a)
	{
	if(($a->kegiatan == 'Unsur utama') or ($a->kegiatan == 'Unsur Penunjang Tugas Guru') or ($a->kegiatan == 'Unsur PKB'))
		{

		}
		else
		{
			echo '<tr>';
			if(($a->kode=='00') or (substr($a->kode,0,2)=='T0'))
			{
				echo '<td align="center"><a href="'.base_url().'sieka/tahunanid/'.$a->id_skp_skor_guru.'"><span class="fa fa-edit"></span></a><p>'.$a->id_tahunan.'</p></td>';
			}
			else
			{
				echo '<td align="center"></td>';
			}
			$id_skp_skor_guru_revisi = $a->id_skp_skor_guru;
			$td = $this->db->query("SELECT * FROM `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` ='$id_skp_skor_guru_revisi' and `nip`='$nippegawai'");
			$adatd = $td->num_rows();
			if($adatd==0)
			{
				echo '<td align="center">'.$nourut.'</td><td>'.$a->kegiatan;
				if(substr($a->kegiatan,0,7) == 'Panitia')
				{
					echo '<div class="alert alert-danger">SKP ini harus dihapus</div>';
				}
				echo '</td><td align="center">'.$a->ak.'</td><td align="center"><strong>'.$a->ak_target.'</strong></td><td align="center">&nbsp;&nbsp;'.$a->kuantitas.'&nbsp;&nbsp;</td><td align="center">'.$a->satuan.'</td><td align="center">'.$a->kualitas.'</td><td align="center">'.$a->waktu.'</td><td align="center">'.$a->satuanwaktu.'</td><td align="center">'.$a->biaya.'</td></tr>';
			}
			else
			{
				$adarevisi = 1;
				foreach($td->result() as $d)
				{
					$rkuantitas = $d->kuantitas;
					$rkualitas = $d->kualitas;
					$rwaktu = $d->waktu;
					$rbiaya = $d->biaya;
					$swaktu = $d->satuanwaktu;
				}

				echo '<td align="center">'.$nourut.'</td><td>'.$a->kegiatan.'</td><td align="center">'.$a->ak.'</td><td align="center"><strong>'.$a->ak_target.'</strong></td><td align="center"><s>&nbsp;&nbsp;'.$a->kuantitas.'&nbsp;&nbsp;</s><br />&nbsp;&nbsp;'.$rkuantitas.'&nbsp;&nbsp;</td><td align="center">'.$a->satuan.'</td><td align="center"><s>'.$a->kualitas.'</s><br />'.$rkualitas.'</td><td align="center"><s>'.$a->waktu.'</s><br />'.$rwaktu.'</td><td align="center"><s>'.$a->satuanwaktu.'</s><br />'.$swaktu.'</td><td align="center"><s>'.$a->biaya.'</s><br />'.$a->biaya.'</td></tr>';
			}

		$jak_target = $jak_target + $a->ak_target ;
		$nourut++;
		}
	$nomor++;
	}
}

echo '<tr><td align="center"></td><td align="center"></td><td align="center"></td><td colspan="2">Jumlah Angka Kredit</td><td align="center">'.$jak_target.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td></tr>';
echo '</table>';
/*
if($adarevisi == 1)
{
	$tb = $this->db->query("select * from `ppk_pns_kedua` where `kode`='$nippegawai' and `tahun`='$tahunsekarang'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `ppk_pns_kedua` (`tahun`,`kode`) values ('$tahunsekarang','$nippegawai')");
	}
	$tb = $this->db->query("select * from `ppk_pns_kedua` where `kode`='$nippegawai' and `tahun`='$tahunsekarang'");
	foreach($tb->result() as $b)
	{
		$idskawal = $b->skawal;
		$idskakhir = $b->skakhir;
		$tawal = $b->tawal;
		$takhir = $b->takhir;
	}
	$gol1 = id_sk_jadi_golongan($idskawal) ;
	$pangkat1 = golongan_jadi_pangkat($gol1);
	$jabatan1 = golongan_jadi_jabatan($gol1);
	$gol2 = id_sk_jadi_golongan($idskakhir) ;
	$pangkat2 = golongan_jadi_pangkat($gol2);
	$jabatan2 = golongan_jadi_jabatan($gol2);
	?>
	<h1>SKP Kedua</h1><table class="table table-bordered">
	<tr><td>Nama</td><td><?php echo $nama;?></td></tr>
	<tr><td>NIP</td><td><?php echo $nippegawai;?></td></tr>
	<tr><td>Tempat/Tanggal Lahir</td><td><?php echo $tempat;?>, <?php echo date_to_long_string($tgllhr);?></td></tr>
	<tr><td>Awal Penilaian</td><td><?php echo tanggal($tawal);?>  <a href="<?php echo base_url();?>pkg2/skskp">Ubah</a></td></tr>
	<tr><td>Akhir Penilaian</td><td><?php echo tanggal($takhir);?>  <a href="<?php echo base_url();?>pkg2/skskp">Ubah</a></td></tr>
	<tr><td>Pangkat/Jabatan/Golongan Awal Penilaian</td><td><?php echo $pangkat1.' / '.$jabatan1.' / '.$gol1;?>  <a href="<?php echo base_url();?>pkg2/skskp">Ubah</a></td></tr>
	<tr><td>Pangkat/Jabatan/Golongan Akhir Penilaian</td><td><?php echo $pangkat2.' / '.$jabatan2.' / '.$gol2;?>  <a href="<?php echo base_url();?>pkg/skskp">Ubah</a></td></tr>
	<tr><td>Tahun</td><td><strong><?php echo $tahunsekarang;?></strong></td></tr></table>
	</table>
	<?php

	echo '<p class="text-center"><a href="'.base_url().'pkg2/skp" class="btn btn-danger">MENGELOLA SKP KEDUA</a>';
	//kedua
	$nomor=1;
	$ta=$this->db->query("select * from `skp_skor_guru_kedua` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' order by `nourut`");
	echo '<table class="table table-striped table-hover table-bordered">
<tr><td rowspan="2">No</td><td rowspan="2" colspan="2" align="center">III. KEGIATAN TUGAS JABATAN</td><td rowspan="2" align="center">AK</td><td colspan="6" align="center">TARGET</td></tr>
<tr align="center" id="kolom"><td colspan="2" align="center">KUANTITAS / OUTPUT</td><td>KUALITAS / MUTU</td><td colspan="2">WAKTU</td><td>BIAYA</td></tr>';
	$jak_target = 0;
	$nourut = 1;
	if(count($ta->result())>0)
	{
		foreach($ta->result() as $a)
		{	
			if(($a->kegiatan == 'Unsur utama') or ($a->kegiatan == 'Unsur Penunjang Tugas Guru') or ($a->kegiatan == 'Unsur PKB'))	
			{
				echo '<tr><td align="center"></td><td><strong>'.$a->kegiatan.'</strong></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td></tr>';
			}
			else
			{
				echo '<td align="center">'.$nourut.'</td><td>'.$a->kegiatan.'</td><td align="center">'.$a->ak.'</td><td align="center"><strong>'.$a->ak_target.'</strong></td><td align="center">&nbsp;&nbsp;'.$a->kuantitas.'&nbsp;&nbsp;</td><td align="center">'.$a->satuan.'</td><td align="center">'.$a->kualitas.'</td><td align="center">'.$a->waktu.'</td><td align="center">'.$a->satuanwaktu.'</td><td align="center">'.$a->biaya.'</td></tr>';
				$jak_target = $jak_target + $a->ak_target ;
				$nourut++;
			}
		}
	}
	echo '<tr><td align="center"></td><td colspan="2">Jumlah Angka Kredit</td><td align="center">'.$jak_target.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td></tr>';
	echo '</table>';
}
else
{
	//kedua
	$this->db->query("delete from `skp_skor_guru_kedua` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `kegiatan`='Unsur utama'");
	$this->db->query("delete from `skp_skor_guru_kedua` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `kegiatan`='Unsur Penunjang Tugas Guru'");
	$this->db->query("delete from `skp_skor_guru_kedua` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `kegiatan`='Unsur PKB'");
	
	$nomor=1;
	$ta=$this->db->query("select * from `skp_skor_guru_kedua` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' order by `nourut`");
	if($ta->num_rows() > 0)
	{
		echo '<div class="alert alert-danger">DI BAWAH INI HARUS DIHAPUS</div>';
		echo '<table class="table table-striped table-hover table-bordered">
<tr><td rowspan="2">Hapus</td><td rowspan="2" align="center">No</td><td rowspan="2" colspan="2" align="center">III. KEGIATAN TUGAS JABATAN</td><td rowspan="2" align="center">AK</td><td colspan="6" align="center">TARGET</td></tr>
<tr align="center" id="kolom"><td colspan="2" align="center">KUANTITAS / OUTPUT</td><td>KUALITAS / MUTU</td><td colspan="2">WAKTU</td><td>BIAYA</td></tr>';
		$nourut = 1;
		foreach($ta->result() as $a)
		{
			if(($permanen !== 1) and ($permanenkepala == 0))
			{
				echo '<td align="center"><a href="'.base_url().'pkg2/hapusskp/'.$a->id_skp_skor_guru.'" data-confirm="Anda yakin ingin menghapus data ini '.$a->kegiatan.'" title="Hapus Data '.$a->kegiatan.'"><span class="fa fa-trash-alt"></span></a></td>';
			}
			else
			{
				echo '<td align="center"></td>';
			}
			echo '<td align="center">'.$nourut.'</td><td>'.$a->kegiatan.'</td><td align="center">'.$a->ak.'</td><td align="center"><strong>'.$a->ak_target.'</strong></td><td align="center">&nbsp;&nbsp;'.$a->kuantitas.'&nbsp;&nbsp;</td><td align="center">'.$a->satuan.'</td><td align="center">'.$a->kualitas.'</td><td align="center">'.$a->waktu.'</td><td align="center">'.$a->satuanwaktu.'</td><td align="center">'.$a->biaya.'</td></tr>';
			$nourut++;
		}
		echo '</table>';
	}
}
*/
 // akhir filter tahun 
?>
</div></div></div>
