<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 20:12:40 WIB 
// Nama Berkas 		: unduh_nilai_xls.php
// Lokasi      		: application/views/bp/
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
$thnajaranawal = substr($thnajaran,0,4);
$thnajaranakhir = substr($thnajaran,5,4);
$te = $this->db->query("select * from `m_walikelas` where `id_walikelas` = '$id_kelas'");
$kelas = '';
foreach($te->result() as $e)
{
	$kelas = $e->kelas;
}
$table = 'nilai'; // table you want to export
$kelase = berkas($kelas);
$judul = 'nilai';
//Daftar_Nilai_X.1_2011_1
$filename = 'Daftar_Nilai_'.$kelase.'_'.$thnajaranawal.'_'.$thnajaranakhir.'_'.$semester.'.xls'; 	
// MULAI CARI NILAI

//SISWA KELAS X-1
$this->excel->getActiveSheet()->setCellValue('A1', 'Pangkalan Data Sekolah dan Siswa');
$this->excel->getActiveSheet()->setCellValue('A3', 'No.');
$this->excel->getActiveSheet()->mergeCells("A3:A4");       
$this->excel->getActiveSheet()->setCellValue('B3', 'NISN');
$this->excel->getActiveSheet()->mergeCells("B3:B4");
$this->excel->getActiveSheet()->setCellValue('C3', 'Nama Siswa');

$tb = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `urut_smptn`");
foreach($tb->result() as $b)
{
	$urut = $b->urut_smptn;
	$mapel = $b->nama_mapel_portal;
	if($urut > 0)
	{
		$num = $urut + 3;
		$kolom = get_col_letter($num);
		$this->excel->getActiveSheet()->setCellValue($kolom.'3',$mapel);
	}
}
$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ");
$nourut = 1;
$baris = 5;
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$tb = $this->db->query("select `nama`, `nis`,`nisn`, `ket` from datsis where nis='$nis' and `ket` = 'Y'");
	if($tb->num_rows()>0)
	{
		foreach($tb->result() as $b)
		{
			$nisn = $b->nisn;
			$nama = $b->nama;
		}
		$this->excel->getActiveSheet()->setCellValue('A'.$baris.'', $nourut);
	//	$this->excel->getActiveSheet()->setCellValue('B'.$baris.'', $nisn);
		$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($nisn, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', $nama);
		$tb = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `urut_smptn`");
		foreach($tb->result() as $b)
		{
			$urut = $b->urut_smptn;
			$mapel = $b->nama_mapel_portal;
			if($urut > 0)
			{
				$num = $urut + 3;
				$kolom = get_col_letter($num);
				$penggalan = substr($mapel,0,8);
				$penggalan = strtoupper($penggalan);
				$nilai = '?';
				if(($penggalan == 'PRAKARYA') or ($penggalan == 'KETERAMP') or ($penggalan == 'KETRAMPI'))
				{
					$tc = $this->db->query("select `nis`,`thnajaran`,`semester`,`mapel`,`kog`, `status`, `kunci` from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel` like '%prakarya%' and `nis`='$nis' and `status`='Y'");
				}
				else
				{
					$tc = $this->db->query("select `nis`,`thnajaran`,`semester`,`mapel`,`kog`, `kunci` from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel` = '$mapel'");
				}
				foreach($tc->result() as $c)
				{
					if($c->kunci == 1)
					{
						$nilai = $c->kog;
					}
					else
					{
						$nilai = 'X';
					}

				}
				$this->excel->getActiveSheet()->setCellValue($kolom.$baris,$nilai);
			}
		}
		$nourut++;
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
