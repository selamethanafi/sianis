<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
if(!empty($record))
{
	$where = $record;
	$where = preg_replace("/x/","' or `id_siswa_bayar`='", $where);
	$where = '`id_siswa_bayar`=\''.$where.'\'';
	$ta = $this->db->query("select * from `siswa_bayar` where $where");
	$ada = $ta->num_rows();
	if($ada == 0)
	{
		echo 'data tidak ditemukan <a href="'.base_url().'keuangan/siswa">Batal</a>';
	}
	else
	{
		$nomor = $baris;
		$baris = $baris - 1;
		echo '<table width="100%">';
		for($i=0;$i<=$baris;$i++)
		{
			echo '<tr><td><br /></td></tr>';
		}
		$jumlah = 0;
		foreach($ta->result() as $a)
		{
			echo '<tr bgcolor="#fff"><td align="left" width="10">'.$nomor.'</td><td align="left" width="70">'.substr($a->macam_pembayaran,0,10).'</td><td width="70"><a href="'.base_url().'keuangan/buku/'.$nis.'/'.$tahun1.'/'.$semester.'/'.$record.'">'.tanggal($a->tanggal).'</a></td><td align="right" width="60"><a href="'.base_url().'keuangan/terima/'.$nis.'/'.$tahun1.'/'.$semester.'">'.number_format($a->besar).'</a></td><td width="3"></td><td width="150"> '.$namauser.'</td><td></td></tr>';
			$nomor++;
		}
		echo '</table><a href="'.base_url().'keuangan/terima/'.$nis.'/'.$tahun1.'/'.$semester.'">.&nbsp;&nbsp;&nbsp;&nbsp;</a>';
	}
}
else
{
	echo '<p class="text-warning">Tidak ada data yang dicetak, <a href="'.base_url().'keuangan/siswa"><strong>Batal</strong></a></p>';
}
?>
</div></body></html>
