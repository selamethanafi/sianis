<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 10 Jan 2015 21:40:31 WIB 
// Nama Berkas 		: sampul_ppkpns_pdf.php
// Lokasi      		: application/views/pdf/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
$x = 2;
$x2 = $x+2;
$y = 7;
$x1 = 2;
$tinggi = 0.8;
$tinggi2 = 1;
$awal = $tahunpenilaian ;
$akhir = $tahunpenilaian + 1;
$thnajaran = $awal."/".$akhir;
$semester = 2;
$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nip' and `tahun`='$tahunpenilaian'");
$idskawal = '';
$idskakhir = '';
$tawal = '';
$takhir = '';
$tambah = 0;
foreach($tb->result() as $b)
{
	$idskawal = $b->skawal;
	$idskakhir = $b->skakhir;
	$tawal = $b->tawal;
	$takhir = $b->takhir;
	$tambah = $b->tambah;
	$permanen = $b->kepala;
	$skp = $b->skp;
	$pelayanan = $b->pelayanan;
	$komitmen = $b->komitmen;
	$integritas = $b->integritas;
	$disiplin = $b->disiplin;
	$kerjasama = $b->kerjasama;
	$kepemimpinan = $b->kepemimpinan;
	$hasil_skp = $b->skp;

}
$gol1 = id_sk_jadi_golongan($idskawal) ;
$pangkat1 = golongan_jadi_pangkat($gol1);
$jabatan1 = golongan_jadi_jabatan($gol1);
$gol2 = id_sk_jadi_golongan($idskakhir) ;
$pangkat2 = golongan_jadi_pangkat($gol2);
$jabatan2 = golongan_jadi_jabatan($gol2);
$tc = $this->db->query("select * from `pkg_masa` where tahun = '$tahunpenilaian'");
foreach($tc->result() as $c)
{
	$tpejabat = $c->tpejabat;
 	$tybs = $c->tybs;
	$tatasanpejabat = $c->tatasanpejabat;
	$t1 = $c->awal;
	$t2 = $c->akhir;
	$tskp = $c->tskp;
	$tpenilaian = $c->tpenilaian;
}
	$tx = $this->db->query("select * from p_pegawai where `nip`='$nip'");
	foreach($tx->result() as $dx)
	{
		$nippegawai = $dx->nip;
		$tempat = $dx->tempat;
		$tgllhr = $dx->tanggallahir;
		$usernamepegawai = $dx->kd;
		$tmtguru = $dx->tmt_guru;
		$jenkel = $dx->jenkel;
		$namapegawai = $dx->nama;
		$jenkel = $dx->jenkel;
		//	$tipepegawai 
	}
if($permanen == 1)
{
	$this->fpdf->FPDF("P","cm","Legal");		
	$this->fpdf->AliasNbPages();
	$this->fpdf->SetTitle("Penilaian Prestasi Kerja PNS");
	$this->fpdf->SetAuthor("Selamet Hanafi");
	$this->fpdf->SetSubject("Sistem Informasi Madrasah");
	$this->fpdf->SetKeywords("sistem, informasi, madrasah");
	// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
	$this->fpdf->AddPage();
	$xxx = 9.5;
	$yyy = 2;
	$this->fpdf->Image('images/garuda_pancasila.jpg',$xxx,$yyy,2.5,2.5);
	$this->fpdf->SetXY($x,5);
	$this->fpdf->setFont('Times','',16);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'PENILAIAN PRESTASI KERJA',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'PEGAWAI NEGERI SIPIL',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'Jangka Waktu Penilaian',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,date_to_long_string($t1).' s.d. '.date_to_long_string($t2),0,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,3*$tinggi,'',0,2,'C',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->setFont('Times','',14);
	$this->fpdf->cell(6,$tinggi2,'Nama Pegawai',0,0,'L',0);
	$this->fpdf->setFont('Times','B',14);
	$this->fpdf->cell(10,$tinggi2,': '.$namapegawai,0,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->setFont('Times','',14);
	$this->fpdf->cell(6,$tinggi2,'NIP',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,': '.$nippegawai,0,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(6,$tinggi2,'Pangkat, Golongan ruang',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,': '.$pangkat2.' / '.$gol2,0,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(6,$tinggi2,'Jabatan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,': '.$jabatan2,0,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(6,$tinggi2,'Unit Kerja',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,': '.$this->config->item('unit_kerja'),0,2,'L',0);
	$this->fpdf->SetXY($x,30);
	$this->fpdf->cell(18,$tinggi,strtoupper($this->config->item('unit_kerja')),0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,$tinggi,'TAHUN '.$tahunpenilaian,0,2,'C',0);
	// borang
	$this->fpdf->AddPage("L");
//	$this->fpdf->FPDF("L","cm","Legal");
	$lebar = 29;
	$tinggi = 19;
	$x = 4;
	$cari_os = cari_os();
	if($cari_os == 'Windows')
	{
		$x = 2;
	}	
	$y = 1;
	$tb = 0.5;
	$tb2 = 0.5;
	$tb1 = 1.5;
	$k1 = 1.5;
	$k2 = 3;
	$k3 = 12;
	$k4 = 1.5;
	$k5 = 3.5;
	$k6 = 7.5;
	$k7 = 3.5;
	$k8 = 2;
	$k9 = 3;
	$k10 = $k5+$k6-$k7-$k8-$k9;
	$k11 = 1; //kuantitas
	$k12 = $k7-$k11;
	$k13 = 1.5; //waktu
	$k14 = $k9-$k13;
	//januari 2014 itu 2013/2014 semester 2
	//2014 JADI 2013/2014 SMT 2
	$awal = $tahunpenilaian - 1 ;
	$akhir = $tahunpenilaian;
	$awal2 = $tahunpenilaian ;
	$akhir2 = $tahunpenilaian + 1;
	$thnajaran = $awal."/".$akhir;
	$semester = 2;
	$thnajaran2 = $awal2."/".$akhir2;
	$semester2 = 1;

	$gol1 = id_sk_jadi_golongan($idskawal) ;
	$pangkat1 = golongan_jadi_pangkat($gol1);
	$jabatan1 = golongan_jadi_jabatan($gol1);
	$gol2 = id_sk_jadi_golongan($idskakhir) ;
	$pangkat2 = golongan_jadi_pangkat($gol2);
	$jabatan2 = golongan_jadi_jabatan($gol2);
	$tambahan = '';
	$adatambahan = 0;
	$tsk = $this->db->query("SELECT * FROM `p_tugas_tambahan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	foreach($tsk->result() as $dsk)
	{
		$tambahan = $dsk->nama_tugas;
	}
	if ((substr($tambahan,0,10)=='Kepala Mad') or (substr($tambahan,0,10)=='Kepala Sek'))
	{
		$adatambahan = 1;
	}
	$tahunsekarang = $tahunpenilaian;
	$nama_penilai = '';
	$nip_penilai = '';
	$pangkat_golongan_penilai = '';
	$jabatan_penilai = '';
	$unit_organisasi_penilai = '';
	$nama_atasan_penilai = '';
	$nip_atasan_penilai = '';
	$pangkat_golongan_atasan_penilai = '';
	$jabatan_atasan_penilai = '';
	$unit_organisasi_atasan_penilai = '';
	if ($adatambahan ==0)
	{
		$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahunsekarang' and dinilai='guru'");
	}
	if ($adatambahan ==1)
	{
		$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahunsekarang' and dinilai='kepala'");
	}
	foreach($ta->result() as $a)
	{
		$nama_penilai = $a->nama_penilai;
		$nip_penilai = $a->nip_penilai;
		$pangkat_golongan_penilai = $a->pangkat_golongan;
		$jabatan_penilai = $a->jabatan;
		$unit_organisasi_penilai = $a->unit_organisasi;
		$nama_atasan_penilai = $a->nama_atasan;
		$nip_atasan_penilai = $a->nip_atasan;
		$pangkat_golongan_atasan_penilai = $a->pangkat_golongan_atasan;
		$jabatan_atasan_penilai = $a->jabatan_atasan;
		$unit_organisasi_atasan_penilai = $a->unit_organisasi_atasan;
	}
	$namasekolah = $this->config->item('sek_nama');
	$teleponsekolah = $this->config->item('sek_telepon');
	$desa = $this->config->item('sek_desa');
	$kec = $this->config->item('sek_kec');
	$kab = $this->config->item('sek_kab');
	$prov = $this->config->item('sek_prov');
	$this->fpdf->SetXY($x,$y + $tambah);
	$this->fpdf->SetFont('Helvetica','',10);
	$this->fpdf->Cell($lebar,$tb,'SASARAN KERJA PEGAWAI',0,2,'C',0);
	$this->fpdf->Cell($k1,$tb, 'No',1,0,'C',0);
	$this->fpdf->Cell($k2+$k3,$tb, 'I. PEJABAT PENILAI',1,0,'C',0);
	$this->fpdf->Cell($k4,$tb, 'No',1,0,'C',0);
	$this->fpdf->Cell($k5+$k6,$tb, 'II. PEGAWAI NEGERI SIPIL YANG DINILAI',1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb, '1',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb, 'Nama',1,0,'L',0);
	$this->fpdf->Cell($k3,$tb, $nama_penilai,1,0,'L',0);
	$this->fpdf->Cell($k4,$tb, '1',1,0,'C',0);
	$this->fpdf->Cell($k5,$tb, 'Nama',1,0,'L',0);
	$this->fpdf->Cell($k6,$tb, $namapegawai,1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb, '2',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb, 'NIP',1,0,'L',0);
	$this->fpdf->Cell($k3,$tb, $nip_penilai,1,0,'L',0);
	$this->fpdf->Cell($k4,$tb, '2',1,0,'C',0);
	$this->fpdf->Cell($k5,$tb, 'NIP',1,0,'L',0);
	$this->fpdf->Cell($k6,$tb, $nippegawai,1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb, '3',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb, 'Pangkat / Gol',1,0,'L',0);
	$this->fpdf->Cell($k3,$tb, $pangkat_golongan_penilai,1,0,'L',0);
	$this->fpdf->Cell($k4,$tb, '3',1,0,'C',0);
	$this->fpdf->Cell($k5,$tb, 'Pangkat / Gol',1,0,'L',0);
	$this->fpdf->Cell($k6,$tb, $pangkat1.', '.$gol1,1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb, '4',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb, 'Jabatan',1,0,'L',0);
	$this->fpdf->Cell($k3,$tb, $jabatan_penilai,1,0,'L',0);
	$this->fpdf->Cell($k4,$tb, '4',1,0,'C',0);
	$this->fpdf->Cell($k5,$tb, 'Jabatan',1,0,'L',0);
	$this->fpdf->Cell($k6,$tb, $jabatan1,1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb, '5',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb, 'Unit kerja',1,0,'L',0);
	$this->fpdf->Cell($k3,$tb, $unit_organisasi_penilai,1,0,'L',0);
	$this->fpdf->Cell($k4,$tb, '5',1,0,'C',0);
	$this->fpdf->Cell($k5,$tb, 'Unit kerja',1,0,'L',0);
	$this->fpdf->Cell($k6,$tb, $this->config->item('unit_kerja'),1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb1, 'NO',1,0,'C',0);
	$this->fpdf->Cell($k2+$k3,$tb1, 'I. KEGIATAN TUGAS JABATAN',1,0,'C',0);
	$this->fpdf->Cell($k4,$tb1, 'AK',1,0,'C',0);
	$this->fpdf->Cell($k5+$k6,$tb,'TARGET',1,2,'C',0);
	$yy = $this->fpdf->getY();
	$this->fpdf->SetX($x+$k1+$k2+$k3+$k4);
	$this->fpdf->Cell($k7,$tb,'KUANTITAS/',0,0,'C',0);
	$this->fpdf->Cell($k8,$tb,'KUALITAS/',0,0,'C',0);
	$this->fpdf->Cell($k9,$tb+$tb,'WAKTU',0,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'BIAYA',0,2,'C',0);
	$this->fpdf->SetX($x+$k1+$k2+$k3+$k4);
	$this->fpdf->Cell($k7,$tb,'OUTPUT',0,0,'C',0);
	$this->fpdf->Cell($k8,$tb,'MUTU',0,0,'C',0);
	$this->fpdf->Cell($k9,$tb+$tb,'',0,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'(Rp)',0,0,'C',0);
	$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4,$yy);
	$this->fpdf->Cell($k7,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k8,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k9,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb+$tb,'',1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'1',1,0,'C',0);
	$this->fpdf->Cell($k2+$k3,$tb,'2',1,0,'C',0);
	$this->fpdf->Cell($k4,$tb,'3',1,0,'C',0);
	$this->fpdf->Cell($k7,$tb,'4',1,0,'C',0);
	$this->fpdf->Cell($k8,$tb,'5',1,0,'C',0);
	$this->fpdf->Cell($k9,$tb,'6',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'7',1,2,'C',0);
	//unsur utama
	$jak_target = 0;
	$jskp = 0 ;
	$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' order by `nourut`");
	$nomor=1;
	$cacahe = 0;
	$this->fpdf->SetFont('Helvetica','',10);
	$cacahitem = $ta->num_rows();
	if($cacahitem >0)
	{
		foreach($ta->result() as $a)
		{
			$this->fpdf->SetX($x);
			$kegiatan = $a->kegiatan;
			if(($kegiatan == 'Unsur utama') or ($kegiatan == 'Unsur Penunjang Tugas Guru') or ($kegiatan == 'Unsur PKB'))
			{
				$this->fpdf->SetFont('Helvetica','B',10);
				$this->fpdf->Cell($k1,$tb2,'',1,0,'C',0);
				$yy = $this->fpdf->getY();
				$this->fpdf->Cell($k2+$k3,$tb2,$kegiatan,1,0,'L',0);
				$this->fpdf->Cell($k4,$tb2,'',1,0,'C',0);
				$this->fpdf->Cell($k11,$tb2,'',1,0,'C',0);
				$this->fpdf->Cell($k12,$tb2,'',1,0,'L',0);
				$this->fpdf->Cell($k8,$tb2,'',1,0,'C',0);
				$this->fpdf->Cell($k13,$tb2,'',1,0,'C',0);
				$this->fpdf->Cell($k14,$tb2,'',1,0,'L',0);
				$this->fpdf->Cell($k10,$tb2,'',1,2,'C',0);
				$cacahe++;
			}
			else
			{
				$this->fpdf->SetFont('Helvetica','',10);
				$yy = $this->fpdf->getY();
				$this->fpdf->SetXY($x,$yy);
				$tb3 = $tb2;
				$this->fpdf->Cell($k1,$tb3,$nomor,0,0,'C',0);
				$this->fpdf->SetXY($x+$k1,$yy);
				$unsur = '';
				$this->fpdf->MultiCell($k2+$k3,$tb3,$unsur.''.strip_tags($a->kegiatan),0,'L',0);
				$selisih = $this->fpdf->getY()-$yy;
				if($selisih>$tb3)
				{
					$tb3 = $selisih;
				}
				$this->fpdf->SetXY($x+$k1+$k2+$k3,$yy);
				$this->fpdf->MultiCell($k4,$tb3,round($a->ak_target,3),0,'C',0);
				$selisih2 = $this->fpdf->getY()-$yy;
				if($selisih2>$tb3)
				{
					$tb3 = $selisih2;
				}
				$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4,$yy);
				$this->fpdf->MultiCell($k11,$tb3,$a->kuantitas,0,'C',0);
				$selisih3 = $this->fpdf->GetY()-$yy;
				if($selisih3>$tb3)
				{
					$tb3 = $selisih3;
				}
				$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k11,$yy);
				$this->fpdf->MultiCell($k12,$tb2,$a->satuan,0,'L',0);
				$selisih4 = $this->fpdf->GetY()-$yy;
				if($selisih4>$tb3)
				{
					$tb3 = $selisih4;
				}
				$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k11+$k12,$yy);
				$this->fpdf->MultiCell($k8,$tb3,$a->kualitas,0,'C',0);
				$selisih5 = $this->fpdf->GetY()-$yy;
				if($selisih5>$tb3)
				{
					$tb3 = $selisih5;
				}
				$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k8,$yy);
				$this->fpdf->MultiCell($k13,$tb3,$a->waktu,0,'C',0);
				$selisih6 = $this->fpdf->GetY()-$yy;
				if($selisih6>$tb3)
				{
					$tb3 = $selisih6;
				}
				$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k8+$k13,$yy);
				$this->fpdf->MultiCell($k14,$tb3,'bulan',0,'L',0);
				$selisih7 = $this->fpdf->GetY()-$yy;
				if($selisih7>$tb3)
				{
					$tb3 = $selisih7;
				}
				$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k8+$k9,$yy);
				$this->fpdf->MultiCell($k10,$tb3,$a->biaya,0,'C',0); //oke
				$tb4 = $tb3;
				$this->fpdf->SetXY($x,$yy);
				$this->fpdf->Cell($k1,$tb4,'',1,0,'L',0);
				$this->fpdf->Cell($k2+$k3,$tb4,'',1,0,'L',0);
				$this->fpdf->Cell($k4,$tb4,'',1,0,'C',0);
				$this->fpdf->Cell($k11,$tb4,'',1,0,'L',0);
				$this->fpdf->Cell($k12,$tb4,'',1,0,'L',0);
				$this->fpdf->Cell($k8,$tb4,'',1,0,'C',0);
				$this->fpdf->Cell($k13,$tb4,'',1,0,'C',0);
				$this->fpdf->Cell($k14,$tb4,'',1,0,'C',0);
				$this->fpdf->Cell($k10,$tb4,'',1,2,'C',0);
				$tb3= $tb2;
				$nomor++;
				$cacahe++;
			}
			$ybatas = $this->fpdf->getY();
			if($ybatas>16)
			{
				if($cacahe != $cacahitem)
				{
					$this->fpdf->AddPage("L");
					$this->fpdf->SetXY($x,$y);
					$this->fpdf->Cell($k1,$tb1, 'NO',1,0,'C',0);
					$this->fpdf->Cell($k2+$k3,$tb1, 'I. KEGIATAN TUGAS JABATAN',1,0,'C',0);
					$this->fpdf->Cell($k4,$tb1, 'AK',1,0,'C',0);
					$this->fpdf->Cell($k5+$k6,$tb,'TARGET',1,2,'C',0);
					$yy = $this->fpdf->getY();
					$this->fpdf->SetX($x+$k1+$k2+$k3+$k4);
					$this->fpdf->Cell($k7,$tb,'KUANTITAS/',0,0,'C',0);
					$this->fpdf->Cell($k8,$tb,'KUALITAS/',0,0,'C',0);
					$this->fpdf->Cell($k9,$tb+$tb,'WAKTU',0,0,'C',0);
					$this->fpdf->Cell($k10,$tb,'BIAYA',0,2,'C',0);
					$this->fpdf->SetX($x+$k1+$k2+$k3+$k4);
					$this->fpdf->Cell($k7,$tb,'OUTPUT',0,0,'C',0);
					$this->fpdf->Cell($k8,$tb,'MUTU',0,0,'C',0);
					$this->fpdf->Cell($k9,$tb+$tb,'',0,0,'C',0);
					$this->fpdf->Cell($k10,$tb,'(Rp)',0,0,'C',0);
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4,$yy);
					$this->fpdf->Cell($k7,$tb+$tb,'',1,0,'C',0);
					$this->fpdf->Cell($k8,$tb+$tb,'',1,0,'C',0);
					$this->fpdf->Cell($k9,$tb+$tb,'',1,0,'C',0);
					$this->fpdf->Cell($k10,$tb+$tb,'',1,2,'C',0);
					$this->fpdf->SetX($x);
					$this->fpdf->Cell($k1,$tb,'1',1,0,'C',0);
					$this->fpdf->Cell($k2+$k3,$tb,'2',1,0,'C',0);
					$this->fpdf->Cell($k4,$tb,'3',1,0,'C',0);
					$this->fpdf->Cell($k7,$tb,'4',1,0,'C',0);
					$this->fpdf->Cell($k8,$tb,'5',1,0,'C',0);
					$this->fpdf->Cell($k9,$tb,'6',1,0,'C',0);
					$this->fpdf->Cell($k10,$tb,'7',1,2,'C',0);
				}
			}

		$jskp = $jskp + $a->capaian_skp;
		} // foreach
	}
	$this->fpdf->SetFont('Helvetica','',10);
	$tglcetak = date_to_long_string($tskp);
	$this->fpdf->SetX($x+3);
	//	$this->fpdf->Cell(6,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,$this->config->item('lokasi').', '.$tglcetak,0,2,'L',0);
	$this->fpdf->SetX($x+3);
	$this->fpdf->Cell(6,$tb,'Pejabat Penilai',0,0,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,'Pegawai Negeri Sipil yang Dinilai',0,0,'L',0);
	$this->fpdf->Cell(6,$tb+$tb+$tb,'',0,2,'L',0);
	$this->fpdf->SetX($x+3);
	$this->fpdf->Cell(6,$tb,$nama_penilai,0,0,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,$namapegawai,0,2,'L',0);
	$this->fpdf->SetX($x+3);
	$this->fpdf->Cell(6,$tb,'NIP '.$nip_penilai,0,0,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,'NIP '.$nippegawai,0,2,'L',0);
	// borang

	//penilaian
	$x = 3.5;
	$cari_os = cari_os();
	if($cari_os == 'Windows')
	{
		$x = 2;
	}	
	$y = 1;
	$tb = 0.5;
	$tb2 = 0.4;
	$tb1 = 1.5;
	$k1 = 0.8;
	$k2 = 10;
	$k3 = 1.3;
	$k4 = 0.5;
	$k5 = 2.5;
	$k6 = 1.2;
	$k7 = 1;
	$k8 = 1;
	$k9 = 1;
	$k10 = 1.5;
	$k11 = 1.5;
	$lebar = $k1 + $k2 + $k3 + $k4 + $k5 + $k6 + $k7 + $k8 + $k9 +$k3 + $k4 + $k5 + $k6 + $k7 + $k8 + $k9 + $k10+$k11;

//januari 2014 itu 2013/2014 semester 2
//2014 JADI 2013/2014 SMT 2
$awal = $tahunpenilaian - 1 ;
$akhir = $tahunpenilaian;
$thnajaran = $awal."/".$akhir;
$semester = 2;
$gol1 = id_sk_jadi_golongan($idskawal) ;
$pangkat1 = golongan_jadi_pangkat($gol1);
$jabatan1 = golongan_jadi_jabatan($gol1);
$gol2 = id_sk_jadi_golongan($idskakhir) ;
$pangkat2 = golongan_jadi_pangkat($gol2);
$jabatan2 = golongan_jadi_jabatan($gol2);
	$tambahan = '';
	$adatambahan = 0;
	$tsk = $this->db->query("SELECT * FROM `p_tugas_tambahan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	foreach($tsk->result() as $dsk)
	{
		$tambahan = $dsk->nama_tugas;
	}
	if ((substr($tambahan,0,10)=='Kepala Mad') or (substr($tambahan,0,10)=='Kepala Sek'))
	{
		$adatambahan = 1;
	}
	$tahunsekarang = $tahunpenilaian;
	$nama_penilai = '';
	$nip_penilai = '';
	$pangkat_golongan_penilai = '';
	$jabatan_penilai = '';
	$unit_organisasi_penilai = '';
	$nama_atasan_penilai = '';
	$nip_atasan_penilai = '';
	$pangkat_golongan_atasan_penilai = '';
	$jabatan_atasan_penilai = '';
	$unit_organisasi_atasan_penilai = '';
	if ($adatambahan ==0)
	{
	$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahunsekarang' and dinilai='guru'");
	}
	if ($adatambahan ==1)
	{
	$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahunsekarang' and dinilai='kepala'");
	}
	foreach($ta->result() as $a)
	{
		$nama_penilai = $a->nama_penilai;
		$nip_penilai = $a->nip_penilai;
		$pangkat_golongan_penilai = $a->pangkat_golongan;
		$jabatan_penilai = $a->jabatan;
		$unit_organisasi_penilai = $a->unit_organisasi;
		$nama_atasan_penilai = $a->nama_atasan;
		$nip_atasan_penilai = $a->nip_atasan;
		$pangkat_golongan_atasan_penilai = $a->pangkat_golongan_atasan;
		$jabatan_atasan_penilai = $a->jabatan_atasan;
		$unit_organisasi_atasan_penilai = $a->unit_organisasi_atasan;
	}
	$namasekolah = $this->config->item('sek_nama');
	$teleponsekolah = $this->config->item('sek_telepon');
	$desa = $this->config->item('sek_desa');
	$kec = $this->config->item('sek_kec');
	$kab = $this->config->item('sek_kab');
	$prov = $this->config->item('sek_prov');
	$this->fpdf->AddPage("L");
	$this->fpdf->SetXY($x,$y+$tambah);
	$this->fpdf->SetFont('Helvetica','',9);
	$this->fpdf->Cell($lebar,$tb,'PENILAIAN SASARAN KERJA PEGAWAI',0,2,'C',0);
	$this->fpdf->Cell(8,$tb,'Jangka waktu penilaian '.date_to_long_string($t1).' s.d. '.date_to_long_string($t2),0,0,'L',0);
	$this->fpdf->Cell(21,$tb,'PNS yang dinilai, Nama: '.$namapegawai.'   NIP '.$nip,0,2,'R',0);

	$this->fpdf->SetX($x);
	$yy1 = $this->fpdf->getY();
	$this->fpdf->Cell($k1,$tb1, 'NO',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb1, 'I. KEGIATAN TUGAS JABATAN',1,0,'C',0);
	$this->fpdf->Cell($k3,$tb1, 'AK',1,0,'C',0);
	$this->fpdf->Cell($k4+$k5+$k6+$k7+$k8+$k9,$tb,'TARGET',1,0,'C',0);
	$this->fpdf->Cell($k3,$tb1, 'AK',1,0,'C',0);
	$this->fpdf->Cell($k4+$k5+$k6+$k7+$k8+$k9,$tb,'REALISASI',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'PENG',0,0,'C',0);
	$this->fpdf->Cell($k11,$tb,'NILAI',0,2,'C',0);
	$yy = $this->fpdf->getY();
	$this->fpdf->SetX($x+$k1+$k2+$k3);
	$this->fpdf->Cell($k4+$k5,$tb,'KUANT/',0,0,'C',0);
	$this->fpdf->Cell($k6,$tb,'KUAL/',0,0,'C',0);
	$this->fpdf->Cell($k7+$k8,$tb+$tb,'WAKTU',0,0,'C',0);
	$this->fpdf->Cell($k9,$tb,'BIAYA',0,0,'C',0);
	$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3);
	$this->fpdf->Cell($k4+$k5,$tb,'KUANT/',0,0,'C',0);
	$this->fpdf->Cell($k6,$tb,'KUAL/',0,0,'C',0);
	$this->fpdf->Cell($k7+$k8,$tb+$tb,'WAKTU',0,0,'C',0);
	$this->fpdf->Cell($k9,$tb,'BIAYA',0,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'HITUNG',0,0,'C',0);
	$this->fpdf->Cell($k11,$tb,'CAPAIAN',0,2,'C',0);
	$this->fpdf->SetX($x+$k1+$k2+$k3);
	$this->fpdf->Cell($k4+$k5,$tb,'OUTPUT',0,0,'C',0);
	$this->fpdf->Cell($k6,$tb,'MUTU',0,0,'C',0);
	$this->fpdf->Cell($k8+$k7,$tb+$tb,'',0,0,'C',0);
	$this->fpdf->Cell($k9,$tb,'(Rp)',0,0,'C',0);
	$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3);
	$this->fpdf->Cell($k4+$k5,$tb,'OUTPUT',0,0,'C',0);
	$this->fpdf->Cell($k6,$tb,'MUTU',0,0,'C',0);
	$this->fpdf->Cell($k8+$k7,$tb+$tb,'',0,0,'C',0);
	$this->fpdf->Cell($k9,$tb,'(Rp)',0,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'AN',0,0,'C',0);
	$this->fpdf->Cell($k11,$tb,'SKP',0,2,'C',0);
	$this->fpdf->SetXY($x+$k1+$k2+$k3,$yy);
	$this->fpdf->Cell($k4+$k5,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k6,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k8+$k7,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k9,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3);
	$this->fpdf->Cell($k4+$k5,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k6,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k8+$k7,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k4+$k5+$k6+$k7+$k8+$k9+$k3,$yy1);
	$this->fpdf->Cell($k10,$tb1,'',1,0,'C',0);
	$this->fpdf->Cell($k11,$tb1,'',1,2,'C',0);

/*
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'1',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb,'2',1,0,'C',0);
	$this->fpdf->Cell($k3,$tb,'3',1,0,'C',0);
	$this->fpdf->Cell($k4,$tb,'4',1,0,'C',0);
	$this->fpdf->Cell($k5,$tb,'5',1,0,'C',0);
	$this->fpdf->Cell($k6,$tb,'6',1,0,'C',0);
	$this->fpdf->Cell($k7,$tb,'7',1,2,'C',0);
*/
	//unsur utama
	$jak_target = 0;
	$jak_realisasi = 0;
	$jskp = 0 ;
	$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nip' order by nourut");
	$nomor=1;
	$this->fpdf->SetFont('Helvetica','',9);
	if(count($ta->result())>0)
	{
		foreach($ta->result() as $a)
		{
			$id_skp_skor_guru_revisi = $a->id_skp_skor_guru;
			$this->fpdf->SetX($x);
			$kegiatan = $a->kegiatan;
			if(($kegiatan == 'Unsur utama') or ($kegiatan == 'Unsur Penunjang Tugas Guru') or ($kegiatan == 'Unsur PKB'))
			{
				$this->fpdf->Cell($k1,$tb2,'',0,0,'C',0);
				$tb3 = $tb2;
				$yy = $this->fpdf->getY();
				$this->fpdf->MultiCell($k2,$tb3,$kegiatan,0,'L',0);
			}
			else
			{
				$td = $this->db->query("SELECT * FROM `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` ='$id_skp_skor_guru_revisi' and `nip`='$nip'");
				$adatd = $td->num_rows();
				foreach($td->result() as $d)
				{
					$rkuantitas = $d->kuantitas;
					$rkualitas = $d->kualitas;
					$rwaktu = $d->waktu;
					$rbiaya = $d->biaya;
				}
					$this->fpdf->Cell($k1,$tb2,$nomor,0,0,'C',0);
					$tb3 = $tb2;
					$yy = $this->fpdf->getY();
					$this->fpdf->MultiCell($k2,$tb3,$kegiatan,0,'L',0);
					$nomor++;
					$selisih = $this->fpdf->getY()-$yy;
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2,$yy);
					$this->fpdf->MultiCell($k3,$tb3,round($a->ak_target,3),0,'C',0);
					$selisih = $this->fpdf->getY()-$yy;
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3,$yy);
					if($adatd>0)
					{
						$this->fpdf->MultiCell($k4,$tb2,$a->kuantitas.' '.$rkuantitas,0,'C',0);
						$this->fpdf->SetXY($x+$k1+$k2+$k3,$yy);
						$this->fpdf->Cell($k4,$tb2,'---',0,2,'C',0);

					}
					else
					{
						$this->fpdf->MultiCell($k4,$tb3,$a->kuantitas,0,'C',0);
					}

					$selisih = $this->fpdf->getY()-$yy;
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4,$yy);
					$this->fpdf->MultiCell($k5,$tb2,$a->satuan,0,'L',0);
					$selisih = $this->fpdf->getY()-$yy;
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5,$yy);
					if($adatd>0)
					{
						$this->fpdf->MultiCell($k6,$tb2,$a->kualitas.' '.$rkualitas,0,'C',0);
						$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5,$yy);
						$this->fpdf->Cell($k6,$tb2,'--------',0,2,'C',0);

					}
					else
					{
						$this->fpdf->MultiCell($k6,$tb3,$a->kualitas,0,'C',0);
					}


					$selisih = $this->fpdf->getY()-$yy;
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6,$yy);
					if($adatd>0)
					{
						$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6,$yy);
						$this->fpdf->Cell($k7,$tb2,'------',0,2,'C',0);
						$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6,$yy);
						$pwaktu = $a->waktu.''.$rwaktu;
						if(strlen($pwaktu) < 3)
						{
							$this->fpdf->MultiCell($k7,$tb2,'   '.$a->waktu.'    '.$rwaktu,0,'C',0);
						}
						else
						{
							$this->fpdf->MultiCell($k7,$tb2,'  '.$a->waktu.'   '.$rwaktu,0,'C',0);
						}


					}
					else
					{
						$this->fpdf->MultiCell($k7,$tb3,$a->waktu,0,'C',0);

					}
					$selisih = $this->fpdf->getY()-$yy;
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7,$yy);
					if($adatd>0)
					{
						if(($a->satuanwaktu == 'Bl') or ($a->satuanwaktu == 'bl'))
						{
							$this->fpdf->MultiCell($k8,$tb2,'bulan',0,'L',0);
						}
						else
						{
							$this->fpdf->MultiCell($k8,$tb2,'hari',0,'L',0);
						}

					}
					else
					{
						if(($a->satuanwaktu == 'Bl') or ($a->satuanwaktu == 'bl'))
						{
							$this->fpdf->MultiCell($k8,$tb3,'bulan',0,'L',0);
						}
						else
						{
							$this->fpdf->MultiCell($k8,$tb3,'hari',0,'L',0);
						}

					}

					$selisih = $this->fpdf->getY()-$yy;
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8,$yy);
					if($a->biaya>0)
					{
						$this->fpdf->SetFont('Helvetica','',4);
					}
					if($adatd>0)
					{
						$this->fpdf->MultiCell($k9,$tb2,$a->biaya,0,'C',0);
					}
					else
					{
	
						$this->fpdf->MultiCell($k9,$tb3,$a->biaya,0,'C',0);
					}
					$this->fpdf->SetFont('Helvetica','',9);
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$yy);
					if($adatd>0)
					{
						$this->fpdf->MultiCell($k3,$tb2,round($a->ak_r,3),0,'C',0);
					}
					else
					{
						$this->fpdf->MultiCell($k3,$tb3,round($a->ak_r,3),0,'C',0);
					}


					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3,$yy);

					$this->fpdf->MultiCell($k4,$tb3,$a->kuantitas_r,0,'C',0);
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4,$yy);
					$this->fpdf->MultiCell($k5,$tb2,$a->satuan,0,'L',0);
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5,$yy);
					$this->fpdf->MultiCell($k6,$tb3,$a->kualitas_r,0,'C',0);
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6,$yy);
					$this->fpdf->MultiCell($k7,$tb3,$a->waktu_r,0,'C',0);
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7,$yy);
if($adatd>0)
					{
						if(($a->satuanwaktu == 'Bl') or ($a->satuanwaktu == 'bl'))
						{
							$this->fpdf->MultiCell($k8,$tb2,'bulan',0,'L',0);
						}
						else
						{
							$this->fpdf->MultiCell($k8,$tb2,'hari',0,'L',0);
						}

					}
					else
					{
						if(($a->satuanwaktu == 'Bl') or ($a->satuanwaktu == 'bl'))
						{
							$this->fpdf->MultiCell($k8,$tb3,'bulan',0,'L',0);
						}
						else
						{
							$this->fpdf->MultiCell($k8,$tb3,'hari',0,'L',0);
						}

					}
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8,$yy);
					if($a->biaya_r>0)
					{
						$this->fpdf->SetFont('Helvetica','',4);
					}
					$this->fpdf->MultiCell($k9,$tb3,$a->biaya_r,0,'C',0);
					$this->fpdf->SetFont('Helvetica','',9);
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$yy);
					$this->fpdf->MultiCell($k10,$tb3,$a->perhitungan,0,'C',0);
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
					$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k10,$yy);
					$this->fpdf->MultiCell($k11,$tb3,$a->capaian_skp,0,'C',0);
					if($selisih>$tb3)
					{
						$tb3 = $selisih;
					}
			}
				$this->fpdf->SetXY($x,$yy);
				$this->fpdf->Cell($k1,$tb3,'',1,0,'L',0);
				$this->fpdf->Cell($k2,$tb3,'',1,0,'L',0);
				$this->fpdf->Cell($k3,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k4,$tb3,'',1,0,'L',0);
				$this->fpdf->Cell($k5,$tb3,'',1,0,'L',0);
				$this->fpdf->Cell($k6,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k7,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k8,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k9,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k3,$tb3,'',1,0,'L',0);
				$this->fpdf->Cell($k4,$tb3,'',1,0,'L',0);
				$this->fpdf->Cell($k5,$tb3,'',1,0,'L',0);
				$this->fpdf->Cell($k6,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k7,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k8,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k9,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k10,$tb3,'',1,0,'C',0);
				$this->fpdf->Cell($k11,$tb3,'',1,2,'C',0);
				$tb3 = $tb2;
				$jskp = $jskp + $a->capaian_skp;
				$jak_target = $jak_target + $a->ak_target;
				$jak_realisasi = $jak_realisasi + $a->ak_r;
				$ybatas = $this->fpdf->getY();
			if($ybatas>15)
				{
				$this->fpdf->AddPage("L");
				$this->fpdf->SetXY($x,$y);
				$this->fpdf->SetXY($x,$y);
				$this->fpdf->SetFont('Helvetica','',9);
				$this->fpdf->Cell($lebar,$tb,'PENILAIAN SASARAN KERJA PEGAWAI',0,2,'C',0);
				$this->fpdf->Cell(10,$tb,'Jangka waktu '.date_to_long_string($t1).' s.d. '.date_to_long_string($t2),0,0,'L',0);
				$this->fpdf->Cell(21,$tb,'PNS yang dinilai, Nama: '.$namapegawai.'   NIP '.$nippegawai,0,2,'R',0);

				$this->fpdf->SetX($x);
				$yy1 = $this->fpdf->getY();
				$this->fpdf->Cell($k1,$tb1, 'NO',1,0,'C',0);
				$this->fpdf->Cell($k2,$tb1, 'I. KEGIATAN TUGAS JABATAN',1,0,'C',0);
				$this->fpdf->Cell($k3,$tb1, 'AK',1,0,'C',0);
				$this->fpdf->Cell($k4+$k5+$k6+$k7+$k8+$k9,$tb,'TARGET',1,0,'C',0);
				$this->fpdf->Cell($k3,$tb1, 'AK',1,0,'C',0);
				$this->fpdf->Cell($k4+$k5+$k6+$k7+$k8+$k9,$tb,'REALISASI',1,0,'C',0);
				$this->fpdf->Cell($k10,$tb,'PENG',0,0,'C',0);
				$this->fpdf->Cell($k11,$tb,'NILAI',0,2,'C',0);
				$yy = $this->fpdf->getY();
				$this->fpdf->SetX($x+$k1+$k2+$k3);
				$this->fpdf->Cell($k4+$k5,$tb,'KUANT/',0,0,'C',0);
				$this->fpdf->Cell($k6,$tb,'KUAL/',0,0,'C',0);
				$this->fpdf->Cell($k7+$k8,$tb+$tb,'WAKTU',0,0,'C',0);
				$this->fpdf->Cell($k9,$tb,'BIAYA',0,0,'C',0);
				$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3);
				$this->fpdf->Cell($k4+$k5,$tb,'KUANT/',0,0,'C',0);
				$this->fpdf->Cell($k6,$tb,'KUAL/',0,0,'C',0);
				$this->fpdf->Cell($k7+$k8,$tb+$tb,'WAKTU',0,0,'C',0);
				$this->fpdf->Cell($k9,$tb,'BIAYA',0,0,'C',0);
				$this->fpdf->Cell($k10,$tb,'HITUNG',0,0,'C',0);
				$this->fpdf->Cell($k11,$tb,'CAPAIAN',0,2,'C',0);
				$this->fpdf->SetX($x+$k1+$k2+$k3);
				$this->fpdf->Cell($k4+$k5,$tb,'OUTPUT',0,0,'C',0);
				$this->fpdf->Cell($k6,$tb,'MUTU',0,0,'C',0);
				$this->fpdf->Cell($k8+$k7,$tb+$tb,'',0,0,'C',0);
				$this->fpdf->Cell($k9,$tb,'(Rp)',0,0,'C',0);
				$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3);
				$this->fpdf->Cell($k4+$k5,$tb,'OUTPUT',0,0,'C',0);
				$this->fpdf->Cell($k6,$tb,'MUTU',0,0,'C',0);
				$this->fpdf->Cell($k8+$k7,$tb+$tb,'',0,0,'C',0);
				$this->fpdf->Cell($k9,$tb,'(Rp)',0,0,'C',0);
				$this->fpdf->Cell($k10,$tb,'AN',0,0,'C',0);
				$this->fpdf->Cell($k11,$tb,'SKP',0,2,'C',0);
				$this->fpdf->SetXY($x+$k1+$k2+$k3,$yy);
				$this->fpdf->Cell($k4+$k5,$tb+$tb,'',1,0,'C',0);
				$this->fpdf->Cell($k6,$tb+$tb,'',1,0,'C',0);
				$this->fpdf->Cell($k8+$k7,$tb+$tb,'',1,0,'C',0);
				$this->fpdf->Cell($k9,$tb+$tb,'',1,0,'C',0);
				$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3);
				$this->fpdf->Cell($k4+$k5,$tb+$tb,'',1,0,'C',0);
				$this->fpdf->Cell($k6,$tb+$tb,'',1,0,'C',0);
				$this->fpdf->Cell($k8+$k7,$tb+$tb,'',1,0,'C',0);
				$this->fpdf->SetXY($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k4+$k5+$k6+$k7+$k8+$k9+$k3,$yy1);
				$this->fpdf->Cell($k10,$tb1,'',1,0,'C',0);
				$this->fpdf->Cell($k11,$tb1,'',1,2,'C',0);
				}
		}
	}
	$nomor = $nomor - 1;
	if ($nomor == 0)
		{
		$jskp = 'Galat';
		}
		else
		{$jskp = $jskp / $nomor;
		}
	if ($jskp>= 91)
		{
		$predikat='Sangat baik';
		}

	if ($jskp< 91)
		{
		$predikat='Baik';
		}

	if ($jskp<= 75)
		{
		$predikat='BURUK';
		}
	$hasilskp = round($jskp,3);
	$jskp1 = $jskp;
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1+$k2,$tb,'Jumlah',1,0,'C',0);
	$this->fpdf->Cell($k3,$tb,$jak_target,1,0,'C',0);
	$this->fpdf->Cell($k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k3,$tb,$jak_realisasi,1,0,'C',0);
	$this->fpdf->Cell($k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k11,$tb,'',1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb,'II. Tugas Tambahan dan Kreatifitas',1,0,'L',0);
	$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'',1,0,'L',0);
	$this->fpdf->Cell($k11,$tb,'',1,2,'L',0);
/*
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb,'a. Tugas Tambahan',1,0,'L',0);
	$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'',1,0,'L',0);
	$this->fpdf->Cell($k11,$tb,'',1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb,'1.',1,0,'L',0);
	$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'',1,0,'L',0);
	$this->fpdf->Cell($k11,$tb,'',1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb,'2.',1,0,'L',0);
	$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'',1,0,'L',0);
	$this->fpdf->Cell($k11,$tb,'',1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb,'3.',1,0,'L',0);
	$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'',1,0,'L',0);
	$this->fpdf->Cell($k11,$tb,'',1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb,'b. Kreatifitas',1,0,'L',0);
	$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'',1,0,'L',0);
	$this->fpdf->Cell($k11,$tb,'',1,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k2,$tb,'1. ',1,0,'L',0);
	$this->fpdf->Cell($k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k10,$tb,'',1,0,'L',0);
	$this->fpdf->Cell($k11,$tb,'',1,2,'L',0);
*/
	$ybatas = $this->fpdf->getY();
	if($ybatas>15)
		{
		$this->fpdf->AddPage("L");
		}
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tb+$tb,'',1,0,'C',0);
	$this->fpdf->Cell($k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9,$tb+$tb,'Nilai Capaian SKP',1,0,'C',0);
	$this->fpdf->Cell($k11+$k10,$tb,$hasilskp,1,2,'C',0);
	$this->fpdf->SetX($x+$k1+$k2+$k3+$k4+$k5+$k6+$k7+$k8+$k9+$k3+$k4+$k5+$k6+$k7+$k8+$k9);
	$this->fpdf->Cell($k11+$k10,$tb,$predikat,1,2,'C',0);

/*
echo '<tr bgcolor="#FFF"><td></td><td colspan="11"><strong></td><td></td><td></td></tr>';
echo '<tr bgcolor="#FFF"><td></td><td colspan="11"><strong>a. Tugas Tambahan</td><td></td><td></td></tr>';
echo '<tr bgcolor="#FFF"><td></td><td colspan="11">1.<br />2.<br />3.<br />4.<br />5.<br /></td><td></td><td></td></tr>';
echo '<tr bgcolor="#FFF"><td></td><td colspan="11"><strong>b. Kreatifitas</td><td></td><td></td></tr>';
echo '<tr bgcolor="#FFF"><td></td><td colspan="11"><strong>II. Tugas Tambahan dan Kreatifitas</td><td></td><td></td></tr>';
echo '<tr bgcolor="#FFF"><td></td><td colspan="11">1.<br />2.<br /></td><td></td><td></td></tr>';
*/
	$this->fpdf->Cell(10,$tb2,'',0,2,'L',0);
	$tglcetak = date_to_long_string($tpenilaian);
	$this->fpdf->SetX($x+20);
	if($adatambahan == 1)
	{
		$this->fpdf->Cell(10,$tb,'Semarang, '.$tglcetak,0,2,'L',0);
	}
	else
	{
		$this->fpdf->Cell(10,$tb,$this->config->item('lokasi').', '.$tglcetak,0,2,'L',0);
	}
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,'Pejabat Penilai',0,0,'L',0);
	$this->fpdf->Cell(6,$tb+$tb+$tb,'',0,2,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,$nama_penilai,0,2,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,'NIP '.$nip_penilai,0,2,'L',0);

	// penilaian

	// perilaku
	$x = 2;
	$x2 = $x+2;
	$y = 2;
	$x1 = 2;
	$tinggi = 0.8;
	$tinggi2 = 1.6;
	$tinggi3 = 6;
	$td = $this->db->query("select * from `perilaku_pns` where tahun = '$tahunpenilaian' and `nip` = '$nip' order by bulan");
	$pelayanan = 0;
	$komitmen = 0;
	$integritas = 0;
	$disiplin = 0;
	$kerjasama = 0;
	$kepemimpinan = 0;
	$jabatan_penilai_perilaku = '';
	$nama_penilai_perilaku = '';
	$nip_penilai_perilaku = '';

	foreach($td->result() as $d)
	{
		$pelayanan = $pelayanan + $d->pelayanan;
		$komitmen = $komitmen + $d->komitmen;
		$integritas = $integritas + $d->integritas;
		$disiplin = $disiplin + $d->disiplin;
		$kerjasama = $kerjasama + $d->kerjasama;
		$kepemimpinan = $kepemimpinan + $d->kepemimpinan;
		$jabatan_penilai_perilaku = $d->jabatan_penilai;
		$nama_penilai_perilaku = $d->nama_penilai;
		$nip_penilai_perilaku = $d->nip_penilai;
	}
	if((empty($hasil_skp)) or ($hasil_skp == 0))
	{
		$hasil_skp = '-';
	}
	$pelayanan = round($pelayanan / 12,2);
	$komitmen = round($komitmen / 12,2);
	$integritas = round($integritas / 12,2);
	$disiplin = round($disiplin / 12,2);
	$kerjasama = round($kerjasama / 12,2);
	$kepemimpinan = round($kepemimpinan / 12,2);
	$jumlahperilaku = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama;
	$rataperilaku = round($jumlahperilaku / 5,2);
	$this->fpdf->AliasNbPages();
	// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
	$this->fpdf->AddPage("P");
	$this->fpdf->SetXY($x,$y);
	$this->fpdf->setFont('Times','',16);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'BUKU CATATAN PERILAKU PEGAWAI NEGERI SIPIL',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Times','',10);
	$this->fpdf->cell(6,$tinggi,'Nama',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi,': '.cari_nama_pegawai($kodeguru),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(6,$tinggi,'NIP',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi,': '.cari_nip_pegawai($kodeguru),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(6,$tinggi,'Unit organisasi',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi,': '.$this->config->item('sek_nama'),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(6,$tinggi,'',0,2,'L',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetX($x);
	$this->fpdf->cell(1,$tinggi2,'No',1,0,'C',0);
	$this->fpdf->cell(4,$tinggi2,'Tanggal',1,0,'C',0);
	$this->fpdf->cell(7,$tinggi2,'Uraian',1,0,'C',0);
	$this->fpdf->cell(6,$tinggi,'Nama/NIP dan',0,2,'C',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->cell(6,$tinggi,'Paraf Pejabat Penilai',0,2,'C',0);
	$this->fpdf->SetXY($x+12,$y1);
	$this->fpdf->cell(6,$tinggi2,'',1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(1,$tinggi,'1',1,0,'C',0);
	$this->fpdf->cell(4,$tinggi,'2',1,0,'C',0);
	$this->fpdf->cell(7,$tinggi,'3',1,0,'C',0);
	$this->fpdf->cell(6,$tinggi,'4',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$tanggalawal = date_to_long_string($t1);
	$tanggalakhir = date_to_long_string($t2);

	$this->fpdf->cell(1,$tinggi,'1',0,0,'C',0);
	$this->fpdf->cell(4,$tinggi,$tanggalawal,0,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(4,$tinggi,'s.d.',0,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(4,$tinggi,$tanggalakhir,0,2,'C',0);
	$this->fpdf->SetXY($x+5,$y1);
	$t = 0.6;
	$this->fpdf->SetX($x+5);
	$this->fpdf->MultiCell(7,$t,'Penilaian SKP sampai dengan akhir Desember '.$tahunpenilaian.' = '.$hasil_skp,0,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->MultiCell(7,$t,'Penilaian perilaku kerja sebagai berikut:',0,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Orientasi Pelayanan',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$pelayanan.' '.predikat_perilaku($pelayanan),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Integritas ',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$integritas.' '.predikat_perilaku($integritas),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Komitmen',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$komitmen.' '.predikat_perilaku($komitmen),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Disiplin ',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$disiplin.' '.predikat_perilaku($disiplin),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Kerjasama',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$kerjasama.' '.predikat_perilaku($kerjasama),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Jumlah ',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$jumlahperilaku,0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Nilai rata - rata',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$rataperilaku.' '.predikat_perilaku($rataperilaku),0,2,'L',0);
	$this->fpdf->SetXY($x+12,$y1);
	$this->fpdf->Cell(6,$t,'',0,2,'C',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->Cell(6,$t,$jabatan_penilai_perilaku,0,2,'C',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->Cell(6,2,'',0,2,'C',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->Cell(6,$t,$nama_penilai_perilaku,0,2,'C',0);
	if (!empty($d->nip_penilai))
	{
		$this->fpdf->SetX($x+12);
		$this->fpdf->Cell(6,$t,'NIP '.$nip_penilai_perilaku,0,2,'C',0);
	}
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$tinggi3,'',1,0,'C',0);
	$this->fpdf->cell(4,$tinggi3,'',1,0,'C',0);
	$this->fpdf->cell(7,$tinggi3,'',1,0,'C',0);
	$this->fpdf->cell(6,$tinggi3,'',1,2,'C',0);

	$this->fpdf->SetXY($x,30);
	$this->fpdf->cell(18,$tinggi,strtoupper($this->config->item('unit_kerja')),0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,$tinggi,'TAHUN '.$tahunpenilaian,0,2,'C',0);

	// perilaku

	// ppk
	$x = 2;
	$x2 = $x+1;
	$y = 7;
	$x1 = 2;
	$tinggi = 0.5;
	$tinggi2 = 0.7;
	$tinggi3 = 1;
	$tinggi4 = 0.5;
	$tahun = $tahunpenilaian ;
	$awal = $tahunpenilaian ;
	$akhir = $tahunpenilaian + 1;
	$thnajaran = $awal."/".$akhir;
	$semester = 1;
	$id_sk = '?';
	$tkepeg = $this->db->query("select * from `p_tugas_tambahan` where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	$adatambahan = 0;
	$tambahan = '';
	foreach($tkepeg->result() as $dkepeg)
	{
		$tambahan = $dkepeg->nama_tugas;
	}
	$nama_penilai = '';
	$nip_penilai = '';
	$pangkat_golongan_penilai = '';
	$jabatan_penilai = '';
	$unit_organisasi_penilai = '';
	$nama_atasan_penilai = '';
	$nip_atasan_penilai = '';
	$pangkat_golongan_atasan_penilai = '';
	$jabatan_atasan_penilai = '';
	$unit_organisasi_atasan_penilai = '';
	$golongan = id_sk_jadi_golongan($idskakhir) ;
	$pangkat = golongan_jadi_pangkat($golongan);
	$jabatan = golongan_jadi_jabatan($golongan);
	if ((substr($tambahan,0,10)=='Kepala Mad') or (substr($tambahan,0,10)=='Kepala Sek'))
	{
		$adatambahan = 1;
	}
	if ($adatambahan ==0)
	{
		$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahun' and dinilai='guru'");
	}
	if ($adatambahan ==1)
	{
		$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahun' and dinilai='kepala'");
	}
	foreach($ta->result() as $a)
	{
		$nama_penilai = $a->nama_penilai;
		$nip_penilai = $a->nip_penilai;
		$pangkat_golongan_penilai = $a->pangkat_golongan;
		$jabatan_penilai = $a->jabatan;
		$unit_organisasi_penilai = $a->unit_organisasi;
		$nama_atasan_penilai = $a->nama_atasan;
		$nip_atasan_penilai = $a->nip_atasan;
		$pangkat_golongan_atasan_penilai = $a->pangkat_golongan_atasan;
		$jabatan_atasan_penilai = $a->jabatan_atasan;
		$unit_organisasi_atasan_penilai = $a->unit_organisasi_atasan;
	}
	$bisa = 0;
	$bisa2 = 0;
	$bisa1= 0;
	$pesan = '';
	if (empty($id_sk))
	{
		$pesan .= ' sk per semester belum ada (id sk kosong)';
	}
	if (!empty($id_sk))
	{
		$pesan = '';
		$bisa1 = 1;
	}
	if (empty($golongan))
	{
		$pesan .= ' golongan tidak terdefinisi (kosong)';
		$bisa2 = 0;
	}
	if (!empty($id_sk))
	{
		$pesan = '';
		$bisa2 = 1;
	}

	// cari golongan dulu
	//$golongan = trim(golongan($kode,$thnajaran,$semester));
	if (($golongan=='III/a') or ($golongan=='III/b') or ($golongan=='III/c') or ($golongan=='III/d') or ($golongan=='IV/a') or ($golongan=='IV/b') or ($golongan=='IV/c') or ($golongan=='IV/d'))
	{
		$bisa = 1;
		$pesan = '';
	}
	else
	{
		$pesan .= 'Golongan '.$golongan.' (id_sk awal '.$idskawal.' akhir '.$idskakhir.'  tidak sesuai dengan aplikasi';
$bisa = 0;
	}
	$bulanawal = substr($tawal,5,2);
	$bulanakhir = substr($takhir,5,2);
	if($adatambahan == 1)
	{
		$jppk = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama;//+ $kepemimpinan;
		$rppk = $jppk / 5;
	}
	else
	{
		$jppk = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama;
		$rppk = $jppk / 5;
	}
	$jskp = $skp * 0.6;
	$this->fpdf->AddPage("P");
	$xxx = 9.5;
	$yyy = 2;
	$this->fpdf->Image('images/garuda_pancasila.jpg',$xxx,$yyy,2.5,2.5);
	$this->fpdf->SetXY($x,5);
	$this->fpdf->setFont('Times','',10);
	$this->fpdf->cell(18,$tinggi,'PENILAIAN PRESTASI KERJA',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'PEGAWAI NEGERI SIPIL',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(10,$tinggi,$this->config->item('sek_nama'),0,0,'L',0);
	$this->fpdf->cell(10,$tinggi,'JANGKA WAKTU PENILAIAN',0,2,'L',0);
	$this->fpdf->cell(10,$tinggi,date_to_long_string($t1).' s.d. '.date_to_long_string($t2),0,2,'L',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetX($x);
	$this->fpdf->cell(1,$tinggi2,'1',0,0,'C',0);
	$this->fpdf->cell(17,$tinggi2,'YANG DINILAI',1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'a. Nama',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$namapegawai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'b. NIP',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$nippegawai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'c. Pangkat, Golongan ruang',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$pangkat.', '.$golongan,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'d. Jabatan / Pekerjaan',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$jabatan,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'e. Unit Organisasi',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$this->config->item('sek_nama'),1,2,'L',0);
	$y2 = $this->fpdf->getY();
	$selisih = $y2 - $y1;
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$selisih,'',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$tinggi2,'2',0,0,'C',0);
	$this->fpdf->cell(17,$tinggi2,'PEJABAT PENILAI',1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'a. Nama',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$nama_penilai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'b. NIP',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$nip_penilai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'c. Pangkat, Golongan ruang',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$pangkat_golongan_penilai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'d. Jabatan / Pekerjaan',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$jabatan_penilai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'e. Unit Organisasi',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$unit_organisasi_penilai,1,2,'L',0);
	$y2 = $this->fpdf->getY();
	$selisih = $y2 - $y1;
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$selisih,'',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$tinggi2,'3',0,0,'C',0);
	$this->fpdf->cell(17,$tinggi2,'ATASAN PEJABAT PENILAI',1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'a. Nama',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$nama_atasan_penilai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'b. NIP',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$nip_atasan_penilai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'c. Pangkat, Golongan ruang',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$pangkat_golongan_atasan_penilai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'d. Jabatan / Pekerjaan',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$jabatan_atasan_penilai,1,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->cell(7,$tinggi2,'e. Unit Organisasi',1,0,'L',0);
	$this->fpdf->cell(10,$tinggi2,$unit_organisasi_atasan_penilai,1,2,'L',0);
	$y2 = $this->fpdf->getY();
	$y3 = $this->fpdf->getY();
	$selisih = $y2 - $y1;
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$selisih,'',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$tinggi3,'4',0,0,'C',0);
	$this->fpdf->cell(14,$tinggi3,'UNSUR YANG DINILAI',1,0,'L',0);
	$this->fpdf->cell(3,$tinggi3,'JUMLAH',1,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(14,$tinggi3,'a. Sasaran Kerja Pegawai (SKP)',1,0,'L',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->cell(3,$tinggi3,$skp.' x 60%',0,0,'L',0);
	$this->fpdf->SetX($x+15);
	$this->fpdf->cell(3,$tinggi3,round($jskp,2),1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(4,$tinggi2,'b. Perilaku Kerja',0,0,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'1. Orientasi Pelayanan',1,0,'L',0);
	$this->fpdf->cell(2,$tinggi2,round($pelayanan,2),1,0,'C',0);
	$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($pelayanan,2)),1,2,'C',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'2. Integritas',1,0,'L',0);
	$this->fpdf->cell(2,$tinggi2,round($integritas,2),1,0,'C',0);
	$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($integritas,2)),1,2,'C',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'3. Komitmen',1,0,'L',0);
	$this->fpdf->cell(2,$tinggi2,round($komitmen,2),1,0,'C',0);
	$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($komitmen,2)),1,2,'C',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'4. Disiplin',1,0,'L',0);
	$this->fpdf->cell(2,$tinggi2,round($disiplin,2),1,0,'C',0);
	$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($disiplin,2)),1,2,'C',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'5. Kerjasama',1,0,'L',0);
	$this->fpdf->cell(2,$tinggi2,round($kerjasama,2),1,0,'C',0);
	$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($kerjasama,2)),1,2,'C',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'6. Kepemimpinan',1,0,'L',0);
	$this->fpdf->cell(2,$tinggi2,'',1,0,'C',0);
	$this->fpdf->cell(3,$tinggi2,'',1,2,'C',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'Jumlah',1,0,'L',0);
	$this->fpdf->cell(5,$tinggi2,round($jppk,2),1,2,'C',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'Nilai rata - rata',1,0,'L',0);
	$this->fpdf->cell(5,$tinggi2,round($rppk,2),1,2,'C',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->cell(5,$tinggi2,'Nilai Perilaku Kerja',1,0,'L',0);
	$this->fpdf->cell(5,$tinggi2,round($rppk,2).' x 40%',1,0,'C',0);
	$npp =$rppk * 0.4;
	$this->fpdf->cell(3,$tinggi2,round($npp,2),1,2,'C',0);
	$y2 = $this->fpdf->getY();
	$selisih = $y2-$y1;
	$this->fpdf->SetXY(17,$y1);
	$this->fpdf->cell(3,$selisih,'',1,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(14,2,'Nilai Prestasi Kerja',1,0,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetX($x+15);
	$npk = $jskp + $npp;
	$pnpk = '?';
	if($npk < 100)
	{
		$pnpk = '(Amat Baik)';
	}
	if ($npk < 91)
	{
		$pnpk = '(Baik)';
	}
	if ($npk < 76)
	{
		$pnpk = '(Cukup)';
	}
	$this->fpdf->cell(3,1,round($npk,2),1,2,'C',0);
	$this->fpdf->cell(3,1,$pnpk,0,2,'C',0);
	$this->fpdf->SetXY($x+15,$y1);
	$this->fpdf->cell(3,2,'',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$selisih = $y3 - $y1;
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$selisih,'',1,2,'C',0);
	$this->fpdf->AddPage("P");
	$this->fpdf->SetXY($x,2);
	$y1 = $this->fpdf->getY();
	$this->fpdf->cell(1,$tinggi,'5',0,0,'C',0);
	$this->fpdf->cell(10,$tinggi,'KEBERATAN DARI PEGAWAI NEGERI SIPIL',0,2,'L',0);
	$this->fpdf->cell(10,$tinggi,'YANG DINILAI (APABILA ADA)',0,2,'L',0);
	$this->fpdf->SetXY($x+12,$y1+3);
	$this->fpdf->cell(10,1,'Tanggal ....................',0,2,'L',0);
	$y2 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$selisih = $y2 - $y1;
	$this->fpdf->cell(18,$selisih,'',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->cell(1,$tinggi,'6',0,0,'C',0);
	$this->fpdf->cell(10,$tinggi,'TANGGAPAN PEJABAT PENILAI ATAS KEBERATAN',0,2,'L',0);
	$this->fpdf->cell(10,$tinggi,'',0,2,'L',0);
	$this->fpdf->SetXY($x+12,$y1+3);
	$this->fpdf->cell(10,1,'Tanggal ....................',0,2,'L',0);
	$y2 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$selisih = $y2 - $y1;
	$this->fpdf->cell(18,$selisih,'',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->cell(1,$tinggi,'7',0,0,'C',0);
	$this->fpdf->cell(10,$tinggi,'KEPUTUSAN ATASAN PEJABAT PENILAI ATAS',0,2,'L',0);
	$this->fpdf->cell(10,$tinggi,'KEBERATAN',0,2,'L',0);
	$this->fpdf->SetXY($x+12,$y1+4);
	$this->fpdf->cell(10,1,'Tanggal ....................',0,2,'L',0);
	$y2 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$selisih = $y2 - $y1;
	$this->fpdf->cell(18,$selisih,'',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->cell(1,$tinggi,'8',0,0,'C',0);
	$this->fpdf->cell(10,$tinggi,'REKOMENDASI',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi,'',0,2,'L',0);
	$this->fpdf->SetXY($x+12,$y1+3);
	$this->fpdf->cell(10,1,'Tanggal ....................',0,2,'L',0);
	$y2 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$selisih = $y2 - $y1;
	$this->fpdf->cell(18,$selisih,'',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetXY($x+8,$y1+0.5);
	$this->fpdf->cell(10,$tinggi4,'9. DIBUAT TANGGAL, '.date_to_long_string($tpejabat),0,2,'C',0);
	$this->fpdf->SetX($x+8);
	$this->fpdf->cell(10,$tinggi4,'PEJABAT PENILAI,',0,2,'C',0);
	$this->fpdf->cell(10,1.5,'',0,2,'C',0);
	$this->fpdf->cell(10,$tinggi4,$nama_penilai,0,2,'C',0);
	$this->fpdf->cell(10,$tinggi4,'NIP '.$nip_penilai,0,2,'C',0);
	$this->fpdf->cell(10,$tinggi4,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(10,$tinggi4,'10. DITERIMA TANGGAL, '.date_to_long_string($tybs),0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(10,$tinggi4,'PEGAWAI NEGERI SIPIL',0,2,'C',0);
	$this->fpdf->cell(10,$tinggi4,'YANG DINILAI',0,2,'C',0);
	$this->fpdf->cell(10,1.5,'',0,2,'C',0);
	$this->fpdf->cell(10,$tinggi4,$namapegawai,0,2,'C',0);
	$this->fpdf->cell(10,$tinggi4,'NIP '.$nippegawai,0,2,'C',0);
	$this->fpdf->SetX($x+8);
	$this->fpdf->cell(10,$tinggi4,'11. DITERIMA TANGGAL, '.date_to_long_string($tatasanpejabat),0,2,'C',0);
	$this->fpdf->SetX($x+10);
	$this->fpdf->cell(7,$tinggi4,'ATASAN PEJABAT PENILAI,',0,2,'C',0);
	$this->fpdf->cell(7,1.5,'',0,2,'C',0);
	$this->fpdf->cell(7,$tinggi4,$nama_atasan_penilai,0,2,'C',0);
	$this->fpdf->cell(7,$tinggi4,'NIP '.$nip_atasan_penilai,0,2,'C',0);
	$y2 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(18,$y2-$y1+0.5,'',1,2,'C',0);
	$this->db->query("update `ppk_pns` set `npk`='$npk' where `tahun`='$tahun' and `kode`='$nip'");

}
else
{
	$this->fpdf->FPDF("P","cm","A4");		
	$this->fpdf->AliasNbPages();
	$this->fpdf->SetTitle("Sampul Penilaian Prestasi Kerja PNS");
	$this->fpdf->SetAuthor("Selamet Hanafi");
	$this->fpdf->SetSubject("Sistem Informasi Madrasah");
	$this->fpdf->SetKeywords("sistem, informasi, madrasah");
	$x = 1.5;
	$y1 = 3;
	$x1 = 2;
	$this->fpdf->AddPage();
	$xxx = 9;
	$yyy = 3;
	$this->fpdf->Image('images/garuda_pancasila.jpg',$xxx,$yyy,2.5,2.5);
	$this->fpdf->SetXY($x,5.5);
	$this->fpdf->setFont('Times','',12);
	$this->fpdf->cell(18,$tinggi,'PENILAIAN PRESTASI KERJA',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'PEGAWAI NEGERI SIPIL',0,2,'C',0);
	$this->fpdf->MultiCell(18,0.4,'an '.$namapegawai.' belum dipermanenkan oleh kepala',0,'L',0);
}

$this->fpdf->Output('penilaian_prestasi_kerja_'.$tahunpenilaian.'_'.$namapegawai.'.pdf',"I");
?>
