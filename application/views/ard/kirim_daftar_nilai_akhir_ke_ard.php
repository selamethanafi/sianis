<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:23:28 WIB 
// Nama Berkas 		: daftarnilai.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<div class="container-fluid">
<?php
if($pilihan == 1)
{
	$query = $this->db->query("select * from `nilai_pilihan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut`");
}
else
{
	$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut`");
}
$cacahsiswa = $query->num_rows();
$cacahsiswa = $cacahsiswa - 1;
	$next = $nomor+1;
	$prev = $nomor - 1;
if($nomor == 0)
{
	//selanjutnya

	echo '<p class="text-center"><a href="'.base_url().'guruard/kirimnilaiakhir/'.$id_mapel.'/'.$next.'" class="btn btn-primary">Selanjutnya</a></p>';
}
elseif(($nomor < $cacahsiswa) and ($nomor > 0))
{
	
	echo '<p class="text-center"><a href="'.base_url().'guruard/kirimnilaiakhir/'.$id_mapel.'/'.$prev.'" class="btn btn-primary">Sebelumnya</a> <a href="'.base_url().'guruard/kirimnilaiakhir/'.$id_mapel.'/'.$next.'" class="btn btn-info">Selanjutnya</a></p>';
}
elseif($nomor == $cacahsiswa)
{
	
	echo '<p class="text-center"><a href="'.base_url().'guruard/kirimnilaiakhir/'.$id_mapel.'/'.$prev.'" class="btn btn-primary">Sebelumnya</a></p>';
}
else
{
}
?>

<iframe src="<?php echo base_url().'guruard/fkirimnilaiakhir/'.$id_mapel.'/'.$nomor;?>" width="100%" height="600"></iframe>
</div>
</div></div></div>
