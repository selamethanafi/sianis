<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi Ketidakhadiran Siswa - <?php echo $this->config->item('sek_nama');?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
	$ta = $this->db->query("select * from `temauser` where `user`='00'");
	$adata = $ta->num_rows();
	if($adata==0)
	{?>
		  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<?php
	}
	else
	{
		$temacss = '';
		$ta = $this->db->query("select * from `temauser` where `user`='00'");
		foreach($ta->result() as $a)
		{
			$temacss = $a->temacss;
		}
		if(!empty($temacss))
		{?>
		    <link href="<?php echo base_url();?>assets/css/<?php echo $temacss;?>" rel="stylesheet"/>
		<?php
		}
		else
		{?>
		  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
		<?php
		}
	}

     ?>
  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jumpmenu.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="card bg-primary text-white">
		<div class="card-header"><h3>Ketidakhadiran Siswa </h3><h3><?php echo date_to_long_string($tanggalhariini);?></h3></div>
		<div class="card-body">
		<?php
			echo $info;
			$tb = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
			$kelasx= '';
			foreach($tb->result() as $b)
			{
				$kelasx = $b->kelas;
			}
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by kelas");

			$xloc = base_url().'tukardata/piket/'.$token;
			echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
			<div class="form-group row">
			<div class="col-sm-6"><label class="control-label">Kelas</label></div>
			<div class="col-sm-6">
			<select name="id_walikelas" onChange="MM_jumpMenu('self',this,0)" class="form-control">
			<option value="<?php echo $id_walikelas;?>"><?php echo $kelasx;?></option>
			<?php
			foreach($ta->result() as $a)
			{
				echo '<option value="'.$xloc.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
			}
			?>
			</select></div></div>
			<?php
			$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' and `status`='Y' order by `no_urut`");
			$cacahsiswa = 0;
			$cacahsiswatidakmasuk = 0;
			$nomor = 1;
			foreach($tc->result() as $c)
			{
				$nis = $c->nis;
				$td = $this->db->query("select * from `siswa_absensi` where `tanggal`='$tanggalhariini' and `nis`='$nis'");
				if($td->num_rows()>0)
				{
					$alasane = '';
					foreach($td->result() as $d)
					{
						$alasane .= ' '.$d->alasan;
					}
					echo '<div class="form-group row"><div class="col-sm-6"><label class="control-label">'.nis_ke_nama($c->nis).'</label></div>
					<div class="col-sm-6"><input type="text" class="form-control" value="'.$alasane.'" disabled></div></div>';
					if(($d->alasan == 'S') or ($d->alasan == 'I') or ($d->alasan == 'A') or ($d->alasan == 'M'))
					{
						$cacahsiswatidakmasuk++;
					}
				}
				else
				{
					echo '<div class="form-group row"><div class="col-sm-6"><label class="control-label">'.nis_ke_nama($c->nis).'</label></div>
					<div class="col-sm-6"><input type="hidden" name="nis_'.$nomor.'" value="'.$c->nis.'">
					<select name="alasan_'.$nomor.'" class="form-control">
					<option value="">Hadir / pilih keterangan tidak masuk</option>
					<option value="S">Sakit</option>
					<option value="I">Izin</option>
					<option value="A">Tanpa Keterangan</option>
					<option value="T">Terlambat masuk sekolah</option>
					<option value="B">Membolos</option></select>
					</div></div>';
					$nomor++;
					$cacahsiswa++;
				}
			}
			if($cacahsiswa>0)
			{
			?>
			<input type="hidden" name="cacahsiswa" value="<?php echo $cacahsiswa;?>">
			<input type="hidden" name="cacahsiswatidakmasuk" value="<?php echo $cacahsiswatidakmasuk;?>">
			<input type="hidden" name="kelas" value="<?php echo $kelasx;?>">
			<div class="form-group row">
				<div class="col-sm-6"><label class="control-label">Kode Guru</label></div>
				<div class="col-sm-6"><input type="text" name="kodeguru" placeholder="silakan memasukkan kode guru" class="form-control" required></div>
			</div>
			<p class="text-center"><input type="submit" value="Kirim" class="btn btn-success"></p>
			<?php
			}?>
		</form>
		</div>
	</div>
</div>

