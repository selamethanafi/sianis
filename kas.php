<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
if($bulan < 7)
{
	$tahun2 = $tahun+1;
	$thnajaran = ''.$tahun.'/'.$tahun2.'';
	$semester = 2;
}
else
{
	$tahun1 = $tahun-1;
	$thnajaran = ''.$tahun1.'/'.$tahun.'';
	$semester = 1;
}
if((!empty($tahun)) and (!empty($bulan)) and (!empty($sumber)))
{
	if($sumber == '1')
	{
	$sumbere = 'Syahriyah';
	?>
	<a href="<?php echo base_url();?>keuangan/kas"><h3 class="text-center">KAS DANA OPERASIONAL SYAHRIYAH</h3></a>
	<?php
	}
	elseif($sumber == '2')
	{
	$sumbere = 'dpm';
	?>
	<a href="<?php echo base_url();?>keuangan/kas"><h3 class="text-center">KAS DANA OPERASIONAL DPM</h3></a>
	<?php
	}
	elseif($sumber == '3')
	{
	$sumbere = 'infaq/jariyah';
	?>
	<a href="<?php echo base_url();?>keuangan/kas"><h3 class="text-center">KAS DANA OPERASIONAL INFAQ/JARIYAH</h3></a>
	<?php
	}
	else
	{
		$tb = $this->db->query("select * from `m_penerimaan` where `nomor`='$sumber'");
		foreach($tb->result() as $b)
		{
			echo '<a href="'.base_url().'keuangan/kas"><h3 class="text-center">KAS DANA '.strtoupper($b->macam_penerimaan).'</h3></a>';
			$sumbere = $b->macam_penerimaan;
		}

	}
	?>
	<p class="text-center">Bulan <?php echo gantibulan($bulan).' '.$tahun;?></p>
	<table width="100%"><tr valign="top">
	<td width="50%">
		<div class="CSSTableGenerator">
		<table width="100%" bgcolor="#ccc"><tr bgcolor="#fff" align="center"><td>No</td><td>Tanggal</td><td>Pemasukan</td><td>Jumlah</td></tr>
		<?php
		$jm = 0;
		$nomor = 1;
		if($bulan<10)
		{
			$bulan = '0'.$bulan;
		}
		for($i=1;$i<32;$i++)
		{
			if($i<10)
			{
				$tanggal = $tahun.'-'.$bulan.'-0'.$i;
			}
			else
			{
				$tanggal = $tahun.'-'.$bulan.'-'.$i;
			}
			$qm = $this->Keuangan_model->Kas_Masuk($tanggal,$sumbere);
			if($qm->num_rows()>0)
			{
				$besar = 0;
				foreach($qm->result() as $m)
				{
					$besar = $besar + $m->besar;
				}
				$jm = $jm + $besar;
				if($sumber == 1)
				{	
				echo '<tr bgcolor="#fff"><td align="center">'.$nomor.'</td><td align="center">'.tanggal($tanggal).'</td><td>Diterima Pembayaran Syahriyah</td><td align="right">'.number_format($besar).'</td></tr>';
				}
				elseif($sumber == 2)
				{
				echo '<tr bgcolor="#fff"><td align="center">'.$nomor.'</td><td align="center">'.tanggal($tanggal).'</td><td>Diterima Pembayaran DPM</td><td align="right">'.number_format($besar).'</td></tr>';
				}
				else
				{
				echo '<tr bgcolor="#fff"><td align="center">'.$nomor.'</td><td align="center">'.tanggal($tanggal).'</td><td>Diterima infaq / syahriyah</td><td align="right">'.number_format($besar).'</td></tr>';

				}

				$nomor++;
			}
			$qpl = $this->Keuangan_model->Kas_Penerimaan($tanggal,$sumbere);
			if($qpl->num_rows()>0)
			{
				$besar = 0;
				foreach($qpl->result() as $l)
				{
					$besar = $l->besar;
					$jm = $jm + $besar;
					echo '<tr bgcolor="#fff"><td align="center">'.$nomor.'</td><td align="center">'.tanggal($tanggal).'</td><td>'.$l->keterangan.'</td><td align="right">'.number_format($besar).'</td></tr>';

				}

				$nomor++;
			}

		}
		echo '<tr bgcolor="#fff"><td colspan="3" align="right">Jumlah</td><td align="right">'.number_format($jm).'</td></tr>';

		?>
		</table></div>
	</td>
	<td>
		<div class="CSSTableGenerator">
		<table width="100%" bgcolor="#ccc"><tr bgcolor="#fff" align="center"><td>No</td><td>Tanggal</td><td>Pengeluaran</td><td>Jumlah</td></tr>
		<?php
		$nomor = 1;
		$jk = 0;
		foreach($qk->result() as $k)
		{
			echo '<tr bgcolor="#fff"><td align="center">'.$nomor.'</td><td align="center">'.tanggal($k->tanggal).'</td><td>'.$k->keterangan.'</td><td align="right">'.number_format($k->besar).'</td></tr>';
			$nomor++;
			$jk = $jk + $k->besar;
		}
		echo '<tr bgcolor="#fff"><td colspan="3" align="right">Jumlah</td><td align="right">'.number_format($jk).'</td></tr>';

		?>
		</table></div>

	</td>
	</tr>
	</table><br />
	<table width="100%"><tr>
		<td width="40%">
			<table><tr><td colspan="2">Dengan keadaan sebagai berikut:</td></tr>
				<tr><td>DEBET</td><td><?php echo number_format($jm);?></td></tr>
				<tr><td>KREDIT</td><td><?php echo number_format($jk);?></td></tr>
				<?php
				$saldobuku = $jm - $jk;
				?>
				<tr><td>SALDO BUKU</td><td><?php echo number_format($saldobuku);?></td></tr>
				<tr><td>SALDO KAS</td><td></td></tr>
				<tr><td>Selisih saldo buku dan saldo kas</td><td>NIHIL</td></tr>
			</table>
		</td>
		<td>
			<table width="100%"><tr  valign="top"><td></td><td><br />Ketua Komite<br /><br /><br /><br /><?php echo $nama_ketua_komite;?></td><td><?php echo $lokasi.',&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.gantibulan($bulan).' '.$tahun.'<br />Bendahara,<br /><br /><br /><br />';
	if(!empty($bendahara_komite))
	{
		echo $bendahara_komite;
	}
	else
	{
		echo $namapengguna;
	}
?>
</td></tr>
			</table>

		</td>
		</tr>
	</table>
	<?php
}
else
{

	?>
	<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
	<?php
	$xloc = base_url().'keuangan/kas';
	echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	if(!empty($tahun))
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9"><p class="form-control-static"><input name="tahun" type="text" value="<?php echo $tahun;?>" class="form-control" readonly></p></div></div>
		<?php
	}
	if(!empty($bulan))
	{
		$bulane = gantibulan($bulan);
		?>
		
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bulan</label></div><div class="col-sm-9"><p class="form-control-static"><input name="bulan" type="text" value="<?php echo $bulane;?>" class="form-control" readonly></p></div></div>
		<?php
	}
	if(empty($tahun))
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9">
		<select name="tahun" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$bulan.'">'.$tahun.'</option>';
		$thnsaja = tahunsaja(tanggal_hari_ini());
		echo '<option value="'.$xloc.'/'.$thnsaja.'/'.$bulan.'">'.$thnsaja.'</option>';
		foreach($daftar_tapel->result() as $a)
		{
			echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'/'.$bulan.'">'.substr($a->thnajaran,0,4).'</option>';
		}
		?>
		</select></div></div>
		<?php
	}
	elseif(empty($bulan))
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bulan</label></div><div class="col-sm-9">
		<select name="bulan" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		$bulane = gantibulan($bulan);
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$bulan.'">'.$bulane.'</option>';
		for($i=1;$i<=12;$i++)
		{
			$bulane = gantibulan($i);
			echo '<option value="'.$xloc.'/'.$tahun.'/'.$i.'">'.$bulane.'</option>';
		}
		?>
		</select></div></div>
		<?php
	}
	elseif(empty($sumber))
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Sumber</label></div><div class="col-sm-9">
		<select name="sumber" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$bulan.'"></option>';
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$bulan.'/1">Syahriyah</option>';
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$bulan.'/2">DPM</option>';
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$bulan.'/3">Infaq/Jariyah</option>';
		$tb = $this->db->query("select * from `m_penerimaan` order by `macam_penerimaan`");
		foreach($tb->result() as $b)
		{
			echo '<option value="'.$xloc.'/'.$tahun.'/'.$bulan.'/'.$b->nomor.'">'.$b->macam_penerimaan.'</option>';
		}

		?>
		</select></div></div>
		<?php

	}
	else
	{
		echo 'asdasdas';
	}
	?>
	</form>
	</div></div></div>
	<?php
}


