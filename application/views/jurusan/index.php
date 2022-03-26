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
						<?php if(!empty($this->session->flashdata('info'))){ ?>
							<div class="alert alert-<?= $this->session->flashdata('info')[0] ? 'success' : 'warning' ?> alert-dismissible fade show" role="alert">
								<?= $this->session->flashdata('info')[1]; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php } ?>
						<button class="btn btn-primary btn-lg mb-3" id="tambah-data">Tambah Data</button>
						<table class="table table-bordered" id="myTable">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Jurusan</th>
									<th>Kode Jurusan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list_jurusan as $key => $list) { ?>
									<tr>
										<td><?= $key + 1; ?></td>
										<td><?= $list->nama_jurusan; ?></td>
										<td><?= $list->kode_jurusan; ?></td>
										<td>
											<a href="<?= base_url($module . '/form/' . encode_arr($list->id_jurusan)); ?>" class="btn btn-warning">Ubah</a>
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