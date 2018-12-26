<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		 edit_ijazah.php
// Lokasi      		 application/views/tatausaha
// Terakhir diperbarui	 Min 15 Mei 2016 18:30:26 WIB 
// Author      		 Selamet Hanafi
//
// (c) Copyright
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#smpmts").mask("2-99-99-99-999-999-9")
	$("#nisn").mask("9999999999")
	$("#tanggallahirsiswa").mask("99-99-9999")
	$("#tanggalijazah").mask("99-99-9999")
	$("#tanggalditerima").mask("99-99-9999")
	$("#paketb").mask("B-99-99-99-99-999")
	$("#pontren").mask("C-99-99-99-999-999")
	$("#sttbpaketb").mask("9999999")
	$("#sttbmts").mask("MTs. 999999999")
	$("#sttbmts2").mask("MTs-06 999999999")
	$("#sttbsmp").mask("DN-03 DI 9999999")
	$("#sttbsmp2").mask("DN-03 DI/99 9999999")
	$("#noblankoskhun1").mask("DN-03 DI 9999999")
	$("#noblankoskhun2").mask("DN-03 D 9999999")
	});
</script>

<div class="container-fluid"><h2>Modul Pengolahan Data Siswa</h2>
<?php
if($tersimpan == 'oke')
{
	echo '<div class="alert alert-success">Sukses! Data ijazah SLTP siswa diperbarui</div>';
}
?>
<a href="<?php echo base_url();?>tatausaha/carisiswa" class="btn btn-info"><b>Pencarian Data Siswa</b></a>
<?php
if (!empty($nis))
	{
	?>
	<a href="<?php echo base_url();?>tatausaha/fotosiswa/<?php echo $nis;?>" class="btn btn-info"><b>Data Siswa</b></a><p></p>
	<?php
	}
	?>
<?php
if (empty($nis))
	{
	echo '<div class="alert alert-danger>Data siswa tidak ditemukan</div>';
	}
else
{
echo form_open('tatausaha/ijazah/'.$nis,'class="form-horizontal" role="form"');
if (count($query->result())>0) 
{
	foreach($query->result() as $t)
	{
		$sltp = strtoupper(substr($t->sltp,0,1));
		?>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Nomor Induk Siswa</label></div>
			<div class="col-sm-9"><?php echo $t->nis;?>
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Nama</label></div>
			<div class="col-sm-9" ><input type="text" name="nama" value="<?php echo $t->nama;?>" class="form-control">
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Tempat Lahir</label></div>
			<div class="col-sm-9" ><input type="text" name="tmpt" value="<?php echo $t->tmpt;?>" class="form-control">
		</div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal lahir</label></div>
			<div class="col-sm-9" >
			<?php
			$str = $t->tgllhr;	
			$tgllhr = tanggal($str);
			?>
			<input type="text" name="tgllhr" value="<?php echo $tgllhr;?>" id="tanggallahirsiswa" class="form-control">
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Nama Orang Tua</label></div>
			<div class="col-sm-9" ><input type="text" name="nmortu" value="<?php echo $t->nmortu;?>" class="form-control">
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">NIS Nasional</label></div>
			<?php
			$nisn = $t->nisn;
			if(substr($t->nisn,0,14)== $kode_tambahan_nis_ard)
			{?>
				<div class="col-sm-9" ><input type="text" name="nisn" value="<?php echo $t->nisn;?>" class="form-control" readonly>
			<?php
			}
			else
			{?>
				<div class="col-sm-9" ><?php echo substr($t->nisn,0,12).' '.$kode_tambahan_nis_ard;?><input type="text" name="nisn" value="<?php echo $t->nisn;?>" id="nisn" class="form-control">
			<?php
			}?>

			
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Nomor Peserta Ujian SLTP</label></div>
			<div class="col-sm-9" >
			<?php
			if (($sltp=='S') or ($sltp=='M'))
			{
				?>
				<input type="text" name="skhun" value="<?php echo $t->skhun;?>" id="smpmts" class="form-control">
				<?php
			}
			else
			{
			?>
			<input type="text" name="skhun" value="<?php echo $t->skhun;?>" class="form-control">
			<?php
			}
			?>
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Nomor Blanko SKHUN</label></div>
			<div class="col-sm-9" >
			<?php
			if(substr($t->no_blanko_skhun,0,8) == 'DN-03 DI')
			{
				$noblanko1 = $t->no_blanko_skhun;
				$noblanko2 = '';
			}
			else
			{
				$noblanko2 = $t->no_blanko_skhun;
				$noblanko1 = '';
			}

			?>
			<input type="text" name="no_blanko_skhun" value="<?php echo $noblanko1;?>" id="noblankoskhun1" class="form-control" placeholder="untuk lulusan 2015 dan sebelumnya">
			<input type="text" name="no_blanko_skhun2" value="<?php echo $noblanko2;?>" id="noblankoskhun2"  class="form-control" placeholder="untuk lulusan 2016 dst">
		</div></div>

		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">SLTP Asal</label></div>
			<div class="col-sm-9" ><input type="text" name="sltp" value="<?php echo $t->sltp;?>" class="form-control">
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Nomor Ijazah SLTP</label></div>
			<div class="col-sm-9">
			<?php
			if ($sltp=='S')
			{
			if(substr($t->nosttb,0,9) == 'DN-03 DI/')
			{
				$nosttb = '';
				$nosttb2 = $t->nosttb;
			}
			else
			{
				$nosttb2 = '';
				$nosttb = $t->nosttb;
			}
			?>
			<input type="text" name="nosttb" value="<?php echo $nosttb;?>" id="sttbsmp" class="form-control" placeholder="untuk lulusan 2015 dan sebelumnya">
			<input type="text" name="nosttb2" value="<?php echo $nosttb2;?>" id="sttbsmp2" class="form-control" placeholder="untuk lulusan 2016 dst">
			<?php
			}
			else if ($sltp=='M')
			{
				if(substr($t->nosttb,0,6) == 'MTs-06')
				{
					$nosttb = '';
					$nosttb2 = $t->nosttb;
				}
				else
				{
					$nosttb2 = '';
					$nosttb = $t->nosttb;
				}
				?>
			<input type="text" name="nosttb" value="<?php echo $nosttb;?>" id="sttbmts" class="form-control">
			<input type="text" name="nosttb2" value="<?php echo $nosttb2;?>" id="sttbmts2" class="form-control">
			<?php
			}
			else
			{
			?>
			<input type="text" name="nosttb" value="<?php echo $t->nosttb;?>" class="form-control">
			<?php
			}
			?>
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">NPSN SLTP/MTS/Paket B</label></div>
			<div class="col-sm-9" >
			<input type="text" name="npsn_sltp" value="<?php echo $t->npsn_sltp;?>" class="form-control">
		</div></div>

		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Tanggal Ijazah</label></div>
			<div class="col-sm-9" >
			<?php
			$str = $t->tglsttb;	
			$tglsttb = tanggal($str);
			?>
			<input type="text" name="tglsttb" value="<?php echo $tglsttb;?>" id="tanggalijazah" class="form-control">
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Berdasar ijazah</label></div>
			<div class="col-sm-9" >
			<?php
			echo '<select name="ijazah" class="form-control">';
			if($t->ijazah=='Ya')
			{
		        echo '<option value="Ya">Ya</option><option value="">Tidak</option>';
			}
			else
			{
		        echo '<option value="">Tidak</option><option value="Ya">Ya</option>';
			}
	              ?>
			</select>
		</div></div>
		<p class="text-center"><button type="submit" class="btn btn-primary">PERBARUI DATA SISWA</button> <input type="hidden" name="nis" value="<?php echo $t->nis;?>"> <a href="<?php echo base_url();?>tatausaha/carisiswa" class="btn btn-info">CARI SISWA LAIN</a></p>
		<?php
	}
}
else{
echo "Belum Ada Data";
}
}
?>
</form>

</div>

