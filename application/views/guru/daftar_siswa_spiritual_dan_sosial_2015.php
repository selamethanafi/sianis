<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: deskripsi_sikap_spiritual_sosial_antarmapel_2015.php
// Lokasi      		: application/views/guru/
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$bisadiproses = '1';
//cari guru yang belum mengirim nilai
$ta = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='T'");
$adata = $ta->num_rows();
if($adata > 0)
{
	$namaguru = '';
	foreach($ta->result() as $a)
	{
		$kodeguru = $a->kodeguru;
		if(empty($namaguru))
		{
			$namaguru .= '<strong>'.cari_nama_pegawai($kodeguru).'<strong>';
		}
		else
		{
			$namaguru .= ", <strong>".cari_nama_pegawai($kodeguru).'<strong>';
		}
	}
	echo '<div class="alert alert-danger">Guru berikut '.$namaguru.' belum mengirim nilai</div>';
}
$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by golongan,id_sikap_spiritual");
if($aksi == 'hitung')
{
	echo '<div class="alert alert-info">Klik Nomor urut siswa untuk mengubah nilai.<br />Bila nomor siswa tidak muncul, silakan perbarui daftar siswa<p>Baris 1 : Penilaian diri<br />Baris 2 : Penilaian antarteman<br />Baris 3 : Penilaian oleh guru<br />Baris 4 : Penilaian walikelas (nilai akhir)</div>';
}
else
{
	echo '<div class="alert alert-info">Klik Nomor urut siswa untuk mengubah nilai.</div>';
	echo '<div class="alert alert-warning">Hanya menampilkan penilaian oleh wali kelas <a href="'.base_url().'guru/daftarsiswa/'.$id_walikelas.'/spiritual/hitung" class="btn btn-info">Tampilkan penilaian dari guru dan siswa (memakan waktu lama)</a></div>';
}
echo '<div class="table-responsive"><table class="table table-hover table-bordered"><tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td>';
$itemke = 1;
foreach($tb->result() as $b)
{
	echo '<td><a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="'.$b->item.'"><span class="badge">'.substr($b->item,0,2).'</span></a>';
	$itemke++;
}
$cacahitem = $itemke - 1;		
echo '</tr>';
if(($aksi == 'hitung') or ($aksi == 'proseshitung'))
{
	$cacahkolom = $itemke - 1;
	$cacahkolom2 = $cacahkolom + 2;
	$nomor = 1;
	$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
	$cacahsemuasiswa = $query->num_rows()-1;
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		$td = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`='$nis'");
		$tt = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`!='$nis'");
		$cacahsiswa = $tt->num_rows();
		$tg = $this->db->query("select * from `nilai_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
		$cacahguru = $tg->num_rows();
		echo '<tr>';
		$tc = $this->db->query("select * from `nilai_akhlak` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='00'");
		$id_nilai_akhlak = '';
		foreach($tc->result() as $c)
		{
			$id_nilai_akhlak = $c->id_nilai_akhlak;
		}
		if(!empty($id_nilai_akhlak))
		{
			echo '<td align="center"><a href="'.base_url().'guru/ubahnilaiakhlakwk/'.$id_walikelas.'/'.$id_nilai_akhlak.'" class="btn btn-primary">'.$nomor.'</a></td><td>'.nis_ke_nama($nis).'</td>';
		}
		else
		{
			echo '<td align="center"><p class="text-warning">Perbarui daftar siswa</p></td><td>'.nis_ke_nama($nis).'</td>';
		}
		$noitem = 1;
		$skor = '';
		$simpulan = '';
		$simpulanguru = '';
		$simpulanwali = '';
		do
		{
			//nilai diri
			$iteme = 'i'.$noitem;
			$skor = 'D?';
			foreach($td->result() as $d)
			{
				$skor = $d->$iteme;
			}
			if(empty($skor))
			{
				$skor = 'D!';
			}
			//cari hasil teman
			$itemjumlah1 = 0;
			$itemjumlah2 = 0;
			$itemjumlah3 = 0;
			$itemjumlah4 = 0;
			foreach($tt->result() as $t)
			{
				if($t->$iteme == '1')
				{
					$itemjumlah1++; 			
				}
				if($t->$iteme == '2')
				{
					$itemjumlah2++; 			
				}
				if($t->$iteme == '3')
				{
					$itemjumlah3++; 			
				}
				if($t->$iteme == '4')
				{
					$itemjumlah4++; 			
				}
			}
			$simpulan = 'T?';
			$tertinggi = max($itemjumlah1,$itemjumlah2,$itemjumlah3,$itemjumlah4);
			if($tertinggi == $itemjumlah1)
			{
				$simpulan = 1;
			}
			if($tertinggi == $itemjumlah2)
			{
				$simpulan = 2;
			}
			if($tertinggi == $itemjumlah3)
			{
				$simpulan = 3;
			}
			if($tertinggi == $itemjumlah4)
			{
				$simpulan = 4;
			}
			if($tertinggi == 0)
			{
				$simpulan = '0';
			}
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
			if($noitem==12)
			{
				$itemeguru = 'i12';
			}
			if($noitem==13)
			{
				$itemeguru = 'i13';
			}
			if($noitem==14)
			{
				$itemeguru = 'i14';
			}
			if($noitem==15)
			{
				$itemeguru = 'i15';
			}
			if($noitem>15)
			{
				$itemeguru = 'i15';
			}
			$itemjumlahguru1 = 0;
			$itemjumlahguru2 = 0;
			$itemjumlahguru3 = 0;
			$itemjumlahguru4 = 0;
			foreach($tg->result() as $g)
			{
				if($g->$itemeguru == '1')
				{
					$itemjumlahguru1++; 			
				}
				if($g->$itemeguru == '2')
				{
					$itemjumlahguru2++; 			
				}
				if($g->$itemeguru == '3')
				{
					$itemjumlahguru3++; 			
				}
				if($g->$itemeguru == '4')
				{
					$itemjumlahguru4++; 			
				}
			}
			$simpulanguru = 'G?';
			$tertinggiguru = max($itemjumlahguru1,$itemjumlahguru2,$itemjumlahguru3,$itemjumlahguru4);
			if($tertinggiguru == $itemjumlahguru1)
			{
				$simpulanguru = 1;
			}
			if($tertinggiguru == $itemjumlahguru2)
			{
				$simpulanguru = 2;
			}
			if($tertinggiguru == $itemjumlahguru3)
			{
				$simpulanguru = 3;
			}
			if($tertinggiguru == $itemjumlahguru4)
			{
				$simpulanguru = 4;
			}
			if($tertinggiguru == 0)
			{
				$simpulanguru = '0';
			}
			//wali
			if($noitem == 1)
			{
				$itemewali = 'satu';
			}
			if($noitem == 2)
			{
				$itemewali = 'dua';
			}
			if($noitem == 3)
			{
				$itemewali = 'tiga';
			}
			if($noitem == 4)
			{
				$itemewali = 'empat';
			}
			if($noitem == 5)
			{
				$itemewali = 'lima';
			}
			if($noitem == 6)
			{
				$itemewali = 'enam';
			}
			if($noitem == 7)
			{
				$itemewali = 'tujuh';
			}
			if($noitem == 8)
			{
				$itemewali = 'delapan';
			}
			if($noitem == 9)
			{
				$itemewali = 'sembilan';
			}
			if($noitem == 10)
			{
				$itemewali = 'sepuluh';
			}
			if($noitem==11)
			{
				$itemewali = 'i11';
			}
			if($noitem==12)
			{
				$itemewali = 'i12';
			}
			if($noitem==13)
			{
				$itemewali = 'i13';
			}
			if($noitem==14)
			{
				$itemewali = 'i14';
			}
			if($noitem==15)
			{
				$itemewali = 'i15';
			}
			if($noitem>15)
			{
				$itemewali = 'i15';
			}
			$itemjumlahwali1 = 0;
			$itemjumlahwali2 = 0;
			$itemjumlahwali3 = 0;
			$itemjumlahwali4 = 0;
			foreach($tc->result() as $c)
			{
				if($c->$itemewali == '1')
				{
					$itemjumlahwali1++; 			
				}
				if($c->$itemewali == '2')
				{
					$itemjumlahwali2++; 			
				}
				if($c->$itemewali == '3')
				{
					$itemjumlahwali3++; 			
				}
				if($c->$itemewali == '4')
				{
					$itemjumlahwali4++; 			
				}
			}
			$simpulanwali = '';
			$tertinggiwali = max($itemjumlahwali1,$itemjumlahwali2,$itemjumlahwali3,$itemjumlahwali4);
			if($tertinggiwali == $itemjumlahwali1)
			{
				$simpulanwali = 1;
			}
			if($tertinggiwali == $itemjumlahwali2)
			{
				$simpulanwali = 2;
			}
			if($tertinggiwali == $itemjumlahwali3)
			{
				$simpulanwali = 3;
			}
			if($tertinggiwali == $itemjumlahwali4)
			{
				$simpulanwali = 4;
			}
			if($tertinggiwali == 0)
			{
				$simpulanwali = '?';
			}
			$simpulansistem = $simpulanwali;
			if($aksi == 'proseshitung')
			{
				$this->db->query("update `siswa_penilaian_diri_rekap` set `i$noitem` = '$simpulansistem' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'"); 
			}
			if(($simpulanwali == 1) or ($simpulanwali == 2) or ($simpulanwali == '?'))
			{
				$simpulanwali = '<div class="alert alert-danger">'.$simpulanwali.'</div>';
			}

			echo '<td align="center" valign="bottom">'.$skor.'<br />'.$simpulan.'<br />'.$simpulanguru.'<br /><strong>'.$simpulanwali.'</strong></td>';
			$noitem++;
		}
		while($noitem<=$cacahkolom);
		echo '</tr>';
		$nomor++;
	}
	if($aksi == 'proseshitung')
	{
		header('Location: '.base_url().'guru/daftarsiswa/'.$id_walikelas.'/proses');
	}
}
else
{
	$cacahkolom = $itemke - 1;
	$cacahkolom2 = $cacahkolom + 2;
	$nomor = 1;
	$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
	$cacahsemuasiswa = $query->num_rows()-1;
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		echo '<tr>';
		$tc = $this->db->query("select * from `nilai_akhlak` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='00'");
		$id_nilai_akhlak = '';
		foreach($tc->result() as $c)
		{
			$id_nilai_akhlak = $c->id_nilai_akhlak;
			if(!empty($id_nilai_akhlak))
			{
				echo '<td align="center"><a href="'.base_url().'guru/ubahnilaiakhlakwk/'.$id_walikelas.'/'.$id_nilai_akhlak.'" class="btn btn-primary">'.$nomor.'</a></td><td>'.nis_ke_nama($nis).'</td>';
			}
			else
			{
				echo '<td align="center"><p class="text-warning">Perbarui daftar siswa</p></td><td>'.nis_ke_nama($nis).'</td>';
				$bisadiproses = 0;
			}
			$noitem = 1;
			do
			{
				//nilai diri
				if($noitem<10)
				{
					$iteme = satuan($noitem);
				}
				elseif($noitem==10)
				{
					$iteme = 'sepuluh';
				}
				else
				{
					$iteme = 'i'.$noitem;
				}
				$simpulanwali = $c->$iteme;
				echo '<td align="center" valign="bottom"><strong>'.$simpulanwali.'</strong></td>';
				$noitem++;
			}
			while($noitem<=$cacahkolom);
			echo '</tr>';
		}
		$nomor++;
	}
	$cacahekolom = $cacahkolom-1; 
}
echo '</table></div>';
echo form_open('guru/perbaruidaftarsiswaakhlak');
?>
<input type="hidden" name="cacahitem" value="<?php $cacahitem;?>">
<input type="hidden" name="kodewali" value="00">
<input type="hidden" name="id_mapel" value="<?php echo $id_walikelas;?>">
<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
<input type="hidden" name="semester" value="<?php echo $semester;?>"><p></p><p class="text-center">
<button type="submit" class="btn btn-primary">Perbarui Daftar Siswa (Semua nilai menjadi 3) </button> 
<?php
	if($bisadiproses == 1)
	{
		?>
		<a href="<?php echo base_url();?>guru/daftarsiswa/<?php echo $id_walikelas;?>/spiritual/proseshitung" class="btn btn-info">PROSES DESKRIPSI</a>
	<?php
	}
	?>
	</p>
</form>
</div></div></div>
