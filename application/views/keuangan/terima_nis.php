<script language="javascript" src="/js/ajax_terima.js"></script>
<style type="text/css">
button {
	margin: 2px; 
	position: relative; 
	padding: 4px 8px 4px 4px; 
	cursor: pointer;   
	list-style: none;
}
button span.ui-icon {
	float: left; 
	margin: 0 4px;
}
#menu-tombol {
	padding-bottom:10px;
	padding:5px 5px 5px 5px;
	margin-bottom:20px;
}
#tombol-tambah{
	float:left;
	width:250px;
}
#tombol-cari{
	float:right;
	width:500px;
	text-align:right;
}
#tampil_data2,#tampil_data3{
	margin-top:30px;
}
#info_siswa{
	position:absolute;
	padding:5px 5px 5px 5px;
	background-color:#FFF;
	width:450px;
	border:3px solid #5c9fe9;
	-moz-border-radius: 5px 5px 5px 5px; 
	-webkit-border-radius: 5px 5px 5px 5px; 
	border-radius: 5px 5px 5px 5px; 
	-moz-box-shadow:0px 0px 20px #aaa;
    -webkit-box-shadow:0px 0px 20px #aaa;
    box-shadow:0px 0px 20spx #aaa;
	z-index:200px;
	float:right;
	left:650px;
}
</style>
<?php
echo '<div class="container-fluid">';
echo "
<h2>PEMBAYARAN SISWA</h2>
<div id='info_siswa'></div>
<table width='100%'>
<tr>
<td width='15%'>NIS</td>
<td width='2%'>:</td>
<td><input type='text' id='nomor' size='15' class='input'></td>
</tr>
<tr>
<td width='15%'>Tanggal</td>
<td width='2%'>:</td>
<td><input type='tgl' id='tgl' size='12' class='input'></td>
</tr>
<tr>
<td width='15%'>Guna membayar</td>
<td width='2%'>:</td>
<td><select name='jenis' id='jenis' class='input'>
<option value='02'>Simpanan Wajib</option><option value='01'>Simpanan Pokok</option>";
echo "</select>
</td>
</tr>
<tr>
<td width='15%'>Jumlah</td>
<td width='2%'>:</td>
<td><input type='text' name='jml' id='jml' size='15' class='input'></td>
</tr>
<tr>
<td colspan='3' align='center'>
<button class='ui-state-default ui-corner-all' id='simpan'>
<span class='ui-icon ui-icon-disk'></span>Simpan
</button>
<button class='ui-state-default ui-corner-all' id='baru'>
<span class='ui-icon ui-icon-document'></span>Baru
</button>
</td>
</tr>
</table>
<div id='tampil_data1'></div>
<div id='tampil_data2'></div>
<div id='tampil_data3'></div>
</div>";
?>
