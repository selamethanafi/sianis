<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Kam 12 Mei 2016 00:28:27 WIB 
// Nama Berkas : nilai_afektif.php
// Lokasi      : application/views/guru
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
?><div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<a href="<?php echo base_url(); ?>guru/daftarnilaiafektif/<?php echo $id_mapel;?>"><span class="glyphicon glyphicon-arrow-left"></span><b> Kembali</b></a>
<?php
$itemnilai='';
if ((empty($id_mapel)) or (empty($nomoraspek)))
{
	echo 'Kode Mapel tidak disertakan dan atau kode aspek, klik  <a href="'.base_url().'guru/afektif">di sini<span class="glyphicon glyphicon-arrow-right"></span></a>';
}
else
{
	$ta = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	$ada = $ta->num_rows();
	if ($ada == 0)
	{
		echo 'Kode Mapel tidak ada atau bukan yang diampu, klik  <a href="'.base_url().'guru/afektif/'.$id_mapel.'">di sini<span class="glyphicon glyphicon-arrow-right"></span></a>';
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
		if($nomoraspek>15)
			{
			echo 'Macam penilaian tidak lebih dari 15, klik  <a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'	">di sini <span class="glyphicon glyphicon-arrow-right"></span></a>';
			
			}
		
		elseif ($adab == 0)
		{
			echo 'Kode Nomor Aspek tidak ada, klik  <a href="'.base_url().'guru/daftarnilaiafektif/'.$id_mapel.'	">di sini <span class="glyphicon glyphicon-arrow-right"></span></a>';
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
<tr ><td><strong>Mata Pelajaran</strong></td><td>: <strong>'.$mapel.'</strong></td></tr><tr ><td><strong>Penilaian Sikap</strong></td><td>: <strong>'.$aspek.'</strong></td></tr>
<tr ><td><strong>Cacah Indikator</strong></td><td>: <strong>'.$nindikator.'</strong></td></tr></table></div>';		
		// header detil
		echo '<div class="table-responsive">
<table class="table table-hover table-bordered"><tr align="center"><td><strong>Nomor</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td>';
		foreach($tb->result() as $dap)		
			{
			if ($nindikator>0)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/1" title="Ubah Nilai '.$dap->p1.'"><strong>'.substr($dap->p1,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p1,0,2).'</strong></td>';
				}
			if ($nindikator>1)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/2" title="Ubah Nilai '.$dap->p2.'"><strong>'.substr($dap->p2,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p2,0,2).'</strong></td>';
				}
			if ($nindikator>2)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/3" title="Ubah Nilai '.$dap->p3.'"><strong>'.substr($dap->p3,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p3,0,2).'</strong></td>';
				}
			if ($nindikator>3)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/4" title="Ubah Nilai '.$dap->p4.'"><strong>'.substr($dap->p4,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p4,0,2).'</strong></td>';
				}
			if ($nindikator>4)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/5" title="Ubah Nilai '.$dap->p5.'"><strong>'.substr($dap->p5,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p5,0,2).'</strong></td>';
				}
			if ($nindikator>5)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/6" title="Ubah Nilai '.$dap->p6.'"><strong>'.substr($dap->p6,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p6,0,2).'</strong></td>';
				}
			if ($nindikator>6)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/7" title="Ubah Nilai '.$dap->p7.'"><strong>'.substr($dap->p7,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p7,0,2).'</strong></td>';
				}
			if ($nindikator>7)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/8" title="Ubah Nilai '.$dap->p8.'"><strong>'.substr($dap->p8,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p8,0,2).'</strong></td>';
				}
			if ($nindikator>8)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/9" title="Ubah Nilai '.$dap->p9.'"><strong>'.substr($dap->p9,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p9,0,2).'</strong></td>';
				}
			if ($nindikator>9)
				{echo '<td><a href="'.base_url().'k2013/sikapharian/'.$id_mapel.'/'.$nomoraspek.'/10" title="Ubah Nilai '.$dap->p10.'"><strong>'.substr($dap->p10,0,2).'</strong></a></td>';}
				else
				{
				echo '<td><strong>'.substr($dap->p10,0,2).'</strong></td>';
				}

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
						$nilaine = $t->$ite;
						echo '<td align="center">'.$nilaine.'</td>';
						$iteme++;
					}	
					while ($iteme<11);
					echo '<td align="center">'.$t->nilai.'</td></tr>';
				$nomor++;	
				}
			}
			else
			{
			echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
			}
			echo '</table></div>';
			if ((!empty($id_mapel)) and (!empty($semester)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
			{
			echo form_open('k2013/perbaruidaftarsiswapenilaiansikap');
			echo '<input type="hidden" name="id_mapel" value="'.$id_mapel.'">
<input type="hidden" name="mapel" value="'.$mapel.'">
<input type="hidden" name="kelas" value="'.$kelas.'">
<input type="hidden" name="thnajaran" value="'.$thnajaran.'">
<input type="hidden" name="semester" value="'.$semester.'">
<input type="hidden" name="nomoraspek" value="'.$nomoraspek.'">
<p class="text-center"><button type="submit" class="btn btn-primary">Perbarui Daftar Siswa</button></p>
</form>';
			}
			

		} // akhir oke
	} //akhir kalau guru ybs
} // kalau ada id mapel dan nomor aspek
echo '</div>';
?>
