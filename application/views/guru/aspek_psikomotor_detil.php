<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: aspek_psikomotor_detil.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">


<?php
if ((empty($id_mapel)) or (empty($nomoraspek)))
	{
	echo '<div class="alert alert-warning">Kode Mapel dan atau kode aspek tidak disertakan, klik  <a href="'.base_url().'guru/psikomotor">di sini</a></div>';
	}
	else
	{
	$ta = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	$ada = $ta->num_rows();
	if($ada == 0)
		{
		echo '<div class="alert alert-warning">Kode Mapel tidak ada atau bukan yang diampu, klik  <a href="'.base_url().'guru/psikomotor">di sini</a></div>';
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
			$tapa = $this->db->query("select * from aspek_psikomotorik where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
			$aspekpenilaian = '';
			if($nomoraspek<19)
				{
				$itemex = "p".$nomoraspek;
				foreach($tapa->result() as $dapa)
					{
					$aspekpenilaian = $dapa->$itemex;
					}
				}

?>
<?php echo form_open('k2013/updateaspekpsikomotor','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $mapel;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penilaian </label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $aspekpenilaian;?></div></div>
<?php
$tap = $this->db->query("select * from detil_aspek_psikomotor where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nomoraspek`='$nomoraspek'");
$ada = $tap->num_rows();
if($ada == 0)
	{
	$this->db->query("insert into detil_aspek_psikomotor (`thnajaran`,`semester`,`kelas`,`mapel`,`nomoraspek`) values ('$thnajaran','$semester','$kelas','$mapel','$nomoraspek')");
	}
$tap = $this->db->query("select * from detil_aspek_psikomotor where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and nomoraspek='$nomoraspek'");
$nomor = 0;
$keterangan ='';
foreach($tap->result() as $dap)
{
	do
	{
	$item = $nomor+1;
	$iteme2 = "p".$item;
	$siteme2 = "s".$item;
	echo '
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Indikator Penilaian Keterampilan dan skor tertinggi '.$item.'</label></div><div class="col-sm-7"><input name="p'.$item.'" value ="'.$dap->$iteme2.'" class="form-control"></div><div class="col-sm-2"><select name="s'.$item.'" class="form-control">';
	$s = $dap->$siteme2;
	echo '<option value="'.$s.'">'.$s.'</option>';

	$i = 0;
	do
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
		$i++;
	}
	while($i<=10);
	echo '<select></div></div>';
	$nomor++;
	}
	while ($nomor<10);
	$keterangan = $dap->keterangan;
}
echo '<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Keterangan Penilaian</label></div></div><div class="form-group row row"><div class="col-sm-12"><textarea name="keterangan" rows="15" class="form-control">'.$keterangan.'</textarea></div></div>';	
echo '<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"><input type="hidden" name="id_mapel" value="'.$id_mapel.'"><input type="hidden" name="nomoraspek" value="'.$nomoraspek.'"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><input type="hidden" name="semester" value="'.$semester.'"><input type="hidden" name="mapel" value="'.$mapel.'"><input type="hidden" name="id_aspek_psikomotor" value="'.$dap->id_detil_aspek_psikomotor.'"><input type="hidden" name="kelas" value="'.$kelas.'"></p>';
?>

</form>
<?php
}//akhir berhak
}
?>

</div></div></div>
