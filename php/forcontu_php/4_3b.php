<?php
  $terminate = 1000;
  $i = 1;

  while ($i < 1000) {
    if ($i >= $terminate) {
      break;
    }

    if ($i % 2 != 0) {
      echo $i;
      $next = $i + 2;
      
      // if the next odd number doesn't reache terminate or 1000, print comma
      if ($next < $terminate && $next < 1000) {
        echo ",";
      }   
    }

    $i++;
  }
?>