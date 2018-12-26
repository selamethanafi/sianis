<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_ijazah.php
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
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$thnajaran = $tahun1.'/'.$tahun2;
$xloc = base_url().'pengajaran/tampillegerijazah';
if((empty($tahun1)) or (empty($tahun2)))
{

	echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value="'.$xloc.'"></option>';
	$ta = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.$a->thnajaran.'">'.$a->thnajaran.'</option>';
	}

	
}
elseif(empty($id_kelas))
{
	$tb = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'XII-%'");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'"></option>';
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$xloc.'/'.$thnajaran.'/'.$b->id_walikelas.'">'.$b->kelas.'</option>';
	}

	
}
else
{
	$thnajaran = $tahun1.'/'.$tahun2;
	if($thnajaran == '2017/2018')
	{
		$tb = $this->db->query("select * from `m_walikelas` where `id_walikelas` = '$id_kelas'");
		$kelas = '';
		foreach($tb->result() as $b)
		{
			$kelas = $b->kelas;
		}
		$tf = $this->db->query("select * from `m_ruang` where `ruang` like '$kelas'");
		$jurusan = '';
		foreach($tf->result() as $f)
		{
			$jurusan = $f->program;
		}
		$tc = $this->db->query("select * from `m_mapel_ijazah` where thnajaran='$thnajaran' and `jurusan` = '$jurusan' order by `no_urut`");
		if($tc->num_rows() > 0)
		{
			echo '<h2>'.$kelas.'</h2>';
			echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr  align="center"><td>Nomor</td><td>NIS</td><td>Nama</td>';
			foreach($tc->result() as $c)
			{
				echo '<td width="100">'.$c->mapel.'</td>';
			}
			echo '</tr>';
			$nomor = 1;
			$tb = $this->db->query("select * from siswa_kelas where `thnajaran`='$thnajaran' and `kelas`= '$kelas' and status='Y' and `semester`='2' order by no_urut ASC");
			foreach($tb->result() as $b)
			{
				$nis = $b->nis;
				echo '<tr><td  align="center">'.$nomor.'</td><td  align="center">'.$nis.'</td><td>'.nis_ke_nama($nis).'</td>';
				foreach($tc->result() as $c)
				{
					$mapel = $c->mapel;
					$no_urut = $c->no_urut;
					$td = $this->db->query("select * from `leger_ijazah` where `nis`='$nis'");
					$nilai = 0;
					foreach($td->result() as $d)
					{
						$field = 'r'.$no_urut;
						echo '<td align="center">'.$d->$field.'</td>';
					}
				}
				$nomor++;
				echo '</tr>';
			}
			echo '</table></div>';
		}
	}
	else
	{
		echo '<p><a href="'.base_url().'pengajaran/legerijazah/'.$thnajaran.'" class="btn btn-primary">Proses Ulang</a></p>';
		$te = $this->db->query("select * from `m_program`");
		foreach($te->result() as $e)
		{
			$jurusan = $e->program;
			$tf = $this->db->query("select * from `m_ruang` where `program`='$jurusan' and `ruang` like 'XII-%'");
			foreach($tf->result() as $f)
			{
				$kelas = $f->ruang;
				$tc = $this->db->query("select * from `m_mapel_ijazah` where thnajaran='$thnajaran' and `jurusan` = '$jurusan' order by `no_urut`");
				if($tc->num_rows() > 0)
				{
					echo '<h2>'.$kelas.'</h2>';
					echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr  align="center"><td rowspan="2">Nomor</td><td rowspan="2">NIS</td><td rowspan="2">Nama</td>';
					foreach($tc->result() as $c)
					{
						echo '<td width="100" colspan="2">'.$c->mapel.'</td>';
					}
					echo '</tr>';
					foreach($tc->result() as $c)
					{
						echo '<td align="center">Rapor</td><td  align="center">UM</td>';
					}
					echo '</tr>';
					$nomor = 1;
					$tb = $this->db->query("select * from siswa_kelas where `thnajaran`='$thnajaran' and `kelas`= '$kelas' and status='Y' and `semester`='2' order by no_urut ASC");
					foreach($tb->result() as $b)
					{
						$nis = $b->nis;
						echo '<tr><td  align="center">'.$nomor.'</td><td  align="center">'.$nis.'</td><td>'.nis_ke_nama($nis).'</td>';
						foreach($tc->result() as $c)
						{
							$mapel = $c->mapel;
							$no_urut = $c->no_urut;
							$td = $this->db->query("select * from `leger_ijazah` where `nis`='$nis'");
							$nilai = 0;
							foreach($td->result() as $d)
							{
								$field = 'r'.$no_urut;
								echo '<td align="center">'.$d->$field.'</td>';
								$nilai_ujian = '';
								$tg = $this->db->query("select * from `nilai_ujian` where `nis`='$nis' and `mapel`='$mapel'");
								foreach($tg->result() as $g)
								{
									$nilai_ujian = $g->nilai;
								}
								echo '<td align="center">'.$nilai_ujian.'</td>';
							}
						}
						$nomor++;
						echo '</tr>';
					}
					echo '</table></div>';
				} //ada data
			} //tabel ruang
		} // jurusan
	} // sebelum 2017/2018
}
?>
</div></div></div>
