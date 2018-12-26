<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: daftar_nilai_akhlak.php
// Terakhir diperbarui	: Kam 12 Mei 2016 07:34:41 WIB 
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
<?php
if($kurikulum == '2013')
{
	echo '<div class="container-fluid"><h2>Modul Penilaian Sikap Spiritual dan Sosial</h2>';
}
elseif($kurikulum == '2015')
{
	echo '<div class="container-fluid"><h2>Modul Penilaian Sikap Spiritual dan Sosial</h2>';
}
else
{
	echo '<div class="container-fluid"><h2>Modul Nilai Kepribadian dan Akhlak Mulia</h2>';
}
$tc = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `kodeguru`='$kodeguru'");
$adatc = $tc->num_rows();
if($adatc == 0)
{
	echo '<div class="alert alert-danger">Galat, data guru tidak sesuai</div>';
}
else
{
	if($kirim=='kirimulang')
	{
		echo '<div class="alert alert-success">Berhasil mengirim ulang</div>';
	}
	$te = $this->db->query("select * from `nilai_akhlak` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	$adate = $te->num_rows();
	?>
	<a href="<?php echo base_url(); ?>guru/nilaiakhlak/" class="btn btn-info" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Kembali</a>
	<div class="table-responsive">
	<table class="table">
		<tr><td width="40%"><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
		<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
		<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
		<tr><td><strong>Kurikulum</strong></td><td>: <strong><?php echo $kurikulum;?></strong></td></tr>
	</table>
	</div>
	<div class="alert alert-info">
		4 = Amat Baik / Selalu, 3 = Baik / Sering, 2 = Cukup / Kadang- kadang, 1 = Kurang / Jarang / tidak pernah, klik nomor urut siswa untuk mengubah nilai, atau judul kolom untuk mengubah nilai tiap kolom.
	</div>
	<?php
	$adaitem = 0;
	if ((!empty($id_mapel)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
	{
		$tf = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `kodeguru`='$kodeguru'");
		$status = '';
		foreach($tf->result() as $f)
		{
			$status = $f->status;
		}
		$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by id_sikap_spiritual");
		if(count($tb->result())>0)
		{
			$adaitem = 1;
			$itemke = 1;
			foreach($tb->result() as $b)
			{
				$des[$itemke] = $b->item;
				$itemke++;
			}
		}
		echo '<div class="alert alert-info">Jika nomor urut siswa tidak muncul, silakan perbarui daftar siswa.</div>';
		echo form_open('guru/perbaruidaftarsiswaakhlak');
		if($adate>0)
		{
			echo '<div class="table-responsive">
			<table class="table table-hover table-bordered">
			<tr align="center"><td width="30"><strong>No.</strong></td><td ><strong>Nama</strong></td>';
			if ($kurikulum == '')
			{
				echo '<td><strong>Kedisiplinan</strong></td><td><strong>Kebersihan</strong></td><td><strong>Kesehatan</strong></td><td><strong>Tanggung jawab</strong></td><td><strong>Sopan santun</strong></td><td><strong>Percaya diri</strong></td><td><strong>Kompetitif</strong></td><td><strong>Hubungan Sosial</strong></td><td><strong>Kejujuran</strong></td><td><strong>Ibadah ritual</strong></td></tr>';
				$cacahkolom = 11;
			}
			elseif($kurikulum == 'KTSP')
			{
				echo '<td><strong>Kedisiplinan</strong></td><td><strong>Kebersihan</strong></td><td><strong>Kesehatan</strong></td><td><strong>Tanggung jawab</strong></td><td><strong>Sopan santun</strong></td><td><strong>Percaya diri</strong></td><td><strong>Kompetitif</strong></td><td><strong>Hubungan Sosial</strong></td><td><strong>Kejujuran</strong></td><td><strong>Ibadah ritual</strong></td></tr>';
				$cacahkolom = 11;
			}
			else
			{
				$itemke = 1;
				foreach($tb->result() as $b)
				{
					echo '<td><a href="'.base_url().'guru/ubahnilaiakhlakkolom/'.$id_mapel.'/'.$itemke.'" title="Info" data-toggle="popover" data-trigger="hover" data-content="'.$b->item.'"><span class="badge">'.substr($b->item,0,2).'</span></a></td>';
					$itemke++;
				}		
				echo '</tr>';
				$cacahkolom = $itemke;
			}
			$nomor=1;
			$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
			$cacahsemuasiswa = $query->num_rows()-1;
			if(count($query->result())>0)
			{
				foreach($query->result() as $t)
				{
					$nis = $t->nis;
					echo '<tr>';
					$ta = $this->db->query("select * from `nilai_akhlak` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
					$id_nilai_akhlak = '';
					foreach($ta->result() as $a)
					{
						$id_nilai_akhlak = $a->id_nilai_akhlak;
					}
					if(!empty($id_nilai_akhlak))
					{
						echo '<td align="center"><a href="'.base_url().'guru/ubahnilaiakhlak/'.$id_mapel.'/'.$id_nilai_akhlak.'" class="btn btn-primary">'.$nomor.'</a></td><td>'.nis_ke_nama($nis).'</td>';
					}
					else
					{
						echo '<td align="center"><div class="alert alert-info">Perbarui daftar siswa</div></td><td>'.nis_ke_nama($nis).'</td>';
					}
					$noitem = 1;
					foreach($ta->result() as $a)
					{
						do
						{
							if($noitem == 1)
							{
							$itemeguru = 'satu';
							}
							if($noitem == 2)
							{
							$itemeguru = 'dua';
							}
							if($noitem == 3)
							{
								$itemeguru = 'tiga';
							}
							if($noitem == 4)
							{
							$itemeguru = 'empat';
							}
							if($noitem == 5)
							{
							$itemeguru = 'lima';
							}
							if($noitem == 6)
							{
								$itemeguru = 'enam';
							}
							if($noitem == 7)
							{
							$itemeguru = 'tujuh';
							}
							if($noitem == 8)
							{
								$itemeguru = 'delapan';
							}
							if($noitem == 9)
							{
								$itemeguru = 'sembilan';
								}
							if($noitem == 10)
							{
							$itemeguru = 'sepuluh';
							}
							if($noitem>10)
							{
								$itemeguru = 'sepuluh';
							}
							if($noitem==11)
							{
								$itemeguru = 'i11';
							}
							if($noitem == 12)
							{
								$itemeguru = 'i12';
							}
							if($noitem == 13)
							{
								$itemeguru = 'i13';
							}
							if($noitem ==14)
							{
								$itemeguru = 'i14';
							}
							if($noitem == 15)
							{
								$itemeguru = 'i15';
							}
							if($noitem>15)
							{
								$itemeguru = 'i15';
							}
							$skor = '?';
							$skor = $a->$itemeguru;
							if($skor == 4)
							{
								$skor = 'A';
							}
							elseif($skor == 3)
							{
								$skor = 'B';
							}
							elseif($skor == 2)
							{
								$skor = '<div class="alert alert-danger">C</div>';
							}
							else
							{
								$skor = '<div class="alert alert-danger">K</div>';
							}
							echo '<td align="center">'.$skor.'</td>';
							$noitem++;
						}
						while($noitem<$cacahkolom);


					}
					$nomor++;
				}
			}
			$cacahekolom = $cacahkolom-1; 
			echo '</table></div>';
		} // kalau ada siswa
		if($kirim == 'kirim')
		{
		$this->db->query("update m_akhlak set status='Y' where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and kodeguru='$kodeguru'");
		$status = 'Y';
		}
	}
}
?>
<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
<input type="hidden" name="semester" value="<?php echo $semester;?>"><p></p>
<p class="text-center">
<?php
if($adate>0)
{
	if($status == 'Y')
	{?>
		<a href="<?php echo base_url(); ?>guru/daftarnilaiakhlak/<?php echo $id_mapel;?>/kirimulang" class="btn btn-info" role="button"><strong><span class="glyphicon glyphicon-export"></span> Kirim Ulang ke Rapor</strong></a>
	<?php
	}else
	{?>
		 <a href="<?php echo base_url(); ?>guru/daftarnilaiakhlak/<?php echo $id_mapel;?>/kirim" class="btn btn-info" role="button"><strong><span class="glyphicon glyphicon-export"></span> Kirim ke Rapor</strong></a>
	<?php
	}

?>
<a href="<?php echo base_url(); ?>guru/formmencetak" class="btn btn-info" role="button"><span class="glyphicon glyphicon-print"></span> <b> Daftar Nilai</b></a>
<?php
}
?>
<button type="submit" class="btn btn-primary">Perbarui Daftar Siswa (Semua nilai berubah menjadi Baik)</button></p>
</form>
</div>
