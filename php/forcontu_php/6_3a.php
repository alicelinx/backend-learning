<?php
use php\Vehicles\Vehicle;

class Motorbike extends Vehicle {
  public function __construct($brand, $seats, $fuel_capacity, $license_plate) {
    parent::__construct($brand, $seats, $fuel_capacity, $license_plate);
    $this->type = 'motorcycle';
  }

  public function accelerate($acceleration = 1) {
    parent::accelerate($acceleration * 3);
  }
}

// $motorcycle = new Motorbike("Toyota", 1, 10, "JYJ-123");
// $motorcycle->fillTank(10);
// $motorcycle->accelerate(1);

?>