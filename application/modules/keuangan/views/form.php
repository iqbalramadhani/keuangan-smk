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
						<?= form_open(base_url($module . '/save/' . $id)) ?>
						<button type="button" class="btn btn-primary btn-lg" id="back" onclick="window.location.href = '<?= base_url($module.'/input'); ?>'">Kembali</button>
						<button type="submit" class="btn btn-primary btn-lg">Simpan</button>
						<br>
						<select name="kelas" class="form-control col-md-3 mb-3 mt-3">
							<option value="">--Pilih Kelas--</option>
							<?php foreach ($kelas as $kelass) : ?>
								<option value="<?= $kelass->id_kelas ?>"><?= $kelass->tingkat . '-' . $kelass->kode_jurusan . '-' . $kelass->kelas ?></option>
							<?php endforeach; ?>
						</select>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Nama <span>*</span></th>
										<th>NIS <span>*</span></th>
										<th>Bulan</th>
										<th>Tanggal Bayar</th>
										<th colspan="2">Nominal</th>
									</tr>
								</thead>
								<tbody id="table-data">
									<tr id="row-1">
										<td><input type="text" name="nama[]" class="form-control" required></td>
										<td><input type="text" name="nis[]" class="form-control" required></td>
										<td>
											<select name="bulan[]" id="" class="form-control">
												<option value="1">Januari</option>
												<option value="2">Februari</option>
												<option value="3">Maret</option>
												<option value="4">April</option>
												<option value="5">Mei</option>
												<option value="6">Juni</option>
												<option value="7">Juli</option>
												<option value="8">Agustus</option>
												<option value="9">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</td>
										<td>
											<input type="text" name="tgl_bayar[]" class="form-control input-date" readonly required>
										</td>
										<td>
											<input type="text" name="nominal[]" class="form-control nominal">
										</td>
										<td><button class="btn btn-danger hapus" data-row="row-1" type="button">Hapus</button> </td>
									</tr>
								</tbody>
							</table>
							<button class="btn btn-success" id="add-button" type="button">Tambah Data</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>