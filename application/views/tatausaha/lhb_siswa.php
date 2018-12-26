<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 10 Nov 2014 04:24:41 WIB 
// Nama Berkas 		: lhb_siswa.php
// Lokasi      		: application/views/tatausaha/
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

if(empty($nis))
	{
	echo '<div class="alert alert-danger">Galat, NIS kosong atau tidak ditemukan</div>';
	}
else
{
echo '<p><a href="'.base_url().'tatausaha/carisiswa" class="btn btn-info">Siswa Lain</a></p>';
$datasiswa = $this->helper->data_siswa($nis);
$ket = $datasiswa['ket'];
$kelasawal = $datasiswa['kls'];
$thnajaranakhir = $datasiswa['thnajaran'];
$semesterakhir = $datasiswa['semester'];
$kelasakhir = $this->helper->nis_ke_kelas_thnajaran_semester($nis,$thnajaranakhir,$semesterakhir);
$kurikulumakhir = cari_kurikulum($thnajaranakhir,$semesterakhir,$kelasakhir);
$datakelas = $this->helper->nis_kelas_jadi_thnajaran_semester($nis,$kelasawal);
$thnajaranawal = $datakelas['thnajaran'];
$semesterawal = $datakelas['semester'];
echo '<h3>NIS '.$nis.' '.nis_ke_nama($nis).'</h3>';
$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by thnajaran ASC, semester ASC");
$ada = $ta->num_rows();
if ($ada == 0)
	{
	echo '<div  class="alert alert-danger">Tidak ada data siswa di tabel kelas</div>';
	}
	else
	{
	echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td width="30" rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>Item</strong></td><td rowspan="2"><strong>Tahun Pelajaran</strong></td><td rowspan="2"><strong>Semester</strong></td><td rowspan="2"><strong>Kelas</strong></td><td rowspan="2"><strong>Kurikulum</strong></td><td colspan="2"><strong>Cetak</strong></td></tr><td align="center">KTSP</td><td align="center">K13</td></tr>';
	$nomor = 1;
	$kurikulumawal=cari_kurikulum($thnajaranawal,$semesterawal,$kelasawal);
	echo '<tr><td align="center">'.$nomor.'</td><td>Sampul</td><td align="center">'.$thnajaranawal.'</td><td align="center">'.$semesterawal.'</td><td align="center">'.$kelasawal.'</td><td align="center">'.$kurikulumawal.'</td>';
		if(($kurikulumawal == '2013') or ($kurikulumawal == '2015'))
			{
			?>
			<td align="center" colspan="2"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/sampul/lck/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php

			}
		elseif($kurikulumawal == 'KTSP')
			{
			?>
			<td align="center" colspan="2"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/sampul/lhb/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php

			}
		else
			{
			?>
			<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/sampul/lhb/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<td align="center">
			<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/sampul/lck/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php
			}
		echo '</tr>';
	$nomor++;
	foreach($ta->result() as $a)
		{
		$thnajaran = $a->thnajaran;
		$semester = $a->semester;
		$kelas = $a->kelas;
		$kurikulum=cari_kurikulum($thnajaran,$semester,$kelas);
		if($kurikulum == '2018')
			{
			$lhb = 'lck_2018';
			}

		elseif($kurikulum == '2015')
			{
			$lhb = 'lck_2015';
			}
		elseif($kurikulum == '2013')
			{
			$lhb = 'lck';
			}
		elseif($kurikulum == 'KTSP')
			{
			$lhb = 'lhb';
			}
		else
			{
			$lhb = '';
			}
		echo "<tr><td align='center'>".$nomor."</td><td>".strtoupper($lhb)."</td><td align='center'>".$thnajaran."</td><td align='center'>".$semester."</td><td align='center'>".$kelas."</td><td align='center'>".$kurikulum."</td><td  colspan=\"2\" align=\"center\">";
		if($lhb == 'lhb')
			{
			?>
			<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php
			}
		if($lhb == 'lck')
			{
			?>
			<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis;?>/akhir','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php
			}
		if($lhb == 'lck_2015')
			{
			?>
			<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis.'/akhir/2015';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php
			}
		if($lhb == 'lck_2018')
			{
			?>
			<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$nis.'/akhir/2018';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php
			}

		$nomor++;
		}
		echo '<tr><td align="center">'.$nomor.'</td><td>Keterangan Masuk Madrasah</td><td align="center">'.$thnajaranawal.'</td><td align="center">'.$semesterawal.'</td><td align="center">'.$kelasawal.'</td><td align="center">'.$kurikulumawal.'</td>';
		if(($kurikulumawal == '2013') or ($kurikulumawal == '2015'))
			{
			?>
			<td align="center" colspan="2"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/masuk/lck/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php

			}
		elseif($kurikulumawal == 'KTSP')
			{
			?>
			<td align="center" colspan="2"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/masuk/lhb/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php

			}
		else
			{
			?>
			<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/masuk/lhb/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<td align="center">
			<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/masuk/lck/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
			<?php
			}
		echo '</tr>';
		if($ket == 'L')
		{
			$nomor++;
			echo '<tr><td align="center">'.$nomor.'</td><td>Keterangan Meninggalkan Madrasah</td><td align="center">'.$thnajaranakhir.'</td><td align="center">'.$semesterakhir.'</td><td align="center">'.$kelasakhir.'</td><td align="center">'.$kurikulumakhir.'</td>';
				?><td colspan="2" align="center">
				<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/keluar/lck/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
				<?php
			echo '</tr>';
		}
		if(($ket == 'P') or ($ket == 'K'))
		{
			$nomor++;
			echo "<tr><td align='center'>".$nomor."</td><td>Keterangan Keluar / Pindah Madrasah</td><td colspan='4'></td>";
				?><td colspan="2"  align="center">
				<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/keluar/lhb/<?php echo $nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
				<?php
			echo '</tr>';
		}
		if($ket == 'L')
		{	
			$nomor++;
			echo "<tr><td align='center'>".$nomor."</td><td>Ijazah Sementara ";
				?>
					<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>tatausaha/legerijazah/<?php echo substr($thnajaran,0,4).'/'.$nis;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Proses Leger</a>
				<?php
				echo "</td><td colspan='4'></td><td  colspan=\"2\"  align='center'>";
				?>
				<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/ijazah/<?php echo $thnajaran.'/'.$nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a><?php
			echo '</td></tr>';
			$nomor++;
			echo "<tr><td align='center'>".$nomor."</td><td>Surat Keterangan Lulus</td><td colspan='4'></td><td colspan=\"2\"  align='center'>";
				?>
				<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/skl/<?php echo $thnajaran.'/'.$nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a><?php
			echo '</td></tr>';
		}
		$nomor++;

	}

}
?>
</table>

</div></div></div>
