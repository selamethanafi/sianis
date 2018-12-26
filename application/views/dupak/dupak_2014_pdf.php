<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_program_kerja_kepala_laboratorium.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
$this->fpdf->FPDF("P","cm","Legal");
$this->fpdf->SetMargins(2,2,2);		
$this->fpdf->AliasNbPages();
$this->fpdf->SetTitle("Dupak Sebelum 2014");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->SetKeywords("sistem, informasi, madrasah");
// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
$this->fpdf->AddPage();
$golongan = preg_replace("/_/","/", $golongan);
$taklama = 0;
$takbaru = 0;
$versi = $datamasa['versi'];
$awal = $datamasa['awal'];
$akhir_penilaian = '2013-12-31';
$awal_penilaian = $datamasa['awal_penilaian'];
$tmt = $datamasa['tmt'];
$tahun = $datamasa['tahun'];
$bulan = $datamasa['bulan'];
$tahun_baru = $datamasa['tahun_baru'];
$bulan_baru = $datamasa['bulan_baru'];
$t = 0.4;
$x = 2;
$l = 18;
$this->fpdf->SetX($x+10);
$this->fpdf->setFont('Helvetica','',8);
$this->fpdf->cell(3,$t,'Lampiran I',0,0,'L',0);
$this->fpdf->cell(3,$t,': Keputusan Bersama',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(3,$t,'',0,0,'C',0);
$this->fpdf->cell(3,$t,'  Menteri Pendidikan Nasional dan',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(3,$t,'',0,0,'C',0);
$this->fpdf->cell(3,$t,'  Kepala Badan Kepegawaian Negara',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(3,$t,'',0,0,'C',0);
$this->fpdf->cell(2,$t,'  Nomor',0,0,'L',0);
$this->fpdf->cell(3,$t,': 03/V/PB/2010',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(3,$t,'',0,0,'C',0);
$this->fpdf->cell(2,$t,'  Nomor',0,0,'L',0);
$this->fpdf->cell(3,$t,': 14 Tahun 2010',0,2,'L',0);

$this->fpdf->SetX($x+10);
$this->fpdf->cell(3,$t,'',0,0,'C',0);
$this->fpdf->cell(2,$t,'  Tanggal',0,0,'L',0);
$this->fpdf->cell(3,$t,': 6 Mei 2010',0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->setFont('Helvetica','',9);
$this->fpdf->cell(3,$t,'',0,2,'C',0);
$this->fpdf->cell($l,$t,'DAFTAR USUL',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($l,$t,' PENETAPAN ANGKA KREDIT GURU',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(3,$t,'',0,0,'C',0);
$this->fpdf->cell(14,$t,'NOMOR :',0,2,'L',0);
$this->fpdf->cell(3,$t,'',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(9,$t,'Instansi : '.$this->config->item('sek_nama').' '.$this->config->item('sek_kab'),0,0,'L',0);
$this->fpdf->cell(9,$t,'Masa Penilaian : '.date_to_long_string($awal_penilaian).' s.d '.date_to_long_string($akhir_penilaian),0,2,'R',0);
$k1 = 1;
$k2 = 6;
$k3 = 2;
$k4 = 9;
$t = 0.6;
$t2 = 0.4;
$this->fpdf->setFont('Helvetica','',8);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'NO',1,0,'C',0);
$this->fpdf->cell($k2+$k3+$k4,$t,'KETERANGAN PERORANGAN',1,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'1',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'Nama',1,0,'L',0);
$this->fpdf->cell($k4,$t,$dataguru['nama'],1,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'2',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'NIP',1,0,'L',0);
$this->fpdf->cell($k4,$t,$dataguru['nip'],1,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'3',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'NUPTK',1,0,'L',0);
$this->fpdf->cell($k4,$t,$dataguru['nuptk'],1,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'4',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'Nomor Seri Kartu Pegawai',1,0,'L',0);
$this->fpdf->cell($k4,$t,$dataguru['karpeg'],1,2,'L',0);

$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'5',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'Tempat dan Tanggal Lahir',1,0,'L',0);
$this->fpdf->cell($k4,$t,$dataguru['tempat'].', '.date_to_long_string($dataguru['tanggallahir']),1,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'6',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'Jenis Kelamin',1,0,'L',0);
$this->fpdf->cell($k4,$t,ubahjenkel($dataguru['jenkel']),1,2,'L',0);
$this->fpdf->SetX($x);
$yy = $this->fpdf->GetY();
$this->fpdf->cell($k1,$t2,'7',0,0,'C',0);
$this->fpdf->Cell($k2+$k3,0.4,'Pendidikan yang telah diperhitungkan',0,0,'L',0);
$this->fpdf->cell($k4,$t2,$datapaklama['pendidikan'],0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t2,' ',0,0,'L',0);
$this->fpdf->Cell($k2+$k3,$t2,'angka kreditnya',0,0,'L',0);
$this->fpdf->cell($k4,$t2,' ',0,2,'L',0);
$this->fpdf->SetXY($x,$yy);
$this->fpdf->cell($k1,$t2+$t2,' ',1,0,'L',0);
$this->fpdf->Cell($k2+$k3,$t2+$t2,'',1,0,'L',0);
$this->fpdf->Cell($k4,$t2+$t2,' ',1,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'8',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'Pangkat / Gol. Ruang / TMT',1,0,'L',0);
$this->fpdf->cell($k4,$t,$datapaklama['pangkat'].' / '.$datapaklama['golongan'].' / '.tanggal($datapaklama['tmt']),1,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'9',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'Jabatan',1,0,'L',0);
$this->fpdf->cell($k4,$t,$datapaklama['jabatan'],1,2,'L',0);

$y3 = $this->fpdf->GetY();
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'10',0,0,'C',0);
$this->fpdf->cell($k2,$t,'Masa kerja Golongan',0,0,'L',0);
$this->fpdf->cell($k3,$t,'Lama',1,0,'L',0);
$this->fpdf->cell($k4,$t,$datapaklama['tahun'].' tahun '.$datapaklama['bulan'].' bulan',1,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'',0,0,'C',0);
$this->fpdf->cell($k2,$t,'',0,0,'L',0);
$this->fpdf->cell($k3,$t,'Baru',1,0,'L',0);
$this->fpdf->cell($k4,$t,$datamasa['tahun_baru'].' tahun '.$datamasa['bulan_baru'].' bulan',1,2,'L',0);
$this->fpdf->SetXY($x,$y3);
$this->fpdf->cell($k1,$t+$t,'',1,0,'C',0);
$this->fpdf->cell($k2,$t+$t,'',1,2,'C',0);

$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'11',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'Jenis guru',1,0,'L',0);
$this->fpdf->cell($k4,$t,'GURU MATA PELAJARAN',1,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'12',1,0,'C',0);
$this->fpdf->cell($k2+$k3,$t,'Unit Kerja',1,0,'L',0);
$this->fpdf->cell($k4,$t,$this->config->item('unit_kerja'),1,2,'L',0);

$k1 = 1;
$k2 = 9.8;
$k3 = 1.2;
$k4 = 1.2;
$k5 = 1.2;
$k6 = 1.2;
$k7 = 1.2;
$k8 = 1.2;
$k2a = 0.5;
$k22 = 2*$k2a;
$k23 = 3*$k2a;
$k24 = 4*$k2a;
$k9 = 1;
$k10 = 1;
$k11= 1;
$t = 0.4;
$d1 = $k2 - $k2a;
$d2 = $k2 - $k2a - $k2a;
$d3 = $k2 - $k2a - $k2a - $k2a;
$d4 = $k2 - $k2a - $k2a - $k2a - $k2a;
$d5 = $k2 - $k2a - $k2a - $k2a - $k2a - $k2a;
$this->fpdf->SetX($x);
$this->fpdf->cell($l,$t,'UNSUR YANG DINILAI',1,2,'C',0);
$this->fpdf->SetX($x);
$yy = $this->fpdf->GetY();
$this->fpdf->cell($k1,3*$t,'NO',1,0,'C',0);
$this->fpdf->SetXY($x+$k1,$yy);
$this->fpdf->cell($k2,3*$t,'UNSUR, SUB UNSUR, DAN BUTIR KEGIATAN',1,0,'C',0);
$this->fpdf->SetXY($x+$k1+$k2,$yy);
$this->fpdf->cell($k3+$k4+$k5+$k6+$k7+$k8,$t,'ANGKA KREDIT MENURUT',1,2,'C',0);
$this->fpdf->SetX($x+$k1+$k2);
$this->fpdf->cell($k3+$k4+$k5,$t,'SEKOLAH PENGUSUL',1,0,'C',0);
$this->fpdf->cell($k6+$k7+$k8,$t,'TIM PENILAI',1,2,'C',0);
$this->fpdf->SetX($x+$k1+$k2);
$this->fpdf->cell($k3,$t,'LAMA',1,0,'C',0);
$this->fpdf->cell($k4,$t,'BARU',1,0,'C',0);
$this->fpdf->cell($k5,$t,'JUMLAH',1,0,'C',0);
$this->fpdf->cell($k6,$t,'LAMA',1,0,'C',0);
$this->fpdf->cell($k7,$t,'BARU',1,0,'C',0);
$this->fpdf->cell($k8,$t,'JUMLAH',1,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t,'1',1,0,'C',0);
$this->fpdf->cell($k2,$t,'2',1,0,'C',0);
$this->fpdf->cell($k3,$t,'3',1,0,'C',0);
$this->fpdf->cell($k4,$t,'4',1,0,'C',0);
$this->fpdf->cell($k5,$t,'5',1,0,'C',0);
$this->fpdf->cell($k6,$t,'6',1,0,'C',0);
$this->fpdf->cell($k7,$t,'7',1,0,'C',0);
$this->fpdf->cell($k8,$t,'8',1,2,'C',0);
$this->fpdf->SetX($x);
$y1 = $this->fpdf->GetY();
$this->fpdf->cell($k1,$t,'I',0,0,'C',0);
$this->fpdf->cell(18-$k1,$t,'UNSUR UTAMA',1,2,'L',0);
$y2 = $this->fpdf->GetY();
$this->fpdf->SetX($x+$k1);
$this->fpdf->cell($k2a,$t,'1',1,0,'C',0);
$this->fpdf->cell($k2-$k2a,$t,'PENDIDIKAN',1,0,'L',0);
$this->fpdf->cell($k3,$t,'',1,0,'C',0);
$this->fpdf->cell($k4,$t,'',1,0,'C',0);
$this->fpdf->cell($k5,$t,'',1,0,'C',0);
$this->fpdf->cell($k6,$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t,'',1,2,'C',0);
$y3 = $this->fpdf->GetY();
$this->fpdf->SetX($x+$k1+$k2a);
$this->fpdf->cell($k2a,$t,'A',0,0,'C',0);
$this->fpdf->cell($d2,$t,'Mengikuti pendidikan dan memperoleh gelar/ijazah/akta',1,0,'L',0);
$this->fpdf->cell($k3,$t,'',1,0,'C',0);
$this->fpdf->cell($k4,$t,'',1,0,'C',0);
$this->fpdf->cell($k5,$t,'',1,0,'C',0);
$this->fpdf->cell($k6,$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t,'',1,2,'C',0);
$y4 = $this->fpdf->GetY();
$this->fpdf->SetX($x+$k1+$k22);
$this->fpdf->cell($k2a,$t,'1',0,0,'L',0);
$this->fpdf->cell($d3,$t,'Doktor (S-3)',1,0,'L',0);
if(substr($datapaklama['pendidikan'],0,3) == 'S-3')
{
	$this->fpdf->cell($k3,$t,$datapaklama['ak_pendidikan'],1,0,'C',0);
	$taklama = $taklama + $datapaklama['ak_pendidikan'];
}
else
{
	$this->fpdf->cell($k3,$t,'',1,0,'C',0);
}
$this->fpdf->cell($k4,$t,'',1,0,'C',0);
if(substr($datapaklama['pendidikan'],0,3) == 'S-3')
{
	$this->fpdf->cell($k5,$t,$datapaklama['ak_pendidikan'],1,0,'C',0);
	$taklama = $taklama + $datapaklama['ak_pendidikan'];
}
else
{
	$this->fpdf->cell($k5,$t,'',1,0,'C',0);
}
$this->fpdf->cell($k6,$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t,'',1,2,'C',0);
$this->fpdf->SetX($x+$k1+$k22);
$this->fpdf->cell($k2a,$t,'2',0,0,'L',0);
$this->fpdf->cell($d3,$t,'Magister (S-2)',1,0,'L',0);
if(substr($datapaklama['pendidikan'],0,3) == 'S-2')
{
	$this->fpdf->cell($k3,$t,$datapaklama['ak_pendidikan'],1,0,'C',0);
	$taklama = $taklama + $datapaklama['ak_pendidikan'];
}
else
{
	$this->fpdf->cell($k3,$t,'',1,0,'C',0);
}
$this->fpdf->cell($k4,$t,'',1,0,'C',0);
if(substr($datapaklama['pendidikan'],0,3) == 'S-2')
{
	$this->fpdf->cell($k5,$t,$datapaklama['ak_pendidikan'],1,0,'C',0);
}
else
{
	$this->fpdf->cell($k5,$t,'',1,0,'C',0);
}

$this->fpdf->cell($k6,$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t,'',1,2,'C',0);
$this->fpdf->SetX($x+$k1+$k22);
$this->fpdf->cell($k2a,$t,'3',0,0,'L',0);
$this->fpdf->cell($d3,$t,'Sarjana (S-1) / Diploma IV',1,0,'L',0);
if(substr($datapaklama['pendidikan'],0,3) == 'S-1')
{
	$this->fpdf->cell($k3,$t,$datapaklama['ak_pendidikan'],1,0,'C',0);
}
else
{
	$this->fpdf->cell($k3,$t,'',1,0,'C',0);
}
$this->fpdf->cell($k4,$t,'',1,0,'C',0);
if(substr($datapaklama['pendidikan'],0,3) == 'S-1')
{
	$this->fpdf->cell($k5,$t,$datapaklama['ak_pendidikan'],1,0,'C',0);
}
else
{
	$this->fpdf->cell($k5,$t,'',1,0,'C',0);
}
$this->fpdf->cell($k6,$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t,'',1,2,'C',0);
$yy = $this->fpdf->GetY();
$selisih = $yy - $y4;
$this->fpdf->SetXY($x+$k1+$k22,$y4);
$this->fpdf->cell($k2a,$selisih,'',1,2,'C',0);
$selisih = $yy - $y3;
$this->fpdf->SetXY($x+$k1+$k2a,$y3);
$this->fpdf->cell($k2a,$selisih,'',1,2,'C',0);
$this->fpdf->SetX($x+$k1+$k2a);
$this->fpdf->cell($k2a,$t,'B',0,0,'C',0);
$this->fpdf->cell($d2,$t,'Mengikuti pelatihan prajabatan',1,0,'L',0);
$this->fpdf->cell($k3,$t,'',1,0,'C',0);
$this->fpdf->cell($k4,$t,'',1,0,'C',0);
$this->fpdf->cell($k5,$t,'',1,0,'C',0);
$this->fpdf->cell($k6,$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t,'',1,2,'C',0);
$y3 = $this->fpdf->GetY();
$this->fpdf->SetX($x+$k1+$k22);
$this->fpdf->cell($k2a,$t,'-',0,0,'L',0);
$this->fpdf->cell($d3,$t,'Pelatihan prajabatan fungsional bagi guru calon.',0,2,'L',0);
$this->fpdf->SetX($x+$k1+$k22);
$this->fpdf->cell($k2a,$t,'',0,0,'L',0);
$this->fpdf->cell($d3,$t,'pegawai negeri sipil / program induksi.',0,0,'L',0);
$this->fpdf->SetXY($x+$k1+$k23+$d3,$y3);
$this->fpdf->cell($k3,$t+$t,'',1,0,'C',0);
$this->fpdf->cell($k4,$t+$t,'',1,0,'C',0);
$this->fpdf->cell($k5,$t+$t,'',1,0,'C',0);
$this->fpdf->cell($k6,$t+$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t+$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t+$t,'',1,2,'C',0);
$y2 = $this->fpdf->GetY();
$this->fpdf->SetX($x+$k1);
$this->fpdf->cell($k2a,$t,'2',1,0,'C',0);
$this->fpdf->cell($k2-$k2a,$t,'PEMBELAJARAN / BIMBINGAN DAN TUGAS TERTENTU',1,0,'L',0);
$this->fpdf->cell($k3,$t,'',1,0,'C',0);
$this->fpdf->cell($k4,$t,'',1,0,'C',0);
$this->fpdf->cell($k5,$t,'',1,0,'C',0);
$this->fpdf->cell($k6,$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t,'',1,2,'C',0);
$y3 = $this->fpdf->GetY();
$this->fpdf->SetX($x+$k1+$k2a);
$this->fpdf->cell($k2a,$t,'A',0,0,'C',0);
$this->fpdf->cell($d2,$t,'Melaksanakan proses pembelajaran',1,0,'L',0);
$this->fpdf->cell($k3,$t,'',1,0,'C',0);
$this->fpdf->cell($k4,$t,'',1,0,'C',0);
$this->fpdf->cell($k5,$t,'',1,0,'C',0);
$this->fpdf->cell($k6,$t,'',1,0,'C',0);
$this->fpdf->cell($k7,$t,'',1,0,'C',0);
$this->fpdf->cell($k8,$t,'',1,2,'C',0);
$y4 = $this->fpdf->GetY();
$this->fpdf->SetX($x+$k1+$k22);
$this->fpdf->cell($k2a,$t,'-',0,0,'L',0);
$this->fpdf->cell($d3,$t,'Merencanakan dan melaksanakan pembelajaran, mengevaluasi',0,2,'L',0);
$this->fpdf->SetX($x+$k1+$k22+$k2a);
$this->fpdf->cell($d3,$t,'dan menilai hasil pembelajaran, menganalisis hasil',0,2,'L',0);
$this->fpdf->SetX($x+$k1+$k22+$k2a);
$this->fpdf->cell($d3,$t,'pembelajaran, melaksanakan tindak lanjut hasil penilaian',0,2,'L',0);
if($gabungan == 'ada')
{
	$ak_pbm_baru = $datapaklama['ak_pbm'] + 
}



















$this->fpdf->SetX($x);
$this->fpdf->cell($k1,$t*2,'',0,0,'R',0);
$this->fpdf->SetX($x+12);
$this->fpdf->cell(6,$t,$this->config->item('lokasi').', 31 Desember 2013',0,2,'L',0);
$this->fpdf->SetX($x+12);
$this->fpdf->cell(6,$t,'Kepala '.$this->config->item('sek_nama'),0,2,'L',0);
$this->fpdf->SetX($x+12);
$this->fpdf->cell(6,$t*3,'',0,2,'L',0);
$namakepala = cari_kepala('2013/2014','1');
$nipkepala = cari_nip_kepala('2013/2014','1');
$this->fpdf->SetX($x+12);
$this->fpdf->cell(6,$t,$namakepala,0,2,'L',0);
$this->fpdf->SetX($x+12);
$this->fpdf->cell(6,$t,'NIP '.$nipkepala,0,2,'L',0);
$this->fpdf->cell(6,$t,'',0,2,'L',0);
$this->fpdf->AddPage();
$yy = $this->fpdf->GetY();
$this->fpdf->SetX($x);
$this->fpdf->cell(10,$t*2,'',0,2,'L',0);
$this->fpdf->cell(10,$t,'PENDAPAT TIM PENILAI',0,2,'L',0);
$this->fpdf->cell(10,$t*2,'',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t,'...................., .....................',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t,'Ketua TIM Penilai...',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t*3,'',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t,'______________________________',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t,'NIP ',0,2,'L',0);
$this->fpdf->cell(10,$t*2,'',0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(10,$t,'PERSETUJUAN : ....................................................',0,2,'L',0);
$this->fpdf->cell(10,$t*2,'',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t,$this->config->item('lokasi').', .....................',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t,'Kepala '.$this->config->item('sek_nama'),0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t*3,'',0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t,$namakepala,0,2,'L',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$t,'NIP '.$nipkepala,0,2,'L',0);
$yy1 = $this->fpdf->GetY();
$selisih = $yy1-$yy+$t+$t;
$this->fpdf->SetXY($x,$yy);
$this->fpdf->cell(17.5,$selisih,'',1,2,'L',0);

$this->fpdf->Output('dupak_guru_'.$golongan.'_'.$nim.'.pdf',"I");
