<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 08 Jan 2016 12:50:40 WIB 
// Nama Berkas 		: form_mencetak_skp.php
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
<?php
$xloc = base_url().'tatausaha/cetakskp/';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">';
echo 'Tahun Penilaian</label></div><div class="col-sm-9">';
echo "<select name=\"tahunpenilaian\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"textfield-option\">";
echo '<option value="'.$tahunpenilaian.'">'.$tahunpenilaian.'</option>';
$ta = $this->db->query("select * from `m_tapel` order by thnajaran DESC limit 0,1");
foreach($ta->result() as $a)
{
	$xtahun = substr($a->thnajaran,0,4) + 1;
	echo '<option value="'.$xloc.''.$xtahun.'">'.$xtahun.'</option>';
}
$ta = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
foreach($ta->result() as $a)
{
	$xtahun = substr($a->thnajaran,0,4);
echo '<option value="'.$xloc.''.$xtahun.'">'.$xtahun.'</option>';
}
echo '</select></div></div>';
echo '</form>';
if(!empty($tahunpenilaian))
{
	echo '<table class="table table-striped table-hover table-bordered">';
	echo '<tr align="center"><td width="100">Nomor</td><td>Kode Pegawai</td><td>Nama</td><td>Semua</td><td>Sampul SKP</td><td>Borang SKP</td><td>Penilaian SKP</td><td>Perilaku</td><td>Penilaian Prestasi Kerja</td></tr>';

	$ta = $this->db->query("select * from `p_pegawai` where `status`='Y' and `status_kepegawaian`= 'PNS' order by nama_tanpa_gelar");
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		echo "<tr><td align=\"center\">".$nomor."</td><td width=\"100\" align=\"center\">".$a->nip."</td><td >".$a->nama_tanpa_gelar." ".$a->nama."</td><td align=\"center\">";
		?>	
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$a->nip.'/semua';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></a>
		<?php
		echo "<td align=\"center\">";
		?>	
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$a->nip.'/sampul';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></a>
		<?php
		echo "</td><td align=\"center\">";
		?>	
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$a->nip.'/borang';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></a>
		<?php
		echo "</td><td align=\"center\">";
		?>	
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$a->nip.'/penilaian';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></a>
		<?php
		echo "</td><td align=\"center\">";
		?>	
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$a->nip.'/perilaku';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></a>
		<?php
		echo "</td><td align=\"center\">";
		?>	
		<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/cetakskp/<?php echo $tahunpenilaian.'/'.$a->nip.'/ppk';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></a>
		<?php
		echo '</tr>';
	$nomor++;
	}
	echo '</table>';
}
?>
</div></div></div>
