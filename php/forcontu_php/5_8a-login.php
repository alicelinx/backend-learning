<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>User Login</title>
  </head>
  <body>

    <?php
    // if logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
      echo "<p>User Name in session: " . htmlspecialchars($_SESSION['username']) . "</p>";
      echo '<p><a href="5_8a-logout.php">Logout</a></p>';
    } else {
    ?>
      <!-- if not logged in -->
      <form name="login" method="post" action="5_8a-process.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
      </form>
    <?php
    }
    ?>

  </body>
</html>