<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
// membuat header dokumen XML
header('Content-Type: text/xml');
echo "<?xml version='1.0'?>";
echo "<outbox>";
$ta = $this->db->query("SELECT * FROM `datsis` where `updated`='1' limit 0,10");
$ada = $ta->num_rows();
if ($ada>0)
{
	foreach($ta->result() as $a)
	{
	$nis = $a->nis;
	echo "<data>";
	echo "<nis>".$a->nis."</nis>";
	echo "<nama>".$a->nama."</nama>";
	$tb = $this->db->query("select `nis`,`kelas`,`thnajaran`,`semester` from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis` = '$nis'");
	$kelas = '';
	foreach($tb->result() as $b)
	{
		$kelas = $b->kelas;
	}
	echo "<kelas>".$kelas."</kelas>";
	echo "<hp>".$a->hp."</hp>";
	echo "<hpayah>".$a->tayah."</hpayah>";
	echo "<hpibu>".$a->tibu."</hpibu>";
	echo "<hpwali>".$a->twali."</hpwali>";
	echo "<alamat>".$a->alamat."</alamat>";
	echo "<foto>".$a->foto."</foto>";
	echo "</data>";
	}
}
echo "</outbox>";
?>
