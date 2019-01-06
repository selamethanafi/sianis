<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 11 Peb 2015 22:12:02 WIB 
// Nama Berkas 		: mencetak_skp.php
// Lokasi      		: application/views/shared/
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
?>
<?php
date_default_timezone_set('Asia/Jakarta');
$this->fpdf->FPDF("L","cm","Legal");
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

$tc = $this->db->query("select * from `pkg_masa` where tahun = '$tahunpenilaian'");
foreach($tc->result() as $c)
	{
	$tpejabat = $c->tpejabat;
 	$tybs = $c->tybs;
	$tatasanpejabat = $c->tatasanpejabat;
	$tawal = $c->awal;
	$takhir = $c->akhir;
	$tpenilaian = $c->tpenilaian;

	}

$namapegawai = cari_nama_pegawai($kodeguru);
//januari 2014 itu 2013/2014 semester 2
//2014 JADI 2013/2014 SMT 2
$awal = $tahunpenilaian - 1 ;
$akhir = $tahunpenilaian;
$thnajaran = $awal."/".$akhir;
$semester = 2;
$tx = $this->db->query("select * from p_pegawai where `kodeguru`='$kodeguru'");
foreach($tx->result() as $dx)
{
	$nippegawai = $dx->nip;
	$tempat = $dx->tempat;
	$tgllhr = $dx->tanggallahir;
	$usernamepegawai = $dx->kd;
	$tmtguru = $dx->tmt_guru;
	$jenkel = $dx->jenkel;
//	$tipepegawai 
}
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$nip'");
$permanen = '';
foreach($tz->result() as $z)
	{
	$permanen = $z->permanen;
	$idskawal = $z->skawal;
	$idskakhir = $z->skakhir;
	$tambah = $z->tambah;
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
	$namasekolah = $this->config->item('sek_nama');
	$teleponsekolah = $this->config->item('sek_telepon');
	$desa = $this->config->item('sek_desa');
	$kec = $this->config->item('sek_kec');
	$kab = $this->config->item('sek_kab');
	$prov = $this->config->item('sek_prov');
	$this->fpdf->AddPage();
	$this->fpdf->SetXY($x,$y+$tambah);
	$this->fpdf->SetFont('Helvetica','',9);
	$this->fpdf->Cell($lebar,$tb,'PENILAIAN SASARAN KERJA PEGAWAI',0,2,'C',0);
	$this->fpdf->Cell(8,$tb,'Jangka waktu penilaian '.date_to_long_string($tawal).' s.d. '.date_to_long_string($takhir),0,0,'L',0);
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
				$this->fpdf->AddPage();
				$this->fpdf->SetXY($x,$y);
				$this->fpdf->SetXY($x,$y);
				$this->fpdf->SetFont('Helvetica','',9);
				$this->fpdf->Cell($lebar,$tb,'PENILAIAN SASARAN KERJA PEGAWAI',0,2,'C',0);
				$this->fpdf->Cell(10,$tb,'Jangka waktu penilaian '.date_to_long_string($tawal).' s.d. '.date_to_long_string($takhir),0,0,'L',0);
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
		$this->fpdf->AddPage();
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
		$posisix = $posisi_x + 21.5;
		$posisine_y = $yy + $posisi_y;
		$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisix,$posisine_y,$lebar_ttd,$tinggi_ttd);
	}
	$this->fpdf->SetXY($x+20,$yy);
	$this->fpdf->Cell(10,$tb,'Pejabat Penilai',0,0,'L',0);
	$this->fpdf->Cell(6,$tb+$tb+$tb,'',0,2,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,$nama_penilai,0,2,'L',0);
	$this->fpdf->SetX($x+20);
	$this->fpdf->Cell(10,$tb,'NIP '.$nip_penilai,0,2,'L',0);
}
else
{
	$this->fpdf->AddPage();
	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Helvetica','B',9);
	$this->fpdf->Cell($lebar,1, 'Belum permanen',1,0,'C',0);
}
$namafile= $cari_os.'_skp_'.$tahunpenilaian.'_'.$namapegawai.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
