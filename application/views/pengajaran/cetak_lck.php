<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_buku_lck.php
// Lokasi      		: application/views/pengajaran/
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
<?php
$pilihan = '';
$te = $this->db->query("select * from `m_logo` limit 0,1");
foreach($te->result() as $e)
	{
	$pilihan = $e->pilihan;
	}
if($pilihan == "2")
	{
	$pilihane = 'Siluet';
	}

elseif($pilihan == "1")
	{
	$pilihane = 'Latar';
	}
else
	{
	$pilihane = 'Gambar tidak digunakan';
	}
$xloc = base_url().'pengajaran/cetaklck';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
echo '<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Gambar digunakan sebagai</label></div>
	<div class="col-sm-9"><p class="form-control-static">'.$pilihane.'</p></div></div>';
if(!empty($tahun1))
	{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/cetaklck">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/cetaklck/'.$tahun1.'">Semester</a></label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '</select></div></div>';
	}
if (!empty($id_kelas))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/cetaklck/'.$tahun1.'/'.$semester.'">Kelas</a></label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '??';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	}
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select></div></div>';
	$kelas = $kelasxx;
	}
if(($status_nilai == 'akhir') or ($status_nilai == 'sementara'))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status Nilai</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$status_nilai.'">'.$status_nilai.'</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/akhir">akhir</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/sementara">sementara</option>';
	echo '</select></div></div>';
	}
/*
if(($abaikan == 'tidak') or ($abaikan == 'ya'))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Abaikan kunci dari walikelas</label></div><div class="col-sm-9">';
	echo "<select name=\"abaikan\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	if($status_nilai == 'sementara')
		{
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$status_nilai.'/ya">ya</option>';
		}
		else
		{
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$status_nilai.'/'.$abaikan.'">'.$abaikan.'</option>';
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$status_nilai.'/ya">ya</option>';
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$status_nilai.'/tidak">tidak</option>';
		}
	echo '</select></div></div>';
	}
*/
if (empty($tahun1))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	echo '</select></div></div></form>';
	}
elseif(empty($semester))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2">2</option>';
	echo '</select></div></div></form>';
	}
elseif(empty($id_kelas))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		$kurikulum = $d->kurikulum;
		if(($kurikulum == '2013') or ($kurikulum == '2015'))
		{
			echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
		}
	}
	echo '</select></div></div></form>';
	}
elseif(($status_nilai != 'akhir') and ($status_nilai != 'sementara'))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status Nilai</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/akhir/tidak">akhir</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/sementara">sementara</option>';
	echo '</select></div></div></form>';
	}
else
{
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	echo '</div></div></form>';
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
//		echo '<p>Silakan klik tautan cetak untuk mencetak. Kalau tidak muncul, berarti ada nilai yang belum dikunci oleh walikelas.</p>';
		echo '<table class="table table-hover table-striped table-bordered"><tr align="center"><td>No</td><td>Nama</td><td>PDF</td><td>html</td></tr>';
		$nomor = 1;
		foreach($ta->result() as $a)
		{
			echo '<tr><td align="center">'.$nomor.'</td><td>'.nis_ke_nama($a->nis).'</td>';
			$nis = $a->nis;
/*
			$adayangbelumdikunci = 0;
			$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
			foreach($tc->result() as $c)
			{
				if(empty($c->kunci))
				{
				$adayangbelumdikunci++;
				}
					
			}
*/
			//cari id_thnajaran
			?>	
			<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis.'/'.$status_nilai.'/'.$kurikulum;?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a></td>
			<?php
			echo '<td align="center"><a href="'.base_url().'pengajaran/rapor/'.substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis.'/'.$status_nilai.'/'.$kurikulum.'" title = "format html  (cocok kalau menggunakan chromium atau google chrome)" target="_blank"><span class="glyphicon glyphicon-print"></span></a></td></tr>';
			$nomor++;
/*
			if($status_nilai == 'akhir')
				{
				if($abaikan=='tidak')
					{
					if ($adayangbelumdikunci==0)
						{
						?>	
						<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>index.php/pdf_report/bukulck/<?php echo $id_thnajaran.'/'.$semester.'/'.$a->nis.'/kunci/'.$status_nilai;?>','yes','scrollbars=yes,width=550,height=400')"><img border="0" src="/images/pdf.gif"></a></h2>
						<?php
						}
					}
				if($abaikan=='ya')
					{
					?>
						<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>index.php/pdf_report/bukulck/<?php echo $id_thnajaran.'/'.$semester.'/'.$a->nis.'/cuek/'.$status_nilai;?>','yes','scrollbars=yes,width=550,height=400')"><img border="0" src="/images/pdf.gif"></a></h2>
					<?php
					}
				}
			else
				{
				if($abaikan=='tidak')
					{
					if ($adayangbelumdikunci==0)
						{
						?>	
						<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>index.php/pdf_report/bukulck/<?php echo $id_thnajaran.'/'.$semester.'/'.$a->nis.'/kunci/'.$status_nilai;?>','yes','scrollbars=yes,width=550,height=400')"><img border="0" src="/images/pdf.gif"></a></h2>
						<?php
						}
					}
				if($abaikan=='ya')
					{
					?>
						<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>index.php/pdf_report/bukulck/<?php echo $id_thnajaran.'/'.$semester.'/'.$a->nis.'/cuek/'.$status_nilai;?>','yes','scrollbars=yes,width=550,height=400')"><img border="0" src="/images/pdf.gif"></a></h2>
					<?php
					}
				}
*/

		}
}
?>
</div>
