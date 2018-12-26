<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : cetak_skbk.php
// Lokasi      : application/views/tatausaha
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<div class="container-fluid"><h2>Mencetak SKBK / SKMT / SK Aktif Mengajar / Identitas Penerima Tunjangan Profesi</h2>
<?php
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$tahun1 = substr($thnajaran,0,4);
$querypegawai=$this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y' order by nama ASC");

echo '<table class="table table-striped table-hover table-bordered">';
	echo '<tr><td>Nama</td><td>Identitas</td><td>Daftar Berkas</td><td>Borang Supervisi</td><td>Hasil Supervisi</td><td>SKBK</td><td>SKMT</td><td>Surat Pernyataan</td></tr>';

foreach($querypegawai->result() as $qp)
{
	echo '<tr><td>'.$qp->nama.'</td><td><a href="'.base_url().'tatausaha/formcetakskbk/identitas/'.$tahun1.'/'.$semester.'/'.$qp->kode.'" target="_blank">Identitas</a></td><td><a href="'.base_url().'tatausaha/formcetakskbk/daftarberkas/'.$tahun1.'/'.$semester.'/'.$qp->kode.'" target="_blank">Daftar Berkas</a></td><td><a href="'.base_url().'tatausaha/formcetakskbk/borangsupervisi/'.$tahun1.'/'.$semester.'/'.$qp->kode.'" target="_blank">Borang Supervisi</a></td><td><a href="'.base_url().'tatausaha/formcetakskbk/hasilsupervisi/'.$tahun1.'/'.$semester.'/'.$qp->kode.'" target="_blank">Hasil Supervisi</a></td><td><a href="'.base_url().'tatausaha/formcetakskbk/skbk/'.$tahun1.'/'.$semester.'/'.$qp->kode.'" target="_blank">SKBK</td><td><a href="'.base_url().'tatausaha/formcetakskbk/skmt/'.$tahun1.'/'.$semester.'/'.$qp->kode.'" target="_blank">SKMT</td><td><a href="'.base_url().'tatausaha/formcetakskbk/pernyataan/'.$tahun1.'/'.$semester.'/'.$qp->kode.'" target="_blank">Surat Pernyataan</a></td></tr>';
}
?>
</table>
</div>
