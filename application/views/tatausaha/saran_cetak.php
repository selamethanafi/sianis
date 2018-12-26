<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 07 Sep 2015 22:48:23 WIB 
// Nama Berkas 		: saran.php
// Lokasi      		: application/views/tatausaha/
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>css/skbk-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>Daftar Saran / Kritik / Aduan - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<center><h1>Daftar Saran / Kritik / Pengaduan</h1></center>
<table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr bgcolor="#FFF" align="center"><td width="25%"><strong>Dari Nama</strong></td><td width="15%"><strong>Tanggal</strong></td><td width="10%"><strong>Nomor Seluler</strong></td><td><strong>Kritik / Saran / Aduan</strong></td></tr>
<?php
$query = $this->db->query("select * from `tblsaran` order by tanggal DESC");
$nomor=1;
foreach($query->result() as $b)
{
		if(($nomor%2)==0){
			$warna=warna1;
		} else{
			$warna=warna2;
		}
if(empty($page))
	{
	$page = 0;
	}
echo "<tr bgcolor='$warna'><td>".$b->nama_tamu."</td><td>".$b->tanggal."</td><td align=\"center\">".$b->nosel_tamu."</td><td>".$b->saran."</td></tr>";
$nomor++;
}
?>
</table>
<BODY>
</html>
