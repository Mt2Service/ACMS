<?php
if(Plugins::Status('google_recaptcha_v2')==1)
{
		$open = file_get_contents("system/plugins/google_recaptcha_v2/settings.json");
		$open = json_decode($open, true); 
		
	if($open["public"]!='')
	{
		print '<div class="g-recaptcha" data-sitekey="'.$open["public"].'"></div>';
	}
	else
		print "<script>alertError('Google Recaptcha Key are clean, please login to admin panel and complete keys.');</script>"; 
}
?>