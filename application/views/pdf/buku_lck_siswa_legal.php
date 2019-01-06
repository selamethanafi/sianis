<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : blanko_kehadiran.php
// Lokasi      : application/views/pdf/
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

//by selamet hanafi

date_default_timezone_set('Asia/Jakarta');
$folderfotosiswa = $this->config->item('folderfotosiswa');

$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle("buku lck siswa sebelum permen 53 tahun 2015");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");

$page_height = 30; // mm (portrait letter)
$bottom_margin = 20; // mm

$lebar = $this->config->item('lebar_halaman');
$tinggi = $this->config->item('tinggi_halaman');
$x=$this->config->item('batas_kiri');
$y = $this->config->item('batas_atas');
$batas_bawah = $y;
$this->fpdf->SetMargins($x,$y,2);
$tbr =0.4;
$t1 = 0.6;
$kelas = '';
$tanggalcetak ='';
$batasbawah = 26;
$posisi_y = 0;
$posisi_x = 0;
$pilihan = '';
$ttd = 1;
$te = $this->db->query("select * from `m_logo` limit 0,1");
foreach($te->result() as $e)
	{
	$lebar_logo = $e->lebar;
	$tinggi_logo = $e->tinggi;
	$separuh_lebar_logo = $lebar_logo / 2;
	$separuh_lebar = $lebar / 2;
	$x_logo = $separuh_lebar - $separuh_lebar_logo + $x;
	$y_logo = $e->posisi_y;
	$pilihan = $e->pilihan;
	$ttd = $e->ttd;
	}
$thnajaranx = str_replace("/", "_", $thnajaran);
$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester' and `nis` ='$nis'");
foreach($tdata_siswa->result() as $ds)
	{
	$kelas = $ds->kelas;
	}

$ttglcetak = $this->db->query("select * from `m_tapel` where `thnajaran` = '$thnajaran'");
foreach($ttglcetak->result() as $dtglcetak)
	{
	if ($semester=='1')
		{$tanggalcetak=$dtglcetak->akhir1;}
		else
		{$tanggalcetak=$dtglcetak->akhir2;}
	}
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);

$tkepala = $this->db->query("select * from `m_kepala` where `thnajaran` = '$thnajaran' and `semester`='$semester'");
$posisi_x = 0;
$posisi_y = 0;
$lebar_ttd = 0;
$tinggi_ttd = 0;

foreach($tkepala->result() as $dkepala)
		{
			$posisi_x = $dkepala->posisi_x / 10;
			$posisi_y = $dkepala->posisi_y / 10;
			$lebar_ttd = $dkepala->lebar / 10;
			$tinggi_ttd = $dkepala->tinggi / 10;

		}
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
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
$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
$adasiswa = $tb->num_rows();
$peminatan = kelas_jadi_program($kelas);
if ($adasiswa>0)
{
	$nisn = nisn($nis);
	$fotosiswa = cari_foto($nis);
	$this->fpdf->AddPage();
	$namasiswa = nis_ke_nama($nis);
	$this->fpdf->SetXY($x,$batas_bawah);
	$this->fpdf->setFont('Arial','',9);
//	$this->fpdf->Cell(19,0.4,'LAPORAN CAPAIAN KOMPETENSI SISWA',0,2,'C',0);
	$this->fpdf->Cell(3,$tbr,'Nama Madrasah',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$this->config->item('sek_nama'),0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'Kelas',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,$kelas,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,$tbr,'Alamat',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$this->config->item('sek_alamat'),0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'Semester',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,$semester,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,$tbr,'Nama Peserta Didik',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$namasiswa,0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'Tahun Pelajaran',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,$thnajaran,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,$tbr,'Nomor Induk / NISN',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$nis.' / '.$nisn,0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,'',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,'',0,2,'L',0);
	$this->fpdf->Cell(2,0.3,'',0,2,'L',0);
	if($status_nilai == 'akhir')
	{
		if($adayangbelumdikunci>0)
		{
			$this->fpdf->SetFont('Arial','',10);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(18,0.8,'Nilai belum dikunci oleh wali kelas',1,2,'C',0);
		}
	}
	$k1 = 1;
	$k2 = 8;
	$k3 = 1;
	$k4 = 1;
	$k5 = 1.5;
	$k6 = 1;
	$k7 = 1;
	$k8 = 1.5;
	$k9 = $lebar - 	$k1 - $k2 - $k3 - $k4 - $k5 - $k6 - $k7 - $k8;
	$this->fpdf->setFont('Arial','',9);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1+$k2,1.6,'Mata Pelajaran',1,0,'C',0);
	$this->fpdf->Cell($k4+$k3+$k5,0.8,'Pengetahuan (KI-3)',1,0,'C',0);
	$this->fpdf->Cell($k8+$k6+$k7,0.8,'Keterampilan (KI-4)',1,0,'C',0);
	$y = $this->fpdf->GetY();
	$this->fpdf->Cell($k9,0.4,'Sikap spiritual dan',0,2,'C',0);
	$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8);	
	$this->fpdf->Cell($k9,0.4,'sosial dalam mapel',0,2,'C',0);
	$this->fpdf->SetX($x+$k1+$k2);
	$this->fpdf->Cell($k3+$k4,0.4,'Angka',1,0,'C',0);
	$this->fpdf->Cell($k5,0.4,'Predikat',1,0,'C',0);
	$this->fpdf->Cell($k6+$k7,0.4,'Angka',1,0,'C',0);
	$this->fpdf->Cell($k8,0.4,'Predikat',1,0,'C',0);
	$this->fpdf->Cell($k9,0.4,'(KI-1 dan KI-2)',0,2,'C',0);
	$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8,$y);
	$this->fpdf->Cell($k9,1.2,'',1,2,'C',0);
	$this->fpdf->setFont('Arial','',9);
	$this->fpdf->SetX($x+$k1+$k2);
	$this->fpdf->Cell($k3,0.4,'1-100',1,0,'C',0);
	$this->fpdf->Cell($k4,0.4,'1-4',1,0,'C',0);
	$this->fpdf->Cell($k5,0.4,'',1,0,'C',0);
	$this->fpdf->Cell($k6,0.4,'1-100',1,0,'C',0);
	$this->fpdf->Cell($k7,0.4,'1-4',1,0,'C',0);
	$this->fpdf->Cell($k8,0.4,'',1,0,'C',0);
	$this->fpdf->Cell($k9,0.4,'SB/B/C/K',1,2,'C',0);
	//kelompok A
	$this->fpdf->SetX($x);
	$yn = $this->fpdf->GetY();
	$tmapel = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	foreach($tmapel->result() as $dm)
	{
		$mapel = $dm->nama_mapel_portal;
		$mapele = $dm->nama_mapel;
		$komponen = $dm->komponen;
		$yn = $this->fpdf->GetY();
		$this->fpdf->SetXY($x,$yn);
		if($mapele == 'Peminatan')
			{
			$this->fpdf->Cell($k1,0.8,$komponen,1,0,'C',0);			
			$this->fpdf->SetX($x+$k1);
			$this->fpdf->Cell($k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9,0.8,$mapele.' '.$peminatan,1,2,'L',0);
			}
		elseif(empty($mapel))
			{
			$this->fpdf->Cell($k1,0.8,$komponen,1,0,'C',0);			
			$this->fpdf->SetX($x+$k1);
			$this->fpdf->Cell($k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9,0.8,$mapele,1,2,'L',0);
			}
		else
		{
			$kunci = '';
			$tc = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
			$this->fpdf->SetX($x);
			$yn = $this->fpdf->GetY();
			$this->fpdf->Cell($k1,0.8,$komponen,0,2,'C',0);			
			$this->fpdf->SetXY($x+$k1,$yn);
			$this->fpdf->Cell($k2,0.8,'',0,0,'L',0);
			$this->fpdf->SetX($x+$k1);
			$this->fpdf->Cell($k2,0.4,$mapele.'',0,2,'L',0);
			//cari guru
			$kodeguru ='??';
			$tf = $this->db->query("select * from `m_mapel` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester'");
			$namaguru = '';
			foreach($tf->result() as $f)
			{
				$kodeguru = $f->kodeguru;
				if (empty($namaguru))
				{
					$namaguru = cari_nama_pegawai($kodeguru);
				}
				else
				{
					$namaguru .= ', '.cari_nama_pegawai($kodeguru);
				}
			}
//			$namaguru .= $mapel;
			$this->fpdf->SetX($x+$k1);
			$this->fpdf->MultiCell(6,0.4,$namaguru.'',0,'L',0);
			$ymapelatas = $this->fpdf->GetY();	
			$selisih = $ymapelatas - $yn;
			$this->fpdf->SetXY($x,$yn);
			$this->fpdf->Cell($k1,$selisih,'',1,0,'C',0);
			$this->fpdf->Cell($k2,$selisih,'',1,0,'C',0);						
			$adanilai = $tc->num_rows();
			if($adanilai>0)
			{
				foreach($tc->result() as $c)
				{
					$mapel = $c->mapel;
					$kunci = $c->kunci;
					$this->fpdf->SetXY($x+$k1+$k2,$yn);
					if($status_nilai == 'akhir')
					{
						if(empty($kunci))
							{
							$this->fpdf->SetXY($x+$k1+$k2,$yn);
							$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9,$selisih,'Nilai belum dikunci oleh wali kelas',1,2,'C',0);
							}
							else
						{
						$this->fpdf->Cell($k3,$selisih,$c->kog,1,0,'C',0);
						$this->fpdf->Cell($k4,$selisih,konversi_nilai($c->kog),1,0,'C',0);
						if($this->config->item('predikat_nilai') == '2015')
						{
							$this->fpdf->Cell($k5,$selisih,predikat_nilai_2015($c->kog,$this->config->item('versi_predikat_nilai')),1,0,'C',0);
						}
						else
						{
							$this->fpdf->Cell($k5,$selisih,predikat_nilai($c->kog),1,0,'C',0);
						}
						$this->fpdf->Cell($k6,$selisih,$c->psi,1,0,'C',0);
						$this->fpdf->Cell($k7,$selisih,konversi_nilai($c->psi),1,0,'C',0);
						if($this->config->item('predikat_nilai') == '2015')
						{
							$this->fpdf->Cell($k8,$selisih,predikat_nilai_2015($c->psi,$this->config->item('versi_predikat_nilai')),1,0,'C',0);
						}
						else
						{
							$this->fpdf->Cell($k8,$selisih,predikat_nilai($c->psi),1,0,'C',0);
						}

						$this->fpdf->Cell($k9,$selisih,$c->afektif,1,2,'C',0);
						}
					}
					elseif($status_nilai == 'sementara')
					{
						$this->fpdf->Cell($k3,$selisih,$c->nilai_nr,1,0,'C',0);
						$this->fpdf->Cell($k4,$selisih,konversi_nilai($c->nilai_nr),1,0,'C',0);
						if($this->config->item('predikat_nilai') == '2015')
						{
							$this->fpdf->Cell($k5,$selisih,predikat_nilai_2015($c->nilai_nr,$this->config->item('versi_predikat_nilai')),1,0,'C',0);
						}
						else
						{
							$this->fpdf->Cell($k5,$selisih,predikat_nilai($c->nilai_nr,$this->config->item('versi_predikat_nilai')),1,0,'C',0);
						}

						$this->fpdf->Cell($k6,$selisih,$c->psikomotor,1,0,'C',0);
						$this->fpdf->Cell($k7,$selisih,konversi_nilai($c->psikomotor),1,0,'C',0);
						if($this->config->item('predikat_nilai') == '2015')
						{
							$this->fpdf->Cell($k8,$selisih,predikat_nilai_2015($c->psikomotor,$this->config->item('versi_predikat_nilai')),1,0,'C',0);
						}
						else
						{
							$this->fpdf->Cell($k8,$selisih,predikat_nilai($c->psikomotor),1,0,'C',0);
						}

						$this->fpdf->Cell($k9,$selisih,$c->afektif,1,2,'C',0);
					}
					else
					{
						$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9,$selisih,'Status nilai ?',1,2,'C',0);
					}

				} //kalau ada nilai
			}
			else
			{
				$this->fpdf->SetXY($x+$k1+$k2,$yn);
				$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9,$selisih,'Siswa tidak mengikuti mata pelajaran ini',1,2,'C',0);
			}
				$ymapelatas = $this->fpdf->GetY();	
				if($ymapelatas>22)
				{
					$this->fpdf->AddPage();
					$this->fpdf->SetXY($x,$batas_bawah);
					$this->fpdf->setFont('Arial','',9);
			//	$this->fpdf->Cell(17,0.4,'LAPORAN CAPAIAN KOMPETENSI SISWA',0,2,'C',0);
					$this->fpdf->Cell(3,$tbr,'Nama Madrasah',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$this->config->item('sek_nama'),0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'Kelas',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,$kelas,0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell(3,$tbr,'Alamat',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$this->config->item('sek_alamat'),0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'Semester',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,$semester,0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell(3,$tbr,'Nama Peserta Didik',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$namasiswa,0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'Tahun Pelajaran',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,$thnajaran,0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell(3,$tbr,'Nomor Induk / NISN',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$nis.' / '.$nisn,0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,'',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,'',0,2,'L',0);
					$this->fpdf->Cell(2,0.3,'',0,2,'L',0);
					$this->fpdf->setFont('Arial','',9);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell($k1+$k2,1.6,'Mata Pelajaran',1,0,'C',0);
					$this->fpdf->Cell($k4+$k3+$k5,0.8,'Pengetahuan (KI-3)',1,0,'C',0);
					$this->fpdf->Cell($k8+$k6+$k7,0.8,'Keterampilan (KI-4)',1,0,'C',0);
					$y = $this->fpdf->GetY();
					$this->fpdf->Cell($k9,0.4,'Sikap spiritual dan',0,2,'C',0);
					$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8);
					$this->fpdf->Cell($k9,0.4,'sosial dalam mapel',0,2,'C',0);
					$this->fpdf->SetX($x+$k1+$k2);
					$this->fpdf->Cell($k3+$k4,0.4,'Angka',1,0,'C',0);
					$this->fpdf->Cell($k5,0.4,'Predikat',1,0,'C',0);
					$this->fpdf->Cell($k6+$k7,0.4,'Angka',1,0,'C',0);
					$this->fpdf->Cell($k8,0.4,'Predikat',1,0,'C',0);
					$this->fpdf->Cell($k9,0.4,'(KI-1 dan KI-2)',0,2,'C',0);
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8,$y);
					$this->fpdf->Cell($k9,1.2,'',1,2,'C',0);
					$this->fpdf->setFont('Arial','',9);
					$this->fpdf->SetX($x+$k1+$k2);
					$this->fpdf->Cell($k3,0.4,'1-100',1,0,'C',0);
					$this->fpdf->Cell($k4,0.4,'1-4',1,0,'C',0);
					$this->fpdf->Cell($k5,0.4,'',1,0,'C',0);
					$this->fpdf->Cell($k6,0.4,'1-100',1,0,'C',0);
					$this->fpdf->Cell($k7,0.4,'1-4',1,0,'C',0);
					$this->fpdf->Cell($k8,0.4,'',1,0,'C',0);
					$this->fpdf->Cell($k9,0.4,'SB/B/C/K',1,2,'C',0);
					$ymapelatas = $this->fpdf->GetY();
				}
				$this->fpdf->SetXY($x,$ymapelatas);	
				//paksa ganti halaman

		}	
	}
	// akhir mata pelajaran
	//sikap antar mapel
	$td = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$sikap_antarmapel = '';
	foreach($td->result() as $d)
	{
		$sikap_antarmapel = $d->kom1;
	}
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($lebar,0.4,'Sikap Spiritual dan Sosial Antarmapel',1,2,'C',0);
	//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
	$this->fpdf->MultiCell($lebar,0.4,$sikap_antarmapel,1,'L',0);
	$this->fpdf->Cell($lebar,0.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX($x);	
	$this->fpdf->Cell(1,0.8,'NO',1,0,'C',0);
	$this->fpdf->Cell(4,0.8,'Ekstrakurikuler',1,0,'C',0);
	$this->fpdf->Cell($lebar-5,0.8,'Keikutsertaan dalam kegiatan',1,2,'C',0);
	$this->fpdf->SetX($x);
	$nilai_ekstra = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$adaekstra = $nilai_ekstra->num_rows();
	if ($adaekstra>0)
	{
		$no = 1;
		foreach($nilai_ekstra->result() as $dne)
		{
			$this->fpdf->Cell(1,0.6,$no,1,0,'C',0);
			$this->fpdf->Cell(4,0.6,$dne->nama_ekstra,1,0,'L',0);
			$this->fpdf->MultiCell($lebar-5,0.6,$dne->keterangan,1,'L',0);
			$this->fpdf->SetX($x);
			$no++;
		}
	}
	// ketidak hadiran
	$nilai_pribadi = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$adapribadi = $nilai_pribadi->num_rows();
	if ($adapribadi>0)
	{
		foreach($nilai_pribadi->result() as $d)
		{
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(17,0.4,'',0,2,'C',0); // di leti
			$this->fpdf->Cell(1,0.8,'NO',1,0,'C',0);
			$this->fpdf->Cell(4,0.8,'Ketidakhadiran',1,0,'C',0);
			$this->fpdf->Cell(2,0.8,'Keterangan',1,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(1,0.6,'1',1,0,'C',0);
			$this->fpdf->Cell(4,0.6,'Sakit',1,0,'L',0);
			$this->fpdf->Cell(2,0.6,$d->sakit.' hari',1,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(1,0.6,'2',1,0,'C',0);
			$this->fpdf->Cell(4,0.6,'Izin',1,0,'L',0);
			$this->fpdf->Cell(2,0.6,$d->izin.' hari',1,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(1,0.6,'3',1,0,'C',0);
			$this->fpdf->Cell(4,0.6,'Tanpa Keterangan',1,0,'L',0);
			$this->fpdf->Cell(2,0.6,$d->tanpa_keterangan.' hari',1,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(1,0.6,'4',1,0,'C',0);
			$this->fpdf->Cell(4,0.6,'Terlambat',1,0,'L',0);
			$this->fpdf->Cell(2,0.6,$d->terlambat.' kali',1,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(1,0.6,'5',1,0,'C',0);
			$this->fpdf->Cell(4,0.6,'Membolos',1,0,'L',0);
			$this->fpdf->Cell(2,0.6,$d->membolos.' kali',1,2,'C',0);
			$this->fpdf->SetX($x);
			$this->fpdf->Cell(1,0.6,'6',1,0,'C',0);
			$this->fpdf->Cell(4,0.6,'Kredit Pelanggaran',1,0,'L',0);
			$this->fpdf->Cell(2,0.6,$d->angka_kredit,1,2,'C',0);
		}
	} //kalau ada pribadi
	$this->fpdf->Cell(17,0.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(1,0.3,'Mengetahui',0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(5,0.3,$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$yy = $this->fpdf->GetY();
	$this->fpdf->Cell(1,0.3,'Orang tua / Wali',0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(2,0.3,'Wali Kelas',0,2,'L',0);
	$this->fpdf->Cell(17,1.2,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(1.0,0.3,'_______________________',0,0,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(2,0.3,$namawalikelas,0,2,'L',0);
	$this->fpdf->SetX(12);
	$this->fpdf->Cell(2,0.3,'NIP '.$nipwalikelas.'',0,2,'L',0);
	//deskripsi capaian kompetensi
	$this->fpdf->AddPage(); // page break.
	$this->fpdf->SetXY($x,$batas_bawah);
	$this->fpdf->setFont('Arial','',9);
//	$this->fpdf->Cell(17,0.4,'LAPORAN CAPAIAN KOMPETENSI SISWA',0,2,'C',0);
	$this->fpdf->Cell(3,$tbr,'Nama Madrasah',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$this->config->item('sek_nama'),0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'Kelas',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,$kelas,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,$tbr,'Alamat',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$this->config->item('sek_alamat'),0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'Semester',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,$semester,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,$tbr,'Nama Peserta Didik',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$namasiswa,0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'Tahun Pelajaran',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,$thnajaran,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,$tbr,'Nomor Induk / NISN',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$nis.' / '.$nisn,0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,'',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,'',0,2,'L',0);
	$this->fpdf->Cell(2,0.3,'',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Arial','',9);
	$this->fpdf->Cell($lebar,0.4,'DESKRIPSI KOMPETENSI',0,2,'L',0);
	$this->fpdf->SetX($x);
	$k1 = 1;
	$k2 = 5;
	$k3 = 3;
	$k4 = $lebar-9;
	$yn = $this->fpdf->GetY();
	$this->fpdf->Cell(6,0.8,'MATA PELAJARAN',1,0,'C',0);			
	$this->fpdf->Cell(3,0.8,'KOMPETENSI',1,0,'C',0);
	$this->fpdf->Cell($lebar-9,0.8,'CATATAN',1,2,'C',0);
	$tmapel = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	foreach($tmapel->result() as $dm)
	{
		$mapel = $dm->nama_mapel_portal;
		$mapele = $dm->nama_mapel;
		$komponen = $dm->komponen;
				$ymapelatas = $this->fpdf->GetY();	
				if($ymapelatas>$batasbawah)
					{
					$this->fpdf->AddPage();
					$this->fpdf->SetXY($x,$batas_bawah);
					$this->fpdf->setFont('Arial','',9);
				//	$this->fpdf->Cell(17,0.4,'LAPORAN CAPAIAN KOMPETENSI SISWA',0,2,'C',0);
					$this->fpdf->Cell(3,$tbr,'Nama Madrasah',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$this->config->item('sek_nama'),0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'Kelas',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,$kelas,0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell(3,$tbr,'Alamat',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$this->config->item('sek_alamat'),0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'Semester',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,$semester,0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell(3,$tbr,'Nama Peserta Didik',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$namasiswa,0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'Tahun Pelajaran',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,$thnajaran,0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell(3,$tbr,'Nomor Induk / NISN',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$nis.' / '.$nisn,0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,'',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,'',0,2,'L',0);
					$this->fpdf->Cell(2,0.3,'',0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->setFont('Arial','',9);
					$this->fpdf->Cell($lebar,0.4,'DESKRIPSI KOMPETENSI',0,2,'L',0);
					$this->fpdf->setFont('Arial','',9);
					$ymapelatas = $this->fpdf->GetY();
					}
		$this->fpdf->SetXY($x,$ymapelatas);
		$yn = $this->fpdf->GetY();
		$this->fpdf->SetXY($x,$yn);
		if($mapele == 'Peminatan')
			{
			$this->fpdf->Cell($k1,0.8,$komponen,1,0,'C',0);			
			$this->fpdf->SetX($x+$k1);
			$this->fpdf->Cell($k2+$k3+$k4,0.8,$mapele.' '.$peminatan,1,2,'L',0);
			}
		elseif(empty($mapel))
			{
			$this->fpdf->Cell($k1,0.8,$komponen,1,0,'C',0);			
			$this->fpdf->SetX($x+$k1);
			$this->fpdf->Cell($k3+$k2+$k4,0.8,$mapele,1,2,'L',0);
			}
		else
		{
			$this->fpdf->SetX($x);
			$yy = $this->fpdf->GetY();
			$this->fpdf->Cell($k1,0.4,$komponen,0,0,'C',0);			
			$this->fpdf->MultiCell($k2,0.4,$mapele,0,'L',0);
			$this->fpdf->SetXY($x+$k1+$k2,$yy);				
			$this->fpdf->Cell($k3,0.4,'Pengetahuan',0,0,'L',0);
			$desk = '';
			$ketpsi='';
			$td = $this->db->query("select * from `nilai` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis`='$nis'");
			foreach($td->result() as $d)
			{
				$desk = $d->keterangan;
				$ketpsi = $d->deskripsi;
			}
			$this->fpdf->MultiCell($k4,0.4,$desk,1,'L',0);
			$this->fpdf->SetX($x+$k1+$k2);
			$this->fpdf->Cell($k3,0.4,'Keterampilan',0,0,'L',0);
			$this->fpdf->MultiCell($k4,0.4,$ketpsi,1,'L',0);
			$this->fpdf->SetX($x+$k1+$k2);
			$this->fpdf->Cell($k3,0.4,'Sikap *)',0,0,'L',0);
			//sikap
			$tj = $this->db->query("select * from `afektif` where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
			$ketafektif='';
			foreach($tj->result() as $j)
			{
				$ketafektif = $j->deskripsi;
			}
			$this->fpdf->MultiCell($k4,0.4,$ketafektif,1,'L',0);
			$yx = $this->fpdf->GetY();
			$selisih = $yx - $yy;
			$baris = $selisih / 0.4;
			if ($selisih>0)
			{
				$this->fpdf->SetXY($x,$yy);
				$this->fpdf->Cell($k1,$selisih,'',1,0,'C',0);
				$this->fpdf->Cell($k2,$selisih,'',1,0,'C',0);
				$this->fpdf->Cell($k3,$selisih,'',1,2,'C',0);
//					$this->fpdf->Cell(9,$selisih,'',1,2,'L',0);
			}
		}
	} // akhir deskripsi 
	$this->fpdf->Cell(17,0.4,'*) spiritual dan sosial',0,2,'L',0);			

	$ywali = $this->fpdf->getY();
	$this->fpdf->Cell(17,0.5,' ',0,2,'C',0); // spasi kosong
	if($ywali > 24)
	{
		$this->fpdf->AddPage(); // page break.
		$ywali = $this->fpdf->getY();
		$this->fpdf->SetY($this->config->item('batas_atas'));
	}

		if ($semester == '1')
		{
		$this->fpdf->SetX($x+1);
		$this->fpdf->Cell(1,0.3,'Mengetahui',0,0,'L',0);
		$this->fpdf->SetX(12);
		$this->fpdf->Cell(5,0.3,$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak),0,2,'L',0);
		$this->fpdf->SetX($x+1);
		$yy = $this->fpdf->GetY();
		$this->fpdf->Cell(1,0.3,'Orang tua / Wali',0,0,'L',0);
		$this->fpdf->SetX(12);
		$this->fpdf->Cell(2,0.3,'Wali Kelas',0,2,'L',0);
		$this->fpdf->Cell(17,1.5,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->SetX($x+1);
		$this->fpdf->Cell(1.0,0.3,'_______________________',0,0,'L',0);
		$this->fpdf->SetX(12);
		$this->fpdf->Cell(2,0.3,$namawalikelas,0,2,'L',0);
		$this->fpdf->SetX(12);
		$this->fpdf->Cell(2,0.3,'NIP '.$nipwalikelas.'',0,2,'L',0);
		}
		else
		{
		//kolom kiri
		$y = $this->fpdf->GetY();
		$this->fpdf->SetX($x+1);
		$this->fpdf->Cell(2,0.5,'Wali Kelas',0,2,'L',0);
		$this->fpdf->Cell(2,1.5,'',0,2,'L',0);
		$this->fpdf->Cell(4,0.5,$namawalikelas,0,2,'L',0);
		$this->fpdf->Cell(4,0.3,'NIP '.$nipwalikelas.'',0,2,'L',0);
		$this->fpdf->Cell(2,1.5,'',0,2,'L',0);
		$this->fpdf->Cell(2,0.5,'Orang Tua / Wali',0,2,'L',0);
		$this->fpdf->Cell(2,1.5,'',0,2,'L',0);
		$this->fpdf->Cell(1.0,0.5,'_______________________',0,2,'L',0);
		$this->fpdf->SetXY(11,$y);
		if((substr($kelas,0,4) == 'XII-') and ($semester == '2'))
		{
			$this->fpdf->Cell(1,0.6,'Keputusan',0,2,'L',0);
			$this->fpdf->Cell(1,0.4,'',0,2,'L',0);
			$this->fpdf->Cell(8,0.6,'Berdasarkan kriteria kelulusan satuan pendidikan',0,2,'L',0);
			$this->fpdf->Cell(8,0.6,'peserta didik ditetapkan LULUS  /  TIDAK LULUS',0,2,'L',0);

		}
		else
		{
			$this->fpdf->Cell(1,0.6,'Keputusan',0,2,'L',0);
			$this->fpdf->Cell(1,0.4,'',0,2,'L',0);
			$this->fpdf->Cell(8,0.6,'Berdasarkan hasil yang dicapai pada',0,2,'L',0);
			$this->fpdf->Cell(8,0.6,'semester 1 dan 2, peserta didik ditetapkan',0,2,'L',0);
			$this->fpdf->Cell(8,0.6,'naik ke kelas ................. (........................)',0,2,'L',0);
			$this->fpdf->Cell(8,0.6,'tinggal di kelas ............... (........................)',0,2,'L',0);
		}
		$this->fpdf->Cell(17,0.6,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->SetX(11);
		$this->fpdf->Cell(5,0.5,$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak),0,2,'L',0);
		$yy = $this->fpdf->GetY();
		if($ttd == 1)
		{
			$posisix = $posisi_x+ 9;
			$posisine_y = $yy + $posisi_y + 0.5;
			$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisix,$posisine_y,$lebar_ttd,$tinggi_ttd);
		}
		$this->fpdf->SetXY(11,$yy);
		$this->fpdf->Cell(0.8,0.5,$this->config->item('plt').'Kepala',0,0,'L',0);
		$this->fpdf->Cell(6,1.5,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->SetX(11);
		$this->fpdf->Cell(1,0.5,$namakepala,0,2,'L',0);
		$this->fpdf->Cell(1,0.5,'NIP '.$nipkepala.'',0,2,'L',0);
		}
	$namafile='buku_lck_'.$thnajaranx.'_semester_'.$semester.'_'.$namasiswa.'.pdf';
	$namafile = str_replace(" ", "_", $namafile);

	$this->fpdf->Output($namafile,"I");
	//kalau bisa dicetak
}
elseif($adasiswa == 0)
{
		$this->fpdf->AddPage();
		$this->fpdf->SetXY($x,$batas_bawah);
		$this->fpdf->setFont('Arial','',9);
		$this->fpdf->Cell(17,0.4,'LAPORAN CAPAIAN KOMPETENSI SISWA',0,2,'C',0);
		$this->fpdf->setFont('Arial','',9);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(8,$tbr,'Siswa tidak ditemukan',0,2,'L',0);
	$namafile='buku_lck_'.$thnajaranx.'_semester_'.$semester.'_.pdf';
	$namafile = str_replace(" ", "_", $namafile);

	$this->fpdf->Output($namafile,"I");
}

else
{
	$this->fpdf->AddPage();
	$this->fpdf->Image('images/logo_madrasah.jpg',$x_logo,$y_logo,$lebar_logo,$tinggi_logo);
		$this->fpdf->SetXY($x,$batas_bawah);
		$this->fpdf->setFont('Arial','',9);
		$this->fpdf->Cell(17,0.4,'Galat LAPORAN CAPAIAN KOMPETENSI SISWA',0,2,'C',0);
	$namafile='galat_.pdf';
	$namafile = str_replace(" ", "_", $namafile);

	$this->fpdf->Output($namafile,"I");
}
?>
