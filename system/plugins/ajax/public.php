<?php
	if(isset($_SERVER['HTTP_REFERER']))
	{
		if(isset($_GET['newplayeronserver']) && $_GET['newplayeronserver']=='1')
		{
			$in_map = 'unknown empire';
			$color = 'black';
			$getlistplayers = $database->Player("SELECT id,name FROM player WHERE playtime < 5");
			$getlistplayers->execute(); 
			$count = $getlistplayers -> rowCount();
			
			if($count > 0)
			{
				$new_players =$getlistplayers->fetch(PDO::FETCH_ASSOC);
				$map = PlayerEmpire($new_players['id']);
				$notification_name = $new_players['name'];
				if($map==1)
				{
					$in_map = 'Shinsoo';
					$color = 'red';
				}
				if($map==2)
				{
					$in_map = 'Chunjo';
					$color = 'orange';
				}
				if($map==3)
				{
					$in_map = 'Jinno';
					$color = 'blue';
				}
				
				print '<script>NewPlayer("<b>'.$notification_name .'</b> has joined <b>'.Server_Details::GetSettings(1).'</b> on <font color=\"'.$color.'\"><b>'.$in_map.'</b></font>.<br>The team wishes you good luck!");</script>';
				
				$updatetime = $database->Player("UPDATE player SET playtime='5' WHERE name='$notification_name'");
				if($updatetime->execute())
					$savedsuccess=1;
			}
		}
	}
	else print 'Denyed access!';
?>