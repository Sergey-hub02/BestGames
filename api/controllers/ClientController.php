<?php

namespace Api\Controllers;

require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../models/Client.php";
require_once __DIR__ . "/../dao/ClientDAO.php";

use Config\Database;
use Api\Models\Client;
use Api\Dao\ClientDAO;

class ClientController extends Controller {
  private ClientDAO $clientDAO;

  /**
   * Создаёт контроллер для работы с конечными точками /api/clients
   */
  public function __construct() {
    $this->clientDAO = new ClientDAO((new Database())->getConnection());
  }

  /**
   * GET /api/clients/list: возвращает список клиентов
   * @return void
   */
  public function listAction(): void {
    $method = $_SERVER["REQUEST_METHOD"];
    $params = $this->getQueryStringParams();

    if (strtoupper($method) !== "GET") {
      $this->sendOutput(
        json_encode([
          "error" => "Метод $method не поддерживается!",
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 422 Unprocessable Entity"]
      );
      return;
    }

    if (!empty($params["id"])) {
      $client = $this->clientDAO->readOne($params["id"]);

      if ($client === null) {
        $this->sendOutput(
          json_encode([
            "error" => "Пользователь с id {$params['id']} не был найден!",
          ], JSON_UNESCAPED_UNICODE),
          ["Content-Type: application/json", "HTTP/1.1 400 Bad Request"]
        );
        return;
      }

      $this->sendOutput(
        json_encode($client->toArray(), JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 200 OK"]
      );
      return;
    }

    $clients = array_map(function (Client $client) {
      return $client->toArray();
    }, $this->clientDAO->readAll());

    $this->sendOutput(
      json_encode($clients, JSON_UNESCAPED_UNICODE),
      ["Content-Type: application/json", "HTTP/1.1 200 OK"]
    );
  }
}
