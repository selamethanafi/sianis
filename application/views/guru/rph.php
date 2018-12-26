<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rph.php
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
<div class="container-fluid"><h2>Rencana Pelaksanaan Harian - <?php echo $this->config->item('nama_web');?></h2>
<?php echo '<a href="'.base_url().'index.php/guru/awalrph"><b>Kerangka RPH semester ini</b></a>';?>&nbsp;&nbsp;&nbsp;<?php echo '<a href="'.base_url().'index.php/guru/rphlain"><b>Tambah/Ubah RPH/BPH</b></a>';?>&nbsp;&nbsp;&nbsp;<?php echo '<a href="'.base_url().'index.php/guru/rphtanggal"><b>Tampil, Ubah, Salin RPH/BPH tanggal tertentu</b></a>';?>
<table>
<tr><td>Tahun Pelajaran</td><td>:</td><td><strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td>Semester</td><td>:</td><td><strong><?php echo $semester;?></strong></td></tr>
</table>

<?php
$nomor=$page+1;
echo '<div class="CSSTableGenerator"><table>
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Jam Ke-</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong></td><td><strong>SK/KD</strong></td><td><strong>Rencana</strong></td><td><strong>Keterangan</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>';
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
//date("l", mktime(0, 0, 0, 7, 1, 2000));
	$dinane = tanggal_ke_hari($t->tanggal);
	echo "<tr><td>".$nomor."</td><td>".$dinane.", ".date_to_long_string($t->tanggal)."</td><td>".$t->jamke."</td><td>".$t->kelas."</td><td>".$t->mapel."</td><td><b>".tanpa_paragraf($t->sk)."</b> / ".tanpa_paragraf($t->kd)."</td><td>".tanpa_paragraf($t->rencana)."</td><td>".tanpa_paragraf($t->keterangan)."</td><td>
<a href='".base_url()."index.php/guru/ubahrph/".$t->id_rph."' title='Ubah Rencana Pelaksanaan Harian'><img src='".base_url()."images/edit-icon.gif' border='0'></a></td><td align=\"center\"><a href='".base_url()."index.php/guru/hapusrph/".$t->id_rph."' onClick=\"return confirm('Anda yakin ingin menghapus data RPH dan BPH ini?')\" title='Hapus Data'><img src='".base_url()."images/hapus-icon.gif' border='0'></a></td></tr>";
	$nomor++;
	}

}
else
{
echo "<tr><td colspan='5'>Belum ada data RPH</td></tr>";
}
echo '</table></div>';
?>
<?php
if (!empty($paginator))
	{
	?>
	<h5><?php echo $paginator;?></h5>
	<?php }?>
<div class="clear padding40"></div>
</div>
