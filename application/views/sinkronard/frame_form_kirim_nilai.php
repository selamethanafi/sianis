<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:35:41 WIB 
// Nama Berkas 		: frame_form_kirim_nilai.php
// Lokasi      		: application/views/sinkronard/
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
$kelas = '';
$mapel = '';
$subjects_value = '';
$tw = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
foreach($tw->result() as $w)
{
	$kelas =$w->kelas;
	$mapel =$w->mapel;
	$subjects_value = $w->subjects_value;
	$thnajaran = $w->thnajaran;
	$semester = $w->semester;
}
if(!empty($id_mapel))
{
	$tb = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
	$school_class_id = '';
	$belumadaard = 0;
	foreach($tb->result() as $b)
	{
		$school_class_id = $b->kode_rombel;
	}
	if((empty($school_class_id)) or (empty($subjects_value)))
	{
		echo '<div class="alert alert-danger">Kode Kelas atau Kode Mapel dari ARD  belum ada </div>';
	}
	else
	{
		echo 'school_class_id '.$school_class_id;
		echo '<br />subjects_value '.$subjects_value;
		$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut`");
		$cacahsiswa = $query->num_rows();
		if(count($query->result())>0)
		{
			echo form_open($url_ard.'/ma/guru/functions/student_value/daily/'.$school_class_id.'/'.$subjects_value.'/1');
			?>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered"><thead>
				<tr align="center"><td><strong>No</strong></td><td><strong>Nama</strong></td>
				<?php
				echo '<td><strong>PH1</strong></td><td><strong>PH2</strong></td><td><strong>PH3</strong></td><td><strong>PH4</strong></td><td><strong>PH5</strong></td><td><strong>PH6</strong></td><td><strong>PH7</strong></td><td><strong>PH8</strong></td><td><strong>PH9</strong></td><td><strong>PH10</strong></td><td><strong>RPH</strong></td></thead>';
				$nomor=1;
				$galat = 0;
				foreach($query->result() as $t)
				{		
					$nis = $t->nis;
					$tb = $this->db->query("select `nis`,`id_ard_siswa` from `datsis` where `nis`='$nis'");
					foreach($tb->result() as $b)
					{
						$student_id = $b->id_ard_siswa;
					}
					$namasiswa = nis_ke_nama($nis);
					if(!empty($t->student_value))
					{
						echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td>';
						if($t->nilai_uh1>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh1 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh1.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh1.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh1.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh2>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh2 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh2.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh2.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh2.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh3>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh3 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh3.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh3.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh3.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh4>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh4 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh4.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh4.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh4.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh5>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh5 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh5.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh5.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh5.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh6>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh6 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh6.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh6.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh6.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh7>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh7 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh7.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh7.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh7.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh8>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh8 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh8.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh8.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh8.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh9>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh9 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh9.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh9.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh9.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						if($t->nilai_uh10>100)
						{
							echo '<td align="center">lebih dari 100</td>';
							$galat++;
						}
						else
						{
							if($t->nilai_uh10 > 0)
							{
								echo '<td align="center">'.$t->nilai_uh10.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh10.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
							else
							{
								echo '<td align="center">'.$t->nilai_uh10.'<input type="hidden" class="form-control" name="value_daily_score[]" value="" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
							}
						}
						echo '<td align="center">'.$t->kog.'<input type="hidden" name="student_id[]" value="'.$student_id.'" required /><input type="hidden" name="student_status[]" value="" required /><input type="hidden" name="student_value[]" value="'.$t->student_value.'" required /></td>';
						echo '</tr>';
					}
					else
					{
						echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td><td colspan="11">belum ada kode nilai dari ARD</div>';
						$belumadaard++;
					}
					$nomor++;
				}
				echo '</table>
			</div>';
			echo '<p class="text-center">';
			if(($galat==0) and ($belumadaard==0))
			{
				echo '<input type="submit" value="Kirim ke ARD" class="btn btn-success"> ';
			}
			echo '<a href="'.base_url().'sinkronard/unduhkodenilai/'.$id_mapel.'" class="btn btn-primary"><span class="fa fa-download"></span>   <b>Unduh Kode Nilai</b></a></p>
			</form>';
		}
		else
		{
			echo 'Belum ada daftar nilai semester ini';
		}
	}
}
echo '</div></div></div>';
