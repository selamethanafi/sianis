<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 16 Jan 2015 08:43:21 WIB 
// Nama Berkas 		: unduh_skp.php
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
$namasekolah = $this->config->item('sek_nama');

$awal = $tahun - 1 ;
$akhir = $tahun;
$thnajaran = $awal."/".$akhir;
$semester = 2;
$tkepeg = $this->db->query("select * from `p_tugas_tambahan` where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kode'");
$adatambahan = 0;
$tambahan = '';
foreach($tkepeg->result() as $dkepeg)
	{
	$tambahan = $dkepeg->nama_tugas;
	}
$ty = $this->db->query("select * from `pkg_masa` where tahun = '$tahun'");
foreach($ty->result() as $dy)
{
	$tpejabat = date_to_long_string($dy->tpejabat);
	$tybs = date_to_long_string($dy->tybs);
	$tatasanpejabat = date_to_long_string($dy->tatasanpejabat);
	$t1 = $dy->awal;
	$t2 = $dy->akhir;

}
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$kode'");
$permanen = 1;
foreach($tz->result() as $z)
	{
	if($item == 'borang')
	{
		$permanen = $z->permanen;
	}
	else
	{
		$permanen = $z->kepala;
	}
	$pelayanan =  $z->pelayanan;
 	$integritas = $z->integritas;
	$komitmen = $z->komitmen;
	$disiplin = $z->disiplin;
	$kerjasama = $z->kerjasama;
	$kepemimpinan = $z->kepemimpinan;
	$pelayanan =  $pelayanan / 12;
 	$integritas = $integritas / 12;
	$komitmen = $komitmen / 12;
	$disiplin = $disiplin / 12;
	$kerjasama = $kerjasama / 12;
	$kepemimpinan = $kepemimpinan / 12;
	if($kepemimpinan > 0)
	{
		$jumlah = $pelayanan + 	$integritas + $komitmen + $disiplin + $kerjasama + $kepemimpinan;
		$rata = $jumlah / 6;
	}
	else
	{
		$jumlah = $pelayanan + 	$integritas + $komitmen + $disiplin + $kerjasama;
		$kepemimpinan = '-';
		$rata = $jumlah / 5;
	}
	$jumlah = round($jumlah,2);
	$rata = round($rata,2);
	$idskawal = $z->skawal;
	$idskakhir = $z->skakhir;
	$tawal = $z->tawal;
	$takhir = $z->takhir;
	}
$gol1 = id_sk_jadi_golongan($idskawal);
$pangkat1 = golongan_jadi_pangkat($gol1);
$jabatan1 = golongan_jadi_jabatan($gol1);
$pangkatgolongan1 = $pangkat1.', '.$gol1;
$gol2 = id_sk_jadi_golongan($idskakhir);
$pangkat2 = golongan_jadi_pangkat($gol2);
$jabatan2 = golongan_jadi_jabatan($gol2);
$pangkatgolongan2 = $pangkat2.', '.$gol2;
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
$bisa1=0;
$pesan = '';

//$golongan = trim(golongan($kode,$thnajaran,$semester));
if (($gol1=='III/a') or ($gol1=='III/b') or ($gol1=='III/c') or ($gol1=='III/d') or ($gol1=='IV/a') or ($gol1=='IV/b') or ($gol1=='IV/c') or ($gol1=='IV/d'))
{
$bisa = 1;
$pesan = '';
}
else
{
$pesan .= 'Golongan '.$golongan.'   tidak sesuai dengan aplikasi';
$bisa = 0;
}

if($permanen == 1)
{
$bisa1 = 1;
}
//cari skp
//akhir skp
if (($bisa == 1) and ($bisa1 == 1))
{

$judul = 'data';
$tx = $this->db->query("select * from p_pegawai where `nip`='$kode'");
foreach($tx->result() as $x)
{
	$nippegawai = $x->nip;
	$tempat = $x->tempat;
	$tgllhr = $x->tanggallahir;
	$usernamepegawai = $x->kd;
	$tmtguru = $x->tmt_guru;
	$jenkel = $x->jenkel;
	$namapegawai = $x->nama;
//	$tipepegawai 
}
$namaberkas = berkas($namapegawai);
$filename = 'data_'.$item.'_'.$namaberkas.'_'.$kode.'_'.$tahun.'.xls';
$tanggalawal = date_to_long_string($tawal);
$tanggalakhir= date_to_long_string($takhir);
$tskp = date_to_long_string($t1);
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Worksheet');
$this->excel->getActiveSheet()->setCellValue('A1','DATA SASARAN KERJA PEGAWAI');
$this->excel->getActiveSheet()->setCellValue('A3','INSTANSI INDUK');
$this->excel->getActiveSheet()->setCellValue('C3',$namasekolah);
$this->excel->getActiveSheet()->setCellValue('d3',$this->config->item('lokasi'));
$this->excel->getActiveSheet()->setCellValue('A4','JANGKA WAKTU PENILAIAN');
$this->excel->getActiveSheet()->setCellValueExplicit('C4',$tanggalawal, PHPExcel_Cell_DataType::TYPE_STRING);
$this->excel->getActiveSheet()->setCellValueExplicit('E4',$tanggalakhir, PHPExcel_Cell_DataType::TYPE_STRING);
$this->excel->getActiveSheet()->setCellValueExplicit('G4',$tskp, PHPExcel_Cell_DataType::TYPE_STRING);
$this->excel->getActiveSheet()->setCellValue('A5','1. YANG DINILAI');
$this->excel->getActiveSheet()->setCellValue('E5','Pelayanan');
$this->excel->getActiveSheet()->setCellValue('F5','integritas');
$this->excel->getActiveSheet()->setCellValue('G5','komitmen');
$this->excel->getActiveSheet()->setCellValue('H5','disiplin');
$this->excel->getActiveSheet()->setCellValue('I5','kerjasama');
$this->excel->getActiveSheet()->setCellValue('J5','kepemimpinan');
$this->excel->getActiveSheet()->setCellValue('K5','jumlah');
$this->excel->getActiveSheet()->setCellValue('L5','rata');
$this->excel->getActiveSheet()->setCellValue('M5','cacah skp');
$this->excel->getActiveSheet()->setCellValue('E6',$pelayanan);
$this->excel->getActiveSheet()->setCellValue('F6',$integritas);
$this->excel->getActiveSheet()->setCellValue('G6',$komitmen);
$this->excel->getActiveSheet()->setCellValue('H6',$disiplin);
$this->excel->getActiveSheet()->setCellValue('I6',$kerjasama);
$this->excel->getActiveSheet()->setCellValue('J6',$kepemimpinan);
$this->excel->getActiveSheet()->setCellValue('K6',$jumlah);
$this->excel->getActiveSheet()->setCellValue('L6',$rata);
$this->excel->getActiveSheet()->setCellValue('A6','a. Nama');
$this->excel->getActiveSheet()->setCellValue('C6',$namapegawai);
$this->excel->getActiveSheet()->setCellValue('A7','b. NIP');
$this->excel->getActiveSheet()->setCellValueExplicit('C7',$nippegawai, PHPExcel_Cell_DataType::TYPE_STRING);
$this->excel->getActiveSheet()->setCellValue('E7','Penilai');
$this->excel->getActiveSheet()->setCellValue('F7','Ybs');
$this->excel->getActiveSheet()->setCellValue('G7','Atasan');
$this->excel->getActiveSheet()->setCellValue('E8',$tpejabat);
$this->excel->getActiveSheet()->setCellValue('F8',$tybs);
$this->excel->getActiveSheet()->setCellValue('G8',$tatasanpejabat);

//$this->excel->getActiveSheet()->setCellValue('C7',$nippegawai);
$this->excel->getActiveSheet()->setCellValue('A8','c. Pangkat/Gol.Ruang');
$this->excel->getActiveSheet()->setCellValue('C8',$pangkat1.', '.$gol1);
$this->excel->getActiveSheet()->setCellValue('D8',$pangkat2.', '.$gol2);
$this->excel->getActiveSheet()->setCellValue('A9','d. Jabatan');
$this->excel->getActiveSheet()->setCellValue('C9',$jabatan1);
$this->excel->getActiveSheet()->setCellValue('D9',$jabatan1);
$this->excel->getActiveSheet()->setCellValue('A10','e. Unit Kerja');
$this->excel->getActiveSheet()->setCellValue('C10',$this->config->item('unit_kerja'));
$this->excel->getActiveSheet()->setCellValue('A11','f. Unit Organisasi');
$this->excel->getActiveSheet()->setCellValue('C11',$this->config->item('unit_organisasi'));
$this->excel->getActiveSheet()->setCellValue('A12','2 PEJABAT PENILAI');
$this->excel->getActiveSheet()->setCellValue('A13','a. Nama');
$this->excel->getActiveSheet()->setCellValue('C13',$nama_penilai);
$this->excel->getActiveSheet()->setCellValue('A14','b. NIP');
$this->excel->getActiveSheet()->setCellValueExplicit('C14',$nip_penilai, PHPExcel_Cell_DataType::TYPE_STRING);
$this->excel->getActiveSheet()->setCellValue('A15','c. Pangkat/Gol.Ruang');
$this->excel->getActiveSheet()->setCellValue('C15',$pangkat_golongan_penilai);
$this->excel->getActiveSheet()->setCellValue('A16','d. Jabatan');
$this->excel->getActiveSheet()->setCellValue('C16',$jabatan_penilai);
$this->excel->getActiveSheet()->setCellValue('A17','e. Unit Kerja');
$this->excel->getActiveSheet()->setCellValue('C17',$this->config->item('unit_kerja'));
$this->excel->getActiveSheet()->setCellValue('A18','f. Unit Organisasi');
$this->excel->getActiveSheet()->setCellValue('C18',$this->config->item('unit_organisasi'));
$this->excel->getActiveSheet()->setCellValue('A19','3. ATASAN PEJABAT PENILAI');
$this->excel->getActiveSheet()->setCellValue('A20','a. Nama');
$this->excel->getActiveSheet()->setCellValue('C20',$nama_atasan_penilai);
$this->excel->getActiveSheet()->setCellValue('A21','b. NIP');
$this->excel->getActiveSheet()->setCellValueExplicit('C21',$nip_atasan_penilai, PHPExcel_Cell_DataType::TYPE_STRING);
$this->excel->getActiveSheet()->setCellValue('A22','c. Pangkat/Gol.Ruang');
$this->excel->getActiveSheet()->setCellValue('C22',$pangkat_golongan_atasan_penilai);
$this->excel->getActiveSheet()->setCellValue('A23','d. Jabatan');
$this->excel->getActiveSheet()->setCellValue('C23',$jabatan_atasan_penilai);
$this->excel->getActiveSheet()->setCellValue('A24','e. Unit Organisasi');
$this->excel->getActiveSheet()->setCellValue('C24',$unit_organisasi_atasan_penilai);

//baris 28 mulai data skp
$baris = 28;
$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$kode' order by nourut");
if(count($ta->result())>0)
{
$nomor = 1;
foreach($ta->result() as $a)
	{
	if (substr($a->kegiatan,0,8)=='Unsur ut')
		{
		$this->excel->getActiveSheet()->setCellValue('B'.$baris,'Unsur Utama');
		$baris++;
		$this->excel->getActiveSheet()->setCellValue('B'.$baris,'Pembelajaran / Pembimbingan / Tugas Tertentu');
		$baris++;
		$this->excel->getActiveSheet()->setCellValue('A'.$baris,$nomor);
		$nomor++;
		$this->excel->getActiveSheet()->setCellValue('B'.$baris,'Menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran, melaksanakan kegiatan pembelajaran, menyusun alat ukur/soal sesuai mata pelajaran, menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya, menganalisis hasil penilaian pembelajaran, melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi');
		}
		else
		{
			if((substr($a->kegiatan,0,32) == 'Melaksanakan Proses Pembelajaran') or (substr($a->kegiatan,0,15) == 'Unsur Penunjang') or ($a->kegiatan == 'Unsur PKB'))
			{
				$this->excel->getActiveSheet()->setCellValue('A'.$baris,' ');
			}
			else
			{
				$this->excel->getActiveSheet()->setCellValue('A'.$baris,$nomor);
				$nomor++;
			}
		$this->excel->getActiveSheet()->setCellValue('B'.$baris,strip_tags($a->kegiatan));
			if($a->ak_target > 0)
			{
			$this->excel->getActiveSheet()->setCellValue('E'.$baris,$a->ak_target);
			$this->excel->getActiveSheet()->setCellValue('F'.$baris,$a->kuantitas);
			$this->excel->getActiveSheet()->setCellValue('G'.$baris,$a->satuan);
			$this->excel->getActiveSheet()->setCellValue('H'.$baris,$a->kualitas);
			$this->excel->getActiveSheet()->setCellValue('I'.$baris,$a->waktu);
			$this->excel->getActiveSheet()->setCellValue('J'.$baris,'bulan');
			$this->excel->getActiveSheet()->setCellValue('K'.$baris,$a->biaya);
			$this->excel->getActiveSheet()->setCellValue('L'.$baris,$a->ak_r);
			$this->excel->getActiveSheet()->setCellValue('M'.$baris,$a->kuantitas_r);
			$this->excel->getActiveSheet()->setCellValue('N'.$baris,$a->satuan);
			$this->excel->getActiveSheet()->setCellValue('O'.$baris,$a->kualitas_r);
			$this->excel->getActiveSheet()->setCellValue('P'.$baris,$a->waktu_r);
			$this->excel->getActiveSheet()->setCellValue('Q'.$baris,'Bulan');
			$this->excel->getActiveSheet()->setCellValue('R'.$baris,$a->biaya_r);
			$this->excel->getActiveSheet()->setCellValue('S'.$baris,$a->perhitungan);
			$this->excel->getActiveSheet()->setCellValue('T'.$baris,$a->capaian_skp);
			}
			else
			{
			$this->excel->getActiveSheet()->setCellValue('E'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('F'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('G'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('H'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('I'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('J'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('K'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('L'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('M'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('N'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('O'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('P'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('Q'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('R'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('S'.$baris,' ');
			$this->excel->getActiveSheet()->setCellValue('T'.$baris,' ');
			}
		}
	$baris++;
	}
}
$cacah = $nomor - 1;
$this->excel->getActiveSheet()->setCellValue('M6',$cacah);
//$this->excel->getActiveSheet()->mergeCells("A3:A4");       
}
else
{
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Worksheet');
$this->excel->getActiveSheet()->setCellValue('A1', $pesan);
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
