<?php
require '6_4b.php';

$cat = new Cat("Bee", 1);
$cat->calculateMonthlyFee(1);

for ($i = 1; $i <= 10; $i++) {
  try {
    $cat->feed(1);
    echo "{$cat->name} can continue eating.<br>";
  } catch (Exception $e) {
    echo $e->getMessage() . " {$cat->name} is already well fed.<br>";
    break;
  }
}

echo "Monthly insurance fee: \${$cat->monthly_fee}";

?>