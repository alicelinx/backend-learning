<?php

$filename = "php_example.log";

if (file_exists($filename) && filesize($filename) > 0) {

  $ip = $_SERVER['REMOTE_ADDR'];
  $timestamp = time();
  $userAgent = $_SERVER['HTTP_USER_AGENT'];

  $line = "$ip|$timestamp|$userAgent" . PHP_EOL;

  if (file_put_contents($filename, $line, FILE_APPEND)) {
    echo "IP: $ip <br>";
    echo "Timestamp: $timestamp <br>";
    echo "User agent: $userAgent <br>";
  } else {
    echo "Error: Could not write the file.";
  }

} else {
  echo "File could not be found or is empty.";
}



?>