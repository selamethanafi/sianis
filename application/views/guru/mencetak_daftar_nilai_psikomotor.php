<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_daftar_nilai_psikomotor.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$lebartabel="100%";
$nindikator= 0;
$kelas = id_mapel_jadi_kelas($id_mapel);
$mapel = id_mapel_jadi_mapel($id_mapel);
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
echo '<h3><p class="text-center"><a href="'.base_url().'guru/formmencetak/19">';
if(($kurikulum == '2013') or ($kurikulum=='2015'))
{
	echo 'Daftar Nilai Keterampilan';
}
elseif($kurikulum == 'KTSP')
{
	echo 'Daftar Nilai Psikomotor';
}
else
{
	echo 'Daftar Nilai Psikomotor / Keterampilan';
}
echo '</a></p></h3>

<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong>'.$thnajaran.'</strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong>'.$semester.'</strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong>'.$kelas.'</strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong>'.$mapel.'</strong></td></tr>';
if ($nomoraspek !='Semua')
	{
				$tb = $this->db->query("select * from `aspek_psikomotorik` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");
				 foreach($tb->result() as $b)
					{
					$iteme = "p".$nomoraspek;
					$aspek =$b->$iteme;
					}

	echo '<tr><td><strong>Aspek Penilaian</strong></td><td>: <strong>'.$aspek.'</strong></td></tr>';
	}
echo '</table>';
if ($nomoraspek == 'Semua')
{
echo '<div class="CSSTableGenerator"><table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr align="center"><td width="30"><strong>No.</strong></td><td ><strong>Nama</strong></td>';
// aspek psikomotor

$tap = $this->db->query("select * from aspek_psikomotorik where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
$cap=0;

foreach($tap->result() as $dap)
	{
	$cap = $dap->np;
	$batas = $cap+1;	
$iteme = 1;
	do
	{	$ite = "p$iteme";
	echo '<td>'.$dap->$ite.'</td>';
	$iteme++;
	}
	while ($iteme<$batas);
	}

?>
<td align="center">Rata Rata</td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from `nilai` where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	echo "<tr><td align='center'>".$nomor."</a></td><td>".nis_ke_nama($t->nis)."</td>";
	foreach($tap->result() as $dap)
		{
		$cap = $dap->np;
		$iteme = 1;
		$jnilai = 0;
		do
		{	$ite = "p$iteme";
			$jnilai = $jnilai + $t->$ite;
			echo '<td align="center">'.$t->$ite.'</td>';
			$iteme++;
		}
		while ($iteme<$batas);
		}
		$ratarata = $jnilai / $cap;
		$ratarata = round($ratarata,2);

	echo "<td align=\"center\">".$ratarata."</td></tr>";
	$nomor++;
	}
}
echo '</table></div>';
} // akhir kalau semua
else
{ // awal kalau tiap aspek
	$tb = $this->db->query("select * from detil_aspek_psikomotor where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek'");
	$adab = $tb->num_rows();
	$keterangan = '';
	foreach($tb->result() as $b)
		{
		$nindikator = $b->np;
		$keterangan= $b->keterangan;
		}
	$batas = $nindikator + 1;			
	// header detil
	echo '<div class="CSSTableGenerator"><table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small"><tr align="center" bgcolor="#fff"><td width="40"><strong>Nomor</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td>';
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
	echo '<td><strong>Nilai</strong></td></tr>'; // akhir header
			$nomor=1;
		$query =  $this->db->query("select * from detil_keterampilan where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek' order by no_urut");
		if(count($query->result())>0)
			{
				foreach($query->result() as $t)
				{
					if(($nomor%2)==0){
						$warna=warna1;
					} else{
						$warna=warna2;
					}
					$namasiswa = nis_ke_nama($t->nis);
					echo '<tr bgcolor="'.$warna.'"><td align="center">'.$nomor.'</td><td>'.$t->nis.'</td><td>'.$namasiswa.'</td>';
					$iteme = 1;
					do
					{
						$ite = "p$iteme";
						echo '<td align="center">'.$t->$ite.'</td>';
						$iteme++;
					}	
					while ($iteme<$batas);
					echo '<td align="center">';
					echo ''.$t->nilai.'</td></tr>';
				$nomor++;	
				}
			}

echo '</table></div>';
echo $keterangan;
}
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
</div></body></html>
