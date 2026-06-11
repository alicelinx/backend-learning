<?php
$env = parse_ini_file('.env');

$server = $env['DB_HOST'];
$dbname = $env['DB_NAME'];
$username = $env['DB_USER'];
$password = $env['DB_PASS'];


try {
  $conn = new PDO("mysql:host=$server;dbname=$dbname",
                  $username, $password
  );
  echo "Connected successfully<br>";
} catch(PDOException $e) {
  echo "Connect failed: " . $e->getMessage() . "<br>";
  die();
}

// 8.3d
$sql1 = "SELECT t1.emp_no 
      FROM employees t1 
      INNER JOIN emp_fired t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t1.gender = 'M'  
      AND t1.hire_date <= '1999-12-31' 

      UNION 

      SELECT t1.emp_no 
      FROM employees t1 
      LEFT JOIN emp_fired t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t1.gender = 'F' 
      AND t1.hire_date >= '1999-01-01' 
      AND t2.emp_no IS NULL 
      LIMIT 100;";

// 8.3e
$sql2 = "SELECT YEAR(t1.hire_date) AS hire_year,
      COUNT(*) AS num_hired 
      FROM employees t1 
      JOIN titles t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t1.gender = 'F' 
      AND t2.title = 'Engineer' 
      GROUP BY YEAR(t1.hire_date) 
      ORDER BY hire_year ASC 
      LIMIT 100;";

$queries = [$sql1, $sql2];

foreach ($queries as $query) {
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  $rows = $stmt->fetchALL();

  if ($rows) {
    echo "<table>";
    echo "<tr>";
    foreach (array_keys($rows[0]) as $col) {
      echo "<th>$col</th>";
    }
    echo "</tr>";
  
    foreach ($rows as $row) {
      echo "<tr>";
      foreach ($row as $value) {
        echo "<td>$value</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }
}

?>