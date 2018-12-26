<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: nilai_uambn.php
// Lokasi      		: application/views/pengajaran/
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
<div class="container-fluid">
<?php echo form_open('pengajaran/nilaiuambn','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
if (!empty($thnajaran))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9" ><p class="form-control-static">'.$thnajaran.'<input name="thnajaran" type="hidden" value="'.$thnajaran.'"></p></div></div>';
	}

if (empty($thnajaran))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9" >
	<select name="thnajaran" class="form-control"><option value="'.$thnajaran.'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/nilaiuambn" class="btn btn-info"><b>Batal</b></a></p>';
}
else
{
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Tampil Nilai" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/nilaiuambn" class="btn btn-info"><b>Batal</b></a></p>';
}

?>
</div></div>
</form>

<?php
if((!empty($thnajaran)) and (!empty($semester)))
{
$te = $this->db->query("select * from `m_ruang` where `tingkat`='XII' order by ruang");
foreach($te->result() as $e)
{
	$kelas = $e->ruang;
	//cari ada siswa nggak
	$tg = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas`='$kelas' and `status`='Y'");
	$adatg = $tg->num_rows();
	if($adatg>0)
	{
		?>
		<div class="panel panel-default">
		<div class="panel-heading"><h4><?php echo $e->ruang;?></h4></div>
		<div class="panel-body">
		<?php
		$program = $e->program;
		$tf = $this->db->query("select * from `mapel_uambn` where `thnajaran`='$thnajaran' and `program`='$program' order by no_urut");
		$adamapel = $tf->num_rows();
		if($adamapel > 1)
		{
			$lebarkolom = 60 / $adamapel; 
		}
		else
		{
			$lebarkolom = 60;
		}
		echo '<table class="table table-hover table-striped table-bordered"><tr align="center"><td width="5%">Nomor</td><td width="10%">NIS</td><td width="25%">Nama</td>';
		foreach($tf->result() as $f)
		{
			echo '<td width="'.$lebarkolom.'%">'.$f->mapel.'</td>';
	
		}
		echo '</tr>';
		$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `kelas` = '$kelas' and `semester`='2' and `status`='Y' order by no_urut");
		$nomor =1;
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			$namasiswa = nis_ke_nama($nis);
			echo '<tr><td align="center">'.$nomor.'<td align="center">'.$nis.'</td><td>'.$namasiswa.'</td>';
			foreach($tf->result() as $f)
			{
				$mapel = $f->mapel;
				$tb = $this->db->query("select * from `nilai_ujian` where nis='$nis' and mapel ='$mapel'");
				if($tb->num_rows() >0)
				{
					foreach($tb->result() as $b)
					{
						$nilai = $b->nilai;
						echo '<td align="center">'.$nilai.'</td>';
					}
				}
				else
				{
					echo '<td align="center"></td>';
				}
		
			}
			echo '</tr>';
			$nomor++;
		}
		echo '</table>
	
		</div>
		</div>';
	}
}
}
?>

</div>
</div>
