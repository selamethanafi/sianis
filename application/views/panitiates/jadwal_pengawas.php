<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: jadwal_pengawas.php
// Lokasi      		: application/views/panitiates
// Terakhir diperbarui	: Rab 01 Jul 2015 11:34:03 WIB 
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
?>
<div id="bg-isi"><h2>Modul Jadwal Pengawas - <?php echo $this->config->item('nama_web');?></h2><br />
<?php echo form_open('panitiates/jadwalpengawas');
$id_tes = 1;
$ta = $this->db->query("select * from `m_ruang`  where `status` = '1' ");
//$cacahruang = count($ta->result());
$cacahruang = 7;
$tb = $this->db->query("select * from `hari_tes`  where id_tes='$id_tes'order by `tanggal` ASC ");

echo '<table width="870" style="border: 2pt ridge #cccccc;" cellpadding="2" cellspacing="1" class="widget-small">';
//judul
echo '<tr><td>Tanggal</td><td>Jam Ke</td>';
	$urutan = 1;
	do
	{
		echo '<td>'.$urutan.'</td>';
		$urutan++;
	}
	while ($urutan < $cacahruang+1);
	echo '</tr>';
$jamke = 1;
foreach($tb->result() as $b)
{
	if($jamke==3)
		{$jamke=1;
		}
	$tanggaltes = $b->tanggal;
	do
	{
		echo '<tr><td>'.date_to_long_string($tanggaltes).'</td><td>'.$jamke.'</td>';
		$tc = $this->db->query("select * from pengawas_jadwal where `id_tes`='$id_tes' and `tanggal`='$tanggaltes' and `jam_ke`='$jamke' order by `ruang` ASC");
		foreach($tc->result() as $c)
		{
		echo '<td width="75" align="center"><a href="'.base_url().'index.php/panitiates/jadwalpengawas/ubah/'.$c->id_pengawas_jadwal.'"  title="Ubah Data">'.$c->kode1.' - '.$c->kode2.'</a></td>';
		}	
		echo '</tr>';
	$jamke++;
	}
	while ($jamke<3);
}

echo '</table>
</form>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div>';
