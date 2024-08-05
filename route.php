<?php
    // Define your location project directory in htdocs (EX THE FULL PATH: D:\xampp\htdocs\x-kang\simple-routing-with-php)
    include 'lib/conn.php';
    $project_location = "/budget";
    $me = $project_location;

    // For get URL PATH
    $request = $_SERVER['REQUEST_URI'];

    switch ($request) {
        case $me.'/' :
            require "views/dashboard.view.php";
            break;
        case $me.'/login' :
            require "views/login.view.php";
            break;
        case $me.'/opd' :
            require "views/opd.view.php";
            break;
        case $me.'/sumberdana' :
            require "views/sumberdana.view.php";
            break;
        case $me.'/views' :
            require "views/error.view.php";
            break;
        default:
            http_response_code(404);
            require "views/error.view.php";
            break;
    }