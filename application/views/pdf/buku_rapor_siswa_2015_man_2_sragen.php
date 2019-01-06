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
$batas_paksa = 23;
if($ukuran_kertas == 'Legal')
{
	$batas_paksa = 27;
}

$this->fpdf->FPDF("P","cm",$ukuran_kertas);
$this->fpdf->SetTitle("buku rapor permen 53 tahun 2015 versi 2");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");

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
$batasbawah = 28;
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
	$this->fpdf->Cell(3,$tbr,'Nama Madrasahs',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$sek_nama,0,0,'L',0);
	$this->fpdf->Cell(3,$tbr,'Kelas',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(2,$tbr,$kelas,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,$tbr,'Alamat',0,0,'L',0);
	$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
	$this->fpdf->Cell(8,$tbr,$sek_alamat_pendek,0,0,'L',0);
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
	//sikap antar mapel
	$td = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$sikap_spiritual = '';
	$sikap_sosial = '';
	$pred1 = '';
	$pred2 = '';
	foreach($td->result() as $d)
	{
		$pred1 = $d->satu;
		$pred2 = $d->dua;
		$sikap_spiritual = $d->kom1;
		$sikap_sosial = $d->kom2;
	}
	$ksp = 3;
	$kss = $lebar - $ksp;
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($lebar,0.4,'CAPAIAN HASIL BELAJAR',0,2,'C',0);
	$this->fpdf->Cell($lebar,0.3,'',0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,'A. Sikap Spiritual dan Sosial',0,2,'L',0);
	$this->fpdf->Cell($lebar,0.8,'1. Sikap Spiritual',0,2,'l',0);
	$this->fpdf->Cell($ksp,0.8,'Predikat',1,0,'C',0);
	$this->fpdf->Cell($kss,0.8,'Deskripsi',1,2,'C',0);
	$this->fpdf->SetX($x);
	$y1 = $this->fpdf->GetY();
	//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
	$this->fpdf->MultiCell($ksp,0.5,$pred1.' ('.predikat_sikap($pred1).')',0,'C',0);
	$this->fpdf->SetXY($x+$ksp,$y1);
	$this->fpdf->MultiCell($kss,0.5,$sikap_spiritual,1,'L',0);
	$y2 = $this->fpdf->GetY();
	$tinggi = $y2 - $y1;
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->Cell($ksp,$tinggi,'',1,2,'C',0); // bingkai
	$this->fpdf->Cell($lebar,0.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->Cell($lebar,0.8,'2. Sikap Sosial',0,2,'l',0);
	$this->fpdf->SetX($x);
	$y1 = $this->fpdf->GetY();
	$this->fpdf->MultiCell($ksp,0.5,$pred2.' ('.predikat_sikap($pred2).')',0,'C',0);
	$this->fpdf->SetXY($x+$ksp,$y1);
	$this->fpdf->MultiCell($kss,0.5,$sikap_sosial,1,'L',0);
	$y2 = $this->fpdf->GetY();
	$tinggi = $y2 - $y1;
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->Cell($ksp,$tinggi,'',1,2,'C',0); //bingkai
	$this->fpdf->Cell($ksp,1,'',0,2,'C',0); // spasi kosong
	$k1 = 1.5;
	$k3 = 1;
	$k4 = 1.5;
	$k5 = 3;
	$k6 = 1.5;
	$k7 = 3;
	$k2 = $lebar - 	$k1 - $k3 - $k4 - $k5 - $k6 - $k7;
	$this->fpdf->setFont('Arial','',9);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($lebar,0.8,'B. Pengetahuan dan Keterampilan',0,2,'L',0);
	$this->fpdf->Cell($k1,1.6,'Nomor',1,0,'C',0);
	$this->fpdf->Cell($k2,1.6,'Mata Pelajaran',1,0,'C',0);
	$this->fpdf->Cell($k3,1.6,'KKM',1,0,'C',0);
	$this->fpdf->Cell($k4+$k5,0.8,'Pengetahuan',1,0,'C',0);
	$this->fpdf->Cell($k6+$k7,0.8,'Keterampilan',1,2,'C',0);
	$this->fpdf->SetX($x+$k1+$k2+$k3);
	$this->fpdf->Cell($k4,0.8,'Nilai',1,0,'C',0);
	$this->fpdf->Cell($k5,0.8,'Predikat',1,0,'C',0);
	$this->fpdf->Cell($k6,0.8,'Nilai',1,0,'C',0);
	$this->fpdf->Cell($k7,0.8,'Predikat',1,2,'C',0);

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
			$this->fpdf->Cell($k2+$k3+$k4+$k5+$k6+$k7,0.8,$mapele.' '.$peminatan,1,2,'L',0);
			}
		elseif(empty($mapel))
			{
			$this->fpdf->Cell($k1,0.8,$komponen,1,0,'C',0);			
			$this->fpdf->SetX($x+$k1);
			$this->fpdf->Cell($k2+$k3+$k4+$k5+$k6+$k7,0.8,$mapele,1,2,'L',0);
			}
		else
		{
			$kunci = '';
			$penggalan = substr($mapele,0,8);
			$penggalan = strtoupper($penggalan);
			$prakarya = 0;
			if(($penggalan == 'PRAKARYA') or ($penggalan == 'KETERAMP') or ($penggalan == 'KETRAMPI'))
			{
				$tc = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel` like '%prakarya%' and `nis`='$nis' and `status`='Y'");
				foreach($tc->result() as $c)
				{
					$mapel = $c->mapel;
				}
				$prakarya = $tc->num_rows();
			}
			if($prakarya == 0)
			{

				$tc = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis' and `status`='Y'");
			}

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
					$kkm = cari_kkm($thnajaran,$semester,$kelas,$mapel);
					if($status_nilai == 'akhir')
					{
						if(empty($kunci))
							{
							$this->fpdf->SetXY($x+$k1+$k2,$yn);
							$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7,$selisih,'Nilai belum dikunci oleh wali kelas',1,2,'C',0);
							}
							else
						{

						$this->fpdf->Cell($k3,$selisih,$kkm,1,0,'C',0);
						$this->fpdf->Cell($k4,$selisih,$c->kog,1,0,'C',0);
						$this->fpdf->Cell($k5,$selisih,predikat_nilai_2015($c->kog,$this->config->item('versi_predikat_nilai')),1,0,'C',0);
						$this->fpdf->Cell($k6,$selisih,$c->psi,1,0,'C',0);
						$this->fpdf->Cell($k7,$selisih,predikat_nilai_2015($c->psi,$this->config->item('versi_predikat_nilai')),1,2,'C',0);
						}
					}
					elseif($status_nilai == 'sementara')
					{
						$this->fpdf->Cell($k3,$selisih,$kkm,1,0,'C',0);
						$this->fpdf->Cell($k4,$selisih,$c->nilai_nr,1,0,'C',0);
						$this->fpdf->Cell($k5,$selisih,predikat_nilai_2015($c->nilai_nr,$this->config->item('versi_predikat_nilai')),1,0,'C',0);
						$this->fpdf->Cell($k6,$selisih,$c->psikomotor,1,0,'C',0);
						$this->fpdf->Cell($k7,$selisih,predikat_nilai_2015($c->psikomotor,$this->config->item('versi_predikat_nilai')),1,2,'C',0);
					}
					else
					{
						$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7,$selisih,'Status nilai ?',1,2,'C',0);
					}

				} //kalau ada nilai
			}
			else
			{
				$this->fpdf->SetXY($x+$k1+$k2,$yn);
				$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7,$selisih,'Siswa tidak mengikuti mata pelajaran ini',1,2,'C',0);
			}
				$ymapelatas = $this->fpdf->GetY();	
				if($ymapelatas>$batas_paksa)
				{
					$this->fpdf->AddPage();
					$this->fpdf->SetXY($x,$batas_bawah);
					$this->fpdf->setFont('Arial','',9);
			//	$this->fpdf->Cell(17,0.4,'LAPORAN CAPAIAN KOMPETENSI SISWA',0,2,'C',0);
					$this->fpdf->Cell(3,$tbr,'Nama Madrasah',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$sek_nama,0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'Kelas',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,$kelas,0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell(3,$tbr,'Alamat',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$sek_alamat_pendek,0,0,'L',0);
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
					$this->fpdf->Cell($k1,1.6,'Nomor',1,0,'C',0);
					$this->fpdf->Cell($k2,1.6,'Mata Pelajaran',1,0,'C',0);
					$this->fpdf->Cell($k3,1.6,'KKM',1,0,'C',0);
					$this->fpdf->Cell($k4+$k5,0.8,'Pengetahuan',1,0,'C',0);
					$this->fpdf->Cell($k6+$k7,0.8,'Keterampilan',1,2,'C',0);
					$this->fpdf->SetX($x+$k1+$k2+$k3);
					$this->fpdf->Cell($k4,0.8,'Nilai',1,0,'C',0);
					$this->fpdf->Cell($k5,0.8,'Predikat',1,0,'C',0);
					$this->fpdf->Cell($k6,0.8,'Nilai',1,0,'C',0);
					$this->fpdf->Cell($k7,0.8,'Predikat',1,2,'C',0);
					$ymapelatas = $this->fpdf->GetY();
				}
				$this->fpdf->SetXY($x,$ymapelatas);	
				//paksa ganti halaman

		}	
	}
	// akhir mata pelajaran
	$this->fpdf->Cell(2,0.6,'',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Arial','',9);
	$this->fpdf->Cell($lebar,1,'Deskripsi Pengetahuan dan Keterampilan',0,2,'L',0);
	$this->fpdf->SetX($x);
	$k1 = 1;
	$k2 = 5;
	$k3 = 3;
	$k4 = $lebar-9;
	$yn = $this->fpdf->GetY();
	$this->fpdf->Cell($k1,0.8,'No',1,0,'C',0);			
	$this->fpdf->Cell($k2,0.8,'Mata Pelajaran',1,0,'C',0);			
	$this->fpdf->Cell($k3,0.8,'Aspek',1,0,'C',0);
	$this->fpdf->Cell($k4,0.8,'Deskripsi',1,2,'C',0);
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
					$this->fpdf->Cell(8,$tbr,$sek_nama,0,0,'L',0);
					$this->fpdf->Cell(3,$tbr,'Kelas',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(2,$tbr,$kelas,0,2,'L',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell(3,$tbr,'Alamat',0,0,'L',0);
					$this->fpdf->Cell($tbr,$tbr,':',0,0,'L',0);
					$this->fpdf->Cell(8,$tbr,$sek_alamat_pendek,0,0,'L',0);
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
					$this->fpdf->Cell($lebar,0.4,'Deskripsi Pengetahuan dan Keterampilan',0,2,'L',0);
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
			$prakarya = 0;
			$penggalan = substr($mapele,0,8);
			$penggalan = strtoupper($penggalan);
			if(($penggalan == 'PRAKARYA') or ($penggalan == 'KETERAMP') or ($penggalan == 'KETRAMPI'))
			{
				$td = $this->db->query("select * from `nilai` WHERE `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel` like '%prakarya%' and `nis`='$nis' and `status`='Y'");
				foreach($td->result() as $d)
				{
					$mapel = $d->mapel;
				}
				$prakarya = $td->num_rows();
			}
			if($prakarya == 0)
			{
				$td = $this->db->query("select * from `nilai` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis`='$nis'");
			}
			foreach($td->result() as $d)
			{
				$desk = $d->keterangan;
				$ketpsi = $d->deskripsi;
			}
			$this->fpdf->MultiCell($k4,0.4,$desk,1,'L',0);
			$ymapelatas = $this->fpdf->GetY();
			if($ymapelatas>$batas_paksa)
			{
				$this->fpdf->AddPage();
			}

			$this->fpdf->SetX($x+$k1+$k2);
			$this->fpdf->Cell($k3,0.4,'Keterampilan',0,0,'L',0);
			$this->fpdf->MultiCell($k4,0.4,$ketpsi,1,'L',0);
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
	$ymapelatas = $this->fpdf->GetY();
	if($ymapelatas>$batas_paksa)
	{
		$this->fpdf->AddPage();
	}

	$this->fpdf->Cell(1,0.5,'',0,2,'C',0);
	$this->fpdf->SetX($x);	
	$k1 = 1;
	$k2 = 5;
	$k3 = 2;
	$k4 = $lebar - $k1 - $k2 - $k3;
	$this->fpdf->Cell($lebar,0.8,'C. Ekstrakurikuler',0,2,'L',0);
	$this->fpdf->Cell($k1,0.8,'NO',1,0,'C',0);
	$this->fpdf->Cell($k2,0.8,'Kegiatan Ekstrakurikuler',1,0,'C',0);
	$this->fpdf->Cell($k3,0.8,'Nilai',1,0,'C',0);
	$this->fpdf->Cell($k4,0.8,'Deskripsi',1,2,'C',0);
	$this->fpdf->SetX($x);
	$nilai_ekstra = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$adaekstra = $nilai_ekstra->num_rows();
	if ($adaekstra>0)
	{
		$no = 1;
		foreach($nilai_ekstra->result() as $dne)
		{
			$y1 = $this->fpdf->GetY();
			$this->fpdf->Cell($k1,0.6,$no,0,0,'C',0);
			$this->fpdf->Cell($k2,0.6,$dne->nama_ekstra,0,0,'L',0);
			$this->fpdf->Cell($k3,0.6,$dne->nilai,0,0,'C',0);
			$this->fpdf->MultiCell($k4,0.5,$dne->keterangan,0,'L',0);
			$y2 = $this->fpdf->GetY();
			$tinggi = $y2 - $y1;
			if($tinggi<0.6)
			{
				$tinggi = 0.6;
			}
			$this->fpdf->SetXY($x,$y1);
			$this->fpdf->Cell($k1,$tinggi,'',1,0,'C',0);
			$this->fpdf->Cell($k2,$tinggi,'',1,0,'C',0);
			$this->fpdf->Cell($k3,$tinggi,'',1,0,'C',0);
			$this->fpdf->Cell($k4,$tinggi,'',1,2,'C',0);
			$this->fpdf->SetX($x);
			$no++;
		}
	}
	else
	{
	    $this->fpdf->SetX($x);
	    $this->fpdf->Cell($k1+$k2+$k3+$k4,0.6,'---------------------',1,2,'C',0);
	}
	$ymapelatas = $this->fpdf->GetY();
	if($ymapelatas>$batas_paksa)
	{
		$this->fpdf->AddPage();
	}

	//prestasi
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($lebar,0.6,'',0,2,'C',0);
	$this->fpdf->Cell($lebar,0.5,'D. Prestasi',0,2,'L',0);
	$k1 = 1;
	$k2 = 6;
	$k3 = $lebar - $k1 - $k2;
	$this->fpdf->SetX($x);		
	$this->fpdf->Cell($k1,0.6,'No',1,0,'C',0);
	$this->fpdf->Cell($k2,0.6,'Jenis Kegiatan',1,0,'C',0);
	$this->fpdf->Cell($k3,0.6,'Keterangan',1,2,'C',0);

//cari prestasi
	$tpres = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran'");
	$adapres = $tpres->num_rows();
	if ($adapres>0)
			{
	$no = 1;
	foreach($tpres->result() as $dpres)
		{
		$this->fpdf->SetX($x);		
		$y1 = $this->fpdf->GetY();
		$this->fpdf->Cell($k1,0.6,$no,0,0,'C',0);
		$this->fpdf->MultiCell($k2,0.5,$dpres->kegiatan,0,'L',0);
		$y3 = $this->fpdf->GetY();
		$this->fpdf->SetXY($x+$k1+$k2,$y1);		
		$this->fpdf->MultiCell($k3,0.5,$dpres->keterangan,0,'L',0);
		$y2 = $this->fpdf->GetY();
		if($y3>$y2)
		{
			$y2 = $y3;
		}		
		$tinggi  = $y2 - $y1;
		if($tinggi<0.6)
		{
			$tinggi = 0.6;
		}
		$this->fpdf->SetXY($x,$y1);		
		$this->fpdf->Cell($k1,$tinggi,'',1,0,'C',0);
		$this->fpdf->Cell($k2,$tinggi,'',1,0,'C',0);
		$this->fpdf->Cell($k3,$tinggi,'',1,2,'C',0);
		$no++;
		}
	}
	else
	{
	    $this->fpdf->SetX($x);
	    $this->fpdf->Cell($k1+$k2+$k3,0.6,'---------------------',1,2,'C',0);
	}
	$ymapelatas = $this->fpdf->GetY();
	if($ymapelatas>$batas_paksa)
	{
		$this->fpdf->AddPage();
	}

	// ketidak hadiran
	$catatanwalikelas = '';
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($lebar,0.6,'',0,2,'C',0);
	$this->fpdf->Cell($lebar,0.5,'E. Ketidakhadiran',0,2,'L',0);

	$nilai_pribadi = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$adapribadi = $nilai_pribadi->num_rows();
	if ($adapribadi>0)
	{
		foreach($nilai_pribadi->result() as $d)
		{
			$catatanwalikelas = $d->wali;
			$this->fpdf->SetX($x);
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
//prestasi
	$ymapelatas = $this->fpdf->GetY();
	if($ymapelatas>$batas_paksa)
	{
		$this->fpdf->AddPage();
	}
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,1,'',0,2,'L',0);
	$this->fpdf->Cell($lebar,0.5,'F. Catatan Walikelas',0,2,'L',0);
	$ycw = $this->fpdf->GetY();
	$this->fpdf->SetXY($x,$ycw+0.2);
	$this->fpdf->MultiCell($lebar,0.5,$catatanwalikelas,0,'L',0);
	$ycw2 = $this->fpdf->GetY();
	$selisih = $ycw2 - $ycw;
	$this->fpdf->SetXY($x,$ycw);
	$this->fpdf->Cell($lebar,$selisih+0.4,'',1,2,'L',0);
	$ymapelatas = $this->fpdf->GetY();
	if($ymapelatas>$batas_paksa)
	{
		$this->fpdf->AddPage();
	}

	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,1,'',0,2,'L',0);
	$this->fpdf->Cell($lebar,0.5,'G. Tanggapan Orang Tua / Wali',0,2,'L',0);
	$this->fpdf->Cell($lebar,3,'',1,2,'L',0);
	$this->fpdf->Cell(1,1,'',0,2,'L',0);
	$ywali = $this->fpdf->getY();
	if($semester == '1')
	{
		if($ywali > 29)
		{
			$this->fpdf->AddPage(); // page break.
			$ywali = $this->fpdf->getY();
			$this->fpdf->SetY($this->config->item('batas_atas'));
		}
	}
	else
	{
		if($ywali > 25)
		{
			$this->fpdf->AddPage(); // page break.
			$ywali = $this->fpdf->getY();
			$this->fpdf->SetY($this->config->item('batas_atas'));
		}
	}

		if($semester == '2')
		{
			if(substr($kelas,0,2) == 'X-')
			{
				$kelasnaik = 'XI (sebelas)';
				$kelasajeg = 'X (sepuluh)';
			}
			if(substr($kelas,0,3) == 'XI-')
			{
				$kelasnaik = 'XII (dua belas)';
				$kelasajeg = 'XI (sebelas)';
			}
			$k1 = 1;
			if(substr($kelas,0,4) == 'XII-')
			{
				$this->fpdf->SetX($x+$k1);
				$this->fpdf->Cell($k2,0.4,'Keputusan',0,2,'L',0);
				$this->fpdf->Cell($k2,0.4,'Berdasar kriteria kelulusan satuan pendidikan',0,2,'L',0);
				$this->fpdf->Cell($k2,0.4,'peserta didik ditetapkan',0,2,'L',0);
				$this->fpdf->Cell($k2,0.4,'lulus / tidak lulus',0,2,'L',0);
			}
			else
			{
				$this->fpdf->SetX($x+$k1);
				$this->fpdf->Cell($k2,0.4,'Keputusan',0,2,'L',0);
				$this->fpdf->Cell($k2,0.4,'Berdasar pencapaian kompetensi pada semester 1, semester 2 dan,',0,2,'L',0);
				$this->fpdf->Cell($k2,0.4,'kriteria kenaikan kelas, peserta didik ditetapkan',0,2,'L',0);
				$this->fpdf->Cell($k2,0.4,'naik ke kelas '.$kelasnaik,0,2,'L',0);
				$this->fpdf->Cell($k2,0.4,'tinggal di kelas '.$kelasajeg,0,2,'L',0);
			}
		}
//		$this->fpdf->Cell($k2,1.5,'',0,2,'L',0);
		$k2 = 11;
		$k3 = $lebar - $k1 - $k2;
		$this->fpdf->SetX($x+$k1);
		$this->fpdf->Cell($k2,0.4,'Mengetahui',0,0,'L',0);
		$this->fpdf->Cell($k3,0.4,$lokasi.', '.date_to_long_string($tanggalcetak),0,2,'L',0);
		$this->fpdf->SetX($x+$k1);
		$yy = $this->fpdf->GetY();
		$this->fpdf->Cell($k2,0.4,'Orang tua / Wali',0,0,'L',0);
		$this->fpdf->Cell($k3,0.4,'Wali Kelas',0,2,'L',0);
		$this->fpdf->Cell($lebar,1.5,' ',0,2,'C',0); // spasi kosong
		$this->fpdf->SetX($x+$k1);
		$this->fpdf->Cell($k2,0.4,'_______________________',0,0,'L',0);
		$this->fpdf->Cell($k3,0.4,$namawalikelas,0,2,'L',0);
		$this->fpdf->SetX($x+$k1+$k2);
		$this->fpdf->Cell($k3,0.4,'NIP '.$nipwalikelas.'',0,2,'L',0);
		$yy = $this->fpdf->GetY();
		if($semester == '2')
		{
			if($siswa == 'bukan')
			{
				if($ttd == 1) 
				{
					$posisix = $posisi_x + 6.2;
					$yyy = $yy + 0.8;
					$posisine_y = $yyy + $posisi_y;
					$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisix,$posisine_y,$lebar_ttd,$tinggi_ttd);
				}
			}
			$this->fpdf->SetXY($x+7,$yy);
			$this->fpdf->Cell($k3,0.4,'Mengetahui',0,2,'L',0);
			$this->fpdf->Cell($k3,0.4,$plt.'Kepala '.ucwords($sek_tipe),0,2,'L',0);
			$this->fpdf->Cell($k3,1.5,' ',0,2,'L',0); // spasi kosong
			$this->fpdf->Cell($k3,0.4,$namakepala,0,2,'L',0);
			$this->fpdf->Cell($k3,0.5,'NIP '.$nipkepala.'',0,2,'L',0);
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
		$this->fpdf->Cell(17,0.4,'RAPOR',0,2,'C',0);
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
		$this->fpdf->Cell(17,0.4,'Galat RAPOR',0,2,'C',0);
	$namafile='galat_.pdf';
	$namafile = str_replace(" ", "_", $namafile);

	$this->fpdf->Output($namafile,"I");
}
?>
