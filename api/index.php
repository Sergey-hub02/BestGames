<?php

require_once __DIR__ . "/dao/ConsoleDAO.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/models/Console.php";

use Config\Database;
use Api\Dao\ConsoleDAO;
use Api\Models\Console;

$dao = new ConsoleDAO((new Database())->getConnection());

$result = $dao->delete(6);

print_r($result);
