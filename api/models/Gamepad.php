<?php

namespace Api\Models;

class Gamepad {
  private int $gamepadId;
  private string $name;
  private string $brand;
  private int $buttons;
  private float $price;

  /**
   * @param int $gamepadId      ID геймпада
   * @param string $name        название геймпада
   * @param string $brand       компания, выпустившая геймпад
   * @param int $buttons        количество кнопок
   * @param float $price        цена геймпада
   */
  public function __construct(
    int $gamepadId = 0,
    string $name = "",
    string $brand = "",
    int $buttons = 0,
    float $price = 0.0
  ) {
    $this->gamepadId = $gamepadId;
    $this->name = $name;
    $this->brand = $brand;
    $this->buttons = $buttons;
    $this->price = $price;
  }

  /**
   * @return int
   */
  public function getGamepadId(): int {
    return $this->gamepadId;
  }

  /**
   * @param int $gamepadId
   */
  public function setGamepadId(int $gamepadId): void {
    $this->gamepadId = $gamepadId;
  }

  /**
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName(string $name): void {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getBrand(): string {
    return $this->brand;
  }

  /**
   * @param string $brand
   */
  public function setBrand(string $brand): void {
    $this->brand = $brand;
  }

  /**
   * @return int
   */
  public function getButtons(): int {
    return $this->buttons;
  }

  /**
   * @param int $buttons
   */
  public function setButtons(int $buttons): void {
    $this->buttons = $buttons;
  }

  /**
   * @return float
   */
  public function getPrice(): float {
    return $this->price;
  }

  /**
   * @param float $price
   */
  public function setPrice(float $price): void {
    $this->price = $price;
  }

  /**
   * Возвращает поля объекта в виде ассоциативного массива
   * @return array
   */
  public function toArray(): array {
    return [
      "gamepad_id" => $this->getGamepadId(),
      "name" => $this->getName(),
      "brand" => $this->getBrand(),
      "buttons" => $this->getButtons(),
      "price" => $this->getPrice()
    ];
  }
}
