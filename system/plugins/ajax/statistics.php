<?php
	if(areadmin())
	{
		if(isset($_GET['chart']) && $_GET['chart']=='yang')
		{
			
			$stmt = $database->Player("SELECT SUM(gold) as sums FROM player");
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			$total = $data['sums'];
			echo json_encode(["online"=>$total]);
		}
		
		if(isset($_GET['chart']) && $_GET['chart']=='weblive')
		{
			$todaydate = date('Y-m-d');
			$time = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime('now')));
			$stmt = $database->update_v220("SELECT COUNT(distinct ip) as count FROM visits WHERE date='$todaydate' AND datetime > '$time'");
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			$total = $data['count'];;
			echo json_encode(["online"=>$total]);
		}
		
		if(isset($_GET['chart']) && $_GET['chart']=='totalvisits')
		{
			$todaydate=date('Y-m-d');
			$stmt = $database->update_v220("SELECT COUNT(*) FROM visits WHERE date='$todaydate'");
			$stmt->execute();
			$data = $stmt->fetchColumn();
			
			echo json_encode(["online"=>$data]);
		}
		
		if(isset($_GET['chart']) && $_GET['chart']=='weblivedetails')
		{
			$time = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime('now')));
			$todaydate=date('Y-m-d');
			$stmt = $database->update_v220("SELECT DISTINCT ip FROM visits WHERE date='$todaydate' AND date='$todaydate' AND datetime > '$time'");
			$stmt->execute();
			$data = $stmt->fetchAll();
			print '<table class="table table-bordered">';
			print '<thead class="thead-dark">';
			print '<tr>';
			print '<th scope="col"><center>IP Adress</center></th>';
			print '<th scope="col"><center>Country</center></th>';
			print '<th scope="col"><center>City</center></th>';
			print '</tr>';
			print '</thead>';
			print '<tbody>';
			foreach($data as $d)
			{
				$ipdate = $d['ip'];
				$iptolocation = 'http://api.hostip.info/get_json.php?ip='.$ipdate;
				$creatorlocation = call_own($iptolocation);
				$json =  json_decode($creatorlocation, true);
				?>
					<tr>
						<td><center><?= $json['ip']; ?></center></td>
						<td>
							<?php if(file_exists('style/languages/'.strtolower($json['country_code']).'.png')) { ?>
							<img style="height:15px;" src="<?php print Theme::URL(); ?>style/languages/<?= strtolower($json['country_code']); ?>.png">&nbsp;
							<?php } ?>
							<?= ucfirst(strtolower($json['country_name'])); ?>
						</td>
						<td><center><?= $json['city']; ?></center></td>
					</tr>
				<?php
				
			}
			print '</tbody>
							</table>';
		}
		
		if(isset($_GET['chart']) && $_GET['chart']=='sumofdown')
		{
			$sumofdownloads = 0;
			$download_db = file_get_contents('system/database/download_links.json');
			$download_db = json_decode($download_db, true);
			foreach($download_db as $key => $download)
			{
				$sumofdownloads+= $download['count'];
			}
			echo json_encode(["online"=>$sumofdownloads]);
		}
	}
	else print 'Denyed access!';
?>