<?php

$filename = "php_example.log";

if (file_exists($filename) && filesize($filename) > 0) { 
  $lines = file($filename);
  
  foreach ($lines as $line) {
    $parts = explode('|', $line);

    if (count($parts) === 3){
      $ip = $parts[0];
      $timestamp = $parts[1];
      $userAgent = $parts[2];
      $date = date('d/m/Y H:i:s', $timestamp);
      
      echo "IP: $ip <br>";
      echo "Date: $date <br>";
      echo "User agent: $userAgent <br>";
    }    
  }
  
  if (count($lines) >= 5) {

    // check the /logs exists, if not, create one
    $logsDir = 'logs';
    if (!is_dir($logsDir)) {
      mkdir($logsDir);
    }

    // new file name
    $now = time();
    $newFilename = "php_example.$now.log";
    $destination = $logsDir . '/' . $newFilename;

    // make a copy of the file
    copy($filename, $destination);
    // delete
    unlink($filename);

    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    $newLine = "$ip|$timestamp|$userAgent" . PHP_EOL;
    file_put_contents($filename, $newLine);
  }

} else {
  echo "File could not be found or is empty.";
}

?>