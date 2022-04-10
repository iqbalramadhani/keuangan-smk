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
						<?= form_open(base_url($module . '/save/'),array('class' => 'form-horizontal form-label-left')) ?>
						<div class="row">
							<div class="col-md-3">
								<img id="uploadPreview" src="<?= base_url('assets/img/default-user.png') ?>" class="mb-3" alt="profile" width="100%" height="70%">
								<input type="file" name="img-profile" id="uploadImage"  onchange="PreviewImage();" class="form-control">
							</div>
							<div class="col-md-6">
								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" value="<?= $profile->nama_lengkap; ?>" id="first-name" required="required" class="form-control ">
									</div>
								</div>
								
							</div>
						</div>

						<div class="ln_solid"></div>
						<div class="item form-group">
							<div class="col-md-6 col-sm-6 offset-md-3">
								<button class="btn btn-primary" type="button">Cancel</button>
								<button class="btn btn-primary" type="reset">Reset</button>
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>