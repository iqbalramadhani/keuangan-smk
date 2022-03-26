<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><?= $title; ?></h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5   form-group pull-right top_search">
					<a href="<?= base_url().$module ?>"><?= $module ?></a> / <a href=""><?= $title ?></a>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12  ">
				<div class="x_panel">
					
					<div class="x_content">
						<button type="button" class="btn btn-primary btn-lg" id="back" onclick="window.location.href = '<?= base_url() . $module; ?>'">Kembali</button>
						<?= form_open(base_url($module . '/save/'.$id), array('class' => 'form-horizontal form-label-left')) ?>
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Tingkat <span class="required">*</span>
							</label>
							
							<div class="col-md-6 col-sm-6 ">
								<select name="tingkat" class="form-control" id="tingkat" required='required'>
									<option value="X" <?php echo isset($kelas) ? set_select('tingkat','X',($kelas->tingkat == 'X')) : ''; ?>>X</option>
									<option value="XI" <?php echo isset($kelas) ? set_select('tingkat','XI',($kelas->tingkat == 'XI')) : ''; ?>>XI</option>
									<option value="XII" <?php echo isset($kelas) ? set_select('tingkat','XII',($kelas->tingkat == 'XII')) : ''; ?>>XII</option>
								</select>
							</div>
						</div>
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Jurusan <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 ">
								<select name="kode_jurusan" class="form-control" required="required">
									<option value="">-Pilih Jurusan-</option>
									<?php foreach ($jurusan as $ju) : ?>
										<option value="<?= $ju->kode_jurusan ?>" <?= isset($kelas) ? set_select('kode_jurusan',$ju->kode_jurusan,($kelas->kode_jurusan == $ju->kode_jurusan)) : ''; ?>><?= $ju->kode_jurusan.' - '.$ju->nama_jurusan; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="item form-group">
							<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Kelas <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 ">
								<input id="" name="kelas" value="<?= isset($kelas) ? $kelas->kelas : '' ?>" required="required" class="form-control" type="text" name="middle-name">
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