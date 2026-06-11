<?php
$env = parse_ini_file('.env');

$conn = new mysqli(
  $env['DB_HOST'],
  $env['DB_USER'],
  $env['DB_PASS'],
  $env['DB_NAME']
);

if ($conn->connect_errno) {
  die("Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error);
}

// 8.3a
$sql1 = "SELECT DISTINCT t1.emp_no, UPPER(t1.first_name) AS first_name, UPPER(t1.last_name) AS last_name, t1.hire_date, t2.salary 
      FROM employees t1 
      LEFT JOIN salaries t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t1.hire_date > '1989-12-31' 
      AND t2.salary BETWEEN 60000 AND 65000 
      ORDER BY t2.salary DESC 
      LIMIT 100;";

// 8.3b
$sql2 = "SELECT t1.emp_no 
      FROM dept_manager t1 
      LEFT JOIN emp_fired t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t2.date > '1990-12-31' 
      OR t2.date IS NULL 
      LIMIT 100;";

// 8.3c
$sql3 = "SELECT t1.salary, t2.dept_no AS dep_manager 
      FROM salaries t1 
      LEFT JOIN dept_manager t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t1.salary >= 100000 
      LIMIT 100;";

$queries = [$sql1, $sql2, $sql3];

foreach ($queries as $query) {
  $result = $conn->query($query);

  if ($result) {
    echo "<table>";
    echo "<tr>";
    while ($field = $result->fetch_field()) {
      echo "<th>{$field->name}</th>";
    }
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      foreach ($row as $value) {
        echo "<td>$value</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }
}

$conn->close();
?>