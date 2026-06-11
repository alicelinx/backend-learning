<?php
echo "<table>";
$filename = "csv/SampleCSV.csv";

if (file_exists($filename) && filesize($filename) > 0) { 
  $handle = fopen($filename, 'r');

  while (($row = fgetcsv($handle)) !== false) {
    echo "<tr>";
    foreach ($row as $cell) {
      echo "<td>$cell</td>";
    }
    echo "</tr>";
  }
  fclose($handle);
} else {
  echo "The file could not be found or is empty.";
}
echo "</table>";
?>