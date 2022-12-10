<?php $this->load->view('layout/header') ?>

<div class="container mt-3 mb-3 align-items-center justify-content-center">
    <div class="row py-2 align-items-center justify-content-center">
        <div class="card px-2 py-1" style="width: 90%">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-3 mx-2">
                        <label class="row text-center">Kereta</label>
                    </div>
                    <div class="col-7 mx-2">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label class="row text-center">Berangkat</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label class="row text-center">Durasi</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label class="row text-center">Tiba</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 mx-2">
                        <label class="row text-center">Harga</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($schedule as $s) : ?>
        <div class="row py-2 align-items-center justify-content-center">
            <div class="card px-2 py-1" style="width: 90%">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-3 mx-2">
                            <label class="row font-weight-bold"><?= $s->name ?></label>
                            <label class="row"><?= $s->class ?></label>
                        </div>
                        <div class="col-7 mx-2">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <label class="row"><?= $s->station_from_name ?></label>
                                        <label class="row">
                                            <?php
                                            $date = $s->depart_time;
                                            $date = strtotime($date);
                                            echo date('H:i', $date);
                                            ?>
                                        </label>
                                        <label class="row">
                                            <?php
                                            $date = $s->depart_time;
                                            $date = strtotime($date);
                                            echo date('d F Y', $date);
                                            ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <?php
                                        $depart_time = $s->depart_time;
                                        $arrive_time = $s->arrive_time;
                                        $d1 = new DateTime($depart_time);
                                        $d2 = new DateTime($arrive_time);
                                        $interval = $d2->diff($d1);
                                        echo $interval->format('%hj %Im');
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <label class="row"><?= $s->station_to_name ?></label>
                                        <label class="row">
                                            <?php
                                            $date = $s->arrive_time;
                                            $date = strtotime($date);
                                            echo date('H:i', $date);
                                            ?>
                                        </label>
                                        <label class="row">
                                            <?php
                                            $date = $s->arrive_time;
                                            $date = strtotime($date);
                                            echo date('d F Y', $date);
                                            ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 mx-2">
                            <label class="row font-weight-bold">
                                <?php echo ("Rp " . number_format($s->price, 0, ",", ".")) ?>
                            </label>
                            <label class="row font-weight-bold">
                                <?php echo($s->remaining_seats == 0 ? 'Habis' : 'Tersedia') ?>
                            </label>
                            <div class="row">
                                <a class="px-3 py-2 my-2 btn btn-primary btn-block confirm-button <?php echo($s->remaining_seats == 0 ? 'disabled' : '') ?>" href="<?= base_url().'book?id='.$s->id ?>">PESAN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php $this->load->view('layout/footer') ?>