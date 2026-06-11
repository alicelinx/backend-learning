<?php

class User {
  private static $instance;
  private $name;

  public static function getInstance($name) {
    if (!isset(self::$instance)) {
      self::$instance = new self($name);
    }
    return self::$instance;
  }

  private function __construct($name) {
    $this->name = $name;
  }

  private function __clone() {
  }

  public function getName() { 
    return $this->name;
  }
}


try {
  $user1 = new User("Alice");
} catch (Error $e) {
  echo "Cannot create user directly<br>";
}

$user2 = User::getInstance("Alice");
print $user2->getName();

echo "<br>";

$user3 = User::getInstance("Bob");
print $user3->getName();

?>