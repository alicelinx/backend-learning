<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$validUsers =
  ($username === 'admin' && $password === 'forcontu') ||
  ($username === 'demouser' && $password === 'forcontu');

if ($validUsers) {
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $username;

  echo "<p>Login successful. Welcome, " . htmlspecialchars($username) . ".</p>";
} else {
  echo "<p>The data entered is not correct.</p>";
}
?>

<p><a href="5_8a-login.php">Back to form</a></p>