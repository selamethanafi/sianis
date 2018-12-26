<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: siswa_padamu_xls.php
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
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `kelas`,`no_urut` ");
$thnajarane = berkas($thnajaran);
$filename = 'data_siswa_ARD_tahun_'.$thnajarane.'.xlsx'; 
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data siswa';
$baris=1;
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','NAMA');
$this->excel->getActiveSheet()->setCellValue('B1', 'NISN');
$this->excel->getActiveSheet()->setCellValue('C1', 'NIS');
$this->excel->getActiveSheet()->setCellValue('D1','TEMPAT LAHIR');
$this->excel->getActiveSheet()->setCellValue('E1','TANGGAL LAHIR (DD/MM/YYYY)');
$this->excel->getActiveSheet()->setCellValue('F1','JENIS KELAMIN (L/P)');
$this->excel->getActiveSheet()->setCellValue('G1','AGAMA (lihat sheet2)');
$this->excel->getActiveSheet()->setCellValue('H1','ALAMAT');
$this->excel->getActiveSheet()->setCellValue('I1','KODEPOS');
$this->excel->getActiveSheet()->setCellValue('J1','TELEPON');
$this->excel->getActiveSheet()->setCellValue('K1','EMAIL');
$this->excel->getActiveSheet()->setCellValue('L1','NAMA AYAH');
$this->excel->getActiveSheet()->setCellValue('M1','NIK AYAH');
$this->excel->getActiveSheet()->setCellValue('N1','TANGGAL LAHIR AYAH (DD/MM/YYYY)');
$this->excel->getActiveSheet()->setCellValue('O1','PENDIDIKAN TERAKHIR AYAH (lihat sheet2)');
$this->excel->getActiveSheet()->setCellValue('P1','PEKERJAAN AYAH');
$this->excel->getActiveSheet()->setCellValue('Q1','NOMOR TELEPON AYAH');
$this->excel->getActiveSheet()->setCellValue('R1','NAMA IBU');
$this->excel->getActiveSheet()->setCellValue('S1','NIK IBU');
$this->excel->getActiveSheet()->setCellValue('T1','TANGGAL LAHIR IBU (DD/MM/YYYY)');
$this->excel->getActiveSheet()->setCellValue('U1','PENDIDIKAN TERAKHIR IBU (lihat sheet2)');
$this->excel->getActiveSheet()->setCellValue('V1','PEKERJAAN IBU');
$this->excel->getActiveSheet()->setCellValue('W1','NOMOR TELEPON IBU');
$this->excel->getActiveSheet()->setCellValue('X1','NAMA WALI');
$this->excel->getActiveSheet()->setCellValue('Y1','NIK WALI');
$this->excel->getActiveSheet()->setCellValue('Z1','TANGGAL LAHIR WALI (DD/MM/YYYY)');
$this->excel->getActiveSheet()->setCellValue('AA1','PENDIDIKAN TERAKHIR WALI (lihat sheet2)');
$this->excel->getActiveSheet()->setCellValue('AB1','PEKERJAAN WALI');
$this->excel->getActiveSheet()->setCellValue('AC1','TELEPON WALI');
$baris++;
$nomor = 1;
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$no_urut = $a->no_urut;
	$kelas = $a->kelas;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	$tahunmasuk = '';
	$kodepadamu = '';
	foreach($tb->result() as $b)
	{
		$nisn = $b->nisn;
		$namasiswa = strtolower($b->nama);
		$namasiswa = ucwords($namasiswa);
		$jeniskelamin = jenkel_siswa($nis,0);
		$alamat2 = '';
		$tanggallahir = tanggal_slash($b->tgllhr);
//		$tanggallahir = $b->tgllhr;
		$alamat = $b->alamat;
		if (!empty($b->jalan))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Jalan '.$b->jalan;
		}
		if (!empty($b->rt))
		{
		if (!empty($alamat2))
			{
				$alamat2 .= ' ';
			}
		$alamat2 .= 'RT '.$b->rt;

		}
		if (!empty($b->rw))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'RW '.$b->rw;
		}
		if (!empty($b->dusun))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'Dusun '.$b->dusun;
		}
		if (!empty($b->desa))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Desa '.$b->desa;
		}
		if (!empty($b->kec))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Kec. '.$b->kec;
		}
		if (!empty($b->kab))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Kab. '.$b->kab;
		}
		if (!empty($b->prov))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Prov. '.$b->prov;
		}
		$goldarah = $b->goldarah;
		$hp = $b->hp;
		$this->excel->getActiveSheet()->getCell('A'.$baris)->setValueExplicit($namasiswa, PHPExcel_Cell_DataType::TYPE_STRING);
		if(empty($nisn))
		{
			$yy=substr($b->tgllhr,2,2);
			$mm=substr($b->tgllhr,5,2);
	  		$dd=substr($b->tgllhr,8,2);
			$nisn = $depan.$dd.$mm.$yy;//.$nis;
			$this->db->query("update `datsis` set `nisn`='$nisn' where `nis`='$nis'");
		}
		$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($nisn, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('C'.$baris)->setValueExplicit($nis, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('D'.$baris)->setValueExplicit($b->tmpt, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('E'.$baris)->setValueExplicit($tanggallahir, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('F'.$baris,$jeniskelamin);
		$this->excel->getActiveSheet()->setCellValue('G'.$baris,'1');
		$this->excel->getActiveSheet()->setCellValue('H'.$baris,$alamat2);
		$this->excel->getActiveSheet()->setCellValue('I'.$baris,'');
		$this->excel->getActiveSheet()->getCell('J'.$baris)->setValueExplicit($hp, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('K'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('L'.$baris,$b->nmayah);
		$this->excel->getActiveSheet()->getCell('M'.$baris)->setValueExplicit($b->nik_kk, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('N'.$baris,tanggal_slash($b->tglayah));
		$this->excel->getActiveSheet()->setCellValue('O'.$baris,kode_sekolah_ard($b->sekayah));
		if($b->payah == 'Tidak bekerja (Di rumah saja)')
		{
			$this->excel->getActiveSheet()->setCellValue('P'.$baris,'Tidak bekerja');
		}
		else
		{
			$this->excel->getActiveSheet()->setCellValue('P'.$baris,$b->payah);
		}

		$this->excel->getActiveSheet()->getCell('Q'.$baris)->setValueExplicit($b->tayah, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('R'.$baris,$b->nmibu);
		$this->excel->getActiveSheet()->getCell('S'.$baris)->setValueExplicit($b->nik_ibu, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('T'.$baris,tanggal_slash($b->tglibu));
		$this->excel->getActiveSheet()->setCellValue('U'.$baris,kode_sekolah_ard($b->sekibu));
		if($b->pibu == 'Tidak bekerja (Di rumah saja)')
		{
			$this->excel->getActiveSheet()->setCellValue('V'.$baris,'Tidak bekerja');
		}
		else
		{
			$this->excel->getActiveSheet()->setCellValue('V'.$baris,$b->pibu);
		}
		$this->excel->getActiveSheet()->getCell('W'.$baris)->setValueExplicit($b->tibu, PHPExcel_Cell_DataType::TYPE_STRING);
		if(!empty($b->nmwali))
		{
			$this->excel->getActiveSheet()->setCellValue('X'.$baris,$b->nmwali);
			$this->excel->getActiveSheet()->getCell('Y'.$baris)->setValueExplicit($b->nik_wali, PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValue('Z'.$baris,tanggal_slash($b->twali));
			$this->excel->getActiveSheet()->setCellValue('AA'.$baris,kode_sekolah_ard($b->sekwali));
			if($b->pwali == 'Tidak bekerja (Di rumah saja)')
			{
				$this->excel->getActiveSheet()->setCellValue('AB'.$baris,'Tidak bekerja');
			}
			else
			{
				$this->excel->getActiveSheet()->setCellValue('AB'.$baris,$b->pwali);
			}
			$this->excel->getActiveSheet()->getCell('AC'.$baris)->setValueExplicit($b->twali, PHPExcel_Cell_DataType::TYPE_STRING);
		}
		$nomor++;
		$baris++;
	} //akhir foreach $tb
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
// akhir unduh xls
