<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 08 Jan 2016 09:44:23 WIB 
// Nama Berkas 		: skp.php
// Lokasi      		: application/views/kepala/
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
<a href="<?php echo base_url();?>kepala/perilaku/<?php echo $tahun;?>/"><h3 class="text-center">PERHITUNGAN PENILAIAN CAPAIAN SASARAN KERJA<BR />PEGAWAI NEGERI SIPIL</h3></a>
<?php
$tahuntmt  = '';
$tahunmasa = '';
$bulanmasa = '';
$akk = 0;
$akpkb = 0;
$akp = 0;
$kegolongan = '';
$permanen = '';
$tahunpenilaian = $tahun;
$tawalsistem = '';
$takhirsistem = '';
$ttahun = $this->db->query("SELECT * FROM `pkg_masa` where `tahun`='$tahun'");
foreach($ttahun->result() as $dtahun)
{
	$tawalsistem = $dtahun->awal;
	$takhirsistem = $dtahun->akhir;
}

$tx = $this->db->query("select * from p_pegawai where `nip`='$nip'");
foreach($tx->result() as $x)
{
	$namapegawai = $x->nama;
	$tempat = $x->tempat;
	$tgllhr = $x->tanggallahir;
	$usernamepegawai = $x->kd;
	$tmtguru = $x->tmt_guru;
	$jenkel = $x->jenkel;
	$kodeguru = $x->kodeguru;
/*
	$ = $x->;
*/
}
if(!empty($nip))
{
	if($id=='permanenkepala')
		{
		$this->db->query("update `ppk_pns` set `kepala`='1' where `tahun`='$tahunpenilaian' and `kode`='$nip'");
		$DestinationNumber=cari_seluler_pegawai($usernamepegawai);
		$TextDecoded = 'SKP '.$tahunpenilaian.' telah dinilai, silakan mencetak Hasil SKP dan DP3';
		$id_sms_user =$this->config->item('id_sms_user');
		$chat_id = $this->guru->get_Chat_Id($usernamepegawai);
			if(!empty($chat_id))
			{
				$this->load->helper('telegram');
				$pesantelegram = $TextDecoded;
				$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);
			}
			else
			{	
				$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`, `id_sms_user`) value ('$DestinationNumber', '$TextDecoded','$id_sms_user')");
			}

		}
	if($id=='batalpermanenkepala')
		{
		$this->db->query("update `ppk_pns` set `kepala`='0' where `tahun`='$tahunpenilaian' and `kode`='$nip'");
		$DestinationNumber=cari_seluler_pegawai($usernamepegawai);
		$TextDecoded = 'SKP '.$tahunpenilaian.' dinilai ulang';
		$chat_id = $this->guru->get_Chat_Id($usernamepegawai);
			if(!empty($chat_id))
			{
				$this->load->helper('telegram');
				$pesantelegram = $TextDecoded;
				$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);
			}
			else
			{	
				$id_sms_user =$this->config->item('id_sms_user');
				$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`, `id_sms_user`) value ('$DestinationNumber', '$TextDecoded','$id_sms_user')");
			}
		}
	if($id=='batalpermanenguru')
		{
			$this->db->query("update `ppk_pns` set `permanen`='0', `kepala`='0' where `tahun`='$tahunpenilaian' and `kode`='$nip'");
			$chat_id = $this->guru->get_Chat_Id($usernamepegawai);
			if(!empty($chat_id))
			{
				$this->load->helper('telegram');
				$pesantelegram = 'SKP '.$tahunpenilaian.' telah dibatalkan';
				$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);
			}
			else
			{	
				$DestinationNumber=cari_seluler_pegawai($usernamepegawai);
				$TextDecoded = 'SKP telah dibatalkan';
				$id_sms_user =$this->config->item('id_sms_user');
				$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`, `id_sms_user`) value ('$DestinationNumber', '$TextDecoded','$id_sms_user')");
			}
		}

	$tahunsebelumnya = $tahunpenilaian - 1;
	$tv = $this->db->query("select * from `ppk_pns` where tahun = '$tahunsebelumnya' and kode = '$nip'");
	$skplalu = 0;
	foreach($tv->result() as $v)
		{
		$skplalu = $v->skp;
		}
	$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$nip'");
	$permanen = '';
	$batas_skp = 0;
	$permanenpkg = 0;
	$idskakhir = '';
	foreach($tz->result() as $z)
		{
		$permanen = $z->permanen;
		$permanenkepala = $z->kepala;
		$batas_skp = $z->batas_skp;
		$idskawal = $z->skawal;
		$idskakhir = $z->skakhir;
		$tawal = $z->tawal;
		$takhir = $z->takhir;
		$permanenpkg = $z->permanen_pkg;
		}
$golongan = id_sk_jadi_golongan($idskakhir) ;
$pangkat = golongan_jadi_pangkat($golongan);
$jabatan = golongan_jadi_jabatan($golongan);
$golongan2 = id_sk_jadi_golongan($idskakhir) ;
$pangkat2 = golongan_jadi_pangkat($golongan2);
$jabatan2 = golongan_jadi_jabatan($golongan2);
}
if(empty($tawal))
{
	$tawal = $tawalsistem;
}
if(empty($takhir))
{
	$takhir = $takhirsistem;
}

if ((!empty($nip)) and ($permanen==1))
{
$awal = $tahunpenilaian ;
$akhir = $tahunpenilaian + 1;
$thnajarane = $awal."/".$akhir;
$semestere = 1;

$tkepeg = $this->db->query("select * from p_kepegawaian where id = '$idskakhir'");
if($tkepeg->num_rows() == 0)
{
	echo '<div class="alert alert-danger"><h1>Ybs. belum menentukan SK yang berlaku</h1></div>';
}
if($permanenpkg == 0)
{
	echo '<div class="alert alert-danger"><h1>Ybs. belum mempermanenkan PKG</h1></div>';
}
$pangkatgolongan = $pangkat2.'/'.$jabatan2.'/'.$golongan2;
$tahunsekarang = $tahunpenilaian;

$namasekolah = $this->config->item('sek_nama');
$teleponsekolah = $this->config->item('sek_telepon');
$desa = $this->config->item('sek_desa');
$kec = $this->config->item('sek_kec');
$kab = $this->config->item('sek_kab');
$prov = $this->config->item('sek_prov');
?>
<table class="table table-striped table-hover table-bordered">
<tr><td align="left">Nama</td><td><?php echo $namapegawai;?></td></tr>
<tr><td>NIP</td><td><?php echo $nip;?></td></tr>
<tr><td>Pangkat/Jabatan/Golongan</td><td><?php echo $pangkatgolongan;?></td></tr>
<tr><td>Periode Penilaian</td><td><p><?php echo date_to_long_string($tawal);?> s.d. <?php echo date_to_long_string($takhir);?></p></td></tr>
<tr><td>Tahun Penilaian</td><td><?php echo $tahunsekarang;?></td></tr></table>
<?php
//cari realisasi dari pkg
if ($permanenkepala == 0)
	{
	echo '<a href="'.base_url().'kepala/skp/'.$tahun.'/'.$nip.'/permanenkepala" class="btn btn-success" data-confirm ="Anda yakin akan mempermanenkan penilaian SKP '.$namapegawai.'?">Jadikan Permanen</a>&nbsp;&nbsp;&nbsp;&nbsp; atau &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.base_url().'kepala/skp/'.$tahun.'/'.$nip.'/batalpermanenguru" class="btn btn-danger" data-confirm ="Anda yakin akan membatalkan SKP '.$namapegawai.'?">Batalkan SKP</a>&nbsp;&nbsp;&nbsp;&nbsp';
echo '<h3><p class="text-info">Untuk menilai SKP, klik <a href="'.base_url().'kepala/nilaiskp/'.$tahun.'/'.$nip.'" class="btn btn-primary">disini</a>';
		
		echo '</p></h3>';

	}
	else
	{
	echo '<div class="alert alert-warning">Sudah terproses, kalau hendak mengubah, batalkan dulu, <a href="'.base_url().'kepala/skp/'.$tahun.'/'.$nip.'/batalpermanenkepala" class="btn btn-danger" data-confirm ="Anda yakin akan membatalkan PPK an '.$namapegawai.'?">Batalkan</b></a></div>';
	}
$nomor=1;

//echo 'skorpkg '.$jskor.' nilaipkg '.$nilaipkg.' akk '.$akk.' akpkb '.$akpkb.' akp '.$akp.' jw '.$jw.' jwm '.$jwm.' npk '.$npk;
echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr><td>No</td><td>KEGIATAN</td><td>T. AK</td><td>T. KUANT</td><td>T. MUTU</td><td>T. WAKTU</td><td>T. BIAYA</td><td>R. AK</td><td  colspan="2">R. KUANT</td><td>R. MUTU (%)</td><td>R. WAKTU</td><td>R. BIAYA</td><td>PERHI TUNG AN</td><td>NILAI CAPAIAN SKP</td></tr>';
//hitung dulu

$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nip' order by unsur,kode");
if(count($ta->result())>0)
{
foreach($ta->result() as $a)
	{
	$id_skp_skor_guru = $a->id_skp_skor_guru;
	$pembagi = 0;
	$to = $a->kuantitas;
	$ro = $a->kuantitas_r;
	$tw = $a->waktu;
	$rw = $a->waktu_r;
	$tk = $a->kualitas;
	$rk = $a->kualitas_r;
	$rb = $a->biaya_r;
	$tb = $a->biaya;
	$tj = $this->db->query("SELECT * FROM `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` ='$id_skp_skor_guru' and `nip`='$nip'");
	$adatj = $tj->num_rows();
	if($adatj > 0)
	{
			foreach($tj->result() as $j)
			{
				$to = $j->kuantitas;
				$tw = $j->waktu;
				$tk = $j->kualitas;
				$tb = $j->biaya;
			}
	}
//	$rw =0;
					$aspek_kualitas  = 0;
					$aspek_kuantitas  = 0;
				if ($tk>0)
					{
					$aspek_kualitas  = $rk / $tk * 100;
					}
				if ($to>0)
					{
					$aspek_kuantitas  = $ro / $to * 100;
					}

	if ($tb == 0)
		{$persentase_biaya = 0;
		}
		else
		{
		$persentase_biaya = 100 - ($rb/$tb*100);
		}
	if ($tw>0)
		{
		$persentase_waktu = 100 - ($rw/$tw*100);
		if (($persentase_waktu < 24 ) or ($persentase_waktu == 24 ))
			{
			$aspek_waktu = ((1.76*$tw)-$rw)/$tw*100;
			}
		else
			{
			$aspek_waktu_a = ((1.76*$tw)-$rw)/$tw*100;
			$aspek_waktu = 176 - $aspek_waktu_a;
			}
		}
		else
		{
		$aspek_waktu = 0;
		}
	if (($persentase_biaya < 24 ) or ($persentase_biaya == 24 ))
		{
		if ($persentase_biaya == 0)
			{
			$aspek_biaya = 0;
			}
			else
			{
			$aspek_biaya = ((1.76*$tb)-$rb)/$tb*100;
			}
		}
		else
		{
		$aspek_biaya_a = ((1.76*$tb)-$rb)/$tb*100;
		$aspek_biaya = 176 - $aspek_biaya_a;
		}
	if ($aspek_kuantitas !== 0)
		{
		$pembagi++;
		} 
	if ($aspek_kualitas !== 0)
		{
		$pembagi++;
		} 
	if ($aspek_waktu !== 0)
		{
		$pembagi++;
		} 
	if ($aspek_biaya !== 0)
		{
		$pembagi++;
		} 
		$perhitungan = $aspek_kuantitas+$aspek_kualitas+$aspek_waktu+$aspek_biaya;
	if ($pembagi == 0)
		{$skp = 0;}
		else
		{
		$skp = $perhitungan/$pembagi;
		}

	$perhitunganx = round($perhitungan,2);
	$skpx = round($skp,2);
	$this->db->query("update `skp_skor_guru` set `perhitungan`='$perhitunganx', `capaian_skp`='$skpx' where `id_skp_skor_guru`='$id_skp_skor_guru'");
	}
$jskp = 0 ;
$nomor = 1;
$cacahitem = 0;
}
$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nip' order by `nourut`");
if(count($ta->result())>0)
{
$jak = 0;
$jakr = 0;
foreach($ta->result() as $a)
	{
		if(($a->kegiatan == 'Unsur utama') or ($a->kegiatan == 'Unsur Penunjang Tugas Guru') or ($a->kegiatan == 'Unsur PKB'))
		{
			echo '<tr><td align="center"></td><td><strong>'.$a->kegiatan.'</strong></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td></td><td></td><td></td></tr>';
		}
		else
		{

			echo '<tr><td align="center">'.$nomor;
			$id_skp = $a->id_skp_skor_guru;
			$tf = $this->db->query("select * from `skp_realisasi` where `id_skp`='$id_skp'");
			$bulanrealisasi = '';
			$usul = $tf->num_rows();
			foreach($tf->result() as $f)
			{
				if(empty($bulanrealisasi))
				{
					$bulanrealisasi .= gantibulan($f->bulan);
				}
				else
				{
					$bulanrealisasi .= ' '.gantibulan($f->bulan);
				}

			}
			$tk = $this->db->query("SELECT * FROM `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` ='$id_skp' and `nip`='$nip'");
			$adatk = $tk->num_rows();
			if($adatk > 0)
			{
				foreach($tk->result() as $k)
				{
					$rto = $k->kuantitas;
					$rtw = $k->waktu;
					$rtk = $k->kualitas;
					$rtb = $k->biaya;
				}
			}
				if($adatk == 0)
				{
				echo '</td><td>'.$a->kegiatan.'<p class="text-info">'.$bulanrealisasi.'</p></td><td align="center">'.$a->ak_target.'</td><td align="center">'.$a->kuantitas.'</td><td align="center">'.$a->kualitas.'</td><td align="center">'.$a->waktu.'</td><td align="center">'.$a->biaya.'</td><td align="center">'.$a->ak_r.'</td><td align="center">'.$usul.'</td><td align="center">'.$a->kuantitas_r.'</td><td align="center">'.$a->kualitas_r.'</td><td align="center">'.$a->waktu_r.'</td><td align="center">'.$a->biaya_r.'</td>';
			}
			else
			{
				echo '</td><td>'.$a->kegiatan.'<p class="text-info">'.$bulanrealisasi.'</p></td><td align="center">'.$a->ak_target.'</td><td align="center"><s>'.$a->kuantitas.'</s><br />'.$rto.'</td><td align="center"><s>'.$a->kualitas.'</s><br />'.$rtk.'</td><td align="center"><s>'.$a->waktu.'</s><br />'.$rtw.'</td><td align="center"><s>'.$a->biaya.'</s><br />'.$rtb.'</td><td align="center">'.$a->ak_r.'</td><td align="center">'.$usul.'</td><td align="center">'.$a->kuantitas_r.'</td><td align="center">'.$a->kualitas_r.'</td><td align="center">'.$a->waktu_r.'</td><td align="center">'.$a->biaya_r.'</td>';
			}

			echo '<td align="center">'.round($a->perhitungan,2).'</td><td align="center">'.round($a->capaian_skp,2).'</td></tr>';
			$jak = $jak + $a->ak_target;
			$jakr = $jakr + $a->ak_r;
			$jskp = $jskp + $a->capaian_skp;
			$cacahitem++;
			$nomor++;
		}
	}

}
echo '<tr><td align="center"></td><td></td><td align="center">'.$jak.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center">'.$jakr.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td></td><td></td><td></td></tr>';

//echo 'skorpkg '.$jskor.' nilaipkg '.$nilaipkg.' akk '.$akk.' akpkb '.$akpkb.' akp '.$akp.' jw '.$jw.' jwm '.$jwm.' npk '.$npk;


$jskpasli = $jskp;
if ($cacahitem == 0)
	{
	$jskp = 'Galat';
	}
	else
	{$jskp = $jskp / $cacahitem;
	}
	$nomor = $nomor+1;
	echo '<tr><td align="center" colspan="12">Nilai capaian SKP</td><td align="center" colspan="2">'.round($jskp,2).'</td></tr>';
	if ($jskp>= 91)
		{
		$predikat='Sangat baik';
		}

	if ($jskp< 91)
		{
		$predikat='Baik';
		}

	if ($jskp<= 75)
		{
		$predikat='BURUK';
		}
	$nomor++;
	$hasilskp = round($jskp,3);
	$skpfinal = $hasilskp;
/*	if ($hasilskp>$batas_skp)
		{
		$skpfinal = $batas_skp;
		}
*/
	$this->db->query("update `ppk_pns` set `skp`='$skpfinal' where `tahun`='$tahunpenilaian' and `kode`='$nip'");
	echo '<tr><td align="center" colspan="12">Predikat</td><td align="center" colspan="2">'.$predikat.'</td></tr>';
	$nomor++;
	echo '<tr><td align="center" colspan="12">Nilai capaian SKP disetujui</td><td align="center" colspan="2"><strong>'.round($skpfinal,2).'</strong></td></tr>';
	if ($skpfinal>= 91)
		{
		$predikatfinal='Sangat baik';
		}

	if ($skpfinal< 91)
		{
		$predikatfinal='Baik';
		}

	if ($skpfinal<= 75)
		{
		$predikatfinal='BURUK';
		}
	$nomor++;
	echo '<tr><td align="center" colspan="12">Predikat SKP disetujui</td><td align="center" colspan="2"><strong>'.$predikatfinal.'</strong></td></tr>';
	$nomor++;
	echo '<tr><td align="center" colspan="12">Nilai capaian SKP Tahun '.$tahunsebelumnya.'</td><td align="center" colspan="2"><strong>'.round($skplalu,2).'</strong></td></tr>';

$nomor++;
?>
</table></div>

<?php
echo '<h3><p class="text-center">PENILAIAN PRESTASI KERJA PEGAWAI NEGERI SIPIL<br />';
if($permanenkepala == 1)
	{echo 'STATUS PERMANEN KEPALA</p></h3>';
	}
	else
	{echo 'STATUS BELUM PERMANEN KEPALA</p></h3>';
	}
echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr><td colspan="7">Sasaran Kinerja Pegawai</td><td align="center">'.round($skpfinal,2).' x 60%</td><td align="center">';
$hskp = $skpfinal * 0.6;
echo ''.round($hskp,2).'</td></tr>';
echo '<tr bgcolor="#FFF" align="center"><td>Bulan</td><td width="10%">Orientasi Pelayanan</td><td width="10%">Integritas</td><td width="10%">Komitmen</td><td width="10%">Disiplin</td><td width="10%">Kerja sama</td><td width="10%">Kepemimpinan</td><td></td><td></td></tr>';
$td = $this->db->query("SELECT * FROM `perilaku_pns` where `tahun`='$tahunsekarang' and `nip`='$nip' order by bulan");
$nomor = 1;
$p1 = 0;
$p2 = 0;
$p3 = 0;
$p4 = 0;
$p5 = 0;
$p6 = 0;
foreach($td->result() as $d)
	{
	$p1 = $p1 + $d->pelayanan;
	$p2 = $p2 + $d->integritas;
	$p3 = $p3 + $d->komitmen;
	$p4 = $p4 + $d->disiplin;
	$p5 = $p5 + $d->kerjasama;
	$p6 = $p6 + $d->kepemimpinan;
	echo '<tr align="center"><td>'.angka_jadi_bulan($d->bulan).'</td><td>'.$d->pelayanan.'</td><td>'.$d->integritas.'</td><td>'.$d->komitmen.'</td><td>'.$d->disiplin.'</td><td>'.$d->kerjasama.'</td><td>'.$d->kepemimpinan.'</td><td></td><td></td></tr>';
	$nomor++;
	}
	$tahunawal = substr($tawal,0,4);
	$tahunakhir = substr($takhir,0,4);
	$bulanawal = substr($tawal,5,2);
	$bulanakhir = substr($takhir,5,2);
	$cacahtahun = $tahunakhir + $tahunawal;
	if($cacahtahun > 0)
	{
		$masapenilaian = 12;
	}
	else
	{
		$masapenilaian = $bulanakhir - $bulanawal + 1 ;
	}

	if($masapenilaian>0)
	{
		$p1 = $p1 / $masapenilaian ;
		$p2 = $p2 / $masapenilaian ;
		$p3 = $p3 / $masapenilaian ;
		$p4 = $p4 / $masapenilaian ;
		$p5 = $p5 / $masapenilaian ;
		$p6 = $p6 / $masapenilaian ;
	}
	else
	{

		$p1 = $p1 / 12 ;
		$p2 = $p2 / 12 ;
		$p3 = $p3 / 12 ;
		$p4 = $p4 / 12 ;
		$p5 = $p5 / 12 ;
		$p6 = $p6 / 12 ;
	}

	echo '<tr bgcolor="#FFF" align="center"><td>Rata - rata<br />Bulan akhir penilaian = '.$bulanakhir.'<br >Bulan awal penilaian = '.$bulanawal.'<br />Masa Penilaian = '.$masapenilaian.' bulan</td><td>'.round($p1,2).'</td><td>'.round($p2,2).'</td><td>'.round($p3,2).'</td><td>'.round($p4,2).'</td><td>'.round($p5,2).'</td><td>'.round($p6,2).'</td>';
	$jmlnilaiperilaku = ($p1 + $p2 + $p3 + $p4 + $p5 + $p6 );
	if($p6>0)
	{
		$nilaiperilaku = $jmlnilaiperilaku / 6;
	}
	else
	{
		$nilaiperilaku = $jmlnilaiperilaku / 5;
	}

	$nilaiakhirperilaku = $nilaiperilaku * 0.4;
	echo '<td>'.round($nilaiperilaku,2).' x 40%</td><td>'.round($nilaiakhirperilaku,2).'</td></tr>';
	$nilaiprestasi = $hskp + $nilaiakhirperilaku;
	if ($nilaiprestasi>= 91)
		{
		$predikat='Sangat baik';
		}

	if ($nilaiprestasi< 91)
		{
		$predikat='Baik';
		}

	if ($nilaiprestasi<= 75)
		{
		$predikat='BURUK';
		}
	$tdl = $this->db->query("SELECT * FROM `ppk_pns` where `tahun`='$tahunsebelumnya' and `kode`='$nip'");
	$nilaiprestasilalu = '?';
	foreach($tdl->result() as $dl)
	{
		$nilaiprestasilalu = $dl->npk;
	}
	echo '<tr bgcolor="#FFF" align="center"><td colspan="8">Nilai Prestasi Kerja Tahun '.$tahunsebelumnya.'</td><td>'.round($nilaiprestasilalu,2).'</td></tr>';
	$npk = round($nilaiprestasi,2);
	$this->db->query("update `ppk_pns` set `npk`='$npk' where `tahun`='$tahun' and `kode`='$nip'");
	echo '<tr bgcolor="#FFF" align="center"><td colspan="8">Nilai Prestasi Kerja</td><td>'.$npk.'</td></tr>';
	echo '<tr bgcolor="#FFF" align="center"><td colspan="8">Predikat</td><td>'.$predikat.'</td></tr>';
	echo '</table></div>';

}
else
{
	if (empty($nip))
		{
		echo 'NIP pegawai kosong';
		}
	if ($permanen == 0)
		{
		echo ''.$namapegawai.' belum menetapkan skp';
		}
}
?>
<div class="clear padding40"></div>
</div>
