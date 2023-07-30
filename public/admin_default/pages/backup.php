<?php
	$backupacms = scandir('system/backups/', SCANDIR_SORT_DESCENDING);
	$newest_backup = $backupacms[0];

	if(isset($_POST['updatebutton']))
	{
		$newfile = 'system/backups/backup_'.date('Y-m-d-H-i-s').'-v'.$_version.'.zip';
		exec("tar --exclude='system/backups/*' -czf $newfile public system style index.php config.php .htaccess");
		print '<script>UpdateTRUE("Backup created succesfully!");</script>';
	}
	
	if(isset($_POST['restorebutton'], $_POST['archivename']))
	{
		copy('system/backups/'.$_POST['archivename'], 'restore.zip');
		exec("tar -zxvf restore.zip");
		if(unlink('restore.zip'))
			print '<script>UpdateTRUE("Succesfully restore '.$_POST['archivename'].'");</div>';
	}

?>
<div class="container-fluid py-4">
	<div class="row mb-4">
		<div class="col-lg-4 col-md-6 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title">
						<i class="fa fa-bolt" aria-hidden="true"></i> Backup Creator
					</h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<center>
						<div id="loadingimage" style="display:none;">
							<img src="https://sezeromer.com/wp-content/uploads/2019/09/Infinity-1s-200px.gif"/>
							<br><br>
							<span id="mbackup" style="display:none;">&bull; Making backup...</span>
							<span id="minstall" style="display:none;">&bull; Packing...</span>
						</div>
						<form method="POST">
							<button type="submit" name="updatebutton" class="btn btn-dark" onclick="StartLoading()" id="startbtn" style="display:block;">Create a backup</button>
						</form>
					</center>
				</div>
			</div>
		
			<div class="card card-secondary" id="loadingrestore" style="display:none;">
				<div class="card-header pb-0">
					<h4 class="card-title">
						<i class="fa fa-bolt" aria-hidden="true"></i> Backup Installer
					</h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<center>
						<div>
							<img src="https://sezeromer.com/wp-content/uploads/2019/09/Infinity-1s-200px.gif"/>
							<br><br>
							<span id="rbck" style="display:none;">&bull; Restore backup...</span>
							<span id="ura" style="display:none;">&bull; Unpack restore archive...</span>
						</div>
					</center>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-6 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title">
						<i class="fa fa-bolt" aria-hidden="true"></i> Backup Restore
					</h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<form method="POST">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th scope="col">File name</th>
									<th scope="col">Creation date</th>
									<th scope="col">Version</th>
									<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($backupacms as $bkcup)
									{
										if($bkcup!='..' && $bkcup!='...' && $bkcup!='.')
										{
											$replaceinarr = array('backup_','.zip');
											$info_show = str_replace($replaceinarr, '', $bkcup);
											$arshow = explode("-", $info_show);
											?>
												<tr>
													<td><?= $bkcup; ?></td>
													<td><?= $arshow[2]; ?>/<?= $arshow[1]; ?>/<?= $arshow[0]; ?>&nbsp; <?= $arshow[3]; ?>:<?= $arshow[4]; ?>:<?= $arshow[5]; ?></td>
													<td><?= $arshow[6]; ?></td>
													<td>
														<input type="hidden" value="<?= $bkcup; ?>" name="archivename">
														<button type="submit" name="restorebutton" class="btn btn-warning btn-sm" onclick="StartLoadingRestore()" id="resbtn" style="display:block;">Restore</button>
													</td>
												</tr>
										<?php
										}
									}
								?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function StartLoading()
	{
		document.getElementById('loadingimage').style.display='block';
		document.getElementById('startbtn').style.display='none';
		document.getElementById('mbackup').style.display='block';
		$(document).ready(function(){
			$('#mbackup').hide().delay(1).fadeIn('slow');
		});
		$(document).ready(function(){
			$('#mbackup').hide().delay(3000).fadeOut('slow');
			$('#minstall').hide().delay(4000).fadeIn('slow');
		});
	}
	
	function StartLoadingRestore()
	{
		document.getElementById('loadingrestore').style.display='block';
		document.getElementById('resbtn').style.display='none';
		document.getElementById('rbck').style.display='block';
		$(document).ready(function(){
			$('#rbck').hide().delay(1).fadeIn('slow');
		});
		$(document).ready(function(){
			$('#rbck').hide().delay(3000).fadeOut('slow');
			$('#ura').hide().delay(4000).fadeIn('slow');
		});
	}
</script>