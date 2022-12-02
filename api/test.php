<?php

require_once __DIR__ . "/dao/OrderDAO.php";
require_once __DIR__ . "/models/Order.php";
require_once __DIR__ . "/models/Console.php";
require_once __DIR__ . "/models/Gamepad.php";
require_once __DIR__ . "/models/Client.php";
require_once __DIR__ . "/models/OrderConsole.php";
require_once __DIR__ . "/models/OrderGamepad.php";
require_once __DIR__ . "/../config/Database.php";

use Api\Dao\OrderDAO;
use Api\Models\Order;
use Api\Models\Console;
use Api\Models\Gamepad;
use Api\Models\Client;
use Api\Models\OrderConsole;
use Api\Models\OrderGamepad;
use Config\Database;

$dao = new OrderDAO((new Database())->getConnection());
$result = $dao->delete(7);
print_r($result);
