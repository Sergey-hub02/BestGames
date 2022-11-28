<?php

require_once __DIR__ . "/controllers/ClientController.php";

use Api\Controllers\ClientController;

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = explode("/", $uri);

if (isset($uri[3]) && $uri[3] !== "clients" || !isset($uri[4])) {
  header("HTTP/1.1 404 Not Found");
  die();
}

$controller = new ClientController();
$methodName = $uri[4] . "Action";
$controller->{$methodName}();
