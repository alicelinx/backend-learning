<?php
interface Codify {
  public function encode($data);
  public function decode($data);
}

class Serialize implements Codify {
  public function encode($data) {
    return serialize($data);
  }
  public function decode($data) {
    return unserialize($data);
  }
}

class Json implements Codify {
  public function encode($data) {
    return json_encode($data);
  }
  public function decode($data) {
    // adding 'true' to return array
    return json_decode($data, true);
  }
}

$data = [
  'apples' => ['red' => 5, 'green' => 23],
  'oranges' => 12,
  'pears' => 'Not available'
];

$serialize = new Serialize();
$encodedSerialization = $serialize->encode($data);
$decodedSerialization = $serialize->decode($encodedSerialization);

echo "<b>Serialize encoded:</b>";
echo "<pre>";
print_r($encodedSerialization);
echo "</pre>";
echo "<b>Serialize decoded:</b>";
echo "<pre>";
print_r($decodedSerialization);
echo "</pre>";


$json = new Json();
$encodedJson = $json->encode($data);
$decodedJson = $json->decode($encodedJson);

echo "<b>JSON encoded:</b>";
echo "<pre>";
print_r($encodedJson);
echo "</pre>";
echo "<b>JSON decoded:</b>";
echo "<pre>";
print_r($decodedJson);
echo "</pre>";
?>