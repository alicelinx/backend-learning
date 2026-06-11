<?php
  $string1 = "abcdefg";
  $string2 = "abcdefghijk";

  if (strlen($string1) > strlen($string2)) {
    echo "String1 is greater than string2 by " . (strlen($string1) - strlen($string2)) . " characters.";
  } elseif (strlen($string1) < strlen($string2)) {
    echo "String1 is less than string2 by " . (strlen($string2) - strlen($string1)) . " characters.";
  } else {
    echo "The strings are equal and have " . strlen($string1) . " characters.";
  }
?>