<?php $this->load->view('layout/header') ?>

<div class="container mt-3 mb-3 justify-content-center d-flex">
	<div class="card px-2 py-2" style="width: 40rem;">
		<div class="card-body">
			<h3 class="py-3 d-flex text-center">PENCARIAN TIKET</h3>
			<form action="<?= base_url().'schedule' ?>" method="POST">
				<div class="row">
					<div class="col">
						<label class="py-3">Stasiun Asal</label>
						<select class="form-control" name="station_from" required>
							<option selected disabled>Pilih Stasiun</option>
							<?php
								foreach($station as $st) {
									echo('<option value="'.$st->id.'">'.$st->name.'</option>');
								}
							?>
						</select>
					</div>
					<div class="col">
						<label class="py-3">Stasiun Tujuan</label>
						<select class="form-control" name="station_to" required>
							<option selected disabled>Pilih Stasiun</option>
							<?php
								foreach($station as $st) {
									echo('<option value="'.$st->id.'">'.$st->name.'</option>');
								}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="py-3">Tanggal Keberangkatan</label>
						<input class="form-control" type="date" name="depart_time" required/>
					</div>
				</div>
				<div class="flex-column text-center px-5 py-2 mt-3 mb-3">
					<button type="submit" class="btn btn-primary btn-block confirm-button">Cari Kereta</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('layout/footer') ?>