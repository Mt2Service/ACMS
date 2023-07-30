<?php if(Permission::Verify('manateme')) { 
	if(isset($_POST['makeprimary']))
	{
		Server_Details::UpdateSettings(3,$_POST['makeprimary']);
		print '<script>alertSuccess("Now use '.$_POST['makeprimary'].' template");</script>';
	}
	
	if(isset($_POST['download_theme'], $_POST['keys']))
	{
		$creditentials = $_POST['keys'].'$'.md5(URL).'$'.URL;
		$calltotheme = file_get_contents('https://m2s-shop.com/cms_database/theme_key/index.php?productlicense='.$creditentials);
		if($calltotheme!='404')
		{
			file_put_contents($_POST['keys'].'.zip', $calltotheme);
			$path = pathinfo(realpath($_POST['keys'].'.zip'), PATHINFO_DIRNAME);
			
			if (filesize($_POST['keys'].'.zip') > 0) 
			{
				$zip = new ZipArchive;
				if ($zip->open($_POST['keys'].'.zip') === true) {
					$zip->extractTo($path);
					$zip->close();
					unlink($_POST['keys'].'.zip');
				}
			}
		}
	}
?>
<div class="container-fluid py-4">
	<div class="row mb-4">
		<div class="col-lg-12 col-md-12 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title"><?=l(241);?></h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
				
				
				<div class="alert alert-info">If you purchase a template or you have yet a template you can download and autoinstall it, just click on "i have license" and paste purchase code.</div>
				<p>
					<a class="btn btn-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
						I have a license
					</a>
				</p>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<form method="POST">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-4">
									<input type="text" class="form-control" name="keys" placeholder="License Code" required>
								</div>
								<div class="col">
									<button type="submit" name="download_theme" class="btn btn-dark">Download Theme</button>
								</div>
							</div>
						</form>
					</div>
				</div>
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th><?=l(242);?></th>
								<th><?=l(243);?></th>
								<th style="width:20%;"><?=l(145);?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$dir = 'public/';
							$dirstyle = 'style/';
							if ($handle = opendir($dir)) 
							{
								$blacklist = array('.', '..', '.htaccess', 'loading.php','admin_');
								while (false !== ($file = readdir($handle))) 
								{
									if (!in_array($file, $blacklist) && !strstr($file, 'admin_')) 
									{
										if(file_exists($dir.$file.'/body.php') && file_exists($dir.$file.'/head.php') && file_exists($dir.$file.'/partials/owner.php'))
										{
											include $dir.$file.'/partials/owner.php';
											if($file=='default') $file_name = "default_template"; else $file_name = $file;
											if($version!=$lversion)
												$new_update = true;
											else
												$new_update = false;
											if(isset($_POST['update_now']))
											{
												$theme_update = $theme_url.$lversion.'.zip';
												$file = $lversion.'.zip';
												$script = basename($_SERVER['PHP_SELF']);
												file_put_contents($file, fopen($theme_update, 'r'));
												$path = pathinfo(realpath($file), PATHINFO_DIRNAME);
												$zip = new ZipArchive;
												$res = $zip->open($file);
												if ($res === TRUE) 
												{
													$zip->extractTo($path);
													$zip->close();
													unlink($file);
													print '<script>alertSuccess(" template updated!");</script>';
													$new_update = false;
												} 
												else 
												  print '<script>alertError(" some error!");</script>';
											}
											
											$totalsize = intval((GetDirectorySize($dir.$file)+GetDirectorySize($dirstyle.$file))/1000);
										?>
										<tr>
											<td style="vertical-align:middle;"><?= $file_name; ?><br><small>&copy;&nbsp;<?=$creator;?></small></td>
											<td style="vertical-align:middle;">
												<div class="row">
													<div class="col-md-6 my-auto align-self-center">
														<a target="blank" href="<?= $preview; ?>" style=" position: relative;text-align: center;color: white;">
															<img style="width:130.55px;height:150px;opacity:0.3" src="<?= $preview; ?>"/>
															<div style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);"><b style="color:black"><?=l(244);?></b></div>
														</a>
													</div>
													<div class="col-md-6 my-auto align-self-center">
														<div style="vertical-align:middle;">
														<b>Script Location:</b> <?=$dir.$file.'/';?><br>
														<b>Style Location:</b> <?=$dirstyle.$file.'/';?><br>
														<b><?=l(248);?>:</b> ~ <?=$totalsize; ?> MB <br>
														<b><?=l(245);?>:</b> <?=$version;?> <br>
														<b><?=l(246);?>:</b> <?=$price;?> <br>
														<br><?=$message;?>
														</div>
													</div>
												</div>
											</td>
											<td style="vertical-align:middle;">
												<center>
													<form method="POST">
														<input type="hidden" value="<?= $file;?>" name="makeprimary">
														<button type="submit" alt="<?=l(235);?> " title="<?=l(235);?> " class="btn btn-secondary btn-sm" <?php if(Server_Details::GetSettings(3)==$file) print 'disabled'; ?>>
															<i class="fa-solid fa-key"></i>
														</button>
														
														<?php if($new_update) { ?>
														&nbsp;&nbsp;
														<button type="submit" alt="Update now!" title="Update now!" name="update_now" class="btn btn-danger btn-sm">
															UPDATE
														</button>
														<?php } ?>
														
													</form>
												</center>
											</td>
										</tr>
										<?php
										}
									}
								}
								closedir($handle);
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } else print '<div class="alert alert-danger">You dont have access!</div>';?>