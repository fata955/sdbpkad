<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<title>Aplikasi Sumber Dana dan Verifikasi Penatausahaan</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="assets/plugins/charts-c3/plugin.css"/>
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.min.css" />
<!-- Font Awesome  -->
<link rel="stylesheet" href="assets/Font-Awesome/css/all.min.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
<!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
<link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
<link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<link rel="stylesheet" href="assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
</head>

<body class="theme-blush">

<?php 
    include 'component/loader.php';
?>

<?php 
    include 'component/overlay.php';
?>
<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
      <input type="search" value="" placeholder="Search..." />
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<?php 
    // include 'component/sidebaricon.php';
?>
<?php 
    include 'component/leftsidebar.php';
?>
<?php 
    include 'component/sidebarright.php';
?>



