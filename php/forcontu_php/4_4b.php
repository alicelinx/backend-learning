<?php
include '4_4a.php';

$numbers = [
  ['num1' => 41, 'num2' => 2.1],
  ['num1' => 3, 'num2' => 67],
  ['num1' => 145, 'num2' => 0],
  ['num1' => 28, 'num2' => 87]
];

$operations = [
  'addition' => '+',
  'subtraction' => '-',
  'division' => '/',
  'multiplication' => '*',
  'remainder' => '%'
];

// echo "<pre>";
foreach ($numbers as $number) {
  $numOne = $number['num1'];
  $numTwo = $number['num2'];

  foreach ($operations as $operation => $symbol) {
    $result = calculator($numOne, $numTwo, $operation);
    
      if ($result === "ERROR0") {
        echo "$numOne $symbol $numTwo = Division by zero error\n";
      } else {
        echo "$numOne $symbol $numTwo = $result\n";
      }
  }
}
// echo "</pre>";
?>