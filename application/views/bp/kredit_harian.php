<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 16:13:18 WIB 
// Nama Berkas 		: kredit_harian.php
// Lokasi      		: application/views/bp/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<?php $tanggalharian = "$tahunhadir-$bulanhadir-$tanggalhadir";
?>
<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body"><form class="form-horizontal" role="form" action= "<?php echo base_url();?>bp/kreditharian" method="post">
	<div class="col-sm-2">
		<label class="control-label">Tanggal</label>
	</div>
	<div class="col-sm-1">
		<select name="tanggalhadir" class="form-control">
		<?php
			$postedhari= substr($tanggalharian,8,2);
			$postedbulan= substr($tanggalharian,5,2);
			$postedtahun= substr($tanggalharian,0,4);
			echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
			for($i=1;$i<=9;$i++)
			{
				echo '<option value="0'.$i.'">0'.$i.'</option>';
			}	
			for($i=10;$i<=31;$i++)
			{
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
			?>
		</select>
	</div>
	<div class="col-sm-2">
		<select name="bulanhadir" class="form-control">
			<?php
			 $bulan = gantibulan($postedbulan);
			echo '<option value="'.$postedbulan.'">'.$bulan.'</option>';	
			echo '<option value="01">Januari</option>';
			echo '<option value="02">Februari</option>';
			echo '<option value="03">Maret</option>';
			echo '<option value="04">April</option>';
			echo '<option value="05">Mei</option>';
			echo '<option value="06">Juni</option>';
			echo '<option value="07">Juli</option>';
			echo '<option value="08">Agustus</option>';
			echo '<option value="09">September</option>';
			echo '<option value="10">Oktober</option>';
			echo '<option value="11">November</option>';
			echo '<option value="12">Desember</option>';
			?>
		</select>
	</div>
	<div class="col-sm-2">
			<?php
			echo '<select name="tahunhadir" class="form-control">';
			echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
		  	$th=date("Y");
		        $awal_th=$th;
		        $akhir_th=$th-20;
			$i = $awal_th;
			do
			{
			       	echo '<option value="'.$i.'">'.$i.'</option>';
				$i=$i-1;
			}
			while ($i>=$akhir_th);
			?>
			</select>
	</div>
	<p></p>
	<div class="col-sm-5">
		<p class="text-center">
			<button type="submit" class="btn btn-primary">TAMPILKAN DATA
			</button>
		</p>
	</div>
</div></div>
</form>
<?php
$query = $this->db->query("select * from `siswa_kredit` where `tanggal` = '$tanggalharian'");
$adaquery = $query->num_rows();
if($adaquery>0)
{
?>
<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Kode<br>Pelanggaran</strong></td><td><strong>Pelanggaran</strong><td><strong>Point</strong><td><strong>Kode Guru</strong></td><td><strong>Hapus</strong></td></tr>

		<?php
		$nomor=1;
		foreach($query->result() as $ba)
		{
			$nis = $ba->nis;
			$thnajaran = $ba->thnajaran;
			$semester = $ba->semester;
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$namasiswa = nis_ke_nama($nis);
			$kode = $ba->kd_pelanggaran;
			$tkred = $this->db->query("select * from m_kredit where kode = '$kode'");
			$namapelanggaran = '';
			foreach($tkred->result() as $dkred)
			{
				$namapelanggaran = $dkred->nama_pelanggaran;
			}

			echo "<tr><td align=\"center\">".$nomor."</td><td>".$namasiswa."</td><td align=\"center\">".$kelas."</td><td align=\"center\">".$kode."</td><td>".$namapelanggaran."</td><td align=\"center\">".$ba->point."<td align=\"center\">".$ba->kodeguru."</td><td align=\"center\"><a href='".base_url()."bp/hapuskredit/".$ba->id_siswa_kredit."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Absensi Siswa'><span class='fa fa-trash-alt'></span></a></td></tr>";
			$nomor++;
		}
		?>
	</table>
</div>
<?php
}
else
{
	echo '<div class="alert alert-warning">Tidak ada data pada tanggal '.date_to_long_string($tanggalharian).'</div>';
}?>
</div>
