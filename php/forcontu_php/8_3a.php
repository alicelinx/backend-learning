<?php

// Make a query that returns the employee code, first and last name, 
// date of hire and salary of those employees who started in the company after 1990
// and have had a salary between 60000 and 65000. It avoids repeating results. 
// The results will be sorted by salary, from highest to lowest, and the first and last name will be shown in upper case. 

echo "SELECT DISTINCT t1.emp_no, UPPER(t1.first_name), UPPER(t1.last_name), t1.hire_date, t2.salary 
      FROM employees t1 
      LEFT JOIN salaries t2 
      ON t1.emp_no = t2.emp_no 
      WHERE t1.hire_date > '1989-12-31' 
      AND t2.salary BETWEEN 60000 AND 65000 
      ORDER BY t2.salary DESC;";

?>