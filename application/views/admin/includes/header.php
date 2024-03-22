<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SafeCity Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/fontawesome.min.css">
    <!-- Bootstrap plugin -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap/bootstrap.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />

    <!-- datatable Plugin -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/datatable/jquery.dataTables.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/fonts/static/fonts.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/tempusdominus-bootstrap-4.min.css">
    <!-- Bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/admin.css">


	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>
</head>

<!-- <body style="height: auto; overflow: scroll"> -->
<body>
    <div class="container-fluid px-0 h-100">
        <div class="admin-main">
            <!-- Leftbar placeholder -->
            <?php $this->load->view('admin/includes/sidebar'); ?>

            <div class="admin-rightbar">
            <!-- Site Main Content Goes here -->