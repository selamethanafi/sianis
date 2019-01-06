<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_keluar.php
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

/*    * POWERED BY       : CodeIgniter 2.1 & FPDF 1.6	 
*/
/* setting zona waktu */ 
date_default_timezone_set('Asia/Jakarta');
$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle("keterangan meninggalkan madrasah");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(2,2,2);
$lebar = 18;
$tinggi = 25.5;
$x=1.5;
$y = 3;
$x2 = 4.0;
$x3 = 5.0;
$x4 = 8.0;
$ada = 0;
$tbr =0.4;
if(isset($nis))
{
	$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' order by no_urut");
}
else
{
	$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");

}
$adasiswa = $tb->num_rows();
$namakepalaawal = cari_kepala($thnajaran,$semester);
$nipkepalaawal = cari_nip_kepala($thnajaran,$semester);
$adasiswa = $tb->num_rows();
if ($adasiswa>0)
{
	foreach($tb->result() as $b)
	{
	$nis = $b->nis;
	$kelasditinggalkan = $b->kelas;
	$tdata_siswa=$this->db->query("select * from `datsis` where `nis`='$nis'");
		foreach($tdata_siswa->result() as $a)
		{
		$namasiswa = $a->nama;		
		$alasankeluar = $a->alasankeluar;
		$tanggalkeluar = date_to_long_string($a->tanggalkeluar);
		$this->fpdf->AddPage();
		$this->fpdf->SetX($x,$y);
		$this->fpdf->SetFont('Arial','',12);
		$this->fpdf->SetXY($x,$y);
		$tipe = $this->config->item('sek_tipe');
		$this->fpdf->Cell(18,0.5,'KETERANGAN MENINGGALKAN '.strtoupper($tipe),0,2,'C',0);
		$this->fpdf->Cell(18,0.5,'NAMA PESERTA DIDIK : '.strtoupper($namasiswa),0,2,'C',0);
		$this->fpdf->Cell(18,0.5,'',0,2,'C',0);
		$this->fpdf->Cell(18,1,'KELUAR',1,2,'C',0);
		$this->fpdf->Cell(4,1.8,'Tanggal',1,0,'C',0);
		$yy = $this->fpdf->GetY();
		$this->fpdf->SetXY($x+4,$yy);
		$this->fpdf->Cell(3,0.6,'Kelas',0,2,'C',0);
		$this->fpdf->Cell(3,0.6,'yang',0,2,'C',0);
		$this->fpdf->Cell(3,0.6,'Ditinggalkan',0,2,'C',0);
		$this->fpdf->SetXY($x+4,$yy);
		$this->fpdf->Cell(3,1.8,'',1,2,'C',0);
		$this->fpdf->SetXY($x+7,$yy);
		$this->fpdf->Cell(4.5,0.6,'Sebab-sebab Keluar',0,2,'C',0);
		$this->fpdf->Cell(4.5,0.6,'atau Atas Permintaan',0,2,'C',0);
		$this->fpdf->Cell(4.5,0.6,'(Tertulis)',0,2,'C',0);
		$this->fpdf->SetXY($x+7,$yy);
		$this->fpdf->Cell(4.5,1.8,'',1,2,'C',0);
		$this->fpdf->SetXY($x+11.5,$yy);
		$this->fpdf->Cell(6.5,0.6,'Tanda Tangan Kepala '.ucwords($tipe).',',0,2,'C',0);
		$this->fpdf->Cell(6.5,0.6,'Stempel '.ucwords($tipe).', dan',0,2,'C',0);
		$this->fpdf->Cell(6.5,0.6,'Tanda Tangan Orang Tua/Wali',0,2,'C',0);
		$this->fpdf->SetXY($x+11.5,$yy);
		$this->fpdf->Cell(6.5,1.8,'',1,2,'C',0);
		$this->fpdf->SetX($x);
		$yy1 = $this->fpdf->GetY();
		$this->fpdf->Cell(4,0.5,'',0,2,'C',0);
		$yy = $this->fpdf->GetY();
		$this->fpdf->Cell(4,0.8,$tanggalkeluar,0,0,'C',0);
		$this->fpdf->SetXY($x+4,$yy);
		$this->fpdf->MultiCell(2.5,0.8,$kelasditinggalkan,0,'C',0);
		$this->fpdf->Cell(3,1.6,'',0,2,'C',0);
		$this->fpdf->SetXY($x+4,$yy);
		$this->fpdf->SetXY($x+7,$yy);
		if(empty($a->nosurat))
			{
			$this->fpdf->MultiCell(4.5,0.6,$alasankeluar,0,'C',0);
			}
			else
			{
			$this->fpdf->MultiCell(4.5,0.6,$alasankeluar.'. Nomor surat pindah / keluar '.$a->nosurat,0,'C',0);
			}
		$this->fpdf->SetXY($x+7,$yy);
		$this->fpdf->SetXY($x+11.5,$yy);
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
		$this->fpdf->Cell(6,0.6,$this->config->item('lokasi').', '.$tanggalkeluar,0,2,'C',0);
		$this->fpdf->Cell(6,0.6,$this->config->item('plt').'Kepala '.$this->config->item('sek_nama'),0,2,'C',0);
		$yy = $this->fpdf->GetY();
		if($ttd == 1)
		{
			$posisix = $posisi_x+ 13;
			$posisine_y = $yy + $posisi_y;
			$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisix,$posisine_y,$lebar_ttd,$tinggi_ttd);
		}
		$this->fpdf->SetXY($x+11.5,$yy);
		$this->fpdf->Cell(6,2,'',0,2,'C',0);
		$this->fpdf->Cell(6,0.6,$namakepalaawal,0,2,'C',0);
		$this->fpdf->Cell(6,0.6,'NIP '.$nipkepalaawal,0,2,'C',0);
		$this->fpdf->Cell(6,1.2,'',0,2,'C',0);
		$this->fpdf->SetX($x+12);
		$this->fpdf->Cell(6,0.6,'Orang Tua/Wali,',0,2,'C',0);
		$this->fpdf->Cell(6,2.1,'',0,2,'C',0);
		$this->fpdf->Cell(6,0.6,'_________________________',0,2,'C',0);
		$this->fpdf->Cell(6,1,'',0,2,'C',0);
		$yy2 = $this->fpdf->GetY();
		$selisih = $yy2 - $yy1;
		$this->fpdf->SetXY($x,$yy1);
		$this->fpdf->Cell(4,$selisih,'',1,0,'C',0);
		$this->fpdf->Cell(3,$selisih,'',1,0,'C',0);
		$this->fpdf->Cell(4.5,$selisih,'',1,0,'C',0);
		$this->fpdf->Cell(6.5,$selisih,'',1,2,'C',0);

		}
	}
}
else
{
	$this->fpdf->AddPage();
	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Arial','',8);
	$this->fpdf->SetXY($x,$y);
	$this->fpdf->Cell(18,0.5,'DATA SISWA TIDAK ADA',0,2,'C',0);
}
/* setting Cell untuk page number */

$namafile='keterangan_keluar_'.$nis.'_'.$namasiswa.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
