<?php $this->load->view('layout/header') ?>

<div class="container my-5 justify-content-center">
	<form id="form-book" action="<?= base_url() . 'book/store' ?>" method="POST">
		<input type="hidden" name="schedule_id" value="<?= $schedule->id ?>" id="schedule-id">
		<input type="hidden" name="book_amount" value="<?= $book_amount ?>" id="book-amount">
		<div class="row justify-content-center">
			<div class="col-6 mx-4">
				<?php for ($i = 1; $i <= $book_amount; $i++) : ?>
					<h3 class="px-2 py-3 mb-3">Data Penumpang <?= $i ?> </h3>
					<div class="card card-body">
						<div class="row py-2">
							<div class="col-4">
								<label class="">Nama</label>
							</div>
							<div class="col-6">
								<input type="text" name="name[<?= $i ?>]" class="form-control" placeholder="Nama Penumpang <?= $i ?>" required>
							</div>
						</div>
						<div class="row py-2">
							<div class="col-4">
								<label class="">NIK</label>
							</div>
							<div class="col-6">
								<input type="text" name="nik[<?= $i ?>]" class="form-control" placeholder="NIK Penumpang <?= $i ?>" required>
							</div>
						</div>
						<div class="row py-2">
							<div class="col-4">
								<label class="">Bangku</label>
							</div>
							<div class="col-6">
								<select name="seat[<?= $i ?>]" class="form-control seat[<?= $i ?>]" required>
									<?php foreach ($available_seats as $a) : ?>
										<option value="<?= $a->id ?>"><?= $a->seat_number ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
					</div>
				<?php endfor ?>
				<div class="py-2 mt-3 mb-3" style="text-align: right;">
					<button type="submit" class="btn btn-primary btn-block book-button">Pesan</button>
				</div>
			</div>
			<div class="col-4 mx-3">
				<div class="card card-body">
					<h3 class="px-2 py-2 text-center">Data Tiket</h3>
					<label class="row px-2">
						<?php
						$date = $schedule->depart_time;
						$date = strtotime($date);
						echo date('d F Y', $date);
						?>
					</label>
					<label class="row px-2"><?= $schedule->name ?></label>
					<label class="row px-2"><?= $schedule->class ?></label>
					<label class="row px-2"><?= $book_amount ?> Dewasa</label>
					<div class="row px-2 py-3">
						<div class="col">
							<div class="row">
								<label class="row"><?= $schedule->station_from_name ?></label>
								<label class="row">
									<?php
									$date = $schedule->depart_time;
									$date = strtotime($date);
									echo date('H:i', $date);
									?>
								</label>
								<label class="row">
									<?php
									$date = $schedule->depart_time;
									$date = strtotime($date);
									echo date('d F Y', $date);
									?>
								</label>
							</div>
						</div>
						<div class="col justify-content-center mt-3">
							<div class="row"><i class="fa fa-arrow-circle-right"></i></div>
						</div>
						<div class="col">
							<div class="row">
								<label class="row"><?= $schedule->station_to_name ?></label>
								<label class="row">
									<?php
									$date = $schedule->arrive_time;
									$date = strtotime($date);
									echo date('H:i', $date);
									?>
								</label>
								<label class="row">
									<?php
									$date = $schedule->arrive_time;
									$date = strtotime($date);
									echo date('d F Y', $date);
									?>
								</label>
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
		$(document).on('submit', '#form-book', function(e) {
			e.preventDefault()
			$.ajax({
				url: $('#form-book').attr('action'),
				type: 'POST',
				data: $('#form-book').serialize(),
				dataType: 'json',
				success: function(data) {
					if (data.status == true) {
						Swal.fire({
							title: data.message,
							icon: "success"
						}).then(function() {
							window.location = base_url + "payment";
						});
					} else {
						Swal.fire({
							title: data.message,
							icon: "error"
						});
					}
				},
				error: function(error) {
					Swal.fire({
						title: data.message,
						icon: "error"
					});
				}
			})
		});
	});
</script>

<?php $this->load->view('layout/footer') ?>