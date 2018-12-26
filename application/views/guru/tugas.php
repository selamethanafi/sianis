<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : tugas.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<div class="container-fluid"><h2>Modul Tugas Mandiri dan Tak Terstruktur Tahun <?php echo $thnajaran;?> Semester <?php echo $semester;?></h2>

<?php
echo '<a href="'.base_url().'index.php/guru/tugastanggal"><b>Tampil/Ubah Tugas tanggal tertentu</b></a>';
if (($aksi=='ubah') and (!empty($id_rph)))
	{
	echo '<h2>Ubah Tugas</h2>';
	echo '<form method="post" action="'.base_url().'index.php/guru/tugas/'.$page.'">';
	$tb = $this->db->query("SELECT * FROM `guru_rph` where kodeguru='$kodeguru' and id_rph='$id_rph'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
 echo '<table cellspacing="5"><tr><td >Kode Guru</td><td>:</td><td>'.$kodeguru.'</td></tr>
	<tr><td>Tahun Pelajaran</td><td>:</td><td>'.$b->thnajaran.'</td></tr>
	<tr><td>Semester</td><td>:</td><td>'.$b->semester.'</td></tr>';
	echo '<tr><td>Mata Pelajaran</td><td>:</td><td>'.$b->mapel.'</td></tr>';
	echo '<tr><td>Kelas</td><td>:</td><td>'.$b->kelas.'</td></tr>';
	echo '<tr><td>Tanggal Pemberian Tugas</td><td>: </td><td>'.date_to_long_string($b->tanggal).'</td></tr>
	<tr><td>Jam Ke</td><td align="top">:</td><td>'.$b->jamke.'</td></tr>
	<tr><td>Standar Kompetensi</td><td>:</td><td>'.tanpa_paragraf($b->sk).'</td></tr>
	<tr><td>Kompetensi Dasar</td><td>:</td><td>'.tanpa_paragraf($b->kd).'</td></tr>
	<tr><td>Materi </td><td>:</td><td>'.tanpa_paragraf($b->materi).'</td></tr>
	<tr><td>Perintah / Tugas</td><td>:</td><td><textarea name="tugas" rows="15" class="textfield">'.$b->tugas.'</textarea></td></tr>';
	if ($b->tanggalselesai=='0000-00-00')
		{$tanggalselesai = $b->tanggal;
		}
		else
		{$tanggalselesai = $b->tanggalselesai;
		}
		
	$postedhari= substr($tanggalselesai,8,2);
	$postedbulan= substr($tanggalselesai,5,2);
	$postedtahun= substr($tanggalselesai,0,4);
	echo '<tr><td>Tanggal Penyerahan Tugas</td><td>: </td><td>';
	echo '<select name="tanggaltugasselesai">';
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
		{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
	for($i=10;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
	echo '</select>';
	echo '<select name="bulantugasselesai" >';
			 if ($postedbulan=="01")
			{
			$bulan = "Januari";
			}
			if ($postedbulan=="02")
			{
			$bulan = "Februari";
			}
			if ($postedbulan=="03")
			{
			$bulan = "Maret";
			}
			if ($postedbulan=="04")
			{
			$bulan = "April";
			}
			if ($postedbulan=="05")
			{
			$bulan = "Mei";
			}
			if ($postedbulan=="06")

			{
			$bulan = "Juni";
			}
			if ($postedbulan=="07")

			{
			$bulan = "Juli";
			}
			if ($postedbulan=="08")
			{
			$bulan = "Agustus";
			}
			if ($postedbulan=="09")
			{

			$bulan = "September";
			}
			if ($postedbulan=="10")
			{

			$bulan = "Oktober";
			}
			if ($postedbulan=="11")
			{

			$bulan = "November";
			}
			if ($postedbulan=="12")
			{
			$bulan = "Desember";

			}
			if (($postedbulan=="00") or ($postedbulan==""))
			{
			$bulan = "-----";
			}
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
	echo '</select>';
	echo '<select name="tahuntugasselesai" >';
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
	echo '</select></td></tr>
	<tr><td>Jenis Tugas</td><td>:</td><td>';
	echo '<select name="is_mandiri" class="textfield-option">';
	if ($b->keterangan=='1')
		{
		echo '<option value="1">Mandiri Tak Terstruktur</option>';
		echo '<option value="2">Terstruktur</option>';
		}
	elseif ($b->keterangan=='2')
		{
		echo '<option value="2">Terstruktur</option>';
		echo '<option value="1">Mandiri Tak Terstruktur</option>';
		}

		else
		{
		echo '<option value="1">Mandiri Tak Terstruktur</option>';
		echo '<option value="2">Terstruktur</option>';
		}
	echo '</select></td></tr>
<tr><td></td><td></td><td><input type="submit" value="Simpan" class="tombol-merah"><a href="'.base_url().'index.php/guru/tugas/tampil"><b>Batal</b></a>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="textfield" size="30">
<input type="hidden" name="id_rph" value="'.$id_rph.'" class="textfield" size="30">
<input type="hidden" name="post_aksi" value="ubah_data" class="textfield" size="30"></td></tr>
</table></form>';
		} // data
	} //kalau ada / ditemukan

	}
else
{
?>
<div class="CSSTableGenerator"><table>
<tr align="center"><td><strong>No</strong></td><td><strong>Hari, Tanggal</strong></td><td><strong>Mapel</strong></td><td><strong>Kelas</strong></td><td><strong>Jam Ke-</strong></td><td><strong>Tugas</strong></td><td><strong>Ket</strong></td><td><strong>Aksi</strong></td></tr>
<?php
if (empty($page))
	{
	$page=0;
	}
$nomor=$page+1;
if(count($ta->result())>0){
foreach($ta->result() as $a)
{
	if ($a->is_mandiri=='1')
		{
		$keterangan = 'Mandiri Tak Terstruktur';
		}
	else if ($a->is_mandiri=='0')
		{
		$keterangan = 'Mandiri Tak Terstruktur';
		}
	else if ($a->is_mandiri=='2')
		{
		$keterangan = 'Terstruktur';
		}
	else
		{
		$keterangan = '?';
		}
echo "<tr><td align='center'>".$nomor."</td><td>".tanggal_ke_hari($a->tanggal).", ".date_to_long_string($a->tanggal)."</td><td>".$a->mapel."</td><td>".$a->kelas."</td><td>".$a->jamke."</td><td>".tanpa_paragraf($a->tugas)."</td><td>".$keterangan."</td><td>
<a href='".base_url()."index.php/guru/tugas/".$page."/ubah/".$a->id_rph."' title='Sunting Tugas '><img src='".base_url()."images/edit-icon.gif' border='0'></a></td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Anda belum pernah menulis Tugas</td></tr>";
} //akhir tampil
echo '</table></div>';

} // akhir bukan edit
if (!empty($paginator))
	{
	?>
	<h5><?php echo $paginator;?></h5>
	<?php }?>
<div class="clear padding40"></div>
</div>
