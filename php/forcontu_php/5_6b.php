<?php

$string = "aabCcCCddDDeFFgGGhhhhIJJkLLmmmmnOpQrrrSssTTUV";

$pattern = '/[a-z]{2}[A-Z]{2,}/';

$count = preg_match_all($pattern, $string, $matches);

echo $count . "<br>";
print_r($matches);

?>