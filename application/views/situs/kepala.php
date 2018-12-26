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
  <link rel="stylesheet" href="/assets/css/style1.css">
  <link href="/assets/css/fontawesome-all.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" />
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
<?php
		$kategori_profil = $this->Situs_model->Daftar_Kategori_Profil();
		$kategori_berita = $this->Situs_model->Daftar_Kategori_Berita();
		$kategori_download = $this->Situs_model->Daftar_Kategori_Download();
		$kategori_tutorial = $this->Situs_model->Daftar_Kategori_Materi();
?>
<div class="container-fluid">
 <!-- Static navbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/icon.png" alt="logo">Laman </a>
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
     </nav>
</div>
<br />
