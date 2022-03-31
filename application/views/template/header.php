<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= $title; ?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<!-- NProgress -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.css">

	<!-- Custom Theme Style -->
	<link href="<?= base_url() ?>assets/build/css/custom.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">



	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="<?= base_url('dashboard'); ?>" class="site_title"><img src="<?= base_url('assets/img/logo.png') ?>" width="50px" height="50px" alt=""> <span>SIM KEUANGAN</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="<?= base_url('assets/img/default-user.png') ?>" alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2>Admin</h2>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<ul class="nav side-menu">
								<li>
									<a href="<?= base_url('dashboard'); ?>"><i class="fa fa-home"></i>Dashboard<span class="label label-success pull-right"></span></a>
								</li>
								<li>
									<a href="<?= base_url('jurusan'); ?>"><i class="fa fa-file-text-o"></i>Jurusan<span class="label label-success pull-right"></span></a>
								</li>
								<li>
									<a href="<?= base_url('kelas'); ?>"><i class="fa fa-list-alt"></i>Kelas<span class="label label-success pull-right"></span></a>
								</li>
								<li>
									<a href="<?= base_url('keuangan/input'); ?>"><i class="fa fa-money"></i>Keuangan<span class="label label-success pull-right"></span></a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /sidebar menu -->

				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="<?= base_url('assets/img/default-user.png') ?>" alt="">Admin
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="javascript:;"> Profile</a>
									<a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->
			<script>
				// base url
				function base_url() {
					var pathparts = location.pathname.split('/');
					if (location.host == 'localhost') {
						var url = location.origin + '/' + pathparts[1].trim('/') + '/';
					} else {
						var url = location.origin + '/';
					}
					return url;
				}
			</script>