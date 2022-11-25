<?php

require_once __DIR__ . "/dao/WiredGamepadDAO.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/models/WiredGamepad.php";

use Config\Database;
use Api\Dao\WiredGamepadDAO;
use Api\Models\WiredGamepad;

$dao = new WiredGamepadDAO((new Database())->getConnection());
$result = $dao->delete(6);
print_r($result);
