<?php

$users = [
  3 => 'foo',
  24 => 'boB654',
  26 => 'billanderson',
  45 => 'paulmAc2'
];


// That it has at least 6 characters.
// That it has at least one lowercase letter. 
// That it has at least one uppercase letter. 
// That the first letter is a lowercase letter. 
// That it has at least one numeric value.

$pattern = '/^[a-z](?=.*[a-z])(?=.*[A-Z])(?=.*\d).{5,}$/';

$validUsers = preg_grep($pattern, $users);

echo "<pre>";
print_r($validUsers);
echo "</pre>";


?>