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
		echo 'Galat, guru / pegawai dengan NIP '.$nip.', tidak ditemukan.';
	}
	else
	{
		foreach($ta->result() as $da)
		{
			$namapegawai = $da->nama;
			$kodeguru = $da->kd;
		}
		$adatambahan = 0;
		$tambahan = '';
		$tsk = $this->db->query("SELECT * FROM `p_tugas_tambahan` where `thnajaran` like '%$tahun%' and `kodeguru`='$kodeguru' and `semester`='1'");
		foreach($tsk->result() as $dsk)
		{
			$tambahan = $dsk->nama_tugas;
		}
		if ((substr($tambahan,0,10)=='Kepala Mad') or (substr($tambahan,0,10)=='Kepala Sek'))
		{
			$adatambahan = 1;
		}
		echo 'Tugas tambahan '.$tambahan;
		if ($adatambahan ==0)
		{
			$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahun' and dinilai='guru'");
		}
		else
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
		$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip'");
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
		$tc = $this->db->query("select * from `perilaku_pns` where `tahun`='$tahun' and `bulan`='12' and `nip`='$nip'");
		foreach($tc->result() as $c)
		{
			$pelayanan = $c->pelayanan;
			$integritas = $c->integritas;
			$komitmen = $c->komitmen;
			$disiplin = $c->disiplin;
			$kerjasama = $c->kerjasama;
		}

		echo form_open('kepala/simpanperilaku/'.$tahun.'/'.$nip.'/sekaligus');
		echo '<div class="table-responsive"><table class="table table-striped table-bordered table-hover">	
		<tr align="center"><td><strong>Penilaian</strong></td><td width="150">Nilai</td></tr>';
		$nomor=1;
		foreach($tc->result() as $c)
		{
			echo '<tr><td>1. Orientasi Pelayanan</td>';
			echo '<td align="center"><input type="number" min="76" max="100" name="pelayanan" value="'.$pelayanan.'" class="form-control"></td>';
			echo '<tr><td>2. Integritas</td>';
			echo '<td align="center"><input type="number" min="76" max="100" name="integritas" value="'.$integritas.'" class="form-control"></td>';
			echo '<tr><td>3. Komitmen</td>';
			echo '<td align="center"><input type="number" min="76" max="100" name="komitmen" value="'.$komitmen.'" class="form-control"></td>';
			echo '<tr><td>4. Disiplin</td>';
			echo '<td align="center"><input type="number" min="76" max="100" name="disiplin" value="'.$disiplin.'" class="form-control"></td>';
			echo '<tr><td>5. Kerja sama</td>';
			echo '<td align="center"><input type="number" min="76" max="100" name="kerjasama" value="'.$kerjasama.'" class="form-control"></td>';
			echo '</tr></table><p>Penilai : '.$nama_penilai.'</p><p>NIP Penilai : '.$nip_penilai.'</p><p>Jabatan Penilai : '.$jabatan_penilai.'</p><input type="hidden" name="nama_penilai" value="'.$nama_penilai.'"><input type="hidden" name="nip_penilai" value="'.$nip_penilai.'"><input type="hidden" name="jabatan_penilai" value="'.$jabatan_penilai.'">
			<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p></form>';
		}
	}
}
else
{
	echo 'Tidak ada data pegawai';
}
echo '</div>';
