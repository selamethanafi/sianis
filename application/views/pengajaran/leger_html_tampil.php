<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_bph.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tahun2 = $tahun1+1;
$thnajaran = $tahun1.'/'.$tahun2;
$lebartabel="95%";
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `id_walikelas` = '$id_walikelas'");
if($ta->num_rows()>0)
{
	foreach($ta->result() as $a)
	{
		$kelas = $a->kelas;
		$kurikulum = $a->kurikulum;
	}

	echo '<h3 class="text-center"><a href="'.base_url().'pengajaran/leger2">LEGER NILAI</a></p></h3>
	<table width="'.$lebartabel.'"><tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong>'.$thnajaran.'</strong></td></tr>
	<tr><td><strong>Semester</strong></td><td>: <strong>'.$semester.'</strong></td></tr><tr><td><strong>Kelas</strong></td><td>: <strong>'.$kelas.'</strong></td></tr></table>';
	?>
	<div class="CSSTableGenerator">
		<table width="<?php echo $lebartabel;?>">
		<tr align="center"><td>No.</td><td>Nama</td>
		<?php
		$nomor = 1;
		$nokol = 1;
		$tb = $this->db->query("select * from `m_mapel_rapor` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by `no_urut`");
		if($kurikulum == '2015')
		{
			foreach($tb->result() as $b)
			{
				if(!empty($b->nama_mapel_portal))
				{
					echo '<td align="center" colspan="2">';
					if(substr($b->nama_mapel,1,1) == '.')
					{
						$len = strlen($b->nama_mapel) - 3;
						echo substr($b->nama_mapel,2,$len);
					}
					else
					{
						echo $b->nama_mapel;
					}
					echo '</td>';
					$nokol++;
				}

			}
		}
		else
		{
			foreach($tb->result() as $b)
			{
				if(!empty($b->nama_mapel_portal))
				{
					echo '<td align="center" colspan="3">';
					if(substr($b->nama_mapel,1,1) == '.')
					{
						$len = strlen($b->nama_mapel) - 2;
						echo substr($b->nama_mapel,3,$len);
					}
					else
					{
						echo $b->nama_mapel;
					}
					echo '</td>';
					$nokol++;
				}
			}
		}
		echo '</tr>';
		$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
		foreach($tc->result() as $c)
		{
			$nis = $c->nis;
			echo '<tr><td>'.$nomor.'</td><td>'.nis_ke_nama($nis).'</td>';
			$nokol = 1;
			if($kurikulum == '2015')
			{
				$td = $this->db->query("select `thnajaran`,`semester`,`nis`, `kog`, `psi`, `afe`, `kunci` from `nilai` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y' order by `kd_mapel`");
				$kog = '';
				$psi = '';
				foreach($td->result() as $d)
				{
					if($d->kunci == 1)
					{
						$kog = $d->kog;
						$psi = $d->psi;	
					}
					else
					{
						$kog ='X';
						$psi = 'X';
					}
					echo '<td align="center">'.$kog.'</td><td align="center">'.$psi.'</td>';
				}

			}
			else
			{
				$td = $this->db->query("select `thnajaran`,`semester`,`nis`, `kog`, `psi`, `afe`, `afektif`, `kunci` from `nilai` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y' order by `kd_mapel`");
				$kog = '';
				$psi = '';
				$afe = '';
				foreach($td->result() as $d)
				{
					if($d->kunci == 1)
					{
						$kog = $d->kog;
						$psi = $d->psi;	
						$afe = $d->afektif;
					}
					else
					{
						$kog ='X';
						$psi = 'X';
						$afe = 'X';
					}
					echo '<td align="center">'.$kog.'</td><td align="center">'.$psi.'</td><td align="center">'.$afe.'</td>';
				}
			}
		echo '</tr>';
		$nomor++;

		}
		echo '</table>';
	echo '</div>';
}
else
{
	echo 'tidak ada data';
}
?>
</div></body></html>


