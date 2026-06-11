<?php
namespace php\Vehicles;

class Vehicle {
  public $brand = "Toyota";
  public $seats = 5;
  public $fuel_capacity = 15;
  public $license_plate = "ABC-1234";
  public $type = "";
  public static $vehicle_types = ["motorcyle", "car", "truck"];

  protected $fuel_level = 10;
  protected $current_speed = 0;
  protected $state = "off";
  
  public function getBrand() {
    return $this->brand;
  }

  public function getSeats() {
    return $this->seats;
  }

  public function getLicensePlate() {
    return $this->license_plate;
  }

  public static function getVehicleTypes() {
    return self::$vehicle_types;
  }

  public function setFuelLevel($fuel_level) {
    $old_fuel_level = $this->fuel_level;
    $this->fuel_level = $fuel_level;
    $difference = $fuel_level - $old_fuel_level;
    print "The fuel level has been increased by $difference. The current fuel level is $fuel_level.<br>";
  }

  public function setCurrentSpeed($current_speed) {
    $old_speed = $this->current_speed;
    $this->current_speed = $current_speed;
    $difference = $current_speed - $old_speed;
    print "The speed has been increased by $difference. The current speed is $current_speed.<br>";
  }

  public function setState($state) {
    $this->state = $state;
    }
    
  public function startEngine() {
    if ($this->state === "off") {
      $this->state = "on";
      print "Vehicle ({$this->license_plate}) has started.<br>";
      return TRUE;
    } else {
      print "The vehicle ({$this->license_plate}) was already running.<br>";
      return FALSE;
    }
  }

  public function accelerate($acceleration) {
    if ($acceleration < 1 || $acceleration > 5) {
      print "Acceleration must be between 1 and 5.<br>";
      return;
    }
    $this->current_speed += $acceleration;
    $this->fuel_level -= $acceleration;
    print "The vehicle ({$this->license_plate}) has increased the speed by $acceleration. 
      Current speed is {$this->current_speed}. Fuel level is {$this->fuel_level}.<br>";
  }

  public function slowDown() {
    if ($this->current_speed > 0) {
      $this->current_speed--;
      print "The vehicle ({$this->license_plate}) has decreased its speed. 
        The current speed is {$this->current_speed}.<br>";
    } else {
      print "The vehicle ({$this->license_plate}) is stopped (when the speed is 0).<br>";
    }
  }

  public function stopEngine() {
    if ($this->state === "on" && $this->current_speed <= 0) {
      $this->state = "off";
      print "The vehicle ({$this->license_plate}) has been turned off.<br>";
    } else {
      print "The vehicle ({$this->license_plate}) was already turned off.<br>";
    }
  }

  public function fillTank($quantity) {
    $space_left = $this->fuel_capacity - $this->fuel_level;
    if ($space_left === 0) {
      print "The tank is full ({$this->fuel_level} liters).<br>";
    }

    if ($space_left >= $quantity) {
      $this->fuel_level += $quantity;
      print "The vehicle ({$this->license_plate}) has been filled with $quantity liters of fuel.<br>";
    }    
  }

  public function __construct($brand, $seats, $fuel_capacity, $license_plate) {
    $this->brand = $brand;
    $this->seats = $seats;
    $this->fuel_capacity = $fuel_capacity;
    $this->license_plate = $license_plate;

    $this->fuel_level = 0;
    $this->current_speed = 0;
    $this->state = "off";
  
    print "Vehicle {$this->brand} with license plate {$this->license_plate} has been registered.<br>";
  }

  public function __destruct() {
    // slow down until the vehicle stops
    while ($this->current_speed > 0) {
      $this->slowDown();
    }

    // turn off the engine
    if ($this->state === "on") {
      $this->stopEngine();
    }

    print "The vehicle {$this->license_plate} has been stopped and turned off permanently.<br>";
  }
}
?>