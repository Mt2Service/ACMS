<?php if(Permission::Verify('adlang')) { 

	if(isset($_POST['langfull'],$_POST['langcode']))
	{
		$tolow = strtolower($_POST['langcode']);
		$first = ucfirst($_POST['langfull']);
		$installed = false;
		if(Lang::Add($tolow))
		{
			$json_languages['languages'][$tolow] = $first;
			$installed = true;
			if($installed)
			{
				$json_new = json_encode($json_languages);
				if(file_put_contents('system/database/db_languages.json', $json_new))
					print '<script>alertSuccess("'.$first.'");</script>';
			}
		}
		else 
		{
			$json_languages['languages'][$tolow] = $first;
			$installed = true;
			if($installed)
			{
				$json_new = json_encode($json_languages);
				if(file_put_contents('system/database/db_languages.json', $json_new))
					print '<script>alertSuccess("Translations exist, added just on list.");</script>';
			}
		}
	}
	elseif(isset($_POST['keys'], $_POST['ddelete']))
	{
		$deleted = false;
		if($_POST['keys'] != $json_languages['settings']['default'])
		{
			unset($json_languages['languages'][$_POST['keys']]);
			$deleted = true;
		}
		if($deleted)
		{
			$json_new = json_encode($json_languages);
			if(file_put_contents('system/database/db_languages.json', $json_new))
			print '<script>alertError("Deleted succesfully!");</script>';
		}
	}
	elseif(isset($_POST['keys'], $_POST['make_primary']))
	{
		$makeprimary = false;
		$json_languages['settings']['default'] = $_POST['keys'];
		$makeprimary = true;
		if($makeprimary)
		{
			$json_new = json_encode($json_languages);
			file_put_contents('system/database/db_languages.json', $json_new);
		}
	}
	if(isset($_POST['keys'], $_POST['turnlang']))
	{
		if(Lang::ChangeStatus($_POST['keys']))
			print '<script>alertSuccess("language status changed");</script>';
	}
?>

<div class="container-fluid py-4">
	<div class="row mb-4">
		<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title"><?=l(233);?></h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<form method="POST">
						<input type="text" name="langfull" class="form-control" placeholder="<?=l(231);?> (ex: English,Deutsch)"><br>
						<input type="text" name="langcode" class="form-control" placeholder="<?=l(232);?> (ex: en,de,ro)"><br>
						<center><input type="submit" class="btn btn-success" value="<?=l(230);?>"></center>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title"><?=l(234);?></h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th><?=l(231);?></th>
								<th><?=l(232);?></th>
								<th style="width:40%;"><?=l(145);?> </th>
							</tr>
						</thead>
						<tbody>
						<?php
							if(count($json_languages['languages'])>1) 
							{
								foreach($json_languages['languages'] as $key => $value)
								{
									?>
									<tr>
										<td><?= $value;?></td>
										<td><?= $key;?></td>
										<td>
											<center>
												<form method="POST">
													<input type="hidden" value="<?= $key;?>" name="keys">
													<button type="submit" alt="<?=l(235);?>" title="<?=l(235);?>" name="make_primary" class="btn btn-secondary btn-sm" <?php if($json_languages['settings']['default']==$key) print 'disabled'; ?>>
														<i class="fa-solid fa-key"></i>
													</button>
													&nbsp;
													<?php if(Lang::StatusVF($key)) { ?>
													<button type="submit" class="btn btn-success btn-sm" name="turnlang">
														<i class="fa fa-toggle-on" aria-hidden="true"></i>
													</button>
													<?php } else { ?>
													<button type="submit" class="btn btn-danger btn-sm" name="turnlang">
														<i class="fa fa-toggle-off" aria-hidden="true"></i>
													</button>
													<?php } ?>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<button type="submit" class="btn btn-danger btn-sm" name="ddelete">
														<i class="fa fa-trash"></i>
													</button>
													&nbsp;
													<a href="<?=Theme::URL(); ?>admin_panel/languages_edit/<?= $key;?>">
														<button type="submit" class="btn btn-warning btn-sm">
															<i class="fa fa-pencil"></i>
														</button>
													</a>
												</form>
											</center>
										</td>
									</tr>
									<?php
								}
							
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