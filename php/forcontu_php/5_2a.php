<?php

$strings = [
  " Lorem ipsum dolor sit amet drupal, consectetur adipiscing elit. Etiam sapien Drupal mauris, vestibulum quis mattis sit amet.",
  "Praesent elementum urna et Drupal condimentum DRUPAL vulputate blandit. Vestibulum eget ipsum Drupal sapien consequat vulputate Drupal. ",
  "Phasellus laoreet eu drupal orci et tincidunt. Quisque ac drupal gravida sem, non eleifend erat DrUPal."
];

?>


<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  
  <body>
    <?php
    $totalChar = 0;
    $totalSpaces = 0;
    $totalDrupal = 0;

    foreach ($strings as &$string) {
        
        // 1. Calculate and print the number of characters in each string. Print also the total number of characters.
        echo "1. " . strlen($string) . "<br>";
        $totalChar += strlen($string);

        // 2. Eliminate possible spaces at the beginning and end of each string.
        $string = trim($string);
        echo "2. " . $string . "<br>";
        
        // 3. Calculate and print the number of spaces in each string. It also prints the total number of spaces.
        echo "3. " . substr_count($string, " ") . "<br>";
        $totalSpaces += substr_count($string, " ");
      
        // 4. Replace all Drupal variants (DRUPAL, drupal, dRUpal, etc.) with Drupal.
        echo "4. " . $string = str_ireplace("drupal", "Drupal", $string) . "<br>";
      
        // 5. Calculate and print the number of times the word Drupal appears in each string. Also print the total.
        echo "5. " . substr_count($string, "Drupal") . "<br>";
        $totalDrupal += substr_count($string, "Drupal");

        // 6. Trim all strings to 100 characters (keep the first 100 characters).
        echo "6. " . $string = substr($string, 0, 100) . "<br>";

        // 7. Replace the word Drupal with "<strong>Drupal</strong>", so that it is shown in bold.
        echo "7. " . $string = str_replace("Drupal", "<strong>Drupal</strong>", $string) . "<br>";

      }
      unset($string);
      echo "Total characters: " . $totalChar . "<br>";
      echo "Total spaces: " . $totalSpaces . "<br>";
      echo "Total Drupal counts: " . $totalDrupal . "<br>";
    ?>
  </body>
  
</html>