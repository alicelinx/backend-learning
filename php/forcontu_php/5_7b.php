<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_POST = [
    'firstname' => 'Alice',
    'lastname' => 'Lin',
    'country' => 'Taiwan',
    'username' => 'alin1234',
    'password' => '123456789_10'
  ];
}

$firstname = $_POST['firstname'] ?? '';
$lastname  = $_POST['lastname'] ?? '';
$country   = $_POST['country'] ?? '';
$username  = $_POST['username'] ?? '';
$password  = $_POST['password'] ?? '';

// The username has at least 8 characters and starts with lowercase.
$usernamePattern = '/^[a-z].{7,}$/';

// The password is at least 10 characters long and contains at least one of these characters: . (dot), / (slash) or _ (underscore).
$passwordPattern = '/^(?=.{10,})(?=.*[._\/]).*$/';

$usernameValid = preg_match($usernamePattern, $username);
$passwordValid = preg_match($passwordPattern, $password);


echo "Name: $firstname<br>";
echo "Surname: $lastname<br>";
echo "Country: $country<br>";


if ($usernameValid) {
    echo "Username: " . md5($username) . "<br>";
} else {
    echo "Username: $username (invalid)<br>";
}


if ($passwordValid) {
    echo "Password: " . md5($password) . "<br>";
} else {
    echo "Password: $password (invalid)<br>";
}

?>