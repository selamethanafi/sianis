<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: 
// Nama Berkas 		: unduh_nilai.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php

if ((!empty($tahun1)) and (!empty($semester)) and (!empty($id_kelas)) and (!empty($format)) and (!empty($id_mapel)))
{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	$td = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	foreach($td->result() as $d)
	{
		$kelas = $d->kelas;
		$kurikulum = $d->kurikulum;
	}
	$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester' and status='Y' order by no_urut ");
	$tax = $this->db->query("select * from `m_mapel` where `id_mapel` = '$id_mapel'");
	foreach($tax->result() as $ax)
	{
		$mapel = $ax->mapel;
	}
	if ($format=='xls')
		{
$thnajarane = berkas($thnajaran);
$table = 'nilai'; // table you want to export
$kelase = berkas($kelas);
$judul = 'nilai';

$filename = 'Daftar_Nilai_Rapor_'.$kelase.'_'.$thnajarane.'_'.$semester.'.xls'; 	


//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Worksheet');
$this->excel->getActiveSheet()->setCellValue('A1', 'thnajaran');
$this->excel->getActiveSheet()->setCellValue('B1', 'semester');
$this->excel->getActiveSheet()->setCellValue('C1', 'kelas');
$this->excel->getActiveSheet()->setCellValue('D1','no_urut');
$this->excel->getActiveSheet()->setCellValue('E1','nis');
$this->excel->getActiveSheet()->setCellValue('F1','nama');
$this->excel->getActiveSheet()->setCellValue('G1','mapel');
$this->excel->getActiveSheet()->setCellValue('H1','nilai_uh1');
$this->excel->getActiveSheet()->setCellValue('I1','nilai_uh2');
$this->excel->getActiveSheet()->setCellValue('J1','nilai_uh3');
$this->excel->getActiveSheet()->setCellValue('K1','nilai_uh4');
$this->excel->getActiveSheet()->setCellValue('L1','nilai_ruh');
$this->excel->getActiveSheet()->setCellValue('M1','nilai_tu1');
$this->excel->getActiveSheet()->setCellValue('N1','nilai_tu2');
$this->excel->getActiveSheet()->setCellValue('O1','nilai_tu3');
$this->excel->getActiveSheet()->setCellValue('P1','nilai_tu4');
$this->excel->getActiveSheet()->setCellValue('Q1','nilai_rtu');
$this->excel->getActiveSheet()->setCellValue('R1','nilai_nh');
$this->excel->getActiveSheet()->setCellValue('S1','nilai_mid');
$this->excel->getActiveSheet()->setCellValue('T1','nilai_uas');
$this->excel->getActiveSheet()->setCellValue('U1','nilai_na');
if($kurikulum == '2015')
{
	$this->excel->getActiveSheet()->setCellValue('V1','pengetahuan');
	$this->excel->getActiveSheet()->setCellValue('W1','keterampilan');
	$this->excel->getActiveSheet()->setCellValue('X1','deskripsi_pengetahuan');
	$this->excel->getActiveSheet()->setCellValue('Y1','deskripsi_psikomotor');
	$this->excel->getActiveSheet()->setCellValue('Z1','ket_akhir');
	$this->excel->getActiveSheet()->setCellValue('AA1','status');
}
else
{
	$this->excel->getActiveSheet()->setCellValue('V1','kog');
	$this->excel->getActiveSheet()->setCellValue('W1','psi');
	$this->excel->getActiveSheet()->setCellValue('X1','afektif');
	$this->excel->getActiveSheet()->setCellValue('Y1','deskripsi_pengetahuan');
	$this->excel->getActiveSheet()->setCellValue('Z1','deskripsi_psikomotor');
	$this->excel->getActiveSheet()->setCellValue('AA1','deksripsi_sikap');
	$this->excel->getActiveSheet()->setCellValue('AB1','ket_akhir');
	$this->excel->getActiveSheet()->setCellValue('AC1','status');
}
$nourut = 1;
$baris = 2;
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$nama = nis_ke_nama($nis);
	$tb = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and `mapel` ='$mapel' order by `no_urut` ASC");
	foreach($tb->result() as $b)
	{
		$this->excel->getActiveSheet()->setCellValue('A'.$baris.'',$thnajaran);
		$this->excel->getActiveSheet()->setCellValue('B'.$baris.'',$semester);
		$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', $kelas);
		$this->excel->getActiveSheet()->setCellValue('D'.$baris,$a->no_urut);
		$this->excel->getActiveSheet()->setCellValue('E'.$baris.'',$nis);
		$this->excel->getActiveSheet()->setCellValue('F'.$baris.'',$nama);
		$this->excel->getActiveSheet()->setCellValue('G'.$baris,$mapel);
		$this->excel->getActiveSheet()->setCellValue('H'.$baris,$b->nilai_uh1);
		$this->excel->getActiveSheet()->setCellValue('I'.$baris,$b->nilai_uh2);
		$this->excel->getActiveSheet()->setCellValue('J'.$baris,$b->nilai_uh3);
		$this->excel->getActiveSheet()->setCellValue('K'.$baris,$b->nilai_uh4);
		$this->excel->getActiveSheet()->setCellValue('L'.$baris,$b->nilai_ruh);
		$this->excel->getActiveSheet()->setCellValue('M'.$baris,$b->nilai_tu1);
		$this->excel->getActiveSheet()->setCellValue('N'.$baris,$b->nilai_tu2);
		$this->excel->getActiveSheet()->setCellValue('O'.$baris,$b->nilai_tu3);
		$this->excel->getActiveSheet()->setCellValue('P'.$baris,$b->nilai_tu4);
		$this->excel->getActiveSheet()->setCellValue('Q'.$baris,$b->nilai_rtu);
		$this->excel->getActiveSheet()->setCellValue('R'.$baris,$b->nilai_nh);
		$this->excel->getActiveSheet()->setCellValue('S'.$baris,$b->nilai_mid);
		$this->excel->getActiveSheet()->setCellValue('T'.$baris,$b->nilai_uas);
		$this->excel->getActiveSheet()->setCellValue('U'.$baris,$b->nilai_na);
		$kognitif = $b->kog;
		$psikomotor = $b->psi;
		if($kurikulum == '2015')
		{
			$this->excel->getActiveSheet()->setCellValue('V'.$baris,$kognitif);
			$this->excel->getActiveSheet()->setCellValue('W'.$baris,$psikomotor);
			$this->excel->getActiveSheet()->setCellValue('X'.$baris,$b->keterangan);
			$this->excel->getActiveSheet()->setCellValue('Y'.$baris,$b->deskripsi);
			$this->excel->getActiveSheet()->setCellValue('Z'.$baris,$b->ket_akhir);
			$this->excel->getActiveSheet()->setCellValue('AA'.$baris,$b->status);
		}
		else
		{
			$tc = $this->db->query("select * from `afektif` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and `mapel` = '$mapel'");
			$desk_sikap = '';
			foreach($tc->result() as $c)
			{
				$desk_sikap = $c->deskripsi;
			}
			$this->excel->getActiveSheet()->setCellValue('V'.$baris,$kognitif);
			$this->excel->getActiveSheet()->setCellValue('W'.$baris,$psikomotor);
			$this->excel->getActiveSheet()->setCellValue('X'.$baris,$b->afektif);
			$this->excel->getActiveSheet()->setCellValue('Y'.$baris,$b->keterangan);
			$this->excel->getActiveSheet()->setCellValue('Z'.$baris,$b->deskripsi);
			$this->excel->getActiveSheet()->setCellValue('AA'.$baris,$desk_sikap);
			$this->excel->getActiveSheet()->setCellValue('AB'.$baris,$b->ket_akhir);
			$this->excel->getActiveSheet()->setCellValue('AC'.$baris,$b->status);
		}

		$baris++;
	}

}

header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
		} // akhir unduh xls

	if ($format=='csv')
		{
		$thnajarane = berkas($thnajaran);
		$mapele = berkas($mapel);
		$table = 'nilai'; // table you want to export
		$kelase = berkas($kelas);
		$judul = 'nilai';
		$filename = 'Daftar_Nilai_Rapor_'.$mapele.'_'.$kelase.'_'.$thnajarane.'_'.$semester.''; 	
		if($kurikulum == '2015')
		{
		$csv_output = '"thnajaran","semester","kelas","mapel","no_urut","nis","nama","nilai_uh1","nilai_uh2","nilai_uh3","nilai_uh4","nilai_ruh","nilai_tu1","nilai_tu2","nilai_tu3","nilai_tu4","nilai_rtu","nilai_nh","nilai_mid","nilai_uas","nilai_na","pengetahuan","keterampilan","ket_akhir","deskripsi_pengetahuan","deskripsi_keterampilan","status"';
		}
		else
		{
		$csv_output = '"thnajaran","semester","kelas","mapel","no_urut","nis","nama","nilai_uh1","nilai_uh2","nilai_uh3","nilai_uh4","nilai_ruh","nilai_tu1","nilai_tu2","nilai_tu3","nilai_tu4","nilai_rtu","nilai_nh","nilai_mid","nilai_uas","nilai_na","kog","psikomotor","afektif","ket_akhir","deskripsi_kognitif","deskripsi_psikomotor","deskripsi_sikap","status"';
		}

		$csv_output .= "\n";
		foreach($ta->result() as $a)
		{
				$nis=$a->nis;
				$nama = nis_ke_nama($nis);
				$tb = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and `mapel` = '$mapel' order by `no_urut`");
				foreach($tb->result() as $b)
				{
				$csv_output .= '"'.$thnajaran.'","'.$semester.'","'.$b->kelas.'","'.$b->mapel.'","'.$a->no_urut.'","'.$nis.'","'.$nama.'"';
				$csv_output .= ',"'.$b->nilai_uh1.'","'.$b->nilai_uh2.'","'.$b->nilai_uh3.'","'.$b->nilai_uh4.'","'.$b->nilai_ruh.'","'.$b->nilai_tu1.'","'.$b->nilai_tu2.'","'.$b->nilai_tu3.'","'.$b->nilai_tu4.'","'.$b->nilai_rtu.'","'.$b->nilai_nh.'","'.$b->nilai_mid.'","'.$b->nilai_uas.'","'.$b->nilai_na.'",';
					if($kurikulum == '2015')
					{
						$csv_output .= '"'.$b->kog.'","'.$b->psi.'","'.$b->ket_akhir.'","'.$b->keterangan.'","'.$b->deskripsi.'","'.$b->status.'"';				
					}
					else
					{
						$tc = $this->db->query("select * from `afektif` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and `mapel` = '$mapel'");
						$desk_sikap = '';
						foreach($tc->result() as $c)
						{
							$desk_sikap = $c->deskripsi;
						}

						$csv_output .= '"'.$b->kog.'","'.$b->psi.'","'.$b->afektif.'","'.$b->ket_akhir.'","'.$b->keterangan.'","'.$b->deskripsi.'","'.$desk_sikap.'","'.$b->status.'"';				
					}
	
				$csv_output .= "\n";
				}

		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: csv" . date("Y-m-d") . ".csv");
		header( "Content-disposition: filename=".$filename.".csv");
		print $csv_output;
 		exit;
		} // akhir csv

}
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
$xloc = base_url().'pengajaran/unduhnilairapor';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
if(!empty($tahun1))
	{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/unduhnilairapor">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/unduhnilairapor/'.$tahun1.'">Semester</a></label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '</select></div></div>';
	}
if (!empty($id_kelas))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/unduhnilairapor/'.$tahun1.'/'.$semester.'">Kelas</a></label></div><div class="col-sm-9">';
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
if (!empty($id_mapel))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/unduhnilairapor/'.$tahun1.'/'.$semester.'/'.$id_kelas.'">Mata Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$mapelx = '';
	$tax = $this->db->query("select * from `m_mapel` where `id_mapel` = '$id_mapel'");
	foreach($tax->result() as $ax)
	{
		$mapelx = $ax->mapel;
	}
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$id_mapel.'">'.$mapelx.'</option></select></div></div>';
	}
if (empty($tahun1))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	echo '</select></div></div>';
	}
elseif(empty($semester))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2">2</option>';
	echo '</select></div></div>';
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
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}
	echo '</select></div></div>';
	}
elseif(empty($id_mapel))
{
	
	$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasxx'  order by `mapel`");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$id_mapel.'">'.$mapelx.'</option>';
	foreach($ta->result() as $a)
		{
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$a->id_mapel.'">'.$a->mapel.'</option>';
		}
	echo '</select></div></div>';

}
else
{
	
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Format</label></div><div class="col-sm-9">';
	echo "<select name=\"format\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$format.'">'.$format.'</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$id_mapel.'/csv">csv</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$id_mapel.'/xls">xls</option>';
	echo '</select></div></div>';

}
echo '</form>';
?>
</div></div></div>
