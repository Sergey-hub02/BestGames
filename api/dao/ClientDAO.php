<?php

namespace Api\Dao;

require_once __DIR__ . "/../models/Client.php";
require_once __DIR__ . "/../models/Address.php";

use PDO;
use Api\Models\Client;
use Api\Models\Address;

class ClientDAO {
  private PDO $connection;

  /**
   * Проверяет, существует ли клиент с указанным ID
   * @param int $clientId
   * @return bool
   */
  private function exists(int $clientId): bool {
    $query = "SELECT * FROM `Client` WHERE `client_id` = ?";
    $stmt = $this->connection->prepare($query);

    if (!$stmt->execute([$clientId])) {
      return false;
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return count($result) > 0;
  }

  /**
   * @param PDO $connection       подключение к БД
   */
  public function __construct(PDO $connection) {
    $this->connection = $connection;
  }

  /**
   * Создаёт объект клиента и добавляет его в БД
   * @param Client $client
   * @return Client|null
   */
  public function create(Client $client): Client|null {
    $this->connection->beginTransaction();

    $query = "
      INSERT INTO `Client`(
        `first_name`,
        `last_name`,
        `email`,
        `password`
      )
      VALUES
        (?, ?, ?, ?)
    ";

    $stmt = $this->connection->prepare($query);

    if (!$stmt->execute([
      $client->getFirstName(),
      $client->getLastName(),
      $client->getEmail(),
      $client->getPassword()
    ])) {
      $this->connection->rollBack();
      return null;
    }

    $client->setClientId($this->connection->lastInsertId());

    $query = "
      INSERT INTO `Address`(
        `client_id`,
        `region`,
        `city`,
        `street`,
        `house`,
        `flat`
      )
      VALUES
        (?, ?, ?, ?, ?, ?)
    ";
    $stmt = $this->connection->prepare($query);

    if (!$stmt->execute([
      $client->getClientId(),
      $client->getAddress()->getRegion(),
      $client->getAddress()->getCity(),
      $client->getAddress()->getStreet(),
      $client->getAddress()->getHouse(),
      $client->getAddress()->getFlat()
    ])) {
      $this->connection->rollBack();
      return null;
    }

    $this->connection->commit();
    return $client;
  }

  /**
   * Возвращает список пользователей
   * @return array
   */
  public function readAll(): array {
    $query = "
    SELECT
      `Client`.`client_id` AS `id`,
      `Client`.`first_name`,
      `Client`.`last_name`,
      `Client`.`email`,
      `Address`.`region` AS `region`,
      `Address`.`city` AS `city`,
      `Address`.`street` AS `street`,
      `Address`.`house` AS `house`,
      `Address`.`flat` AS `flat`
    FROM `Client`
    JOIN `Address`
      ON `Client`.`client_id` = `Address`.`client_id`";

    $stmt = $this->connection->query($query);

    if (!$stmt) {
      return [];
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $clients = [];

    foreach ($result as $row) {
      $clients[] = new Client(
        $row["id"],
        $row["first_name"],
        $row["last_name"],
        $row["email"],
        "",
        new Address(
          $row["region"],
          $row["city"],
          $row["street"],
          $row["house"],
          $row["flat"]
        )
      );
    }

    return $clients;
  }

  /**
   * Возвращает объект клиента с заданным ID
   * @param int $clientId       ID клиента
   * @return Client|null
   */
  public function readOne(int $clientId): Client|null {
    if (!$this->exists($clientId)) {
      return null;
    }

    $query = "
      SELECT
        `Client`.`client_id` AS `id`,
        `Client`.`first_name`,
        `Client`.`last_name`,
        `Client`.`email`,
        `Address`.`region` AS `region`,
        `Address`.`city` AS `city`,
        `Address`.`street` AS `street`,
        `Address`.`house` AS `house`,
        `Address`.`flat` AS `flat`
      FROM `Client`
      JOIN `Address`
        ON `Client`.`client_id` = `Address`.`client_id`
      WHERE `Client`.`client_id` = ?";

    $stmt = $this->connection->prepare($query);

    if (!$stmt->execute([$clientId])) {
      return null;
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

    return new Client(
      $result["id"],
      $result["first_name"],
      $result["last_name"],
      $result["email"],
      "",
      new Address(
        $result["region"],
        $result["city"],
        $result["street"],
        $result["house"],
        $result["flat"]
      )
    );
  }

  /**
   * Обновляет данные клиента в БД
   * @param Client $client
   * @return Client|null
   */
  public function update(Client $client): Client|null {
    if (!$this->exists($client->getClientId())) {
      return null;
    }

    $this->connection->beginTransaction();

    $query = "
      UPDATE
        `Client`
      SET
        `first_name` = ?,
        `last_name` = ?,
        `email` = ?,
        `password` = ?
      WHERE `client_id` = ?
    ";

    $stmt = $this->connection->prepare($query);

    if (!$stmt->execute([
      $client->getFirstName(),
      $client->getLastName(),
      $client->getEmail(),
      $client->getPassword(),
      $client->getClientId()
    ])) {
      $this->connection->rollBack();
      return null;
    }

    $query = "
      UPDATE
        `Address`
      SET
        `region` = ?,
        `city` = ?,
        `street` = ?,
        `house` = ?,
        `flat` = ?
      WHERE `client_id` = ?
    ";

    $stmt = $this->connection->prepare($query);

    if (!$stmt->execute([
      $client->getAddress()->getRegion(),
      $client->getAddress()->getCity(),
      $client->getAddress()->getStreet(),
      $client->getAddress()->getHouse(),
      $client->getAddress()->getFlat(),
      $client->getClientId()
    ])) {
      $this->connection->rollBack();
      return null;
    }

    $this->connection->commit();
    return $client;
  }

  /**
   * Удаляет данные клиента из БД
   * @param int $clientId
   * @return bool
   */
  public function delete(int $clientId): bool {
    if (!$this->exists($clientId)) {
      return false;
    }

    $this->connection->beginTransaction();

    $query = "DELETE FROM `Address` WHERE `client_id` = ?";
    $stmt = $this->connection->prepare($query);

    if (!$stmt->execute([$clientId])) {
      $this->connection->rollBack();
      return false;
    }

    $query = "DELETE FROM `Client` WHERE `client_id` = ?";
    $stmt = $this->connection->prepare($query);

    if (!$stmt->execute([$clientId])) {
      $this->connection->rollBack();
      return false;
    }

    $this->connection->commit();
    return true;
  }
}
