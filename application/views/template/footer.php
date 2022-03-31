	<!-- footer content -->
	<footer>
		<div class="pull-right">
			<p>©2022 SMKN 2 PEMATANG SIANTAR</p>
		</div>
		<div class="clearfix"></div>
	</footer>
	<!-- /footer content -->
	</div>
	</div>

	<!-- Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/0.6.0/fastclick.js"></script>
	<!-- NProgress -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="<?= base_url() ?>assets/build/js/custom.min.js"></script>
	<script src="<?= base_url() ?>assets/src/js/herper.js"></script>


	<script>
		let current_location = window.location.href

		setTimeout(function() {
			$('.alert').alert('close');
		}, 10000);

		$(document).ready(function() {
			$('#myTable').DataTable();

    		$('.select2').select2();

		});
	</script>
	</body>

	</html>