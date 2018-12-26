<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp.php
// Lokasi      		: application/views/pegawai/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?><div class="container"><h2>Modul Sasaran Kerja Pegawai Negeri Sipil - PEGAWAI</h2>
<?php
$tahunsekarange='';
$tahunsekarang=$tahunpenilaian;
$tanggalsekarang = tanggal_hari_ini();
$tahunsaja = tahunsaja($tanggalsekarang);
$bulansaja = bulansaja($tanggalsekarang);
if($tahunsaja != $tahunsekarang)
{

	if(empty($tahunsekarang))
	{
		echo '<div class="alert alert-warning"><h4><strong>Tahun penilaian belum ditentukan</strong>, silakan menghubungi Operator di Kantor / Unit Kerja / Satker / Madrasah / RA masing - masing</h4></div>';
		$tahunsekarange = 'belum ditentukan';
	}
	else
	{
		$tahunsekarange = $tahunpenilaian;
	}
	echo '<div class="alert alert-warning"><h4>SKP seharusnya dibuat pada tahun berjalan. Sekarang tahun '.$tahunsaja.', Tahun Penilaian '.$tahunsekarange;//.' Untuk memberi tahu admin agar membetulkan data tahun silakan klik tombol berikut =&gt;  <a href="#" data-toggle="modal" data-target="#myModalsms" class="btn btn-info">Kirim SMS</a>
		echo '</h4> </div>';
}
if(!empty($tahunsekarang))
{
$pangkatgolongan = '';
$tb = $this->db->query("select * from `ppk_pns` where `kode`='$kodeguru' and `tahun`='$tahunsekarang'");
$adatb = $tb->num_rows();
if($adatb == 0)
{
	$this->db->query("insert into `ppk_pns` (`tahun`,`kode`) values ('$tahunsekarang','$kodeguru')");
}
$tb = $this->db->query("select * from `ppk_pns` where `kode`='$kodeguru' and `tahun`='$tahunsekarang'");
$gol1 = '';
$gol2 = '';
foreach($tb->result() as $b)
{
	$idskawal = $b->skawal;
	$idskakhir = $b->skakhir;
	$jabatan = $b->jabatan;
	$id_pejabat = $b->id_pejabat;
}
$pangkat1 = golongan_jadi_pangkat($gol1,'');
$jabatan1 = $jabatan;
$pangkat2 = golongan_jadi_pangkat($gol2,'');
$jabatan2 = $jabatan;


$datapegawai = cari_data_pegawai($kodeguru);
$nama = $datapegawai[0];
$nippegawai = $datapegawai[1];
$tempat = $datapegawai[2];
$tgllhr = $datapegawai[3];
?>

<table class="table table-bordered">
<tr><td>Nama</td><td><?php echo $nama;?></td></tr>
<tr><td>NIP</td><td><?php echo $nippegawai;?></td></tr>
<tr><td>Tempat/Tanggal Lahir</td><td><?php echo $tempat;?>, <?php echo format_tanggal($tgllhr);?></td></tr>
<tr><td>Awal Penilaian</td><td><?php echo tanggal($awal);?></td></tr>
<tr><td>Akhir Penilaian</td><td><?php echo tanggal($akhir);?></td></tr>
<tr><td>Tanggal Penyusunan</td><td><?php echo tanggal($tskp);?></td></tr>
<tr><td>Pangkat/Jabatan/Golongan Awal Penilaian</td><td><?php echo $pangkat1.' / '.$jabatan1.' / '.$gol1;?>  <a href="<?php echo base_url();?>pegawai/skp/skskp">Ubah</a></td></tr>
<tr><td>Pangkat/Jabatan/Golongan Akhir Penilaian</td><td><?php echo $pangkat2.' / '.$jabatan2.' / '.$gol2;?>  <a href="<?php echo base_url();?>pegawai/skp/skskp">Ubah</a></td></tr>
<tr><td>Tahun</td><td><strong><?php echo $tahunsekarang;?></strong></td></tr>
<tr><td>Pejabat Penilai</td><td><strong>
<?php
$tc = $this->db->query("select * from `pejabat_penilai` where `id_pejabat` = '$id_pejabat'");
$namapenilai = '????????';
foreach($tc->result() as $c)
{
	 $namapenilai = $c->nama_penilai.'<br />'.$c->jabatan;
}
echo $namapenilai;?></strong>   <a href="<?php echo base_url();?>pegawai/skp/ubahpenilai">Ubah</a></td></tr></table>

<?php
//<a href="'.base_url().'pkg/tambahskp/utama"><b>Tambah Unsur Utama</b></a>&nbsp;&nbsp;&nbsp;&nbsp;
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$kodeguru'");
if(count($tz->result())==0)
{
	$this->db->query("insert into `ppk_pns` (`kode`,`tahun`) values ('$kodeguru','$tahunpenilaian')");
}
$permanen = '';
$permanenkepala = '';
foreach($tz->result() as $z)
	{
	$permanen = $z->permanen;
	$permanenkepala = $z->kepala;
	}
echo '<p>';
if($permanen == 1)
	{
		echo '<a href="'.base_url().'pegawai/skp/batalpermanen" class="btn btn-warning" data-confirm="Anda yakin akan membatalkan SKP?"><b> Batalkan</b></a> ';
	}
	else
	{
	$link_permanen = anchor('pegawai/skp/permanen', 'Permanen', array('title' => 'Jadikan permanen', 'data-confirm' => 'Anda yakin akan mempermanenkan SKP?','class'=>'btn btn-primary'));
	echo $link_permanen;
	}
if($permanen != 1)
	{
	echo ' <a href="'.base_url().'pegawai/skp/tambahskp" class="btn btn-info"><b>Tambah SKP</b></a>';
	}
if($permanen == 1)
	{
		echo '<a href="'.base_url().'pegawai/skp/harian" class="btn btn-info"><b>SKP Harian</b></a> '; 
	?>	
		Cetak <strong>&gt;&gt;&gt;</strong>&nbsp;<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$kodeguru.'/borang';?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-success"><strong>Borang</strong></a>&nbsp;&nbsp;
		<?php
	}
echo ' ';
if(($permanenkepala == 1) and ($permanen == 1))
	{
	?>	
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$kodeguru.'/penilaian';?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-success"><strong>Penilaian SKP</strong></a>
		&nbsp;&nbsp;
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$kodeguru.'/ppk';?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-success"><strong>PPK (DP3)</strong></a>
		&nbsp;&nbsp;
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$kodeguru.'/sampul';?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-success"><strong>Sampul</strong></a>
		<?php
	}
	echo '</p>';
$nomor=1;
$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `kodeguru`='$kodeguru' order by `nourut`");
echo '<table class="table table-striped table-hover table-bordered">
<tr>';
if($permanen == 1)
{

	echo '';
}
else
{
	echo '<td rowspan="2" align="center">Hapus</td><td rowspan="2" align="center">Ubah</td>';
}
echo '<td rowspan="2">No</td><td rowspan="2" align="center">III. KEGIATAN TUGAS JABATAN</td><td rowspan="2" align="center">AK</td><td colspan="6" align="center">TARGET</td></tr>
<tr align="center" id="kolom"><td colspan="2" align="center">KUANTITAS / OUTPUT</td><td>KUALITAS / MUTU</td><td colspan="2">WAKTU</td><td>BIAYA</td></tr>';
$jak_target = 0;
$nomor = 1;
if(count($ta->result())>0)
{
	foreach($ta->result() as $a)
	{
		echo '<tr>';
		if($permanen != 1)
		{
			echo '<td align="center"><a href="'.base_url().'pegawai/skp/hapusskp/'.$a->id_skp_skor_guru.'" data-confirm="Anda yakin akan menghapus kegiatan: '.$a->kegiatan.'?" title="Hapus Data '.$a->kegiatan.'"><span class="glyphicon glyphicon-remove"></span></a></td>';
			echo '<td align="center">';
			echo '<a href="'.base_url().'pegawai/skp/ubahskp/'.$a->id_skp_skor_guru.'" title="Ubah Data"><span class="glyphicon glyphicon-edit"></span></a>';
			echo '</td>';
		}
		echo '<td align="center">'.$a->nourut.'</td><td>'.$a->kegiatan.'</td><td align="center"><strong></strong></td><td align="center">&nbsp;&nbsp;'.$a->kuantitas.'&nbsp;&nbsp;</td><td align="center">'.$a->satuan.'</td><td align="center">'.$a->kualitas.'</td><td align="center">'.$a->waktu.'</td><td align="center">'.$a->satuanwaktu.'</td><td align="center">'.$a->biaya.'</td></tr>';
	}
}

echo '<tr>';
			if($permanen == 1)
			{
				echo '';
			}
			else
			{
				echo '<td align="center"></td><td align="center"></td>';
			}
	echo '<td align="center"></td><td colspan="2">Jumlah Angka Kredit</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td></tr>';
echo '</table>';
 // akhir filter tahun 
}
?>
</div>
