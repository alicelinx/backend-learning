<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  
  <body>
    <?php
    $dates = [
      ['day' => 3, 'month' => 12, 'year' => 2005],
      ['day' => 30, 'month' => 2, 'year' => 2017],
      ['day' => 7, 'month' => 9, 'year' => 2019],
      ['day' => 1, 'month' => 11, 'year' => 2014]
    ];


    foreach ($dates as $key => &$date) {
      if (!checkdate($date['month'], $date['day'], $date['year'])) {
        unset($date[$key]);
        continue;
      }

      $date['timestamp'] = mktime(0, 0, 0, $date['month'], $date['day'], $date['year']);
    }
    unset($date);

    $todayTimestamp = time();
    $dates[] = [
      'day' => (int)date('j'),
      'month' => (int)date('n'),
      'year' => (int)date('Y'),
      'timestamp' => $todayTimestamp
    ];

    echo "<pre>";
    print_r($dates);
    echo "</pre>";
    ?>
  </body>
  
</html>