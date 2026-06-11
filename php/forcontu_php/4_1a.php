<?php

  $num1 = 41;
  $num2 = 2.1;

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>

  <body>
    <?php 
      echo "The result of adding " . $num1 . " and " . $num2 . " is " . ($num1 + $num2) . ".<br>";
      echo "The result of subtracting " . $num1 . " and " . $num2 . " is " . ($num1 - $num2) . ".<br>";
      echo "The result of multiplying " . $num1 . " and " . $num2 . " is " . ($num1 * $num2) . ".<br>";
      echo "The result of dividing " . $num1 . " and " . $num2 . " is " . ($num1 / $num2) . ".<br>";
      echo "The result of the remainder of dividing " . $num1 . " and " . $num2 . " is " . ($num1 % $num2) . ".<br>";
    ?>
    
  </body>
  
</html>