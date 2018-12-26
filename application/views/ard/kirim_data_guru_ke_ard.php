<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2018 12:23:28 WIB 
// Nama Berkas 		: ard_login.php
// Lokasi      		: application/views/ard/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tb = $this->db->query("select * from `ard_login` where `username`='$kd'");
foreach($tb->result() as $b)
{
	$teacher_id = $b->teacher_id;
	$username_ard = $b->username_ard;
}
$datadesa = $this->Model_select->data_desa($id_desa);
$id_kec = $datadesa[2];
$datakec = $this->Model_select->data_kecamatan($id_kec);
$id_kab = $datakec[2];
$datakab = $this->Model_select->data_kabupaten($id_kab);
$id_prov = $datakab[2];
$dataprov = $this->Model_select->data_provinsi($id_prov);
echo 'Kode Guru ARD '.$teacher_id;
echo ' Kode Desa '.$id_desa;
if(!empty($teacher_id))
{
	$ta = $this->db->query("select * from `p_pegawai` where `kd`='$kd'");
	foreach($ta->result() as $a)
	{
		echo '<form method="post" action="'.$url_ard.'/ma/operator_madrasah/functions/teacher/edit/'.$teacher_id.'" enctype="multipart/form-data">
	<input type="hidden" name="category_ladder_id" value="3" required />
	<input type="text" class="form-control" placeholder="Provinsi" value="'.$dataprov[1].'" readonly />
	<input type="text" class="form-control" placeholder="Kota/Kabupaten" value="'.$datakab[1].'" readonly />
	<input type="text" class="form-control" placeholder="Madrasah" value="'.$sek_nama_ard.'" readonly />
	<input type="text" name="school_id" value="'.$school_id.'" required readonly />
<input type="text" class="form-control" name="teacher_name" placeholder="NIP" value="'.$a->nama.'" required readonly />
<input type="text" class="form-control" name="teacher_nip" placeholder="NIP" value="'.$username_ard.'" required readonly />
<input type="text" class="form-control" name="teacher_npwp" placeholder="NPWP" value="'.$a->npwp.'" required readonly />
<input type="text" class="form-control" name="teacher_nuptk" placeholder="NUPTK" value="'.$a->nuptk.'" required readonly />';
		echo '<select class="form-control" name="teacher_gender" required>';
	if($a->jenkel == 'Lk')
	{
		echo '<option value="laki-laki" selected>Laki-laki</option>';
	}
	else
	{
		echo '<option value="perempuan" selected>Perempuan</option>';
	}
	echo '</select>
	<input type="text" class="form-control" name="teacher_place_of_birth" placeholder="Tempat Lahir" value="'.$a->tempat.'" required />
<input type="text" class="form-control date" name="teacher_date_of_birth" placeholder="Tanggal Lahir" value="'.$a->tanggallahir.'" required />
<select class="form-control" name="teacher_religion" required>
<option value="islam" selected>Islam</option>
<input type="email" class="form-control" name="teacher_email" placeholder="Email" value="'.$a->email.'" required />
<input type="text" class="form-control" name="teacher_phone" placeholder="Telepon" value="'.$a->seluler.'" required />
<select class="form-control" name="master_province_id" id="master_province_id" required>
<option value="'.$id_prov.'" selected>'.$dataprov[1].'</option>
</select>
</div>
<select class="form-control" name="master_regency_id" id="master_regency_id" required>
<option value="'.$id_kab.'" selected>'.$datakab[1].'</option>
</select>
<select class="form-control" name="master_district_id" id="master_district_id" required>
<option value="'.$id_kec.'" selected>'.$datakec[1].'</option>
</select>
<select class="form-control" name="master_village_id" id="master_village_id" required>
<option value="'.$id_desa.'" selected>'.$datadesa[1].'</option>
</select>
<textarea class="form-control" name="teacher_address" placeholder="Alamat" rows="5" required>'.$a->alamat.'</textarea>
<input type="text" class="form-control" name="teacher_postal_code" placeholder="Kodepos" value="'.$a->kodepos.'" required />';
	echo '
<button type="submit" class="btn btn-md btn-primary">
<i class="fa fa-save"></i> Simpan
</button>
</form>';
	}
}
