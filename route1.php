<?php
 // Database configuration
$routes = [];

route('/', function () {
    require 'views/dashboard.view.php';
});

route('/login', function () {
  require "views/login.view.php";
});

route('/about-us', function () {
  echo "About Us";
});

route('/404', function () {
    http_response_code(404);
    require "views/error.view.php";
});

function route(string $path, callable $callback) {
  global $routes;
  $routes[$path] = $callback;
}

if (isset($_SESSION['user'])) {
  run();
}else{
  require "views/login.view.php";
}

function run() {
  global $routes;
  
  $uri = $_SERVER['REQUEST_URI'];
  $found = false;
  foreach ($routes as $path => $callback) {
    if ($path !== $uri) continue;

    $found = true;
    $callback();
  }

  if (!$found) {
    $notFoundCallback = $routes['/404'];
    $notFoundCallback();
  }
}