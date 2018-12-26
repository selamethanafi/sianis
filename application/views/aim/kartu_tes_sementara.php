<?php
			require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php');
			use Mike42\Escpos\Printer;
			use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h2>Mencetak Kartu Tes Sementara</h2></div>
	<div class="card-body">
<?php
if(empty($nis))
{		$tanggal = tanggal_hari_ini();
		$namahari = tanggal_ke_hari(tanggal_hari_ini());

?>
		<form class="form-horizontal" role="form" action="<?php echo base_url();?>aim/kartutes" method="post">
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
<div class="col-sm-3"><label class="control-label">Nama Tes</label></div>
				<div class="col-sm-9" ><select name="nama_tes" class="form-control" required autofocus>
					<?php
					$ttes = $this->db->query("SELECT * FROM `nama_tes` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `id_nama_tes` DESC");
					foreach($ttes->result() as $dtes)
					{
						echo '<option value="'.$dtes->nama_tes.'">'.$dtes->nama_tes.'</option>';
					}
					?>
					</select>
				</div>
			</div>
			<div class="form-group row">
			     <div class="col-sm-3"><label class="control-label">Tanggal</label></div>
		             <div class="col-sm-9" ><p class="form-control-static"><?php echo $namahari.' '.tanggal(tanggal_hari_ini());?></p></div>
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
	$namasiswa = nis_ke_nama($nis);
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
		$printer -> text("Kartu Tes Sementara\n");
		$printer -> setUnderline(1);
		$printer -> text($nama_tes."\n");
		$printer -> setUnderline(0);

		$printer -> feed();
		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$printer -> text("Nama : ".$namasiswa."\n");
		$printer -> text("Kelas : ".$kelas."\n");
		$printer -> feed();
		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$tanggal = tanggal_hari_ini();
		$namahari = tanggal_ke_hari(tanggal_hari_ini());
		$printer -> text("diizinkan meningikuti tes pada hari ini, $namahari, ".date_to_long_string($tanggal)."\n");
		$printer -> feed();	
		$printer -> text("Kartu tes sementara ini sah bila ditandatangani panitia\n");
		$printer -> feed();
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text("Panitia");
		$printer -> feed(2);
		$printer -> text("________________");
		$printer -> feed(2);
		$printer -> text($date . "\n");
		/* Cut the receipt and open the cash drawer */
		$printer -> feed(2);
		/* Cut the receipt and open the cash drawer */
		$printer -> cut();
		$printer -> pulse();
		$printer -> close();
		echo '<div class="alert alert-info"><h1 class="text-center">Silakan ambil kartu tes sementara</h1></div>';
		?>
		<script>setTimeout(function () {
				window.location.href= '<?php echo base_url();?>aim/kartutes'; // the redirect goes here
				},200);
		</script>
			<?php
	}
}
	?>


