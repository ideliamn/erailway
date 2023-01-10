<?php $this->load->view('layout/header') ?>

<div class="container mt-3 mb-3 align-items-center justify-content-center">
	<div class="row py-2 align-items-center justify-content-center">
		<div class="card px-2 py-1" style="width: 90%">
			<div class="card-body">
				<div class="row py-2 px-2">
					<div class="col">
						<h5 class="pb-2">Pemesanan</h5>
						<table class="table table-borderless">
							<tr>
								<td>Nama Pemesan</td>
								<td>: <?= $mybooking[0]->user_name ?></td>
							</tr>
							<tr>
								<td>Nomor Telepon</td>
								<td>: <?= $mybooking[0]->phone ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>: <?= $mybooking[0]->email ?></td>
							</tr>
							<tr>
								<td>Tanggal Pemesanan</td>
								<td>: <?php echo date('d F Y H:i:s', strtotime($mybooking[0]->booking_time)); ?></td>
							</tr>
						</table>
					</div>
					<div class="col"></div>
				</div>
				<div class="row py-2 px-2">
					<h5 class="pb-2">Detail Pemesanan</h5>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col" style="text-align: center;">NAMA KA</th>
								<th scope="col" style="text-align: center;">KELAS KA</th>
								<th scope="col" style="text-align: center;">KEBERANGKATAN</th>
								<th scope="col" style="text-align: center;">TUJUAN</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($mybooking as $m) : ?>
								<tr>
									<td><?= $m->train_name ?></td>
									<td><?= $m->class ?></td>
									<td>
										<?= $m->station_from ?> 
										<?php echo date('d F Y H:i', strtotime($m->depart_time)); ?>
									</td>
									<td>
										<?= $m->station_to ?> 
										<?php echo date('d F Y H:i', strtotime($m->arrive_time)); ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="row py-2 px-2">
					<h5 class="pb-2">Detail Penumpang</h5>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col" style="text-align: center;">NAMA PENUMPANG</th>
								<th scope="col" style="text-align: center;">KURSI</th>
								<th scope="col" style="text-align: center;">NOMOR IDENTITAS</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($mybooking as $m) : ?>
								<tr>
									<td><?= $m->passenger_name ?></td>
									<td><?= $m->seat_number ?></td>
									<td><?= $m->nik ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

	});
</script>

<?php $this->load->view('layout/footer') ?>