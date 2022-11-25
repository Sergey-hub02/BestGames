<?php

require_once __DIR__ . "/dao/WirelessGamepadDAO.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/models/WirelessGamepad.php";

use Config\Database;
use Api\Dao\WirelessGamepadDAO;
use Api\Models\WirelessGamepad;

$dao = new WirelessGamepadDAO((new Database())->getConnection());
$result = $dao->delete(7);
print_r($result);
