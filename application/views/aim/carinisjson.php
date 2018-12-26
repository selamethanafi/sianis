<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
if(isset($q)){
	$sql = "SELECT `nis`,`nama` from `datsis`
        WHERE (`nama` LIKE '%".$q."%' or `nis` LIKE '%".$q."%') and `ket`='Y' order by `nama` ASC
        LIMIT 10"; 
}else{
	$sql = "SELECT `nama`, `nis` from `datsis` where `ket`='Y' order by `nama` ASC LIMIT 20"; 
}

$result = $this->db->query($sql);
$jum=$result->num_rows();
$json = [];
foreach($result->result() as $row)
{
       	$nis = $row->nis;
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
            $json[] = ['id'=>$row->nis, 'text'=>$row->nama, 'kelas'=>$kelas];
}
echo json_encode($json);

?>
