<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: deskripsi_afektif.php
// Lokasi      		: application/views/deskripsi/
// Terakhir diperbarui	: Min 06 Jan 2019 20:27:14 WIB 
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$sukses = 'galat';
$kelas = '';
$mapel = '';
foreach($tmapel->result() as $a)
{
	$mapel = $a->mapel;
	$kelas = $a->kelas;
	$id_mapel = $a->id_mapel;	
	$jenis_deskripsi = $a->jenis_deskripsi;
	$kkm = $a->kkm;
	$ranah = $a->ranah;
}
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
if(($kurikulum == '2013') or ($kurikulum == 'KTSP'))
{
$th = $this->db->query("select * from `aspek_afektif` where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester'");
foreach($th->result() as $h)
{
	$afe[1]=$h->p1;
	$afe[2]=$h->p2;
	$afe[3]=$h->p3;
	$afe[4]=$h->p4;
	$afe[5]=$h->p5;
	$afe[6]=$h->p6;
	$afe[7]=$h->p7;
	$afe[8]=$h->p8;
	$afe[9]=$h->p9;
	$afe[10]=$h->p10;
	$afe[11]=$h->p11;
	$afe[12]=$h->p12;
	$afe[13]=$h->p13;
	$afe[14]=$h->p14;
	$afe[15]=$h->p15;
}
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y'");
if((count($query->result())>0) and ($kurikulum == '2013'))
{
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		//sikap
		$ti = $this->db->query("select * from afektif where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
		$afektif4 = '';
		$afektif3 = '';
		$afektif2 = '';
		$afektif1 = '';
		$item = 1;
		foreach($ti->result() as $i)
		{
			do
			{
				$aspek = "p$item";
				if (!empty($afe[$item]))
				{			
					if($i->$aspek>=4)
					{
						if (empty($afektif4))
						{
							$afektif4 .= $afe[$item];
						}
						else
						{
							$afektif4 .= ", ".$afe[$item];
						}
					}
					elseif($i->$aspek>=3)
					{
						if (empty($afektif3))
						{
							$afektif3 .= $afe[$item];
						}
						else
						{
							$afektif3 .= ", ".$afe[$item];
						}
					}
					elseif($i->$aspek>=2)
					{
						if (empty($afektif2))
						{
							$afektif2 .= $afe[$item];
						}
						else
						{
							$afektif2 .= ", ".$afe[$item];
						}
					}
					else 
					{
						if (empty($afektif1))
						{
							$afektif1 .= $afe[$item];
						}
						else
						{
							$afektif1 .= ", ".$afe[$item];
						}
					}

				}
				$item++;
			}
			while ($item<16);
		}
		$ketafektif ='';
		if(!empty($afektif4))
		{	
			if (empty($ketafektif))
			{
				$ketafektif .= 'Siswa selalu menunjukkan sikap '.strtolower($afektif4).'';
			}
			else
			{
				$ketafektif .= '. Siswa selalu menunjukkan sikap '.strtolower($afektif4).'';
			}
		}
		if(!empty($afektif3))
		{	
			if (empty($ketafektif))
			{
				$ketafektif .= 'Siswa sering menunjukkan sikap '.strtolower($afektif3).'';
			}
			else
			{
				$ketafektif .= '. Siswa sering menunjukkan sikap '.strtolower($afektif3).'';
			}
		}
		if(!empty($afektif2))
		{	
			if (empty($ketafektif))
			{
				$ketafektif .= 'Siswa kadang - kadang menunjukkan sikap '.strtolower($afektif2).'';
			}
			else
			{
				$ketafektif .= '. Siswa kadang - kadang menunjukkan sikap '.strtolower($afektif2).'';
			}
		}
		if(!empty($afektif1))
		{	
			if (empty($ketafektif))
			{
				$ketafektif .= 'Siswa tidak pernah menunjukkan sikap '.strtolower($afektif1).'';
			}
			else
			{
				$ketafektif .= '. Siswa tidak pernah menunjukkan sikap '.strtolower($afektif1).'';
			}
		}
		$this->db->query("update `afektif` set `deskripsi`='$ketafektif' where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");
	}
	$sukses = 'sukses';
}
}
if($sumber == 'mapel')
{
?>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>deskripsi/<?php echo $sukses;?>/mapel'; // the redirect goes here

},100);
			</script>
<?php

}
else
{
echo '<img src="'.base_url().'images/loading.gif"><br />';
	echo 'Halaman ini akan berpindah otomatis, bila dalam 5 detik tidak berpindah klik <a href="'.base_url().'deskripsi/praproses/sikap/'.$nomor.'">di sini</a>'; // manual redirect
	?>
	<script>setTimeout(function () {
	  window.location.href= '<?php echo base_url();?>deskripsi/praproses/sikap/<?php echo $nomor;?>'; // the redirect goes here
},5000);
	</script>
	<?php

}
