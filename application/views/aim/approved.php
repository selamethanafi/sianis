<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<h1>Pengajuan izin siswa telah disetujui</h1>
<?php
$thnajaran = cari_thnajaran();
$semester= cari_semester();
$ta = $this->db->query("select * from `siswa_proses_izin` where `token`='$token'");
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$alasan = $a->alasan;
	$namasiswa = nis_ke_nama($nis);
	$kembali = $a->kembali;
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	if($kembali == 'T')
	{
		$pesan = 'Ananda '.$namasiswa.' dizinkan pulang karena '.$alasan;
	}
	else
	{
		$pesan = 'Ananda '.$namasiswa.' dizinkan meninggalkan sekolah karena '.$alasan;
	}

	$kirimtelegram = kirimtelegram($this->config->item('chat_id_grup_guru'),$pesan,$this->config->item('token_bot'));
}


