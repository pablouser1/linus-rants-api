<?php
use App\Db;
use App\Helpers;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/cors.php';

$db = new Db;

// Create Router instance
$router = new \Bramus\Router\Router();

// -- ROUTES -- //

$router->all('/', function () use ($db) {
    $sort = isset($_GET["sort"]) ? trim($_GET["sort"]) : '';
    $all = $db->all($sort);
    Helpers::sendResponse($all);
});

$router->get('/random', function () use ($db) {
    $random = $db->random();
    Helpers::sendResponse($random);
});

$router->get('/(\d+)', function (int $id) use ($db) {
    $one = $db->one($id);
    if ($one) {
        Helpers::sendResponse($one);
    } else {
        Helpers::showError("Rant doesn't exist", 404);
    }
});

// Run router
$router->run();
