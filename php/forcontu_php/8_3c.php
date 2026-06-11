<?php

// Perform a query with the appropriate JOIN statement that returns 
// the complete list of employees with salaries greater than 100,000.
// For employees who have been department managers, 
// a column called "dep_manager" will be displayed with the department code. 

echo "SELECT t1.salary, t2.dept_no AS dep_manager 
      FROM salaries t1 
      LEFT JOIN dept_manager t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t1.salary >= 100000;";

?>