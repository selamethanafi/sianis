<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rapor_siswa.php
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
$folderfotosiswa = $this->config->item('folderfotosiswa');

$this->fpdf->FPDF("P","cm","Legal");

// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1.5,2,1);
$lebarhalaman = $this->config->item('lebar_halaman');

$x = 2;
$y = 2.0;
$this->fpdf->AliasNbPages();
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
$thnajaranx = preg_replace("/\//","_", $thnajaran);

$ttglcetak = $this->db->query("select * from `m_tapel` where `thnajaran` = '$thnajaran'");
foreach($ttglcetak->result() as $dtglcetak)
{
	if ($semester=='1')
	{$tanggalcetak=$dtglcetak->akhir1;}
	else
	{$tanggalcetak=$dtglcetak->akhir2;}
}
$tkepala = $this->db->query("select * from `m_kepala` where `thnajaran`='$thnajaran' and `semester` = '$semester'");
foreach($tkepala->result() as $dkepala)
{
	$posisi_x = $dkepala->posisi_x / 10;
	$posisi_y = $dkepala->posisi_y / 10;
	$lebar = $dkepala->lebar / 10;
	$tinggi = $dkepala->tinggi / 10;
}
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$namaguru = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);

$tdx = $this->db->query("select * from `bimtik_mapel` where `id_mapel`='$id_kelas' and `kodeguru`='$kodeguru'");
$kelas = '';
foreach($tdx->result() as $dx)
{
	$kelas = $dx->kelas;
}

if($nis == 'semua')
{
	$tdata_siswa=$this->db->query("select * from `bimtik_nilai` where `thnajaran`='$thnajaran' and `semester` = '$semester' and `kelas`='$kelas' and status='Y' order by `nis` ASC ");
	$namafile='rapor_tik_'.$thnajaranx.'_semester_'.$semester.'_kelas_'.$kelas.'.pdf';
}
else
{
	$tdata_siswa=$this->db->query("select * from `bimtik_nilai` where `thnajaran`='$thnajaran' and `semester` = '$semester' and `kelas`='$kelas' and status='Y' and `nis`='$nis'");
	$namasiswa = nis_ke_nama($nis);
	$namafile='rapor_tik_'.$thnajaranx.'_semester_'.$semester.'_'.$namasiswa.'.pdf';
}
$tb=$this->db->query("select * from `bimtik_mapel` where `thnajaran`='$thnajaran' and `semester` = '$semester' and `kelas`='$kelas'");
foreach($tb->result() as $b)
{
	$sk = $b->sk;
	$kd1 = $b->materi1;
	$kd2 = $b->materi2;
	$kd3 = $b->materi3;
}
foreach($tdata_siswa->result() as $a)
{
	$this->fpdf->AddPage();
	$this->fpdf->SetXY($x,$y);
	$this->fpdf->setFont('Arial','',11);
	$this->fpdf->Cell($lebarhalaman,0.5,'Laporan Capaian Kompetensi Bimbingan TIK',0,2,'C',0);
	$this->fpdf->Cell($lebarhalaman,0.5,'Semester '.$semester.' Tahun Pelajaran '.$thnajaran,0,2,'C',0);
	$this->fpdf->setFont('Arial','',10);
	$this->fpdf->Cell(10,0.5,'',0,2,'L',0);
	$this->fpdf->Cell(10,0.5,'Nama Siswa : '.nis_ke_nama($a->nis),0,0,'L',0);
	$this->fpdf->Cell(7,0.5,'Kelas : '.$kelas,0,2,'R',0);
	$this->fpdf->Cell(10,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,1,'No',1,0,'C',0);
	$this->fpdf->Cell(4,1,'Standar Kompetensi',1,0,'C',0);
	$this->fpdf->Cell(10,1,'Rumusan Kompetensi',1,0,'C',0);
	$this->fpdf->Cell(1.5,1,'P',1,0,'C',0);
	$this->fpdf->Cell(1.5,1,'K',1,2,'C',0);
	$yK = $this->fpdf->GetY();
	$this->fpdf->SetX($x);
	$yy = $this->fpdf->GetY();
	$this->fpdf->Cell(1,0.6,'1',0,0,'C',0);
	$this->fpdf->MultiCell(4,0.6,$sk,0,'L',0);
	$ysk = $this->fpdf->GetY();
	$this->fpdf->SetXY($x+5,$yy);
	$this->fpdf->MultiCell(10,0.6,$kd1,1,'L',0);
	$ykd1 = $this->fpdf->GetY();
	$yy = $this->fpdf->GetY();
	$this->fpdf->SetXY($x+5,$ykd1);
	$this->fpdf->MultiCell(10,0.6,$kd2,1,'L',0);
	$ykd2 = $this->fpdf->GetY();
	$this->fpdf->SetXY($x+5,$ykd2);
	$this->fpdf->MultiCell(10,0.6,$kd3,1,'L',0);
	$ykd3 = $this->fpdf->GetY();
	$selisih = $ykd3 - $yK;
	$this->fpdf->SetXY($x,$yK);
	$this->fpdf->Cell(1,$selisih,'',1,0,'C',0);
	$this->fpdf->Cell(4,$selisih,'',1,0,'C',0);
	$this->fpdf->SetXY($x+15,$yK);
	$s1 = $ykd1 - $yK;
	$this->fpdf->Cell(1.5,$s1,$a->nilai_uh1,1,0,'C',0);
	$this->fpdf->Cell(1.5,$s1,$a->nilai_tu1,1,2,'C',0);
	$this->fpdf->SetXY($x+15,$ykd1);
	$s2 = $ykd2 - $ykd1;
	$this->fpdf->Cell(1.5,$s2,$a->nilai_uh2,1,0,'C',0);
	$this->fpdf->Cell(1.5,$s2,$a->nilai_tu2,1,2,'C',0);
	$this->fpdf->SetXY($x+15,$ykd2);
	$s3 = $ykd3 - $ykd2;
	$this->fpdf->Cell(1.5,$s3,$a->nilai_uh3,1,0,'C',0);
	$this->fpdf->Cell(1.5,$s3,$a->nilai_tu3,1,2,'C',0);
	$juh = $a->nilai_uh1 + $a->nilai_uh2 + $a->nilai_uh3;
	$jtu = $a->nilai_tu1 + $a->nilai_tu2 + $a->nilai_tu3;
	$ruh = round($juh/3,2);
	$rtu = round($jtu/3,2);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(15,1,'Jumlah',1,0,'R',0);
	$this->fpdf->Cell(1.5,1,$juh,1,0,'C',0);
	$this->fpdf->Cell(1.5,1,$jtu,1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(15,1,'Rata - rata',1,0,'R',0);
	$this->fpdf->Cell(1.5,1,$ruh,1,0,'C',0);
	$this->fpdf->Cell(1.5,1,$rtu,1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,1,'Keterangan : P = Nilai pengetahuan, K = nilai keterampilan',1,2,'L',0);
	$this->fpdf->Cell(18,1,'Kesimpulan',1,2,'L',0);
	$this->fpdf->MultiCell(18,0.6,$a->keterangan,1,'L',0);
	$this->fpdf->Cell(10,1.5,'',0,2,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(5,0.5,$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak),0,2,'L',0);

	$this->fpdf->SetX(5);
	$this->fpdf->Cell(5,0.5,'Kepala '.$this->config->item('sek_nama'),0,0,'L',0);
	$yyy = $this->fpdf->GetY();
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(5,0.5,'Guru TIK',0,2,'L',0);

	$this->fpdf->SetX(5);
	$this->fpdf->Cell(5,1.5,'',0,2,'L',0);
	$this->fpdf->SetX(5);
	$posisix = $posisi_x + 3;
	$posisine_y = $yyy + $posisi_y - 1;
	$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisix,$posisine_y,$lebar,$tinggi);
	$this->fpdf->SetX(5);
	$this->fpdf->Cell(1,0.6,$namakepala,0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.6,$namaguru,0,2,'L',0);
	$this->fpdf->SetX(5);
	$this->fpdf->Cell(1,0.6,'NIP '.$nipkepala.'',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.6,'NIP '.$nipguru.'',0,2,'L',0);

}

$namafile = preg_replace("/ /","_", $namafile);
$this->fpdf->Output($namafile,"I");
?>
