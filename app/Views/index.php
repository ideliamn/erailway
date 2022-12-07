<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-3 mb-3 justify-content-center d-flex">
	<div class="card px-2 py-2" style="width: 40rem;">
		<div class="card-body">
			<h3 class="py-3 d-flex text-center">PEMESANAN TIKET</h3>
			<form action="<?= base_url().'/schedule' ?>" method="POST">
				<?= csrf_field(); ?>
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
						<input class="form-control" type="date" name="depart_date" required/>
					</div>
				</div>
				<div class="flex-column text-center px-5 py-2 mt-3 mb-3">
					<button type="submit" class="btn btn-primary btn-block confirm-button">Cari Kereta</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?= $this->endSection() ?>