<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: status_ketuntasan.php
// Lokasi      		: application/views/guru
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$thnajaran = cari_thnajaran();
$adadata = 0;
$nis = '';
$cacah = 0;
$lanjut = 1;
$token = md5($this->config->item('awalttd'));
$url_ppdb = $url_ppdb.'/tukardata/unduh/'.$token.'/'.$nomor;
$dataxml = simplexml_load_file($url_ppdb);
foreach($dataxml->data as $a)
{
	$cacah = $a->cacah;
	$nis = $a->nis;
	$nomor_pendaftaran = $a->nomor_pendaftaran;
	$nama = nopetik($a->nama);
	$kls = $a->kls;
	$in['nomor_pendaftaran'] = $nomor_pendaftaran;
	$in['nis'] = $nis;
	$in['tglditerima'] = $a->tglditerima;
	$in['nisn'] = $a->nisn;
	$in['nama'] = $nama;
	$in['panggilan'] = $a->panggilan;
	$in['jenkel'] = $a->jenkel;
	$in['agama'] = $a->agama;
	$in['tmpt'] = $a->tmpt;	
	$in['tgllhr'] = $a->tgllhr;
	$in['bb'] = $a->bb;
	$in['tb'] = $a->tb;
	$in['goldarah'] = $a->goldarah;
	$in['anakke'] = $a->anakke;
	$in['kandung'] = $a->kandung;
	$in['tinggal'] = $a->tinggal;
	$in['jarak'] = $a->jarak;
	$in['alamat'] = $a->alamat;
	$in['desa'] = $a->desa;
	$in['dusun'] = $a->dusun;
	$in['rt'] = $a->rt;
	$in['rw'] = $a->rw;
	$in['kodepos'] = $a->kodepos;
	$in['hp'] = $a->hp;
	$in['transportasi'] = $a->transportasi;
	$in['hobi'] = $a->hobi;
	$in['cita_cita'] = $a->cita_cita;
	$in['nmayah'] = $a->nmayah;
	$in['nik_kk'] = $a->nik_kk;
	$in['payah'] = $a->payah;
	$in['sekayah'] = $a->sekayah;
	$in['alayah'] = $a->alayah;
	$in['dayah'] = $a->dayah;
	$in['tayah'] = $a->tayah;
	$in['nmibu'] = $a->nmibu;
	$in['nik_ibu'] = $a->nik_ibu;
	$in['pibu'] = $a->pibu;
	$in['tibu'] = $a->tibu;
	$in['alibu'] = $a->alibu;
	$in['sekibu'] = $a->sekibu;
	$in['dibu'] = $a->dibu;
	$in['dortu'] = $a->dortu;
	$in['yatim'] = $a->yatim;
	$in['twali'] = $a->twali;
	$in['nmwali'] = $a->nmwali;
	$in['sekwali'] = $a->sekwali;
	$in['pwali'] = $a->pwali;
	$in['dwali'] = $a->dwali;
	$in['nik'] = $a->nik;
	$in['nokk'] = $a->nokk;
	$in['kps'] = $a->kps;
	$in['pkh'] = $a->pkh;
	$in['kip'] = $a->kip;
	$in['kks'] = $a->kks;
	$in['sltp'] = $a->sltp;
	$in['jenis_sltp'] = $a->jenis_sltp;
	$in['kota_sltp'] = $a->kota_sltp;
	$in['kls'] = $a->kls;
	$in['nosttb'] = $a->nosttb;
	$in['skhun'] = $a->skhun;
	$in['wn'] = 'Indonesia';
	$in['kec'] = $a->kec;
	$in['kab'] = $a->kab;
	$in['prov'] = $a->prov;
	$adadata = 1;
}
if($nomor == 1)
{
	if($nisterakhir != $nis)
	{
//		$lanjut = 0;
	}
}
if($lanjut == 1)
{
	if(!empty($nis))
	{
		$psw = $nomor_pendaftaran;
		$options = array('cost' => 8);
		if(!empty($psw))
		{
			$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
		}
		$ta = $this->db->query("select * from tbllogin where `username`='$nis'");
		if($ta->num_rows() == 0)
		{
			$this->db->query("INSERT INTO `tbllogin` (`username` ,`psw` ,`nama` ,`status` ,`idlink`,`aktif`) VALUES ('$nis', '$psw' , '$nama', 'Siswa', '$nis','Y')");
		}
		else
		{
			$this->db->query("update tbllogin set `nama`='$nama', `psw`='$psw', aktif='Y' where `username`='$nis'");
		}
		$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
		if($tb->num_rows() == 0)
		{
			$this->db->query("INSERT INTO `datsis` (`nis` ,`nama`,`ket`) VALUES ('$nis', '$nama','Y')");
		}
		$tc = $this->db->query("select * from siswa_kelas where nis='$nis' and thnajaran='$thnajaran' and `semester`='1'");
		if($tc->num_rows() == 0)
		{
			$this->db->query("INSERT INTO `siswa_kelas` (`thnajaran`,`kelas`,`nis`,`no_urut`,`status`, `semester`) VALUES ('$thnajaran', '$kls', '$nis', '99','Y','1')");
		}
		else
		{
			$this->db->query("update `siswa_kelas` set `kelas`='$kls' where `thnajaran`= '$thnajaran' and `semester`='1' and `nis`= '$nis'");
		}
		$this->Tatausaha_model->Perbarui_Data_Siswa_Baru($in);
		echo '<h2>Mohon bersabar</h2>';
		if($nomor < $cacah)
		{
			$persen = $nomor/$cacah * 100;
			$persen = round($persen);
			echo '<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-success" style="width:'.$persen.'%;">
			'.$nama.' '.$nomor.' dari '.$cacah.' siswa ('.$persen.'%) terproses
			</div>
		      </div>';
			$nomor++;
			?>
			<script>setTimeout(function () {
			   window.location.href= '<?php echo base_url();?>ambilppdb/unduh/<?php echo $nomor?>';
			},1);
			</script>
			<?php
		}
		else
		{
			$persen = 100;
			echo '<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-success" style="width:'.$persen.'%;">
			'.$persen.'% terproses
			</div>
		      </div>';
		?>
			<h3>tunggu sampai berpindah halaman</h3>
			<script>setTimeout(function () {
				   window.location.href= '<?php echo base_url();?>tatausaha';
			},100);
				</script>
			<?php
		}
	}
}
else
{
	echo 'Galat, nis awal tidak cocok, periksa nis baru di web ini '.$nisterakhir.' dan di web ppdb '.$nis;
	echo '<p><a href="'.base_url().'tatausaha">kembali ke beranda tatausaha</a></p>';
}
?>
</div></div></div>
