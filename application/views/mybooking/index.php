<?php $this->load->view('layout/header') ?>

<div class="container my-5 justify-content-center">
	<form id="form-payment" action="" method="POST">
		<div class="row justify-content-center">
			<div class="col-6 mx-4">
				<div class="py-2 mt-3 mb-3" style="text-align: right;">
					<button type="submit" class="btn btn-primary btn-block book-button">Pembayaran</button>
				</div>
			</div>
			<div class="col-4 mx-3">
				<div class="card card-body">
					<h3 class="px-2 py-2 text-center">Data Tiket</h3>
					<div class="row px-2 py-3">
						<div class="col">
							<div class="row">
							</div>
						</div>
						<div class="col justify-content-center mt-3">
							<div class="row"><i class="fa fa-arrow-circle-right"></i></div>
						</div>
						<div class="col">
							<div class="row">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function() {

	});
</script>

<?php $this->load->view('layout/footer') ?>