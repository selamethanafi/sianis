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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$cekitem = 0;
$namaitem = '';
if(($item == 'uh1') or ($item == 'uh2') or ($item == 'uh3') or ($item == 'uh4') or ($item == 'uh5') or ($item == 'uh6') or ($item == 'uh7') or ($item == 'uh8') or ($item == 'uh9') or ($item == 'uh10') or ($item == 'p1') or ($item == 'p2') or ($item == 'p3') or ($item == 'p4') or ($item == 'p5') or ($item == 'p6') or ($item == 'p7') or ($item == 'p8') or ($item == 'p9') or ($item == 'p10') or ($item == 'p11') or ($item == 'p12') or ($item == 'p13') or ($item == 'p14') or ($item == 'p15') or ($item == 'p16') or ($item == 'p17') or ($item == 'p18')  or ($item == 'mid') or ($item == 'uas') or ($item == 'tu1') or ($item == 'tu2') or ($item == 'tu3') or ($item == 'tu4') or ($item == 'ku1') or ($item == 'ku2') or ($item == 'ku3') or ($item == 'ku4'))
{
	$cekitem = 1;
}
$tb=$this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
if($tb->num_rows() == 0)
{
	echo 'Mata pelajaran yang diampu tidak ditemukan';
}
elseif($cekitem == 0)
{
	echo 'Item penilaian tidak didukung';
}
else
{
	foreach($tb->result() as $b)
	{
		$mapel = $b->mapel;
		$kelas = $b->kelas;
		$thnajaran = $b->thnajaran;
		$semester = $b->semester;
	}
	if(substr($item,0,1) == 'p')
	{
		$iteme = $item;
		$tc = $this->db->query("select * from aspek_psikomotorik where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		$cacahitem = 0;
		foreach($tc->result() as $c)
		{
			$namaitem = $c->$item;
		}

	}
	else
	{
		$iteme = 'nilai_'.$item;
		$namaitem = $item;
	}

	if($aksi == 'proses')
	{
		echo '<h3>Mohon bersabar, tunggu sampai halaman berpindah.</h3>';
		if($limit < 0)
		{
			$limit = 0;
		}
		
		$ta = $this->db->query("select `thnajaran`,`semester`,`mapel`,`kelas`,`nis`,`status`,`$iteme`, `chat_id` from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `chat_id` ='1' limit $limit,1");
		if($ta->num_rows()>0)
		{
			foreach($ta->result() as $a)
			{
				$nis = $a->nis;
				$nilaine = $a->$iteme;
				$tc = $this->db->query("select `nis`,`nama`,`chat_id` from `datsis` where `nis`='$nis'");
				$namasiswa = '';
				$chat_id = '';
				foreach($tc->result() as $c)
				{
					$namasiswa = $c->nama;
					$chat_id = $c->chat_id;
				}
				$pesan = 'Nilai '.$namaitem.' mapel '.$mapel.' '.$nilaine;
				if(!empty($chat_id))
				{
					$kirimpesan = kirimtelegram($chat_id,$pesan,$this->config->item('token_bot'));
				}

				echo $namasiswa;
			}
			$limit++;
		?>

			<script>setTimeout(function () {
			   window.location.href= '<?php echo base_url();?>gurutelegram/bpu/<?php echo $id_mapel;?>/<?php echo $item;?>/proses/<?php echo $limit;?>';
			},1);
			</script>
		
		<?php
		}
		else
		{
			if(substr($item,0,1) == 'p')
			{
				?>
				<script>setTimeout(function () {
				   window.location.href= '<?php echo base_url();?>guru/daftarnilaipsikomotor/<?php echo $id_mapel;?>';
				},0);
				</script>
			<?php
			}
			else
			{?>
				<script>setTimeout(function () {
				   window.location.href= '<?php echo base_url();?>guru/daftarnilai/<?php echo $id_mapel;?>';
				},0);
				</script>
			<?php
			}

		}
	}
	else
	{
		$ta = $this->db->query("select `thnajaran`,`semester`,`mapel`,`kelas`,`nis`,`status`,`$iteme`,`status` from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `status`='Y'");
		if($ta->num_rows()>0)
		{
			$this->db->query("update `nilai` set `chat_id`='' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");
			$nomor = 1;
			$adachat = 0;
			echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>Nis</td><td>Nama</td><td>Chat ID</td><td>Nilai '.$namaitem.'</td></tr>';
			foreach($ta->result() as $a)
			{
				$nis = $a->nis;
				$tc = $this->db->query("select `nis`,`nama`,`chat_id` from `datsis` where `nis`='$nis'");
				$namasiswa = '';
				$chat_id = '';
				foreach($tc->result() as $c)
				{
					$namasiswa = $c->nama;
					$chat_id = $c->chat_id;
				}
				if(!empty($chat_id))
				{
					$this->db->query("update `nilai` set `chat_id`='1' where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `nis`='$nis'");
					$adachat++;
				}
				echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.$namasiswa.'</td><td>'.$chat_id.'</td><td>'.$a->$iteme.'</td></tr>';
				$nomor++;
			}
			echo '</table>';
			if($adachat > 0)
			{
				echo '<p class="text-center"><a href="'.base_url().'gurutelegram/bpu/'.$id_mapel.'/'.$item.'/proses" class="btn btn-success" data-confirm = "Anda yakin hendak mengirim telegram?">Kirim Telegram</a> ';
				if(substr($item,0,1) == 'p')
				{
					echo '<a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'" class="btn btn-warning">Kembali ke Daftar Nilai</a></p>';
				}
				else
				{
					echo '<a href="'.base_url().'guru/daftarnilai/'.$id_mapel.'" class="btn btn-warning">Kembali ke Daftar Nilai</a></p>';
				}

			}
			else
			{
				echo 'tidak ada yang mempunyai akun telegram';
				if(substr($item,0,1) == 'p')
				{
					echo '<p><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'" class="btn btn-warning">Kembali ke Daftar Nilai</a></p>';
				}
				else
				{
					echo '<p><a href="'.base_url().'guru/daftarnilai/'.$id_mapel.'" class="btn btn-warning">Kembali ke Daftar Nilai</a></p>';
				}
			}

		}
		else
		{
			echo 'Belum ada daftar nilai';
		}
	}
}
?>

</div></div></div>
