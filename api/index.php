<?php

require_once __DIR__ . "/dao/OrderGamepadDAO.php";
require_once __DIR__ . "/dao/WiredGamepadDAO.php";
require_once __DIR__ . "/dao/WirelessGamepadDAO.php";
require_once __DIR__ . "/dao/ClientDAO.php";

require_once __DIR__ . "/../config/Database.php";

require_once __DIR__ . "/models/OrderGamepad.php";
require_once __DIR__ . "/models/Gamepad.php";
require_once __DIR__ . "/models/WiredGamepad.php";
require_once __DIR__ . "/models/WirelessGamepad.php";
require_once __DIR__ . "/models/Client.php";

use Config\Database;

use Api\Dao\OrderGamepadDAO;
use Api\Dao\WiredGamepadDAO;
use Api\Dao\WirelessGamepadDAO;
use Api\Dao\ClientDAO;

use Api\Models\OrderGamepad;
use Api\Models\Gamepad;
use Api\Models\WiredGamepad;
use Api\Models\WirelessGamepad;
use Api\Models\Client;

$conn = (new Database())->getConnection();

$orderDao = new OrderGamepadDAO($conn);
$wiredDao = new WiredGamepadDAO($conn);
$wirelessDao = new WirelessGamepadDAO($conn);
$clientDao = new ClientDAO($conn);

$gamepad = $wirelessDao->readOne(3);
$client = $clientDao->readOne(5);

$order = new OrderGamepad();

$order->setOrderId(6);
$order->setGamepad($gamepad);
$order->setClient($client);
$order->setAmount(1);

$result = $orderDao->delete(6);
print_r($result);
