<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 13 Mei 2016 14:13:59 WIB 
// Nama Berkas 		: salin_deskripsi.php
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
<?php
$adatujuan = 0;
$id_aspek_psikomotor = '';
$kelas = '';
$mapel='';
$mapelkelas = '';
$jenis_deskripsine = '';
$jenis_deskripsi = '';
if(!empty($sukses))
{?>
    <div class="alert alert-success">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Sukses!</strong> data berhasil di simpan
     </div>
<?php
}
?>
<?php
$bisa = 0;
$xloc = base_url().'guru/salindeskripsiketerampilan';
?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
echo form_open($xloc,'class="form-horizontal" role="form"');?>
<div class="form-group row row">
	<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9">
		<select name="thnajaran" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
		foreach($daftar_tapel->result() as $k)
		{
			$thn1 = substr($k->thnajaran,0,4);
			echo '<option value="'.$xloc.'/'.$thn1.'">'.$k->thnajaran.'</option>';
		}
		?>
		</select>
        </div>
</div>
<div class="form-group row row">	
	<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
	<div class="col-sm-9">
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo "<option value='".$semester."'>".$semester."</option>";
		$thn1 = substr($thnajaran,0,4);
		echo '<option value="'.$xloc.'/'.$thn1.'/1">1</option>';
		echo '<option value="'.$xloc.'/'.$thn1.'/2">2</option>';
		echo '</select>';
		?>
	</div>
</div>
        <?php
	$ta = $this->db->query("select * from m_mapel where id_mapel = '$id_mapel'");
	foreach($ta->result() as $a)
		{
			$kelas= $a->kelas;
			$mapel = $a->mapel;
			$mapelkelas = $mapel.' '.$kelas;
		}
	$taa = $this->db->query("select * from m_mapel where id_mapel = '$id_mapeld'");
	$kelastujuan= '';
	$mapeltujuan = '';
	$mapelkelastujuan = '';
	foreach($taa->result() as $aa)
		{
			$kelastujuan= $aa->kelas;
			$mapeltujuan = $aa->mapel;
			$mapelkelastujuan = $mapeltujuan.' '.$kelastujuan;
		}

	$tb = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");
	?>
<div class="form-group row row">
	<div class="col-sm-3"><label for="matapelajaran" class="control-label">Mata Pelajaran</label></div>
	<div class="col-sm-9">
		<select name="id_mapel" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'">'.$mapelkelas.'</option>';
		foreach($tb->result() as $b)
		{
			echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
		}
		echo '</select>';
		?>
        </div>
</div>
<?php
if((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
{
	$tap = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
	$ada = $tap->num_rows();
	if($ada == 0)
	{
		echo '<div class="alert alert-warning">Tidak ada data KD ranah keterampilan</div>';
	}
	else
	{
		?>
		<div class="form-group row row">
			<div class="col-sm-12"><label class="control-label">Disalin ke</label></div>
		</div>
		<div class="form-group row row">
			<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="thnajaran2" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
				<?php
				echo "<option value='".$thnajaran2."'>".$thnajaran2."</option>";
				foreach($daftar_tapel->result() as $k)
				{
					$thntujuan = substr($k->thnajaran,0,4);
					echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'/'.$thntujuan.'">'.$k->thnajaran.'</option>';
				}
				?>
				</select>
	        	</div>
		</div>
		<div class="form-group row row">	
			<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
			<div class="col-sm-9">
				<select name="semestertujuan" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
				<?php
					$thntujuan = substr($thnajaran2,0,4);
				echo "<option value='".$semestertujuan."'>".$semestertujuan."</option>";
				echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'/'.$thntujuan.'/1">1</option>';
				echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'/'.$thntujuan.'/2">2</option>';
				echo '</select>';
				?>
			</div>
		</div>
		<div class="form-group row row">
			<div class="col-sm-3"><label for="matapelajaran" class="control-label">Mata Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="id_mapel" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
				<?php
				$tbb = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and `thnajaran`='$thnajaran2' and semester='$semestertujuan' order by mapel,kelas");

				echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'/'.$id_mapel.'/'.$thntujuan.'/'.$semestertujuan.'/'.$id_mapeld.'">'.$mapelkelastujuan.'</option>';
				foreach($tbb->result() as $bb)
				{
					if($bb->id_mapel != $id_mapel)
					{
						echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'/'.$thntujuan.'/'.$semestertujuan.'/'.$bb->id_mapel.'">'.$bb->mapel.' '.$bb->kelas.'</option>';
					}
				}
				echo '</select>';
				?>
		        </div>
		</div>
		<div class="col-sm-6"><p><?php echo $mapelkelas.' '.$thnajaran.' semester '.$semester;?></p>
			<?php
			$kd = '';
			foreach($tap->result() as $dap)
			{
				for($i=1;$i<19;$i++)
				{
					$item = 'p'.$i;
					$kd .= $i.' '.$dap->$item.'<br />';
					echo '<input type="hidden" name="p'.$i.'" value="'.$dap->$item.'">';
				}
			}
			echo $kd;
			?>
		</div>

		<div class="col-sm-6"><p><?php echo $mapelkelastujuan.' '.$thnajaran2.' semester '.$semestertujuan;?></p>
			<?php
	$tapx = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran2' and semester='$semestertujuan' and kelas='$kelastujuan' and mapel='$mapeltujuan'");
	$ada = $tapx->num_rows();
	if((!empty($thnajaran2)) and (!empty($semestertujuan)) and (!empty($kelastujuan)) and (!empty($mapeltujuan)))
	{
		$adatujuan = 1;
		if($ada == 0)
		{
			echo 'Galat, belum ada pembagian tugas';
		}
	}
	$tapx = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran2' and semester='$semestertujuan' and kelas='$kelastujuan' and mapel='$mapeltujuan'");
		$kd = '';
			foreach($tapx->result() as $dapx)
			{
				$id_mapel_tujuan = $dapx->id_mapel;
				for($i=1;$i<19;$i++)
				{
					$item = 'p'.$i;
					$kd .= $i.' '.$dapx->$item.'<br />';
				}
			}
			echo $kd;
			?>
		</div>
	<?php
	}
}
echo '</form>';
	if($adatujuan == 1)
	{
		echo form_open('guru/updateaspekpsikomotor/'.$id_mapel_tujuan);
			foreach($tap->result() as $dap)
			{
				for($i=1;$i<19;$i++)
				{
					$item = 'p'.$i;
					$kd .= $i.' '.$dap->$item.'<br />';
					echo '<input type="hidden" name="p'.$i.'" value="'.$dap->$item.'">';
				}
			}

?>
		<input type="hidden" name="id_mapel" value="<?php echo $id_mapeld;?>">
	<?php
		echo '<input type="hidden" name="thnajaran" value="'.$thnajaran2.'"><input type="hidden" name="semester" value="'.$semestertujuan.'"><input type="hidden" name="mapel" value="'.$mapeltujuan.'">';
		?>
		<input type="hidden" name="id_aspek_psikomotor" value="<?php echo $id_aspek_psikomotor;?>">
				<p class="text-center"><button type="submit" class="btn btn-primary">SALIN DESKRIPSI</button> <a class="btn btn-info" href="'.base_url().'guru/salindeskripsiketerampilan"><b>Batal</b></a></p></form>
	<?php
	}?>

</div></div></div>
