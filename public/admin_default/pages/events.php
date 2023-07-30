<?php
	if(isset($_POST['insertevent'],$_POST['title'],$_POST['addevent']))
	{
		if(UPDATE200::AddEvent($_POST['title'], $_POST['addevent']))
			print '<script>alertSuccess("event added");</script>';
	}
	
	if(isset($_POST['prodid'],$_POST['disable']))
	{
		if(UPDATE200::DisableEvent($_POST['prodid']))
			print '<script>alertSuccess("updated status");</script>';
	}
	elseif(isset($_POST['prodid'],$_POST['delete']))
	{
		if(UPDATE200::DeleteEvent($_POST['prodid']))
			print '<script>alertSuccess("event deleted");</script>';
	}

?>


<div class="container-fluid py-4">
	<div class="row mb-4">
		<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title">Add live event</h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
					<form method="POST">
						<input type="text" name="title" class="form-control" placeholder="Event title"><br>
						<textarea name="addevent" id="addevent" rows="10" cols="80"></textarea>
						<br><br>
						<center><input type="submit" class="btn btn-dark btn-sm" name="insertevent" value="<?= l(128); ?>"></center>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
			<div class="card card-secondary">
				<div class="card-header pb-0">
					<h4 class="card-title">Events list</h4><br>
					<h6 style="float:right;"></h6>
				</div>
				<div class="card-body">
				<table class="table table-bordered">
					<thead class="thead-dark">
						<tr>
							<th scope="col" style="width:20%;"><center>Title</center></th>
							<th scope="col" style="width:30%;"><center>Content</center></th>
							<th scope="col" style="width:10%;"><center>Active</center></th>
							<th scope="col"><center><?= l(145); ?></center></th>
						</tr>
					</thead>
					<tbody>
				<?php
					$events_list = array();
					$events_list = UPDATE200::ListEvent();
					foreach($events_list as $show)
					{
						if($show['active']==1) $event_sts = 'enabled'; else $event_sts = 'disabled'; 
						print '<tr>';
						print '<td><center>'.$show['title'].'</center></th>';
						print '<td><center>'.$show['container'].'</center></td>';
						print '<td><center>'.$event_sts.'</center></td>';
						print '<td><center>
						<form method="POST">
						<input type="hidden" name="prodid" value="'.$show['id'].'">
						<button name="disable" type="submit" class="btn btn-warning btn-sm" alt="Disable" title="Disable">Enable/Disable</button>&nbsp;
						<button name="delete" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></form></center></td>';
						print '</tr>';
					}
				
				
				?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	CKEDITOR.replace('addevent');
</script>