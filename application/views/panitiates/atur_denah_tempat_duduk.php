<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: cetak_denah_tempat_duduk.php
// Lokasi      		: application/views/panitiates/
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
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$xloc = base_url().'panitiates/denahtempatduduk';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ruang Tes</label></div><div class="col-sm-9">
<select name="ruang" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	if(empty($ruang))
	{
		$ruang = '1';
	}
	echo '<option value="'.$xloc.'/'.$ruang.'">'.$ruang.'</option>';
	$urutan = 1;
	do
	{
		echo '<option value="'.$xloc.'/'.$urutan.'">'.$urutan.'</option>';
		$urutan++;
	}
	while ($urutan < $jumlah_kelas+1);
	?>
	</select></div></div>
</form>
<?php
if(!empty($ruang))
{
	$nobar = 1;
	do
	{
		$tc = $this->db->query("select * from `siswa_denah_tempat_duduk` where `ruang` = '$ruang' and `baris`='$nobar'");
		if($tc->num_rows() == 0)
		{
			$this->db->query("insert into `siswa_denah_tempat_duduk` (`ruang`,`baris`) values ('$ruang','$nobar')");
		}
		$nobar++;
	}	
	while($nobar<7);
	$ta = $this->db->query("select * from `siswa_nomor_tes` where `ruang` = '$ruang'");
	$adata = $ta->num_rows();
	if($adata>0)
	{
		echo form_open('panitiates/denahtempatduduk/'.$ruang,'class="form-horizontal" role="form"');
		echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>NIS</td><td>Nomor Tes</td><td>Nama</td><td>Kelas</td><td>Baris</td><td>Kolom</td><td>Kanan / Kiri</td></tr>';
		$nomor = 1;
		foreach($ta->result() as $a)
		{
			//cari posisi
			$baris = '';
			$kolom = '';
			$posisi = '';
			$nis = $a->nis;
			// kiri kolom 1
			$tkiri1 = $this->db->query("SELECT * FROM `siswa_denah_tempat_duduk` where `kiri1` = '$nis'");
			$adakiri = $tkiri1->num_rows();
			if($adakiri>0)
			{
				foreach($tkiri1->result() as $dkiri1)
				{
					$baris = $dkiri1->baris;
					$kolom = 1;	
					$posisi = 'Kiri';
				}
			}
			// kiri kolom 2
			$tkiri2 = $this->db->query("SELECT * FROM `siswa_denah_tempat_duduk` where `kiri2` = '$nis'");
			$adakiri = $tkiri2->num_rows();
			if($adakiri>0)
			{
				foreach($tkiri2->result() as $dkiri2)
				{
					$baris = $dkiri2->baris;
					$kolom = 2;	
					$posisi = 'Kiri';
				}

			}
			// kiri kolom 3
			$tkiri3 = $this->db->query("SELECT * FROM `siswa_denah_tempat_duduk` where `kiri3` = '$nis'");
			$adakiri = $tkiri3->num_rows();
			if($adakiri>0)
			{
				foreach($tkiri3->result() as $dkiri3)
				{
					$baris = $dkiri3->baris;
					$kolom = 3;
					$posisi = 'Kiri';
				}
	
			}
			// kiri kolom 4
			$tkiri4 = $this->db->query("SELECT * FROM `siswa_denah_tempat_duduk` where `kiri4` = '$nis'");
			$adakiri = $tkiri4->num_rows();
			if($adakiri>0)
			{
				foreach($tkiri4->result() as $dkiri4)
				{
					$baris = $dkiri4->baris;
					$kolom = 4;
					$posisi = 'Kiri';
				}
	
			}
			// kanan kolom 1
			$tkanan1 = $this->db->query("SELECT * FROM `siswa_denah_tempat_duduk` where `kanan1` = '$nis'");
			$adakanan = $tkanan1->num_rows();
			if($adakanan>0)
			{
				foreach($tkanan1->result() as $dkanan1)
				{
					$baris = $dkanan1->baris;
					$kolom = 1;
					$posisi = 'Kanan';
				}
	
			}
			// kanan kolom 2
			$tkanan2 = $this->db->query("SELECT * FROM `siswa_denah_tempat_duduk` where `kanan2` = '$nis'");
			$adakanan = $tkanan2->num_rows();
			if($adakanan>0)
			{
				foreach($tkanan2->result() as $dkanan2)
				{
					$baris = $dkanan2->baris;
					$kolom = 2;
					$posisi = 'Kanan';
				}
	
			}
			// kanan kolom 3
			$tkanan3 = $this->db->query("SELECT * FROM `siswa_denah_tempat_duduk` where `kanan3` = '$nis'");
			$adakanan = $tkanan3->num_rows();
			if($adakanan>0)
			{
				foreach($tkanan3->result() as $dkanan3)
				{
					$baris = $dkanan3->baris;
					$kolom = 3;	
					$posisi = 'Kanan';
				}

			}
			// kanan kolom 4
			$tkanan4 = $this->db->query("SELECT * FROM `siswa_denah_tempat_duduk` where `kanan4` = '$nis'");
			$adakanan = $tkanan4->num_rows();
			if($adakanan>0)
			{
				foreach($tkanan4->result() as $dkanan4)
				{
					$baris = $dkanan4->baris;
					$kolom = 4;	
					$posisi = 'Kanan';
				}

			}
			$kelassiswa = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->nis.'</td><td>'.$a->no_peserta.'</td><td>'.nis_ke_nama($a->nis).'</td><td>'.$kelassiswa.'</td>';
			echo '<td><select name="baris_'.$nomor.'" class="form-control" required>
				<option value="'.$baris.'">'.$baris.'</option>';
				$nobar = 1;
				do
				{
				echo '<option value="'.$nobar.'">'.$nobar.'</option>';				
				$nobar++;
				}
				while($nobar<7);
				echo '</select></td>';

			echo '<td><select name="kolom_'.$nomor.'" class="form-control" required>
				<option value="'.$kolom.'">'.$kolom.'</option>';
				$nokol = 1;
				do
				{
				echo '<option value="'.$nokol.'">'.$nokol.'</option>';				
				$nokol++;
				}
				while($nokol<5);
				echo '</select></td>';

			echo '<td><select name="posisi_'.$nomor.'" class="form-control" required>
				<option value="'.$posisi.'">'.$posisi.'</option>';
				echo '<option value="1">Kiri</option>';
				echo '<option value="2">Kanan</option>';
				echo '</select><input type="hidden" name="nis_'.$nomor.'" value="'.$nis.'"></td></tr>';
			$nomor++;
		}
		echo '</table><p class="text-center"><input name="cacahpeserta" type="hidden" value="'.$adata.'"><input name="ruang" type="hidden" value="'.$ruang.'"><input type="submit" value="Simpan Data Tempat Duduk" class="btn btn-primary"></p>
		</form>';
	}
	else
	{
		echo '<div class="alert alert-danger">Belum ada peserta di ruang ini</div>';
	}
}
?>
</div></div></div>
