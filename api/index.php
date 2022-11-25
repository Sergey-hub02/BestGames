<?php

require_once __DIR__ . "/dao/OrderConsoleDAO.php";
require_once __DIR__ . "/dao/ConsoleDAO.php";
require_once __DIR__ . "/dao/ClientDAO.php";

require_once __DIR__ . "/../config/Database.php";

require_once __DIR__ . "/models/OrderConsole.php";
require_once __DIR__ . "/models/Console.php";
require_once __DIR__ . "/models/Client.php";

use Config\Database;

use Api\Dao\OrderConsoleDAO;
use Api\Dao\ConsoleDAO;
use Api\Dao\ClientDAO;

use Api\Models\OrderConsole;
use Api\Models\Console;
use Api\Models\Client;

$conn = (new Database())->getConnection();

$orderDao = new OrderConsoleDAO($conn);
$result = $orderDao->delete(7);
print_r($result);
