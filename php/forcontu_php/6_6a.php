<?php
trait Insurance {
  public $monthly_fee;

  public function calculateMonthlyFee($age) {
    $nameLength = strlen($this->name);
    $this->monthly_fee = $age * $nameLength;
  }
}
?>