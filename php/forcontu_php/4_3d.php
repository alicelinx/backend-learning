<?php
  $employees = [
    13 => [
      'firstname' => 'Mark',
      'lastname'  => 'Gil',
      'salary'     => 900
    ],
    3 => [
      'firstname' => 'Frank',
      'lastname'  => 'Williams',
      'salary'     => 2700
    ],
    42 => [
      'firstname' => 'Saul',
      'lastname'  => 'Goodman',
      'salary'     => 1800
    ]
  ];
  
  $highestSalary = 0;
  $highestEmployee = '';
?>


<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>

  <body>
    <ul>
      <?php
        foreach ($employees as $id => $employee) {

          $salary = $employee['salary'];

          //switch for salary level
          switch (true) {
            case ($salary < 1000):
              $level = 'low';
              break;
            
            case ($salary > 1000 && $salary < 2000):
              $level = 'medium';
              break;

            default:
              $level = 'high';
          }

          //find the highest salary and employee
          if ($salary > $highestSalary) {
            $highestSalary = $salary;
            $highestEmployee = $employee['firstname'] . ' ' . $employee['lastname'];
          }

          echo '<li>'
            . $employee['firstname'] . ' '
            . $employee['lastname']
            . ' (ID: ' . $id . ') has a salary of '
            . $employee['salary'] . ' € (' . $level . ').'
            . '</li>';
        }
      ?>
    </ul>
    <p>
      <?php
        echo $highestEmployee
          . ' has the highest salary of all '
          . $highestSalary
          . ' €.';
      ?>
    </p>
</body>