<?php
// baca data XML dari server hosting yang digenerate oleh data.php
$dataxml = simplexml_load_file('http://d.mantengaran.sch.id/index.php/situs/nilaidiambil/'.$tahun.'/'.$semester.'/'.$kelas.'');
foreach($dataxml->data as $data)
{
$nis = $data->nis;
$thnajaran = $data->thnajaran;
$semester = $data->semester;
$kelas = $data->kelas;
$kog = $data->kog;
$psi = $data->psi;
$afektif = $data->afektif;
$keterangan = nopetik($data->keterangan);
$mapel = $data->mapel;
$query = "update `nilai` set `kog`='$kog', `psi`='$psi', `keterangan`='$keterangan', `afektif`='$afektif' where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'";
$this->db->query($query);
}
header('Location: '.base_url().'api'); //redirect browser to public main page
?>
