<?php
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';
require 'actions.php';
require 'helpers.php';

// CORS //
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
if($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
	exit;
}

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
