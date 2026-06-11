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

      <tr>
        <td> <?php echo $movies[1]["identifier"]; ?> </td>
        <td> <?php echo $movies[1]["title"]; ?> </td>
        <td> <?php echo $movies[1]["director"]; ?> </td>
        <td> <?php echo $movies[1]["year"]; ?> </td>
        <td> <?php echo $movies[1]["duration"]; ?> </td>
      </tr>

      <tr>
        <td> <?php echo $movies[2]["identifier"]; ?> </td>
        <td> <?php echo $movies[2]["title"]; ?> </td>
        <td> <?php echo $movies[2]["director"]; ?> </td>
        <td> <?php echo $movies[2]["year"]; ?> </td>
        <td> <?php echo $movies[2]["duration"]; ?> </td>
      </tr>

      <tr>
        <td> <?php echo $movies[3]["identifier"]; ?> </td>
        <td> <?php echo $movies[3]["title"]; ?> </td>
        <td> <?php echo $movies[3]["director"]; ?> </td>
        <td> <?php echo $movies[3]["year"]; ?> </td>
        <td> <?php echo $movies[3]["duration"]; ?> </td>
      </tr>
      
      <tr>
        <td> <?php echo $movies[4]["identifier"]; ?> </td>
        <td> <?php echo $movies[4]["title"]; ?> </td>
        <td> <?php echo $movies[4]["director"]; ?> </td>
        <td> <?php echo $movies[4]["year"]; ?> </td>
        <td> <?php echo $movies[4]["duration"]; ?> </td>
      </tr>
    </table>
  </body>
</html>