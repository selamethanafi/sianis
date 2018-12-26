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
$ta = $this->db->query("select * from `p_pegawai` where `status`='Y' order by guru DESC");
$thnajarane = berkas($thnajaran);
$filename = 'data_personal_tahun_'.$thnajarane.'.xls'; 
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data personal';
$baris=1;
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('K1','NIP/NIGNP');
$this->excel->getActiveSheet()->setCellValue('L1', 'NUPTK/PEGID');
$this->excel->getActiveSheet()->setCellValue('M1', 'Nama Lengkap');
$this->excel->getActiveSheet()->setCellValue('N1','NIK');
$this->excel->getActiveSheet()->setCellValue('O1','TEMPAT LAHIR');
$this->excel->getActiveSheet()->setCellValue('P1','TGL LAHIR (DD/MM/YYYY)');
$this->excel->getActiveSheet()->setCellValue('Q1','JENIS KELAMIN');
$this->excel->getActiveSheet()->setCellValue('R1','Nama Ibu Kandung');
$this->excel->getActiveSheet()->setCellValue('S1','Jenjang');
$this->excel->getActiveSheet()->setCellValue('T1','Kelompok Program Studi');
$this->excel->getActiveSheet()->setCellValue('U1','Status Kepegawaian');
$this->excel->getActiveSheet()->setCellValue('V1','Status Inpassing');
$this->excel->getActiveSheet()->setCellValue('W1','TMT Inpassing');
$this->excel->getActiveSheet()->setCellValue('X1','Golongan');
$this->excel->getActiveSheet()->setCellValue('Y1','TMT SK CPNS');
$this->excel->getActiveSheet()->setCellValue('Z1','TMT SK Awal');
$this->excel->getActiveSheet()->setCellValue('AA1','TMT SK Terakhir');
$this->excel->getActiveSheet()->setCellValue('AB1','Instansi');
$this->excel->getActiveSheet()->setCellValue('AC1','STATUS Penugasan');
$this->excel->getActiveSheet()->setCellValue('AD1','Gaji pokok Per bulan');
$this->excel->getActiveSheet()->setCellValue('AE1','Status Tempat Tugas');
$this->excel->getActiveSheet()->setCellValue('AF1','Jenis Satminkal');
$this->excel->getActiveSheet()->setCellValue('AG1','NPSN Satminkal');
$this->excel->getActiveSheet()->setCellValue('AH1','Tugas Utama');
$this->excel->getActiveSheet()->setCellValue('AI1','Status Keaktifan');
$this->excel->getActiveSheet()->setCellValue('AJ1','Mapel yang diampu');
$this->excel->getActiveSheet()->setCellValue('AK1','Total Jam Tatap');
$this->excel->getActiveSheet()->setCellValue('AL1','Tugas Tenaga Kependidikan');
$this->excel->getActiveSheet()->setCellValue('AM1','Tugas Tambahan');
$this->excel->getActiveSheet()->setCellValue('AN1','Ekuivalensi');
$this->excel->getActiveSheet()->setCellValue('AO1','Jenis Tugas di tempat lain');
$this->excel->getActiveSheet()->setCellValue('AP1','NPSN Sekolah Lain');
$this->excel->getActiveSheet()->setCellValue('AQ1','Mapel Di Sekolah Lain');
$this->excel->getActiveSheet()->setCellValue('AR1','JTM di Sekolah Lain');
$this->excel->getActiveSheet()->setCellValue('AS1','Status Peserta Sertifikasi');
$this->excel->getActiveSheet()->setCellValue('AT1','Status Kelulusan Sertifikasi');
$this->excel->getActiveSheet()->setCellValue('AU1','Tahun Lulus');
$this->excel->getActiveSheet()->setCellValue('AV1','Mapel Sertifikasi');
$this->excel->getActiveSheet()->setCellValue('AW1','NRG');
$this->excel->getActiveSheet()->setCellValue('AX1','Nomor SK NRG');
$this->excel->getActiveSheet()->setCellValue('AY1','Tanggal SK NRG');
$this->excel->getActiveSheet()->setCellValue('AZ1','Status Penerima TPG');
$this->excel->getActiveSheet()->setCellValue('BA1','Mulai Menerima');
$this->excel->getActiveSheet()->setCellValue('BB1','Besar TPG');
$this->excel->getActiveSheet()->setCellValue('BC1','Status Penerima TFG');
$this->excel->getActiveSheet()->setCellValue('BD1','Tahun Menerima TFG');
$this->excel->getActiveSheet()->setCellValue('BE1','Besar TFG');
$this->excel->getActiveSheet()->setCellValue('BF1','penghargaan');
$this->excel->getActiveSheet()->setCellValue('BG1','Bidang Penghargaan');
$this->excel->getActiveSheet()->setCellValue('BH1','Tingkat Penghargaan');
$this->excel->getActiveSheet()->setCellValue('BI1','Tahun Perolehan Penghargaan');
$this->excel->getActiveSheet()->setCellValue('BJ1','Pelatihan Kepribadian (Kepala)');
$this->excel->getActiveSheet()->setCellValue('BK1','Tahun Pelatihan Kepribadian (Kepala)');
$this->excel->getActiveSheet()->setCellValue('BL1','Pelatihan Manajerial');
$this->excel->getActiveSheet()->setCellValue('BM1','Tahun Pelatihan Manajerial');
$this->excel->getActiveSheet()->setCellValue('BN1','Pelatihan Wirausaha');
$this->excel->getActiveSheet()->setCellValue('BO1','Tahun Pelatihan Wirausaha');
$this->excel->getActiveSheet()->setCellValue('BP1','Pelatihan Supervisi');
$this->excel->getActiveSheet()->setCellValue('BQ1','Tahun Pelatihan Supervisi');
$this->excel->getActiveSheet()->setCellValue('BR1','Pelatihan Sosial');
$this->excel->getActiveSheet()->setCellValue('BS1','Tahun Pelatihan Sosial');
$this->excel->getActiveSheet()->setCellValue('BT1','Alamat'); // BULAN
$this->excel->getActiveSheet()->setCellValue('BU1','Prov');
$this->excel->getActiveSheet()->setCellValue('BV1','Kabupaten');
$this->excel->getActiveSheet()->setCellValue('BW1','Kecamatan');
$this->excel->getActiveSheet()->setCellValue('BX1','Desa');
$this->excel->getActiveSheet()->setCellValue('BY1','Kode Pos');
$this->excel->getActiveSheet()->setCellValue('BZ1','Jarak Rumah Ke Madrasah');
$this->excel->getActiveSheet()->setCellValue('CA1','Transportasi ke Madrasah');
$this->excel->getActiveSheet()->setCellValue('CB1','Nomor HP');
$this->excel->getActiveSheet()->setCellValue('CC1','Status Rumah / Tempat Tinggal');
$this->excel->getActiveSheet()->setCellValue('CD1','Agama PTK');
$this->excel->getActiveSheet()->setCellValue('CE1','Prodi S1/D4');
$this->excel->getActiveSheet()->setCellValue('CF1','Gelar S1/D4');
$this->excel->getActiveSheet()->setCellValue('CG1','Tahun S1/D4');
$this->excel->getActiveSheet()->setCellValue('CH1','Prodi S2');
$this->excel->getActiveSheet()->setCellValue('CI1','Gelar S2');
$this->excel->getActiveSheet()->setCellValue('CJ1','Tahun S2');
$this->excel->getActiveSheet()->setCellValue('CK1','Prodi S3');
$this->excel->getActiveSheet()->setCellValue('CL1','Gelar S3');
$this->excel->getActiveSheet()->setCellValue('CM1','Tahun S3');
$this->excel->getActiveSheet()->setCellValue('CN1','Nomor SK Guru Tetap NonPNS');
$this->excel->getActiveSheet()->setCellValue('CO1','Tanggal SK Guru Tetap NonPNS');
$this->excel->getActiveSheet()->setCellValue('CP1','Nomor SK Inpassing');
$this->excel->getActiveSheet()->setCellValue('CQ1','Tanggal SK Inpassing');
$this->excel->getActiveSheet()->setCellValue('CR1','Nomor Peserta Sertifikasi');
$this->excel->getActiveSheet()->setCellValue('CS1','Jalur Sertifikasi');
$this->excel->getActiveSheet()->setCellValue('CT1','Tanggal Lulus Sertifikasi');
$this->excel->getActiveSheet()->setCellValue('CU1','Nomor Sertifikat Pendidik');
$this->excel->getActiveSheet()->setCellValue('CV1','Tanggal Sertifikat');
$this->excel->getActiveSheet()->setCellValue('CW1','Kode LPTK');
$baris++;
$nomor = 1;
foreach($ta->result() as $a)
{	
	$username = $a->kd;
	$nip = $a->nip;
	$kode_mapel_utama = $a->kode_mapel_utama;
	if(!empty($nip))
	{
		$this->excel->getActiveSheet()->getCell('K'.$baris)->setValueExplicit($nip, PHPExcel_Cell_DataType::TYPE_STRING);
	}	
	else
	{
		$nip = '';
		if(!empty($kode_mapel_utama))
		{
		$nip = $this->config->item('sek_nsm').''.$a->kode_mapel_utama.'00';
		}
		$this->excel->getActiveSheet()->getCell('K'.$baris)->setValueExplicit($nip, PHPExcel_Cell_DataType::TYPE_STRING);

	}
	$nuptk = $a->nuptk;
	if(empty($nuptk))
	{
		$pegid = $a->pegid;	
		if(empty($pegid))
		{
			$nuptk = '';
		}
		else
		{
			$nuptk = 'ID'.$pegid;
		}
	}
	$this->excel->getActiveSheet()->getCell('L'.$baris)->setValueExplicit($nuptk, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->setCellValue('M'.$baris,$a->nama);
	$this->excel->getActiveSheet()->getCell('N'.$baris)->setValueExplicit($a->nik, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->setCellValue('O'.$baris,$a->tempat);
	$tanggallahir = tanggal_slash($a->tanggallahir);
	$this->excel->getActiveSheet()->setCellValue('P'.$baris,$tanggallahir);
	$this->excel->getActiveSheet()->setCellValue('Q'.$baris,substr($a->jenkel,0,1));
	$this->excel->getActiveSheet()->setCellValue('R'.$baris,$a->ibu);
	//pendidikan
	$tb = $this->db->query("select * from `p_pendidikan` where `idpegawai` = '$username' order by tahunlulus DESC limit 0,1" );
	$jenjang = '';
	$kelprodi = '';
	foreach($tb->result() as $b)
	{
		$jenjang = $b->tingkat;
		$kelprodi = $b->kelprodi;
	}
	if($jenjang == 'SD')
	{
		$jenjange = 1;
	}
	elseif($jenjang == 'SLTP')
	{
		$jenjange = 1;
	}
	elseif($jenjang == 'SLTA')
	{
		$jenjange = 2;
	}
	elseif($jenjang == 'DI')
	{
		$jenjange = 3;
	}
	elseif($jenjang == 'DII')
	{
		$jenjange = 4;
	}
	elseif($jenjang == 'DIII')
	{
		$jenjange = 5;
	}
	elseif($jenjang == 'DIV')
	{
		$jenjange = 6;
	}
	elseif($jenjang == 'S1')
	{
		$jenjange = 7;
	}
	elseif($jenjang == 'S2')
	{
		$jenjange = 8;
	}
	elseif($jenjang == 'S3')
	{
		$jenjange = 9;
	}
	else
	{
		$jenjange = 0;
	}
	$this->excel->getActiveSheet()->setCellValue('S'.$baris,$jenjange);
	$this->excel->getActiveSheet()->setCellValue('T'.$baris,$kelprodi);
	//pns atau bukan
	$pns = 0;
	if(($a->status_kepegawaian == 'CPNS') or ($a->status_kepegawaian == 'PNS'))
	{
		$pns = 1;
	}
	$this->excel->getActiveSheet()->setCellValue('U'.$baris,$pns);
	$this->excel->getActiveSheet()->setCellValue('V'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('W'.$baris,'');
	$tkepegx = $this->db->query("select * from p_kepegawaian where idpegawai = '$username' and (`jenis_sk`= 'SK PNS' or `jenis_sk`= 'PNS' or `jenis_sk`= 'SK KP') order by tanggal DESC limit 0,1 ");
	$tmt_skterakhir = '';
	foreach($tkepegx->result() as $dkepegx)
	{
		$golonganx = substr($dkepegx->gol,3,10);
		$tmt_skterakhir = tanggal_slash($dkepegx->tmt);
		if($golonganx=='II/a')
		{
			$gol = '02';
		}
		elseif($golonganx=='II/b')
		{
			$gol = '03';
		}
		elseif($golonganx=='II/c')
		{
			$gol = '04';
		}
		elseif($golonganx=='II/d')
		{
			$gol = '05';
		}
		elseif($golonganx=='III/a')
		{
			$gol = '06';
		}
		elseif($golonganx=='III/b')
		{
			$gol = '07';
		}
		elseif($golonganx=='III/c')
		{
			$gol = '08';
		}
		elseif($golonganx=='III/d')
		{
			$gol = '09';
		}
		elseif($golonganx=='IV/a')
		{
			$gol = '10';
		}
		elseif($golonganx=='IV/b')
		{
			$gol = '11';
		}
		elseif($golonganx=='IV/c')
		{
			$gol = '12';
		}
		elseif($golonganx=='IV/d')
		{
			$gol = '13';
		}
		elseif($golonganx=='IV/e')
		{
			$gol = '14';
		}
		else
		{
			$gol = '01';
		}
	$this->excel->getActiveSheet()->setCellValue('X'.$baris,$gol);
	}
	$tkepegx = $this->db->query("select * from p_kepegawaian where idpegawai = '$username' and `jenis_sk` = 'SK CPNS' order by tanggal DESC limit 0,1 ");
	$tanggalcpns = '';
	foreach($tkepegx->result() as $dkepegx)
	{
		$tanggalcpns = tanggal_slash($dkepegx->tmt);
	}
	$this->excel->getActiveSheet()->setCellValue('Y'.$baris,$tanggalcpns);
	$this->excel->getActiveSheet()->setCellValue('Z'.$baris,tanggal($a->tmt_guru));
	$this->excel->getActiveSheet()->setCellValue('AA'.$baris,$tmt_skterakhir);
	$this->excel->getActiveSheet()->setCellValue('AB'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AC'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AD'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AE'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AF'.$baris,'3');
	$this->excel->getActiveSheet()->setCellValue('AG'.$baris,'');
	$jtm = '';
	if($a->guru == 'Y')
	{
		$kodeguru = $a->kode;
		$tc = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
		foreach($tc->result() as $c)
		{
			$jtm = $jtm + $c->jam;
		}
		$this->excel->getActiveSheet()->setCellValue('AH'.$baris,'1');
	}
	else
	{
		$this->excel->getActiveSheet()->setCellValue('AH'.$baris,'2');
	}
	$this->excel->getActiveSheet()->setCellValue('AI'.$baris,'1');
	$this->excel->getActiveSheet()->setCellValue('AJ'.$baris,$a->kode_mapel_utama);
	$this->excel->getActiveSheet()->setCellValue('AK'.$baris,$jtm);
	$this->excel->getActiveSheet()->setCellValue('AL'.$baris,'');
	$td = $this->db->query("select * from `p_tugas_tambahan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	$tambahan = '';
	foreach($td->result() as $d)
	{
		$tambahan = $d->nama_tugas;
	}
	if($tambahan == 'Kepala Madrasah')
	{
		$tambahane = 1;
	}
	elseif($tambahan == 'Waka Madrasah Kurikulum')
	{
		$tambahane = 2;
	}
	elseif($tambahan == 'Waka Madrasah Sarana Prasarana')
	{
		$tambahane = 2;
	}
	elseif($tambahan == 'Waka Madrasah Kesiswaan')
	{
		$tambahane = 2;
	}
	elseif($tambahan == 'Waka Madrasah Humas')
	{
		$tambahane = 2;
	}
	elseif($tambahan == 'Kepala Laboratorium Kimia')
	{
		$tambahane = 4;
	}
	elseif($tambahan == 'Kepala Laboratorium Bahasa')
	{
		$tambahane = 4;
	}
	elseif($tambahan == 'Kepala Laboratorium Biologi')
	{
		$tambahane = 4;
	}
	elseif($tambahan == 'Kepala Laboratorium Fisika')
	{
		$tambahane = 4;
	}
	elseif($tambahan == 'Kepala Laboratorium IPA')
	{
		$tambahane = 4;
	}
	elseif($tambahan == 'Kepala Laboratorium IPS')
	{
		$tambahane = 4;
	}
	elseif($tambahan == 'Kepala Laboratorium Keterampilan')
	{
		$tambahane = 4;
	}
	elseif($tambahan == 'Kepala Laboratorium TIK')
	{
		$tambahane = 4;
	}
	elseif($tambahan == 'Kepala Perpustakaan')
	{
		$tambahane = 3;
	}
	else
	{
		$tambahane = '';
	}
	$this->excel->getActiveSheet()->setCellValue('AM'.$baris,$tambahane);
	$this->excel->getActiveSheet()->setCellValue('AN'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AO'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AP'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AQ'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AR'.$baris,'');
	if($a->sudah_sertifikasi == 'Ya')
	{
		$this->excel->getActiveSheet()->setCellValue('AS'.$baris,'1');
	}
	else
	{
		$this->excel->getActiveSheet()->setCellValue('AS'.$baris,'0');
	}
	if($a->sudah_sertifikasi == 'Ya')
	{
		if($a->lulus_sertifikasi == 'Ya')
		{
			$this->excel->getActiveSheet()->setCellValue('AT'.$baris,'1');
		}
	}
	else
	{
		$this->excel->getActiveSheet()->setCellValue('AT'.$baris,'');
	}
	$this->excel->getActiveSheet()->setCellValue('AU'.$baris,substr($a->tgl_lulus_sertifikasi,0,4));
	$this->excel->getActiveSheet()->getCell('AW'.$baris)->setValueExplicit($a->nrg, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->setCellValue('AZ'.$baris,$a->status_penerima_tpg);
	$this->excel->getActiveSheet()->setCellValue('BA'.$baris,$a->tpg_pertama);
/*
	$this->excel->getActiveSheet()->setCellValue('AX'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('AY'.$baris,'');


	$this->excel->getActiveSheet()->setCellValue('BB'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BC'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BD'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BE'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BF'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BG'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BH'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BI'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BJ'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BK'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BL'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BM'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BN'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BO'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BP'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BQ'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BR'.$baris,'');
	$this->excel->getActiveSheet()->setCellValue('BS'.$baris,'');
*/
	//alamat
	$alamat = '';
	if(!empty($a->jalan))
	{
		$alamat .= $a->jalan;
	}
	if(!empty($a->rt))
	{
		if(empty($alamat))
		{
			$alamat .= 'RT '.$a->rt;
		}
		else
		{
			$alamat .= ' RT '.$a->rt;
		}
	}
	if(!empty($a->rw))
	{
		if(empty($alamat))
		{
			$alamat .= 'RW '.$a->rw;
		}
		else
		{
			$alamat .= ' RW '.$a->rw;
		}
	}
	$this->excel->getActiveSheet()->setCellValue('BT'.$baris,$alamat);
	$this->excel->getActiveSheet()->setCellValue('BU'.$baris,$a->provinsi);
	$this->excel->getActiveSheet()->setCellValue('BV'.$baris,$a->kabupaten);
	$this->excel->getActiveSheet()->setCellValue('BW'.$baris,$a->kecamatan);
	$this->excel->getActiveSheet()->setCellValue('BX'.$baris,$a->desa);
	$this->excel->getActiveSheet()->setCellValue('BY'.$baris,$a->kodepos);
	$this->excel->getActiveSheet()->setCellValue('CB'.$baris,$a->seluler);
	$this->excel->getActiveSheet()->setCellValue('CC'.$baris,'1');
	$this->excel->getActiveSheet()->setCellValue('CD'.$baris,'1');
	$tb = $this->db->query("select * from `p_pendidikan` where `idpegawai` = '$username' and `tingkat`='S1' limit 0,1" );
	foreach($tb->result() as $b)
	{
		$this->excel->getActiveSheet()->setCellValue('CE'.$baris,$b->kelprodi);
		$this->excel->getActiveSheet()->setCellValue('CF'.$baris,$b->gelar);
		$this->excel->getActiveSheet()->setCellValue('CG'.$baris,$b->tahunlulus);
	}
	$tb = $this->db->query("select * from `p_pendidikan` where `idpegawai` = '$username' and `tingkat`='S2' limit 0,1" );
	foreach($tb->result() as $b)
	{
		$this->excel->getActiveSheet()->setCellValue('CH'.$baris,$b->kelprodi);
		$this->excel->getActiveSheet()->setCellValue('CI'.$baris,$b->gelar);
		$this->excel->getActiveSheet()->setCellValue('CJ'.$baris,$b->tahunlulus);
	}
	$tb = $this->db->query("select * from `p_pendidikan` where `idpegawai` = '$username' and `tingkat`='S3' limit 0,1" );
	foreach($tb->result() as $b)
	{
		$this->excel->getActiveSheet()->setCellValue('CK'.$baris,$b->kelprodi);
		$this->excel->getActiveSheet()->setCellValue('CL'.$baris,$b->gelar);
		$this->excel->getActiveSheet()->setCellValue('CM'.$baris,$b->tahunlulus);
	}
	$this->excel->getActiveSheet()->getCell('CR'.$baris)->setValueExplicit($a->no_peserta_sertifikasi, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->setCellValue('CS'.$baris,$a->jalur_sertifikasi);
	if($a->lulus_sertifikasi == 'Ya')
	{
		$this->excel->getActiveSheet()->setCellValue('CT'.$baris,tanggal_slash($a->tgl_lulus_sertifikasi));
		$this->excel->getActiveSheet()->getCell('CU'.$baris)->setValueExplicit($a->no_sertifikat, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('CV'.$baris,tanggal_slash($a->tanggal_sertifikat));
		$this->excel->getActiveSheet()->setCellValue('CW'.$baris,$a->kode_lptk);
	}

	$nomor++;
	$baris++;
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
// akhir unduh xls
