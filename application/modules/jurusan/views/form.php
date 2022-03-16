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
						<button type="button" class="btn btn-primary btn-lg" id="back" onclick="window.location.href = '<?= base_url($module); ?>'">Kembali</button>
						<?= form_open(base_url($module.'/save'),array('class'=>'form-horizontal form-label-left')) ?>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="">Nama Jurusan <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" name="nama_jurusan" id="" required="required" class="form-control ">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="">Kode Jurusan <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" name="kode_jurusan" id="" required="required" class="form-control ">
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-6 col-sm-6 offset-md-3">
=									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Kirim</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('dashboard/js.php');
?>