<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
/////// Sistem Informasi Madrasah 			///////
///////////////////////////////////////////////////////////////
/////// Dibuat oleh : Selamet Hanafi, S.Si		///////
/////// email	 : selamethanafi@yahoo.co.id		///////
/////// Hp	 : 081226623835				///////
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
$nohpbp='';
$ta = $this->db->query("select * from `m_referensi` where `opsi` = 'nohpbp'");
foreach($ta->result() as $a)
{
	$nohpbp = $a->nilai;
}
$nohpkesiswaan='';
$ta = $this->db->query("select * from `m_referensi` where `opsi` = 'nohpkesiswaan'");
foreach($ta->result() as $a)
{
	$nohpkesiswaan = $a->nilai;
}
$nohpadmin = '';
$ta = $this->db->query("select * from `m_referensi` where `opsi` = 'nohpadmin'");
foreach($ta->result() as $a)
{
	$nohpadmin = $a->nilai;
}

$tahun = date("Y");
$bulan = date("m");
$tanggal = date("d");

$id_sms_user = '';
//nol kan remisi
if ($bulan=='07') 
{
//	$this->db->query("delete from siswa_remisi");
}

if (($bulan=='07') or ($bulan=='08') or ($bulan=='09') or ($bulan=='10') or ($bulan=='11') or ($bulan=='12'))
{
	$tahun2 = $tahun+1;
	$thnajaran = ''.$tahun.'/'.$tahun2.'';
	$semester = 1;
}
else
{
	$tahun1 = $tahun-1;
	$thnajaran = ''.$tahun1.'/'.$tahun.'';
	$semester = 2;
}
$this->db->query("delete from siswa_kredit_total");
$tx = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester'");
foreach($tx->result() as $dx)
{	
	
	$nis = $dx->nis;
	// hitung
	$ty = $this->db->query("select * from siswa_kredit where thnajaran = '$thnajaran' and nis='$nis'");
	$nilai =0;
	foreach($ty->result() as $dy)
	{
		$nilai = $nilai+$dy->point;
	}
	// masukkan ke siswa kredit toal
	if ($nilai>0)
	{
		$this->db->query("INSERT INTO `siswa_kredit_total` (`nis`, `nilai`) VALUES ('$nis', '$nilai')");
	}
}
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$tsikre = $this->db->query("select * from `siswa_kredit_total`");
foreach($tsikre->result() as $dsikre)
{
	$nis=$dsikre->nis;
	$nilai = $dsikre->nilai;
	$pesan ="telah mencapai angka kredit $nilai";
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	$kodeguru = cari_walikelas($thnajaran,$semester,$kelas);
	$nowalikelas = cari_seluler_pegawai($kodeguru);
	$chat_id_walikelas = cari_chat_id_pegawai($kodeguru);
	if(empty($nowalikelas))
	{$nowalikelas = $nohpadmin;}
	$namawalikelas = cari_nama_pegawai($kodeguru);
	$namasiswa = nis_ke_nama($nis);
	$namasiswa = preg_replace("/`/","\'", $namasiswa);

	//> 25
	// cek di pemberitahuan
	if ($nilai>=25)
	{
		$tpemb=$this->db->query("select * from `pemberitahuan` where `thnajaran`='$thnajaran' and `nis`='$nis' and `ke`='1'");
		$sudah1 = $tpemb->num_rows();
		if ($sudah1==0)
		{
			$this->db->query("insert into `pemberitahuan` (`nis`,`thnajaran`,`ke`) values ('$nis','$thnajaran','1')");
			$noPengirim = $nowalikelas;
			$reply = "INFO PORTAL: $namasiswa $pesan"; 
			if(!empty($chat_id_walikelas))
			{
				$kirimpesan = kirimtelegram($chat_id_walikelas,$reply,$token_bot);
			}
			else
			{
				if (!empty($noPengirim))
				{
					$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply','$id_sms_user')";
					$hasil3 = $this->db->query($query3);
				}
			}
		}
			
	} // akhir pemberitahuan 1
	//> 50
	// cek di pemberitahuan
	if ($nilai>=50)
	{
		$tpemb=$this->db->query("select * from `pemberitahuan` where `thnajaran`='$thnajaran' and `nis`='$nis' and `ke`='2'");
		$sudah2 = $tpemb->num_rows();
		if ($sudah2==0)
		{
			$this->db->query("insert into `pemberitahuan` (`nis`,`thnajaran`,`ke`) values ('$nis','$thnajaran','2')");
			$noPengirim = $nowalikelas;
			$reply = "INFO PORTAL: $namasiswa $pesan"; 
			if(!empty($chat_id_walikelas))
			{
				$kirimpesan = kirimtelegram($chat_id_walikelas,$reply,$token_bot);
			}
			else
			{
				if (!empty($noPengirim))
				{
					$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply','$id_sms_user')";
					$hasil3 = $this->db->query($query3);
				}
			}
		}	

	} // akhir pemberitahuan 2
	//> 75
	// cek di pemberitahuan
	if ($nilai>=75)
	{
		$tpemb=$this->db->query("select * from `pemberitahuan` where `thnajaran`='$thnajaran' and `nis`='$nis' and `ke`='3'");
		$sudah3 = $tpemb->num_rows();
		if ($sudah3==0)
		{
			$this->db->query("insert into `pemberitahuan` (`nis`,`thnajaran`,`ke`) values ('$nis','$thnajaran','3')");
			$tb = $this->db->query("select * from `tbllogin` where `status`='BP'");
			foreach($tb->result() as $b)
			{
				$noPengirim = $b->idlink;
				$reply = "INFO PORTAL: $namasiswa $pesan"; 
				if (!empty($noPengirim))
				{
					$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply', '$id_sms_user')";
					$hasil3 = $this->db->query($query3);
				}
			}
			$noPengirim = $nowalikelas;
			$reply = "INFO PORTAL: $namasiswa $pesan"; 
			if(!empty($chat_id_walikelas))
			{
				$kirimpesan = kirimtelegram($chat_id_walikelas,$reply,$token_bot);
			}
			else
			{
				if (!empty($noPengirim))
				{
					$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply', '$id_sms_user')";
					$hasil3 = $this->db->query($query3);
				}
			}
		}	
	} // akhir pemberitahuan 3

	//> 100
	// cek di pemberitahuan
	if ($nilai>=100)
	{
		$tpemb=$this->db->query("select * from `pemberitahuan` where `thnajaran`='$thnajaran' and `nis`='$nis' and `ke`='4'");
		$sudah4 = $tpemb->num_rows();
		if ($sudah4==0)
		{
			$this->db->query("insert into `pemberitahuan` (`nis`,`thnajaran`,`ke`) values ('$nis','$thnajaran','4')");
			$tb = $this->db->query("select * from `tbllogin` where `status`='BP'");
			foreach($tb->result() as $b)
			{
				$noPengirim = $b->idlink;
				$reply = "INFO PORTAL: $namasiswa $pesan"; 
				if (!empty($noPengirim))
				{
					$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply', '$id_sms_user')";
					$hasil3 = $this->db->query($query3);
				}
			}
			$noPengirim = $nowalikelas;
			$reply = "INFO PORTAL: $namasiswa $pesan"; 
			if(!empty($chat_id_walikelas))
			{
				$kirimpesan = kirimtelegram($chat_id_walikelas,$reply,$token_bot);
			}
			else
			{
				if (!empty($noPengirim))
				{
					$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply', '$id_sms_user')";
					$hasil3 = $this->db->query($query3);
				}
			}
			$noPengirim = $nohpkesiswaan;
			$reply = "INFO PORTAL: $namasiswa $pesan"; 
			if (!empty($noPengirim))
			{
					$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply', '$id_sms_user')";
					$hasil3 = $this->db->query($query3);
			}
		}	
	} // akhir pemberitahuan 3
	//> 125
	// cek di pemberitahuan
	if ($nilai>=125)
	{
		$tpemb=$this->db->query("select * from `pemberitahuan` where `thnajaran`='$thnajaran' and `nis`='$nis' and `ke`='5'");
		$sudah5 = $tpemb->num_rows();
		if ($sudah5==0)
		{
			$this->db->query("insert into `pemberitahuan` (`nis`,`thnajaran`,`ke`) values ('$nis','$thnajaran','5')");
			$noPengirim = $nohpbp;
			$reply = "INFO PORTAL: $namasiswa $pesan"; 
			if (!empty($noPengirim))
			{
				$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply', '$id_sms_user')";
				$hasil3 = $this->db->query($query3);
			}
			$noPengirim = $nowalikelas;
			$reply = "INFO PORTAL: $namasiswa $pesan"; 
			if(!empty($chat_id_walikelas))
			{
				$kirimpesan = kirimtelegram($chat_id_walikelas,$reply,$token_bot);
			}
			else
			{
				if (!empty($noPengirim))
				{
					$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply', '$id_sms_user')";
					$hasil3 = $this->db->query($query3);
				}
			}
			$noPengirim = $nohpkesiswaan;
			$reply = "INFO PORTAL: $namasiswa $pesan"; 
			if (!empty($noPengirim))
			{
				$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, id_sms_user) VALUES ('$noPengirim', '$reply', '$id_sms_user')";
				$hasil3 = $this->db->query($query3);
			}
		}	
	} // akhir pemberitahuan 5

}

//TES
/*
$tahun = '2017';
$bulan = '09';
$tgl = '01';
*/
//
$hariini = "$tahun-$bulan-$tanggal";
$blnthn = "$tahun-$bulan";

// PEMBERITAHUAN
$tpegawai = $this->db->query("select * from `p_pegawai` where `kgb_sms` like '$blnthn%' and status='Y'");
$ada = $tpegawai->num_rows();
//echo "$ada $hariini";
if ($ada>0)
{
	foreach($tpegawai->result_array() as $dpegawai)
	{
		$str=$dpegawai['kgb_yad'];
		$postedyear=substr($str,0,4);
		$postedmonth=substr($str,5,2);
	  	$postedday=substr($str,8,2);
		$bulan='';
		if ($postedmonth=="01")
		{
			$bulan = "Januari";
		}
		if ($postedmonth=="02")
		{
			$bulan = "Februari";
		}
		if ($postedmonth=="03")
		{
			$bulan = "Maret";
		}
		if ($postedmonth=="04")
		{
			$bulan = "April";
		}
		if ($postedmonth=="05")
		{
			$bulan = "Mei";
		}
		if ($postedmonth=="06")
		{
			$bulan = "Juni";
		}
		if ($postedmonth=="07")
		{
			$bulan = "Juli";
		}
		if ($postedmonth=="08")
		{
			$bulan = "Agustus";
		}
		if ($postedmonth=="09")
		{
			$bulan = "September";
		}
		if ($postedmonth=="10")
		{
			$bulan = "Oktober";
		}
		if ($postedmonth=="11")
		{
			$bulan = "November";
		}
		if ($postedmonth=="12")
		{
			$bulan = "Desember";
		}
		$tanggalkgb = "$postedday $bulan $postedyear";	
		$seluler=$dpegawai['seluler'];
		$jenkel =$dpegawai['jenkel'];
		$kd_pegawai = $dpegawai['kd'];
		$namapegawai = $dpegawai['nama'];
		$namapegawai = preg_replace("/`/","\'", $namapegawai);
		if ($jenkel=='Lk')
		{$pesanybs='INFO PORTAL: Yth. Bapak '.$namapegawai.', bulan depan gaji Bapak naik berkala per '.$tanggalkgb.'';}
		else
		{$pesanybs='INFO PORTAL: Yth. Ibu '.$namapegawai.', bulan depan gaji Ibu naik berkala per '.$tanggalkgb.'';}
		$chat_id_pegawai = $dpegawai['chat_id'];
		if(!empty($chat_id_pegawai))
		{
			$kirimpesan = kirimtelegram($chat_id_pegawai,$pesanybs,$token_bot);
		}
		$tahunsmsyad=substr($dpegawai['kgb_sms'],0,4)+2;
		$sms_yad = ''.$tahunsmsyad.'-'.substr($dpegawai['kgb_sms'],4,8).'';
		$this->db->query("update `p_pegawai` set `kgb_sms`='$sms_yad' where `kd`='$kd_pegawai'");
	}
}
// HARI INI
$tpegawai = $this->db->query("select * from `p_pegawai` where `kgb_yad` like '$blnthn%' and status='Y'");
$ada = $tpegawai->num_rows();
//echo "<br>Sudah kgb $ada $hariini";
if ($ada>0)
{
	foreach($tpegawai->result_array() as $dpegawai)
	{
		$str=$dpegawai['kgb_yad'];
		$postedyear=substr($str,0,4);
		$postedmonth=substr($str,5,2);
	  	$postedday=substr($str,8,2);
		$blntgl = "$postedmonth-$postedday";
		$bulan='';
		if ($postedmonth=="01")
		{
			$bulan = "Januari";
		}
		if ($postedmonth=="02")
		{
			$bulan = "Februari";
		}
		if ($postedmonth=="03")
		{
			$bulan = "Maret";
		}
		if ($postedmonth=="04")
		{
			$bulan = "April";
		}
		if ($postedmonth=="05")
		{
			$bulan = "Mei";
		}
		if ($postedmonth=="06")
		{
			$bulan = "Juni";
		}
		if ($postedmonth=="07")
		{
			$bulan = "Juli";
		}
		if ($postedmonth=="08")
		{
			$bulan = "Agustus";
		}
		if ($postedmonth=="09")
		{
			$bulan = "September";
		}
		if ($postedmonth=="10")
		{
			$bulan = "Oktober";
		}
		if ($postedmonth=="11")
		{
			$bulan = "November";
		}
		if ($postedmonth=="12")
		{
			$bulan = "Desember";
		}
		$tanggalkgb = "$postedday $bulan $postedyear";	
		$seluler=$dpegawai['seluler'];
		$jenkel =$dpegawai['jenkel'];
		$kd_pegawai = $dpegawai['kd'];
		$nama = $dpegawai['nama'];
		$nama = preg_replace("/`/","\'", $nama);
		if ($jenkel=='Lk')
		{$pesanybs='INFO PORTAL: Yth. Bapak '.$nama.', bulan ini gaji Bapak naik berkala per '.$tanggalkgb.'';}
		else
		{$pesanybs='INFO PORTAL: Yth. Ibu '.$nama.', bulan ini gaji Ibu naik berkala per '.$tanggalkgb.'';}
		$noPengirim = $dpegawai['seluler'];
		$chat_id_pegawai = $dpegawai['chat_id'];
		if(!empty($chat_id_pegawai))
		{
			$kirimpesan = kirimtelegram($chat_id_pegawai,$pesanybs,$token_bot);
		}
		$tahunkgbyad=substr($dpegawai['kgb_yad'],0,4)+2;
		$kgb_yad = ''.$tahunkgbyad.''.substr($dpegawai['kgb'],4,8).'';
		$tahunsekarang=substr($hariini,0,4).'';
		$kgb = $dpegawai['kgb_yad'];
		$this->db->query("update `p_pegawai` set `kgb_yad`='$kgb_yad', `kgb`='$kgb' where `kd`='$kd_pegawai'");
	}
} // akhir hari ini sudah kgb
?>
