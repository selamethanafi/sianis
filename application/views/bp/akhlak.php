<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: akhlak.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 17 Mei 2016 18:30:58 WIB 
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
?>
<?php
$pesan = '';
if ((!empty($thnajaran)) and (!empty($semester)) and ($proses == 'proses'))
{
	$adamapel = 0;
	for($i=0;$i<3;$i++)
	{
		if($i == 0)
		{
			$kurikulum = '2015';
		}
		elseif($i == 1)
		{
			$kurikulum = '2013';
		}
		else
		{
			$kurikulum = 'KTSP';
		}
		if($kurikulum == '2015')
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kurikulum`='$kurikulum'");
			foreach($ta->result() as $a)
			{
				$kelase = $a->kelas;
				$tmapel = $this->db->query("select * from `m_akhlak_2015` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelase'");
				$adamapel = $adamapel + $tmapel->num_rows();
				foreach($tmapel->result_array() as $d)
				{
					$kelas = $d['kelas'];
					$kodeguru = $d['kodeguru'];
					$tb = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `kodeguru`='$kodeguru'");
					$adatb = $tb->num_rows();
					if($adatb == 0)
					{
						$this->db->query("insert into m_akhlak (`thnajaran`,`semester`,`kelas`,`kodeguru`) values ('$thnajaran','$semester','$kelas','$kodeguru')");
					}
				}
			}

		}
		else
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kurikulum`='$kurikulum'");

			foreach($ta->result() as $a)
			{
				$kelase = $a->kelas;
				$tmapel = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelase'");
				$adamapel = $adamapel + $tmapel->num_rows();
				foreach($tmapel->result_array() as $d)
				{
					$kelas = $d['kelas'];
					$kodeguru = $d['kodeguru'];
					$tak = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelase' and `kodeguru`='$kodeguru'");
					$adaak = $tak->num_rows();
					if($adaak == 0)
					{
						$this->db->query("insert into m_akhlak (`thnajaran`,`semester`,`kelas`,`kodeguru`) values ('$thnajaran','$semester','$kelas','$kodeguru')");
					}
				}
			}
		}
	} // akhir $i
	$pesan = '
    <div class="alert alert-success">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Sukses!</strong> Proses Selesai, '.$adamapel.' baris</div>';

?>
<?php
}
$ta = $this->db->query("select * from `m_akhlak_2015` where `thnajaran`='$thnajaran' and `semester`='$semester'");
$adaguru = $ta->num_rows();
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo $pesan;?>
<div class="alert alert-warning">Khusus Kurikulum 2015, pastikan guru penilai sikap sudah dimasukkan semua, saat ini ada <strong><?php echo $adaguru;?></strong> guru</div>
<?php echo form_open('bp/akhlak','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">
<?php
echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">
<?php
echo "<option value='".$semester."'>".$semester."</option>";
?>
</select></div></div>
<?php
if($adaguru >0)
{?>
	<p class="text-center"><input type="hidden" name="proses" value="proses"><button type="submit" class="btn btn-primary" role="button">PROSES</button></p>
<?php
}
?>
</form>
</div></div></div>
