<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  
  <body>
    <?php
    $countries = [
      'uk' => 'United Kingdom',
      'fr' => 'France',
      'pt' => 'Portugal',
      've' => 'Venezuela',
      'at' => 'Austria',
      'es' => 'Spain',
      'co' => 'Colombia'
    ];

    $myCountry = 'Taiwan';
    if (in_array($myCountry, $countries)) {
      echo "My home country is $myCountry and it is in the list<br>";
    } else {
      echo "My home country is $myCountry but it is not in the list<br>";
    }
    
    asort($countries);
    print_r($countries) . "<br>";

    $countryString = implode(", ", $countries);
    echo $countryString;
    ?>
  </body>
  
</html>