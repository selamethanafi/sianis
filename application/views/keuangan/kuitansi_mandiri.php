<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<script src="<?php echo base_url();?>assets/js/jumpmenu.js"></script>
<?php
if((!empty($tanggal)) and (!empty($nis)))
{
	$ta = $this->db->query("select * from `siswa_bayar` where `tanggal`='$tanggal' and `nis`='$nis'");
	$ada = $ta->num_rows();
	if($ada == 0)
	{
		echo 'data tidak ditemukan <a href="'.base_url().'keuangan/siswa">Batal</a>';
	}
	else
	{
		echo '<table width="100%"><tr><td>';
		if(!empty($baris1))
		{
			echo $baris1;
		}
		if(!empty($baris2))
		{
			echo '<br>'.$baris2;
		}
		if(!empty($baris3))
		{
			echo '<br>'.$baris3;
		}
		if(!empty($baris4))
		{
			echo '<br>'.$baris4;
		}
		if(!empty($baris5))
		{
			echo '<br>'.$baris5;
		}
		echo '
</td><td><table width="100%"><tr><td align="center">';
		$xloc = base_url().'keuangan/buku/'.$nis.'/'.$tahun1.'/'.$semester;
		echo '<form name="formx" method="post" action="'.$xloc.'">';
		?>
			<select name="kartu" onChange="MM_jumpMenu('self',this,0)">
			<option value="">KUITANSI</option>
			<?php
			for($i=0;$i<=40;$i++)
			{
				echo '<option value="'.$xloc.'/'.$i.'">'.$i.'</option>';
			}
			?>
			</select>
		</form>
		<?php
		echo '</td></tr></table></td></tr></table>';
		echo '<table width="100%"><tr><td>NIS</td><td>'.$nis.'</td></tr><tr><td>Nama</td><td>'.nis_ke_nama($nis).'</td></tr></table>';
		echo '<table width="100%" bgcolor="#ccc"><tr bgcolor="#fff" align="center"><td>Tanggal<td>Macam Pembayaran</td><td>Besar</td><td>Keterangan</td></tr>';
		$jumlah = 0;
		foreach($ta->result() as $a)
		{
			echo '<tr bgcolor="#fff"><td>'.tanggal($a->tanggal).'</td><td>'.$a->macam_pembayaran.'</td><td align="right">'.number_format($a->besar).'</td><td>'.$a->keterangan.'</td></tr>';
			$jumlah = $jumlah + $a->besar;
		}

		echo '</table>'.xduit($jumlah).' Terbilang: '.strtolower(xduitf($jumlah)).'<br />';
		echo '<table width="100%"><tr><td width="60%"></td><td>'.$lokasi.', '.date_to_long_string(tanggal_hari_ini()).'<br />Petugas<br /><br /><br /><a href="'.base_url().'keuangan/siswa">'.$namauser.'</a></td></tr></table>';
		?>
			<script>print();</script>
		<?php
	}
}
else
{
	echo '<p class="text-warning">Tidak ada data yang dicetak, <a href="'.base_url().'keuangan/siswa"><strong>Batal</strong></a></p>';
}
?>
</div></body></html>
