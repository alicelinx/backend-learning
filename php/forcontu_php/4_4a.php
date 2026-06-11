<?php
  function calculator($num1, $num2, $operation = 'sum') {
    switch ($operation) {
      case 'addition':
        return $num1 + $num2;

      case 'subtraction':
        return $num1 - $num2;

      case 'division':
        if ($num2 == 0) {
          return "ERROR0";
        }
        return $num1 / $num2;

      case 'multiplication':
        return $num1 * $num2;

      case 'remainder':
        if ($num2 == 0) {
          return "ERROR0";
        }
        return $num1 % $num2;
      
      default:
        return $num1 + $num2;
    }
  }

?>