<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Logout</title>
  </head>
  <body>
    <p>You have been logged out.</p>
    <p><a href="5_8a-login.php">Back to form</a></p>
  </body>
</html>