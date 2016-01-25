<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Paul Sabando">
    <title>MyBici</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/estilos.css">
    <link rel="stylesheet" href="/css/sb-admin.css">
    <link rel="stylesheet" href="/css/morris.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/datepicker.css">
    <link rel="icon" type="image/png" href="/icons/ico_bicicleta.jpg"/>

    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/raphael.min.js"></script>
    <script src="/js/morris.js"></script>
    <script src="/js/jQuery-MD5.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <?php foreach ($helpers as $helper) { ?>
        <script type="text/javascript" src="<?= $helper ?>"></script>
    <?php } ?>
    <?php if (Escritorio::verificarInternet()) { ?>
        <script src="http://maps.googleapis.com/maps/api/js"></script>
    <?php } ?>
</head>
<body>
<?='<script> var base_url = \'http://'.$_SERVER['HTTP_HOST'].'/\'; </script>';?>