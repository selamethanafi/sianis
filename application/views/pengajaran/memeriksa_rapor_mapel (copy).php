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
$xloc = base_url().'pengajaran/periksanilairapormapel';
?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$tahun2= $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
$kelas = '';
if(empty($limit))
{
	$limit = 0;
}

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
	if (!empty($id_walikelas))
	{
		$tbx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
		foreach($tbx->result() as $bx)
		{
			$kelas= $bx->kelas;
		}
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'/'.$tahun1.'/'.$semester.'" title="Ganti Kelas">Kelas</a></label></div><div class="col-sm-9"><select name="id_walikelas" class="form-control"><option value="'.$id_walikelas.'">'.$kelas.'</option></select></div></div>';
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
	elseif(empty($id_walikelas))
	{
		$tb = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$kelas.'</option>';
		foreach($tb->result() as $b)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$b->id_walikelas.'">'.$b->kelas.'</option>';
		}
		echo '</select></div></div>';
	}
	else
	{ 
	}
	if((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
	{
		$tdx = $this->db->query("SELECT * FROM `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `nama_mapel_portal`"); //
		$cacahmapel = $tdx->num_rows();
		$td = $this->db->query("SELECT * FROM `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `nama_mapel_portal` limit $limit,1"); //
		$persen = 0;
		$nomor = 1;
		foreach($td->result() as $d)
		{
			$mapele = $d->nama_mapel;
			$mapel = $d->nama_mapel_portal;
			$pilihan = $d->pilihan;
			$pesan = '';
			if(!empty($mapel))
			{
				$te = $this->db->query("SELECT * FROM `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
				$kodeguru = '';
				$id_mapel = '';
				$pesan .= 'INFO PORTAL. ';
				foreach($te->result() as $e)
				{
					$kodeguru = $e->kodeguru;
					$id_mapel = $e->id_mapel;
				}
				$ta = $this->db->query("SELECT * FROM `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y'");
				$cacahsiswa = $ta->num_rows();
				$tc = $this->db->query("SELECT * FROM `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel' and `status`='Y'");
				$cacahnilai = $tc->num_rows();
				if($pilihan == 1)
				{
					$cacahsiswa = $cacahnilai;
				}
				if(empty($kodeguru))
				{
					die('kodeguru tidak dtemukan');
				}
				if($cacahsiswa != $cacahnilai)
				{
					$pesan .= 'Cacah siswa ('.$cacahsiswa.') berbeda dengan cacah nilai ('.$cacahnilai.') '.$mapel.' kelas '.$kelas.' tahun '.$thnajaran.' semester '.$semester.'. Sudah memperbarui daftar siswa?';
				}
				else
				{
					$cacahtuntas = 0;
					$cacahbelumtuntas = 0;
					$cacahkunci = 0;
					foreach($tc->result() as $c)
					{
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

					}
					if($cacahsiswa > 0)
					{
						$persenkunci = $cacahkunci / $cacahsiswa * 100;
						$persenkunci = round($persen,0);
						$persenbelumtuntas = $cacahbelumtuntas / $cacahsiswa * 100;
						$persenbelumtuntas = round($persenbelumtuntas,0);
						$persentuntas = $cacahtuntas / $cacahsiswa * 100;
						$persentuntas = round($persentuntas,0);
						$pesan .= 'Mata pelajaran '.$mapel.' kelas '.$kelas.' tahun '.$thnajaran.' semester '.$semester.' terkunci '.$persenkunci.'%, belum tuntas '.$persenbelumtuntas.'%, tuntas '.$persentuntas.'%';
					}
					else
					{
						$pesan = 'Cacah siswa kelas '.$kelas.' mapel '.$mapel.' tahun '.$thnajaran.' semester '.$semester.' '.$cacahsiswa.'. Sudah memperbarui daftar siswa?';
					}
				}
				if($aksi == 'kirim')
				{
					$ponselguru ='';
					$chat_id_guru = '';
					if(!empty($kodeguru))
					{
						$ponselguru = cari_seluler_pegawai($kodeguru);
						$chat_id_guru = cari_chat_id_pegawai($kodeguru);
					}
					if(!empty($chat_id_guru))
					{
						//cek dulu
						$tf = $this->db->query("select * from `telegram` where `pesan` = '$pesan' and `terkirim`='1'");
						if($tf->num_rows() == 0)
						{
							$kirimpesan = kirimtelegram($chat_id_guru,$pesan,$token_bot);
							if($kirimpesan != 1)
							{
								if(!empty($ponselguru))
								{
									$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`) values ('$ponselguru','$pesan')");
								}
							}
						}
					}
					else
					{
						$kirimpesan = kirimtelegram($id_admin,$pesan,$token_bot);
						if(!empty($ponselguru))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`) values ('$ponselguru','$pesan')");
						}

					}

				}
			}
			if($limit%2==0)
			{
				echo $mapele.' <p class="text-success">'.$pesan.'</p>';
			}
			else
			{
				echo $mapele.' <p class="text-danger">'.$pesan.'</p>';
			}

					$limit++;
				if($aksi == 'kirim')
				{

					if($limit > $cacahmapel)
					{?>
					<script>setTimeout(function () {
		 				  window.location.href= '<?php echo base_url();?>pengajaran/periksanilairapormapel/<?php echo $tahun1?>/<?php echo $semester?>';
						},1);
					</script>
					<?php
					}
					?>
					<script>setTimeout(function () {
		 				  window.location.href= '<?php echo base_url();?>pengajaran/periksanilairapormapel/<?php echo $tahun1?>/<?php echo $semester?>/<?php echo $id_walikelas?>/<?php echo $limit?>/kirim';
						},500);
					</script>
					<?php
				}
			echo '<p class="text-center">';
			if($aksi == 'kirim')
			{

			}
			else
			{
				$limit = $limit - 1;
					echo ' <a href="'.base_url().'pengajaran/periksanilairapormapel/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/'.$limit.'/kirim" class="btn btn-success">Kirim Telegram dan Lanjut</a>';
			}
		}
	}
?>
</form>
</div></div></div>
