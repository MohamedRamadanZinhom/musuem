<?php

require_once 'Router.php';

// Instantiate the router
$router = new Router();

// Add routes

$router->addRoute('/souviner', function () {
    include '../../Login.php';
});


$router->addRoute('/', function () {
    include 'Views/index.php';
});


// Add more routes as needed

// Get the requested route from the URL
// Get the requested route from the URL
$requestPath = '/' . trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');


// Handle the request
$router->handleRequest($requestPath);

?>
