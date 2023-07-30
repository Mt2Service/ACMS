<section class="content">
<?php
	if(isset($_POST['change_status'], $_POST['status_id'], $_POST['status_value']))
	{
		Plugins::Update($_POST['status_id'], $_POST['status_value']);
	}

?>
<div class="container-fluid">
	<div class="container-fluid py-4">
		<div class="row mb-4">
			<div class="col-lg-12 mb-md-0 mb-4">
				<div class="row">
					<div class="col-lg-12 col-md-6 mb-md-0 mb-4">
						<div class="card card-secondary" style="height:auto;">
							<div class="card-header">
								<h3 class="card-title"><i class="fa-solid fa-plug"></i> Plugins</h3>
								<div class="card-tools"></div>
							</div>
							<div class="card-body">
								<div class="row">
									<table class="table table-bordered">
										<tbody>
											<?php
												$list = array();
												$list = Plugins::Enum();
												foreach($list as $s)
												{
													if($s['active']==1)
														$status = '<font color="green">Active</font>';
													else
														$status = '<font color="red">Inactive</font>';
													?>
													<tr>
														<!----------------------->
														<td style="vertical-align:middle;">
															<b>
																<center><?= $s['name']; ?></center>
															</b>
																<center><b>Status:</b>&nbsp;<?= $status; ?></center>
														</td>
														<!----------------------->
														<td style="vertical-align:middle;width:30%;">
															<p><?= $s['description']; ?></p>
														</td>
														<!----------------------->
														<?php
															if($s['active']==1)
															{
																print '<td style="vertical-align:middle;"><center>';
																if(file_exists('system/plugins/'.$s['short'].'/index.php'))
																{
																	include 'system/plugins/'.$s['short'].'/index.php';
																}
																print '</center></td>';
															}
														?>
														<!----------------------->
												
														<td style="vertical-align:middle;">
															<center>
																<form method="POST">
																	<input type="hidden" value="<?= $s['id']; ?>" name="status_id">
																	<input type="hidden" value="<?= $s['active']; ?>" name="status_value">
																	<?php 
																	if($s['active']==1)
																		print '<button type="submit" name="change_status" title="Turn off" class="btn btn-danger btn-sm"><i class="fa fa-ban fa-1" aria-hidden="true"></i></button>';
																	else
																		print '<button type="submit" name="change_status" title="Turn on" class="btn btn-success btn-sm"><i class="fa fa-check fa-1" aria-hidden="true"></i></button>';
																	 
																	//if($s['editable']==1)
																	//	print '&nbsp; <button type="submit" name="change_status" title="Edit information" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-1" aria-hidden="true"></i></button>';
																	
																	?>
																</form>
															</center>
														</td>
													</tr>
													<?php
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>