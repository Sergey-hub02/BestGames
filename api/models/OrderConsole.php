<?php

namespace Api\Models;

class OrderConsole {
  private Console $console;
  private Client $client;
  private int $amount;

  /**
   * @param Console|null $console       заказываемая консоль
   * @param Client|null $client         заказчик
   * @param int $amount                 количество товара
   */
  public function __construct(
    Console $console = null,
    Client $client = null,
    int $amount = 0
  ) {
    $this->console = $console;
    $this->client = $client;
    $this->amount = $amount;
  }

  /**
   * @return Console|null
   */
  public function getConsole(): ?Console {
    return $this->console;
  }

  /**
   * @param Console|null $console
   */
  public function setConsole(?Console $console): void {
    $this->console = $console;
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
