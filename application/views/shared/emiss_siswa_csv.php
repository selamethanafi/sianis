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
$kode_madrasah = '13113322000316';
$id_lembaga = '38a38973-6594-4031-967d-fe4642f16c19';
$npsn = '20363209';
$kelas = '12';
$kode_kurikulum = '1';
$nama_kurikulum = '1';
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas` like 'XII-%' and `status`='Y' order by `kelas`,`no_urut` ");
$thnajarane = berkas($thnajaran);
$filename = 'data_siswa_emiss_tahun_'.$thnajarane; 
$csv_output = '"ID SISWA","NAMA LENGKAP","JENIS KELAMIN","NISN","TMP. LAHIR","TGL. LAHIR","ALAMAT PD","KODE AGAMA","AGAMA","NAMA AYAH","KEBUTUHAN KHUSUS","ID LEMBAGA","NPSN","NO. PES UJIAN","NO. SKHUN","No. IJASAH","NIS LOKAL","KELAS","KODE KURIKULUM","NAMA KURIKULUM","KODE ROMBEL","ROMBEL","KODE JURUSAN","JURUSAN","KODE BAHASA","BAHASA","no_absen"';
$nomor = 1;
$csv_output .= "\n";		
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$no_urut = $a->no_urut;
	$alamat2 ='';
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		//ID SISWA
		$csv_output .= '"'.$b->id_siswa.'"';
		$namasiswa = strtolower($b->nama);
		$namasiswa = ucwords($namasiswa);

		//NAMA LENGKAP
		$csv_output .= ',"'.$namasiswa.'"';
		//JENIS KELAMIN
		$jeniskelamin = jenkel_siswa($nis,0);
		if($jeniskelamin == 'P')
		{
			$jenkel = '2';
		}
		else
		{
			$jenkel = '1';
		}

		$csv_output .= ',"'.$jenkel.'"';
		//NISN
		$csv_output .= ',"'.$b->nisn.'"';
		//TMP. LAHIR
		$csv_output .= ',"'.$b->tmpt.'"';
		//TGL. LAHIR
		$csv_output .= ',"'.$b->tgllhr.'"';
		//ALAMAT PD
		$csv_output .= ',"'.$b->alamat.'"';
		//KODE AGAMA
		$csv_output .= ',"1"';
		//AGAMA
		$csv_output .= ',"Islam"';
		//NAMA AYAH
		$csv_output .= ',"'.$b->nmayah.'"';
		//KEBUTUHAN KHUSUS
		$csv_output .= ',""';
		//ID LEMBAGA
		$csv_output .= ',"'.$id_lembaga.'"';
		//NPSN
		$csv_output .= ',"'.$npsn.'"';
		//NO. PES UJIAN
		$csv_output .= ',"'.$b->skhun.'"';
		//NO. SKHUN
		$csv_output .= ',"'.$b->no_blanko_skhun.'"';
		//No. IJASAH
		$csv_output .= ',"'.$b->nosttb.'"';
		//NIS LOKAL
		$csv_output .= ',"'.$kode_madrasah.''.$b->nis.'"';
		//KELAS
		$csv_output .= ',"12"';
		//KODE KURIKULUM
		$csv_output .= ',"1"';
		//NAMA KURIKULUM
		$csv_output .= ',"1"';
		//KODE ROMBEL
		$csv_output .= ',"'.$b->kode_rombel.'"';
		//ROMBEL
		$csv_output .= ',"'.$b->rombel.'"';
		//KODE JURUSAN
		$csv_output .= ',"'.$b->kode_jurusan.'"';
		//JURUSAN
		$csv_output .= ',"'.$b->jurusan_emiss.'"';
		//","KODE BAHASA","BAHASA","no_absen"';
		$csv_output .= ',"","","'.$no_urut.'"';
		$csv_output .= "\n";
		$nomor++;
	} //akhir foreach $tb
}
header("Content-type: application/vnd.ms-excel");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
?>
