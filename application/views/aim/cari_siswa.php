<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	$(function() {
		$('#loading').ajaxStart(function(){
			$(this).fadeIn();
		}).ajaxStop(function(){
			$(this).fadeOut();
		});
	});

	function cariDosen(namaDosen) {
		if(namaDosen.length == 0) {
			$('#hasilPencarian').hide();
		} else {
			$.post("<?php echo base_url(); ?>aim/tampil/<?php echo $aksi; ?>", {kirimNama: ""+namaDosen+""}, function(data){
				if(data.length >0) {
					$('#hasilPencarian').fadeIn();
					$('#dataPencarian').html(data);
				}
			});
		}
	} 
	
	function pilih(thisValue) {
		$('#namaDosen').val(thisValue);
		setTimeout("$('#hasilPencarian').fadeOut();", 100);
	}
</script>
<div class="container-fluid">
<p class="text-center"><a href="<?php echo base_url().'aim';?>" class="btn btn-primary">Menu Utama</a></p>
    <h2>Cari NIS</h2>
	<div id="loading" style="display:none"><img src="<?php echo base_url(); ?>images/loading.gif" width="20px">
	<br>Memuat Data dari Database...</div>
		<form class="form-horizontal" role="form">
			<div class="form-group row row">
				<div class="col-sm-3"><label class="control-label">Nama Siswa</label></div>
				<div class="col-sm-9" ><input type="text" class="form-control" id="namaDosen" onkeyup="cariDosen(this.value);" onblur="pilih();"  
				value="ketik nama siswa ...." onfocus="if(this.value=='ketik nama siswa ....') this.value='';" autofocus/>
				</div>
			</div>
			
			<div class="kotakHasil" id="hasilPencarian" style="display: none;">
				<div class="daftarPencarian" id="dataPencarian"></div>
			</div>
		</form>
</div>

</body>
</html>
