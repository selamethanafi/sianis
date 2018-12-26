<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	$(function() {
		$('#loading').ajaxStart(function(){
			$(this).fadeIn();
		}).ajaxStop(function(){
			$(this).fadeOut();
		});
	});

	function cariSiswa(namaSiswa) {
		if(namaSiswa.length == 0) {
			$('#hasilPencarian').hide();
		} else {
			$.post("<?php echo base_url(); ?>autocomplete/tampil/guru/<?php echo $aksi; ?>", {kirimNama: ""+namaSiswa+""}, function(data){
				if(data.length >0) {
					$('#hasilPencarian').fadeIn();
					$('#dataPencarian').html(data);
				}
			});
		}
	} 
	
	function pilih(thisValue) {
		$('#namaSiswa').val(thisValue);
		setTimeout("$('#hasilPencarian').fadeOut();", 100);
	}
</script>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
	<div id="loading" style="display:none"><img src="<?php echo base_url(); ?>images/loading.gif" width="20px">
	<br>Memuat Data dari Database...</div>
		Menu tidak berfungsi, silakan klik beranda dulu untuk mengaktifkan menu.
		<form class="form-horizontal" role="form">
			<div class="form-group row row">
				<div class="col-sm-3"><label class="control-label">Cari Siswa</label></div>
				<div class="col-sm-9" ><input type="text" class="form-control" id="namaSiswa" onkeyup="cariSiswa(this.value);" onblur="pilih();"  
				value="ketik nama siswa ...." onfocus="if(this.value=='ketik nama siswa ....') this.value='';" />
				</div>
			</div>
			
			<div class="kotakHasil" id="hasilPencarian" style="display: none;">
				<div class="daftarPencarian" id="dataPencarian">
					
				</div>
			</div>
		</form>
	<?php
	$tanggal = tanggal_hari_ini();
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$ta = $this->db->query("select * from `siswa_proses_izin` where `tanggal`='$tanggal'");
	if($ta->num_rows()>0)
	{
		echo '<div class="col-sm-12"><h3><p class="text-center">Daftar Siswa Mengajukan Izin</p></h3>';
		echo '	<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
		<tr align="center"><td>Nama</td><td>Kelas</td><td>Keterangan</td><td>Status</td><td>Proses</td></tr>';
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			$link_setuju = anchor('guru/token/'.$a->tokenmd5,'<span class="fa fa-bullseye"></span>', array('title' => 'disetujui', 'data-confirm' => 'Anda yakin akan menyetujui izin '.nis_ke_nama($nis).'?'));
			$link_pending = anchor('guru/pending/'.$a->tokenmd5,'<span class="fa fa-bullseye"></span>', array('title' => 'ditunda / batal', 'data-confirm' => 'Anda yakin akan menunda / membatalkan izin '.nis_ke_nama($nis).'?'));
			if($a->valid == '1')
			{
				echo '<tr class="success"><td>'.nis_ke_nama($nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester).'</td><td>'.$a->alasan.'</td><td class="success">disetujui</td>';
			}
			else
			{
				echo '<tr class="danger"><td>'.nis_ke_nama($nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester).'</td><td>'.$a->alasan.'</td><td class="danger">ditunda</td>';
			}
			if($a->kode_guru == $kodeguru)
			{
				if($a->valid == '1')
				{
					echo '<td align="center">'.$link_pending.'</td></tr>';
				}
				else
				{
					echo '<td align="center">'.$link_setuju.'</td></tr>';				}
			}
			else
			{
				echo '<td></td></tr>';
			}

		}
		echo '</table></div></div>';
	}
	
	$ta = $this->db->query("select * from `siswa_absensi` where `tanggal`='$tanggal'");
	if($ta->num_rows()>0)
	{
		echo '<div class="col-sm-12"><h3><p class="text-center">Daftar Siswa Tidak Hadir</p></h3>';
		echo '	<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
		<tr align="center"><td>Nama</td><td>Kelas</td><td>Alasan</td><td>Keterangan</td></tr>';
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			if(($a->alasan == 'S') or ($a->alasan == 'M'))
			{
				echo '<tr class="success"><td>'.nis_ke_nama($nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester).'</td><td>'.$a->alasan.'</td><td>'.$a->keterangan.'</td></tr>';
			}
			elseif($a->alasan == 'I')
			{
				echo '<tr class="warning"><td>'.nis_ke_nama($nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester).'</td><td>'.$a->alasan.'</td><td>'.$a->keterangan.'</td></tr>';
			}
			else
			{
				echo '<tr class="danger"><td>'.nis_ke_nama($nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester).'</td><td>'.$a->alasan.'</td><td>'.$a->keterangan.'</td></tr>';
			}
		}
		echo '</table></div></div>';
	}
	?>
</div></div></div>

