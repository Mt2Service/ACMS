<?php
	$gr2set = file_get_contents("system/plugins/google_recaptcha_v2/settings.json");
	$gr2set = json_decode($gr2set, true); 
	if(isset($_POST['public'], $_POST['secret']))
	{
		$gr2set['public']=$_POST['public'];
		$gr2set['secret']=$_POST['secret'];
		if(file_put_contents('system/plugins/google_recaptcha_v2/settings.json', json_encode($gr2set)))
		 print '<script>GeneralSuccess("Recaptcha updated!");</script>';
	}
?>
<form method="POST">
	<div class="row">
		<div class="col-md-6">
			<input type="text" name="public" class="form-control" placeholder="Public Key" value="<?= $gr2set['public']; ?>">
		</div>
		<div class="col-md-6">
			<input type="text" name="secret" class="form-control" placeholder="Secret Key" value="<?= $gr2set['secret']; ?>">
		</div>
	</div>
	<br>
	<center><button type="text" class="btn btn-dark">Save</button></center>
</form>