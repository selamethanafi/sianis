<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: daftar_nilai_afektif.php
// Terakhir diperbarui	: Rab 11 Mei 2016 23:26:40 WIB 
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
?><div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php 
$adaterkunci = 0;
?>
<p><a href="<?php echo base_url(); ?>guru/afektif" class="btn btn-info"><span class="fa fa-arrow-left"></span> <b>Kelas Lain</b></a></p>
<?php
$tap = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
$cacahitem = 0;
$dapnbaik = 3;
$dapnmax = 5;
$dapnamat = 4;
$dapp1 = '';
$dapp2 = '';
$dapp3 = '';
$dapp4 = '';
$dapp5 = '';
$dapp6 = '';
$dapp7 = '';
$dapp8 = '';
$dapp9 = '';
$dapp10 = '';
$dapp11 = '';
$dapp12 = '';
$dapp13 = '';
$dapp14 = '';
$dapp15 = '';
foreach($tap->result() as $dap)
{
	$cacahitem = $dap->ns;
	$dapp1 = $dap->s1;
	$dapp2 = $dap->s2;
	$dapp3 = $dap->s3;
	$dapp4 = $dap->s4;
	$dapp5 = $dap->s5;
	$dapp6 = $dap->s6;
	$dapp7 = $dap->s7;
	$dapp8 = $dap->s8;
	$dapp9 = $dap->s9;
	$dapp10 = $dap->s10;
	$dapp11 = $dap->s11;
	$dapp12 = $dap->s12;
	$dapp13 = $dap->s13;
	$dapp14 = $dap->s14;
	$dapp15 = $dap->s15;
}
?>
<div class="table-responsive">
<table class="table">
<tr><td><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td>Semester</td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td>Kelas</td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td>Mata Pelajaran</td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td>Cacah Item Penilaian</td><td>: <strong><?php echo $cacahitem;?></strong></td></tr>
<tr><td>Jumlah Nilai Tertinggi</td><td>: <strong><?php echo $dapnmax;?></strong></td></tr>
<tr><td>Predikat Amat Baik</td><td>: <strong>lebih atau sama <?php echo $dapnamat;?></strong></td></tr>
<tr><td>Predikat Baik</td><td>: <strong>lebih atau sama <?php echo $dapnbaik;?></strong></td></tr>
<tr><td>Predikat Cukup</td><td>: <strong>kurang dari <?php echo $dapnbaik;?></strong></td></tr>
<tr><td>Kurikulum</td><td>: <strong><?php echo $kurikulum;?></strong></td></tr>
</table></div>
<p class="text-danger">Untuk menilai, silakan klik tautan indikator penilaian atau nama siswa</p><?php
if($kurikulum == '2013')
{
	?>
		<p class="text-center"><a href="<?php echo base_url();?>guru/deskripsisikap/<?php echo $id_mapel;?>" class="btn btn-primary">PROSES DESKRIPSI</a></p>
		<?php
}

if($cacahitem == 0)
{
	echo '<div class="alert alert-warning">Belum ada indikator penilaian, tambah indikator penilaian <a href="'.base_url().'guru/aspekafektif/'.$id_mapel.'" class="btn btn-primary">di sini</a></div>';
}
else
{
	?>
	<div class="table-responsive">
	<table class="table table-hover table-bordered"><thead>
	<tr align="center"><td>No.</td><td>Nama</td>
	<?php
	if(!empty($dapp1))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/1" title="'.$dapp1.'"><strong>'.substr($dapp1,0,2).'</strong></a></td>';
	}
	if(!empty($dapp2))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/2" title="'.$dapp2.'"><strong>'.substr($dapp2,0,2).'</strong></a></td>';
	}
	if(!empty($dapp3))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/3" title="'.$dapp3.'"><strong>'.substr($dapp3,0,2).'</strong></a></td>';
	}
	if(!empty($dapp4))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/4" title="'.$dapp4.'"><strong>'.substr($dapp4,0,2).'</strong></a></td>';
	}
	if(!empty($dapp5))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/5" title="'.$dapp5.'"><strong>'.substr($dapp5,0,2).'</strong></a></td>';
	}
	if(!empty($dapp6))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/6" title="'.$dapp6.'"><strong>'.substr($dapp6,0,2).'</strong></a></td>';
	}
	if(!empty($dapp7))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/7" title="'.$dapp7.'"><strong>'.substr($dapp7,0,2).'</strong></a></td>';
	}
	if(!empty($dapp8))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/8" title="'.$dapp8.'"><strong>'.substr($dapp8,0,2).'</strong></a></td>';
	}
	if(!empty($dapp9))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/9" title="'.$dapp9.'"><strong>'.substr($dapp9,0,2).'</strong></a></td>';
	}
	if(!empty($dapp10))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/10" title="'.$dapp10.'"><strong>'.substr($dapp10,0,2).'</strong></a></td>';
	}
	if(!empty($dapp11))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/11" title="'.$dapp11.'"><strong>'.substr($dapp11,0,2).'</strong></a></td>';
	}
	if(!empty($dapp12))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/12" title="'.$dapp12.'"><strong>'.substr($dapp12,0,2).'</strong></a></td>';
	}
	if(!empty($dapp13))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/13" title="'.$dapp13.'"><strong>'.substr($dapp13,0,2).'</strong></a></td>';
	}
	if(!empty($dapp14))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/14" title="'.$dapp14.'"><strong>'.substr($dapp14,0,2).'</strong></a></td>';
	}
	if(!empty($dapp15))
	{
		echo '<td><a href="'.base_url().'guru/nilaiafektif/'.$id_mapel.'/15" title="'.$dapp15.'"><strong>'.substr($dapp15,0,2).'</strong></a></td>';
	}
	echo '<td>Nilai</td><td>Predikat</td><td>Tuntas</td></tr></thead>';
	$nomor=1;
	if($pilihan == 1)
	{
		$query=$this->db->query("select * from `nilai_pilihan` where `kelas`='$kelas' and `mapel` = '$mapel' and `semester` = '$semester' and `thnajaran` = '$thnajaran'");
	}
	else
	{
		$query=$this->db->query("select * from `nilai` where `kelas`='$kelas' and `mapel` = '$mapel' and `semester` = '$semester' and `thnajaran` = '$thnajaran'");
	}

	if(count($query->result())>0)
	{
		foreach($query->result() as $t)
		{
			$nis = $t->nis;
			$namasiswa = nis_ke_nama($nis);
			$ratarata = 0;
			$predikat = '?';
			//cari yang SB
			$item = 0;
			$sangatbaik = 0;
			$baik = 0;
			$kurang = 0;
			do
			{
				$item++;
				$item2 = "s".$item;
				$titem2 = $t->$item2;
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
			while($item<$cacahitem);
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
			if($kurikulum == 'KTSP')
			{
				if($predikat == 'SB')
				{
				$predikat = 'A';
				}
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
			if($cacahitem>0)// and ($statuscetak == 'proses'))
			{
				if($pilihan == 1)
				{
					$this->db->query("update `nilai_pilihan` set `afektif`='$predikat' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel' and `kunci` = '0'");
				}
				else
				{
					$this->db->query("update `nilai` set `afektif`='$predikat' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel' and `kunci` = '0'");
				}

			}
			$terkunci = 0;
			$terkunci = $t->kunci;
			if($terkunci == 1)
			{
				$adaterkunci = 1;
			}
			if($terkunci == 1)
			{
				echo "<tr><td align='center'>".$nomor."</td><td>".$namasiswa."</td>";
			}
			else
			{
				echo "<tr><td align='center'>".$nomor."</td><td><a href='".base_url()."guru/daftarnilaiafektif/".$id_mapel."/persiswa/".$t->id_afektif."'>".$namasiswa."</a></td>";
			}
			if(!empty($dapp1))
			{
				echo '<td align="center">'.$t->s1.'</td>';
			}
			if(!empty($dapp2))
			{
				echo '<td align="center">'.$t->s2.'</td>';
			}
			if(!empty($dapp3))
			{
				echo '<td align="center">'.$t->s3.'</td>';
			}
			if(!empty($dapp4))
			{
				echo '<td align="center">'.$t->s4.'</td>';
			}
			if(!empty($dapp5))
			{
				echo '<td align="center">'.$t->s5.'</td>';
			}
			if(!empty($dapp6))
			{
				echo '<td align="center">'.$t->s6.'</td>';
			}
			if(!empty($dapp7))
			{
				echo '<td align="center">'.$t->s7.'</td>';
			}
			if(!empty($dapp8))
			{
				echo '<td align="center">'.$t->s8.'</td>';
			}
			if(!empty($dapp9))
			{
				echo '<td align="center">'.$t->s9.'</td>';
			}
			if(!empty($dapp10))
			{
				echo '<td align="center">'.$t->s10.'</td>';
			}
			if(!empty($dapp11))
			{
				echo '<td align="center">'.$t->s11.'</td>';
			}
			if(!empty($dapp12))
			{
				echo '<td align="center">'.$t->s12.'</td>';
			}
			if(!empty($dapp13))
			{
				echo '<td align="center">'.$t->s13.'</td>';
			}
			if(!empty($dapp14))
			{
				echo '<td align="center">'.$t->s14.'</td>';
			}
			if(!empty($dapp15))
			{
				echo '<td align="center">'.$t->s15.'</td>';
			}
			if($terkunci == 1)
			{
				echo '<td align="center">'.$ratarata.'</td><td align="center">'.$predikat.'</td><td align="center">'.$tuntas.' <span class="fa fa-lock"></td></tr>';
			}
			else
			{
				echo "<td align='center'>".$ratarata."</td><td align='center'>".$predikat."</td><td align='center'>".$tuntas." </td></tr>";
			}

			$nomor++;	
		}
		if($adaterkunci == 0)
		{
			echo '<tr><td align="center"></td><td>Indikator Penilaian Sikap </td>';
			$iteme = 1;
			do
			{
				$ite = "p$iteme";
				if (!empty($dap->$ite))
				{
					echo '<td align="center"><a href="'.base_url().'k2013/aspekpenilaiansikap/'.$id_mapel.'/'.$iteme.'" title="Indikator Penilaian '.$dap->$ite.'"><span class="fa fa-edit"></span></a></td>';
				}
				$iteme++;
			}
			while ($iteme<15);
			echo '<tr><td align="center"></td><td>Detil Penilaian</td>';
			$iteme = 1;
			do
			{
				$ite = "p$iteme";
				if (!empty($dap->$ite))
				{
					echo '<td align="center"><a href="'.base_url().'k2013/penilaiansikap/'.$id_mapel.'/'.$iteme.'" title="Penilaian '.$dap->$ite.' rinci"><span class="fa fa-bullseye"></span></a></td>';
				}
				$iteme++;
			}
			while ($iteme<15);
		}
	}
	else
	{
		echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
	}
	?>
	</table></div><?php
	if ((!empty($id_mapel)) and ($adaterkunci == 0)) 
	{
		echo '<p class="text-center"><a href="'.base_url().'guru/perbaruidaftarsiswaafektif/'.$id_mapel.'" class="btn btn-primary">Perbarui Daftar Siswa (Semua nilai menjadi Baik)</a></p> ';
	}
}
?>
</div></div></div>
