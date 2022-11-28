<?php

namespace Api\Models;

class Address {
  private string $region;
  private string $city;
  private string $street;
  private string $house;
  private int $flat;

  /**
   * @param string $region      область
   * @param string $city        город
   * @param string $street      улица
   * @param string $house       дом
   * @param int $flat           квартира
   */
  public function __construct(
    string $region = "",
    string $city = "",
    string $street = "",
    string $house = "",
    int $flat = 0
  ) {
    $this->region = $region;
    $this->city = $city;
    $this->street = $street;
    $this->house = $house;
    $this->flat = $flat;
  }

  /**
   * @return string
   */
  public function getRegion(): string {
    return $this->region;
  }

  /**
   * @param string $region
   */
  public function setRegion(string $region): void {
    $this->region = $region;
  }

  /**
   * @return string
   */
  public function getCity(): string {
    return $this->city;
  }

  /**
   * @param string $city
   */
  public function setCity(string $city): void {
    $this->city = $city;
  }

  /**
   * @return string
   */
  public function getStreet(): string {
    return $this->street;
  }

  /**
   * @param string $street
   */
  public function setStreet(string $street): void {
    $this->street = $street;
  }

  /**
   * @return string
   */
  public function getHouse(): string {
    return $this->house;
  }

  /**
   * @param string $house
   */
  public function setHouse(string $house): void {
    $this->house = $house;
  }

  /**
   * @return int
   */
  public function getFlat(): int {
    return $this->flat;
  }

  /**
   * @param int $flat
   */
  public function setFlat(int $flat): void {
    $this->flat = $flat;
  }

  /**
   * Возвращает поля объекта в виде ассоциативного массива
   * @return array
   */
  public function toArray(): array {
    return [
      "region" => $this->getRegion(),
      "city" => $this->getCity(),
      "street" => $this->getStreet(),
      "house" => $this->getHouse(),
      "flat" => $this->getFlat()
    ];
  }
}
