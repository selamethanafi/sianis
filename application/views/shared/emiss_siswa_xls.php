<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: siswa_padamu_xls.php
// Lokasi      		: application/views/shared/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `kelas`,`no_urut` ");
$thnajarane = berkas($thnajaran);
$filename = 'data_siswa_emiss_tahun_'.$thnajarane.'.xls'; 
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data siswa';
$baris=1;
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('K1','NIS');
$this->excel->getActiveSheet()->setCellValue('L1', 'NISN');
$this->excel->getActiveSheet()->setCellValue('M1', 'NIK');
$this->excel->getActiveSheet()->setCellValue('N1','NAMA');
$this->excel->getActiveSheet()->setCellValue('O1','TEMPAT LAHIR');
$this->excel->getActiveSheet()->setCellValue('P1','TGL LAHIR (DD/MM/YYYY)');
$this->excel->getActiveSheet()->setCellValue('Q1','JENIS KELAMIN');
$this->excel->getActiveSheet()->setCellValue('R1','TINGKAT');
$this->excel->getActiveSheet()->setCellValue('S1','JURUSAN');
$this->excel->getActiveSheet()->setCellValue('T1','PARALEL');
$this->excel->getActiveSheet()->setCellValue('U1','NOMOR ABSEN');
$this->excel->getActiveSheet()->setCellValue('V1','RANGKING');
$this->excel->getActiveSheet()->setCellValue('W1','STATUS SISWA');
$this->excel->getActiveSheet()->setCellValue('X1','ASAL SEKOLAH');
$this->excel->getActiveSheet()->setCellValue('Y1','HOBI');
$this->excel->getActiveSheet()->setCellValue('Z1','CITA - CITA');
$this->excel->getActiveSheet()->setCellValue('AA1','JUMLAH SAUDARA');
$this->excel->getActiveSheet()->setCellValue('AB1','JENIS SEKOLAH ASAL');
$this->excel->getActiveSheet()->setCellValue('AC1','STATUS SEKOLAH ASAL');
$this->excel->getActiveSheet()->setCellValue('AD1','KABUPATEN SEKOLAH ASAL');
$this->excel->getActiveSheet()->setCellValue('AE1','NOMOR PESERTA UN SMP');
$this->excel->getActiveSheet()->setCellValue('AF1','ALAMAT');
$this->excel->getActiveSheet()->setCellValue('AG1','PROVINSI');
$this->excel->getActiveSheet()->setCellValue('AH1','KAB/KOTA');
$this->excel->getActiveSheet()->setCellValue('AI1','KECAMATAN');
$this->excel->getActiveSheet()->setCellValue('AJ1','DESA/KELURAHAN');
$this->excel->getActiveSheet()->setCellValue('AK1','KODEPOS');
$this->excel->getActiveSheet()->setCellValue('AL1','JARAK');
$this->excel->getActiveSheet()->setCellValue('AM1','TRANSPORTASI');
$this->excel->getActiveSheet()->setCellValue('AN1','TUNA RUNGU');
$this->excel->getActiveSheet()->setCellValue('AO1','TUNA NETRA');
$this->excel->getActiveSheet()->setCellValue('AP1','TUNA DAKSA');
$this->excel->getActiveSheet()->setCellValue('AQ1','TUNA GRAHITA');
$this->excel->getActiveSheet()->setCellValue('AR1','TUNA LARAS');
$this->excel->getActiveSheet()->setCellValue('AS1','LAMBAN BELAJAR');
$this->excel->getActiveSheet()->setCellValue('AT1','SULIT BELAJAR');
$this->excel->getActiveSheet()->setCellValue('AU1','GANGGUAN KOMUNIKASI');
$this->excel->getActiveSheet()->setCellValue('AV1','BAKAT LUAR BIASA');
$this->excel->getActiveSheet()->setCellValue('AW1','NOMOR KK');
$this->excel->getActiveSheet()->setCellValue('AX1','NAMA AYAH KANDUNG');
$this->excel->getActiveSheet()->setCellValue('AY1','NIK AYAH KANDUNG');
$this->excel->getActiveSheet()->setCellValue('AZ1','PENDIDIKAN AYAH KANDUNG');
$this->excel->getActiveSheet()->setCellValue('BA1','PEKERJAAN AYAH KANDUNG');
$this->excel->getActiveSheet()->setCellValue('BB1','NAMA LENGKAP IBU KANDUNG');
$this->excel->getActiveSheet()->setCellValue('BC1','NIK IBU KANDUNG');
$this->excel->getActiveSheet()->setCellValue('BD1','PENDIDIKAN IBU KANDUNG');
$this->excel->getActiveSheet()->setCellValue('BE1','PEKERJAAN IBU KANDUNG');
$this->excel->getActiveSheet()->setCellValue('BF1','PENGHASILAN ORTU');
$this->excel->getActiveSheet()->setCellValue('BG1','NOMOR KKS/ KPS');
$this->excel->getActiveSheet()->setCellValue('BH1','NOMOR KARTU PKH');
$this->excel->getActiveSheet()->setCellValue('BI1','NOMOR KIP');
$this->excel->getActiveSheet()->setCellValue('BJ1','STATUS PENERIMA PIP/BSM');
$this->excel->getActiveSheet()->setCellValue('BK1','ALASAN MENERIMA PIP/BSM');
$this->excel->getActiveSheet()->setCellValue('BL1','PERIODE MENERIMA PIP/BSM');
$this->excel->getActiveSheet()->setCellValue('BM1','BIDANG PRESTASI');
$this->excel->getActiveSheet()->setCellValue('BN1','TINGKAT PRESTASI');
$this->excel->getActiveSheet()->setCellValue('BO1','PERINGKAT YANG DIPEROLEH');
$this->excel->getActiveSheet()->setCellValue('BP1','TAHUN');
$this->excel->getActiveSheet()->setCellValue('BQ1','STATUS BEASISWA');
$this->excel->getActiveSheet()->setCellValue('BR1','SUMBER BEASISWA');
$this->excel->getActiveSheet()->setCellValue('BS1','JENIS BEASISWA');
$this->excel->getActiveSheet()->setCellValue('BT1','JANGKA WAKTU'); // BULAN
$this->excel->getActiveSheet()->setCellValue('BU1','BESAR UANG DITERIMA');
$this->excel->getActiveSheet()->setCellValue('BV1','AGAMA SISWA');
$this->excel->getActiveSheet()->setCellValue('BW1','WALI KELAS');
$this->excel->getActiveSheet()->setCellValue('BX1','NPSN');
$this->excel->getActiveSheet()->setCellValue('BY1','NOMOR BLANKO SKHUN');
$this->excel->getActiveSheet()->setCellValue('BZ1','NOMOR SERI IJAZAH');
$this->excel->getActiveSheet()->setCellValue('CA1','TOTAL NILAI UN');
$this->excel->getActiveSheet()->setCellValue('CB1','TANGGAL KELULUSAN');
$this->excel->getActiveSheet()->setCellValue('CC1','NAMA WALI SISWA');
$this->excel->getActiveSheet()->setCellValue('CD1','TAHUN LAHIR WALI SISWA');
$this->excel->getActiveSheet()->setCellValue('CE1','NIK WALI SISWA');
$this->excel->getActiveSheet()->setCellValue('CF1','PENDIDIKAN WALI SISWA');
$this->excel->getActiveSheet()->setCellValue('CG1','PEKERJAAN WALI SISWA');
$this->excel->getActiveSheet()->setCellValue('CH1','Penghasilan Wali');
$this->excel->getActiveSheet()->setCellValue('CI1','STATUS TEMPAT TINGGAL');
$this->excel->getActiveSheet()->setCellValue('CJ1','BAHASA ASING PILIHAN SISWA');
$baris++;
$nomor = 1;
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$no_urut = $a->no_urut;
	$bsm = $a->bsm;
	$alasan_bsm = $a->alasan_bsm;
	$periode_bsm = '';
	$alamat2 ='';
	$goldarah = '';
	$hp = '';
	$kelas = $a->kelas;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	$tahunmasuk = '';
	$kodepadamu = '';
	foreach($tb->result() as $b)
	{
		$nisn = $b->nisn;
		$tc = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `bsm`='1'");
		$adatc = $tc->num_rows();
		$ket = $b->ket;
		$namasiswa = strtolower($b->nama);
		$namasiswa = ucwords($namasiswa);
		$jeniskelamin = jenkel_siswa($nis,0);
		$tempat = $b->tmpt;
		$tanggallahir = tanggal_slash($b->tgllhr);
		$alamat = $b->alamat;
		$tahunmasuk = substr($b->tglditerima,0,4);
		$kodepadamu = $b->kodepadamu;
		if (!empty($b->jalan))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Jalan '.$b->jalan;
		}
		if (!empty($b->rt))
		{
		if (!empty($alamat2))
			{
				$alamat2 .= ' ';
			}
		$alamat2 .= 'RT '.$b->rt;

		}
		if (!empty($b->rw))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'RW '.$b->rw;
		}
		if (!empty($b->dusun))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'Dusun '.$b->dusun;
		}
		if (!empty($b->desa))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Desa '.$b->desa;
		}
		if (!empty($b->kec))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Kec. '.$b->kec;
		}
		if (!empty($b->kab))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Kab. '.$b->kab;
		}
		if (!empty($b->prov))
		{
			if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
			$alamat2 .= 'Prov. '.$b->prov;
		}
		$goldarah = $b->goldarah;
		$hp = $b->hp;
		if ($tahunmasuk == '0000')
		{
			$tahunmasuk = '';
		}
		$tingkat = '';
		$peringkat = '';
		if (substr($kelas,0,2) == 'X-')
		{
			$tingkat = 10;
		} 
		if (substr($kelas,0,3) == 'XI-')
		{
			$tingkat = 11;
		} 
		if (substr($kelas,0,4) == 'XII-')
		{
			$tingkat = 12;
		}
		//peringkat siswa
		if($semester == '1')
		{
			$tahun2 = substr($thnajaran,0,4);
			$tahun1 = $tahun2 - 1;
			$thnsebelumnya = $tahun1.'/'.$tahun2;
			$semestersebelumnya = '2';
		}
		else
		{
			$thnsebelumnya = $thnajaran;
			$semestersebelumnya = '1';
		}
		if(($tingkat == 11) or ($tingkat == 12))
		{
			$tperingkat = $this->db->query("select * from `siswa_peringkat` where `thnajaran`= '$thnsebelumnya' and `semester`='$semestersebelumnya' and `nis`='$nis'");
			foreach($tperingkat->result() as $dperingkat)
			{
				$peringkat = $dperingkat->peringkat_kelas;
			}
			if($peringkat>10)
			{
				$peringkat = '';
			}
		}
		//tunggakan
		$status = '';
		if($tingkat == 10)
		{
			$status = 5;
			$tkelas = $this->db->query("select * from `siswa_kelas` where `thnajaran`= '$thnsebelumnya' and `semester`='$semestersebelumnya' and `nis`='$nis'");
			$adakelas = $tkelas->num_rows();
			if($adakelas>0)
			{
				$status = 2;
			}
		}
		if(($tingkat == 11) or ($tingkat==12))
		{
			$kelas11 = substr($kelas,0,3);
			$status = 1;
			$tkelas = $this->db->query("select * from `siswa_kelas` where `thnajaran`= '$thnsebelumnya' and `semester`='$semestersebelumnya' and `nis`='$nis'");
			$adakelas = $tkelas->num_rows();
			if($adakelas>0)
			{
				$kelasx = '?';
				foreach($tkelas->result() as $dkelas)
				{
					$kelasx = $dkelas->kelas;
				}
				$tingkatx = kelas_jadi_tingkat($kelas);
				if($tingkat == $tingkatx)
				{
					$status = 2;
				}
			}
			else
			{
				$status = 3;
			}
		}
		$nislokal = '';
		if(!empty($tahunmasuk))
		{
			$nislokal = $this->config->item('sek_nsm').''.substr($tahunmasuk,2,2).''.$nis;
		}
		$this->excel->getActiveSheet()->getCell('K'.$baris)->setValueExplicit($nislokal, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('L'.$baris)->setValueExplicit($nisn, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('M'.$baris)->setValueExplicit($b->nik, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('N'.$baris)->setValueExplicit($namasiswa, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('O'.$baris)->setValueExplicit($tempat, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('P'.$baris,$tanggallahir);
		$this->excel->getActiveSheet()->setCellValue('Q'.$baris,$jeniskelamin);
		$this->excel->getActiveSheet()->setCellValue('R'.$baris,$tingkat);
		$jurusane = kelas_jadi_program($kelas);
		$jurusan = '';
		if(($jurusane == 'IPA') or ($jurusane == 'Matematika dan Ilmu - Ilmu Alam'))
		{
			$jurusan =  1;
		}
		if(($jurusane == 'IPS') or ($jurusane == 'Ilmu - Ilmu Sosial'))
		{
			$jurusan =  2;
		}
		if($jurusane == 'Keagamaan')
		{
			$jurusan =  4;
		}
		$this->excel->getActiveSheet()->setCellValue('S'.$baris,$jurusan);
		$paralel = substr($kelas,-1);
		$angka = $paralel * 2;
		if($angka==0)
		{
			$paralel = 1;
		}
		$this->excel->getActiveSheet()->setCellValue('T'.$baris,$paralel);
		$this->excel->getActiveSheet()->setCellValue('U'.$baris,$no_urut);
		$this->excel->getActiveSheet()->setCellValue('V'.$baris,$peringkat);
		$this->excel->getActiveSheet()->setCellValue('W'.$baris,$status);
		$this->excel->getActiveSheet()->setCellValue('X'.$baris,$b->sltp);
		//hobi
		$hobi = $b->hobi;
		if($hobi == 'olahraga')
		{
			$hobine = '1';
		}
		elseif($hobi == 'kesenian')
		{
			$hobine = '2';
		}
		elseif($hobi == 'membaca')
		{
			$hobine = '3';
		}
		elseif($hobi == 'menulis')
		{
			$hobine = '4';
		}
		elseif($hobi == 'travelling')
		{
			$hobine = '5';
		}
		else
		{
			$hobine = '6';
		}
		$this->excel->getActiveSheet()->setCellValue('Y'.$baris,$hobine);
		//cita
		$cita_cita = $b->cita_cita;
		$cita_citane = '';
		$tcita = $this->db->query("select * from `m_cita` where `nama_cita` = '$cita_cita'");
		foreach($tcita->result() as $dcita)
		{
			$cita_citane = $dcita->nama_cita;
		}
		if($cita_citane == 'A')
		{
			$citane = '1';
		}
		elseif($cita_citane == 'B')
		{
			$citane = '2';
		}
		elseif($cita_citane == 'C')
		{
			$citane = '3';
		}
		elseif($cita_citane == 'D')
		{
			$citane = '4';
		}
		elseif($cita_citane == 'E')
		{
			$citane = '5';
		}
		elseif($cita_citane == 'F')
		{
			$citane = '6';
		}
		elseif($cita_citane == 'G')
		{
			$citane = '7';
		}
		else
		{
			$citane = '8';
		}
		$this->excel->getActiveSheet()->setCellValue('Z'.$baris,$citane);
		$this->excel->getActiveSheet()->setCellValue('AA'.$baris,$b->kandung);
		$sekolah = strtoupper($b->sltp);
		if(substr($sekolah,0,3) == 'SMP')
		{
//			$this->excel->getActiveSheet()->setCellValue('AB'.$baris,'1');
			$this->excel->getActiveSheet()->setCellValue('AB'.$baris,$sekolah);
		}
		elseif(substr($sekolah,0,3) == 'MTS')
		{
//			$this->excel->getActiveSheet()->setCellValue('AB'.$baris,'2');
			$this->excel->getActiveSheet()->setCellValue('AB'.$baris,$sekolah);
		}
		else
		{
//			$this->excel->getActiveSheet()->setCellValue('AB'.$baris,'5');
			$this->excel->getActiveSheet()->setCellValue('AB'.$baris,$sekolah);
		}
		if(substr($sekolah,0,3) == 'SMP')
		{
			if(substr($sekolah,0,5) == 'SMP N')
			{
				$this->excel->getActiveSheet()->setCellValue('AC'.$baris,'1');
			}
			else
			{
				$this->excel->getActiveSheet()->setCellValue('AC'.$baris,'2');
			}

		}
		elseif(substr($sekolah,0,3) == 'MTS')
		{
			if((substr($sekolah,0,4) == 'MTSN') or (substr($sekolah,0,5) == 'MTS N'))
			{
				$this->excel->getActiveSheet()->setCellValue('AC'.$baris,'1');
			}
			else
			{
				$this->excel->getActiveSheet()->setCellValue('AC'.$baris,'2');
			}
		}
		else
		{
			$this->excel->getActiveSheet()->setCellValue('AC'.$baris,'2');
		}
		$this->excel->getActiveSheet()->setCellValue('AD'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AE'.$baris,$b->skhun);
		$this->excel->getActiveSheet()->setCellValue('AF'.$baris,ucwords(strtolower($b->alamat)));
		$this->excel->getActiveSheet()->setCellValue('AG'.$baris,ucwords(strtolower($b->prov)));
		$this->excel->getActiveSheet()->setCellValue('AH'.$baris,ucwords(strtolower($b->kab)));
		$this->excel->getActiveSheet()->setCellValue('AI'.$baris,ucwords(strtolower($b->kec)));
		$this->excel->getActiveSheet()->setCellValue('AJ'.$baris,ucwords(strtolower($b->desa)));
		$this->excel->getActiveSheet()->setCellValue('AK'.$baris,'');
		//jarak
		$jarak = $b->jarak;
		if($jarak == '0 - 1 km')
		{
			$jarake = 1;
		}
		elseif($jarak == '1 - 3 km')
		{
			$jarake = 2;
		}
		elseif($jarak == '3 - 5 km')
		{
			$jarake = 3;
		}
		elseif($jarak == '5 - 10 km')
		{
			$jarake = 4;
		}
		else
		{
			$jarake = 5;
		}
		$this->excel->getActiveSheet()->setCellValue('AL'.$baris,$jarake);
		//tranpor
		$transport = $b->transportasi;
		if($transport == 'jalan kaki')
		{
			$transporte = '1';
		}
		elseif($transport == 'sepeda')
		{
			$transporte = '2';
		}
		elseif($transport == 'motor')
		{
			$transporte = '3';
		}
		elseif($transport == 'mobil pribadi')
		{
			$transporte = '4';
		}
		elseif($transport == 'antar jemput sekolah')
		{
			$transporte = '5';
		}
		elseif($transport == 'angkutan umum')
		{
			$transporte = '6';
		}
		elseif($transport == 'Kendaraan Umum')
		{
			$transporte = '6';
		}
		elseif($transport == 'Kendaraan Sendiri')
		{
			$transporte = '3';	
		}
		elseif($transport == 'Berjalan Kaki')
		{
			$transporte = '1';
		}
		else
		{
			$transporte = '8';
		}
		$this->excel->getActiveSheet()->setCellValue('AM'.$baris,$transporte);
		$this->excel->getActiveSheet()->setCellValue('AN'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AO'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AP'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AQ'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AR'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AS'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AT'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AU'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('AV'.$baris,'');
		$this->excel->getActiveSheet()->getCell('AW'.$baris)->setValueExplicit($b->nokk, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('AX'.$baris,ucwords(strtolower($b->nmayah)));
		$this->excel->getActiveSheet()->getCell('AY'.$baris)->setValueExplicit($b->nik_kk, PHPExcel_Cell_DataType::TYPE_STRING);
		//sekolah
		$sekayah = $b->sekayah;
		$tsekayah = $this->db->query("SELECT * FROM `m_sekolah` where `jenjang` = '$sekayah'");
		$kodesekayah = '';
		foreach($tsekayah->result() as $dsekayah)
		{
			$kodesekayah = $dsekayah->kode;
		}
		if($kodesekayah == 'A')
		{
			$sekayahe = 0;
		}
		elseif($kodesekayah == 'B') 
		{		
			$sekayahe = 1;
		}

		elseif($kodesekayah == 'C') 
		{		
			$sekayahe = 1;
		}
		elseif($kodesekayah == 'D')
		{		
			$sekayahe = 2;
		}
		elseif($kodesekayah == 'E')
		{		
			$sekayahe = 5;
		}
		elseif($kodesekayah == 'F') 
		{		
			$sekayahe = 6;
		}
		elseif($kodesekayah == 'G') 
		{		
			$sekayahe = 7;
		}
		elseif($kodesekayah == 'H') 
		{		
			$sekayahe = 8;
		}
		elseif($kodesekayah == 'I') 
		{		
			$sekayahe = 9;
		}
		else
		{
			$sekayahe = '0';
		}
		$this->excel->getActiveSheet()->setCellValue('AZ'.$baris,$sekayahe);
		//payah
		$payah = $b->payah;
		$tpayah = $this->db->query("SELECT * FROM `m_pekerjaan` where `nama_pekerjaan` = '$payah'");
		$kodepayah = '';
		foreach($tpayah->result() as $dpayah)
		{
			$kodepayah = $dpayah->kode_pekerjaan;
		}

		if($kodepayah == 'A')
		{
			$kodepayahe = '03';
		}
		elseif($kodepayah == 'B')
		{
			$kodepayahe = '04';
		}
		elseif($kodepayah == 'C')
		{
			$kodepayahe = '05';
		}
		elseif($kodepayah == 'D')
		{
			$kodepayahe = '10';
		}	
		elseif($kodepayah == 'E')
		{
			$kodepayahe = '17';
		}
		elseif($kodepayah == 'F')
		{
			$kodepayahe = '06';
		}
		elseif($kodepayah == 'G')
		{
			$kodepayahe = '07';
		}
		elseif($kodepayah == 'H')
		{
			$kodepayahe = '13';
		}
		elseif($kodepayah == 'I')
		{
			$kodepayahe = '09';
		}
		elseif($kodepayah == 'J')
		{
			$kodepayahe = '15';
		}
		elseif($kodepayah == 'K')
		{
			$kodepayahe = '01';
		}
		else
		{
			$kodepayahe = '18';
		}
		$this->excel->getActiveSheet()->setCellValue('BA'.$baris,$kodepayahe);
		$this->excel->getActiveSheet()->setCellValue('BB'.$baris,ucwords(strtolower($b->nmibu)));
		$this->excel->getActiveSheet()->getCell('BC'.$baris)->setValueExplicit($b->nik_ibu, PHPExcel_Cell_DataType::TYPE_STRING);
		//sekolah
		$sekibu = $b->sekibu;
		$tsekibu = $this->db->query("SELECT * FROM `m_sekolah` where `jenjang` = '$sekibu'");
		$kodesekibu = '';
		foreach($tsekibu->result() as $dsekibu)
		{
			$kodesekibu = $dsekibu->kode;
		}
		if($kodesekibu == 'A')
		{
			$sekibue = 0;
		}
		elseif($kodesekibu == 'B') 
		{		
			$sekibue = 1;
		}

		elseif($kodesekibu == 'C') 
		{		
			$sekibue = 1;
		}
		elseif($kodesekibu == 'D')
		{		
			$sekibue = 2;
		}
		elseif($kodesekibu == 'E')
		{		
			$sekibue = 5;
		}
		elseif($kodesekibu == 'F') 
		{		
			$sekibue = 6;
		}
		elseif($kodesekibu == 'G') 
		{		
			$sekibue = 7;
		}
		elseif($kodesekibu == 'H') 
		{		
			$sekibue = 8;
		}
		elseif($kodesekibu == 'I') 
		{		
			$sekibue = 9;
		}
		else
		{
			$sekibue = '0';
		}
		$this->excel->getActiveSheet()->setCellValue('BD'.$baris,$sekibue);
		//pibu
		$pibu = $b->pibu;
		$tpibu = $this->db->query("SELECT * FROM `m_pekerjaan` where `nama_pekerjaan` = '$pibu'");
		$kodepibu = '';
		foreach($tpibu->result() as $dpibu)
		{
			$kodepibu = $dpibu->kode_pekerjaan;
		}

		if($kodepibu == 'A')
		{
			$kodepibue = '03';
		}
		elseif($kodepibu == 'B')
		{
			$kodepibue = '04';
		}
		elseif($kodepibu == 'C')
		{
			$kodepibue = '05';
		}
		elseif($kodepibu == 'D')
		{
			$kodepibue = '10';
		}	
		elseif($kodepibu == 'E')
		{
			$kodepibue = '17';
		}
		elseif($kodepibu == 'F')
		{
			$kodepibue = '06';
		}
		elseif($kodepibu == 'G')
		{
			$kodepibue = '07';
		}
		elseif($kodepibu == 'H')
		{
			$kodepibue = '13';
		}
		elseif($kodepibu == 'I')
		{
			$kodepibue = '09';
		}
		elseif($kodepibu == 'J')
		{
			$kodepibue = '15';
		}
		elseif($kodepibu == 'K')
		{
			$kodepibue = '01';
		}
		else
		{
			$kodepibue = '18';
		}
		$this->excel->getActiveSheet()->setCellValue('BE'.$baris,$kodepibue);
		//dortu
		$dortu = $b->dortu;
		$tdortu = $this->db->query("SELECT * FROM `m_duit` where `besar` = '$dortu'");
		$kodedortu = '';
		foreach($tdortu->result() as $ddortu)
		{
			$kodedortu = $ddortu->besar;
		}

		if($kodedortu == 'B')
		{
			$kodedortue = '2';
		}
		elseif($kodedortu == 'C')
		{
			$kodedortue = '3';
		}
		elseif($kodedortu == 'D')
		{
			$kodedortue = '3';
		}	
		elseif($kodedortu == 'E')
		{
			$kodedortue = '4';
		}
		elseif($kodedortu == 'F')
		{
			$kodedortue = '4';
		}
		elseif($kodedortu == 'G')
		{
			$kodedortue = '5';
		}
		elseif($kodedortu == 'H')
		{
			$kodedortue = '5';
		}
		elseif($kodedortu == 'I')
		{
			$kodedortue = '5';
		}
		elseif($kodedortu == 'J')
		{
			$kodedortue = '6';
		}
		else
		{
			$kodedortue = '1';
		}
		$this->excel->getActiveSheet()->setCellValue('BF'.$baris,$kodedortue);
		$this->excel->getActiveSheet()->getCell('BG'.$baris)->setValueExplicit($b->kps, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('BH'.$baris)->setValueExplicit($b->pkh, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('BI'.$baris)->setValueExplicit($b->kip, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('BJ'.$baris,$bsm);
		if($bsm == 1)
		{
			$this->excel->getActiveSheet()->setCellValue('BK'.$baris,$alasan_bsm);
		}
		else
		{
			$this->excel->getActiveSheet()->setCellValue('BK'.$baris,'');
		}

		$this->excel->getActiveSheet()->setCellValue('BL'.$baris,$adatc);
		$this->excel->getActiveSheet()->setCellValue('BV'.$baris,'1');
		$kodewali = cari_walikelas($thnajaran,$semester,$kelas);
		$namawali = cari_nama_pegawai($kodewali);
		$this->excel->getActiveSheet()->setCellValue('BW'.$baris,$namawali);
		$this->excel->getActiveSheet()->setCellValue('BX'.$baris,$b->npsn_sltp);
		$this->excel->getActiveSheet()->setCellValue('BY'.$baris,$b->no_blanko_skhun);
		$this->excel->getActiveSheet()->setCellValue('BZ'.$baris,$b->nosttb);
		$tanggalsttb = tanggal_slash($b->tglsttb);
		$this->excel->getActiveSheet()->setCellValue('CB'.$baris,$tanggalsttb);
		$this->excel->getActiveSheet()->setCellValue('CC'.$baris,$b->nmwali);
		$tahunwali = substr($b->tglwali,0,4);
		$this->excel->getActiveSheet()->setCellValue('CD'.$baris,$tahunwali);
		$this->excel->getActiveSheet()->getCell('CE'.$baris)->setValueExplicit($b->nik_wali, PHPExcel_Cell_DataType::TYPE_STRING);
		$sekwali = $b->sekwali;
		$tsekwali = $this->db->query("SELECT * FROM `m_sekolah` where `jenjang` = '$sekwali'");
		$kodesekwali = '';
		foreach($tsekwali->result() as $dsekwali)
		{
			$kodesekwali = $dsekwali->kode;
		}
		if($kodesekwali == 'A')
		{
			$sekwalie = 0;
		}
		elseif($kodesekwali == 'B') 
		{		
			$sekwalie = 1;
		}

		elseif($kodesekwali == 'C') 
		{		
			$sekwalie = 1;
		}
		elseif($kodesekwali == 'D')
		{		
			$sekwalie = 2;
		}
		elseif($kodesekwali == 'E')
		{		
			$sekwalie = 5;
		}
		elseif($kodesekwali == 'F') 
		{		
			$sekwalie = 6;
		}
		elseif($kodesekwali == 'G') 
		{		
			$sekwalie = 7;
		}
		elseif($kodesekwali == 'H') 
		{		
			$sekwalie = 8;
		}
		elseif($kodesekwali == 'I') 
		{		
			$sekwalie = 9;
		}
		else
		{
			$sekwalie = '0';
		}
		$this->excel->getActiveSheet()->setCellValue('CF'.$baris,$sekwalie);

		//pwali
		$pwali = $b->pwali;
		$tpwali = $this->db->query("SELECT * FROM `m_pekerjaan` where `nama_pekerjaan` = '$pwali'");
		$kodepwali = '';
		foreach($tpwali->result() as $dpwali)
		{
			$kodepwali = $dpwali->kode_pekerjaan;
		}

		if($kodepwali == 'A')
		{
			$kodepwalie = '03';
		}
		elseif($kodepwali == 'B')
		{
			$kodepwalie = '04';
		}
		elseif($kodepwali == 'C')
		{
			$kodepwalie = '05';
		}
		elseif($kodepwali == 'D')
		{
			$kodepwalie = '10';
		}	
		elseif($kodepwali == 'E')
		{
			$kodepwalie = '17';
		}
		elseif($kodepwali == 'F')
		{
			$kodepwalie = '06';
		}
		elseif($kodepwali == 'G')
		{
			$kodepwalie = '07';
		}
		elseif($kodepwali == 'H')
		{
			$kodepwalie = '13';
		}
		elseif($kodepwali == 'I')
		{
			$kodepwalie = '09';
		}
		elseif($kodepwali == 'J')
		{
			$kodepwalie = '15';
		}
		elseif($kodepwali == 'K')
		{
			$kodepwalie = '01';
		}
		else
		{
			$kodepwalie = '18';
		}
		$this->excel->getActiveSheet()->setCellValue('CG'.$baris,$kodepwalie);
		//dwali
		$dwali = $b->dwali;
		$tdwali = $this->db->query("SELECT * FROM `m_duit` where `besar` = '$dwali'");
		$kodedwali = '';
		foreach($tdwali->result() as $ddwali)
		{
			$kodedwali = $ddwali->besar;
		}

		if($kodedwali == 'B')
		{
			$kodedwalie = '2';
		}
		elseif($kodedwali == 'C')
		{
			$kodedwalie = '3';
		}
		elseif($kodedwali == 'D')
		{
			$kodedwalie = '3';
		}	
		elseif($kodedwali == 'E')
		{
			$kodedwalie = '4';
		}
		elseif($kodedwali == 'F')
		{
			$kodedwalie = '4';
		}
		elseif($kodedwali == 'G')
		{
			$kodedwalie = '5';
		}
		elseif($kodedwali == 'H')
		{
			$kodedwalie = '5';
		}
		elseif($kodedwali == 'I')
		{
			$kodedwalie = '5';
		}
		elseif($kodedwali == 'J')
		{
			$kodedwalie = '6';
		}
		else
		{
			$kodedwalie = '1';
		}
		if(!empty($b->nmwali))
		{
			$this->excel->getActiveSheet()->setCellValue('CH'.$baris,$kodedwalie);
		}
		else
		{
			$this->excel->getActiveSheet()->setCellValue('CH'.$baris,'');
		}
		if($b->jenrumah == 'Pribadi')
		{
			$jenrumah = '1';
		}
		elseif($b->jenrumah == 'Kontrak')
		{
			$jenrumah = '4';
		}
		elseif($b->jenrumah == 'Kost')
		{
			$jenrumah = '4';
		}
		elseif($b->jenrumah == 'Asrama')
		{
			$jenrumah = '4';
		}
		else
		{
			$jenrumah = '7';
		}
		$this->excel->getActiveSheet()->setCellValue('CI'.$baris,$jenrumah);
		$this->excel->getActiveSheet()->setCellValue('CJ'.$baris,'');
		$nomor++;
		$baris++;
	} //akhir foreach $tb
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
// akhir unduh xls
