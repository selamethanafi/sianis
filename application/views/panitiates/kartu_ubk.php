<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 01 Jun 2017 07:32:26 WIB 
// Nama Berkas 		: kartu_ubk.php
// Lokasi      		: application/views/panitiates/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tdx = $this->db->query("select * from `nama_tes` where `id_nama_tes`='$id_tes'");
$nama_tes = '';
foreach($tdx->result() as $dx)
{
	$nama_tes = $dx->nama_tes;
}
$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
$kelasxx = '??';
foreach($tdx->result() as $dx)
{
	$kelasxx = $dx->kelas;
}
$this->db->query("delete from `kartu_ubk`");
$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasxx'");
?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<title><?php echo $nama_tes;?></title>
	<link rel="icon" type="image/png" href="<?php echo base_url();?>images/depag.png">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/kartu_ubk.css">
</head>
<body>

<?php
$kolom = 0;
$baris =1;
foreach($tb->result() as $b)
{
	$kolom++;
	$nis = $b->nis;
	if($kolom == 1)
	{
		$this->db->query("insert into `kartu_ubk` (`baris`,`nis1`) values ('$baris','$nis')");
	}
	if($kolom == 2)
	{
		$this->db->query("update `kartu_ubk` set `nis2` = '$nis' where `baris`='$baris'");
		$baris++;
		$kolom = 0;
	}
}
$kolom = 1;
$baris = 1;
$ta = $this->db->query("select * from `kartu_ubk`");
foreach($ta->result() as $a)
{
	$nis1 = $a->nis1;
	$nis2 = $a->nis2;
	$nama1 = '';
	$password1 = '';
	$nama2 = '';
	$password2 = '';

	$tc = $this->db->query("select `nis`,`nama`,`password_tes` from `datsis` where `nis`='$nis1'");
	foreach($tc->result() as $c)
	{
		$nama1 = $c->nama;
		$password1 = $c->password_tes;
	}
	$tc = $this->db->query("select `nis`,`nama`,`password_tes` from `datsis` where `nis`='$nis2'");
	foreach($tc->result() as $c)
	{
		$nama2 = $c->nama;
		$password2 = $c->password_tes;
	}

	if($baris == 1)
	{
		echo '<div class="page"><center>';
		echo '<table align="center"><tbody>';
	}
	echo '<tr>';
	echo '<td style="padding:8px;">';
	echo '<table style="width:9cm;border:1px solid black;" class="kartu">
					<tbody><tr>
						<td colspan="3" style="border-bottom:1px solid black">
							<table class="kartu" width="100%">
							<tbody><tr>
								<td><img src="'.base_url().'images/depag.png" height="40"></td>
								<td style="font-weight:bold" align="center">
									KARTU PESERTA <br>UJIAN BERBASIS KOMPUTER<br> 
									'.$nama_tes.'
								</td>
							</tr>
							</tbody></table>
						</td>
					</tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td width="115">Nama Peserta</td><td width="1">:</td><td>'.$nama1.'</td></tr>
					<tr><td>Kelas</td><td>:</td><td>'.$kelasxx.'</td></tr>
					<tr><td>Username</td><td>:</td><td style="font-size:14px;font-weight:bold;">'.$nis1.'</td></tr>
					<tr><td>Password</td><td>:</td><td style="font-size:14px;font-weight:bold;">'.$password1.'</td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
				</tbody></table>';
	echo '</td>';
echo '<td style="padding:8px;">';
	echo '<table style="width:9cm;border:1px solid black;" class="kartu">
					<tbody><tr>
						<td colspan="3" style="border-bottom:1px solid black">
							<table class="kartu" width="100%">
							<tbody><tr>
								<td><img src="'.base_url().'images/depag.png" height="40"></td>
								<td style="font-weight:bold" align="center">
									KARTU PESERTA<br>UJIAN BERBASIS KOMPUTER<br> 
									'.$nama_tes.'
								</td>
							</tr>
							</tbody></table>
						</td>
					</tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td width="115">Nama Peserta</td><td width="1">:</td><td>'.$nama2.'</td></tr>
					<tr><td>Kelas</td><td>:</td><td>'.$kelasxx.'</td></tr>
					<tr><td>Username</td><td>:</td><td style="font-size:14px;font-weight:bold;">'.$nis2.'</td></tr>
					<tr><td>Password</td><td>:</td><td style="font-size:14px;font-weight:bold;">'.$password2.'</td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
					<tr><td> </td><td></td><td style="font-size:14px;font-weight:bold;"></td></tr>
				</tbody></table>';
	echo '</td></tr>';
	$baris++;
	if($baris > 5)
	{
		?>
		<tr>
		</tr>
		</tbody>
		</table></center>
		<?php
		echo '</div>';
		$baris = 1;
	}


}
?>
<style>
	.kartu td {
	font-size:11px;
	}
	.kartu tr td:first-child {
		padding-left:10px;
	}
</style>
</body></html>
