<?php

namespace Api\Models;

class Console {
  private int $consoleId;
  private string $name;
  private string $brand;
  private string $gpu;
  private string $cpu;
  private int $ram;
  private float $price;

  /**
   * @param int $consoleId        ID консоли
   * @param string $name          название консоли
   * @param string $brand         компания, выпустившая консоль
   * @param string $gpu           название видеокарты
   * @param string $cpu           название процессора
   * @param int $ram              объём оперативной памяти
   * @param float $price          цена консоли
   */
  public function __construct(
    int $consoleId = 0,
    string $name = "",
    string $brand = "",
    string $gpu = "",
    string $cpu = "",
    int $ram = 0,
    float $price = 0.0
  ) {
    $this->consoleId = $consoleId;
    $this->name = $name;
    $this->brand = $brand;
    $this->gpu = $gpu;
    $this->cpu = $cpu;
    $this->ram = $ram;
    $this->price = $price;
  }

  /**
   * @return int
   */
  public function getConsoleId(): int {
    return $this->consoleId;
  }

  /**
   * @param int $consoleId
   */
  public function setConsoleId(int $consoleId): void {
    $this->consoleId = $consoleId;
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
   * @return string
   */
  public function getGpu(): string {
    return $this->gpu;
  }

  /**
   * @param string $gpu
   */
  public function setGpu(string $gpu): void {
    $this->gpu = $gpu;
  }

  /**
   * @return string
   */
  public function getCpu(): string {
    return $this->cpu;
  }

  /**
   * @param string $cpu
   */
  public function setCpu(string $cpu): void {
    $this->cpu = $cpu;
  }

  /**
   * @return int
   */
  public function getRam(): int {
    return $this->ram;
  }

  /**
   * @param int $ram
   */
  public function setRam(int $ram): void {
    $this->ram = $ram;
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
}
