<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<!-- NProgress -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.css">

	<!-- Custom Theme Style -->
	<link href="<?= base_url() ?>assets/build/css/custom.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="<?= base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">

	<style>
		.judul {
			margin-bottom: -10px;
		}
	</style>
</head>

<body class="login">
	<div>
		<h1 class="text-center judul mt-5">SMKN 2 PEMATANG SIANTAR</h1>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>
		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<?php if(!empty($this->session->flashdata('info'))){ ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Username atau Password salah
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } ?>
					<?= form_open(base_url('auth')) ?>
					<h1>Login User</h1>
					<div>
						<input type="text" name="username" class="form-control" placeholder="Username" required="" />
					</div>
					<div>
						<input type="password" name="password" class="form-control" placeholder="Password" required="" />
					</div>
					<div class="text-center">
						<input type="submit" name="submit" value="Log in" class="btn btn-primary submit">
						<button type="button" onclick="location.href='<?= base_url(); ?>'" class="btn btn-success">Kembali</button>
					</div>

					<div class="clearfix"></div>

					<div class="separator">
						<div class="clearfix"></div>
						<br />

						<div>
						</div>
					</div>
					</form>
				</section>
			</div>

			<div id="register" class="animate form registration_form">
				<section class="login_content">
					<form>
						<h1>Create Account</h1>
						<div>
							<input type="text" class="form-control" placeholder="Username" required="" />
						</div>
						<div>
							<input type="email" class="form-control" placeholder="Email" required="" />
						</div>
						<div>
							<input type="password" class="form-control" placeholder="Password" required="" />
						</div>
						<div>
							<a class="btn btn-default submit" href="index.html">Submit</a>
						</div>

						<div class="clearfix"></div>

						<div class="separator">
							<p class="change_link">Already a member ?
								<a href="#signin" class="to_register"> Log in </a>
							</p>

							<div class="clearfix"></div>
							<br />

							<div>
								<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>

							</div>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
	<div class="fixed-bottom text-center">
		<p>©2022 SMKN 2 PEMATANG SIANTAR</p>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

</body>

</html>