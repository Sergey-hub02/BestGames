<?php

require_once __DIR__ . "/dao/ClientDAO.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/models/Client.php";
require_once __DIR__ . "/models/Address.php";

use Config\Database;
use Api\Dao\ClientDAO;
use Api\Models\Client;
use Api\Models\Address;

$dao = new ClientDAO((new Database())->getConnection());
$result = $dao->delete(8);

print_r($result);
