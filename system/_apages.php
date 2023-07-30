<?php
	switch ($administrator_page) {
		case 'news':
			$pagea = 'news';
			$atitle = 'news';
			include 'system/plugins/admin/news.php';
		break;
		
		case 'download':
			$pagea = 'download';
			$atitle = 'download';
			include 'system/plugins/admin/download.php';
		break;
		
		case 'log':
			$pagea = 'log';
			$atitle = 'log';
			include 'system/plugins/admin/log.php';
		break;
		
		case 'create_item':
			$pagea = 'create_item';
			$atitle = 'create_item';
			include 'system/plugins/admin/create_item.php';
		break;
		
		case 'players_management':
			$pagea = 'players_management';
			$atitle = 'players_management';
			include 'system/plugins/admin/players_management.php';
		break;
		
		case 'general_settings':
			$pagea = 'general_settings';
			$atitle = 'general_settings';
			include 'system/plugins/admin/general_settings.php';
		break;
		
		case 'news_settings':
			$pagea = 'news_settings';
			$atitle = 'news_settings';
			include 'system/plugins/admin/news_settings.php';
		break;
		
		case 'coupon':
			$pagea = 'coupon';
			$atitle = 'coupon';
			include 'system/plugins/admin/coupon.php';
		break;
		
		case 'vote':
			$pagea = 'vote';
			$atitle = 'vote';
			include 'system/plugins/admin/vote.php';
		break;
		
		case 'refferals':
			$pagea = 'refferals';
			$atitle = 'refferals';
			include 'system/plugins/admin/refferals.php';
		break;
		
		case 'player_inventory':
			$pagea = 'player_inventory';
			$atitle = 'player_inventory';
		break;
		
		case 'language_manager':
			$pagea = 'language_manager';
			$atitle = 'language_manager';
		break;
		
		case 'languages':
			$pagea = 'languages';
			$atitle = 'languages';
		break;
		
		case 'template_settings':
			$pagea = 'template_settings';
			$atitle = 'template_settings';
		break;
		
		case 'custom_page':
			$pagea = 'custom_page';
			$atitle = 'custom_page';
		break;
		
		case 'backup':
			$pagea = 'backup';
			$atitle = 'backup';
		break;
		
		case 'permissions':
			$pagea = 'permissions';
			$atitle = 'permissions';
		break;
		
		case 'acms_update':
			$pagea = 'acms_update';
			$atitle = 'acms_update';
		break;

		case 'recaptcha2':
			$pagea = 'recaptcha2';
			$atitle = 'recaptcha2';
		break;
		
		case 'statistics':
			$pagea = 'statistics';
			$atitle = 'statistics';
		break;

		case 'events':
			$pagea = 'events';
			$atitle = 'events';
		break;

		case 'web-statistics':
			$pagea = 'web-statistics';
			$atitle = 'web-statistics';
		break;
		
		case 'plugins':
			$pagea = 'plugins';
			$atitle = 'plugins';
		break;
		
		//PLUGINSPAGE
		
		default:
			$pagea = 'home';
			$atitle = 'Home';
	}
?>