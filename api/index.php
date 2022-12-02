<?php

require_once __DIR__ . "/controllers/ClientController.php";
require_once __DIR__ . "/controllers/ConsoleController.php";
require_once __DIR__ . "/controllers/WiredGamepadController.php";
require_once __DIR__ . "/controllers/WirelessGamepadController.php";
require_once __DIR__ . "/controllers/OrderController.php";

use Api\Controllers\ClientController;
use Api\Controllers\ConsoleController;
use Api\Controllers\WiredGamepadController;
use Api\Controllers\WirelessGamepadController;
use Api\Controllers\OrderController;

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = explode("/", $uri);

// доступные группы конечных точек
$sections = [
  "clients",
  "console",
  "wiredgamepad",
  "wirelessgamepad",
  "orders",
];

$section = $uri[3];

if (isset($section) && !in_array($section, $sections) || !isset($uri[4])) {
  header("HTTP/1.1 404 Not Found");
  die();
}

$controller = null;

switch ($section) {
  case "clients":
    $controller = new ClientController();
    break;

  case "console":
    $controller = new ConsoleController();
    break;

  case "wiredgamepad":
    $controller = new WiredGamepadController();
    break;

  case "wirelessgamepad":
    $controller = new WirelessGamepadController();
    break;

  case "orders":
    $controller = new OrderController();
    break;

  default:
    break;
}

$methodName = $uri[4] . "Action";
$controller->{$methodName}();
