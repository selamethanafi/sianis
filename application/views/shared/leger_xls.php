<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 03 Des 2014 19:43:20 WIB 
// Nama Berkas 		: unduh_mapel_csv.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
// 			  selamethanafi@yahoo.co.id
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
$thnajarane = berkas($thnajaran);
$tanggalcetak = '';
$te = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
foreach($te->result() as $e)
{
	if ($semester=='1')
	{$tanggalcetak=$e->akhir1;}
	else
	{$tanggalcetak=$e->akhir2;}
}
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$namawalikelas = '';
$nipwalikelas = '';
$kodewalikelas = '';
foreach($twalikelas->result() as $dwalikelas)
{
	$kodewalikelas = $dwalikelas->kodeguru;
}
$namawalikelas = cari_nama_pegawai($kodewalikelas);
$nipwalikelas = cari_nip_pegawai($kodewalikelas);
$tanggalcetak = date_to_long_string($tanggalcetak);
$filename = 'leger_nilai_tahun_'.$thnajarane.'_semester_'.$semester.'_kelas_'.$kelas.'.xls'; 	
$ta = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
$ada = $ta->num_rows();
if($ada > 0)
{
	$styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 10,
        'name'  => 'Arial'
    ));

	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$titel = $kelas;
	$this->excel->getActiveSheet()->setTitle($titel);
	$this->excel->getActiveSheet()->setTitle($titel);
	$this->excel->getActiveSheet()->setCellValue('A1','Leger Nilai Kelas '.$kelas.' Semester '.$semester.' Tahun '.$thnajaran);
	$this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
	$baris = 3;
	$this->excel->getActiveSheet()->setCellValue('A3','No');
	$this->excel->getActiveSheet()->mergeCells('A3:A4');       
	$this->excel->getActiveSheet()->setCellValue('B3','NIS');
	$this->excel->getActiveSheet()->mergeCells('B3:B4');       
	$this->excel->getActiveSheet()->setCellValue('C3','Nama Siswa');
	$this->excel->getActiveSheet()->mergeCells('C3:C4');       
	$this->excel->getActiveSheet()->getStyle('A'.$baris.':C'.$baris)->applyFromArray($styleArray);
	$kolom = 3;
	foreach($ta->result() as $a)
	{
		$mapel = $a->nama_mapel_portal;
		if(!empty($mapel))
		{
			//cari ranah
			$kolom++;
			$ranah = 'KPA';
			$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
			foreach($tb->result() as $b)
			{
				$ranah = $b->ranah;
			}
			if($ranah == 'KPA')
				{
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,''.$mapel);
				$this->excel->getActiveSheet()->getStyle($namakolom.$baris)->getAlignment()->setTextRotation(90);
				$kolom2 = $kolom + 2;
				$kolom = $kolom2;
				$namakolom2 = get_col_letter($kolom2);
				$this->excel->getActiveSheet()->mergeCells($namakolom.$baris.':'.$namakolom2.$baris);       
				}
			if(($ranah == 'KA') or ($ranah == 'PA'))
				{
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$mapel);
				$this->excel->getActiveSheet()->getStyle($namakolom.$baris)->getAlignment()->setTextRotation(90);
				$kolom2 = $kolom + 1;
				$kolom = $kolom2;
				$namakolom2 = get_col_letter($kolom2);
				$this->excel->getActiveSheet()->mergeCells($namakolom.$baris.':'.$namakolom2.$baris);       
				}
		}
	}
	$namakolom2 = get_col_letter($kolom);
	$this->excel->getActiveSheet()->getStyle('A'.$baris.':'.$namakolom2.$baris)->applyFromArray($styleArray);
	$baris++;
	$kolom = 3;
	foreach($ta->result() as $a)
	{
		$mapel = $a->nama_mapel_portal;
		if(!empty($mapel))
		{

			//cari ranah
			$ranah = 'KPA';
			$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
			foreach($tb->result() as $b)
			{
				$ranah = $b->ranah;
			}
//		$namakolom = get_col_letter($kolom);
//		$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$namakolom.'-'.$mapel);

			if($ranah == 'KPA')
				{
				$kolom++;
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,'K');
				$kolom++;
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,'P');
				$kolom++;
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,'A');
				}
			if($ranah == 'KA')
				{
				$kolom++;
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,'K');
				$kolom++;
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,'A');
				}
			if($ranah == 'PA')
				{
				$kolom++;
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,'P');
				$kolom++;
				$namakolom = get_col_letter($kolom);
				$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,'A');
				}
		}
	}
	$namakolom2 = get_col_letter($kolom);
	$this->excel->getActiveSheet()->getStyle('A2:'.$namakolom2.$baris)->applyFromArray($styleArray);
	$this->excel->getActiveSheet()->getStyle('A2:'.$namakolom2.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->excel->getActiveSheet()->getStyle('A2:'.$namakolom2.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
	$ada_tc = $tc->num_rows();
	if($ada_tc>0)
	{
		foreach($tc->result() as $c)
		{
			$baris++;
			$kolom = 1;
			$no_urut = $c->no_urut;
			$nis = $c->nis;
			$nama_siswa = nis_ke_nama($nis);
			$namakolom = get_col_letter($kolom);
			$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$no_urut);
			$kolom++;
			$namakolom = get_col_letter($kolom);
			$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$nis);
			$kolom++;
			$namakolom = get_col_letter($kolom);
			$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$nama_siswa);
			foreach($ta->result() as $a)		
			{
				$mapel = $a->nama_mapel_portal;
				if(!empty($mapel))
				{
					//cari ranah
					$ranah = 'KPA';
					$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
					foreach($tb->result() as $b)
					{
						$ranah = $b->ranah;
					}
					$td = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
					$kog = '';
					$psi = '';
					$afe = '';
					foreach($td->result() as $d)
						{
						$kog = $d->kog;
						$psi = $d->psi;
						$afe = $d->afektif;
						}
					if($ranah == 'KPA')
					{
						$kolom++;
						$namakolom = get_col_letter($kolom);
						$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$kog);
						$kolom++;
						$namakolom = get_col_letter($kolom);
						$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$psi);
						$kolom++;
						$namakolom = get_col_letter($kolom);
						$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$afe);
					}
					if($ranah == 'KA')
					{
						$kolom++;
						$namakolom = get_col_letter($kolom);
						$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$kog);
						$kolom++;
						$namakolom = get_col_letter($kolom);
						$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$afe);
					}
					if($ranah == 'PA')
					{
						$kolom++;
						$namakolom = get_col_letter($kolom);
						$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$psi);
						$kolom++;
						$namakolom = get_col_letter($kolom);
						$this->excel->getActiveSheet()->setCellValue($namakolom.$baris,$afe);
					}
				}
			}
		}
		$namakolom = get_col_letter($kolom);
		$this->excel->getActiveSheet()->getStyle('A5:'.$namakolom.$baris)->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A5:'.$namakolom.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A5:'.$namakolom.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$this->excel->getActiveSheet()->getStyle('C5:C'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
		$this->excel->getActiveSheet()->getStyle('A3:'.$namakolom.$baris)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$baris++;
		$this->excel->getActiveSheet()->setCellValue('A'.$baris,'Keterangan:');
		$this->excel->getActiveSheet()->getStyle('A'.$baris.':Z'.$baris)->applyFromArray($styleArray);
		$baris++;
		$this->excel->getActiveSheet()->setCellValue('A'.$baris,'K = Kognitif / Pengetahuan');
		$this->excel->getActiveSheet()->setCellValue('D'.$baris,'Mengetahui,');
		$this->excel->getActiveSheet()->setCellValue('Q'.$baris,'Tengaran. '.$tanggalcetak);
		$this->excel->getActiveSheet()->getStyle('A'.$baris.':Z'.$baris)->applyFromArray($styleArray);
		$baris++;
		$this->excel->getActiveSheet()->setCellValue('A'.$baris,'P = Psikomotor / Praktik');
		$this->excel->getActiveSheet()->setCellValue('D'.$baris,'Kepala '.$this->config->item('sek_nama'));
		$this->excel->getActiveSheet()->setCellValue('Q'.$baris,'Wali kelas '.$kelas);
		$this->excel->getActiveSheet()->getStyle('A'.$baris.':Z'.$baris)->applyFromArray($styleArray);
		$baris++;
		$this->excel->getActiveSheet()->setCellValue('A'.$baris,'A = Afektif / Sikap');
		$this->excel->getActiveSheet()->getStyle('A'.$baris.':Z'.$baris)->applyFromArray($styleArray);
		$baris++;
		$baris++;
		$baris++;
		$this->excel->getActiveSheet()->setCellValue('D'.$baris,$namakepala);
		$this->excel->getActiveSheet()->setCellValue('Q'.$baris,$namawalikelas);
		$this->excel->getActiveSheet()->getStyle('A'.$baris.':Z'.$baris)->applyFromArray($styleArray);
		$baris++;
		$this->excel->getActiveSheet()->setCellValue('D'.$baris,'NIP '.$nipkepala);
		$this->excel->getActiveSheet()->setCellValue('Q'.$baris,'NIP '.$nipwalikelas);
		$this->excel->getActiveSheet()->getStyle('A'.$baris.':Z'.$baris)->applyFromArray($styleArray);


		
       	}
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
?>
