<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 15 Mei 2016 18:30:04 WIB
// Nama Berkas 		: hasil_cari_siswa.php
// Lokasi      		: application/views/tatausaha/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<p><a href="<?php echo base_url(); ?>tatausaha/carisiswa" class="btn btn-info"><b>Pencarian Siswa</b></a></p>
<div class="alert alert-info">Hasil Pencarian dengan kunci <strong><?php echo $kunci_nama;?></strong></div>
<?php
$nomor = 1;
if(count($hasilpencarian->result())>0){
?>
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Kelas Terakhir</strong></td><td><strong>Status</strong></td><td><strong>Lihat Data</strong></td><td><strong>Ubah</strong></td><td><strong>Data Ijazah</strong></td><td><strong>Kuliah</strong></td><td><strong>Foto</strong></td><td><strong>BSM</strong></td><td><strong>Mutasi</strong></td><td><strong>Keluar / Pindah / Mengundurkan Diri</strong></td><td><strong>Internet</strong></td><td><strong>Cetak</strong></td><td><strong>Rapor / Ijazah</strong></td></tr>
<?php
foreach($hasilpencarian->result() as $t)
{
		$ket = $t->ket;
		if ($t->ket=='Y')
			{
			$ket='Aktif';
			}
		if ($t->ket=='P')
			{
			$ket='Pindah';
			}
		if ($t->ket=='L')
			{
			$ket='Lulus';
			}
		if ($t->ket=='K')
			{
			$ket='Keluar';
			}


echo "<tr><td align='center'>".$nomor."</td><td>".$t->nis."</td><td>".$t->nama."</td>";
$nis = $t->nis;
$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by `thnajaran` DESC, `semester` DESC limit 0,1");
$kelas = '';
foreach($ta->result() as $a)
{
	$kelas = $a->kelas;
}
echo '<td>'.$kelas.'</td><td>'.$ket.'<br/>';
if($t->ket != 'Y')
{
	echo '<a href="'.base_url().'tatausaha/batalkeluar/'.$t->nis.'" title="Batal pindah / keluar" data-confirm="Yakin hendak membatalkan pindah / keluar siswa '.$t->nama.' ?">Batal</a>';

}
echo '</td>';
echo "<td align=\"center\"><a href='".base_url()."tatausaha/fotosiswa/".$t->nis."' title='Lihat Data Siswa'><span class='fa fa-bullseye'></span></a></td>";
echo "<td align=\"center\"><a href='".base_url()."tatausaha/editsiswa/".$t->nis."' title='Edit Data Siswa'><span class='fa fa-edit'></span></a></td>";
echo "<td align=\"center\"><a href='".base_url()."tatausaha/ijazah/".$t->nis."' title='Edit Data Siswa'><span class='fa fa-edit'></span></a></td>";
if($t->kuliah == 'Ya')
{
	echo '<td align="center"><a href="'.base_url().'tatausaha/kuliah/'.$t->nis.'/batal" title="Ubah satus '.$t->nama.' menjadi batal kuliah" data-confirm="Hendak mengubah status siswa menjadi batal kuliah">'.$t->kuliah.'</a></td>';
}
else
{
	echo '<td align="center"><a href="'.base_url().'tatausaha/kuliah/'.$t->nis.'/kuliah" title="Ubah satus menjadi hendak kuliah" class="btn btn-success" data-confirm="Hendak mengubah status '.$t->nama.' menjadi hendak kuliah">'.$t->kuliah.'</a></td>';
}
echo "<td align=\"center\"><a href='".base_url()."tatausaha/foto/".$t->nis."' title='Unggah Foto Siswa'><span class='fa fa-edit'></span></a></td>";
echo "<td align=\"center\"><a href='".base_url()."tatausaha/datapenerimabsm/".$t->nis."' title='Data persyaratan penerima PIP/BSM'><span class='fa fa-edit'></span></a></td>";
echo "<td align=\"center\"><a href='".base_url()."tatausaha/mutasisiswa/".$t->nis."' title='Mutasi Siswa'><span class='fa fa-edit'></span></a></td>";

echo "<td align=\"center\"><a href='".base_url()."tatausaha/keluar/".$t->nis."' title='Keterangan Pindah'><span class='fa fa-edit'></span></a></td>";

	?>
	<td align="center">
<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>tatausaha/kartuaksesinternet/<?php echo $t->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
	<td align="center">
<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>tatausaha/detilsiswa/<?php echo $t->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
	<td align="center"><a href="<?php echo base_url();?>tatausaha/lhbsiswa/<?php echo $t->nis;?>"><span class="fa fa-print"></span></a></td>
</tr>
<?php
$nomor++;	
}
	echo '</table>';
}
else{
echo '<div class="alert alert-danger">Tidak ada siswa dengan nama yang mengandung karakter <strong>'.$kunci_nama.'</strong></div></div>';
}?>

</div></div></div>
