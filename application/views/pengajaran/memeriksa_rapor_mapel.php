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
if(empty($id_walikelas))
{$id_walikelas = 0;
}
$id_kelas = $id_walikelas;
$tb = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
$cacahkelas = $tb->num_rows();
if($id_walikelas > $cacahkelas)
{
	die('selesai <a href="'.base_url().'pengajaran/periksanilairapormapel/'.$tahun1.'/'.$semester.'">Kembali</a>');
}

echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	if (!empty($tahun1))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'" title="Ganti Tahun Pelajaran">Tahun Pelajaran</a></label></div><div class="col-sm-9"><select name="tahun1" class="form-control">';
		echo "<option value='".$tahun1."'>".$thnajaran."</option>";
		echo '</select></div></div>';
	}
	if (!empty($semester))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'/'.$tahun1.'" title="Ganti Semester">Semester</a></label></div><div class="col-sm-9"><select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option></select></div></div>';
	}
	if(empty($tahun1))
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
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
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
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
	}
	if((!empty($thnajaran)) and (!empty($semester)))
	{
		$tb = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas` limit $id_walikelas,1");
		foreach($tb->result() as $b)
		{
			$kelas = $b->kelas;
		}
		?>

		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<?php echo $kelas.'</div></div>';

		$tdx = $this->db->query("SELECT * FROM `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `nama_mapel_portal`"); //
		$cacahmapel = $tdx->num_rows();
		$limite = $limit+1;
		//echo 'limit '.$limit.' cacah mapel '.$cacahmapel.' id_walikelas '.$id_walikelas.' cacah kelas '.$cacahkelas;
		if($limite > $cacahmapel)
		{
			$id_walikelas++;
			if($id_walikelas > $cacahkelas)
				{
					?>
					<script>setTimeout(function () {
		 				  window.location.href= '<?php echo base_url();?>pengajaran/periksanilairapormapel/<?php echo $tahun1?>';
						},1);
					</script>
					<?php
				}
				else
				{
	
					?>
					<script>setTimeout(function () {
		 				  window.location.href= '<?php echo base_url();?>pengajaran/periksanilairapormapel/<?php echo $tahun1?>/<?php echo $semester?>/<?php echo $id_walikelas?>/0/kirim';
						},10);
					</script>
					<?php
				}
		}
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
						$persenkunci = round($persenkunci,0);
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
					if(empty($kodeguru))
					{
						$pesan = 'Belum ada guru pengampu '.$mapel.' kelas '.$kelas.' tahun '.$thnajaran.' semester '.$semester;
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
									//$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`) values ('$ponselguru','$pesan')");
									$kirimsms = postsms($url_sms_post,$ponselguru,$pesan);
								}
							}
						}
					}
					else
					{
						$kirimpesan = kirimtelegram($id_admin,$pesan,$token_bot);
						if(!empty($ponselguru))
						{
//							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`) values ('$ponselguru','$pesan')");
							$kirimsms = postsms($url_sms_post,$ponselguru,$pesan);
						}

					}
					if(!empty($ponselguru))
					{
//						$kirimsms = postsms($urlsms,$pesan,$token_bot);
					}

				}
			}
			if($limit%2==0)
			{
				echo '<p class="text-success">'.$pesan.'</p>';
			}
			else
			{
				echo '<p class="text-danger">'.$pesan.'</p>';
			}
			$persenk = $id_kelas/$cacahkelas * 100;
				$persenk = round($persenk);
				echo '<div class="progress">
				<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width:'.$persenk.'%;">
				kelas ke-'.$id_kelas.' dari '.$cacahkelas.' ('.$persenk.'%) terproses
				</div>
			      </div><br />';
				
			$persen = $limit/$cacahmapel * 100;
				$persen = round($persen);
				echo '<div class="progress">
				<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:'.$persen.'%;">
				langkah ke-'.$limit.' dari '.$cacahmapel.' ('.$persen.'%) terproses
				</div>
			      </div>';
					$limit++;
				if($aksi == 'kirim')
				{

					?>
					<script>setTimeout(function () {
		 				  window.location.href= '<?php echo base_url();?>pengajaran/periksanilairapormapel/<?php echo $tahun1?>/<?php echo $semester?>/<?php echo $id_walikelas?>/<?php echo $limit?>/kirim';
						},10);
					</script>
					<?php
				}
			
			echo '<br /><p class="text-center">';
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
