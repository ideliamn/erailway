<?php $this->load->view('layout/header') ?>

<div class="container mt-3 mb-3 align-items-center justify-content-center">
    <?php foreach ($mybooking as $m) : ?>
        <div class="row py-2 align-items-center justify-content-center">
            <div class="card px-2 py-1" style="width: 90%">
                <div class="card-body">
                    <div class="row">
						<span>Tanggal Pemesanan: <?php echo date('d F Y H:i:s', strtotime($m->booking_time)); ?></span>
						<br><br>
                        <h5><b><?= $m->train_name ?></b></h5>
						<span><?= $m->class ?></span>
                    </div>
					<div class="row px-2 py-3">
						<div class="col">
							<div class="row">
								<b><label class="row"><?= $m->station_from ?></label></b>
								<label class="row">
									<?php echo date('d F Y', strtotime($m->depart_time)); ?>
									<?php echo date('H:i', strtotime($m->depart_time)); ?>
								</label>
							</div>
						</div>
						<div class="col justify-content-center mt-3">
							<div class="row"><i class="fa fa-arrow-circle-right"></i></div>
						</div>
						<div class="col">
							<div class="row">
								<b><label class="row"><?= $m->station_to ?></label></b>
								<label class="row">
									<?php echo date('d F Y', strtotime($m->arrive_time)); ?>
									<?php echo date('H:i', strtotime($m->arrive_time)); ?>
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<span>Jumlah tiket dipesan: <?= $m->ticket_count ?></span>
					</div>
                </div>
				<div class="py-2 px-2" style="text-align: right;">
					<a class="btn btn-primary btn-block " href="<?= base_url().'mybooking/detail?id='.$m->id ?>">Lihat Detail</a>
				</div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {

	});
</script>

<?php $this->load->view('layout/footer') ?>