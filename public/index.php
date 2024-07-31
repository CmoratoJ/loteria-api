<?php
header('Content-Type: application/json');

use app\controllers\TicketController;
use app\router\Router;

require '../vendor/autoload.php';

$router = new Router();
$controller = new TicketController();

$router->add('/generate', function() use ($controller) {
    $quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 0;
    $numDezenas = isset($_GET['num_dezenas']) ? (int)$_GET['num_dezenas'] : 0;
    return $controller->generate($quantity, $numDezenas);
});

$router->add('/compare', function() use ($controller) {
    $quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 0;
    $numDezenas = isset($_GET['num_dezenas']) ? (int)$_GET['num_dezenas'] : 0;
    header('Content-Type: text/html');
    return $controller->compareWithWinningTicket($quantity, $numDezenas);
});

$requestedRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($requestedRoute);