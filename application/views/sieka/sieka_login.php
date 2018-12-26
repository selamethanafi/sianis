<?php
		$tb = $this->db->query("select * from `sieka_user` where `nip`='$nip'");
		foreach($tb->result() as $b)
		{
			$passwd = $b->passwd;
		}
?>
<form class="form-horizontal" role="form"  action="http://sieka.kemenag.go.id/kinerja/res-php/login.php" method="post">
<input type="hidden" name="username" value="<?php echo $nip;?>"><input type="hidden" name="password" value="<?php echo $passwd;?>">
<input name="login" id="login" value="login ke Sieka" title="Klik disini untuk log in" type="submit" class="btn btn-primary">
</form>

