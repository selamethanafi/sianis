<?php
$thnajaran = '2015/2016';
$semester = '2';
$twali = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' order by `kelas`");
$ada = $twali->num_rows();
echo $ada;
echo '<table>';
foreach($twali->result() as $w)
{
	echo '<tr><td><a href="'.base_url().'api/ambilnilai/'.substr($thnajaran,0,4).'/'.$semester.'/'.cegah($w->kelas).'">'.$w->kelas.'</a></td></tr>';
}
echo '</table>';
?>
