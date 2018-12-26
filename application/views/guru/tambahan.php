<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: tambahan.php
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
<?php echo form_open('guru/updatedatatambahan','class="form-horizontal" role="form"');?>
<?php
$tp = $this->db->query("select * from `p_pegawai` where `kd` = '$kodeguru'");
$is_pns = 0;
	foreach ($tp->result() as $dtp)
		{
		$status_kepegawaian = $dtp->status_kepegawaian;
		$status_inpassing = $dtp->status_inpassing;
		$tmt_inpassing = $dtp->tmt_inpassing;
		$status_tempat_tugas = $dtp->status_tempat_tugas;
		$status_penerima_tpg = $dtp->status_penerima_tpg;
		$tpg_pertama = $dtp->tpg_pertama;
		$besar_tpg_pertama = $dtp->besar_tpg_pertama;
		$madrasah_induk = $dtp->madrasah_induk;
		}
if ($status_kepegawaian=='PNS')
	{
	$is_pns = 1;
	}
$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
$ada = count($ttambahan->result());
$tambahan = '';
$jtm = '';
$pangkat = '';
$golongan = '';
$jabatan = '';
$tpg='';
$gaji_pokok='';

if ($ada > 0)
	{
	foreach ($ttambahan->result() as $dtambahan)
		{
		$tambahan = $dtambahan->nama_tugas;
		$jtm = $dtambahan->jtm;
		$id_sk = $dtambahan->id_sk;
		$tpg = $dtambahan->tpg;

		}
	$golongan = id_sk_jadi_golongan($id_sk);
	$gaji_pokok = id_sk_jadi_gapok($id_sk);
	$pangkat = golongan_jadi_pangkat($golongan);
	$jabatan = golongan_jadi_jabatan($golongan);

	}
?>
<?php
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><input type="hidden" name="proses" value="-">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option></select></div></div>';

if ((!empty($thnajaran)) or (!empty($semester)))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tugas Tambahan</label></div><div class="col-sm-9">
		<select name="nama_tugas" class="form-control">';
		if(!empty($tambahan))
			{
				echo '<option value="'.$tambahan.'">'.$tambahan.'</option>';
			}
		$ta = $this->db->query("select * from `m_tugas_tambahan` order by `nama_tugas_tambahan`");
		foreach($ta->result() as $a)
		{	
		echo '<option value = "'.$a->nama_tugas_tambahan.'">'.$a->nama_tugas_tambahan.'</option>';
		}
		echo '</select></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">
		Jumlah Jam Tambahan</label></div><div class="col-sm-9"><input type="hidden" name="proses" value="oke"><input type="text" name="jtm" value="'.$jtm.'" class="form-control"></div></div>';
		if ($is_pns == 1)
			{
			
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pangkat</label></div><div class="col-sm-9">'.$pangkat;
			if(empty($pangkat))
				{
				echo 'Silakan mutakhir SK yang berlaku pada semester ini';
				}
			echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Golongan</label></div><div class="col-sm-9">'.$golongan.'</div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jabatan</label></div><div class="col-sm-9">'.$jabatan.'</div></div>';
			}
		if ($is_pns == 0)
			{
			if ($status_kepegawaian == 'NonPNS')
				{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Status Inpassing</label></div><div class="col-sm-9">';
			echo '<select name="status_inpassing" class="form-control">';
			if ($status_inpassing =='0')
				{
				echo '<option value="0">Belum</option>';		
				echo '<option value="1">Sudah</option>';
				}
				else
				{
				echo '<option value="1">Sudah</option>';
				echo '<option value="0">Belum</option>';		
				}
			echo '</select></div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">TMT Inpassing</td><td>:</td>
			<td><select name="hariinpassing" class="form-control">';			
			$postedhari=substr($tmt_inpassing,8,2);
			$postedbulan=substr($tmt_inpassing,5,2);
			$postedtahun=substr($tmt_inpassing,0,4);
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
			echo '<select name="bulaninpassing" class="form-control">';
				echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
			        for($i=1;$i<10;$i++)
				{
				echo '<option value="0'.$i.'">0'.$i.'</option>';
				}
				echo '<option value="10">10</option>';
				echo '<option value="11">11</option>';
				echo '<option value="12">12</option>';
				echo '</select>';
				echo '<select name="tahuninpassing" class="form-control">';
				echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
			        $th=date("Y");
			       	$awal_th=$th;
			        $akhir_th=$th-50;
				$i = $awal_th;
				do
				{
			       	echo '<option value="'.$i.'">'.$i.'</option>';
				$i=$i-1;
				}
				while ($i>=$akhir_th);
				echo '</select></div></div>';

			}
		}
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Gaji Pokok per bulan</td><td>:</td>
	<td>'.$gaji_pokok.'</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Status Tempat Tugas</label></div><div class="col-sm-9">';
			echo '<select name="status_tempat_tugas" class="form-control">';
			if (($status_tempat_tugas =='0') or ($status_tempat_tugas ==''))
				{
				echo '<option value="0">Bukan Induk / Bukan Pangkalan</option>';		
				echo '<option value="1">Induk / Pangkalan</option>';
				}
				else
				{
				echo '<option value="1">Induk / Pangkalan</option>';
				echo '<option value="0">Bukan Induk / Bukan Pangkalan</option>';		
				}
			echo '</select></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Sekolah / madrasah induk (jika '.$this->config->item('sek_nama').' bukan sekolah induk)</label></div><div class="col-sm-9"><input type="text" name="madrasah_induk" value="'.$madrasah_induk.'" class="form-control"></div></div>';

		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Sudah menerima Tunjangan Profesi Guru</label></div><div class="col-sm-9">';
			echo '<select name="status_penerima_tpg" class="form-control">';
			if (($status_penerima_tpg =='0') or ($status_penerima_tpg ==''))
				{
				echo '<option value="0">Belum menerima</option>';		
				echo '<option value="1">Sudah menerima</option>';
				}
				else
				{
				echo '<option value="1">Sudah menerima</option>';
				echo '<option value="0">Belum menerima</option>';		
				}
			echo '</select></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jika sudah menerima TPG, menerima mulai tahun</label></div><div class="col-sm-9"><input type="text" name="tpg_pertama" value="'.$tpg_pertama.'" class="form-control"></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jika sudah menerima TPG, Nominal TPG pertama</label></div><div class="col-sm-9"><input type="text" name="besar_tpg_pertama" value="'.$besar_tpg_pertama.'" class="form-control"> angka saja ya </div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jika sudah menerima TPG, Nominal TPG saat ini</label></div><div class="col-sm-9"><input type="text" name="tpg" value="'.$tpg.'" class="form-control"> angka saja ya </div></div>';

	
	}
	if ($is_pns == 0)
		{
		echo '<input type="hidden" name="pangkat" value="-">';
		echo '<input type="hidden" name="golongan" value="-">';
		echo '<input type="hidden" name="jabatan" value="-">';
		}
	echo '<input type="hidden" name="ada" value="'.$ada.'"><input type="hidden" name="is_pns" value="'.$is_pns.'"><input type="hidden" name="kodeguru" value="'.$kodeguru.'"><p class="text-center"><input type="submit" value="Lanjut / Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'perangkat/sertifikasi"><b>Batal</b></a></p>';
echo '</form>';

if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kodeguru)))
{
	//hapus dulu
	$this->db->query("delete from m_mapel_skbk where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	// cari mapel
	$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' order by mapel ASC");
	$jtm = 0;
	foreach($tmapel->result() as $dmapel)
	{
		$mapelguru = $dmapel->mapel;
		if($dmapel->jam>0)
		{
			$tmapels = $this->db->query("select * from m_mapel_skbk where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' and mapel = '$mapelguru' ");
			$ada = count($tmapels->result());
			if ($ada == 0)
				{
				$this->db->query("INSERT INTO `m_mapel_skbk` (`thnajaran`,`semester`,`mapel`,`kodeguru`) VALUES ('$thnajaran','$semester', '$mapelguru', '$kodeguru')");
				}
				$jtm = $jtm + $dmapel->jam;
		}

	}

}
?>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>JTM</strong></td><td><strong>Tugas Tambahan</strong></td><td><strong>JTM</strong></td><td><strong>Tugas Tambahan di Sekolah Lain</strong></td><td><strong>JTM</strong></td><td><strong>JTM Kumulatif</strong></td></tr>
<?php
$tmapelskbk = $this->db->query("select * from m_mapel_skbk where thnajaran = '$thnajaran' and semester='$semester' and kodeguru='$kodeguru'");
$nomor=1;
foreach($tmapelskbk->result() as $dp)
{
	//hapus dulu
	$thnajaran = $dp->thnajaran;
	$semester = $dp->semester;
	// cari mapel
	$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' order by mapel ASC");
	$jtm = 0;
	foreach ($tmapel->result() as $dmapel)
	{
		$mapelguru = $dmapel->mapel;
		$jtm = $jtm + $dmapel->jam;

	}
	// cari tambahan
	$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	$tambahan = '';
	$jtmtambahan = '';
	foreach ($ttambahan->result() as $dtambahan)
		{
		$tambahan = $dtambahan->nama_tugas;
		$jtmtambahan = $dtambahan->jtm;
		}
	// cari tambahan di sekolah lain
	$ttambahanluar = $this->db->query("select * from p_tugas_tambahan_luar where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	$tambahanluar = '';
	$jtmtambahanluar = '';
	$namasekolah = '';
	foreach($ttambahanluar->result() as $dtambahanluar)
		{
			$tambahanluar = $dtambahanluar->nama_tugas;
			$jtmtambahanluar = $dtambahanluar->jtm;
			$namasekolah = $dtambahanluar->nama_sekolah;
		}
	$jtmk = $jtm + $jtmtambahan + $jtmtambahanluar;
	$mapel = $dp->mapel;
	// cari mapel
	$tmapelx = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' and `mapel`='$mapel'");
	$jtmx = 0;
	foreach ($tmapelx->result() as $dmapelx)
	{
		$jtmx = $jtmx + $dmapelx->jam;
	}
	
echo "<tr><td align='center'>".$nomor."</td><td align='center'>".$thnajaran."</td><td align='center'>".$semester."</td><td>".$mapel."</td><td align='center'>".$jtmx."</td><td>".$tambahan."</td><td>".$jtmtambahan."</td><td>";
	if ($jtmtambahanluar>0)
		{echo ''.$tambahanluar.' di '.$namasekolah.'';
		}
	echo "</td><td align='center'>".$jtmtambahanluar."</td><td align='center'>".$jtmk."</td></tr>";
	$nomor++;	
}
?>
</table></div>
</div></div></div>
