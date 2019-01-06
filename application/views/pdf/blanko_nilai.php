<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 05 Jan 2016 11:02:22 WIB 
// Nama Berkas 		: blanko_nilai.php
// Lokasi      		: application/views/pdf/
// Author      		: Selamet Hanafi
//	                  selamethanafi@yahoo.co.id
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

$thnajaranx = str_replace("/", "_", $thnajaran);
$this->fpdf->FPDF("P","cm","Legal");

// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1.5,1,1);
$x=1.5;
$y = 7.0;
$x2 = 4.0;
$x3 = 1.0;
$x4 = 5.0;
$ada = 0;
$batas = 41;
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
// AddPage merupakan fungsi untuk membuat halaman baru
$tdaftar_mapel = $this->Nilai_model->Daftar_Mapel($thnajaran,$semester,$kodeguru);
foreach($tdaftar_mapel->result() as $ddaftar_mapel) 
{
	if (($ddaftar_mapel->ranah=='KPA') or ($ddaftar_mapel->ranah=='KA') or ($ddaftar_mapel->ranah=='KP'))
	{
		$this->fpdf->AddPage();
		$this->fpdf->SetY(1.0);
		$this->fpdf->SetFont('Times','',8);
		$this->fpdf->SetXY(1.5,1.0);

		$this->fpdf->setFont('Arial','',10);
		$this->fpdf->Cell(18,0.5,'DAFTAR PENILAIAN PESERTA DIDIK',0,2,'C',0);
		$this->fpdf->Cell(18,0.5,$this->config->item('sek_nama'),0,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
		$this->fpdf->Cell(3,0.5,'Mata Pelajaran',0,0,'L',0);
		$this->fpdf->SetX($x4);
		$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->mapel,0,0,'L',0);
		$this->fpdf->SetX(15);
		$this->fpdf->Cell(3,0.5,'Kelas',0,0,'L',0);
		$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kelas,0,2,'L',0);
		$kelas = $ddaftar_mapel->kelas;
		$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
		$kog = 'Kognitif';
		$psi = 'Psikomotor';
		$afe = 'Afektif';
		if(($kurikulum == '2015') or ($kurikulum == '2015'))
		{
			$kog = 'Pengetahuan';
			$psi = 'Keterampilan';
			$afe = 'Sikap';
		}

		$this->fpdf->SetX($x);
		$this->fpdf->Cell(3,0.5,'Penilaian',0,0,'L',0);
		$this->fpdf->SetX($x4);
		$this->fpdf->Cell(5,0.5,': '.$kog,0,0,'L',0);
		$this->fpdf->SetX(15);
		$this->fpdf->Cell(3,0.5,'Semester',0,0,'L',0);
		$this->fpdf->Cell(3,0.5,': '.$semester,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(3,0.5,'KKM',0,0,'L',0);
		$this->fpdf->SetX($x4);
		$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kkm,0,0,'L',0);
		$this->fpdf->SetX(15);
		$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
		$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);

		//JUDUL KOLOM
		$this->fpdf->SetX($x);
		$this->fpdf->cell(18,0.3,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->setFont('Arial','',9);

		$this->fpdf->Cell(1.0,0.5,'No',1,0,'C',0);
		$this->fpdf->cell(5.5,0.5,'Nama ',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'UH1',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'UH2',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'UH3',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'UH4',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'RUH',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'TU1',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'TU2',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'TU3',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'TU4',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'RTU',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'NH',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'MID',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'SMT',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'NA',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'NR',1,2,'C',0);

		//CARI DAFTAR SISWA
		$kelas = $ddaftar_mapel->kelas;
		$tdaftar_siswa=$this->Nilai_model->Siswa_Kelas($thnajaran,$kelas,$semester);
		$nomor=1;
		foreach($tdaftar_siswa->result() as $ddaftar_siswa) 
		{
			$this->fpdf->SetX($x);
			$this->fpdf->cell(1.0,0.5,$nomor,1,0,'C',0);
			$this->fpdf->cell(5.5,0.5,''.nis_ke_nama($ddaftar_siswa->nis).'',1,0,'L',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,2,'C',0);
			$nomor++;
		}
		if($nomor<$batas)
		{
		$ekstra = 1;
		do
		{
			$this->fpdf->SetX($x);
			$this->fpdf->cell(1,0.5,''.$nomor.'',1,0,'C',0);
			$this->fpdf->cell(5.5,0.5,'',1,0,'L',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
				$nomor++;
				$ekstra++;
		}
		while ($ekstra < 4);
		}
		$this->fpdf->SetX($x);
		$this->fpdf->cell(6.5,0.5,'Rata - rata',1,0,'L',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
		$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
		$namakepala = cari_kepala_baru($thnajaran,$semester);
		$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
		$tguru = $this->Nilai_model->Kode_Guru_ke_Nama_Guru($ddaftar_mapel->kodeguru);
		$namaguru = '';
		$nipguru = '';
		foreach($tguru->result() as $dguru)
		{
			$namaguru = $dguru->nama;
			$nipguru = $dguru->nip;
		}

		$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->SetX(4.0);
		$this->fpdf->cell(1.0,0.3,'Mengetahui',0,0,'L',0);
		$this->fpdf->SetX(14.0);
		$this->fpdf->cell(2.0,0.3,$this->config->item('lokasi').' ,',0,2,'L',0);
		$this->fpdf->SetX(4.0);
		$this->fpdf->cell(1.0,0.4,$this->config->item('plt').'Kepala',0,0,'L',0);
		$this->fpdf->SetX(14.0);
		$this->fpdf->cell(2.0,0.4,'Guru Mata Pelajaran',0,2,'L',0);
		$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->SetX(4.0);
		$this->fpdf->cell(1.0,0.3,''.$namakepala.'',0,0,'L',0);
		$this->fpdf->SetX(14);
		$this->fpdf->cell(2,0.3,''.$namaguru.'',0,2,'L',0);
		$this->fpdf->SetX(4.0);
		$this->fpdf->cell(1.0,0.3,'NIP '.$nipkepala.'',0,0,'L',0);
		$this->fpdf->SetX(14.0);
		$this->fpdf->cell(2.0,0.3,'NIP '.$nipguru.'',0,2,'L',0);
		$this->fpdf->SetX(1);
		$this->fpdf->SetY(-6);

		/* setting font untuk footer */
		$this->fpdf->SetFont('Times','',10);

		/* setting Cell untuk waktu pencetakan */ 
		$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb} Dicetak : '.date('d/m/Y H:i').' | '.$this->config->item('nama_web'),0,'LR','L');

	}
	$dpilihan = $pilihan;
	if ($ddaftar_mapel->ranah=='KP')
	{
		$dpilihan = 2;
	}
	//psikomotor
	if (($ddaftar_mapel->ranah=='KPA') or ($ddaftar_mapel->ranah=='PA') or ($ddaftar_mapel->ranah=='KP'))
	{
		if ($dpilihan=='1')//p dan a jadi 1
		
		{
			$this->fpdf->AddPage();
			$this->fpdf->SetY(1.0);
			$this->fpdf->SetFont('Times','',8);
			$this->fpdf->SetXY(1.5,1.0);
			$this->fpdf->setFont('Arial','',10);
			$this->fpdf->Cell(18,0.5,'DAFTAR PENILAIAN PESERTA DIDIK',0,2,'C',0);
			$this->fpdf->Cell(18,0.5,$this->config->item('sek_nama'),0,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
			$this->fpdf->Cell(3,0.5,'Mata Pelajaran',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->mapel,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Kelas',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kelas,0,2,'L',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(3,0.5,'Penilaian',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(5,0.5,': '.$psi.' dan '.$afe,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Semester',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$semester,0,2,'L',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(3,0.5,'KKM',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kkm,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);

			//JUDUL KOLOM
			$this->fpdf->SetX($x);
			$this->fpdf->cell(18,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->setFont('Arial','',9);

			$this->fpdf->Cell(1.0,1,'No',1,0,'C',0);
			$this->fpdf->cell(5.5,1,'Nama ',1,0,'C',0);
			$this->fpdf->cell(6.0,0.5,'Psikomotor',1,0,'C',0);
			$this->fpdf->cell(6.0,0.5,'Afektif',1,2,'C',0);
			$this->fpdf->SetX($x+6.5);
			$this->fpdf->cell(0.8,0.5,'1',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'2',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'3',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'4',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'5',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'6',1,0,'C',0);
			$this->fpdf->cell(1.2,0.5,'NR',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'1',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'2',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'3',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'4',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'5',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'6',1,0,'C',0);
			$this->fpdf->cell(1.2,0.5,'NR',1,2,'C',0);

			//CARI DAFTAR SISWA
			$kelas = $ddaftar_mapel->kelas;
			$tdaftar_siswa=$this->Nilai_model->Siswa_Kelas($thnajaran,$kelas,$semester);
			$nomor=1;
			foreach($tdaftar_siswa->result() as $ddaftar_siswa) 
			{
				$this->fpdf->SetX($x);
				$this->fpdf->cell(1.0,0.5,$nomor,1,0,'C',0);
				$this->fpdf->cell(5.5,0.5,''.nis_ke_nama($ddaftar_siswa->nis).'',1,0,'L',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(1.2,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(1.2,0.5,'',1,2,'L',0);
				$nomor++;
			}
			if($nomor<$batas)
			{
			$ekstra = 1;
			do
			{
				$this->fpdf->SetX($x);
				$this->fpdf->cell(1,0.5,''.$nomor.'',1,0,'C',0);
				$this->fpdf->cell(5.5,0.5,'',1,0,'L',0);
				$this->fpdf->SetX($x+6.5);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(1.2,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(1.2,0.5,'',1,2,'C',0);
				$nomor++;
				$ekstra++;
			}
			while ($ekstra < 4);
			}
			$this->fpdf->SetX($x);
			$this->fpdf->cell(6.5,0.5,'Rata - rata',1,0,'L',0);
			$this->fpdf->SetX($x+6.5);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(1.2,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(1.2,0.5,'',1,2,'C',0);
			$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
			$namakepala = cari_kepala_baru($thnajaran,$semester);
			$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
			$tguru = $this->Nilai_model->Kode_Guru_ke_Nama_Guru($ddaftar_mapel->kodeguru);
			$namaguru = '';
			$nipguru = '';
			foreach($tguru->result() as $dguru)
			{
			$namaguru = $dguru->nama;
			$nipguru = $dguru->nip;
			}

			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,'Mengetahui',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.3,$this->config->item('lokasi').' ,',0,2,'L',0);
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.4,$this->config->item('plt').'Kepala',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.4,'Guru Mata Pelajaran',0,2,'L',0);
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,''.$namakepala.'',0,0,'L',0);
			$this->fpdf->SetX(14);
			$this->fpdf->cell(2,0.3,''.$namaguru.'',0,2,'L',0);
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,'NIP '.$nipkepala.'',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.3,'NIP '.$nipguru.'',0,2,'L',0);
	$this->fpdf->SetX(1);
	$this->fpdf->SetY(-6);

			/* setting font untuk footer */
			$this->fpdf->SetFont('Times','',10);

			/* setting Cell untuk waktu pencetakan */ 
			$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb} Dicetak : '.date('d/m/Y H:i').' | '.$this->config->item('nama_web'),0,'LR','L');

		}
		else // p dan a dua halaman
		{

			$this->fpdf->AddPage();
			$this->fpdf->SetY(1.0);
			$this->fpdf->SetFont('Times','',8);
			$this->fpdf->SetXY(1.5,1.0);
			$this->fpdf->setFont('Arial','',10);
			$this->fpdf->Cell(18,0.5,'DAFTAR NILAI PESERTA DIDIK',0,2,'C',0);
			$this->fpdf->Cell(18,0.5,$this->config->item('sek_nama'),0,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
			$this->fpdf->Cell(3,0.5,'Mata Pelajaran',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->mapel,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Kelas',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kelas,0,2,'L',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(3,0.5,'Penilaian',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(5,0.5,': '.$psi,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Semester',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$semester,0,2,'L',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(3,0.5,'KKM',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kkm,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
			//JUDUL KOLOM
			$this->fpdf->SetX($x);
			$this->fpdf->cell(18,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->setFont('Arial','',9);

			$this->fpdf->Cell(1.0,0.5,'No',1,0,'C',0);
			$this->fpdf->cell(5.5,0.5,'Nama ',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'1',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'2',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'3',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'4',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'5',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'6',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'7',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'8',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'9',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'10',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'11',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'12',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'13',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'NA',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'NR',1,2,'C',0);
	
			//CARI DAFTAR SISWA
			$kelas = $ddaftar_mapel->kelas;
			$tdaftar_siswa=$this->Nilai_model->Siswa_Kelas($thnajaran,$kelas,$semester);
			$nomor=1;
			foreach($tdaftar_siswa->result() as $ddaftar_siswa) 
			{
				$this->fpdf->SetX($x);
				$this->fpdf->cell(1.0,0.5,$nomor,1,0,'C',0);
				$this->fpdf->cell(5.5,0.5,''.nis_ke_nama($ddaftar_siswa->nis).'',1,0,'L',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,2,'C',0);
				$nomor++;
			}
			if($nomor<$batas)
			{
			$ekstra = 1;
			do
			{
				$this->fpdf->SetX($x);
				$this->fpdf->cell(1,0.5,''.$nomor.'',1,0,'C',0);
				$this->fpdf->cell(5.5,0.5,'',1,0,'L',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
				$nomor++;
				$ekstra++;
			}
			while ($ekstra < 4);
			}
			$this->fpdf->SetX($x);
			$this->fpdf->cell(6.5,0.5,'Rata - rata',1,0,'L',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
			$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
			$namakepala = cari_kepala_baru($thnajaran,$semester);
			$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
			$tguru = $this->Nilai_model->Kode_Guru_ke_Nama_Guru($ddaftar_mapel->kodeguru);
			$namaguru = '';
			$nipguru = '';
			foreach($tguru->result() as $dguru)
			{
				$namaguru = $dguru->nama;
				$nipguru = $dguru->nip;
			}

			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,'Mengetahui',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.3,$this->config->item('lokasi').' ,',0,2,'L',0);
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.4,$this->config->item('plt').'Kepala',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.4,'Guru Mata Pelajaran',0,2,'L',0);
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,''.$namakepala.'',0,0,'L',0);
			$this->fpdf->SetX(14);
			$this->fpdf->cell(2,0.3,''.$namaguru.'',0,2,'L',0);
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,'NIP '.$nipkepala.'',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.3,'NIP '.$nipguru.'',0,2,'L',0);
			if (substr($ddaftar_mapel->ranah,0,1) =='A')
			{
			//afektif
				$this->fpdf->AddPage();
				$this->fpdf->SetY(1.0);
				$this->fpdf->SetFont('Times','',8);
				$this->fpdf->SetXY(1.5,1.0);
				$this->fpdf->setFont('Arial','',10);
				$this->fpdf->Cell(18,0.5,'DAFTAR NILAI PESERTA DIDIK',0,2,'C',0);
				$this->fpdf->Cell(18,0.5,$this->config->item('sek_nama'),0,2,'C',0);
				$this->fpdf->SetX($x);
				$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
				$this->fpdf->Cell(3,0.5,'Mata Pelajaran',0,0,'L',0);
				$this->fpdf->SetX($x4);
				$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->mapel,0,0,'L',0);
				$this->fpdf->SetX(15);
				$this->fpdf->Cell(3,0.5,'Kelas',0,0,'L',0);
				$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kelas,0,2,'L',0);
				$this->fpdf->SetX($x);
				$this->fpdf->Cell(3,0.5,'Penilaian',0,0,'L',0);
				$this->fpdf->SetX($x4);
				$this->fpdf->Cell(5,0.5,': '.$afe,0,0,'L',0);
				$this->fpdf->SetX(15);
				$this->fpdf->Cell(3,0.5,'Semester',0,0,'L',0);
				$this->fpdf->Cell(3,0.5,': '.$semester,0,2,'L',0);
				$this->fpdf->SetX($x);
				$this->fpdf->Cell(3,0.5,'KKM',0,0,'L',0);
				$this->fpdf->SetX($x4);
				$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kkm,0,0,'L',0);
				$this->fpdf->SetX(15);
				$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
				$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
				//JUDUL KOLOM
				$this->fpdf->SetX($x);
				$this->fpdf->cell(18,0.3,' ',0,2,'C',0); // spasi kosong
				$this->fpdf->setFont('Arial','',9);
				$this->fpdf->Cell(1.0,0.5,'No',1,0,'C',0);
				$this->fpdf->cell(5.5,0.5,'Nama ',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'1',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'2',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'3',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'4',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'5',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'6',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'7',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'8',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'9',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'10',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'11',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'12',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'13',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'NA',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'NR',1,2,'C',0);
				//CARI DAFTAR SISWA
				$kelas = $ddaftar_mapel->kelas;
				$tdaftar_siswa=$this->Nilai_model->Siswa_Kelas($thnajaran,$kelas,$semester);
				$nomor=1;
				foreach($tdaftar_siswa->result() as $ddaftar_siswa) 
				{
					$namasiswa = nis_ke_nama($ddaftar_siswa->nis);
					$this->fpdf->SetX($x);
					$this->fpdf->cell(1.0,0.5,$nomor,1,0,'C',0);
					$this->fpdf->cell(5.5,0.5,''.$namasiswa.'',1,0,'L',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,2,'C',0);
					$nomor++;
				}
				if($nomor<$batas)
				{
				$ekstra = 1;
				do
				{
					$this->fpdf->SetX($x);
					$this->fpdf->cell(1,0.5,''.$nomor.'',1,0,'C',0);
					$this->fpdf->cell(5.5,0.5,'',1,0,'L',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
					$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
					$nomor++;
					$ekstra++;
				}
				while ($ekstra < 4);
				}
				$this->fpdf->SetX($x);
				$this->fpdf->cell(6.5,0.5,'Rata - rata',1,0,'L',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
				$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
				$namakepala = cari_kepala_baru($thnajaran,$semester);
				$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
				$tguru = $this->Nilai_model->Kode_Guru_ke_Nama_Guru($ddaftar_mapel->kodeguru);
				$namaguru = '';
				$nipguru = '';
				foreach($tguru->result() as $dguru)
				{
					$namaguru = $dguru->nama;
					$nipguru = $dguru->nip;
				}
				$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
				$this->fpdf->SetX(4.0);
				$this->fpdf->cell(1.0,0.3,'Mengetahui',0,0,'L',0);
				$this->fpdf->SetX(14.0);
				$this->fpdf->cell(2.0,0.3,$this->config->item('lokasi').' ,',0,2,'L',0);
				$this->fpdf->SetX(4.0);
				$this->fpdf->cell(1.0,0.4,$this->config->item('plt').'Kepala',0,0,'L',0);
				$this->fpdf->SetX(14.0);
				$this->fpdf->cell(2.0,0.4,'Guru Mata Pelajaran',0,2,'L',0);
				$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
				$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
				$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
				$this->fpdf->SetX(4.0);
				$this->fpdf->cell(1.0,0.3,''.$namakepala.'',0,0,'L',0);
				$this->fpdf->SetX(14);
				$this->fpdf->cell(2,0.3,''.$namaguru.'',0,2,'L',0);
				$this->fpdf->SetX(4.0);
				$this->fpdf->cell(1.0,0.3,'NIP '.$nipkepala.'',0,0,'L',0);
				$this->fpdf->SetX(14.0);
				$this->fpdf->cell(2.0,0.3,'NIP '.$nipguru.'',0,2,'L',0);
				$this->fpdf->SetX(1);
				$this->fpdf->SetY(-6);
				/* setting font untuk footer */
				$this->fpdf->SetFont('Times','',10);
				/* setting Cell untuk waktu pencetakan */ 
				$this->fpdf->Cell(9.5, 0.5, 'Dicetak : '.date('d/m/Y H:i').' | '.$this->config->item('nama_web'),0,'LR','L');
			}
	
		} // endif dua halaman
	} //endif kpa atau ka
	
	if ($ddaftar_mapel->ranah=='KA')
	{
			//afektif
			$this->fpdf->AddPage();
			$this->fpdf->SetY(1.0);
			$this->fpdf->SetFont('Times','',8);
			$this->fpdf->SetXY(1.5,1.0);
			$this->fpdf->setFont('Arial','',10);
			$this->fpdf->Cell(18,0.5,'DAFTAR NILAI PESERTA DIDIK',0,2,'C',0);
			$this->fpdf->Cell(18,0.5,$this->config->item('sek_nama'),0,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
			$this->fpdf->Cell(3,0.5,'Mata Pelajaran',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->mapel,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Kelas',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kelas,0,2,'L',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(3,0.5,'Penilaian',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(5,0.5,': '.$afe,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Semester',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$semester,0,2,'L',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(3,0.5,'KKM',0,0,'L',0);
			$this->fpdf->SetX($x4);
			$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kkm,0,0,'L',0);
			$this->fpdf->SetX(15);
			$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
			//JUDUL KOLOM
			$this->fpdf->SetX($x);
			$this->fpdf->cell(18,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->setFont('Arial','',9);

			$this->fpdf->Cell(1.0,0.5,'No',1,0,'C',0);
			$this->fpdf->cell(5.5,0.5,'Nama ',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'1',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'2',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'3',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'4',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'5',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'6',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'7',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'8',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'9',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'10',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'11',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'12',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'13',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'NA',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'NR',1,2,'C',0);
			//CARI DAFTAR SISWA
			$kelas = $ddaftar_mapel->kelas;
			$tdaftar_siswa=$this->Nilai_model->Siswa_Kelas($thnajaran,$kelas,$semester);
			$nomor=1;

			foreach($tdaftar_siswa->result() as $ddaftar_siswa) 
			{

			$this->fpdf->SetX($x);
			$this->fpdf->cell(1.0,0.5,$nomor,1,0,'C',0);
			$this->fpdf->cell(5.5,0.5,''.nis_ke_nama($ddaftar_siswa->nis).'',1,0,'L',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
			$this->fpdf->cell(0.8,0.5,'',1,2,'C',0);
			$nomor++;

			}
			if($nomor<$batas)
			{
			$ekstra = 1;
			do
			{
				$this->fpdf->SetX($x);
				$this->fpdf->cell(1,0.5,''.$nomor.'',1,0,'C',0);
				$this->fpdf->cell(5.5,0.5,'',1,0,'L',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
				$nomor++;
				$ekstra++;
			}
			while ($ekstra < 4);
			}
				$this->fpdf->SetX($x);
				$this->fpdf->cell(6.5,0.5,'Rata - rata',1,0,'L',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
				$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
			$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
			$namakepala = cari_kepala_baru($thnajaran,$semester);
			$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
			$tguru = $this->Nilai_model->Kode_Guru_ke_Nama_Guru($ddaftar_mapel->kodeguru);
			$namaguru = '';
			$nipguru = '';
			foreach($tguru->result() as $dguru)
			{
				$namaguru = $dguru->nama;
				$nipguru = $dguru->nip;
			}

			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,'Mengetahui',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.3,$this->config->item('lokasi').' ,',0,2,'L',0);
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.4,$this->config->item('plt').'Kepala',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.4,'Guru Mata Pelajaran',0,2,'L',0);
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,''.$namakepala.'',0,0,'L',0);
			$this->fpdf->SetX(14);
			$this->fpdf->cell(2,0.3,''.$namaguru.'',0,2,'L',0);
			$this->fpdf->SetX(4.0);
			$this->fpdf->cell(1.0,0.3,'NIP '.$nipkepala.'',0,0,'L',0);
			$this->fpdf->SetX(14.0);
			$this->fpdf->cell(2.0,0.3,'NIP '.$nipguru.'',0,2,'L',0);
	$this->fpdf->SetX(1);
	$this->fpdf->SetY(-6);

			/* setting font untuk footer */
			$this->fpdf->SetFont('Times','',10);

			/* setting Cell untuk waktu pencetakan */ 
			$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb} Dicetak : '.date('d/m/Y H:i').' | '.$this->config->item('nama_web'),0,'LR','L');

	}
	//kehadiran
	$this->fpdf->AddPage();
	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->SetXY(1.5,1.0);
	$this->fpdf->setFont('Arial','',10);
	$this->fpdf->Cell(18,0.5,'DAFTAR PENILAIAN PESERTA DIDIK',0,2,'C',0);
	$this->fpdf->Cell(18,0.5,$this->config->item('sek_nama'),0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(3,0.5,'Mata Pelajaran',0,0,'L',0);
	$this->fpdf->SetX($x4);
	$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->mapel,0,0,'L',0);
	$this->fpdf->SetX(15);
	$this->fpdf->Cell(3,0.5,'Kelas',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kelas,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Penilaian',0,0,'L',0);
	$this->fpdf->SetX($x4);
	$this->fpdf->Cell(5,0.5,': Kehadiran',0,0,'L',0);
	$this->fpdf->SetX(15);
	$this->fpdf->Cell(3,0.5,'Semester',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$semester,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'KKM',0,0,'L',0);
	$this->fpdf->SetX($x4);
	$this->fpdf->Cell(3,0.5,': '.$ddaftar_mapel->kkm,0,0,'L',0);
	$this->fpdf->SetX(15);
	$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
	//JUDUL KOLOM
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,0.3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->setFont('Arial','',9);

	$this->fpdf->Cell(1.0,0.5,'No',1,0,'C',0);
	$this->fpdf->cell(5.5,0.5,'Nama ',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,2,'C',0);
	//CARI DAFTAR SISWA
	$kelas = $ddaftar_mapel->kelas;
	$tdaftar_siswa=$this->Nilai_model->Siswa_Kelas($thnajaran,$kelas,$semester);
	$nomor=1;

	foreach($tdaftar_siswa->result() as $ddaftar_siswa) 
	{

	$this->fpdf->SetX($x);
	$this->fpdf->cell(1.0,0.5,$nomor,1,0,'C',0);
	$this->fpdf->cell(5.5,0.5,''.nis_ke_nama($ddaftar_siswa->nis).'',1,0,'L',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
	$this->fpdf->cell(0.8,0.5,'',1,2,'C',0);
	$nomor++;

	}
	if($nomor<$batas)
	{
	$ekstra = 1;
	do
	{
		$this->fpdf->SetX($x);
		$this->fpdf->cell(1,0.5,''.$nomor.'',1,0,'C',0);
		$this->fpdf->cell(5.5,0.5,'',1,0,'L',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,0,'C',0);
		$this->fpdf->cell(0.8,0.5,'',1,2,'L',0);
		$nomor++;
		$ekstra++;
	}
	while ($ekstra < 4);
	}
	$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
	$namakepala = cari_kepala_baru($thnajaran,$semester);
	$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
	$tguru = $this->Nilai_model->Kode_Guru_ke_Nama_Guru($ddaftar_mapel->kodeguru);
	$namaguru = '';
	$nipguru = '';
	foreach($tguru->result() as $dguru)
	{
	$namaguru = $dguru->nama;
	$nipguru = $dguru->nip;
	}

	$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(4.0);
	$this->fpdf->cell(1.0,0.3,'Mengetahui',0,0,'L',0);
	$this->fpdf->SetX(14.0);
	$this->fpdf->cell(2.0,0.3,$this->config->item('lokasi').' ,',0,2,'L',0);
	$this->fpdf->SetX(4.0);
	$this->fpdf->cell(1.0,0.4,$this->config->item('plt').'Kepala',0,0,'L',0);
	$this->fpdf->SetX(14.0);
	$this->fpdf->cell(2.0,0.4,'Guru Mata Pelajaran',0,2,'L',0);
	$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->cell(18.0,0.3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(4.0);
	$this->fpdf->cell(1.0,0.3,''.$namakepala.'',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->cell(2,0.3,''.$namaguru.'',0,2,'L',0);
	$this->fpdf->SetX(4.0);
	$this->fpdf->cell(1.0,0.3,'NIP '.$nipkepala.'',0,0,'L',0);
	$this->fpdf->SetX(14.0);
	$this->fpdf->cell(2.0,0.3,'NIP '.$nipguru.'',0,2,'L',0);
	$this->fpdf->SetX(1);
	$this->fpdf->SetY(-6);
	/* setting font untuk footer */
	$this->fpdf->SetFont('Times','',10);
	/* setting Cell untuk waktu pencetakan */ 
	$this->fpdf->Cell(9.5, 0.5, 'Halaman '.$this->fpdf->PageNo().'/{nb} Dicetak : '.date('d/m/Y H:i').' | '.$this->config->item('nama_web').'. Rp. {nb}.000',0,'LR','L');

}
$namafile='blanko_nilai_'.$kodeguru.'_'.$thnajaranx.'_semester_'.$semester.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
