<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
header('Content-Type: text/xml');
echo "<?xml version='1.0'?>";
// membuat root tag untuk data XML
echo "<outbox>";
// query untuk membaca seluruh SMS yang ada di tabel outbox
if($item == 1)
{
	$ta = $this->db->query("SELECT * FROM `outbox` where `id_sms_user` ='$sms_user' ORDER BY id");
}
else
{
	$ta = $this->db->query("SELECT * FROM `outbox` ORDER BY id limit 0,4");
}
foreach($ta->result_array() as $data)
{
// representasi data sms

echo "<data>";
echo "<id>".$data['id']."</id>";
echo "<destination>".$data['DestinationNumber']."</destination>";
echo "<sms>".$data['TextDecoded']."</sms>";
echo "<id_sms_user>".$data['id_sms_user']."</id_sms_user>";
echo "</data>";
}
echo "</outbox>";
?>
