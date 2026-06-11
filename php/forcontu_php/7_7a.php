<?php

class Product implements SplSubject {
  private $observers;
  private $name;
  private $original_price;
  private $current_price;
  private $sold = FALSE;

  public function __construct($name, $original_price) {
    // object container
    $this->observers = new SplObjectStorage();

    $this->name = $name;
    $this->original_price = $original_price;
    $this->current_price = $original_price;
  }

  public function attach(SplObserver $observer) {
    if ($this->sold) {
      echo "Cannot subscribe, {$this->name} already sold<br>";
      return;
    }
    $this->observers->attach($observer);
  }

  public function detach(SplObserver $observer) {
    $this->observers->detach($observer);
  }

  public function notify() {
    if ($this->sold) return;

    foreach ($this->observers as $observer) {
      $observer->update($this);
      if ($this->sold) break;
    }
  }

  public function setNewPrice($new_price) {
    if ($this->sold) {
      echo "Cannot change the price, {$this->name} has been sold<br>";
      return;
    }
    
    if ($new_price < $this->current_price) {
      $this->current_price = $new_price;
      echo "Product {$this->name} has a new price of <b> {$this->current_price} </b><br>";
      $this->notify();
    }
  }

  public function buy($buyer) {
    if ($this->sold) return;

    $this->sold = TRUE;
    echo "Buyer {$buyer->getUsername()} has bought {$this->name}<br>";
  }

  public function getPrice() {
    return $this->current_price;
  }

  public function getName() {
    return $this->name;
  }

  public function getOriginalPrice() {
    return $this->original_price;
  }

  public function isSold() {
    return $this->sold;
  }
}

class Buyer implements SplObserver {
  private $username;
  private $percentage;

  public function __construct($username, $percentage) {
    $this->username = $username;
    $this->percentage = $percentage;
  }

  public function update(SplSubject $subject) {
    if ($subject->isSold()) return;

    echo "{$this->username} has been notified of the new price of <b>{$subject->getName()} ({$subject->getPrice()})</b><br>";

    // calculation of price drop
    $original = $subject->getOriginalPrice();
    $current = $subject->getPrice();
    $drop = (($original - $current) / $original) * 100;
    if ($drop >= $this->percentage) {
      $subject->buy($this);
    }
  }

  public function getUsername() {
    return $this->username;
  }
}

$buyer1 = new Buyer("Fran", 5);
$buyer2 = new Buyer("Laura", 10);
$buyer3 = new Buyer("Mark", 15);

$product1 = new Product("Bycicle MX2", 700);
$product1->attach($buyer2);
$product1->attach($buyer3);

$product2 = new Product("Motorbike Yamaha", 3500);
$product2->attach($buyer1);
$product2->attach($buyer2);
$product2->attach($buyer3);

for ($i = 1; $i <= 20; $i++) {
  echo "Iteration {$i} <br>";
  $product1->setNewPrice($product1->getPrice() - 5);
  $product2->setNewPrice($product2->getPrice() - 10);
}
?>