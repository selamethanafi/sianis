<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 10 Jun 2015 12:16:38 WIB 
// Nama Berkas 		: deskripsi_sikap_spiritual_sosial_antarmapel.php
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
<?php
$lebartabel= '100%';
$kelas = id_mapel_jadi_kelas($id_mapel);
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
$daftarsiswa = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' and `kelas`='$kelas' order by `no_urut`");
echo '<h3><p class="text-center"><a href="'.base_url().'guru/formmencetak">Deskripsi Sikap Spiritual dan Sosial AntarMata Pelajaran</a></p></h3>';
echo '<table width="100%">
<tr><td>Tahun Pelajaran</td><td>:</td><td>'.$thnajaran.'</td></tr>
<tr><td>Semester</td><td>:</td><td>'.$semester.'</td></tr>
<tr><td>Kelas</td><td>:</td><td>'.$kelas.'</td></tr></table>';
$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by id_sikap_spiritual");
$itemke = 1;
foreach($tb->result() as $b)
	{
	$des[$itemke] = $b->item;
	$itemke++;
	}
$adatb = $tb->num_rows();
if(($adatb == 0) and (!empty($thnajaran)))
{
	echo 'Tabel item penilaian sikap spiritual kosong';
}
else
{
//jmlguru

$tma = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='T' and `kelas`='$kelas' order by `kodeguru`,kelas");
$rekapkodeguru = '';
foreach($tma->result_array() as $dma)
	{
	if(empty($rekapkodeguru))
		{
		$rekapkodeguru .= $dma['kodeguru'];
		}
		else
		{
		$rekapkodeguru .= ', '.$dma['kodeguru'];
		}

	}
if(!empty($rekapkodeguru))
{
	echo 'Daftar Guru Belum mengirim penilaian sikap spiritual dan sosial antarmapel';
	echo $rekapkodeguru.'';
}
$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ASC");
echo '<table width="'.$lebartabel.'" class="table table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td width="50"><strong>NIS</strong></td><td ><strong>Nama</strong></td><td><strong>Deskripsi</strong></td></tr>';
$nomor = 1;
foreach($tdata_siswa->result() as $e)
{
	$nis = $e->nis;
	$namasiswa = nis_ke_nama($nis);
	$ta = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	foreach($ta->result() as $a)
	{
	echo "<tr><td>".$nomor."</td><td>".$nis."</td><td width=\"50\">".$namasiswa."</td><td>".$a->kom1."</td></tr>";
	}
	$nomor++;

}
echo '</table>';
}
?>
</div>
