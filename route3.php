
<?php
// Start session
session_start();

// Include necessary files
include 'lib/conn.php'; // Database configuration
// include 'functions.php'; // Common functions

// Get the requested path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/sdbpkad');
$path = explode('/sdbpkad', $path);
// $path = $path;
// Route the request
switch ($path[0]) {

    case '':
        if (isset($_SESSION['user'])) {
            include 'views/dashboard.view.php';
        } else {
            header('Location: /sdbpkad/login');
        }
        break;
    case '/skpd':
        if (isset($_SESSION['user'])) {
            include 'views/master/opd.view.php';
        } else {
            header('Location: /sdbpkad/register');
        }
        break;

    case '/sumberdana':
        if (isset($_SESSION['user'])) {
            include 'views/master/subsumberdana.view.php';
        } else {
            header('Location: /sdbpkad/login');
        }
        break;

    case '/bagsumberdana':
        if (isset($_SESSION['user'])) {
            include 'views/master/subsumberdana.view.php';
        } else {
            header('Location: /sdbpkad/login');
        }
        break;

    case 'register':
        // Login page
        include 'register.view.php';
        break;
    case 'login':
        // Home page
        include 'views/login.view.php';
        break;


    default:
        // 404 page
        include 'views/error.view.php';
        break;
}
?>
