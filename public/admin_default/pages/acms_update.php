<?php


	$backupacms = scandir('system/backups/', SCANDIR_SORT_DESCENDING);
	$newest_backup = $backupacms[0];
if(isset($_POST['updatebutton']))
{
	$newfile = 'system/backups/backup_'.date('Y-m-d-H-i-s').'-v'.$_version.'.zip';
	exec("tar --exclude='system/backups/*' -czf $newfile public system style index.php config.php .htaccess");
	file_put_contents(Dependencies::GetUpdateName(), fopen(Dependencies::GetDownload(), 'r'));
	if(file_exists(Dependencies::GetUpdateName()))
	{
		$path = pathinfo(realpath(Dependencies::GetUpdateName()), PATHINFO_DIRNAME);
		$zip = new ZipArchive;
		$res = $zip->open(Dependencies::GetUpdateName());
		if ($res === TRUE) 
		{
			$zip->extractTo($path);
			$zip->close();
			if(file_exists(Dependencies::GetUpdateName()) && unlink(Dependencies::GetUpdateName()))
			{
				print '<script>UpdateTRUE("ACMS updated to version <b>'.Dependencies::NewV().'</b>");</script>';
				$callback = '<br><div class="alert alert-success"><center>ACMS succesfully updated to <b>'.Dependencies::NewV().'</b></center></div>';
			}
			else 
			{
				$callback = '<br><div class="alert alert-danger"><center>I can\'t update homepage, probably you are banned, contact Mt2Services!</b></center></div>';
			}
		}
	}
	else 
	{
		$callback = '<br><div class="alert alert-danger"><center>I can\'t update homepage, please contact Mt2Services!</b></center></div>';
	}
}

if(isset($_POST['restorebutton']))
{
	copy('system/backups/'.$newest_backup, 'restore.zip');
	exec("tar -zxvf restore.zip");
	if(unlink('restore.zip'))
		print '<script>UpdateTRUE("Succesfully restore!");</div>';
}

?>
<div class="container-fluid py-4">
	<div class="row mb-4">
		<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title">
						<i class="fa fa-bolt" aria-hidden="true"></i> Update Panel
					</h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<?php 
					if(extension_loaded('zip')) 
					{
						if(Dependencies::isUpdate())
						{
						?>
							<center>
								<div id="loadingimage" style="display:none;">
									<img src="https://sezeromer.com/wp-content/uploads/2019/09/Infinity-1s-200px.gif"/>
									<br><br>
									<span id="mbackup" style="display:none;">&bull; Making backup...</span>
									<span id="minstall" style="display:none;">&bull; Download and install update...</span>
								</div>
								<?php 
									if(isset($callback)) 
										print $callback; 
								?>
								<form method="POST">
									<button type="submit" name="updatebutton" class="btn btn-dark" onclick="StartLoading()" id="startbtn" style="display:block;">Install Update</button>
								</form>
							</center>
						<?php 
						}
						else print '<div class="alert alert-success"><i class="fa fa-info-circle" aria-hidden="true"></i> ACMS is updated to the latest version! ['.$_version.']</div>';
					} 
					else 
						print '<div class="alert alert-danger">[ERROR]: ZIP Extension are disabled!</div>'; ?>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title">
						<i class="fa fa-bolt" aria-hidden="true"></i> Update Info
					</h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<?php print Dependencies::GetUpdateInfo(); ?>
				</div>
			</div>
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title">
						<i class="fa fa-bolt" aria-hidden="true"></i> Restore
					</h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<center>
						<div id="loadingrestore" style="display:none;">
							<img src="https://sezeromer.com/wp-content/uploads/2019/09/Infinity-1s-200px.gif"/>
							<br><br>
							<span id="rbck" style="display:none;">&bull; Restore backup...</span>
							<span id="ura" style="display:none;">&bull; Unpack restore archive...</span>
						</div>
						<form method="POST">
							<button type="submit" name="restorebutton" class="btn btn-dark" onclick="StartLoadingRestore()" id="resbtn" style="display:block;">Restore backup before update</button>
						</form>
					</center>
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