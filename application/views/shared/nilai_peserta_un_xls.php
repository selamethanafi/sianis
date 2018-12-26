<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 12 Mei 2016 13:06:08 WIB 
// Nama Berkas 		: nilai_peserta_un_xls.php
// Lokasi      		: application/views/shared/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<?php
if (!empty($id_mapel))
	{
	$td = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	foreach($td->result() as $d)
		{
		$thnajaran = $d->thnajaran;
		$semester = $d->semester;
		$kelas = $d->kelas;
		$mapel = $d->mapel;
		}
	}
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)) and (!empty($mapel)))
{
	$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester' and kelas='$kelas' and status='Y' order by no_urut ");

$thnajarane = berkas($thnajaran);
$table = 'nilai'; // table you want to export
$kelase = berkas($kelas);
$mapele = berkas($mapel);
$filename = 'daftar_nilai_peserta_ujian_nasional_tahun_'.$thnajarane.'_'.$mapele.'_kelas_'.$kelase.'.xls'; 


//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = substr($mapele,0,20);
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1', 'No');
$this->excel->getActiveSheet()->setCellValue('B1', 'Identitas');
$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$this->excel->getActiveSheet()->setCellValue('C1','Semester');
$this->excel->getActiveSheet()->setCellValue('D1', 'KKM');
$this->excel->getActiveSheet()->setCellValue('E1','Pengetahuan');
$this->excel->getActiveSheet()->setCellValue('F1','Praktik');
$this->excel->getActiveSheet()->setCellValue('G1','Sikap');
$this->excel->getActiveSheet()->setCellValue('H1','Kelas');
$this->excel->getActiveSheet()->setCellValue('I1','Tuntas');
$this->excel->getActiveSheet()->setCellValue('J1','thnajaran');
$this->excel->getActiveSheet()->setCellValue('K1','semester');
$this->excel->getActiveSheet()->setCellValue('L1','nis');
$this->excel->getActiveSheet()->setCellValue('M1','mapel');
$this->excel->getActiveSheet()->setCellValue('N1','ket');
$this->excel->getActiveSheet()->setCellValue('O1','keterangan');

$nourut = 1;
$baris = 1;
$pembagiujian = 1;
foreach($ta->result() as $a)
{	
	$baris++;
	$nis = $a->nis;
	$nama = nis_ke_nama($nis);
	$this->excel->getActiveSheet()->setCellValue('A'.$baris.'',$nourut);
	$this->excel->getActiveSheet()->setCellValue('B'.$baris.'',$nis);
	$baris2 = $baris+1;
	$this->excel->getActiveSheet()->setCellValue('B'.$baris2.'',$nama);
	$romawi = 1;
	$tb = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' order by thnajaran ASC, semester ASC");
	$j1= $baris;
	$j11 = $baris+2;
	$pembagi = 1 ;
	$cacahnilai = 0;
	foreach($tb->result() as $b)
	{

		$thnajarane = $b->thnajaran;
		$semestere = $b->semester;
		$kelase = $b->kelas;
		//cari kkm
		$tc = $this->db->query("select * from m_mapel where mapel='$mapel' and thnajaran='$thnajarane' and semester='$semestere' and kelas='$kelase'");
		$kkm = 0;
		$ranah = '';
		$status = 'Belum kompeten';
		$kog = 0;
		$psi = 1;
		$afe = 0;
		foreach($tc->result() as $c)
		{
			$kkm = $c->kkm;
			$ranah = $c->ranah;
		}
		if ($romawi==7)
			{$romawi = '1';}

		if ($romawi==1)
			{$rom = 'I';}
		if ($romawi==2)
			{$rom = 'II';}
		if ($romawi==3)
			{$rom = 'III';}
		if ($romawi==4)
			{$rom = 'IV';}
		if ($romawi==5)
			{$rom = 'V';}
		if ($romawi==6)
			{$rom = 'VI';}
		if ($ranah == 'KPA')
			{
			$pembagi = 6;
			$pembagiujian = 2;
			if ($b->kog<$kkm)
				{
				$kog = 0;
				}
				else
				{
				$kog = 1;
				}
			if ($b->psi<$kkm)
				{
				$psi = 0;
				}
				else
				{
				$psi = 1;
				}

			}
		if ($ranah == 'KA')
			{
			$pembagi = 3;
			$psi = 1;
			$pembagiujian = 1;
			if ($b->kog<$kkm)
				{
				$kog = 0;
				}
				else
				{
				$kog = 1;
				}

			}
		if ($ranah == 'PA')
			{
			$kog = 1;
			$pembagi = 3;
			$pembagiujian = 1;
			if ($b->psi<$kkm)
				{
				$psi = 0;
				}
				else
				{
				$psi = 1;
				}

			}
		if (($b->afektif=='A') or ($b->afektif=='B') or ($b->afektif=='AB'))
				{
				$afe = 1;
				}
				else
				{
				$afe = 0;
				}
		if (($kog==1) and ($psi==1) and ($afe==1))
			{
			$status = 'Sudah kompeten';
			}

		$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', $rom);
		$this->excel->getActiveSheet()->setCellValue('D'.$baris.'', $kkm);
		$this->excel->getActiveSheet()->setCellValue('E'.$baris,$b->nilai_nr);
		$this->excel->getActiveSheet()->setCellValue('F'.$baris.'',$b->psikomotor);
		$this->excel->getActiveSheet()->setCellValue('G'.$baris.'',$b->afektif);
		$this->excel->getActiveSheet()->setCellValue('H'.$baris,$b->kelas);
		$this->excel->getActiveSheet()->setCellValue('I'.$baris,$status);
		$this->excel->getActiveSheet()->setCellValue('J'.$baris,$b->thnajaran);
		$this->excel->getActiveSheet()->setCellValue('K'.$baris,$b->semester);
		$this->excel->getActiveSheet()->setCellValue('L'.$baris,$nis);
		$this->excel->getActiveSheet()->setCellValue('M'.$baris,$mapel);
		$this->excel->getActiveSheet()->setCellValue('N'.$baris,$status);
		$this->excel->getActiveSheet()->setCellValue('O'.$baris,$b->keterangan);

		$cacahnilai++;
		$romawi++;
		$baris++;
	}
	$j2 = $baris - 2;
	//ujian sekolah
	$ns = 0;
	$nu = 0;
	$np = 0;

	$tc = $this->db->query("select * from nilai_ujian where nis='$nis' and mapel='$mapel'");
	foreach($tc->result() as $c)
	{	
		$nu = $c->nilai;
		$np = $c->praktik;
	}
	$us = $nu+$np;
		$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', 'US');
		$this->excel->getActiveSheet()->setCellValue('E'.$baris,$nu);
		$this->excel->getActiveSheet()->setCellValue('F'.$baris,$np);
		$this->excel->getActiveSheet()->setCellValue('J'.$baris,$b->thnajaran);
		$this->excel->getActiveSheet()->setCellValue('K'.$baris,'US');
		$this->excel->getActiveSheet()->setCellValue('L'.$baris,$nis);
		$this->excel->getActiveSheet()->setCellValue('M'.$baris,$mapel);
		$this->excel->getActiveSheet()->setCellValue('N'.$baris,$b->ket);
		$this->excel->getActiveSheet()->setCellValue('O'.$baris,$b->keterangan);

		$barisus = $baris;
		$baris++;	

	//Nilai sekolah
		$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', 'NS');
//		$rumus = 'jajal';
		if($thnajaran == '2015/2016')
		{
			$rumus = '=ROUND(0.06*(sum(E'.$j11.':F'.$j2.'))/'.$pembagi.'';
			$rumus .= '+(0.04*(sum(E'.$barisus.':F'.$barisus.'))/'.$pembagiujian.'),2)';
		}
		else
		{
			$rumus = '=ROUND(0.07*(sum(E'.$j11.':F'.$j2.'))/'.$pembagi.'';
			$rumus .= '+(0.03*(sum(E'.$barisus.':F'.$barisus.'))/'.$pembagiujian.'),2)';

		}

		$this->excel->getActiveSheet()->setCellValue('E'.$baris,"$rumus");
		$this->excel->getActiveSheet()->setCellValue('F'.$baris,"$rumus");
		$rumus2 = '=if(E'.$baris.'>=8.2,"Terima Kasih Banyak",if(E'.$baris.'>=8,"Terima Kasih","Tambahi Lagi"))';
		$this->excel->getActiveSheet()->setCellValue('I'.$baris,"$rumus2");
		$baristrim = $baris;
/*
	if ($cacahnilai>=5)
		{
		//$this->excel->getActiveSheet()->setCellValue('E'.$baris,"$rumus");
		//$this->excel->getActiveSheet()->setCellValue('F'.$baris,"$rumus");
		}
		else
		{
		$this->excel->getActiveSheet()->setCellValue('E'.$baris,"Nilai Tidak Lengkap");
		}
*/
		$baris++;	
	//ujian sekolah
/*
		$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', 'NS');
		$this->excel->getActiveSheet()->setCellValue('E'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('F'.$baris,'');
		$baris++;	
*/
	$nourut++;
}
$this->excel->getActiveSheet()->getStyle('C1:H'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('C1:R'.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$baris++;
$baris++;
$this->excel->getActiveSheet()->setCellValue('A'.$baris,"$mapel");

header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
} // akhir unduh xls
