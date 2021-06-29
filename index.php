<?php
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';
require 'actions.php';
require 'helpers.php';

$rants = new Rants();

// Create Router instance
$router = new \Bramus\Router\Router();

// -- ROUTES -- //

$router->all('/', function () use ($rants) {
    $all = $rants->all();
    Helpers::showAll($all);
});

$router->get('/random', function () use ($rants) {
    $random = $rants->random();
    Helpers::showOne($random);
});

$router->get('/(\d+)', function ($id) use ($rants) {
    $one = $rants->one($id);
    if ($one) {
        Helpers::showOne($one);
    }
    else {
        Helpers::showError("Rant doesn't exist", 404);
    }
});

// Run router
$router->run();
