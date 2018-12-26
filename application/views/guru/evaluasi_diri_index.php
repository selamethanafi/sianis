<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:58:42 WIB 
// Nama Berkas 		: pkg_index.php
// Lokasi      		: application/views/guru/
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' '.$tahun;?></h3></div>
<div class="card-body">

<?php
echo '<p class="text-center"><a href="'.base_url().'evaluasi/evaluasi/'.$tahun.'/ubah" class="btn btn-primary">Ubah Evaluasi</a> <a href="'.base_url().'evaluasi/evaluasi/'.$tahun.'/cetak" class="btn btn-success">Cetak Evaluasi</a> <a href="'.base_url().'evaluasi/rencana/'.$tahun.'" class="btn btn-info">Rencana Evaluasi</a></p>';
$tglhariini = tanggal_hari_ini();
$thnajaran = cari_thnajaran();
$tb = $this->db->query("select * from `evaluasi_diri_tanggal` where `tahun`= '$tahun' and `nim`='$nim'");
if($tb->num_rows() == 0)
{
	$this->db->query("insert into `evaluasi_diri_tanggal` (`tahun`, `nim`,`thnajaran`, `tanggal`) values ('$tahun', '$nim', '$thnajaran', '$tglhariini')");
	
}
$tb = $this->db->query("select * from `evaluasi_diri_tanggal` where `tahun`= '$tahun' and `nim`='$nim'");
foreach($tb->result() as $b)
{
	$tanggal = $b->tanggal;
}
//$this->db->query("delete from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim'");
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'A1', 'Menguasai karakteristik peserta didik', 'Saya belum  menguasai karakteristik peserta didik saya dalam aspek sosial dan emosional, juga hanya tidak lebih dari 50% hafal dengan nama-nama peserta didik saya')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'A2', 'Menguasai teori belajar dan prinsip-prinsip belajar yang mendidik', 'Saya merasa  baru  sedikit  menguasai berbagai teori belajar dan implementasinya dalam pembelajaran utamanya teori-teori belajar terkini yang menjadi rujukan')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'A3', 'Pengembangan kurikulum', 'Saya sudah paham bagaimana menyusun RPP sesuai dengan standar proses dan pendidikan karakter bangsa')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'A4', 'Kegiatan belajar yang mendidik', 'Saya belum mampu melaksanakan kegiatan pembelajaran sesuai RPP yang saya buat, dan belum paham juga  bagaimana melaksanakan implementasi strategi pembelajaran yang mendidik')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'A5', 'Pengembangan potensi peserta didik', 'Saya belum dapat mengoptimalkan pengembangan potensi peserta didik baik dalam aspek intelektual, emosional maupun spiritualnya')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'A6', 'Komunikasi dengan peserta didik', 'Dalam berkomunikasi dengan peserta didik terkadang [ tidak selalu ] saya mengalami / menghadapi kendala ketika ada 1 atau 2 pserta didik yang tidak bisa menempatkan dirinya')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'A7', 'Penilaian dan evaluasi', 'Saya merasa tidak mengalami banyak kendala dalam melakukan penilaian kepada peserta didik baik kognitif, afektif maupun psikomotorik')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'B1', 'Bertindak sesuai norma agama, hukum, sosial, dan kebudayaan nasional', 'Saya belum bisa sepenuhnya  berperilaku sesuai dengan norma agama yang saya yakini dan norma-norma hukum serta sosial yang berlaku baik di sekolah maupun di masyarakat')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'B2', 'Menunjukkan pribadi yang dewasa dan teladan', 'Saya belum bisa menampilkan diri sebagai pribadi yang mantap dan stabil, berusaha tidak terlalu emosional dalam menghadapi masalah dalam bergaul dengan rekan guru, dan peserta didik')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'B3', 'Etos kerja, tanggung jawab yang tinggi dan rasa bangga menjadi seorang guru', 'Saya belum bisa menunjukkan etos kerja, tanggungjawab yang tinggi serta belum begitu bangga menjadi seorang guru')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'C1', 'Bersikap inklusif, bertindak objektif serta tidak diskriminatif', 'Saya selalu berusaha untuk bisa membawakan diri saya sebaik mungkin dalam bergaul dengan sesama rekan guru tanpa membedakan suku, ras, maupun agama. Dan saya berupaya untuk bisa bersikap adil dalam memberikan perlakuan terhadap peserta didik')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'C2', 'Komunikasi dengan sesama guru, tenaga kependidikan, orang tua, peserta didik, dan masyarakat', 'Komunikasi saya dengan sesama guru, tenaga kependidikan, orang tua, dan masyarakat tidak ada hambatan / permasalahan. Tetapi keterampilan berkomunikasi secara ilmiah di forum/komunitas ilmiah baik melalui media cetak maupun elektronik belum sesuai harapan')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'D1', 'Penguasaan materi, struktur, konsep dan pola pikir keilmuan yang mendukung mata pelajaran yang diampu', 'Saya merasa masih belum optimal dalam menguasai materi, struktur, konsep dan pola pikir keilmuan yang mendukung mata pelajaran yang saya ampu')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'D2', 'Pengembangan keprofesionalan melalui tindakan', 'Saya sudah cukup memahami cara menyusun proposal , melaksanakan dan menyusun laporan PTK. Hanya saja masih merasa berat untuk take action')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'E1', 'Usaha-usaha yang telah saya lakukan untuk memenuhi dan  mengembangkan 14 kompetensi inti tersebut', 'Belajar secara mandiri baik melalui buku-buku referensi, meramban internet yang terkait dengan permasalahan kompetensi inti. Juga melalui kegiatan MGMP di kabupaten atau kegiatan lain')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'E2', 'Kendala yang saya hadapi dalam memenuhi dan mengembangkan kompetensi inti tersebut', 'Pengelolaan waktu baik di sekolah maupun di rumah, finansial serta motivasi diri')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'E3', 'Keberhasilan yang saya capai setelah mengikuti pengembangan keprofesian berkelanjutan untuk memenuhi dan mengembangkan kompetensi inti tersebut', 'Belum nyata terlihat, hanya merasa bertambah wawasan pengetahuan keilmuan')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'E4', 'Pengembangan keprofesian berkelanjutan yang masih saya butuhkan dalam memenuhi dan mengembangkan kompetensi inti tersebut', 'Saya tentu masih membutuhkan pengembangan pengetahuan serta ketrampilan untuk Ke-14 kompetensi inti tersebut. Utamanya  keterampilan mengelola pembelajaran yang bisa / mampu menggugah inspirasi, motivasi belajar peserta didik')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'F1', 'Usaha-usaha yang telah saya lakukan untuk memenuhi dan  mengembangkan kompetensi untuk menghasilkan publikasi ilmiah', 'Mengikuti seminar penulisan PTK, membaca PTK karya guru lain, mencari info seputar PTK')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'F2', 'Kendala yang saya hadapi dalam memenuhi dan mengembangkan kompetensi untuk menghasilkan publikasi ilmiah', 'Belum mampu mengalahkan diri sendiri')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'F3', 'Keberhasilan yang saya capai setelah mengikuti pengembangan keprofesian berkelanjutan untuk memenuhi dan mengembangkan kompetensi untuk menghasilkan publikasi ilmiah', 'Belum ada wujudnya')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'G1', 'Usaha-usaha yang telah saya lakukan untuk memenuhi dan  mengembangkan kompetensi untuk menghasilkan karya inovatif', 'Saya belum melakukan apa-apa untuk hal ini. Hanya sebatas memiliki ide')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'G2', 'Kendala yang saya hadapi dalam memenuhi dan mengembangkan kompetensi untuk menghasilkan karya inovatif', 'Mungkin terkait dengan keyakinan diri, tujuan dan lainnya')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'G3', 'Keberhasilan yang saya capai setelah mengikuti pengembangan keprofesian berkelanjutan untuk memenuhi dan mengembangkan kompetensi untuk menghasilkan karya inovatif', 'Belum ada')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'H1', 'Usaha-usaha yang telah saya lakukan untuk memenuhi dan  mengembangkan kompetensi penunjang pelaksanaan pembelajaran yang berkualitas', 'Saya sudah belajar tentang beberapa program dasar pengoperasian kumputer dan program TIK untuk pengembangan diri')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'H2', 'Kendala yang saya hadapi dalam memenuhi dan mengembangkan kompetensi penunjang pelaksanaan pembelajaran yang berkualitas', 'Perangkat terbatas, kemauan diri')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'H3', 'Keberhasilan yang saya capai setelah mengikuti pengembangan keprofesian berkelanjutan untuk memenuhi dan mengembangkan kompetensi 
penunjang pelaksanaan pembelajaran yang berkualitas', 'Belum nampak')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'H4', 'Pengembangan keprofesian berkelanjutan yang masih saya butuhkan dalam memenuhi dan mengembangkan kompetensi penunjang pelaksanaan pembelajaran yang berkualitas', 'Latihan pemanfaaatan, pengelolaan pembelajaran yang berkualitas')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'I1', 'Usaha-usaha yang telah saya lakukan untuk memenuhi dan  mengembangkan kompetensi penunjang pelaksanaan tugas tambahan', 'Belum ada')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'I2', 'Kendala yang saya hadapi dalam memenuhi dan mengembangkan kompetensi penunjang pelaksanaan tugas tambahan', 'Belum ada')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'I3', 'Keberhasilan yang saya capai setelah mengikuti pengembangan keprofesian berkelanjutan untuk memenuhi dan mengembangkan kompetensi untuk melaksanakan tugas tambahan tersebut', 'Belum ada')");
	$this->db->query("insert into `evaluasi_diri` (`tahun`, `nim`,`kode`, `kompetensi_inti`, `evaluasi`) values ('$tahun', '$nim', 'I4', 'Pengembangan keprofesian berkelanjutan yang masih saya butuhkan dalam memenuhi dan mengembangkan kompetensi untuk melaksanakan 
tugas tambahan tersebut', 'Belum ada')");




}
echo '<p class="text-info">Tanggal penyusunan evaluasi diri guru '.date_to_long_string($tanggal).'</p>';
$nomor = 1;
echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr><td colspan="2"><h3>A. Kompetensi Inti</h3></td><td><h3>Evaluasi diri terhadap kompetensi terkait</h3></td></tr>';
echo '<tr><td colspan="4"><h4>Pedagogik</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'A%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
echo '<tr><td colspan="4"><h4>Kepribadian</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'B%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
echo '<tr><td colspan="4"><h4>Sosial</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'C%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
echo '<tr><td colspan="4"><h4>Profesional</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'D%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>Berbagai hal terkait dengan pemenuhan dan peningkatan kompetensi inti tersebut</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'E%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>B. Kompetensi menghasilkan Publikasi Ilmiah</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'F%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>C. Kompetensi menghasilkan Karya Inovatif</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'G%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>D. Kompetensi untuk penunjang pelaksanaan pembelajaran berkualitas (TIK, Bahasa Asing, dsb)</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'H%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>E. Kompetensi penunjang pelaksanaan tugas tambahan</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'I%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
echo '</table></div>';
echo '<p class="text-center"><a href="'.base_url().'evaluasi/evaluasi/'.$tahun.'/ubah" class="btn btn-primary">Ubah Evaluasi</a> <a href="'.base_url().'evaluasi/evaluasi/'.$tahun.'/cetak" class="btn btn-success">Cetak Evaluasi</a> <a href="'.base_url().'evaluasi/rencana/'.$tahun.'" class="btn btn-info">Rencana Evaluasi</a></p>';
?>
</div></div></div>
