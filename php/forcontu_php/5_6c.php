<?php

$string = "Vestibulum ante ipsum primis Drupal 7 faucibus orci luctus et ultrices posuere Drupal 10 cubilia Curae; Morbi euismod drUpal9 iaculis sem a gravida drupal6. ";

$pattern = '/(drupal)\s?(\d+)/i';
$replace = '$1-$2';

$result = preg_replace($pattern, $replace, $string);
echo $result;

?>