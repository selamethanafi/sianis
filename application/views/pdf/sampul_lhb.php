<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : sampul_lhb.php
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

/*    * POWERED BY       : CodeIgniter 2.1 & FPDF 1.6	 
*/

/* setting zona waktu */ 
date_default_timezone_set('Asia/Jakarta');
$folderfotosiswa = $this->config->item('folderfotosiswa');

$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle("Sampul LHB");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$lebar_kertas = 17;
$tinggi_kertas = 26.5;
$x=2;
$y = 3;
$x2 = 4.0;
$x3 = 5.0;
$x4 = 8.0;
$ada = 0;
$pilihanlogo = 1;
$te = $this->db->query("select * from `m_logo` limit 0,1");
foreach($te->result() as $e)
	{
	$lebar_logo = $e->lebar;
	$tinggi_logo = $e->tinggi;
	$separuh_lebar_logo = $lebar_logo / 2;
	$separuh_lebar = $lebar_kertas / 2;
	$x_logo = $separuh_lebar - $separuh_lebar_logo + $x;
	$y_logo = $e->posisi_y;
	$pilihanlogo = $e->pilihan;
	}
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();

// AddPage merupakan fungsi untuk membuat halaman baru


// Setting Font : String Family, String Style, Font size 
$tdata_siswa=$this->db->query("select * from `datsis` where `nis`='$nis'");
$adasiswa = $tdata_siswa->num_rows();
if ($adasiswa>0)
{
	foreach($tdata_siswa->result() as $a)
	{	
	$nis= $a->nis;
	$semester = 1;
	$thnajaran = '';
	$kelas= '';
	$tb = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by `thnajaran` ASC limit 0,1");
	foreach($tb->result() as $b)
	{
		$thnajaran = $b->thnajaran;
		$semester = $b->semester;
	}
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	$baris1 = '';
	$baris2 = '';
	if($kurikulum == '2015')
	{
		$ta = $this->db->query("select * from `m_referensi` where `opsi`='baris_1_identitas_sekolah_2015'");
		foreach($ta->result() as $a)
		{
			$baris1 = $a->nilai;
		}
		$ta = $this->db->query("select * from `m_referensi` where `opsi`='baris_2_identitas_sekolah_2015'");
		foreach($ta->result() as $a)
		{
			$baris2 = $a->nilai;
		}
	}
	elseif($kurikulum == '2013')
	{
		$ta = $this->db->query("select * from `m_referensi` where `opsi`='baris_1_identitas_sekolah_2013'");
		foreach($ta->result() as $a)
		{
			$baris1 = $a->nilai;
		}
		$ta = $this->db->query("select * from `m_referensi` where `opsi`='baris_2_identitas_sekolah_2013'");
		foreach($ta->result() as $a)
		{
			$baris2 = $a->nilai;
		}
	}
	else
	{
		$baris1 = 'LAPORAN HASIL BELAJAR';
		$baris2 = 'PESERTA DIDIK';
	}
	
	$nisn = nisn($nis);
	$namasiswa = nis_ke_nama($nis);
	$this->fpdf->AddPage();
		$this->fpdf->SetX($x,$y);
		$this->fpdf->SetLineWidth(0.3);
		$this->fpdf->SetDrawColor(0,80,180);
		$this->fpdf->SetFillColor(255,255,255);
	    	$this->fpdf->SetTextColor(220,50,50);
		//bingkai
	    	$this->fpdf->Cell($lebar_kertas,$tinggi_kertas,'',1,1,'C',true);
	$this->fpdf->Image('images/logo.jpg',7.5,4,6,6);
	$this->fpdf->SetFont('Times','',8);

	$this->fpdf->SetXY($x,12);
	$this->fpdf->setFont('Arial','',14);
	$this->fpdf->Cell($lebar_kertas,0.8,$kurikulum.' '.$baris1,0,2,'C',0);
	$this->fpdf->Cell($lebar_kertas,0.8,$baris2,0,2,'C',0);
	$this->fpdf->Cell($lebar_kertas,0.8,$this->config->item('sek_nama'),0,2,'C',0);
	$this->fpdf->Cell($lebar_kertas,0.8,$this->config->item('sek_kab'),0,2,'C',0);
    	$this->fpdf->SetTextColor(0,0,0);
	$this->fpdf->SetDrawColor(0,0,0);
	$this->fpdf->SetFillColor(255,255,255);
	$this->fpdf->SetLineWidth(0);
	$this->fpdf->SetXY(6,16);
	$this->fpdf->setFont('Arial','',12);
	$this->fpdf->Cell(9,0.8,'Nama Peserta Didik',0,2,'C',0);
	$this->fpdf->Cell(9,0.8,$namasiswa,1,2,'C',0);
	$this->fpdf->Cell(9,0.8,'NIS/NISN : '.$nis.' / '.$nisn,1,2,'C',0);
	$this->fpdf->SetXY($x,25);
	$this->fpdf->setFont('Arial','',12);
	$this->fpdf->Cell($lebar_kertas,0.8,'KEMENTERIAN AGAMA',0,2,'C',0);
	$this->fpdf->Cell($lebar_kertas,0.8,'REPUBLIK INDONESIA',0,2,'C',0);
	$this->fpdf->AliasNbPages();
	// AddPage merupakan fungsi untuk membuat halaman baru
	$this->fpdf->AddPage();
	// Setting Font : String Family, String Style, Font size 
	$this->fpdf->SetX($x,$y);
		$this->fpdf->SetX($x,$y);
		$this->fpdf->SetLineWidth(0.3);
		$this->fpdf->SetDrawColor(0,80,180);
		$this->fpdf->SetFillColor(255,255,255);
	    	$this->fpdf->SetTextColor(220,50,50);
		//bingkai
	    	$this->fpdf->Cell($lebar_kertas,$tinggi_kertas,'',1,1,'C',true);
	$this->fpdf->SetXY($x,4);
	$this->fpdf->setFont('Arial','',14);
	$this->fpdf->Cell($lebar_kertas,0.8,$baris1,0,2,'C',0);
	$this->fpdf->Cell($lebar_kertas,0.8,$baris2,0,2,'C',0);
	$this->fpdf->Cell($lebar_kertas,0.8,strtoupper($this->config->item('sek_nama')),0,2,'C',0);
	$this->fpdf->Cell($lebar_kertas,0.8,strtoupper($this->config->item('sek_kab')),0,2,'C',0);
    	$this->fpdf->SetTextColor(0,0,0);
	$this->fpdf->SetDrawColor(0,0,0);
	$this->fpdf->SetFillColor(255,255,255);
	$this->fpdf->SetXY($x+1,10);
	$this->fpdf->setFont('Arial','',12);
	$this->fpdf->Cell(4,0.6,'Nama Sekolah',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_nama'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'NPSN/NSS',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_npsn').' / '.$this->config->item('sek_nss'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Alamat Sekolah',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_alamat'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Kelurahan',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_desa'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Kecamatan',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_kec'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Kabupaten/Kota',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_kab'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Provinsi',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_prov'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Website',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_website'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'E-mail',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_email'),0,2,'L',0);
	$this->fpdf->SetLineWidth(0);
	$this->fpdf->SetXY($x,25);
	$this->fpdf->setFont('Arial','',12);
	$this->fpdf->Cell($lebar_kertas,0.8,'KEMENTERIAN AGAMA',0,2,'C',0);
	$this->fpdf->Cell($lebar_kertas,0.8,'REPUBLIK INDONESIA',0,2,'C',0);
	$this->fpdf->AddPage();
	$namasiswa = nis_ke_nama($nis);
	$this->fpdf->SetX($x,$y);
	$this->fpdf->SetLineWidth(0.3);
	$this->fpdf->SetDrawColor(0,80,180);
	$this->fpdf->SetFillColor(230,230,0);
	$this->fpdf->SetFillColor(255,255,255);
    	$this->fpdf->SetTextColor(220,50,50);
		//bingkai
    		$this->fpdf->Cell($lebar_kertas,$tinggi_kertas,'',1,1,'C',true);
		$this->fpdf->SetXY($x,$y);
		$this->fpdf->setFont('Arial','',12);
		$this->fpdf->Cell($lebar_kertas,0.8,'KETERANGAN PESERTA DIDIK',0,2,'C',0);
    		$this->fpdf->SetTextColor(0,0,0);
		$this->fpdf->SetDrawColor(0,0,0);
		$this->fpdf->SetFillColor(255,255,255);
		$this->fpdf->SetLineWidth(0);
		$this->fpdf->SetXY(2.5,4);
		$this->fpdf->setFont('Arial','',10);
		$this->fpdf->Cell(1,0.5,'1.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Nama Peserta Didik (lengkap)',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$namasiswa,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'2.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Nomor Induk Siswa Nasional',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$nisn,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'3.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Tempat  Tanggal Lahir',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->tmpt.', '.date_to_long_string($a->tgllhr),0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'4.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Jenis Kelamin',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->jenkel,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'5.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Agama',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->agama,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'6.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Status dalam Keluarga',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		if (!empty($a->anakke))
			{
			$this->fpdf->Cell(9,0.5,'Anak Kandung',0,2,'L',0);
			}
			else
			{
			$this->fpdf->Cell(9,0.5,'Anak',0,2,'L',0);
			}

		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'7.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Anak ke',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->anakke,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,1,'8.',0,0,'L',0);
		$alamat = '';
		if (!empty($a->dusun))
			{
			if (!empty($alamat))
				{
				$alamat .= " ".$a->dusun;
				}
				else
				{
				$alamat .= $a->dusun;
				}
			}
		if (!empty($a->rt))
			{
			if (!empty($alamat))
				{
				$alamat .= " RT ".$a->rt;
				}
				else
				{
				$alamat .= "RT ".$a->rt;
				}
			}
		if (!empty($a->rw))
			{
			if (!empty($alamat))
				{
				$alamat .= " RW ".$a->rw;
				}
				else
				{
				$alamat .= "RW ".$a->rw;
				}
			}
		if (!empty($a->desa))
			{
			if (!empty($alamat))
				{
				$alamat .= " Desa ".$a->desa;
				}
				else
				{
				$alamat .= "Desa ".$a->desa;
				}
			}
		if (!empty($a->kec))
			{
			if (!empty($alamat))
				{
				$alamat .= " Kec. ".$a->kec;
				}
				else
				{
				$alamat .= "Kec. ".$a->kec;
				}
			}
		if (!empty($a->kab))
			{
			if (!empty($alamat))
				{
				$alamat .= " ".$a->kab;
				}
				else
				{
				$alamat .= $a->kab;
				}
			}
		if (!empty($a->prov))
			{
			if (!empty($alamat))
				{
				$alamat .= " ".$a->prov;
				}
				else
				{
				$alamat .= $a->prov;
				}
			}



		$this->fpdf->Cell(5,1,'Alamat Peserta Didik',0,0,'L',0);
		$yalamat = $this->fpdf->GetY();
		$this->fpdf->Cell(0.3,1,':',0,0,'L',0);
		$this->fpdf->MultiCell(9,0.5,'alamat'.$alamat,0,'L',0);
		$this->fpdf->SetXY(2.5,$yalamat+1);
		$this->fpdf->Cell(1,0.5,'9.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Nomor Telepon',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->hp,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'10.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Sekolah Asal',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->sltpasal,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'11.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Diterima di sekolah ini',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'a. Di kelas',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->kls,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'b. Pada tanggal',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,date_to_long_string($a->tglditerima),0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'12.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Nama Orang Tua',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'a. Ayah',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->nmayah,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'b. Ibu',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->nmibu,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'13.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Alamat  Orang Tua',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->alayah,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Nomor Telepon',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->tayah,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'14.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Pekerjaan Orang Tua',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'a. Ayah',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$payah = $a->payah;
		if($a->payah == 'Lainnya')
		{
			$payah = '';
		}
		$this->fpdf->Cell(9,0.5,$payah,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'b. Ibu',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$pibu = $a->pibu;
		if($a->pibu == 'Di rumah saja')
		{
			$pibu = 'Ibu rumah tangga';
		}
		if($a->pibu == 'Lainnya')
		{
			$pibu = '';
		}

		$this->fpdf->Cell(9,0.5,$pibu,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'15.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Nama Wali Peserta Didik',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$a->nmwali,0,2,'L',0);
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'16.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Alamat Wali Peserta Didik',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		if (empty($nmwali))
			{
			$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
			}
			else
			{
			$this->fpdf->Cell(9,0.5,$a->awali,0,2,'L',0);
			}
		$this->fpdf->SetX(2.5);
		$this->fpdf->Cell(1,0.5,'17.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'Pekerjaan Wali Peserta Didik',0,0,'L',0);
		$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
		if (empty($nmwali))
			{
			$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
			}
			else
			{
			$this->fpdf->Cell(9,0.5,$a->pwali,0,2,'L',0);
			}
		$y = $this->fpdf->GetY();
		$this->fpdf->SetXY(2.5,$y+4);
		$yyy = $this->fpdf->GetY();	
		if (!empty($a->foto))
			{
			$this->fpdf->Image(''.$folderfotosiswa.'/'.$a->foto.'',7,$yyy,3,4);
			}			
		$this->fpdf->SetXY(12,$yyy+0.5);
		$this->fpdf->Cell(7,0.5,''.$this->config->item('lokasi').', '.date_to_long_string($a->tglditerima).'',0,2,'L',0);
		$this->fpdf->Cell(7,0.5,$this->config->item('plt').'Kepala Madrasah,',0,2,'L',0);
		$this->fpdf->SetXY(12,$yyy+3);
		//cek di siswa kelas
		$namakepala ='';
		$nipkepala = '';
		if (!empty($thnajaran))
			{
			$namakepala = cari_kepala($thnajaran,$semester);
			$nipkepala = cari_nip_kepala($thnajaran,$semester);
			}
		$this->fpdf->Cell(7,0.5,$namakepala,0,2,'L',0);
		$this->fpdf->Cell(7,0.5,'NIP '.$nipkepala,0,2,'L',0);
		$namafile='sampul_lhb_'.$namasiswa.'.pdf';
		$namafile = preg_replace("/ /","_", $namafile);
		$this->fpdf->Output($namafile,"I");
	}
}
