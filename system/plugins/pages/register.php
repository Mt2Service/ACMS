<?php
	if(Plugins::Status('google_recaptcha_v2')==1)
	{
		$openrechaptcha = file_get_contents('system/plugins/google_recaptcha_v2/settings.json');
		$openrechaptcha = json_decode($openrechaptcha, true);
		
		if(isset($_POST['username'], $_POST['password'], $_POST['rpassword'], $_POST['email'], $_POST['deletec'], $_POST['g-recaptcha-response']))
		{
			$urlrecaptcha = 'https://www.google.com/recaptcha/api/siteverify?secret='.$openrechaptcha['secret'].'&response='.$_POST['g-recaptcha-response'];
			$urlrecaptcha = file_get_contents($urlrecaptcha);
			$urlrecaptcha = json_decode($urlrecaptcha);
			$errors = array();
			
			 if ($urlrecaptcha->success != true)
				$errors[]='Recaptcha error!';
			if(!VerifyUsername($_POST['username']))
				$errors[]=l(45);
			if(!VerifyPassword($_POST['password']))
				$errors[]=l(44);
			if($_POST['password'] != $_POST['rpassword'])
				$errors[]=l(41);
			if(!VerifyEmail($_POST['email']))
				$errors[]=l(43);
			if(VerifyExistUsername($_POST['username']))
				$errors[]=l(46);
			if(VerifyExistEmail($_POST['email']))
				$errors[]=l(47);
			
			foreach($errors as $error)
				$show_error = '<div class="alert alert-danger" role="alert">'.$error.'</div>';
			if(!count($errors))
			{
				$referral = isset($_GET['ref']) ? $_GET['ref'] : null;
				
				if(UserRegister($_POST['username'], $_POST['password'], $_POST['email'], $_POST['deletec'], $referral)){	
					$show_error = '<div class="alert alert-success"><p>'.l(48).'</p></div>';
				}
				else $show_error = '<div class="alert alert-danger">Unknown error</div>';
			}
		}
	}
	else
	{
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rpassword']) && isset($_POST['email']) && isset($_POST['deletec']))
		{
			$errors = array();
			if(!VerifyUsername($_POST['username']))
				$errors[]=l(45);
			if(!VerifyPassword($_POST['password']))
				$errors[]=l(44);
			if($_POST['password'] != $_POST['rpassword'])
				$errors[]=l(41);
			if(!VerifyEmail($_POST['email']))
				$errors[]=l(43);
			if(VerifyExistUsername($_POST['username']))
				$errors[]=l(46);
			if(VerifyExistEmail($_POST['email']))
				$errors[]=l(47);
			
			
			foreach($errors as $error)
				$show_error = '<div class="alert alert-danger" role="alert">'.$error.'</div>';
			if(!count($errors))
			{
				$referral = isset($_GET['ref']) ? $_GET['ref'] : null;
				
				if(UserRegister($_POST['username'], $_POST['password'], $_POST['email'], $_POST['deletec'], $referral)){	
					$show_error = '<div class="alert alert-success"><p>'.l(48).'</p></div>';
				}
				else $show_error = '<div class="alert alert-danger">Unknown error</div>';
			}
		}
	}
?>