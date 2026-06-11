<?php

// Perform a query with the appropriate JOIN statement 
// that returns the list of employees (employee code) 
// who have been department managers and who have not been fired before the year 1990 (inclusive).

echo "SELECT t1.emp_no 
      FROM dept_manager t1 
      LEFT JOIN emp_fired t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t2.date > '1990-12-31' 
      OR t2.date IS NULL;";

?>