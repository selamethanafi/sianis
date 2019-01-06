<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : buku_rapor_siswa.php
// Lokasi      : application/views/pdf
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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

/* setting zona waktu */ 
$folderfotosiswa = $this->config->item('folderfotosiswa');
$this->fpdf->FPDF("P","cm","A4");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1.5,1,1);
$x=1.5;
$y = 1;
$ada = 0;
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
$this->fpdf->SetTitle("buku rapor ktsp");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$namasiswa ='unknown';
$t1 = 0.6;
$t2 = 0.5;
$t3 = 0.4;
$tbr =0.4;
$kelas ='';
$lebar = 18;
$tinggi = 25.5;
$ditandatangani = 1;
// AddPage merupakan fungsi untuk membuat halaman baru
$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester' and `nis` ='$nis'");
foreach($tdata_siswa->result() as $ds)
	{
	$kelas = $ds->kelas;
	}
$no_urut = 1;
$adasiswa = $tdata_siswa->num_rows();
$thnajaranx = preg_replace("/\//","_", $thnajaran);
//tanda tangan
$ttglcetak = $this->Nilai_model->Tanggal_Rapor($thnajaran);
$tanggalcetak='';
foreach($ttglcetak->result() as $dtglcetak)
{
	if ($semester=='1')
	{$tanggalcetak=$dtglcetak->akhir1;}
	else
	{$tanggalcetak=$dtglcetak->akhir2;}
}
$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
foreach($tkepala->result() as $dkepala)
{
	$posisi_x = $dkepala->px_rapor / 10;
	$posisi_y = $dkepala->py_rapor / 10;
	$lebar = $dkepala->l_rapor / 10;
	$tinggi = $dkepala->t_rapor / 10;
}
$posisi_x = $posisi_x + 7;
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);

$twalikelas = $this->Nilai_model->Walikelas($thnajaran,$semester,$kelas);
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
$jurusan = kelas_jadi_program($kelas);
//cek terkunci atau tidak
$adayangbelumdikunci = 0;
	$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y'");
	foreach($ta->result() as $a)
	{
		if($a->mapel != 'Bimbingan Teknologi Informasi dan Komunikasi')
		{
			if(empty($a->kunci))
			{
			$adayangbelumdikunci++;
			}
		}
			
	}
if ($adasiswa>0)
{
	$namasiswa = nis_ke_nama($nis);
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	$nisn = nisn($nis);
	$nilai_rapor = $this->Nilai_model->Rapor($thnajaran,$semester,$nis);
	$this->fpdf->AddPage();
	$this->fpdf->SetY($y);
	$yyy = $this->fpdf->GetY();	
	$this->fpdf->setFont('Arial','',10);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(3,0.5,'Nama Peserta Didik',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(5,0.5,': '.$namasiswa,0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Kelas / Semester',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$kelas.' / '.$semester,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nomor Induk / NISN',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$nis.' / '.$nisn,0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nama Madrasah',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$this->config->item('sek_nama'),0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Program',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$jurusan,0,2,'L',0);
	$this->fpdf->SetX($x);
	/* setting header table */
	$kolom1 = 1;
	$kolom2 = 5.5;
	$kolom3 = 1;
	$kolom4 = 1;
	$kolom5 = 3.5;
	$kolom6 = 1;
	$kolom7 = 3.5;
	$kolom8 = 1.5;
	$this->fpdf->SetFont('Arial','',10);
	if((empty($abaikan)) and ($adayangbelumdikunci>0))
		{
		$this->fpdf->Cell($kolom1+$kolom2+$kolom3+$kolom4+$kolom5+$kolom6+$kolom7+$kolom8,0.8,'Ada '.$adayangbelumdikunci.' Nilai belum dikunci oleh wali kelas',1,2,'C',0);
		}
	$this->fpdf->Cell(19,0.3,'',0,2,'C',0); // di leti
	$this->fpdf->SetFont('Arial','',10);
	$this->fpdf->Cell($kolom1,2.4,'NO',1,0,'C',0);
	$this->fpdf->Cell($kolom2,2.4,'KOMPONEN',1,0,'C',0);
	$this->fpdf->Cell($kolom3,2.4,'KKM',1,0,'C',0);
	$this->fpdf->Cell($kolom4+$kolom5+$kolom6+$kolom7+$kolom8,0.8,'Nilai Hasil Belajar',1,2,'C',0);
	$this->fpdf->SetX($x+$kolom1+$kolom2+$kolom3);	
	$this->fpdf->Cell($kolom4+$kolom5,0.8,'Pengetahuan',1,0,'C',0);
	$this->fpdf->Cell($kolom6+$kolom7,0.8,'Praktik',1,0,'C',0);
	$this->fpdf->Cell($kolom8,0.8,'Sikap',1,2,'C',0);
	$this->fpdf->SetX($x+$kolom1+$kolom2+$kolom3);	
	$this->fpdf->SetFont('Arial','',9);
	$this->fpdf->Cell($kolom4,0.8,'Angka',1,0,'C',0);
	$this->fpdf->Cell($kolom5,0.8, 'Huruf',1,0,'C',0);
	$this->fpdf->Cell($kolom6,0.8, 'Angka',1,0,'C',0);
	$this->fpdf->Cell($kolom7,0.8, 'Huruf',1,0,'C',0);
	$this->fpdf->Cell($kolom8,0.8, 'Predikat',1,2,'C',0);
	$ta = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	foreach($ta->result() as $a)
	{
		$ymapelatas = $this->fpdf->GetY();
		$mapel = $a->nama_mapel_portal;
		$nama_mapel = $a->nama_mapel;
		$pilihan = $a->pilihan;
		$komponen = $a->komponen;
		$ymapelatas = $this->fpdf->GetY();
		$mapel = $a->nama_mapel_portal;
		$nama_mapel = $a->nama_mapel;
		$komponen = $a->komponen;
		if(empty($mapel))
		{
			$this->fpdf->SetXY($x,$ymapelatas);		 
			$this->fpdf->Cell($kolom1,$t1,$komponen,1,0,'C',0);
			$this->fpdf->Cell($kolom2,$t1,$nama_mapel,1,0,'L',0);
			$this->fpdf->Cell($kolom3,$t1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom4,$t1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom5,$t1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom6,$t1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom7,$t1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom8,$t1,'',1,2,'C',0);
		}
		$tc =  $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and 	`mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
		foreach($tc->result() as $c)
		{
			$this->fpdf->SetXY($x,$ymapelatas);		 
			$this->fpdf->Cell($kolom1,$t1,$komponen,0,0,'C',0);
			if($pilihan == 1)
			{
			$this->fpdf->MultiCell($kolom2,$t1,$nama_mapel.' ***)',1,'L',0);
			}
			else
			{
			$this->fpdf->MultiCell($kolom2,$t1,$nama_mapel,1,'L',0);
			}
			$ymapelbawah = $this->fpdf->GetY();
			$selisihmapel = $ymapelbawah - $ymapelatas;
			$this->fpdf->SetXY($x,$ymapelatas);
			$this->fpdf->Cell($kolom1,$selisihmapel,'',1,0,'C',0);
			//kkm
			$kkm = "?";
			$ranah = '';
			$tb =  $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
			foreach($tb->result() as $b)
			{
				$kkm = $b->kkm;
				$ranah = $b->ranah;
			}
			$nilaikognitif = '?';
			$nilaipsikomotor = '?';
			$nilaiafektif = '?';
			$kunci = '';
			$this->fpdf->SetXY($x+$kolom1+$kolom2,$ymapelatas);		 
			$this->fpdf->Cell($kolom3,$selisihmapel,$kkm,1,2,'C',0);
			$kunci = $c->kunci;
			if ($ranah == 'KPA')
			{
				$nilaikognitif = $c->kog;
				$nilaipsikomotor = $c->psi;
			}
			elseif ($ranah == 'KA')
			{
				$nilaikognitif = $c->kog;
				$nilaipsikomotor = '-';
			}
			elseif ($ranah == 'PA')
			{
				$nilaikognitif = '-';
				$nilaipsikomotor = $c->psi;
			}
			else
			{
			$nilaikognitif = 'ranah ??';
			$nilaipsikomotor = 'ranah ??';
			}
			$nilaiafektif = $c->afektif;
			if((empty($abaikan)) and (empty($kunci)))
			{
				$this->fpdf->SetXY($x+$kolom1+$kolom2,$ymapelatas);		 
				$this->fpdf->Cell($kolom3+$kolom4+$kolom5+$kolom6+$kolom7+$kolom8,$selisihmapel,'Nilai belum dikunci oleh wali kelas',1,2,'C',0);
			}
			else
			{
				$this->fpdf->SetXY($x+$kolom1+$kolom2+$kolom3,$ymapelatas);
				$this->fpdf->Cell($kolom4,$selisihmapel,$nilaikognitif,1,0,'C',0);
				if($nilaikognitif=='-')
				{
					$this->fpdf->Cell($kolom5,$selisihmapel,'-',1,0,'C',0);
				}
				else
				{
					$this->fpdf->Cell($kolom5,$selisihmapel,number_to_long_string($nilaikognitif),1,0,'C',0);
				}
				$this->fpdf->Cell($kolom6,$selisihmapel,$nilaipsikomotor,1,0,'C',0);
				if($nilaipsikomotor=='-')
				{
					$this->fpdf->Cell($kolom7,$selisihmapel,'-',1,0,'C',0);
				}
				else
				{
					$this->fpdf->Cell($kolom7,$selisihmapel,number_to_long_string($nilaipsikomotor),1,0,'C',0);
				}
				$this->fpdf->Cell($kolom8,$selisihmapel,$nilaiafektif,1,2,'C',0);
			}
			$ymapelatas = $this->fpdf->GetY();	
			if($ymapelatas>22)
			{
			$this->fpdf->AddPage();
			$this->fpdf->SetXY($x,$y);
			$ymapelatas = $this->fpdf->GetY();
			}
		}
	}//endforeach $ta	
	$this->fpdf->SetX($x);	
	$this->fpdf->setFont('Arial','I',8);	 
	$this->fpdf->Cell(16,0.4,'*) diisi dengan keterampilan / bahasa asing yang diikuti peserta didik',0,2,'L',0);
	$this->fpdf->Cell(16,0.4,'**) diisi dengan jenis program muatan lokal yang diikuti peserta didik',0,2,'L',0);
	$this->fpdf->Cell(16,0.4,'***) Mata pelajaran pilihan peserta didik',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->setFont('Arial','',10);	 
	$this->fpdf->Cell(1,0.5,'Mengetahui',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(5,0.5,$this->config->item('lokasi').', '.$tanggalcetak,0,2,'L',0);
	$this->fpdf->SetX(2.5);
	$yy = $this->fpdf->GetY();
	$this->fpdf->Cell(1,0.5,'Orang tua / Wali',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'Wali Kelas',0,2,'L',0);
	if($ditandatangani == 1)
		{
		$this->fpdf->SetX(9);
		$posisine_y = $yy + $posisi_y;
		$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisi_x,$posisine_y,$lebar,$tinggi);
		}
	$this->fpdf->SetXY(9,$yy);
	$this->fpdf->Cell(0.8,0.5,$this->config->item('plt').'Kepala',0,0,'L',0);
	$this->fpdf->Cell(18,1.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->Cell(1.0,0.5,'_______________________',0,0,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,$namakepala,0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,$namawalikelas,0,2,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,'NIP '.$nipkepala.'',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'NIP '.$nipwalikelas.'',0,2,'L',0);
	//lembar kedua
	$this->fpdf->AddPage();
	$this->fpdf->SetY($y);
	$yyy = $this->fpdf->GetY();	
	$this->fpdf->setFont('Arial','',10);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(3,0.5,'Nama Peserta Didik',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(5,0.5,': '.$namasiswa,0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Kelas / Semester',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$kelas.' / '.$semester,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nomor Induk / NISN',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$nis.' / '.$nisn,0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nama Madrasah',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$this->config->item('sek_nama'),0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Program',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$jurusan,0,2,'L',0);

	$this->fpdf->SetX($x);
	/* setting header table */
	$kolom1 = 1;
	$kolom2 = 5.5;
	$kolom3 = 12;
	$this->fpdf->Cell(19,0.3,'',0,2,'C',0); // di leti
	$this->fpdf->SetFont('Arial','B',10);
	$this->fpdf->Cell($kolom1+$kolom2+$kolom3,0.8,'Ketercapaian Kompetensi Peserta Didik',0,2,'L',0);
	$this->fpdf->Cell($kolom1,0.8,'NO',1,0,'C',0);
	$this->fpdf->Cell($kolom2,0.8,'Komponen',1,0,'C',0);
	$this->fpdf->Cell($kolom3,0.8,'Ketercapaian Kompetensi',1,2,'C',0);
	$yhurufpengetahuanatas = $this->fpdf->GetY();
	$this->fpdf->SetFont('Arial','',9);
	$ta = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	foreach($ta->result() as $a)
	{
		$ymapelatas = $this->fpdf->GetY();
		if($ymapelatas>23)
		{
			$this->fpdf->AddPage();
			$this->fpdf->SetY($y);
			$yyy = $this->fpdf->GetY();	
			$this->fpdf->setFont('Arial','',10);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
			$this->fpdf->Cell(3,0.5,'Nama Peserta Didik',0,0,'L',0);
			$this->fpdf->SetX($x+4);
			$this->fpdf->Cell(5,0.5,': '.$namasiswa,0,0,'L',0);
			$this->fpdf->SetX(12);
			$this->fpdf->Cell(3,0.5,'Kelas / Semester',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$kelas.' / '.$semester,0,2,'L',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(3,0.5,'Nomor Induk / NISN',0,0,'L',0);
			$this->fpdf->SetX($x+4);
			$this->fpdf->Cell(3,0.5,': '.$nis.' / '.$nisn,0,0,'L',0);
			$this->fpdf->SetX(12);
			$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(3,0.5,'Nama Madrasah',0,0,'L',0);
			$this->fpdf->SetX($x+4);
			$this->fpdf->Cell(3,0.5,': '.$this->config->item('sek_nama'),0,0,'L',0);
			$this->fpdf->SetX(12);
			$this->fpdf->Cell(3,0.5,'Program',0,0,'L',0);
			$this->fpdf->Cell(3,0.5,': '.$jurusan,0,2,'L',0);
			$this->fpdf->Cell(19,0.3,'',0,2,'C',0); // di leti
			$this->fpdf->SetFont('Arial','B',10);
			$this->fpdf->SetX($x);		 
			$this->fpdf->Cell($kolom1+$kolom2+$kolom3,0.8,'Ketercapaian Kompetensi Peserta Didik',0,2,'L',0);
			$this->fpdf->Cell($kolom1,0.8,'NO',1,0,'C',0);
			$this->fpdf->Cell($kolom2,0.8,'Komponen',1,0,'C',0);
			$this->fpdf->Cell($kolom3,0.8,'Ketercapaian Kompetensi',1,2,'C',0);
			$ymapelatas = $this->fpdf->GetY();
		}
		$this->fpdf->setFont('Arial','',9);
		$mapel = $a->nama_mapel_portal;
		$this->fpdf->SetXY($x,$ymapelatas);		 
		$this->fpdf->Cell($kolom1,$t2,$a->komponen,0,2,'C',0);
		$this->fpdf->SetXY($x+$kolom1,$ymapelatas);
		$this->fpdf->MultiCell($kolom2,$t2,$a->nama_mapel,0,'L',0);
		$ymapelbawah = $this->fpdf->GetY();
		$selisih1 = $ymapelbawah - $ymapelatas;

		//kkm
		$kkm = "?";
		$ranah = '';
		$tb =  $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
		foreach($tb->result() as $b)
		{
			$kkm = $b->kkm;
		}
		$ketercapaian = '';
		$tc =  $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
		$adanilai = $tc->num_rows();
		if(($adanilai == 0) and (!empty($mapel)) and ($pilihan == 1))
			{
			$this->fpdf->SetXY($x,$ymapelatas);		 
			$this->fpdf->Cell($kolom1,$t2,'',1,0,'C',0);
			$this->fpdf->SetXY($x+$kolom1+$kolom2,$ymapelatas);		 
			$this->fpdf->Cell($kolom3,$t2,'Siswa tidak memilih mata pelajaran',1,2,'L',0);

			}
		else
		{
		foreach($tc->result() as $c)
		{
			$ketercapaian = $c->keterangan;
		}
		$this->fpdf->SetXY($x+$kolom1+$kolom2,$ymapelatas);		 
		$this->fpdf->MultiCell($kolom3,$t2,$ketercapaian,0,'L',0);
		$yketercapaianbawah = $this->fpdf->GetY();
		$selisih2 = $yketercapaianbawah - $ymapelatas;
		if($selisih2>$selisih1)
		{
			$this->fpdf->SetXY($x,$ymapelatas);		 
			$this->fpdf->Cell($kolom1,$selisih2,'',1,0,'C',0);
			$this->fpdf->Cell($kolom2,$selisih2,'',1,0,'C',0);
			$this->fpdf->Cell($kolom3,$selisih2,'',1,2,'C',0);
		}
		else
		{
			$this->fpdf->SetXY($x,$ymapelatas);		 
			$this->fpdf->Cell($kolom1,$selisih1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom2,$selisih1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom3,$selisih1,'',1,2,'C',0);

		}
		}
	} //akhir mapel pendidikan agama
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->setFont('Arial','',10);	 
	$this->fpdf->Cell(1,0.5,'Mengetahui',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(5,0.5,$this->config->item('lokasi').', '.$tanggalcetak,0,2,'L',0);
	$this->fpdf->SetX(2.5);
	$yy = $this->fpdf->GetY();
	$this->fpdf->Cell(1,0.5,'Orang tua / Wali',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'Wali Kelas',0,2,'L',0);
	if($ditandatangani == 1)
		{
		$this->fpdf->SetX(9);
		$posisine_y = $yy + $posisi_y;
		$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisi_x,$posisine_y,$lebar,$tinggi);
		}
	$this->fpdf->SetXY(9,$yy);
	$this->fpdf->Cell(0.8,0.5,$this->config->item('plt').'Kepala',0,0,'L',0);
	$this->fpdf->Cell(18,1.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->Cell(1.0,0.5,'_______________________',0,0,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,$namakepala,0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,$namawalikelas,0,2,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,'NIP '.$nipkepala.'',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'NIP '.$nipwalikelas.'',0,2,'L',0);
	//lembar ketiga
	$this->fpdf->AddPage();
	$this->fpdf->SetY($y);
	$yyy = $this->fpdf->GetY();	
	$this->fpdf->setFont('Arial','',10);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(3,0.5,'Nama Peserta Didik',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(5,0.5,': '.$namasiswa,0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Kelas / Semester',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$kelas.' / '.$semester,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nomor Induk / NISN',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$nis.' / '.$nisn,0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nama Madrasah',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$this->config->item('sek_nama'),0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Program',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$jurusan,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Arial','B',10);
	$this->fpdf->Cell(3,$t1,'',0,2,'L',0);
	$this->fpdf->Cell(3,$t1,'Pengembangan Diri',0,2,'L',0);
	$kolom1 = 1;
	$kolom2 = 7;
	$kolom3 = 10.5;
	$this->fpdf->SetX($x);		
	$this->fpdf->setFont('Arial','',9); 
	$this->fpdf->Cell($kolom1,$t2,'No',1,0,'C',0);
	$this->fpdf->Cell($kolom2,$t2,'Jenis Kegiatan',1,0,'C',0);
	$this->fpdf->Cell($kolom3,$t2,'Keterangan',1,2,'C',0);
	$this->fpdf->SetX($x);		
	$this->fpdf->Cell($kolom1,$t2,'A',1,0,'C',0);
	$this->fpdf->Cell($kolom2,$t2,'Kegiatan Ekstrakurikuler',1,0,'C',0);
	$this->fpdf->Cell($kolom3,$t2,'',1,2,'C',0);
	//cari kegiatan ekstra
	$nilai_ekstra = $this->Nilai_model->Ekstra($thnajaran,$semester,$nis);
	$adaekstra = $nilai_ekstra->num_rows();
	if ($adaekstra>0)
	{
	$no = 1;
	foreach($nilai_ekstra->result() as $dne)
		{
	$this->fpdf->setFont('Arial','',9); 
		$ymapelatas = $this->fpdf->GetY();
		$this->fpdf->SetXY($x,$ymapelatas);	
		$this->fpdf->Cell($kolom1,$t3,'',0,0,'C',0);
		$this->fpdf->MultiCell($kolom2,$t3,$no.'. '.$dne->nama_ekstra,0,'L',0);
		$ymapelbawah = $this->fpdf->GetY();
		$this->fpdf->SetXY($x+$kolom1+$kolom2,$ymapelatas);
		$predikat = '';
		if(empty($dne->nilai))
			{
			$predikat = '';
			}	
		elseif(($dne->nilai == 'A') or ($dne->nilai == 'a'))
			{
			$predikat = 'Predikat amat baik.';
			}
		elseif(($dne->nilai == 'B') or ($dne->nilai == 'b'))
			{
			$predikat = 'Predikat baik.';
			}
		elseif(($dne->nilai == 'C') or ($dne->nilai == 'c'))
			{
			$predikat = 'Predikat cukup.';
			}
		else
			{
			$predikat = 'Predikat baik';
			}


		$this->fpdf->MultiCell($kolom3,$t3,$predikat.' '.$dne->keterangan,0,'L',0);
		$ymapelbawah2 = $this->fpdf->GetY();
		$this->fpdf->SetXY($x,$ymapelatas);
		if($ymapelbawah2>$ymapelbawah)
			{
			//$this->fpdf->SetXY($x,$ymapelatas);
			$selisih = $ymapelbawah2 - $ymapelatas;
			}
			else
			{
			//$this->fpdf->SetXY($x,$ymapelatas);
			$selisih = $ymapelbawah - $ymapelatas;
			}
			$this->fpdf->Cell($kolom1,$selisih,'',1,0,'C',0);
			$this->fpdf->Cell($kolom2,$selisih,'',1,0,'C',0);
			$this->fpdf->Cell($kolom3,$selisih,'',1,2,'C',0);
		$no++;
		}
	}
	else
	{
	    $this->fpdf->SetX($x);
	    $this->fpdf->Cell($kolom1+$kolom2+$kolom3,$t3,'Nilai tidak ada atau peserta didik tidak mengikuti kegiatan ekstrakurikuler',1,2,'C',0);
	}
	$this->fpdf->SetX($x);		
	$this->fpdf->setFont('Arial','',9); 
	$this->fpdf->Cell($kolom1,0.8,'B',0,0,'C',0);
	$yatas = $this->fpdf->GetY();
	$this->fpdf->MultiCell($kolom2,$t2,'Keikutsertaan dalam organisasi / Kegiatan di madrasah',1,'L',0);
	$ybawah = $this->fpdf->GetY();
	$selisih = $ybawah - $yatas;
	$this->fpdf->SetXY($x,$yatas);		
	$this->fpdf->Cell($kolom1,$selisih,'',1,2,'C',0);
	$this->fpdf->SetXY($x+$kolom1+$kolom2,$yatas);		
	$this->fpdf->Cell($kolom3,$selisih,'',1,2,'C',0);
	//cari kegiatan ekstra
	$torg = $this->db->query("select * from `siswa_organisasi` where `thnajaran`='$thnajaran' and `nis`='$nis'"); 
	$adaorg = $torg->num_rows();
	if ($adaorg>0)
	{
	$no = 1;
	foreach($torg->result() as $dorg)
		{
	$this->fpdf->setFont('Arial','',9); 
		$ymapelatas = $this->fpdf->GetY();
		$this->fpdf->SetXY($x,$ymapelatas);	
		$this->fpdf->Cell($kolom1,$t3,'',0,0,'C',0);
		$this->fpdf->MultiCell($kolom2,$t3,$no.'. '.$dorg->organisasi,0,'L',0);
		$ymapelbawah = $this->fpdf->GetY();
		$this->fpdf->SetXY($x+$kolom1+$kolom2,$ymapelatas);
		$this->fpdf->MultiCell($kolom3,$t3,$dorg->keterangan,0,'L',0);
		$ymapelbawah2 = $this->fpdf->GetY();
		$this->fpdf->SetXY($x,$ymapelatas);
		if($ymapelbawah2>$ymapelbawah)
			{
			//$this->fpdf->SetXY($x,$ymapelatas);
			$selisih = $ymapelbawah2 - $ymapelatas;
			}
			else
			{
			//$this->fpdf->SetXY($x,$ymapelatas);
			$selisih = $ymapelbawah - $ymapelatas;
			}
			$this->fpdf->Cell($kolom1,$selisih,'',1,0,'C',0);
			$this->fpdf->Cell($kolom2,$selisih,'',1,0,'C',0);
			$this->fpdf->Cell($kolom3,$selisih,'',1,2,'C',0);
		$no++;
		}
	}
	else
	{
	    $this->fpdf->SetX($x);
	    $this->fpdf->Cell($kolom1+$kolom2+$kolom3,$t3,'Data organisasi tidak ada atau peserta didik tidak mengikuti organisasi',1,2,'C',0);
	}

	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Arial','I',8);	 
	$this->fpdf->Cell(16,0.4,'* Ekstrakurikuler yang wajib diikuti peserta didik',0,2,'L',0);
	$nilai_pribadi = $this->Nilai_model->Kepribadian($thnajaran,$semester,$nis);
	$adapribadi = $nilai_pribadi->num_rows();
	$kolom1 = 1;
	$kolom2 = 6;
	$kolom3 = 11.5;
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Arial','B',10); 
	$this->fpdf->Cell(9,0.3,'',0,2,'C',0); // di leti
	$this->fpdf->Cell($kolom1+$kolom2+$kolom3,$t1,'Akhlak Mulia dan Kepribadian',0,2,'L',0);
	$this->fpdf->setFont('Arial','',9); 
	$this->fpdf->Cell($kolom1,$t1,'NO',1,0,'C',0);
	$this->fpdf->Cell($kolom2,$t1,'Aspek',1,0,'C',0);
	$this->fpdf->Cell($kolom3,$t1,'Keterangan',1,2,'C',0);
	if ($adapribadi>0)
	{
		foreach($nilai_pribadi->result() as $d)
		{
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'1',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Kedisiplinan',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->satu,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'2',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Kebersihan',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->dua,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'3',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Kesehatan',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->tiga,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'4',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Tanggung jawab',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->empat,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'5',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Sopan santun',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->lima,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'6',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Percaya diri',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->enam,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'7',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Kompetitif',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->tujuh,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'8',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Hubungan Sosial',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->delapan,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'9',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Kejujuran',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->sembilan,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'10',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Ibadah ritual',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->sepuluh,1,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1+$kolom2,$t2,'Kredit Pelanggaran',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t2,$d->angka_kredit,1,2,'L',0);
		}

	}
		else
		{	
			$this->fpdf->SetX($x);
			$this->fpdf->Cell($kolom1+$kolom2+$kolom3,$t1,'Belum ada data Akhlak Mulia dan Kepribadian',1,2,'C',0);
		}
	$nilai_pribadi = $this->Nilai_model->Kepribadian($thnajaran,$semester,$nis);
	$adapribadi = $nilai_pribadi->num_rows();
	$kolom1 = 1;
	$kolom2 = 6;
	$kolom3 = 11.5;
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Arial','B',10); 
	$this->fpdf->Cell(9,0.3,'',0,2,'C',0); // di leti
	$this->fpdf->Cell($kolom1+$kolom2+$kolom3,0.8,'Ketidakhadiran',0,2,'L',0);
	$this->fpdf->setFont('Arial','',9); 
	$this->fpdf->Cell($kolom1,$t2,'NO',1,0,'C',0);
	$this->fpdf->Cell($kolom2,$t2,'Alasan ketidakhadiran',1,0,'C',0);
	$this->fpdf->Cell($kolom3,$t2,'Keterangan',1,2,'C',0);

	if ($adapribadi>0)
	{
		foreach($nilai_pribadi->result() as $d)
		{
		$this->fpdf->SetX($x);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'1',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Sakit',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->sakit.' hari',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'2',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Izin',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->izin.' hari',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'3',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Tanpa Keterangan',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->tanpa_keterangan.' hari',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'4',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Terlambat',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->terlambat.' kali',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($kolom1,$t3,'5',1,0,'C',0);
		$this->fpdf->Cell($kolom2,$t3,'Membolos',1,0,'L',0);
		$this->fpdf->Cell($kolom3,$t3,$d->membolos.' kali',1,2,'C',0);		}

	}
		else
		{
 	    		$this->fpdf->SetX($x);
			$this->fpdf->Cell($kolom1+$kolom2+$kolom3,$t1,'Belum ada data ketidakhadiran',1,2,'C',0);
		}
		$ymapelatas = $this->fpdf->GetY();
		if($ymapelatas>23)
			{
			$this->fpdf->AddPage();
			$ymapelatas = $y;
			}
			else
			{
			$ymapelatas = $this->fpdf->GetY();	
			}
			$this->fpdf->SetXY($x,$ymapelatas);	
	$this->fpdf->setFont('Arial','B',10); 
	$this->fpdf->Cell(9,0.3,'',0,2,'C',0); // di leti
	$yatas = $this->fpdf->GetY();
	$this->fpdf->Cell($kolom1+$kolom2+$kolom3,$t1,'Catatan Walikelas:',0,2,'L',0);
	$this->fpdf->SetXY($x,$yatas);
	$this->fpdf->Cell($kolom1+$kolom2+$kolom3,2,'',1,2,'L',0);

	if ($semester == 2)
		{
		$ymapelatas = $this->fpdf->GetY();
		if($ymapelatas>23)
			{
			$this->fpdf->AddPage();
			$ymapelatas = $y;
			}
			else
			{
			$ymapelatas = $this->fpdf->GetY();	
			}
			$this->fpdf->SetXY($x,$ymapelatas);	
			if ((substr($kelas,0,2) == 'X-') or (substr($kelas,0,3) == 'XI-'))
			{
				$kolom1 = 7;
				$kolom2 = 1;
				$kolom3 = 10.5;
				$this->fpdf->setFont('Arial','B',10); 
				$this->fpdf->Cell(9,0.3,'',0,2,'C',0); // di leti
				$yatas = $this->fpdf->GetY();
				$this->fpdf->Cell($kolom1,$t1,'Keterangan Kenaikan Kelas',0,0,'L',0);
				$this->fpdf->Cell($kolom2,$t1,':',0,0,'L',0);
				$this->fpdf->Cell($kolom3,$t1,'Naik / Tidak Naik *)',0,2,'L',0);
				$this->fpdf->SetX($x);
				$this->fpdf->Cell($kolom1,$t1,'Program',0,0,'L',0);
				$this->fpdf->Cell($kolom2,$t1,':',0,0,'L',0);
				$this->fpdf->Cell($kolom3,$t1,'IPA / IPS / BAHASA / Keagamaan  *)',0,2,'L',0);
				$this->fpdf->SetX($x);	
				$this->fpdf->setFont('Arial','I',8);	 
				$this->fpdf->Cell(16,0.4,'*) coret yang tidak perlu',0,2,'L',0);
				$this->fpdf->SetXY($x,$yatas);
				$this->fpdf->Cell($kolom1+$kolom2+$kolom3,1.2,'',1,2,'L',0);
			}
		}
		$ymapelatas = $this->fpdf->GetY();
		if($ymapelatas>23)
			{
			$this->fpdf->AddPage();
			$ymapelatas = $y;
			}
			else
			{
			$ymapelatas = $this->fpdf->GetY();	
			}
			$this->fpdf->SetXY($x,$ymapelatas);	

	$this->fpdf->Cell(18,0.3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->Cell(1,0.3,'',0,2,'L',0);
	$this->fpdf->Cell(18,0.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->setFont('Arial','',10);	 
	$this->fpdf->Cell(1,0.5,'Mengetahui',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(5,0.5,$this->config->item('lokasi').', '.$tanggalcetak,0,2,'L',0);
	$this->fpdf->SetX(2.5);
	$yy = $this->fpdf->GetY();
	$this->fpdf->Cell(1,0.5,'Orang tua / Wali',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'Wali Kelas',0,2,'L',0);
	if($ditandatangani == 1)
		{
		$this->fpdf->SetX(9);
		$posisine_y = $yy + $posisi_y;
		$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisi_x,$posisine_y,$lebar,$tinggi);
		}
	$this->fpdf->SetXY(9,$yy);
	$this->fpdf->Cell(0.8,0.5,$this->config->item('plt').'Kepala',0,0,'L',0);
	$this->fpdf->Cell(18,1.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->Cell(1.0,0.5,'_______________________',0,0,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,$namakepala,0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,$namawalikelas,0,2,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,'NIP '.$nipkepala.'',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'NIP '.$nipwalikelas.'',0,2,'L',0);
	//lembar keempat
	if($semester=='2')
	{
	$this->fpdf->AddPage();
	$this->fpdf->SetY($y);
	$yyy = $this->fpdf->GetY();	
	$this->fpdf->setFont('Arial','B',10);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(18,0.5,'Catatan Prestasi Yang Telah Dicapai',0,2,'C',0);
	$this->fpdf->setFont('Arial','',10);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.5,'(Dibuat untuk melengkapi penilaian pengembangan diri)',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(3,0.5,'Nama Peserta Didik',0,0,'L',0);

	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(5,0.5,': '.$namasiswa,0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Kelas',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$kelas,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nomor Induk / NISN',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$nis.' / '.$nisn,0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nama Madrasah',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$this->config->item('sek_nama'),0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(3,0.5,'Program',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$jurusan,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Arial','B',10);
	$this->fpdf->Cell(3,$t1,'',0,2,'L',0);
	$this->fpdf->Cell(3,$t1,'Pengembangan Diri',0,2,'L',0);
	$kolom1 = 1;
	$kolom2 = 8;
	$kolom3 = 9.5;
	$this->fpdf->SetX($x);		
	$this->fpdf->setFont('Arial','',10); 
	$this->fpdf->Cell($kolom1,$t1,'No',1,0,'C',0);
	$this->fpdf->Cell($kolom2,$t1,'Kegiatan Yang Diikuti',1,0,'C',0);
	$this->fpdf->Cell($kolom3,$t1,'Keterangan',1,2,'C',0);
	$this->fpdf->SetX($x);		
	//cari prestasi
	$tpres = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran'");
	$adapres = $tpres->num_rows();
	if ($adapres>0)
			{
	$no = 1;
	foreach($tpres->result() as $dpres)
		{
		$this->fpdf->SetX($x);		
		$ypresatas = $this->fpdf->GetY();
		$this->fpdf->SetXY($x,$ypresatas);		 
		$this->fpdf->Cell($kolom1,$t1,$no,0,0,'C',0);
		$this->fpdf->MultiCell($kolom2,$t1,$dpres->kegiatan,0,'L',0);
		$ypresbawah1 = $this->fpdf->GetY();
		$selisihpres1 = $ypresbawah1 - $ypresatas;
		$this->fpdf->SetXY($x+$kolom1+$kolom2,$ypresatas);		 
		$this->fpdf->MultiCell($kolom3,$t1,$dpres->keterangan,0,'L',0);
		$ypresbawah2 = $this->fpdf->GetY();
		$selisihpres2 = $ypresbawah2 - $ypresatas;
		$this->fpdf->SetXY($x,$ypresatas);		 
		if($selisihpres1>$selisihpres2)
			{
			$this->fpdf->Cell($kolom1,$selisihpres1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom2,$selisihpres1,'',1,0,'C',0);
			$this->fpdf->Cell($kolom3,$selisihpres1,'',1,0,'C',0);
			}
			else
			{
			$this->fpdf->Cell($kolom1,$selisihpres2,'',1,0,'C',0);
			$this->fpdf->Cell($kolom2,$selisihpres2,'',1,0,'C',0);
			$this->fpdf->Cell($kolom3,$selisihpres2,'',1,0,'C',0);
			}
		if($ypresbawah1>$ypresbawah2)
			{
			$this->fpdf->SetY($ypresbawah1);		
			}
			else
			{
			$this->fpdf->SetY($ypresbawah2);		
			}

		$no++;
		}
	}
	else
	{
	    $this->fpdf->SetX($x);
	    $this->fpdf->Cell($kolom1+$kolom2+$kolom3,$t1,'---------------------',1,2,'C',0);
	}

	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->Cell(1,0.3,'',0,2,'L',0);
	$this->fpdf->Cell(18,0.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->setFont('Arial','',10);	 
	$this->fpdf->Cell(1,0.5,'Mengetahui',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(5,0.5,$this->config->item('lokasi').', '.$tanggalcetak,0,2,'L',0);
	$this->fpdf->SetX(2.5);
	$yy = $this->fpdf->GetY();
	$this->fpdf->Cell(1,0.5,'Orang tua / Wali',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'Wali Kelas',0,2,'L',0);
	if($ditandatangani == 1)
		{
		$this->fpdf->SetX(9);
		$posisine_y = $yy + $posisi_y;
		$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisi_x,$posisine_y,$lebar,$tinggi);
		}
	$this->fpdf->SetXY(9,$yy);
	$this->fpdf->Cell(0.8,0.5,$this->config->item('plt').'Kepala',0,0,'L',0);
	$this->fpdf->Cell(18,1.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->Cell(1.0,0.5,'_______________________',0,0,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,$namakepala,0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,$namawalikelas,0,2,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,'NIP '.$nipkepala.'',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'NIP '.$nipwalikelas.'',0,2,'L',0);
	}//akhir cetak lembar keempat di semester 2



} // KALAU ADA SISWA
else
{
	$this->fpdf->AddPage();
	$this->fpdf->SetY($x);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->SetXY(1.5,1.0);
	$this->fpdf->Cell(18,0.5,'DATA SISWA TIDAK ADA id_thnajaran '.$id_thnajaran.' semester '.$semester.' nis '.$nis,0,2,'C',0);
}

/* setting Cell untuk page number */
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$namafile='rapor_'.$thnajaranx.'_semester_'.$semester.'_'.$namasiswa.'.pdf';
$namafile = preg_replace("/ /","_", $namafile);
$this->fpdf->Output($namafile,"I");
?>
