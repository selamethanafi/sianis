<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: kekurangan_siswa_per_kelas_per_tahun.php
// Lokasi      		: application/views/keuangan
// Terakhir diperbarui	: Rab 01 Jul 2015 11:34:03 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div id="bg-isi"><h2>Kekurangan Pembayaran Per Tahun (Tanpa Tunggakan Tahun Lain)</h2><br />
<?php echo form_open('keuangan/cetakkekurangansiswaperkelaspertahun');?>
<table width="870" style="border: 1pt ridge #cccccc;" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="250" valign="middle">Tahun Pelajaran</td><td width="10" valign="middle">:</td><td><input name="thnajaran" size = "20" type="text" readonly="readonly" value="<?php echo $thnajaran;?>"></td></tr>
<tr><td width="250" valign="middle">Kelas</td><td width="10" valign="middle">:</td><td>
<select name="ruang" >
<?php
	echo '<option value="'.$ruang.'">'.$ruang.'</option>';
foreach($querykelas->result() as $bc)
{
	echo '<option value="'.$bc->ruang.'">'.$bc->ruang.'</option>';
}
?>
</select></td></tr>
<tr><td width="150" valign="middle"></td><td width="10" valign="middle"></td><td><input type="submit" value="Proses" class="tombol"></td></tr>
</form>
</table>
<?php
{
if ((!empty($thnajaran)) and (!empty($ruang)))
	{
	$warna="#D6F3FF";
	$nomor=1;
	$truang =mysql_query("select * from m_ruang where ruang='$ruang'");
	$druang = mysql_fetch_array($truang);
	$tingkat = $druang['tingkat'];
	//
	echo '<table width="870" style="border: 1pt ridge #cccccc;" cellpadding="2" cellspacing="1" class="widget-small">
	<tr bgcolor="#FFF" align="center"><td>Nama</td>';
	$tmacam = mysql_query("select * from m_uang where status='1'");
	$dmacam = mysql_fetch_array($tmacam);
	$item= 1;
	do
		{
		echo '<td align="center">'.substr($dmacam['nama'],0,5).'</td>';
		$macam[$item]=$dmacam['nama'];
		$item++;
		}
	while ($dmacam = mysql_fetch_array($tmacam));
	echo '<td>Jumlah</td></tr>';
	$tsk = mysql_query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$ruang' and status='Y' order by no_urut");
	$dsk = mysql_fetch_array($tsk);
	$jmlbsrtung = 0;
	do
		{
			if(($nomor%2)==0){
				$warna="#C8E862";
			} else{
				$warna="#D6F3FF";
			}

		$nis = $dsk['nis'];
		$nama = $dsk['nama'];
		echo '<tr bgcolor="'.$warna.'"><td>'.$nama.'</td>';		
		$jmltung= 0;
		$itemx=1;
		do {
			$macam_pembayaran = $macam[$itemx];
			$tset = mysql_query("select * from m_uang_besar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and tingkat='$tingkat'");
			$dset = mysql_fetch_array($tset);
			$besar[$itemx]=$dset['besar'];
			//cari yang dibayar siswa
			$tsb = mysql_query("select * from siswa_bayar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and nis='$nis'");
			$dsb = mysql_fetch_array($tsb);
			$bayar[$itemx]=0;
			do
				{
				$bayar[$itemx]=$bayar[$itemx]+$dsb['besar'];
				}
			while ($dsb = mysql_fetch_array($tsb));
			$kurang[$itemx]=$besar[$itemx]-$bayar[$itemx];
			echo '<td align="right">'.$kurang[$itemx].'</td>';
			$jmltung=$jmltung+$kurang[$itemx];
			$itemx++;
			}
		while ($itemx<$item);

		echo '<td align="right">'.$jmltung.'</td></tr>';
		$jmlbsrtung = $jmlbsrtung + $jmltung;
		$nomor++;
		}
	while ($dsk = mysql_fetch_array($tsk));
	echo '</table><br>Jumlah Semua Tunggakan '.$jmlbsrtung.'';	
	}

}
echo 'per tanggal '.date("d").'-'.date("m").'-'.date("Y").'';
?>

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div>
