<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: rph_kelas.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php
$lanjut = 1;
if (empty($id_mapel))
	{
	echo 'Galat, parameter yang dibutuhkan tidak disertakan, <a href="'.base_url().'index.php/guru/nilai">Kembali</a>';
	$lanjut = 0;
	}
elseif(!empty($id_mapel))
	{
	$ta = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and kodeguru='$kodeguru'");
	$ada = $ta->num_rows();
	if ($ada==0)
		{
		echo 'Galat, data tidak ditemukan, <a href="'.base_url().'index.php/guru/nilai">Kembali</a>';
		$lanjut = 0;
		}
		else
		{
		foreach($ta->result() as $a)
			{
			$thnajaran = $a->thnajaran;
			$semester = $a->semester;
			$mapel = $a->mapel;
			$kelas = $a->kelas;
			}
		}

	}
if ($lanjut == 1)
{
	$tb=$this->db->query("select * from `guru_rph_ringkas` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and `kelas`='$kelas' order by tanggal ASC");
echo '<a href="'.base_url().'index.php/guru/rphkelas/'.$id_mapel.'"><span class="glyphicon glyphicon-refresh"></span> <b>Segarkan</b></a>';?>
<div class="row">
    <div class="col-sm-4">Tahun Pelajaran</div><div class="col-sm-8"><strong><?php echo $thnajaran;?></strong></div>
    <div class="col-sm-4">Semester</div><div class="col-sm-8"><strong><?php echo $semester;?></strong></div>
</div>

<?php
$nomor=1;
echo '<div class= "table-responsive">
<table class="table table-hover table-bordered"><thead><tr align="center"><td><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Jam Ke-</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong></td><td><strong>SK/KD</strong></td><td><strong>Rencana</strong></td><td><strong>Keterangan</strong></td><td colspan="2"><strong>Aksi</strong></td></tr></thead>';
if(count($tb->result())>0)
{
	foreach($tb->result() as $t)
	{
	$dinane = tanggal_ke_hari($t->tanggal);
	$kode_rpp = $t->kode_rpp;
	$trpp = $this->db->query("select * from `guru_rpp_induk` where `id_guru_rpp_induk`='$kode_rpp'");
	$rencana ='';
	$sk = '';
	$kd = '';
	foreach($trpp->result() as $rpp)
		{
			$rencana = $rpp->rencana;
			$sk = $rpp->standar_kompetensi;
			$kd = $rpp->kompetensi_dasar;
		}

	echo "<tr><td>".$nomor."</td><td>".$dinane.", ".date_to_long_string($t->tanggal)."</td><td>".$t->jamke."</td><td>".$t->kelas."</td><td>".$t->mapel."</td><td><b>".tanpa_paragraf($sk)."</b> / ".tanpa_paragraf($kd)."</td><td>".tanpa_paragraf($rencana)."</td><td>".tanpa_paragraf($t->keterangan)."</td><td>";
	?>
	<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>index.php/guru/ubahrph/<?php echo $t->id_rph;?>','yes','scrollbars=yes,width=1200,height=800')">
	<?php
	echo '<span class="glyphicon glyphicon-new-window"></span></a></td><td align="center">';
	echo "<a href='".base_url()."index.php/guru/hapusrph/".$t->id_rph."' onClick=\"return confirm('Anda yakin ingin menghapus data RPH dan BPH ini?')\" title='Hapus Data'><span class='fa fa-trash-alt'></span></a></td></tr>";
	$nomor++;
	}

}
else
{
echo "<tr><td colspan='5'>Belum ada data RPH</td></tr>";
}
echo '</table></div>';
}
if (!empty($paginator))
	{
	?>
	<h5><?php echo $paginator;?></h5>
	<?php }?>
<div class="clear padding40"></div>
</div>
