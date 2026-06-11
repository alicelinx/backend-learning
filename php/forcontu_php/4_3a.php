<?php
  $movies = [
    1 => [
      "identifier" => 1,
      "title" => "Life of Pi",
      "director" => "Ang Lee",
      "year" => 2012,
      "duration" => "2h 7m"
    ],
    2 => [
      "identifier" => 2,
      "title" => "Django Unchained",
      "director" => "Quentin Tarantino",
      "year" => 2012,
      "duration" => "2h 45m"
    ],
    3 => [
      "identifier" => 3,
      "title" => "The Dark Knight",
      "director" => "Christopher Nolan",
      "year" => 2008,
      "duration" => "2h 32m"
    ],
    4 => [
      "identifier" => 4,
      "title" => "The Grand Budapest Hotel",
      "director" => "Wes Anderson",
      "year" => 2014,
      "duration" => "1h 40m"
    ],
    5 => [
      "identifier" => 5,
      "title" => "Taken",
      "director" => "Pierre Morel",
      "year" => 2008,
      "duration" => "1h 33m"
    ]
  ];
?>


<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>

  <body>
    <table>
      <tr>
        <th>Identifier</th>
        <th>Title</th>
        <th>Director</th>
        <th>Year</th>
        <th>Duration</th>
      </tr>

      <?php 
        for ($i = 1; $i <= count($movies); $i++) {
          echo "<tr>";
          echo "<td>" . $movies[$i]["identifier"] . "</td>";
          echo "<td>" . $movies[$i]["title"] . "</td>";
          echo "<td>" . $movies[$i]["director"] . "</td>";
          echo "<td>" . $movies[$i]["year"] . "</td>";
          echo "<td>" . $movies[$i]["duration"] . "</td>";
          echo "</tr>";
        }
      ?>
    </table>
  </body>
</html>