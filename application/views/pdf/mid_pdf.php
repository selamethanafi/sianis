<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mid_pdf.php
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
date_default_timezone_set('Asia/Jakarta');

$folderfotosiswa = $this->config->item('folderfotosiswa');
$this->fpdf->FPDF("P","mm","Legal");
//mid
$filenya = "mid_pdf.php";
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1.5,1,1);
$this->fpdf->AliasNbPages();
$this->fpdf->SetTitle("Laporan Hasil Tengah Semester");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->AddFont('free3of9');
$x = 15;
$y = 70;
$x2 = 40;
$x3 = 50;
$x4 = 80;
$ada = 0;
$namafile='';
$thnajaranx = berkas($thnajaran);
$namafile='kelas_'.$kelas.'_'.$thnajaranx.'_semester_'.$semester.'';
$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
foreach($tkepala->result() as $dkepala)
{
	$posisi_x = $dkepala->px_uts;
	$posisi_y = $dkepala->py_uts;
	$lebar = $dkepala->l_uts;
	$tinggi = $dkepala->t_uts;
}
// wali kelas
$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$kodeguru = '??';
$namawalikelas = '';
$nipwalikelas = '';
foreach($twalikelas->result() as $dwalikelas)
{
	$kodeguru = $dwalikelas->kodeguru;
}
$namawalikelas = cari_nama_pegawai($kodeguru);
$nipwalikelas = cari_nip_pegawai($kodeguru);
$tahun = date("Y");
$bulan = date("m");
$tanggal = date("d");
$tanggalcetak = "$tahun-$bulan-$tanggal";
$tanggalcetak = date_to_long_string($tanggalcetak);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$terus = 1;
$peminatan = kelas_jadi_program($kelas);
// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
$tsiskel = $this->db->query("SELECT * from `siswa_kelas` where `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `status`='Y' limit $urutan,5" );
$ada = $tsiskel->num_rows();
if ($ada>0)
{

	foreach($tsiskel->result() as $dsiskel)
	{
	// kalau ada
	$cacah = 0;
		$this->fpdf->AddPage();
		$nis = $dsiskel->nis;
		$kelas = $dsiskel->kelas;
		$program = kelas_jadi_program($kelas);
		$tdatsis = $this->db->query("select * from datsis where `nis` = '$nis'");
		foreach($tdatsis->result() as $ddatsis)
		{
			$namasiswa = ucwords(strtolower($ddatsis->nama));
			$foto = $ddatsis->foto;
			$kode = $ddatsis->nis;
			$jenkel = $ddatsis->jenkel;
		}
		//$foto = '';
		if (empty($foto))
		{	
			if ($jenkel == 'Laki-laki')
			{
				$foto = 'putra.jpg';
			}
			else if ($jenkel == 'Perempuan')
			{
				$foto = 'putri.jpg';
			}
			else 
			{
				$foto = 'mbuh.jpg';
			}
		}
		$this->fpdf->SetXY($x,10);
		$this->fpdf->SetFont('Arial','',8);
		$xxx = $x;
		$yyy = $this->fpdf->GetY();
		$this->fpdf->Image($this->config->item('folderfotosiswa').'/'.$foto.'',$xxx,$yyy,22.5,30);
		$this->fpdf->SetXY(15,10);
		$this->fpdf->setFont('Arial','',10);
		$this->fpdf->cell(180,5,'LAPORAN HASIL ULANGAN TENGAH SEMESTER',0,2,'C',0);
		//$this->fpdf->cell(180,5,$foto,0,2,'C',0);
		$this->fpdf->cell(180,5,'MADRASAH ALIYAH',0,2,'C',0);
		$this->fpdf->SetX($x3);
		$this->fpdf->cell(180,3,'',0,2,'C',0);
		$this->fpdf->cell(30,5,'Nama Madrasah',0,0,'L',0);
		$this->fpdf->SetX($x4);
		$this->fpdf->cell(30,5,': '.$sek_nama.'',0,0,'L',0);
		$this->fpdf->SetX(150);
		$this->fpdf->cell(30,5,'Kelas',0,0,'L',0);
		$this->fpdf->cell(30,5,': '.$kelas.'',0,2,'L',0);
		$this->fpdf->SetX($x3);
		$this->fpdf->cell(30,5,'Nama',0,0,'L',0);
		$this->fpdf->SetX($x4);
		$this->fpdf->cell(50,5,': '.$namasiswa.'',0,0,'L',0);
		$this->fpdf->SetX(150);
		$this->fpdf->cell(30,5,'Semester',0,0,'L',0);
		$this->fpdf->cell(30,5,': '.$semester.'',0,2,'L',0);
		$this->fpdf->SetX($x3);
		$this->fpdf->cell(30,5,'NIS',0,0,'L',0);
		$this->fpdf->SetX($x4);
		$this->fpdf->cell(30,5,': '.$nis.'',0,0,'L',0);
		$this->fpdf->SetX(150);
		$this->fpdf->cell(30,5,'Tahun pelajaran',0,0,'L',0);
		$this->fpdf->cell(30,5,': '.$thnajaran.'',0,2,'L',0);
		$k1 = 8;
		$k2 = 65;
		$k3 = 8;
		$k4 = 16;
		$k5 = 93;
		$this->fpdf->SetX($x);
		$this->fpdf->setFont('Arial','',8);
		$this->fpdf->cell(180,3,'',0,2,'C',0); // di leti
		$this->fpdf->cell($k1,8,'NO',1,0,'C',0);
		$this->fpdf->cell($k2,8,'MATA PELAJARAN',1,0,'C',0);
		$this->fpdf->cell($k3,8,'KKM',1,0,'C',0);
		/*
		$this->fpdf->cell(8,8,'NIL',1,0,'C',0);
		$this->fpdf->cell(8,8,'RATA',1,0,'C',0);
		*/
		$this->fpdf->cell($k4,8,'NILAI',1,0,'C',0);
		$this->fpdf->cell($k5,8,'Ketercapaian',1,2,'C',0);
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
				$this->fpdf->Cell($k1,4,$komponen,0,0,'C',0);
				$this->fpdf->MultiCell($k2+$k3+$k4+$k5,4,$mapele,0,'L',0);
				$yk5 = $this->fpdf->GetY();
				$sk5 = $yk5 - $yn;
				if($sk5<8)
					{
					$sk5  = 8;
					}
				$this->fpdf->SetXY($x,$yn);
				$this->fpdf->Cell($k1,$sk5,'',1,0,'C',0);
				$this->fpdf->Cell($k2+$k3+$k4+$k5,$sk5,'',1,2,'L',0);

			}
			else
			{
				$kkm = '?';
				$adamid = 'Y';
				$tb =  $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
				foreach($tb->result() as $b)
				{
					$kkm = $b->kkm;
					$adamid = $b->adamid;
				}
				//cari guru
				$kodeguru ='??';
				$tf = $this->db->query("select * from `m_mapel` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester'");
				$namaguru = '';
				foreach($tf->result() as $f)
				{
					$kodeguru = $f->kodeguru;
					$tg = $this->db->query("select * from `p_pegawai` where `kode`='$kodeguru'");
					foreach($tg->result() as $g)
					{
						if (empty($namaguru))
						{
							$namaguru = $g->nama;
						}
						else
						{
						$namaguru .= ', '.$g->nama;
						}
					}
				}
				$tc = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
				$nilai_mid = 0;
				$ketercapaian = '';
				$adanilai = $tc->num_rows();
				if($adanilai == 0)
				{
					if($pilihan == 1)
					{
					$nilai_mid = '-';
					$ketercapaian .= 'Siswa tidak mengikuti mapel ini. ';
					}

				}
				else
				{
					foreach($tc->result() as $c)
					{	
					$nilai_mid = $c->nilai_mid;
					$ketercapaian = $c->keterangan;
					}
					if ($nilai_mid<$kkm) 
					{
						$cacah ++;
					}
				}
				if($adamid == 'T')
					{
					$ketercapaian .= 'Tidak ada ulangan tengah semester. ';
					$nilai_mid = '-';
					}

				$this->fpdf->SetX($x);
				$this->fpdf->Cell($k1,4,$komponen,0,0,'C',0);
				if($pilihan == 1)
					{
					$this->fpdf->MultiCell($k2,4,$mapele.' ***)',0,'L',0);
					}
					else
					{
					$this->fpdf->MultiCell($k2,4,$mapele,0,'L',0);
					}

				$this->fpdf->SetX($x+$k1);
				$this->fpdf->MultiCell($k2,4,$namaguru.'',0,'L',0);
				$yk2 = $this->fpdf->GetY();	
				$this->fpdf->SetXY($x+$k1+$k2,$yn);
				$this->fpdf->Cell($k3,4,$kkm,0,0,'C',0);
				$this->fpdf->Cell($k4,4,$nilai_mid,0,0,'C',0);
				$yk4 = $this->fpdf->GetY();	
				$this->fpdf->MultiCell($k5,4,$ketercapaian,0,'L',0);
				$yk5 = $this->fpdf->GetY();
				$sk2 = $yk2 - $yn;
				$sk5 = $yk5 - $yn;
				$selisih = $sk2;
				if($sk5>$sk2)
				{
					$selisih = $sk5;
				}
				if($selisih < 8)
				{
					$this->fpdf->SetXY($x,$yn);
					$this->fpdf->Cell($k1,8,'1',1,0,'L',0);
					$this->fpdf->Cell($k2,8,'2',1,0,'L',0);
					$this->fpdf->Cell($k3,8,'3',1,0,'L',0);
					$this->fpdf->Cell($k4,8,'4',1,0,'L',0);
					$this->fpdf->Cell($k5,8,'5',1,2,'L',0);
				}
				else
				{
					$this->fpdf->SetXY($x,$yn);
					$this->fpdf->Cell($k1,$selisih,'',1,0,'C',0);
					$this->fpdf->Cell($k2,$selisih,'',1,0,'L',0);
					$this->fpdf->Cell($k3,$selisih,'',1,0,'C',0);
					$this->fpdf->Cell($k4,$selisih,'',1,0,'C',0);
					$this->fpdf->Cell($k5,$selisih,'',1,2,'L',0);
				}

			}
			$ymapelatas = $this->fpdf->GetY();	
			if($ymapelatas>300)
			{
			$this->fpdf->AddPage();
			$this->fpdf->SetXY($x,15);
			}

		}	
		// akhir mata pelajaran
		$this->fpdf->SetX($x);
		$this->fpdf->cell($k1+$k2+$k3+$k4+$k5,6,'Cacah mata pelajaran belum kompeten : '.$cacah.'',1,2,'L',0);//ketercapaian
		$this->fpdf->Cell($k1+$k2+$k3+$k4+$k5,4,'*) diisi dengan keterampilan / bahasa asing yang diikuti peserta didik',0,2,'L',0);
		$this->fpdf->Cell($k1+$k2+$k3+$k4+$k5,4,'**) diisi dengan jenis program muatan lokal yang diikuti peserta didik',0,2,'L',0);
		$this->fpdf->Cell($k1+$k2+$k3+$k4+$k5,4,'***) Mata pelajaran pilihan peserta didik',0,2,'L',0);

		$this->fpdf->SetX(25);
		$this->fpdf->cell(10,6,'',0,2,'L',0);
		$this->fpdf->cell(10,3,'Mengetahui',0,0,'L',0);
		$this->fpdf->SetX(140);
		$this->fpdf->cell(50,3,$lokasi.', '.$tanggalcetak.'',0,2,'L',0);
		$this->fpdf->SetX(25);
		$yy = $this->fpdf->GetY();
		$this->fpdf->cell(10,3,'Wali / orang tua',0,0,'L',0);
		$this->fpdf->SetX(140);
		$this->fpdf->cell(20,6,'Wali Kelas',0,2,'L',0);
		$this->fpdf->SetX(87);
		$yyy = $yy;
		$posisine_y = $yyy + $posisi_y;
		if($ditandatangani == 'Y')
		{
			$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisi_x,$posisine_y,$lebar,$tinggi);
		}
		$this->fpdf->SetXY(90,$yy);
		$this->fpdf->cell(8,6,$plt.'Kepala',0,0,'L',0);
		$this->fpdf->cell(180,12,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->SetX(25);
		$this->fpdf->cell(10,3,'_______________________',0,0,'L',0);
		$this->fpdf->SetX(90);
		$this->fpdf->cell(10,3,''.$namakepala.'',0,0,'L',0);
		$this->fpdf->SetX(140);
		$this->fpdf->cell(20,3,''.$namawalikelas.'',0,2,'L',0);
		$this->fpdf->SetX(90);
		$this->fpdf->cell(10,3,'NIP '.$nipkepala.'',0,0,'L',0);
		$this->fpdf->SetX(140);
		$this->fpdf->cell(20,3,'NIP '.$nipwalikelas.'',0,2,'L',0);
	}
}
else
{
	if (!isset($nis))
		{
		$nis='';
		}
	$this->fpdf->AddPage();
	$this->fpdf->SetXY(15,10);
	$this->fpdf->setFont('Arial','',14);
	$this->fpdf->cell(180,5,'NIS '.$nis.' atau kelas '.$kelas.' TIDAK ADA',0,2,'C',0);
}
$urutan1 = $urutan+1;
$urutan2 = $urutan+5;
$urutane = $urutan1.'-'.$urutan2;
$this->fpdf->Output('hasil_tengah_semester_'.$namafile.'_nomor_'.$urutane.'.pdf',"I");

?>
