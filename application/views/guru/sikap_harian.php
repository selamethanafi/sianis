<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 10 Nov 2014 20:46:37 WIB 
// Nama Berkas 		: sikap.php
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
<div class="container-fluid"><h2>Modul Penilaian Sikap</h2>
<?php
if ((empty($id_mapel)) or (empty($nomoraspek)))
{
	echo 'Kode Mapel tidak disertakan dan atau kode aspek, klik  <a href="'.base_url().'index.php/guru/psikomotor">di sini<span class="glyphicon glyphicon-arrow-right"></span></a>';
}
else
{
	$ta = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	$ada = $ta->num_rows();
	if ($ada == 0)
	{
		echo 'Kode Mapel tidak ada atau bukan yang diampu, klik  <a href="'.base_url().'index.php/guru/psikomotor/'.$id_mapel.'">di sini<span class="glyphicon glyphicon-arrow-right"></span></a>';
	}
	else
	{
		foreach($ta->result() as $dtmapel)
		{
			$kelas = $dtmapel->kelas;
			$mapel = $dtmapel->mapel;
			$thnajaran = $dtmapel->thnajaran;
			$semester= $dtmapel->semester;
		}
$tb = $this->db->query("select * from detil_aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek'");
		$adab = $tb->num_rows();
		foreach($tb->result() as $b)
			{
			$nindikator = $b->np;
		
			}			
		if($nomoraspek>18)
			{
			echo 'Macam penilaian tidak lebih dari 18, klik  <a href="'.base_url().'index.php/guru/daftarnilaipsikomotor/'.$id_mapel.'	">di sini<span class="glyphicon glyphicon-arrow-right"></span></a>';
			
			}
		
		elseif ($adab == 0)
		{
			echo 'Kode Nomor Aspek tidak ada, klik  <a href="'.base_url().'index.php/guru/daftarnilaipsikomotor/'.$id_mapel.'	">di sini<span class="glyphicon glyphicon-arrow-right"></span></a>';
		}
		else
		{
		$iteme = "p".$nomoraspek;
		$tc = $this->db->query("select * from aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		foreach($tc->result() as $c)
			{
			$aspek = $c->$iteme;
			}
		echo '<div class="table-responsive">
<table class="table"><tr><td><strong>Tahun Pelajaran.</strong></td><td>: <strong>'.$thnajaran.'</strong></td></tr><tr ><td><strong>Semester</strong></td><td>: <strong>'.$semester.'</strong></td></tr><tr ><td><strong>Kelas</strong></td><td>: <strong>'.$kelas.'</strong></td></tr>
<tr ><td><strong>Mata Pelajaran</strong></td><td>: <strong>'.$mapel.'</strong></td></tr><tr ><td><strong>Penilaian Keterampilan</strong></td><td>: <strong>'.$aspek.'</strong></td></tr>
<tr ><td><strong>Cacah Indikator</strong></td><td>: <strong>'.$nindikator.'</strong></td></tr></table></div>';		
		// header detil
		echo 'Rentang nilai 0 s.d. 4';
		echo form_open('k2013/updatenilaisikap');
		echo '<div class="table-responsive">
<table class="table table-hover table-bordered"><tr align="center"><td><strong>Nomor</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td>';
		foreach($tb->result() as $dap)		
			{
				echo '<td><strong>'.substr($dap->p1,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p2,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p3,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p4,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p5,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p6,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p7,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p8,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p9,0,2).'</strong></td>';
				echo '<td><strong>'.substr($dap->p10,0,2).'</strong></td>';
			}
echo '<td><strong>Nilai</strong></td></tr>';
		$nomor=1;
		$query =  $this->db->query("select * from detil_sikap where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek' order by no_urut");
		if(count($query->result())>0)
			{
				foreach($query->result() as $t)
				{
					$namasiswa = nis_ke_nama($t->nis);
					echo '<tr><td align="center">'.$nomor.'</td><td>'.$t->nis.'</td><td>'.$namasiswa.'</td>';
					$iteme = 1;
					do
					{
						$ite = "p$iteme";
			
						if ($itemnilai=="$iteme")
						{
							$nilaine = $t->$ite;
							if ($nilaine == 0)
							{$nilaine = 3;}
							echo '<td align="center"><input type="text" name="p'.$iteme.'_'.$nomor.'" value ="'.$nilaine.'" size="2">';
						}
						else
						{
						echo '<td align="center"><input type="hidden" name="p'.$iteme.'_'.$nomor.'" value ="'.$t->$ite.'" >'.$t->$ite.'';
						}
						echo '<input type="hidden" name="nis_'.$nomor.'" value ="'.$t->nis.'" >';
						$iteme++;
					}	
					while ($iteme<11);
					echo '<input type="hidden" name="cacahitem"  value ='.$nindikator.'><input type="hidden" name="id_detil_sikap_'.$nomor.'"  value ='.$t->id_detil_sikap.'></td></tr>';
				$nomor++;	
				}
			}
		echo '</table></div><center>';
		$nomor--;
		if ((!empty($id_mapel)) and (!empty($semester)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
			{
				if (($itemnilai==1) or ($itemnilai==2) or ($itemnilai==3) or ($itemnilai==4) or ($itemnilai==5) or ($itemnilai==6) or ($itemnilai==7) or ($itemnilai==8) or ($itemnilai==9) or ($itemnilai==10))
				{
				echo '<input type="hidden" name="id_mapel" value="'.$id_mapel.'">
					<input type="hidden" name="cacah_siswa"  value ='.$nomor.'>
					<input type="hidden" name="thnajaran" value="'.$thnajaran.'">
					<input type="hidden" name="semester" value="'.$semester.'">
					<input type="hidden" name="mapel" value="'.$mapel.'">
					<input type="hidden" name="nomoraspek" value="'.$nomoraspek.'">
					<input type="hidden" name="itemnilai" value="'.$itemnilai.'">
					<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN</button></p>';
				}
			}
			echo '</center></form>';
		}
	}
}
?>
</div>

