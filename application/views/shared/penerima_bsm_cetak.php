<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 16:13:10 WIB 
// Nama Berkas 		: kredit_siswa.php
// Lokasi      		: application/views/bp/
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
<br /><br /><br /><br /><br /><br />
<?php

echo '<center><a href="'.base_url().''.$tautan_balik.'/penerimabsm">DAFTAR PENERIMA BSM</a></center><br />';
if(empty($tahun1))
{
	$thnajaran = '';
}
else
{
	$tahun2 = $tahun1+1;
	$thnajaran = $tahun1.'/'.$tahun2;
}

$nomor = 1;
$np = 0;
$nl = 0;
$daftarsiswa =$this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `bsm`='1' order by `kelas` ASC, `no_urut`");
$cacah_bsm = $daftarsiswa->num_rows();
echo '<table width="100%" bgcolor="#a49c9c"><tr bgcolor="#fff" align="center"><td rowspan="2" valign="center">Nomor</td><td rowspan="2" valign="center">Nama</td><td rowspan="2" valign="center">NISN/NISM</td><td rowspan="2" valign="center">Jenis Kelamin</td><td rowspan="2" valign="center">Kelas</td><td rowspan="2" valign="center">KKS</td><td rowspan="2" valign="center">KPS</td><td rowspan="2" valign="center">KPH</td><td rowspan="2" valign="center">KIP</td><td rowspan="2" valign="center">SKTM</td><td colspan="2">Orang Tua</td><td colspan="5">Alamat</td></tr><tr bgcolor="#fff" align="center"><td>Ayah</td><td>Ibu</td><td>Alamat</td><td>Desa</td><td>Kecamatan</td><td>Kabupaten</td><td>Provinsi</td></tr>';
foreach($daftarsiswa->result() as $b)
	{
		?>
		<?php
		$nis = $b->nis;
		$kelamin = jenkel_siswa($nis,0);
		$status = $b->status;
		if($kelamin == 'P')
		{
		$np++;
		}
		elseif($kelamin == 'L')
		{
		$nl++;
		}
		else
		{
		$nx++;
		}
		$kps = '';
		$kip = '';
		$kks = '';
		$nmayah = '';
		$nmibu = '';
		$rt = '';
		$rw = '';
		$desa = '';
		$dusun = '';
		$kec = '';
		$kab = '';
		$prov = '';
		$nisn = '';
		$pkh = '';
		$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
		foreach($tb->result() as $a)
		{
			$kps = $a->kps;
			$kip = $a->kip;
			$kks = $a->kks;
			$pkh = $a->pkh;
			$nmayah = $a->nmayah;
			$nmibu = $a->nmibu;
			$rt = $a->rt;
			$rw = $a->rw;
			$desa = $a->desa;
			$kec = $a->kec;
			$kab = $a->kab;
			$prov = $a->prov;
			$nisn = $a->nisn;
			$dusun = $a->dusun;
		}
		$nise = $nisn;
		if(empty($nise))
		{
			$nise = $nis;
		}
		echo '<tr bgcolor="#fff"><td>'.$nomor.'</td><td><a href="'.base_url().''.$tautan_balik.'/datapenerimabsm/'.$nis.'" target="_blank">'.nis_ke_nama($nis).'</a></td><td>'.$nise.'</td><td>'.$kelamin.'</td><td>'.$b->kelas.'</td><td>'.$kks.'</td><td>'.$kps.'</td><td>'.$pkh.'</td><td>'.$kip.'</td>';
		$kode_alasan_bsm = $b->alasan_bsm;
		$alasan_bsm = '';
		if($b->alasan_bsm == 2)
		{
			$alasan_bsm = 'SKTM';
		}
		$alamate = '';
		if(!empty($dusun))
		{
			if(empty($alamate))
			{
				$alamate .= ucwords(strtolower($dusun));
			}
			else
			{
				$alamate .= ' '.ucwords(strtolower($dusun));
			}
		}
		if(!empty($rt))
		{
			if(empty($alamate))
			{
				$alamate .= 'RT '.$rt;
			}
			else
			{
				$alamate .= ' RT '.$rt;
			}
		}
		if(!empty($rw))
		{
			if(empty($alamate))
			{
				$alamate .= 'RW '.$rw;
			}
			else
			{
				$alamate .= ' RW '.$rw;
			}
		}
		echo '<td>'.$alasan_bsm.'</td><td>'.ucwords(strtolower($nmayah)).'</td><td>'.ucwords(strtolower($nmibu)).'</td><td>'.$alamate.'</td><td>'.ucwords(strtolower($desa)).'</td><td>'.ucwords(strtolower($kec)).'</td><td>'.ucwords(strtolower($kab)).'</td><td>'.ucwords(strtolower($prov)).'</td></tr>';
		$nomor++;
	}
	echo '</table>';
?>

</div></div></div>
