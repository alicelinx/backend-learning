<!DOCTYPE html>
<html>
  <head>
    <title>POST form</title>
  </head>
  <body>

    <form name="form1" method="post" action="5_7b.php">

      <label for="firstname">First name:</label>
      <input type="text" name="firstname" required><br><br>

      <label for="lastname">Last name:</label>
      <input type="text" name="lastname" required><br><br>

      <label for="country">Country:</label>
      <select name="country" required>
        <option value="">Select</option>
        <option value="Canada">Canada</option>
        <option value="Taiwan">Taiwan</option>
      </select><br><br>

      <label for="username">User name:</label>
      <input type="text" name="username" required><br><br>

      <label for="password">Password:</label>
      <input type="password" name="password" required><br><br>

      <button type="submit">Submit</button>

    </form>

  </body>
</html>