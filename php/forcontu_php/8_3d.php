<?php

// Make a query that returns, 
// the male employees hired before 1999 (inclusive), 
// and that were finally fired, and the female employees 
// hired after 1999 (inclusive) that were not fired. 
// Use the UNION clause.

echo "SELECT t1.emp_no 
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
      AND t2.emp_no IS NULL;";
?>