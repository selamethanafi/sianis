<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_buku_rapor.php
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
<?php
			$id_thnajaran = '';
if ($sekarang == 'sekarang')
{
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$daftar_kelas = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	echo form_open('pengajaran/cetakbukurapor/'.$sekarang,'class="form-horizontal" role="form"');?>
	<div class="panel panel-default">
	<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="panel-body">
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option></select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="kelas" class="form-control">';
	foreach($daftar_kelas->result_array() as $ka)
	{
		echo "<option value='".$ka["kelas"]."'>".$ka["kelas"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Abaikan kunci dari Walikelas </label></div><div class="col-sm-9"><select name="abaikan" class="form-control">';
	echo '<option value="'.$abaikan.'">'.$abaikan.'</option>';
	echo "<option value='Tidak'>Tidak</option>";
	echo "<option value='Ya'>Ya</option>";
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Proses" class="btn btn-primary"></p></form>';
	if(!empty($kelas))
	{
		$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
		echo '<p>Silakan klik tautan cetak untuk mencetak. Kalau tidak muncul, berarti ada nilai yang belum dikunci oleh walikelas.</p>';
		foreach($ta->result() as $a)
		{
			echo '<p>'.nis_ke_nama($a->nis);
			$nis = $a->nis;
			$adayangbelumdikunci = 0;
			$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
			foreach($tc->result() as $c)
			{
				if(empty($c->kunci))
				{
				$adayangbelumdikunci++;
				}
					
			}
			//cari id_thnajaran

			$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
			foreach($td->result() as $d)
			{
				$id_thnajaran = $d->id;
			}
			if((empty($abaikan)) or ($abaikan=='Tidak'))
				{
				if ($adayangbelumdikunci==0)
					{
					?>	
					<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a></p>
					<?php
					}
				}
			if($abaikan=='Ya')
				{

					?>
					<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis.'/cuek';?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a></p>
				<?php
				}

		}
		echo '</div></div>';
	}

} //kalau sekarang
else
{
	echo form_open('pengajaran/cetakbukurapor','class="form-horizontal" role="form"');?>
	<div class="panel panel-default">
	<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="panel-body">
	<?php
	if (!empty($thnajaran))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><select name="thnajaran" class="form-control">';
		echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
		echo '</select></div></div>';
	}
	if (!empty($semester))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option></select></div></div>';
	}
	if(!empty($kelas))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="kelas" class="form-control"><option value="'.$kelas.'">'.$kelas.'</option></select></div></div>';
	}
	if(!empty($nis))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="nis" class="form-control"><option value="'.$nis.'">'.nis_ke_nama($nis).' '.$nis.'</option></select></div></div>';
	}
	if(!empty($abaikan))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Abaikan kunci dari Walikelas</label></div><div class="col-sm-9"><select name="abaikan" class="form-control"><option value="'.$abaikan.'">'.$abaikan.'</option></select></div></div>';
	}
	if((empty($thnajaran)) or (empty($semester)))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">';
		foreach($daftar_tapel->result_array() as $k)
		{
		echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">';
		echo "<option value='1'>1</option>";
		echo "<option value='2'>2</option>";
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Abaikan kunci dari Walikelas </label></div><div class="col-sm-9"><select name="abaikan" class="form-control">';
	echo "<option value='Tidak'>Tidak</option>";
	echo "<option value='Ya'>Ya</option>";
	echo '</select></div></div><p class="text-center"><input type="submit" value="Proses" class="btn btn-primary"></p></form>';
	}
	elseif(empty($kelas))
	{
		$daftar_kelas = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");

		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="kelas" class="form-control">';
		foreach($daftar_kelas->result_array() as $ka)
		{
			echo "<option value='".$ka["kelas"]."'>".$ka["kelas"]."</option>";
		}
		echo '</select></div></div><p class="text-center"><input type="submit" value="Proses" class="btn btn-primary">
		<a href="'.base_url().'pengajaran/cetakbukurapor/'.$sekarang.'" class="btn btn-info">Kelas Lainnya</a></p></form>';

	}
	else
	{
		$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
		echo $kurikulum;
		echo '<p><a href="'.base_url().'pengajaran/cetakbukurapor/'.$sekarang.'" class="btn btn-info">Kelas Lainnya</a></p>';
		$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
		echo '<div class="alert alert-warning">Silakan klik tautan cetak untuk mencetak. Kalau tidak muncul, berarti ada nilai yang belum dikunci oleh walikelas.</div>';
		$adasiswa = $ta->num_rows();
		if ($adasiswa == 0)
			{
			echo '<div class="alert alert-warning">Tidak data siswa</div>';
			}
		foreach($ta->result() as $a)
		{
			echo '<p>'.nis_ke_nama($a->nis);
			$nis = $a->nis;
			$adayangbelumdikunci = 0;
			$namamapel = '';
			$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y'");
			$terkunci = '';
			foreach($tc->result() as $c)
			{
				$terkunci = $c->kunci;
				if((empty($c->kunci)) or ($c->kunci == 0) or ($c->kunci == '0'))
				{
				$adayangbelumdikunci++;
				$namamapel .= ' '.$c->mapel;
				}
					
			}
			//cari id_thnajaran
				if((empty($abaikan)) or ($abaikan=='Tidak'))
				{
					if ($adayangbelumdikunci==0)
					{
						if($kurikulum == '2015')
						{
						?>	
							<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis;?>/2015','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a></p>
						<?php
						}
						else
						{
						?>	
							<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a></p>
						<?php
						}

					}
					if(!empty($namamapel))
					{
						echo ' belum bisa dicetak karena<p class="text-danger">'.$namamapel.'</p>belum dikunci.';
					}
				
				}
				if($abaikan=='Ya')
				{
					if($kurikulum == '2015')
					{
					?>	
					<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis.'/cuek';?>/2015','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a></p>
					<?php
					}
					else
					{?>
					<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis.'/cuek';?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a></p>
					<?php
					}

				}

		}
		echo '</div></div>';
	}
}
?>
</div>
