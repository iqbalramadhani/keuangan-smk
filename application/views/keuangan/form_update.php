<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><?= $title; ?></h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5   form-group pull-right top_search">
					<a href="<?= base_url() . $module ?>"><?= ucfirst($module); ?></a> / <a href=""><?= $title ?></a>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12  ">
				<div class="x_panel">

					<div class="x_content">
						<button type="button" class="btn btn-primary btn-lg" id="back" onclick="window.location.href = '<?= base_url() . $module.'/input'; ?>'">Kembali</button>
						<?= form_open(base_url($module . '/save/' . $id), array('class' => 'form-horizontal form-label-left')) ?>
						<div class="item form-group">
							<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 ">
								<input id="" name="nama_siswa" value="<?= isset($pembayaran) ? $pembayaran->nama_siswa : '' ?>" required="required" class="form-control" type="text">
							</div>
						</div>
						<div class="item form-group">
							<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">NIS</label>
							<div class="col-md-6 col-sm-6 ">
								<input id="" name="nis" value="<?= isset($pembayaran) ? $pembayaran->nis : '' ?>" class="form-control" type="text">
							</div>
						</div>
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Kelas <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<select name="kelas" class="form-control select2" id="kelas" required='required'>
									<?php foreach ($kelas as $ks) : ?>
										<option value="<?= $ks->id_kelas; ?>" <?php echo isset($pembayaran) ? set_select('kelas', $ks->id_kelas, ($pembayaran->kelas == $ks->id_kelas)) : ''; ?>><?= $ks->tingkat . '-' . $ks->kode_jurusan . '-' . $ks->kelas ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Bulan <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<select name="bulan" id="" class="form-control select2">
									<option value="1" <?php echo isset($pembayaran) ? set_select('bulan[]', '1', ($pembayaran->bulan == '1')) : ''; ?>>Januari</option>
									<option value="2" <?php echo isset($pembayaran) ? set_select('bulan[]', '2', ($pembayaran->bulan == '2')) : ''; ?>>Februari</option>
									<option value="3" <?php echo isset($pembayaran) ? set_select('bulan[]', '3', ($pembayaran->bulan == '3')) : ''; ?>>Maret</option>
									<option value="4" <?php echo isset($pembayaran) ? set_select('bulan[]', '4', ($pembayaran->bulan == '4')) : ''; ?>>April</option>
									<option value="5" <?php echo isset($pembayaran) ? set_select('bulan[]', '5', ($pembayaran->bulan == '5')) : ''; ?>>Mei</option>
									<option value="6" <?php echo isset($pembayaran) ? set_select('bulan[]', '6', ($pembayaran->bulan == '6')) : ''; ?>>Juni</option>
									<option value="7" <?php echo isset($pembayaran) ? set_select('bulan[]', '7', ($pembayaran->bulan == '7')) : ''; ?>>Juli</option>
									<option value="8" <?php echo isset($pembayaran) ? set_select('bulan[]', '8', ($pembayaran->bulan == '8')) : ''; ?>>Agustus</option>
									<option value="9" <?php echo isset($pembayaran) ? set_select('bulan[]', '9', ($pembayaran->bulan == '9')) : ''; ?>>September</option>
									<option value="10" <?php echo isset($pembayaran) ? set_select('bulan[]', '10', ($pembayaran->bulan == '10')) : ''; ?>>Oktober</option>
									<option value="11" <?php echo isset($pembayaran) ? set_select('bulan[]', '11', ($pembayaran->bulan == '11')) : ''; ?>>November</option>
									<option value="12" <?php echo isset($pembayaran) ? set_select('bulan[]', '12', ($pembayaran->bulan == '12')) : ''; ?>>Desember</option>
								</select>
							</div>
						</div>
						<div class="item form-group">
							<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Bayar <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 ">
								<input type="text" name="tanggal_bayar" value="<?= isset($pembayaran) ? date('d-m-Y',strtotime($pembayaran->tanggal_bayar)) : '' ?>" class="form-control input-date" onkeydown="return false;" required>
							</div>
						</div>
						<div class="item form-group">
							<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nominal <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 ">
								<input id="" name="nominal" value="<?= isset($pembayaran) ? number_format($pembayaran->nominal,0,'.','.')  : '' ?>" required="required" class="form-control nominal" type="text">
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="item form-group">
							<div class="col-md-6 col-sm-6 offset-md-3">
								<button class="btn btn-primary" type="reset">Reset</button>
								<button type="submit" class="btn btn-success">Kirim</button>
							</div>
						</div>
						<?= form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('dashboard/js.php');
?>