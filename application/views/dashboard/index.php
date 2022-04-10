<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><?= $title; ?></h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5   form-group pull-right top_search">

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
						<div class="row">
							<?php foreach ($data as $datas) : ?>
								<div class="animated flipInY col-md-<?= $datas['id'] == 3 ? '12 text-center total-nominal' : '4' ?>">
									<div class="tile-stats bg-info text-white">
										<div class="count">
											<h6 class="<?= $datas['id'] == 3 ? 'total-nominal' : ''?>"><?= $datas['label']; ?></h6>
										</div>
										<div class="money ml-2 ">Rp. <?= number_format($datas['nominal'], 0, '.', '.') ?></div>
										<?php if (in_array($datas['id'], [4, 5, 6])) { ?>
											<div class="detail-info">
												<a href="<?= base_url('dashboard/detail_pemasukan/'.$datas['tingkat']) ?>" class="text-center">
													<p class="more-detail">Info Lebih Lanjut
														<i class="fa fa-arrow-circle-right"></i>
													</p>
												</a>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('dashboard/js.php');
?>