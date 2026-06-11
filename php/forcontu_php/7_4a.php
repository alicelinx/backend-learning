<?php

abstract class Motor {
  abstract public function start();
  abstract public function accelerate();
  abstract public function stop();
}

class MotorHibrido {
  public $active_engine;
  public $battery_level;

  public function __construct() {
    $this->active_engine = "battery";
    $this->battery_level = 80;
    print "New hybrid engine<br>";
  }

  public function useBattery() {
    if ($this->active_engine !== "battery") {
      $this->active_engine = "battery";
      print "Switching to battery<br>";
    } else {
      print "Already using battery<br>";
    }
  }

  public function useGasoline() {
    if ($this->active_engine !== "gasoline") {
      $this->active_engine = "gasoline";
      print "Switching to gasoline<br>";
    } else {
      print "Already using gasoline<br>";
    }
  }
  
  public function startBattery() {
    if ($this->active_engine === "battery") {
      print "Engine started in battery mode<br>";
    } else {
      print "Cannot start engine: switch to battery mode first<br>";
    }
  }

  public function startGasoline() {
    if ($this->active_engine === "gasoline") {
      print "Engine started in gasoline mode<br>";
    } else {
      print "Cannot start engine: switch to gasoline mode first<br>";
    }
  }

  public function accelerateBattery() {
    if ($this->active_engine === "battery") {
      $this->battery_level -= 10;
      print "Battery engine accelerated, battery at {$this->battery_level}%<br>";

      if ($this->battery_level <= 10) {
        print "Battery low, switching to gasoline<br>";
        $this->useGasoline();
      }
      
    } else {
      print "Cannot accelerate: switch to battery mode first<br>";
    }
  }

  public function accelerateGasoline() {
    if ($this->active_engine === "gasoline") {
      $this->battery_level += 10;
      print "Gasoline engine accelerated, battery at {$this->battery_level}%<br>";

    } else {
      print "Cannot accelerate: switch to gasoline mode first<br>";
    }
  }

  public function stopBattery() {
    if ($this->active_engine === "battery") {
      print "Battery engine stopped<br>";
    } else {
      print "Cannot stop: switch to battery mode first<br>";
    }
  }

  public function stopGasoline() {
    if ($this->active_engine === "gasoline") {
      print "Gasoline engine stopped<br>";
    } else {
      print "Cannot stop: switch to gasoline mode first<br>";
    }
  }
}

class MotorHibridoAdapter extends Motor {
  private $motor;

  public function __construct() {
    $this->motor = new MotorHibrido();
    print "Creating adapter for hybrid motor<br>";
  }
  
  public function start() {
    if ($this->motor->battery_level > 0) {
      $this->motor->useBattery();
      $this->motor->startBattery();
    } else {
      $this->motor->useGasoline();
      $this->motor->startGasoline();
    }
  }

  public function accelerate() {
    if ($this->motor->active_engine === "battery" && $this->motor->battery_level > 10) {
      $this->motor->accelerateBattery();
    } else {
      $this->motor->accelerateGasoline();
    }
  }

  public function stop() {
    if ($this->motor->active_engine === "battery") {
      $this->motor->stopBattery();
    } else {
      $this->motor->stopGasoline();
    }
  }
}

class MotorDiesel extends Motor {
  public function __construct() {
    print "New diesel engine<br>";
  }
  public function start() {
    print "Start the diesel engine<br>";
  }
  public function accelerate() {
    print "Accelerate the diesel engine<br>";
  }
  public function stop() {
    print "Turn off the diesel engine<br>";
  }
}

class ElectricMotor extends Motor {
  public function __construct() {
    print "New electric motor<br>";
  }
  public function start() {
    print "Start the electric engine<br>";
  }
  public function accelerate() {
    print "Accelerate the electric engine<br>";
  }
  public function stop() {
    print "Turn off the electric engine<br>";
  }
}

echo "<hr><b>Testing Motors</b><br>";

$engineDiesel = new MotorDiesel();
$engineElectric = new ElectricMotor();
$engineHybrid = new MotorHibridoAdapter();

echo "<br><b>Start</b><br>";
$engineDiesel->start();
$engineElectric->start();
$engineHybrid->start();

echo "<br><b>Accelerate</b><br>";
for ($i = 0; $i < 15; $i++) {
  print "Iteration " . ($i + 1) . "<br>";
  $engineDiesel->accelerate();
  $engineElectric->accelerate();
  $engineHybrid->accelerate();
}

echo "<br><b>Stop</b><br>";
$engineDiesel->stop();
$engineElectric->stop();
$engineHybrid->stop();
?>