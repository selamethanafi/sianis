<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : transaksi_bulanan.php
// Lokasi      : application/views/keuangan
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
	echo '<div id="isi"><h2>Rekapitulasi Penerimaan Pembayaran Bulanan</h2><br />';
	echo form_open('keuangan/bulanan');
	echo '<table width="100%" style="border: 1pt ridge #cccccc;" cellpadding="2" cellspacing="1" class="widget-small"><tr><td width="150" valign="top">Tahun Pelajaran</td><td width="10" valign="top">:</td><td>
	<select name="thnajaran" class="textfield-option">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	$ta = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
	foreach($ta->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}	echo '</select></td></tr>';
	echo '<tr><td width="150" valign="top">Bulan</td><td width="10" valign="top">:</td><td>';
	echo '<select name="bulan" >';
	echo '<option value="'.$bulan.'">'.$bulan.'</option>';
	echo '<option value="Semua">Semua</option>';		
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></td></tr>';

echo '<tr><td width="150" valign="middle"></td><td width="10" valign="middle"></td><td><input name="proses" type="hidden" value="1"><input type="submit" value="Proses" class="tombol"></td></tr>
</table>
</form>';
if ((!empty($thnajaran)) and (!empty($bulan)))
	{
	if ($bulan=='Semua')
		{
		echo '<table>';
		$td = $this->db->query("select * from `siswa_bayar` where `thnajaran`='$thnajaran'");
		$semua = 0;
		foreach($td->result() as $d)
			{
			$semua = $semua + $d->besar;
			echo '<tr><td>'.$d->nis.'</td><td>'.nis_ke_nama($d->nis).'</td><td>'.$d->macam_pembayaran.'</td><td align="right">'.$d->besar.'</td><td align="right">'.xduit($semua).'</td></tr>';
			}
		echo '</table>';
		echo '<br />Jumlah Penerimaan <strong>'.xduit($semua).'</strong> Terbilang <strong>'.xduitf($semua).'</strong>';	

		}
		else
		{
//		$tahun1 = substr($thnajaran,0,4);
//		$tahun2 = substr($thnajaran,5,4);
		$bulane = "%-".$bulan."-%";
		echo '<table border="1">';
		$td = $this->db->query("select * from `siswa_bayar` where `thnajaran`='$thnajaran' and tanggal like '$bulane'");
		$semua = 0;
		foreach($td->result() as $d)
			{
			
			$semua = $semua + $d->besar;
echo '<tr><td>'.$d->nis.'</td><td>'.nis_ke_nama($d->nis).'</td><td>'.date_to_long_string($d->tanggal).'</td><td>'.$d->macam_pembayaran.'</td><td align="right">'.$d->besar.'</td><td align="right">'.xduit($semua).'</td></tr>';
			}
		echo '</table>';
		echo '<br />Jumlah Penerimaan <strong>'.xduit($semua).'</strong> Terbilang <strong>'.xduitf($semua).'</strong>';	
		}
	}
echo '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div>';
