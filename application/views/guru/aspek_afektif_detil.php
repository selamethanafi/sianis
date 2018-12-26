<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: aspek_afektif_detil.php
// Terakhir diperbarui	: Rab 11 Mei 2016 23:55:55 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php
if ((empty($id_mapel)) or (empty($nomoraspek)))
	{
	echo 'Kode Mapel tidak disertakan dan atau kode aspek, klik  <a href="'.base_url().'guru/afektif">di sini <span class="glyphicon glyphicon-arrow-right"></span></a>';
	}
	else
	{
	$ta = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	$ada = $ta->num_rows();
	if(($ada == 0) or ($nomoraspek>10))
		{
		echo 'Kode Mapel tidak ada atau bukan yang diampu atau aspek penilaian lebih dari 10, klik  <a href="'.base_url().'guru/afektif/'.$id_mapel.'">di sini <span class="glyphicon glyphicon-arrow-right"></span></a>';
		}
		else
		{
			foreach($ta->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester= $dtmapel->semester;
			}
			$tapa = $this->db->query("select * from aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
			$aspekpenilaian = '';
			if($nomoraspek<16)
				{
				$itemex = "p".$nomoraspek;
				foreach($tapa->result() as $dapa)
					{
					$aspekpenilaian = $dapa->$itemex;
					}
				}

?>
<div class="table-responsive">
<table class="table">
<tr><td>Tahun Pelajaran</td><td>:</td><td><strong><?php echo $thnajaran?></strong></td></tr>
<tr><td>Semester</td><td>:</td><td><strong><?php echo $semester?></strong></td></tr>
<tr><td>Kelas</td><td>:</td><td><strong><?php echo $kelas;?></strong></td></tr>
<tr><td>Mata Pelajaran</td><td>:</td><td><strong><?php echo $mapel;?></strong></td></tr>
<tr><td>Penilaian </td><td>:</td><td><strong><?php echo $aspekpenilaian;?></strong></td></tr>
</table>
</div>
<?php
$tap = $this->db->query("select * from detil_aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek'");
$ada = $tap->num_rows();
if($ada == 0)
	{
	$this->db->query("insert into detil_aspek_afektif (`thnajaran`,`semester`,`kelas`,`mapel`,`nomoraspek`) values ('$thnajaran','$semester','$kelas','$mapel','$nomoraspek')");
	}
$tap = $this->db->query("select * from detil_aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and nomoraspek='$nomoraspek'");
$nomor = 0;
?>
<form class="form-horizontal" role="form" action="<?php echo base_url();?>k2013/updateaspekafektif" method="post">
<?php
foreach($tap->result() as $dap)
{
	$teknik = $dap->teknik;
	$keterangan = $dap->keterangan;
	?>
	<div class="form-group row row">
		<div class="col-sm-4"><label for="teknikpenilaian" class="control-label">Teknik Penilaian</label></div>
		<div class="col-sm-8" ><input type="text" name="teknik" value="<?php echo $teknik;?>" class="form-control"></div>
	</div>
<?php
	do
	{
	$item = $nomor+1;
	$iteme2 = "p".$item;
	$dapitem2 = $dap->$iteme2;

	if($nomoraspek == 1)
		{
		if($item == 1)
			{
			$dapitem2 = 'berdoa sebelum dan sesudah menjalankan sesuatu';
			}
		if($item == 2)
			{
			$dapitem2 = 'menjalankan ibadah tepat waktu';
			}
		if($item == 3)
			{
			$dapitem2 = 'memberi salam pada saat awal dan akhir presentasi';
			}
		if($item == 4)
			{
			$dapitem2 = 'bersyukur atas nikmat dan karunia Allah, SWT.';
			}
		if($item == 5)
			{
			$dapitem2 = 'mensyukuri kemampuan manusia dalam mengendalikan diri';
			}
		if($item == 6)
			{
			$dapitem2 = 'mengucapkan syukur ketika berhasil mengerjakan sesuatu';
			}
		if($item == 7)
			{
			$dapitem2 = 'berserah diri (tawakal) kepada Tuhan setelah berikhtiar atau melakukan usaha';
			}
		if($item == 8)
			{
			$dapitem2 = 'menjaga lingkungan hidup di sekitar rumah tempat tinggal, sekolah, dan masyarakat';
			}
		if($item == 9)
			{
			$dapitem2 = 'bersyukur kepada Tuhan Yang Maha Esa sebagai bangsa Indonesia';
			}
		if($item == 10)
			{
			$dapitem2 = 'menghormati orang lain menjalankan ibadah sesuai dengan agamanya';
			}
		} // akhir nomoraspek 1
	if($nomoraspek == 2)
		{
		if($item == 1)
			{
 			$dapitem2 = 'tidak menyontek dalam mengerjakan ujian/ulangan';
			}
		if($item == 2)
			{
			$dapitem2 = 'tidak melakukan plagiarisme (mengambil/menyalin karya orang lain tanpa menyebutkan sumber)';
			}
		if($item == 3)
			{
			$dapitem2 = 'mengungkapkan perasaan apa adanya';
			}
		if($item == 4)
			{
			$dapitem2 = 'menyerahkan barang temuan kepada yang berwenang atau berhak';
			}
		if($item == 5)
			{
			$dapitem2 = 'membuat laporan berdasarkan data atau informasi apa adanya';
			}
		if($item == 6)
			{
			$dapitem2 = 'mengakui kesalahan atau kekurangan yang dimiliki';
			}
		} // akhir nomoraspek 2
	if($nomoraspek == 3)
		{
		if($item == 1)
			{
			$dapitem2 = 'datang tepat waktu';
			}
		if($item == 2)
			{
			$dapitem2 = 'patuh pada tata tertib atau aturan bersama/sekolah';
			}
		if($item == 3)
			{
			$dapitem2 = 'mengerjakan/mengumpulkan tugas sesuai dengan waktu yang ditentukan';
			}
		if($item == 4)
			{
			$dapitem2 = 'mengikuti kaidah berbahasa yang baik dan benar';
			}
		} // akhir nomoraspek 3
	if($nomoraspek == 4)
		{
		if($item == 1)
			{
			$dapitem2 = 'melaksanakan tugas individu dengan baik';
			}
		if($item == 2)
			{
			$dapitem2 = 'menerima risiko dari tindakan yang dilakukan';
			}
		if($item == 3)
			{
			$dapitem2 = 'tidak menyalahkan/menuduh orang lain tanpa bukti yang akurat';
			}
		if($item == 4)
			{
			$dapitem2 = 'mengembalikan barang yang dipinjam';
			}
		if($item == 5)
			{
			$dapitem2 = 'mengakui dan meminta maaf atas kesalahan yang dilakukan';
			}
		if($item == 6)
			{
			$dapitem2 = 'menepati janji';
			}
		} // akhir nomoraspek 4
	if($nomoraspek == 5)
		{
		if($item == 1)
			{
			$dapitem2 = 'tidak mengganggu teman yang berbeda pendapat';
			}
		if($item == 2)
			{
			$dapitem2 = 'menerima kesepakatan meskipun berbeda pendapat';
			}
		if($item == 3)
			{
			$dapitem2 = 'dapat menerima kekurangan orang lain';
			}
		if($item == 4)
			{
			$dapitem2 = 'dapat mememaafkan kesalahan orang lain';
			}
		if($item == 5)
			{
			$dapitem2 = 'menghormati teman memiliki keberagaman latar belakang, pandangan, dan keyakinan';
			}
		} // akhir nomoraspek 5
	if($nomoraspek == 6)
		{
		if($item == 1)
			{
			$dapitem2 = 'aktif dalam bekerja bakti membersihkan kelas atau sekolah';
			}
		if($item == 2)
			{
			$dapitem2 = 'bersedia melakukan tugas sesuai kesepakatan';
			}
		if($item == 3)
			{
			$dapitem2 = 'bersedia membantu orang lain tanpa mengharap imbalan';
			}
		if($item == 4)
			{
			$dapitem2 = 'aktif dalam kerja kelompok';
			}
		} // akhir nomoraspek 6
	if($nomoraspek == 7)
		{
		if($item == 1)
			{
			$dapitem2 = 'menghormati orang yang lebih tua';
			}
		if($item == 2)
			{
			$dapitem2 = 'tidak berkata kotor, kasar, dan takabur';
			}
		if($item == 3)
			{
			$dapitem2 = 'tidak melakukan tindakan jorok, cabul, dan cemar bukan pada tempatnya';
			}
		if($item == 4)
			{
			$dapitem2 = 'tidak menyela pembicaraan pada waktu yang tidak tepat';
			}
		if($item == 5)
			{
			$dapitem2 = 'mengucapkan terima kasih setelah menerima bantuan orang lain';
			}
		if($item == 6)
			{
			$dapitem2 = 'melakukan 3S (salam, senyum, sapa)';
			}
		if($item == 7)
			{
			$dapitem2 = 'meminta izin ketika akan memasuki ruangan orang lain atau menggunakan barang milik orang lain';
			}
		if($item == 8)
			{
			$dapitem2 = 'memberi perlakuan kepada orang lain seperti perlakuan yang diinginkan untuk diri sendiri';
			}
		} // akhir nomoraspek 7
	if($nomoraspek == 8)
		{
		if($item == 1)
			{
			$dapitem2 = 'berpendapat atau melakukan kegiatan tanpa ragu-ragu';
			}
		if($item == 2)
			{
			$dapitem2 = 'mampu membuat keputusan dengan cepat';
			}
		if($item == 3)
			{
			$dapitem2 = 'tidak mudah putus asa';
			}
		if($item == 4)
			{
			$dapitem2 = 'tidak canggung dalam bertindak';
			}
		if($item == 5)
			{
			$dapitem2 = 'berani presentasi di depan kelas';
			}
		if($item == 6)
			{
			$dapitem2 = 'berani berpendapat, bertanya, atau menjawab pertanyaan kepada orang lain';
			}
		if($item == 7)
			{
			$dapitem2 = 'berani memberikan kritik dan saran kepada orang lain';
			}
		if($item == 8)
			{
			$dapitem2 = 'berani menerima atau menolak pendapat orang lain dengan santun';
			}
		} // akhir nomoraspek 8

	echo '<div class="form-group row row">
		<div class="col-sm-4"><label for="Detil_Aspek_Penilaian_Sikap_'.$item.'" class="control-label">Detil Aspek Penilaian Sikap '.$item.'</label></div>
		<div class="col-sm-8" ><input tpye="text" name="p'.$item.'" value="'.$dapitem2.'" class="form-control"></div>
	</div>';
	$nomor++;
	}
	while ($nomor<10);
}
echo '<label for="ketpilihan" class="control-label"><strong>Keterangan Penilaian</strong></label>
	<textarea name="keterangan" class="form-control" rows="15">'.$keterangan.'</textarea></div>';	
echo '<input type="hidden" name="id_mapel" value="'.$id_mapel.'"><input type="hidden" name="nomoraspek" value="'.$nomoraspek.'"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><input type="hidden" name="semester" value="'.$semester.'"><input type="hidden" name="mapel" value="'.$mapel.'"><input type="hidden" name="id_aspek_afektif" value="'.$dap->id_detil_aspek_afektif.'"><input type="hidden" name="kelas" value="'.$kelas.'">';
?><p></p>
<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN</button></p>
</form>
<?php
}//akhir berhak
}
?>

</div>
