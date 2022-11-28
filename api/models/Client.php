<?php

namespace Api\Models;

require_once __DIR__ . "/Address.php";

use Api\Models;

class Client {
  private int $clientId;
  private string $firstName;
  private string $lastName;
  private string $email;
  private Address|null $address;

  /**
   * @param int $clientId                   ID клиента
   * @param string $firstName               имя клиента
   * @param string $lastName                фамилия клиента
   * @param string $email                   email клиента
   * @param Address|null $address           адрес клиента
   */
  public function __construct(
    int $clientId = 0,
    string $firstName = "",
    string $lastName = "",
    string $email = "",
    Address|null $address = null
  ) {
    $this->clientId = $clientId;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->address = $address;
  }

  /**
   * @return int
   */
  public function getClientId(): int {
    return $this->clientId;
  }

  /**
   * @param int $clientId
   */
  public function setClientId(int $clientId): void {
    $this->clientId = $clientId;
  }

  /**
   * @return string
   */
  public function getFirstName(): string {
    return $this->firstName;
  }

  /**
   * @param string $firstName
   */
  public function setFirstName(string $firstName): void {
    $this->firstName = $firstName;
  }

  /**
   * @return string
   */
  public function getLastName(): string {
    return $this->lastName;
  }

  /**
   * @param string $lastName
   */
  public function setLastName(string $lastName): void {
    $this->lastName = $lastName;
  }

  /**
   * @return string
   */
  public function getEmail(): string {
    return $this->email;
  }

  /**
   * @param string $email
   */
  public function setEmail(string $email): void {
    $this->email = $email;
  }

  /**
   * @return Address|null
   */
  public function getAddress(): ?Address {
    return $this->address;
  }

  /**
   * @param Address|null $address
   */
  public function setAddress(?Address $address): void {
    $this->address = $address;
  }

  public function toArray(): array {
    return [
      "client_id" => $this->getClientId(),
      "first_name" => $this->getFirstName(),
      "last_name" => $this->getLastName(),
      "email" => $this->getEmail(),
      "address" => $this->getAddress()->toArray()
    ];
  }
}
