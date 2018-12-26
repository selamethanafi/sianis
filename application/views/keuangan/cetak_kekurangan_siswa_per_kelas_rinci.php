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
if ((!empty($thnajaran)) and (!empty($ruang)) and (!empty($semester)))
{
	$tbayar = 0;
	$jmlkekurangan = 0;
	$banyakkolom = 0;
	echo '<h3><p class="text-center"><a href="'.base_url().'keuangan/kekurangansiswaperkelas">DAFTAR KEKURANGAN PEMBAYARAN SISWA KELAS '.$ruang.' TAHUN '.$thnajaran.'</a></p></h3>';
	$tskk = $this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and `semester`='$semester' and kelas='$ruang' and status='Y' order by no_urut");
	$jmlbsrtung = 0;
	$jmltung = 0;
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

		echo '<p><strong>'.$namasiswa.'</strong></p>';
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
			echo '<table width="100%" bgcolor="#ccc">
			<tr bgcolor="#fff" align="center"><td>Tahun Pelajaran</td><td>Kelas</td><td>Macam Pembayaran</td>';
			echo '<td align="center" width="12%">Besar</td><td align="center" width="12%">Terbayar</td></tr>';
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
					echo '<tr bgcolor="#fff"><td>'.$thnajaran.'</td><td>'.$kelas.'</td>';
					echo '<td>'.$macam_pembayaran.'</td><td align="right">'.number_format($besar).'</td>';
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
					echo '<td align="right">'.number_format($terbayar).'</td></tr>';
				}
			}
			$jmltagihan2 = 0;
			$jmlterbayar2 = 0;
			$tmacam = $this->db->query("select * from `non_komite_besar` where `nis`='$nis'");
			if($tmacam->num_rows()>0)
			{
				foreach($tmacam->result() as $h)
				{
					$id_non_komite = $h->id_non_komite;
					$besar2 = $h->besar;
					$jmltagihan2 = $jmltagihan2 + $besar2;
					$ti = $this->db->query("select * from `non_komite_bayar` where `id_non_komite`='$id_non_komite' and nis='$nis'");
					$terbayar2 = 0;
					foreach($ti->result() as $di)
					{
						$terbayar2 = $terbayar2 + $di->besar;
					}
					$tg = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
					$nama_tunggakan = '';
					foreach($tg->result() as $g)
					{
						$nama_tunggakan = $g->nama_tunggakan;
					}
					//terbayar
					$jmlterbayar2 = $jmlterbayar2 + $terbayar2;
					echo '<tr><td></td><td></td><td>'.$nama_tunggakan.'</td><td align="right">'.number_format($besar2).'</td><td align="right">'.number_format($terbayar2).'</td><td align="right">'.xduit($jmltagihan2).'</td><td align="right">'.xduit($jmlterbayar2).'</td></tr>';
				}
				$kekurangan2 = $jmltagihan2 - $jmlterbayar2;
			}
			$jmltagihan = $jmltagihan + $jmltagihan2;
			$jmlterbayar = $jmlterbayar + $jmlterbayar2;
			echo '<tr align="right" bgcolor="#fff"><td colspan="3">Jumlah</td><td>'.number_format($jmltagihan).'</td><td>'.number_format($jmlterbayar).'</td></tr>';
			$kekurangan = $jmltagihan - $jmlterbayar + $kekurangan2;
			if($kekurangan < 0)
			{
				echo '<tr align="right" bgcolor="#fff"><td colspan="3">Kelebihan</td><td colspan="2"><div class="alert alert-danger">'.number_format($kekurangan).'</div></td></tr>';
			}
			else
			{
				echo '<tr align="right" bgcolor="#fff"><td colspan="3">Kekurangan</td><td colspan="2"><p class="text-info">'.number_format($kekurangan).'</p></td></tr>';
			}
			echo '</table>';	
		}
	}		
}
echo '<p>Kekurangan ; '.xduit($tbayar).'<br />Terbilang '.xduitf($tbayar);
echo '<br>per tanggal '.date("d").'-'.date("m").'-'.date("Y").'';
?>
</div></body></html>
