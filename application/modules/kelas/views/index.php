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
						<h2>Plain Page</h2>
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
						<button class="btn btn-primary btn-lg" id="tambah-data">Tambah Data</button>
						<br>
						<table class="table col-md-5">
							<thead>
								<tr>
									<td>No</td>
									<td>Kelas</td>
									<td>Aksi</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($kelas as $key => $class) :
								?>
									<tr>
										<td><?= $key + 1; ?></td>
										<td><?= $class->tingkat.'-'.$class->jurusan.'-'.$class->kelas; ?></td>
										<td><a href="<?= base_url('kelas/form/'.encode_arr($class->id_kelas)); ?>" class="btn btn-warning">Ubah</a> <a href="" class="btn btn-danger">Hapus</a></td>
									</tr>
								<?php
								endforeach;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('dashboard/js.php');
?>