<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rapor_siswa.php
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
$folderfotosiswa = $this->config->item('folderfotosiswa');

$this->fpdf->FPDF("P","cm","Legal");

// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1.5,2,1);

$x = $this->config->item('batas_kiri');
$y = 7.0;
$x2 = 4.0;
$x3 = 5.0;
$x4 = 8.0;
$ada = 0;

/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();

// AddPage merupakan fungsi untuk membuat halaman baru


$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ASC ");
$persiswa = 0;

if (!empty($nis))
	{
	$persiswa = 1;
	$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester' and `nis` ='$nis'");
	foreach($tdata_siswa->result() as $ds)
		{
		$kelas = $ds->kelas;
		}
	}
$adasiswa = $tdata_siswa->num_rows();
$thnajaranx = preg_replace("/\//","_", $thnajaran);
	//tanda tangan
	$ttglcetak = $this->Nilai_model->Tanggal_Rapor($thnajaran);
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
			$posisi_x = $dkepala->posisi_x / 10;
			$posisi_y = $dkepala->posisi_y / 10;
			$lebar = $dkepala->lebar / 10;
			$tinggi = $dkepala->tinggi / 10;

		}
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

	if (substr($tanggalcetak,5,2)=='12')
		{$bulan = 'Desember';}
	elseif (substr($tanggalcetak,5,2)=='06')
		{$bulan = 'Juni';}
	else
		{$bulan = substr($tanggalcetak,5,2);}

	$tanggalcetak = substr($tanggalcetak,8,2).' '.$bulan.' '.substr($tanggalcetak,0,4);

if ($adasiswa>0)
{
foreach($tdata_siswa->result() as $data)
{
	$nis = $data->nis;
	$namasiswa = nis_ke_nama($nis);
	$kelas = $data->kelas;
	$fotosiswa = cari_foto($nis);
	if (!empty($fotosiswa))
	{
	$nilai_rapor = $this->Nilai_model->Rapor($thnajaran,$semester,$nis);
	$this->fpdf->AddPage();
	$this->fpdf->SetY($this->config->item('batas_atas'));
	$yyy = $this->fpdf->GetY();	
	$this->fpdf->Image(''.$folderfotosiswa.'/'.$fotosiswa.'',$this->config->item('batas_kiri'),$this->config->item('batas_atas'),2.5,3);
	$this->fpdf->SetFont('Helvetica','',8);
	$this->fpdf->SetXY($x,$this->config->item('batas_atas'));
	$this->fpdf->setFont('Arial','',10);
	$this->fpdf->Cell(18,0.5,'LAPORAN HASIL BELAJAR PESERTA DIDIK ',0,2,'C',0);
	$this->fpdf->Cell(18,0.5,'MADRASAH ALIYAH',0,2,'C',0);
	$this->fpdf->SetX($x3);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(3,0.5,'Nama Madrasah',0,0,'L',0);
	$this->fpdf->SetX($x4);
	$this->fpdf->Cell(3,0.5,': '.$sek_nama,0,0,'L',0);
	$this->fpdf->SetX(15);
	$this->fpdf->Cell(3,0.5,'Kelas',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$data->kelas,0,2,'L',0);
	$this->fpdf->SetX($x3);
	$this->fpdf->Cell(3,0.5,'Nama',0,0,'L',0);
	$this->fpdf->SetX($x4);
	$this->fpdf->Cell(5,0.5,': '.$namasiswa,0,0,'L',0);
	$this->fpdf->SetX(15);
	$this->fpdf->Cell(3,0.5,'Semester',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$semester,0,2,'L',0);
	$this->fpdf->SetX($x3);
	$this->fpdf->Cell(3,0.5,'NIS',0,0,'L',0);
	$this->fpdf->SetX($x4);
	$this->fpdf->Cell(3,0.5,': '.$data->nis,0,0,'L',0);
	$this->fpdf->SetX(15);
	$this->fpdf->Cell(3,0.5,'Tahun pelajaran',0,0,'L',0);
	$this->fpdf->Cell(3,0.5,': '.$thnajaran,0,2,'L',0);
	$this->fpdf->SetX($x);
	/* setting header table */
	$this->fpdf->Cell(19,0.3,'',0,2,'C',0); // di leti
	$this->fpdf->SetFont('Helvetica','B',8);
	$this->fpdf->Cell(0.8  , 1, 'N0',1,0,'C',0);
	$this->fpdf->Cell(5 , 1, 'MATA PELAJARAN',1,0,'C',0);
	$this->fpdf->Cell(0.8 , 1, 'KKM',1,0,'C',0);
	$this->fpdf->Cell(0.8 , 1, 'Kog',1,0,'C',0);
	$this->fpdf->Cell(0.8 , 1, 'Psi',1,0,'C',0);
	$this->fpdf->Cell(0.8 , 1, 'Afe',1,0,'C',0);
	$this->fpdf->Cell(10 , 1, 'Keterangan',1,2,'C',0);
	$k1 = 0.8;
	$k2 = 5;
	$k3 = 0.8;
	$k4 = 0.8;
	$k5 = 0.8;
	$k6 = 0.8;
	$k7 = 10;
	$this->fpdf->SetFont('Helvetica','',8);
	/* generate hasil query disini */
	if($status == 'akhir')
	{
		$adayangbelumdikunci = 0;
		//cek terkunci atau tidak
		$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
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
		if ($adayangbelumdikunci>0)
		{
		    $this->fpdf->SetX($x);
		    $this->fpdf->SetFont('Helvetica','',8);
		    $this->fpdf->Cell(19, 0.5, 'Ada '.$adayangbelumdikunci.' nilai yang belum dikunci, hubungi walikelas',1,2,'C',0);
		}
	}
	/* nilai */
	$tmapel = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	foreach($tmapel->result() as $dm)
	{
		$mapel = $dm->nama_mapel_portal;
		$mapele = $dm->nama_mapel;
		$komponen = $dm->komponen;
		$pilihan = $dm->pilihan;
		$yn = $this->fpdf->GetY();
		$this->fpdf->SetXY($x,$yn);
		if(empty($mapel))
		{
			$this->fpdf->Cell($k1,0.4,$komponen,0,0,'C',0);
			$this->fpdf->MultiCell($k2+$k3+$k4+$k5+$k6+$k7,0.4,$mapele,0,'L',0);
			$yk7 = $this->fpdf->GetY();
			$sk7 = $yk7 - $yn;
			if($sk7<0.4)
				{
				$sk7  = 0.4;
				}
			$this->fpdf->SetXY($x,$yn);
			$this->fpdf->Cell($k1,$sk7,'',1,0,'C',0);
			$this->fpdf->Cell($k2+$k3+$k4+$k5+$k6+$k7,$sk7,'',1,2,'L',0);
		}
		else
		{
			$kkm = '?';
			$ranah = '?';
			$kog = '?';
			$psi = '?';
			$afe = '?';

			$tb =  $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
			foreach($tb->result() as $b)
			{
				$kkm = $b->kkm;
				$ranah = $b->ranah;
			}
			$tc = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
			$nilai_mid = 0;
			$ketercapaian = '';
			$adanilai = $tc->num_rows();
			if($adanilai == 0)
			{
				if($pilihan == 1)
				{
					$kog = '-';
					$psi = '-';
					$afe = '-';
					$ketercapaian .= 'Siswa tidak mengikuti mapel ini. ';
				}
			}
			else
			{
				$kog = '-';
				$psi = '-';
				$afe = '-';
				foreach($tc->result() as $c)
				{	
					if(($ranah == 'KPA') or ($ranah == 'KA'))
					{
						if($status == 'sementara')
						{
							$kog = $c->nilai_nr;
						}
						else
						{
							$kog = $c->kog;
						}

					}
					if(($ranah == 'PA') or ($ranah == 'KPA'))
					{
						if($status == 'sementara')
						{
							$psi = $c->psikomotor;
						}
						else
						{
							$psi = $c->psi;
						}

					}
					$afe = $c->afektif;
					$ketercapaian = $c->keterangan;
				}
			}
			$this->fpdf->SetX($x);
			$this->fpdf->Cell($k1,0.4,$komponen,0,0,'C',0);
			if($pilihan == 1)
			{
				$this->fpdf->MultiCell($k2,0.4,$mapele.' ***',0,'L',0);
			}
			else
			{
				$this->fpdf->MultiCell($k2,0.4,$mapele,0,'L',0);
			}
			$yk2 = $this->fpdf->GetY();	
			$this->fpdf->SetXY($x+$k1+$k2,$yn);
			$this->fpdf->Cell($k3,0.4,$kkm,0,0,'C',0);
			$this->fpdf->Cell($k4,0.4,$kog,0,0,'C',0);
			$this->fpdf->Cell($k5,0.4,$psi,0,0,'C',0);
			$this->fpdf->Cell($k6,0.4,$afe,0,0,'C',0);
			$this->fpdf->MultiCell($k7,0.4,$ketercapaian,0,'L',0);
			$yk7 = $this->fpdf->GetY();
			$sk2 = $yk2 - $yn;
			$sk7 = $yk7 - $yn;
			$selisih = $sk2;
			if($sk7>$sk2)
			{
				$selisih = $sk7;
			}
			if($selisih < 0.4)
			{
				$this->fpdf->SetXY($x,$yn);
				$this->fpdf->Cell($k1,0.4,'',1,0,'L',0);
				$this->fpdf->Cell($k2,0.4,'',1,0,'L',0);
				$this->fpdf->Cell($k3,0.4,'',1,0,'L',0);
				$this->fpdf->Cell($k4,0.4,'',1,0,'L',0);
				$this->fpdf->Cell($k5,0.4,'',1,0,'L',0);
				$this->fpdf->Cell($k6,0.4,'',1,0,'L',0);
				$this->fpdf->Cell($k7,0.4,'',1,2,'L',0);

			}
			else
			{
				$this->fpdf->SetXY($x,$yn);
				$this->fpdf->Cell($k1,$selisih,'',1,0,'C',0);
				$this->fpdf->Cell($k2,$selisih,'',1,0,'L',0);
				$this->fpdf->Cell($k3,$selisih,'',1,0,'C',0);
				$this->fpdf->Cell($k4,$selisih,'',1,0,'C',0);
				$this->fpdf->Cell($k5,$selisih,'',1,0,'C',0);
				$this->fpdf->Cell($k6,$selisih,'',1,0,'C',0);
				$this->fpdf->Cell($k7,$selisih,'',1,2,'L',0);
			}
		}
		$ymapelatas = $this->fpdf->GetY();	
		if($ymapelatas>27)
		{
			$this->fpdf->AddPage();
			$this->fpdf->SetXY($x,1.5);
		}
	}
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(16,0.4,'*) Keterampilan / bahasa asing yang diikuti peserta didik',0,2,'L',0);
	$this->fpdf->Cell(16,0.4,'**) Jenis program muatan lokal yang diikuti peserta didik',0,2,'L',0);
	$this->fpdf->Cell(16,0.4,'***) Mata pelajaran pilihan peserta didik, wajib mengikuti salah satu',0,2,'L',0);

	/* nilai */
    	$this->fpdf->SetFont('Helvetica','',8);
    	// ekstra
    	$y = $this->fpdf->GetY();
    	$this->fpdf->SetXY($x,$y);
    	$this->fpdf->Cell(18,0.3,'',0,2,'C',0); // di leti
   	$this->fpdf->Cell(7.8,0.8,'Pengembangan Diri',1,2,'C',0);
    	$this->fpdf->SetX($x);
	$this->fpdf->Cell(0.8,0.8,'NO',1,0,'C',0);
	$this->fpdf->Cell(5,0.8,'Ekstrakurikuler',1,0,'C',0);
	$this->fpdf->Cell(2,0.8,'Keterangan',1,2,'C',0);
	$this->fpdf->SetX($x);
	$nilai_ekstra = $this->Nilai_model->Ekstra($thnajaran,$semester,$nis);
	$adaekstra = $nilai_ekstra->num_rows();
	if ($adaekstra>0)
	{
	$no = 1;
	foreach($nilai_ekstra->result() as $dne)
		{
		$this->fpdf->Cell(0.8,0.6,$no,1,0,'C',0);
		$this->fpdf->Cell(5,0.6,$dne->nama_ekstra,1,0,'L',0);
		$this->fpdf->Cell(2,0.6,$dne->nilai,1,2,'C',0);
		$this->fpdf->SetX($x);
		$no++;
		}
	}
	else
	{
	    $this->fpdf->SetX($x);
	    $this->fpdf->SetFont('Helvetica','',8);
	    $this->fpdf->Cell(7.8,0.6,'Nilai tidak ada atau tidak mengikuti',1,2,'C',0);
	}
	
	// ketidak hadiran
	$nilai_pribadi = $this->Nilai_model->Kepribadian($thnajaran,$semester,$nis);
	$adapribadi = $nilai_pribadi->num_rows();
	$ykehadiran = $this->fpdf->GetY();
	if ($adapribadi>0)
	{
	foreach($nilai_pribadi->result() as $d)
		{
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(18,0.4,'',0,2,'C',0); // di leti
		$this->fpdf->Cell(0.8,0.8,'NO',1,0,'C',0);
		$this->fpdf->Cell(5,0.8,'Ketidakhadiran',1,0,'C',0);
		$this->fpdf->Cell(2,0.8,'Keterangan',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(0.8,0.6,'1',1,0,'C',0);
		$this->fpdf->Cell(5,0.6,'Sakit',1,0,'L',0);
		$this->fpdf->Cell(2,0.6,$d->sakit.' hari',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(0.8,0.6,'2',1,0,'C',0);
		$this->fpdf->Cell(5,0.6,'Izin',1,0,'L',0);
		$this->fpdf->Cell(2,0.6,$d->izin.' hari',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(0.8,0.6,'3',1,0,'C',0);
		$this->fpdf->Cell(5,0.6,'Tanpa Keterangan',1,0,'L',0);
		$this->fpdf->Cell(2,0.6,$d->tanpa_keterangan.' hari',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(0.8,0.6,'4',1,0,'C',0);
		$this->fpdf->Cell(5,0.6,'Terlambat',1,0,'L',0);
		$this->fpdf->Cell(2,0.6,$d->terlambat.' kali',1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(0.8,0.6,'5',1,0,'C',0);
		$this->fpdf->Cell(5,0.6,'Membolos',1,0,'L',0);
		$this->fpdf->Cell(2,0.6,$d->membolos.' kali',1,2,'C',0);
		$ykehadiran = $this->fpdf->GetY();
		}
	} //kalau ada pribadi
	$ykehadiran = $this->fpdf->GetY();
	// akhlak mulia dan kehadiran
	foreach($nilai_pribadi->result() as $d)
	{

	$x2 = $x+8.5;
	$this->fpdf->SetXY($x2,$y);
	$this->fpdf->Cell(9,0.3,'',0,2,'C',0); // di leti
	$this->fpdf->Cell(10.5,0.8,'Akhlak Mulia dan Kepribadian',1,2,'C',0);
	$this->fpdf->Cell(0.8,0.8,'NO',1,0,'C',0);
	$this->fpdf->Cell(3,0.8,'Aspek',1,0,'C',0);
	$this->fpdf->Cell(6.7,0.8,'Keterangan',1,2,'C',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'1',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Kedisiplinan',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->satu,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'2',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Kebersihan',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->dua,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'3',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Kesehatan',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->tiga,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'4',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Tanggung jawab',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->empat,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'5',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Sopan santun',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->lima,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'6',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Percaya diri',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->enam,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'7',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Kompetitif',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->tujuh,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'8',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Hubungan Sosial',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->delapan,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'9',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Kejujuran',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->sembilan,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(0.8,0.6,'10',1,0,'C',0);
	$this->fpdf->Cell(3,0.6,'Ibadah ritual',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->sepuluh,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell(3.8,0.6,'Kredit Pelanggaran',1,0,'L',0);
	$this->fpdf->Cell(6.7,0.6,$d->angka_kredit,1,2,'L',0);
	$yakhlak = $this->fpdf->GetY();
	}
	if ($adapribadi==0)
		{
	    $y3 = $this->fpdf->GetY();
	    $this->fpdf->SetX($x);
	    $this->fpdf->Cell(18,0.4,'',0,2,'C',0); // di leti
	    $this->fpdf->Cell(0.8,0.8,'NO',1,0,'C',0);
	    $this->fpdf->Cell(5,0.8,'Ketidakhadiran',1,0,'C',0);
	    $this->fpdf->Cell(2,0.8,'Keterangan',1,2,'C',0);
	    $this->fpdf->SetX($x);
	    $this->fpdf->Cell(7.8,0.6,'Belum ada data',1,2,'C',0);
	    $ykehadiran = $this->fpdf->GetY();
		

	    // akhlak mulia dan kehadiran
	    $x2 = $x+8.5;
 	    $this->fpdf->SetXY($x2,$y);
	    $this->fpdf->Cell(9,0.3,'',0,2,'C',0); // di leti
	    $this->fpdf->Cell(10.5,0.8,'Akhlak Mulia dan Kepribadian',1,2,'C',0);
	    $this->fpdf->Cell(10.5,0.8,'Belum ada data',1,2,'C',0);
	    $yakhlak = $this->fpdf->GetY();
		}
	if ($ykehadiran > $yakhlak)
		{
		$ytanggalcetak = $ykehadiran;
		}
		else
		{
		$ytanggalcetak = $yakhlak;
		}

	$this->fpdf->SetXY($x,$ytanggalcetak);
	$this->fpdf->Cell(18,0.3,' ',0,2,'C',0); // spasi kosong
	if ($semester == '2') 
		{
		$this->fpdf->Cell(1,0.3,'Berdasarkan kriteria kenaikan kelas, siswa dinyatakan naik / tidak naik ',0,2,'L',0);
		$this->fpdf->Cell(18,0.5,' ',0,2,'C',0); // spasi kosong
		}
	$this->fpdf->SetX(2.5);
	$this->fpdf->Cell(1,0.3,'Mengetahui',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(5,0.3,$lokasi.', '.$tanggalcetak,0,2,'L',0);
	$this->fpdf->SetX(2.5);
	$yy = $this->fpdf->GetY();
	$this->fpdf->Cell(1,0.3,'Wali / orang tua',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.3,'Wali Kelas',0,2,'L',0);
	$this->fpdf->SetX(9);
	$yyy = $yy;
	$posisix = $posisi_x + 1.5;
	$posisine_y = $yyy + $posisi_y;
	$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisix,$posisine_y,$lebar,$tinggi);
	$this->fpdf->SetXY(9,$yy);
	$this->fpdf->Cell(0.8,0.3,$plt.'Kepala',0,0,'L',0);
	$this->fpdf->Cell(18,1.2,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->Cell(1.0,0.3,'_______________________',0,0,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.3,$namakepala,0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.3,$namawalikelas,0,2,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.3,'NIP '.$nipkepala.'',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.3,'NIP '.$nipwalikelas.'',0,2,'L',0);


	
	/* setting posisi footer 5 cm dari bawah */
	$this->fpdf->SetY(-6);
	/* setting font untuk footer */
	$this->fpdf->SetFont('Helvetica','',10);

	/* setting Cell untuk waktu pencetakan */ 
//	$this->fpdf->Cell(9.5, 0.5, 'Dicetak melalui : '.$this->config->item('nama_web'),0,'LR','L');
	}
} //kalau ada foto

} //akhir ada siswa


else
{
	$this->fpdf->AddPage();
	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Helvetica','',8);
	$this->fpdf->SetXY(1.5,1.0);
	$this->fpdf->Cell(18,0.5,'DATA SISWA TIDAK ADA',0,2,'C',0);
}
/* setting Cell untuk page number */
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$namafile='rapor_kelas_'.$kelas.'_'.$thnajaranx.'_semester_'.$semester.'.pdf';
if ($persiswa == 1)
	{
	$namafile='rapor_'.$thnajaranx.'_semester_'.$semester.'_'.$namasiswa.'.pdf';
	}

$namafile = preg_replace("/ /","_", $namafile);
$this->fpdf->Output($namafile,"I");
?>
