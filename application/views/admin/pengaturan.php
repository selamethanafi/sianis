<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : isi_index.php
// Lokasi      : application/views/guru
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
echo $pesan;
if(empty($nomor))
{
/*
*/
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nohpadmin'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nohpadmin','Nomor Ponsel Admin')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nohpbp'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nohpbp','Nomor Seluler BK')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nohpkesiswaan'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nohpkesiswaan','Nomor Seluler Waka Kesiswaan')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris_1_identitas_sekolah_2015'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris_1_identitas_sekolah_2015','Baris Pertama Judul Sampul Rapor Kurikulum 2015')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris_2_identitas_sekolah_2015'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris_2_identitas_sekolah_2015','Baris kedua judul sampul rapor kurikulum 2015')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris_1_identitas_sekolah_2013'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris_1_identitas_sekolah_2013','Baris pertama judul sampul rapor kurikulum 2013')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris_2_identitas_sekolah_2013'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris_2_identitas_sekolah_2013','Baris kedua judul sampul rapor kurikulum 2013')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'chat_id_admin_skp'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('chat_id_admin_skp','ID chat telegram admin SKP')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'token_bot'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('token_bot','Token Bot Telegram')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'jenjang'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('jenjang','MI/SD, MTs/SMP, MA/SMA')");
	}

	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_alamat_pendek'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_alamat_pendek','Alamat sekolah muncul di halaman rapor siswa')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_nama'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_nama','Nama Sekolah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_status'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_status','Status Sekolah, N = Negeri, S = Swasta')");
	}

	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_nama_panjang'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_nama_panjang','Nama sekolah tidak disingkat')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_alamat'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_alamat','Alamat sekolah muncul di halaman rapor depan')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_kontak'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_kontak','Nomor Kontak Sekolah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_telepon'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_telepon','Nomor Telepon')");
	}

	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_desa'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_desa','Desa')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_kec'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_kec','Kecamatan')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_kab'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_kab','Kabupaten')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_prov'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_prov','Provinsi')");
	}

	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'lokasi'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('lokasi','Tempat atau kota, muncul di halaman bertanda tangan')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_membolos'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_membolos','Kode pelanggaran bagi siswa membolos,  B06 adalah bawaan sistem')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_terlambat'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_terlambat','Kode pelanggaran bagi siswa terlambat datang ke sekolah, B01 adalah bawaan sistem')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_terlambat_mapel'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_terlambat_mapel','Kode pelanggaran bagi siswa terlambat masuk kelas, B07 adalah bawaan sistem')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_tanpa_keterangan'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_tanpa_keterangan','Kode pelanggaran bagi siswa tidak masuk tanpa keterangan, B03 adalah bawaan sistem')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'idsurat'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('idsurat','Kode surat')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_un_provinsi'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_un_provinsi','Kode UN provinsi')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_un_kab'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_un_kab','Kode UN kab / kota')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_un_sekolah'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_un_sekolah','Kode UN sekolah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_un_satuan'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_un_satuan','Kode Jenjang UN, 1 = MI/SD, 2 = MTs / SMP, 3 = MA/SMA')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_npsn'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_npsn','Kode nomor pokok sekolah nasional')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_nss'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_nss','Nomor statistik sekolah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_nsm'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_nsm','Nomor statistik madrasah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_website'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_website','alamat web sekolah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_email'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_email','alamat surel sekolah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_tipe'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_tipe','sekolah atau madrasah, tulis dengan huruf kecil')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'persentase_klasikal'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('persentase_klasikal','Persentase suatu kelas perlu pembelajaran remidial secara klasikal')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'maintainer'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('maintainer','Nama perawat web')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'unit_kerja'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('unit_kerja','Unit Kerja untuk  SKP')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris1'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris1','Kepala surat baris ke 1')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris2'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris2','Kepala surat baris ke 2')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris3'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris3','Kepala surat baris ke 3')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris4'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris4','Kepala surat baris ke 4')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nama_web'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nama_web','Nama / Keterangan Website')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'plt'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('plt','Kalau kepala dijabat secara definitif kosongkan. Kalau dijabat plt, isi dengan Plt')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris_1_komite'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris_1_komite','Baris 1 Kepala Surat Komite Madrasah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris_2_komite'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris_2_komite','Baris 2 Kepala Surat Komite Madrasah')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris_3_komite'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris_3_komite','Baris 3 Kepala Surat Komite')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris_4_komite'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris_4_komite','Baris 4 Kepala Surat Komite')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nama_ketua_komite'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nama_ketua_komite','Nama Komite')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'chat_id_admin'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('chat_id_admin','ID Telegram Admin Portal')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'url_sms_post'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('url_sms_post','Alamat Post SMS')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'url_ppdb'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('url_ppdb','alamat web ppdb')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'bendahara_komite'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('bendahara_komite','Bendahara Komite')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_1'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('caption_slide_1','Caption Slide 1')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_2'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('caption_slide_2','Caption Slide 2')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_3'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('caption_slide_3','Caption Slide 3')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_4'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('caption_slide_4','Caption Slide 4')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_5'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('caption_slide_5','Caption Slide 5')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_6'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('caption_slide_6','Caption Slide 6')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_1'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sub_caption_slide_1','Sub Caption Slide 1')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_2'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sub_caption_slide_2','Sub Caption Slide 2')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_3'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sub_caption_slide_3','Sub Caption Slide 3')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_4'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sub_caption_slide_4','Sub Caption Slide 4')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_5'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sub_caption_slide_5','Sub Caption Slide 5')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_6'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sub_caption_slide_6','Sub Caption Slide 6')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'koordinator_pkb'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('koordinator_pkb','Koordinator PKB')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nip_koordinator_pkb'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nip_koordinator_pkb','NIP Koordinator PKB')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris1kartutes'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris1kartutes','Kepala kartu tes baris ke 1')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris2kartutes'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris2kartutes','Kepala kartu tes baris ke 2')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'baris3kartutes'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('baris3kartutes','Kepala kartu tes baris ke 3')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nilai_akreditasi'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nilai_akreditasi','Nilai akreditasi')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'status_akreditasi'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('status_akreditasi','Status akreditasi')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'tahun_akreditasi'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('tahun_akreditasi','Tahun penilaian akreditasi')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'jenis_printer_izin'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('jenis_printer_izin','Jenis Printer AIM, isi Thermal atau Inkjet')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nama_printer_izin'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nama_printer_izin','Nama printer AIM')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'ip_aim'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('ip_aim','Alamat IP AIM')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'jenis_printer_pembayaran'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('jenis_printer_pembayaran','Jenis Printer untuk kuitansi pembayaran. Isi Thermal atau Inkjet')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'nama_printer_pembayaran'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('nama_printer_pembayaran','Nama printer Kuitansi')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'cetak_struk_pembayaran_aim'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('cetak_struk_pembayaran_aim','Cetak struk pembayaran lewat AIM, isi YA atau TIDAK')");
	}
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'cetak_kartu_tes_sementara'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('cetak_kartu_tes_sementara','Cetak Kartu Tes Sementara lewat AIM, isi YA atau TIDAK')");
	 }
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'tanda_tangan'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('tanda_tangan','Rapor langsung ditandatangani? isi YA atau TIDAK')");
	 }
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'fontsize_rapor'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('fontsize_rapor','Ukuran font rapor cetakan HTML? isi angka genap')");
	 }
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'url_ard'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('url_ard','URL Aplikasi ARD')");
	 }
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'kode_tambahan_nis_ard'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('kode_tambahan_nis_ard','Kode tambahan NIS untuk ARD')");
	 }
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'school_id'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('school_id','ID sekolah untuk ARD')");
	 }
	$this->db->query("update `m_referensi` set `keterangan`='URL Aplikasi ARD Upload' where `opsi` = 'url_ard'");
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'url_ard_unduh'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('url_ard_unduh','URL Aplikasi ARD Download')");
	 }
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'id_desa'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('id_desa','Kode Desa')");
	 }
	$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sek_nama_ard'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `m_referensi` (`opsi`, `keterangan`) values ('sek_nama_ard','Nama Sekolah di ARD')");
	}

}
$nomor = $nomor * 1;
$mulai = $nomor * 10;
$ta = $this->db->query("select * from `m_referensi` limit $mulai,10");
if($ta->num_rows() > 0)
{
	echo form_open('admin/simpanpengaturan/'.$nomor,'class="form-horizontal" role="form"');

$nomor = 1;
foreach($ta->result() as $a)
{
	$id = $a->id_referensi;
?>
	<div class="form-group row">
		<div class="col-sm-3" ><label class="control-label"><?php echo $a->keterangan;?></label></div>
		<div class="col-sm-9" ><input type="text" name="nilai_<?php echo $nomor;?>" value="<?php echo $a->nilai;?>" class="form-control"></div>
	</div>
	<input type="hidden" name="id_referensi_<?php echo $nomor;?>" value="<?php echo $id;?>">
	<?php $nomor++;
}
	$cacah_item = $nomor - 1;
	echo '<input type="hidden" name="cacah_item" value="'.$cacah_item.'">';
	echo '<p class="text-center"><button type="submit" class="btn btn-primary">Simpan</button></p>';
echo form_close();
}
else
{
	echo 'Sudah rampung';
}
?>

</div></div></div>
