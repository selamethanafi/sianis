<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	 Min 09 Nov 2014 160028 WIB 
// Nama Berkas 		 edit_siswa.php
// Lokasi      		 application/views/tatausaha/
// Author      		 Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>

<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		
	?>
	<form method="post" action="<?php echo $url_ard;?>/ma/operator_madrasah/functions/student/edit/<?php echo $t->id_ard_siswa;?>" enctype="multipart/form-data">
	<input type="hidden" class="form-control" placeholder="Jenjang" value="Madrasah Aliyah" readonly />
	<input type="hidden" name="category_ladder_id" value="3">
	<input type="hidden" class="form-control" placeholder="Provinsi" value="JAWA TENGAH" readonly />
	<input type="hidden" class="form-control" placeholder="Kota/Kabupaten" value="KABUPATEN SEMARANG" readonly />
	<input type="hidden" class="form-control" placeholder="Madrasah" value="MAN 2 Semarang" readonly />
	<input type="hidden" name="school_id" value="<?php echo $school_id;?>">
	<input type="hidden" class="form-control" name="student_nisn" placeholder="NISN" value="<?php echo $t->nisn;?>"  readonly />
	<input type="hidden" class="form-control" name="student_nis" placeholder="NIS" value="<?php echo $kode_tambahan_nis_ard.$t->nis;?>">
	<input type="hidden" class="form-control" name="student_from_school" placeholder="Madrasah Asal" value="<?php echo $t->sltp;?>">
	<?php
/*
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
$daftar_mapel = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas` = '$kelas'");
	$kode_rombel = '';
	foreach($daftar_mapel->result() as $dw)
	{
		$kode_rombel = $dw->kode_rombel;
	}
	?>
	<input type="hidden" class="form-control" name="school_class_id" value="<?php echo $kode_rombel;?>">
	<?php
*/
	if(substr($t->kdkls,0,4)== 'XII-')
	{
		echo '<input type="hidden" name="student_from_class" value="12" >';
	}
	elseif(substr($t->kdkls,0,3)== 'XI-')
	{
		echo '<input type="hidden" name="student_from_class" value="11" >';
	}
	else
	{
		echo '<input type="hidden" name="student_from_class" value="10" >';
	}
	?>
	<input type="hidden" class="form-control date" name="student_from_date" placeholder="Pada Tanggal" value="<?php echo $t->tglditerima;?>" id="date">
	<input type="hidden" class="form-control" name="student_name" placeholder="Nama" value="<?php echo $t->nama;?>">
	<input type="hidden" name="student_gender" value="<?php echo strtolower($t->jenkel);?>">
	<input type="hidden" class="form-control" name="student_place_of_birth" placeholder="Tempat Lahir" value="<?php echo $t->tmpt;?>"/>
	<input type="hidden" class="form-control date" name="student_date_of_birth" placeholder="Tanggal Lahir" value="<?php echo $t->tgllhr;?>">
	<input type="hidden" class="form-control" name="student_religion" value="islam">
	<input type="hidden" class="form-control" name="student_phone" placeholder="Telepon" value="<?php echo $t->hp;?>">
<input type="hidden" class="form-control" name="student_email" placeholder="Email" value="<?php echo $t->nis;?>@man2semarang.sch.id">
	<input type="hidden" name="student_family_status" value="anak+kandung">
	<input type="hidden" name="student_family_grade" value="<?php echo $t->anakke;?>">
	<input type="hidden" name="master_province_id" value="<?php echo substr($t->id_desa,0,2);?>">
	<input type="hidden" name="master_regency_id" value="<?php echo substr($t->id_desa,0,4);?>">
	<input type="hidden" name="master_district_id" id="master_district_id" value="<?php echo substr($t->id_desa,0,7);?>">
	<input type="hidden" name="master_village_id" id="master_village_id" value="<?php echo $t->id_desa;?>">
	<input type="hidden" name="student_address" placeholder="Alamat" value="<?php echo $t->alamat;?>">
	<input type="hidden" class="form-control" name="student_postal_code" placeholder="Kodepos" value="<?php echo $t->kodepos;?>">
	<input type="hidden" class="form-control" name="student_father_nik" placeholder="NIK Ayah" value="<?php echo $t->nik_kk;?>">
	<input type="hidden" class="form-control" name="student_father_name" placeholder="Nama Ayah" value="<?php echo $t->nmayah;?>">
	<?php
	$tglayah = $t->tglayah;
	if((empty($t->tglayah)) or ($t->tglayah == '0000-00-00'))
	{
		$tglayah = '';
	}?>
	<?php
	$tglibu = $t->tglibu;
	if((empty($t->tglibu)) or ($t->tglibu == '0000-00-00'))
	{
		$tglibu = '';
	}?>
	<?php
	$tglwali = $t->tglwali;
	if((empty($t->tglwali)) or ($t->tglwali == '0000-00-00'))
	{
		$tglwali = '';
	}?>
	<input type="hidden" class="form-control date" name="student_father_date_of_birth" placeholder="Tanggal Lahir Ayah" value="<?php echo $tglayah;?>">
	<input type="hidden" name="student_father_educational_level" value="<?php echo sekolah_ard($t->sekayah);?>">
	<?php
	if($t->payah == 'Tidak bekerja (Di rumah saja)')
	{
		$pekerjaanayah = 'Tidak bekerja';
	}
	else
	{
		$pekerjaanayah = $t->payah;
	}?>
	<input type="hidden" class="form-control" name="student_father_occupation" value="<?php echo $pekerjaanayah;?>">
	<input type="hidden" class="form-control" name="student_father_phone" placeholder="Nomor Telepon Ayah" value="<?php echo $t->tayah;?>">
	<input type="hidden" class="form-control" name="student_mother_nik" placeholder="NIK Ibu" value="<?php echo $t->nik_ibu;?>">
	<input type="hidden" class="form-control" name="student_mother_name" placeholder="Nama Ibu" value="<?php echo $t->nmibu;?>">
	<input type="hidden" class="form-control date" name="student_mother_date_of_birth" placeholder="Tanggal Lahir Ibu" value="<?php echo $tglibu;?>">
	<input type="hidden" name="student_mother_educational_level" value="<?php echo sekolah_ard($t->sekibu);?>">
	<?php
	if($t->pibu == 'Tidak bekerja (Di rumah saja)')
	{
		$pekerjaanibu = 'Tidak bekerja';
	}
	else
	{
		$pekerjaanibu = $t->pibu;
	}?>

	<input type="hidden" class="form-control" name="student_mother_occupation" placeholder="Pekerjaan Ibu" value="<?php echo $pekerjaanibu;?>">
	<input type="hidden" class="form-control" name="student_mother_phone" placeholder="Nomor Telepon Ibu" value="<?php echo $t->tibu;?>">
	<?php
	if(!empty($t->nmwali))
	{?>
	<input type="hidden" class="form-control" name="student_guardian_nik" placeholder="NIK Wali" value="<?php echo $t->nik_wali;?>">
	<input type="hidden" class="form-control" name="student_guardian_name" placeholder="Nama Wali" value="<?php echo $t->nmwali;?>">
	<input type="hidden" class="form-control date" name="student_guardian_date_of_birth" placeholder="Tanggal Lahir Wali" value="<?php echo $tglwali;?>">
	<input type="hidden" name="student_guardian_educational_level" value="<?php echo sekolah_ard($t->sekwali);?>">
	<?php
	if($t->pwali == 'Tidak bekerja (Di rumah saja)')
	{
		$pekerjaanwali = 'Tidak bekerja';
	}
	else
	{
		$pekerjaanwali = $t->pwali;
	}?>
	<input type="hidden" class="form-control" name="student_guardian_occupation" placeholder="Pekerjaan Wali" value="<?php echo $pekerjaanwali;?>">
	<input type="hidden" class="form-control" name="student_guardian_phone" placeholder="Nomor Telepon Wali" value="<?php echo $t->twali;?>">
	<?php
	}
	else
	{?>
	<input type="hidden" class="form-control" name="student_guardian_nik" placeholder="NIK Wali" value="">
	<input type="hidden" class="form-control" name="student_guardian_name" placeholder="Nama Wali" value="">
	<input type="hidden" class="form-control date" name="student_guardian_date_of_birth" placeholder="Tanggal Lahir Wali" value="">
	<input type="hidden" name="student_guardian_educational_level" value="">
	<input type="hidden" class="form-control" name="student_guardian_occupation" placeholder="Pekerjaan Wali" value="">
	<input type="hidden" class="form-control" name="student_guardian_phone" placeholder="Nomor Telepon Wali" value="">
	<?php
	}?>
	<p class="text-center"><button type="submit" class="btn btn-primary">KIRIM KE ARD</button></p>
	</form>
	<?php
	}
}
else{
echo '<div class="alert alert-danger">Data siswa tidak ditemukan</div>';
}
?>

