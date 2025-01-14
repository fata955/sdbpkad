<?php
// session_start();
// if (!empty($_SESSION['username']) && !empty($_SESSION['nama'])) {
//     include 'route.php';
// }else {
    // include 'routelogin.php';equire '../route.php';
//     echo "anda perlu Login";
//     header('Location: /sdbpkad/login');
//     exit;
// } 
session_start(); 
include '../lib/conn.php';
if (!isset($_SESSION['username'])) { header('Location: /sdbpkad/login'); 
    exit(); }

