<?php

namespace Api\Controllers;

require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../../config/Database.php";

require_once __DIR__ . "/../models/Client.php";
require_once __DIR__ . "/../models/Address.php";

require_once __DIR__ . "/../dao/ClientDAO.php";

use Config\Database;
use Api\Models\Client;
use Api\Models\Address;
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
   * GET /api/clients/list?id=N: возвращает клиента с указанным ID
   * @return void
   */
  public function listAction(): void {
    $method = strtoupper($_SERVER["REQUEST_METHOD"]);
    $params = $this->getQueryStringParams();

    // для данных конечных точек можно применять только GET запросы
    if ($method !== "GET") {
      $this->sendOutput(
        json_encode([
          "error" => "Метод $method не поддерживается!",
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 422 Unprocessable Entity"]
      );
      return;
    }

    // нужен только один клиент
    if (!empty($params["id"])) {
      $client = $this->clientDAO->readOne($params["id"]);

      // клиент с заданным id не найден
      if ($client === null) {
        $this->sendOutput(
          json_encode([
            "error" => "Пользователь с id {$params['id']} не был найден!",
          ], JSON_UNESCAPED_UNICODE),
          ["Content-Type: application/json", "HTTP/1.1 400 Bad Request"]
        );
        return;
      }

      // клиент с заданным id найден
      $this->sendOutput(
        json_encode($client->toArray(), JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 200 OK"]
      );
      return;
    }

    // конвертируем все объекты в ассоциативные массивы
    $clients = array_map(function (Client $client) {
      return $client->toArray();
    }, $this->clientDAO->readAll());

    // конвертируем массивы в JSON-строки и отправляем ответ
    $this->sendOutput(
      json_encode($clients, JSON_UNESCAPED_UNICODE),
      ["Content-Type: application/json", "HTTP/1.1 200 OK"]
    );
  }

  /**
   * POST /api/clients/create: создаёт клиента и добавляет его в БД
   * @return void
   */
  public function createAction(): void {
    $method = strtoupper($_SERVER["REQUEST_METHOD"]);

    // для данной конечной точки применяется только метод POST
    if ($method !== "POST") {
      $this->sendOutput(
        json_encode([
          "error" => "Метод $method не поддерживается!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 422 Unprocessable Entity"]
      );
      return;
    }

    // получаем тело запроса
    $data = json_decode(
      file_get_contents("php://input"),
      true
    );

    // проверяем полноценность данных
    if (
      empty($data["first_name"])
      || empty($data["last_name"])
      || empty($data["email"])
      || empty($data["password"])
      || empty($data["region"])
      || empty($data["city"])
      || empty($data["street"])
      || empty($data["house"])
      || empty($data["flat"])
    ) {
      $this->sendOutput(
        json_encode([
          "error" => "Невозможно выполнить запрос! Неполные данные!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 400 Bad Request"]
      );
      return;
    }

    // все данные для создания записи присутствуют
    $client = new Client();

    $client->setFirstName($data["first_name"]);
    $client->setLastName($data["last_name"]);
    $client->setEmail($data["email"]);
    $client->setPassword(password_hash($data["password"], PASSWORD_DEFAULT));

    $client->setAddress(new Address(
      $data["region"],
      $data["city"],
      $data["street"],
      $data["house"],
      $data["flat"]
    ));

    $created = $this->clientDAO->create($client);

    // произошла ошибка при добавлении клиента
    if ($created === null) {
      $this->sendOutput(
        json_encode([
          "error" => "Ошибка добавления клиента!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 500 Internal Server Error"]
      );
      return;
    }

    // добавление клиента прошло успешно
    $this->sendOutput(
      json_encode($created->toArray(), JSON_UNESCAPED_UNICODE),
      ["Content-Type: application/json", "HTTP/1.1 201 Created"]
    );
  }

  /**
   * PUT /api/clients/update: обновляет данные клиента в БД
   * @return void
   */
  public function updateAction(): void {
    $method = strtoupper($_SERVER["REQUEST_METHOD"]);

    // для данной конечной точки можно применить только метод PUT
    if ($method !== "PUT") {
      $this->sendOutput(
        json_encode([
          "error" => "Ошибка обновления данных клиента!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 422 Unprocessable Entity"]
      );
      return;
    }

    // получаем тело запроса
    $data = json_decode(
      file_get_contents("php://input"),
      true
    );

    // проверка на полноценность данных
    if (
      empty($data["client_id"])
      || empty($data["first_name"])
      || empty($data["last_name"])
      || empty($data["email"])
      || empty($data["password"])
      || empty($data["region"])
      || empty($data["city"])
      || empty($data["street"])
      || empty($data["house"])
      || empty($data["flat"])
    ) {
      $this->sendOutput(
        json_encode([
          "error" => "Невозможно выполнить запрос! Неполные данные!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 400 Bad Request"]
      );
      return;
    }

    // все данные для обновления присутствуют
    $client = new Client(
      $data["client_id"],
      $data["first_name"],
      $data["last_name"],
      $data["email"],
      password_hash($data["password"], PASSWORD_DEFAULT),
      new Address(
        $data["region"],
        $data["city"],
        $data["street"],
        $data["house"],
        $data["flat"]
      )
    );

    $updated = $this->clientDAO->update($client);

    // произошла ошибка при обновлении данных клиента
    if ($updated === null) {
      $this->sendOutput(
        json_encode([
          "error" => "Ошибка обновления данных клиента!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 500 Internal Server Error"]
      );
      return;
    }

    // обновление данных клиента прошло успешно
    $this->sendOutput(
      json_encode($updated->toArray(), JSON_UNESCAPED_UNICODE),
      ["Content-Type: application/json", "HTTP/1.1 201 Created"]
    );
  }

  /**
   * DELETE /api/clients/delete: удаляет клиента из БД
   * @return void
   */
  public function deleteAction(): void {
    $method = strtoupper($_SERVER["REQUEST_METHOD"]);

    // для данной конечной точки можно применять только метод DELETE
    if ($method !== "DELETE") {
      $this->sendOutput(
        json_encode([
          "error" => "Метод $method не поддерживается!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 422 Unprocessable Entity"]
      );
      return;
    }

    $params = $this->getQueryStringParams();

    // id клиента обязательно должен быть задан
    if (empty($params["id"])) {
      $this->sendOutput(
        json_encode([
          "error" => "Невозможно удалить клиента! Не задан id клиента!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 400 Bad Request"]
      );
      return;
    }

    // ошибка при удалении клиента
    if (!$this->clientDAO->delete($params["id"])) {
      $this->sendOutput(
        json_encode([
          "error" => "Произошла ошибка при удалении клиента!"
        ], JSON_UNESCAPED_UNICODE),
        ["Content-Type: application/json", "HTTP/1.1 500 Internal Server Error"]
      );
      return;
    }

    // успешной удаление
    $this->sendOutput(
      json_encode([
        "message" => "Удаление клиента прошло успешно!"
      ], JSON_UNESCAPED_UNICODE),
      ["Content-Type: application/json", "HTTP/1.1 200 OK"]
    );
  }
}
