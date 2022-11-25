<?php

namespace Api\Models;

class OrderGamepad {
  private Gamepad $gamepad;
  private Client $client;
  private int $amount;

  /**
   * @param Gamepad|null $gamepad       заказываемый геймпад
   * @param Client|null $client         заказчик
   * @param int $amount                 количество товара
   */
  public function __construct(
    Gamepad $gamepad = null,
    Client $client = null,
    int $amount = 0
  ) {
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
   * @param Gamepad|null $gamepad
   */
  public function setGamepad(?Gamepad $gamepad): void{
    $this->gamepad = $gamepad;
  }

  /**
   * @return Client|null
   */
  public function getClient(): ?Client {
    return $this->client;
  }

  /**
   * @param Client|null $client
   */
  public function setClient(?Client $client): void {
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
}
