<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: analisis_jawaban_siswa_edit.php
// Terakhir diperbarui	: Jum 13 Mei 2016 21:52:56 WIB 
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
<script language="javascript">
 function CountLeft(field, count, max) {
 if (field.value.length > max)
 field.value = field.value.substring(0, max);
 else
 count.value = field.value.length + 1;
 }
 </script>
<div class="container-fluid">
<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>"><b> Kembali</b></a>
<?php
$tanalisis = $this->db->query("select * from analisis where id_analisis='$id_analisis'");
$ada = count($tanalisis->result());
if ($ada>0)
{
	foreach($tanalisis->result() as $d);
	echo form_open('guru/updateanalisis');
	$namasiswa = nis_ke_nama($d->nis);
	$jawaban = $d->jawaban;
	$kelompok = $d->kelompok;
	echo '<h2>'.$namasiswa.'</h2>';
	echo '<label>Kelompok (kosong berarti kelompok A, diisi sembarang berarti kelompok B</label>';
	echo '<input type="text" size="1" name="kelompok" value="'.$kelompok.'" class="textfield"> ';
	?>
	<label>Nomor<label> <input readonly type="text" name="left" size=3 maxlength=3
 value="1"  class="textfield">
	<?php
	echo '<label>Jawaban Siswa</label>';
	?>
	 <input name="jawabane" type="text" value="<?php echo $jawaban;?>" size="<?php echo $nsoal+10;?>"  onKeyDown="CountLeft(this.form.jawabane,this.form.left,<?php echo $nsoal;?>);" onKeyUp="CountLeft(this.form.jawabane,this.form.left,<?php echo $nsoal;?>);"  class="textfield">
	<?php
	if ($nsoalb>0)
	{
		$nomorb = 0;
		echo '<label>Soal Uraian Nomor</label> ';
		do
		{
		$nomorsoalb = $nomorb+1;
		$itemenilaib = "uraian_".$nomorsoalb;
		$nilaianalisisb = $d->$itemenilaib;
	
		echo $nomorsoalb.'. ';echo '<input type="text" size="3" name="uraian_'.$nomorsoalb.'" value="'.$nilaianalisisb.'">';
		$nomorb++;
		}
		while ($nomorb<$nsoalb);
	}
	?>
	<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
	<input type="hidden" name="entry" value="jawaban siswa">
	<input type="hidden" name="id_analisis" value="<?php echo $id_analisis;?>">
	<input type="hidden" name="skora" value="<?php echo $skora;?>">
	<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
	<input type="hidden" name="nsoal" value="<?php echo $nsoal;?>">
	<input type="hidden" name="kunci" value="<?php echo $kunci;?>">
	<input type="hidden" name="kuncib" value="<?php echo $kuncib;?>">
	<input type="hidden" name="nsoalb" value="<?php echo $nsoalb;?>">
	<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
	<input type="submit" value="Simpan Data" class="tombol">
	</form>
<?php
}
else
{
echo 'DATA TIDAK ADA';
}
?>
</div>
</BODY></HTML>

