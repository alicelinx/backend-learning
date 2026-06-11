<?php
require '6_1a.php';
require '6_3a.php';
require '6_3b.php';
require '6_3c.php';
use php\Vehicles\Vehicle;

$motorbike1 = new Motorbike("Honda", 1, 18, "2X88Z");
$motorbike1->fillTank(18);
$motorbike1->startEngine();
for ($i = 0; $i < 3; $i++) {
  $motorbike1->accelerate(1);
}
for ($i = 0; $i < 9; $i++) {
  $motorbike1->slowDown();
}
$motorbike1->stopEngine();


$truck1 = new Truck("Ford", 5, 100, "VBN-8765");
$truck1->fillTank(50);
$truck1->startEngine();
for ($i = 0; $i < 5; $i++) {
  $truck1->accelerate(5);
}
for ($i = 0; $i < 50; $i++) {
  $truck1->slowDown();
}
$truck1->stopEngine();

print_r(Vehicle::getVehicleTypes());
?>