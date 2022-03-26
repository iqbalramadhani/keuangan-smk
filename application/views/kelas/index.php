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
					<div class="x_content">
						<?php if (!empty($this->session->flashdata('info'))) { ?>
							<div class="alert alert-<?= $this->session->flashdata('info')[0] ? 'success' : 'warning' ?> alert-dismissible fade show" role="alert">
								<?= $this->session->flashdata('info')[1]; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php } ?>
						<button class="btn btn-primary btn-lg" id="tambah-data">Tambah Data</button>
						<br>
						<div class="table-responsive">
							<table class="table" id="myTable">
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
											<td><?= $class->tingkat . '-' . $class->kode_jurusan . '-' . $class->kelas; ?></td>
											<td>
												<a href="<?= base_url('kelas/form/' . encode_arr($class->id_kelas)); ?>" class="btn btn-warning">Ubah</a>
												<a href="<?= base_url('kelas/hapus/' . encode_arr($class->id_kelas)); ?>" class="btn btn-danger" onclick="return confirm('Akan menghapus data ini ?')">Hapus</a>
											</td>
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
</div>