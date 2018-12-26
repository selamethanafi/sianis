<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : cetak_kekurangan_siswa_per_kelas.php
// Lokasi      : application/views/keuangan
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
<?php
$tbayar = 0;
if ((!empty($thnajaran)) and (!empty($ruang)) and (!empty($semester)))
{

	$jmlkekurangan = 0;
	$banyakkolom = 0;
	echo '<h3><p class="text-center"><a href="'.base_url().'keuangan/kekurangansiswaperkelas">DAFTAR KEKURANGAN PEMBAYARAN SISWA KELAS '.$ruang.' TAHUN '.$thnajaran.'</a></p></h3>';
	$tskk = $this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and `semester`='$semester' and kelas='$ruang' and status='Y' order by no_urut");
	$jmlbsrtung = 0;
	$jmltung = 0;
	echo '<table width="100%" bgcolor="#ccc"><tr bgcolor="#fff" align="center"><td>Nama</td><td>Jumlah Yang Seharusnya dibayar</td><td>Terbayar</td><td>Kekurangan</td></tr>';

	foreach($tskk->result() as $dskk)
	{
		$nis = $dskk->nis;
		$namasiswa = nis_ke_nama($nis);
		$kelas = $dskk->kelas;
		$thnajarankk = $dskk->thnajaran;
		//cari di riwayat
		$tba = $this->db->query("select * from `siswa_kelas_tahun` where `thnajaran`='$thnajarankk' and `nis`='$nis'");
		$adatba = $tba->num_rows();
		if($adatba == 0)
		{
			$this->db->query("insert into `siswa_kelas_tahun` (`thnajaran`,`nis`,`kelas`) values ('$thnajarankk', '$nis', '$kelas')");
		}
		$ta = $this->db->query("select * from `siswa_kelas_tahun` where nis = '$nis' order by `thnajaran`");
		$adata=$ta->num_rows();
		if($adata==0)
		{
			echo '<div class="alert alert-warning">Belum ada data riwaya kelas siswa per tahun</div>';
		}
		else
		{
			$jmltagihan = 0;
			$jmlterbayar = 0;
			$tmacam = $this->db->query("select * from m_uang");
			$tsk = $this->db->query("select * from `siswa_kelas_tahun` where nis = '$nis' order by `thnajaran`");
			$jmltagihan = 0;
			foreach($tsk->result() as  $dsk)
			{
				$thnajaran = $dsk->thnajaran;
				$kelas = $dsk->kelas;
				$tingkat = kelas_jadi_tingkat($kelas);
				$tset = $this->db->query("select * from m_uang_besar where thnajaran='$thnajaran' and tingkat='$tingkat'");
				foreach($tset->result() as  $dset)
				{
					$macam_pembayaran = $dset->macam_pembayaran;
					$besar = $dset->besar;
					$jmltagihan = $jmltagihan + $besar;
					//cari jumlah pembayaran
					$tby = $this->db->query("select * from siswa_bayar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and nis='$nis'");
					$terbayar = 0;
					foreach($tby->result() as $dby)
					{
						$terbayar = $terbayar + $dby->besar;
					}
					//terbayar
					$jmlterbayar = $jmlterbayar + $terbayar;
					$tbayar = $tbayar + $jmlterbayar;
				}
			}
			echo '<tr bgcolor="#fff"><td>'.$namasiswa.'</td><td align="right">'.number_format($jmltagihan).'</td><td align="right">'.number_format($jmlterbayar).'</td><td align="right">';
			$kekurangan = $jmltagihan - $jmlterbayar;
			if($kekurangan < 0)
			{
				echo '<div class="alert alert-danger">Kelebihan '.number_format($kekurangan).'</div>';
			}
			else
			{
				echo '<div class="alert alert-danger">'.number_format($kekurangan).'</div>';
			}
			echo '</td></tr>';
		}
	}
	echo '</table>';
	echo '<p>Kekurangan ; '.xduit($tbayar).'<br />Terbilang '.xduitf($tbayar);
	echo '<br>per tanggal '.date("d").'-'.date("m").'-'.date("Y").'';

}
?>
</div></body></html>
