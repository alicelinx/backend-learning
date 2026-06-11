<?php
require '6_1a.php';
use php\Vehicles\Vehicle as Driving;

$vehicle1 = new Driving("Toyota", 5, 20, "LMN-9876");

$vehicle1->fillTank(20);
$vehicle1->startEngine();

for ($i = 0; $i < 10; $i++) {
    $vehicle1->accelerate(1);
}

for ($i = 0; $i < 10; $i++) {
    $vehicle1->slowDown();
}

$vehicle1->stopEngine();
?>