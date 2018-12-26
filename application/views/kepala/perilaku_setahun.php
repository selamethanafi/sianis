<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: perilaku.php
// Lokasi      		: application/views/kepala
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
echo '<div class="container-fluid">';
if (!empty($nip))
{
	$ta = $this->db->query("select * from `p_pegawai` where `nip`='$nip'");
	if (count($ta->result())==0)
	{
		echo 'Galat, guru / pegawai dengan nip '.$nip.', tidak ditemukan.';
	}
	else
	{
		foreach($ta->result() as $da)
		{
			$namapegawai = $da->nama;
		}
		$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and `kode` = '$nip'");
		if(count($tz->result())==0)
		{
			$this->db->query("insert into `ppk_pns` (`kode`,`tahun`) values ('$nip','$tahun')");
		}
		echo '<h4>'.$namapegawai.' </h4>';
		//buat data baru
		$bulane = 1;
		do
		{
			$bulanx= $bulane;
			if ($bulane<10)
			{
				$bulanx = "0".$bulane;
			}
			//cari di perilaku pns
			$tc = $this->db->query("select * from `perilaku_pns` where `tahun`='$tahun' and `bulan`='$bulanx' and `nip`='$nip'");
			if ($tc->num_rows() == 0)
			{
				$this->db->query("insert into `perilaku_pns` (`nip`,`tahun`,`bulan`) values ('$nip','$tahun','$bulanx')");
			}
			$bulane++;
		}
		while ($bulane<13);
		echo form_open('kepala/simpanperilaku/'.$tahun.'/'.$nip.'');
		echo '<div class="table-responsive"><table class="table table-striped table-bordered table-hover">	
		<tr align="center"><td><strong>Penilaian</strong></td><td width="50">Januari</td><td>Februari</td><td>Maret</td><td>April</td><td>Mei</td><td>Juni</td><td>Juli</td><td>Agustus</td><td>September</td><td>Oktober</td><td>November</td><td>Desember</td></tr>';
		$nomor=1;
		foreach($ta->result() as $a)
		{
			//cari nilai
			$bulane = 1;
			do
			{
				$jperbulan[$bulane] = 0;
				$bulane++;
			}
			while ($bulane<13);
			echo '<tr><td>1. Orientasi Pelayanan</td>';
			$bulane = 1;
			$jpelayanan = 0;
			do
			{
				$bulanx= $bulane;
				if ($bulane<10)
				{
					$bulanx = "0".$bulane;
				}
				//cari di perilaku pns
				//pelayanan
				$td = $this->db->query("select * from `perilaku_pns` where `tahun`='$tahun' and `bulan`='$bulanx' and `nip`='$nip'");
				foreach($td->result() as $d)
				{
					echo '<td align="center" width="100"><input type="number" min="76" max="100" name="pelayanan_'.$bulanx.'" value="'.$d->pelayanan.'" class="form-control"></td>';
				}
				$bulane++;
			}
			while ($bulane<13);
			$nomor++;
			//integritas
			echo '<tr><td>2. Integritas</td>';
			$bulane = 1;
			$jintegritas = 0;
			do
			{
				$bulanx= $bulane;
				if ($bulane<10)
				{
					$bulanx = "0".$bulane;
				}
				//cari di perilaku pns
				$td = $this->db->query("select * from `perilaku_pns` where `tahun`='$tahun' and `bulan`='$bulanx' and `nip`='$nip'");
				foreach($td->result() as $d)
				{
					echo '<td align="center" width="100"><input type="number" min="76" max="100" name="integritas_'.$bulanx.'" value="'.$d->integritas.'" class="form-control"></td>';
				}
				$bulane++;
			}
			while ($bulane<13);
			$nomor++;
			//komitmen
			echo '<tr><td>3. Komitmen</td>';
			$bulane = 1;
			$jkomitmen = 0;
			do
			{
				$bulanx= $bulane;
				if ($bulane<10)
				{
					$bulanx = "0".$bulane;
				}
				//cari di perilaku pns
				$td = $this->db->query("select * from `perilaku_pns` where `tahun`='$tahun' and `bulan`='$bulanx' and `nip`='$nip'");
				foreach($td->result() as $d)
				{
					echo '<td align="center" width="100"><input type="number" min="76" max="100" name="komitmen_'.$bulanx.'" value="'.$d->komitmen.'" class="form-control"></td>';
				}
				$bulane++;
			}
			while ($bulane<13);
			$nomor++;
			//disiplin
			echo '<tr><td>4. Disiplin</td>';
			$bulane = 1;
			$jdisiplin = 0;
			do
			{
				$bulanx= $bulane;
				if ($bulane<10)
				{
					$bulanx = "0".$bulane;
				}
				//cari di perilaku pns
				$td = $this->db->query("select * from `perilaku_pns` where `tahun`='$tahun' and `bulan`='$bulanx' and `nip`='$nip'");
				foreach($td->result() as $d)
				{
					echo '<td align="center" width="100"><input type="number" min="76" max="100" name="disiplin_'.$bulanx.'" value="'.$d->disiplin.'" class="form-control"></td>';
				}
				$bulane++;
			}
			while ($bulane<13);
			$nomor++;
			//kerjasama
			echo '<tr><td>5. Kerja sama</td>';
			$bulane = 1;
			$jkerjasama = 0;
			do
			{
				$bulanx= $bulane;
				if ($bulane<10)
				{
					$bulanx = "0".$bulane;
				}
				//cari di perilaku pns
				$td = $this->db->query("select * from `perilaku_pns` where `tahun`='$tahun' and `bulan`='$bulanx' and `nip`='$nip'");
				foreach($td->result() as $d)
				{
					echo '<td align="center" width="100"><input type="number" min="76" max="100" name="kerjasama_'.$bulanx.'" value="'.$d->kerjasama.'" class="form-control"></td>';
				}
				$bulane++;
			}
			while ($bulane<13);
			$nomor++;
			echo '</tr></table>
			<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p></form>';
		}
	}
}
else
{
	echo 'Tidak ada data pegawai';
}
echo '</div>';
