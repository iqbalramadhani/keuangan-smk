<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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
						<table class="table mt-3 table-bordered">
							<thead>
								<tr>
									<th>NIS</th>
									<th>Nama</th>
									<th>Kelas</th>
									<th>Bulan</th>
									<th>Tanggal Bayar</th>
									<th>Nominal</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($pembayaran as $pe) : ?>
									<tr>
										<td><?= $pe->nis; ?></td>
										<td><?= $pe->nama_siswa; ?></td>
										<td><?= $pe->kelas; ?></td>
										<td><?= bulanIndo($pe->bulan); ?></td>
										<td><?= tgl_indo($pe->tanggal_bayar); ?></td>
										<td><?= rupiah($pe->nominal); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>