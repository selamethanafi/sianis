<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_identitas_siswa.php
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

$this->fpdf->FPDF("P","cm","Legal");
$this->fpdf->SetTitle("Identitas Siswa");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$lebar = 17.5;
$tinggi = 30;
$x=2;
$y = 3;
$x2 = 3.0;
$x3 = 5.0;
$x4 = 8.0;
$ada = 0;
$pakaifoto = $this->config->item('fotosiswa');
$namakepala = '';
$nipkepala = '';
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$thnajaranx = str_replace("/", "_", $thnajaran);
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();

// AddPage merupakan fungsi untuk membuat halaman baru


// Setting Font : String Family, String Style, Font size 
$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester' and status='Y' order by no_urut ASC");
$adasiswa = $tdata_siswa->num_rows();
if ($adasiswa>0)
{
	foreach($tdata_siswa->result() as $a)
	{	
		$nis= $a->nis;
		$nisn = nisn($nis);
		$fotosiswa =cari_foto($nis);
		$this->fpdf->AddPage();
		$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
		foreach($tb->result() as $b)
		{	
			$namasiswa = strtoupper(nis_ke_nama($nis));
			$this->fpdf->SetX($x,$y);
			$this->fpdf->SetLineWidth(0.3);
			$this->fpdf->SetDrawColor(0,80,180);
			$this->fpdf->SetFillColor(255,255,255);
  			$this->fpdf->SetTextColor(0,0,0);
    			//$this->fpdf->Cell($lebar,$tinggi,'',1,1,'C',true);
			$this->fpdf->SetXY($x,3);
			$this->fpdf->setFont('Arial','',12);
			$this->fpdf->Cell($lebar,0.8,'KETERANGAN PESERTA DIDIK',0,2,'C',0);
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
			$this->fpdf->Cell(9,0.5,$b->tmpt.', '.date_to_long_string($b->tgllhr),0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'4.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Jenis Kelamin',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->jenkel,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'5.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Agama',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->agama,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'6.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Status dalam Keluarga',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			if (!empty($b->anakke))
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
			$this->fpdf->Cell(9,0.5,$b->anakke,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'8.',0,0,'L',0);
			$alamat = '';
			if (!empty($b->dusun))
			{
				if (!empty($alamat))
				{
					$alamat .= " ".$b->dusun;
				}
				else
				{
					$alamat .= $b->dusun;
				}
			}
			if (!empty($b->rt))
			{
				if (!empty($alamat))
				{
				$alamat .= " RT ".$b->rt;
				}
				else
				{
				$alamat .= "RT ".$b->rt;
				}
			}
			if (!empty($b->rw))
			{
				if (!empty($alamat))
				{
				$alamat .= " RW ".$b->rw;
				}
				else
				{
				$alamat .= "RW ".$b->rw;
				}
			}
			if (!empty($b->desa))
			{
				if (!empty($alamat))
				{
				$alamat .= " Desa ".$b->desa;
				}
				else
				{
				$alamat .= "Desa ".$b->desa;
				}
			}
			if (!empty($b->kec))
			{
				if (!empty($alamat))
				{
				$alamat .= " Kec. ".$b->kec;
				}
				else
				{
				$alamat .= "Kec. ".$b->kec;
				}
			}
			if (!empty($b->kab))
			{
				if (!empty($alamat))
				{
				$alamat .= " ".$b->kab;
				}
				else
				{
				$alamat .= $b->kab;
				}
			}
			if (!empty($b->prov))
			{
				if (!empty($alamat))
				{
				$alamat .= " ".$b->prov;
				}
				else
				{
				$alamat .= $b->prov;
				}
			}
			$this->fpdf->Cell(5,0.5,'Alamat Peserta Didik',0,0,'L',0);
			$yalamat = $this->fpdf->GetY();
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->MultiCell(9,0.5,$alamat,0,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'9.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Nomor Telepon',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->hp,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'10.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Sekolah Asal',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->sltp,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'11.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Diterima di sekolah ini',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,'',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'a. Di kelas',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->kls,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'b. Pada tanggal',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,date_to_long_string($b->tglditerima),0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'12.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Nama Orang Tua',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'a. Ayah',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->nmayah,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'b. Ibu',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->nmibu,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'13.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Alamat  Orang Tua',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->alayah,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Nomor Telepon',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->tayah,0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'14.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Pekerjaan Orang Tua',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'a. Ayah',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			if($b->payah == 'Lainnya')
			{
				$this->fpdf->Cell(9,0.5,'',0,2,'L',0);
			}
			else
			{
				$this->fpdf->Cell(9,0.5,$b->payah,0,2,'L',0);
			}

			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'b. Ibu',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			if(($b->pibu == 'Lainnya') or ($b->pibu == 'Di rumah saja'))
			{
				$this->fpdf->Cell(9,0.5,'-',0,2,'L',0);
			}
			else
			{
				$this->fpdf->Cell(9,0.5,$b->pibu,0,2,'L',0);
			}
			$this->fpdf->SetX(2.5);
			$this->fpdf->Cell(1,0.5,'15.',0,0,'L',0);
			$this->fpdf->Cell(5,0.5,'Nama Wali Peserta Didik',0,0,'L',0);
			$this->fpdf->Cell(0.3,0.5,':',0,0,'L',0);
			$this->fpdf->Cell(9,0.5,$b->nmwali,0,2,'L',0);
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
			$this->fpdf->Cell(9,0.5,$b->awali,0,2,'L',0);
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
				$this->fpdf->Cell(9,0.5,$b->pwali,0,2,'L',0);
			}
			$y = $this->fpdf->GetY();
			$this->fpdf->SetXY(2.5,$y+2);
			$yyy = $this->fpdf->GetY();	
			if (!empty($b->foto))
			{
				$this->fpdf->Image(''.$folderfotosiswa.'/'.$b->foto.'',7,$yyy,3,4);
			}			
			$this->fpdf->SetXY(12,$yyy+0.5);
			$this->fpdf->Cell(7,0.5,''.$this->config->item('lokasi').', '.date_to_long_string($b->tglditerima).'',0,2,'L',0);
			$this->fpdf->Cell(7,0.5,$this->config->item('plt').'Kepala Madrasah,',0,2,'L',0);
			$this->fpdf->SetXY(12,$yyy+3);
			$this->fpdf->Cell(7,0.5,$namakepala,0,2,'L',0);
			$this->fpdf->Cell(7,0.5,'NIP '.$nipkepala,0,2,'L',0);
	/*
		$this->fpdf->Cell(1,0.5,'.',0,0,'L',0);
		$this->fpdf->Cell(5,0.5,'',0,0,'L',0);
		$this->fpdf->Cell(9,0.5,$,0,2,'L',0);
		$this->fpdf->SetX(2.5);
*/
		} //data siswa
	} //akhir ada siswa
}

else
{

	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->SetXY(1.5,1.0);
	$this->fpdf->Cell(18,0.5,'DATA SISWA TIDAK ADA',0,2,'C',0);
}
/* setting Cell untuk page number */

$namafile='identitas_siswa_lck_kelas_'.$kelas.'_'.$thnajaranx.'_semester_'.$semester.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
