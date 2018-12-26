<?php
echo 'hallo';

$table	= 'datsis';
$text	= "SELECT *
			FROM $table WHERE nis= '1339'";
$sql 	= $this->db->query($text);
$row	= $sql->num_rows();
if ($row>0){
	foreach($sql->result() as $r)
	{
		if ($r->jenkel=='L'){
		$sex = 'Laki-laki';
		}else{
		$sex = 'Perempuan';
		}
	echo '<table>
		<tr>
			<td>Nama</td>
			<td>: '.$r->nama.'</td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>: '.$sex.'</td>
		</tr>
		<tr>
			<td>Tempat, Tgl Lahir</td>
			<td>: '.$r->tmpt.', '.date_to_long_string($r->tgllhr).'</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>: '.$r->alamat.'</td>
		</tr>
	</table>';
	}
}
?>
