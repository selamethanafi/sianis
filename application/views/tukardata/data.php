<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
// membuat header dokumen XML
header('Content-Type: text/xml');
echo "<?xml version='1.0'?>";
// membuat root tag untuk data XML
echo "<outbox>";
// query untuk membaca seluruh SMS yang ada di tabel outbox
$query = "SELECT * FROM outbox ORDER BY id";
$hasil = mysqli_query($koneksi,$query);
while ($data = mysqli_fetch_array($hasil))
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
