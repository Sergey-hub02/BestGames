<?php

namespace Api\Models;

require_once __DIR__ . "/Gamepad.php";
require_once __DIR__ . "/Client.php";

class OrderGamepad {
  private int $orderId;
  private ?Gamepad $gamepad;
  private ?Client $client;
  private int $amount;

  /**
   * @param Gamepad|null $gamepad       заказываемый геймпад
   * @param Client|null $client         заказчик
   * @param int $amount                 количество товара
   */
  public function __construct(
    int $orderId = 0,
    ?Gamepad $gamepad = null,
    ?Client $client = null,
    int $amount = 0
  ) {
    $this->orderId = $orderId;
    $this->gamepad = $gamepad;
    $this->client = $client;
    $this->amount = $amount;
  }

  /**
   * @return Gamepad|null
   */
  public function getGamepad(): ?Gamepad {
    return $this->gamepad;
  }

  /**
   * @param Gamepad $gamepad
   */
  public function setGamepad(Gamepad $gamepad): void{
    $this->gamepad = $gamepad;
  }

  /**
   * @return Client|null
   */
  public function getClient(): ?Client {
    return $this->client;
  }

  /**
   * @param Client $client
   */
  public function setClient(Client $client): void {
    $this->client = $client;
  }

  /**
   * @return int
   */
  public function getAmount(): int {
    return $this->amount;
  }

  /**
   * @param int $amount
   */
  public function setAmount(int $amount): void {
    $this->amount = $amount;
  }

  /**
   * @return int
   */
  public function getOrderId(): int {
    return $this->orderId;
  }

  /**
   * @param int $orderId
   */
  public function setOrderId(int $orderId): void {
    $this->orderId = $orderId;
  }
}
