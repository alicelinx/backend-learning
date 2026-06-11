<?php
use php\Vehicles\Vehicle;

class Car extends Vehicle {
  public function __construct($brand, $seats, $fuel_capacity, $license_plate) {
    parent::__construct($brand, $seats, $fuel_capacity, $license_plate);
    $this->type = 'car';
  }
}
?>