<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title  ?></title>
    <link rel="icon" type="image/png" href="<?= ($datasetting['logo_aplikasi'] == 'default.png' ? base_url('assets/img/setting/logo.jpg') : base_url('assets/img/setting/' . $datasetting['icon_aplikasi'])); ?>">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="<?= base_url('assets'); ?>/modules/fontawesome/css/all.min.css" rel="stylesheet" />
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.css">


    <!-- Template CSS -->
    <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet" />
    <link href="<?= base_url('assets'); ?>/css/components.css" />

</head>