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
$tm = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
$xloc = base_url().'kepala/perilaku';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
	<h3>Tahun Penilaian <select name="tahun" onChange="MM_jumpMenu('self',this,0)" class="form-control-static">";
	<?php
	echo '<option value="'.$xloc.'/'.$tahun.'">'.$tahun.'</option>';
	foreach($tm->result() as $m)
	{
	echo '<option value="'.$xloc.'/'.substr($m->thnajaran,0,4).'">'.substr($m->thnajaran,0,4).'</option>';
	}
	echo '</select></h3>';
echo '</form>';
//cari nilai
$bulane = 1;
do
{
	$jperbulan[$bulane] = 0;
	$bulane++;
}
while ($bulane<13);
$rataperitem1 = 0;
$rataperitem2 = 0;
$rataperitem3 = 0;
$rataperitem4 = 0;
$rataperitem5 = 0;
$rataperitem6 = 0;
if (!empty($nip))
{
	$ta = $this->db->query("select * from `p_pegawai` where `status`='Y' and `nip`='$nip'");
	if (count($ta->result())==0)
	{
		echo 'Galat, guru dengan NIP '.$nip.', tidak ditemukan.';
	}
	else
	{
	foreach($ta->result() as $a)
	{
		$namapegawai = $a->nama;
		$kodeguru = $a->kodeguru;
	}
	$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip'");
	if(count($tz->result())==0)
	{
	$this->db->query("insert into `ppk_pns` (`kode`,`tahun`) values ('$nip','$tahun')");
	}
	$adatambahan = 0;
	$tambahan = '';
	$tsk = $this->db->query("SELECT * FROM `p_tugas_tambahan` where `thnajaran` like '%$tahun%' and `kodeguru`='$kodeguru'");
	foreach($tsk->result() as $dsk)
		{
		$tambahan = $dsk->nama_tugas;
		}
	if ((substr($tambahan,0,10)=='Kepala Mad') or (substr($tambahan,0,10)=='Kepala Sek'))
		{
		$adatambahan = 1;
		}

	echo '<h4>'.$namapegawai.' </h4>';
		if ($aksi == 'oke')
			{
				$tc = $this->db->query("update `perilaku_pns` set `pelayanan`='$pelayanan', `integritas`='$integritas' , `komitmen`='$komitmen' , `disiplin`='$disiplin' , `kerjasama`='$kerjasama', `kepemimpinan`='$kepemimpinan', `awal_bulan`='$awalbulanpost', `akhir_bulan` = '$akhirbulanpost', `nama_penilai`='$namapenilaipost', `nip_penilai`='$nippenilaipost', `jabatan_penilai`='$jabatanpenilaipost' where `tahun`='$tahun' and `bulan`='$bulanpost' and `nip`='$nip'");

			}
		if($bulan == 14)
			{
			echo form_open('kepala/perilaku/'.$tahun.'/'.$nip.'');
			$te = $this->db->query("select * from `ppk_pns` where `tahun`='$tahun' and `kode`='$nip'");
			foreach($te->result() as $e)
				{
				$batase_skp =$e->batas_skp;
				}
			echo '<table class="table table-striped table-bordered table-hover">
	<tr align="center"><td>Batas SKP</td><td>:</td><td><input name="batas_skp" size ="4" value="'.$batase_skp.'" class="form-control"></td></tr><tr><td><input type="hidden" name="aksi" value="oke_skp"><input type="submit" value="Simpan" class="tombol-merah"></td></tr><table>';
		}
		if(($bulan>0) and ($bulan<13))
			{
			$bulan = $bulan * 1;
			$bulanx = $bulan;
			$tanggalakhir = 30;
			if ($bulan<10)
				{
				$bulanx = "0".$bulan;
				}
			if (($bulan == 1) or ($bulan == 3) or ($bulan == 5) or ($bulan == 7) or ($bulan == 8) or ($bulan == 10) or ($bulan == 12))
				{
				 $tanggalakhir = 31;
				}
			if ($bulan == 2)
				{
				 $tanggalakhir = 28;
				}
			if (($bulan == 4) or ($bulan == 6) or ($bulan == 9) or ($bulan == 11))
				{
				 $tanggalakhir = 30;
				}

			echo form_open('kepala/perilaku/'.$tahun.'/'.$nip.'');
			echo '<table class="table table-striped table-bordered table-hover">
	<tr><td>Tanggal Penilaian</td><td><select name="awal_bulan">';
				echo '<option value="01">01</option>';
				echo '<option value="02">02</option>';
				echo '<option value="03">03</option>';
				echo '<option value="04">04</option>';
				echo '<option value="05">05</option></select> s.d. <select name="akhir_bulan">';
				echo '<option value="'.$tanggalakhir.'">'.$tanggalakhir.'</option>';
				$awal = $tanggalakhir;
					do
					{
					echo '<option value="'.$awal.'">'.$awal.'</option>';
					$awal--;
					}
					while ($awal>27);
					echo '</select>';
			echo ''.angka_jadi_bulan($bulanx).' '.$tahun.'</td></tr>';
			$tc = $this->db->query("select * from `perilaku_pns` where `tahun`='$tahun' and `bulan`='$bulanx' and `nip`='$nip'");
			foreach($tc->result() as $c)
			{
			echo '<tr><td>1. Orientasi Pelayanan</td><td><input type="number" min="76" max="100" name="pelayanan" value="'.$c->pelayanan.'" class="form-control"></td></tr>
			<tr><td>2. Integritas</td><td><input type="number" min="76" max="100" name="integritas" class="form-control" value="'.$c->integritas.'"></td></tr>
			<tr><td>3. Komitmen</td><td><input type="number" min="76" max="100" name="komitmen" class="form-control" value="'.$c->komitmen.'"></td></tr>
			<tr><td>4. Disiplin</td><td><input type="number" min="76" max="100" name="disiplin" class="form-control" value="'.$c->disiplin.'"></td></tr>
			<tr><td>5. Kerjasama</td><td><input type="number" min="76" max="100" name="kerjasama" class="form-control" value="'.$c->kerjasama.'"></td></tr>';
/*
			if ($adatambahan ==1)
				{
					echo '<tr><td>6. Kepemimpinan</td><td><input type="number" min="76" max="100" name="kepemimpinan" value="'.$c->kepemimpinan.'" class="form-control"></td></tr>';	
				}
*/
			}
		if ($adatambahan ==0)
			{
			$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahun' and dinilai='guru'");
			}
		if ($adatambahan ==1)
			{
			$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahun' and dinilai='kepala'");
			}
			$nama_penilai = '';
			$nip_penilai = '';
			$pangkat_golongan_penilai = '';
			$jabatan_penilai = '';
			$unit_organisasi_penilai = '';
			$nama_atasan_penilai = '';
			$nip_atasan_penilai = '';
			$pangkat_golongan_atasan_penilai = '';
			$jabatan_atasan_penilai = '';
			$unit_organisasi_atasan_penilai = '';
			foreach($ta->result() as $a)
			{
			$nama_penilai = $a->nama_penilai;
			$nip_penilai = $a->nip_penilai;
			$pangkat_golongan_penilai = $a->pangkat_golongan;
			$jabatan_penilai = $a->jabatan;
			$unit_organisasi_penilai = $a->unit_organisasi;
			$nama_atasan_penilai = $a->nama_atasan;
			$nip_atasan_penilai = $a->nip_atasan;
			$pangkat_golongan_atasan_penilai = $a->pangkat_golongan_atasan;
			$jabatan_atasan_penilai = $a->jabatan_atasan;
			$unit_organisasi_atasan_penilai = $a->unit_organisasi_atasan;
		}

		echo '</table><p class="text-center"><input type="hidden" name="nip" value="'.$nip.'"><input type="hidden" name="aksi" value="oke"><input type="hidden" name="bulanpost" value="'.$bulanx.'"><input type="hidden" name="nama_penilai" value="'.$nama_penilai.'"><input type="hidden" name="nip_penilai" value="'.$nip_penilai.'"><input type="hidden" name="jabatan_penilai" value="'.$jabatan_penilai.'"><input type="submit" value="Simpan" class="btn btn-primary"></p></form>';
	}

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
				if (count($tc->result())==0)
					{
					$this->db->query("insert into `perilaku_pns` (`nip`,`tahun`,`bulan`) values ('$nip','$tahun','$bulanx')");
					}
				
			$bulane++;
		}
		while ($bulane<13);
		echo '<div class="table-responsive"><table class="table table-striped table-bordered table-hover">	
		<tr align="center"><td><strong>Penilaian</strong></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/01" title="menilai perilaku '.$namapegawai.' bulan Januari '.$tahun.'">Jan</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/02" title="menilai perilaku '.$namapegawai.' bulan Februari '.$tahun.'">Feb</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/03" title="menilai perilaku '.$namapegawai.' bulan Maret '.$tahun.'">Mar</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/04" title="menilai perilaku '.$namapegawai.' bulan April '.$tahun.'">Apr</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/05" title="menilai perilaku '.$namapegawai.' bulan Mei '.$tahun.'">Mei</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/06" title="menilai perilaku '.$namapegawai.' bulan Juni '.$tahun.'">Jun</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/07" title="menilai perilaku '.$namapegawai.' bulan Juli '.$tahun.'">Jul</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/08" title="menilai perilaku '.$namapegawai.' bulan Agustus '.$tahun.'">Agu</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/09" title="menilai perilaku '.$namapegawai.' bulan September '.$tahun.'">Sep</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/10" title="menilai perilaku '.$namapegawai.' bulan Oktober '.$tahun.'">Okt</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/11" title="menilai perilaku '.$namapegawai.' bulan November '.$tahun.'">Nov</a></td><td><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$nip.'/12" title="menilai perilaku '.$namapegawai.' bulan Desember '.$tahun.'">Des</a></td><td><strong>Rata - rata</strong></td></tr>';
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
					echo '<td align="center">'.$d->pelayanan.'</td>';
					$jpelayanan = $d->pelayanan+$jpelayanan;
					$jperbulan[$bulane] = $jperbulan[$bulane] +$d->pelayanan;
					}

			$bulane++;
		}
		while ($bulane<13);
		$rataperitem1 = $jpelayanan / 12;
		echo '<td align="center">'.round($rataperitem1,3).'</td>';
		$this->db->query("update `ppk_pns` set `pelayanan`='$jpelayanan' where tahun = '$tahun' and kode = '$nip'");
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
					echo '<td align="center">'.$d->integritas.'</td>';
					$jintegritas = $d->integritas+$jintegritas;
					$jperbulan[$bulane] = $jperbulan[$bulane] +$d->integritas;
					}

			$bulane++;
		}
		while ($bulane<13);
		$rataperitem2 = $jintegritas / 12;
		echo '<td align="center">'.round($rataperitem2,3).'</td>';
		$this->db->query("update `ppk_pns` set `integritas`='$jintegritas' where tahun = '$tahun' and kode = '$nip'");
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
					echo '<td align="center">'.$d->komitmen.'</td>';
					$jkomitmen = $d->komitmen+$jkomitmen;
					$jperbulan[$bulane] = $jperbulan[$bulane] +$d->komitmen;
					}

			$bulane++;
		}
		while ($bulane<13);
		$rataperitem3 = $jkomitmen / 12;
		echo '<td align="center">'.round($rataperitem3,2,0).'</td>';
		$this->db->query("update `ppk_pns` set `komitmen`='$jkomitmen' where tahun = '$tahun' and `kode` = '$nip'");
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
					echo '<td align="center">'.$d->disiplin.'</td>';
					$jdisiplin = $d->disiplin+$jdisiplin;
					$jperbulan[$bulane] = $jperbulan[$bulane] +$d->disiplin;
					}

			$bulane++;
		}
		while ($bulane<13);
		$rataperitem4 = $jdisiplin / 12;
		echo '<td align="center">'.round($rataperitem4,2,0).'</td>';
		$this->db->query("update `ppk_pns` set `disiplin`='$jdisiplin' where tahun = '$tahun' and `kode` = '$nip'");
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
					echo '<td align="center">'.$d->kerjasama.'</td>';
					$jkerjasama = $d->kerjasama+$jkerjasama;
					$jperbulan[$bulane] = $jperbulan[$bulane] +$d->kerjasama;
					}

			$bulane++;
		}
		while ($bulane<13);
		$rataperitem5 = $jkerjasama / 12;
		echo '<td align="center">'.round($rataperitem5,2,0).'</td>';
		$this->db->query("update `ppk_pns` set `kerjasama`='$jkerjasama' where tahun = '$tahun' and `kode` = '$nip'");
		$nomor++;
	}
		echo '</tr>';
		echo '<tr><td align="center">Jumlah</td>';
		$bulane = 1;
		do
		{
			echo '<td align="center">'.$jperbulan[$bulane].'</td>';
			$bulane++;
		}
		while ($bulane<13);
		$jumlahsetahun = $rataperitem1 + $rataperitem2 + $rataperitem3 + $rataperitem4 + $rataperitem5 + $rataperitem6;
			echo '<td align="center">'.round($jumlahsetahun,2,0).'</td>';

		echo '</tr>';
		echo '<tr><td align="center">Rata - rata</td>';
		$bulane = 1;
		do
		{
/*
			if($adatambahan == 1)
			{
				$rata_rata =  $jperbulan[$bulane] / 6;
			}
			else
			{
*/
				$rata_rata =  $jperbulan[$bulane] / 5;
//			}

			echo '<td align="center">'.round($rata_rata,2,0).'</td>';
			$bulane++;
		}
		while ($bulane<13);
/*
			if($adatambahan == 1)
			{
				$ratasetahun = $jumlahsetahun / 6;
			}
			else
			{
*/				$ratasetahun = $jumlahsetahun / 5;
//			}

			echo '<td align="center">'.round($ratasetahun,2,0).'</td>';
		echo '</tr>';
}
echo '</table></div>';
echo '<a href="'.base_url().'kepala/perilakusetahun/'.$tahun.'/'.$nip.'" class="btn btn-success">Nilai Tiap Bulan Setahun</a> <a href="'.base_url().'kepala/perilakusetahun/'.$tahun.'/'.$nip.'/sekaligus" class="btn btn-success">Nilai Setahun</a> ';
}
else
{
echo '<div class="container-fluid"><h2>Daftar Guru / Pegawai</h2>';
$ta = $this->db->query("select * from `p_pegawai` where nip !='' and `status`='Y' and `status_tempat_tugas` = '1' order by nama_tanpa_gelar");
echo '<div class="table-responsive">
<table class="table table-striped table-bordered table-hover"><tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>PKG</strong></td><td><strong>SKP</strong></td><td><strong>Perilaku</strong></td><td><strong>Unduh Excel</strong></td></tr>';
$nomor=1;

foreach($ta->result() as $a)
{
	$urutan = 1;
	$kodepegawai = $a->kodeguru; 
	$nip = $a->nip;
	$namapegawai = $a->nama;

	if(!empty($kodepegawai))
	{
		echo '<tr><td>'.$nomor.'</td><td>'.$namapegawai.'<br />'.$nip.'</td>';
		$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip'");
		$permanen = '';
		$permanenkepala = '';
		$permanen_pkg = '';
		foreach($tz->result() as $z)
			{
			$permanen = $z->permanen;
			$permanenkepala = $z->kepala;
			$permanen_pkg = $z->permanen_pkg;
			}
		if($a->guru == 'Y')
		{
			if($permanen_pkg == '1')
			{
				if($permanenkepala == '1')
				{
					echo '<td align="center"><span class="fa fa-thumbs-up"></span></td>';
				}
				else
				{
					echo '<td align="center"><a href="'.base_url().'kepala/batalpkg/'.$tahun.'/'.$a->nip.'" class="btn btn-primary" data-confirm ="Anda yakin akan membatalkan PKG '.$namapegawai.'?">BATAL PKG</a></td>';
				}
			}
			else
			{
				echo '<td align="center"><span class="fa fa-times"></td>';
			}
		}
		else
		{
			echo '<td></td>';
		}
		if($permanen == 1)
		{
			echo '<td align="center"><a href="'.base_url().'kepala/skp/'.$tahun.'/'.$a->nip.'/batalpermanenguru" class="btn btn-warning" data-confirm ="Anda yakin akan membatalkan SKP '.$namapegawai.'?">Batalkan SKP</a> <a href="'.base_url().'kepala/unduhborangskp/'.$tahun.'/'.$a->nip.'" title="unduh skp format excel '.$namapegawai.' '.$tahun.'" class="btn btn-primary">Unduh</a> ';
			if($permanen_pkg == '1')
			{ 
				echo ' <a href="'.base_url().'kepala/skp/'.$tahun.'/'.$a->nip.'" title="menilai skp '.$namapegawai.' '.$tahun.'" class="btn btn-success">Nilai</a>';
			}
			else
			{ 
				echo ' <a href="'.base_url().'kepala/skp/'.$tahun.'/'.$a->nip.'" title="menilai skp '.$namapegawai.' '.$tahun.'" class="btn btn-success disabled">Nilai</a>';
			}

			echo '</td>';
			if($permanenkepala == '1')
			{ 
				echo '<td align="center"><span class="fa fa-thumbs-up"></span></td>';
			}
			else
			{ 
				echo '<td align="center"><a href="'.base_url().'kepala/perilaku/'.$tahun.'/'.$a->nip.'" title="menilai perilaku '.$namapegawai.' '.$tahun.'" class="btn btn-success">Nilai</a></td>';
			}

			if($permanenkepala == 1)
				{
				echo '<td align="center"><a href="'.base_url().'kepala/unduhskp/'.$tahun.'/'.$a->nip.'" title="unduh skp format excel '.$namapegawai.' '.$tahun.'" class="btn btn-success">Unduh</a></td>';
				}
				else
				{
				echo '<td align="center"></td>';
				}

			}
			else
			{
			echo '<td align="center"><span class="fa fa-times"></td><td align="center"><span class="fa fa-times"></td>';
			if($permanenkepala == 1)
				{
				echo '<td align="center"><a href="'.base_url().'kepala/unduhskp/'.$tahun.'/'.$a->nip.'" title="unduh skp format excel '.$namapegawai.' '.$tahun.'" class="btn btn-success">Unduh</a></td>';
							}
				else
				{
				echo '<td align="center"></td>';
				}
			}

			echo '</tr>';
		$nomor++;
	}

}
echo '</table></div>';
}
if(!empty($nip))
{
echo '<a href="'.base_url().'kepala/perilaku" class="btn btn-primary">Kembali ke daftar guru</a> <a href="'.base_url().'kepala/skp/'.$tahun.'/'.$nip.'" class="btn btn-danger">Pengukuran SKP</a>';
}
echo '</div>';
?>
