<?php
require '6_4a.php';
require '6_6a.php';

class Cat extends Pet {
  use Insurance;
  public $name;
  public static $max_feed;
  private $feed = 0;

  public function __construct($name, $age) {
    $this->name = $name;
    parent::__construct($age);
    self::$max_feed = 5;
  }

  public function feed($quantity) {
    if ($quantity + $this->feed > self::$max_feed) {
      throw new Exception("You can't feed the cat that much.");
    }
    $this->feed += $quantity;
  }
}

?>