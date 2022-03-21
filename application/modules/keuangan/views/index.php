<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laporan Keuangan</title>

	<!-- Bootstrap -->
	<link href="<?= base_url() ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="<?= base_url() ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="<?= base_url() ?>assets/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="">
	<div class="container body">
		<div class="main_container">
			<!-- page content -->
			<div class="right_col p-5" role="" style="min-height: 900px;">
				<div class="d-flex justify-content-end">.
					<a href="<?= base_url('auth'); ?>" class="btn btn-primary">Login User</a>
				</div>
				<div class="">
					<div class="page-title">
						<div class="text-center">
							<h1>SMK Negeri 2 Pematang Siantar</h1>
						</div>
						<div class="title_right">
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12  ">
							<div class="x_panel" style="min-height: 100px;">
								<div class="x_content">
									<div class="text-center mt-5">
										<label for="">
											<h3>Masukan NIS / Nama Siswa</h3>
										</label>
										<div class="mx-auto">
											<form action="" id="form-search" class="form-horizontal">
												<div class="row justify-content-center">
													<div class="mr-3 mb-3">
														<input type="text" name="nis" required id="data-nis" class="form-control">
													</div>
													<button type="submit" class="btn btn-primary" style="height: 40px;" id="search">Cari Data
														<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
													</button>
												</div>
											</form>
										</div>
									</div>
									<div id="spp" style="align-content: center;font-size: 20px;" class="data-spp">
										<div class="card">
											<div class="card-header">
												<div class="row">
													<div class="col-md-4">
														Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<span id="spp-nama"></span></div>
													<div class="col-md-4">
														NIS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<span id="spp-nis"></span></div>
												</div>
												<div class="row mb-3">
													<div class="col-md-4">
														Kelas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<span id="spp-kelas"></span></div>
													<div class="col-md-4">Jurusan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<span id="spp-jurusan"></span></div>
												</div>
											</div>
											<div class="card-body" style="font-size: 20px;">

												<table class="table">
													<thead class="">
														<tr>
															<th>Bulan</th>
															<th>Tanggal Bayar</th>
															<th>Nominal</th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody id="spp-content">

													</tbody>
												</table>
											</div>
										</div>
									</div>

									<div id="alert-search" class="alert alert-warning alert-dismissible text-white data-spp" role="alert" style="display: none;">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
										</button>
										<h2>Data NIS <strong id="alert-nis">Holy guacamole!</strong> tidak ditemukan.</h2>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<div class="footer_fixed">
				<footer style="margin-left: 0px;" class="bg-secondary text-white">
					<h2><b>SMK Negeri 2 Pematang Siantar</b></h2>
					Jl. Sangnaualuh Kel
					<br>
					2022 SMKN 2 Pematang Siantar
				</footer>
			</div>

			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?= base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="<?= base_url() ?>assets/vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="<?= base_url() ?>assets/vendors/nprogress/nprogress.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="build/js/custom.min.js"></script>
	<script>
		$('#spp').hide();
		$('.data-spp').hide();

		function base_url() {
			var pathparts = location.pathname.split('/');
			if (location.host == 'localhost') {
				var url = location.origin + '/' + pathparts[1].trim('/') + '/';
			} else {
				var url = location.origin + '/';
			}
			return url;
		}

		$(document).ready(function() {

			$('#form-search').submit(function(e) {
				$('.footer_fixed').removeClass('footer_fixed');
				e.preventDefault();
				$('.data-spp').hide();

				let nis = $('#data-nis').val();

				$.ajax({
					url: base_url() + 'keuangan/search/' + nis,
					method: 'GET',
					dataType : 'JSON',
					success: function(data) {
						if(data.status){
							console.log('lebih')
							let table = '';
							$('#spp-nama').html(data.data[0].nama_siswa);
							$('#spp-nis').html(data.data[0].nis);
							$('#spp-jurusan').html(data.data[0].jurusan);
							$('#spp-kelas').html(data.data[0].kelas);
							$.each(data.data, function(keys, values) {
								table += `<tr>
											<td>${values.bulan}</td>
											<td>${values.tanggal_bayar}</td>
											<td>${values.nominal != '' ? 'Rp. '+values.nominal : '-'}</td>
											<td><span class="badge badge-success">Sudah Bayar</span></td>
										</tr>`
							});
							$('#spp-content').html(table);
							$('#spp').show();
						}else{
							console.log('kurang')

							$('#spp').hide();
							$('#alert-nis').html(nis);
							$('#alert-search').show();
						}
					},
					error: function(xhr) {
						console.log('error ' + xhr)
					}
				});

				// $('#spp').hide();
				// $('#alert-nis').html(nis);
				// $('#alert-search').show();

				
				// $.each(data, function(key, val) {
				// 	if (val.nis.toLowerCase() == nis.toLowerCase() || val.nama.toLowerCase() == nis.toLowerCase()) {
				// 		let table = '';
				// 		$('#spp-nama').html(val.nama);
				// 		$('#spp-nis').html(val.nis);
				// 		$('#spp-jurusan').html(val.jurusan);
				// 		$('#spp-kelas').html(val.kelas);
				// 		$.each(val.transaksi, function(keys, values) {
				// 			table += `<tr>
				// 				<td>${values.bulan}</td>
				// 				<td>${values.tanggal_bayar}</td>
				// 				<td>${values.nominal != '' ? 'Rp. '+values.nominal : '-'}</td>
				// 				<td><span class="badge badge-${values.status == 'Belum Bayar' ? 'danger' : 'success'}">${values.status}</span></td>
				// 			</tr>`
				// 		});
				// 		$('#spp-content').html(table);
				// 		$('#spp').show();
				// 		return false;
				// 	}
				// 	$('#spp').hide();
				// 	$('#alert-nis').html(nis);
				// 	$('#alert-search').show();
				// });

			});
		});
	</script>
</body>

</html>