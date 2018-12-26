<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(isset($tekseditor))
	{
		$akey = 'd88b2868cf66e6c0f46d738dedb00f6e';
	?>
	<script src="<?php echo $this->config->item('url_tinymce');?>"></script>
	<script>tinymce.init({ selector:'textarea', plugins: [
"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
      "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview fullpage | forecolor backcolor emoticons font responsivefilemanager',
external_filemanager_path:"<?php echo base_url();?>assets/filemanager/",
      filemanager_title:"File Manager" ,
	filemanager_access_key:"<?php echo $akey;?>",
      external_plugins: { "filemanager" : "../filemanager/plugin.min.js"},
	  });
	</script>
	<?php
	}
	if(isset($loncat))
	{
	?>
	<script src="<?php echo base_url();?>assets/js/jumpmenu.js"></script>
	<?php
	}

	if((isset($cariotomatis)) or (isset($select)))
	{
		if(isset($select))
		{?>
		        <script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
		        <script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
			<?php
		}
	}
	else
	{?>
	    <script src="/assets/js/jquery-3.2.1.slim.min.js"></script> 
	       <script src="/assets/js/popper.min.js"></script>
        	<script src="/assets/js/bootstrap.min.js"></script>
	        <script src="/assets/js/bootstrap-4-navbar.js"></script>
	        <script src="/assets/js/tambahan.js"></script>
	<?php
	}
if(isset($adainfo))
{?>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
<?php
}
?>

</body>
</html>

