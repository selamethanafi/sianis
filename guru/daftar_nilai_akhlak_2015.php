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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by golongan,id_sikap_spiritual");
$adatb = $tb->num_rows();
			$itemke = 1;
			foreach($tb->result() as $b)
			{
				$des[$itemke] = $b->item;
				$itemke++;
			}
$cacahitem = $itemke - 1;
$tc = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `kodeguru`='$kodeguru'");
$adatc = $tc->num_rows();
if($adatc == 0)
{
	echo '<div class="alert alert-danger">Galat, data guru tidak sesuai</div>';
}
elseif($adatb == 0)
{
	echo '<div class="alert alert-danger">Galat, belum ada kriteria penilaian sikap spiritual dan sosial, hubungi BP</div>';
}
else
{
	if($kirim == 'kirim')
	{
		echo '<div class="alert alert-success">Nilai berhasil dikirim.</div>';
	}
	if($kirim == 'kirimulang')
	{
		echo '<div class="alert alert-success">Nilai berhasil dikirim ulang.</div>';
	}

	$te = $this->db->query("select * from `nilai_akhlak` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	$adate = $te->num_rows();
	?>
	<a href="<?php echo base_url(); ?>guru/nilaiakhlak/" class="btn btn-info" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Kembali</a>
	<div class="table-responsive">
	<table>
		<tr><td width="350"><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
		<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
		<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
		<tr><td><strong>Kurikulum</strong></td><td>: <strong><?php echo $kurikulum;?></strong></td></tr>
	</table>
	</div>
	<p>
		4 = Amat Baik / Selalu, 3 = Baik / Sering, 2 = Cukup / Kadang- kadang, 1 = Kurang / Jarang / tidak pernah, klik nomor urut siswa untuk mengubah nilai, atau judul kolom untuk mengubah nilai tiap kolom.
	</p>
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
		$tf = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
		$cacahsemuaguru = $tf->num_rows();
			$adaitem = 1;
			echo '<div class="alert alert-info">Jika nomor urut siswa tidak muncul, silakan perbarui daftar siswa.</div>
	<p class="text-info">Untuk menilai, klik nomor urut siswa atau judul kolom</p>';
				$itemke = 1;
			if($adate>0)
			{
			echo '<div class="table-responsive">
			<table class="table table-hover table-bordered">
			<tr align="center"><td width="30"><strong>No.</strong></td><td ><strong>Nama</strong></td>';

			foreach($tb->result() as $b)
			{
				echo '<td><a href="'.base_url().'guru/ubahnilaiakhlakkolom/'.$id_mapel.'/'.$itemke.'" title="Aspek yang dinilai" data-toggle="popover" data-trigger="hover" data-content="'.$b->item.'"><span class="badge">'.substr($b->item,0,2).'</span></a></td>';
//				echo '<td><a href="'.base_url().'guru/ubahnilaiakhlakkolom/'.$id_mapel.'/'.$itemke.'" title="'.$b->item.'"><strong>'.substr($b->item,0,2).'</strong></a></td>';
				$itemke++;
			}		
			echo '</tr>';
			$cacahkolom = $itemke;
			$nomor=1;
			$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
			$cacahsemuasiswa = $query->num_rows()-1;
			if(count($query->result())>0)
			{
				foreach($query->result() as $t)
				{
					$nis = $t->nis;
					$td = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`='$nis'");
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
						echo '<td align="center"></td><td>'.nis_ke_nama($nis).'</td>';
					}
					$noitem = 1;
					do
					{
						//nilai diri
						//guru
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
						foreach($ta->result() as $a)
						{
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
	
						}
						echo '<td align="center" valign="bottom">'.$skor.'</td>';
						$noitem++;
					}
					while($noitem<$cacahkolom);
					echo '</tr>';
					$nomor++;
				}
				echo '</table></div>';
			} // kalau ada siswa
		}
	if($kirim == 'kirim')
	{
		$this->db->query("update m_akhlak set status='Y' where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and kodeguru='$kodeguru'");
		$status = 'Y';
	}
}
echo '<p class="text-center">';
if($adate > 0)
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
echo '<a href="'.base_url().'gurukeren/perbaruidaftarsiswaakhlak/'.$id_mapel.'/'.$cacahitem.'/0" class="btn btn-primary">PERBARUI DAFTAR SISWA</a>';
?>
</p>
</form>
<?php
}
?>
</div></div></div>
