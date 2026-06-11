<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  
  <body>
    <?php
    $numbers = [3, 45, 22, 12, 33, 23, 44, 1, 121];
    $oddCount = 0;
    $evenCount = 0;

    // 1. Print the number of elements in the array. 
    echo "1. " . count($numbers) . " elements <br>";
    
    
    // 2. Count and print the number of odd and even elements. 
    foreach ($numbers as $number) {
      if ($number % 2 == 0) {
        $evenCount++;
      } else {
        $oddCount++;
      }
    }
    echo "2. $evenCount (even); $oddCount (odd)<br>";

    // 3. Sort the array elements in ascending order.
    sort($numbers);
    
    // 4. Create an array named $morenumbers, from the string "5:76:7:8". Use the appropriate array functions to convert the string to an array of numbers. 
    $morenumbers = explode(":", "5:76:7:8");

    // 5. Combine the two arrays, so that the numbers in $numbers come first. Store the result in the $numbers array. 
    $numbers = array_merge($numbers, $morenumbers);

    // 6. Sort the array elements in descending order.
    rsort($numbers); 

    // Finally, print the resulting $numbers array using print_r().
    print_r($numbers);
    ?>
  </body>
  
</html>