<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="<?php print Theme::Admin_PathStyle(); ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
		</div>
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<?php if(Permission::Full()) { ?>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="<?php print Theme::URL(); ?>admin_panel/permissions/" class="nav-link"><font color="orange"><i class="fa fa-bolt" aria-hidden="true"></i> Grant Access</font></a>
					</li>
				<?php } 
				if(Permission::Verify('genset') || Permission::Verify('articles') || Permission::Verify('custpag')) { ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Settings
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php if(Permission::Verify('genset')) { ?>
							<a class="dropdown-item" href="<?php print Theme::URL(); ?>admin_panel/general-settings"><i class="nav-icon fa-solid fa-gears"></i> General Settings</a>
						<?php } if(Permission::Verify('articles')) { ?>
							<a class="dropdown-item" href="<?php print Theme::URL(); ?>admin_panel/news-settings"><i class="nav-icon fa-solid fa-gears"></i> Articles Settings</a>
						<?php } if(Permission::Verify('custpag')) { ?>
							<a class="dropdown-item" href="<?php print Theme::URL(); ?>admin_panel/custom-page/"><i class="nav-icon fa-solid fa-gears"></i> Custom Pages</a>
						<?php } if(Permission::Full()) { ?>
							<a class="dropdown-item" href="<?php print Theme::URL(); ?>admin_panel/backup"><i class="nav-icon fa-solid fa-gears"></i>  Website Backup</a>
						<?php } ?>
					</div>
				</li>
				<?php }  if(Permission::Verify('adlang') || Permission::Verify('editlang')) { ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Languages
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php if(Permission::Verify('adlang')) { ?>
							<a class="dropdown-item" href="<?php print Theme::URL(); ?>admin_panel/languages"><i class="fa fa-language" aria-hidden="true"></i> Language Manager</a>
						<?php } if(Permission::Verify('editlang')) { ?>
							<a class="dropdown-item" href="<?php print Theme::URL(); ?>admin_panel/languages_edit/en"><i class="fa fa-language" aria-hidden="true"></i> Translations</a>
						<?php } ?>
					</div>
				</li>
				<?php }  if(Permission::Verify('manateme')) { ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php print Theme::URL(); ?>admin_panel/template_settings">
						Templates
					</a>
				</li>
				<?php }  if(Permission::Verify('plugsett')) { ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php print Theme::URL(); ?>admin_panel/plugins/">
						Plugins
					</a>
				</li>
				<?php } ?>
				<li class="nav-item" style="margin-top:10px;margin-left:100px;" data-toggle="tooltip" data-placement="bottom" title="Live online players">
					<center>
						<a>
						<i class="fa fa-user" aria-hidden="true"></i> <span id="liveplayers">0</span>
						<span id="saving" style="display:none;"></span>
						</a>
					</center>
				</li>
				<script>
					$(function () {
						$('[data-toggle="tooltip"]').tooltip()
					})
				</script>
				
			</ul>
			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Navbar Search -->
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<li class="nav-item">
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
							<i class="far fa-bell"></i>
							<?php if(Dependencies::isUpdate()) { ?>
							<span class="badge badge-warning navbar-badge">
								1
							</span>
							<?php } ?>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
							<span class="dropdown-item dropdown-header"><?php if(Dependencies::isUpdate()) print '1 New Notification'; else print 'Notifications'; ?></span>
							<div class="dropdown-divider"></div>
							<?php if(Dependencies::isUpdate()) { ?>
							<a href="<?= Theme::URL(); ?>admin_panel/acms_update" class="dropdown-item bg-warning">
								<i class="fas fa-bell" aria-hidden="true"></i> A new update are available
							</a>
							<?php } ?>
							<a href="" class="dropdown-item dropdown-footer"></a>
						</div>
					</li>
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
					<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index3.html" class="brand-link">
			<img src="<?php print Theme::Admin_PathStyle(); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">Mt2Services - Panel</span>
			</a>
			<div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
				<div class="os-resize-observer-host observed">
					<div class="os-resize-observer" style="left: 0px; right: auto;"></div>
				</div>
				<div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
					<div class="os-resize-observer"></div>
				</div>
				<div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 903px;"></div>
				<div class="os-padding">
					<div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
						<div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
							<!-- Sidebar user panel (optional) -->
							
							<!-- SidebarSearch Form -->
							<!-- Sidebar Menu -->
							<nav class="mt-2">
								<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
									
									<li class="nav-header">Home Pages</li>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel" class="nav-link <?php if($pagea=='home') print 'active'; ?>">
											<i class="nav-icon fa fa-dashboard"></i>
											<p>
												Dashboard
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a target="_blank" href="<?php print Theme::URL(); ?>" class="nav-link">
											<i class="nav-icon fa fa-window-maximize"></i>
											<p>
												Homepage Preview
											</p>
										</a>
									</li>
									<hr>
									<li class="nav-header">Basic Settings</li>
									<?php if(Permission::Verify('articles')) { ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/news" class="nav-link">
											<i class="nav-icon fa fa-newspaper"></i>
											<p>
												Articles
											</p>
										</a>
									</li>
									<?php } if(Permission::Verify('downloads')) { ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/download" class="nav-link">
											<i class="nav-icon fa fa-download"></i>
											<p>
												Download
											</p>
										</a>
									</li>
									<?php } if(Permission::Verify('logs')) { ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/logs" class="nav-link">
											<i class="nav-icon fa fa-font-awesome"></i>
											<p>
												Server Log
											</p>
										</a>
									</li>
									<?php } if(Permission::Verify('createitem')) { ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/create_item" class="nav-link">
											<i class="nav-icon fa fa-fire"></i>
											<p>
												Create Item
											</p>
										</a>
									</li>
									<?php } if(Permission::Verify('banplay')) { ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/players_management" class="nav-link">
											<i class="nav-icon fa fa-user"></i>
											<p>
												Players Management
											</p>
										</a>
									</li>
									<?php } if(Permission::Verify('promotional')) { ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/voucher" class="nav-link">
											<i class="nav-icon fa fa-ticket"></i>
											<p>
												Promotional Codes
											</p>
										</a>
									</li>
									<?php } if(Permission::Verify('vote4coins')) { ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/vote" class="nav-link">
											<i class="nav-icon fa fa-check-to-slot"></i>
											<p>
												Vote for Coins
											</p>
										</a>
									</li>
									<?php } if(Permission::Verify('refferal')) { ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/refferals" class="nav-link">
											<i class="nav-icon fa fa-circle-user"></i>
											<p>
												Refferal System
											</p>
										</a>
									</li>
									<?php } ?>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/events" class="nav-link">
											<i class="nav-icon fa-solid fa-calendar"></i>
											<p>&nbsp;Events</p>
										</a>
									</li>
									<hr>
									<li class="nav-header">Statistics</li>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/statistics" class="nav-link">
											<i class="nav-icon fa-solid fa-area-chart"></i>
											<p>&nbsp;Statistics</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php print Theme::URL(); ?>admin_panel/web-statistics" class="nav-link">
											<i class="nav-icon fa-solid fa-area-chart"></i>
											<p>&nbsp;Web Statistics</p>
										</a>
									</li>
									<hr>
									<?php if(Permission::Verify('marketplace') && Permission::Verify('plugsett')) { ?>
									<li class="nav-header">Marketplace</li>
									<?php } if(Permission::Verify('marketplace')) { ?>
									<li class="nav-item">
										<a target="_blank" href="https://mt2-services.eu" class="nav-link">
											<i class="nav-icon fa-solid fa-shop"></i>
											<p>&nbsp;Store</p>
										</a>
									</li>
									<hr>
									<li class="nav-item">
										<a href="https://paypal.me/cristianservers?country.x=RO&locale.x=en_US" class="nav-link">
											<i class="nav-icon fa-brands fa-paypal"></i>
											<p>&nbsp;ACMS Donation</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="https://discord.gg/AwhKh3Hbtp" class="nav-link">
											<i class="nav-icon fa-solid fa-handshake-angle"></i>
											<p>&nbsp;Help</p>
										</a>
									</li>
									<?php } ?>
									<hr>
								</ul>
							</nav>
							<!-- /.sidebar-menu -->
						</div>
					</div>
				</div>
				<div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
					<div class="os-scrollbar-track">
						<div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
					</div>
				</div>
				<div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
					<div class="os-scrollbar-track">
						<div class="os-scrollbar-handle" style="height: 66.5195%; transform: translate(0px, 0px);"></div>
					</div>
				</div>
				<div class="os-scrollbar-corner"></div>
			</div>
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" style="height:auto;">
			<section class="content">
				<div class="container-fluid">
					<?php
						include Theme::Admin_Path($pagea);
						?>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; <?= date('Y'); ?> <a href="https://mt2-services.eu">Mt2Services</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				Version <b><?=$_version; ?></b>
			</div>
		</footer>
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->
	<!-- jQuery -->
	<link rel="stylesheet" href="<?php print Theme::URL(); ?>style/partials/tagsinput.css">
	<script src="<?php print Theme::URL(); ?>style/partials/tagsinput.js"></script>
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<!-- jQuery Knob Chart -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/moment/moment.min.js"></script>
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="<?php print Theme::Admin_PathStyle(); ?>dist/js/pages/dashboard.js"></script>
	<script src="<?php print Theme::Admin_PathStyle(); ?>/plugins/bootstrap-switch/js/bootstrap-switch.js"></script>
	<script>
		var onp = window.setInterval(function(){
			showonlineplayers();
		}, 2000);
		var saveonp = window.setInterval(function(){
			saveoldnumber();
		}, 10000);
		function saveoldnumber() {
			$("#saving").load("<?= Theme::URL(); ?>?v=general&liveonplayer=save");
		}
		function showonlineplayers() {
			$("#liveplayers").load("<?= Theme::URL(); ?>?v=general&liveonplayer=now");
		}
	</script>
</body>
</html>