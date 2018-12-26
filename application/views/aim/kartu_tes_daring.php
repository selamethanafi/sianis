<?php
			require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php');
			use Mike42\Escpos\Printer;
			use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h2>Mencetak Kartu Tes Daring</h2></div>
	<div class="card-body">
 <?php
if(empty($nis))
{		$tanggal = tanggal_hari_ini();
		$namahari = tanggal_ke_hari(tanggal_hari_ini());

?>
		<form class="form-horizontal" role="form" action="<?php echo base_url();?>aim/passwordtes" method="post">
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Nama</label></div>
				<div class="col-sm-9" ><select id="nis" name="nis" class="form-control" required autofocus>
					<option value=""></option>
					<?php
					// ambil data dari database
					$hasil2 = $this->db->query("SELECT * FROM `datsis` where `ket`='Y'");
					foreach($hasil2->result() as $row) {
						$nis = $row->nis;
						$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
						if(!empty($kelas))
						{
						 ?>
							 <option value="<?php echo $row->nis?>"><?php echo $row->nama.' '.$nis.'  '.$kelas;?></option>
						 <?php
						}
					}
					?>
					</select>
				</div>
			</div>
			<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>aim" class="btn btn-info"><b>Batal</b></a></p>
		</form>
	<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
	<script>
		$(document).ready(function () {
		 $("#nis").select2({
		placeholder: "Klik disini, ketik nama Anda lalu pilih bila sudah muncul"
		 });
		});
	</script>
	<?php
}
else
{
	$ta = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($ta->result() as $a)
	{
		$namasiswa = $a->nama;
		$password = $a->password_tes;
	}
	if(!empty($namasiswa))
	{
		$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		$connector = new CupsPrintConnector($nama_printer);
		$printer = new Printer($connector);
		$printer -> initialize();
		/* Date is kept the same for testing */
	       	$date = date('D j M Y H:i:s');  
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> text("$sek_nama\n");
		$printer -> selectPrintMode();
		$printer -> setUnderline(1);
		$printer -> text("Kartu Tes Daring\n");
		$printer -> setUnderline(0);

		$printer -> feed();
		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$printer -> text("Nama : ".$namasiswa."\n");
		$printer -> text("Kelas : ".$kelas."\n");
		$printer -> text("Username : ".$nis."\n");
		$printer -> text("Password : ".$password."\n");
		$printer -> feed(2);
		/* Cut the receipt and open the cash drawer */
		$printer -> cut();
		$printer -> pulse();
		$printer -> close();
		$params=[
			    'nis'=>$nis,
			    'password'=>$password,
			    'app_key' => '68!6?E&4221*7A891527B412AE5016BA77EAB07EAF7F=:',
			];
		$tb = $this->db->query("select * from `server_ubk`");
		foreach($tb->result() as $b)
		{
			$url_ubk = $b->url;
			$ch = curl_init($url_ubk.'/siswa/update_password.php');
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close($ch);
		}
		echo '<div class="alert alert-info"><h1 class="text-center">Silakan ambil kartu</h1></div>';
		?>
		<script>setTimeout(function () {
				window.location.href= '<?php echo base_url();?>aim/passwordtes'; // the redirect goes here
				},200);
		</script>
			<?php
	}
}
	?>


