<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: status_ketuntasan.php
// Lokasi      		: application/views/guru
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
echo '<h2>Mohon bersabar</h2>';
$desk = '';
if($id <= $total_siswa)
{
	$persen = $id/$total_siswa * 100;
	$persen = round($persen);
	echo $id.' dari '.$total_siswa.' siswa ('.$persen.'%) terproses';
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	if($kurikulum == '2013')
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
		$ti = $this->db->query("select * from afektif where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' limit $id,1");
		$afektif4 = '';
		$afektif3 = '';
		$afektif2 = '';
		$afektif1 = '';
		$item = 1;
		$nis = '';
		foreach($ti->result() as $i)
		{
			$nis = $i->nis;
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
			} // end of do
			while ($item<16);
		}
		$ketafektif ='';
		if(!empty($afektif4))
		{	
			if (empty($ketafektif))
			{
				$ketafektif .= 'Ananda selalu menunjukkan sikap '.strtolower($afektif4).'';
			}
			else
			{
				$ketafektif .= '. Ananda selalu menunjukkan sikap '.strtolower($afektif4).'';
			}
		}
		if(!empty($afektif3))
		{	
			if (empty($ketafektif))
			{
				$ketafektif .= 'Ananda sering menunjukkan sikap '.strtolower($afektif3).'';
			}
			else
			{
				$ketafektif .= '. Ananda sering menunjukkan sikap '.strtolower($afektif3).'';
			}
		}
		if(!empty($afektif2))
		{	
			if (empty($ketafektif))
			{
				$ketafektif .= 'Ananda kadang - kadang menunjukkan sikap '.strtolower($afektif2).'';
			}
			else
			{
				$ketafektif .= '. Ananda kadang - kadang menunjukkan sikap '.strtolower($afektif2).'';
			}
		}
		if(!empty($afektif1))
		{	
			if (empty($ketafektif))
			{
				$ketafektif .= 'Ananda tidak pernah menunjukkan sikap '.strtolower($afektif1).'';
			}
			else
			{
				$ketafektif .= '. Ananda tidak pernah menunjukkan sikap '.strtolower($afektif1).'';
			}
		}
		$this->db->query("update `afektif` set `deskripsi`='$ketafektif' where `mapel`='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and nis='$nis'");

	}
	$id++;
	?>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/deskripsisikap/<?php echo $id_mapel?>/<?php echo $id?>';
		},1);
			</script>
	<?php
}
else
{
	$persen = 100;
	echo $persen.'% terproses';
	?>
	<h3>tunggu sampai berpindah halaman</h3>
	<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>guru/afektif';
		},100);
			</script>
		<?php
}
?>
</div></div></div>
