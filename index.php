<?php
// Require composer autoloader
require 'vendor/autoload.php';
require 'actions.php';
require 'helpers.php';
require 'cors.php';

$rants = new Rants();

// Create Router instance
$router = new \Bramus\Router\Router();

// -- ROUTES -- //

$router->all('/', function () use ($rants) {
    $all = $rants->all();
    Helpers::sendResponse($all);
});

$router->get('/random', function () use ($rants) {
    $random = $rants->random();
    Helpers::sendResponse($random);
});

$router->get('/(\d+)', function ($id) use ($rants) {
    $one = $rants->one($id);
    if ($one) {
        Helpers::sendResponse($one);
    }
    else {
        Helpers::showError("Rant doesn't exist", 404);
    }
});

// Run router
$router->run();
