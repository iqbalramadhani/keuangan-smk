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
						<button class="btn btn-primary" id="tambah-data">Tambah Data</button>
						<a href="<?= base_url('keuangan/export/'.$tgl) ?>" target="_blank" class="btn btn-primary">Export Excel</a>
						<hr>
						<?= form_open(base_url('keuangan/filter')) ?>
						<label for="">Tanggal Bayar</label>
						<br>
						<input type="text" name="tanggal" id="tgl" class="form-control col-md-3">
						<button class="btn btn-primary ml-3 filter"><i class="fa fa-search"></i></button>
						<a href="<?= base_url('keuangan/input') ?>" class="btn btn-primary"><i class="fa fa-undo"></i></a>
						</form>

						<br>
						<div class="table-responsive">

							<table class="table mt-3 table-bordered" id="myTable">
								<thead>
									<tr>
										<th>NIS</th>
										<th>Nama</th>
										<th>Kelas</th>
										<th>Bulan</th>
										<th>Tanggal Bayar</th>
										<th>Nominal</th>
										<th>Aksi</th>
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
											<td width="20%">
												<a href="<?= base_url('keuangan/form/'.encode_arr($pe->id_pembayaran)) ?>" class="btn btn-warning">Ubah</a>
												<a href="<?= base_url('keuangan/hapus/'.encode_arr($pe->id_pembayaran)) ?>" onclick="return confirm('Akan menghapus data ini ?')" class="btn btn-danger">Hapus</a>
											</td>
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
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
	function formatDate() {
		var d = new Date(),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();

		if (month.length < 2)
			month = '0' + month;
		if (day.length < 2)
			day = '0' + day;

		return [month,day,year].join('/');
	}

	$('#tgl').daterangepicker({
		"showDropdowns": true,
		"maxYear": new Date().getFullYear(),
		"autoApply": true,
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		"startDate": formatDate(),
		"endDate": formatDate()
	});
</script>