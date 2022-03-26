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
						<?= form_open_multipart(base_url($module . '/save/' . $id), array('id' => 'form-data')) ?>
						<button type="button" class="btn btn-primary" id="back" onclick="window.location.href = '<?= base_url($module . '/input'); ?>'">Kembali</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
						<br>
						<select name="kelas" class="form-control col-md-3 mb-3 mt-3 ml-2" required>
							<option value="">--Pilih Kelas--</option>
							<?php foreach ($kelas as $kelass) : ?>
								<option value="<?= $kelass->id_kelas ?>"><?= $kelass->tingkat . '-' . $kelass->kode_jurusan . '-' . $kelass->kelas ?></option>
							<?php endforeach; ?>
						</select>
						<br />
						<br />
						<br />
						<div class="mt-3">
							<div class="form-check form-check-inline">
								<input class="form-check-input" data-id="manual" type="radio" checked name="tipe_check" id="inlineRadio1" value="manual">
								<label class="form-check-label" for="inlineRadio1">Input Form</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" data-id="import-excel" type="radio" name="tipe_check" id="inlineRadio2" value="import">
								<label class="form-check-label" for="inlineRadio2">Import Excel</label>
							</div>
						</div>
						<div class="input-form" id="manual">
							<div class="card">
								<div class="table-responsive">
									<table class="table table-bordered">
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
												<td><input type="text" name="nama[]" class="form-control manual-required" required></td>
												<td><input type="text" name="nis[]" class="form-control manual-required" required></td>
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
													<input type="text" name="tgl_bayar[]" class="form-control input-date manual-required" readonly required>
												</td>
												<td>
													<input type="text" name="nominal[]" required class="form-control nominal manual-required">
												</td>
												<td><button class="btn btn-danger hapus" data-row="row-1" type="button">Hapus</button> </td>
											</tr>
										</tbody>
									</table>
									<button class="btn btn-success ml-3 mb-3" id="add-button" type="button">Tambah Data</button>
								</div>
							</div>
						</div>
						<div class="input-form mt-3" id="import-excel" style="display: none;">
							<label>File Excel<span>*</span> | Format : xls</label>
							<input type="file" name="file" id="" class="form-control import-required">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>