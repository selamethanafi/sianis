<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>Rekapitulasi Ketidakhadiran Siswa Per Bulan- <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<div class="landscape">
<?php
$tanggalcetak = '';
echo '<table width="90%">
<tr><td width="100"><img src ="'.base_url().'images/depag.png" width="75" alt="logo kementerian / pemerintah"></td><td align="center">'.$this->config->item('baris1').'<br>'.$this->config->item('baris2').'<br>'.$this->config->item('baris3').'<br>'.$this->config->item('baris4').'</TD><TR>
</table>';

?>
<a href="<?php echo base_url().'bp/rekapbulanan/'.$tahun1.'/'.$semester;?>"><h4 class="text-center">Rekapitulasi Ketidakhadiran Siswa Per Bulan</h4></a>
<?php
$ta = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_wali'");
$kelas = '';
foreach($ta->result() as $a)
{
	$kelas = $a->kelas;
}
echo '<p>Kelas '.$kelas.'</p>';
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut` ASC");
if(($bulan == '07') or ($bulan == '08') or ($bulan == '10') or ($bulan == '12') or ($bulan == '01') or ($bulan == '03') or ($bulan == '05'))
{
	echo '<table class="table table-striped table-bordered"><tr><td align="center" rowspan="2">Nomor</td><td align="center" rowspan="2">Nama</td><td align="center" colspan="31">Tanggal</td><td align="center" colspan="6" >Jumlah</td></tr>';
	for($i=1;$i<=31;$i++)
	{
		echo '<td align="center">'.$i.'</td>';
	}
}
elseif(($bulan == '04') or ($bulan == '06') or ($bulan == '09') or ($bulan == '11'))
{
	echo '<table class="table table-striped table-bordered"><tr><td align="center" rowspan="2">Nomor</td><td align="center" rowspan="2">Nama</td><td align="center" colspan="30">Tanggal</td><td align="center" colspan="6" >Jumlah</td></tr>';
	for($i=1;$i<=30;$i++)
	{
		echo '<td align="center">'.$i.'</td>';
	}
}
else
{
	echo '<table class="table table-striped table-bordered"><tr><td align="center" rowspan="2">Nomor</td><td align="center" rowspan="2">Nama</td><td align="center" colspan="29">Tanggal</td><td align="center" colspan="6" >Jumlah</td></tr>';
	for($i=1;$i<=29;$i++)
	{
		echo '<td align="center">'.$i.'</td>';
	}
}
echo '<td align="center">S</td>';
echo '<td align="center">I</td>';
echo '<td align="center">A</td>';
echo '<td align="center">T</td>';
echo '<td align="center">B</td>';
echo '<td align="center">M</td>';
echo '<tr>';
$nomor = 1;
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$js = 0;
	$ji = 0;
	$ja = 0;
	$jm = 0;
	$jb = 0;
	$jt = 0;
	if(($bulan == '07') or ($bulan == '08') or ($bulan == '10') or ($bulan == '12') or ($bulan == '01') or ($bulan == '03') or ($bulan == '05'))
	{
		echo '<tr><td align="center">'.$nomor.'</td><td>'.nis_ke_nama($nis).'</td>';
		for($i=1;$i<=31;$i++)
		{
			if($i<10)
			{
				$tgl = '0'.$i;
			}
			else
			{
				$tgl = $i;
			}
			if(($bulan == '07') or ($bulan == '08') or ($bulan == '10') or ($bulan == '12'))
			{
				$tanggal = $tahun1.'-'.$bulan.'-'.$tgl;
				$tanggalcetak = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.angka_jadi_bulan($bulan).' '.$tahun1;
			}
			else
			{
				$tanggal = $tahun2.'-'.$bulan.'-'.$tgl;
				$tanggalcetak = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.angka_jadi_bulan($bulan).' '.$tahun2;
			}
			$tb = $this->db->query("select * from `siswa_absensi` where `tanggal`='$tanggal' and `nis`='$nis'");
			if($tb->num_rows()>0)
			{
				$alasan = '';
				foreach($tb->result() as $b)
				{
					if($b->alasan == 'S')
					{
						$js++;
				
					}
					elseif($b->alasan == 'I')
					{
						$ji++;
					}
					elseif($b->alasan == 'A')
					{
						$ja++;
					}
					elseif($b->alasan == 'M')
					{
						$jm++;
					}
					elseif($b->alasan == 'B')
					{
						$jb++;
					}
					elseif($b->alasan == 'T')
					{
						$jt++;
					}
					else
					{

					}
					if(empty($alasan))
					{
						$alasan .= $b->alasan;
					}
					else
					{
						$alasan .= ' '.$b->alasan;
					}
				}
				echo '<td align="center">'.$alasan.'</td>';
			}
			else
			{
				echo '<td align="center"></td>';
			}

		}
	}
	elseif(($bulan == '04') or ($bulan == '06') or ($bulan == '09') or ($bulan == '11'))
	{
		echo '<tr><td align="center">'.$nomor.'</td><td>'.nis_ke_nama($nis).'</td>';
		for($i=1;$i<=30;$i++)
		{
			if($i<10)
			{
				$tgl = '0'.$i;
			}
			else
			{
				$tgl = $i;
			}
			if(($bulan == '09') or ($bulan == '11'))
			{
				$tanggal = $tahun1.'-'.$bulan.'-'.$tgl;
				$tanggalcetak = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.angka_jadi_bulan($bulan).' '.$tahun1;
			}
			else
			{
				$tanggal = $tahun2.'-'.$bulan.'-'.$tgl;
				$tanggalcetak = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.angka_jadi_bulan($bulan).' '.$tahun2;
			}
			$tb = $this->db->query("select * from `siswa_absensi` where `tanggal`='$tanggal' and `nis`='$nis'");
			if($tb->num_rows()>0)
			{
				$alasan = '';
				foreach($tb->result() as $b)
				{
					if($b->alasan == 'S')
					{
						$js++;
				
					}
					elseif($b->alasan == 'I')
					{
						$ji++;
					}
					elseif($b->alasan == 'A')
					{
						$ja++;
					}
					elseif($b->alasan == 'M')
					{
						$jm++;
					}
					elseif($b->alasan == 'B')
					{
						$jb++;
					}
					elseif($b->alasan == 'T')
					{
						$jt++;
					}
					else
					{

					}
					if(empty($alasan))
					{
						$alasan .= $b->alasan;
					}
					else
					{
						$alasan .= ' '.$b->alasan;
					}
				}
				echo '<td align="center">'.$alasan.'</td>';
			}
			else
			{
				echo '<td align="center"></td>';
			}


		}
	}
	else
	{
		echo '<tr><td align="center">'.$nomor.'</td><td>'.nis_ke_nama($nis).'</td>';
		for($i=1;$i<=29;$i++)
		{
			if($i<10)
			{
				$tgl = '0'.$i;
			}
			else
			{
				$tgl = $i;
			}
			$tanggal = $tahun2.'-'.$bulan.'-'.$tgl;
			$tanggalcetak = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.angka_jadi_bulan($bulan).' '.$tahun2;
			$tb = $this->db->query("select * from `siswa_absensi` where `tanggal`='$tanggal' and `nis`='$nis'");
			if($tb->num_rows()>0)
			{
				$alasan = '';
				foreach($tb->result() as $b)
				{
					if($b->alasan == 'S')
					{
						$js++;
				
					}
					elseif($b->alasan == 'I')
					{
						$ji++;
					}
					elseif($b->alasan == 'A')
					{
						$ja++;
					}
					elseif($b->alasan == 'M')
					{
						$jm++;
					}
					elseif($b->alasan == 'B')
					{
						$jb++;
					}
					elseif($b->alasan == 'T')
					{
						$jt++;
					}
					else
					{

					}
					if(empty($alasan))
					{
						$alasan .= $b->alasan;
					}
					else
					{
						$alasan .= ' '.$b->alasan;
					}
				}
				echo '<td align="center">'.$alasan.'</td>';
			}
			else
			{
				echo '<td align="center"></td>';
			}


		}
	}
	echo '<td align="center">'.$js.'</td>';
	echo '<td align="center">'.$ji.'</td>';
	echo '<td align="center">'.$ja.'</td>';
	echo '<td align="center">'.$jt.'</td>';
	echo '<td align="center">'.$jb.'</td>';
	echo '<td align="center">'.$jm.'</td>';
	echo '<tr>';
	$nomor++;
}
echo '</table>';
echo '<p>S = Sakit, I = Izin, A = Tanpa keterangan, T = Terlambat, B = Membolos, M = Izin meninggalkan '.$this->config->item('sek_tipe').'</p>';

		$namakepala = '';
		$nipkepala = '';
		$namakepala = cari_kepala($thnajaran,$semester);
		$nipkepala = cari_nip_kepala($thnajaran,$semester);
		$tahun = date("Y");
		$bulan = date("m");
		$tanggal = date("d");
echo '</table><br>
<table>
<tr><td valign="top" width="100"></td><td valign="top" >Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td><td valign="top" width="100"></td>
<td valign="top" >'.$this->config->item('lokasi').', '.$tanggalcetak.'<br>Staf BK<br><br><br><br>______________________<br>NIP </TD><TR>
</table><br><br>';
?>

</div>
