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
$xloc = base_url().'guru/salindeskripsi';
echo form_open($xloc,'class="form-horizontal" role="form"');?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
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
	$tdx = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	$kelasxx = '??';
	$mapelxx = '??';
	$jenis_deskripsi = '';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
		$mapelxx = $dx->mapel;
		$jenis_deskripsi = $dx->jenis_deskripsi;
		$materi1 = $dx->materi1;
		$materi2 = $dx->materi2;
		$materi3 = $dx->materi3;
		$materi4 = $dx->materi4;
		$materi5 = $dx->materi5;
		$materi6 = $dx->materi6;
		$materi7 = $dx->materi7;
		$materi8 = $dx->materi8;
		$materi9 = $dx->materi9;
		$materi10 = $dx->materi10;
		$keterampilan1 = $dx->keterampilan1;
		$keterampilan2 = $dx->keterampilan2;
	}
	//cari deskripsi

	if($jenis_deskripsi== 1)
	{
			$jenis_deskripsine = 'Berdasar Ulangan (Deskripsi Otomatis)';
			$bisa = 1;
	}
	if($jenis_deskripsi== 2)
	{
			$jenis_deskripsine = 'Berdasar Nilai Akhir (Deskripsi Otomatis)';
			$bisa = 1;
	}
	if($jenis_deskripsi== 5)
	{
			$jenis_deskripsine = 'Berdasar NS (Deskripsi Otomatis)';
			$bisa = 1;
	}
	if($jenis_deskripsi== 6)
	{
			$jenis_deskripsine = $this->config->item('versi_deskripsi');
			$bisa = 1;
	}

	if($jenis_deskripsi== 3)
	{
			$jenis_deskripsine = 'Berdasar Kriteria lalu dipilih (Deskripsi Otomatis)';
			$bisa = 1;
	}
	if($bisa == 1)
	{
	?>
<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Jenis Deskripsi</label></div>
	<div class="col-sm-9"><p class="form-control-static"><?php echo $jenis_deskripsine;?></p></div>
</div>

	<?php
	}
	if($jenis_deskripsi== 1)
	{
		?>
		<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Materi / KD (1)</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $materi1;?></p></div>
		</div>
		<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Materi / KD (2)</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $materi2;?></p></div>
		</div>
		<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Materi / KD (3)</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $materi3;?></p></div>
		</div>
		<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Materi / KD (4)</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $materi4;?></p></div>
		</div>
		<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Materi / KD (5)</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $materi5;?></p></div>
		</div>
		<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Materi / KD (6)</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $materi6;?></p></div>
		</div>
		<?php
	}
	if($jenis_deskripsi== 2) 
		{
			$jenis_deskripsine = 'Berdasar Nilai Akhir (Deskripsi Otomatis)';
			$bisa = 1;
			$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
			if($kurikulum == '2013')
			{

			?>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai >= 3.67</div>
					<div class="col-sm-6"><?php echo $materi1;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 3.34 s.d. 3.66</div>
					<div class="col-sm-6"><?php echo $materi2;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 3.01 s.d. 3.33</div>
					<div class="col-sm-6"><?php echo $materi3;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 2.67 s.d. 3.00</div>
					<div class="col-sm-6"><?php echo $materi4;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 2.34 s.d. 2.66</div>
					<div class="col-sm-6"><?php echo $materi5;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai kurang dari 2.34</div>
					<div class="col-sm-6"><?php echo $materi6;?></div>
			</div>
			<?php
			}
			else
			{
			?>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai >= 90</div>
					<div class="col-sm-6"><?php echo $materi1;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 85 s.d. 90</div>
					<div class="col-sm-6"><?php echo $materi2;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 80 s.d. 84</div>
					<div class="col-sm-6"><?php echo $materi3;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 70 s.d. 79</div>
					<div class="col-sm-6"><?php echo $materi4;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 60 s.d. 69</div>
					<div class="col-sm-6"><?php echo $materi5;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai kurang dari 60</div>
					<div class="col-sm-6"><?php echo $materi6;?></div>
			</div>
			<?php
			}

		}
	if($jenis_deskripsi== 3)
		{
		$jenis_deskripsine = 'Berdasar Kriteria lalu dipilih (Deskripsi Otomatis)';
		$bisa = 1;
			?>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Materi / KD (1)</div>
					<div class="col-sm-6"><?php echo $materi1;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Materi / KD (2)</div>
					<div class="col-sm-6"><?php echo $materi2;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Materi / KD (3)</div>
					<div class="col-sm-6"><?php echo $materi3;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Materi / KD (4)</div>
					<div class="col-sm-6"><?php echo $materi4;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Materi / KD (5)</div>
					<div class="col-sm-6"><?php echo $materi5;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Materi / KD (6)</div>
					<div class="col-sm-6"><?php echo $materi6;?></div>
			</div>
		<?php
		}

	if($jenis_deskripsi== 5) 
		{
			$jenis_deskripsine = 'Berdasar NS (Deskripsi Otomatis)';
			$bisa = 1;
			$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
			if($kurikulum == '2013')
			{

			?>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai >= 3.67</div>
					<div class="col-sm-6"><?php echo $materi1;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 3.34 s.d. 3.66</div>
					<div class="col-sm-6"><?php echo $materi2;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 3.01 s.d. 3.33</div>
					<div class="col-sm-6"><?php echo $materi3;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 2.67 s.d. 3.00</div>
					<div class="col-sm-6"><?php echo $materi4;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 2.34 s.d. 2.66</div>
					<div class="col-sm-6"><?php echo $materi5;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai kurang dari 2.34</div>
					<div class="col-sm-6"><?php echo $materi6;?></div>
			</div>
			<?php
			}
			else
			{
			?>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai >= 90</div>
					<div class="col-sm-6"><?php echo $materi1;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 85 s.d. 90</div>
					<div class="col-sm-6"><?php echo $materi2;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 80 s.d. 84</div>
					<div class="col-sm-6"><?php echo $materi3;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 70 s.d. 79</div>
					<div class="col-sm-6"><?php echo $materi4;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai 60 s.d. 69</div>
					<div class="col-sm-6"><?php echo $materi5;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">Nilai kurang dari 60</div>
					<div class="col-sm-6"><?php echo $materi6;?></div>
			</div>
			<?php
			}

		}
	if($jenis_deskripsi== 4)
		{
			$jenis_deskripsine = 'Berdasar bank deskripsi';
			$bisa = 1;
			?>
			<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Jenis Deskripsi</label></div>
			<div class="col-sm-9"><p class="form-control-static"><?php echo $jenis_deskripsine;?></p></div>
			</div>
		<?php
		}
	if($jenis_deskripsi== 6)
		{
		$jenis_deskripsine = $this->config->item('versi_deskripsi');
		$bisa = 1;
			?>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3"> KD 1</div>
					<div class="col-sm-6"><?php echo $materi1;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 2</div>
					<div class="col-sm-6"><?php echo $materi2;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 3</div>
					<div class="col-sm-6"><?php echo $materi3;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 4</div>
					<div class="col-sm-6"><?php echo $materi4;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 5</div>
					<div class="col-sm-6"><?php echo $materi5;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 6</div>
					<div class="col-sm-6"><?php echo $materi6;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 7</div>
					<div class="col-sm-6"><?php echo $materi7;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 8</div>
					<div class="col-sm-6"><?php echo $materi8;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 9</div>
					<div class="col-sm-6"><?php echo $materi9;?></div>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
					<div class="col-sm-3">KD 10</div>
					<div class="col-sm-6"><?php echo $materi10;?></div>
			</div>

		<?php
		}

	if(($bisa == 0) and (!empty($id_mapel)))
	{
		echo '<div class="col-sm-3"></div>
			<div class="col-sm-9">
				<div class="alert alert-warning">Jenis deskripsi manual tidak perlu disalin, silakan ganti dengan kelas lain.</div>
			</div>';
	}


	if($bisa == 1)
	{?>
		<div class="form-group row row">
			<div class="col-sm-12"><label class="control-label">Disalin ke</label></div>
		</div>
		<?php
		$tb = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");
		?>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="id_mapeld" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
				<?php
				$mapelkelasd = '';
				$tdx = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapeld'");
				$dmateri1 = '';
				$dmateri2 = '';
				$dmateri3 = '';
				$dmateri4 = '';
				$dmateri5 = '';
				$dmateri6 = '';
				$dmateri7 = '';
				$dmateri8 = '';
				$dmateri9 = '';
				$dmateri10 = '';
				$dketerampilan1 = '';
				$dketerampilan2 = '';
				$djenis_deskripsi ='';
				$dmapelxx = '';
				$dkelasxx = '';
				foreach($tdx->result() as $dx)
				{
					$dkelasxx = $dx->kelas;
					$dmapelxx = $dx->mapel;
					$djenis_deskripsi = $dx->jenis_deskripsi;
					$dmateri1 = $dx->materi1;
					$dmateri2 = $dx->materi2;
					$dmateri3 = $dx->materi3;
					$dmateri4 = $dx->materi4;
					$dmateri5 = $dx->materi5;
					$dmateri6 = $dx->materi6;
					$dmateri7 = $dx->materi7;
					$dmateri8 = $dx->materi8;
					$dmateri9 = $dx->materi9;
					$dmateri10 = $dx->materi10;
					$dketerampilan1 = $dx->keterampilan1;
					$dketerampilan2 = $dx->keterampilan2;
				}
				$mapelkelasd = $dmapelxx.' '.$dkelasxx;
				//cari deskripsi
				if($djenis_deskripsi== 1)
				{
					$jenis_deskripsine = 'Berdasarkan Ulangan (Deskripsi Otomatis)';
				}
				elseif($djenis_deskripsi== 2)
				{
					$jenis_deskripsine = 'Berdasarkan Nilai Akhir (Deskripsi Otomatis)';
				}	
				elseif($djenis_deskripsi== 5)
				{
					$jenis_deskripsine = 'Berdasarkan NS (Deskripsi Otomatis)';
				}	
				elseif($jenis_deskripsi== 3)
				{
					$jenis_deskripsine = 'Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)';
				}
				elseif($jenis_deskripsi== 4)
				{
					$jenis_deskripsine = 'Berdasar bank deskripsi';
				}
				elseif($jenis_deskripsi== 5)
				{
					$jenis_deskripsine = $this->config->item('versi_deskripsi');
				}

				else
				{
					$jenis_deskripsine = 'Kopi Paste / Manual';
				}
				echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'/'.$id_mapeld.'">'.$mapelkelasd.'</option>';
				foreach($tb->result() as $b)
				{
					if($b->id_mapel != $id_mapel)
					{
						echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'/'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
					}
				}
				echo '</select>';
			?>
		        </div>
		</div>
		<?php
		}
		if(($bisa == 1) and (!empty($id_mapeld)))
			{
				echo '<input type="hidden" name="id_mapeldd" value="'.$id_mapeld.'">
				<input type="hidden" name="dmateri1" value="'.$materi1.'">
				<input type="hidden" name="dmateri2" value="'.$materi2.'">
				<input type="hidden" name="dmateri3" value="'.$materi3.'">
				<input type="hidden" name="dmateri4" value="'.$materi4.'">
				<input type="hidden" name="dmateri5" value="'.$materi5.'">
				<input type="hidden" name="dmateri6" value="'.$materi6.'">
				<input type="hidden" name="dmateri7" value="'.$materi7.'">
				<input type="hidden" name="dmateri8" value="'.$materi8.'">
				<input type="hidden" name="dmateri9" value="'.$materi9.'">
				<input type="hidden" name="dmateri10" value="'.$materi10.'">
				<input type="hidden" name="keterampilan1" value="'.$keterampilan1.'">
				<input type="hidden" name="keterampilan2" value="'.$keterampilan2.'">
				<input type="hidden" name="id_mapel" value="'.$id_mapel.'">
				<input type="hidden" name="tahun1" value="'.substr($thnajaran,0,4).'">
				<input type="hidden" name="semester" value="'.$semester.'">
				<input type="hidden" name="djenis_deskripsi" value="'.$jenis_deskripsi.'">
				<p class="text-center"><button type="submit" class="btn btn-primary">SALIN DESKRIPSI</button> <a class="btn btn-info" href="'.base_url().'guru/salindeskripsi"><b>Batal</b></a></p>';
			}
		else
		{
			echo '<p class="text-center"><a class="btn btn-info" href="'.base_url().'guru/salindeskripsi"><b>Batal</b></a></p>';
		}
	?>

</div></div></form>
</div>
