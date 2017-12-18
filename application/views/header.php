<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Paul Sabando">
    <title>MyBici</title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/estilos.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/sb-admin.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/morris.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/font-awesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/datepicker.css">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/icons/ico_bicicleta.jpg"/>

    <script src="<?= base_url() ?>/js/jquery.js"></script>
    <script src="<?= base_url() ?>/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>/js/raphael.min.js"></script>
    <script src="<?= base_url() ?>/js/morris.js"></script>
    <script src="<?= base_url() ?>/js/jQuery-MD5.js"></script>
    <script src="<?= base_url() ?>/js/bootstrap-datepicker.js"></script>
    <?php foreach ($helpers as $helper) { ?>
        <script type="text/javascript" src="<?= $helper ?>"></script>
    <?php } ?>
    <?php if (Escritorio::verificarInternet()) { ?>
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD9_tmNFbXbnoF5ONOj7DWRYJlYk30zvt8"></script>
        
    <?php } ?>
</head>
<body>
<?='<script> var base_url = \'http://'.$_SERVER['HTTP_HOST'].'/web/MyBici_server/\'; </script>';?>