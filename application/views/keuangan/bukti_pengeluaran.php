<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
if($query->num_rows() == 0)
{
	echo 'data tidak ditemukan <a href="'.base_url().'keuangan/siswa">Batal</a>';
}
else
{
	echo '<table width="100%"><tr><td>';
	if(!empty($baris1))
	{
		echo $baris1.'<br />';
	}
	if(!empty($baris2))
	{
		echo $baris2.'<br />';
	}
	if(!empty($baris3))
	{
		echo $baris3.'<br />';
	}
	if(!empty($baris4))
	{
		echo $baris4;
	}
	echo '</td><td><table width="100%" bgcolor="#ccc"><tr bgcolor="#fff"><td><h3><p class="text-center"><a href="'.base_url().'keuangan/keluar/tampil">BUKTI PENGELUARAN</a></p></h3></td></tr></table></td></tr></table>';
	echo '<table width="100%" bgcolor="#ccc"><tr bgcolor="#fff"><td></td></tr></table>';
	foreach($query->result() as $q)
	{
		echo '<table width="100%"><tr><td width="15%">Cara Transaksi</td><td width="35%">: Tunai</td><td width="15%">Tanggal</td><td>: '.tanggal($q->tanggal).'</td></tr>';
		echo '<tr><td width="15%" valign="top">Terbilang</td><td width="35%" rowspan="2" valign="top">: '.strtolower(xduitf($q->besar)).'</td><td width="15%">Nomor Bukti</td><td>: '.$q->id_keluar.'</td></tr>';
		echo '<tr><td colspan="4"><p>Dengan rincian transaksi sebagai berikut:</p></td></tr></table>';
		echo '<table width="100%" bgcolor="#ccc"><tr bgcolor="#fff"><td width="10%">Sumber</td><td width="20%">Jenis Pengeluaran</td><td width="50%">Keterangan</td><td align="right">Besar Pengeluaran</td></tr>';
		echo '<tr bgcolor="#fff"><td>'.$q->sumber.'</td><td>'.$q->jenis.'</td><td>'.$q->keterangan.'</td><td align="right">Rp '.number_format($q->besar).'</tr></table><br />';

	}
/*
		echo '<table width="100%"><tr valign="top"><td width="15%"></td><td width="30%" >Menyetujui<br />'.$this->config->item('plt').'Kepala,<br /><br /><br />'.cari_kepala(cari_thnajaran(),cari_semester()).'<br />NIP '.cari_nip_kepala(cari_thnajaran(),cari_semester()).'</td><td>Yang mengeluarkan,<br /><br /><br /><br />'.$namapengguna.'</td><td>Yang menerima,<br /><br /><br /><br />'.$q->penerima.'</td></tr></table>';
*/
		echo '<table width="100%"><tr valign="top"><td width="15%"></td><td width="30%">Yang mengeluarkan,<br /><br /><br /><br />';
	if(!empty($bendahara_komite))
	{
		echo $bendahara_komite;
	}
	else
	{
		echo $namapengguna;
	}
	echo '</td><td width="30%"></td><td>Yang menerima,<br /><br /><br /><br />'.$q->penerima.'</td></tr></table>';

}?>
</div></body></html>
