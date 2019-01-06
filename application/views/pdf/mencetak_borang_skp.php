<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 06 Jan 2019 20:29:41 WIB 
// Nama Berkas 		: mencetak_borang_skp.php
// Lokasi      		: application/views/pdf/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
?>
<?php
$te = $this->db->query("select * from `pkg_masa` where tahun = '$tahunpenilaian'");
foreach($te->result() as $e)
{
	$tawal = $e->awal;
	$takhir = $e->akhir;
	$tskp = $e->tskp;
	$tpenilaian = $e->tpenilaian;
}

$tambah = 0;
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$nip'");
$permanen = '';
foreach($tz->result() as $z)
	{
	$permanen = $z->permanen;
	$idskawal = $z->skawal;
	$idskakhir = $z->skakhir;
	$tambah = $z->tambah;
	}

$this->fpdf->FPDF("L","cm","Legal");
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
//	$tipepegawai 
}
$gol1 = id_sk_jadi_golongan($idskawal) ;
$pangkat1 = golongan_jadi_pangkat($gol1);
$jabatan1 = golongan_jadi_jabatan($gol1);
$gol2 = id_sk_jadi_golongan($idskakhir) ;
$pangkat2 = golongan_jadi_pangkat($gol2);
$jabatan2 = golongan_jadi_jabatan($gol2);

if($permanen == 1)
{	
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
	$this->fpdf->AddPage();
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
	$this->fpdf->Cell($k6,$tb, $unit_kerja,1,2,'L',0);
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
/*
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
*/
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
			/*
			if($a->unsur == 'D')
				{
				$unsur = 'Unsur penunjang: ';
				}
			if($a->unsur == 'C')
				{
				$unsur = 'Unsur PKB: ';
				}
			if($a->unsur == 'Z')
				{
				$unsur = 'Tugas relevan: ';
				}
			*/
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
					$this->fpdf->AddPage();
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
		}
	}
	$this->fpdf->SetFont('Helvetica','',10);
	$tglcetak = date_to_long_string($tskp);
	$this->fpdf->SetX($x+3);
//	$this->fpdf->Cell(6,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,$lokasi.', '.$tglcetak,0,2,'L',0);
	$yy = $this->fpdf->getY();
	$tahunnow = date("Y");
	if($tahunpenilaian<$tahunnow)
	{
		$tahun2 = $tahunpenilaian + 1;
		$thnajaran = $tahunpenilaian.'/'.$tahun2;
		$semester = 1;
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
		$posisix = $posisi_x + 5;
		$posisine_y = $yy + $posisi_y;
		$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisix,$posisine_y,$lebar_ttd,$tinggi_ttd);
	}
	$this->fpdf->SetXY($x+3,$yy);
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
}
else
{
	$this->fpdf->AddPage();
	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Helvetica','B',8);
	$this->fpdf->Cell($lebar,1, 'Belum permanen',1,0,'C',0);
}
$namafile= $cari_os.'_borang_skp_'.$tahunpenilaian.'_'.$namapegawai.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
