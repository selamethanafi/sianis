<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 18 Nov 2014 07:34:01 WIB 
// Nama Berkas 		: mencetak_daftar_nilai_afektif.php
// Lokasi      		: application/views/guru/
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
$lebartabel='95%';
$nindikator= 0;
$kelas = id_mapel_jadi_kelas($id_mapel);
$mapel = id_mapel_jadi_mapel($id_mapel);
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
echo '<h3><p class="text-center"><a href="'.base_url().'guru/formmencetak/16">';
if($kurikulum == 'KTSP')
	{echo 'Daftar Nilai Afektif';}
elseif($kurikulum == '2015')

	{echo 'AFEKTIF TIDAK DI SINI';}

elseif($kurikulum == '2013')

	{echo 'Daftar Nilai Sikap Spiritual dan Sosial Dalam Mata Pelajaran';}
else
	{echo 'Daftar Nilai Afektif / Sikap Spiritual dan Sosial Dalam Mata Pelajaran';}
echo '</a></p></h3>
<table width="'.$lebartabel.'">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong>'.$thnajaran.'</strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong>'.$semester.'</strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong>'.$kelas.'</strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong>'.$mapel.'</strong></td></tr>';
if ($nomoraspek !='Semua')
	{
		$aspek = '';
		if (($nomoraspek<11) or ($nomoraspek>0))
			{
				$tb = $this->db->query("select * from `aspek_afektif` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");

				 foreach($tb->result() as $b)
					{
					$iteme = "p".$nomoraspek;
					$aspek =$b->$iteme;
					}
			}

	echo '<tr><td><strong>Aspek Penilaian</strong></td><td>: <strong>'.$aspek.'</strong></td></tr>';
	}
$tb = $this->db->query("select * from detil_aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek'");
$teknik = '';
foreach($tb->result() as $b)
	{
	$teknik = $b->teknik;
	}
if(!empty($teknik))
	{
	echo '<tr><td><strong>Teknik Penilaian</strong></td><td>: <strong>'.$teknik.'</strong></td></tr>';
	}
echo '</table>';
if ($nomoraspek == 'Semua')
{
echo '<div class="CSSTableGenerator"><table width="'.$lebartabel.'">
<tr align="center"><td width="30"><strong>No.</strong></td><td ><strong>Nama</strong></td>';

// aspek psikomotor
$tap = $this->db->query("select * from aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
$cap=0;
$batas = 0;
foreach($tap->result() as $dap)
	{
	$cap = $dap->np;
	$batas = $cap+1;
	$namat = $dap->namat;	
	$nbaik = $dap->nbaik;	
	$nmax = $dap->nmax;	
$iteme = 1;
	do
	{	$ite = "p$iteme";
	echo '<td>'.$dap->$ite.'</td>';
	$iteme++;
	}
	while ($iteme<$batas);
	}

?>
<td align="center">Nilai</td><td align="center">Predikat</td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `status`='Y' order by no_urut");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	$nis = $t->nis;
	$namasiswa = nis_ke_nama($nis);
	echo "<tr><td align='center'>".$nomor."</td><td>".nis_ke_nama($t->nis)."</td>";
	$tc = $this->db->query("select * from `afektif` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis`='$nis'");
	foreach($tc->result() as $c)
	{
		foreach($tap->result() as $dap)
		{
			$cap = $dap->np;
			$iteme = 1;
			$jnilai = 0;
			do
			{	$ite = "p$iteme";
				$jnilai = $jnilai + $c->$ite;
				echo '<td align="center">'.$c->$ite.'</td>';
				$iteme++;
			}
			while ($iteme<$batas);
		}
		$kurikulum = '2013';
		if ($kurikulum == '2013')
		{
		//cari yang SB
		$item = 0;
		$sangatbaik = 0;
		$baik = 0;
		$kurang = 0;
			do
			{
				$item++;
				$item2 = "p".$item;
				$titem2 = $c->$item2;
				if($titem2 >= 4)
					{
					$sangatbaik++;
					} 
				elseif($titem2 >= 3)
					{
					$baik++;
					}
				else 
					{
					$kurang++;
					} 
 			}
			while($item<$batas);
			$rataratax = max($sangatbaik,$baik,$kurang);
			if($rataratax == $sangatbaik)
				{
				$predikat = 'SB';
				$ratarata = '4';
				}
			elseif($rataratax == $baik)
				{
				$predikat = 'B';
				$ratarata = '3';
				}
			else
				{
				$predikat = 'K';
				$ratarata = '2';
				}


		}
		else
		{
			$ratarata = ($c->p1 + $c->p2 + $c->p3 + $c->p4 + $c->p5 + $c->p6 + $c->p7 + $c->p8 + $c->p9 + $c->p10 + $c->p11 + $c->p12 + $c->p13 + $c->p14 + $c->p15 ) / $cap;
		

		if ($ratarata < $nmax )
			{$predikat = 'A';}
			if ($ratarata < $namat )
			{$predikat = 'B';}
			if ($ratarata < $nbaik )
			{$predikat = 'C';}
		}
	if (($predikat=='A') or ($predikat=='B') or ($predikat=='SB'))
		{
			$tuntas = 'Ya';
		}
		else
		{
			$tuntas = 'Belum';
		}

	$ratarata = round($ratarata,2);
	echo "<td align=\"center\">".$ratarata."</td><td align=\"center\">".$predikat."</td></tr>";
	$nomor++;
	}
	}
}
echo '</table></div>Predikat <strong>A</strong> senilai dengan <strong>SB</strong>';
} // akhir kalau semua / rekap
else
{
	$tb = $this->db->query("select * from detil_aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek'");
	$adab = $tb->num_rows();
	$keterangan = '';
	foreach($tb->result() as $b)
		{
		$nindikator = $b->np;
		$keterangan = $b->keterangan;
		}			
	$batas = $nindikator + 1;
		// header detil
	echo '<div class="CSSTableGenerator"><table><tr align="center" bgcolor="#fff"><td><strong>Nomor</strong></td><td><strong>Nama</strong></td>';
	foreach($tb->result() as $dap)		
		{
	$urut = 1;
	do
		{
		$iteme = "p".$urut;
			$aspeke = $b->$iteme;
			echo '<td><strong>'.$aspeke.'</strong></td>';
			$urut++;
			}
		while ($urut<$batas);

		}
echo '<td><strong>Nilai</strong></td></tr>';
		$nomor=1;
		$query =  $this->db->query("select * from detil_sikap where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek' order by no_urut");
		if(count($query->result())>0)
			{
				foreach($query->result() as $t)
				{
					$namasiswa = nis_ke_nama($t->nis);
					echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td>';
					$iteme = 1;
					do
					{
						$ite = "p$iteme";
						$nilaine = $t->$ite;
						echo '<td align="center">'.$nilaine.'</td>';
						$iteme++;
					}	
					while ($iteme<$batas);
					echo '<td align="center">'.$t->nilai.'</td></tr>';
				$nomor++;	
				}
			}
	echo '</table></div>';
	echo $keterangan;
	echo 'Predikat <strong>A</strong> senilai dengan <strong>SB</strong>';
} //akhir detil
//if ($nomoraspek == 'Semua')
//	{

//	}

$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
if ($ditandatangani=='ya')
{
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
?>

