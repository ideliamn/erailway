<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?= $this->security->get_csrf_hash() ?>" name="<?= $this->security->get_csrf_token_name() ?>">
	<meta content="<?=base_url()?>" name="base_url">
	<title>E-Railway</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>" />
</head>

<body style="margin-bottom: 10rem !important">

    <?php $this->load->view('layout/navbar') ?>

	<!-- Jquery and Bootsrap JS -->
	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
