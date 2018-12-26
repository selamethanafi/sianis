<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: daftar_nilai_psikomotor.php
// Terakhir diperbarui	: Rab 11 Mei 2016 21:55:44 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

<?php
if($jujug == 'T')
{
	if($proses != 'proses')
	{
	echo '<div class="alert alert-warning">Setelah mengisi semua nilai silakan proses deskripsi keterampilan <a href="'.base_url().'guru/deskripsiketerampilan/'.$id_mapel.'" class="btn btn-primary">PROSES DEKSRIPSI KETERAMPILAN</a></a></div>';
	}
	else
	{
		echo '<div class="alert alert-success">Berhasil memproses deskripsi keterampilan. Deskripsi ada di bagian bawah<a href="'.base_url().'guru/daftarnilai/'.$id_mapel.'" class="btn btn-info"><b>Ke Penilaian Pengetahuan</b></a></div>';
	}
}
?>
<p><a href="<?php echo base_url(); ?>guru/psikomotor/" class="btn btn-info"><span class="fa fa-arrow-left"></span><b>Kelas lain</b></a></p>
<?php
$tap = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
$cacahitem = 0;
foreach($tap->result() as $dap)
{
	$cacahitem = $dap->np;
}
if($cacahitem == 0)
{
	echo '<div class="alert alert-info">Cacah Indikator tidak ada, deskripsi tidak bisa dibuat</div>';
}
else
{
?>
	<form class="form-horizontal" role="form">
		<div class="form-group row">
			<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $thnajaran;?></p></div>
			<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $semester;?></p></div>
			<div class="col-sm-3"><label for="kelas" class="control-label">Kelas</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $kelas;?></p></div>
			<div class="col-sm-3"><label for="matapelajaran" class="control-label">Mata Pelajaran</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $mapel;?></p></div>
			<div class="col-sm-3"><label for="cacah_item_penilaian" class="control-label">Cacah Kriteria Penilaian</label></div>
			<div class="col-sm-9" ><div class="form-control-static"><?php echo $cacahitem;?></div></div>
			<div class="col-sm-3"><label for="kurikulum" class="control-label">Kurikulum</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $kurikulum;?></p></div>
	    </div>
	</form>
	<?php
/*
	if(($kurikulum == '2013') or ($kurikulum == '2015'))
	{
		?>
			<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>deskripsi/pramapel/keterampilan/<?php echo $id_mapel;?>/mapel','yes','scrollbars=yes,width=550,height=400')"  class='btn btn-primary'> PROSES DESKRIPSI</a></p>
		<?php
	}
*/
	$nomor=1;
	if(count($query->result())>0)
	{
		?>
		<div class="table-responsive">
		<table class="table table-hover table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td>
		<?php
		$kolom = 1;
		do
		{
			$pke = 'p'.$kolom;
			if(!empty($dap->$pke))
			{
				echo '<td><a href="'.base_url().'guru/nilaipsikomotor/'.$id_mapel.'/'.$kolom.'" class="btn btn-primary" title="'.$dap->$pke.'">'.substr($dap->$pke,0,4).'</a></td>';
			}
			$kolom++;
		}
		while($kolom<19);
		echo '<td>Nilai</td>
		<td>';
		if($jujug == 'Y')
		{
			echo '<a href="'.base_url().'guru/nilaipsikomotor/'.$id_mapel.'/19" title="Nilai Akhir Psikomotor / Keterampilan" class="btn btn-primary"><strong>NP</strong></a>';
		}
		else
		{
			echo '<strong>NP*</strong>';
		}
		echo '</td>
		</tr>';
		foreach($query->result() as $t)
		{
			$nis = $t->nis;
			$namasiswa = nis_ke_nama($nis);
			$psi = $t->psi;
			$ratarata = 0;
			if($cacahitem>0)
			{
				$ratarata = ($t->p1 + $t->p2 + $t->p3 + $t->p4 + $t->p5 + $t->p6 + $t->p7 + $t->p8 + $t->p9 + $t->p10 + $t->p11 + $t->p12 + $t->p13 + $t->p14 + $t->p15 + $t->p16 + $t->p17 + $t->p18) / $cacahitem;
			}
			$ratarata = round($ratarata,2);
			echo "<tr><td align='center'>".$nomor."</td><td><a href='".base_url()."guru/daftarnilaipsikomotor/".$id_mapel."/persiswa/".$t->kd."'>".$namasiswa."</a></td>";
			if ($kurikulum == '2013')
			{
				$kolom = 1;
				do
				{
					$pke = 'p'.$kolom;
					echo "<td align='center'>".konversi_nilai($t->$pke)."</td>";
					$kolom++;
				}
				while($kolom<=$cacahitem);

				echo "<td align='center'>".konversi_nilai($ratarata)."</td><td align='center'>".konversi_nilai($psi)."</td>";
			}
			else
			{
				$kolom = 1;
				do
				{
					$pke = 'p'.$kolom;
					echo "<td align='center'>".$t->$pke."</td>";
					$kolom++;
				}
				while($kolom<=$cacahitem);
				echo "<td align='center'>".$ratarata."</td>";
				if($t->kunci == 1)
				{
					echo '<td align="center">'.$psi.' <span class="fa fa-lock"></span></td>';
				}
				else
				{
					echo '<td align="center">'.$psi.'</td>';
				}

			}
			echo "</tr>";
			$nomor++;	
		}
		echo '<tr><td align="center"></td><td>Indikator Penilaian Keterampilan </td>';
		$iteme = 1;
		do
		{
			$ite = "p$iteme";
			if (!empty($dap->$ite))
			{
				echo '<td align="center"><a href="'.base_url().'k2013/aspekpenilaianketerampilan/'.$id_mapel.'/'.$iteme.'" title="Indikator Penilaian '.$dap->$ite.'"><span class="fa fa-edit"></span></a></td>';
			}
			$iteme++;
		}
		while ($iteme<18);
		echo '</tr>';
		echo '<tr><td align="center"></td><td>Detil Penilaian</td>';
		$iteme = 1;
		do
		{
			$ite = "p$iteme";
			if (!empty($dap->$ite))
			{
				echo '<td align="center"><a href="'.base_url().'k2013/penilaianketerampilan/'.$id_mapel.'/'.$iteme.'" title="Penilaian Keterampilan '.$dap->$ite.'"><span class="fa fa-bullseye"></span></a></td>';
			}
			$iteme++;
		}
		while ($iteme<18);
		echo '</tr>';
		echo '<tr><td align="center"></td><td>Impor</td>';
		$iteme = 1;
		do
		{
			$ite = "p$iteme";
			if (!empty($dap->$ite))
			{
				echo '<td align="center"><a href="'.base_url().'guru/imporpsikomotor/'.$id_mapel.'/'.$iteme.'" title="Impor Nilai '.$dap->$ite.'"><span class="fa fa-bullseye"></span></a></td>';
			}
			$iteme++;
		}
		while ($iteme<18);
		echo '</tr>';
		//telegram
		echo '<tr><td align="center"></td><td>Kirim Telegram</td>';
		$iteme = 1;
		do
		{
			$ite = "p$iteme";
			if (!empty($dap->$ite))
			{
				echo '<td align="center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/'.$ite.'" title="Kirim Telegram '.$dap->$ite.'"><span class="fa fa-bullseye"></span></a></td>';
			}
			$iteme++;
		}
		while ($iteme<18);
		echo '</tr>';

		echo '</table></div>';
		echo '<p><a href="'.base_url().'guru/imporpsikomotor/'.$id_mapel.'/semua" class="btn btn-success">Unggah Nilai</a></p>';

	} // ada nilai psikomotor
	else
	{
		echo '<div class="alert alert-info">Belum ada daftar nilai psikomotor</div>';
	}
}
echo '</div></div></div>';
