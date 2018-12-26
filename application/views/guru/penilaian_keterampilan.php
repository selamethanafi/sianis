<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : nilai_psikomotor.php
// Lokasi      : application/views/guru
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<p><a href="<?php echo base_url(); ?>guru/daftarnilaipsikomotor/<?php echo $id_mapel;?>" class="btn btn-info"><b> Kembali</b></a></p>
<?php
$itemnilai='';
if ((empty($id_mapel)) or (empty($nomoraspek)))
{
	echo 'Kode Mapel tidak disertakan dan atau kode aspek, klik  <a href="'.base_url().'guru/psikomotor">di sini</a>';
}
else
{
	$ta = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	$ada = $ta->num_rows();
	if ($ada == 0)
	{
		echo 'Kode Mapel tidak ada atau bukan yang diampu, klik  <a href="'.base_url().'guru/psikomotor/'.$id_mapel.'">di sini</a>';
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
$tb = $this->db->query("select * from detil_aspek_psikomotor where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek'");
		$adab = $tb->num_rows();
		foreach($tb->result() as $b)
			{
			$nindikator = $b->np;
		
			}			
		if($nomoraspek>18)
			{
			echo 'Macam penilaian tidak lebih dari 18, klik  <a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'	">di sini</a>';
			
			}
		
		elseif ($adab == 0)
		{
			echo 'Kode Nomor Aspek tidak ada, klik  <a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'	">di sini</a>';
		}
		else
		{
		$iteme = "p".$nomoraspek;
		$tc = $this->db->query("select * from aspek_psikomotorik where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		foreach($tc->result() as $c)
			{
			$aspek = $c->$iteme;
			}
		
		echo '<form class="form-horizontal" role="form"><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">'.$thnajaran.'</p></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">'.$semester.'</p></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static">'.$kelas.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">'.$mapel.'</p></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penilaian Keterampilan</label></div><div class="col-sm-9"><p class="form-control-static">'.$aspek.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah Indikator</label></div><div class="col-sm-9"><p class="form-control-static">'.$nindikator.'</p></div></div></form>';		
		echo '<p class="text-info">Klik nama siswa untuk menilai</p>';
		// header detil
		echo '<table class="table table-striped table-bordered table-hover"><tr align="center"><td><strong>Nomor</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td>';
		foreach($tb->result() as $dap)		
			{
				echo '<td><strong>'.$dap->p1.'</strong></td>';
				echo '<td><strong>'.$dap->p2.'</strong></td>';
				echo '<td><strong>'.$dap->p3.'</strong></td>';
				echo '<td><strong>'.$dap->p4.'</strong></td>';
				echo '<td><strong>'.$dap->p5.'</strong></td>';
				echo '<td><strong>'.$dap->p6.'</strong></td>';
				echo '<td><strong>'.$dap->p7.'</strong></td>';
				echo '<td><strong>'.$dap->p8.'</strong></td>';
				echo '<td><strong>'.$dap->p9.'</strong></td>';
				echo '<td><strong>'.$dap->p10.'</strong></td>';
			}
echo '<td><strong>Nilai</strong></td></tr>';
		$nomor=1;
		$query =  $this->db->query("select * from detil_keterampilan where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek' order by no_urut");
		if(count($query->result())>0)
			{
				foreach($query->result() as $t)
				{
					$namasiswa = nis_ke_nama($t->nis);
					echo '<tr><td align="center">'.$nomor.'</td><td>'.$t->nis.'</td><td><a href="'.base_url().'k2013/penilaianketerampilan/'.$id_mapel.'/'.$nomoraspek.'/'.$t->id_detil_keterampilan.'">'.$namasiswa.'</a></td>';
					$iteme = 1;
					do
					{
						$ite = "p$iteme";
						echo '<td align="center">'.$t->$ite.'</td>';
						$iteme++;
					}	
					while ($iteme<11);
					echo '<td align="center">';
					echo '<input type="hidden" name="cacahitem"  value ='.$nindikator.'><input type="hidden" name="id_detil_keterampilan_'.$nomor.'"  value ='.$t->id_detil_keterampilan.'><input type="hidden" name="cacah_siswa"  value ='.$nomor.'>'.$t->nilai.'</td></tr>';
				$nomor++;	
				}
			}
			else
			{
			echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
			}
			echo '</table>';
			if ((!empty($id_mapel)) and (!empty($semester)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
			{
			echo form_open('k2013/perbaruidaftarsiswapenilaianketerampilan');
			echo '<p class="text-center"><input type="hidden" name="id_mapel" value="'.$id_mapel.'">
<input type="hidden" name="mapel" value="'.$mapel.'">
<input type="hidden" name="kelas" value="'.$kelas.'">
<input type="hidden" name="thnajaran" value="'.$thnajaran.'">
<input type="hidden" name="semester" value="'.$semester.'">
<input type="hidden" name="nomoraspek" value="'.$nomoraspek.'">
<input type="submit" value="Perbarui Daftar Siswa" class="btn btn-primary"></p>
</form>';
			}
		} // akhir oke
	} //akhir kalau guru ybs
} // kalau ada id mapel dan nomor aspek
?>
</div></div></div>
