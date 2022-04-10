<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><?= $title; ?></h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5   form-group pull-right top_search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Go!</button>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12  ">
				<div class="x_panel">
					<div class="x_title">
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="#">Settings 1</a>
									<a class="dropdown-item" href="#">Settings 2</a>
								</div>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<button type="button" class="btn btn-primary" id="back" onclick="window.location.href = '<?= base_url('dashboard'); ?>'">Kembali</button>
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<table class="table mt-3">
								<thead>
									<th>Kelas</th>
									<th>Pemasukan Hari Ini</th>
									<th>Pemasukan Minggu Ini</th>
									<th>Pemasukan Bulan Ini</th>
									<th>Total Pemasukan</th>
								</thead>
								<tbody>
									<?php foreach ($data as $datas) : ?>
										<tr>
											<td><?= $datas['kelasnya']; ?></td>
											<td><?= number_format($datas['nominal_hariini'],0,'.','.'); ?></td>
											<td><?= number_format($datas['nominal_minggu'],0,',','.'); ?></td>
											<td><?= number_format($datas['nominal_bulan'],0,',','.'); ?></td>
											<td><?= number_format($datas['total_nominal'],0,',','.'); ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>

							

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('dashboard/js.php');
?>