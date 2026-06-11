<?php

// Perform a query that returns the number of female engineers 
// that were hired per year, showing also the number of contracts.
// Sort the results by year from lowest to highest.

echo "SELECT YEAR(t1.hire_date) AS hire_year,
      COUNT(*) AS num_hired 
      FROM employees t1 
      JOIN titles t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t1.gender = 'F' 
      AND t2.title = 'Engineer' 
      GROUP BY YEAR(t1.hire_date) 
      ORDER BY hire_year ASC;
";

?>