<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: cetak_rekap.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2>Mencetak Daftar Riwayat Hidup</h2>
<?php echo form_open('tatausaha/cetakrekap');?>
<table>
<?php
	if (!empty($usernamepegawai))
		{
		echo '<tr><td>Nama Pegawai</td><td>:</td><td>
		<select name="usernamepegawai" class="textfield-option"><option value="'.$usernamepegawai.'">'.$namapegawai.'</option></select><font color="#FF0000"> '.$terupdate.'</strong></font></td></tr>';
		}
		else
		{
		echo '<tr><td>Nama Pegawai</td><td>:</td><td>
		<select name="usernamepegawai" class="textfield-option">';
		echo "<option value=''></option>";
		foreach($querypegawai->result() as $a)
			{
			echo "<option value='".$a->kd."'>".$a->nama."</option>";
			}

		}
	?>
	</select></td></tr>
<tr><td></td><td></td><td>
<?php
	if (empty($usernamepegawai))
		{	echo '<input type="submit" value="Lanjut" class="tombol-merah">';
		}
		else
		{
		echo '<input type="hidden" name="terupdate" value="oke"><input type="submit" value="Simpan Data Umum Pegawai" class="tombol-merah">&nbsp&nbsp&nbsp<a href="'.base_url().'index.php/tatausaha/keluarga"><b>Batal</b></a>';
		}


?>
</form>
</table>
<div class="clear padding20"></div>
</div>
