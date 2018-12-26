<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $this->config->item('sek_nama');?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
	$ta = $this->db->query("select * from `temauser` where `user`='00'");
	$adata = $ta->num_rows();
	if($adata==0)
	{?>
		  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<?php
	}
	else
	{
		$temacss = '';
		$ta = $this->db->query("select * from `temauser` where `user`='00'");
		foreach($ta->result() as $a)
		{
			$temacss = $a->temacss;
		}
		if(!empty($temacss))
		{?>
		    <link href="<?php echo base_url();?>assets/css/<?php echo $temacss;?>" rel="stylesheet"/>
		<?php
		}
		else
		{?>
		  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
		<?php
		}
	}

     ?>
  <link href="/assets/css/fontawesome-all.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" />
  <style>
	  .carousel-inner img {
	      width: 100%;
	      height: 100%;
	  }
</style>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</head>
<body>
<div class="container-fluid">
<!-- Static navbar -->
	<nav class="navbar navbar-expand-md navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/icon.png" alt="logo"> Laman </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                	<ul class="navbar-nav">
                        	<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profil <b class="caret"></b></a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<?php
						foreach($kategori_profil->result_array() as $daftar)
						{
							echo '<li><a  class="dropdown-item" href="'.base_url().'situs/katprofil/'.$daftar['id_kategori'].'">Profil '.$daftar['nama_kategori'].'</a></li>';
						}
						?>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Berita <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php
			  			foreach($kategori_berita->result_array() as $daftar)
			  			{
				  			echo '<li><a class="dropdown-item" href="'.base_url().'situs/katberita/'.$daftar['id_kategori'].'">Berita '.$daftar['nama_kategori'].'</a></li>';
						}
						?>
					</ul>
				</li>
			        <li class="dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Materi Pelajaran <b class="caret"></b></a>		
			        	<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<?php
						$ta = $this->db->query("select * from `m_kelompok_mapel` order by no_urut");
						if(count($ta->result())>0)	
						{
							foreach($ta->result() as $a)
							{
							?>
				        	                <li><a class="dropdown-item dropdown-toggle" href="#"><?php echo $a->kelompok_mapel;?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<?php
										$parent_id = $a->id_kelompok_mapel;
										$tb = $this->db->query("select * from `tblkategoritutorial` where `parent_id`='$parent_id' order by  `nama_kategori`");
										foreach($tb->result_array() as $b)
										{
							  				echo '<li><a class="dropdown-item" href="'.base_url().'situs/katmateri/'.$b['id_kategori_tutorial'].'">'.$b['nama_kategori'].'</a></li>';
  										}
										?>
									</ul>
								</li>
								<?php
							}
						}
						$tb = $this->db->query("select * from `tblkategoritutorial` where `parent_id`='0' order by  `nama_kategori`");
						if(count($tb->result())>0)	
						{
							echo '
							<li><a class="dropdown-item dropdown-toggle" href="#">Lain - lain <b class="caret"></b></a>';
								foreach($tb->result() as $b)
								{
									echo '
									<ul class="dropdown-menu">';
										$tb = $this->db->query("select * from `tblkategoritutorial` where `parent_id`='0' order by  `nama_kategori`");
										foreach($tb->result_array() as $b)
										{
									  		echo '<li><a class="dropdown-item" href="'.base_url().'situs/katmateri/'.$b['id_kategori_tutorial'].'">'.$b['nama_kategori'].'</a></li>';
  										}
										echo '
									</ul>';
								}
								echo '
							</li>';
						}
						?>
					</ul>
				</li>
        			<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Unduhan <b class="caret"></b></a>
					<ul class="dropdown-menu">
					<?php
					foreach($kategori_download->result_array() as $daftar)
					{
					  	echo '<li><a class="dropdown-item" href="'.base_url().'situs/katdownload/'.$daftar['id_kategori_download'].'">'.$daftar['nama_kategori_download'].'</a></li>';
  					}
					?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav ml-auto">
			        <li><a href="<?php echo base_url();?>login"><span class="fa fa-sign-in-alt"></span> Masuk <img src="<?php echo base_url();?>images/icon2.png" alt="logo"></a></li>
      			</ul>
		</div>
	</nav>
</div>
<br />
<?php
$caption_slide_1 = '';
$caption_slide_2 = '';
$caption_slide_3 = '';
$caption_slide_4 = '';
$caption_slide_5 = '';
$caption_slide_6 = '';
$sub_caption_slide_1 = '';
$sub_caption_slide_2 = '';
$sub_caption_slide_3 = '';
$sub_caption_slide_4 = '';
$sub_caption_slide_5 = '';
$sub_caption_slide_6 = '';
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_1'");
foreach($tb->result() as $b)
{
	$caption_slide_1 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_2'");
foreach($tb->result() as $b)
{
	$caption_slide_2 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_3'");
foreach($tb->result() as $b)
{
	$caption_slide_3 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_4'");
foreach($tb->result() as $b)
{
	$caption_slide_4 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_5'");
foreach($tb->result() as $b)
{
	$caption_slide_5 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'caption_slide_6'");
foreach($tb->result() as $b)
{
	$caption_slide_6 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_1'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_1 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_2'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_2 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_3'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_3 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_4'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_4 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_5'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_5 = $b->nilai;
}
$tb = $this->db->query("select * from `m_referensi` where `opsi` = 'sub_caption_slide_6'");
foreach($tb->result() as $b)
{
	$sub_caption_slide_6 = $b->nilai;
}
?>
<div class="container-fluid">
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
    <li data-target="#demo" data-slide-to="4"></li>
    <li data-target="#demo" data-slide-to="5"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url();?>images/1.jpg" alt="slide 1">
<div class="carousel-caption">
    <h3><?php echo $caption_slide_1;?></h3>
    <p><?php echo $sub_caption_slide_1;?></p>
  </div>
    </div>

    <div class="carousel-item">
      <img src="<?php echo base_url();?>images/2.jpg" alt="slide 2">
	<div class="carousel-caption">
    <h3><?php echo $caption_slide_2;?></h3>
    <p><?php echo $sub_caption_slide_2;?></p>
	</div>

    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url();?>images/3.jpg" alt="slide 3">
	<div class="carousel-caption">
    <h3><?php echo $caption_slide_3;?></h3>
    <p><?php echo $sub_caption_slide_3;?></p>
	</div>

    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url();?>images/4.jpg" alt="slide 4">
	<div class="carousel-caption">
    <h3><?php echo $caption_slide_4;?></h3>
    <p><?php echo $sub_caption_slide_4;?></p>
	</div>

    </div>

    <div class="carousel-item">
      <img src="<?php echo base_url();?>images/5.jpg" alt="slide 5">
    <h3><?php echo $caption_slide_5;?></h3>
    <p><?php echo $sub_caption_slide_5;?></p>

    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url();?>images/6.jpg" alt="slide 6">
	<div class="carousel-caption">
    <h3><?php echo $caption_slide_6;?></h3>
    <p><?php echo $sub_caption_slide_6;?></p>
	</div>

    </div>


  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>


</div> <!-- /container -->
