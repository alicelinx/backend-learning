<?php
use php\Vehicles\Vehicle;

class Truck extends Vehicle {
  public function __construct($brand, $seats, $fuel_capacity, $license_plate) {
    parent::__construct($brand, $seats, $fuel_capacity, $license_plate);
    $this->type = 'truck';
  }
  public function slowDown() {
    if ($this->current_speed > 0) {
      $this->current_speed -= 0.5;
      print "The truck ({$this->license_plate}) has decreased its speed. 
        The current speed is {$this->current_speed}.<br>";
    } else {
      print "The truck ({$this->license_plate}) is stopped.<br>";
    }
  }
}

// $truck = new Truck("Ford", 1, 25, "LKJ-4567");
// $truck->fillTank(20);
// $truck->accelerate(5);
// $truck->slowDown();

?>