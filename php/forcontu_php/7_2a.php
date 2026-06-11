<?php

class Subscription {
  public $months;

  public function __construct($months) {
    if ($months < 6) {
      throw new Exception('The minimum contract is 6 months');
    }
    $this->months = $months;
  }

  // Factory method
  public static function create($type, $months) {
    switch ($type) {
      case 'regular':
        return new RegularSubscription($months);
      case 'premium':
        return new PremiumSubscription($months);
      default:
        throw new Exception('Subscription type not available');
    }
  }
}

class RegularSubscription extends Subscription {
  public function __construct($months) {
    parent::__construct($months);
    echo "A subscription of type Regular has been created for {$this->months} months<br>";
  }
}

class PremiumSubscription extends Subscription {
  public function __construct($months) {
    parent::__construct($months);
    echo "A subscription of type Premium has been created for {$this->months} months<br>";
  }
}

// Testings
try {
  $subscription1 = Subscription::create('regular', 6);
} catch (Exception $e) {
  echo $e->getMessage() . "<br>";
}

try {
  $subscription2 = Subscription::create('premium', 12);
} catch (Exception $e) {
  echo $e->getMessage() . "<br>";
}

try {
  $subscription3 = Subscription::create('gold', 6);
} catch (Exception $e) {
  echo $e->getMessage() . "<br>";
}

try {
  $subscription4 = Subscription::create('premium', 3);
} catch (Exception $e) {
  echo $e->getMessage() . "<br>";
}
?>