<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 06 Jan 2016 11:51:19 WIB 
// Nama Berkas 		: penilaian_diri.php
// Lokasi      		: application/views/siswa/
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
if((empty($tahun1)) or (empty($semester)))
{
	$tb = $this->db->query("select * from `siswa_kelas` where `nis`='$penilai' order by `thnajaran`, `semester`");
	echo '<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Aksi</strong></td></tr>';
	$nomor =1;
	foreach($tb->result() as $b)
	{
		$tahun1 = substr($b->thnajaran,0,4);
		$semester = $b->semester;
		echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$b->thnajaran.'</td><td align="center">'.$semester.'</td><td align="center"><a href="'.base_url().'siswa/penilaianantarteman/'.$tahun1.'/'.$semester.'" title="Melihat / Mengubah Nilai Diri Semester '.$semester.' Tahun '.$b->thnajaran.'"><span class="fa fa-edit"></span></a></td></tr>';
		$nomor++;
	}
	echo '</table>';
}
elseif(empty($teman))
{
	echo '<h4>Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'</h4>';
	echo '<p><a href="'.base_url().'siswa/penilaianantarteman" class="btn btn-info">Batal</a></p>';
	$kelas = nis_ke_kelas_thnajaran_semester($penilai,$thnajaran,$semester);
	$td = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
	echo '<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Aksi</strong></td></tr>';
	$nomor =1;
	foreach($td->result() as $d)
	{
		$nisteman = $d->nis;
		if($nisteman != $penilai)
		{
		$namateman = nis_ke_nama($nisteman);
		echo '<tr><td align="center">'.$nomor.'</td><td>'.$namateman.'</td><td align="center"><a href="'.base_url().'siswa/penilaianantarteman/'.$tahun1.'/'.$semester.'/'.$nisteman.'/ubah" title="Melihat / Mengubah Penilaian Diri '.$namateman.' Semester '.$semester.' Tahun '.$thnajaran.'"><span class="fa fa-edit"></span></a></td></tr>';
		$nomor++;
		}
	}
	echo '</table>';
}

else
{
	//cek apakah teman sekelas
	$kelaspenilai = '';
	$kelasteman = '?';
	$tf = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$penilai'");
	foreach($tf->result() as $f)
	{
		$kelaspenilai = $f->kelas;
	}
	$tg = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$teman'");
	foreach($tg->result() as $g)
	{
		$kelasteman = $g->kelas;
	}
	if(($kelaspenilai == $kelasteman) and ($penilai != $teman))
	{
		if($aksi == 'ubah')
		{
			$namateman = nis_ke_nama($teman);
			echo 'Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'<br />';
			echo '<h4>Nama Teman : '.$namateman.'</h4>';
			$tahun1 = substr($thnajaran,0,4);
			$ta = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' ORDER BY `golongan` , `id_sikap_spiritual` ");
			$adata = $ta->num_rows();
			if($adata>0)
			{
				$tc = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$teman' and `penilai`='$penilai'");
				$adatc = $tc->num_rows();
				if($adatc == 0)
				{
				$this->db->query("insert into `siswa_penilaian_diri` (`thnajaran`,`semester`,`nis`,`penilai`) values ('$thnajaran','$semester','$teman','$penilai')");
				}
				echo form_open('siswa/penilaianantarteman/'.$tahun1.'/'.$semester.'/'.$teman);
				$nomor =1;
				echo '<table class="table table-striped table-hover table-bordered"><tr bgcolor="#FFF" align="center"><td><strong>No.</strong></td><td><strong>Aspek yang diamati</strong></td><td><strong>Pilihan</strong></td></tr>';
				foreach($ta->result() as $a)
				{
					//cari nilai
					$tc = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$teman' and `penilai`='$penilai'");
					$iteme = 'i'.$nomor;
					$skor = '';
					foreach($tc->result() as $c)
					{
						$skor = $c->$iteme;
					}
					echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->item.'</td>';
					echo '<td align="center"><select name="skor_'.$nomor.'" class="form-control">';
					if($skor == 4)
						{echo '<option value="4">Selalu</option><option value="3">Sering</option><option value="2">kadang - kadang</option><option value="1">Jarang / tidak pernah</option>';}
					elseif($skor == 3)
						{echo '<option value="3">Sering</option><option value="4">Selalu</option><option value="2">kadang - kadang</option><option value="1">Jarang / tidak pernah</option>';}
					elseif($skor == 2)
						{echo '<option value="2">kadang - kadang</option><option value="4">Selalu</option><option value="3">Sering</option><option value="1">Jarang / tidak pernah</option>';}
					elseif($skor == 1)
						{echo '<option value="1">Jarang / tidak pernah</option><option value="4">Selalu</option><option value="3">Sering</option><option value="2">kadang - kadang</option>';}
					else
						{echo '<option value=""></option><option value="4">Selalu</option><option value="3">Sering</option><option value="2">kadang - kadang</option><option value="1">Jarang / tidak pernah</option>';}
					echo '</select></td></tr>';
					$nomor++;
				}
				$cacah = $nomor - 1;
				echo '</table><p class="text-center"><input type="hidden" name="cacah" value="'.$cacah.'"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().'siswa/penilaianantarteman" class="btn btn-info">Batal</a></p>';
				echo '</form>';
			}
			else
			{
			echo '<div class="alert alert-warning">Belum ada Aspek yand diamati silakan menghubungi wali, pengajaran, atau waka kurikulum. <a href="'.base_url().'siswa/penilaianantarteman">Batal</a></div>';
			}
		} // KALAU UBAH
		else
		{
			$namateman = nis_ke_nama($teman);
			echo 'Tahun Pelajaran '.$thnajaran.' Semester '.$semester.'<br />';
			echo '<h4>Nama Teman : '.$namateman.'</h4>';
			$tahun1 = substr($thnajaran,0,4);
			$ta = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' ORDER BY `golongan` , `id_sikap_spiritual` ");
			$adata = $ta->num_rows();
			if($adata>0)
			{
				$nomor =1;
				echo '<p><a href="'.base_url().'siswa/penilaianantarteman/'.$tahun1.'/'.$semester.'/'.$teman.'/ubah" title="Mengubah Nilai Diri Semester '.$semester.' Tahun '.$thnajaran.'" class="btn btn-info">Ubah</a> atau <a href="'.base_url().'siswa/penilaianantarteman/'.$tahun1.'/'.$semester.'" title="Mengubah Nilai Diri Semester '.$semester.' Tahun '.$thnajaran.'" class="btn btn-info">Teman Lain</a></p>';

				echo '<table class="table table-striped table-hover table-bordered"><tr bgcolor="#FFF" align="center"><td rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>Aspek yang diamati</strong></td><td colspan="4"><strong>Check List</strong></td></tr><tralign="center"><td><strong>1</strong></td><td><strong>2</strong></td><td><strong>3</strong></td><td><strong>4</strong></td></tr>';
				foreach($ta->result() as $a)
				{
					//cari nilai
					$tc = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$teman' and `penilai`='$penilai'");
					$iteme = 'i'.$nomor;
					$skor = '';
					foreach($tc->result() as $c)
					{
						$skor = $c->$iteme;
					}
					echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->item.'</td>';
					if($skor == 4)
						{echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td>';}
					elseif($skor == 3)
						{echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td>';}
					elseif($skor == 2)
						{echo '<td align="center" width="40"></td><td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td>';}
					elseif($skor == 1)
						{echo '<td align="center" width="40"><img src="'.base_url().'images/centang.png" alt="V" border="0"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';}
					else
						{echo '<td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td><td align="center" width="40"></td>';}
					echo '</tr>';
					$nomor++;
				}
				echo '</table>';
				echo '<p><a href="'.base_url().'index.php/siswa/penilaianantarteman/'.$tahun1.'/'.$semester.'/'.$teman.'/ubah" title="Mengubah Nilai Diri Semester '.$semester.' Tahun '.$thnajaran.'" class="btn btn-info">Ubah</a> atau <a href="'.base_url().'index.php/siswa/penilaianantarteman/'.$tahun1.'/'.$semester.'" title="Mengubah Nilai Diri Semester '.$semester.' Tahun '.$thnajaran.'" class="btn btn-info">Teman Lain</a><br />';

			}
			else
			{
				echo '<div class="alert alert-warning">Belum ada Aspek yand diamati silakan menghubungi wali, pengajaran, atau waka kurikulum. <a href="'.base_url().'siswa/penilaianantarteman">Batal</a></div>';
			}			

		} // KALAU MELIHAT
	} // AKHIR KALAU TEMAN SEKELAS
	else
	{
			echo 'Anda dan teman bukan teman sekelas<br >';
	}
}

echo '</div></div></div>';
