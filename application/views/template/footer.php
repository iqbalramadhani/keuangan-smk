	<!-- footer content -->
	<footer>
		<div class="pull-right">
			Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
		</div>
		<div class="clearfix"></div>
	</footer>
	<!-- /footer content -->
	</div>
	</div>

	<!-- Bootstrap -->
	<script src="<?= base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="<?= base_url() ?>assets/vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="<?= base_url() ?>assets/vendors/nprogress/nprogress.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="<?= base_url() ?>assets/build/js/custom.min.js"></script>

	<?php
	if (isset($js)) {
		foreach ($js as $jss) {
	?>
	<?php
		}
	}
	?>


	<script>
		let current_location = window.location.href
	</script>
	</body>

	</html>