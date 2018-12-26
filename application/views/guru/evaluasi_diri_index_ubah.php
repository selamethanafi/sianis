<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:58:42 WIB 
// Nama Berkas 		: pkg_index.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' '.$tahun;?></h3></div>
<div class="card-body">
<?php
echo '<p class="text-center"><a href="'.base_url().'evaluasi/evaluasi/'.$tahun.'" class="btn btn-danger">Batal</a></p>';
$nomor = 1;
$item = 1;
$tb = $this->db->query("select * from `evaluasi_diri_tanggal` where `tahun`= '$tahun' and `nim`='$nim'");
foreach($tb->result() as $b)
{
	$tanggal = tanggal($b->tanggal);
}
echo form_open('evaluasi/simpanevaluasi/'.$tahun,'class="form-horizontal" role="form"');
					echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Penyusunan EDG</label></div><div class="col-sm-9">';
					?>
					<input id="datepicker" format="dd-mm-yyyy" name="tanggal" value="<?php echo $tanggal;?>"  width="276" />
					<script>
					        $('#datepicker').datepicker({ format: 'dd-mm-yyyy',
					            uiLibrary: 'bootstrap4'
					        });
					</script>
					<?php
					echo '</div></div>';

echo '<table class="table table-striped table-hover table-bordered"><tr><td colspan="2"><h3>A. Kompetensi Inti</h3></td><td><h3>Evaluasi diri terhadap kompetensi terkait</h3></td></tr>';
echo '<tr><td colspan="4"><h4>Pedagogik</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'A%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td width="30%">'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
echo '<tr><td colspan="4"><h4>Kepribadian</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'B%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
echo '<tr><td colspan="4"><h4>Sosial</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'C%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
echo '<tr><td colspan="4"><h4>Profesional</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'D%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>Berbagai hal terkait dengan pemenuhan dan peningkatan kompetensi inti tersebut</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'E%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>B. Kompetensi menghasilkan Publikasi Ilmiah</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'F%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>C. Kompetensi menghasilkan Karya Inovatif</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'G%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>D. Kompetensi untuk penunjang pelaksanaan pembelajaran berkualitas (TIK, Bahasa Asing, dsb)</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'H%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
$nomor = 1;
echo '<tr><td colspan="4"><h4>E. Kompetensi penunjang pelaksanaan tugas tambahan</h4></td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'I%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td><textarea name="evaluasi_'.$item.'" class="form-control">'.$a->evaluasi.'</textarea><input type="hidden" name="kode_'.$item.'" value="'.$a->kode.'"></td></tr>';
	$nomor++;
	$item++;
}
echo '</table>';
$cacah_item = $item - 1;
echo '<input type="hidden" name="cacah_indikator" value="'.$cacah_item.'">';
echo '<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().'evaluasi/evaluasi/'.$tahun.'" class="btn btn-danger">Batal</a></p>';
?>
</div></div></div>
