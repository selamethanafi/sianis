<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?><div class="container-fluid">
<?php
$xloc = base_url().'pengajaran/periksanilairapor';
?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$tahun2= $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;

echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	if (!empty($tahun1))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'" title="Ganti Tahun Pelajaran">Tahun Pelajaran</a></label></div><div class="col-sm-9"><select name="tahun1" class="form-control">';
		echo "<option value='".$tahun1."'>".$thnajaran."</option>";
		echo '</select></div></div>';
	}
	if (!empty($semester))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'/'.$tahun1.'" title="Ganti Semester">Semester</a></label></div><div class="col-sm-9"><select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option></select></div></div>';
	}

if(empty($tahun1))
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
		foreach($daftar_tapel->result() as $k)
		{
			echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
		}
		echo '</select></div></div>';
	}
	elseif(empty($semester))
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		if($semester == 1)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
		}
		elseif($semester == 2)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
		}
		else
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
		}

		echo '</select></div></div>';
	}
	else
	{
		$ta = $this->db->query("select `kd`, `nama_tanpa_gelar` from `p_pegawai` where `guru`='Y' and `status`='Y' order by `nama_tanpa_gelar`");
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Guru</label></div><div class="col-sm-9">
		<select name="kodeguru" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$kodeguru.'">'.cari_nama_pegawai($kodeguru).'</option>';
		foreach($ta->result() as $a)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->kd.'">'.$a->nama_tanpa_gelar.'</option>';
		}
		echo '</select></div></div>';
	}
	if((!empty($thnajaran)) and (!empty($semester)) and (!empty($kodeguru)))
	{
		$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' order by `kelas`, `mapel`");
		if($tb->num_rows()==0)
		{
			echo '<div class="alert alert-warning">Ybs. tidak mendapat tugas mengajar</div>';
		}
		else
		{
			foreach($tb->result() as $b)
			{
				$id_mapel = $b->id_mapel;
				$mapel = $b->mapel;
				$kelas = $b->kelas;
				$ranah = $b->ranah;
				$kkm = $b->kkm;
				$jenis_deskripsi = $b->jenis_deskripsi;
				if($jenis_deskripsi== 1)
				{
					$jenis_deskripsine = 'Berdasarkan Ulangan (Deskripsi Otomatis)';
				}
				elseif($jenis_deskripsi== 5)
				{
					$jenis_deskripsine = 'Berdasarkan Nilai Rapor (Deskripsi Otomatis)';
				}
				elseif($jenis_deskripsi== 3)
				{
					$jenis_deskripsine = 'Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)';
				}
				elseif($jenis_deskripsi== 4)
				{
					$jenis_deskripsine = 'Berdasar bank deskripsi';
				}
				elseif($jenis_deskripsi== 6)
				{
					$jenis_deskripsine = $this->config->item('versi_deskripsi');
				}
				else
				{
					$jenis_deskripsine = 'Kopi Paste / Manual';
				}
				$te = $this->db->query("SELECT * FROM `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y'");
			$cacahsiswa = $te->num_rows();
				echo '<h4>'.$mapel.' | '.$kelas.' | '.$ranah.' | '.$kkm.' | Jenis Deskripsi '.$jenis_deskripsine.'</h4>';
				$tc = $this->db->query("select `nis`, `thnajaran`, `semester`, `mapel`, `kog`, `psi`, `afektif`, `deskripsi`, `keterangan`, `ket_akhir`, `status`, `kunci` from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel' and `status`='Y' order by `no_urut`");
				$cacahnilai = $tc->num_rows();
				$nomor = 1;
				echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>NIS</td><td>Nama</td>';
				if($ranah == 'KA')
				{
					echo '<td>Pengetahuan<br />Deskripsi</td><td>Sikap<br />Deskripsi</td>';
				}
				elseif($ranah == 'KPA')
				{
					echo '<td>Pengetahuan<br />Deskripsi</td><td>Keterampilan<br />Deskripsi</td><td>Sikap<br />Deskripsi</td>';
				}
				elseif($ranah == 'PA')
				{
					echo '<td>Pengetahuan<br />Deskripsi</td><td>Sikap<br />Deskripsi</td>';

				}
				elseif($ranah == 'KP')
				{
					echo '<td>Pengetahuan<br />Deskripsi</td><td>Keterampilan<br />Deskripsi</td>';
				}
				else
				{
					echo '<td>Ranah?</td><td>Ranah?</td><td>Ranah?</td>';
				}
				echo '<td>Tuntas</td><td>Terkunci</td></tr>';
				$cacahtuntas = 0;
				$cacahbelumtuntas = 0;
				$cacahkunci = 0;
				$tidaksesuai = 0;
				foreach($tc->result() as $c)
				{
					$nis = $c->nis;
					$status = substr($c->ket_akhir,0,5);
					$statuse = 'Belum';
					$k = '0';
					$p = 0;
					$s = 0;
					$ket_sikap = '';
					echo '<td>'.$nomor.'</td><td>'.$nis.'</td><td>'.nis_ke_nama($nis).'</td>';
					if($ranah == 'KPA')
					{
						$td = $this->db->query("select `nis`, `thnajaran`, `semester`, `mapel`, `deskripsi` from `afektif` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
						foreach($td->result() as $d)
						{
							$ket_sikap = $d->deskripsi;
						}

						echo '<td>';
						if($c->kog<$kkm)
						{
							echo '<p class="text-danger">'.$c->kog.'</p>';
						}
						else
						{
							$k = 1;							
							echo '<p class="text-success">'.$c->kog.'</p>';
						}
						echo $c->keterangan.'</td><td>';
						if($c->psi<$kkm)
						{
							echo '<p class="text-danger">'.$c->psi.'</p>';
						}
						else
						{
							$p = 1;
							echo '<p class="text-success">'.$c->psi.'</p>';
						}
						echo $c->deskripsi.'</td>';
						if(($c->afektif == 'AB') or ($c->afektif == 'A') or ($c->afektif == 'SB') or ($c->afektif == 'B'))
						{
							$s = 1;
							echo '<td><p class="text-success">'.$c->afektif.'</p>'.$ket_sikap.'</td>';
						}
						else
						{
							echo '<td><p class="text-danger">'.$c->afektif.'</p>'.$ket_sikap.'</td>';
						}
					}
					elseif($ranah == 'KA')
					{
						$td = $this->db->query("select `nis`, `thnajaran`, `semester`, `mapel`, `deskripsi` from `afektif` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
						foreach($td->result() as $d)
						{
							$ket_sikap = $d->deskripsi;
						}

						$p = 1;
						echo '<td>';
						if($c->kog<$kkm)
						{
							echo '<p class="text-danger">'.$c->kog.'</p>';
						}
						else
						{
							$k = 1;
							echo '<p class="text-success">'.$c->kog.'</p>';
						}
						echo '</td><td>';
						if(($c->afektif == 'AB') or ($c->afektif == 'A') or ($c->afektif == 'SB') or ($c->afektif == 'B'))
						{
							$s = 1;
							echo '<td><p class="text-success">'.$c->afektif.'</p>'.$ket_sikap.'</td>';
						}
						else
						{
							echo '<td><p class="text-danger">'.$c->afektif.'</p>'.$ket_sikap.'</td>';
						}
					}
					elseif($ranah == 'PA')
					{
						$td = $this->db->query("select `nis`, `thnajaran`, `semester`, `mapel`, `deskripsi` from `afektif` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
						foreach($td->result() as $d)
						{
							$ket_sikap = $d->deskripsi;
						}

						$k =1;
						echo '<td>';
						if($c->psi<$kkm)
						{
							echo '<p class="text-danger">'.$c->psi.'</p>';
						}
						else
						{
							$p = 1;
							echo '<p class="text-success">'.$c->psi.'</p>';
						}
						echo $c->deskripsi.'</td>';
						if(($c->afektif == 'AB') or ($c->afektif == 'A') or ($c->afektif == 'SB') or ($c->afektif == 'B'))
						{
							$s= 1;
							echo '<td><p class="text-success">'.$c->afektif.'</p>'.$ket_sikap.'</td>';
						}
						else
						{
							echo '<td><p class="text-danger">'.$c->afektif.'</p>'.$ket_sikap.'</td>';
						}
					}
					elseif($ranah == 'KP')
					{
						$s=1;
						echo '<td>';
						if($c->kog<$kkm)
						{
							echo '<p class="text-danger">'.$c->kog.'</p>';
						}
						else
						{
							$k = 1;
							echo '<p class="text-success">'.$c->kog.'</p>';
						}
						echo $c->keterangan.'</td><td>';
						if($c->psi<$kkm)
						{
							echo '<p class="text-danger">'.$c->psi.'</p>';
						}
						else
						{
							$p = 1;
							echo '<p class="text-success">'.$c->psi.'</p>';
						}
						echo $c->deskripsi.'</td>';
					}
					else
					{
						echo '<td>Ranah ?</td><td>Ranah ?</td><td>Ranah ?</td>';
					}
					if(($k == 1) and ($p==1) and ($s==1))
					{
						$statuse = 'Sudah';
					}
					if($statuse == $status)
					{
						if($statuse == 'Belum')
						{
							echo '<td><p class="text-danger">'.$status.'</p></td>';
						}
						else
						{
							echo '<td><p class="text-success">'.$status.'</p></td>';
						}
					}
					else
					{
						$tidaksesuai++;
						echo '<td><p class="text-danger">Status tidak sesuai</p></td>';
					}
					if($c->kunci == 1)
					{
						$cacahkunci++;
					}
					if(($c->ket_akhir == 'Belum kompeten') or ($c->ket_akhir == ''))
					{
						$cacahbelumtuntas++;
					}
					if($c->ket_akhir == 'Sudah kompeten')
					{
						$cacahtuntas++;
					}

					echo '<td>'.$c->kunci.'</td></tr>';
					$nomor++;
				}
				echo '</table>';
				$persenkunci = 0;
				$persenbelumtuntas = 0;
				$persentuntas = 0;

				if($cacahsiswa > 0)
				{
					$persenkunci = $cacahkunci / $cacahsiswa * 100;
					$persenkunci = round($persenkunci,0);
					$persenbelumtuntas = $cacahbelumtuntas / $cacahsiswa * 100;
					$persenbelumtuntas = round($persenbelumtuntas,0);
					$persentuntas = $cacahtuntas / $cacahsiswa * 100;
					$persentuntas = round($persentuntas,0);
				}
				echo 'terkunci '.$persenkunci.'%, tuntas '.$cacahtuntas.' siswa, belum tuntas '.$cacahbelumtuntas.' siswa';
				echo '<p><a href="'.base_url().'pengajaran/deskripsiketerampilan/'.$id_mapel.'" class="btn btn-danger">Proses Ulang Deskripsi '.$mapel.' '.$kelas.'</a> ';
				?>
				<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pengajaran/telegram/<?php echo $id_mapel.'/'.$persenkunci.'/'.$cacahbelumtuntas.'/'.$cacahtuntas.'/'.$tidaksesuai;?>','yes','scrollbars=yes,width=550,height=640')" class="btn btn-primary">Kirim Telegram <span class="fa fa-print"></span></a></p>	
				<?php
			}
		}
	}
?>
</form>
</div></div></div>
